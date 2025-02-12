<?php

namespace App\Livewire\Collect;

use DragonCode\Support\Facades\Helpers\Arr;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CollectChart extends Component
{
    protected $listeners = ['connectionUpdated', 'popUpdated'];
    public $currentConnection;
    public $selectedYear;
    public $pop = 'PARINTINS';
    public array $myChart = [
        'type' => 'line',
        'data' => [
            'labels' => ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            'datasets' => [
                [
                    'label' => 'Total Cancelado',
                    'data' => [],
                ],
                [
                    'label' => 'Total Recolhido',
                    'data' => [],
                ]
            ]
        ]
    ];

    public function mount()
    {
        $this->currentConnection = session('currentConnection', 'sgp');
        $this->selectedYear = date('Y');
        $this->refreshData();
    }

    public function popUpdated($newPop)
    {
        $this->pop = $newPop;
        $this->refreshData();
    }

    public function updatedSelectedYear($year)
    {
        $this->selectedYear = $year;
        $this->refreshData();
    }

    public function connectionUpdated($newConnection)
    {
        $this->currentConnection = $newConnection;
        $this->refreshData();
    }

    public function refreshData()
    {
        $totalCanceled = $this->fetchMonthlyData('canceled');
        $totalCollected = $this->fetchMonthlyData('collected');

        // Atualizando os dados no gráfico
        $this->myChart['data']['datasets'][0]['data'] = $totalCanceled;
        $this->myChart['data']['datasets'][1]['data'] = $totalCollected;
    }

    private function fetchMonthlyData(string $type): array
    {
        if (!$this->currentConnection) {
            return array_fill(0, 12, 0);
        }

        $query = DB::connection($this->currentConnection)
            ->table('admcore_clientecontrato')
            ->join('admcore_clientecontratostatus', 'admcore_clientecontrato.status_id', '=', 'admcore_clientecontratostatus.id')
            ->join('admcore_pop', 'admcore_pop.id', '=', 'admcore_clientecontrato.pop_id')
            ->when($this->pop, function ($query) {
                $query->where('admcore_pop.cidade', $this->pop);
            })
            ->selectRaw('EXTRACT(MONTH FROM admcore_clientecontrato.data_alteracao) as month, COUNT(*) as total')
            ->whereRaw('EXTRACT(YEAR FROM admcore_clientecontrato.data_alteracao) = ' . $this->selectedYear)
            ->groupByRaw('EXTRACT(MONTH FROM admcore_clientecontrato.data_alteracao)');

        if ($type === 'canceled') {
            $query->where('admcore_clientecontratostatus.status', 3);
        } elseif ($type === 'collected') {
            $query->join('admcore_servicointernet', 'admcore_clientecontrato.id', '=', 'admcore_servicointernet.clientecontrato_id')
                ->join('netcore_onu', 'admcore_servicointernet.id', '=', 'netcore_onu.service_id')
                ->where('admcore_clientecontratostatus.status', 3);
        }

        $results = $query->get();

        $monthlyData = array_fill(0, 12, 0);
        foreach ($results as $result) {
            $monthIndex = (int) $result->month - 1;
            if ($monthIndex >= 0 && $monthIndex < 12) {
                $monthlyData[$monthIndex] = (int) $result->total;
            }
        }
        return $monthlyData;
    }

    public function render()
    {
        return view('livewire.collect.collect-chart', ['chartData' => $this->myChart]);
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ServiceOrderMotivoOs extends Component
{
    protected $listeners = ['connectionUpdated', 'popUpdated'];

    public $data;
    public $currentConnection;
    public $selectedMonth;
    public $totalMonth;
    public $pop;

    public function mount()
    {
        $this->currentConnection = session('currentConnection', 'sgp');
        $this->selectedMonth = now()->format('Y-m');
        $this->pop = session('pop', 'PARINTINS');
    }


    public function connectionUpdated($newConnection)
    {
        $this->currentConnection = $newConnection;
    }

    public function popUpdated($newPop)
    {
        $this->pop = $newPop;
    }


    public function loadData()
    {

        $year = date('Y', strtotime($this->selectedMonth));
        $month = date('m', strtotime($this->selectedMonth));

        $this->data = DB::connection($this->currentConnection)->table('admcore_pessoa')
            ->join('admcore_cliente', 'admcore_pessoa.id', '=', 'admcore_cliente.pessoa_id')
            ->join('admcore_endereco', 'admcore_cliente.endereco_id', '=', 'admcore_endereco.id')
            ->join('admcore_clientecontrato', 'admcore_cliente.id', '=', 'admcore_clientecontrato.cliente_id')
            ->join('admcore_pop', 'admcore_pop.id', '=', 'admcore_clientecontrato.pop_id')
            ->join('admcore_servicointernet', 'admcore_servicointernet.clientecontrato_id', '=', 'admcore_clientecontrato.id')
            ->join('atendimento_ocorrencia', 'admcore_clientecontrato.id', '=', 'atendimento_ocorrencia.clientecontrato_id')
            ->join('atendimento_os', 'atendimento_ocorrencia.id', '=', 'atendimento_os.ocorrencia_id')
            ->join('auth_user', 'atendimento_os.responsavel_id', '=', 'auth_user.id')
            ->join('atendimento_motivoos', 'atendimento_os.motivoos_id', '=', 'atendimento_motivoos.id')
            ->selectRaw('
                COUNT(*) AS total, 
                atendimento_motivoos.descricao,
                (COUNT(*) * 100.0) / SUM(COUNT(*)) OVER() AS percentual
            ')
            ->whereRaw("EXTRACT(MONTH FROM atendimento_os.data_finalizacao) = ?", [$month])
            ->whereRaw("EXTRACT(YEAR FROM atendimento_os.data_finalizacao) = ?", [$year])
            ->when($this->currentConnection == 'sgptins', function ($query) {
                $query->where('admcore_pop.cidade', '=', $this->pop);
            })
            ->groupBy('atendimento_motivoos.descricao')
            ->orderByRaw('COUNT(*) DESC')
            ->get();

        $this->totalMonth = DB::connection($this->currentConnection)->table('atendimento_motivoos')
            ->join('atendimento_os', 'atendimento_os.motivoos_id', '=', 'atendimento_motivoos.id')
            ->selectRaw('
                COUNT(*) as total
            ')
            ->whereRaw("EXTRACT(MONTH FROM atendimento_os.data_finalizacao) = ?", [$month])
            ->whereRaw("EXTRACT(YEAR FROM atendimento_os.data_finalizacao) = ?", [$year])
            ->get();
    }

    public function render()
    {
        return view('livewire.service-order-motivo-os', [
            'data' => $this->loadData(),
        ]);
    }
}

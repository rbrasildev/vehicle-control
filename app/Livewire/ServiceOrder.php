<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ServiceOrder extends Component
{
    protected $listeners = ['connectionUpdated'];
    public $selectedTab;
    public $totalOs = [];
    public $currentConnection = 'sgp';

    public function mount()
    {
        $this->currentConnection = session('currentConnection', 'sgp');

        $this->selectedTab = session('selectedTab', 'today-tab');
        $this->totalOs = [
            $this->countOs(0),
            $this->countOs(1),
            $this->countOs(2),
            $this->countOs(3),
        ];
    }

    public function connectionUpdated($newConnection)
    {
        $this->currentConnection = session(['currentConnection' => $newConnection]);

        $this->totalOs = [
            $this->countOs(0),
            $this->countOs(1),
            $this->countOs(2),
            $this->countOs(3),
        ];
    }

    private function countOs($status)
    {

        return DB::connection($this->currentConnection)
            ->table('admcore_pessoa')
            ->join('admcore_cliente', 'admcore_pessoa.id', '=', 'admcore_cliente.pessoa_id')
            ->join('admcore_clientecontrato', 'admcore_cliente.id', '=', 'admcore_clientecontrato.cliente_id')
            ->join('admcore_pop', 'admcore_pop.id', '=', 'admcore_clientecontrato.pop_id')
            ->join('admcore_servicointernet', 'admcore_servicointernet.clientecontrato_id', '=', 'admcore_clientecontrato.id')
            ->join('atendimento_ocorrencia', 'admcore_clientecontrato.id', '=', 'atendimento_ocorrencia.clientecontrato_id')
            ->join('atendimento_os', 'atendimento_ocorrencia.id', '=', 'atendimento_os.ocorrencia_id')
            ->where('atendimento_os.status', $status)
            ->count();
    }

    public function updatedSelectedTab($tab)
    {
        session(['selectedTab' => $tab]);
        $this->selectedTab = $tab;
    }
    
    public function render()
    {
        $this->currentConnection = session(['currentConnection' ,'sgp']);
        return view('livewire.service-order');
    }
}

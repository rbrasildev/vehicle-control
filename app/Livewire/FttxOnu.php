<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class FttxOnu extends Component
{
    public $currentConnection;
    public $onu; 
    public $perPage = 20;

    public function mount()
    {
        $this->currentConnection = session('currentConnection', 'sgp');
    }


    public function updatedOnu()
    {
        // Executa a consulta sempre que $onu for atualizado
        $query = DB::connection($this->currentConnection)->table('netcore_onu')
            ->select(
                'admcore_cliente.id as cliente_id',
                'admcore_servicointernet.id as contrato',
                'admcore_pessoa.nome',
                'netcore_onu.onutype',
                'netcore_onu.phy_addr',
                'admcore_clientecontratostatus.status'
            )
            ->join('admcore_servicointernet', 'netcore_onu.service_id', '=', 'admcore_servicointernet.id')
            ->join('admcore_clientecontrato', 'admcore_servicointernet.clientecontrato_id', '=', 'admcore_clientecontrato.id')
            ->join('admcore_cliente', 'admcore_cliente.id', '=', 'admcore_clientecontrato.cliente_id')
            ->join('admcore_pessoa', 'admcore_pessoa.id', '=', 'admcore_cliente.pessoa_id')
            ->join('admcore_clientecontratostatus', 'admcore_clientecontrato.status_id', '=', 'admcore_clientecontratostatus.id')
            ->whereRaw('LOWER(netcore_onu.phy_addr) LIKE ?', ["%{$this->onu}%"])
            ->orWhereRaw('UPPER(netcore_onu.phy_addr) LIKE ?', ["%{$this->onu}%"]);
        return $query->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.fttx-onu', ['results' => $this->updatedOnu()]);
    }
}

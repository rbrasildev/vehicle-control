<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class ClientCollectMonth extends Component
{
    use WithPagination;

    protected $listeners = ['connectionUpdated'];


    public $currentConnection;
    public $perPage = 6;

    public function mount()
    {
        $this->currentConnection = session('currentConnection', 'sgp');
    }

    public function connectionUpdated($newConnection)
    {
        $this->currentConnection = $newConnection;

    }


    public function loadOs()
    {
        if (!$this->currentConnection) {
            return collect([]); // Retorna coleção vazia para evitar erro
        }

        // Consulta usando a conexão atual
        return DB::connection($this->currentConnection)
            ->table('admcore_cliente')
            ->join('admcore_pessoa', 'admcore_cliente.pessoa_id', '=', 'admcore_pessoa.id')
            ->join('admcore_endereco', 'admcore_cliente.endereco_id', '=', 'admcore_endereco.id')
            ->join('admcore_clientecontrato', 'admcore_cliente.id', '=', 'admcore_clientecontrato.cliente_id')
            ->join('admcore_servicointernet', 'admcore_clientecontrato.id', '=', 'admcore_servicointernet.clientecontrato_id')
            ->join('netcore_onu', 'admcore_servicointernet.id', '=', 'netcore_onu.service_id')
            ->join('admcore_clientecontratostatus', 'admcore_clientecontrato.status_id', '=', 'admcore_clientecontratostatus.id')
            ->where('admcore_clientecontratostatus.status', 3)
            ->whereRaw('EXTRACT(MONTH FROM admcore_clientecontrato.data_alteracao) = EXTRACT(MONTH FROM NOW())')
            ->whereRaw('EXTRACT(YEAR FROM admcore_clientecontrato.data_alteracao) = EXTRACT(YEAR FROM NOW())')
            ->select(
                'admcore_cliente.id AS cliente_id',
                'admcore_pessoa.nome AS cliente_nome',
                'admcore_endereco.logradouro',
                'admcore_endereco.bairro',
                'admcore_endereco.numero',
                'admcore_endereco.complemento',
                'admcore_endereco.pontoreferencia',
                'admcore_clientecontrato.data_alteracao',
                'admcore_servicointernet.login',
                'admcore_servicointernet.mac',
                'netcore_onu.date_created',
                'netcore_onu.onutype',
                'netcore_onu.phy_addr',
                'admcore_clientecontratostatus.status AS status_descricao'
            )
            ->orderBy('data_alteracao', 'DESC')
            ->paginate($this->perPage);
    }

    public function render()
    {
        logger('Recebendo someEvent');
        return view('livewire.client-collect-month', [
            'collectThisMonth' => $this->loadOs(),
        ]);
    }
}

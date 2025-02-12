<?php

namespace App\Livewire\Collect;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ClientCollectCount extends Component
{
    protected $listeners = ['connectionUpdated', 'popUpdated'];

    public $total = [];
    public $currentConnection;
    public $totalCollect = 0;
    public $pop;

    public function mount()
    {
        $this->currentConnection = session('currentConnection', 'sgp');
        $this->pop = session('pop', 'PARINTINS');

        $this->loadTotal();
        $this->collectCount();
    }

    public function popUpdated($newPop)
    {
        $this->pop = $newPop;
        session()->put('pop', $this->pop);
        $this->loadTotal();
        $this->collectCount();
    }

    public function connectionUpdated($newConnection)
    {
        $this->currentConnection = $newConnection;

        $this->loadTotal();
        $this->collectCount();
    }

    public function collectCount()
    {
        $this->totalCollect = DB::connection($this->currentConnection)
            ->table('admcore_cliente')
            ->join('admcore_pessoa', 'admcore_cliente.pessoa_id', '=', 'admcore_pessoa.id')
            ->join('admcore_endereco', 'admcore_cliente.endereco_id', '=', 'admcore_endereco.id')
            ->join('admcore_clientecontrato', 'admcore_cliente.id', '=', 'admcore_clientecontrato.cliente_id')
            ->join('admcore_pop', 'admcore_pop.id', '=', 'admcore_clientecontrato.pop_id')
            ->join('admcore_servicointernet', 'admcore_clientecontrato.id', '=', 'admcore_servicointernet.clientecontrato_id')
            ->join('netcore_onu', 'admcore_servicointernet.id', '=', 'netcore_onu.service_id')
            ->join('admcore_clientecontratostatus', 'admcore_clientecontrato.status_id', '=', 'admcore_clientecontratostatus.id')
            ->where('admcore_clientecontratostatus.status', 3)
            ->when($this->currentConnection == 'sgptins', function ($query) {
                $query->where('admcore_pop.cidade', '=', $this->pop);
            })
            ->select(
                'admcore_cliente.id AS cliente_id',
                'admcore_pessoa.nome',
                'admcore_endereco.logradouro',
                'admcore_endereco.bairro',
                'admcore_endereco.numero',
                'admcore_pop.cidade',
                'admcore_endereco.complemento',
                'admcore_endereco.pontoreferencia',
                'admcore_clientecontrato.data_alteracao',
                'admcore_servicointernet.login',
                'admcore_servicointernet.mac',
                'netcore_onu.date_created',
                'netcore_onu.onutype',
                'netcore_onu.phy_addr',
                'admcore_clientecontratostatus.status AS status_descricao'
            )->count();
    }


    public function loadTotal()
    {
        $query = DB::connection($this->currentConnection)
            ->table('admcore_clientecontrato')
            ->join('admcore_pop', 'admcore_pop.id', '=', 'admcore_clientecontrato.pop_id')
            ->join('admcore_servicointernet', 'admcore_servicointernet.clientecontrato_id', '=', 'admcore_clientecontrato.id')
            ->join('atendimento_ocorrencia', 'admcore_clientecontrato.id', '=', 'atendimento_ocorrencia.clientecontrato_id')
            ->join('atendimento_os', 'atendimento_ocorrencia.id', '=', 'atendimento_os.ocorrencia_id')
            ->select(
                'atendimento_os.status',
                DB::raw('COUNT(*) as total')
            );

        $query->whereIn('atendimento_os.status', [0, 1, 3])
            ->when($this->currentConnection == 'sgptins', function ($query) {
                $query->where('admcore_pop.cidade', '=', $this->pop);
            })
            ->groupBy('atendimento_os.status');

        $this->total = $query->get();
    }

    public function render()
    {
        return view('livewire.collect.client-collect-count', ['total' => $this->total]);
    }
}

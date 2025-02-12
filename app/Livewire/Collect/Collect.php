<?php

namespace App\Livewire\Collect;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Collect extends Component
{
    public $listeners = ['connectionUpdated'];

    public $perPage = 500;
    public $collectTotal;
    public $models = [];
    public $sort;
    public $date;
    public $currentPop;

    public $currentConnection;

    public function mount()
    {
        $this->currentConnection = session('currentConnection', 'sgp');
        $this->getModels();
    }

    public function placeholder()
    {
        return view('livewire.placeholder');
    }

    public function connectionUpdated($connection)
    {
        $this->currentConnection = $connection;
    }

    public function getPop()
    {
        return DB::connection($this->currentConnection)->table('admcore_pop')
            ->select('id', 'cidade as name')
            ->get();
    }

    public function updatedCurrentPop($newPop)
    {
        $this->currentPop = $newPop;
    }

    public function baseQuery()
    {
        return DB::connection($this->currentConnection)
            ->table('admcore_cliente')
            ->join('admcore_pessoa', 'admcore_cliente.pessoa_id', '=', 'admcore_pessoa.id')
            ->join('admcore_endereco', 'admcore_cliente.endereco_id', '=', 'admcore_endereco.id')
            ->join('admcore_clientecontrato', 'admcore_cliente.id', '=', 'admcore_clientecontrato.cliente_id')
            ->join('admcore_pop', 'admcore_pop.id', '=', 'admcore_clientecontrato.pop_id')
            ->join('admcore_servicointernet', 'admcore_clientecontrato.id', '=', 'admcore_servicointernet.clientecontrato_id')
            ->join('netcore_onu', 'admcore_servicointernet.id', '=', 'netcore_onu.service_id')
            ->join('admcore_clientecontratostatus', 'admcore_clientecontrato.status_id', '=', 'admcore_clientecontratostatus.id');
    }

    public function loadOs()
    {


        $query = $this->baseQuery()
            ->where('admcore_clientecontratostatus.status', 3)
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
            );

        if (!empty($this->date)) {
            $query->whereDate('admcore_clientecontrato.data_alteracao', '=', $this->date);
        }

        if (!empty($this->sort)) {
            $query->where('netcore_onu.onutype', $this->sort);
        }
        if (!empty($this->currentPop)) {
            $query->where('admcore_pop.id', '=', $this->currentPop);
        }

        $collect = $query->orderBy('data_alteracao', 'DESC')->paginate($this->perPage);

        $this->collectTotal = $collect->total();

        return $collect;
    }

    public function getModels()
    {
        $query = $this->baseQuery()
            ->where('admcore_clientecontratostatus.status', 3)
            ->selectRaw('
                COUNT(*) as total,
                netcore_onu.onutype
            ')
            ->groupBy('netcore_onu.onutype');
        if (!empty($this->currentPop)) {
            $query->where('admcore_pop.id', '=', $this->currentPop);
        }

        $this->models = $query->get();
    }

    public function modelSort($sort)
    {
        $this->sort = $sort;
    }

    public function render()
    {
        $this->getModels();

        return view('livewire.collect.collect', ['collectData' => $this->loadOs(), 'pops' => $this->getPop()]);
    }
}

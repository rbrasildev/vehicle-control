<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;


class Collect extends Component
{
    public $listeners = ['connectionUpdated', 'popUpdated'];

    public $perPage = 100;
    public $collectTotal;
    public $models;
    public $sort;
    public $pop_id;

    public function mount()
    {
        $this->getModels();
    }


    public function loadOs()
    {
        $connection = session('currentConnection', 'sgp');
        $this->pop_id = session('currentPop');
        $query = DB::connection($connection)
            ->table('admcore_cliente')
            ->join('admcore_pessoa', 'admcore_cliente.pessoa_id', '=', 'admcore_pessoa.id')
            ->join('admcore_endereco', 'admcore_cliente.endereco_id', '=', 'admcore_endereco.id')
            ->join('admcore_clientecontrato', 'admcore_cliente.id', '=', 'admcore_clientecontrato.cliente_id')
            ->join('admcore_pop', 'admcore_pop.id', '=', 'admcore_clientecontrato.pop_id')
            ->join('admcore_servicointernet', 'admcore_clientecontrato.id', '=', 'admcore_servicointernet.clientecontrato_id')
            ->join('netcore_onu', 'admcore_servicointernet.id', '=', 'netcore_onu.service_id')
            ->join('admcore_clientecontratostatus', 'admcore_clientecontrato.status_id', '=', 'admcore_clientecontratostatus.id')
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
        if (!is_null($this->pop_id) &&  $this->pop_id !== '') {
            $query->where('admcore_pop.id',  $this->pop_id);
        }
        if (!empty($this->sort)) {
            $query->where('netcore_onu.onutype', $this->sort);
        }

        $collect = $query->orderBy('data_alteracao', 'DESC')->paginate($this->perPage);

        $this->collectTotal = $collect->total();

        return $collect;
    }

    public function getModels()
    {
        // Configurar a conexão com o banco de dados
        $this->models = DB::connection(session('currentConnection', 'sgp'))
            ->table('admcore_cliente')
            ->join('admcore_pessoa', 'admcore_cliente.pessoa_id', '=', 'admcore_pessoa.id')
            ->join('admcore_endereco', 'admcore_cliente.endereco_id', '=', 'admcore_endereco.id')
            ->join('admcore_clientecontrato', 'admcore_cliente.id', '=', 'admcore_clientecontrato.cliente_id')
            ->join('admcore_pop', 'admcore_pop.id', '=', 'admcore_clientecontrato.pop_id')
            ->join('admcore_servicointernet', 'admcore_clientecontrato.id', '=', 'admcore_servicointernet.clientecontrato_id')
            ->join('netcore_onu', 'admcore_servicointernet.id', '=', 'netcore_onu.service_id')
            ->join('admcore_clientecontratostatus', 'admcore_clientecontrato.status_id', '=', 'admcore_clientecontratostatus.id')
            ->where('admcore_clientecontratostatus.status', 3)
            ->selectRaw('
                COUNT(*) as total,
                netcore_onu.onutype
            ')
            ->groupBy('netcore_onu.onutype') // Agrupar por tipo de ONU
            ->get(); // Retornar os resultados como coleção
    }

    public function modelSort($sort)
    {
        $this->sort = $sort;
    }


    public function render()
    {
        $this->getModels();

        return view('livewire.collect', ['collectData' => $this->loadOs()]);
    }
}

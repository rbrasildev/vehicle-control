<?php

namespace App\Livewire\Collect;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Negative extends Component
{
    public $listeners = ['connectionUpdated', 'popUpdated'];

    public $perPage = 100;
    public $collectTotal;
    public $models;
    public $sort;


    public function mount()
    {
        $this->getModels();
    }
    public function placeholder()
    {
        return view('livewire.placeholder');
    }

    public function loadOs()
    {
        $connection = session('currentConnection', 'sgp');

        $query = DB::connection($connection)
            ->table('admcore_pessoa')
            ->select(
                'admcore_cliente.id as cliente_id',
                'admcore_servicointernet.login',
                'admcore_pessoa.nome',
                'admcore_endereco.logradouro',
                'admcore_endereco.bairro',
                'admcore_endereco.numero',
                'admcore_endereco.complemento',
                'admcore_endereco.pontoreferencia',
                'admcore_endereco.cidade',
                'atendimento_os.prioridade',
                'atendimento_os.data_agendamento',
                'atendimento_os.data_checkin',
                'atendimento_os.data_finalizacao',
                'atendimento_os.data_alteracao',
                'atendimento_os.latitude',
                'atendimento_os.longitude',
                'atendimento_os.conteudo',
                'atendimento_os.servicoprestado',
                'atendimento_os.usuario_id',
                'atendimento_os.status',
                'atendimento_os.djson',
                'auth_user.username',
                'atendimento_motivoos.descricao',
                'atendimento_motivoos.codigo',
                'netcore_onu.onutype',
                'netcore_onu.id as onu_id'
            )
            ->join('admcore_cliente', 'admcore_pessoa.id', '=', 'admcore_cliente.pessoa_id')
            ->join('admcore_endereco', 'admcore_cliente.endereco_id', '=', 'admcore_endereco.id')
            ->join('admcore_clientecontrato', 'admcore_cliente.id', '=', 'admcore_clientecontrato.cliente_id')
            ->join('admcore_clientecontratostatus', 'admcore_clientecontratostatus.id', '=', 'admcore_clientecontrato.status_id')
            ->join('admcore_servicointernet', 'admcore_servicointernet.clientecontrato_id', '=', 'admcore_clientecontrato.id')
            ->join('netcore_onu', 'admcore_servicointernet.id', '=', 'netcore_onu.service_id')
            ->join('atendimento_ocorrencia', 'admcore_clientecontrato.id', '=', 'atendimento_ocorrencia.clientecontrato_id')
            ->join('atendimento_os', 'atendimento_ocorrencia.id', '=', 'atendimento_os.ocorrencia_id')
            ->join('auth_user', 'atendimento_os.responsavel_id', '=', 'auth_user.id')
            ->join('atendimento_motivoos', 'atendimento_os.motivoos_id', '=', 'atendimento_motivoos.id')
            ->where('atendimento_os.status', '=', 1)
            ->where('atendimento_motivoos.codigo', '=', 70)
            ->where('admcore_clientecontratostatus.status', '=', 3);

        if (!empty($this->sort)) {
            $query->where('netcore_onu.onutype', $this->sort);
        }
        $collect = $query->orderBy('atendimento_os.data_alteracao', 'DESC')->paginate($this->perPage);

        $this->collectTotal = $collect->total();

        return $collect;
    }

    public function getModels()
    {
        // Configurar a conexão com o banco de dados
        $this->models = DB::connection(session('currentConnection', 'sgp'))
            ->table('admcore_pessoa')
            ->join('admcore_cliente', 'admcore_pessoa.id', '=', 'admcore_cliente.pessoa_id')
            ->join('admcore_endereco', 'admcore_cliente.endereco_id', '=', 'admcore_endereco.id')
            ->join('admcore_clientecontrato', 'admcore_cliente.id', '=', 'admcore_clientecontrato.cliente_id')
            ->join('admcore_clientecontratostatus', 'admcore_clientecontratostatus.id', '=', 'admcore_clientecontrato.status_id')
            ->join('admcore_servicointernet', 'admcore_servicointernet.clientecontrato_id', '=', 'admcore_clientecontrato.id')
            ->join('netcore_onu', 'admcore_servicointernet.id', '=', 'netcore_onu.service_id')
            ->join('atendimento_ocorrencia', 'admcore_clientecontrato.id', '=', 'atendimento_ocorrencia.clientecontrato_id')
            ->join('atendimento_os', 'atendimento_ocorrencia.id', '=', 'atendimento_os.ocorrencia_id')
            ->join('auth_user', 'atendimento_os.responsavel_id', '=', 'auth_user.id')
            ->join('atendimento_motivoos', 'atendimento_os.motivoos_id', '=', 'atendimento_motivoos.id')
            ->where('atendimento_os.status', '=', 1)
            ->where('atendimento_motivoos.codigo', '=', 70)
            ->where('admcore_clientecontratostatus.status', '=', 3)
            ->selectRaw('
                COUNT(*) as total,
                netcore_onu.onutype
            ')
            ->groupBy('netcore_onu.onutype')
            ->get();
    }

    public function modelSort($sort)
    {
        $this->sort = $sort;
    }
    public function render()
    {
        $this->getModels();
        return view('livewire.collect.negative', ['collectData' => $this->loadOs()]);
    }
}

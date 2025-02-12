<?php

namespace App\Livewire;


use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ServiceOrderToday extends Component
{
    protected $listeners = ['connectionUpdated', 'popUpdated'];

    public $clientes;
    public $status = "";
    public $statusCounts;
    public $technicianOsCount;
    public $currentConnection;
    public $pop;

    public function mount()
    {
        $this->currentConnection = session('currentConnection', 'sgp');
    }

    public function placeholder()
    {
        return view('livewire.placeholder');
    }

    public function connectionUpdated($newConnection)
    {
        $this->currentConnection = $newConnection;
    }


    public function loadOpen()
    {

        $query = DB::connection($this->currentConnection)
            ->table('admcore_pessoa')
            ->join('admcore_cliente', 'admcore_pessoa.id', '=', 'admcore_cliente.pessoa_id')
            ->join('admcore_endereco', 'admcore_cliente.endereco_id', '=', 'admcore_endereco.id')
            ->join('admcore_clientecontrato', 'admcore_cliente.id', '=', 'admcore_clientecontrato.cliente_id')
            ->join('admcore_pop', 'admcore_pop.id', '=', 'admcore_clientecontrato.pop_id')
            ->join('admcore_servicointernet', 'admcore_servicointernet.clientecontrato_id', '=', 'admcore_clientecontrato.id')
            ->join('atendimento_ocorrencia', 'admcore_clientecontrato.id', '=', 'atendimento_ocorrencia.clientecontrato_id')
            ->join('atendimento_os', 'atendimento_ocorrencia.id', '=', 'atendimento_os.ocorrencia_id')
            ->join('auth_user as responsavel', 'atendimento_os.responsavel_id', '=', 'responsavel.id')
            ->join('auth_user as tecnico', 'atendimento_os.usuario_id', '=', 'tecnico.id')
            ->join('atendimento_motivoos', 'atendimento_os.motivoos_id', '=', 'atendimento_motivoos.id')
            ->select(
                'admcore_cliente.id as cliente_id',
                'admcore_servicointernet.login',
                'admcore_pessoa.nome',
                'admcore_endereco.logradouro',
                'admcore_endereco.bairro',
                'admcore_endereco.numero',
                'admcore_endereco.complemento',
                'admcore_endereco.pontoreferencia',
                'admcore_pop.cidade',
                'atendimento_os.prioridade',
                'atendimento_os.data_agendamento',
                'atendimento_os.data_checkin',
                'atendimento_os.data_finalizacao',
                'atendimento_os.latitude',
                'atendimento_os.longitude',
                'atendimento_os.conteudo',
                'atendimento_os.servicoprestado',
                'atendimento_os.usuario_id',
                'atendimento_os.status',
                'atendimento_os.djson',
                'responsavel.username as responsavel_username',
                'tecnico.username as equipe',
                'atendimento_motivoos.descricao',
                DB::raw('COUNT(atendimento_os.status) as status_count')
            )

            ->where('atendimento_os.data_agendamento', '>=', now()->startOfDay())
            ->where('atendimento_os.data_agendamento', '<=', now()->endOfDay());

        if (!is_null($this->status) && $this->status !== '') {
            $query->where('atendimento_os.status', $this->status);
        }

        $this->clientes = $query->groupBy('atendimento_os.status', 'admcore_cliente.id', 'admcore_servicointernet.login', 'admcore_pessoa.nome', 'admcore_endereco.logradouro', 'admcore_endereco.bairro', 'admcore_endereco.numero', 'admcore_endereco.complemento', 'admcore_endereco.pontoreferencia', 'admcore_pop.cidade', 'atendimento_os.prioridade', 'atendimento_os.data_agendamento', 'atendimento_os.data_checkin', 'atendimento_os.data_finalizacao', 'atendimento_os.latitude', 'atendimento_os.longitude', 'atendimento_os.conteudo', 'atendimento_os.servicoprestado', 'atendimento_os.usuario_id', 'atendimento_os.djson', 'responsavel_username', 'equipe', 'atendimento_motivoos.descricao')->orderBy('atendimento_os.status')->get();

        $this->statusCounts = DB::connection($this->currentConnection)
            ->table('atendimento_os')
            ->select('status', DB::raw('COUNT(*) as total'))
            ->whereDate('data_agendamento', now()->toDateString())
            ->groupBy('status')
            ->get();

        $query = DB::connection($this->currentConnection)->table('admcore_pessoa')
            ->join('admcore_cliente', 'admcore_cliente.pessoa_id', '=', 'admcore_pessoa.id')
            ->join('admcore_endereco', 'admcore_cliente.endereco_id', '=', 'admcore_endereco.id')
            ->join('admcore_clientecontrato', 'admcore_cliente.id', '=', 'admcore_clientecontrato.cliente_id')
            ->join('admcore_pop', 'admcore_pop.id', '=', 'admcore_clientecontrato.pop_id')
            ->join('atendimento_ocorrencia', 'admcore_clientecontrato.id', '=', 'atendimento_ocorrencia.clientecontrato_id')
            ->join('atendimento_os', 'atendimento_ocorrencia.id', '=', 'atendimento_os.ocorrencia_id')
            ->join('auth_user', 'atendimento_os.responsavel_id', '=', 'auth_user.id')
            ->selectRaw('COUNT(*) AS total, auth_user.username, admcore_pop.id');

        $this->technicianOsCount = $query->whereDate('atendimento_os.data_agendamento', '=', DB::raw('CURRENT_DATE'))
            ->groupBy('auth_user.username', 'admcore_pop.id')
            ->orderByDesc('total')
            ->get();
    }



    public function render()
    {
        return view('livewire.service-order-today', ['clientes' => $this->loadOpen()]);
    }
}

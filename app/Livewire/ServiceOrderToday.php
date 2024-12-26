<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ServiceOrderToday extends Component
{
    protected $listeners = ['connectionUpdated'];

    public $clientes;
    public $status;
    public $statusCounts;
    public $technicianOsCount;
    public $pops;
    public $pop_id;



    public function getPop()
    {
        $connection = session('currentConnection', 'sgp');

        $this->pops = DB::connection($connection)
            ->table('admcore_pop')->get();
    }

    public function mount($status = null)
    {
        $this->status = $status;
    }

    public function loadOpen()
    {
        $this->getPop();
        $connection = session('currentConnection', 'sgp');
        $query = DB::connection($connection)
            ->table('admcore_pessoa')
            ->join('admcore_cliente', 'admcore_pessoa.id', '=', 'admcore_cliente.pessoa_id')
            ->join('admcore_endereco', 'admcore_cliente.endereco_id', '=', 'admcore_endereco.id')
            ->join('admcore_clientecontrato', 'admcore_cliente.id', '=', 'admcore_clientecontrato.cliente_id')
            ->join('admcore_pop', 'admcore_pop.id', '=', 'admcore_clientecontrato.pop_id')
            ->join('admcore_servicointernet', 'admcore_servicointernet.clientecontrato_id', '=', 'admcore_clientecontrato.id')
            ->join('atendimento_ocorrencia', 'admcore_clientecontrato.id', '=', 'atendimento_ocorrencia.clientecontrato_id')
            ->join('atendimento_os', 'atendimento_ocorrencia.id', '=', 'atendimento_os.ocorrencia_id')
            ->join('auth_user', 'atendimento_os.responsavel_id', '=', 'auth_user.id')
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
                'auth_user.username',
                'atendimento_motivoos.descricao',
                DB::raw('COUNT(atendimento_os.status) as status_count')
            )

            ->whereDate('atendimento_os.data_agendamento', '=', now()->toDateString());

        if (!is_null($this->pop_id) && $this->pop_id !== '') {
            $query->where('admcore_pop.id', $this->pop_id);
        }

        if (!is_null($this->status) && $this->status !== '') {
            $query->where('atendimento_os.status', $this->status);
        }

        $this->clientes = $query->groupBy('atendimento_os.status', 'admcore_cliente.id', 'admcore_servicointernet.login', 'admcore_pessoa.nome', 'admcore_endereco.logradouro', 'admcore_endereco.bairro', 'admcore_endereco.numero', 'admcore_endereco.complemento', 'admcore_endereco.pontoreferencia', 'admcore_pop.cidade', 'atendimento_os.prioridade', 'atendimento_os.data_agendamento', 'atendimento_os.data_checkin', 'atendimento_os.data_finalizacao', 'atendimento_os.latitude', 'atendimento_os.longitude', 'atendimento_os.conteudo', 'atendimento_os.servicoprestado', 'atendimento_os.usuario_id', 'atendimento_os.djson', 'auth_user.username', 'atendimento_motivoos.descricao')->orderBy('atendimento_os.status')->get();

        $this->statusCounts = DB::connection($connection)
            ->table('atendimento_os')
            ->select('status', DB::raw('COUNT(*) as total'))
            ->whereDate('data_agendamento', now()->toDateString())
            ->groupBy('status')
            ->get();

        $this->technicianOsCount = DB::connection($connection)
            ->table('admcore_pessoa as pessoa')
            ->join('admcore_cliente as cliente', 'cliente.pessoa_id', '=', 'pessoa.id')
            ->join('admcore_endereco as endereco', 'cliente.endereco_id', '=', 'endereco.id')
            ->join('admcore_clientecontrato as contrato', 'cliente.id', '=', 'contrato.cliente_id')
            ->join('atendimento_ocorrencia as ocorrencia', 'contrato.id', '=', 'ocorrencia.clientecontrato_id')
            ->join('admcore_pop as pop', 'contrato.pop_id', '=', 'pop.id')
            ->join('atendimento_os as ordem_servico', 'ocorrencia.id', '=', 'ordem_servico.ocorrencia_id')
            ->join('auth_user as usuario', 'ordem_servico.responsavel_id', '=', 'usuario.id')
            ->selectRaw('
                COUNT(*) as total,
                (COUNT(*) * 100.0) / SUM(COUNT(*)) OVER() AS percentual,
                usuario.username as username,
                usuario.name as name
            ')
            ->whereDate('ordem_servico.data_agendamento', '=', now()->toDateString())
            ->where('ordem_servico.status', 0)
            ->groupBy('usuario.username', 'usuario.name')
            ->orderByDesc('total')
            ->get();
    }



    public function render()
    {
        return view('livewire.service-order-today', ['clientes' => $this->loadOpen()]);
    }
}

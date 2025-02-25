<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class ServiceOrderLate extends Component
{
    use WithPagination;
    protected $listeners = ['connectionUpdated'];

    public $statusCounts;
    public $perPage = 20;
    public $currentConnection;

    public function mount()
    {
        $this->currentConnection = session('currentConnection', 'sgp');
        $this->loadOs();
    }

    public function placeholder()
    {
        return view('livewire.placeholder');
    }


    public function connectionUpdated($newConnection)
    {
        $this->currentConnection = $newConnection;
        $this->loadOs();
    }


    public function loadOs()
    {
        $query = DB::connection($this->currentConnection)->table('admcore_pessoa')
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
                'atendimento_motivoos.descricao'
            )
            ->whereDate('atendimento_os.data_agendamento', '<', now()->toDateString())
            ->where('atendimento_os.status', '=', 0);

        return $query->paginate($this->perPage);
    }


    public function render()
    {
        return view('livewire.service-order-late', [
            'serviceOrders' => $this->loadOs(),
        ]);
    }
}

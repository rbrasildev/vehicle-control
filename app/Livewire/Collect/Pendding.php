<?php

namespace App\Livewire\Collect;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

use Livewire\WithPagination;

class Pendding extends Component
{
    use WithPagination;

    protected $listeners = ['connectionUpdated', 'selectedTab'];
    public $selectedTab;

    public $currentConnection;

    public function mount()
    {
        $this->currentConnection = session()->get('currentConnection', 'sgp');
        $this->selectedTab = session()->get('currentTab', 'collect-tab');
        $this->listPenddingRemove();
    }

    public function placeholder()
    {
        return view('livewire.placeholder');
    }

    public function connectionUpdated($newConnection)
    {
        $this->currentConnection = $newConnection;
    }


    public function listPenddingRemove()
    {
        return DB::connection($this->currentConnection)->table('admcore_pessoa')
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
            ->where('atendimento_motivoos.codigo', '=', 20)
            ->where('admcore_clientecontratostatus.status', '=', 3)
            ->orderBy('atendimento_os.data_finalizacao', 'desc')
            ->get();
    }
    public function render()
    {
        return view('livewire.collect.pendding', ['pendding' => $this->listPenddingRemove()]);
    }
}

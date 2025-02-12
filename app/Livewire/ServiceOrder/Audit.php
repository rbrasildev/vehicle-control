<?php

namespace App\Livewire\ServiceOrder;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\DB;


class Audit extends Component
{
    protected $listeners = ['connectionUpdated'];

    public $date;
    public $currentConnection;
    public $currentPop;

    public function placeholder()
    {
        return view('livewire.placeholder');
    }

    public function mount()
    {
        $this->date = Carbon::now()->toDateString();
        $this->currentConnection = session('currentConnection', 'sgp');
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

    public function connectionUpdated($newConnection)
    {
        $this->currentConnection = $newConnection;
    }

    public function getAudit()
    {
        $query =  DB::connection($this->currentConnection)->table('admcore_pessoa')
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
                'atendimento_ocorrencia.numero as numero_ocorrencia',
                'atendimento_ocorrencia.id as ocorrencia_id',
                'admcore_cliente.id',
                'admcore_pessoa.nome',
                'admcore_pop.cidade',
                'atendimento_motivoos.descricao',
                'atendimento_os.conteudo',
                'atendimento_os.servicoprestado',
                'atendimento_os.id as os_id',
                'admcore_pop.cidade',
                'admcore_pop.id',
                'atendimento_os.data_agendamento',
                'atendimento_os.data_finalizacao',
                'responsavel.username'
            )
            ->where('atendimento_os.status', '=', 1)
            ->whereDate('atendimento_os.data_finalizacao', '=', $this->date)
            ->orderBy('atendimento_motivoos.descricao', 'asc');
        if (!empty($this->currentPop)) {
            $query->where('admcore_pop.id', '=', $this->currentPop);
        }
        return $query->get();
    }
    public function render()
    {
        return view('livewire.service-order.audit', ['audit' => $this->getAudit(), 'pops' => $this->getPop()]);
    }
}

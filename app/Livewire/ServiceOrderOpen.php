<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class ServiceOrderOpen extends Component
{
    use WithPagination;
    protected $listeners = ['connectionUpdated', 'popUpdated'];

    public $statusCounts;
    public $perPage = 100;
    public $selectedDate;
    public $pop = '';
    public $currentConnection;

    public function placeholder()
    {
        return view('livewire.placeholder');
    }

    public function mount()
    {
        $this->currentConnection = session('currentConnection', 'sgp');
        session()->put('pop', $this->pop);
    }

    public function connectionUpdated()
    {
        $this->currentConnection = session('currentConnection', 'sgp');

        $this->loadOpen();
    }

    public function popUpdated($newPop)
    {
        $this->currentConnection = session('currentConnection', 'sgp');
        $this->pop = $newPop;
        $this->loadOpen();
    }

    public function loadOpen()
    {
        $query = DB::connection(session('currentConnection', 'sgp'))->table('admcore_pessoa')
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
            ->where('atendimento_os.status', 0)
            ->when($this->pop, function ($query) {
                $query->where('admcore_pop.cidade', $this->pop);
            });

        if ($this->selectedDate) {
            $query->whereDate('atendimento_os.data_agendamento', '=', $this->selectedDate);
        }


        $open = $query->orderBy('data_agendamento', 'DESC')->paginate($this->perPage);

        $this->statusCounts = $open->total();

        $this->dispatch('countOsOpen', $open->total());

        return $open;
    }



    public function render()
    {
        return view('livewire.service-order-open', [
            'serviceOrders' => $this->loadOpen(),
        ]);
    }
}

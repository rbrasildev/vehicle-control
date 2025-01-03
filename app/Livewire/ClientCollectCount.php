<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ClientCollectCount extends Component
{
    protected $listeners = ['connectionUpdated', 'popUpdated'];

    public $total = [];
    public $currentConnection;
    public $currentPop;

    public function mount()
    {
        // Define a conexão inicial e o POP inicial a partir da sessão ou padrão
        $this->currentConnection = session('currentConnection', 'sgp');
        $this->currentPop = session('currentPop'); // Define como 1 se não estiver na sessão

        $this->loadTotal();
    }

    public function connectionUpdated($newConnection)
    {
        $this->currentConnection = $newConnection;

        // Recarrega os dados com a nova conexão
        $this->loadTotal();
    }

    public function popUpdated($newPop)
    {
        $this->currentPop = $newPop;

        $this->loadTotal();
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
                'admcore_pop.id as pop_id',
                DB::raw('COUNT(*) as total')
            );

        // Aplica o filtro pelo POP se definido
        if (!empty($this->currentPop)) {
            $query->where('admcore_pop.id', $this->currentPop);
        }

        // Filtros adicionais e agrupamento
        $query->whereIn('atendimento_os.status', [0, 1, 3])
            ->groupBy('atendimento_os.status', 'admcore_pop.id');

        // Armazena os resultados
        $this->total = $query->get();
    }

    public function render()
    {
        // Renderiza a view com os dados carregados
        return view('livewire.client-collect-count', ['total' => $this->total]);
    }
}

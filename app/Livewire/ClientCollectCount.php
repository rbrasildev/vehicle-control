<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ClientCollectCount extends Component
{
    protected $listeners = ['connectionUpdated'];

    public $total;
    public $currentConnection;

    public function mount()
    {
        $this->currentConnection = session('currentConnection', 'sgp');
        $this->loadTotal();
    }

    public function connectionUpdated($newConnection)
    {
        $this->currentConnection = $newConnection;
    }


    public function loadTotal()
    {
        $this->total = DB::connection($this->currentConnection)
            ->table('atendimento_os')
            ->select('status', DB::raw('COUNT(*) as total'))
            ->whereIn('status', [0,1,3])
            ->groupBy('status')
            ->get();
    }


    public function render()
    {
        return view('livewire.client-collect-count', ['total' => $this->loadTotal()]);
    }
}

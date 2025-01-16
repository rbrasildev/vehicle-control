<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class IsOnline extends Component
{
    protected $listeners = ['connectionUpdated'];
    public $currentConnection;
    public $login;

    public function mount()
    {
        $this->currentConnection = session()->get('currentConnection', 'sgp');
    }

    public function connectionUpdated($newConnection)
    {
        $this->currentConnection = $newConnection;
    }

    public function render()
    {
        // Consulta para verificar se o usuário está online
        $isOnline = DB::connection($this->currentConnection)
            ->table('radacct')
            ->whereNull('acctstoptime')
            ->where('username', $this->login)
            ->exists(); // Retorna true ou false

        return view('livewire.is-online', ['isOnline' => $isOnline]);
    }
}

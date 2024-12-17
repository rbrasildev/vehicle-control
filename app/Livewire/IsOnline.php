<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class IsOnline extends Component
{
    public $login;

    public function render()
    {
        // Consulta para verificar se o usuário está online
        $isOnline = DB::connection('sgp')
            ->table('radacct')
            ->whereNull('acctstoptime')
            ->where('username', $this->login)
            ->exists(); // Retorna true ou false

        return view('livewire.is-online', ['isOnline' => $isOnline]);
    }
}

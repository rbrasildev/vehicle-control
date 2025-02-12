<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class Dashboard extends Component
{
    public $currentConnection;

    public function mount()
    {
        $this->currentConnection = session('currentConnection', 'sgptins');
        $this->currentConnection && $this->updatedCurrentConnection($this->currentConnection);
    }

    public function updatedCurrentConnection($value)
    {
        session(['currentConnection' => $value]);
    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }


    public function render()
    {
        return view('livewire.dashboard');
    }
}

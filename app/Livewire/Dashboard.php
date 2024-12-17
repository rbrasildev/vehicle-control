<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Sgpos\auth_user;

class Dashboard extends Component
{
    public $totalCollect;
    protected $listeners = ['someEvent' => 'render'];

    public function mount()
    {
        $this->totalCollect = auth_user::count();
    }


    public function render()
    {
        return view('livewire.dashboard');
    }
}

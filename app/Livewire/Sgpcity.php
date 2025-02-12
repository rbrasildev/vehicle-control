<?php

namespace App\Livewire;

use Livewire\Component;

class Sgpcity extends Component
{
    protected $listeners = ['connectionUpdated'];
    
    public function render()
    {
        return view('livewire.sgpcity');
    }
}

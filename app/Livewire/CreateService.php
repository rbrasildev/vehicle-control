<?php

namespace App\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

class CreateService extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.create-service', ['vehicle' => Vehicle::search($this->search)->first()]);
    }
}

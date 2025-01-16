<?php

namespace App\Livewire;

use Livewire\Component;

class CitySelect extends Component
{
    public $currentConnection = "sgp";

    public function mount($value = null)
    {
        $this->currentConnection = $value;
        $this->currentConnection = session()->get('currentConnection', 'sgp');
    }

    public function updatedCurrentConnection($value)
    {
        session()->put('currentConnection', $value ?? $this->currentConnection);
        $this->dispatch('connectionUpdated', $value ?? $this->currentConnection);
    }


    public function render()
    {
        return view('livewire.city-select');
    }
}

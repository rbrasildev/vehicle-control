<?php

namespace App\Livewire;

use Livewire\Component;

class CitySelect extends Component
{
    public $currentConnection;

    public function mount()
    {
        $this->currentConnection = session('currentConnection', 'sgp');

    }

  
    public function updatedCurrentConnection($value)
    {
        // Atualiza a sessão sempre que o valor do modelo é alterado
        session(['currentConnection' => $value]);

        // Emite um evento para notificar outros componentes sobre a alteração
        $this->dispatch('connectionUpdated', $value);
    }

    public function render()
    {
        return view('livewire.city-select');
    }
}

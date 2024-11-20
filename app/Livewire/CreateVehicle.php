<?php

namespace App\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

class CreateVehicle extends Component
{
    public $placa = '';
    public $marca = '';
    public $modelo = '';
    public $ano = '';
    public $chassi = '';

    public function save()
    {
        Vehicle::create([
            'placa' => $this->placa,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'ano' => $this->ano,
            'chassi' => $this->chassi,
        ]);
    }

    public function render()
    {
        return view('livewire.create-vehicle');
    }
}

<?php

namespace App\Livewire\Forms;

use App\Models\Vehicle;
use Livewire\Attributes\Validate;
use Livewire\Form;

class VehicleForm extends Form
{
    public $placa = '';
    public $marca = '';
    public $modelo = '';
    public $ano = '';
    public $tipo = '';
    public $quilometragem = '';

    public function rules()
    {
        return [
            'placa' => 'required|string|max:10', // Placas geralmente têm até 7 caracteres, mas vamos dar uma folga
            'marca' => 'required|string|max:50', // As marcas não costumam ser muito longas
            'modelo' => 'required|string|max:50', // Os modelos também não devem ser muito longos
            'ano' => 'required|integer|min:1900|max:' . date('Y'), // Anos válidos considerando veículos modernos
            'tipo' => 'required|string|max:50', // Tipos de veículos também devem ser breves
            'quilometragem' => 'required|integer|min:0', // Quilometragem deve ser um valor positivo
        ];
    }

    public function store()
    {
        Vehicle::create($this->all());
    }

    public function setVehicle(Vehicle $vehicle)
    {
        $this->placa = $vehicle->placa;
        $this->marca = $vehicle->marca;
        $this->modelo = $vehicle->modelo;
        $this->ano = $vehicle->ano;
        $this->tipo = $vehicle->tipo;
        $this->quilometragem = $vehicle->quilometragem;
    }
}

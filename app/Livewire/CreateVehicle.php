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
    public $tipo = '';
    public $quilometragem = '';

    public function save()
    {
        Vehicle::create([
            'placa' => $this->placa,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'ano' => $this->ano,
            'chassi' => $this->chassi,
            'tipo' => $this->tipo,
            'quilometragem' => $this->quilometragem,
        ]);

        // Define a mensagem de sucesso e redireciona para a rota /veiculo
        session()->flash('success', 'Veículo criado com sucesso!');
        return redirect('/veiculos');
    }

    public function render()
    {
        return view('livewire.create-vehicle');
    }
}

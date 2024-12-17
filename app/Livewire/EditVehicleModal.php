<?php

namespace App\Livewire;

use App\Models\Vehicle;
use Livewire\Component;

class EditVehicleModal extends Component
{
    public $showModal = false;
    public $vehicleId;
    public $placa;
    public $marca;
    public $modelo;
    public $ano;
    public $quilometragem;

    protected $rules = [
        'placa' => 'required|max:10',
        'marca' => 'required|max:50',
        'modelo' => 'required|max:50',
        'ano' => 'required|digits:4',
        'quilometragem' => 'required|numeric',
    ];

    // Abre o modal e carrega os dados do veículo
    public function openModal($id)
    {
        $this->vehicleId = $id;
        $vehicle = Vehicle::findOrFail($id);

        $this->placa = $vehicle->placa;
        $this->marca = $vehicle->marca;
        $this->modelo = $vehicle->modelo;
        $this->ano = $vehicle->ano;
        $this->quilometragem = $vehicle->quilometragem;

        $this->showModal = true;
    }

    // Fecha o modal
    public function closeModal()
    {
        $this->reset(['showModal', 'vehicleId', 'placa', 'marca', 'modelo', 'ano', 'quilometragem']);
    }

    // Salva as alterações
    public function save()
    {
        $this->validate();

        $vehicle = Vehicle::findOrFail($this->vehicleId);
        $vehicle->update([
            'placa' => $this->placa,
            'marca' => $this->marca,
            'modelo' => $this->modelo,
            'ano' => $this->ano,
            'quilometragem' => $this->quilometragem,
        ]);

        session()->flash('success', 'Veículo atualizado com sucesso!');
        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.edit-vehicle-modal');
    }
}

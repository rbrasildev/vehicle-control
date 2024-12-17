<?php

namespace App\Livewire;

use App\Models\OilChange;
use App\Models\TypeOfOil;
use App\Models\Vehicle;
use Livewire\Component;

class Modal extends Component
{
    public $showModal = false;
    public $vehicleId;
    public $data_troca;
    public $quilometragem;
    public $tipo_de_oleo_id;
    public $valor;
    public $observacoes;
    public $tiposDeOleo;



    public function openModal()
    {
        $this->showModal = true;
    }

    public function save()
    {

        OilChange::create([
            'id_veiculo' => $this->vehicleId,
            'tipo_de_oleo_id' => $this->tipo_de_oleo_id,
            'data_troca' => $this->data_troca,
            'quilometragem' => $this->quilometragem,
            'valor' => $this->valor,
            'observacoes' => $this->observacoes,
        ]);
        $this->updateKm();

        session()->flash('success', 'Veículo atualizado com sucesso!');
        $this->closeModal();
    }

    public function updateKm()
    {
        $veiculo = Vehicle::find($this->vehicleId);
        $veiculo->km_ultima_troca = $this->quilometragem;
        $veiculo->save();
    }


    public function closeModal()
    {
        $this->showModal = false;
    }

    public function mount()
    {
        return $this->tiposDeOleo = TypeOfOil::all();
    }

    public function render()
    {
        return view('livewire.modal');
    }
}

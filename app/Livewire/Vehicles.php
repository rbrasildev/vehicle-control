<?php

namespace App\Livewire;

use App\Livewire\Forms\VehicleForm;
use Livewire\Component;
use App\Models\Vehicle;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class Vehicles extends Component

{
    use Toast;
    public VehicleForm $form;
    use WithPagination;

    public $perPage = "10";
    public $search = '';
    public bool $vehicleModal = false;

    public function save()
    {
        $this->validate();

        Vehicle::create(
            $this->form->all()
        );
        $this->form->reset();
        $this->vehicleModal = false;
        $this->toast('success', 'Veículo cadastrado com sucesso');
    }

    public function delete($vehicleId)
    {
        Vehicle::find($vehicleId)->delete();
        $this->toast('success', "Veículo deletado com sucesso");
    }

    public function update() {}



    public function render()
    {
        return view('livewire.vehicle', ['vehicles' => Vehicle::search($this->search)->paginate($this->perPage)]);
    }
}

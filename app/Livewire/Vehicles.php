<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vehicle;


class Vehicles extends Component

{
    public $query = '';
    public $results = [];

    public function updatedQuery()
    {
        $this->results = Vehicle::where('placa', 'like', '%' . $this->query . '%')->get();
    }

    public function delete($vehicleId)
    {
        Vehicle::find($vehicleId)->delete();
    }

    public function render()
    {
        return view('livewire.vehicle', ['vehicle' => Vehicle::all()]);
    }
}

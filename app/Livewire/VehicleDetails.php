<?php

namespace App\Livewire;

use App\Models\OilChange;
use App\Models\Vehicle;
use Livewire\Component;

class VehicleDetails extends Component
{
    public $vehicle_id;
    public $vehicle;
    public $oilChange;

    public function mount($vehicle_id)
    {
        $this->vehicle_id = $vehicle_id;
        $this->vehicle = Vehicle::findOrFail($vehicle_id);
        $this->oilChange =  OilChange::with('typeOfOil')
        ->where('id_veiculo', $this->vehicle_id)->get();
    }
    public function render()
    {
        return view('livewire.vehicle-details');
    }
}

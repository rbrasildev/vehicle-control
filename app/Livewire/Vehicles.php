<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Vehicle;
use Livewire\WithPagination;

class Vehicles extends Component

{
    use WithPagination;

    public $perPage = "10" ;
    public $search = '';

  

    public function delete($vehicleId)
    {
        Vehicle::find($vehicleId)->delete();
    }
    

    public function render()
    {
        return view('livewire.vehicle', ['vehicles' => Vehicle::search($this->search)->paginate($this->perPage)]);
      
    }
    
}

<?php

namespace App\Livewire;

use App\Models\OilChange;
use Livewire\Component;

class OilChanges extends Component
{

    public function render()
    {
        return view('livewire.oil-change', ['oilChange' => OilChange::with('Vehicles')->paginate(10)]);
    }
}

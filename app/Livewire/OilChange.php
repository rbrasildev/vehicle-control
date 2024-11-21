<?php

namespace App\Livewire;

use App\Models\OilChange as ModelsOilChange;
use Livewire\Component;

class OilChange extends Component
{

    public function render()
    {
        return view('livewire.oil-change', ['oilChange' => ModelsOilChange::all()]);
    }
}

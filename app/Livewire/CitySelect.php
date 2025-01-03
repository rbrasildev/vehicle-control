<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CitySelect extends Component
{
    public $currentConnection;
    public $currentPop = 1;
    public $pops;

    public function mount()
    {
        $this->currentConnection = session('currentConnection', 'sgp');
    }

    public function getPop()
    {
        $this->pops = DB::connection($this->currentConnection)
            ->table('admcore_pop')->get();
    }


    public function updatedCurrentConnection($value)
    {
        session(['currentConnection' => $value]);
        $this->dispatch('connectionUpdated', $value);
    }


    public function updatedCurrentPop($value)
    {
        session(['currentPop' => $value]);
        $this->dispatch('popUpdated', $value,);
    }

    public function render()
    {
        $this->getPop();
        return view('livewire.city-select');
    }
}

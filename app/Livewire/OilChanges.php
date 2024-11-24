<?php

namespace App\Livewire;

use App\Models\OilChange;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class OilChanges extends Component
{

    public function render()
    {
        return view('livewire.oil-change', ['oiChange', DB::table('veiculos')
            ->join('trocas_de_oleo', 'veiculos.id', '=', 'trocas_de_oleo.id_veiculo')
            ->select('*')
            ->get()]);
    }
}

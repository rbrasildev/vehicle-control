<?php

namespace App\Livewire;

use Livewire\Component;

class OsStatus extends Component
{
    // Propriedade pública para receber o status
    public $status;

    // Método para converter o status em um badge
    public function osStatusConverte($status)
    {
        switch ($status) {
            case 0:
                return '<span class="px-3 py-1 rounded-full text-white bg-red-500">Aberta</span>';
            case 1:
                return '<span class="px-3 py-1 rounded-full text-white bg-green-500">Finalizada</span>';
            case 2:
                return '<span class="px-3 py-1 rounded-full text-white bg-yellow-500">Execução</span>';
            case 3:
                return '<span class="px-3 py-1 rounded-full text-white bg-gray-500">Pendente</span>';
            default:
                return '<span class="px-3 py-1 rounded-full text-white bg-black">Desconhecido</span>';
        }
    }

    public function render()
    {
        
        return view('livewire.os-status', [
            'badge' => $this->osStatusConverte($this->status)
        ]);
    }
}
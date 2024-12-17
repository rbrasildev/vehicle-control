<?php

namespace App\Livewire;

use Livewire\Component;

class ServiceOrder extends Component
{
    public $active = 'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500'; 

 
    public function render()
    {
        return view('livewire.service-order');
    }
}

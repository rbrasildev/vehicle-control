<?php

namespace App\Livewire;

use Livewire\Component;

class Tabs extends Component
{
    public $currentTab = 'hoje'; 

    public function mount()
    {
        
        $this->currentTab = session()->get('currentTab', $this->currentTab);
    }

    public function setTab($tab)
    {
        $this->currentTab = $tab;

        session()->put('currentTab', $this->currentTab);
    }
    
    public function render()
    {
        return view('livewire.tabs');
    }
}

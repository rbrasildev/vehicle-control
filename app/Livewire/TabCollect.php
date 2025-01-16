<?php

namespace App\Livewire;

use Livewire\Component;

class TabCollect extends Component
{
    protected $listeners = ['connectionUpdated'];

    public $selectedTab = "collect-tab";
    public $currentConnection;

    public function mount()
    {
        $this->selectedTab = session()->get('currentTab', 'collect-tab');
    }

    public function connectionUpdated($newConnection)
    {
        $this->currentConnection = $newConnection;
    }



    public function updatedSelectedTab($value)
    {
        session()->put('currentTab', $this->selectedTab);
        $this->dispatch('selectedTab', $value);
    }


    public function render()
    {
        return view('livewire.tab-collect');
    }
}

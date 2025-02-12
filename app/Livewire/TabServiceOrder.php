<?php

namespace App\Livewire;

use Livewire\Component;


class TabServiceOrder extends Component
{
    protected $listeners = ['connectionUpdated'];
    public $selectedTab;
    public $currentConnection;
    public $pop;

    public function mount()
    {
        $this->currentConnection = session('currentConnection', 'sgp');
        $this->selectedTab = session('selectedTab', 'today-tab');
    }

    public function connectionUpdated($newConnection)
    {
        $this->currentConnection = session(['currentConnection' => $newConnection]);
    }


    public function updatedSelectedTab($tab)
    {
        session(['selectedTab' => $tab]);
        $this->selectedTab = $tab;
    }

    public function render()
    {
        return view('livewire.tab-service-order');
    }
}

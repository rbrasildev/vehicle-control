<?php

namespace App\Livewire;

use Livewire\Component;
use Carbon\Carbon;

class TimeElapsed extends Component
{
    public $dataCheckin;
    public $timeElapsed;

    public function mount($dataCheckin)
    {

        $this->dataCheckin = Carbon::parse($dataCheckin)->setTimezone('America/Manaus'); 
        $this->updateTimeElapsed();
    }

    public function updateTimeElapsed()
    {
       
        $now = Carbon::now('America/Manaus');  
        $diff = $this->dataCheckin->diff($now);

       
        $hours = $diff->h + ($diff->days * 24); 
        $minutes = $diff->i;
        $seconds = $diff->s;

       
        $this->timeElapsed = sprintf("%02d:%02d:%02d", $hours-1, $minutes, $seconds);
    }

    public function render()
    {
        $this->updateTimeElapsed(); 
        return view('livewire.time-elapsed');
    }
}

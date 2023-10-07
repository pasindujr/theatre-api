<?php

namespace App\Livewire;

use Livewire\Component;

class EventCreate extends Component
{

    public $startDate;
    public $endDate;

    public bool $areDatesFilled = false;

    public function openShowtime()
    {
        if ($this->startDate && $this->endDate) {
            $this->areDatesFilled = true;
        }
    }

    public function render()
    {
        return view('livewire.event-create');
    }
}

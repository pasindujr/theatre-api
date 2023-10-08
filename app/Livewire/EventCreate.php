<?php

namespace App\Livewire;

use App\Models\Day;
use App\Models\Event;
use App\Models\Showtime;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Collection;
use Livewire\Component;

class EventCreate extends Component
{

    public $startDate;
    public $endDate;
    public bool $areDatesFilled = false;
    public bool $areShowTimesFilled = false;
    public Collection $showTimes;
    public array $showTimesArray = [];
    public string $eventName;

    public function openShowtime()
    {
        if ($this->startDate && $this->endDate) {
            $this->areDatesFilled = true;
            $this->showTimes = Showtime::select(['id', 'start_time', 'end_time'])
                ->get();
        }
    }

    public function addShowtimes($showtimeId)
    {
        // if shpwtimeid contains in array then remove it if not then add it
        if (in_array($showtimeId, $this->showTimesArray)) {
            $this->showTimesArray = array_diff($this->showTimesArray, [$showtimeId]);
        } else {
            $this->showTimesArray[] = $showtimeId;
        }

    }

    public function addName()
    {
        $this->areShowTimesFilled = true;
    }

    public function createEvents()
    {
        $dayId = 0;
        $venueId = auth()->user()->venue->id;

        // all dates between start and end date
        $begin = new DateTime( $this->startDate);
        $end = new DateTime( $this->endDate);
        $end = $end->modify( '+1 day' );

        $interval = new DateInterval('P1D');
        $period = new DatePeriod($begin, $interval ,$end);

        foreach ($period as $key => $date) {
           if (Day::where('date', $date)->exists()) {
               $dayId = Day::where('date', $date)->first()->id;
           } else {
                $day = new Day();
                $day->date = $date;
                $day->save();
                $dayId = $day->id;
           }

           foreach ($this->showTimesArray as $showTimeId) {
               $event = new Event();
               $event->name = $this->eventName;
               $event->day_id = $dayId;
               $event->showtime_id = $showTimeId;
               $event->venue_id = $venueId;
               $event->save();
           }
        }

        toast('Events Created!','success');
        $this->redirect(route('events.create'));
    }

    public function render()
    {
        return view('livewire.event-create');
    }
}

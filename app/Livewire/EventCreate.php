<?php

namespace App\Livewire;

use App\Models\Day;
use App\Models\Event;
use App\Models\SeatAllocation;
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
    public $startTime;
    public $endTime;

    public function openShowtime()
    {
        if ($this->startDate && $this->endDate) {
            $this->areDatesFilled = true;
            $this->showTimes = Showtime::select(['id', 'start_time', 'end_time'])
                ->where('user_id', auth()->user()->id)
                ->get();
        }
    }

    public function createShowTimes()
    {
        $showtime = new Showtime();
        $showtime->start_time = $this->startTime;
        $showtime->end_time = $this->endTime;
        $showtime->user_id = auth()->user()->id;
        $showtime->save();

        $this->openShowtime();
    }

    public function addShowtimes($showtimeId)
    {
        // if showtime id contains in array then remove it, if not then add it
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
        $seatingCapacity = auth()->user()->venue->seating_capacity;

        // all dates between start and end date
        $begin = new DateTime($this->startDate);
        $end = new DateTime($this->endDate);
        $end = $end->modify('+1 day');

        $interval = new DateInterval('P1D');
        $period = new DatePeriod($begin, $interval, $end);

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

                $eventId = $event->id;

                for ($i = 1; $i <= $seatingCapacity; $i++) {
                    $seatAllocation = new SeatAllocation();
                    $seatAllocation->event_id = $eventId;
                    $seatAllocation->seat_number = $i;
                    $seatAllocation->is_reserved = false;
                    $seatAllocation->save();
                }
            }
        }
        toast('Events and Seats Created!', 'success');
        $this->redirect(route('events.create'));
    }

    public function render()
    {
        return view('livewire.event-create');
    }
}

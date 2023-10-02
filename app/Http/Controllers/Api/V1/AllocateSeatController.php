<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EventResource;
use App\Models\Day;
use App\Models\Event;
use App\Models\Showtime;
use App\Models\Venue;

class AllocateSeatController extends Controller
{
    public function index(Venue $venue, Day $day, Showtime $showtime)
    {
        $event = Event::where([
            'venue_id' => $venue->id,
            'day_id' => $day->id,
            'showtime_id' => $showtime->id,
        ])->firstOrFail();

        return new EventResource($event);

    }
}

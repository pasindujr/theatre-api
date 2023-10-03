<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\EventResource;
use App\Models\Day;
use App\Models\Event;
use App\Models\SeatAllocation;
use App\Models\Showtime;
use App\Models\Venue;
use Illuminate\Http\Request;

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

    public function store(Event $event, Request $request)
    {

        //create an array using $request->query('seat'), it has values separated by comma
        $seats = explode(',', $request->query('seat'));

        // $seats is an array having ids of seats, we can use it to update the is_reserved column to true
        $allocatedSeats = SeatAllocation::whereIn('id', $seats)
            ->update(['is_reserved' => true]);

        return response()->json([
            'data' =>
                ['message' => 'Seats allocated successfully',
                    'status' => 'success',
                    'code' => 200,
                    'eventAndSeatData' => [
                        'event' => $event->name,
                        'venue' => $event->venue->name,
                        'day' => $event->day->date,
                        'startTime' => $event->showtime->start_time,
                        'endTime' => $event->showtime->end_time,
                        'allocatedSeats' => $allocatedSeats,
                    ],
                ]
        ]);

    }
}

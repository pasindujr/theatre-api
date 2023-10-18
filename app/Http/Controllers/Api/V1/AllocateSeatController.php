<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AllocateSeatRequest;
use App\Http\Resources\V1\EventResource;
use App\Models\Day;
use App\Models\Event;
use App\Models\SeatAllocation;
use App\Models\Showtime;
use App\Models\Venue;
use Illuminate\Http\Request;


/**
 * @group Allocate Seats
 *
 * APIs for allocating seats
 */
class AllocateSeatController extends Controller
{

    /**
     * Get all seats.
     *
     * List all seats in for the event
     *
     * @response status=200 scenario="success" {"data":{"id":4,"event_name":"Bethel Robel","venue":{"id":19,"name":"Bogisich PLC","seating_capacity":2172},"showtime":{"id":7,"start_time":"09:16:20","end_time":"16:10:39"},"day":{"id":9,"date":"2003-05-09"},"seat_allocations":[{"id":28,"seat_number":29,"is_reserved":1},{"id":86,"seat_number":152,"is_reserved":1},{"id":91,"seat_number":271,"is_reserved":1}]}}
     *
     */
    public function index(Venue $venue, Day $day, Showtime $showtime)
    {
        $event = Event::where([
            'venue_id' => $venue->id,
            'day_id' => $day->id,
            'showtime_id' => $showtime->id,
        ])->firstOrFail();

        return new EventResource($event);

    }

    /**
     * Allocate seats.
     *
     * Allocate seats for the event
     */
    public function store(Event $event, AllocateSeatRequest $request)
    {
        //create an array using $request->query('seat'), it has values separated by comma
        $seats = explode(',', $request->seats);

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

<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Support\Facades\URL;

class EndpointController extends Controller
{
    public function show(Event $event)
    {
        $endpoint = URL::to('/') . '/api/v1/' . $event->venue_id . '/' . $event->day_id . '/' . $event->showtime_id;
        $venueName = $event->venue->name;
        $day = $event->day->date;
        $showtime = $event->showtime->start_time . ' - ' . $event->showtime->end_time;
        $eventName = $event->name;
        $eventId = $event->id;

        return view('endpoints.show', compact('endpoint', 'venueName', 'day', 'showtime', 'eventName', 'eventId'));
    }

}

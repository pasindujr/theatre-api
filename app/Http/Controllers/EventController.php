<?php

namespace App\Http\Controllers;

use App\Models\Event;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::where('venue_id', auth()->user()->venue->id)
            ->paginate(15);

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

}

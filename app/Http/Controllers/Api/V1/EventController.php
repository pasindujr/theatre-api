<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\View\View;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::where('venue_id', auth()->user()->venue->id)
            ->get();

//dd($events[2]->day->date);

        return view('events.index', compact('events'));
    }

}

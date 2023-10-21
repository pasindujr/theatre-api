<?php

namespace App\Http\Controllers;

use App\Models\SeatAllocation;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $eventIds = collect();

        if (!auth()->user()->venue) {
            return redirect()->route('venue.create');
        }

        $eventCount = auth()->user()->venue->events->count();

        //get date range events
        $events = auth()->user()->venue->events;

        if ($events->isEmpty()) {
            $earliestEventDate = null;
            $latestEventDate = null;
        } else {
            $earliestEventDate = $events->min('created_at')->format('Y-m-d');
            $latestEventDate = $events->max('created_at')->format('Y-m-d');
            // get event ids
            $eventIds= auth()->user()->venue->events->pluck('id');
        }

        if ($eventIds->isEmpty()) {
            $reservedSeatCount = 0;
            $totalSeatCount = 0;
            $reservedSeatPercentage = 0;
        } else {
            //get the count of seat allocations for each event id where is_reserved is true and false
            $reservedSeatCount = SeatAllocation::whereIn('event_id', $eventIds)->where('is_reserved', true)->count();
            $totalSeatCount = SeatAllocation::whereIn('event_id', $eventIds)->count();
            //percentage of reserved seats
            $reservedSeatPercentage = ($reservedSeatCount / $totalSeatCount) * 100;
            $reservedSeatPercentage = round($reservedSeatPercentage, 2);
        }

        return view('home', compact('eventCount', 'earliestEventDate', 'latestEventDate', 'reservedSeatCount', 'totalSeatCount', 'reservedSeatPercentage'));
    }
}

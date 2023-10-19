<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenueRequest;
use App\Http\Resources\V1\VenueResource;
use App\Models\Venue;
use Illuminate\Support\Facades\Gate;

/**
 * @group Venue
 *
 * APIs for managing venues
 */
class VenueController extends Controller
{
    /**
     * Get all venues.
     *
     * List all venues in the database.
     */
    public function index()
    {
        return VenueResource::collection(Venue::all());
    }

    public function create()
    {
        if (Gate::denies('create-a-venue')) {
            return back();
        }
        return view('venues.create');
    }

    public function save(VenueRequest $request)
    {

        if (Gate::denies('create-a-venue')) {
            abort(403);
        }

        $venue = Venue::create([
            'name' => $request->name,
            'seating_capacity' => $request->capacity,
            'user_id' => auth()->user()->id,
        ]);

        toast('Venue Created!','success');

        return redirect()->route('venue.edit')->with('success', 'Venue created successfully');
    }

    public function edit()
    {
        if (Gate::allows('create-a-venue')) {
            return back();
        }

        $venue = auth()->user()->venue;

        return view('venues.edit', compact('venue'));
    }

    public function update(VenueRequest $request)
    {
        if (Gate::allows('create-a-venue')) {
            return back();
        }

        Venue::whereId(auth()->user()->venue->id)
            ->update([
                'name' => $request->name,
                'seating_capacity' => $request->capacity,
            ]);

        toast('Venue Edited!','success');

        return redirect()->route('venue.edit')->with('success', 'Venue updated successfully');
    }
}

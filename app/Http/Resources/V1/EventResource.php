<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'event_name' => $this->name,
            'venue' => new VenueResource($this->venue),
            'showtime' => new ShowtimeResource($this->showtime),
            'day' => new DayResource($this->day),
            'seat_allocations' => SeatAllocationResource::collection($this->seatAllocations),
        ];
    }
}

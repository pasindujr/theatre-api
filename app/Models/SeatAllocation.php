<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatAllocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'seat_number',
        'is_reserved',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue_id',
        'showtime_id',
        'day_id',
        'name',
    ];

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function showtime()
    {
        return $this->belongsTo(Showtime::class);
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }



}

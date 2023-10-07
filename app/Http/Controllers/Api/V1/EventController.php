<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function create()
    {
        return view('events.create');
    }
}

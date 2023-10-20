@extends('layouts.app')

@section('content')
    <div class="main py-4">
        <div class="card card-body border-0 shadow table-wrapper table-responsive">

            <div class="container row justify-content-center">
                <span>Event Name - {{ $eventName }}</span>
                <span>Venue - {{ $venueName }}</span>
                <span>Day - {{ $day }}</span>
                <span class="mb-3">Showtime - {{ $showtime }}</span>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Provide this endpoint to vendors to book seats on behalf of you.</label>
                    <input value="{{ $endpoint }}" readonly type="text" class="form-control" id="exampleFormControlInput1" >
                    <a href="{{ route('events.index') }}" class="btn btn-primary mt-3"><i class="fas fa-backward fa-fw"></i> Back</a>
                    <a href="{{ route('events.show', $eventId) }}" class="btn btn-primary mt-3"><i class="fas fa-info fa-fw"></i> Seat Info</a>
                </div>
                <div class="col-6">

                </div>
            </div>

        </div>
    </div>
@endsection

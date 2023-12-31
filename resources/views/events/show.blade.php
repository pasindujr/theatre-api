@extends('layouts.app')

@section('content')
    <div class="main py-4">
        <div class="card card-body border-0 shadow table-wrapper table-responsive">
            <h2 class="mb-4 h5">{{ __('Event') }}</h2>
            <div class="container justify-content-start">
                <a href="{{ route('events.index') }}" class="btn btn-primary"><i class="fas fa-backward fa-fw"></i> Back to Events</a>
            </div>
            <div class="container row justify-content-center">
                <div class="table-responsive py-4">
                    <livewire:seat-allocation-table :eventId="$event->id"/>
                </div>
            </div>

        </div>
    </div>
@endsection

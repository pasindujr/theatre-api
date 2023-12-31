<div>
    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <h2 class="mb-4 h5">{{ __('Create Events') }}</h2>

        <div class="container row justify-content-center">

            <div class="col-6">
                <form action="{{ route('venue.save') }}" method="post">

                    <div class="mb-4 ">
                        <label for="startdate">Start Date</label>
                        <input type="date" name="startdate" class="form-control"
                               id="startdate"
                               required wire:model.blur="startDate">

                    </div>
                    <div class="mb-3">
                        <label for="enddate">End Date</label>
                        <input type="date" name="enddate"
                               class="form-control" id="enddate" wire:model.blur="endDate" required>

                    </div>

                    @if(!$areDatesFilled)
                        <button wire:click.prevent="openShowtime()" class="btn btn-tertiary">Next</button>
                    @endif

                    @if($areDatesFilled)
                        @if($showTimes->count() > 0)
                            <label>Select Show Times</label>
                            @foreach($showTimes as $showtime)
                                <div class="form-check">
                                    <input wire:click="addShowtimes({{ $showtime->id }})" class="form-check-input"
                                           type="checkbox" value="{{ $showtime->id }}" id="showTime{{ $showtime->id }}">
                                    <label class="form-check-label" for="showTime{{ $showtime->id }}">
                                        {{ $showtime->start_time }} - {{ $showtime->end_time }}
                                    </label>
                                </div>
                            @endforeach
                            <div class="mb-4 ">
                                <label for="starttime">Start Time</label>
                                <input type="time" name="starttime" class="form-control"
                                       id="starttime"
                                       required wire:model.blur="startTime">

                            </div>
                            <div class="mb-3">
                                <label for="endtime">End Time</label>
                                <input type="time" name="endtime"
                                       class="form-control" id="endtime" wire:model.blur="endTime" required>

                            </div>
                            <button wire:click.prevent="createShowTimes()" class="btn btn-tertiary">Save New Show Time</button>
                            @if(!$areShowTimesFilled)
                                <button wire:click.prevent="addName()" class="btn btn-tertiary">Next</button>
                            @endif
                        @else
                            <div class="alert alert-danger" role="alert">
                                No Show Times Available. Add Some.
                            </div>
                            <div class="mb-4 ">
                                <label for="starttime">Start Time</label>
                                <input type="time" name="starttime" class="form-control"
                                       id="starttime"
                                       required wire:model.blur="startTime">

                            </div>
                            <div class="mb-3">
                                <label for="endtime">End Time</label>
                                <input type="time" name="endtime"
                                       class="form-control" id="endtime" wire:model.blur="endTime" required>

                            </div>
                            <button wire:click.prevent="createShowTimes()" class="btn btn-tertiary">Save Show Time</button>
                        @endif
                    @endif

                    @if($areDatesFilled && $areShowTimesFilled)

                        <div class="mb-4 mt-3">
                            <label for="eventname">Event Name</label>
                            <input type="text" name="eventname" class="form-control"
                                   id="eventname"
                                   required wire:model.blur="eventName">

                        </div>
                        <button wire:click.prevent="createEvents()" class="btn btn-tertiary">Save</button>
                    @endif

                </form>
            </div>
        </div>

    </div>
</div>

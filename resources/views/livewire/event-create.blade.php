<div>
    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <h2 class="mb-4 h5">{{ __('Create Events') }}</h2>

        <div class="container row justify-content-center">

            <div class="col-6">
                <form action="{{ route('venue.save') }}" method="post">
                    @csrf
                    <div class="mb-4 ">
                        <label for="startdate">Start Date</label>
                        <input type="date" name="startdate" class="form-control"
                               id="startdate"
                               required wire:model.live="startDate">

                    </div>
                    <div class="mb-3">
                        <label for="enddate">End Date</label>
                        <input type="date" name="enddate"
                               class="form-control" id="enddate" wire:model.live="endDate" required>

                    </div>

                    <button wire:click.prevent="openShowtime()" class="btn btn-tertiary">Next</button>

                    @if($areDatesFilled)

                        <input type="text" name="" id="">
                    @endif
                </form>
            </div>
        </div>

    </div>
</div>

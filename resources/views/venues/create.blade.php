@extends('layouts.app')

@section('content')
    <div class="main py-4">
        <div class="card card-body border-0 shadow table-wrapper table-responsive">
            <h2 class="mb-4 h5">{{ __('Create the venue') }}</h2>

            <div class="container row justify-content-center">

                <div class="col-6">
                    <form action="{{ route('venue.save') }}" method="post">
                        @csrf
                        <div class="mb-4 ">
                            <label for="name">Venue Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   required value="{{ old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>
                        <div class="mb-3">
                            <label for="capacity">Seating Capacity</label>
                            <input type="number" name="capacity"
                                   class="form-control @error('capacity') is-invalid @enderror" id="capacity" required>
                            @error('capacity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-tertiary" type="submit">Save</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

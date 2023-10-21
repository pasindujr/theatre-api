@extends('layouts.app')

@section('content')
    <div class="main py-4">
        <div class="row">
            <div class="col-12 col-xl-12">
                <div class="col-12 px-0">
                    <div class="card border-0 shadow">
                        <div class="card-body">
                            <h2 class="fs-5 fw-bold mb-1">{{ __('Dashboard') }}</h2>
                            <p>Welcome {{ auth()->user()->name }}</p>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 col-lg-4">
                        <div class="card border-0 shadow">
                            <div class="card-body">
                                <div class="row d-block d-xl-flex align-items-center">
                                    <div
                                        class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center">
                                        <div class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0">
                                            <svg class="icon" fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <div class="d-sm-none">
                                            <h2 class="fw-extrabold h5">Event Count</h2>
                                            <h3 class="mb-1">{{ $eventCount }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-12 col-xl-7 px-xl-0">
                                        <div class="d-none d-sm-block">
                                            <h2 class="h6 text-gray-400 mb-0"> Event Count</h2>
                                            <h3 class="fw-extrabold mb-2">{{ $eventCount }}</h3>
                                        </div>
                                        <small class="text-gray-500">
                                            {{ $earliestEventDate }} - {{ $latestEventDate }}
                                        </small>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-8">
                        <div class="card border-0 shadow">
                            <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                                <h2 class="fs-5 fw-bold mb-0">Allocated / Unallocated seats  ({{ $reservedSeatCount. '/' . $totalSeatCount }})</h2>
                            </div>
                            <div class="card-body">
                                <!-- Project 3 -->
                                <div class="row align-items-center mb-4">
                                    <div class="col-auto">
                                        <svg class="icon icon-sm text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                            <path fill-rule="evenodd"
                                                  d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                                                  clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="col">
                                        <div class="progress-wrapper">
                                            <div class="progress-info">
                                                <div class="small fw-bold text-gray-500"><span>{{ $reservedSeatPercentage }} %</span></div>
                                            </div>
                                            <div class="progress mb-0">
                                                <div class="progress-bar bg-warning" role="progressbar"
                                                     aria-valuenow="{{ $reservedSeatPercentage }}" aria-valuemin="0" aria-valuemax="100"
                                                     style="width: {{ $reservedSeatPercentage }}%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

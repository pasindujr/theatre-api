<?php

use App\Http\Controllers\Api\V1\AllocateSeatController;
use App\Http\Controllers\VenueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//create route group with prefix v1
Route::prefix('v1')->group(function () {
    Route::get('/venues',[VenueController::class, 'index']);
    Route::get('/{venue}/{day}/{showtime}',[AllocateSeatController::class, 'index']);
    Route::post('/events/{event}/allocateseats',[AllocateSeatController::class, 'store']);
});



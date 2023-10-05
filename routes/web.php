<?php

use App\Http\Controllers\Api\V1\VenueController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('venue/create', [VenueController::class, 'create'])->name('venue.create');
    Route::post('venue/save', [VenueController::class, 'save'])->name('venue.save');
    Route::get('venue/edit', [VenueController::class, 'edit'])->name('venue.edit');
    Route::post('venue/update', [VenueController::class, 'update'])->name('venue.update');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
});

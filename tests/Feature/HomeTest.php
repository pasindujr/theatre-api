<?php

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('redirects to home if logged in', function () {


    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/login')
        ->assertRedirect('/home');
});

it('redirects to login if not logged in', function () {

    $this->get('/home')
        ->assertDontSeeText(['Create Venue', 'Update Venue', 'Events', 'Create Event', 'Manage Events'])
        ->assertRedirect('/login');
});

it('shows create venue on navbar if logged in user not have a venue', function () {

    $user = User::factory()->create();

    $this->actingAs($user)->get('/home')
        ->assertSee(['Create Venue', $user->name])
        ->assertDontSeeText(['Update Venue', 'Events', 'Create Event', 'Manage Events']);
});

it('shows update venue on navbar if logged in user have a venue', function () {

    $user = User::factory()->create();
    $user->venue()->create([
        'user_id' => $user->id,
        'name' => 'Venue Name',
        'seating_capacity' => 10,
    ]);

    $this->actingAs($user)->get('/home')
        ->assertSeeText(['Update Venue', 'Events', 'Create Event', 'Manage Events', $user->name])
        ->assertDontSeeText(['Create Venue']);
});




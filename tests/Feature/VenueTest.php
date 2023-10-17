<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('can create a venue if logged in user doesnt have a venue', function () {

    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/home')
        ->assertSee(['Create Venue', $user->name])
        ->assertDontSeeText(['Update Venue', 'Events', 'Create Event', 'Manage Events']);

    $this->actingAs($user)->post('/venue/save', [
        'name' => 'Venue Name',
        'capacity' => 10,
    ])->assertRedirect('/venue/edit');

    $this->assertDatabaseHas('venues', [
        'user_id' => $user->id,
        'name' => 'Venue Name',
        'seating_capacity' => 10,
    ]);

});

it('can update the venue if logged in user have a venue', function () {

    $user = User::factory()->create();
    $user->venue()->create([
        'user_id' => $user->id,
        'name' => 'Venue Name',
        'seating_capacity' => 10,
    ]);

    $this->actingAs($user)->get('/home')
        ->assertSeeText(['Update Venue', 'Events', 'Create Event', 'Manage Events', $user->name])
        ->assertDontSeeText(['Create Venue']);

    $this->actingAs($user)->post('/venue/update', [
        'name' => 'Venue Name Updated',
        'capacity' => 20,
    ])->assertRedirect('/venue/edit');

    $this->assertDatabaseHas('venues', [
        'user_id' => $user->id,
        'name' => 'Venue Name Updated',
        'seating_capacity' => 20,
    ]);

});

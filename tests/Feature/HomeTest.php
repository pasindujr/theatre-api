<?php

use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(LazilyRefreshDatabase::class);

it('redirects to home if logged in', function () {


    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/login');

    $response->assertRedirect('/home');
});

it('redirects to login if not logged in', function () {

    $response = $this->get('/home');

    $response->assertRedirect('/login');
});




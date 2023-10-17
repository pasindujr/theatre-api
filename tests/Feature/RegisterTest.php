<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('has errors if the details are not provided', function () {

    $this->post('/register', [
        'name' => '',
        'email' => '',
        'password' => '',
        'password_confirmation' => '',
    ])->assertSessionHasErrors(['name', 'email', 'password']);

});

it('registers the user if data are provided', function () {

    $this->post('/register', [
        'name' => 'John Doe',
        'email' => 'john@gmail.com',
        'password' => '12345678',
        'password_confirmation' => '12345678',
    ])->assertRedirect('/home');

    $this->assertDatabaseHas('users', [
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
        ])
        ->assertAuthenticated();

});

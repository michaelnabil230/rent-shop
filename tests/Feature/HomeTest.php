<?php

declare(strict_types=1);

uses(Illuminate\Foundation\Testing\LazilyRefreshDatabase::class);

it('home page returns a successful response')
    ->get('/')
    ->assertStatus(200);

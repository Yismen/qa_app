<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Foundation\Auth\User;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '', // password
        'remember_token' => Str::random(10),
    ];
});

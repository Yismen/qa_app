<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Dainsys\QAApp\Models\Form;
use Faker\Generator as Faker;

$factory->define(Form::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
        'goal_percentage' => $faker->randomFloat(2, 0, 1),
    ];
});

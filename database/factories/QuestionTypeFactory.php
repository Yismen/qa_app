<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Dainsys\QAApp\Models\QuestionType;
use Faker\Generator as Faker;

$factory->define(QuestionType::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
    ];
});

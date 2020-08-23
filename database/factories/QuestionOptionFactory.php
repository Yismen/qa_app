<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Dainsys\QAApp\Models\QuestionOption;
use Dainsys\QAApp\Models\QuestionType;
use Faker\Generator as Faker;

$factory->define(QuestionOption::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'value' => $faker->randomFloat(2, 0, 1),
        'question_type_id' => factory(QuestionType::class),
    ];
});

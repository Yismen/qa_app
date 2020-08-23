<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Dainsys\QAApp\Models\Form;
use Dainsys\QAApp\Models\Question;
use Dainsys\QAApp\Models\QuestionType;
use Faker\Generator as Faker;

$factory->define(Question::class, function (Faker $faker) {
    return [
        'text' => $faker->word(),
        'points' => 10,
        'form_id' => factory(Form::class),
        'question_type_id' => factory(QuestionType::class),
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Dainsys\QAApp\Models\Audit;
use Dainsys\QAApp\Models\Form;
use Dainsys\QAApp\Tests\MockUser;
use Faker\Generator as Faker;

$factory->define(Audit::class, function (Faker $faker) {
    return [
        'form_id' => factory(Form::class),
        'user_id' => factory(MockUser::class),
        'production_date' => now(),
        'transaction' => $faker->bankAccountNumber,
        'max_points' => 30,
        'points' => 28,
        'points_goal' => 25,
        'passes' => true,
        'data' => null
    ];
});

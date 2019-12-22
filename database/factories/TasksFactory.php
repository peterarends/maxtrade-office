<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'project_id' => 1,
        'title' => $faker->text(30),
        'body'  => $faker->text(200),
        'status'    => $faker->randomElement([0, 1])
    ];
});

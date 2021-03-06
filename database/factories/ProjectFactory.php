<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'title' => $faker->text(30),
        'body'  => $faker->text(200),
        'status'    => $faker->randomElement([0, 1])
    ];
});

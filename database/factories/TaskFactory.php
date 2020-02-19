<?php

use Faker\Generator as Faker;

$factory->define(TaskApp\Task::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence
    ];
});

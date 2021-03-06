<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Concept;
use Faker\Generator as Faker;

$factory->define(Concept::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'description' => $faker->text,
        'dvc_included' => false,
        'concept_id' => null,
    ];
});

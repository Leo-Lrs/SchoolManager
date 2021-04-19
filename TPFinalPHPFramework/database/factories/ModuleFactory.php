<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Module;
use Faker\Generator as Faker;

$factory->define(Module::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Anglais', 'Mathématiques', 'Dessin', 'PHP', 'Reseaux']),
        'description' => $faker->text($maxNbChars = 30)
    ];
});

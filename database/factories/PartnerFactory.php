<?php

use App\Partner;
use Faker\Generator as Faker;

$factory->define(Partner::class, function (Faker $faker) {
    return [
        //
        'email' => $faker->unique()->email,
        'name' => $faker->unique()->company,
    ];
});

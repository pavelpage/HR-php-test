<?php

use App\Vendor;
use Faker\Generator as Faker;

$factory->define(Vendor::class, function (Faker $faker) {
    return [
        //
        'email' => $faker->unique()->email,
        'name' => $faker->unique()->company,
    ];
});

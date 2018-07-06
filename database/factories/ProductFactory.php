<?php

use App\Product;
use App\Vendor;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        'price' => $faker->numberBetween(100, 1000),
        'vendor_id' => function(){
            return factory(Vendor::class)->create()->id;
        },
    ];
});

<?php

use App\Order;
use App\Partner;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    $status = [0, 10, 20];
    $createdAt = \Carbon\Carbon::now()->subDays(rand(0, 4));
    return [
        'status' => $status[rand(0,2)],
        'client_email' => $faker->email,
        'partner_id' => function(){
            return factory(Partner::class)->create()->id;
        },
        'delivery_dt' => $createdAt->copy()->addHours(rand(6,50)),
        'created_at' => $createdAt,
        'updated_at' => $createdAt->copy()->addHours(rand(1,5)),
    ];
});

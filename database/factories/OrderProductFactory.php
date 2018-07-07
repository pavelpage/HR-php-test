<?php

use App\Order;
use App\OrderProduct;
use App\Product;
use Faker\Generator as Faker;

$factory->define(OrderProduct::class, function (Faker $faker) {

    $product = factory(Product::class)->create();
    $order = factory(Order::class)->create();

    return [
        //
        'order_id' => $order->id,
        'product_id' => $product->id,
        'quantity' => rand(1,3),
        'price' => $product->price,
        'created_at' => $order->created_at,
        'updated_at' => $order->updated_at,
    ];
});

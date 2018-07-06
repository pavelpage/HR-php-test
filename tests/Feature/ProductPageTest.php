<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_see_product_list()
    {
        $products = factory(Product::class, 10)->create();

        $this->get(route('product.index'))
            ->assertSee($products->first()->name);
    }

    public function test_user_can_update_product_price()
    {
        $product = factory(Product::class)->create(['price' => 200]);

        $this->post(route('product.update-price'), [
            'id' => $product->id,
            'price' => 300,
        ])->assertJson(['res' => true]);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'price' => 300,
        ]);
    }
}

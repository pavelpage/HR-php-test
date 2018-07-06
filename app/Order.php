<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $guarded = [];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function items()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'order_products');
    }

    public function statusString()
    {
        $arr = [
            0 => 'Новый',
            10 => 'Подтвержден',
            20 => 'Завершен',
        ];

        return $arr[$this->status];
    }

    public function fullPrice()
    {
        return $this->items->sum(function ($product){
            return $product->price * $product->quantity;
        });
    }

    public function productsString()
    {
        return $this->products->implode('name', ', ');
    }
}

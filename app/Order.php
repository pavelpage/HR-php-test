<?php

namespace App;

use Carbon\Carbon;
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

    public function scopeOverdue($query)
    {
        return $query->where('status', 10)
            ->whereRaw('delivery_dt < NOW()');
    }

    public function scopeCurrent($query)
    {
        $date = Carbon::now()->addHours(24)->format('Y-m-d H:i:s');

        return $query->where('status', 10)
                ->where('delivery_dt', '<', $date)
                ->whereRaw('delivery_dt > NOW()');
    }

    public function scopeNew($query)
    {
        return $query->where('status', 0)
            ->whereRaw('delivery_dt > NOW()');
    }

    public function scopeCompleted($query)
    {
        $date = Carbon::now()->subHours(24)->format('Y-m-d H:i:s');

        return $query->where('status', 20)
            ->where('delivery_dt', '>', $date)
            ->whereRaw('delivery_dt < NOW()');
    }
}

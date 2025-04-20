<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'drink_id', 'quantity', 'price'];

    public function drink()
{
    return $this->belongsTo(Drinks::class);
}

public function order()
{
    return $this->belongsTo(Order::class);
}

}

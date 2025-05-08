<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'drink_id', 'quantity'];

    public function drink()
    {
        return $this->belongsTo(Drinks::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}

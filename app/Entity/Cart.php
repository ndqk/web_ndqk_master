<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    protected $fillable = ['customer_id', 'status'];

    public function cartItems(){
        return $this->hasMany(CartItem::class);
    }
}

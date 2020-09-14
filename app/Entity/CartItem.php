<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = "cart_items";

    protected $fillable = ['product_id', 'cart_id', 'quantity', 'status'];

    public function product(){
        return $this->hasOne(Product::class, 'id','product_id');
    }
}

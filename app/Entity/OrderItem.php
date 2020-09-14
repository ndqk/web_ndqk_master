<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';

    protected $fillable = ['product_id', 'order_id', 'quantity', 'status'];
}

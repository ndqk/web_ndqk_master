<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['customer_id', 'name', 'phone', 'email', 'address', 
    'province', 'district', 'ward', 'shipping', 'subtotal', 'status'];
}

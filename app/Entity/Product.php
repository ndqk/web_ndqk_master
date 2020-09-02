<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'slug', 'category_id', 'description', 'price'
    , 'discount', 'quantity', 'type', 'user_id', 'view', 'status'];
}

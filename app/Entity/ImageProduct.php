<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    protected $table = 'image_products';

    protected $fillable = ['image', 'product_id', 'status'];
}

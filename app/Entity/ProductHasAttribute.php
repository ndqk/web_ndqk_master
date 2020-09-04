<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class ProductHasAttribute extends Model
{
    protected $table = 'product_has_attributes';

    protected $fillable = ['product_id', 'attribute_id'];
}

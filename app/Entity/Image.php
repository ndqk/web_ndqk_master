<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = ['image', 'post_id', 'status'];
}

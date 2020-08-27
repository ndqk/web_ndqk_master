<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

    protected $fillable = ['title', 'image', 'link'];
}

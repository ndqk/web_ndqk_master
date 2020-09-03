<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{

    use Sluggable;
    protected $table = 'products';

    protected $fillable = ['name', 'slug', 'category_id', 'description', 'price'
    , 'discount', 'quantity', 'type', 'user_id', 'view', 'status'];

    public function sluggable(){
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

}

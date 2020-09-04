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

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function images(){
        return $this->hasMany(ImageProduct::class, 'product_id');
    }

    public function attributes(){
        return $this->belongsToMany(Attribute::class, 'product_has_attributes');
    }
}

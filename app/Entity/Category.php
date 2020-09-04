<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


class Category extends Model
{
    use Sluggable;
    protected $table="categories";

    protected $fillable=['title','status', 'category_id' ,'slug'];

    public function sluggable(){
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function childrenCategories(){
        return $this->hasMany(Category::class)->with('categories');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function subproducts(){
        return $this->hasManyThrough(Product::class, Category::class, 'category_id', 'category_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}

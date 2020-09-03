<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;
    protected $table="categories";

    protected $fillable=['title', 'parent', 'status', 'category_id' ,'slug'];

    public function sluggable(){
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }


    public function categories(){
        return $this->hasMany(Category::class);
    }

    public function childrenCategories(){
        return $this->hasMany(Category::class)->with('categories');
    }
}

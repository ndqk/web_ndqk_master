<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;
    protected $table="posts";
    protected $primaryKey = 'id';

    protected $fillable=['title', 'slug', 'category_id', 'content', 'user_id','view', 'status'];

    public function sluggable(){
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function images(){
        return $this->hasMany('App\Entity\Image');
    }

    public function category(){
        return $this->belongsTo('App\Entity\Category');
    }
}

<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;
    protected $table="categories";

    protected $fillable=['title', 'parent', 'status', 'slug'];

    public function sluggable(){
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public static function showCategories($categories, $parent_id = 0){
        $cate_child = array();
        foreach($categories as $item){
            if($item->parent == $parent_id){
                $cate_child[] = $item;
            }
        }
        $sting = '';
        if($cate_child){
            echo '<ul class="tree-view">';
            foreach($cate_child as $item){
                echo '<li >
                        <span>'.$item->title.'</span>
                        &ensp;
                        <a href="" data-toggle="modal" data-target="#modal-default" class="category-edit" data-link="'.route('category.show', $item->id).'">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a href="'.route('category.delete', $item->id).'" data-method="DELETE">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                        <a class="create-new-category" href="#" data-id='.$item->id.' data-title ='.$item->title.'>
                            <i class="fas fa-plus"></i>
                        </a>';
                self::showCategories($categories, $item->id);
                echo '</li>';
            }
            echo '</ul>';
        }
    }

    public static function showCategoriesInSite($categories, $parent_id = 0){
        $cate_child = array();
        foreach($categories as $item){
            if($item->parent == $parent_id){
                $cate_child[] = $item;
            }
        }
        $sting = '';
        if($cate_child){
            foreach($cate_child as $item){
                if($parent_id == 0){
                    echo '<ul class="single-mega cn-col-4">
                            <li class="title">
                                '.$item->title.'
                            </li>
                            <li><a href="">All</a></li>';
                    self::showCategoriesInSite($categories, $item->id);
                    echo '</ul>';
                }
                else{
                    echo '<li><a href="">'.$item->title.'</a></li>';
                }
            }
        }
    }
}

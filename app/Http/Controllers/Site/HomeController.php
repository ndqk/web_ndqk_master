<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Entity\{Post, Image, Category};

class HomeController extends Controller
{
    //
    public function index(){
        $posts = Post::select('id', 'title', 'slug', 'updated_at', 'category_id')
                        ->with(['images' => function($query){
                            return $query->where('status', 0);
                        }])
                        ->with('category')
                        ->latest()
                        ->paginate(9);
        return view('site.home.index', compact('posts'));
    }
}

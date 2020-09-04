<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Collection;

use App\Entity\{Category, Product};

class ProductController extends Controller
{
    public function detail(Category $category, Product $product){
        $images = $product->images()->get();
        $attrs = $product->attributes()->get();
        
        list($previewImage, $thumImages) = $images->partition(function($image){
            return $image->status == 0;
        });
        list($sizes, $colors) = $attrs->partition(function($attr){
            return $attr->name == 'size';
        });

        return view('site.product.detail', [
            'category' => $category,
            'detail_product' => $product,
            'preview_image' => $previewImage,
            'thumbnail_images' => $thumImages,
            'sizes' => $sizes,
            'colors' => $colors
        ]);
    }
}

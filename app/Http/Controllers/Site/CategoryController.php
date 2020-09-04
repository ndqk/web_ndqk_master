<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Response;


use App\Entity\{Category, Product};

class CategoryController extends Controller
{
    public function index(Category $category){
        if($category->category_id)
            $parentCategory = Category::findOrFail($category->category_id);
        else
            $parentCategory = $category;

        $allProducts = $this->getAllProductsByCategory($category);

        $url = \Request::url();
        $order = \Request::query('sort', 'new');
        $allProducts = $this->manuallyOrderByRequest($allProducts, $order);

        $countProducts = $allProducts->count();
        $allProducts = $this->makeManuallyPaginator($allProducts, $url, 9);
        
        return view('site.category.index', [
            'currCategory' => $category,
            'parentCategory' => $parentCategory,
            'productFilters' => $allProducts,
            'countProducts' => $countProducts
        ]);
    }

    public function filter(Category $category, Request $request){

        $allProducts = $this->getAllProductsByCategory($category);

        $url = $request->url();
        $order = $request->query('sort', 'new');
        $allProducts = $this->manuallyOrderByRequest($allProducts, $order);
        if(isset($request->min) && isset($request->max)){
            $min = $request->min;
            $max = $request->max;
            $allProducts = $this->getCollectionByRange($allProducts, $min, $max, 'discount');
        }

        $countProducts = $allProducts->count();
        $allProducts = $this->makeManuallyPaginator($allProducts, $url, 9);

        return response()->json(View::make('site/product/product_filter', ['productFilters' => $allProducts, 'countProducts' => $countProducts])->render());
    }

    private function getAllProductsByCategory($category){
        $productFilters = Category::where('id', $category->id)
                                    ->with([
                                        'products' => function($q){
                                            $q->with(['images' => function($q){
                                                $q->where('image_products.status', 0);
                                            }, 'category']);
                                        }
                                        , 
                                        'subproducts'  => function($q){
                                            $q->with(['images' => function($q){
                                                $q->where('image_products.status', 0);
                                            }, 'category']);
                                        }
                                    ])
                                    ->first();
        return $productFilters->products->merge($productFilters->subproducts);
    }

    private function makeManuallyPaginator($collection, $url, $perPage){
        $count = $collection->count();
        $page = \Request::get('page', 1);
        $query = \Request::query();
        
        return new LengthAwarePaginator($collection->forPage($page, $perPage), $count, 
                                                $perPage, $page,  
                                                ['path' => $url, 'query' => $query]);
    }

    private function manuallyOrderByRequest($collection, $order){
        if($order == 'new'){
            return $collection->sortByDesc('updated_at');
        }
        if($order == 'price-desc'){
            return $collection->sortByDesc('discount');
        }
        if($order == 'price-asc'){
            return $collection->sortBy('discount');
        }
        if($order == 'rate'){
            return $collection->sortByDesc('view');
        }
        if($order == 'view'){
            return $collection->sortByDesc('view');
        }
        if($order == 'alphabet'){
            return $collection->sortBy('slug');
        }
    }

    private function getCollectionByRange($collection, $min, $max, $option){
        return $collection->filter(function($item) use ($min, $max){
            return $item->discount >= $min && $item->discount <= $max;
        });
    }
}

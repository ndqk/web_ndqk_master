<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

use App\Entity\{Category, Product, ImageProduct, Attribute, ProductHasAttribute};

use App\Http\Requests\{StoreProductRequest, UpdateProductRequest};

class ProductController extends Controller
{

    function __construct(){
        $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => 'index']);
        $this->middleware('permission:product-create', ['only' => ['store', 'create']]);
        $this->middleware('permission:product-edit', ['only' => ['show', 'update']]);
        $this->middleware('permission:product-delete', ['only' => 'destroy']);
    }

    public function index()
    {
        return view('admin.product.list');
    }

    public function getList(){
        $products = Product::join('categories', 'categories.id', 'products.category_id')
                            ->join('image_products', 'image_products.product_id', 'products.id')
                            ->where('image_products.status', 0)
                            ->select('products.id', 'products.name', 'products.price', 'products.quantity', 'products.discount',
                            'products.description', 'products.view', 'products.type', 'products.status' ,'categories.title', 'image_products.image');
        return Datatables::of($products)->addColumn('action', function($product){
            //$string =  '<a href="">View</a>';
            $string = '';
            $string .=   '<a href="'.route('product.edit', $product->id).'">Edit </a>';
            $string .=  '<a href="'.route('product.delete', $product->id).'">&emsp;Delete</a>';                                
            return $string;
        })->make(true);
    }

    public function create()
    {
        $categories = Category::all();
        $sizeProducts = Attribute::where('name' , 'size')->get();
        $colorProducts = Attribute::where('name' , 'color')->get();
        return view('admin.product.create', [
            'categories' => $categories,
            'size_products' => $sizeProducts,
            'color_products' => $colorProducts
        ]);
    }

    public function store(StoreProductRequest $request)
    {
        $product = [
            'name' => $request->name,
            'category_id' => $request->category,
            'quantity' => $request->quantity ? $request->quantity : 0,
            'price' => $request->price,
            'discount' => $request->discount ? $request->discount : $request->price,
            'type' => $request->type,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'view' => 0,
            'status' => $request->status
        ];
        $attrs =  array_merge($request->size, $request->color);

        $storeProduct = new Product($product);
        $storeProduct->save();

        foreach($attrs as $attr)
            ProductHasAttribute::insert([
                'product_id' => $storeProduct->id, 
                'attribute_id' => $attr
            ]);

        if($request->has('previewImage')){
            ImageProduct::insert([
                'image' => $this->uploadFile($request->previewImage,'/upload/image/product'),
                'product_id' => $storeProduct->id,
                'status' => 0
            ]);
        }

        if($request->has('thumbImage')){
            $thumbImages = $request->thumbImage;
            foreach($thumbImages as $image){
                ImageProduct::insert([
                    'image' => $this->uploadFile($image, '/upload/image/product'),
                    'product_id' => $storeProduct->id,
                    'status' => 1
                ]);
            }
        }

        return redirect()->back()->with('status', 'Thêm sản phẩm mới thành công');
        
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $categories = Category::all();
        $editProduct = Product::with('attributes')->findOrFail($id);
        $attrChecked = $editProduct->attributes->pluck('id')->all();
        $previewImage = ImageProduct::where('product_id', $editProduct->id)
                                    ->where('status', 0)->first();
        $thumbImages = ImageProduct::where('product_id', $editProduct->id)
                                    ->where('status', 1)->get();
        $sizeProducts = Attribute::where('name' , 'size')->get();
        $colorProducts = Attribute::where('name' , 'color')->get();

        return view('admin.product.edit', [
            'categories' => $categories,
            'editProduct' => $editProduct,
            'previewImage' => $previewImage,
            'thumbImages' => $thumbImages,
            'size_products' => $sizeProducts,
            'color_products' => $colorProducts,
            'attr_checked' => $attrChecked
        ]);
    }

   
    public function update(UpdateProductRequest $request, $id)
    {
        $product = [
            'name' => $request->name,
            'category_id' => $request->category,
            'quantity' => $request->quantity ? $request->quantity : 0,
            'price' => $request->price,
            'discount' => $request->discount ? $request->discount : $request->price,
            'type' => $request->type,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
            'view' => 0,
            'status' => $request->status
        ];

        $attrs = array_merge($request->size, $request->color);
        ProductHasAttribute::where('product_id', $id)->delete();
        foreach($attrs as $attr)
        ProductHasAttribute::insert([
            'product_id' => $id, 
            'attribute_id' => $attr
        ]);

        $updateProduct = Product::findOrFail($id);
        $updateProduct->update($product);

        if($request->has('previewImage')){
            $currPreviewImage = ImageProduct::where('product_id', $updateProduct->id)
                                            ->where('status', 0)
                                            ->first();
            //return public_path().'/upload/image/product/'.$currPreviewImage->image;
            $this->deleteFile('/upload/image/product/'.$currPreviewImage->image);
            $currPreviewImage->delete();
            ImageProduct::insert([
                'image' => $this->uploadFile($request->previewImage,'/upload/image/product'),
                'product_id' => $updateProduct->id,
                'status' => 0
            ]);
        }

        if($request->has('thumbImage')){
            $currThumbImages = ImageProduct::where('product_id', $updateProduct->id)
                                            ->where('status', 1)
                                            ->get();
            
            if($currThumbImages){
                foreach($currThumbImages as $image){
                    $this->deleteFile('/upload/image/product/'.$image->image);
                }
                ImageProduct::where('product_id', $updateProduct->id)
                                                ->where('status', 1)
                                                ->delete();
            }
        
            $thumbImages = $request->thumbImage;
            foreach($thumbImages as $image){
                ImageProduct::insert([
                    'image' => $this->uploadFile($image, '/upload/image/product'),
                    'product_id' => $updateProduct->id,
                    'status' => 1
                ]);
            }
        }
        $updateProduct->update($product);
        return redirect()->back()->with('status', 'Sửa sản phẩm thành công');
    }

    public function destroy($id)
    {
        ProductHasAttribute::where('product_id', $id)->delete();
        $deleteImages = ImageProduct::where('product_id', $id)->get();
        foreach($deleteImages as $image){
            $this->deleteFile('/upload/image/product/'.$image->image);
        }
        ImageProduct::where('product_id', $id)->delete();
        $deleteProduct = Product::findOrFail($id);
        $deleteProduct->delete();

        return redirect()->back()->with('status', 'Xóa thành công');
    }


    //
    private function genFileName($file){
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        return $filename . '_' . time() . '_' .uniqid(). '.' .$extension;
    }

    private function uploadFile($file, $output_folder){
        $file_ = $file->getClientOriginalName();
        $fileName = $this->genFileName($file_);
        if(!file_exists($fileName))
            $file->move(public_path($output_folder), $fileName);
        return $fileName;
    }

    private function deleteFile($path){
        $path_ = public_path().$path;
        if(file_exists($path_)){
            unlink($path_);
        }
    }
}

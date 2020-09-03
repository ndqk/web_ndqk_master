<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

use App\Entity\{Category, Product, ImageProduct};

use App\Http\Requests\{StoreProductRequest, UpdateProductRequest};

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getList(){
        $products = Product::join('categories', 'categories.id', 'category_id')
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
        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        $storeProduct = new Product($product);
        $storeProduct->save();

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $editProduct = Product::findOrFail($id);
        $previewImage = ImageProduct::where('product_id', $editProduct->id)
                                    ->where('status', 0)->first();
        $thumbImages = ImageProduct::where('product_id', $editProduct->id)
                                    ->where('status', 1)->get();
        return view('admin.product.edit', [
            'categories' => $categories,
            'editProduct' => $editProduct,
            'previewImage' => $previewImage,
            'thumbImages' => $thumbImages
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
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

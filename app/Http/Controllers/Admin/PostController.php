<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use Illuminate\Support\Facades\Auth;
use App\Entity\{Post, Category, Image};

use App\Http\Requests\{StorePostRequest,UpdatePostRequest};

class PostController extends Controller
{
    
    function __construct(){
        $this->middleware('permission:post-list|post-create|post-edit|post-delete', ['only' => 'index']);
        $this->middleware('permission:post-create', ['only' => 'store']);
        $this->middleware('permission:post-edit', ['only' => ['show', 'update']]);
        $this->middleware('permission:post-delete', ['only' => 'destroy']);
    }

    public function index()
    {
        return view('admin.post.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getList(){
        $post = Post::join('categories', 'posts.category_id', 'categories.id')
                    ->join('images', 'posts.id', 'images.post_id')
                    ->where('images.status', '0')
                    ->join('users', 'posts.user_id', 'users.id')
                    ->select('posts.id', 'posts.title', 'categories.title as category', 'images.image', 'users.name', 'posts.status', 'posts.view');
        
        return Datatables::of($post)->addColumn('action', function($post){
            //$string =  '<a href="">View</a>';
            $string = '';
            $string .=   '<a href="'.route('post.edit', $post->id).'">&emsp;Edit </a>';
            $string .=  '<a href="'.route('post.delete', $post->id).'">&emsp;Delete</a>';
            
            return $string;
        })->make(true);
        
        
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {   
        //create new post

        $post = [
            'title' => $request->title,
            'category_id' => $request->category,
            'content' => $this->handleContent($request->content, 'create', null)[0],
            'user_id' => Auth::user()->id,
            'status' => $request->status,
            'view' => 0
        ];

        $savePost = new Post($post);
        $savePost->save();

        //upload image
        $previewIamge = $this->uploadFile($request, 'previewImage', '/upload/image/post');
        $backgroundImage = $this->uploadFile($request, 'backgroundImage', '/upload/image/post');  

        Image::insert([
            'image' => $previewIamge,
            'post_id' => $savePost->id,
            'status' => 0,
        ]);
        if($backgroundImage){
            Image::insert([
                'image' => $backgroundImage,
                'post_id' => $savePost->id,
                'status' => 1,
            ]);
        }

        return redirect()->back()->with('status', 'Thêm bài viết thành công');
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
        $post = Post::join('users', 'posts.user_id', 'users.id')
                    ->where('posts.id', $id)
                    ->select('posts.*', 'users.name')
                    ->get()->first();
        // return $post;
        $previewImage = Image::where([['post_id', '=', $id], ['status', '=', 0]])->get()->first();
        $backgroundImage = Image::where([['post_id', '=', $id], ['status', '=', 1]])->get()->first();
        return view('admin.post.edit', [
            'categories' => $categories,
            'post' => $post,
            'previewImage' => $previewImage,
            'backgroundImage' => $backgroundImage
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $editPost = Post::findOrFail($id);
        $handle = $this->handleContent($request->content, 'update', null);
        $content = $handle[0];
        $arrayImage = $handle[1];
        //return $arrayImage;
        if(sizeof($arrayImage) > 0)
            $deleteImage = $this->handleContent($editPost->content, 'delete', $arrayImage);
        
        $post = [
            'title' => $request->title,
            'category_id' => $request->category,
            'content' => $content,
            'user_id' => Auth::user()->id,
            'status' => $request->status
        ];
        $editPost->update($post);
        
        if($request->hasFile('previewImage')){
            $image = Image::where('post_id', $id)->where('status', 0)->get()->first();
            $this->deleteFile(public_path().'/upload/image/post/'. $image->image);
            //
            $image->delete();
            //
            $previewIamge = $this->uploadFile($request, 'previewImage', '/upload/image/post');
            Image::insert([
                'image' => $previewIamge,
                'post_id' => $id,
                'status' => 0,
            ]);
        }
        if($request->hasFile('backgroundImage')){
            $image = Image::where('post_id', $id)->where('status', 1)->get()->first();
            if($image){
                $this->deleteFile(public_path().'/upload/image/post/'. $image->image);
                $image->delete();
            }
            $backgroundImage = $this->uploadFile($request, 'backgroundImage', '/upload/image/post');
            Image::insert([
                'image' => $backgroundImage,
                'post_id' => $id,
                'status' => 1,
            ]);
        } 

        return redirect()->back()->with('status', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteImages = Image::where('post_id', $id)->get();
        Image::where('post_id', $id)->delete();
        foreach($deleteImages as $deleteImage){
            $path = public_path().'/upload/image/post/'.$deleteImage->image;
            $this->deleteFile($path);
        }

        $deletePost = Post::findOrFail($id);

        $deleteContent = $this->handleContent($deletePost->content, 'delete', []);

        $deletePost->delete();  

        return redirect()->back()->with('status', 'Xóa bài viết thành công');
    }

    public function preview(Request $request){
        $respone = view('admin.post.preview')->render();
        return $respone;
        //return view('admin.post.preview');
    }

    private function base64_to_jpeg($base64_string, $output_file) {
        $ifp = fopen($output_file, 'wb' ); 
        $data = explode( ',', $base64_string );
        fwrite( $ifp, base64_decode( $data[ 1 ] ) );
        fclose( $ifp ); 
        return $output_file; 
    }

    private function uploadFile($request, $nameInputFile, $output_folder){
        if($request->hasFile($nameInputFile)){
            $file = $request[$nameInputFile];
            $file_ = $file->getClientOriginalName();
            $fileName = $this->genFileName($file_);
            if(!file_exists($fileName))
                $file->move(public_path($output_folder), $fileName);
            return $fileName;
        }
        return '';
    }

    private function deleteFile($path){
        if(file_exists($path)){
            unlink($path);
        }
    }

    private function genFileName($file){
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        return $filename . '_' . time() . '_' .uniqid(). '.' .$extension;
    }

    private function handleContent($html, $option, $array = []) {
        $dom = new \DOMDocument();
        $dom->loadHTML($html);

        $anchors = $dom -> getElementsByTagName('img');

        $arrayImage = [];

        foreach ($anchors as $element){  // upload all file image
            $file = $element->getAttribute('data-filename');
            if($file){
                if($option == 'create' || $option == 'update'){
                    if(!file_exists(public_path(). $file)){
                        $fileName = $this->genFileName($file);
                        $base64 = $element -> getAttribute('src');
                        if($base64){
                            $this->base64_to_jpeg($base64, public_path('upload/image/post/').$fileName);
                        }
                        $element->setAttribute('src', "/upload/image/post/$fileName");
                        $element->setAttribute('data-filename', "/upload/image/post/$fileName");
                        $arrayImage[] = $fileName;
                    }
                    else
                        $arrayImage[] = $file;
                }
                if($option == 'delete'){
                    if(sizeof($array) > 0 && !in_array($file, $array))
                        $this->deleteFile(public_path() . $file);
                }
            }
        }

        //get content post
        $html=$dom->saveHTML();
        $content = explode("<body>", $html);
        $content = explode("</body>", $content[1]);
        return [$content[0], $arrayImage];
    }
}

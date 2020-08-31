<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;
use App\Entity\{Banner};

use App\Http\Requests\{StoreBannerRequest, UpdateBannerRequest};

class BannerController extends Controller
{

    function __construct(){
        $this->middleware('permission:banner-list|banner-create|banner-edit|banner-delete', ['only' => 'index']);
        $this->middleware('permission:banner-create', ['only' => 'store']);
        $this->middleware('permission:banner-edit', ['only' => ['show', 'update']]);
        $this->middleware('permission:banner-delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listBanner = Banner::all();
        return view('admin.banner.list', compact('listBanner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBannerRequest $request)
    {
        $createBanner = new Banner;
        $createBanner->title = $request->title;
        $createBanner->link = $request->link;
        
        $fileName = $this->uploadFile($request, 'image', '/upload/image/banner');

        $createBanner->image = $fileName;

        $createBanner->save();

        return redirect()->back()->with('status', 'Thêm banner thành công');
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
        $editBanner = Banner::findOrFail($id);

        return view('admin.banner.edit', compact('editBanner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBannerRequest $request, $id)
    {
        $upadteBanner = Banner::findOrFail($id);

        $upadteBanner->title = $request->title;
        $upadteBanner->link = $request->link;

        $fileName = $this->uploadFile($request, 'image', '/upload/image/banner');

        if($fileName){
            $this->deleteFile(public_path().'/upload/image/banner/'.$upadteBanner->image);
            $upadteBanner->image = $fileName;
        }

        $upadteBanner->save();

        return redirect()->back()->with('status', 'Cập nhật banner thành công');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteBanner = Banner::findOrFail($id);

        $this->deleteFile(public_path(). '/upload/image/banner/'. $deleteBanner->image);

        $deleteBanner->delete();

        return redirect()->back()->with('status', 'Xóa banner thành công');
    }


    //


    private function genFileName($file){
        $filename = pathinfo($file, PATHINFO_FILENAME);
        $extension = pathinfo($file, PATHINFO_EXTENSION);
        return $filename . '_' . time() . '_' .uniqid(). '.' .$extension;
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
        return null;
    }


    private function deleteFile($path){
        if(file_exists($path)){
            unlink($path);
        }
    }
}

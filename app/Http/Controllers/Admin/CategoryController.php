<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Entity\Category;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\CreateCateRequest;

class CategoryController extends Controller
{
    function __construct(){
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => 'index']);
        $this->middleware('permission:category-create', ['only' => 'store']);
        $this->middleware('permission:category-edit', ['only' => ['show', 'update']]);
        $this->middleware('permission:category-delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCateRequest $request)
    {
        $cateData = [
            'title' => $request->input('title'),
            'status' => 0
        ];
        $category = new Category($cateData);
        $category->save();
        return redirect()->back()->with('status', 'Thêm mới thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $on = ($category->status == 1) ? 'selected' : '';
        $off = ($category->status == 0) ? 'selected' : '';

        return '<div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control"  placeholder="Enter name" value="'.$category->title.'" required>
                </div>
                <div class="form-group">
                    <label for="StatusCate">Status</label>
                    <select name="status" id="StatusCate" class="custom-select">
                        <option value="1" '.$on.'>On</option>
                        <option value="0" '.$off.'>Off</option>
                    </select>
                </div>';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCateRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->slug = null;
        $category->update([
            'title' => $request->title,
            'status' => $request->status
        ]);

        return '<div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5>
                        <i class="icon fas fa-check"></i>
                        Cập nhật thành công
                    </h5>
                </div>';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteCategory = Category::findOrFail($id);
        try{
            $deleteCategory->delete();
        } catch(\Exception $e){
            return redirect()->back()->withErrors(['Không thể xóa mục này']);;
        }
        return redirect()->back()->with('status', 'Xóa thành công');
    }
}

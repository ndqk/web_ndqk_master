@extends('admin.layout.master')

@section('titleHeader', 'Create product')
@section('nameRoute', 'Product / Create')


@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Thêm sản phẩm mới</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="create-post-form" role="form" method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
      @csrf
      <div class="card-body">
        <div class="form-group">
            <label for="InputName">Tên sản phẩm *</label>
            <input type="text" name="name" id="InputName" class="form-control" >
        </div>
        <div class="form-group">
            <label for="InputName">Số lượng *</label>
            <input type="text" name="quantity" id="InputName" class="form-control" >
        </div>
        <div class="form-group">
            <label for="InputName">Đơn giá *</label>
            <input type="text" name="price" id="InputName" class="form-control">
        </div>
        <div class="form-group">
            <label for="InputName">Giá khuyến mãi *</label>
            <input type="text" name="discount" id="InputName" class="form-control" >
        </div>
        <div class="form-group">
            <label for="InputCategory">Danh mục</label>
            <select name="category" id="InputCategory" class="custom-select">
                @foreach ($categories as $category)
                  <option value="{{$category->id}}" data-name="{{$category->title}}">{{$category->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="InputCategory">Sản phẩm dành cho</label>
            <select name="type" id="InputCategory" class="custom-select">
                <option value="1" >All</option>
                <option value="2" >Men</option>
                <option value="3" >Women</option>
                <option value="4" >Kids</option>
            </select>
        </div>
        <div class="form-group">
            <label for="inputPreImage">Ảnh sản phẩm*</label>
            <div class="input-group">
              <div class="custom-file">
                <input name="previewImage" type="file" class="custom-file-input" id="inputPreImage" >
                <label class="custom-file-label" for="inputPreImage">Choose file</label>
              </div>
              <div class="input-group-append">
                <span class="input-group-text" id="">Upload</span>
              </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputThumbImage">Thumbnail sản phẩm</label>
            <div class="input-group">
              <div class="custom-file">
                <input name="thumbImage[]" type="file" class="custom-file-input" id="inputThumbImage" multiple>
                <label class="custom-file-label" for="inputThumbImage">Choose file</label>
              </div>
              <div class="input-group-append">
                <span class="input-group-text" id="">Upload</span>
              </div>
            </div>
        </div>

        <div class="row form-group">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">
                            <strong>Mô tả sản phẩm</strong>
                        </h3>
                        <!-- tools box -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                            <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                                    title="Remove">
                            <i class="fas fa-times"></i></button>
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pad">
                        <div class="mb-3">
                            <textarea form="create-post-form" name="description" class="textarea" placeholder="Place some text here"
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <div class="form-group">
            <label for="InputStatus">Trạng thái</label>
            <select name="status" id="InputStatus" class="custom-select">
                <option value="0">Off</option>
                <option value="1">On</option>
            </select>
        </div>
        
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    
  </div>
@endsection

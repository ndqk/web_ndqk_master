@extends('admin.layout.master')

@section('titleHeader', 'Edit product')
@section('nameRoute', 'Product / Edit')


@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Chỉnh sửa sản phẩm</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="create-post-form" role="form" method="post" action="{{route('product.update', $editProduct->id)}}" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="card-body">
        <div class="form-group">
            <label for="InputName">Tên sản phẩm *</label>
            <input type="text" name="name" id="InputName" class="form-control" value="{{$editProduct->name}}">
        </div>
        <div class="form-group">
            <label for="InputName">Số lượng *</label>
            <input type="text" name="quantity" id="InputName" class="form-control" value="{{$editProduct->quantity}}">
        </div>
        <div class="form-group">
            <label for="InputName">Đơn giá *</label>
            <input type="text" name="price" id="InputName" class="form-control" value="{{$editProduct->price}}">
        </div>
        <div class="form-group">
            <label for="InputName">Giá khuyến mãi *</label>
            <input type="text" name="discount" id="InputName" class="form-control"  value="{{$editProduct->discount}}">
        </div>
        <div class="form-group">
            <label for="InputCategory">Danh mục</label>
            <select name="category" id="InputCategory" class="custom-select">
                @foreach ($categories as $category)
                  <option value="{{$category->id}}" data-name="{{$category->title}}" {{$category->id == $editProduct->category_id ? 'selected' : ''}}>{{$category->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="InputCategory">Sản phẩm dành cho</label>
            <select name="type" id="InputCategory" class="custom-select">
                <option value="1" {{$editProduct->type == 1 ? 'selected' : ''}}>All</option>
                <option value="2" {{$editProduct->type == 2 ? 'selected' : ''}}>Men</option>
                <option value="3" {{$editProduct->type == 3 ? 'selected' : ''}}>Women</option>
                <option value="4" {{$editProduct->type == 4 ? 'selected' : ''}}>Kids</option>
            </select>
        </div>

        <div class="form-group">
            <label>Cách kích cỡ của sản phẩm</label>
            @foreach ($size_products as $size)
              <div class="form-check">
                <input name="size[]" value="{{$size->id}}" class="form-check-input" type="checkbox"
                {{in_array($size->id, $attr_checked) ? 'checked' : ''}}>
                <label class="form-check-label">{{strtoupper($size->value)}}</label>
              </div>
            @endforeach
        </div>
        <div class="form-group">
            <label>Cách màu của sản phẩm</label>
            @foreach ($color_products as $color)
              <div class="form-check">
                <input name="color[]" value="{{$color->id}}" class="form-check-input" type="checkbox" 
                {{in_array($color->id, $attr_checked) ? 'checked' : ''}}>
                <label class="form-check-label">{{strtoupper($color->value)}}</label>
              </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="inputPreImage">Ảnh sản phẩm*</label>
            <img src="/upload/image/product/{{$previewImage->image}}" width="100" />
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
            <div>
                @if ($thumbImages)
                    @foreach ($thumbImages as $item)
                        <img src="/upload/image/product/{{$item->image}}" width="100" />
                    @endforeach
                @endif
            </div>
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
                                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                {{$editProduct->description}}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <div class="form-group">
            <label for="InputStatus">Trạng thái</label>
            <select name="status" id="InputStatus" class="custom-select">
                <option value="0" {{$editProduct->status == 0 ? 'selected' : ''}}>Off</option>
                <option value="1" {{$editProduct->status == 1 ? 'selected' : ''}}>On</option>
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

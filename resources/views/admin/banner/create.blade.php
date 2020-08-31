@extends('admin.layout.master')

@section('titleHeader', 'Create Banner')
@section('nameRoute', 'Banner / Create')

@section('content')

<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Create Banner</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form role="form" method="post" action="{{route('banner.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                    <label>Title*</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="title">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                    <label>Link*</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="link">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPreImage">Image*</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input name="image" type="file" class="custom-file-input" id="inputPreImage" >
                    <label class="custom-file-label" for="inputPreImage">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text" id="">Upload</span>
                  </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
  </div>    
@endsection
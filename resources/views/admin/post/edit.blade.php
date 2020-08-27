@extends('admin.layout.master')

@section('titleHeader', 'Edit product')
@section('nameRoute', 'Product / edit')

@section('css')
    <link rel="stylesheet" href="{{asset('site/css/preview.css')}}">
@endsection

@section('content')
@include('partials.alert')
<div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Chỉnh sửa bài viết</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form id="create-post-form" role="form" method="post" action="{{route('post.update', $post->id)}}" enctype="multipart/form-data">
        @method('PUT')
        @csrf
      
      <div class="card-body">
        <div class="form-group">
            <label for="InputName">Title *</label>
            <input type="text" name="title" id="InputName" class="form-control" placeholder="Title" value="{{$post->title}}" >
        </div>
        <div class="form-group">
            <label for="InputCategory">Category</label>
            <select name="category" id="InputCategory" class="custom-select">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}" data-name="{{$category->title}}" {{($post->category_id == $category->id) ? 'selected' : ''}}>{{$category->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="inputPreImage">Preview Image*</label>
            ({{$previewImage ? $previewImage->image : ''}})
            <div class="input-group">
              <div class="custom-file">
                <input name="previewImage" type="file" class="custom-file-input" id="inputPreImage">
                <label class="custom-file-label" for="inputPreImage">Choose file</label>
              </div>
              <div class="input-group-append">
                <span class="input-group-text" id="">Upload</span>
              </div>
            </div>
        </div>
        <div class="form-group">
            <label for="inputBackgroundImage">Background Image</label>
            ({{$backgroundImage ? $backgroundImage->image : ''}})
            <div class="input-group">
              <div class="custom-file">
                <input name="backgroundImage" type="file" class="custom-file-input" id="inputBackgroundImage" 
                onchange="document.getElementById('backgroundImage').src = window.URL.createObjectURL(this.files[0])">
                <label class="custom-file-label" for="inputBackgroundImage">Choose file</label>
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
                            <strong>Content</strong>
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
                            <textarea form="create-post-form" name="content" class="textarea" placeholder="Place some text here"
                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                  {{$post->content}}
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col-->
        </div>
        <div class="form-group">
            <label for="InputStatus">Status</label>
            <select name="status" id="InputStatus" class="custom-select">
                <option value="0" {{$post->status == 0 ? 'selected' : '' }}>Off</option>
                <option value="1" {{$post->status == 1 ? 'selected' : '' }}>On</option>
            </select>
        </div>
        
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <a class="btn btn-primary preview-post" data-toggle="modal" data-target="#modal-xl">
            Perview
        </a>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    
  </div>

  {{-- MODEL FREVIEW --}}
  <div class="modal fade" id="modal-xl">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">PREVIEW</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="alert-edit-role">

            </div>
            <div class="modal-body" id="modal-content-body">
                
                
                        <section class="s-content s-content--top-padding s-content--narrow">

                            <article class="row entry format-standard">
                    
                                <div class="entry__media col-full">
                                    <div class="entry__post-thumb">
                                        <img id="backgroundImage" src="{{$backgroundImage ? '/upload/image/post/'.$backgroundImage->image : ''}}" 
                                            width="100%" sizes="(max-width: 2000px) 100vw, 2000px" alt="">
                                    </div>
                                </div>
                    
                                <div class="entry__header col-full">
                                    <h1 class="entry__header-title display-1">
                                        {{$post->title}}
                                    </h1>
                                    <ul class="entry__header-meta">
                                        <li class="date">{{$post->created_at}}</li>
                                        <li class="byline">
                                            By
                                            <a href="{{asset('site/#0')}}">{{$post->name}}</a>
                                        </li>
                                    </ul>
                                </div>
                    
                                <div class="col-full entry__main">
                                    <div class="entry_content" style="width: 100%">
                                        
                                    </div>
                    
                                </div> <!-- s-entry__main -->
                    
                            </article> <!-- end entry/article -->
                    
                    
                        </section>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                {{-- <button type="submit" class="btn btn-primary" id="save-change">Save changes</button> --}}
            </div>
        <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endsection


@push('script')
    <script type="text/javascript">
        $(function(){
            $('.preview-post').click(function(){
                let title = $("input[name='title']").val();
                let content = $("textarea[name='content']").val();
                let utc = new Date().toJSON().slice(0,10).replace(/-/g,'-');
                $('.entry__header-title').html(title);
                $('.date').html(utc);
                $('.entry_content').html(content);
            });
        });
    </script>
@endpush
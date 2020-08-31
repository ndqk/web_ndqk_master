@extends('admin.layout.master')

@section('titleHeader', 'List Category')
@section('nameRoute', 'Category')

@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-7">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">List category</h3>
                </div>
                <div class="card-body">
                    <ul class="tree-view">
                        @if (sizeof($categories))
                            @foreach ($categories as $category)
                                <li >
                                    <span>{{$category->title}}</span>
                                    &ensp;
                                    <a href="" data-toggle="modal" data-target="#modal-default" class="category-edit" data-link="{{route('category.show', $category->id)}}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="{{route('category.delete', $category->id)}}" data-method="DELETE">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <a href="">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <p>Không có danh mục nào</p>
                        @endif
                    </ul>
                </div>  
            </div>
        </div>
        <div class="col-md-5">
            
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Create new category</h3>
                </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                <form role="form" method="post" action="{{route('category.store')}}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputPassword1">Title *</label>
                            <input type="text" name="title" class="form-control"  placeholder="Enter title" value="">
                        </div>
                    </div>
  
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
      
      </div>
    <!-- /.row (main row) -->
    <div class="modal fade" id="modal-default">
        <div class="modal-dialog ">
            <form class="modal-content" method="post" action="" id="form-edit">
                @method('PUT')
                @csrf
                
                <div class="modal-header">
                    <h4 class="modal-title">DETAIL</h4>
                    <button type="button" class="close ndqk-closde-modal" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="alert-edit">

                </div>
                <div class="modal-body" id="modal-content-body">
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal" class="ndqk-closde-modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="save-change">Save changes</button>
                </div>
            <!-- /.modal-content -->
            </form>
        <!-- /.modal-dialog -->
        </div>
    <!-- /.modal -->
    <div>
  </div><!-- /.container-fluid -->
@endsection

@push('script')
    <script type="text/javascript">
        $(function(){
            $('.ndqk-closde-modal').click(function(){
                location.reload();
            });
            $('.category-edit').click(function(){
                let url = $(this).data('link');
                $.ajax({
                    type: 'GET',
                    url : url,
                    success : function(respone){
                        $('#modal-content-body').html(respone);
                        $('#form-edit').attr('action', url);
                    }
                });
            });
            $('#save-change').click(function(){
                let url = $('#form-edit').attr('action');
                let data = $('#form-edit').serialize();
                $.ajax({
                    type: 'PUT',
                    url : url,
                    data : data,
                    success: function(respone){
                        $('#alert-edit').html(respone);
                    }
                });
                return false;
            });
        });
    </script>    
@endpush
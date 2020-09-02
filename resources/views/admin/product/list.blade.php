@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    
@endsection

@section('titleHeader', 'List Post')
@section('nameRoute', 'Post')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Danh sách tài khoản quản trị</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="user" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Author</th>
                            <th>View</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
@endsection

@push('script')
    <script type="text/javascript">
        $(function(){
            $('#user').DataTable({
                serverSide: true,
                pageLength: 10,
                ajax : {
                    url : '{{ route('post.list') }}',
                    type : 'GET',
                },
                columns : [
                    {data : 'id', name : 'id'},
                    {data : 'title', name : 'title'},
                    {data : 'category', name : 'categories.title'},
                    {data : 'image', render : function(data){
                        return '<img src="/upload/image/post/'+data+'" width="100" />';
                    },  name : 'images.image'},
                    {data : 'name', name : 'users.name'},
                    {data : 'view', name : 'view'},
                    {data : 'status', name : 'status'},
                    {data : 'action', name : 'action', orderable : false, searchable:true},
                ],
            });
        })
    </script>
@endpush
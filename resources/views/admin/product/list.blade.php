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
                            <th>Tên sản phẩm</th>
                            <th>Danh mục</th>
                            <th>Ảnh sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Giá khuyến mãi</th>
                            <th>Dành cho</th>
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
                    url : '{{ route('product.list') }}',
                    type : 'GET',
                },
                columns : [
                    {data : 'id', name : 'products.id'},
                    {data : 'name', name : 'name'},
                    {data : 'title', name : 'categories.title'},
                    {data : 'image', render : function(data){
                        return '<img src="/upload/image/product/'+data+'" width="100" />';
                    },  name : 'image_products.image'},
                    {data : 'quantity', name : 'quantity'},
                    {data : 'price', name : 'price'},
                    {data : 'discount', name : 'discount'},
                    {data : 'type', render(data){
                        switch(data){
                            case 1: 
                                return 'All';
                            case 2: 
                                return 'Men';
                            case 3: 
                                return 'Women';
                            case 4: 
                                return 'Kids';
                            default: return 'All';
                        }
                    },name : 'type'},
                    {data : 'status', name : 'status'},
                    {data : 'action', name : 'action', orderable : false, searchable:true},
                ],
            });
        })
    </script>
@endpush
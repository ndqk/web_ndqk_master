@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    
@endsection

@section('titleHeader', 'List User')
@section('nameRoute', 'List User')

@section('content')
@include('partials.alert')
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
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Role</th>
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
                pageLength: 6,
                ajax : {
                    url : '{{ route('user.get.list') }}',
                    type : 'GET',
                },
                columns : [
                    {data : 'id', name : 'id'},
                    {data : 'name', name : 'name'},
                    {data : 'email', name : 'email'},
                    {data : 'address', name : 'address'},
                    {data : 'phone', name : 'phone'},
                    {data : 'role', name : 'role'},
                    {data : 'action', name : 'action', orderable : false, searchable:true},
                ],
            });
        })
    </script>
@endpush
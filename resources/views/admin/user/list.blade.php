@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    
@endsection

@section('titleHeader', 'List User')
@section('nameRoute', 'User')

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

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <form class="modal-content" action="" method="post" id="form-edit">
            @csrf
            <div class="modal-header">
                <h4 class="modal-title">PERMISSION</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-content-body">
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="save-change">Save changes</button>
            </div>
        <!-- /.modal-content -->
        </form>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
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
                    url : '{{ route('user.list') }}',
                    type : 'GET',
                },
                columns : [
                    {data : 'id', name : 'id'},
                    {data : 'name', name : 'name'},
                    {data : 'email', name : 'email'},
                    {data : 'address', name : 'address'},
                    {data : 'phone', name : 'phone'},
                    {data : 'role', name : 'roles.name'},
                    {data : 'action', name : 'action', orderable : false, searchable:true},
                ],
            });
            $('#user').on('click', '.edit-user-permission-btn', function(){
                let url = $(this).data('link');
                let userId = $(this).data('id');
                $.ajax({
                    type : 'GET',
                    url : url,
                    success : function(respone){
                        $('#modal-content-body').html(respone);
                        //console.log(respone);
                        $('#form-edit').attr('action', `/admin/user/permission/update/${userId}`);
                    },
                    error : function(error){

                    }
                });
            });
            $('#save-change').click(function(){
                let url = $('#form-edit').attr('action');
                let data = $('#form-edit').serialize()
                
                $.ajax({
                    type : 'POST',
                    url : url,
                    data : data,
                    success : function (respone){
                        toastr.options.timeOut = 2000;
                        toastr.options.closeButton = true;
                        toastr.success(respone);
                        //console.log(respone);
                    },
                    error : function(error){

                    }
                })
                return false;

            });
        })
    </script>
@endpush
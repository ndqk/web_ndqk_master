@extends('admin.layout.master')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    
@endsection

@section('titleHeader', 'To do List')
@section('nameRoute', 'To-do-list')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">To do List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="user" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Deadline</th>
                            <th>User</th>
                            <th style="width: 15%">Action</th>
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
                    url : '{{ route('todo-list.list') }}',
                    type : 'GET',
                },
                columns : [
                    {data : 'id', name : 'id'},
                    {data : 'title', name : 'title'},
                    {data : 'deadline', name : 'dealine'},
                    {data : 'users',render: function(data){
                      let res = '';
              
                      data.forEach(user => {
                        res += user.user.name + ' / ';
                      });

                      return res;
                    }, name : 'users'},
                    {data : 'action', name : 'action', orderable : false, searchable:true},
                ],
            });
        })
    </script>
@endpush
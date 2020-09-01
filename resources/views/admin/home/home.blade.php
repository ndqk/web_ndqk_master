@extends('admin.layout.master')

@section('titleHeader', 'Dashboard')
@section('nameRoute', 'Dashboard v1')

@section('content')
<div class="container-fluid">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{$countPost ? $countPost : 0}}</h3>

          <p>Posts</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="{{route('post.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>53<sup style="font-size: 20px">%</sup></h3>

          <p>Bounce Rate</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="{{asset('#')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
          <h3>{{$countCustomer ? $countCustomer : 0}}</h3>

          <p>User Registrations</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="{{route('customer.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>65</h3>

          <p>Unique Visitors</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="{{asset('#')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->
  <!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <section class="col-lg-7 connectedSortable">
      <!-- TO DO List -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="ion ion-clipboard mr-1"></i>
            To Do List
          </h3>
          
          <div class="card-tools">
            {{$todoList->links()}}
          </div>
        </div>
        
        <!-- /.card-header -->
        <div class="card-body">
          <ul class="todo-list" data-widget="todo-list">
            @if ($todoList)
                @php
                    $currentDate = date('Y-m-d H:i:s');
                @endphp
                @foreach ($todoList as $item)
                  <li class="{{$item->deadline < $currentDate ? 'done' : ''}}">
                    <!-- drag handle -->
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>

                    <!-- checkbox -->
                    <div class="icheck-primary d-inline ml-2">
                      <input type="checkbox" value="{{$item->id}}" name="todo[]" class="todos" id="todoCheck{{$item->id}}" {{$item->status ? 'checked' : ''}}
                      {{$item->deadline < $currentDate ? 'disabled' : ''}}
                      >
                      <label for="todoCheck{{$item->id}}"></label>
                    </div>
                    <!-- todo text -->
                    <label for="todoCheck{{$item->id}}" class="text">{{$item->title}}</label>
                    
                    <!-- Emphasis label -->
                    @if ($item->deadline > $currentDate)
                      <small class="badge badge-{{$item->time_remain->style}}">
                        <i class="far fa-clock"> </i>
                        {{$item->time_remain->time .' '. $item->time_remain->ext}}
                      </small>
                      <span id="{{$item->id}}">{{$item->status ? 'Approving ... ' : ''}}</span>
                    @else
                      <span>( Out of date: {{$item->time_remain->time . ' ' . $item->time_remain->ext}})</span>
                    @endif
                    <!-- General tools such as edit or delete-->

                    <div class="tools">

                      @can('todo-detail')
                        <a href="{{route('todo-list.show', $item->id)}}" target="_blank"><i class="fas fa-info-circle"></i></a>
                      @endcan
                      &nbsp;
                      @can('todo-edit')
                        <a href="{{route('todo-list.edit', $item->id)}}"><i class="fas fa-edit"></i></a>
                      @endcan
                      &nbsp;
                      @can('todo-delete')
                        <a href="{{route('todo-list.delete', $item->id)}}"><i class="fas fa-trash"></i></a>
                      @endcan
                      
                    </div>
                  </li>
                @endforeach
            @endif
          </ul>
        </div>
        <!-- /.card-body -->
        
        @can('todo-create')
          <div class="card-footer clearfix">
            <a href="{{route('todo-list.create')}}" class="btn btn-info float-right"><i class="fas fa-plus"></i> Add item</a>
          </div>
        @endcan
      </div>
      <!-- /.card -->
    </section>
    <!-- /.Left col -->


    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    {{-- <section class="col-lg-5 connectedSortable">

      <!-- Map card -->
      <div class="card bg-gradient-primary">
        <div class="card-header border-0">
          <h3 class="card-title">
            <i class="fas fa-map-marker-alt mr-1"></i>
            Visitors
          </h3>
          <!-- card tools -->
          <div class="card-tools">
            <button type="button"
                    class="btn btn-primary btn-sm daterange"
                    data-toggle="tooltip"
                    title="Date range">
              <i class="far fa-calendar-alt"></i>
            </button>
            <button type="button"
                    class="btn btn-primary btn-sm"
                    data-card-widget="collapse"
                    data-toggle="tooltip"
                    title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
          <!-- /.card-tools -->
        </div>
        <div class="card-body">
          <div id="world-map" style="height: 250px; width: 100%;"></div>
        </div>
        <!-- /.card-body-->
        <div class="card-footer bg-transparent">
          <div class="row">
            <div class="col-4 text-center">
              <div id="sparkline-1"></div>
              <div class="text-white">Visitors</div>
            </div>
            <!-- ./col -->
            <div class="col-4 text-center">
              <div id="sparkline-2"></div>
              <div class="text-white">Online</div>
            </div>
            <!-- ./col -->
            <div class="col-4 text-center">
              <div id="sparkline-3"></div>
              <div class="text-white">Sales</div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div>
      </div>
      <!-- /.card -->

      <!-- Calendar -->
      <div class="card bg-gradient-success">
        <div class="card-header border-0">

          <h3 class="card-title">
            <i class="far fa-calendar-alt"></i>
            Calendar
          </h3>
          <!-- tools card -->
          <div class="card-tools">
            <!-- button with a dropdown -->
            <div class="btn-group">
              <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                <i class="fas fa-bars"></i></button>
              <div class="dropdown-menu float-right" role="menu">
                <a href="{{asset('#')}}" class="dropdown-item">Add new event</a>
                <a href="{{asset('#')}}" class="dropdown-item">Clear events</a>
                <div class="dropdown-divider"></div>
                <a href="{{asset('#')}}" class="dropdown-item">View calendar</a>
              </div>
            </div>
            <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pt-0">
          <!--The calendar -->
          <div id="calendar" style="width: 100%"></div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </section> --}}
    <!-- right col -->
  </div>
  <!-- /.row (main row) -->
</div><!-- /.container-fluid -->
@endsection

@push('script')
<script type="text/javascript">
  $(function(){
      $('.todos').click(function(){
        let id = $(this).val();
        let url = '/admin/todo-list/approve/send-request/' + id;
        $.ajax({
          type: 'GET',
          url: url,
          headers: {
            'X-CSRF-Token': '{{ csrf_token() }}',
          },
          success: function(data){
            $('#' + id).html(data);
          }
        });
      });
  });
</script>
@endpush
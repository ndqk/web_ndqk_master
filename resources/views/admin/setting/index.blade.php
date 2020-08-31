@extends('admin.layout.master')

@section('titleHeader', 'Setting')
@section('nameRoute', 'Setting')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="card-body">
            <div class="row">
                <div class="col-5 col-sm-3">
                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                        <a onclick="addUrl('tab=general')" class="nav-link {{$tab == 'general' ? 'active' : ''}}" id="vert-tabs-profile-tab" data-toggle="pill" href="#general" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">
                            <i class="fas fa-cog"></i>  Chung
                        </a>
                        <a onclick="addUrl('tab=security')" class="nav-link {{$tab == 'security' ? 'active' : ''}}" id="vert-tabs-home-tab" data-toggle="pill" href="#security" role="tab" aria-controls="vert-tabs-home" aria-selected="true">
                            <i class="fas fa-shield-alt"></i>  Bảo mật và đăng nhập
                        </a>
                    </div>
                </div>
                <div class="col-7 col-sm-9">
                    <div class="tab-content" id="vert-tabs-tabContent">
                        <div class="tab-pane fade {{$tab == 'general' ? 'show active' : ''}}" id="general" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                            @include('admin.setting.account')
                        </div>
                        <div class="tab-pane text-left fade {{$tab == 'security' ? 'show active' : ''}}" id="security" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                            @include('admin.setting.security')
                        </div>
                    </div>
                </div>
            </div>
        </div>       
    </div>
  
</div>
@endsection

@push('script')
    <script>
        var addUrl = (url) => {
            window.location = '{{route('setting.index')}}' + '?' + url;
        }
    </script>
@endpush
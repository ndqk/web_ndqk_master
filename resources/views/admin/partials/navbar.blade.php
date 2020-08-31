<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="{{asset('#')}}" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{route('admin.home')}}" class="nav-link">Home</a>
    </li>
  </ul>

  {{-- <!-- SEARCH FORM -->
  <form class="form-inline ml-3">
    <div class="input-group input-group-sm">
      <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-navbar" type="submit">
          <i class="fas fa-search"></i>
        </button>
      </div>
    </div>
  </form> --}}

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
  
    <!-- Notifications Dropdown Menu -->
    @php
        $notifications = Auth::user()->notifications->sortByDesc('created_at');
        $unreadNotifications = Auth::user()->unreadNotifications->count();
    @endphp
    <li class="nav-item dropdown">
      <audio id="notification-sound" src="{{asset('upload/audio/alert/alertFacebook.mp3')}}" preload="auto"></audio>
      <a id="notification-button" class="nav-link" data-toggle="dropdown" href="{{asset('#')}}">
        <i class="far fa-bell"></i>
        @if ($unreadNotifications)
          <span id="notification-badge" class="badge badge-danger navbar-badge badge-pill">
                {{$unreadNotifications}}
          </span>
        @else
        <span id="notification-badge" class="badge badge-danger navbar-badge badge-pill"></span>
        @endif
      </a>
    
      <div id="notification-content" class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span id="notification-header" class="dropdown-item dropdown-header">
          @if ($notifications->count())
              @if ($notifications->count() - 1)
                  {{$notifications->count()." Notifications"}}
              @else
                  {{$notifications->count() . " Notification"}}
              @endif
          @else
              Don't have any notifications
          @endif
        </span>
        
        <div id="notification-list">
        </div>

        @if ($notifications->count() > 5)
          <a id="notification-more" href="{{asset('#')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
        @else
        <a id="notification-close" href="{{asset('#')}}" class="dropdown-item dropdown-footer">Close</a>
        @endif
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-user-circle"></i>

      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <div class="dropdown-divider"></div>
        <a href="{{route('profile.index')}}" class="dropdown-item">
          <i class="fas fa-user mr-2"></i> Profile
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{route('setting.index')}}" class="dropdown-item" id="setting">
          <i class="fas fa-cog mr-2"></i> Setting
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{route('admin.logout')}}" class="dropdown-item">
          <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
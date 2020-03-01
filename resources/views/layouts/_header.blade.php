<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top">
  <div class="container">
    <!-- Branding Image -->
    <a class="navbar-brand " href="{{ url('/') }}">
      LaraBBS
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left Side Of Navbar -->
      <ul class="navbar-nav mr-auto">
        <li class="nav-item @if(request()->url()==route('topics.index')) active @endif"><a href="{{route('topics.index')}}" class="nav-link">所有话题</a></li>

          @if (count(\App\Models\Category::all()))
             @foreach (\App\Models\Category::all() as $category)
                <li class="nav-item @if(request()->url()===route('categories.show',$category->id)) active @endif ">
                  <a href="{{route('categories.show',$category->id)}}" class="nav-link">{{$category->name}}</a>
                </li>
             @endforeach
          @endif

      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav navbar-right">
        @guest
        <!-- Authentication Links -->
        <li class="nav-item"><a class="nav-link" href="{{route('login')}}">登录</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('register')}}">注册</a></li>
        @else
         <li class="nav-item">
          <a href="{{route('topics.create')}}" class="nav-link mt-1 mr-2">
              <i class="fa fa-plus"></i>
            </a>
         </li>
         <li class="nav-item notification-badge">
         <a href="{{route('notifications.index')}}"
         class="nav-link badge mr-3 badge-pill badge-{{Auth::user()->notification_count > 0 ? 'hint': 'secondary'}} text-white">
              {{Auth::user()->notification_count}}
            </a>
         </li>

         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
         <img src="{{Auth::user()->avatar}}"
            class="img-responsive img-circle" width="30px" height="30px">
            {{Auth::user()->name}}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">

            @can('manage_contents', Auth::user())
            <a href="{{ url(config('administrator.uri')) }}" class="dropdown-item"><i class="fas fa-tachometer-alt mr-2"></i>管理后台</a>
            @endcan

            <a href="{{route('users.show',Auth::id())}}" class="dropdown-item"><i class="fa fa-user mr-2"></i>个人中心</a>
            <a href="{{route('users.edit',Auth::id())}}" class="dropdown-item"><i class="fa fa-edit mr-2"></i>编辑资料</a>
            <div class="dropdown-divider"></div>
            <a href="" class="dropdown-item">
           {!! Form::open(['route'=>'logout','method'=>'post']) !!}
              <button class="btn btn-danger btn-block " type="submit">退出</button>
           {!! Form::close() !!}
            </a>
         </div>
        </li>
        @endguest

      </ul>
    </div>
  </div>
</nav>

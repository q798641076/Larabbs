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

      </ul>

      <!-- Right Side Of Navbar -->
      <ul class="navbar-nav navbar-right">
        @guest
        <!-- Authentication Links -->
        <li class="nav-item"><a class="nav-link" href="{{route('login')}}">登录</a></li>
        <li class="nav-item"><a class="nav-link" href="{{route('register')}}">注册</a></li>
        @else
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
         <img src="{{Auth::user()->avatar}}"
            class="img-responsive img-circle" width="30px" height="30px">
            {{Auth::user()->name}}
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a href="{{route('users.show',Auth::id())}}" class="dropdown-item">个人中心</a>
            <a href="{{route('users.edit',Auth::id())}}" class="dropdown-item">编辑资料</a>
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
<!DOCTYPE html>
{{-- 获取config app.php里的locale --}}
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  {{-- csrf-token 标签是为了方便前端的 JavaScript 脚本获取 CSRF 令牌。 --}}
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', 'LaraBBS') - Laravel 进阶教程</title>
  <meta name="description" content="@yield('description','Larabbs站点社区')">
  <!-- Styles -->
  {{-- 根据 webpack.mix.js 的逻辑来生成 CSS 文件链接。 --}}
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  {{-- 加载文本编辑器 --}}
   @yield('style')
</head>

<body>

<div id="app" class="{{ route_class() }}">

    @include('layouts._header')

    <div class="container" style="margin-bottom:100px">

       @include('shared._messages')

       @yield('content')

    </div>

    @include('layouts._footer')

</div>

 <!-- Scripts -->
 <script src="{{ mix('js/app.js') }}"></script>
  {{-- 加载文本编辑器 --}}
 @yield('script')
<script>
  $(document).ready(function(){
    setInterval(function(){
      $('.flash-message').slideUp();
    }, 3000);
  })
</script>
</body>

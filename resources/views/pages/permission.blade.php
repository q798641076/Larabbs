@extends('layouts.app')

@section('title','权限不足')

@section('content')

  <div class="container col-md-4 offset-md-4">
    <div class="card">
      @if (Auth::check())
       <div class="card-body">
          <div class="alert alert-danger">您的权限不足</div>
       </div>
      @else
      <div class="card-body">
      <div class="alert alert-primary">
                请先登录
              </div>

            <a href="{{config('app.url').'/login'}}" class="btn btn-success btn-block btn-lg">
              <i class="fas fa-sign-in-alt"></i>登录</a>
      </div>

      @endif
    </div>
  </div>

@endsection

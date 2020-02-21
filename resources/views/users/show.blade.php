@extends('layouts.app')

@section('title','个人中心')

@section('content')

<div class="container">
<div class="row">

  <div class="col-lg-3 col-md-3 col-sm-3">
    <div class="card">

        <img class="card-img-top" src="https://cdn.learnku.com/uploads/images/201709/20/1/PtDKbASVcz.png?imageView2/1/w/600/h/600"  alt="{{$user->name}}">
         <div class="card-body">
        <h5><strong>个人简介：</strong></h5>
         <p>{{$user->introduction}}</p>
         <hr>
         <h5>创建时间：</h5>
       <p>{{$user->created_at->diffForHumans()}}</p>
      </div>
    </div>
  </div>

  <div class="col-lg-9 col-md-9 col-sm-9">
    <div class="card">
      <div class="card-body">
        <h3 class="mb-0">{{$user->name}} &nbsp;<small>{{$user->email}}</small></h3>
      </div>
    </div>
<hr>
    <div class="card">
      <div class="card-body">
       <strong>暂无发布信息/(ㄒoㄒ)/~</strong>
      </div>
    </div>
  </div>


 </div>
</div>

@endsection

@extends('layouts.app')

@section('title',isset($category)?$category->name:'所有话题')

@section('content')
<div class="container">
  <div class="row">
   <div class="col-lg-9 col-md-9 col-xs-9">

      @if (isset($category))
            <div class="alert alert-info" role="alert">
                {{$category->name}}&nbsp;:&nbsp;{{$category->description}}
            </div>
       @endif

         <div class="card">
           <div class="card-header bg-transparent">
             <ul class="nav nav-pills ">
              <li class="nav-item">
                <a href="{{Request::url()}}?order=recentReplied"
                class="nav-link ">最后回复</a>
               </li>
                <li class="nav-item ">
                <a href="{{Request::url()}}?order=recent"
                class="nav-link ">最新发布</a>
               </li>
             </ul>
           </div>

           <div class="card-body">
             {{-- 话题列表 --}}
              @include('topics._topic_list',['topics'=>$topics])
              {{-- 分页列表 --}}
              <div class="mt-lg-5 mt-md-5">
                {{-- 他将获取到路由的所有参数，除了page以外 --}}
                {{$topics->appends(Request::except('page'))->render()}}
              </div>
           </div>
         </div>
   </div>

   <div class="col-lg-3 col-md-3 col-xs-3 sidebar">
     @include('topics._topic_sidebar',['topics'=>$topics])
   </div>
</div>
</div>
@endsection

@extends('layouts.app')
@section('title','消息通知')

@section('content')

  <div class="container col-md-10 offset-md-1">
      <div class="card ">
          <div class="card-header">
            <h5 class="text-xs-center">
              <i class="fa fa-bell mr-2"></i>我的通知
            </h5>
          </div>

          <div class="card-body">

            @if (count($notifications))

            <div class="list-unstyled notification-list">
              @foreach ($notifications as $notification)
              {{--
                $notification->type获取的是App\Notifications\TopicReplied
                而class_basename会将获取的转化为TopicReplied
                然后Str::snake会将它变成topic_replied
                --}}
                  @include('notifications.type._'.Str::snake(class_basename($notification->type)))
              @endforeach

            </div>
            @else
             <div class="empty-block">暂无消息(ˉ▽ˉ；)...</div>
            @endif

          </div>

          <div class="ml-4">
            {{$notifications->render()}}
          </div>

      </div>

  </div>

@endsection

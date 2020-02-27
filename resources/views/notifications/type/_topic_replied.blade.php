<li class="media @if(!$loop->last) border-bottom @endif mb-3">

    <div class="media-left">
        <a href="{{route('users.show',$notification->data['user_id'])}}" alt="{{$notification->data['user_name']}}" class="mr-3">
          <img src="{{$notification->data['user_avatar']}}" alt="{{$notification->data['user_name']}}" width="50px" height="50px"
          style="padding:2px;border: 1px solid #d8d8d8">
        </a>
    </div>

    <div class="media-body">
      <div class="media-heading mb-1 mt-0">
        <a href="{{route('users.show',$notification->data['user_id'])}}">
          {{$notification->data['user_name']}}
      </a>
      <span class="text-secondary">评论了</span>
      <a href="{{$notification->data['topic_link']}}">
        {{$notification->data['topic_title']}}
      </a>
      <span class="float-right text-secondary" title="{{$notification->created_at}}" >
        <i class="far fa-clock mr-1"></i>
        {{$notification->created_at->diffForHumans()}}
      </span>
      </div>

      <div class="reply-content">
          {!! $notification->data['reply_content'] !!}
      </div>
    </div>

</li>

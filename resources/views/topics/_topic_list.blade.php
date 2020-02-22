



@if (count($topics)>0)

   @foreach ($topics as $topic)

     <ul class="list-unstyled">
       <li class="media">
         <div class="media-left">
          <a href="{{route('users.show',$topic->user->id)}}">
           <img class="mr-3 media-object" src="{{$topic->user->avatar}}" alt="{{$topic->user->name}}" width="45px" height="45px" style="padding:2px;border: 1px solid #d8d8d8">
          </a>
         </div>

    <div class="media-body">
         <div class="media-heading mb-1" >
          <a href="{{route('topics.show',$topic->id)}}" >
            {{$topic->title}}
          </a>
        <span class="badge badge-secondary float-right badege-pill" style="background:#d8d8d8;">{{$topic->reply_count}}</span>
         </div>

          <small class="meta" >
          <a href="" class='text-secondary'>
              <i class="fa fa-folder"></i>
              {{$topic->category->name}}
              <span>•</span>
          </a>

          <a href="{{route('users.show',$topic->user->id)}}"  class='text-secondary'>
            <i class="fa fa-user"></i>{{$topic->user->name}}
          </a>
          <span>•</span>

          <a href="#" class='text-secondary'>
              <i class="fa fa-clock"></i>{{$topic->updated_at->diffForHumans()}}
          </a>
          </small>
    </div>
       </li>
     </ul>

        @if (!$loop->last)
          <hr>
        @endif

   @endforeach

   @else
    <div class="empty-block">暂无数据/(ㄒoㄒ)/~~</div>
@endif

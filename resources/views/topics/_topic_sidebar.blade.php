<div class="card">
  <div class="card-body">
  <a class="btn btn-block btn-success" href="{{route('topics.create')}}">
       <i class="fa fa-edit">
         新建帖子
       </i>
     </a>
  </div>
</div>

@if (count($active_users))
    <div class="card active_user mt-4">
        <div class="card-body">
          <h5 class='text-center text-secondary'>活跃用户</h5>
          <hr>
          @foreach ($active_users as $active_user)
           <div class="media mt-2">
              <div class="media-left media-middle mr-2 ml-1">
                 <img src="{{$active_user->avatar}}" alt="" class="img-thumbnail media-object" width="40px">
              </div>
              <div class='media-body mt-2'>
                  <a href="{{route('users.show',$active_user->id)}}" class="text-secondary ">
                  {{$active_user->name}}
                  @if ($loop->first)
                    <small class="badge-success badge-pill">最佳</small>
                  @endif
                  </a>

             </div>
           </div>
         @endforeach

        </div>
    </div>
@endif


@if (count($active_links))

    <div class="card mt-4 active_links" >
       <div class="card-body">
         <h5 class="text-center text-secondary">
          资源推荐
         </h5>
         <hr>
         @foreach ($active_links as $active_link)

         <div class="mb-2 pl-2">
           <a href="{{$active_link->link}}" class="text-info">{{$active_link->title}}</a>
         </div>

         @endforeach
       </div>
    </div>

@endif


<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#topics" role="tab" aria-controls="topics" aria-selected="true">ta的话题</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#replies" role="tab" aria-controls="replies" aria-selected="false">ta的回复</a>
  </li>

</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="topics" role="tabpanel" aria-labelledby="topics-tab">

     <ul class="list-group mt-lg-2 mb-lg-3">

      @foreach ($topics as $topic)
          <li class="list-group-item border-left-0 border-right-0 mt-lg-2  pl-1 pr-1 @if($loop->first) border-top-0 @endif">
          <a href="{{$topic->link()}}" >{{$topic->title}}</a>
           <small class="float-right text-secondary">
              {{count($topic->reply)}}&nbsp;回复
              <span>•</span>
              {{$topic->created_at->diffForHumans()}}
           </small>
          </li>
      @endforeach

     </ul>
{{$topics->render()}}
  </div>
  <div class="tab-pane fade" id="replies" role="tabpanel" aria-labelledby="replies-tab">

    <ul class="list-group mt-lg-2 mb-lg-3">

      @foreach ($replies as $reply)
        <li class="list-group-item border-right-0 border-left-0 pl-1 pr-1 mt-2 @if($loop->first) border-top-0 @endif">
        <a href="{{$reply->topic->link(['#reply'.$reply->id])}}" >{{$reply->topic->title}}</a>
        <small class="text-secondary float-right">
          {{$reply->topic->reply_count}}&nbsp;回复
          <span>•</span>
          {{$reply->topic->created_at->diffForHumans()}}
        </small>
        </li>
      @endforeach

    </ul>
    <div class="ml-2">
       {{$replies->render()}}
      </div>

  </div>

</div>

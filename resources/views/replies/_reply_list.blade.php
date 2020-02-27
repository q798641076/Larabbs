
<ul class="list-unstyled">

  @foreach ($replies as $reply)
    <li class="media p-3" name="reply{{ $reply->id }}" id="reply{{ $reply->id }}" >
      <div class="media-left">
        <a href="{{ route('users.show', [$reply->user_id]) }}">
          <img class="media-object img-thumbnail mr-3" alt="{{ $reply->user->name }}" src="{{ $reply->user->avatar }}" style="width:48px;height:48px;" />
        </a>
      </div>

      <div class="media-body">
        <div class="media-heading mt-0 mb-1 text-secondary">
          <a href="{{ route('users.show', [$reply->user_id]) }}" title="{{ $reply->user->name }}">
            {{ $reply->user->name }}
          </a>
          <span class="text-secondary"> • </span>
          <span class=" text-secondary" title="{{ $reply->created_at }}">{{ $reply->created_at->diffForHumans() }}</span>

          {{-- 回复删除按钮 --}}
          @can('destroy', $reply)
            <span class=" float-right mr-2">
              {!! Form::open(['route'=>['replies.destroy',$reply->id], 'method'=>'delete','onsubmit'=>"return confirm('确定要删除?')"]) !!}
              <button type="submit" class="btn btn-sm">
                  <i class="far fa-trash-alt"></i>
              </button>
              {!! Form::close() !!}
            </span>
          @endcan
        </div>
        <div class="reply-content text-secondary">
          {!! $reply->content !!}
        </div>
      </div>


    </li>
 @if (!$loop->last)
      <hr class="m-0">
    @endif

  @endforeach
</ul>
{{$replies->render()}}

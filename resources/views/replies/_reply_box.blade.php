<div class="p-3">
  {!! Form::open(['route'=>['replies.store'],'method'=>'post']) !!}

  {!! Form::hidden('topic_id', $topic->id) !!}

  <div class="form-group">
  {!! Form::textarea('content', null, ['class'=>'form-control','rows'=>3,'placeholder'=>'分享你的见解~']) !!}
  </div>
  {!! $errors->first('content','<div class="alert alert-danger flash-message">:message</div>') !!}
  <button class="btn btn-primary btn-sm" type="submit">
  <i class="fa fa-share mr-1"></i>回复
  </button>

  {!! Form::close() !!}
</div>

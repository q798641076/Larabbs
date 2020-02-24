@extends('layouts.app')

@section('style')
  <link rel="stylesheet" href="{{asset('css/simditor.css')}}">
@endsection

@section('content')

<div class="container">

    <div class="col-md-10 offset-md-1">
      <div class="card">
        <div class="card-header">
          <h2>
            <i class="fa fa-edit"></i>
             @isset($topic->id)
               编辑话题
             @else
               新建话题
             @endisset
          </h2>
        </div>

        <div class="card-body">
          @isset($topic->id)
            {!! Form::model($topic,['route'=>['topics.update',$topics->id],'method'=>'patch','files'=>true]) !!}
          @else
            {!! Form::open(['route'=>['topics.store'],'method'=>'post','files'=>true]) !!}
          @endisset
            <div class="form-group">
            {!! Form::text('title', null, ['class'=>'form-control','placeholder'=>'请填写标题','required']) !!}
            </div>
            <div class="form-group">
            {!! Form::select('category_id', $category->pluck('name','id'), null, ['placeholder'=>'请选择分类','class'=>'form-control','required']) !!}
            {!!$errors->first('category_id','<div class="alert alert-danger flash-message">:message</div>')!!}
            </div>
            <div class="form-group">
            {!! Form::textarea('body', null, ['class'=>'form-control','placeholder'=>'请填写最少三个字符','rows'=>6,'id'=>'editor']) !!}
            </div>
            <div class="well well-sm">
              <button type="submit" class="btn btn-success"><i class="fa fa-save"></i></button>
            </div>
            {!! Form::close() !!}
        </div>
      </div>
    </div>

</div>

@endsection

@section('script')

<script type="text/javascript" src="{{ asset('js/module.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/hotkeys.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/uploader.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/simditor.js') }}"></script>


<script>
   $(document).ready(function() {
      var editor = new Simditor({
        textarea: $('#editor'),
        upload:{
          url:'{{route('topics.upload_image')}}',
          params:{
            _token:'{{csrf_token()}}'
          },
          fileKey:'upload_file',
          connectionCount:3,
          leaveConfirm:'文件上传中，关闭此页面将取消上传。'
        },
        pasteImage:true
      });
    });
</script>
@endsection

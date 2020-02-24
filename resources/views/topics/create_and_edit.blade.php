@extends('layouts.app')

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
            {!! Form::model($topic,['route'=>['topics.update',$topics->id],'method'=>'patch']) !!}
          @else
            {!! Form::open(['route'=>['topics.store'],'method'=>'post']) !!}
          @endisset
            <div class="form-group">
            {!! Form::text('title', null, ['class'=>'form-control','placeholder'=>'请填写标题','required']) !!}
            </div>
            <div class="form-group">
            {!! Form::select('category_id', $category->pluck('name','id'), null, ['placeholder'=>'请选择分类','class'=>'form-control','required']) !!}
            {!!$errors->first('category_id','<div class="alert alert-danger flash-message">:message</div>')!!}
            </div>
            <div class="form-group">
            {!! Form::textarea('body', null, ['class'=>'form-control','placeholder'=>'请填写最少三个字符','rows'=>6,]) !!}
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

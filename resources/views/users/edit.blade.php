@extends('layouts.app')

@section('title', '编辑资料')
@section('content')
   <div class="container">
     <div class="col-lg-8 col-md-8 offset-md-1">
      <div class="card ">
        <div class="card-header">
          <h4>
           <i class="fa fa-cogs"></i> 编辑个人资料
          </h4>
        </div>
        <div class="card-body">
           {!! Form::model($user,['route'=>['users.update',$user->id],'method'=>'patch','files'=>true]) !!}

           <div class="form-group">
           {!! Form::label('name', '姓名') !!}
           {!! Form::text('name', null, ['class'=>'form-control']) !!}
           {!!$errors->getBag('update')->first('name','<p class="text-danger">:message</p>')!!}
           </div>

           <div class="form-group">
             {!! Form::label('email', '邮箱') !!}
             {!! Form::email('email', null, ['class'=>'form-control']) !!}
             {!!$errors->getBag('update')->first('email','<p class="text-danger">:message</p>')!!}
           </div>

           <div class="form-group">
             {!! Form::label('introduction', '个人简介') !!}
             {!! Form::textarea('introduction', null, ['class'=>'form-control']) !!}
             {!!$errors->getBag('update')->first('introduction','<p class="text-danger">:message</p>')!!}
           </div>

           <div class="form-group">
            {!! Form::label('avatar', '头像上传') !!}
            {!! Form::file('avatar', ['class'=>'form-control-file']) !!}
            {!!$errors->getBag('update')->first('avatar','<p class="text-danger">:message</p>')!!}
            <img src="{{$user->avatar}}"  alt="{{$user->name}}" width="250px" height="250px">
          </div>

           {!! Form::submit('保存资料', ['class'=>'btn btn-primary']) !!}
           {!! Form::close() !!}
        </div>
      </div>
    </div>
   </div>
@endsection

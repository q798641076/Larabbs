<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Topic;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{

    protected $rep;

    public function __construct(UserRepository $rep)
    {
        $this->rep=$rep;
        return $this->middleware('auth',['except'=>'show']);
    }

    public function show(User $user){

        $topics=$this->rep->show($user);

        return view('users.show',compact('user','topics'));

    }

    public function edit(User $user){
        //授权：：不让这个用户去访问另外一个用户的操作界面
        $this->authorize('update', $user);
        return view('users.edit',compact('user'));
    }

    public function update(UpdateUserRequest $request, ImageUploadHandler $upload ,User $user){
       $this->authorize('update', $user);

       $this->rep->update($request,$upload, $user);

       return redirect()->route('users.show',$user->id)->with('success','更改信息成功');
    }
}

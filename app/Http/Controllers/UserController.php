<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    protected $rep;

    public function __construct(UserRepository $rep)
    {
        $this->rep=$rep;
        return $this->middleware('auth');
    }

    public function show(User $user){
        return view('users.show',compact('user'));
    }

    public function edit(User $user){
        return view('users.edit',compact('user'));
    }

    public function update(UpdateUserRequest $request, ImageUploadHandler $upload ,$id){

       $this->rep->update($request,$upload, $id);

       return redirect()->route('users.show',$id)->with('success','更改信息成功');
    }
}

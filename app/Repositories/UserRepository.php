<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Topic;
class UserRepository{

    public function find($id){

       return User::findOrFail($id);
    }

    public function show($user){

        $topics=Topic::recent()->with('user')->where('user_id', $user->id)->paginate(5);

        return $topics;
    }

    public function update($request, $upload, $user){

        if(Auth::user()->id!=$user->id){

           return back()->with('danger','别搞事情啊');

        };

       $data=$request->all();

       if($request->avatar){

         $file=$upload->save($request->avatar, 'avatar', Auth::id());

         if(!$file){
           return back()->with('danger','文件格式有误');
         }
         $data['avatar']=$file['path'];
       }

       $this->find($user->id)->update($data);
    }
}

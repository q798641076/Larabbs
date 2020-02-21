<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserRepository{

    public function find($id){

       return User::findOrFail($id);
    }

    public function update($request, $upload, $id){
        if(Auth::user()->id!=$id){
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

       $this->find($id)->update($data);
    }
}

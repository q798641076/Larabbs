<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserRepository{

    public function find($id){

       return User::findOrFail($id);
    }

    public function update($request, $id){

        if(Auth::id()!==$id){
           return back()->with('danger','别搞事情啊');
        }

        auth()->user()->update($request->all());

    }
}

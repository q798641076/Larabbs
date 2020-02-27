<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        //获取当前用户下的所有通知
        $notifications=Auth::user()->notifications()->paginate(10);

        //将消息设为已读;
        
        Auth::user()->markAsRead();

        return view('users.notification',compact('notifications'));
    }
}

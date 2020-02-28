<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\MustVerifyEmail as MustVerifyEmailTrait;
use App\Models\Topic;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    //要use MustVerifyEmailTrait才能用到里面的方法
    use MustVerifyEmailTrait;
    use HasRoles;
    //复写我们的notify()
    use Notifiable
    {
        notify as protected laravelNotify;
    }

    // public function notify($instance)
    // {
    //     //当自己评论自己时不用通知
    //     //但如果这样的话，我们激活邮件时，就不能重新发送邮件了，所以要重新定义一个方法
    //     if($this->id==Auth::id())
    //     {
    //         return;
    //     }

    //     //只有数据库类型通知才需要+1，直接发送email或者其他的都pass
    //     if(method_exists($instance,'toDatabase'))
    //     {
    //         $this->increment('notification_count');
    //     }
    //     $this->laravelNotify($instance);
    // }

        public function toNotify($instance)
        {
            if($this->id==Auth::id())
            {
                return;
            }

            if(method_exists($instance, 'toDatabase'))
            {
                $this->increment('notification_count');

            }

            $this->laravelNotify($instance);

        }

        //定义取消已读消息

        public function markAsRead()
        {
            $this->notification_count=0;

            $this->save();

            //循环所有未读消息,将它设为已读
            $this->unreadNotifications->markAsRead();
        }



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','introduction','avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function topics(){
        return $this->hasMany(Topic::class,'user_id');
    }

    public function reply()
    {
        return $this->hasMany(Reply::class,'user_id');
    }

    public function isAuthOf($model){
        return $this->id==$model->user_id;
    }

}

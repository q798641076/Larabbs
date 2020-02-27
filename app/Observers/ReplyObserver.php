<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        //
    }

    public function updating(Reply $reply)
    {
        //
    }
    public function saving(Reply $reply)
    {
        //xss攻击
        $reply->content=clean($reply->content,'user_topic_body');
    }
    public function created(Reply $reply)
    {
        //回复时触发通知   一个通知相当于一个类
        //默认的 User 模型中使用了 trait —— Notifiable，它包含着一个可以用来发通知的方法 notify() ，此方法接收一个通知实例做参数
        //当我们每次调用$user->notify时 自动将users里的notification_count+1 去user模型


        $reply->topic->user->toNotify(new TopicReplied($reply));

        //回复总数
       $reply->topic->updateReplyCount();

    }
    public function deleted(Reply $reply)
    {
        //减去回复数量
        $reply->topic->updateReplyCount();
    }
}

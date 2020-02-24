<?php

namespace App\Observers;

use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

//对事件的监听，例如当我们正在保存的时候要执行什么操作
//需要在Appserverprovider中注册
class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }

    public function saving(Topic $topic){
        //make_excerpt()自定义函数，在helpers
        return $topic->excerpt=make_excerpt($topic->body);
    }
}

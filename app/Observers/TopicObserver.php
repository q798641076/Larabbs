<?php

namespace App\Observers;

use App\Handlers\SlugTranslateHandler;
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

    public function saving(Topic $topic)
    {
        //入库之前进行xss过滤
        $topic->body = clean($topic->body, 'user_topic_body');

        //make_excerpt()自定义函数，在helpers
        $topic->excerpt=make_excerpt($topic->body);

        //入库之前对slug进行赋值
        //app() 允许我们使用 Laravel 服务容器 ，此处我们用来生成 SlugTranslateHandler 实例。
        if(!$topic->slug){
             $topic->slug=app(SlugTranslateHandler::class)->translate($topic->title);
        }

    }
}

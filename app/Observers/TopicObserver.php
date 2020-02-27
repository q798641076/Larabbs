<?php

namespace App\Observers;

use App\Handlers\SlugTranslateHandler;
use App\Jobs\TranslateSlug;
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


        //队列系统对于构造器里传入的 Eloquent 模型，将会只序列化 ID 字段，因为我们是在 Topic
        //模型监控器的 saving() 方法中分发队列任务的，此时传参的 $topic 变量还未在数据库里创建，所以 $topic->id 为 null。
        // if(!$topic->slug){
        //     //推送任务给队列
        //     dispatch(new TranslateSlug($topic));
        // }
    }

    public function saved(Topic $topic){

        if(!$topic->slug){
            dispatch(new TranslateSlug($topic));
        }
    }
}

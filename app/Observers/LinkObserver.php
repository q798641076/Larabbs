<?php
namespace App\Observers;

use Illuminate\Support\Facades\Cache;
use App\Models\Link;

class LinkObserver
{

    public function saved(Link $link)
    {
        //当数据模型发生变化时 清空缓存   注册监控器在AppServiceProvider
        Cache::forget($link->cache_key);
    }

    public function deleted(Link $link)
    {
        //当数据模型发生变化时 清空缓存   注册监控器在AppServiceProvider
        Cache::forget($link->cache_key);
    }

}

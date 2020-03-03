<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Link extends Model
{
    protected $fillable=[
        'title','link'
    ];

   public  $cache_key='larabbs_avtive_links';
   protected  $cache_empire_in_seconds='1440*60';

    //缓存活跃资源，因为推荐资源数据属于极少修改的数据，我们还会使用缓存来为加速读取。
    public function cacheActiveLink()
    {


        //尝试从$cache_key取得数据，如果没有的话就取默认值，
        //并且将默认值缓存到cache_key
       return  Cache::remember($this->cache_key, $this->cache_empire_in_seconds, function () {

            return $this->all();
        });


    }
}

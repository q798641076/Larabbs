<?php
namespace App\Models\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\Topic;
use App\Models\Reply;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

trait ActiveUserHelper
{
    //用于存放临时用户数据；
    protected $users=[];

    //配置信息
    protected $topic_weight=4; //话题权重
    protected $reply_weight=1; //回复权重
    protected $pass_days=7;    //时间范围
    protected $user_number=6;  //用户数量

    //缓存相关配置
    protected $cache_key='larabbs_active_users';
    protected $cache_expire_in_seconds=65*60;

    public function getActiveUsers()
    {
        // 尝试从缓存中取出 cache_key 对应的数据。如果能取到，便直接返回数据。
        // 否则运行匿名函数中的代码来取出活跃用户数据，返回的同时做了缓存。
        return Cache::remember($this->cache_key, $this->cache_expire_in_seconds, function () {
            return $this->calculateActiveUsers();
        });
    }

    public function calculateAndCacheAcitveUsers()
    {
        //取得活动用户
        $active_users=$this->calculateActiveUsers();
        //并加以缓存
        $this->cacheActiveUsers($active_users);
    }

    public function calculateActiveUsers()
    {
        $this->calculateTopicScore();
        $this->calculateReplyScore();

        //数组按照得分排序
        $users= Arr::sort($this->users, function($user){
            return $user['score'];
        });

        //我们需要的是倒序
        $users=array_reverse($users, true);

        //获取数量
        $users=array_slice($users,0,$this->user_number,true);
      
        //新建一个空集合
        $active_users=collect();

        foreach($users as $user_id =>$user)
        {
            //查找数据库当前用户
            $user=$this->find($user_id);
            //$this 指的是使用这个traits的类 例如User用了这个traits 那么$this就是User这个类
            if(isset($user))
            {
                $active_users->push($user);
            }
        }
        return $active_users;
    }

    public function calculateTopicScore()
    {
        //取出我们的所有用户对应的话题量，在指定时间范围内
        $topic_users=Topic::query()
                            ->select(DB::raw('user_id , count(*) as topic_count'))
                            ->where('created_at', '>=' , Carbon::now()->subDay($this->pass_days))
                            // groupBy('user_id')指的是把user_id的值作为数组的键名
                            //配合DB::raw()聚合
                            ->groupBy('user_id')
                            ->get();

        foreach($topic_users as $value)
        {
            $this->users[$value->user_id]['score']=$value->topic_count*$this->topic_weight;
        }
    }

    public function calculateReplyScore()
    {
        $reply_users=Reply::query()
                            ->select(DB::raw('user_id , count(*) as reply_count'))
                            ->where('created_at' , '>=' , Carbon::now()->subDay($this->pass_days))
                            ->groupBy('user_id')
                            ->get();

        foreach($reply_users as $value)
        {
            $reply_count_weight=$value->reply_count*$this->reply_weight;
            if(!isset($this->users[$value->user_id]['score']))
            {
                $this->users[$value->user_id]['score']=$reply_count_weight;
            }else{
                $this->users[$value->user_id]['score']+=$reply_count_weight;
            }
        }
    }

    public function cacheActiveUsers($active_users)
    {
        //将数据放入缓存表中
        Cache::put($this->cache_key, $active_users, $this->cache_expire_in_seconds);
    }
}

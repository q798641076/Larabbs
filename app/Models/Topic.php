<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Reply;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function reply()
    {
        return $this->hasMany(Reply::class, 'topic_id');
    }

    //作用域查询排序
    public function scopeWithOrder($query, $order){

        switch($order){

            case 'recent':
                $query->recent();
            break;

            case 'recentReplied':
                $query->recentReplied();
            break;
        }

        return $query->with('user','category');

    }
    //最新创建
    public function scopeRecent($query){
        return $query->orderBy('created_at','desc');
    }

    //最新回答，也就是最新更改
    public function scopeRecentReplied($query){
        return $query->orderBy('updated_at','desc');
    }


    public function link($parem=[]){
       //把id和slug给topics.show
        return route('topics.show',array_merge([$this->id,$this->slug],$parem));
    }

    //回复总数
    public function updateReplyCount()
    {
        $this->reply_count=$this->reply->count();
        $this->save();
    }

}

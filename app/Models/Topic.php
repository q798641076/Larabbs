<?php

namespace App\Models;

use App\Models\Category;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'category_id', 'reply_count', 'view_count', 'last_reply_user_id', 'order', 'excerpt', 'slug'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
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


}

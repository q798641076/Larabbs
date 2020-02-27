<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;

class ReplyPolicy extends Policy
{
    public function update(User $user, Reply $reply)
    {
        // return $reply->user_id == $user->id;
        return true;
    }

    public function destroy(User $user, Reply $reply)
    {
        //评论属于我 可以删除,或者话题属于我 可以删除
        return $user->isAuthOf($reply)||$user->isAuthOf($reply->topic);
    }
}

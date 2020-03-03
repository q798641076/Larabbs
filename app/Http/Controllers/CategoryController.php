<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Link;


class CategoryController extends Controller
{
    public function show(Category $category,Topic $topic,User $user, Link $link){

        $topics=Topic::withOrder(request('order'))->where('category_id', $category->id)->paginate();

        $active_users=$user->getActiveUsers();

        $active_links=$link->cacheActivelink();
        return view('categories.show', compact('category', 'topics','active_users','active_links'));
    }
}

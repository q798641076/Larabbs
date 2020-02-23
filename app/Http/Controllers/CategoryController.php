<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category,Topic $topic){

        $topics=Topic::withOrder(request('order'))->where('category_id', $category->id)->paginate();

        return view('categories.show', compact('category', 'topics'));
    }
}
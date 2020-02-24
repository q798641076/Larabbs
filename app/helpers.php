<?php
use Illuminate\Support\Str;
//将路由名称转化为类名，来给指定的页面设置指定的样式
function route_class()
{
    return str_replace('.','-', Route::currentRouteName());
}

//
function make_excerpt($value,$limit=200)
{
    //trim去掉两边空白字符或者其他预定义字符
    //preg_replace 搜索第三个参数中的第一个参数内容，用第二个参数替换
    //strip_tags去掉html标签
    $excerpt=trim(preg_replace('/\r\n|\r|\n+/', ' ', strip_tags($value)));

    return Str::limit($excerpt, $limit);
}

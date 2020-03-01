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

// if(!function_exists('manage_contents'))
// {
//     function manage_contents()
//     {
//         return Auth::check() && Auth::user()->can('manage_contents');
//     }
// }


function model_admin_link($value, $model)
{
    return model_link($value,$model,'admin');
}

function model_link($value, $model,$prefix=[])
{
    //获取数据模型的复数蛇形命名
    $model_name=model_plural_name($model);

    //初始化前缀
    $prefix= $prefix ? "/$prefix/" : '/';

    //使用站点url拼接全量URL
    $url= config('app.url').$prefix."$model_name/".$model->id;

    return '<a href="'.$url.'" target="_blank">'.$value.'</a>';
}

function model_plural_name($model)
{   //例如 $model=$model->user
    //从实体中获取完整类名，例如：App\Models\User
    $full_class_name=get_class($model);

    //获取基础类名， 例如： 传参App\Models\User 会得到’User‘

    $class_name=class_basename($full_class_name);

    //蛇形命名，例如：传参’User‘ 会得到“user”，
    //'FooBar'会得到 ’foo_bar‘
    $snake_case_name= Str::snake($class_name);

    //获取字符串为复数形式
    return Str::plural($snake_case_name);
}

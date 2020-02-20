<?php

//将路由名称转化为类名，来给指定的页面设置指定的样式
function route_class()
{
    return str_replace('.','-', Route::currentRouteName());
}

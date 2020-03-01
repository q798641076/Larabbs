<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'PagesController@root')->name('root');

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController',['only'=>['update','edit','show']]);

Route::resource('topics', 'TopicsController', ['only' => ['index', 'create', 'store', 'update', 'edit', 'destroy']]);
Route::get('topics/{topic}/{slug?}','TopicsController@show')->name('topics.show');

Route::resource('categories', 'CategoryController',['only'=>'show']);

//创建或更改文章时，要上传的图片路由
Route::post('uploadImage', 'TopicsController@uploadImage')->name('topics.upload_image');

Route::resource('replies', 'RepliesController', ['only' => [ 'create', 'store',  'destroy']]);

Route::resource('notifications', 'NotificationController',['only'=>['index','destroy']]);

Route::get('permissions','PagesController@permission')->name('permissions');

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
/** 登录*/
Route::get('/', function () {
    return view('login');
});
/** 桌面首页*/
//Route::any('/index', function () {
//    return view('index');
//});
Route::any('index','IndexController@index');

/**跟单管理*/
#跟单列表
Route::any('with','OddController@oddList');

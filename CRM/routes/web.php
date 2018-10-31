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
Route::any('/', function () {
    return view('login');
});
/** 执行登录*/
Route::any('/login', 'LoginController@login');
/** 退出登录*/
Route::any('/quit', 'LoginController@quit');
/** 权限管理*/
Route::any('/power', 'PowerController@power');
/** 权限添加*/
Route::any('/powerAdd', 'PowerController@powerAdd');
/** 权限数据表格  + 分页*/
Route::any('/powerData', 'PowerController@powerData');
/** 权限修改（即点即改）*/
Route::any('/powerUpdate', 'PowerController@powerUpdate');
/** 客户管理*/
Route::any('/user', 'userController@user');
Route::any('/index', 'IndexController@index');
/** 跟单管理列表*/
Route::any('/with','OddController@oddList');
/** 根据地址pid查询所有地址*/
Route::any('/userArea', 'UserController@userArea');
/**客户添加*/
Route::any('/userAdd', 'UserController@userAdd');
/**客户列表*/
Route::any('/userList', 'UserController@userList');


/**客户列表删除*/
Route::any('/userDel', 'UserController@userDel');
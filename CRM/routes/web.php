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
/** 注意事项*/
Route::any('/waring', function () {
    return view('waring');
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
/** 角色管理*/
Route::any('/role', 'RoleController@role');
/** 角色添加*/
Route::any('/roleAdd', 'RoleController@roleAdd');
/** 角色数据表格  + 分页*/
Route::any('/roleData', 'RoleController@roleData');
/** 角色修改（即点即改）*/
Route::any('/roleUpdate', 'RoleController@roleUpdate');
/** 管理员管理*/
Route::any('/admin', 'AdminController@admin');
/** 管理员添加*/
Route::any('/adminAdd', 'AdminController@adminAdd');
/** 管理员数据表格  + 分页*/
Route::any('/adminData', 'AdminController@adminData');
/** 管理员修改（即点即改）*/
Route::any('/adminUpdate', 'AdminController@adminUpdate');
/** 桌面首页*/
Route::any('/index', 'IndexController@index');





/** 客户管理*/
<<<<<<< HEAD
Route::any('/user', 'userController@user');
/** 桌面首页*/
Route::any('/index', 'IndexController@index');
=======
Route::any('/user', 'UserController@user');
/** 跟单管理列表*/
Route::any('/with','OddController@oddList');
>>>>>>> 8eadb87cc553b4f9561b01ce729c30aefc09f57d
/** 根据地址pid查询所有地址*/
Route::any('/userArea', 'UserController@userArea');
/**客户添加*/
Route::any('/userAdd', 'UserController@userAdd');
<<<<<<< HEAD

=======
/**客户列表*/
Route::any('/userList', 'UserController@userList');


/**客户列表删除*/
Route::any('/userDel', 'UserController@userDel');
/**客户修改视图*/
Route::any('/userUpdate{id}', 'UserController@userUpdate');
/**客户修改执行*/
Route::any('/userUpDo', 'UserController@userUpdateDo');
>>>>>>> 8eadb87cc553b4f9561b01ce729c30aefc09f57d

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    //检测滑块验证
    public function index(Request $request){
        $result=$this->validate($request,[
            'geetest_challenge'=>'geetest',
        ],[
            'geetest'=>config('geetest.server_fail_alert')
        ]);
        if($request){
            return'success';
        }
    }
    //执行登录
    public function login(Request $request){
        $account = $request -> input('login-username');//账号
        $pwd = $request -> input('login-password');//密码
        //根据账号查询一条数据

    }

    //退出登录
    public function quit(){

    }

}

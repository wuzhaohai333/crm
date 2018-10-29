<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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
        //检验参数
        if(empty($account)){
            exit('账号不能为空！');
        }
        if(empty($pwd)){
            exit('密码不能为空！');
        }
        //根据账号查询一条数据
        $admin_info = json_decode(json_encode(DB::table('crm_admin')
            ->where(['admin_accont' => $account])
            ->first()),true);
        //如果账号不存在  提示  账号或密码有误
        if(!$admin_info){
            echo "<script>alert('账号或密码有误');location.href=('/')</script>";
            exit;
        }
        //账号正确 比对密码是否正确  对比规则  数据库密码 = md5(表单密码.自增id)
        if($admin_info['admin_pwd'] != md5($pwd.$admin_info['id'])){
            echo "<script>alert('账号或密码有误');location.href=('/')</script>";
            exit;
        }
        session(['admin_info'=>$admin_info]);//存入session

        echo "<script>alert('登录成功!')</script>";
        return redirect('/index');
    }

    //退出登录
    public function quit(Request $request){
        $request->session()->flush();//销毁session
        return redirect('/');
    }

}

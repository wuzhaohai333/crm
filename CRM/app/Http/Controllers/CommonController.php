<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommonController extends Controller
{
    //初始化数据
    public function __construct()
    {

        $this->middleware(function ($request,$next) {
            if(!$request->session()->has('admin_info')){
                echo "<script>alert('请先登录！');location.href=('/')</script>";
                exit;
            }else{
                #登录  获取管理员id
                $admin_id = session('admin_info')['id'];//管理员id
                #根据管理员id 获取这个管理员的角色
                $role = json_decode(json_encode(DB::table('crm_role_admin')
                    -> where(['admin_id'=>$admin_id])
                    -> get()),true);
                $role_id = [];#角色id
                foreach($role as $k=>$v){
                    $role_id[] = $v['role_id'];
                }
                #根据角色id查询  查询角色权限关联表
                $power = json_decode(json_encode(DB::table('crm_role_power')
                    -> whereIn('role_id',$role_id)
                    -> get()),true);
                $power_id = [];
                foreach($power as $k=>$v){
                    $power_id[] = $v['power_id'];
                }
                #根据权限id  查询权限表  获取这个管理员权限
                $powerAll = json_decode(json_encode(DB::table('crm_power')
                    -> whereIn('id',$power_id)
                    -> get()),true);
                $index = [];#管理员的权限
                foreach($powerAll as $k => $v){
                    $index[] = strtolower($v['power_url']);
                }
                #如果权限不够阻止访问
                $route = strtolower('/'.$request -> path());#路由
                #特殊权限
                $index[] = '/index';
                #超级管理员不受权限控制
                if($admin_id != 1){
                    if(!in_array($route,$index)){
                        exit("<span style='color:red'>你没有权限访问</span><br><a target='_parent' href='/index'>返回首页</a>");
                    }
                }
            }
            $request->merge(['index' => $index]); //合并参数 在控制器中可以使用 request()->get('userinfo') 获取
            $request->merge(['admin' => $admin_id]); //合并参数 在控制器中可以使用 request()->get('userinfo') 获取
//            $request->attributes->add(['userinfo' => $arr]);//添加参数  在控制器中可以使用request()->get('userinfo') 获取
            return $next($request);
        });
    }

    //获取员工id
    public function getUserId(Request $request){
        return $request->session()->get('admin_info')['id'];
    }
    //正确、错误提示
    public function hint($font,$code){
        return ['font'=>$font,'code'=>$code];
    }
    //获取$x天新增
    /**
     * @param $table  表名
     * @param $where  条件
     * @param int $day 天数
     * @return array
     */
    public function todayAdd($table,$where,$day=1){
        $name=substr($table,Strpos($table,'_')+1).'_ctime';
        $data=DB::table($table)->where($where)->get()->toArray();
        $arr=[];
        foreach ($data as $k=>$v) {
            echo time()-$v->$name.'/';
            if(time()-$v->$name<86400*$day){
                $arr[]=$v;
            }
        }
        return $arr;
    }
}

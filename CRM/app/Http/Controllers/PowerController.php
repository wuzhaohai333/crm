<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PowerController extends CommonController
{
    /** 权限管理*/
    public function power(){
        #只查最顶级权限(添加时下拉框使用)
        $power_top = json_decode(json_encode(DB::table('crm_power') -> where(['power_level' => 1,'power_status' => 1]) -> get()),true);
        #查出所有的权限（列表展示）
        $powerList = json_decode(json_encode(DB::table('crm_power') -> where(['power_status' => 1]) -> get()),true);
        return view('power',['power'=> $power_top,'powerList'=>$powerList]);
    }
    /** 权限添加*/
    public function powerAdd(Request $request){
        //ajax   post请求
        if($request -> ajax() && $request -> isMethod('post')){
            $power_name = $request -> input('name');//权限名称
            $power_url = $request -> input('url');//权限路径
            $power_img = $request -> input('img');//权限图像
            $power_status = $request -> input('sex');//1启用   2不启用
            $pid = $request -> input('parent');
            //检验参数
            if(empty($power_name)){
                return ['font'=>'非空项不能为空','code'=>0];
                exit;
            }
            if(empty($power_url)){
                return ['font'=>'非空项不能为空','code'=>0];
                exit;
            }
            if(empty($power_img)){
                return ['font'=>'非空项不能为空','code'=>0];
                exit;
            }
            if(empty($power_status)){
                return ['font'=>'是否启用？','code'=>0];
                exit;
            }
            if($pid == 'a'){
                $pid = 0;
                $level = 1;
            }else{
                $level = 2;
            }
            //要添加的数据
            $arr = [
                'power_name' => $power_name,
                'power_url' => $power_url,
                'power_img' => $power_img,
                'power_pid' => $pid,
                'power_level' => $level,
                'power_ctime' => time(),
                'power_status' => $power_status
            ];
            $id = DB::table('crm_power') -> insertGetId($arr);
            if($id){
                return ['font'=>'添加成功','code'=>1000];
            }else{
                return ['font'=>'添加异常','code'=>0];
            }
        }

    }




}

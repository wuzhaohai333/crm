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
        return view('power',['power'=> $power_top]);
    }
    /** 数据表格  分页*/
    public function powerData(Request $request){
        $p = empty($request -> input('page'))?1:$request -> input('page');//当前页码
        $p_num = $request -> input('limit');//每页显示条数
        $count = DB::table('crm_power') -> count();//总条数
        #查出所有的权限（列表展示）
        $powerList = json_decode(json_encode(DB::table('crm_power') -> where(['power_status' => 1])  -> forPage($p,$p_num) -> get()),true);//权限表数据
        foreach($powerList as &$v){
            //处理状态
            if($v['power_status'] == 1){
                $v['power_status'] = '已启用';
            }else{
                $v['power_status'] = '未启用';
            }
            //处理时间戳
            $v['power_ctime'] = date('Y-m-d H:i:s',$v['power_ctime']);
            $v['power_utime'] = empty($v['power_utime'])?'暂未修改':date('Y-m-d H:i:s',$v['power_utime']);
        }
        echo json_encode([
            'code' =>0,
            'msg' =>'',
            'count' => $count,
            'data' => $powerList
        ]);
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
    /** 权限修改（即点即改）*/
    public function powerUpdate(Request $request){
        $field = $request -> input('info')['field'];//修改的字段
        $value = $request -> input('info')['value'];//修改的新值
        $id = $request -> input('info')['data']['id'];//修改的id
        $updateRes = DB::table('crm_power')
            -> where(['id' => $id])
            -> update([$field => $value]);
        if($updateRes){
            return ['code' => 1000,'font' => '修改成功！'];
        }

    }




}

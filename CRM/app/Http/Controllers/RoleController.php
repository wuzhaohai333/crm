<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class roleController extends CommonController
{
    /** 角色管理*/
    public function role(){
        #查询所有权限
        $nodeAll = json_decode(json_encode(DB::table('crm_power') -> where(['power_status' => 1]) -> get()),true);
        $nodeAll = getTree($nodeAll);
        return view('role',['nodeAll'=> $nodeAll]);
    }
    /** 数据表格  分页*/
    public function roleData(Request $request){
        $p = empty($request -> input('page'))?1:$request -> input('page');//当前页码
        $p_num = $request -> input('limit');//每页显示条数
        $count = DB::table('crm_role') -> count();//总条数
        #查出所有的角色（列表展示）
        $roleList = json_decode(json_encode(DB::table('crm_role') -> where(['role_status' => 1])  -> forPage($p,$p_num) -> get()),true);//角色表数据
        foreach($roleList as &$v){
            //处理状态
            if($v['role_status'] == 1){
                $v['role_status'] = '已启用';
            }else{
                $v['role_status'] = '未启用';
            }
            //处理时间戳
            $v['role_ctime'] = date('Y-m-d H:i:s',$v['role_ctime']);
            $v['role_utime'] = empty($v['role_utime'])?'暂未修改':date('Y-m-d H:i:s',$v['role_utime']);
        }
        echo json_encode([
            'code' =>0,
            'msg' =>'',
            'count' => $count,
            'data' => $roleList
        ]);
    }
    /** 角色添加*/
    public function roleAdd(Request $request){
        //ajax   post请求
        if($request -> ajax() && $request -> isMethod('post')){
            $role_name = $request -> input('name');//角色名称
            $role_status = $request -> input('sex');//1启用   2不启用
            $power = $request -> input('power');//选择的权限
            //检验参数
            if(empty($role_name)){
                return ['font'=>'非空项不能为空','code'=>0];
                exit;
            }
            if(empty($role_status)){
                return ['font'=>'是否启用？','code'=>0];
                exit;
            }
            if(!$power){
                return ['font'=>'非空项不能为空','code'=>0];
                exit;
            }
            try{
                DB::beginTransaction();//开启事务
                //添加角色信息
                $arr = [
                    'role_name' => $role_name,
                    'role_ctime' => time(),
                    'role_status' => $role_status
                ];
                $role_id = DB::table('crm_role') -> insertGetId($arr);
                if(!$role_id){
                    throw new \Exception('角色数据写入失败');
                }
                //添加角色权限关联表信息
                $info = [];
                foreach($power as $k => $v){
                    $info[] = [
                        'role_id' => $role_id,
                        'power_id' => $v
                    ];
                }
                $res = DB::table('crm_role_power') -> insert($info);
                if(!$res){
                    throw new \Exception('角色权限关联数据写入失败');
                }
                #执行事务
                DB::commit();
                return ['code'=>1000,'font' => '添加成功'];
            }catch (\Exception $e){
                DB::rollBack();#事务回滚
                return ['code'=>1000,'font' => $e -> getMessage()];
            }

        }

    }
    /** 角色修改（即点即改）*/
    public function roleUpdate(Request $request){
        $field = $request -> input('info')['field'];//修改的字段
        $value = $request -> input('info')['value'];//修改的新值
        $id = $request -> input('info')['data']['id'];//修改的id
        $updateRes = DB::table('crm_role')
            -> where(['id' => $id])
            -> update([$field => $value]);
        if($updateRes){
            return ['code' => 1000,'font' => '修改成功！'];
        }

    }




}

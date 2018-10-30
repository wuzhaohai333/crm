<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends CommonController
{
    /** 管理员管理*/
    public function admin(){
        #角色数据
        $role = json_decode(json_encode(DB::select(
            "select group_concat(`p`.`power_name`) as `power_all`,r.* from `crm_role` as `r` LEFT JOIN `crm_role_power` as `rp` ON r.id = rp.role_id LEFT JOIN `crm_power` as `p` ON p.id = rp.power_id WHERE r.role_status=1 AND p.power_level !=1 GROUP BY r.id"
        )),true);
        #部门数据
        $branch = json_decode(json_encode(DB::table('crm_branch') -> where(['branch_status'=>1]) -> get()),true);
        return view('admin',['branch' => $branch,'role'=>$role]);
    }
    /** 数据表格  分页*/
    public function adminData(Request $request){
        $p = empty($request -> input('page'))?1:$request -> input('page');//当前页码
        $p_num = $request -> input('limit');//每页显示条数
        $count = DB::table('crm_admin') -> count();//总条数
        #查出所有的管理员（列表展示）
        $adminList = json_decode(json_encode(DB::table('crm_admin') -> where(['admin_status' => 1])  -> forPage($p,$p_num) -> get()),true);//管理员表数据
        foreach($adminList as &$v){
            //处理状态
            if($v['admin_status'] == 1){
                $v['admin_status'] = '已启用';
            }else{
                $v['admin_status'] = '未启用';
            }
            //处理时间戳
            $v['admin_ctime'] = date('Y-m-d H:i:s',$v['admin_ctime']);
            $v['admin_utime'] = empty($v['admin_utime'])?'暂未修改':date('Y-m-d H:i:s',$v['admin_utime']);
        }
        echo json_encode([
            'code' =>0,
            'msg' =>'',
            'count' => $count,
            'data' => $adminList
        ]);
    }
    /** 管理员添加*/
    public function adminAdd(Request $request)
    {
        //ajax   post请求
        if ($request->ajax() && $request->isMethod('post')) {
            $admin_name = $request->input('name');//管理员账号
            $admin_pwd = $request->input('pwd');//管理员密码
            $admin_phone = $request->input('phone');//管理员联系方式
            $admin_email = $request->input('email');//管理员邮箱
            $admin_branch = $request->input('branch');//管理员部门
            $admin_status = $request->input('sex');//1启用   2不启用
            $role_id = $request->input('role');//所选的角色
            //检验参数
            if (empty($admin_name)) {
                return ['font' => '非空项不能为空', 'code' => 0];
                exit;
            }
            if (empty($admin_pwd)) {
                return ['font' => '非空项不能为空', 'code' => 0];
                exit;
            }
            if (empty($admin_phone)) {
                return ['font' => '非空项不能为空', 'code' => 0];
                exit;
            }
            if (empty($admin_email)) {
                return ['font' => '非空项不能为空', 'code' => 0];
                exit;
            }
            if (empty($admin_branch)) {
                return ['font' => '非空项不能为空', 'code' => 0];
                exit;
            }
            if (empty($admin_status)) {
                return ['font' => '是否启用？', 'code' => 0];
                exit;
            }

            try{
                DB::beginTransaction();//开启事务
                //添加管理员信息
                $arr = [
                    'admin_account' => $admin_name,
                    'admin_pwd' => 'LiuLiLin666',
                    'admin_tel' => $admin_phone,
                    'admin_email' => $admin_email,
                    'admin_name' => '管理员',
                    'admin_branch' => $admin_branch,
                    'admin_ctime' => time(),
                    'admin_status' => $admin_status,
                ];
                $admin_id = DB::table('crm_admin') -> insertGetId($arr);
                if(!$role_id){
                    throw new \Exception('管理员数据写入失败');
                }
                $admin_info = json_decode(json_encode(DB::table('crm_admin') -> where(['id' => $admin_id]) -> first()),true);
                $updateRes = DB::table('crm_admin') -> where(['id' => $admin_id]) -> update(['admin_pwd' => md5($admin_pwd.$admin_info['id'])]);
                if(!$updateRes){
                    throw new \Exception('密码****');
                }
                //添加角色管理员关联表信息
                $info = [];
                foreach($role_id as $k => $v){
                    $info[] = [
                        'admin_id' => $admin_id,
                        'role_id' => $v,
                    ];
                }
                $res = DB::table('crm_role_admin') -> insert($info);
                if(!$res){
                    throw new \Exception('角色管理员关联数据写入失败');
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
    /** 管理员修改（即点即改）*/
    public function adminUpdate(Request $request){
        $field = $request -> input('info')['field'];//修改的字段
        $value = $request -> input('info')['value'];//修改的新值
        $id = $request -> input('info')['data']['id'];//修改的id
        $updateRes = DB::table('crm_admin')
            -> where(['id' => $id])
            -> update([$field => $value]);
        if($updateRes){
            return ['code' => 1000,'font' => '修改成功！'];
        }

    }




}

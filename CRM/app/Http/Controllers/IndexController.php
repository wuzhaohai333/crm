<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends CommonController
{
    /** 桌面首页*/
    public function index(Request $request){
        $index = $request -> get('index');//管理员的权限
        $admin_id = $request -> get('admin');//管理员id
        $data = json_decode(json_encode(DB::table('crm_power') ->where(['power_level' =>1]) -> whereIn('power_url',$index) -> get()),true);
        $power_name = '';
        if($admin_id == 1){
            $power_name = '全部权限';
            $data = json_decode(json_encode(DB::table('crm_power') ->where(['power_level' =>1])  -> get()),true);
        }else{

            $role = json_decode(json_encode(DB::select(
                "select group_concat(`p`.`power_name`) as `power_all`,r.* from `crm_role` as `r` LEFT JOIN `crm_role_power` as `rp` ON r.id = rp.role_id LEFT JOIN `crm_power` as `p` ON p.id = rp.power_id WHERE r.role_status=1 AND p.power_level !=1 GROUP BY r.id"
            )),true);
            foreach($role as $k => $v){
                $power_name .= $v['power_all'].',';
            }
            $power_name = rtrim($power_name,',');
        }
        return view('index',['data' => $data,'power_name'=>$power_name]);
    }

}

<?php
/**
 * 跟单管理
 */
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class OddController extends CommonController
{
    /** 跟单管理列表*/
    public function oddList(){
        #查询跟单列表
        $odd_data = json_decode(DB::table('crm_odd')
            ->where(['odd_status'=>1])
            ->join('crm_user','crm_odd.user_id','=','crm_user.user_id')
            ->select('crm_odd.*','user_name','salesman_id')
            ->get(),true);
        #循环处理数据
        foreach($odd_data as $key=>$val){
            #跟单类型
            switch($val['odd_type']){
                case 1;
                    $odd_data[$key]['odd_type'] = '电话拜访';
                    break;
                case 2;
                    $odd_data[$key]['odd_type'] = '上门拜访';
                    break;
                case 3;
                    $odd_data[$key]['odd_type'] = 'QQ交谈';
                    break;
                case 4;
                    $odd_data[$key]['odd_type'] = 'Email邮件';
                    break;
                default:
                    $odd_data[$key]['odd_type'] = '微信';
                    break;
            }
            #跟单进度
            switch($val['odd_plan']){
                case 1;
                    $odd_data[$key]['odd_plan'] = '已支付';
                    break;
                case 2;
                    $odd_data[$key]['odd_plan'] = '未支付';
                    break;
                case 3;
                    $odd_data[$key]['odd_plan'] = '跟进中';
                    break;
                default:
                    $odd_data[$key]['odd_plan'] = '有意向';
                    break;
            }
            #下次联系
            $odd_data[$key]['next_time'] = date('Y-m-d H:s:i',$val['next_time']);
            #添加时间
            $odd_data[$key]['odd_ctime'] = date('Y-m-d',$val['odd_ctime']);
        }
        #获取客户列表的数据
        $where = ['user_status'=>1];
        $info = $this->clientList($where);
        return view('odd.oddList',['odd_data'=>$odd_data,'info'=>$info]);
    }
    /**
     * 新增跟单第一步
     */
    public function oddAdd_to(){
            $user_info = [];
            $user_data = Input::get();
            $user_info['user_id'] = $user_data;
            return view('odd.oddAdd_to',['user_info'=>$user_info]);
    }
    /**
     * 新增跟单第二步
     */
    public function oddAdd(){
        $arr = Input::post();
        $data = $arr['data'];
        #日期转换时间戳
        $todaytime=strtotime($data['next_time']);
        ##############验证客户端的数据
        $insert = [];
        $insert['user_id'] = $data['user_id'];
        $insert['odd_type'] = $data['odd_type'];
        $insert['odd_plan'] = $data['odd_plan'];
        $insert['odd_object'] = $data['odd_object'];
        $insert['next_time'] = $todaytime;
        $insert['first'] = $data['first'];
        $insert['details'] = $data['details'];
        $insert['odd_ctime'] = time();
        $insert['odd_status'] = 1;
        $row = DB::table('crm_odd')->insertGetId($insert);
    }
    /**
     * 客户列表
     */
    public function clientList($where){
        $info = json_decode(DB::table('crm_user')
            ->where($where)
            ->select('user_id','user_name','user_qq','user_linkman','user_utime')
            ->get(),true);
        foreach($info as $k=>$v){
            $info[$k]['user_utime'] = ceil((time()-$v['user_utime']));
        }
        return $info;
    }

}

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
            ->join('crm_user','crm_odd.id','=','crm_user.id')
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
            $user_info['id'] = $user_data;
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
        $insert['id'] = $data['id'];
        $insert['odd_type'] = $data['odd_type'];
        $insert['odd_plan'] = $data['odd_plan'];
        $insert['odd_object'] = $data['odd_object'];
        $insert['next_time'] = $todaytime;
        $insert['first'] = $data['first'];
        $insert['details'] = $data['details'];
        $insert['odd_ctime'] = time();
        $insert['odd_status'] = 1;
        $row = DB::table('crm_odd')->insertGetId($insert);
        if($row){
            return 1;
            #是否要修改客户列表的数据
            $where = ['id'=>$data['id'],'user_status'=>1];
            $save = ['user_status'=>2];
            $set = DB::table('crm_user')->where($where)->update($save);

        }else{
            return 2;
        }

    }
    /**
     * 客户列表
     */
    public function clientList($where){
        $info = json_decode(DB::table('crm_user')
            ->where($where)
            ->select('id','user_name','user_qq','user_linkman','user_utime')
            ->get(),true);
        foreach($info as $k=>$v){
            $info[$k]['user_utime'] = ceil((time()-$v['user_utime']));
        }
        return $info;
    }
    /**
     * 删除
     */
    public function oddDel(){
        $arr=Input::post();
        if($arr['type']==1){
            $update_arr=[
                'odd_status'=>2,
                'odd_utime'=>time()
            ];
            $where=[
                'odd_status'=>1,
                'odd_id'=>$arr['odd_id']
            ];
            $res=DB::table('crm_odd')->where($where)->update($update_arr);
            if($res){
                echo 1;
            }else{
                echo 2;
            }
        }
    }

    /**
     * 修改
     */
    public function oddUpdate($odd_id){
        $odd_data = json_decode(json_encode(DB::table('crm_odd')
            ->where(['odd_id'=>$odd_id])
            ->join('crm_user','crm_odd.id','=','crm_user.id')
            ->select('crm_odd.*','user_name','salesman_id')
            ->first()),true);
//        #stdclass object格式 转数组
//        object2array($odd_data);
            #跟单类型
            switch($odd_data['odd_type']){
                case 1;
                    $odd_data['odd_type'] = '电话拜访';
                    break;
                case 2;
                    $odd_data['odd_type'] = '上门拜访';
                    break;
                case 3;
                    $odd_data['odd_type'] = 'QQ交谈';
                    break;
                case 4;
                    $odd_data['odd_type'] = 'Email邮件';
                    break;
                case 5;
                    $odd_data['odd_type'] = '微信';
                    break;
                default:
                    break;
            }
            #跟单进度
            switch($odd_data['odd_plan']){
                case 1;
                    $odd_data['odd_plan'] = '已支付';
                    break;
                case 2;
                    $odd_data['odd_plan'] = '未支付';
                    break;
                case 3;
                    $odd_data['odd_plan'] = '跟进中';
                    break;
                default:
                    $odd_data['odd_plan'] = '有意向';
                    break;
            }
            #下次联系

            $odd_data['next_time'] = date('Y-m-d H:i:s',$odd_data['next_time']);

            //$odd_data['next_time'] = date('Y-m-d H:i:s',$odd_data['next_time']);

            #添加时间
            // $odd_data['odd_ctime'] = date('Y-m-d',$odd_data['odd_ctime']);
        return view('odd.oddUpdate',['odd_data'=>$odd_data]);
    }
    /**
     * 执行修改
     */
    public function oddUpdate_to(){
        $arr = Input::post();
        print_r($arr);
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class UserController extends CommonController
{
    //客户添加列表
    public function user(){
        $data=DB::table('crm_area')->where(['pid'=>0])->get()->toArray();
        //dump($data);
        return view('user',['area'=>$data]);
    }
    //获取当前地址下的所有地址
    public function userArea(){
        $pid=Input::post('pid');
        $arr=DB::table('crm_area')->where(['pid'=>$pid])->get()->toArray();
        echo json_encode($arr);
    }
    //客户添加
    public function userAdd(){
        $arr=Input::post();
        $arr['user_ctime']=time();
        $arr['user_status']=1;
        $tmp='_token';
        foreach( $arr as $k=>$v) {
            if($tmp == $k) unset($arr[$k]);
        }
        //print_r($arr);
        $res=DB::table('crm_user')->insert($arr);
        echo $res;
    }
    //客户列表
    public function userList(){
        $arr=Input::get();
        $limit=($arr['page']-1)*$arr['limit'];
        $data=DB::select('select * from crm_user where user_status=1 limit '.$limit.','.$arr['limit']);
        $count=DB::table('crm_user')->where(['user_status'=>1])->count();
        echo json_encode(["code"=>0,"msg"=>"","count"=>$count,'data'=>$data]);
    }
    //客户删除
    public function userDel(){
        $arr=Input::get();
        if($arr['type']==1){
            $update_arr=[
                'user_status'=>2,
                'user_ctime'=>time()
            ];
            $where=[
                'user_status'=>1,
                'id'=>$arr['id']
            ];
            $res=DB::table('crm_user')->where($where)->update($update_arr);
            if($res){
                echo 1;
            }else{
                echo 2;
            }
        }

    }
    //客户修改视图
    public function userUpdate($id){
        $data=DB::table('crm_area')->where(['pid'=>0])->get()->toArray();

        $user_info=DB::table('crm_user')->where(['id'=>$id])->first();
        $area=DB::table('crm_area')->where(['pid'=>$user_info->user_province])->get()->toArray();
        //dump($user_info);die;
        return view('userUpdate',['area'=>$data,'user_info'=>$user_info,'are'=>$area]);
    }
    //执行客户修改
    public function userUpdateDo(){
        $arr=Input::get();
        $arr['user_ctime']=time();
        $tmp='_token';
        foreach( $arr as $k=>$v) {
            if($tmp == $k) unset($arr[$k]);
            if('s' == $k) unset($arr[$k]);
            if('index' == $k) unset($arr[$k]);
        }
        $where=[
            'id'=>$arr['id'],
            'user_status'=>1
        ];
        //print_r($arr);
        $res=DB::table('crm_user')->where($where)->update($arr);
        echo $res;
    }
}

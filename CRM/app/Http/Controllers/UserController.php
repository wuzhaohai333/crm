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
        $tmp='lI7AfRSdiZMZYPr94Oo0mmG5rh7SDtaSjMVAMxXe';
        foreach( $arr as $k=>$v) {
            if($tmp == $v) unset($arr[$k]);
        }
        //print_r($arr);
        $res=DB::table('crm_user')->insert($arr);
        echo $res;
    }
    //客户列表
    public function userList(){
        $data=DB::table('crm_user')->where(['user_status'=>1])->get();
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
}

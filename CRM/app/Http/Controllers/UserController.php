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
}

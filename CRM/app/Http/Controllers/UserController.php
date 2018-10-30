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
}

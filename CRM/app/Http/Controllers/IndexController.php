<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends CommonController
{
    /** 桌面首页*/
    public function index(){
        $data=DB::table('crm_power')->where(['power_status'=>1])->get()->toArray();
        //$data=json_decode($data,true);
        return view('index',['data'=>$data]);
    }

}

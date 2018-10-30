<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends CommonController
{
    //客户添加列表
    public function user(){
        $data=DB::table('crm_area')->where(['pid'=>0])->get()->toArray();
        //dump($data);
        return view('user',['area'=>$data]);
    }
}

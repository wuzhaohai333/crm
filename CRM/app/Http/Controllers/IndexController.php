<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends CommonController
{
    /** 桌面首页*/
    public function index(Request $request){
        $data=json_decode(json_encode(DB::table('crm_power')->where(['power_status'=>1,'power_level'=>1])->get()),true);
        return view('index',['data' => $data]);
    }

}

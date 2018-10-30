<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommonController extends Controller
{
    //初始化数据
    public function __construct()
    {

//        $this->middleware(function ($request,$next) {
//            if(!$request->session()->has('admin_info')){
//                echo "<script>alert('请先登录！');location.href=('/')</script>";
//                exit;
//            }
////            $request->merge(['userinfo' => $arr]); //合并参数 在控制器中可以使用 request()->get('userinfo') 获取
////            $request->attributes->add(['userinfo' => $arr]);//添加参数  在控制器中可以使用request()->get('userinfo') 获取
//            return $next($request);
//        });
    }

    //获取员工id
    public function getUserId(Request $request){
        return $request->session()->get('admin_info')['id'];
    }
    //正确、错误提示
    public function hint($font,$code){
        return ['font'=>$font,'code'=>$code];
    }
    //获取$x天新增
    /**
     * @param $table  表名
     * @param $where  条件
     * @param int $day 天数
     * @return array
     */
    public function todayAdd($table,$where,$day=1){
        $name=substr($table,Strpos($table,'_')+1).'_ctime';
        $data=DB::table($table)->where($where)->get()->toArray();
        $arr=[];
        foreach ($data as $k=>$v) {
            echo time()-$v->$name.'/';
            if(time()-$v->$name<86400*$day){
                $arr[]=$v;
            }
        }
        return $arr;
    }
}

<?php
/**合同管理*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PactcateController extends CommonController
{

    //合同列表
    public function pactList(){
        //根据合同表查询展示数据
       $pact_data = DB::table('crm_contract')
           ->where(['contract_status'=>1])
           ->get();
        return view('pactcate.pactlist',['pact'=>$pact_data]);
    }
    /**
     * 客户列表
     */
    public function clientList($where){
        $info = DB::table('crm_user')
            ->where($where)
            ->get();
        return $info;
    }

    //客户列表页
    public function  pactlist_client(Request $request ){
        $where = ['user_status'=>1];
        $pact = $this->clientList($where);
        return view('pactcate.pactcate_client', ['pact' => $pact,]);

    }

}

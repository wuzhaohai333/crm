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

    /**
     * 客户列表页
     */
    public function  pactlist_client(){
        $where = ['user_status'=>1];
        $pact = $this->clientList($where);
        return view('pactcate.pactcate_client', ['pact' => $pact,]);

    }
    /**
     * 新增合同
     */
    public function pactcate_add( Request $request ){

        //生成合同编号
        $pact_code = 'HT'.time();
        //查询客户名称
        $user_id = intval($request->input('cid'));
        $user_info = DB::table('crm_user')->where(['id'=>$user_id])->first();
        return view('pactcate.pactcate_add',['pact_code'=>$pact_code,'user_info'=>$user_info]);
    }
    /**
     * 执行添加
     */
    public function pactcate_add_to(Request $request){
        $data = $request ->input('arr');

        $insert['user_id'] = $data['id'];
        $insert['contract_mark'] = $data['contract_mark'];
        $insert['contract_type'] = $data['contract_type'];
        $insert['order_mark'] = $data['order_mark'];
        $insert['begin_time']=strtotime($data['begin_time']);
        $insert['over_time']=strtotime($data['over_time']);
        $insert['contract_ctime'] = time();
        $insert['contract_status'] = 1;
        $insert['money'] = $data['money'];
        $insert['invoice'] = $data['invoice'];
        $insert['user_id'] = $data['id'];
        $insert['tax'] = $data['tax'];
        $insert['contract_details'] = $data['contract_details'];
        $row = DB::table('crm_contract')->insert($insert);
        if($row){
            return json_encode(['code'=>1000,'font'=>'合同添加成功']);
        }else{
            return json_encode(['code'=>1,'font'=>'合同添加失败']);
        }
    }
}

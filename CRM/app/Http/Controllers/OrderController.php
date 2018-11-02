<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class OrderController extends Controller
{
    //订单视图
    public function order(){
        $data=DB::table('crm_area')->where(['pid'=>0])->get()->toArray();
        $user=DB::table('crm_user')->where(['user_status'=>1])->get()->toArray();
        $link=DB::table('crm_linkman')->get()->toArray();
        return view('order',['area'=>$data,'link'=>$link,'user'=>$user]);
    }
    //订单列表
    public function orderList(){
        $arr=Input::get();
        $limit=($arr['page']-1)*$arr['limit'];
        $data=DB::table('crm_order')
            ->join('crm_user','crm_order.user_id','=','crm_user.id')
            ->offset($limit)->limit($arr['limit'])->where(['user_status'=>1])->get()->toArray();
        $count=DB::table('crm_order')->join('crm_user','crm_order.user_id','=','crm_user.id')->count();
        foreach($data as $k=>$v){
            $arr=DB::table('crm_linkman')->where(['link_id'=>$v->linkman])->first();
            $data[$k]->linkman=$arr->link_name;
            $data[$k]->order_ctime=date('Y-m-d',$v->order_ctime);
            $data[$k]->order_btime=date('Y-m-d',$v->order_btime);
            if($v->order_type==1){
                $data[$k]->order_type='待处理';
            }else if($v->order_type==2){
                $data[$k]->order_type='已处理';
            }else if($v->order_type==3){
                $data[$k]->order_type='未处理';
            }
        }
        echo json_encode(["code"=>0,"msg"=>"","count"=>$count,'data'=>$data]);
    }
    //订单添加
    public function orderAdd(){
        $arr=Input::get();
        //dump($arr);die;
        $order_arr=[
            'user_id'=>$arr['user_id'],
            'order_mark'=>$arr['order_mark'],
            'linkman'=>$arr['link_id'],
            'order_ctime'=>strtotime($arr['order_ctime']),
            'order_btime'=>strtotime($arr['order_btime']),
            'order_status'=>1,
            'order_remark'=>$arr['order_remark'],
            'order_type'=>1
        ];
        $res=DB::table('crm_order')->insert($order_arr);
        if($res){echo 1;}else{echo 2;}
    }
    //获取单号
    public function orderMark(){
        $id=Input::get('id');
        $orderMark=$this->order_no($id);
        echo $orderMark;
    }
    /** 生成订单号*/
    public function order_no($user_id)
    {
        $time = date('ymd');//时间
        //  $user_id = $this->getUid();  //用户id
        $user = strlen($user_id);
        if ($user < 4) {
            $new_user = str_repeat('0', 4 - $user) . $user_id;
        } else {
            $new_user = $user_id / 10000;
        }
        //用 业务线 时间  用户id  随机数四位
        $order_number = '1' . $time . $new_user . rand(0000, 9999);
        return $order_number;
    }
    /**修改订单状态按钮*/
    public function orderType($id){
        return view('orderType',['id'=>$id]);
    }
    /**修改订单状态*/
    public function upType(){
        $arr=Input::get();
        $where=[
            'id'=>$arr['id']
        ];
        $upArr=[
            'order_type'=>$arr['type']
        ];
        $res=DB::table('crm_order')->where($where)->update($upArr);
        if($res){echo 1;}else{echo 2;}
    }
    /**添加产品视图*/
    public function product($id){
        return view('product',['order_id'=>$id]);
    }
    /**添加产品*/
    public function productAdd(){
        $arr=Input::get();
        $newArr=[
            'product_name'=>$arr['product_name'],
            'price_cost'=>$arr['price_cost'],
            'price_sell'=>$arr['price_sell'],
            'product_num'=>$arr['product_num'],
            'discount'=>$arr['discount'],
            'price_sum'=>$arr['price_sum'],
            'status'=>1,
            'product_remark'=>$arr['product_remark'],
            'order_id'=>$arr['order_id']
        ];
        $res=DB::table('crm_product')->insert($newArr);
        if($res){echo 1;}else{echo 2;}
    }
}

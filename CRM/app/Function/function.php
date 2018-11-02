<?php
//自定义函数
//无限极分类（非静态）
function getTree($data , $pid = 0){
    $info = [];
    foreach($data as $k => $v){
        if($v['power_pid'] == $pid){
            $son = getTree($data , $v['id']);
            $v['son'] = $son;
            $info[] = $v;
        }
    }
    return $info;
}
//stdclass object格式 转数组
function object2array(&$object) {
    $object =  json_decode( json_encode( $object),true);
    return  $object;
}

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
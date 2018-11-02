<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <title>合同列表</title>
    <link rel="stylesheet" href="/layui/css/layui.css"  media="all">
    <script type="text/javascript" src="/layui/layui.js"></script>


</head>
<body>
<div style="margin: 15px;">
    <div class="layui-form-item">
        <label class="layui-form-label">关键字</label>

        <div class="layui-inline">
            <input type="text" name="" value="" id="date1" autocomplete="off" class="layui-input">
        </div>
        <div class="layui-inline">
            <button class="layui-btn">搜索</button>
        </div>

    </div>


    <button class="layui-btn layui-btn-danger">合同列表</button>
    <button class="layui-btn " onclick="popup('新增客户第一步:选择合同客户','pactlist_client')">新增合同</button>

</div>
<table class="layui-table" lay-size="sm" id="test" style="margin: 15px;width:98%;">
    <colgroup>
        <col width="150">
        <col width="200">
        <col>
    </colgroup>
    <thead>
    <tr>
        <th>合同编号</th>
        <th>合同分类</th>
        <th>订单编号</th>
        <th>起始时间</th>
        <th>到期时间</th>
        <th>金额</th>
        <th>提供发票</th>
        <th>管理</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pact as $v)
        <tr>
            <td>{{$v->contract_mark}}</td>
            <td>{{$v->contract_type}}</td>
            <td>{{$v->order_mark}}</td>
            <td>{{$v->begin_time}}</td>
            <td>{{$v->over_time}}</td>
            <td>{{$v->money}}</td>
            <td>{{$v->invoice}}</td>
            <td>
                <div class="layui-btn-group">
                    <button class="layui-btn layui-btn-sm" onclick="popup('合同修改','pactUpdate?pt_id={{$v->id}}')">修改</button>
                    <button class="layui-btn layui-btn-sm layui-btn-normal del" >删除</button>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
<script>
    layui.use('layer', function(){
        var layer = layui.layer;

    });
    //页面层
    function popup(title,url){

        layer.open({
            type: 2,
            shade: 0.3,
            title: title,
            shadeClose: true,
            maxmin: true, //开启最大化最小化按钮
            area: ['1000px', '500px'],
            content: '/index.php/'+url,
            end: function () {
                window.location.reload();
            }

        });

    }

</script>




</html>
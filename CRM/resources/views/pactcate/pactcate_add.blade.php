<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <title>新增客户</title>
    <script type="text/javascript" src="/win10/js/jquery-2.2.4.min.js"></script>
    <link href="/win10/component/layer-v3.0.3/Layui/css/layui.css" rel="stylesheet">
    <script type="text/javascript" src="/win10/js/win10.child.js"></script>
    <script type="text/javascript" src="/layui/layui.js"></script>
    <script type="text/javascript" src="/win10/component/layer-v3.0.3/Layui/layui.js"></script>
</head>
<body>
<form class="layui-form layui-form-pane" action="" style="margin-top: 20px;margin-left: 20px;">

    <div class="layui-form-item">
        <label class="layui-form-label">客户名称</label>

        <div class="layui-input-block">
            <input type="text" name="name" lay-verify="required" value="{{$client->client_name}}" placeholder="请输入"
                   autocomplete="off"
                   class="layui-input">
        </div>

    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">合同编号</label>

        <div class="layui-input-block">
            <input type="text" name="h_code" value="{{$pact_code}}" lay-verify="required" placeholder="请输入"
                   autocomplete="off"
                   class="layui-input">
        </div>

    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">合同分类</label>

        <div class="layui-input-inline">
            <select name="cls">
                @foreach( $category as $v)
                    <option value="{{$v->category_id}}">{{$v->category_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="layui-input-inline">
            <button class="layui-btn layui-btn-primary layui-btn-sm"
                    style="background:#5CAD69 ;color: #ffffff;margin-top:5px;">新增
            </button>
        </div>

    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">订单编号</label>

        <div class="layui-input-inline">
            <input type="text" name="order" value="" lay-verify="required" placeholder="请输入" autocomplete="off"
                   class="layui-input">
        </div>


    </div>

    <div class="layui-form-item">

        <label class="layui-form-label">合同结束时间</label>

        <div class="layui-inline">

            <div class="layui-input-inline">
                <input type="text" name="endtime" class="layui-input" id="test1" placeholder="请输入">
            </div>
        </div>

    </div>

    <div class="layui-form-item">


        <div class="layui-inline">
            <label class="layui-form-label" >已收款</label>

            <div class="layui-input-inline">
                <input type="text" name="money" class="layui-input" placeholder="请输入">
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label" >总金额</label>

            <div class="layui-input-inline">
                <input type="text" name="total_money" class="layui-input" placeholder="请输入">
            </div>
        </div>

    </div>

    <div class="layui-form-item">

        <label class="layui-form-label">是否提供发票</label>

        <div class="layui-input-inline">
            <input type="radio" name="invoice" value="1" title="是" checked="">
            <input type="radio" name="invoice" value="2" title="否">

        </div>
        <label class="layui-form-label">是否含税</label>

        <div class="layui-inline">
            <input type="radio" name="tax" value="1" title="是" checked="">
            <input type="radio" name="tax" value="2" title="否">
        </div>

    </div>
    <input type="hidden" name="client_id" value="{{$client->client_id}}">



    <div class="layui-form-item" style="text-align:center;">
        <button class="layui-btn" lay-submit="" lay-filter="*">保存</button>
        <button class="layui-btn" id="colse">关闭</button>
    </div>
</form>

</body>
<script>


    layui.use(['form', 'layedit', 'laydate'], function () {
        var form = layui.form
                , layer = layui.layer
                , laydate = layui.laydate; //日期


        //选择日期
        laydate.render({
            elem: '#test1'
            , format: 'yyyy-MM-dd HH:mm:ss' //可任意组合

        });

        //监听提交
        form.on('submit(*)', function (data) {

            $.ajax({
                url: 'pactcate_add_db',
                data: {
                    '_token': '{{csrf_token()}}',
                    arr:data.field
                },
                dataType: 'json',
                type: 'post',
                async: false,
                success: function (json_msg) {
                    if (json_msg.code == '1000') {
                        layui.layer.msg(json_msg.font, {icon: 6});

                    } else {
                        layui.layer.msg(json_msg.font, {icon: 5});
                    }
                }
            });
            return false;
        });

        //选择省的内容改变事件
        form.on('select(test)', function (data) {
//            console.log(data.elem); //得到select原始DOM对象
//            console.log(data.value); //得到被选中的值
//            console.log(data.othis); //得到美化后的DOM对象

            var region_id = data.value;
            var _tr = '<option value="">请选择市</option>';
            $.ajax({
                url: 'get_region',
                data: {
                    '_token': '{{csrf_token()}}',
                    'region_id': region_id
                },
                dataType: 'json',
                type: 'post',
                async: false,
                success: function (json_msg) {
                    for (v in json_msg.region) {

                        _tr += '<option value="' + json_msg.region[v]['region_id'] + '">'
                                + json_msg.region[v]['region_name']
                                + '</option>';
                    }


                }

            });
            //赋值
            $('#ciy').append(_tr);
            form.render('select');


        });


    });


</script>

</html>
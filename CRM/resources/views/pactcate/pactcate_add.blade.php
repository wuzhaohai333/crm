<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <title>新增客户</title>
    <script type="text/javascript" src="/win10ui/js/jquery-2.2.4.min.js"></script>
    <link rel="stylesheet" href="/layui/css/layui.css"  media="all">
    <script type="text/javascript" src="/win10ui/js/win10.child.js"></script>
    <script type="text/javascript" src="/layui/layui.js"></script>
    {{--<script type="text/javascript" src="/win10ui/component/layer-v3.0.3/Layui/layui.js"></script>--}}
</head>
<body>
<form class="layui-form layui-form-pane" action="" style="margin-top: 20px;margin-left: 20px;">

    <div class="layui-form-item">
        <label class="layui-form-label">客户名称</label>

        <div class="layui-input-block">
            <input type="text" name="name" lay-verify="required" value="{{$user_info->user_name}}" placeholder="请输入"
                   autocomplete="off"
                   class="layui-input">
        </div>

    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">合同编号</label>

        <div class="layui-input-block">
            <input type="text" name="contract_mark" value="{{$pact_code}}" lay-verify="required" placeholder="请输入"
                   autocomplete="off"
                   class="layui-input">
        </div>

    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">合同分类</label>

        <div class="layui-input-inline">
            <select name="contract_type">
                <option value="">请选择</option>
                <option value="1">租赁</option>
                <option value="2">工程</option>
                <option value="3">技术</option>
                <option value="4">委托</option>
                <option value="5">服务</option>
            </select>
        </div>


    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">订单编号</label>

        <div class="layui-input-inline">
            <input type="text" name="order_mark" value="" lay-verify="required" placeholder="请输入" autocomplete="off"
                   class="layui-input">
        </div>


    </div>
    <div class="layui-form-item">

        <label class="layui-form-label">开始时间</label>

        <div class="layui-inline">

            <div class="layui-input-inline">
                <input type="text" name="begin_time" class="layui-input" id="test1" placeholder="请输入">
            </div>
        </div>

    </div>

    <div class="layui-form-item">

        <label class="layui-form-label">结束时间</label>

        <div class="layui-inline">

            <div class="layui-input-inline">
                <input type="text" name="over_time" class="layui-input" id="test1" placeholder="请输入">
            </div>
        </div>

    </div>

    <div class="layui-form-item">

        <div class="layui-inline">
            <label class="layui-form-label" >总金额</label>

            <div class="layui-input-inline">
                <input type="text" name="money" class="layui-input" placeholder="请输入">
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
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">合同详情</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入内容" name="contract_details" class="layui-textarea"></textarea>
        </div>
    </div>

    <input type="hidden" name="id" value="{{$user_info->id}}">



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
                url: 'pactcate_add_to',
                data: {
                    '_token': '{{csrf_token()}}',
                    arr:data.field
                },
                dataType: 'json',
                type: 'post',
                async: false,
                success: function (json_msg) {
                    alert(json_msg);
                    return false;
                    if (json_msg.code == '1000') {
                        layui.layer.msg(json_msg.font, {icon: 6});

                    } else {
                        layui.layer.msg(json_msg.font, {icon: 5});
                    }
                }
            });
            return false;
        });

    });


</script>

</html>
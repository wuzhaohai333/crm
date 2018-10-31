<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="/layui/css/layui.css"  media="all">
    <script src="/layui/layui.js" charset="utf-8"></script>
    <script src="/win10ui\js\jquery-2.2.4.min.js"></script>
</head>
<body>
    <form class="layui-form" action="">

    <div class="layui-form-item">
        <label class="layui-form-label">客户名称</label>
        <div class="layui-input-block">
            @foreach($user_info as $value)
                <input type="hidden" value="{{$value['user_id']}}">
                <input type="text" name="title" value="{{$value['user_name']}}" lay-verify="title"  class="layui-input">
            @endforeach
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">跟单类型</label>
        <div class="layui-input-block" style="width: 200px">
            <select name="odd_type" lay-filter="aihao">
                <option value=""></option>
                <option value="1">电话跟进</option>
                <option value="2">上门拜访</option>
                <option value="3">QQ交谈</option>
                <option value="4">Email邮件</option>
                <option value="5">微信</option>
            </select>
        </div>
    </div>

    <div class="layui-form-item">
            <label class="layui-form-label">跟单进度</label>
            <div class="layui-input-block" style="width: 200px">
                <select name="odd_plan" lay-filter="aihao">
                    <option value=""></option>
                    <option value="1">已成交</option>
                    <option value="2">未成交</option>
                    <option value="3">跟进中</option>
                    <option value="4">有意向</option>
                </select>
            </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">跟单对象</label>
        <div class="layui-input-block" style="width: 200px">
            <select name="odd_plan" lay-filter="aihao">
                <option value=""></option>
                <option value="1">小阳</option>
                <option value="2">小李</option>
                <option value="3">小东</option>
            </select>
        </div>
    </div>

        <div class="layui-inline">
            <label class="layui-form-label">中文版</label>
            <div class="layui-input-inline">
                <input type="text" class="layui-input" id="test1" placeholder="">
            </div>
        </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">普通文本域</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入内容" class="layui-textarea"></textarea>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
</body>
</html>
<script>
    layui.use(['form', 'layedit', 'laydate'], function() {
        var form = layui.form
                , layer = layui.layer
                , layedit = layui.layedit
                , laydate = layui.laydate;
        //常规用法
        laydate.render({
            elem: '#test1'
        });

        //监听提交
        form.on('submit(demo1)', function (data) {
            layer.alert(JSON.stringify(data.field), {
                title: '最终的提交信息'
            })
            return false;
        });
    });
</script>
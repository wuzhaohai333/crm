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
                <input type="hidden" name="id" value="{{$value['id']}}">
                <input type="text" name="user_name" disabled value="{{$value['user_name']}}" lay-verify="title"  class="layui-input">
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
            <select name="odd_object" lay-filter="aihao">
                <option value=""></option>
                <option value="1">小阳</option>
                <option value="2">小李</option>
                <option value="3">小东</option>
            </select>
        </div>
    </div>

    <div class="layui-inline layui-form-item layui-form-text">
        <label class="layui-form-label">下次联系</label>
        <div class="layui-input-inline">
            <input type="text" name="next_time" class="layui-input" id="test1" placeholder="联系时间">
        </div>
        <label class="layui-form-label">提前</label>
        <div class="layui-input-inline">
            <select name="first" lay-filter="aihao">
                <option value="1">1小时</option>
                <option value="2">2小时</option>
                <option value="3">3小时</option>
                <option value="4">1&nbsp;&nbsp;&nbsp;天</option>
                <option value="5">2&nbsp;&nbsp;&nbsp;天</option>
            </select>
        </div>
        <label class="layui-form-label">提醒</label>
    </div>

    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">普通文本域</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入内容" name="details" class="layui-textarea"></textarea>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            &nbsp;&nbsp;&nbsp;<a href="with">返回上页</a>
        </div>
    </div>
</form>
</body>
</html>

<script>
    layui.use(['form', 'layedit', 'laydate','layer'], function() {
        var form = layui.form
                , layer = layui.layer
                , layedit = layui.layedit
                , laydate = layui.laydate;
        //常规用法
        laydate.render({
            elem: '#test1'
            ,format: 'yyyy-MM-dd HH:mm:ss' //可任意组合
        });

        //监听提交
        form.on('submit(demo1)', function (data) {
            $.ajax({
                url:'oddAdd',
                data:{'_token':'{{csrf_token()}}',data:data.field},
                type:'post',
                dataType:'json',
                success:function(json){
                    if(json == 1){
                        layer.msg('添加成功',{icon:1,time:2000},function(){
                            window.location.href='with';
                        })
                    }else {
                        lauer.msg('添加失败',{icon:2}, function () {
                            window.location.href=history.go(0);
                        })
                    }

                }
            })
            return false;
        });
    });
</script>
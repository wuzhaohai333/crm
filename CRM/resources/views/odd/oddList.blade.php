<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/layui/css/layui.css"  media="all">
    <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>

<div class="layui-tab layui-tab-card">
    <ul class="layui-tab-title">
        <li class="layui-this">跟单列表</li>
        <li>今日需跟进</li>
        <li>近七天需跟进</li>
        <li>近七天跟进记录</li>
        <li>本月跟单记录</li>
        <li>
            <button data-method="notice" class="layui-btn">新增跟单</button>
        </li>
    </ul>
    <div class="layui-tab-content" style="height: 100px;">
        <div class="layui-tab-item layui-show">
            跟单列表
        </div>
        <div class="layui-tab-item">
            今日需跟进
        </div><div class="layui-tab-item">
            近七天需跟进
        </div><div class="layui-tab-item">
            近七天跟进记录
        </div><div class="layui-tab-item">
            本月跟单记录
        </div>
        <div class="layui-tab-item">
            {{--新增跟单--}}
            <form class="layui-form" action="">
                <div class="layui-form-item">
                    <label class="layui-form-label">权限名称：</label>
                    <div class="layui-input-block">
                        <input style="width:300px;" type="text"  name="name" required  lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input">
                    </div>

                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">权限url：</label>
                    <div class="layui-input-inline">
                        <input style="width:300px;" type="text" name="url" required lay-verify="url" placeholder="请输入网址" autocomplete="off" class="layui-input">
                    </div>
                    <!--<div class="layui-form-mid layui-word-aux">请输入品牌网址</div>&lt;!&ndash;辅助文字&ndash;&gt;-->
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">权限图像：</label>
                    <div class="layui-input-inline">
                        <input style="width:300px;" type="text" name="img" required lay-verify="url" placeholder="请输入图像网址" autocomplete="off" class="layui-input">
                    </div>

                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">是否启用：</label>
                    <div class="layui-input-block">
                        <input type="radio" name="sex" value="1" title="是" checked="">
                        <input type="radio" name="sex" value="2" title="否">

                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="button" class="layui-btn" lay-submit lay-filter="*">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>


<script src="/layui/layui.js" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.use(['element','form'], function(){
        var element = layui.element;//选项卡
        var form = layui.form;//表单

        form.on('submit(*)',function(data){
//                    console.log(data.field);  //表单所有值
            $.ajax({
                type:'post',
                url:"/oddAdd",
                data:data.field,
                async:false,//异步
                success:function(msg){
                    if(msg.status == 0){
                        layer.msg(msg.msg,{icon:5});
                        return false;
                    }else if(msg.status == 1000){
                        layer.confirm(
                                msg.msg,//提示的文字
                                {
                                    //两个按钮
                                    btn:['继续添加','查看权限列表'],
                                    //按钮一的回调（点击按钮一执行的东西）
                                    yes:function (index){
                                        window.history.go(0);
                                    },
                                    //按钮二的回调（点击按钮二执行的东西）
                                    btn2: function(){
                                        window.location.href=("/powerList");
                                    }
                                }
                        );
                    }
                },
                dataType:'json',
            });
//                    return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        });

    });
</script>

</body>
</html>
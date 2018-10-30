<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <title>layui</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/layui/css/layui.css"  media="all">
    <script type="text/javascript" src="/win10ui/js/jquery-2.2.4.min.js"></script>
    <!-- 注意：如果你直接复制所有代码到本地，上述css路径需要改成你本地的 -->
</head>
<body>


<fieldset class="layui-elem-field layui-field-title" style="margin-top: 50px;">
    <legend>管理员管理</legend>
</fieldset>
<div class="layui-tab layui-tab-card">
    <ul class="layui-tab-title">
        <li class="layui-this">管理员添加</li>
        <li>管理员列表</li>
    </ul>
    <div class="layui-tab-content" style="height: 100px;">
        <div class="layui-tab-item layui-show">
            {{--管理员添加的表单--}}
            <form class="layui-form">
                @csrf
                <div class="layui-form-item">
                    <label class="layui-form-label">管理员账号：</label>
                    <div class="layui-input-block">
                        <input style="width:300px;" type="text"  name="name" required  lay-verify="required" placeholder="请输入账号" autocomplete="off" class="layui-input">
                    </div>

                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">密码：</label>
                    <div class="layui-input-inline">
                        <input style="width:300px;" type="text" name="pwd" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                    </div>
                    <!--<div class="layui-form-mid layui-word-aux">请输入品牌网址</div>&lt;!&ndash;辅助文字&ndash;&gt;-->
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">联系方式：</label>
                    <div class="layui-input-inline">
                        <input style="width:300px;" type="text" name="phone" required lay-verify="required|phone" placeholder="请输入你的联系方式" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">邮箱：</label>
                    <div class="layui-input-inline">
                        <input style="width:300px;" type="text" name="email" required lay-verify="email|required" placeholder="请输入邮箱" autocomplete="off" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item" style="width: 410px">
                    <label class="layui-form-label">所属部门：</label>
                    <div class="layui-input-block">
                        <select name="branch" lay-verify="required">
                            @foreach($branch as $v)
                                <option value="{{$v['id']}}">{{$v['branch_name']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="layui-form-item" style="width: 410px">
                    <label style="margin-left:25%" class="layui-form-label">选择角色：</label>
                    <div style="margin-left: 33%"  class="layui-form-item" pane="">
                        @foreach($role as $v)
                            <fieldset class="layui-elem-field">
                                <legend>
                                    <input type="checkbox" name="role[]" lay-verify="required" value="{{$v['id']}}" class="parent" lay-filter="q" lay-skin="primary" title="{{$v['role_name']}}">
                                </legend>
                                <div class="layui-field-box">
                                    {{$v['power_all']}}
                                </div>
                            </fieldset>
                        @endforeach
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

        <div class="layui-tab-item">
            {{--管理员列表--}}
            <table class="layui-table" lay-data="{height:315,url:'/adminData',page:true,id:'test',limit:3,limits:[3,5,10,15]}" lay-filter="test">
                <thead>
                <tr>
                    <th lay-data="{field:'id', width:80, sort: true}">ID</th>
                    <th lay-data="{field:'admin_name', width:80,edit:true}">管理员名</th>
                    <th lay-data="{field:'admin_url', width:80,edit:true}">url</th>
                    <th lay-data="{field:'admin_ctime'}">添加时间</th>
                    <th lay-data="{field:'admin_utime'}">最后一次修改时间</th>
                    <th lay-data="{field:'admin_status'}">是否启用</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script src="/layui/layui.js" charset="utf-8"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.use(['element','form','table','layer'], function(){
        var layer = layui.layer;//弹出层
        var element = layui.element;//选项卡
        var form = layui.form;//表单
        var table = layui.table;//数据表格
        //监听表单提交
        form.on('submit(*)',function(data){
//                    console.log(data.field);  //表单所有值
            $.ajax({
                type:'post',
                url:"/adminAdd",
                data:data.field,
                async:false,//异步
                dataType:'json',
                success:function(msg){
                    if(msg.code == 0){
                        layer.msg(msg.font,{icon:5});
                        return false;
                    }else if(msg.code == 1000){
                        layer.confirm(
                                msg.font,//提示的文字
                                {
                                    //两个按钮
                                    btn:['继续添加','查看管理员列表'],
                                    //按钮一的回调（点击按钮一执行的东西）
                                    yes:function (index){
                                        window.history.go(0);
                                    },
                                    //按钮二的回调（点击按钮二执行的东西）
                                    btn2: function(){
                                        window.location.href=("/adminList");
                                    }
                                }
                        );
                    }
                },

            });
//                    return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
        });
        //监听单元格编辑
        table.on('edit(test)', function(obj){ //注：edit是固定事件名，test是table原始容器的属性 lay-filter="对应的值"
            console.log(obj.value); //得到修改后的值
            console.log(obj.field); //当前编辑的字段名
            console.log(obj.data); //所在行的所有相关数据
            $.ajax({
                type:'post',
                url:"/adminUpdate",
                data:{info:obj},
                async:false,//异步
                dataType:'json',
                success:function(msg){
                    if(msg.code == 1000){
                        layer.msg(msg.font);
                    }
                },

            });

        });

    });
</script>

</body>
</html>
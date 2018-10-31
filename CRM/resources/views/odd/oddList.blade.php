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
    <style>
        .Findtip{
            margin-left:40%;
            color: red;
            border: 1px;
        }
    </style>
</head>
<body>

<div class="layui-tab layui-tab-card">
    <ul class="layui-tab-title">
        <li class="layui-this">跟单列表</li>
        <li>今日需跟进</li>
        <li>近七天需跟进</li>
        <li>近七天跟进记录</li>
        <li>本月跟单记录</li>
        <li>新增跟单</li>
    </ul>
    <div class="layui-tab-content" style="height: 100px;">
        <div class="layui-tab-item layui-show">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_1">
                <tbody><tr>
                    <td class="td_l_r title">关键字</td>
                    <td class="td_r_l">
                        <span id="ss_suggest" style="display:none;"></span>名称
                        <input name="keyword" type="text" class="int" id="keyword" size="20" value="" onkeyup="searchSuggest();">

                        <select name="type"  class="Select_Type"  title="Select Travel Destination"><option value="">客户类型</option>
                            <option value="1">已成交</option>
                            <option value="2">未成交</option>
                            <option value="3">跟进中</option>
                            <option value="4">有意向</option>
                        </select>
                        <select name="start" class="Select_Type" title="Select Travel Destination"><option value="">客户级别</option>
                            <option value="1">★★★★★</option>
                            <option value="2">★★★★</option>
                            <option value="3">★★★</option>
                            <option value="4">★★</option>
                            <option value="5">★</option>
                        </select>
                        <select name="source" id="Select_source" class="Select_Type"><option value="">客户来源</option>
                            <option value="1">电话营销</option>
                            <option value="2">搜索引擎</option>
                            <option value="3">朋友介绍</option>
                            <option value="4">其它来源</option>
                        </select>
                        <select name="adduser" class="int Select_Type"><option value="">业务员</option>
                            <option value="1">小阳</option>
                            <option value="2">刘总监</option>
                            <option value="3">测试111</option>
                            <option value="4">ceshi2</option>
                            <option value="4">显示</option>
                        </select>
                        所在地区
                        <select name="adduser" class="int Select_Type"><option value="">请选择</option>
                            <option value="1">河北</option>
                        </select>省
                        <select name="adduser" class="int Select_Type"><option value="">请选择</option>
                            <option value="1">邯郸</option>
                        </select>市
                        <input type="submit" name="Submit" id="ss_button" class="btn1 btnxiug layui-btn layui-btn-sm" value="搜索">
                        <input type="button" class="btn1 btnxiug layui-btn layui-btn-sm" value="清空条件" onclick="window.location.href=&quot;?&quot;">
                        <input type="button" class="btn1 btnxiug layui-btn layui-btn-sm" value="导出" onclick="window.location.href=&quot;http://phpcrm.tutula.cn/index.php/customer/excel?mobile=&amp;type=&amp;start=&amp;adduser=&amp;linkman=&amp;state=&amp;tel=&amp;timetype=&amp;source=&amp;trade=&amp;address=&amp;keyword=&amp;sttdate=&amp;enddate=&amp;area1=&amp;area2=&quot;">
                    </td>
                </tr>
                </tbody></table>
            {{--跟单列表--}}
            <table class="layui-table">
                <thead>
                <tr>
                    <th>编号</th>
                    <th>客户名称</th>
                    <th>跟单类型</th>
                    <th>跟单进度</th>
                    <th>跟单对象</th>
                    <th>下次联系</th>
                    <th>详细内容</th>
                    <th>业务员</th>
                    <th>录入时间</th>
                    <th>管理</th>
                </tr>
                </thead>
                <tbody>
                @foreach($odd_data as $value)
                    <tr>
                        <td>{{$value['odd_id']}}</td>
                        <td>{{$value['user_name']}}</td>
                        <td>{{$value['odd_type']}}</td>
                        <td>{{$value['odd_plan']}}</td>
                        <td>{{$value['odd_object']}}</td>
                        <td>{{$value['next_time']}}</td>
                        <td>{{$value['details']}}</td>
                        <td>小阳</td>
                        <td>{{$value['odd_ctime']}}</td>
                        <td>
                            <button>修改</button>
                            <button>删除</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="layui-tab-item">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_1">
                <tbody><tr>
                    <td class="td_l_r title">关键字</td>
                    <td class="td_r_l">
                        <span id="ss_suggest" style="display:none;"></span>名称
                        <input name="keyword" type="text" class="int" id="keyword" size="20" value="" onkeyup="searchSuggest();">

                        <select name="type"  class="Select_Type"  title="Select Travel Destination"><option value="">客户类型</option>
                            <option value="1">已成交</option>
                            <option value="2">未成交</option>
                            <option value="3">跟进中</option>
                            <option value="4">有意向</option>
                        </select>
                        <select name="start" class="Select_Type" title="Select Travel Destination"><option value="">客户级别</option>
                            <option value="1">★★★★★</option>
                            <option value="2">★★★★</option>
                            <option value="3">★★★</option>
                            <option value="4">★★</option>
                            <option value="5">★</option>
                        </select>
                        <select name="source" id="Select_source" class="Select_Type"><option value="">客户来源</option>
                            <option value="1">电话营销</option>
                            <option value="2">搜索引擎</option>
                            <option value="3">朋友介绍</option>
                            <option value="4">其它来源</option>
                        </select>
                        <select name="adduser" class="int Select_Type"><option value="">业务员</option>
                            <option value="1">小阳</option>
                            <option value="2">刘总监</option>
                            <option value="3">测试111</option>
                            <option value="4">ceshi2</option>
                            <option value="4">显示</option>
                        </select>
                        所在地区
                        <select name="adduser" class="int Select_Type"><option value="">请选择</option>
                            <option value="1">河北</option>
                        </select>省
                        <select name="adduser" class="int Select_Type"><option value="">请选择</option>
                            <option value="1">邯郸</option>
                        </select>市
                        <input type="submit" name="Submit" id="ss_button" class="btn1 btnxiug layui-btn layui-btn-sm" value="搜索">
                        <input type="button" class="btn1 btnxiug layui-btn layui-btn-sm" value="清空条件" onclick="window.location.href=&quot;?&quot;">
                        <input type="button" class="btn1 btnxiug layui-btn layui-btn-sm" value="导出" onclick="window.location.href=&quot;http://phpcrm.tutula.cn/index.php/customer/excel?mobile=&amp;type=&amp;start=&amp;adduser=&amp;linkman=&amp;state=&amp;tel=&amp;timetype=&amp;source=&amp;trade=&amp;address=&amp;keyword=&amp;sttdate=&amp;enddate=&amp;area1=&amp;area2=&quot;">
                    </td>
                </tr>
                </tbody></table>
            今日需跟进
        </div>
        <div class="layui-tab-item">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_1">
                <tbody><tr>
                    <td class="td_l_r title">关键字</td>
                    <td class="td_r_l">
                        <span id="ss_suggest" style="display:none;"></span>名称
                        <input name="keyword" type="text" class="int" id="keyword" size="20" value="" onkeyup="searchSuggest();">

                        <select name="type"  class="Select_Type"  title="Select Travel Destination"><option value="">客户类型</option>
                            <option value="1">已成交</option>
                            <option value="2">未成交</option>
                            <option value="3">跟进中</option>
                            <option value="4">有意向</option>
                        </select>
                        <select name="start" class="Select_Type" title="Select Travel Destination"><option value="">客户级别</option>
                            <option value="1">★★★★★</option>
                            <option value="2">★★★★</option>
                            <option value="3">★★★</option>
                            <option value="4">★★</option>
                            <option value="5">★</option>
                        </select>
                        <select name="source" id="Select_source" class="Select_Type"><option value="">客户来源</option>
                            <option value="1">电话营销</option>
                            <option value="2">搜索引擎</option>
                            <option value="3">朋友介绍</option>
                            <option value="4">其它来源</option>
                        </select>
                        <select name="adduser" class="int Select_Type"><option value="">业务员</option>
                            <option value="1">小阳</option>
                            <option value="2">刘总监</option>
                            <option value="3">测试111</option>
                            <option value="4">ceshi2</option>
                            <option value="4">显示</option>
                        </select>
                        所在地区
                        <select name="adduser" class="int Select_Type"><option value="">请选择</option>
                            <option value="1">河北</option>
                        </select>省
                        <select name="adduser" class="int Select_Type"><option value="">请选择</option>
                            <option value="1">邯郸</option>
                        </select>市
                        <input type="submit" name="Submit" id="ss_button" class="btn1 btnxiug layui-btn layui-btn-sm" value="搜索">
                        <input type="button" class="btn1 btnxiug layui-btn layui-btn-sm" value="清空条件" onclick="window.location.href=&quot;?&quot;">
                        <input type="button" class="btn1 btnxiug layui-btn layui-btn-sm" value="导出" onclick="window.location.href=&quot;http://phpcrm.tutula.cn/index.php/customer/excel?mobile=&amp;type=&amp;start=&amp;adduser=&amp;linkman=&amp;state=&amp;tel=&amp;timetype=&amp;source=&amp;trade=&amp;address=&amp;keyword=&amp;sttdate=&amp;enddate=&amp;area1=&amp;area2=&quot;">
                    </td>
                </tr>
                </tbody></table>
            近七天需跟进
        </div>
        <div class="layui-tab-item">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_1">
                <tbody><tr>
                    <td class="td_l_r title">关键字</td>
                    <td class="td_r_l">
                        <span id="ss_suggest" style="display:none;"></span>名称
                        <input name="keyword" type="text" class="int" id="keyword" size="20" value="" onkeyup="searchSuggest();">

                        <select name="type"  class="Select_Type"  title="Select Travel Destination"><option value="">客户类型</option>
                            <option value="1">已成交</option>
                            <option value="2">未成交</option>
                            <option value="3">跟进中</option>
                            <option value="4">有意向</option>
                        </select>
                        <select name="start" class="Select_Type" title="Select Travel Destination"><option value="">客户级别</option>
                            <option value="1">★★★★★</option>
                            <option value="2">★★★★</option>
                            <option value="3">★★★</option>
                            <option value="4">★★</option>
                            <option value="5">★</option>
                        </select>
                        <select name="source" id="Select_source" class="Select_Type"><option value="">客户来源</option>
                            <option value="1">电话营销</option>
                            <option value="2">搜索引擎</option>
                            <option value="3">朋友介绍</option>
                            <option value="4">其它来源</option>
                        </select>
                        <select name="adduser" class="int Select_Type"><option value="">业务员</option>
                            <option value="1">小阳</option>
                            <option value="2">刘总监</option>
                            <option value="3">测试111</option>
                            <option value="4">ceshi2</option>
                            <option value="4">显示</option>
                        </select>
                        所在地区
                        <select name="adduser" class="int Select_Type"><option value="">请选择</option>
                            <option value="1">河北</option>
                        </select>省
                        <select name="adduser" class="int Select_Type"><option value="">请选择</option>
                            <option value="1">邯郸</option>
                        </select>市
                        <input type="submit" name="Submit" id="ss_button" class="btn1 btnxiug layui-btn layui-btn-sm" value="搜索">
                        <input type="button" class="btn1 btnxiug layui-btn layui-btn-sm" value="清空条件" onclick="window.location.href=&quot;?&quot;">
                        <input type="button" class="btn1 btnxiug layui-btn layui-btn-sm" value="导出" onclick="window.location.href=&quot;http://phpcrm.tutula.cn/index.php/customer/excel?mobile=&amp;type=&amp;start=&amp;adduser=&amp;linkman=&amp;state=&amp;tel=&amp;timetype=&amp;source=&amp;trade=&amp;address=&amp;keyword=&amp;sttdate=&amp;enddate=&amp;area1=&amp;area2=&quot;">
                    </td>
                </tr>
                </tbody></table>
            近七天跟进记录
        </div>
        <div class="layui-tab-item">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_1">
                <tbody><tr>
                    <td class="td_l_r title">关键字</td>
                    <td class="td_r_l">
                        <span id="ss_suggest" style="display:none;"></span>名称
                        <input name="keyword" type="text" class="int" id="keyword" size="20" value="" onkeyup="searchSuggest();">

                        <select name="type"  class="Select_Type"  title="Select Travel Destination"><option value="">客户类型</option>
                            <option value="1">已成交</option>
                            <option value="2">未成交</option>
                            <option value="3">跟进中</option>
                            <option value="4">有意向</option>
                        </select>
                        <select name="start" class="Select_Type" title="Select Travel Destination"><option value="">客户级别</option>
                            <option value="1">★★★★★</option>
                            <option value="2">★★★★</option>
                            <option value="3">★★★</option>
                            <option value="4">★★</option>
                            <option value="5">★</option>
                        </select>
                        <select name="source" id="Select_source" class="Select_Type"><option value="">客户来源</option>
                            <option value="1">电话营销</option>
                            <option value="2">搜索引擎</option>
                            <option value="3">朋友介绍</option>
                            <option value="4">其它来源</option>
                        </select>
                        <select name="adduser" class="int Select_Type"><option value="">业务员</option>
                            <option value="1">小阳</option>
                            <option value="2">刘总监</option>
                            <option value="3">测试111</option>
                            <option value="4">ceshi2</option>
                            <option value="4">显示</option>
                        </select>
                        所在地区
                        <select name="adduser" class="int Select_Type"><option value="">请选择</option>
                            <option value="1">河北</option>
                        </select>省
                        <select name="adduser" class="int Select_Type"><option value="">请选择</option>
                            <option value="1">邯郸</option>
                        </select>市
                        <input type="submit" name="Submit" id="ss_button" class="btn1 btnxiug layui-btn layui-btn-sm" value="搜索">
                        <input type="button" class="btn1 btnxiug layui-btn layui-btn-sm" value="清空条件" onclick="window.location.href">
                        <input type="button" class="btn1 btnxiug layui-btn layui-btn-sm" value="导出" onclick="window.location.href">
                    </td>
                </tr>
                </tbody></table>
            本月跟单记录
        </div>
        <div class="layui-tab-item">
            <div class="Findtip">①单击选中客户 &gt;&gt; ②录入信息</div>
            <table class="layui-table">
                <thead>
                <tr>
                    <th><input type="checkbox"></th>
                    <th>编号</th>
                    <th>客户名称</th>
                    <th>联系QQ</th>
                    <th>联系人</th>
                    <th>手机号</th>
                    <th>最后更新</th>
                    <th>总金额</th>
                    <th>总欠款</th>
                    <th>售后次数</th>
                    <th>业务员</th>
                    <th>新增</th>
                </tr>
                </thead>
                <tbody>
                @foreach($info as $value)
                <tr class="add" user_id="{{$value['user_id']}}">
                    <td><input type="checkbox"></td>
                    <td>{{$value['user_id']}}</td>
                    <td>{{$value['user_name']}}</td>
                    <td>{{$value['user_qq']}}</td>
                    <td>{{$value['user_linkman']}}</td>
                    <td>{{$value['user_qq']}}</td>
                    @if($value['user_utime'] > 3600*24)
                        <td>{{ceil($value['user_utime']/60)}}天前</td>
                    @elseif($value['user_utime'] > 3600)
                        <td>{{ceil($value['user_utime']/3600)}}小时前</td>
                    @elseif($value['user_utime'] > 60)
                        <td>{{ceil($value['user_utime']/60)}}分钟前</td>
                    @endif
                    <td>元</td>
                    <td>元</td>
                    <td>1</td>
                    <td>小阳</td>
                    <td><a href="oddAdd?user_id={{$value['user_id']}}&user_name={{$value['user_name']}}">添加</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="/layui/layui.js" charset="utf-8"></script>
<script src="/win10ui\js\jquery-2.2.4.min.js"></script>
<!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
<script>
    layui.use(['element','form'], function(){
        var element = layui.element;//选项卡
        var form = layui.form;//表单
        var table = layui.table;//数据表格
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
                                        window.location.href=("/oddAdd");
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
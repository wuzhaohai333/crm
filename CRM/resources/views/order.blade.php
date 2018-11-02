<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>订单</title>
    <link rel="stylesheet" href="{{URL::asset('layui/css/layui.css')}}">
    <style>
        .table_1 { border-left: 1px solid #E1E2E4; border-bottom: 1px solid #E1E2E4; }
        .title {
            background-color: #EFF0EF;
            width: 60px;
        }
        .td_l_r {
            text-align: right;
            border-right: 1px solid #E1E2E4;
            border-top: 1px solid #E1E2E4;
            height: 35px;
            padding-top: 0px;
            padding-bottom: 0px;
            padding-right: 10px;
        }
        .td_r_l {
            text-align: left;
            border-right: 1px solid #E1E2E4;
            border-top: 1px solid #E1E2E4;
            padding-left: 10px;
            height: 35px;
            padding-top: 0px;
            padding-bottom: 0px;
        }
        .int {
            min-height: 25px;
            line-height: 25px;
            font-size: 12px;
        }
        .Wdate {
            height: 25px;
        }
        /* SELECT W/IMAGE */
        select.Select_Type
        {
            width                    : 6.5em;
            height                   : 2.2em;
            padding                  : 0.2em 0.4em 0.2em 0.4em;
            vertical-align           : middle;
            border                   : 1px solid #e9e9e9;
            -moz-border-radius       : 0.2em;
            -webkit-border-radius    : 0.2em;
            border-radius            : 0.2em;
            box-shadow               : inset 0 0 3px #a0a0a0;
            -webkit-appearance       : none;
            -moz-appearance          : none;
            appearance               : none;
            /* sample image from the webinfocentral.com */
            background               : url(http://webinfocentral.com/Images/favicon.ico) 95% / 10% no-repeat #fdfdfd;
            font-family              : Arial,  Calibri, Tahoma, Verdana;
            font-size                : 1.1em;
            color                    : #000099;
            cursor                   : pointer;
        }
        select.Select_Type  option
        {
            font-size               : 1em;
            padding                 : 0.2em 0.4em 0.2em 0.4em;
        }
        select.Select_Type  option[selected]{ font-weight:bold}
        select.Select_Type  option:nth-child(even) { background-color:#f5f5f5; }
        select.Select_Type:hover
        {
            color                   : #101010;
            border                  : 1px solid #cdcdcd;
        }
        select.Select_Type:focus {box-shadow: 0 0 2px 1px #404040;}

        /*SELECT W/DOWN-ARROW*/
        select#selectPointOfInterest
        {
            width                    : 185pt;
            height                   : 40pt;
            line-height              : 40pt;
            padding-right            : 20pt;
            text-indent              : 4pt;
            text-align               : left;
            vertical-align           : middle;
            box-shadow               : inset 0 0 3px #606060;
            border                   : 1px solid #acacac;
            -moz-border-radius       : 6px;
            -webkit-border-radius    : 6px;
            border-radius            : 6px;
            -webkit-appearance       : none;
            -moz-appearance          : none;
            appearance               : none;
            font-family              : Arial,  Calibri, Tahoma, Verdana;
            font-size                : 18pt;
            font-weight              : 500;
            color                    : #000099;
            cursor                   : pointer;
            outline                  : none;
        }
        select#selectPointOfInterest option
        {
            padding             : 4px 10px 4px 10px;
            font-size           : 11pt;
            font-weight         : normal;
        }
        select#selectPointOfInterest option[selected]{ font-weight:bold}
        select#selectPointOfInterest option:nth-child(even) { background-color:#f5f5f5; }
        select#selectPointOfInterest:hover {font-weight: 700;}
        select#selectPointOfInterest:focus {box-shadow: inset 0 0 5px #000099; font-weight: 600;}

        /*LABEL FOR SELECT*/
        label#lblSelect{ position: relative; display: inline-block;}
        /*DOWNWARD ARROW (25bc)*/
        label#lblSelect::after
        {
            content                 : "\25bc";
            position                : absolute;
            top                     : 0;
            right                   : 0;
            bottom                  : 0;
            width                   : 20pt;
            line-height             : 40pt;
            vertical-align          : middle;
            text-align              : center;
            background              : #000099;
            color                   : #fefefe;
            -moz-border-radius       : 0 6px 6px 0;
            -webkit-border-radius    : 0 6px 6px 0;
            border-radius           : 0 6px 6px 0;
            pointer-events          : none;
        }
    </style>
</head>
<script src="{{URL::asset('layui/layui.js')}}"></script>
<script src="{{URL::asset('layui/js.js')}}"></script>
<body>
<div class="layui-tab layui-tab-card">
    <ul class="layui-tab-title">
        <li class="layui-this">订单列表</li>
        <li>今日新增</li>
        <li>近7天新增</li>
        <li>本月新增</li>
        <li>新增订单</li>
    </ul>
    <div class="layui-tab-content" style="height: 100px;">
        <div class="layui-tab-item layui-show">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_1">
                <tbody><tr>
                    <td class="td_l_r title">关键字</td>
                    <td class="td_r_l">
                        <span id="ss_suggest" style="display:none;"></span>名称
                        <input name="keyword" type="text" class="int" id="keyword" size="20" value="" onkeyup="searchSuggest();">

                        <select name="type"  class="Select_Type"  title="Select Travel Destination"><option value="">客户状态</option>
                            <option value="1">已处理</option>
                            <option value="2">处理中</option>
                            <option value="3">未处理</option>
                        </select>
                        <select name="adduser" class="int Select_Type"><option value="">业务员</option>
                            @foreach($link as $k=>$v)
                            <option value="{{$v->link_id}}">{{$v->link_name}}</option>
                            @endforeach
                        </select>
                        所在地区
                        <select name="adduser" class="int Select_Type linkage"><option value="">请选择</option>
                            @foreach($area as $k=>$v)
                                <option value="{{$v->id}}">{{$v->area_name}}</option>
                            @endforeach
                        </select>省
                        <select name="adduser" class="int Select_Type"><option value="">请选择</option>
                        </select>市
                        <input type="submit" name="Submit" id="ss_button" class="btn1 btnxiug layui-btn layui-btn-sm" value="搜索">
                        <input type="button" class="btn1 btnxiug layui-btn layui-btn-sm" value="清空条件" onclick="window.location.href=&quot;?&quot;">
                        <input type="button" class="btn1 btnxiug layui-btn layui-btn-sm" value="导出" onclick="window.location.href=&quot;http://phpcrm.tutula.cn/index.php/customer/excel?mobile=&amp;type=&amp;start=&amp;adduser=&amp;linkman=&amp;state=&amp;tel=&amp;timetype=&amp;source=&amp;trade=&amp;address=&amp;keyword=&amp;sttdate=&amp;enddate=&amp;area1=&amp;area2=&quot;">
                    </td>
                </tr>
                </tbody>
                <table id="demo" lay-filter="test"  lay-data="{id: 'idTest'}"></table>
                <script type="text/html" id="barDemo">
                    <a class="layui-btn layui-btn-sm" lay-event="add"><i class="layui-icon">&#xe654;</i></a>
                    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
                    <a class="layui-btn layui-btn-xs" lay-event="type">编辑状态</a>

                </script>
                <script type="text/html" id="aa">
                    <a class="layui-btn layui-btn-xs" lay-event="type">状态</a>
                </script>
                <script>
                    layui.use('table', function(){
                        var table = layui.table;

                        //第一个实例
                        table.render({
                            elem: '#demo'
                            ,height: 312
                            ,url: 'orderList' //数据接口
                            ,page: true //开启分页
                            ,limit:5
                            ,cols: [[ //表头
                                {field: 'id', title: '编号', width:80, fixed: 'left'}
                                ,{field: 'user_name', title: '客户名称', width:110}
                                ,{field: 'linkman', title: '联系人', width:110 }
                                ,{field: 'order_ctime', title: '下单日期', width:130 }
                                ,{field: 'order_btime', title: '交单日期', width:130}
                                ,{field: '', title: '订单金额', width: 110}
                                ,{field: 'order_type', title: '状态', width: 120}
                                ,{field: 'title', title: '管理',templet: '#barDemo', width: 260}
                            ]]
                        });
                        table.on('tool(test)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
                            var data = obj.data; //获得当前行数据
                            var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
                            var tr = obj.tr; //获得当前行 tr 的DOM对象
                            if(layEvent === 'detail'){ //查看
                                //do somehing
                            } else if(layEvent === 'del'){ //删除
                                layer.confirm('确定删除吗', function(index){

                                    //向服务端发送删除指令
                                    $.post('userDel',{'_token':'{{csrf_token()}}',id:data.id,type:1},function(msg){
                                        if(msg==1){
                                            layer.msg('删除成功', {
                                                icon: 1,
                                                time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                            }, function(){
                                                obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                                            });

                                        }else{
                                            window.location.href=history.go(0);
                                        }
                                    })
                                });
                            } else if(layEvent === 'edit'){ //编辑
                                layer.open({
                                    type: 2,
                                    area: ['900px', '500px'],
                                    content: '/userUpdate'+data.id //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
                                    ,end:function(){
                                        window.location.reload();
                                    }
                                });
                            }else if(layEvent === 'type'){
                                layer.open({
                                    type: 2,
                                    area: ['220px', '80px'],
                                    content: '/orderType'+data.id //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
                                    ,end:function(){
                                        window.location.reload();
                                    }
                                });
                            }else{
                                layer.open({
                                    type: 2,
                                    area: ['900px', '500px'],
                                    content: '/product'+data.id //这里content是一个URL，如果你不想让iframe出现滚动条，你还可以content: ['http://sentsin.com', 'no']
                                    ,end:function(){
                                        window.location.reload();
                                    }
                                });
                            }
                        });
                    });

                </script>
            </table>
        </div>

        <div class="layui-tab-item">

            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_1">
                <tbody><tr>
                    <td class="td_l_r title">关键字</td>
                    <td class="td_r_l">
                        <span id="ss_suggest" style="display:none;"></span>名称
                        <input name="keyword" type="text" class="int" id="keyword" size="20" value="" onkeyup="searchSuggest();">

                        <select name="type"  class="Select_Type"  title="Select Travel Destination"><option value="">客户状态</option>
                            <option value="1">已处理</option>
                            <option value="2">处理中</option>
                            <option value="3">未处理</option>
                        </select>
                        <select name="adduser" class="int Select_Type"><option value="">业务员</option>
                            @foreach($link as $k=>$v)
                                <option value="{{$v->link_id}}">{{$v->link_name}}</option>
                            @endforeach
                        </select>
                        所在地区
                        <select name="adduser" class="int Select_Type linkage"><option value="">请选择</option>
                            @foreach($area as $k=>$v)
                                <option value="{{$v->id}}">{{$v->area_name}}</option>
                            @endforeach
                        </select>省
                        <select name="adduser" class="int Select_Type"><option value="">请选择</option>
                        </select>市
                        <input type="submit" name="Submit" id="ss_button" class="btn1 btnxiug layui-btn layui-btn-sm" value="搜索">
                        <input type="button" class="btn1 btnxiug layui-btn layui-btn-sm" value="清空条件" onclick="window.location.href=&quot;?&quot;">
                        <input type="button" class="btn1 btnxiug layui-btn layui-btn-sm" value="导出" onclick="window.location.href=&quot;http://phpcrm.tutula.cn/index.php/customer/excel?mobile=&amp;type=&amp;start=&amp;adduser=&amp;linkman=&amp;state=&amp;tel=&amp;timetype=&amp;source=&amp;trade=&amp;address=&amp;keyword=&amp;sttdate=&amp;enddate=&amp;area1=&amp;area2=&quot;">
                    </td>
                </tr>
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

                        <select name="type"  class="Select_Type"  title="Select Travel Destination"><option value="">客户状态</option>
                            <option value="1">已处理</option>
                            <option value="2">处理中</option>
                            <option value="3">未处理</option>
                        </select>
                        <select name="adduser" class="int Select_Type"><option value="">业务员</option>
                            @foreach($link as $k=>$v)
                                <option value="{{$v->link_id}}">{{$v->link_name}}</option>
                            @endforeach
                        </select>
                        所在地区
                        <select name="adduser" class="int Select_Type linkage"><option value="">请选择</option>
                            @foreach($area as $k=>$v)
                                <option value="{{$v->id}}">{{$v->area_name}}</option>
                            @endforeach
                        </select>省
                        <select name="adduser" class="int Select_Type"><option value="">请选择</option>
                        </select>市
                        <input type="submit" name="Submit" id="ss_button" class="btn1 btnxiug layui-btn layui-btn-sm" value="搜索">
                        <input type="button" class="btn1 btnxiug layui-btn layui-btn-sm" value="清空条件" onclick="window.location.href=&quot;?&quot;">
                        <input type="button" class="btn1 btnxiug layui-btn layui-btn-sm" value="导出" onclick="window.location.href=&quot;http://phpcrm.tutula.cn/index.php/customer/excel?mobile=&amp;type=&amp;start=&amp;adduser=&amp;linkman=&amp;state=&amp;tel=&amp;timetype=&amp;source=&amp;trade=&amp;address=&amp;keyword=&amp;sttdate=&amp;enddate=&amp;area1=&amp;area2=&quot;">
                    </td>
                </tr>
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

                        <select name="type"  class="Select_Type"  title="Select Travel Destination"><option value="">客户状态</option>
                            <option value="1">已处理</option>
                            <option value="2">处理中</option>
                            <option value="3">未处理</option>
                        </select>
                        <select name="adduser" class="int Select_Type"><option value="">业务员</option>
                            @foreach($link as $k=>$v)
                                <option value="{{$v->link_id}}">{{$v->link_name}}</option>
                            @endforeach
                        </select>
                        所在地区
                        <select name="adduser" class="int Select_Type linkage"><option value="">请选择</option>
                            @foreach($area as $k=>$v)
                                <option value="{{$v->id}}">{{$v->area_name}}</option>
                            @endforeach
                        </select>省
                        <select name="adduser" class="int Select_Type"><option value="">请选择</option>
                        </select>市
                        <input type="submit" name="Submit" id="ss_button" class="btn1 btnxiug layui-btn layui-btn-sm" value="搜索">
                        <input type="button" class="btn1 btnxiug layui-btn layui-btn-sm" value="清空条件" onclick="window.location.href=&quot;?&quot;">
                        <input type="button" class="btn1 btnxiug layui-btn layui-btn-sm" value="导出" onclick="window.location.href=&quot;http://phpcrm.tutula.cn/index.php/customer/excel?mobile=&amp;type=&amp;start=&amp;adduser=&amp;linkman=&amp;state=&amp;tel=&amp;timetype=&amp;source=&amp;trade=&amp;address=&amp;keyword=&amp;sttdate=&amp;enddate=&amp;area1=&amp;area2=&quot;">
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="layui-tab-item">
            <style>
                .cssout {
                    padding: 5px;
                }

                body {
                    margin: 0;
                    line-height: 1.5em;
                    font-size: 13px;
                    color: #000000;
                    font-family: "Microsoft YaHei", "微软雅黑", "宋体", STHeiti, MingLiu, Verdana, Geneva, sans-serif;
                }
                .cssin li.bg {
                    background: #EFF0EF;
                }

                .cssin li.w100 {
                    width: 100%;
                    clear: both;
                    height: auto;
                }
                .cssin li {
                    border: 1px solid #E1E2E4;
                    border-right: none;
                    border-bottom: none;
                    float: left;
                    width: 25%;
                    height: 35px;
                    line-height: 33px;
                    box-sizing: border-box;
                    -moz-box-sizing: border-box;
                    -webkit-box-sizing: border-box;
                    padding: 0 5px;
                    overflow: hidden;
                    background: #fff;
                }
                li {
                    list-style: none;
                }
                dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, code, form, legend, input, button, textarea, p, blockquote, th, td {
                    margin: 0;
                    padding: 0;
                }
                input, select {
                    border: 1px solid #B9C2CA;
                    border-radius: 2px;
                    -moz-border-radius: 2px;
                    -webkit-border-radius: 2px;
                    line-height: 25px;
                    font-size: 12px;
                    padding-left: 1px;
                }

                input, select {
                    border: 1px solid #B9C2CA;
                    border-radius: 2px;
                    -moz-border-radius: 2px;
                    -webkit-border-radius: 2px;
                    line-height: 26px;
                    font-size: 12px;
                    padding-left: 2px;
                }
                textarea {
                    border: 1px solid #B9C2CA;
                    border-radius: 2px;
                    -moz-border-radius: 2px;
                    -webkit-border-radius: 2px;
                    line-height: 20px;
                }
                input, select {
                    border: 1px solid #B9C2CA;
                    border-radius: 2px;
                    -moz-border-radius: 2px;
                    -webkit-border-radius: 2px;
                    line-height: 25px;
                    font-size: 12px;
                    padding-left: 1px;
                }
                input, button, textarea, select, optgroup, option {
                    font-family: inherit;
                    font-size: inherit;
                    font-style: inherit;
                    font-weight: inherit;
                }

            </style>
            <div class="cssout">
                <script type="text/javascript" src="{{URL::asset('My97DatePicker/WdatePicker.js')}}"> </script>
                <div class="cssin">
                    <ul>
                        <li class="w100 bg"><b>新增订单</b></li>
                        <li class="w25 bg cl tr">客户名称</li>
                        <li class="w75">
                            <select name="" id="user">
                                <option value="">选择客户</option>
                                @foreach($user as $k=>$v)
                                    <option value="{{$v->id}}">{{$v->user_name}}</option>
                                @endforeach
                            </select>
                        </li>

                        <script>
                            $('#user').change(function(){
                                var user_id=$(this).val();
                                $.get('order_mark',{id:user_id},function(msg){
                                    $('#oCode').val(msg)
                                })
                            })
                        </script>
                        <li class="w25 bg cl tr">

                            订单编号</li>
                        <li class="w75">
                            <input name="number" type="text" id="oCode" size="23" class="int" value="" readonly="" style="border:0;">

                            <span class="info_help help01">&nbsp;自动编号</span> </li>



                        <li class="w25 bg cl tr">

                            <font color="#FF0000">*</font> 联系人</li>
                        <li class="w75">
                            <select name="linkman" id="oLinkman">
                                <option value="">请选择</option>
                                @foreach($link as $k=>$v)
                                    <option value="{{$v->link_id}}">{{$v->link_name}}</option>
                                @endforeach
                            </select>
                            &nbsp;
                            <input name="Back" type="button" id="Back" class="btn1 btnxinz" value="新增" onclick="Linkmans_InfoAdd()">
                            <script>function Linkmans_InfoAdd() {$.dialog.open('http://phpcrm.tutula.cn/index.php/linkman/add?id=81', {title: '新增联系人', width: 600, height: 500,fixed: true}); };</script>
                            <span id="linktel"></span>
                        </li>





                        <li class="w25 bg cl tr">

                            <font color="#FF0000">*</font> 下单日期</li>
                        <li class="w75">
                            <input name="sdate" type="text" id="oSDate" class="int Wdate" size="15"   onClick="WdatePicker()" value="2018-11-02">


                        </li>



                        <li class="w25 bg cl tr">

                            <font color="#FF0000">*</font> 交单日期</li>
                        <li class="w75">
                            <input name="edate" type="text" id="oEDate" class="int Wdate" size="15" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})">
                        </li>




                        <li class="w25 bg cl duohang tr">

                            <font color="#FF0000">*</font> 详情备注</li>
                        <li class="w75 duohang">

                            <textarea name="content" rows="4" id="oContent" class="int" style="height:80px;width:99%;"></textarea>
                        </li>





                    </ul>
                </div>
                <div class="h50b"></div>
                <div class="fixed_bg_B">
                    <input name="customerid" type="hidden" value="81" readonly="">
                    <input name="customername" type="hidden" value="小小" readonly="">
                    <input type="submit" class="btn2 btnbaoc" id="orderSave" value="保存">
                    <input name="Back" type="button" id="Back" class="btn2 btnguanb" value="关闭" onclick="art.dialog.close();">
                </div>

            </div>
            <script>
                layui.use('layer', function(){
                    var layer = layui.layer;
                });
                $('#orderSave').click(function(){
                    var user_id=$('#user').val();
                    var link_id=$('#oLinkman').val();
                    var order_mark=$('#oCode').val();
                    var order_ctime=$('#oSDate').val();
                    var order_btime=$('#oEDate').val();
                    var order_remark=$('#oContent').val();
                    $.post('orderAdd',
                            {'_token':'{{csrf_token()}}',
                                user_id:user_id,
                                link_id:link_id,
                                order_mark:order_mark,
                                order_ctime:order_ctime,
                                order_btime:order_btime,
                                order_remark:order_remark
                            },function(msg){
                                if(msg==1){
                                    layer.msg('保存成功', {
                                        icon: 1,
                                        time: 2000 //2秒关闭（如果不配置，默认是3秒）
                                    }, function(){
                                        window.location.href='/order';
                                    });

                                }else{
                                    window.location.href='/order';
                                }
                            })
                })
            </script>
        </div>
    </div>
</div>
</body>
<script>
    //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
    layui.use('element', function(){
        var element = layui.element;

        //…
    });
    $('.linkage').change(function(){
        var pid=$(this).val();
        var _this=$(this);
        $.ajax({
            url:'userArea',
            type:'get',
            data:{pid:pid},
            dataType:'json',
            success:function(msg){
                var str="<option value=\"\">请选择</option>";
                for(var i in msg){
                    str+="<option value='"+msg[i]['id']+"'>"+msg[i]['area_name']+"</option>"
                }
                _this.next().html(str);
            }
        });
    });
</script>
</html>
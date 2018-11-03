<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="{{URL::asset('layui/css/layui.css')}}">
</head>
<body>
<script src="{{URL::asset('layui/layui.js')}}"></script>
<script src="{{URL::asset('layui/js.js')}}"></script>
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
                <input type="hidden" id="id" value="{{$arr->id}}">
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
                <input name="number" type="text" id="oCode" size="23" class="int" value="{{$arr->order_mark}}" readonly="" style="border:0;">

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
                <input name="sdate" type="text" id="oSDate" class="int Wdate" size="15"   onClick="WdatePicker()" value="{{$arr->order_ctime}}">


            </li>



            <li class="w25 bg cl tr">

                <font color="#FF0000">*</font> 交单日期</li>
            <li class="w75">
                <input name="edate" type="text" id="oEDate" class="int Wdate" size="15" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd'})" value="{{$arr->order_btime}}">
            </li>




            <li class="w25 bg cl duohang tr">

                <font color="#FF0000">*</font> 详情备注</li>
            <li class="w75 duohang">

                <textarea name="content" rows="4" id="oContent" class="int" style="height:80px;width:99%;">{{$arr->order_remark}}</textarea>
            </li>





        </ul>
    </div>
    <div class="h50b"></div>
    <div class="fixed_bg_B">
        <input name="customerid" type="hidden" value="81" readonly="">
        <input name="customername" type="hidden" value="小小" readonly="">
        <input type="submit" class="btn2 btnbaoc" id="orderSave" value="修改">
        <input name="Back" type="button" id="Back" class="btn2 btnguanb" value="关闭" onclick="art.dialog.close();">
    </div>

</div>
<script>
    layui.use('layer', function(){
        var layer = layui.layer;
    });
    $('#orderSave').click(function(){
        var id=$('#id').val();
        var user_id=$('#user').val();
        var link_id=$('#oLinkman').val();
        var order_mark=$('#oCode').val();
        var order_ctime=$('#oSDate').val();
        var order_btime=$('#oEDate').val();
        var order_remark=$('#oContent').val();
        $.post('orderUpdateDo',
                {'_token':'{{csrf_token()}}',
                    id:id,
                    user_id:user_id,
                    link_id:link_id,
                    order_mark:order_mark,
                    order_ctime:order_ctime,
                    order_btime:order_btime,
                    order_remark:order_remark
                },function(msg){
                    /*if(msg==1){
                        layer.msg('保存成功', {
                            icon: 1,
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                            time: 2000 //2秒关闭（如果不配置，默认是3秒）
                        }, function(){
                            window.location.href='/order';
                        });

                    }else{
                        window.location.href='/order';
                    }*/
                })
    })
</script>
</body>
</html>
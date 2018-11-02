<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="{{URL::asset('layui/layui.css')}}">
</head>
<script src="{{URL::asset('layui/layui.js')}}"></script>
<script src="{{URL::asset('layui/js.js')}}"></script>
<style>
    .cssout {
        padding: 5px;
    }
    div {
        display: block;
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
</style>
<body>
<div class="cssout">
    <div class="cssin">
        <ul>
            <li class="w100 bg"><b>新增订单产品</b></li>
            <li class="w25 bg cl tr">
                产品名称
            </li>
            <li class="w75">
                <input name="ProId" type="hidden" id="ProId" size="23" value="{{$order_id}}" readonly="">
                <input name="ProTitle" type="text" id="ProTitle" size="23" value="" onclick="Choose_cp()">
                <script>function Choose_cp() {$.dialog.open('http://phpcrm.tutula.cn/index.php/common/choose_product', {title:'新增订单产品', width: 900, height: 480,fixed: true}); };</script>
            </li>
            <li class="w25 bg cl tr">
                成本单价</li>
            <li class="w75">
                <input type="text" id="oProItemE" value=""></li>
            <li class="w25 bg cl tr">
                销售单价</li>
            <li class="w75">
                <input name="ProPrice" type="text" id="oProPrice" size="10" onchange="oMoney.value=oProPrice.value*parseInt(oProNum.value)-oDiscount.value">
                元</li>
            <li class="w25 bg cl tr">
                数量</li>
            <li class="w75">
                <input name="ProNum" type="text" id="oProNum" size="10" onchange="oMoney.value=oProPrice.value*parseInt(oProNum.value)-oDiscount.value" value="1" onfocus="if (value =='1'){value ='1'}" onblur="if (value ==''){value='1'}">
            </li>
            <li class="w25 bg cl tr">折扣</li>
            <li class="w75">
                <input name="Discount" type="text" id="oDiscount" size="10" onchange="oMoney.value=oProPrice.value*parseInt(oProNum.value)-oDiscount.value" value="0" onfocus="if (value =='0'){value =''}" onblur="if (value ==''){value='0'}">元
            </li>
            <li class="w25 bg cl tr">
                总金额</li>
            <li class="w75">
                <input name="Money" type="text" id="oMoney" size="10" style="font-weight:bold;color:Red;" class="" value="0" onfocus="if (value =='0'){value =''}" onblur="if (value ==''){value='0'}" readonly="">
            </li>
            <li class="w25 bg cl duohang tr">
                详情备注</li>
            <li class="w75 duohang">
                <textarea name="content" rows="4" id="oContent" class="int" style="height:80px;width:99%;"></textarea>
            </li>
        </ul>
    </div>
    <div class="h50b"></div>
        <div class="layui-btn-group">
            <button class="layui-btn" id="bc">保存</button>
            <button class="layui-btn" id="gb">关闭</button>
        </div>
</div>
<script>
    $('#bc').click(function(){
        var order_id=$('#ProId').val();
        var product_name=$('#ProTitle').val();
        var price_cost=$('#oProItemE').val();
        var price_sell=$('#oProPrice').val();
        var product_num=$('#oProNum').val();
        var discount=$('#oDiscount').val();
        var price_sum=$('#oMoney').val();
        var product_remark=$('#oContent').val();
        $.post('testa',{
            '_token':'{{csrf_token()}}',
            order_id:order_id,
            product_name:product_name,
            price_cost:price_cost,
            price_sell:price_sell,
            product_num:product_num,
            discount:discount,
            price_sum:price_sum,
            product_remark:product_remark
        },function(msg){
            if(msg==1){
                layer.msg('修改成功', {
                    icon: 1,
                    time: 1000 //2秒关闭（如果不配置，默认是3秒）
                }, function(){
                    var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                    parent.layer.close(index); //再执行关闭
                });

            }else{
                layer.msg('保存失败', {icon: 1});
                var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                parent.layer.close(index); //再执行关闭
            }
        })
    });

    $('#gb').click(function(){
        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
        parent.layer.close(index); //再执行关闭
    })
</script>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>开始使用layui</title>
    <script src="{{URL::asset('layui/layui.js')}}"></script>
    <script src="{{URL::asset('layui/js.js')}}"></script>
</head>
<button type="button" id="a1" tid="{{$id}}">待处理</button>
<button type="button" id="a2" tid="{{$id}}">已处理</button>
<button type="button" id="a3" tid="{{$id}}">未处理</button>
<script>
    layui.use('layer', function(){
        var layer = layui.layer;
    });
    $('#a1').click(function(){
        var id=$(this).attr('tid');
        $.get('upType',{type:1,id:id},function(msg){
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
    $('#a2').click(function(){
        var id=$(this).attr('tid');
        $.get('upType',{type:2,id:id},function(msg){
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
    $('#a3').click(function(){
        var id=$(this).attr('tid');
        $.get('upType',{type:3,id:id},function(msg){
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
</script>
</html>
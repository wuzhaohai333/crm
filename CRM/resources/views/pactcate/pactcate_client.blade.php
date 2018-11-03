<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no"/>
    <title>客户列表</title>

    <script type="text/javascript" src="/win10ui/js/jquery-2.2.4.min.js"></script>
    <link rel="stylesheet" href="/layui/css/layui.css"  media="all">
    <script type="text/javascript" src="/win10ui/component/layer-v3.0.3/layer/layer.js"></script>
    <script type="text/javascript" src="/layui/layui.js"></script>
</head>
<body>

  <div style="margin: 15px;">
      <div class="layui-form-item">
          <label class="layui-form-label">关键字</label>
          <div class="layui-inline">
              <input type="text" name=""  value="" id="date1" autocomplete="off" class="layui-input">
          </div>
          <div class="layui-inline">
              <button class="layui-btn">搜索</button>
          </div>

      </div>



    <button class="layui-btn layui-btn-danger">客户列表</button>
    <button class="layui-btn " >本周客户</button>

  </div>
  <table class="layui-table" lay-size="sm" id="test" style="margin: 15px;width:98%;">
      <colgroup>
          <col width="150">
          <col width="200">
          <col>
      </colgroup>
      <thead>
      <tr>
          <th>编号</th>
          <th>客户名称</th>
          <th>联系QQ</th>
          <th>联系人</th>
          <th>手机号</th>
          <th>总金额</th>
          <th>总欠款</th>
          <th>售后次数</th>
          <th>业务员</th>
          <th>新增</th>
      </tr>
      </thead>
      <tbody>
      @foreach( $pact as $v )
      <tr onclick="popup('新增合同','pactcate_add?cid={{$v->id}}')">
          <td>{{$v->id}}</td>
          <td>{{$v->user_name}}</td>
          <td>{{$v->user_qq}}</td>
          <td>{{$v->user_linkman}}</td>
          <td>{{$v->user_tel}}</td>
          <td>元</td>
          <td>元</td>
          <td>1</td>
          <td>{{$v->salesman_id}}</td>

      </tr>
      @endforeach

      </tbody>
  </table>

</body>
<script>
    //页面层
    function popup(title,url){

        layer.open({
            type: 2,
            shade: 0.3,
            title: title,
            shadeClose: true,
            maxmin: true, //开启最大化最小化按钮
            area: ['800px', '400px'],
            content: '/index.php/'+url,
            end: function () {
                window.location.reload();
            }

        });

    }


</script>


</html>
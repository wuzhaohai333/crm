<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>开始使用layui</title>
    <link rel="stylesheet" href="{{URL::asset('layui/css/layui.css')}}">
    <script src="{{URL::asset('layui/layui.js')}}"></script>
</head>
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
<body>
<script src="{{URL::asset('layui/js.js')}}"></script>
<script>
    //注意：选项卡 依赖 element 模块，否则无法进行功能性操作
    layui.use(['element','layer'], function(){
        var element = layui.element;
        var form = layui.form;
        //…
    });
</script>
<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief">
    <ul class="layui-tab-title">
        <li class="layui-this">客户列表</li>
        <li>今日新增</li>
        <li>近7天新增</li>
        <li>本月新增</li>
        <li>新增客户</li>
    </ul>
    <div class="layui-tab-content" style="height: 100px;">
        <div class="layui-tab-item layui-show"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_1">
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
                </tbody></table></div>
        <div class="layui-tab-item"><div class="layui-tab-item layui-show"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_1">
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
                    </tbody></table></div>
        </div>
        <div class="layui-tab-item"><div class="layui-tab-item layui-show"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_1">
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
                    </tbody></table></div>
        </div>
        <div class="layui-tab-item"><div class="layui-tab-item layui-show"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_1">
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
                    </tbody></table></div>
        </div>
        <div class="layui-tab-item">
            <style>
                body { margin: 0; line-height: 1.5em; font-size: 13px; color: #000000; font-family: "Microsoft YaHei", "微软雅黑", "宋体", STHeiti, MingLiu, Verdana, Geneva, sans-serif; }
                .td_l_l {
                    text-align: left;
                    border-right: 1px solid #E1E2E4;
                    border-top: 1px solid #E1E2E4;
                    padding-left: 10px;
                    height: 35px;
                    padding-top: 0px;
                    padding-bottom: 0px;
                }
                .td_n {
                    border: 0;
                }
                button, input, optgroup, option, select, textarea {
                    font-family: inherit;
                    font-size: inherit;
                    font-style: inherit;
                    font-weight: inherit;
                    outline: 0;
                }
                .btn2, a.btn2 {
                    padding: 0 10px 0 10px;
                    min-width: 80px;
                    cursor: pointer;
                    color: #fff;
                    font-size: 16px;
                    border: none;
                    display: inline-block;
                    height: 28px;
                    line-height: 28px;
                    border-radius: 4px;
                    -moz-border-radius: 4px;
                    -webkit-border-radius: 4px;
                    letter-spacing: 2px;
                    margin-right: 7px;
                }
                button {
                                                                                                               align-items: flex-start;
                                                                                                               text-align: center;
                                                                                                               cursor: default;
                                                                                                               color: buttontext;
                                                                                                               background-color: buttonface;
                                                                                                               box-sizing: border-box;
                                                                                                               padding: 2px 6px 3px;
                                                                                                               border-width: 2px;
                                                                                                               border-style: outset;
                                                                                                               border-color: buttonface;
                                                                                                               border-image: initial;
                                                                                                           }
                input, button, textarea, select, optgroup, option { font-family: inherit; font-size: inherit; font-style: inherit; font-weight: inherit; }
            </style>
            <body style="padding-bottom:50px;">
            <div style="display: none; position: absolute;" class="">
                <div class="aui_outer"><table class="aui_border">
                        <tbody>
                            <tr>
                                <td class="aui_nw"></td>
                                <td class="aui_n"></td>
                                <td class="aui_ne"></td>
                            </tr>
                            <tr><td class="aui_w"></td><td class="aui_c"><div class="aui_inner"><table class="aui_dialog"><tbody><tr><td colspan="2" class="aui_header"><div class="aui_titleBar"><div class="aui_title" style="cursor: move;"></div><a class="aui_close" title="Close" href="javascript:/*artDialog*/;">×</a></div></td></tr><tr><td class="aui_icon" style="display: none;"><div class="aui_iconBg" style="background: none;"></div></td><td class="aui_main" style="width: auto; height: auto;"><div class="aui_content" style="padding: 20px 25px;"></div></td></tr><tr><td colspan="2" class="aui_footer"><div class="aui_buttons" style="display: none;"></div></td></tr></tbody></table></div></td><td class="aui_e"></td></tr><tr><td class="aui_sw"></td><td class="aui_s"></td><td class="aui_se" style="cursor: se-resize;"></td></tr></tbody></table></div></div>


            <form name="Add" action="" method="post" onsubmit="return CheckInput();">

                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        <td valign="top" class="td_n pdl10 pdr10 pdt10">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_1">
                                <colgroup><col width="100">
                                    <col width="400">
                                    <col width="100">
                                    <col width="400">
                                </colgroup><tbody><tr>
                                    <td colspan="4" class="td_l_l title3 icon_t01">
                                        基本信息
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td_l_r title">
                                        客户名称
                                    </td>
                                    <td colspan="3" class="td_r_l">
                                        <input type="text" class="int" name="name" id="name" size="50" maxlength="50" autocomplete="off" onchange="check_customer_name(this.value);">
                                        <span id="customer_name_err"><span class="info_warn help01">客户识别信息</span></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td_l_r title">
                                        客户类型
                                    </td>
                                    <td class="td_r_l">
                                        <select name="type" id="type">
                                            <option value="">请选择</option>
                                            <option value="已成交">已成交</option>
                                            <option value="未成交">未成交</option>
                                            <option value="跟进中">跟进中</option>
                                            <option value="有意向">有意向</option>
                                        </select>
                                        &nbsp;
                                    </td>

                                    <td class="td_l_r title">


                                    </td>
                                    <td class="td_r_l">


                                    </td>
                                </tr>
                                <tr>
                                    <td class="td_l_r title">
                                        所在地区
                                    </td>
                                    <td class="td_r_l">
                                        <select name="Source" id="Select_Source">
                                            <option value="">请选择</option>
                                            @foreach($area as $k=>$v)
                                            <option value="{{$v->id}}">{{$v->area_name}}</option>
                                            @endforeach
                                        </select>省
                                        &nbsp;
                                        <select name="Source" id="Select_Source">
                                            <option value="">请选择</option>
                                            <option value="电话营销">电话营销</option>
                                        </select>市
                                        &nbsp;
                                    </td>
                                    <td class="td_l_r title">
                                        详细地址
                                    </td>
                                    <td class="td_r_l">

                                        <input name="Address" type="text" class="int" id="Address" size="30">
                                        邮编：
                                        <input name="Zip" type="text" class="int" id="Zip" size="10" maxlength="6" onkeyup="this.value=this .value.replace(/\D/gi,&quot;&quot;)">
                                        <span class="info_help vtip" title="限：数字">&nbsp;</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td_l_r title">
                                        客户级别
                                    </td>
                                    <td class="td_r_l">
                                        <select name="Start" id="Select_Star">
                                            <option value="">请选择</option>
                                            <option value="★★★★★">★★★★★</option>
                                            <option value="★★★★">★★★★</option>
                                            <option value="★★★">★★★</option>
                                            <option value="★★">★★</option>
                                            <option value="★">★</option>
                                        </select>
                                        &nbsp;
                                    </td>
                                    <td class="td_l_r title">
                                        客户来源
                                    </td>
                                    <td class="td_r_l">
                                        <select name="Source" id="Select_Source">
                                            <option value="">请选择</option>
                                            <option value="电话营销">电话营销</option>
                                            <option value="搜索引擎">搜索引擎</option>
                                            <option value="朋友介绍">朋友介绍</option>
                                            <option value="其它来源">其它来源</option>
                                        </select>
                                        &nbsp;
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td_l_r title">
                                        公司网址
                                    </td>
                                    <td class="td_r_l">
                                        <input name="website" type="text" class="int" id="website" size="35">
                                        <span class="info_help help01 vtip" title="加：http://">&nbsp;</span>
                                    </td>
                                    <td class="td_l_r title">
                                        所属行业
                                    </td>
                                    <td class="td_r_l">
                                        <select name="trade" id="trade">
                                            <option value="">请选择</option>
                                            <option value="批发零售" id="67">批发零售</option>
                                            <option value="县级批发" id="68">县级批发</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="td_l_l title3 icon_t02">
                                        首要联系人
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td_l_r title">
                                        联系人
                                    </td>
                                    <td class="td_r_l">
                                        <input name="linkman" type="text" class="int" id="linkman" size="10" onchange="checklinkman (this.value,1);">
                                        &nbsp;
                                        职位：
                                        <select name="job" id="job">
                                            <option value="">请选择</option>
                                            <option value="董事长">董事长</option>
                                            <option value="总经理">总经理</option>
                                            <option value="负责人">负责人</option>
                                            <option value="业务员">业务员</option>
                                            <option value="技术员">技术员</option>
                                        </select>
                                        &nbsp;
                                    </td>
                                    <td class="td_l_r title">
                                        手机号码
                                    </td>
                                    <td class="td_r_l" colspan="3">
                                        <input name="mobile" type="text" class="int" id="mobile" size="30" onchange="checkmobile(this.value,1);">
                                        <span id="check3"><span class="info_warn help01">客户识别信息</span></span>
                                        <span class="info_help vtip" title="限：数字">&nbsp;</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td_l_r title">
                                        联系qq
                                    </td>
                                    <td class="td_r_l">
                                        <input name="qq" type="text" class="int" id="qq" size="30" onkeyup="refreshValue (this)">
                                    </td>
                                    <td class="td_l_r title">
                                        电子邮件
                                    </td>
                                    <td class="td_r_l">
                                        <input name="email" type="text" class="int" id="email" size="30">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="td_l_l title3 icon_t03">
                                        其它信息
                                    </td>
                                </tr>
                                <script language="javascript">
                                    function refreshValue(obj) {
                                        var s = obj.value;
                                        document.all("email").value = s+"@qq.com";
                                    }
                                </script>
                                <tr>
                                    <td class="td_l_r title">
                                        备注
                                    </td>
                                    <td class="td_r_l" colspan="3" style="padding:5px 10px;">
                                        <textarea name="remark" id="remark" class="int" style="height:50px;width:98%;"></textarea>
                                    </td>
                                </tr>
                                </tbody></table>
                        </td>
                    </tr>
                    </tbody></table>
                <div class="fixed_bg_B">
                    <div style="float: right;margin-right: 500px">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                        <tbody><tr>
                            <td valign="top" class="td_n Bottom_pd " >
                                <input type="button" style="background: aquamarine;" id="submit" class="btn2 btnbaoc" value="保存">
                                <input name="Back" type="button" id="Back" class="btn2 btnguanb" value="关闭" onclick="art.dialog.close ();">
                            </td>
                        </tr>
                </tbody></table></div>
                </div>
            </form>
            <script>
                $('#submit').click(function(){
                    if ($("#name").val()== ""){
                        layer.msg('客户名称不能为空！', {icon: 2});
                        return false;
                    }
                    if ($("#type").val()== ""){
                        layer.msg('客户类型不能为空！', {icon: 2});
                        return false;
                    }
                    if ($("#area1").val()== ""){
                        layer.msg('所在地区不能为空！', {icon: 2});
                        return false;
                    }
                    if ($("#area2").val()== ""){
                        layer.msg('所在地区不能为空！', {icon: 2});
                        return false;
                    }
                    if ($("#address").val()== ""){
                        layer.msg('所在地区不能为空！', {icon: 2});
                        return false;
                    }
                    if ($("#linkman").val()== ""){
                        layer.msg('联系人不能为空！', {icon: 2});
                        return false;
                    }
                    if ($("#job").val()== ""){
                        layer.msg('职位不能为空！', {icon: 2});
                        return false;
                    }
                    if ($("#mobile").val()== ""){
                        layer.msg('手机号码不能为空！', {icon: 2});
                        return false;
                    }
                    if ($("#qq").val()== ""){
                        layer.msg('qq号码不能为空！', {icon: 2});
                        return false;
                    }
                    if ($("#trade").val()== ""){
                        layer.msg('所属行业不能为空！', {icon: 2});
                        return false;
                    }
                    if ($("#website").val()== ""){
                        layer.msg('公司网址不能为空！', {icon: 2});
                        return false;
                    }
                    if ($("#email").val()== ""){
                        layer.msg('电子邮件不能为空！', {icon: 2});
                        return false;
                    }
                    if ($("#start").val()== ""){
                        layer.msg('客户级别不能为空！', {icon: 2});
                        return false;
                    }
                    if ($("#source").val()== ""){
                        layer.msg('客户来源不能为空！', {icon: 2});
                        return false;
                    }
                });

            </script>



            <div style="display: none; position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; cursor: move; opacity: 0; background: rgb(255, 255, 255);"></div><div id="qb-sougou-search" style="display: none; opacity: 0;"><p>搜索</p><p class="last-btn">复制</p><iframe src=""></iframe></div></body>

        </div>
    </div>
</div>




</body>
</html>
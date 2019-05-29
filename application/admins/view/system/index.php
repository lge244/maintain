<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
    <script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
    <script type="text/javascript" src="/static/js/jquery.min.js"></script>
    <script type="text/javascript" src="/static/js/map.jquery.min.js"></script>
    <style>
        /* reset */
        html,body,h1,h2,h3,h4,h5,h6,div,dl,dt,dd,ul,ol,li,p,blockquote,pre,hr,figure,table,caption,th,td,form,fieldset,legend,input,button,textarea,menu{margin:0;padding:0;}

        body{padding:100px;font-size: 14px;}
        h1{font-size: 26px;}
        p{font-size: 14px; margin-top: 10px;}
        pre{background:#eee;border:1px solid #ddd;border-left:4px solid #f60;padding:15px;margin-top: 15px;}
        h2{font-size: 20px;margin-top: 20px;}
        .case{margin-top: 15px;width:400px;}

        .bMap{position: relative;}
        .bMap .map-warp{position: absolute;left:0;width:100%;height:400px;top:34px;display: none;}
        .bMap input{width:190px;height:36px;line-height: 30px;border:1px solid #d7d7d7;}
        .tangram-suggestion-main{z-index: 9999}
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=EZPCgQ6zGu6hZSmXlRrUMTpr"></script>

</head>
<body style="padding: 10px;">
<form class="layui-form">
    <input type="hidden" name="id" value="{$item.id}">
    <div class="layui-form-item">
        <label class="layui-form-label">中心位置</label>
        <div class="case">
            <div class="bMap" id='case3'></div>
            <div id="callback">

            </div>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">标准距离</label>
        <div class="layui-input-inline">
            <input type="number" class="layui-input" name="standard" value="{$item.standard}">公里
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">距离奖励</label>
        <div class="layui-input-inline">
            <input type="number" class="layui-input" name="distance_reward" value="{$item.distance_reward}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">时间奖励</label>
        <div class="layui-input-inline">
            <input type="number" class="layui-input" name="time_reward" value="{$item.time_reward}">
        </div>

    </div>

</form>
<div class="layui-form-item">
    <div class="layui-input-block">
        <button class="layui-btn" onclick="save()">保存</button>
    </div>
</div>
</body>
</html>
<script>
    $(function(){
        $("#case3").bMap({name:"callback",callback:function(address,point){
             console.log(JSON.stringify(point))
            }});
        $("#Map_input_callback").val("{$item.address}")
    })
</script>
<script type="text/javascript">
    layui.use(['layer','form'],function(){
        var form = layui.form;
        layer = layui.layer;
        $ = layui.jquery;
    });

    function save(){
        var id = parseInt($('input[name="id"]').val());
        var Map_input_callback = $.trim($('#Map_input_callback').val());
        var distance_reward = $.trim($('input[name="distance_reward"]').val());
        var time_reward = $.trim($('input[name="time_reward"]').val());

        if(Map_input_callback==''){
            layer.alert('请填写中心位置',{'icon':2});
            return;
        }
        if(distance_reward== ''){
            layer.alert('请填写距离奖励',{'icon':2});
            return;
        }
        if(time_reward==''){
            layer.alert('请填写时间奖励',{'icon':2});
            return;
        }

        $.post('/index.php/admins/system/save',$('form').serialize(),function(res){
            if(res.code>0){
                layer.alert(res.msg,{'icon':2});
            }else{
                layer.msg(res.msg,{'icon':1});
                setTimeout(function(){parent.window.location.reload();},1000);
            }
        },'json');
    }
</script>
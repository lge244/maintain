<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
    <script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
</head>
<body style="padding: 10px;">
<form class="layui-form">
<!--    <div class="layui-form-item test"></div>-->

    <div class="layui-form-item">
        <label class="layui-form-label">维修设备</label>
        <div class="layui-input-block">
            <input type="radio" name="equipment" value="空调" title="空调" checked="">
            <input type="radio" name="equipment" value="洗衣机" title="洗衣机">
            <input type="radio" name="equipment" value="冰箱" title="冰箱">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">设备品牌</label>
        <div class="layui-input-block">
            <input type="radio" name="brand" value="美的" title="美的" checked="">
            <input type="radio" name="brand" value="夏利" title="夏利">
            <input type="radio" name="brand" value="美玲" title="美玲">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">品牌型号</label>
        <div class="layui-input-block">
            <input type="radio" name="Version" value="aass" title="aass" checked="">
            <input type="radio" name="Version" value="AKDJS" title="AKDJS">
            <input type="radio" name="Version" value="OUXJWS" title="OUXJWS">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">设备功率</label>
        <div class="layui-input-block">
            <input type="radio" name="power" value="2000" title="2000" checked="">
            <input type="radio" name="power" value="4000" title="4000">
            <input type="radio" name="power" value="6000" title="6000">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否加急</label>
        <div class="layui-input-block">
            <input type="radio" name="worry" value="是" title="是" checked="">
            <input type="radio" name="worry" value="否" title="否">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">维修项目</label>
        <div class="layui-input-block">
            <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
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
<script type="text/javascript">
    // layui.config({
    //     base: '/static/js/',
    // })
    layui.use(['layer','form','interact'],function(){
        var form = layui.form;
        layer = layui.layer;
        $ = layui.jquery;
        // var interact = layui.interact;
        // var data=[{:htmlspecialchars_decode($item)}];
        // interact.render({
        //     elem : '.test',
        //     title : '选择联动',
        //     data : data,
        //     name : 'sort_title',
        // });
        // interact.on('interact(test)',function(data){
        //     console.dir(data);
        // })
    });

    function save(){
        var id = parseInt($('input[name="id"]').val());
        var maintain_price = $.trim($('input[name="maintain_price"]').val());
        var maintain_title = $.trim($('input[name="maintain_title"]').val());
        if(maintain_title==''){
            layer.alert('项目名称不能为空',{'icon':2});
            return;
        }
        if(maintain_price==''){
            layer.alert('项目价格不能为空',{'icon':2});
            return;
        }
        $.post('/index.php/admins/abhibition/save',$('form').serialize(),function(res){
            if(res.code>0){
                layer.alert(res.msg,{'icon':2});
            }else{
                layer.msg(res.msg,{'icon':1});
                setTimeout(function(){parent.window.location.reload();},1000);
            }
        },'json');
    }
</script>
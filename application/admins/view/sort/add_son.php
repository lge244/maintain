<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
    <script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
</head>
<body style="padding: 10px;">
<form class="layui-form">
    <input type="hidden" name="fid" value="{$id}">
    <div class="layui-form-item">
        <label class="layui-form-label">分类名称</label>
        <div class="layui-input-inline">
            <input type="text" class="layui-input" name="sort_title" value="">
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
    layui.use(['layer','form'],function(){
        var form = layui.form;
        layer = layui.layer;
        $ = layui.jquery;
    });
    function save(){
        var fid = parseInt($('input[name="id"]').val());
        var sort_title = $.trim($('input[name="sort_title"]').val());
        if(sort_title==''){
            layer.alert('分类名称不能为空',{'icon':2});
            return;
        }

        $.post('/index.php/admins/sort/save_son',$('form').serialize(),function(res){
            if(res.code>0){
                layer.alert(res.msg,{'icon':2});
            }else{
                layer.msg(res.msg,{'icon':1});
                setTimeout(function(){parent.window.location.reload();},1000);
            }
        },'json');
    }
</script>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
	<script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
</head>
<body style="padding: 10px;">
<form class="layui-form">
	<input type="hidden" name="id" value="{$item.id}">
	<div class="layui-form-item">
		<label class="layui-form-label">项目名称</label>
		<div class="layui-input-inline">
			<input type="text" class="layui-input" name="maintain_title" value="{$item.maintain_title}">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">项目价格</label>
		<div class="layui-input-inline">
			<input type="number" class="layui-input" name="maintain_price" value="{$item.maintain_price}">
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
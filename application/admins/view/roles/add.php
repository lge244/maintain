<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
	<script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
</head>
<body style="padding: 10px;">
	<form class="layui-form">
		<input type="hidden" name="gid" value="{$group.gid}">
		<div class="layui-form-item" >
			<label class="layui-form-label">角色名称</label>
			<div class="layui-input-block">
				<input type="text" class="layui-input" name="title" value="{$group.title}">
			</div>
		</div>

		<div class="layui-form-item">
			<label class="layui-form-label">权限菜单</label>
			{volist name="$menus" id="vo"}
			<hr>
			<div class="layui-input-block">
				<input type="checkbox" name="menu[{$vo.mid}]" lay-skin="primary" title="{$vo.title}" {:isset($group['rights']) && in_array($vo.mid,$group['rights'])?'checked':'';}>
				<hr>
				{volist name="$vo.children" id="cvo"}
				<input type="checkbox" name="menu[{$cvo.mid}]" lay-skin="primary" title="{$cvo.title}" {:isset($group['rights']) && in_array($cvo.mid,$group['rights'])?'checked':'';}>
				{/volist}
			</div>
			{/volist}
		</div>

	</form>
	<div class="layui-form-item" style="margin-top: 10px">
		<div class="layui-input-block">
			<button class="layui-btn" onclick="save()">保存</button>
		</div>
	</div>

</body>
</html>
<script type="text/javascript">
	layui.use(['form','layer'],function(){
		var form = layui.form;
		$ = layui.jquery;
		layer = layui.layer;
	});


	// 保存
	function save(){
		var title = $.trim($('input[name="title"]').val());
		if(title == ''){
			layer.msg('请填写角色名称',{'icon':2});
			return;
		}
		$.post('/index.php/admins/roles/save',$('form').serialize(),function(res){
			if(res.code>0){
				layer.msg(res.msg,{'icon':2});
			}else{
				layer.msg(res.msg,{'icon':1});
				setTimeout(function(){parent.window.location.reload();},1000);
			}
		},'json');
	}
</script>
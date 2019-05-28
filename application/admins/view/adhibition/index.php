<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
	<script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
	<style type="text/css">
		.header span{background: #009688;margin-left: 30px;padding: 10px;color: #ffffff;}
		.header button{float: right;margin-top: -5px;}
		.header div{border-bottom: solid 2px #009688;margin-top: 8px;}
	</style>
</head>
<body style="padding: 10px;">
<div class="header">
	<span>维修项目列表</span>
	<button class="layui-btn layui-btn-sm" onclick="add()">添加</button>
	<div></div>
</div>
<table class="layui-table">
	<thead>
	<tr>
		<th>ID</th>
		<th>维修项目的名称</th>
		<th>维修项目的价格</th>
		<th>操作</th>
	</tr>
	</thead>
	<tbody>
	{volist name='$lists' id="vo"}
	<tr>
		<td>{$vo.id}</td>
		<td>{$vo.maintain_title}</td>
		<td>{$vo.maintain_price}</td>
		<td>
			<button class="layui-btn layui-btn-xs" onclick="add({$vo.id})">编辑</button>
			<button class="layui-btn layui-btn-danger layui-btn-xs" onclick="del({$vo.id})">删除</button>
		</td>
	</tr>
	{/volist}
	</tbody>
</table>
</body>
</html>
<script type="text/javascript">
	layui.use(['layer'],function(){
		layer = layui.layer;
		$ = layui.jquery;
	});
	// 添加
	function add(id){
		layer.open({
			type:2,
			title:id>0?'编辑维修项目':'添加维修项目',
			shade:0.3,
			area:['480px','420px'],
			content:'/index.php/admins/adhibition/add?id='+id
		});
	}
	// 删除
	function del(id){
		layer.confirm('确定要删除吗？',{
			icon:3,
			btn:['确定','取消']
		},function(){
			$.post('/index.php/admins/adhibition/delete',{'id':id},function(res){
				if(res.code>0){
					layer.alert(res.msg,{'icon':2});
				}else{
					layer.msg(res.msg,{'icon':1});
					setTimeout(function(){window.location.reload();},1000);
				}
			},'json');
		});
	}
</script>

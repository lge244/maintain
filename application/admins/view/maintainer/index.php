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
	<span>维修员列表</span>
	<button class="layui-btn layui-btn-sm" onclick="add()">添加</button>
	<div></div>
</div>
<table class="layui-table">
	<thead>
	<tr>
		<th>ID</th>
		<th>真实姓名</th>
		<th>用户名</th>
		<th>手机号码</th>
		<th>办公室</th>
		<th>工种</th>
		<th>员工号</th>
		<th>性别</th>
		<th>家庭地址</th>
		<th>添加时间</th>
		<th>操作</th>
	</tr>
	</thead>
	<tbody>
		{foreach $list as $v}
		<tr>
			<td>{$v.id}</td>
			<td>{$v.true_name}</td>
			<td>{$v.username}</td>
			<td>{$v.phone}</td>
			<td>{$v.office}</td>
			<td>{$v.work_type}</td>
			<td>{$v.staff_id}</td>
			<td>{$v.sex == 1 ? '男' : '女' }</td>
			<td>{$v.address}</td>
			<td>{$v.create_time|date='Y-m-d H:i:s'}</td>
			<td>
				<button class="layui-btn layui-btn-xs" onclick="add({$v.id})">编辑</button>
				<button class="layui-btn layui-btn-danger layui-btn-xs" onclick="del({$v.id})">删除</button>
			</td>
		</tr>
		{/foreach}
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
			title:id>0?'编辑维修员':'添加维修员',
			shade:0.3,
			area:['480px','420px'],
			content:'/index.php/admins/maintainer/form?id='+id
		});
	}

	// 删除
	function del(id){
		layer.confirm('确定要删除吗？',{
			icon:3,
			btn:['确定','取消']
		},function(){
			$.post('/index.php/admins/maintainer/del',{'id':id},function(res){
				if(res.status){
					layer.msg(res.msg,{'icon':1});
					setTimeout(function(){window.location.reload();},1000);
				}else{
					layer.alert(res.msg,{'icon':2});
				}
			},'json');
		});
	}
</script>
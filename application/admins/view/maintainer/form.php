<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
	<script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
</head>
<body style="padding: 10px;">
<form class="layui-form">
	<input type="hidden" name="id" value="{$item.id|default=''}">
	<div class="layui-form-item">
		<label class="layui-form-label">真实姓名</label>
		<div class="layui-input-inline">
			<input type="text" class="layui-input" name="true_name" value="{$item.true_name|default=''}">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">用户名</label>
		<div class="layui-input-inline">
			<input type="text" class="layui-input" name="username" value="{$item.username|default=''}">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">密码</label>
		<div class="layui-input-inline">
			<input type="password" value="{$item['password']|default=''}" class="layui-input" name="password">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">上传图片</label>
		<div class="layui-input-inline">
			<input type="text" class="layui-input" name="img" value="{$item.img|default=''}">
			<button type="button" class="layui-btn" id="test1">
				<i class="layui-icon">&#xe67c;</i>
			</button>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">手机号码</label>
		<div class="layui-input-inline">
			<input type="text" class="layui-input" name="phone" value="{$item.phone|default=''}">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">办公室</label>
		<div class="layui-input-inline">
			<input type="text" class="layui-input" name="office" value="{$item.office|default=''}">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">工种</label>
		<div class="layui-input-inline">
			<input type="text" class="layui-input" name="work_type" value="{$item.work_type|default=''}">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">员工号</label>
		<div class="layui-input-inline">
			<input type="text" class="layui-input" name="staff_id" value="{$item.staff_id|default=''}">
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">性别</label>
		<div class="layui-input-inline">
			<input type="radio" name="sex" value="1" title="男" {if isset($item.sex) && $item.sex == 1}checked{else if !isset($item.sex)}checked{/if}>
			<input type="radio" name="sex" value="2" title="女" {if isset($item.sex) && $item.sex == 2}checked{/if}>
		</div>
	</div>
	<div class="layui-form-item">
		<label class="layui-form-label">家庭地址</label>
		<div class="layui-input-inline">
			<input type="text" class="layui-input" name="address" value="{$item.address|default=''}">
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
	layui.use(['layer', 'form'], function () {
		var form = layui.form;
		layer = layui.layer;
		$ = layui.jquery;
	});
	layui.use('upload', function () {
		var upload = layui.upload;

		//执行实例
		var uploadInst = upload.render({
			elem: '#test1', //绑定元素
			url: "{:url('./extend/uploads/uploadImg')}", //上传接口
			done: function (res) {
				//上传完毕回调
				$('input[name=img]').val(res.url);
				layer.alert('上传完成');
			},
			error: function () {
				//请求异常回调
			}
		});
	});

	function save() {
		console.log(1);
		var id = $('input[name=id]').val();
		var true_name = $('input[name=true_name]').val();
		var username = $('input[name=username]').val();
		var password = $('input[name=password]').val();
		var img = $('input[name=img]').val();
		var phone = $('input[name=phone]').val();
		var office = $('input[name=office]').val();
		var work_type = $('input[name=work_type]').val();
		var staff_id = $('input[name=staff_id]').val();
		var sex = $('input[name=sex]:checked').val();
		var address = $('input[name=address]').val();

		var myreg = /^[1][3,4,5,7,8][0-9]{9}$/;

		if (!true_name || !username || !password || !img || !phone || !office || !work_type || !staff_id || !sex || !address) {
			layer.alert('请将信息填写完整');
			return false;
		}
		if (!myreg.test(phone)) {
			layer.alert('请将填写正确的手机号码');
			return false;
		}
		if (id) {
			// 编辑
			$.ajax({
				type: 'post',
				url: '{:url("maintainer/save")}',
				data: {
					id : id,
					true_name: true_name,
					username: username,
					password: password,
					img: img,
					phone: phone,
					office: office,
					work_type: work_type,
					staff_id: staff_id,
					sex: sex,
					address: address
				},
				dataType: 'json',
				success: function (data) {
					if (data.status) {
						layer.alert(data.msg, {'icon':1});
						setTimeout(function(){parent.window.location.reload();},1000);
					} else {
						layer.alert(data.msg, {'icon':2})
					}
				}
			})
		} else {
			// 新增
			$.ajax({
				type: 'post',
				url: '{:url("maintainer/save")}',
				data: {
					true_name: true_name,
					username: username,
					password: password,
					img: img,
					phone: phone,
					office: office,
					work_type: work_type,
					staff_id: staff_id,
					sex: sex,
					address: address
				},
				dataType: 'json',
				success: function (data) {
					if (data.status) {
						layer.alert(data.msg, {'icon':1});
						setTimeout(function(){parent.window.location.reload();},1000);
					} else {
						layer.alert(data.msg, {'icon':2})
					}
				}
			})
		}
	}
</script>
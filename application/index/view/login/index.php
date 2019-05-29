{extend name="base" /}
{block name="title"}登陆{/block}
{block name="content"}
<!--头部开始-->
<div class="top">
	<div class="top-content">
		<p class="top-name">登录</p>
<!--		<a href="#" class="cancel">取消</a>-->
	</div>
</div>
<div class="top-one">
	<div style="margin:0 auto;width: 90%;display:flex;">
		<p style="line-height:.8rem;background: #40d1c4;color: #fff;font-size: .32rem;">账户：</p>
		<input id="username" type="text" style="color: #fff;background:#40d1c4;"/>
	</div>
</div>
<div class="top-one">
	<div style="margin:0 auto;width: 90%;display:flex;">
		<p style="line-height:.8rem;background: #40d1c4;color: #fff;font-size: .32rem;">密码：</p>
		<input id="password" type="password" style="color: #fff;background:#40d1c4;" />
	</div>
</div>
<button id="login"  style="width: 80%;height: .7rem;margin: 0 auto;background:#40d1c4;display: block;text-align: center;color: #fff;font-size: .32rem;line-height: .7rem;border-radius: 1rem;">登录</button>
<div style="width: 80%;margin: .2rem auto;">
	<a href="#" style="font-size: .24rem;color:#6C6C6C;float: right;">忘记密码可咨询管理员</a>
</div>
<script>
	layui.use('layer',function(){
		layer = layui.layer;
		$ = layui.jquery;
	});
$(function () {
	$('#login').click(function () {
		var username = $('#username').val();
		var password = $('#password').val();
		if (!username || !password) {
			layer.alert('请将信息填写完整');
			return false;
		}
		$.ajax({
			type : 'post',
			url : '{:url("login/login")}',
			data : {
				username : username,
				password : password
			},
			dataType : 'json',
			success : function (data) {
				if(data.status) {
					layer.msg(data.msg);
					setTimeout(function(){
						window.location.href = '{:url("index/index")}'
					},1000);
 				} else {
					layer.msg(data.msg);
				}
			}
		})
	})
})
</script>
{/block}
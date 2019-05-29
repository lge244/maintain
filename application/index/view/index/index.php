{extend name="base" /}
{block name="title"}个人中心{/block}
{block name="content"}
<!--头部开始-->
<div class="top">
	<div class="top-content">
		<p class="top-name">个人中心</p>
	</div>
</div>
<div style="width:2rem;height: 2rem;margin: .2rem auto;">
	<img src="{$list['img']}" style="width: 100%;border-radius: 100%;"/>
</div>
<a href="{:url('withdraw/index')}" style="border-bottom:.01rem solid #F5F5F5;width:90%;margin: .2rem auto;display: block;height:.8rem;" href="#">
	<p style="font-size: .34rem;float: left;line-height:.8rem;color: #474747;">提现</p>
	<img src="__STATIC_INDEX_IMG__/back-01.png" style="float: right;width: 4%;"/>
</a>
<a href="{:url('order/index')}" style="border-bottom:.01rem solid #F5F5F5;width:90%;margin: .2rem auto;display: block;height:.8rem;" href="#">
	<p style="font-size: .34rem;float: left;line-height:.8rem;color: #474747;">我的维修</p>
	<img src="__STATIC_INDEX_IMG__/back-01.png" style="float: right;width: 4%;"/>
</a>
<div>
	<button id="login_out" style="display: block;background: #40d1c4;color: #fff;width: 80%;margin: .5rem auto;height: .7rem;line-height: .7rem;text-align: center;border-radius:.1rem;font-weight: bold;">
		退出登录
		<button>
</div>
<script>
	$(function () {
		layui.use('layer', function () {
			layer = layui.layer;
			$ = layui.jquery;
		});
		$('#login_out').click(function () {
			$.ajax({
				type: 'post',
				url: '{:url("login/loginOut")}',
				data: {},
				dataType: 'json',
				success: function (data) {
					if (data.status) {
						layer.msg(data.msg);
						setTimeout(function () {
							window.location.href = '{:url("login/index")}'
						}, 1000);
					}
				}
			})
		})
	})
</script>
{/block}
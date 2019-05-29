{extend name="base" /}
{block name="title"}提现{/block}
{block name="content"}
<!--头部开始-->
<div class="top">
	<div class="top-content">
		<a href="javascript:;" onclick="history.go(-1)" class="back"><img src="__STATIC_INDEX_IMG__/back.png" class="back-pic" /></a>
		<p class="top-name">提现</p>
	</div>
</div>
<p style="font-size:.32rem;color: #666666;margin: .4rem .4rem;">可提现金额：￥<span>{$balance|default=''}</span></p>
<div class="fui-cell-group" style="font-size: 0.33rem;overflow: hidden;position: relative;display: block;background: #F3F3F3;">
	<div class="fui-cell-title" style="height:.8rem;color:#666;line-height:.8rem;padding:.2rem .5rem;">提现金额</div>
	<div class="fui-cell" style="padding: 0 .6rem 0;display: flex;">
		<div class="fui-cell-label big" style="font-size:.5rem;color: #000;">￥</div>
		<div class="fui-cell-info">
			<input type="number" class="fui-input" id="balance" style="font-size:.5rem;background: #F3F3F3;" />
		</div>
	</div>
</div>
<div>
	<button id="withdraw" style="display: block;background: #40d1c4;color: #fff;width: 80%;margin: .5rem auto;height: .7rem;line-height: .7rem;text-align: center;border-radius:.1rem;font-weight: bold;">提现</button>
</div>
<script>
	$(function () {
		layui.use('layer',function(){
			layer = layui.layer;
			$ = layui.jquery;
		});
		$('#withdraw').click(function () {
			var balance = $('#balance').val();
			if (!balance) {
				layer.msg('提现金额不能为空');
				return false;
			}
			$.ajax({
				type : 'post',
				url : '{:url("withdraw/index")}',
				data : {
					balance : balance,
				},
				dataType : 'json',
				success : function (data) {
					if(data.status) {
						layer.msg(data.msg);
					} else {
						layer.msg(data.msg);
					}
				}
			})
		})
	})
</script>
{/block}
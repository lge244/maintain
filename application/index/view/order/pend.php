{extend name="base" /}
{block name="title"}处理订单信息{/block}
{block name="content"}
<!--头部开始-->
<div class="top">
	<div class="top-content">
		<a href="javascript:;" onclick="history.go(-1);" class="back"><img src="__STATIC_INDEX_IMG__/back.png" class="back-pic" /></a>
		<p class="top-name">处理订单信息</p>
	</div>
</div>
<!--订单开始-->
<div class="dingdan">
	<ul class="dingdan-ul">
		<li class="dingdan-li" style="border: none;">
			<p class="dingdan-left">订单号</p>
			<p class="dingdan-right">20190520112</p>
		</li>
		<li class="dingdan-li" style="border: none;">
			<p class="dingdan-left">距离</p>
			<input class="dingdan-right" style="border: .01rem solid #BBBBBB;border-radius: .4rem;height: .57rem;margin: auto 0;text-indent: .2rem;">
		</li>
		<li class="dingdan-li" style="border: none;">
			<p class="dingdan-left">扫描条形码</p>
			<input class="dingdan-right" style="border: .01rem solid #BBBBBB;border-radius: .4rem;height: .57rem;margin: auto 0;text-indent: .2rem;">
		</li>
		<li class="dingdan-li" style="border: none;">
			<p class="dingdan-left">维修项目</p>
			<input class="dingdan-right" style="border: .01rem solid #BBBBBB;border-radius: .4rem;height: .57rem;margin: auto 0;text-indent: .2rem;">
		</li>
		<li class="dingdan-li" style="border: none;">
			<p class="dingdan-left">完成时间</p>
			<input class="dingdan-right" style="border: .01rem solid #BBBBBB;border-radius: .4rem;height: .57rem;margin: auto 0;text-indent: .2rem;">
		</li>

	</ul>
	<ul class="choose-ul">
		<li class="choose-li"><button class="choose-btn yes">确定</button></li>
	</ul>
</div>
<!--订单结束-->
<script>
$(function () {
	layui.use('layer', function () {
		layer = layui.layer;
		$ = layui.jquery;
	});
})
</script>
{/block}
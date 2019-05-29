{extend name="base" /}
{block name="title"}订单详情{/block}
{block name="content"}
<!--头部开始-->
<div class="top">
	<div class="top-content">
		<a href="javascript:;" onclick="history.go(-1);" class="back"><img src="__STATIC_INDEX_IMG__/back.png" class="back-pic" /></a>
		<p class="top-name">订单详情</p>
	</div>
</div>
<!--头部结束-->
<!--订单开始-->
<div class="dingdan">
	<ul class="dingdan-ul">
		<li class="dingdan-li">
			<p class="dingdan-left">订单id：</p>
			<p class="dingdan-right">{$info['id']}</p>
		</li>
		<li class="dingdan-li">
			<p class="dingdan-left">空调品牌：</p>
			<p class="dingdan-right">{$info['brand']}</p>
		</li>
		<li class="dingdan-li">
			<p class="dingdan-left">用户名：</p>
			<p class="dingdan-right">{$true_name}</p>
		</li>
		<li class="dingdan-li">
			<p class="dingdan-left">电话：</p>
			<p class="dingdan-right">{$info['phone']}</p>
		</li>
		<li class="dingdan-li">
			<p class="dingdan-left">住址：</p>
			<p class="dingdan-right">{$info['callback']}</p>
		</li>
		<li class="dingdan-li">
			<p class="dingdan-left">故障描述：</p>
			<p class="dingdan-right">{$info['desc']}</p>
		</li>
		<li class="dingdan-li">
			<p class="dingdan-left">是否加急：</p>
			<p class="dingdan-right">{$info['worry'] ? '是' : '否'}</p>
		</li>
	</ul>
	<ul class="choose-ul">
		<li class="choose-li"><a id="order" style="display: inline-block;" class="choose-btn yes">接单</a></li>
		<li class="choose-li"><a href="javascript:;" onclick="history.go(-1)" style="display: inline-block;" class="choose-btn no">拒绝</a></li>
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
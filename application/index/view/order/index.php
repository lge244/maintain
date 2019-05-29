{extend name="base" /}
{block name="title"}我的维修{/block}
{block name="content"}
<!--头部开始-->
<div class="top">
	<div class="top-content">
		<a href="javascript:;" onclick="history.go(-1)" class="back"><img src="__STATIC_INDEX_IMG__/back.png" class="back-pic" /></a>
		<p class="top-name">我的维修</p>
	</div>
</div>
<!--头部结束-->
<!--工资开始-->
<div class="salary">
	<ul class="salary-ul">
		<li class="salary-li">
			<a href="javascript:;">
				<p class="salary-text">本月工资：<span class="salary-number">1908</span></p>
			</a>
		</li>
		<li class="salary-li">
			<a href="javascript:;">
				<p class="salary-text">上月工资：<span class="salary-number">1706</span></p>
			</a>
		</li>
		<li class="salary-li">
			<a href="javascript:;">
				<p class="salary-text">详情可咨询管理员</p>
			</a>
		</li>
	</ul>
</div>
<!--工资结束-->
<!--订单开始-->
<div class="dd-wrap">
	<div class="dd-tab">
		<ul class="dd-tab-hd">
			<li class="dd-li active">派单</li>
			<li class="dd-li">抢单</li>
			<li class="dd-li">订单详情</li>
		</ul>
		<ul class="dd-tab-bd">
			<li class="thisclass">
				<div class="dd-info">
					<ul class="info-ul">
						<li class="info-li">订单号：20190520112</li>
						<li class="info-li"><p class="description">故障描述：不制冷不制冷</p></li>
						<li class="info-li" style="text-align: center;"><a href="javascript:;">进入查看</a></li>
					</ul>
					<ul class="info-ul">
						<li class="info-li">订单号：20190520112</li>
						<li class="info-li"><p class="description">故障描述：不制冷不制冷</p></li>
						<li class="info-li" style="text-align: center;"><a href="javascript:;">进入查看</a></li>
					</ul>
				</div>
			</li>
			<li style="display: none;">
				<div class="dd-info">
					<ul class="info-ul">
						<li class="info-li">订单号：20190520112</li>
						<li class="info-li"><p class="description">故障：不制冷不制冷</p></li>
						<li class="info-li" style="text-align: center;"><a href="javascript:;">进入查看</a></li>
					</ul>
					<ul class="info-ul">
						<li class="info-li">订单号：20190520112</li>
						<li class="info-li"><p class="description">故障描述：不制冷不制冷</p></li>
						<li class="info-li" style="text-align: center;"><a href="javascript:;">进入查看</a></li>
					</ul>
				</div>
			</li>
			<li style="display: none;">
				<div class="dd-info">
					<ul class="info-ul">
						<li class="info-li">订单号：20190520112</li>
						<li class="info-li"><p class="description">故障描述：不制冷不制冷</p></li>
						<li class="info-li" style="text-align: center;"><a href="javascript:;">进入查看</a></li>
					</ul>
					<ul class="info-ul">
						<li class="info-li">订单号：20190520112</li>
						<li class="info-li"><p class="description">故障描述：不制冷不制冷</p></li>
						<li class="info-li" style="text-align: center;"><a href="javascript:;">进入查看</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</div>
</div>
<!--订单结束-->

<script type="text/javascript">
	//匿名函数自调
	$(function(){
		//声明函数，参数三个：导航标题、当前选择项、当前标题显示内容
		function tabs(tabTit,on,tabCon){
			//找到所有标题并添加单机事件
			$(tabTit).children().click(function(){
				//声明当前选择项
				var index = $(tabTit).children().index(this);
				//为当前选中项增加active，移除其兄弟元素的active
				$(this).addClass(on).siblings().removeClass(on);
				//选中项显示内容，未选中项隐藏内容
				$(tabCon).children().eq(index).show().siblings().hide();
			});
		};
		tabs(".dd-tab-hd","active",".dd-tab-bd");
	});
</script>
{/block}
{extend name="base" /}
{block name="title"}处理订单信息{/block}
{block name="content"}
<style>
	.file {
		position: relative;
		display: inline-block;
		background: #D0EEFF;
		border: 1px solid #99D3F5;
		border-radius: 4px;
		padding: 4px 12px;
		overflow: hidden;
		color: #1E88C7;
		text-decoration: none;
		text-indent: 0;
		line-height: 26px;
	}
	.file input {
		position: absolute;
		font-size: 100px;
		right: 0;
		top: 0;
		opacity: 0;
	}
	.file:hover {
		background: #AADFFD;
		border-color: #78C3F3;
		color: #004974;
		text-decoration: none;
	}
</style>

<!--头部开始-->
<div class="top">
	<div class="top-content">
		<a href="javascript:;" onclick="history.go(-1);" class="back"><img src="__STATIC_INDEX_IMG__/back.png"
		                                                                   class="back-pic"/></a>
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
			<input class="dingdan-right" id="distance"
			       style="border: .01rem solid #BBBBBB;border-radius: .4rem;height: .57rem;margin: auto 0;text-indent: .2rem;">
			<input class="dingdan-right" type="hidden" id="distance_Point"
			       style="border: .01rem solid #BBBBBB;border-radius: .4rem;height: .57rem;margin: auto 0;text-indent: .2rem;">
		</li>
		<li class="dingdan-li" style="border: none;">
			<p class="dingdan-left">条形码</p>
			<input id="barcode_number" class="dingdan-right"
			       style="border: .01rem solid #BBBBBB;border-radius: .4rem;height: .57rem;margin: auto 0;text-indent: .2rem;">
			<button type="button" class="layui-btn" id="barcode">
				<i class="layui-icon">&#xe67c;</i>
			</button>

		</li>
		<li class="dingdan-li" style="border: none;">
			<p class="dingdan-left">维修项目</p>
			<input class="dingdan-right"
			       style="border: .01rem solid #BBBBBB;border-radius: .4rem;height: .57rem;margin: auto 0;text-indent: .2rem;">
		</li>
		<li class="dingdan-li" style="border: none;">
			<p class="dingdan-left">完成时间</p>
			<input class="dingdan-right"
			       style="border: .01rem solid #BBBBBB;border-radius: .4rem;height: .57rem;margin: auto 0;text-indent: .2rem;">
		</li>
		<li class="dingdan-li" style="border: none;">
			<p class="dingdan-left">图片上传</p>
			<button type="button" class="layui-btn" id="test2">多图片上传</button>

		</li>
		<blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
			预览图：
			<div class="layui-upload-list" id="demo2"></div>
		</blockquote>
	</ul>
	<ul class="choose-ul">
		<li class="choose-li">
			<button class="choose-btn yes">确定</button>
		</li>
	</ul>
	<div id="allmap"></div>
</div>
<!--订单结束-->
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=Z8OaLxT8vIhoPHeAfp1ic1cbDBXMyZZu"></script>
<script>
	$(function () {
		layui.use(['layer', 'upload'], function () {
			layer = layui.layer;
			$ = layui.jquery;
			upload = layui.upload;
			//多图片上传
			upload.render({
				elem: '#test2'
				, url: '/index.php/index/Order/uploads'
				, multiple: true
				, before: function (obj) {
					//预读本地文件示例，不支持ie8
					obj.preview(function (index, file, result) {
						$('#demo2').append('<img src="' + result + '" alt="' + file.name + '" class="layui-upload-img" style="width: 92px;">')
					});
				}
				, done: function (res) {
					$('#demo2').append('<input type="hidden" name="pic" value="' + res.data + '">')
				}
			});
		});

		// 百度地图API功能
		var map = new BMap.Map("allmap");
		var point = new BMap.Point(116.331398, 39.897445);
		map.centerAndZoom(point, 12);

		var geolocation = new BMap.Geolocation();
		geolocation.getCurrentPosition(function (r) {
			if (this.getStatus() == BMAP_STATUS_SUCCESS) {
				var mk = new BMap.Marker(r.point);
				map.addOverlay(mk);
				map.panTo(r.point);
				console.log(r.point)
				// alert('您的位置：'+r.point.lng+','+r.point.lat);
				$('#distance_Point').val(r.point.lng + ',' + r.point.lat);
				var point = new BMap.Point(r.point.lng, r.point.lat);
				var gc = new BMap.Geocoder();
				gc.getLocation(point, function (rs) {
					var addComp = rs.addressComponents;
					actual_address = rs.address;
					$('#distance').val(rs.address);
				});
			} else {
				alert('failed' + this.getStatus());
			}
		}, {enableHighAccuracy: true})

		$('.yes').click(function () {

		});

		layui.use('upload', function () {
			var upload = layui.upload;

			//执行实例
			var uploadInst = upload.render({
				elem: '#barcode', //绑定元素
				url: "{:url('./extend/uploads/uploadImg')}", //上传接口
				done: function (res) {
					//上传完毕回调
					if (res.error != 0) layer.msg(res.message);
					var img_url = "http://" + document.domain + res.url;
					$.ajax({
						type : 'post',
						url : '{:url("./extend/barcode/check")}',
						data : {
							img : img_url
						},
						dataType : 'json',
						success : function (data) {
							if (data.status) {
								$('#barcode_number').val(data.data);
							} else {
								$('#barcode_number').val('');
								layer.msg(data.msg + '请重新上传');
							}
						}
					})
				},
				error: function () {
					//请求异常回调
				}
			});
		});

	})
</script>
{/block}
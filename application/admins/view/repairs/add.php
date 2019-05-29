<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
    <script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
    <script type="text/javascript" src="/static/js/jquery.min.js"></script>
    <script type="text/javascript" src="/static/js/map.jquery.min.js"></script>
    <style>
        /* reset */
        html, body, h1, h2, h3, h4, h5, h6, div, dl, dt, dd, ul, ol, li, p, blockquote, pre, hr, figure, table, caption, th, td, form, fieldset, legend, input, button, textarea, menu {
            margin: 0;
            padding: 0;
        }

        body {
            padding: 100px;
            font-size: 14px;
        }

        h1 {
            font-size: 26px;
        }

        p {
            font-size: 14px;
            margin-top: 10px;
        }

        pre {
            background: #eee;
            border: 1px solid #ddd;
            border-left: 4px solid #f60;
            padding: 15px;
            margin-top: 15px;
        }

        h2 {
            font-size: 20px;
            margin-top: 20px;
        }

        .case {
            margin-top: 15px;
            width: 400px;
        }

        .bMap {
            position: relative;
        }

        .bMap .map-warp {
            position: absolute;
            left: 0;
            width: 100%;
            height: 400px;
            top: 34px;
            display: none;
        }

        .bMap input {
            width: 190px;
            height: 36px;
            line-height: 30px;
            border: 1px solid #d7d7d7;
        }

        .tangram-suggestion-main {
            z-index: 9999
        }
    </style>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=EZPCgQ6zGu6hZSmXlRrUMTpr"></script>
</head>
<body style="padding: 10px;">
<form class="layui-form">
    <div class="layui-form-item">
        <label class="layui-form-label">指定师傅</label>
        <div class="layui-input-block">
            <select name="users" lay-verify="">
                <option value="0">不指定师傅（等于抢单）</option>
                {volist name="$users" id="user"}
                <option value="{$user.id}">{$user.true_name}</option>
                {/volist}
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">设备品牌</label>
        <div class="layui-input-block">
            <select name="brand" lay-verify="">
                {volist name="$project" id="projec"}
                <option value="{$projec.id}">{$projec.sort_title}</option>
                {/volist}
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">设备功率</label>
        <div class="layui-input-block">
            <input type="radio" name="power" value="2000" title="2000" checked="">
            <input type="radio" name="power" value="4000" title="4000">
            <input type="radio" name="power" value="6000" title="6000">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否加急</label>
        <div class="layui-input-block">
            <input type="radio" name="worry" value="是" title="是" checked="">
            <input type="radio" name="worry" value="否" title="否">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">维修项目</label>
        <div class="layui-input-block">
                {volist name="item" id="vo"}
                <input type="checkbox" name="project" value="{$vo.id}" title="{$vo.maintain_title}" lay-skin="primary">
                {/volist}
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">维修描述</label>
        <div class="layui-input-block">
            <textarea name="desc" placeholder="请输入内容" id="desc" lay-verify="required" class="layui-textarea"></textarea>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">详细地址</label>
        <div class="case">
            <div class="bMap" id='case3'></div>
            <div id="callback">

            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">直线距离</label>
        <div class="layui-input-inline">
            <input type="text" name="distance" id="distance" value="" placeholder="报修位置和中心点的直线距离" class="layui-input"
                   style="display: inline-block" disabled="">
        </div>
        <div class="layui-input-inline">
            <input type="text" name="price" id="price" value="" placeholder="预计距离奖励" class="layui-input"
                   style="display: inline-block" disabled="">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">联系人姓名</label>
        <div class="layui-input-inline">
            <input type="text" name="username" placeholder="请填写客户姓名" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">联系人电话</label>
        <div class="layui-input-inline">
            <input type="text" name="phone" placeholder="请填写客户姓名" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">故障照片</label>
        <div class="layui-upload">
            <button type="button" class="layui-btn" id="test2">图片上传</button>
            <blockquote class="layui-elem-quote layui-quote-nm" style="margin-top: 10px;">
                预览图：
                <div class="layui-upload-list" id="demo2"></div>
            </blockquote>
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
<script>
    $(function () {
        $("#case3").bMap({
            name: "callback", callback: function (address, point) {
                $.post('/index.php/admins/repairs/distance', {point: point}, function (res) {
                    console.log(res);
                    if (res.code == 0) {
                        $('#demo2').append('<input type="hidden" name="distance" value="' + res.distance + '">')
                        $('#demo2').append('<input type="hidden" name="price" value="' + res.price + '">')
                        $('#distance').val(res.distance)
                        $('#price').val(res.price)
                    }
                }, 'json')
            }
        });
    })
</script>
<script type="text/javascript">
    layui.use(['layer', 'form', 'upload'], function () {
        var form = layui.form;
        layer = layui.layer;
        $ = layui.jquery;
        upload = layui.upload;
        //多图片上传
        upload.render({
            elem: '#test2'
            , url: '/index.php/admins/repairs/uploads'
            , multiple: true
            , before: function (obj) {
                //预读本地文件示例，不支持ie8
                obj.preview(function (index, file, result) {
                    $('#demo2').append('<img src="' + result + '" alt="' + file.name + '" class="layui-upload-img" style="width: 92px;">')
                });
            }
            , done: function (res) {
                console.log(res)
                $('#demo2').append('<input type="hidden" name="pic" value="' + res.data + '">')
            }
        });
    });

    function save() {
        var pic = [];
        var project = [];
        $("input[name='pic']").each(function(){
            pic.push($(this).val());
        })
        console.log(pic);
        var id = parseInt($('input[name="id"]').val());
        var price = $.trim($('input[name="price"]').val());
        var distance = $.trim($('input[name="distance"]').val());
        var power =  $("input[name='power']:checked").val();
        var worry =  $("input[name='worry']:checked").val();
        var phone = $.trim($('input[name="phone"]').val());
        var username = $.trim($('input[name="username"]').val());
        var location_callback = $.trim($('input[name="location_callback"]').val());
        var callback = $.trim($('input[name="callback"]').val());
        var desc = $('#desc').val();
        var brand = $('select[name="brand"]').val();
        var users = $('select[name="users"]').val();
        $("input[name='project']:checked").each(function(){
            project.push($(this).val());
        });

        $.post('/index.php/admins/repairs/save', {
            brand:brand,
            power:power,
            worry:worry,
            desc:desc,
            callback:callback,
            location_callback:location_callback,
            username:username,
            phone:phone,
            price:price,
            distance:distance,
            pic:pic,
            project:project,
            uid:users,
        }, function (res) {
            if (res.code > 0) {
                layer.alert(res.msg, {'icon': 2});
            } else {
                layer.msg(res.msg, {'icon': 1});
                setTimeout(function () {
                    parent.window.location.reload();
                }, 1000);
            }
        }, 'json');
    }
</script>
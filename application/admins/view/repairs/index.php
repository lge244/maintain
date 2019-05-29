<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
    <script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
    <style type="text/css">
        .header span {
            background: #009688;
            margin-left: 30px;
            padding: 10px;
            color: #ffffff;
        }

        .header button {
            float: right;
            margin-top: -5px;
        }

        .header div {
            border-bottom: solid 2px #009688;
            margin-top: 8px;
        }
    </style>
</head>
<body style="padding: 10px;">
<div class="header">
    <span>报修列表</span>
    <button class="layui-btn layui-btn-sm" onclick="add()">报修创建</button>
    <div></div>
</div>
<table class="layui-table">
    <thead>
    <tr>
        <th>ID</th>
        <th>维修项目</th>
        <th>维修地址</th>
        <th>客户姓名</th>
        <th>客户电话</th>
        <th>故障图片</th>
        <th>创建时间</th>
        <th>订单状态</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    {volist name='$lists' id="vo"}
    <tr>
        <td>{$vo.id}</td>
        <td>
            <?php
            $count = count($vo['project']);
            $str = '';
            for ($i = 0; $i <= $count-1; $i++) {
                $str .= $vo['project'][$i]['maintain_title'].' / ';
            }
            echo $str;
            ?>
        </td>
        <td>{$vo.callback}</td>
        <td>{$vo.username}</td>
        <td>{$vo.phone}</td>
        <td>
            <?php
            $count = count($vo['pic']);
            for ($i = 0; $i <= $count-1; $i++) {
                $pic = $vo['pic'][$i];
                echo "<img src=' $pic ' style='width: 60px;'>";
            }

            ?>
        </td>
        <td>{:date('Y-m-d',$vo.creat_time)}</td>
        <td>
            {switch $vo.status}
            {case 0}未接单{/case}
            {case 1}已接单{/case}
            {default /}已完成
            {/switch}
            {$vo.is_accomplish==1? '/已审核' : ''}
        </td>
        <td>
            <button class="layui-btn layui-btn-warm layui-btn-xs" onclick="add({$vo.id},{$vo.status})">审核</button>
        </td>
    </tr>
    {/volist}
    </tbody>
</table>
</body>
</html>
<script type="text/javascript">
    layui.use(['layer'], function () {
        layer = layui.layer;
        $ = layui.jquery;
    });

    // 添加
    function add(id,status) {
        if (status !=2){
            layer.msg('订单尚未完成！无需审核！', {'icon': 2});
            return false;
        }
        $.post('/index.php/admins/repairs/audit',{
            order_id:id,
        },function (res) {
            if (res.code > 0) {
                layer.alert(res.msg, {'icon': 2});
            } else {
                layer.msg(res.msg, {'icon': 1});
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
            }
        },'json')
    }

    // 删除
    function del(gid) {
        layer.confirm('确定要删除吗？', {
            icon: 3,
            btn: ['确定', '取消']
        }, function () {
            $.post('/index.php/admins/repairs/delete', {'gid': gid}, function (res) {
                if (res.code > 0) {
                    layer.alert(res.msg, {'icon': 2});
                } else {
                    layer.msg(res.msg, {'icon': 1});
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                }
            }, 'json');
        });
    }
</script>
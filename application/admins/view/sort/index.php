<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="/static/plugins/layui/css/layui.css">
    <script type="text/javascript" src="/static/plugins/layui/layui.js"></script>
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
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
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="header">
                    <span>品牌分类列表</span>
                    <button class="layui-btn layui-btn-sm" onclick="add()">添加</button>
                    <div></div>
                </div>
                <div class="layui-card-body ">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th width="20">
                                <input type="checkbox" name="" lay-skin="primary">
                            </th>
                            <th width="70">ID</th>
                            <th>项目类型名称</th>
                            <th width="80">创建时间</th>
                            <th width="250">操作</th>
                        </thead>
                        <tbody class="x-cate">
                        {volist name='$lists' id="vo"}
                        <!--                        项目类型-->
                        <tr cate-id='{$vo.id}' fid='{$vo.fid}'>
                            <td>
                                <input type="checkbox" name="" lay-skin="primary">
                            </td>
                            <td>{$vo.id}</td>
                            <td>
                                {:htmlspecialchars_decode($vo.sort_title)}
                                <i class="layui-icon x-show" status='true'>&#xe623;</i>
                            </td>
                            <td>
                                {:date('Y-m-d',$vo.creat_time)}
                            </td>
                            <td class="td-manage">
                                <button class="layui-btn layui-btn-xs" onclick="add({$vo.id})">编辑</button>
                                <button class="layui-btn layui-btn-danger layui-btn-xs" onclick="del({$vo.id})">删除</button>
                                <button class="layui-btn layui-btn-danger layui-btn-xs" onclick="add_son({$vo.id})">添加下级</button>
                            </td>
                        </tr>
                        {/volist}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
<script type="text/javascript">
    layui.use(['layer'], function () {
        layer = layui.layer;
        $ = layui.jquery;
    });

    // 分类展开收起的分类的逻辑
    $(function () {
        $("tbody.x-cate tr[fid!='0']").hide();
        // 栏目多级显示效果
        $('.x-show').click(function () {
            if ($(this).attr('status') == 'true') {
                $(this).html('&#xe625;');
                $(this).attr('status', 'false');
                cateId = $(this).parents('tr').attr('cate-id');
                $("tbody tr[fid=" + cateId + "]").show();
            } else {
                cateIds = [];
                $(this).html('&#xe623;');
                $(this).attr('status', 'true');
                cateId = $(this).parents('tr').attr('cate-id');
                getCateId(cateId);
                for (var i in cateIds) {
                    $("tbody tr[cate-id=" + cateIds[i] + "]").hide().find('.x-show').html('&#xe623;').attr('status', 'true');
                }
            }
        })
    })
    var cateIds = [];

    function getCateId(cateId) {
        $("tbody tr[fid=" + cateId + "]").each(function (index, el) {
            id = $(el).attr('cate-id');
            cateIds.push(id);
            getCateId(id);
        });
    }

    // 添加
    function add(id) {
        layer.open({
            type: 2,
            title: id > 0 ? '编辑分类' : '添加分类',
            shade: 0.3,
            area: ['480px', '420px'],
            content: '/index.php/admins/sort/add?id=' + id
        });
    }

    function add_son(id) {
        layer.open({
            type: 2,
            title: id > 0 ? '编辑分类' : '添加分类',
            shade: 0.3,
            area: ['480px', '420px'],
            content: '/index.php/admins/sort/add_son?id=' + id
        });
    }

    // 删除
    function del(id) {
        layer.confirm('确定要删除吗？', {
            icon: 3,
            btn: ['确定', '取消']
        }, function () {
            $.post('/index.php/admins/sort/delete', {'id': id}, function (res) {
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

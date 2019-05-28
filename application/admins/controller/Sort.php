<?php

namespace app\admins\controller;

use think\Controller;
use Util\SysDb;

class Sort extends Base
{
    public function index()
    {
        $data['lists'] = $this->db->table('project_sort')->lists();
        $this->view->lists = $data['lists'];
        return $this->fetch();
    }

    public function add()
    {
        $id = (int)input('get.id');
        $data['item'] = $this->db->table('project_sort')->where(array('id' => $id))->item();
        $this->view->item = $data['item'];
        return $this->fetch('', $data);
    }

    public function save()
    {
        $data['sort_title'] = input('post.sort_title');
        $data['id'] = (int)input('post.id');
        if ($data['sort_title'] == '') {
            exit(json_encode(array('code' => 1, 'msg' => '分类名称不能为空')));
        }
        $data['creat_time'] = time();
        if ($data['id'] != 0) {
            $res = $this->db->table('project_sort')->where(array('id' => $data['id']))->update($data);
            if ($res) {
                exit(json_encode(array('code' => 0, 'msg' => '修改成功!')));
            }
        }
        $res = $this->db->table('project_sort')->where(array('sort_title' => $data['sort_title']))->item();
        if ($res) {
            exit(json_encode(array('code' => 1, 'msg' => '分类名称已存在')));
        }
        $res2 = $this->db->table('project_sort')->insert($data);
        if ($res2) {
            exit(json_encode(array('code' => 0, 'msg' => '添加成功!')));
        }
    }
    public function delete()
    {
        $id = (int)input('post.id');
        $res = $this->db->table('project_sort')->where(array('id' => $id))->delete();
        if (!$res) {
            exit(json_encode(array('code' => 1, 'msg' => '删除失败')));
        }
        exit(json_encode(array('code' => 0, 'msg' => '删除成功')));
    }

}
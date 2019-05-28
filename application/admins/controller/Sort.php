<?php

namespace app\admins\controller;

use think\Controller;
use Util\SysDb;

class Sort extends Base
{
    public function index()
    {
        $data = $this->db->table('project_sort')->lists();
        $a = $this->category($data);
        $this->view->lists = $a;
        return $this->fetch();
    }

    public function category($data,$fid=0,$level=0){
        static $array = array();
        foreach ($data as $key => $value) {
            if($value['fid'] == $fid){
                $value['level'] = $level;
                $value['sort_title'] = str_repeat("&nbsp;&nbsp;&nbsp;", $level). $value['sort_title'];
                $array[] = $value;
                $this->category($data,$value['id'],$level+1);
            }
        }
        return $array;
    }

    public function add()
    {
        $id = (int)input('get.id');
        $data['item'] = $this->db->table('project_sort')->where(array('id' => $id))->item();
        $this->view->item = $data['item'];
        return $this->fetch('', $data);
    }

    public function add_son()
    {
        $id = (int)input('get.id');
        $this->view->id = $id;
        return $this->fetch();
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

    public function save_son()
    {
        $data['sort_title'] = input('post.sort_title');
        $data['fid'] = (int)input('post.fid');
        if ($data['sort_title'] == '') {
            exit(json_encode(array('code' => 1, 'msg' => '分类名称不能为空')));
        }
        $data['creat_time'] = time();
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
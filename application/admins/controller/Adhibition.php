<?php
/**
 * Created by PhpStorm.
 * User: storn
 * Date: 2019/5/27
 * Time: 15:57
 */
namespace app\admins\controller;
use think\Controller;
use Util\SysDb;
class Adhibition extends Base
{
	public function index()
	{
		$data['lists'] = $this->db->table('maintain_module')->lists();
		$this->view->lists = $data['lists'];
		return $this->fetch();
	}

	public function add()
	{
		$id = (int)input('get.id');
		$data['item'] = $this->db->table('maintain_module')->where(array('id' => $id))->item();
		$this->view->item = $data['item'];
		return $this->fetch();
	}

	public function save()
	{
		$data['maintain_title'] = input('post.maintain_title');
		$data['maintain_price'] = (int)input('post.maintain_price');
		$data['id'] = (int)input('post.id');
		if ($data['maintain_title'] == '') {
			exit(json_encode(array('code' => 1, 'msg' => '维修项目名称不能为空')));
		}
		if ($data['maintain_price'] == '') {
			exit(json_encode(array('code' => 1, 'msg' => '维修项目金额不能为空')));
		}
		if ($data['id'] != 0) {
			$res = $this->db->table('maintain_module')->where(array('id' => $data['id']))->update($data);
			if ($res) {
				exit(json_encode(array('code' => 0, 'msg' => '修改成功!')));
			}
		}
		$res = $this->db->table('maintain_module')->where(array('maintain_title' => $data['maintain_title']))->item();
		if ($res) {
			exit(json_encode(array('code' => 1, 'msg' => '维修项目已存在')));
		}
		$res2 = $this->db->table('maintain_module')->insert($data);
		if ($res2) {
			exit(json_encode(array('code' => 0, 'msg' => '添加成功!')));
		}
	}

	public function delete()
	{
		$id = (int)input('post.id');
		$res = $this->db->table('maintain_module')->where(array('id' => $id))->delete();
		if (!$res) {
			exit(json_encode(array('code' => 1, 'msg' => '删除失败')));
		}
		exit(json_encode(array('code' => 0, 'msg' => '删除成功')));
	}
}
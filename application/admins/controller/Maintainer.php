<?php
/**
 * 维修人员管理
 */
namespace app\admins\controller;

use app\common\model\Maintainer as MaintainerModel;

class Maintainer extends Base
{
	protected $m_maintainer;
	public function __construct()
	{
		parent::__construct();
		$this->m_maintainer = new MaintainerModel();
	}

	/**
	 * 维修员列表
	 * @return \think\response\View
	 */
	public function index()
	{
		$res = $this->m_maintainer->findAllData();
		return view('maintainer/index', ['list' => $res]);
	}

	/**
	 * 编辑和添加
	 * @param $id
	 * @return \think\response\View
	 */
	public function form($id)
	{
		if (isset($id) && !empty($id)) {
			// 编辑
			$list = $this->m_maintainer->findData(['id' => $id]);
		}
		return view('maintainer/form', ['item' => isset($list) ? $list : '']);
	}

	/**
	 * 保存信息
	 * @return \think\response\Json
	 */
	public function save()
	{
		$data = $this->request->post();
		$id = isset($data['id']) ? $data['id'] : null;
		if (isset($data['id'])) unset($data['id']);
		$data['password'] = md5($data['password']);
		$vali_res = $this->validate($data,'app\common\validate\Maintainer.add');
		if($vali_res !== true) return json(['status' => 0, 'msg' => $vali_res]);
		$res = $this->m_maintainer->saveInfo($id, $data);
		unset($data);
		if ($res !== true) return json(['status' => 0, 'msg' => empty($id) ? '添加失败' : '修改失败']);
		return json(['status' => 1, 'msg' => empty($id) ? '添加成功' : '修改成功']);
	}

	/**
	 * 删除
	 * @return \think\response\Json
	 */
	public function del()
	{
		$id = $this->request->param('id');
		$res = MaintainerModel::destroy($id);
		if ($res !== true) return json(['status' => 0, 'msg' => '删除失败']);
		return json(['status' => 1, 'msg' => '删除成功']);
	}
}
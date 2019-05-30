<?php
/**
 * 订单
 */

namespace app\index\controller;

use app\common\controller\IndexBase;
use app\common\model\MaintainModule;
use app\common\model\MaintenanceOrder;
use think\Db;
use think\facade\Session;

class Order extends IndexBase
{
	protected $maintainOrder;
	protected $maintainModule;

	public function __construct()
	{
		parent::__construct(true);
		$this->maintainOrder = new MaintenanceOrder();
		$this->maintainModule = new MaintainModule();
	}

	/**
	 * 订单列表
	 * @return \think\response\View
	 */
	public function index()
	{
		// 抢单
		$where1 = [
			'uid'    => 0,
			'status' => 0,
		];
		$list1 = $this->maintainOrder->findAllData($where1, '*', 'creat_time');
		// 进行中
		$where2 = [
			'uid'    => $this->uid,
			'status' => 1
		];
		$list2 = $this->maintainOrder->findAllData($where2, '*', 'creat_time');
		// 已完成
		$where3 = [
			'uid'    => $this->uid,
			'status' => 2
		];
		$list3 = $this->maintainOrder->findAllData($where3, '*', 'creat_time');
		$list = [
			$list1, $list2, $list3
		];
		return view('order/index', [
			'list' => $list
		]);
	}

	public function details($id = null)
	{
		if (empty($id)) $this->error('非法请求');
		$info = $this->maintainOrder->findData(['id' => $id]);
		$brand = Db::name('project_sort')->column('sort_title', 'id');
		return view('order/details', [
			'info'  => $info,
			'brand' => $brand
		]);
	}

	public function pend($id = null)
	{
		if (empty($id)) $this->error('非法请求');
		$info = $this->maintainOrder->findData(['id' => $id]);
		if ($info['status'] != 1) $this->error('该订单状态不符合需求');
		$maintain_module = $this->maintainModule->findAllData([], '*', 'id');
		return view('order/pend', [
			'info' => $info,
			'maintain_module' => $maintain_module
		]);
	}

	public function receive()
	{
		$order_id = $this->request->param();
		$user = Session::get('user');
		$data['uid'] = $user['id'];
		$data['status'] = 1;
		$res = $this->maintainOrder->saveInfo($order_id, $data);
		if ($res) {
			exit(json_encode(array('code' => 0, 'msg' => "抢单成功！")));
		}
		exit(json_encode(array('code' => 1, 'msg' => "抢单成功！")));
	}

	public function uploads()
	{
		// 获取到上传的图片信息
		$file = request()->file('file');
		// 移动到框架应用根目录/uploads/ 目录下
		if ($info = $file->validate(['ext' => 'jpg,jpeg,png,gif'])->move('upload')) {
			//客户端要求返回的必须是JSON格式数据,默认没有加上上传目录,需要手工添加一下
			$fileName = '/upload/' . $info->getSaveName();
			return json([1, '上传成功！', 'data' => $fileName]);
		} else {
			//处理出错信息,其实客户端也会处理的,可省略
			return $file->getError();
		}
	}

	/**
	 * 完成
	 */
	public function complete()
	{
		$data = $this->request->param();

		dump($data);

	}
}

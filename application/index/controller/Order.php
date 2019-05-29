<?php
/**
 * 订单
 */

namespace app\index\controller;

use app\common\controller\IndexBase;
use app\common\model\MaintenanceOrder;

class Order extends IndexBase
{
	protected $maintainOrder;

	public function __construct()
	{
		parent::__construct(true);
		$this->maintainOrder = new MaintenanceOrder();
	}

	/**
	 * 订单列表
	 * @return \think\response\View
	 */
	public function index()
	{
		// 派单
		$where1 = [
			'uid', '<>', 0,
			'status', '=', 1
		];
		$list1 = $this->maintainOrder->findAllData($where1, '*', 'creat_time');
		// 抢单
		$list2 = $this->maintainOrder->findAllData();
		// 已完成订单
		$list3 = $this->maintainOrder->findAllData();
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
		return view('order/details', ['info' => $info]);
	}
}

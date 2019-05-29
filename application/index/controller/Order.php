<?php
/**
 * 订单
 */
namespace app\index\controller;

use app\common\controller\IndexBase;

class Order extends IndexBase
{
	public function __construct()
	{
		parent::__construct(true);
	}

	public function index()
	{
		return view('order/index');
	}
}

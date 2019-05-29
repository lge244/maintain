<?php
/**
 * 提现
 */

namespace app\index\controller;

use app\common\controller\IndexBase;
use app\common\model\Maintainer;

class Withdraw extends IndexBase
{
	protected $maintainer;
	protected $withdraw;

	public function __construct()
	{
		parent::__construct(true);
		$this->maintainer = new Maintainer();
		$this->withdraw = new \app\common\model\Withdraw();
	}

	/**
	 * 提现
	 * @return \think\response\View
	 */
	public function index()
	{
		$user_info = $this->maintainer->findData(['id' => $this->uid], 'balance');
		if ($this->request->isAjax()) {
			$balance = $this->request->param('balance');
			$vali_data = [
				'balance' => $balance,
			];
			$vali_res = $this->validate($vali_data, 'app\common\validate\Withdraw.withdraw');
			if ($vali_res !== true) return json(['status' => 0, 'msg' => $vali_res]);
			if ($balance > $user_info['balance']) return json(['status' => 0, 'msg' => '提示金额不可以大于余额']);
			$data = [
				'uid'         => $this->uid,
				'price'       => $balance,
				'create_time' => time(),
				'status'      => 0
			];
			$res = $this->withdraw->saveInfo('', $data);
			if ($res !== true) return json(['status' => 0, 'msg' => '提现失败']);
			return json(['status' => 1, 'msg' => '提现成功，请等待管理员审核']);
		}
		return view('withdraw/index', ['balance' => $user_info['balance']]);
	}
}

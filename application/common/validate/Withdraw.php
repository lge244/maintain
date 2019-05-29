<?php
/**
 * 提现
 */

namespace app\common\validate;

use think\Validate;

class Withdraw extends Validate
{
	/**
	 * 验证规则
	 * @var array
	 */
	protected $rule = [
		'balance' => 'require|number',
	];
	/**
	 * 错误信息
	 * @var array
	 */
	protected $message = [
		'balance.require' => '提现金额不能为空',
		'balance.number'  => '提现金额不合法',
	];

	/**
	 * 验证场景
	 * @var array
	 */
	protected $scene = [
		'withdraw' => ['balance'],
	];
}
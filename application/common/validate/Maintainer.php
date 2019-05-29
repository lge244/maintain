<?php
/**
 * 维修人员
 */

namespace app\common\validate;

use think\Validate;

class Maintainer extends Validate
{
	/**
	 * 验证规则
	 * @var array
	 */
	protected $rule = [
		'true_name' => 'require',
		'username'  => 'require|alphaNum',
		'password'  => 'require|alphaNum',
		'img'       => 'require',
		'phone'     => 'require|mobile',
		'office'    => 'require',
		'work_type' => 'require',
		'staff_id'  => 'require',
		'sex'       => 'require|in:1,2',
		'address'   => 'require',
	];
	/**
	 * 错误信息
	 * @var array
	 */
	protected $message = [
		'true_name.require' => '真实姓名不能为空',
		'username.require'  => '用户名不能为空',
		'username.alphaNum' => '用户名只能是字母和数字',
		'password.require'  => '密码不能为空',
		'password.alphaNum' => '密码只能是字母和数字',
		'img.require'       => '头像不能为空',
		'phone.require'     => '手机号码不能为空',
		'phone.mobile'      => '请填写正确的手机号码',
		'office.require'    => '办公室不能为空',
		'work_type.require' => '工种不能为空',
		'staff_id.require'  => '员工号不能为空',
		'sex.require'       => '性别不能为空',
		'sex.in'            => '性别必须为男或者女',
		'address.require'   => '家庭地址不能为空',
	];

	/**
	 * 验证场景
	 * @var array
	 */
	protected $scene = [
		'add' => ['true_name', 'username', 'password', 'img', 'phone', 'office', 'work_type', 'staff_id', 'sex', 'address'],
	];
}
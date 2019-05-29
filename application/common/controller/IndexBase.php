<?php

/**
 * 前台基类
 */

namespace app\common\controller;

use think\Controller;
use think\facade\Session;
use think\facade\View;

class IndexBase extends Controller
{
	// 用户id
	protected $uid;
	// 用户名
	protected $username;
	// 真实姓名
	protected $true_name;
	public function __construct($need_login = true)
	{
		parent::__construct();
		if ($need_login) {
			$user = Session::get('user');
			if (empty($user)) {
				$this->error('请先登录', 'login/index');
			}
		}
		$this->uid = Session::get('user.id');
		$this->username = Session::get('user.username');
		$this->true_name = Session::get('user.true_name');
		$this->globalVariable();
	}

	public function globalVariable()
	{
		View::assign([
			'uid' => $this->uid,
			'username' => $this->username,
			'true_name' => $this->true_name
		]);
	}
}
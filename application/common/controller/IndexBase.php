<?php

/**
 * 前台基类
 */

namespace app\common\controller;

use think\Controller;
use think\facade\Session;

class IndexBase extends Controller
{
	protected $uid;
	protected $username;
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
	}
}
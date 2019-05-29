<?php

/**
 * 登陆
 */

namespace app\index\controller;

use app\common\controller\IndexBase;
use app\common\model\Maintainer;
use think\facade\Session;

class Login extends IndexBase
{
	protected $maintainer;
	public function __construct()
	{
		parent::__construct();
		$this->maintainer = new Maintainer();
	}

	public function index()
	{
		return view('login/index');
	}

	/**
	 * 登陆
	 * @return \think\response\Json
	 */
	public function login()
	{
		$data = $this->request->param();
		$vali_res = $this->validate($data, 'app\common\validate\Maintainer.login');
		if ($vali_res !== true) return json(['status' => 0, 'msg' => $vali_res]);
		$res = $this->maintainer->findData(['username' => $data['username']]);
		if ($res['password'] != md5($data['password'])) return json(['status' => 0, 'msg' => '账号或密码错误']);
		return json(['status' => 1, 'msg' => '登陆成功']);
	}

	/**
	 * 退出登陆
	 * @return \think\response\Json
	 */
	public function loginOut()
	{
		$res = Session::delete('user');
		if (!$res) return json(['status' => 0, 'msg' => '退出失败']);
		return json(['status' => 1, 'msg' => '退出成功']);
	}
}
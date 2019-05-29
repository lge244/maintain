<?php

/**
 * 前台基类
 */

namespace app\common\controller;

use think\Controller;

class IndexBase extends Controller
{
	public function __construct($need_login = true)
	{
		parent::__construct();
		if ($need_login) {

		}
	}
}
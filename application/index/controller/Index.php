<?php

namespace app\index\controller;

use app\common\controller\IndexBase;

class Index extends IndexBase
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo 1;die;
		return view('index/index');
	}
}

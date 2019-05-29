<?php
/**
 * 个人中心
 */
namespace app\index\controller;

use app\common\controller\IndexBase;
use app\common\model\Maintainer;

class Index extends IndexBase
{
	protected $maintainer;
	public function __construct()
	{
		parent::__construct(true);
		$this->maintainer = new Maintainer();
	}

	/**
	 * 个人中心
	 * @return \think\response\View
	 */
	public function index()
	{
		$res = $this->maintainer->findData(['id' => $this->uid]);
		return view('index/index', ['list' => $res]);
	}
}

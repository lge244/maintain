<?php
/**
 * 上传文件
 */

namespace app\extend\controller;

use think\Controller;
use think\facade\Session;

class Uploads extends Controller
{
	public function __construct()
	{
		parent::__construct();
		if (!Session::has('admin')) {
			$result = [
				'error'   => 1,
				'message' => '未登录'
			];
			return json($result);
		}
	}

	public function uploadImg()
	{
		$config = [
			'size' => 2097152,
			'ext'  => 'jpeg,jpg,gif,png,bmp'
		];

		$file = $this->request->file('file');
		$upload_path = str_replace('\\', '/', './uploads');
		$save_path = '/uploads/';
		$info = $file->validate($config)->move($upload_path);
		if ($info) {
			$result = [
				'error' => 0,
				'url'   => str_replace('\\', '/', $save_path . $info->getSaveName())
			];
		} else {
			$result = [
				'error'   => 1,
				'message' => $file->getError()
			];
		}
		return json($result);
	}

}
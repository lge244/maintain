<?php
/**
 * 上传文件
 */

namespace app\extend\controller;

use think\Controller;
use think\facade\Session;

class Barcode extends Controller
{
	/**
	 * @var string key值
	 */
	protected $appkey = "b3dc2aa582e2d02d";
	/**
	 * 接口地址
	 * @var string
	 */
	protected $api = "https://api.jisuapi.com/barcode/read";
	protected $appsecret = "6gnEvyVoChqcJD8VK1GQVOOgxlS2wGar";
	/**
	 * 完整地址
	 * @var
	 */
	protected $apiUrl;

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * 解析条形码
	 * @return \think\response\Json
	 */
	public function check()
	{
		$img = $this->request->param('img');
		if (empty($img)) return json(['status' => 0, 'msg' => '参数不合法']);
		$this->apiUrl = $this->api . "?&appkey=" . $this->appkey . "&barcode=" . $img;
		$res = json_decode(curlOpen($this->apiUrl, ['ssl' => true]), true);
		if ($res['status'] != 0) return json(['status' => 0, 'msg' => $res['msg']]);
		return json(['status' => 1, 'msg' => $res['msg'], 'data' => $res['result'][0]['number']]);
	}

}
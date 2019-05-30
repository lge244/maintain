<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------


// 应用公共文件
function importExcel($file, $sheet = 0)
{
	$file = iconv("utf-8", "gb2312", $file);   //转码
	if (empty($file) OR !file_exists($file)) {
		die('file not exists!');
	}
	$objRead = new PHPExcel_Reader_Excel2007();   //建立reader对象
	if (!$objRead->canRead($file)) {
		$objRead = new PHPExcel_Reader_Excel5();
		if (!$objRead->canRead($file)) {
			die('No Excel!');
		}
	}

	$cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

	$obj = $objRead->load($file);  //建立excel对象
	$currSheet = $obj->getSheet($sheet);   //获取指定的sheet表
	$columnH = $currSheet->getHighestColumn();   //取得最大的列号
	$columnCnt = array_search($columnH, $cellName);
	$rowCnt = $currSheet->getHighestRow();   //获取总行数

	$data = array();
	for ($_row = 1; $_row <= $rowCnt; $_row++) {  //读取内容
		for ($_column = 0; $_column <= $columnCnt; $_column++) {
			$cellId = $cellName[$_column] . $_row;
			$cellValue = $currSheet->getCell($cellId)->getValue();
			//$cellValue = $currSheet->getCell($cellId)->getCalculatedValue();  #获取公式计算的值
			if ($cellValue instanceof PHPExcel_RichText) {   //富文本转换字符串
				$cellValue = $cellValue->__toString();
			}

			$data[$_row][$cellName[$_column]] = $cellValue;
		}
	}

	return $data;
}

function tidy_time($time)
{

	$d = floor($time / (3600 * 24));
	$h = floor(($time % (3600 * 24)) / 3600);
	$m = floor((($time % (3600 * 24)) % 3600) / 60);
	if ($d > '0') {
		return $d . '天' . $h . '小时' . $m . '分钟';
	} else {
		if ($h != '0') {
			return $h . '小时' . $m . '分';
		} else {
			return $m . '分';
		}
	}
}


/**
 * 创建(导出)Excel数据表格
 * @param array $list 要导出的数组格式的数据
 * @param string $filename 导出的Excel表格数据表的文件名
 * @param array $header Excel表格的表头
 * @param array $index $list数组中与Excel表格表头$header中每个项目对应的字段的名字(key值)
 * 比如: $header = array('编号','姓名','性别','年龄');
 *       $index = array('id','username','sex','age');
 *       $list = array(array('id'=>1,'username'=>'YQJ','sex'=>'男','age'=>24));
 * @return [array] [数组]
 */
function createtable($list, $filename, $header = array(), $index = array())
{
	header("Content-type:application/vnd.ms-excel");
	header("Content-Disposition:filename=" . $filename . ".xls");
	$teble_header = implode("\t", $header);
	$strexport = $teble_header . "\r";
	foreach ($list as $row) {
		foreach ($index as $val) {
			$strexport .= $row[$val] . "\t";
		}
		$strexport .= "\r";

	}
	$strexport = iconv('UTF-8', "GB2312//IGNORE", $strexport);
	exit($strexport);
}

function curlOpen($url, $config = array())
{
	$arr = array('post' => false,'referer' => $url,'cookie' => '', 'useragent' => 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; Trident/4.0; SLCC1; .NET CLR 2.0.50727; .NET CLR 3.0.04506; customie8)', 'timeout' => 20, 'return' => true, 'proxy' => '', 'userpwd' => '', 'nobody' => false,'header'=>array(),'gzip'=>true,'ssl'=>false,'isupfile'=>false);
	$arr = array_merge($arr, $config);
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, $arr['return']);
	curl_setopt($ch, CURLOPT_NOBODY, $arr['nobody']);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_USERAGENT, $arr['useragent']);
	curl_setopt($ch, CURLOPT_REFERER, $arr['referer']);
	curl_setopt($ch, CURLOPT_TIMEOUT, $arr['timeout']);
	//curl_setopt($ch, CURLOPT_HEADER, true);//获取header
	if($arr['gzip']) curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
	if($arr['ssl'])
	{
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	}
	if(!empty($arr['cookie']))
	{
		curl_setopt($ch, CURLOPT_COOKIEJAR, $arr['cookie']);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $arr['cookie']);
	}

	if(!empty($arr['proxy']))
	{
		//curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
		curl_setopt ($ch, CURLOPT_PROXY, $arr['proxy']);
		if(!empty($arr['userpwd']))
		{
			curl_setopt($ch,CURLOPT_PROXYUSERPWD,$arr['userpwd']);
		}
	}

	//ip比较特殊，用键值表示
	if(!empty($arr['header']['ip']))
	{
		array_push($arr['header'],'X-FORWARDED-FOR:'.$arr['header']['ip'],'CLIENT-IP:'.$arr['header']['ip']);
		unset($arr['header']['ip']);
	}
	$arr['header'] = array_filter($arr['header']);

	if(!empty($arr['header']))
	{
		curl_setopt($ch, CURLOPT_HTTPHEADER, $arr['header']);
	}

	if ($arr['post'] != false)
	{
		curl_setopt($ch, CURLOPT_POST, true);
		if(is_array($arr['post']) && $arr['isupfile'] === false)
		{
			$post = http_build_query($arr['post']);
		}
		else
		{
			$post = $arr['post'];
		}
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	$result = curl_exec($ch);
	//var_dump(curl_getinfo($ch));
	curl_close($ch);

	return $result;
}
<?php

namespace app\common\model;

use think\Model;
use think\model\concern\SoftDelete;

class MaintenanceOrder extends Model
{
	/**
	 * 查询所有数据
	 * @param array $where
	 * @param string $field
	 * @param string $order
	 * @return array|\PDOStatement|string|\think\Collection|null
	 */
	public function findAllData($where = [], $field = '*', $order = 'create_time')
	{
		try {
			return $this->where($where)->field($field)->order($order, 'desc')->select();
		} catch (\Exception $e) {
			return null;
		}
	}

	/**
	 * 查询一条指定数据
	 * @param array $where
	 * @param string $field
	 * @return array|\PDOStatement|string|Model|null
	 */
	public function findData($where, $field = '*')
	{
		try {
			return $this->where($where)->field($field)->find();
		} catch (\Exception $e) {
			return null;
		}
	}

	/**
	 * 保存信息
	 * @param $id
	 * @param array $data
	 * @return bool
	 */
	public function saveInfo($id, $data = [])
	{
		try {
			if (empty($id)) {
				// 添加
				$data['create_time'] = time();
				$data['update_time'] = time();
				return $this->save($data);
			} else {
				// 编辑
				$data['update_time'] = time();
				return $this->save($data, ['id' => $id]);
			}
		} catch (\Exception $e) {
			return null;
		}
	}
}
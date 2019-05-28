<?php
namespace Util;
use think\Db;

/**
 * 
 */
class SysDb{
	// 指定表名
	public function table($table){
		$this->where = [];
		$this->field = '*';
		$this->order = '';
		$this->limit = 0;

		$this->table = $table;
		return $this;
	}

	// 指定查询字段
	public function field($field = '*'){
		$this->field = $field;
		return $this;
	}

	// 加载数量
	public function limit($limit){
		$this->limit = $limit;
		return $this;
	}

	// 排序
	public function order($order){
		$this->order = $order;
		return $this;
	}

	// 指定查询条件
	public function where($where = []){
		$this->where = $where;
		return $this;
	}

	// 返回一条记录
	public function item(){
		return Db::name($this->table)->field($this->field)->where($this->where)->find();
	}

	// 返回多条数据
	public function lists(){
		$query = Db::name($this->table)->field($this->field)->where($this->where);
		$this->limit && $query = $query->limit($this->limit);
		$this->order && $query = $query->order($this->order);
		return $query->select();
	}

	// 自定义索引
	public function cates($index){
		$query = Db::name($this->table)->field($this->field)->where($this->where);
		$this->limit && $query = $query->limit($this->limit);
		$this->order && $query = $query->order($this->order);
		$lists = $query->select();
		if(!$lists){
			return $lists;
		}
		$result = [];
		foreach ($lists as $key => $value) {
			$result[$value[$index]] = $value;
		}
		return $result;
	}

	public function count(){
		return Db::name($this->table)->where($this->where)->count();
	}


	// 分页
	public function pages($pageSize = 10){
		$total = Db::name($this->table)->where($this->where)->count();
		$query = Db::name($this->table)->field($this->field)->where($this->where);
		$this->order && $query = $query->order($this->order);
		$data = $query->paginate($pageSize,$total);
		return array('total'=>$total,'lists'=>$data->items(),'pages'=>$data->render());
	}

	// 添加
	public function insert($data){
		return Db::name($this->table)->insertGetId($data);
	}

	// 批量添加数据
	public function insertAll($data){
		return Db::name($this->table)->insertAll($data);
	}

	// 修改
	public function update($data){
		return Db::name($this->table)->where($this->where)->update($data);
	}

	// 删除
	public function delete(){
		return Db::name($this->table)->where($this->where)->delete();
	}

	// 自减
	public function setDec($index,$value=1){
		$res = Db::name($this->table)->where($this->where)->setDec($index,$value);
		return $res;
	}
}
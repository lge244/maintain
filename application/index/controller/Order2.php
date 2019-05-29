<?php
/**
 * 订单
 */

namespace app\index\controller;

use app\common\controller\IndexBase;
use app\common\model\MaintenanceOrder;
use think\facade\Session;
class Order extends IndexBase
{
    protected $maintainOrder;

    public function __construct()
    {
        parent::__construct(true);
        $this->maintainOrder = new MaintenanceOrder();
    }

    /**
     * 订单列表
     * @return \think\response\View
     */
    public function index()
    {
        // 抢单
        $where1 = [
            'uid' => 0,
            'status' => 0,
        ];
        $list1 = $this->maintainOrder->findAllData($where1, '*', 'creat_time');
        // 进行中
        $where2 = [
            'uid' => $this->uid,
            'status' => 1
        ];
        $list2 = $this->maintainOrder->findAllData($where2, '*', 'creat_time');
        // 已完成
        $where3 = [
            'uid' => $this->uid,
            'status' => 2
        ];
        $list3 = $this->maintainOrder->findAllData($where3, '*', 'creat_time');
        $list = [
            $list1, $list2, $list3
        ];
        return view('order/index', [
            'list' => $list
        ]);
    }

    public function details($id = null)
    {
        if (empty($id)) $this->error('非法请求');
        $info = $this->maintainOrder->findData(['id' => $id]);
        return view('order/details', ['info' => $info]);
    }

    public function receive()
    {
        $order_id = $this->request->param();
        $user = Session::get('user');
        $data['uid'] = $user['id'];
        $data['status'] = 1;
        $res = $this->maintainOrder->saveInfo($order_id,$data);
        if ($res){
            exit(json_encode(array('code'=>0,'msg'=>"抢单成功！")));
        }
        exit(json_encode(array('code'=>1,'msg'=>"抢单成功！")));
    }
}

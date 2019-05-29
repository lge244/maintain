<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/28 0028
 * Time: 17:08
 */

namespace app\admins\controller;

use think\Controller;
use Util\SysDb;

class System extends Base
{
    public function index()
    {
        $data = $this->db->table('system')->item();
        $this->view->item=$data;
        return $this->fetch();
    }

    public function save()
    {
        $data['address'] = input('post.callback');
        $data['location_callback'] = input('post.location_callback');
        $data['distance_reward'] = input('post.distance_reward');
        $data['time_reward'] = input('post.time_reward');
        $data['standard'] = input('post.standard');
        $data['service_ratio'] = input('post.service_ratio');
        $res = $this->db->table('system')->where(array('id' => 1))->update($data);
        if ($res) {
            exit(json_encode(array('code' => 0, 'msg' => '保存成功!')));
        }
        exit(json_encode(array('code' => 1, 'msg' => '保存失败!')));


    }

}
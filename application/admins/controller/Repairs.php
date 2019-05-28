<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/28 0028
 * Time: 15:03
 */

namespace app\admins\controller;

use think\Controller;
use Util\SysDb;


class Repairs extends Base
{
    public function index()
    {
        $this->view->lists = 1;
        return $this->fetch();
    }

    public function add()
    {
        $data = $this->db->table('project_sort')->lists();
        $data= json_encode($data);
        $this->view->item =$data ;
        return $this->fetch();
    }
}
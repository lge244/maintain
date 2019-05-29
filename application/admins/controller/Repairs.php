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
        $maintenance = $this->db->table('maintenance_order')->lists();
        foreach ($maintenance as $k => $v) {
            $maintenance[$k]['brand'] = $this->db->table('project_sort')->where(array('id' => $v['brand']))->item();
            $maintenance[$k]['project'] = json_decode($v['project']);
            $maintenance[$k]['pic'] = json_decode($v['pic']);
            if (is_array($maintenance[$k]['project'])){
                foreach ($maintenance[$k]['project'] as $key => $value) {
                    $maintenance[$k]['project'][$key] = $this->db->table('maintain_module')->where(array('id' => $value))->item();
                }
            }

        }
        $this->view->lists = $maintenance;
        return $this->fetch();
    }

    public function add()
    {
        $maintain = $this->db->table('maintain_module')->lists();
        $project = $this->db->table('project_sort')->lists();
        $users = $this->db->table('maintainer')->lists();

        $this->view->item = $maintain;
        $this->view->project = $project;
        $this->view->users = $users;
        return $this->fetch();
    }

    public function save()
    {
        $data = $this->request->post();
        $data['status'] = 0;
        $data['creat_time'] = time();
        $data['pic'] = json_encode($data['pic']);
        $data['project'] = json_encode($data['project']);
        if ($data['uid'] !=0){
            $data['status'] = 1;
            $data['receive_time'] = time();
        }
        $res2 = $this->db->table('maintenance_order')->insert($data);
        if ($res2) {
            exit(json_encode(array('code' => 0, 'msg' => '创建成功!')));
        }
        exit(json_encode(array('code' => 1, 'msg' => '创建失败!')));
    }

    public function uploads()
    {
        // 获取到上传的图片信息
        $file = request()->file('file');
        // 移动到框架应用根目录/uploads/ 目录下
        if ($info = $file->validate(['ext' => 'jpg,jpeg,png,gif'])->move('upload')) {
            //客户端要求返回的必须是JSON格式数据,默认没有加上上传目录,需要手工添加一下
            $fileName = '/upload/' . $info->getSaveName();
            return json([1, '上传成功！', 'data' => $fileName]);
        } else {
            //处理出错信息,其实客户端也会处理的,可省略
            return $file->getError();
        }
    }

    public function distance()
    {
        $point = input('post.point');
        $system = $this->db->table('system')->item();
        $location_callback = explode(",", $system['location_callback']);

        $distance = $this->getdistance($location_callback[0], $location_callback[1], $point['lng'], $point['lat']);

        if ($distance > $system['standard']) {
            $award = $distance - $system['standard'];
            $price = $award * $system['distance_reward'];
            exit(json_encode(array('code' => 0, 'distance' => $distance, 'price' => $price)));

        } else {
            $price = 0;
            exit(json_encode(array('code' => 0, 'distance' => $distance, 'price' => $price)));
        }


    }

    protected function getdistance($lng1, $lat1, $lng2, $lat2)
    {
        // 将角度转为狐度
        $radLat1 = deg2rad($lat1); //deg2rad()函数将角度转换为弧度
        $radLat2 = deg2rad($lat2);
        $radLng1 = deg2rad($lng1);
        $radLng2 = deg2rad($lng2);
        $a = $radLat1 - $radLat2;
        $b = $radLng1 - $radLng2;
        $s = round(2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2))) * 6378.137, 2);
        return $s;
    }
}
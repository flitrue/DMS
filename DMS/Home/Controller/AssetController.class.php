<?php

namespace Home\Controller;
use Think\Controller;

class AssetController extends CommonController{

    public function depart(){

        //$arr = $this->getDepartPriceCounts();
        $arr = $this->getDepartCounts();

        $this->assign('arr',$arr);
        $this->display();

    }

    public function group(){
        $arr = $this->getgroupPriceCounts();
        $model = M("depart");
        $depart = $model->select();
        $this->assign("depart",$depart);
        $this->assign("arr",$arr);
        $this->display();
    }

    /**
     * 部门饼状图接口
     */
    public function pieDepartData(){

        echo json_encode($this->getDepartPriceCounts());
    }

    public function pieData(){
        $data = $this->getDepartPriceCounts();
        foreach ($data as $k => $v){
            $dat[] = $v['name'];
        }

        echo json_encode($dat);
    }

    /**
     * 小组饼状图接口
     */
    public function pieGroupData(){
        echo json_encode($this->getgroupPriceCounts());
    }

    /**
     * 获取部门资产的接口
     * @return array
     */
    public function getDepartPriceCounts(){
        $model1 = M('device');
        $model2 = M('depart');

        $depart = $model2->order("id asc")->select();

        $arr = array();
        foreach ($depart as $item => $value){
            $pricecounts[$item] = $model1->order("id")->where("depart=$item+1")->sum('price');
            if($pricecounts[$item] == NULL){
                $pricecounts[$item] = 0;
            }

            $arr[$item]['value'] = $pricecounts[$item];
            $arr[$item]['name'] = $value['name'];
        }
        return $arr;
    }

    /**
     * 获取部门设备数和价格的接口
     * @return array
     */
    public function getDepartCounts(){

        $model = M();
        $arr = $model->table("am_depart dp")
            ->field("sum(if(de.id is null,0,1)) count,dp.name,sum(if(de.price is null,0,de.price)) price")
            ->join("am_device de on dp.id=de.depart","left")
            ->group("dp.name")
            ->select();
        return $arr;
    }

    /**
     * 获取小组资产的接口
     * @return array
     */
    public function getgroupPriceCounts(){
        $depart = I("get.depart");

        $model1 = M();
        $model2 = M('group');

        $result = $model2->select();
        $arr = array();

        foreach ($result as $item => $value){
            $id = $value["id"];

            $sql = <<<EOF
        SELECT SUM(price) sumprice FROM am_depart dp,am_group gr,am_device dv
        WHERE dv.depart = dp.id AND dv.group = gr.id AND dv.depart=$depart AND dv.group=$id
EOF;
            $res = $model1->query($sql);

            if($res[0]['sumprice'] == NULL){
                $res[0]['sumprice'] = 0;
            }

            $arr[$item]['value'] = $res[0]['sumprice'];
            $arr[$item]['name'] = $value['name'];
        }

        return $arr;
    }



}
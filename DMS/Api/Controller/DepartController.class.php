<?php

namespace Api\Controller;
use Think\Controller;

class DepartController extends Controller{
    public function info(){
        $model = M("depart");
        $arr = $model->select();
        $json = success($arr, "获取部门类别成功");
        echo $json;
    }
}

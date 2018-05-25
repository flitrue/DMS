<?php

namespace Home\Controller;
use Think\Controller;

class LogController extends CommonController{
    public function look(){
        $model = M('log');
        $arr = $model->field("id,time,info,operator")->select();

        $this->assign('arr',$arr);
        $this->display();
    }

    public function add(){
        $this->display();
    }

    public function edit(){
        $this->display();
    }
}
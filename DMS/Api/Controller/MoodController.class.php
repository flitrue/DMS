<?php

namespace Api\Controller;
use Think\Controller;

class MoodController extends CommonController{
    public function add(){
        $context = I("context");
        if($context){
            $model = M("mood");

            $data["text"] = $context;
            $data["date"] = date("Y-m-d");
            $data["uid"] = session("uid");
            $arr = $model->data($data)->add();
            $json = success([], "心情记录成功！");
            echo $json;
        }else{
            $json = failure([], "心情记录失败！");
            echo $json;
        }
    }

    public function info(){
        $model = M('mood');
        $id = session("uid");
        $arr = $model->where("uid=".$id)->select();
        if($arr){
            $json = success($arr, "心情获取成功！");
            echo $json;
        }else{
            $json = failure([], "心情获取失败！");
            echo $json;
        }
    }
}

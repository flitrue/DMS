<?php

namespace Api\Controller;
use Think\Controller;

class ApplyController extends CommonController
{

    public function add()
    {
        $data["uid"] = session("uid");
        $data['category'] = implode("/",I("category"));
        $data['desc'] = I("desc");
        $data['time'] = date("Y-m-d H:i:s");
        $model = M("apply");
        $arr = $model->data($data)->add();
        if ($arr) {
            $json = success($arr, "申请成功");
        } else {
            $json = failure([], "申请失败");
        }

        echo $json;
    }

    public function info()
    {
        $uid = session("uid");
        $model = M("apply");

        $arr = $model->where("uid=".$uid)->select();
        $json = success($arr, "我的申请获取成功");
        echo $json;
    }

    public function infoa(){
        $model = M();
        $arr = $model->table("am_apply as a")->field("a.id id,b.name name,a.time time,a.desc,a.status status,a.category,b.id uid")->join("am_user as b on b.id=a.uid")->select();
        echo success($arr? $arr: [], "获取设备申请成功");
    }

    // 改变设备申请的状态
    public function change(){
        $id = I("id");
        $data["status"] = I("status");
        $model = M("apply");
        $res = $model->data($data)->where("id=".$id)->save();
        echo success($res, "申请状态改变成功！");
    }

    // 改变维修申请的状态
    public function changeRepair(){
        $id = I("id");
        $data["status"] = I("status");
        $model = M("repair");
        $res = $model->data($data)->where("id=".$id)->save();
        echo success($res, "维修状态改变成功！");
    }

    public function getRepair(){
        $model = M();
        $arr = $model->table("am_repair as a")->field("a.id id,b.name name,a.time time,a.desc,a.status status,b.id uid")->join("am_user as b on b.id=a.uid")->select();
        echo success($arr? $arr: [], "获取维修申请成功");
    }

    // 添加维修申请
    public function repair(){
        $data["did"] = session("did");
        $data["uid"] = session("uid");
        $data['desc'] = I("desc");
        $data['time'] = date("Y-m-d H:i:s");
        $model = M("repair");
        $arr = $model->data($data)->add();
        if ($arr) {
            $json = success($arr, "维修申请成功");
        } else {
            $json = failure([], "维修申请失败");
        }

        echo $json;
    }

}
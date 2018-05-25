<?php

namespace Api\Controller;
use Think\Controller;

class ShareController extends CommonController{

    public function index(){
        $model = M();
        $arr2 = $model->table("am_article a")->field("a.id id,a.title,a.content,a.category,a.text,a.uid,a.time,a.good,a.look,a.comment,b.name username")->join("am_user b on a.uid=b.id")->where("share=1")->select();
        $arr1 = $model->table("am_album a")->field("a.id id,a.name title,a.mes,a.photo,a.uid,a.createtime,a.good,a.look,a.good,a.comment,b.name username")->join("am_user b on a.uid=b.id")->where("share=1")->select();
        $data = array(
            "album"     => $arr1,
            "article"       =>  $arr2
        );
        echo success($data, "获取资源共享成功！");
    }

    public function info(){
        $id = session("uid");
        $model = M();
        $arr2 = $model->table("am_article a")->field("a.id id,a.title,a.content,a.category,a.text,a.uid,a.time,a.good,a.look,a.comment,b.name username")->join("am_user b on a.uid=b.id")->where("share=1 and uid=".$id)->select();
        $arr1 = $model->table("am_album a")->field("a.id id,a.name title,a.mes,a.photo,a.uid,a.createtime,a.good,a.look,a.good,a.comment,b.name username")->join("am_user b on a.uid=b.id")->where("share=1 and uid=".$id)->select();

        $data = array(
            "album"     => $arr1,
            "article"       =>  $arr2
        );
        echo success($data, "获取我的分享成功！");
    }

    public function share(){
        $category = I("category");
        $id = I("id");
        if($category == "article"){
            $model = M("article");
        }elseif($category == "album"){
            $model = M("album");
        }else{
            echo error([], "出错了");exit;
        }
        $data["share"] = 1;
        $res = $model->data($data)->where("id=".$id)->save();
        if($res){
            echo success([], "分享成功");
        }else{
            echo failure([], "分享失败");
        }
    }

    public function cancelShare(){
        $category = I("category");
        $id = I("id");
        if($category == "article"){
            $model = M("article");
        }elseif($category == "album"){
            $model = M("album");
        }else{
            echo error([], "出错了");exit;
        }
        $data["share"] = 0;
        $res = $model->data($data)->where("id=".$id)->save();
        if($res){
            echo success([], "取消分享成功");
        }else{
            echo failure([], "取消分享失败");
        }
    }
}
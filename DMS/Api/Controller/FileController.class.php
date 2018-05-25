<?php

namespace Api\Controller;
use Think\Controller;

// 该类为 post 方式提交大量数据

class FileController extends Controller
{
    public function _initialize()
    {
        header('Access-Control-Allow-Origin: *');     //设置允许跨域请求的地址
        header("Access-Control-Allow-Headers:X-Requested-With");      // 设置跨域请求只允许ajax提交
    }

    public function add()
    {
        $category = I("category");
        $model0 = M("documentcategory");
        $category = $model0->field("id")->where("name='".$category."'")->select();
        $data = array(
            "title"     => I("title"),
            "time"      => date("Y-m-d H:i:s"),
            "category"  => $category[0]["id"],
            "content"   => I("content"),
            "text"      =>  I("text"),
            "uid" => I("uid")
        );
        $model = M("article");

        $res = $model->data($data)->add();
        if ($res) {
            $data["id"] = $res;
            echo successp($data, "文档添加成功");
        } else {
            echo failurep([], "文档添加失败");
        }
    }

    public function edit()
    {
        $id = I("id");
        $category = I("category");
        $model0 = M("documentcategory");
        $category = $model0->field("id")->where("name='".$category."'")->select();
        $model = M("article");
        $model->category = $category[0]['id'];
        $model->title = I("title");
        $model->content = I("content");
        $model->text = I("text");
        $model->time = date("Y-m-d H:i:s");
        $model->uid = I("uid");
        $res = $model->where('id='.$id)->save();
        if ($res) {
            echo successp($category, "文档编辑成功");
        } else {
            echo failurep([], "文档编辑失败");
        }
    }

    // 添加设备
    public function addDevice(){
        $model = M("device");
        $category = I("category");
        $category = implode("/",$category);
        $tags = I("tags");
        $tag = "";
        for($i=0;$i<count($tags);$i++){
            if($i == count($tags) -1){
                $tag .= $tags[$i]["name"];
            }else{
                $tag .= $tags[$i]["name"] ."/";
            }
        }
        $data = array(
            "code"      =>      I("code"),
            "brand"     =>      I("brand"),
            "version"   =>      I("version"),
            "category"  =>      $category,
            "tags"      =>      $tag,
            "price"     =>      I("price"),
            //"num"       =>      I("num"), //设备个数暂不提供
            "buytime"   =>      I("buytime"),
            "buyway"   =>      I("buyway"),
            "remarks"    =>      I("remarks"),
        );

        $id = $model->data($data)->add();
        if($id){
            echo successp($id, "设备添加成功！");
        }else{
            echo failurep([], "设备添加失败！");
        }
    }

    // 编辑设备
    public function editDevice(){
        $model = M("device");
        $category = I("category");
        $category = implode("/",$category);
        $tags = I("tags");
        $tag = "";
        for($i=0;$i<count($tags);$i++){
            if($i == count($tags) -1){
                $tag .= $tags[$i]["name"];
            }else{
                $tag .= $tags[$i]["name"] ."/";
            }
        }
        $did = I("did");
        $model->code = I("code");
        $model->brand = I("brand");
        $model->version = I("version");
        $model->category = $category;
        $model->tags = $tag;
        $model->version = I("version");
        $model->price = I("price");
        $model->buytime = I("buytime");
        $model->buyway = I("buyway");
        $model->remarks = I("remarks");

        $id = $model->where("id=".$did)->save();
        if($id){
            echo successp($id, "设备编辑成功！");
        }else{
            echo failurep([], "设备编辑失败！");
        }
    }
}
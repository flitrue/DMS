<?php
namespace Api\Controller;

use Think\Controller;

class ArticleController extends CommonController
{
    public function info()
    {
        $model = M("article");
        $uid = session("uid");
        $pagenow = I('page')?I('page'):1 ;
        $count = $model->count() - 1;
        $unit = I("unit")? I("unit"): 20;// 一页的个数
        //$num = $count/$unit < 1? 1: ceil($count/$unit); //总共几页
        $data = $model->page($pagenow, $unit)->where("uid=" . $uid)->order('time desc')->select();

        $model0 = M("documentcategory");
        $category = $model0->select();
        for($i=0;$i<count($data);$i++){

            for($j=0;$j<count($category);$j++){
                if($data[$i]["category"] == $category[$j]["id"]){
                    $data[$i]["category"] = $category[$j]["name"];
                }
                $data[$i]["text"] = html_entity_decode($data[$i]["text"]);
            }
        }

        $data = array(
            "datas"         => $data? $data: [],
            "pagenow"       => $pagenow,
            "total"         => $count
        );
        echo success($data, "文档获取成功");
    }

    public function detail()
    {
        $id = I("id");
        $model = M("article");
        $data['look'] = array('exp','look+1');

        $model->data($data)->where("id=" . $id)->save();
        $data = $model->where("id=" . $id)->select();
        if ($data) {
            $model0 = M("documentcategory");
            $category = $model0->field("name")->where("id=".$data[0]["category"])->select();
            $data[0]["category"] = $category[0]["name"];
            $uid = $data[0]["uid"];
            $model1 = M("user");
            $name = $model1->field("name")->where("id=" . $uid)->select();
            $data[0]["name"] = $name[0]["name"];
            $data[0]["content"] = html_entity_decode($data[0]["content"]);
            echo success($data[0], "文档获取成功");
        } else {
            echo failure([], "无此文档");
        }
    }

    public function del()
    {
        $id = I("id");
        $model = M("article");
        $res = $model->delete($id);
        if ($res) {
            echo success($id, "文档删除成功");
        } else {
            echo failure([], "文档删除失败");
        }
    }

    public function deletemulti()
    {
        $id = $_POST;
        $datanum = array_values($id);
        $data = implode(',', $datanum);
        $model = M('article');
        $res = $model->delete($data);
        if ($res) {
            echo success($data, "文档删除成功");
        } else {
            echo failure([], "文档删除失败");
        }
    }

}

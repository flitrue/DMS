<?php

namespace Api\Controller;
use Think\Controller;

// 该类为 post 方式提交大量数据

class ChartsController extends Controller
{
    // 部门资产额统计
    public function assetsCount(){
        $model = M();
        $sql = <<<EOF
    select a.id,a.name,sum(if(d.price is null,0,d.price)) as count from am_depart as a left join am_user as b on a.id=b.depart left join 
    am_transfer as c on c.user=b.id left join am_device as d on d.id=c.did group by a.id
EOF;
        $arr = $model->query($sql);
        echo success($arr, "获取部门资产额统计成功");

    }

    // 部门文档数统计
    public function articleCount(){
        $model = M();
        $sql = <<<EOF
    select a.id,a.name,sum(if(c.title is null,0,1)) as count from am_depart as a left join am_user as b on a.id=b.depart 
    left join am_article as c on c.uid=b.id group by a.id
EOF;
        $arr = $model->query($sql);
        echo success($arr, "获取部门文档统计成功");

    }

    public function sexScale(){
        $model = M("user");
        $arr1  = $model->field("count(sex) count")->where("id>1 and sex='男'")->select();
        $arr2  = $model->field("count(sex) count")->where("id>1 and sex='女'")->select();
        $data = array(
            "male"  => $arr1[0]["count"],
            "female"  => $arr2[0]["count"]
        );
        echo success($data, "男女比例获取成功！");
    }
}
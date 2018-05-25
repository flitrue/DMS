<?php

namespace Api\Controller;
use Think\Controller;

class HomeController extends CommonController
{
    public function total(){
        $uid = session("uid");

        $album = M("album");
        $article = M("article");
        if($uid == 1){
            $transfer = M("device");
            $d =$transfer->count();
        }else{
            $transfer = M("transfer");
            $d =$transfer->where("user=".$uid)->count();
        }
        $ar =$article->where("uid=".$uid)->count();
        $arc =$article->where("share=1 and uid=".$uid)->count();
        $a =$album->table("am_album a,am_photo b")->where("a.id=b.aid and uid=".$uid)->count();
        $ac =$album->where("share=1 and uid=".$uid)->count();
        $s = $arc + $ac;

        $arr = array(
            "device"    =>  $d,
            "photo"    =>  $a,
            "share"    =>  $s,
            "article"    =>  $ar
        );

        echo success($arr, "统计数success");

    }

}
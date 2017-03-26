<?php

namespace Home\Controller;
use Think\Controller;

class TestController extends Controller {
    public function index(){
        dump($_SERVER);
        $this->display();
    }

    public function upload(){
        $upload = new \Think\Upload();//  实例化上传类
        $upload->maxSize = 50000 ;//  设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');//  设置附件上传类型
        $upload->rootPath = 'Public/Uploads/';
        $upload->savePath = ''; //  设置附件上传目录
        //  上传文件
        $info = $upload->upload();
//        var_dump($upload);
        if(!$info) {
            //  上传错误提示错误信息
            $this->error($upload->getError());
        }else{
            //  上传成功
            $this->success(' 上传成功！ ');
        }
    }

    public function test(){
        exec("/usr/local/fastphp/bin/php ./test.php");
    }
}
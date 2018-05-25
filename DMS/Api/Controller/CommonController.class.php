<?php

namespace Api\Controller;
use Think\Controller;
class CommonController extends Controller
{
    public function _initialize()
    {
        header('Access-Control-Allow-Origin: *');     //设置允许跨域请求的地址
        header("Access-Control-Allow-Headers:X-Requested-With");      // 设置跨域请求只允许ajax提交
        if(session("uid") == null || session("email") == null){
            $data = [
                'code'      => 3,
                'msg'       => "您离开太久，请重新登录！",
                'data'      => [],
            ];
            //echo json_encode($data);
            //exit;
        }
    }

    //空控制器 空操作 空方法
    public function _empty(){
        redirect(U("index/error_404"));
    }

}

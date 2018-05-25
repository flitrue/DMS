<?php
namespace Home\Controller;
use Think\Controller;
class CommonController extends Controller {
    public function _initialize(){
        //判断用户是否已经登录
        if(session('logintime')+7000 < time()){
            cookie('dms_email',null);
            session('uid',null);
            session('power',null);
            $index = U("login/login");
            echo "<script>window.location.href='$index'</script>";
            exit();
        }

        if (!cookie('dms_email')) {

            $this->redirect('login/login');
        }

        $late = M("lateviewuser");
        $time = date("Y-m-d");
        $map['time'] = array("like",array($time."%"));
        $id = session("uid");
        $res = $late
            ->where($map)
            ->where("uid=$id")
            ->select();
        $ip = $_SERVER['REMOTE_ADDR'];
        $brower = checkBrower();
        $data['time'] = date("Y-m-d H:i:s");
        $data['ip'] = $ip;
        $data['brower'] = $brower;
        $time = date("Y-m-d");
        if($res){
            $map['time'] = array("like",$time."%");
            $late->where("uid=$id")->where($map)->save($data);
        }else{
            $data['uid'] = $id;
            $late->add($data);
        }

        define("EMAIL",cookie("dms_email"));
        define("AVATAR",cookie('dms_avatar'));
        define("USERNAME",cookie("dms_name"));
        //$this->redirect('login/login');
    }

    /**
     * 检查用户权限
     * @return bool
     */
    public function checkpower(){
        $model = M("user");
        $email = EMAIL;
        $power = $model->field("power")->where("email='$email'")->select();
        if($power[0]['power'] == 1 ){
            return true;
        }else{
            return false;
        }
    }


    //空控制器 空操作 空方法
    public function _empty(){
        redirect(U("index/error_404"));
    }

}
<?php

namespace Home\Controller;
use Think\Controller;

class LoginController extends Controller{

    public function login(){
        if (cookie('dms_email')) {
            $this->redirect('/');
        }
        $model = M("loginbg");
        $model4 = M('domain');
        $loginbg = $model->select();
        $domain = $model4->select();
        $this->assign("loginbg", IMAGE_UPLOADURL.$loginbg[0]['url']);
        $this->assign("domain", $domain);

        $this->display();
    }

    /**
     * 加载验证码
     */
    public function loadCode(){
		ob_clean();
        $config = array(
            'length'        =>      4,
            'expire'        =>      40,
            'fontSize'      =>      30,
            'useZh'         =>      true,
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    function check_verify(){
       $yanzhengma = I("post.code");
        $verify = new \Think\Verify();
        $bool = $verify->check($yanzhengma);

        if(!$bool){
            $json = array(
                "valid" => false
            );

        }else{
            $json = array(
                "valid" => true
            );
        }
        echo json_encode($json);
    }

    public function sendmail(){
        $name = I('post.email');
        $domain = I("post.domain");
        $to = $name."@".$domain;
        $model = M("user");
        $id = $model->field("id")->where("email='$to'")->select();
        if(!$id){
            $json = array(
                "code"  =>  500,
                "msg"   =>  "邮箱不存在"
            );
            echo json_encode($json);
            exit;
        }
        $title = '您的登录密钥';
        $key = loginKey();
        $password = md5($key);
        $data['password'] = $password;
        $model->where("email='$to'")->save($data);

        $content = "欢迎登录沃民设备管理系统，您的密钥是$key,请妥善保管。";
        $res = sendMail($to, $title, $content);
        if($res){
            $json = array(
                "code"  =>  200,
                "msg"   =>  "邮件成功"
            );
        }else{
            $json = array(
                "code"  =>  404,
                "msg"   =>  "邮件失败",
                "error" =>  "获取密钥时，发送邮件失败"
            );
            $log = json_encode($json);
            sendMail(LOG_MAIL,$to."--获取密钥失败",$log);
        }
        echo json_encode($json);
    }

    /**
     * 登录时验证
     * 检查员工表中邮箱是否存在
     */
    public function checkemail(){
        $email = I("post.email");
        $model = M("user");
        $condition['email'] = $email;
        $condition['phone'] = $email;
        $condition['qq'] = $email;
        $condition['_logic'] = 'OR';

        $user = $model->field("id")->where($condition)->select();

        if($user){
            $json = array(
                "valid" => true
            );
        }else{

            $json = array(
                "valid" => false
            );
        }
        echo json_encode($json);
    }

    /**
     * 发送邮件时验证
     * 检查员工表中邮箱是否存在
     */
    public function emailcheck(){
        $email = I("post.email");
        $model = M("user");
        $condition['email'] = array("like", array($email."@%"));

        $user = $model->field("id")->where($condition)->select();

        if(!$user){
            $json = array(
                "valid" => false
            );// 无效，X

        }else{
            $json = array(
                "valid" => true
            );// 有效
        }
        echo json_encode($json);
    }

    public function checklogin(){
        $email = I('post.email');
        $key = I('post.password');
        $code = I('post.code');
        $model = M('user');
        session_start();
        $condition['email'] = $email;
        $condition['phone'] = $email;
        $condition['qq'] = $email;
        $condition['_logic'] = 'OR';
        $arr = $model->field('id,name,password,email,avatar,power,review')->where($condition)->select();

        if($arr[0]['review'] == 2){
            $json = array(
                "code"  =>  405,
                "msg"   =>  "你已离职"
            );
            echo json_encode($json);
            exit();
        }
        if(!isset($arr)){
           // $this->redirect("login/fail");
            $json = array(
                "code"  =>  404,
                "msg"   =>  "该账户不存在"
            );
            echo json_encode($json);
            exit();
        }
        /*if(session('verify_code') != md5($code)){
            $json = array(
                "code"  =>  405,
                "msg"   =>  "验证码不正确",
                "yanzhengma"    =>  $_SESSION
            );
            echo json_encode($json);
            exit();
        }*/

        if($arr[0]['password'] == md5($key)){
            //$url = $_SERVER['HTTP_REFERER'];
            //$login = _ROOT.U("login/login");
            //if($url == $login){
                $url = U('index/index');
            //}
            $json = array(
                "code"  =>  200,
                "msg"   =>  "验证成功",
                "url"   =>  $url
            );
            cookie('name',$arr[0]['name'],array('expire'=>3600,'prefix'=>'dms_'));
            cookie('email',$arr[0]['email'],array('expire'=>3600,'prefix'=>'dms_'));
            cookie('avatar',$arr[0]['avatar'],array('expire'=>3600,'prefix'=>'dms_'));
            if(!cookie("lastlogintime")){
                cookie("lastlogintime",date("Y-m-d H:i:s"));
            }
            session('logintime',time());
            session('power',$arr[0]['power']);
            session("uid",$arr[0]['id']);

        }else{
            $json = array(
                "code"  =>  500,
                "msg"   =>  "密码输入错误"
            );
        }
        echo json_encode($json);
    }

    /**
     * 退出系统
     */
    public function exitsys(){
        cookie(null,'dms_');
        $this->redirect('login/login');
    }

    public function fail(){
        $this->display();
    }

}

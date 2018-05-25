<?php

namespace Api\Controller;
use Think\Controller;

class LoginController extends Controller{


    public function _initialize()
    {
        header('Access-Control-Allow-Origin: *');     //设置允许跨域请求的地址
        header("Access-Control-Allow-Headers:X-Requested-With");      // 设置跨域请求只允许ajax提交
    }

    public function login()
    {
        $email = I("email");
        $password = I("password");
        if(!$email && !$password){
            $data = array(
                "post"  =>  $_POST,
                "email" =>$email
            );
            echo error($data, "缺少email和password");
            exit;
        }
        $model = M('user');
        $condition['email'] = $email;
        $condition['phone'] = $email;
        $condition['_logic'] = 'OR';
        $arr = $model->field('id,name,password,email,power,review')->where($condition)->select();
        if($arr[0]['review'] == 2){
            echo failure([], "用户已离职");
            exit;
        }
        if(!isset($arr)){
            $data = array(
                "post"  =>  $_POST,
                "email" =>$email
            );
            echo failure($data, "用户不存在");
            exit;
        }
        if($arr[0]['password'] == md5($password)){
            unset($arr[0]["password"]);
            session("uid",$arr[0]['id']);
            session("email", $arr[0]["email"]);
            echo success($arr[0], "登录成功");
        }else{
            echo failure([], "账号或密码输入错误");
        }
    }

    public function logout()
    {
        session("email", null);
        session("uid", null);
        echo success([], "用户退出成功");
    }

    public function register()
    {
        $model = M('user');
        $data["name"] = I("name");
        $data["email"] = I("email");
        $password = loginKey();
        $data["password"] = md5($password);
        $data["sex"] = I("sex");
        $data["brith"] = I("brith");
        $data["entrytime"] = date("Y-m-d");
        $data["depart"] = I("depart");
        $data["position"] = I("position");
        $depart = $data["depart"];
        $position = $data["position"];
        $model1 = M("depart");
        $depart = $model1->field("name")->where("id=".$depart)->select();
        $depart = $depart[0]['name'];

        if(I("phone")){
            $data["phone"] = I("phone");
        }
        $id = $model->data($data)->add();

        $to = trim($data['email']);
        $title = "恭喜您注册成功-".L('APP_NAME');

        $content = $data["name"].",您好！<br>    欢迎使用".L("APP_NAME").",您的初始登录密码为:".$password.",请尽快登录验证, 登录成功以后请修改密码。<br>
		<a href='https://mis.flitrue.com' style='padding: 50px 50%;background-color: #6bc5a4;' target='_black'>点击登录</a>";

        $username = $data['name'];

        //style='border: 1px solid;border-collapse: collapse
        $html = "<table border='1' style='border-collapse: collapse'>
<tr><th>姓名</th><th>邮箱</th><th>部门</th><th>职位</th></tr>
<tr><td>$username</td><td>$to</td><td>$depart</td><td>$position</td></tr>
</table>";
        $conent1 = "有新员工注册了".L('APP_NAME').",请尽快审核<br>".$html;
        $title1 = "新员工注册提醒";
        $admin = $model->field("email")->where("power=1")->select();
        $res = sendMail($to, $title, $content);
        sendMail($admin[0]['email'], $title1, $conent1);

        if($res){
            $json = successp($data, "注册成功！");
        }else{
            $json = failurep([], "失败了，请重试！");
        }
        echo $json;
    }

    public function sendMail(){
        /*$bool = $this->emailcheck();
        if($bool){
            $data = [];
            $json = failure($data, "该邮箱已注册");
            echo $json;exit;
        }*/
        $code = loginKey();
        $to = I("email");
        if(!$to){
            $data = [];
            $json = error($data, "请输入邮箱");
            echo $json;exit;
        }
        $title = "验证码";
        $content = "您的验证码是：".$code;
        $res = sendMail($to, $title, $content);
        if($res){
            $data = [];
            session("code", $code);
            $json = success($data, "验证码发送成功");
        }else{
            $data = [];
            $json = failure($data, "验证码发送失败");
        }
        echo $json;
    }

    public function reset(){
        $code = I("code");
        $email = I("email");
        if($code != session("code")){
            echo failure([], "验证码错误");exit;
        }
        $model = M("user");
        $arr = $model->field("id,email")->where("email='".$email."'")->select();
        if($arr){
            $newpwd = loginKey();
            $data['password'] = md5($newpwd);
            $model->data($data)->where("id=".$arr[0]['id'])->save();
            $title = "重置密码";
            $content = "您的新密码是：".$newpwd;
            $res = sendMail($email, $title, $content);
            echo success([], "密码重置成功！");
        }else{
            echo failure([], "该邮箱不存在！");
        }
    }


    public function step1R(){
        $code = I("code");
        $email = I("email");

        $data = [];
        if($code != session("code")){
            echo failure($data, "验证码输入错误");exit;
        }
        $model = M("user");
        $arr = $model->field("id")->where("email='".$email."'")->select();
        if($arr){
            echo failure([], "邮箱已存在");
        }else{
            echo success([], "验证码和邮箱都正确");
        }
    }


    /**
     * 发送邮件时验证
     * 检查员工表中邮箱是否存在
     */
    public function emailcheck(){
        $email = I("email");
        $model = M("user");
        $condition['email'] = $email;

        $user = $model->field("id")->where($condition)->select();
        if($user){
            $bool = true;
        }else{
            $bool = false;
        }

        return $bool;
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
            'useZh'         =>      false,
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    function check_verify(){
        $code = I("request.code");
        $verify = new \Think\Verify();
        $bool = $verify->check($code);

        if(!$bool){
            $data = array("valid" => 0);
            $json = success($data, "验证码输入正确");

        }else{
            $data = array("valid" => 1);
            $json = success($data, "验证码输入错误");
        }
        echo $json;
    }

}
<?php

namespace Home\Controller;
use Think\Controller;

class RegisterController extends Controller
{
    public function register()
    {
        $model1 = M('category');
        $model2 = M('depart');
        $model3 = M('group');
        $model4 = M('domain');

        $category = $model1->select();
        $depart = $model2->select();
        $group = $model3->select();
        $domain = $model4->select();

        $this->assign('category',$category);
        $this->assign('depart',$depart);
        $this->assign('domain',$domain);
        $this->assign('group',$group);

        $this->display();
    }

    /**
     * 检查员工表中邮箱是否存在
     * 输出1 表示没有该邮箱
     */
    public function emailcheck(){
        $email = I("post.email");
        $model = M("user");
        $condition['email'] = array("like", array($email."@%"));

        $user = $model->field("id")->where($condition)->select();

        if($user){
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

    /**
     * 检测手机号是否存在
     */
    public function checkphone(){
        $phone = I("post.phone");
        $model = M("user");
        $user = $model->field("id")->where("phone='$phone'")->select();

        if($user){
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

    /**
     * 检测身份证号是否存在
     */
    public function checkidcard(){
        $idcard = I("post.idcard");
        $model = M("user");
        $user = $model->field("id")->where("idcard='$idcard'")->select();

        if($user){
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


    public function add_save(){
        $model = M('user');
	    $domain = $_POST['domain'];
        $arr = $model->create();

        $key = loginKey();
        $model->password = md5($key);
        $model->status = "审核中";
	    $model->email = $arr['email'].'@'.$domain;
        $id = $model->add();

        $to = trim($arr['email'])."@".$domain;
        $loginurl = _ROOT.U("login/login",array("email"=>$to,"key"=>$key));
        $title = "恭喜你注册成功-".L('APP_NAME');

        $content = "你注册的初始登录密码为:".$key.",请尽快登录验证, 登录成功以后请修改密码<br>
		<h3>点击下方链接登录:</h3><br>
		<a href='$loginurl'>$loginurl</a>";

        $username = $arr['name'];
        $useremail = $to;
        $userphone = $arr['phone'];
        $depart = $arr['depart'];
        $group = $arr['group'];
        //style='border: 1px solid;border-collapse: collapse
        $html = "<table border='1' style='border-collapse: collapse'>
<tr><th>姓名</th><th>邮箱</th><th>手机号</th><th>部门</th><th>小组</th></tr>
<tr><td>$username</td><td>$useremail</td><td>$userphone</td><td>$depart</td><td>$group</td></tr>
</table>";
        $url = _ROOT.U('staff/edit',"uid=$id");
        $conent1 = "有新员工注册了".L('APP_NAME').",请尽快审核"."<br>"."审核地址为:</br><a href='$url'>$url</a></br>".$html;
        $title1 = "新员工注册提醒";
        $admin = $model->field("email")->where("power=1")->select();
        $res = sendMail($to, $title, $content);
        for($i = 0; $i < count($admin); $i++){
            sendMail($admin[$i]['email'], $title1, $conent1);
        }

        if($res){
            $json = array(
                "code"  =>  200,
                "msg"   =>  "邮件发送成功"

            );
        }else{
            $json = array(
                "code"  =>  405,
                "msg"   =>  "邮件发送失败",

            );
        }
        echo json_encode($json);
    }

}

<?php

namespace Home\Controller;
use Think\Controller;

class StaffController extends CommonController{

    public function look(){
        $model = M('user');
        $pagenow = I('get.page')?I('get.page'):1 ;
        $email = EMAIL;
        $review = $model->field("review")->where("email='$email'")->select();
        if($review[0]['review']){
            $count = $model->count();
            $num = $count/10 < 1? 1: ceil($count/10);
            $arr = $model->field("id,name,depart,idcard,group,email,status,time,code")->page($pagenow, 10)->select();
        }else{
            $count = $model->where("power=0 and email='$email'")->count();
            $num = $count/10 < 1? 1: ceil($count/10);
            $arr = $model->field("id,name,depart,idcard,group,email,status,time,code")->where("power=0 and email='$email'")->page($pagenow, 10)->select();
        }

        $prepage = $pagenow-1;
        $nextpage = $pagenow+1;


        $people_chart_pie = $this->people_chart_pie();
        $people_chart_pie_category = $this->people_chart_pie_category();
        $people_chart_bar_category = $this->people_chart_bar_category();
        $people_chart_bar = $this->people_chart_bar();
        $this->assign('pagenow',$pagenow);
        $this->assign("prepage",$prepage);
        $this->assign("nextpage",$nextpage);

        $this->assign('num',$num);// 页数
        $this->assign('arr',$arr);

        $this->assign('people_chart_pie',$people_chart_pie);
        $this->assign('people_chart_pie_category',$people_chart_pie_category);
        $this->assign('people_chart_bar',$people_chart_bar);
        $this->assign('people_chart_bar_category',$people_chart_bar_category);
        $this->assign('count',$count);
        $this->display();
    }

    public function people_chart_pie(){
        $model = M('user');
        $people = $model->field("count(*) as value,status name")->group("status")->select();

        return json_encode($people);
    }

    public function people_chart_pie_category(){
        $model = M('user');
        $people = $model->field("status")->group("status")->select();

        foreach($people as $value){
            $people_ca[] = $value['status'];
        }

        return  json_encode($people_ca);
    }

    public function people_chart_bar_category(){
        $depart = A('index');
        $arr = $depart->getDepart();
        return $arr;
    }

    public function people_chart_bar(){
        $model = M();

        $sql = "
        select sum(if(us.id is null,0,1)) count
        from am_depart de left join am_user us
        on us.depart=de.name
        group by de.id";

        $arr = $model->query($sql);
        $arr1 = [];
        for($i=0;$i<count($arr);$i++){
            $arr1[$i] = $arr[$i]['count'];
        }
        return json_encode($arr1);
    }


    public function add(){
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
        $this->assign('group',$group);
        $this->assign('domain',$domain);

        $this->display();
    }

    public function add_save(){
        $model = M('user');
        $domain = $_POST['domain'];
        $arr = $model->create();
        if(session("userbigavatar")){
            $model->big_avatar = session("userbigavatar");
        }

        if(session("usersmallavatar")){
            $model->avatar = session("usersmallavatar");
        }
        $key = loginKey();
        $model->password = md5($key);
        $model->email = $arr['email'].'@'.$domain;
        $id = $model->add();
        $to = trim($arr['email'])."@".$domain;

        $key = loginKey();
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

        $html = "<table border='1' style='border-collapse: collapse'>
<tr><th>姓名</th><th>邮箱</th><th>手机号</th><th>部门</th><th>小组</th></tr>
<tr><td>$username</td><td>$useremail</td><td>$userphone</td><td>$depart</td><td>$group</td></tr>
</table>";

        $url = _ROOT.U('staff/edit',"uid=$id");
        $conent1 = "有新员工注册了".L('APP_NAME').",请尽快审核"."<br>"."审核地址为:</br>$url</br>".$html;
        $title1 = "新员工注册提醒";
        $admin = $model->field("email")->where("power=1")->select();
        $res = sendMail($to, $title, $content);
        for($i = 0; $i < count($admin); $i++){
            sendMail($admin[$i]['email'], $title1, $conent1);
        }

        if($res){
            echo 1;
        }else{
            echo 0;
        }
        session("userbigavatar",null);
        session("usersmallavatar",null);
    }

    /**
     * 划过鼠标显示小组、部门的编号
     * @return string
     */
    public function lookCode(){
        $model1 = M("depart");
        $model2 = M("group");
        $depart = $model1->field("name,code")->select();
        $group = $model2->field("name,code")->select();
        $html = "<div><table style='float: left;' class='table table-bordered'><th colspan='2'>部门</th>";
        foreach($depart as $key => $value){

            $html .= "<tr>";
            $html .= "<td>{$value['name']}</td> <td>{$value['code']}</td>";
            $html .= "</tr>";
        }

        $html .= "</table>";
        $html .= "<table class='table table-bordered'><th colspan='2'>小组</th>";
        foreach($group as $key => $value){
            $html .= "<tr>";
            $html .= "<td>{$value['name']}</td> <td>{$value['code']}</td>";
            $html .= "</tr>";
        }

        $html .= "</table></div>";
        return $html;
    }

    /**
     * 编辑员工信息
     */
    public function edit(){
        $model1 = M('category');
        $model2 = M('depart');
        $model3 = M('group');

        $category = $model1->select();
        $depart = $model2->select();
        $group = $model3->select();

        $this->assign('category',$category);
        $this->assign('depart',$depart);
        $this->assign('group',$group);

        $uid = I('uid');
        $model = M('user');

        $arr = $model->where("id=$uid")->select();

        $this->assign('arr', $arr);
        $this->display();
    }

    /**
     * 检测邮箱是否存在
     */
    public function checkemail(){
        $email = I("post.email");
        $model = M("user");
        $user = $model->field("id")->where("email='$email'")->select();

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

    public function edit_save(){

        $uid = I('get.uid');
        $model = M('user');
        $arr = $model->create();

        if(session("userbigavatar")){
            $model->big_avatar = session("userbigavatar");
        }

        if(session("usersmallavatar")){
            $model->avatar = session("usersmallavatar");
        }
        switch($arr['status']){
            case '在职':
                $model->review = 1;
                $to = $model->field("email")->where("id=$uid")->select();
                $title = "你的员工状态已改变——".L("APP_NAME");
                $url = _ROOT.U('staff/detail',array("uid"=>$uid));
                $content = "你注册的".L("APP_NAME")."账号，员工状态为".$arr['status']."，快去查看吧！<br>"."<a href='$url'>$url</a>";
                sendMail($to[0]['email'],$title,$content);
                break;
            case '离职':
                $model->review = 2;
                $to = $model->field("email")->where("id=$uid")->select();
                $title = "你的员工状态已改变——".L("APP_NAME");
                $url = _ROOT.U('staff/detail',array("uid"=>$uid));
                $content = "你注册的".L("APP_NAME")."账号，员工状态为".$arr['status']."，快去查看吧！<br>"."<a href='$url'>$url</a>";
                sendMail($to[0]['email'],$title,$content);
                break;
            case '审核中':
                $model->review = 0;
                $to = $model->field("email")->where("id=$uid")->select();
                $title = "你的员工状态已改变——".L("APP_NAME");
                $url = _ROOT.U('staff/detail',array("uid"=>$uid));
                $content = "你注册的".L("APP_NAME")."账号，员工状态为".$arr['status']."，快去查看吧！<br>"."<a href='$url'>$url</a>";
                sendMail($to[0]['email'],$title,$content);
                break;
            default:
                break;
        }


        session("userbigavatar",null);
        session("usersmallavatar",null);

        $res = $model->where('id='.$uid)->save();
        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }


    /**
     * 删除员工并删除员工头像图片
     */
    public function del(){
        $id = I('get.uid');
        $model = M('user');

        $avatar = $model->field("big_avatar,avatar")->where("id=$id")->select();
        unlink(SMALL_AVATARSURL.$avatar[0]["avatar"]);
        unlink(BIG_AVATARSURL.$avatar[0]["big_avatar"]);// todo 删除图片
        $res = $model->delete($id);

        if($res){
            $this->redirect("staff/look/");
        }else{
            $this->error("删除失败");
        }
    }

    public function deletemulti(){
        $id = $_POST;
        $data = array_values($id);
        $data = implode(',',$data);
        $model = M('user');

        $res = $model->delete($data);
        for($i=0; $i<count($data);$i++){
            $avatar = $model->field("big_avatar,avatar")->where("id=$data[$i]")->select();
            unlink(SMALL_AVATARSURL.$avatar[0]["avatar"]);
            unlink(BIG_AVATARSURL.$avatar[0]["big_avatar"]);// todo 删除图片
        }

        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }


    public function writeemail(){
        $uid = I("get.uid");
        $model = M('user');

        $email = $model->field("email")->where("id=$uid")->select();
        $this->assign("email",$email[0]['email']);
        $this->display('Index:writeemail');
    }

    public function sendtostaff(){
        $recipient = I("post.recipient");
        $subject = I("post.subject");
        $message = I("post.message");
        $res = sendMail($recipient, $subject, $message);
        if($res){
            $this->success("该员工已收到");
        }else{
            $this->error("哈哈，这个员工不受管束，拒绝了你的邮件，你可以考虑今晚让他加班");
        }
    }

    public function detail(){
        $uid = I("get.uid");

        $model = M("user");
        $arr = $model->where("id=$uid")->select();
        $sql = <<<EOF
        SELECT
        tr.id,de.id did,us.id uid,
        de.name devicename,de.version,de.code,de.tag,ca.name category,de.price,
        tr.status,de.keyinfo,de.remarks,dp.name departname,gr.name groupname,de.buyer,de.buytime buytime,de.usetime,
        us.name username,de.photo1,de.photo2,de.photo3
        FROM 
        am_device de,am_user us,am_transaction tr,am_category ca,am_depart dp,am_group gr
        WHERE
        tr.did = de.id 
        AND tr.uid = us.id
        AND ca.id = de.category
        AND dp.id = de.depart
        AND gr.id = de.group
				AND us.id = de.uid
        AND us.id = %d
EOF;
        $model1 = M();
        $arr1 = $model1->query($sql,$uid);
        $count = count($arr1);
        $this->assign("count",$count);
        $this->assign("arr",$arr);
        $this->assign("arr1",$arr1);
        $this->display();
    }

    public function saveimg(){
        $response = saveimg();
        session("userbigavatar",str_replace(_ROOT,"",$response['url']));
        print json_encode($response);
    }

    public function cropimg(){
        $response = cropimg();
        session("usersmallavatar", ltrim($response['url']),"/");
        print json_encode($response);
    }

}
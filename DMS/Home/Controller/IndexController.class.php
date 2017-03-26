<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends CommonController{

    public function index(){

        $model1 = M("");
        $memberlate = $model1
            ->table("am_lateviewuser lu")
            ->field("us.id id,us.name,us.avatar,lu.time")
            ->join("am_user us on lu.uid=us.id","LEFT")
            ->limit(10)
            ->order("lu.id desc")->select();
        $this->assign("memberlate",$memberlate);

        $devicelate = $model1
            ->table("am_device")
            ->field("id,name,buytime")
            ->limit(12)
            ->order("id desc")
            ->select();
        $this->assign("devicelate",$devicelate);


        $model = M("slide");
        $img = $model->select();
        $lastlogintime = cookie("lastlogintime");
        $userip = $_SERVER["REMOTE_ADDR"];
        $brower = checkBrower();
        if($lastlogintime){
            $this->assign("lastlogintime","您的IP是:<strong>$userip</strong>，
使用的浏览器是:<strong>{$brower}浏览器</strong>，上次的登录时间是:<strong>$lastlogintime</strong>");
        }
        $menbernum = $this->membernum();
        $depart = $this->getDepart();
        $this->assign("img",$img);
        $this->assign("menbernum",$menbernum);
        $this->assign("depart",$depart);

        $this->display();
    }

    /**
     * 登录成功以后显示的欢迎alert
     */
    public function del_cookie(){
        cookie("bool",true,array('prefix'=>'dms_'));
    }


    public function profile(){
        $model = M("user");
        $uid = session("uid");
        $arr = $model->where("id=$uid")->select();
        $aa = count($arr[0]);
        $bb = count(array_filter($arr[0]));
        $cc = floor($bb/$aa * 100);
        $this->assign("arr",$arr);
        $this->assign("progess",$cc);
        $this->display();
    }

    public function updateProfile(){
        $uid = I("get.uid");
        $upload = new \Think\Upload();//  实例化上传类
        $upload->maxSize = 500000 ;//  设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');//  设置附件上传类型

        $upload->rootPath = "./".BIG_AVATARSURL;
        $upload->savePath = ''; //  设置附件上传目录
        $upload->subName = "";
        //  上传文件
        $info = $upload->upload();
        $photo = $info['avatar']['savename'];
        $model = M("user");

        if($photo){
            $image = new \Think\Image();
            $image->open("./".BIG_AVATARSURL.$photo);
            $image->thumb(150, 150,\Think\Image::IMAGE_THUMB_CENTER)->save("./".SMALL_AVATARSURL.$photo);

            $photos = $model->field("big_avatar,avatar")->where("id=$uid")->select();
            unlink($photos[0]["big_avatar"]);
            unlink($photos[0]["avatar"]);
            $data['avatar'] = SMALL_AVATARSURL.$photo;
            $data['big_avatar'] = BIG_AVATARSURL.$photo;

        }

        $data['name'] = I("post.name");
        $data['sex'] = I("post.sex");
        $data['brith'] = I("post.brith");
        $data['phone'] = I("post.phone");
        $data['weixin'] = I("post.weixin");
        $data['qq'] = I("post.qq");
        $data['comment'] = I("post.comment");

        $res = $model->where("id=$uid")->save($data);
        if($res){
            $json = array("code" => 1);
            echo json_encode($json);
        }else{
            $json = array("code" => 0);
            echo json_encode($json);
        }
    }

    public function search(){
        $this->display();
    }


    /**
     * 每個星期加入公司的人數
     * 2016-11-1 --2016-11-7
     * 星期一 星期二 星期三 星期四 星期五 星期六 星期日
     * return 8 5 2 9 6 3
     */
    public function joinPersonNumByWeek(){
        $model = M("user");
        for($i = 1; $i <= 50; $i++){
            $arr1 = json_decode($this->weekItem($i),true);
            $map['time'] = array("between",array($arr1[0],$arr1[6])) ;

            $arr[] = $model->where($map)->count();

        }
        echo json_encode($arr);

    }

    /**
     * 每個星期的日期項
     * 一周時間戳：3600*24*7
     */
    public function zhouyi($num = 1){
        $oneday = 3600*24; // 一天的時間戳

        $now = date("w", time()); // 今天是本週第幾天
        $time = time();
        $chazhi = ($num+$now-1)*$oneday;

        $benzhouyi = date("Y-m-d",$time - $chazhi); // 本周一的日期
        return $benzhouyi;
    }

    public function weekItem($num = 1) {

        $oneday = 3600*24; // 一天的時間戳
        $benzhouyi = $this->zhouyi($num);
        for($i = 0; $i < 7; $i++){
            $benzhou[] = date("Y-m-d", strtotime($benzhouyi)+$i*$oneday);
        }
        return json_encode($benzhou);
    }

    public function joinPersonNumByDay(){

    }

    public function error_404(){
        $this->display();
    }

    public function setting(){

        $model = M("loginbg");
        $loginbg = $model->select();
        $model1 = M();
        $model2 = M("user");
        $user = $model2->field("id,name,email")->where("review=1 and power=0")->select();
        $admin = $model2->field("id,name,email")->where("review=1 and power=1")->select();

        $sql = <<<EOF
select SUM(if(pa.id is null,0,1)) count,pac.* from am_patent pa 
RIGHT JOIN am_patentcategory pac on pa.category=pac.id group by  pac.`name`
EOF;
        $sql1 = <<<EOF
select SUM(if(de.id is null,0,1)) devicecount,
SUM(if(us.id is null,0,1)) membercount,
dp.* from am_depart dp 
LEFT JOIN am_user us 
on dp.name=us.depart
LEFT JOIN am_device de
on dp.id=de.depart
group by dp.`name`
EOF;
        $sql2 = <<<EOF
select SUM(if(de.id is null,0,1)) devicecount,
SUM(if(us.id is null,0,1)) membercount,
gr.* from am_group gr
LEFT JOIN am_user us 
on gr.name=us.group
LEFT JOIN am_device de
on gr.id=de.group
group by gr.`name`
EOF;

        $patent = $model1->query($sql);
        $depart = $model1->query($sql1);
        $group = $model1->query($sql2);
        $this->assign("category", $patent);
        $this->assign("depart", $depart);
        $this->assign("group", $group);
        $this->assign("loginbg", IMAGE_UPLOADURL.$loginbg[0]['url']);
        $this->assign("admin", $admin);
        $this->assign("user", $user);
        $this->display();
    }

    public function setting_save(){
        $model = M("loginbg");

        $upload = new \Think\Upload();
        $upload->maxSize = 5000000 ;//  设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');//  设置附件上传类型
        $upload->rootPath = ".".IMAGE_UPLOADURL;
        $upload->savePath = ''; //  设置附件上传目录
        $upload->subName = '';
        $info = $upload->upload();

        if(!$info){
            $json = array(
                "code"  =>  400,
                "msg"   =>  "图片没有上传"
            );
            echo json_encode($json);
            exit();
        }else{
            $url = $info['loginbg']['savename'];
            $data['url'] = $url;
            $res = $model->where("id=1")->save($data);
            if($res){
                $json = array(
                    "code"  =>  200,
                    "msg"   =>  "保存成功",
                    "url"   =>  IMAGE_UPLOADURL.$url
                );
            }else{
                $json = array(
                    "code"  =>  300,
                    "msg"   =>  "保存失败"
                );
            }
            echo json_encode($json);
        }

    }

    public function depart_save(){
        $model = M("depart");
        $depart = trim(I("post.depart"));

        $arr = $model->field()->where("name='$depart'")->select();
        if(!$arr){
            $data['name'] = $depart;
            $res = $model->add($data);
        }else{
            $res = false;
        }

        $url = U('index/depart_del');
        if($res){
            $sql = <<<EOF
select SUM(if(de.id is null,0,1)) devicecount,
SUM(if(us.id is null,0,1)) membercount,
dp.* 
from am_depart dp
LEFT JOIN am_user us
ON dp.name=us.depart 
LEFT JOIN am_device de
ON de.depart=dp.id
group by  dp.`name`
EOF;

            $res1 = $model->query($sql);
            $html = "<table class='table table-striped table-bordered table-hover'>";

            $html .= "<thead><tr><th>名称</th><th>员工数</th><th>设备数</th><th>操作</th></td></tr></thead><tbody>";
            foreach($res1 as $k => $v){
                $html .= "<tr>";
                $html .= "<td>{$v['name']}</td>";
                $html .= "<td>{$v['membercount']}</td>";
                $html .= "<td>{$v['devicecount']}</td>";
                $id = $v['id'];
                $html .= "<td>
                        <a href='$url&id=$id' class=\"btn btn-info btn-xs btn-danger bootbox-confirm\">
                            <i class=\"icon-trash bigger-120\"></i>
                        </a>
                    </td>";
                $html .= "</tr>";
            }

            $html .= "</tbody></table>";
            $json = array(
                "code"  =>  200,
                "msg"   =>  "添加成功",
                "html"  =>  $html
            );
        }else{
            $json = array(
                "code"  =>  300,
                "msg"   =>  "添加失败",
                "arr"   =>  $arr
            );
        }
        echo json_encode($json);
    }

    public function depart_del(){
        $id = I("get.id");
        $model = M("depart");
        $res = $model->delete($id);
        $this->redirect("index/setting");
    }

    public function group_save(){
        $model = M("group");
        $group = trim(I("post.group"));

        $arr = $model->field()->where("name='$group'")->select();
        if(!$arr){
            $data['name'] = $group;
            $res = $model->add($data);
        }else{
            $res = false;
        }

        $url = U('index/depart_del');
        if($res){
            $sql = <<<EOF
select SUM(if(de.id is null,0,1)) devicecount,
SUM(if(us.id is null,0,1)) membercount,
dp.* 
from am_group gr
LEFT JOIN am_user us
ON gr.name=us.group 
LEFT JOIN am_device de
ON de.depart=gr.id
group by  gr.`name`
EOF;

            $res1 = $model->query($sql);
            $html = "<table class='table table-striped table-bordered table-hover'>";

            $html .= "<thead><tr><th>名称</th><th>员工数</th><th>设备数</th><th>操作</th></td></tr></thead><tbody>";
            foreach($res1 as $k => $v){
                $html .= "<tr>";
                $html .= "<td>{$v['name']}</td>";
                $html .= "<td>{$v['membercount']}</td>";
                $html .= "<td>{$v['devicecount']}</td>";
                $id = $v['id'];
                $html .= "<td>
                        <a href='$url&id=$id' class=\"btn btn-info btn-xs btn-danger bootbox-confirm\">
                            <i class=\"icon-trash bigger-120\"></i>
                        </a>
                    </td>";
                $html .= "</tr>";
            }

            $html .= "</tbody></table>";
            $json = array(
                "code"  =>  200,
                "msg"   =>  "添加成功",
                "html"  =>  $html
            );
        }else{
            $json = array(
                "code"  =>  300,
                "msg"   =>  "添加失败",
                "arr"   =>  $arr
            );
        }
        echo json_encode($json);
    }

    public function group_del(){
        $id = I("get.id");
        $model = M("group");
        $res = $model->delete($id);
        $this->redirect("index/setting");
    }

    public function patent_save(){
        $model = M("patentcategory");
        $patent = trim(I("post.patent"));

        $arr = $model->field()->where("name='$patent'")->select();
        if(!$arr){
            $data['name'] = $patent;
            $res = $model->add($data);
        }else{
            $res = false;
        }

        $url = U('index/patent_del');
        if($res){
            $sql = <<<EOF
select SUM(if(pa.id is null,0,1)) count,pac.* 
from am_patent pa 
RIGHT JOIN am_patentcategory pac 
ON pa.category=pac.id group by  pac.`name`
EOF;

            $res1 = $model->query($sql);
            $html = "<table class='table table-striped table-bordered table-hover'>";

            $html .= "<thead><tr><th>名称</th><th>数量</th><th>操作</th></td></tr></thead><tbody>";
            foreach($res1 as $k => $v){
                $html .= "<tr>";
                $html .= "<td>{$v['name']}</td>";
                $html .= "<td>{$v['count']}</td>";
                $id = $v['id'];
                $html .= "<td>
                        <a href='$url&id=$id' class=\"btn btn-info btn-xs btn-danger bootbox-confirm\">
                            <i class=\"icon-trash bigger-120\"></i>
                        </a>
                    </td>";
                $html .= "</tr>";
            }

            $html .= "</tbody></table>";
            $json = array(
                "code"  =>  200,
                "msg"   =>  "添加成功",
                "html"  =>  $html
            );
        }else{
            $json = array(
                "code"  =>  300,
                "msg"   =>  "添加失败",
                "arr"   =>  $arr
            );
        }
        echo json_encode($json);
    }

    /**
     * 删除专利
     */
    public function patent_del(){
        $id = I("get.id");
        $model = M("patentcategory");
        $res = $model->delete($id);
        $this->redirect("index/setting");
    }

    public function slide_save(){
        $upload = new \Think\Upload();
        $upload->maxSize = 5000000;
        $upload->exts = array('jpg','gif','png','jpeg');
        $upload->rootPath = "./".IMAGE_UPLOADURL;
        $upload->savePath = "";
        $upload->subName = '';

        $info = $upload->upload();
        if($info){

            $model = M("slide");
            if($info['url1']['savename']){
                $photo1 = $info['url1']['savename'];
                $data['url1'] = $photo1;
            }
            if($info['url2']['savename']){
                $photo2 = $info['url2']['savename'];
                $data['url2'] = $photo2;
            }
            if($info['url3']['savename']){
                $photo3 = $info['url3']['savename'];
                $data['url3'] = $photo3;

            }

            $res = $model->where("id=1")->save($data);
            if($res){
                $json = array(
                    "code"  =>  200,
                    "msg"   =>  "添加成功"
                );
            }else{
                $json = array(
                    "code"  =>  404,
                    "msg"   =>  "添加失败"
                );
            }
            echo json_encode($json);

        }else{
            dump($upload->getError());
            die("上传失败");
        }
    }

    public function addadmin_save(){
        $model = M("user");
        $id = I("post.admin");
        $review = $model->field("power")->where("id=$id")->select();
        if($review[0]['power'] == '0'){
            $data['power'] = 1;
            $res = $model->where("id=$id")->save($data);
        }else{
            $res = false;
        }

        if($res){

            $res1 = $model->field("id,name,email")->where("power=1 and review=1")->select();
            $html = "<table class='table table-striped table-bordered table-hover'>";
            $url = U('index/admin_del');
            $url1 = U('staff/detail');
            $html .= "<thead><tr><th>姓名</th><th>邮箱</th><th>操作</th></td></tr></thead><tbody>";
            foreach($res1 as $k => $v){
                $html .= "<tr>";
                $html .= "<td><nobr>{$v['name']}</nobr></td>";
                $html .= "<td><nobr>{$v['email']}</nobr></td>";
                $id = $v['id'];
                $html .= "<td>
                        <nobr>
                            <a href='$url&id=$id' class='btn btn-info btn-xs btn-danger bootbox-confirm'>
                                <i class='icon-trash bigger-120'></i>
                            </a>
                            <a href='$url1&uid=$id' class='btn btn-xs btn-warning' title='查看详细信息'>
                                <i class='icon-eye-open bigger-120'></i>
                            </a>
                        </nobr>
                    </td>";
                $html .= "</tr>";
            }

            $html .= "</tbody></table>";
            $json = array(
                "code"  =>  200,
                "msg"   =>  "添加成功",
                "html"  =>  $html
            );
        }else{
            $json = array(
                "code"  =>  300,
                "msg"   =>  "添加失败"
            );
        }
        echo json_encode($json);
    }

    public function admin_del(){
        $id = I("get.id");
        $model = M('user');
        $data['power'] = 0;
        $res = $model->where("id=$id")->save($data);

        $this->redirect("index/setting#admin-box");
    }

    public function changepassword(){
        $id = I("get.id");
        $password = trim($_POST['password']);
        $repassword = trim($_POST['password']);

        if($password == $repassword){
            $passwordC = md5($password);
            $model = M("user");
            $data['password'] = $passwordC;
            $res = $model->where("id=$id")->save($data);
            if($res){
                $to = EMAIL;
                $title = C('PWD_TITLE');
                $content = L('APP_NAME').C('PWD_CONTENT1').$password.C('PWD_CONTENT2');
                sendMail($to,$title,$content);
                $json = array(
                    "code" => 200,
                    "msg"   =>  "密码修改成功"
                );
            }else{
                $json = array(
                    "code" => 400,
                    "msg"   =>  "数据库保存失败"
                );
            }
        }else{
            $json = array(
                "code" => 500,
                "msg"   =>  "两次密码不一致"
            );
        }
        echo json_encode($json);
    }

    public function membernum(){
        $model = M();
        $sql = "
        select sum(if(us.id is null,0,1)) count 
        from am_depart de left join am_user us
        on us.depart=de.name
        group by de.id
        ";

        $arr = $model->query($sql);
        $arr1 = [];
        for($i=0;$i<count($arr);$i++){
            $arr1[$i] = $arr[$i]['count'];
        }
        return json_encode($arr1);

    }

    public function getDepart(){
        $model = M("depart");
        $arr = $model
            ->field("name")
            ->select();
        $arr1 = [];
        for($i=0;$i<count($arr);$i++){
            $arr1[$i] = $arr[$i]['name'];
        }
        return json_encode($arr1);
    }
}

<?php

namespace Api\Controller;
use Think\Controller;

class UserController extends CommonController{

    public function modifyPwd(){
        $oldpwd = I("oldpwd");
        $newpwd = I("newpwd");
        $model = M("user");
        $condition["password"] = md5($oldpwd);
        $condition["email"] = session("email");
        $res = $model->field("id")->where($condition)->select();
        if($res){
            $model->password = md5($newpwd);
            $id = $model->where("id=".$res[0]['id'])->save();
            if($id){
                echo success([], "修改密码功");
            }else{
                echo failure([], "修改密码失败");
            }
        }else{
            echo failure([], "修改密失败");
        }
    }

    public function info()
    {
        $model = M("user");
        $model1 = M("depart");

        $condition['email'] = session("email");
        $arr = $model->where($condition)->select();
        if($arr){
            unset($arr[0]["password"]);
            $arr[0]['wordcloud'] = explode("/", $arr[0]['wordcloud']);
            $depart = $model1->select();
            for($i=0;$i<count($depart);$i++){
                if($depart[$i]['id'] == $arr[0]["depart"]){
                    $arr[0]['depart'] = $depart[$i]["name"];
                }
            }

            echo success($arr[0], "获取用户信息成功");
        }else{

            echo failure([], "获取用户信息失败");
        }
    }


    public function add(){
        $bool = $this->emailcheck();
        if($bool){
            $data = [];
            $json = failure($data, "该邮箱已注册");
            echo $json;exit;
        }

        $login = A('Login');
        $login->register();
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

    public function save(){
        $id = I("uid")? I("uid"): session("uid");
        $model = M("user");
        if(I("name")){
            $model->name = I("name");
        }
        else if(I("comment")){
            $model->comment = I("comment");
        }
        else if(I("brith")){
            $model->brith = I("brith");
        }
        else if(I("sex")){
            $model->sex = I("sex");
        }
        else if(I("phone")){
            $model->phone = I("phone");
        }else{
            echo success($id, "没有改变");exit;
        }
        $res = $model->where("id=".$id)->save();
        echo success([], "保存个人信息成功");
    }

    public function saveAvatar(){
        $upload = new \Think\Upload();//  实例化上传类
        $upload->maxSize = 5000000 ;//  设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');//  设置附件上传类型
        $upload->rootPath = ".".IMAGE_UPLOADURL;
        $upload->savePath = ''; //  设置附件上传目录
        $upload->subName = '';
        //  上传文件
        $info = $upload->upload();


        $url = _ROOT.IMAGE_UPLOADURL;
        $imgpath = $url . $info['img']['savename'];
        $uid = I("get.uid");
        $model = M("user");
        $model->avatar = $imgpath;
        $res = $model->where("id=".$uid)->save();
        $arr = array(
            "jsonData"      =>  $imgpath,
            "id"            =>  $uid,
            "field"         => $info['img']['savename']
        );

        echo json_encode($arr);
    }

    public function addWordCloud(){
        $uid = I("uid");
        $arr = I("wordcloud");
        $arr1 = [];
        for($i=0;$i<count($arr);$i++){
            array_push($arr1, $arr[$i]['name']);
        }
        $wordcloud = implode("/", $arr1);
        $model = M("user");
        $word = $model->field("wordcloud")->where("id=".$uid)->select();
        $model->wordcloud = trim($word[0]['wordcloud']."/".$wordcloud, "/");
        $res = $model->where("id=".$uid)->save();
        if($res){
            echo success([],"添加同事印象成功");
        }else{
            echo failure([], "添加同事印象失败");
        }
    }

    public function getWordCloud(){
        $uid = I("uid");
        $model = M("user");
        $str = $model->field("wordcloud")->where("id=".$uid)->select();
        if($str[0]["wordcloud"]){
            $arr = array_unique(explode("/",$str[0]["wordcloud"]));
            $arr1 = [];
            foreach($arr as $k => $v){
                $obj = [];
                $value = substr_count($str[0]['wordcloud'],$arr[$k]);
                $obj["name"] = $arr[$k];
                $obj["value"] = $value;
                array_push($arr1, $obj);
            }

            echo success($arr1, "同事印象获取成功");
        }else{
            echo success([], "无同事印象");
        }
    }



    // 将图片生成Data URL
    public function dataUrl(){
        $uid = I("uid");
        $model = M("user");
        $data = $model->field("avatar")->where("id=".$uid)->select();
        $url = $data[0]["avatar"];

        //读取图片文件，转换成base64编码格式
        $image_info = getimagesize($url);

        $base64_image_content = "data:{$image_info['mime']};base64," . base64_encode(file_get_contents($url));

        // 匹配出图片的格式
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)){
            $type = $result[2];
        }

        echo  success($base64_image_content, "获取dataurl成功！");

    }

    public function sendEmail(){

        $subject = I("subject");
        $content = I("content");
        $email = I("email");
        sendMail($email,$subject, $content);
        echo success([], "邮件发送成功!");
    }
}

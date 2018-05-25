<?php

namespace Home\Controller;
use Think\Controller;

class AlbumController extends CommonController{

    public function gallery(){
        $model = M();
        /*$arr = $model->table("am_album a,am_photo p,am_user u")
            ->field("a.id id,a.name,a.mes,a.photo,a.createtime,u.name creater,u.id,count(*) photocount")
            ->where("a.id=p.aid and a.uid=u.id")
            ->group("a.id")
            ->select();*/
        $sql = <<<EOF
select SUM(if(p.id is null,0,1)) photocount ,a.id,a.name,a.mes,a.photo,a.createtime,u.name creater,u.id uid
 from am_album a 
left JOIN am_photo p on p.aid=a.id left JOIN am_user u ON a.uid=u.id group by a.id
EOF;

        $arr = $model->query($sql);

        foreach($arr as $k => $v){
            if(preg_match("/http|https/", $arr[$k]["photo"])){
                $arr[$k]['photo'] = $arr[$k]["photo"];
            }else{
                $arr[$k]['photo'] = ALBUM_UPLOADURL.$arr[$k]["photo"];
            }
        }

        $this->assign("arr",$arr);
        $this->display();
    }

    public function photo(){
        $aid = I("get.aid");
        $model = M("photo");
        $model1 = M("album");
        $model2 = M("albumview");

        $uid = session("uid");

        $auid = $model2->field("id,time")->where("uid=$uid and aid=$aid")->select();
        if($auid){
            $data['time'] = date("Y-m-d H:i:s");
            $data['aid'] = $aid;
            $model2->where("uid=$uid and aid = $aid")->save($data);
        }else{

            $model1->where("id=$aid")->setInc("viewnum");
            $data['time'] = date("Y-m-d H:i:s");
            $data['aid'] = $aid;
            $data['uid'] = $uid;
            $model2->add($data);
        }
        $today = date("Y-m-d");
        $condition['time'] = array("like", array($today.'%'));
        $todaycount = $model2->where($condition)->count();
        $albuminfo = $model1->field("name,viewnum,mes")->where("id=$aid")->select();
        $photocount = $model->where("aid=$aid")->count();

        $view = $model2->table("am_user us,am_albumview av")
            ->field("us.id uid,us.name username,av.time viewtime,us.avatar")
            ->where("us.id=av.uid and aid=$aid")
            ->order("av.time desc")
            ->select();

        $arr = $model->where("aid=$aid")->select();

        $model3 = M("user");
        foreach($arr as $k => $v){
            $uid1 = $arr[$k]["uid"];
            $username = $model3->field("name")->where("id=$uid1")->select();
            $arr[$k]["username"] = $username[0]["name"];
            $arr[$k]["bigphoto"] = _ROOT.GALLERY_UPLOADURL.$arr[$k]["bigphoto"];
            $arr[$k]["smallphoto"] = GALLERY_UPLOADURL.$arr[$k]["smallphoto"];
        }
        $this->assign("aid",$aid);
        $this->assign("arr", $arr);
        $this->assign("view", $view);
        $this->assign("todaycount", $todaycount);
        $this->assign("photocount", $photocount);
        $this->assign("albumname", $albuminfo[0]['name']);
        $this->assign("detail", $albuminfo[0]['mes']);

        $this->assign("allcount", $albuminfo[0]['viewnum']);
        $this->display();
    }

    /**
     * 添加相册
     */
    public function add(){
        $upload = new \Think\Upload();//  实例化上传类
        $upload->maxSize = 500000 ;//  设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');//  设置附件上传类型
        $upload->rootPath = "./".ALBUM_UPLOADURL;
        $upload->savePath = ''; //  设置附件上传目录
        $upload->subName = "";
        //  上传文件
        $info = $upload->upload();
        $photo = $info['photo']['savename'];

        $onlineurl = I("post.onlineurl");

        if($photo){
            $data['photo'] = $photo;
            $image = new \Think\Image();
            $image->open("./".ALBUM_UPLOADURL.$photo);
            $image->thumb(225, 162,\Think\Image::IMAGE_THUMB_CENTER)->save("./".ALBUM_UPLOADURL.$photo);
        }elseif($onlineurl){
            $data['photo'] = $onlineurl;
        }else{
            $data['photo'] = "1.jpg";
        }

        $model = M("album");
        $data['name'] = I("post.name");
        $data['mes'] = I("post.mes");

        $data['createtime'] = date("Y-m-d");
        $model1 = M("user");
        $email = cookie("dms_email");
        $uid = $model1->field("id")->where("email='$email'")->select();
        $data['uid'] = $uid[0]['id'];
        $res = $model->add($data);

        if($res){
            $json = array(
                "code" => 1
            );
            echo json_encode($json);
        }else{
            $json = array(
                "code" => 0
            );
            echo json_encode($json);
        }
    }

    /**
     * 删除相册
     */
    public function del(){
        $id = I("get.id");
        $model = M("album");
        $model1 = M("photo");
        $allphoto = $model1->where("aid=$id")->select();
        foreach ($allphoto as $k => $v){
            $big = $v['bigphoto'];
            $small = $v['smallphoto'];
            unlink("./".GALLERY_UPLOADURL.$big);
            unlink("./".GALLERY_UPLOADURL.$small);
        }

        $model1->where("aid=$id")->delete();
        $photo = $model->field("photo")->where("id=$id")->select();
        unlink("./".ALBUM_UPLOADURL.$photo[0]["photo"]);
        $res = $model->delete($id);
        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function delphoto(){
        $id = I("get.id");
        $aid = I("get.aid");
        $model = M("photo");
        $photo = $model->field("smallphoto,bigphoto")->where("id=$id")->select();
        $res = $model->delete($id);
        unlink("./".GALLERY_UPLOADURL.$photo[0]["smallphoto"]);
        unlink("./".GALLERY_UPLOADURL.$photo[0]["bigphoto"]);
        if($res){
            $this->redirect("album/photo",array("aid"=>$aid));
        }else{
            $this->redirect("album/photo",array("aid"=>$aid));
        }
    }

    /**
     * 保存编辑后相册的信息
     */
    public function editphoto(){

        $upload = new \Think\Upload();//  实例化上传类
        $upload->maxSize = 500000 ;//  设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');//  设置附件上传类型
        $upload->rootPath = "./".ALBUM_UPLOADURL;
        $upload->savePath = ''; //  设置附件上传目录
        $upload->subName = "";
        //  上传文件
        $info = $upload->upload();
        $photo = $info['photo']['savename'];

        $onlineurl = I("post.onlineurl");
        if($photo){
            $data['photo'] = $photo;
            $image = new \Think\Image();
            $image->open("./".ALBUM_UPLOADURL.$photo);
            $image->thumb(225, 162,\Think\Image::IMAGE_THUMB_CENTER)->save("./".ALBUM_UPLOADURL.$photo);
        }elseif($onlineurl){
            $data['photo'] = $onlineurl;
        }

        $model = M("album");
        $data['name'] = I("post.name");
        $data['mes'] = I("post.mes");

        $aid = I("post.aid");
        $oldphoto = $model->field("photo")->where("id=$aid")->select();
        unlink("./".ALBUM_UPLOADURL.$oldphoto);

        $data['createtime'] = date("Y-m-d");
        $model1 = M("user");
        $email = cookie("dms_email");
        $uid = $model1->field("id")->where("email='$email'")->select();
        $data['uid'] = $uid[0]['id'];
        $res = $model->where("id=$aid")->save($data);

        if($res){
            $json = array(
                "code" => 1
            );
            echo json_encode($json);
        }else{
            $json = array(
                "code" => 0
            );
            echo json_encode($json);
        }
    }

    /**
     * 保存编辑后照片的名字
     */
    public function savephoto(){
        $id = I("post.id");
        $model = M("photo");
        $data['name'] = I("post.name");
        $res = $model->where("id=$id")->save($data);
        if($res){
            $json = array(
                "code" => 1
            );
            echo json_encode($json);
        }else{
            $json = array(
                "code" => 0
            );
            echo json_encode($json);
        }
    }

    public function upload(){
        $aid= I("get.aid");
        $this->assign("aid",$aid);
        $this->display();
    }

    public function upload_save(){
        $upload = new \Think\Upload();
        $upload->maxSize = 5000000;
        $upload->exts = array('jpg','gif','png','jpeg');
        $upload->rootPath = "./".GALLERY_UPLOADURL;
        $upload->savePath = "";
        $upload->subName = '';

        $info = $upload->upload();
        if($info){
            $model = M("photo");
            $model1 = M("user");
            $uid = session("uid");
            $uid = $model1->field("id")->where("id='$uid'")->select();

            foreach($info as $file){
                $data['name'] = $file['savename'];
                $photo = $file['savename'];
                $image = new \Think\Image();
                $image->open("./".GALLERY_UPLOADURL.$photo);

                $image->thumb(150, 150,\Think\Image::IMAGE_THUMB_CENTER)->save("./".GALLERY_UPLOADURL."small".$photo);

                $data['bigphoto'] = $photo;
                $data['smallphoto'] = "small".$photo;
                $data['createtime'] = date("Y-m-d");
                $data['aid'] = I("get.aid");
                $data['uid'] = $uid[0]['id'];

                $model->add($data);
            }

        }else{
            die("上传失败");
        }
    }

    public function qrcode(){

        $save_path = isset($_GET['save_path'])?$_GET['save_path']:'Public/qrcode/';  //图片存储的绝对路径
        $web_path = isset($_GET['save_path'])?$_GET['web_path']:'/Public/qrcode/';        //图片在网页上显示的路径
        $qr_data = isset($_GET['qr_data'])?$_GET['qr_data']:'http://www.stockemotion.com/';
        $qr_level = isset($_GET['qr_level'])?$_GET['qr_level']:'H';
        $qr_size = isset($_GET['qr_size'])?$_GET['qr_size']:'10';
        $save_prefix = isset($_GET['save_prefix'])?$_GET['save_prefix']:'dms';
        if($filename = createQRcode($save_path,$qr_data,$qr_level,$qr_size,$save_prefix)){
            $pic = $web_path.$filename;
        }
        echo "<img src='".$pic."' height='360px' width='360px'>";
    }


}

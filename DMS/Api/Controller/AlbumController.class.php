<?php
/**
 * Created by flitrue.
 * User: WODE
 * Date: 2017/5/8
 * Time: 20:53
 */

namespace Api\Controller;
use Think\Controller;

// 该类为 post 方式提交大量数据

class AlbumController extends Controller
{
    public function _initialize()
    {
        header('Access-Control-Allow-Origin: *');     //设置允许跨域请求的地址
        header("Access-Control-Allow-Headers:X-Requested-With");      // 设置跨域请求只允许ajax提交
    }

    public function info(){
        $uid = I("uid");
        $model = M();
        $sql = <<<EOF
select SUM(if(p.id is null,0,1)) photocount ,a.id,a.name,a.mes,a.photo,a.share,a.createtime,u.name creater,u.id uid
 from am_album a 
left JOIN am_photo p on p.aid=a.id left JOIN am_user u ON a.uid=u.id where a.uid=$uid group by a.id
EOF;
        $arr = $model->query($sql);
        if($arr){
            echo successp($arr,"相册获取成功！");
        }else{
            echo failurep([],"您还没有相册,请先创建一个相册！");
        }
    }

    public function create(){

        $model = M("album");
        $data["name"] = I("name");
        $data["mes"] = I("mes");
        $data["createtime"] = date("Y-m-d");
        $data["uid"] = I("uid");
        $data["photo"] = I("img");
        $res = $model->data($data)->add();
        if($res){
            echo successp([], "相册创建成功！");
        }else{
            echo failurep([], "相册创建失败！");
        }
    }

    public function edit(){

        $model = M("album");
        $aid = I("aid");
        $model->name = I("name");
        $model->mes = I("mes");
        $model->photo = I("img");
        $model->updatetime = I("updatetime");

        $res = $model->where("id=".$aid)->save();
        if($res){
            echo successp([], "相册编辑成功！");
        }else{
            echo failurep([], "相册编辑失败！");
        }
    }

    public function del(){

        $model = M("album");
        $aid = I("aid");

        $res = $model->delete($aid);
        if($res){
            echo successp([], "相册删除成功！");
        }else{
            echo failurep([], "相册删除失败！");
        }
    }

    public function detail(){
        $aid = I("aid");
        $model = M("photo");
        $arr = $model->where("aid=".$aid)->select();
        if($arr){
            echo successp($arr, "相册ID".$aid."的相片获取成功！");
        }
    }

    public function delPhoto(){
        $pid = I("pid");
        $model = M("photo");
        $arr = $model->delete($pid);
        if($arr){
            echo successp($arr, "相片ID".$pid."删除成功！");
        }else{
            echo failurep([], "相片ID".$pid."删除失败！");
        }
    }


    public function category(){
        $uid = I("uid");
        $model = M("album");
        $arr = $model->field("id,name,photo")->where("uid=".$uid)->select();
        if($arr){
            echo successp($arr,"相册类别成功！");
        }else{
            echo failurep([],"相册类别失败！");
        }
    }

    // 上传相片
    public function add(){
        $model = M("photo");
        $filelist = I("imglist");
        $data["createtime"] = date("Y-m-d");
        $data["aid"] = I("aid");
        $data1 = [];
        for ($i=0;$i<count($filelist);$i++){
            $data["bigphoto"] = $filelist[$i]["url"];
            array_push($data1, $data);
        }
        $model->addAll($data1);
        echo successp($data1, "相片上传成功！");
    }


    public function upload(){
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
        $arr = array(
            "url"      =>  $imgpath,
            "field"         => $info['img']['savename']
        );

        echo json_encode($arr);
    }
}
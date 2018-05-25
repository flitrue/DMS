<?php

namespace Home\Controller;
use Think\Controller;

class DeviceController extends CommonController{

    public function look(){
        $model = M("transaction");
        $pagenow = I('get.page')?I('get.page'):1 ;
        $size = ($pagenow-1)*10;

        $sql = <<<EOF
        SELECT
        de.id did,us.id uid,tr.id,ca.name category,
        de.name devicename,de.version,de.code,de.tag,de.price,
        de.keyinfo,de.remarks,de.buytime,de.buyer,tr.status,
        us.name username
        FROM am_device de 
        LEFT JOIN am_transaction tr ON (tr.did=de.id) 
        LEFT JOIN am_user us ON (tr.uid=us.id)
        LEFT JOIN am_category ca ON (ca.id=de.category) 
        ORDER BY ca.id LIMIT $size,10
EOF;

        $sql1 = <<<EOF
        SELECT
        *
        FROM am_device de 
        LEFT JOIN am_transaction tr ON (tr.did=de.id) 
        LEFT JOIN am_user us ON (tr.uid=us.id)
        LEFT JOIN am_category ca ON (ca.id=de.category) 
        ORDER BY ca.id 
EOF;

        $arr = $model->query($sql);
        $arr1 = $model->query($sql1);
        $count = count($arr1);

        // SUM(if(pa.id is null,0,1)) count
       /* $device = $model->table("am_depart depart")
            ->field("depart.name depart,sum(if(device.id is null,0,1)) as count")
            ->join("am_device device on device.depart=depart.id","LEFT")
            ->group("depart.name")->select();*/

       $status = $model->query("select count(*) count,status from am_transaction group by status");


        $this->assign('arr',$arr);
        $num = $count/10 < 1? 1:ceil($count/10);//页数
        $prepage = $pagenow-1;
        $nextpage = $pagenow+1;


        $this->assign('pagenow',$pagenow);
        $this->assign("prepage",$prepage);
        $this->assign("nextpage",$nextpage);

        $this->assign('num',$num);// 页数
        $this->assign('status',$status);// 部门下的设备数

        $device_chart_pie = $this->device_chart_pie();
        $device_chart_pie_category = $this->device_chart_pie_category();
        $device_chart_bar = $this->device_chart_bar();
        $device_chart_bar_category = $this->device_chart_bar_category();
        $this->assign('device_chart_pie',$device_chart_pie);
        $this->assign('device_chart_pie_category',$device_chart_pie_category);
        $this->assign('device_chart_bar',$device_chart_bar);
        $this->assign('device_chart_bar_category',$device_chart_bar_category);

        $this->assign('count',$count);
        $this->display();
    }

    public function device_chart_pie(){
        $model = M('device');
        $status = $model->query("select sum(if(id is null,0,1)) value,status name from am_transaction group by status");
        return json_encode($status);
    }

    public function device_chart_pie_category(){
        $model = M();
        $status = $model->query("select status from am_transaction group by status");
        $arr1 = [];
        for($i=0;$i<count($status);$i++){
            $arr1[$i] = $status[$i]['status'];
        }

        return json_encode($arr1);
    }

    public function device_chart_bar(){
        $model = M();
        $arr = $model->table("am_depart dp")
            ->field("sum(if(de.id is null,0,1)) value,dp.name")
            ->join("am_device de on dp.id=de.depart","left")
            ->group("dp.name")
            ->select();

        return json_encode($arr);
    }

    public function device_chart_bar_category(){
        $asset = A('asset');
        $data = $asset->getDepartPriceCounts();
        foreach ($data as $k => $v){
            $data[] = $v['name'];
        }

        return json_encode($data);
    }

    public function add(){
        $model1 = M('category');
        $model2 = M('depart');
        $model3 = M('group');
        $model4 = M('user');
        $category = $model1->select();
        $depart = $model2->select();
        $group = $model3->select();
        $user = $model4->field('id,name,email')->select();

        $this->assign('category',$category);
        $this->assign('depart',$depart);
        $this->assign('group',$group);
        $this->assign('user',$user);
        $this->display();
    }

    public function add_save(){

        $upload = new \Think\Upload();//  实例化上传类
        $upload->maxSize = 5000000 ;//  设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');//  设置附件上传类型
        $upload->rootPath = ".".IMAGE_UPLOADURL;
        $upload->savePath = ''; //  设置附件上传目录
        $upload->subName = '';
        //  上传文件
        $info = $upload->upload();


        $device = M('device');
        $transaction = M('transaction');
        $imgpath1 = $info['photo1']['savename'];
        $imgpath2 = $info['photo2']['savename'];
        $imgpath3 = $info['photo3']['savename'];
        $invoice1 = $info['invoice1']['savename'];
        $invoice2 = $info['invoice2']['savename'];
        $model = M('user');
        $uid = I('post.buyer');
        $res = $model->field("name,email")->where("id=$uid")->select();
        $buyer = $res[0]['name']."(".$res[0]['email'].")";
        $devicename = I('post.brand').I('post.version');
        $data1 = array(
            'name'              =>      $devicename,
            'brand'             =>      I('post.brand'),
            'version'           =>      I('post.version'),
            'code'              =>      I('post.code'),
            'tag'               =>      I('post.tag'),
            'price'             =>      I('post.price'),
            'category'          =>      I('post.category'),
            'keyinfo'           =>      I('post.keyinfo'),
            'usetime'           =>      I('post.usetime'),
            'buyer'             =>      $buyer,
            'buyway'            =>      I('post.buyway'),
            'buytime'           =>      I('post.buytime'),
            'remarks'           =>      I('post.remarks'),
            'depart'            =>      I('post.depart'),
            'group'             =>      I('post.group'),
            'photo1'            =>      $imgpath1,
            'photo2'            =>      $imgpath2,
            'photo3'            =>      $imgpath3,
            'invoice1'          =>      $invoice1,
            'invoice2'          =>      $invoice2,
        );
        $did = $device->add($data1);

        if(I('post.status') == "未分配"){
            $data2 = array(
                'did'               =>      $did,
                'status'            =>      I('post.status'),
            );
        }else{
            $data2 = array(
                'uid'               =>      I('post.uid'),
                'did'               =>      $did,
                'status'            =>      I('post.status'),
            );
        }



        $transaction->add($data2);
        $this->redirect('device/look');
    }

    public function edit(){
        $did = I('get.did');

        $sql = <<<EOF
SELECT
        tr.id,de.id did,us.id uid,
        de.name devicename,de.version,de.code,de.tag,de.category,de.price,
        tr.status,de.keyinfo,de.remarks,de.depart,de.group,de.buyer,de.buytime buytime,de.usetime,
        us.name username,de.photo1,de.photo2,de.photo3
        FROM am_device de 
        LEFT JOIN am_transaction tr ON (tr.did=de.id) 
        LEFT JOIN am_user us ON (tr.uid=us.id)
        LEFT JOIN am_category ca ON (ca.id=de.category) 
        WHERE de.id = $did
        ORDER BY ca.id 
EOF;

        $model = M();
        $arr = $model->query($sql);
        $model1 = M('category');
        $model2 = M('depart');
        $model3 = M('group');
        $model4 = M('user');

        $category = $model1->select();
        $depart = $model2->select();
        $group = $model3->select();
        $user = $model4->field('id,name')->select();
        $photo1 = $arr[0]['photo1'];
        $photo2 = $arr[0]['photo2'];
        $photo3 = $arr[0]['photo3'];

        if($photo1){
            $this->assign("photo1",IMAGE_UPLOADURL.$photo1);
        }

        if($photo2){
            $this->assign("photo2",IMAGE_UPLOADURL.$photo2);
        }

        if($photo3){
            $this->assign("photo3",IMAGE_UPLOADURL.$photo3);
        }
        $this->assign('category',$category);
        $this->assign('depart',$depart);
        $this->assign('group',$group);
        $this->assign('arr', $arr);
        $this->assign('user',$user);
        $this->display();
    }

    public function edit_save(){

        $device = M('device');

        $data1 = array(
            'name'              =>      I('post.devicename'),
            'brand'             =>      I('post.brand'),
            'version'           =>      I('post.version'),
            'code'              =>      I('post.code'),
            'tag'               =>      rtrim(trim(I('post.tag')),','),
            'price'             =>      I('post.price'),
            'category'          =>      str_replace('category','',I('post.category')),
            'keyinfo'           =>      I('post.keyinfo'),
            'usetime'           =>      I('post.usetime'),
            'buyer'             =>      trim(I('post.buyer')),
            'buytime'           =>      I('post.buytime'),
            'remarks'           =>      trim(I('post.remarks')),
            'depart'            =>      str_replace('depart','',I('post.depart')),
            'group'             =>      str_replace('group','',I('post.group'))
        );

        $transaction = M('transaction');

        $uid = str_replace('user','',I('post.user'));
        if(I('post.status') == "未分配"){
            $data2 =array(
                'uid'               =>      '',
                'did'               =>      I('post.did'),
                'status'            =>      I('post.status'),
            );
        }else{
            $data2 =array(
                'uid'               =>      $uid,
                'did'               =>      I('post.did'),
                'status'            =>      I('post.status'),
            );
        }
        $id = I('post.id');
        $did = I('post.did');
        $res1 = $transaction->where("id=$id")->save($data2);

        $res = $device->where("id=$did")->save($data1);
        if($res || $res1){
            echo 1;//  提交成功
        }else{
            echo 0;
        }

    }

    public function del(){
        $did = I('did');
        $id = I('id');
        $model1 = M('device');
        $model2 = M('transaction');
        $photo = $model1->field("photo1,photo2,photo3,invoice1,invoice2")->where("id=$did")->select();
        unlink("./".IMAGE_UPLOADURL.$photo[0]['photo1']);
        unlink("./".IMAGE_UPLOADURL.$photo[0]['photo2']);
        unlink("./".IMAGE_UPLOADURL.$photo[0]['photo3']);
        unlink("./".IMAGE_UPLOADURL.$photo[0]['invoice1']);
        unlink("./".IMAGE_UPLOADURL.$photo[0]['invoice2']);
        $res1 = $model1->delete($did);
        $res2 = $model2->delete($id);
        if($res1 && $res2){
            $this->redirect("device/look/");
        }else{
            $this->error("删除失败");
        }
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

        if(!$info) {
            //  上传错误提示错误信息
            $this->error('请选择图片！');
        }else{
            $device = M('device');
            $imgpath1 = $info['photo1']['savename'];
            $imgpath2 = $info['photo2']['savename'];
            $imgpath3 = $info['photo3']['savename'];

            $data = array();
            if($info['photo1']['savename']){
               $data['photo1'] = $imgpath1;
            }
            if($info['photo2']['savename']){
                $data['photo2'] = $imgpath2;
            }
            if($info['photo3']['savename']){
                $data['photo3'] = $imgpath3;
            }
            $did = I("get.did");

            $device->where("id=$did")->save($data);

            header("location: ".$_SERVER['HTTP_REFERER']);
        }
    }

    public function deletemulti(){
        $id = $_POST;
        $datanum = array_values($id);
        $data = implode(',',$datanum);
        $model = M('device');
        $model1 = M('transaction');

        $res = $model->delete($data);
        for($i = 0; $i < count($datanum);$i++){
            $model1->where("did=$datanum[$i]")->delete();
        }

        if($res){
            echo 1;
        }else{
            echo 0;
        }

    }

    /**
     *查看发票信息
     */
    public function invoice(){
        $did = I('get.did');
        $model = M('device');
        $invoice = $model->field("invoice1,invoice2")->where("id=$did")->select();

        // IMAGE_UPLOADURL.$invoice
        $nopicture = IMAGE_URL."nopicture.jpg";
        $str = '';

        if($invoice[0]['invoice1'] == '' && $invoice[0]['invoice2'] == ''){
            $str = "<span style='display: flex; justify-content: center;font-size: 20px;color: red;'>发票图片不存在</span>";
            $this->assign('invoice',$str);
        }else{
            $str .= "<div class='form-group col-xs-12' >
	<label class='col-xs-3 control-label no-padding-right'></label>
	<div class='row-fluid'>
		<ul class='ace-thumbnails'>";

            if($invoice[0]['invoice1']){
                $invoi = IMAGE_UPLOADURL.$invoice[0]['invoice1'];
                $str .= "
                <li>
                    <a href='$invoi' data-rel='colorbox'>
                        <img alt='150x150' src='$invoi' onerror='javascript:this.src='$nopicture' height='150px' width='150px'/>
                    </a>
                </li>";
            }
            if($invoice[0]['invoice2']){
                $invoi = IMAGE_UPLOADURL.$invoice[0]['invoice2'];
                $str .= "
                <li>
                    <a href='$invoi' data-rel='colorbox'>
                        <img alt='150x150' src='$invoi' onerror='javascript:this.src='$nopicture' height='150px' width='150px'/>
                    </a>
                </li>";
            }
            $str .= "</ul></div></div>";
            $this->assign('invoice',$str);
        }

        $this->display();
    }


    public function detail(){
        $did = I("get.did");

        $sql = <<<EOF
SELECT
        tr.id,de.id did,us.id uid,
        de.name devicename,de.version,de.code,de.tag,de.category,de.price,
        tr.status,de.keyinfo,de.remarks,dp.name departname,gr.name groupname,de.buyer,de.buytime buytime,de.usetime,
        us.name username,de.photo1,de.photo2,de.photo3,de.invoice1,de.invoice2
        FROM am_device de 
        LEFT JOIN am_transaction tr ON (tr.did=de.id) 
        LEFT JOIN am_user us ON (tr.uid=us.id)
        LEFT JOIN am_category ca ON (ca.id=de.category) 
        LEFT JOIN am_group gr ON (ca.id=de.category) 
        LEFT JOIN am_depart dp ON (ca.id=de.category) 
        WHERE de.id = $did
EOF;


        $model = M();
        $arr = $model->query($sql);

        $photo1 = $arr[0]['photo1'];
        $photo2 = $arr[0]['photo2'];
        $photo3 = $arr[0]['photo3'];
        $invoice1 = $arr[0]['invoice1'];
        $invoice2 = $arr[0]['invoice2'];

        if($photo1){
            $this->assign("photo1",IMAGE_UPLOADURL.$photo1);
        }

        if($photo2){
            $this->assign("photo2",IMAGE_UPLOADURL.$photo2);
        }

        if($photo3){
            $this->assign("photo3",IMAGE_UPLOADURL.$photo3);
        }
        if($invoice1){
            $this->assign("invoice1",IMAGE_UPLOADURL.$invoice1);
        }
        if($invoice2){
            $this->assign("invoice2",IMAGE_UPLOADURL.$invoice2);
        }
        $this->assign("arr",$arr);
        $this->display();
    }

    public function checkcode(){
        $code = I("post.code");
        file_put_contents("log.log",$code);
        $model = M("device");
        $device = $model->field("id")->where("code='$code'")->select();

        if($device){
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
}
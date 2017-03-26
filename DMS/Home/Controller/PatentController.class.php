<?php

namespace Home\Controller;
use Think\Controller;

class PatentController extends CommonController{

    public function look(){
        $model = M("patent");
        $count = $model->count();

        $pagenow = I('get.page')?I('get.page'):1 ;

        $arr = $model->table("am_patent pa")
            ->field("pa.id pid,pa.name,max(pas.status) status,pac.name category,if(us.name is null,'用户不存在',us.name) username,us.id uid,if(us1.name is null,'用户不存在',us1.name) operator,us1.id oid")
            ->join("am_patentcategory pac on pac.id=pa.category",'left')
            ->join("am_patentstatus pas on pa.id=pas.pid","left")
            ->join("am_user us on us.id=pa.uid","left")
            ->join("am_user us1 on us1.id=pa.operator","left")
            ->page($pagenow,10)
            ->group("pa.id")
            ->select();

        foreach ($arr as $k => $v){
            switch ($arr[$k]['status']){
                case '1':
                    $arr[$k]['status'] = '受理中';
                    break;
                case '2':
                    $arr[$k]['status'] = '初审中';
                    break;
                case '3':
                    $arr[$k]['status'] = '公布中';
                    break;
                case '4':
                    $arr[$k]['status'] = "实申中";
                    break;
                case '5':
                    $arr[$k]['status'] = '已授权';
                    break;
                default:
                    break;
            }
        }
        $num = $count/10 < 1? 1:ceil($count/10);//页数
        $prepage = $pagenow-1;
        $nextpage = $pagenow+1;

        $patent_chart_pie_category = $this->patent_chart_pie_category();
        $patent_chart_pie = $this->patent_chart_pie();
        $patent_chart_bar_data = $this->patent_chart_bar();
        $patent_chart_bar_category_data = $this->patent_chart_bar_category();

        $this->assign('pagenow',$pagenow);
        $this->assign("prepage",$prepage);
        $this->assign("nextpage",$nextpage);

        $this->assign("patent_chart_pie_category",$patent_chart_pie_category);
        $this->assign("patent_chart_pie",$patent_chart_pie);
        $this->assign("patent_chart_bar_data",$patent_chart_bar_data);
        $this->assign("patent_chart_bar_category_data",$patent_chart_bar_category_data);


        $this->assign('num',$num);// 页数
        $this->assign('count',$count);
        $this->assign("arr", $arr);
        $this->display();
    }

    public function patent_chart_pie(){
        $model = M();
        $patent = $model->table("am_patentcategory pac")
            ->field("sum(if(pa.id is null,0,1)) as value,pac.name as name")
            ->join("am_patent pa on pac.id=pa.category","LEFT")
            ->group("pac.name")->select();

        return json_encode($patent);
    }

    public function patent_chart_pie_category(){
        $model = M();
        $patent = $model->table("am_patentcategory pac")
            ->field("sum(if(pa.id is null,0,1)) as value,pac.name as name")
            ->join("am_patent pa on pac.id=pa.category","LEFT")
            ->group("pac.name")->select();

        foreach($patent as $value){
            $patent_ca[] = $value['name'];
        }

        return  json_encode($patent_ca);
    }

    public function patent_chart_bar_category(){
        $model = M("patentcategory");
        $arr = $model->field("name")->select();
        $res = [];
        for($i=0;$i<count($arr);$i++){
            $res[] = $arr[$i]['name'];
        }
        return json_encode($res);
    }

    public function patent_chart_bar(){
        $model = M();
        $year = date("Y");
        $last = $year-1;

        $sql = "select sum(if( b.starttime not like '$year%' || b.id is null ,0 ,1)) value from am_patentcategory as a
left join am_patentview as b on a.id=b.cid group by a.id";

        $arr = $model->query($sql);
        $res = [];
        for($i=0;$i<count($arr);$i++){
            $res[] = $arr[$i]['value'];
        }
        $arr2 = array(
            "name"  =>  $year,
            "type"  =>  'bar',
            "data"  =>  $res
        );

        $sql1 = "select sum(if( b.starttime not like '$last%' || b.id is null ,0 ,1)) value from am_patentcategory as a
left join am_patentview as b on a.id=b.cid group by a.id";

        $arr1 = $model->query($sql1);
        $res1 = [];
        for($i=0;$i<count($arr1);$i++){
            $res1[] = $arr1[$i]['value'];
        }

        $arr3 = array(
            "name"  =>  $last,
            "type"  =>  'bar',
            "data"  =>  $res1
        );
        $arr4[0] = $arr2;
        $arr4[1] = $arr3;

        return json_encode($arr4);
    }


    public function flow(){
        $model = M("patentcategory");
        $arr = $model->select();
        $this->assign("arr", $arr);
        $this->display();
    }

    public function detail(){
        $pid = I("get.id");
        $model1 = M("patent");
        $model = M("patentstatus");
        $arr = $model->table("am_patent pa")
            ->field("pa.id pid,pa.name,pac.name category,if(us.name is null,'用户不存在',us.name) username,us.id uid,if(us1.name is null,'用户不存在',us1.name) operator,us1.id oid,pa.size,pa.tag,pa.remarks")
            ->join("am_patentcategory pac on pac.id=pa.category",'left')
            ->join("am_patentstatus pas on pa.id=pas.pid","left")
            ->join("am_user us on us.id=pa.uid","left")
            ->join("am_user us1 on us1.id=pa.operator","left")
            ->where("pa.id=$pid")
            ->select();

        $name = $model1->where("id=$pid")->select();
        //$status1 = $model->table("am_patent pa,am_patentstatus pas")->where("pa.id=pas.pid and pas.status=1 and pa.id=$pid")->select();
        $status1 = $model->where("status=1 and pid=$pid")->select();
        $status2 = $model->where("status=2 and pid=$pid")->select();
        $status3 = $model->where("status=3 and pid=$pid")->select();
        $status4 = $model->where("status=4 and pid=$pid")->select();
        $status5 = $model->where("status=5 and pid=$pid")->select();

        $step = 0;
        if($status1){
            $step = 1;
        }
        if ($status2){
            $step = 2;
        }
        if ($status3){
            $step = 3;
        }

        if($status4){
            $step = 4;
        }

        if($status5){
            $step = 5;
        }
        $this->assign("status1",$status1);
        $this->assign("status2",$status2);
        $this->assign("status3",$status3);
        $this->assign("status4",$status4);
        $this->assign("status5",$status5);
        $this->assign("step",$step);
        $this->assign("arr",$arr);
        $this->assign("pid",$pid);
        $this->assign("name",$name[0]['name']);
        $this->assign("empty","<h3 class='light-red'>审核中</h3>");
        $this->assign("endtime","<span class='light-red'>审核中</span>");

        $this->display();
    }

    public function add(){
        $model = M("user");
        $model1 = M("patentcategory");
        $user = $model->field('id,name,email')->select();
        $arr = $model1->select();
        $this->assign("user",$user);
        $this->assign("arr",$arr);
        $this->display();
    }

    public function add_save(){
        $upload = new \Think\Upload();
        $upload->maxSize = 5000000;
        $upload->exts = array('zip', 'rar', 'tar.gz');
        $upload->rootPath = ".".DOCS_UPLOADURL;
        $upload->savePath = ''; //  设置附件上传目录
        $upload->subName = '';
        $info = $upload->upload();
        if(!$info){
            $json = array(
                "code"  =>  '500',
                'msg'   =>  "没有文件被上传",
                'error' =>  $upload->getError(),
                'post'  =>  $_POST
            );
            echo json_encode($json);
            exit;
        }


        $model = M("patent");
        $model1 = M("patentstatus");
        $model2 = M("document");
        $model3 = M("user");
        $uid = session("uid");
        $adduid = $model3->field("id")->where("id=$uid")->select();

        $data['name'] = I("post.name");
        $data['uid'] = I("post.username");
        $data['remarks'] = I("post.remarks");
        $data['tag'] = I("post.tag");
        $data['operator'] = $adduid[0]['id'];
        $data['url'] = $info['file']['savename'];
        $data['size'] = $info['file']['size'];
        //$data['starttime'] = I("post.starttime");
        $data['category'] = 1;

        $id = $model->add($data);
        $data1['pid'] = $id;
        $data1['status'] = 1;
        $data1['starttime'] = I("post.starttime");

        $res = $model1->add($data1);
        if($id){
            $json = array(
                "code"  =>  '200',
                "msg"   =>  '添加成功'
            );
        }else{
            $json = array(
                "code"  =>  '404',
                "msg"   =>  '添加失败'
            );
        }

        echo json_encode($json);

    }

    public function edit(){

        $pid = I("get.pid");
        $model1 = M("patent");
        $model = M("patentstatus");
        $name = $model1->where("id=$pid")->select();
        //$status1 = $model->table("am_patent pa,am_patentstatus pas")->where("pa.id=pas.pid and pas.status=1 and pa.id=$pid")->select();
        $status1 = $model->where("status=1 and pid=$pid")->select();
        $status2 = $model->where("status=2 and pid=$pid")->select();
        $status3 = $model->where("status=3 and pid=$pid")->select();
        $status4 = $model->where("status=4 and pid=$pid")->select();
        $status5 = $model->where("status=5 and pid=$pid")->select();
        $step = 0;
        if($status1){
            $this->assign("status1",$status1);
            $step = 1;
        }
        if ($status2){
            $this->assign("status2",$status2);
            $step = 2;
        }
        if ($status3){
            $this->assign("status3",$status3);
            $step = 3;
        }

        if($status4){
            $this->assign("status4",$status4);
            $step = 4;
        }

        if($status5){
            $this->assign("status5",$status5);
            $step = 5;
        }
        $this->assign("step",$step);
        $this->assign("pid",$pid);
        $this->assign("name",$name[0]['name']);
        $this->assign("empty","<h3 class='light-red'>审核中</h3>");
        $this->assign("endtime","<span class='light-red'>审核中</span>");

        $this->display();
    }

    public function del(){
        $id = I('get.pid');
        $model = M("patent");
        $model1 = M("patentstatus");
        $res = $model->delete($id);
        $res1 = $model1->where("pid=$id")->delete();

        if($res){
            $json = array(
                "code" => 1,
                "msg"  => "删除成功",
            );
        }else{
            $json = array(
                "code" => 0,
                "msg"  => "删除失败",
            );
        }
        echo json_encode($json);
    }

    public function delmutil(){
        $id = $_POST;
        $data = array_values($id);
        $data = implode(',',$data);
        $model = M('patent');
        $model1 = M("patentstatus");
        $res = $model->delete($data);

        for($i=0;$i<count($data);$i++){
            $res1 = $model1->delete($data[$i]);
        }

        if($res){
            echo 1;
        }else{
            echo 0;
        }

    }

    public function end(){
        $status = I("get.status");
        $pid = I("get.pid");
        $model = M("patentstatus");

        $data['endtime'] = date("Y-m-d H-i-s");
        $res = $model->where("pid=$pid and status=$status")->save($data);

        if($status != 5){
            $data1['status'] = (int)$status+1;
            $data1['starttime'] = date("Y-m-d H-i-s");
            $data1['pid'] = $pid;
            $model->add($data1);
        }

        if($res){
            $json = array(
                "code"  =>  200,
                "msg"   =>  "审核结束",
                "starttime"   =>  date("Y-m-d H-i-s")
            );
        }else{
            $json = array(
                "code"  =>  404,
                "msg"   =>  "审核失败"
            );
        }
        echo json_encode($json);
    }

    public function download(){
        $id = I("get.id");
        $model = M("patent");
        $url = $model->field("url")->where("id=$id")->select();

        redirect(DOCS_UPLOADURL.$url[0]['url']);
    }
}

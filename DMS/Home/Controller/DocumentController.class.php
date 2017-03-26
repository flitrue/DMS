<?php

namespace Home\Controller;
use Think\Controller;

class DocumentController extends CommonController{

    public function look(){
        $doc = I("get.doc");
        $pagenow = I('get.page')?I('get.page'):1 ;

        $model = M("document");


        if($doc){
            $count = $model->where("category=$doc")->count();
            $arr = $model->table("am_document doc")
                ->field("doc.id id,doc.name,doc.source,doca.name category,doc.uploadtime,if(us.name is null,'用户不存在',us.name) username,us.id uid,doc.url,doc.size")
                ->join("am_documentcategory doca on doc.category=doca.id",'LEFT')
                ->join("am_user us on us.id=doc.uid","LEFT")
                ->where("doc.category='$doc'")
                ->page($pagenow,10)
                ->select();

        }else{
            $count = $model->count();

            $arr = $model->table("am_document doc")
                ->field("doc.id id,doc.name,doc.source,doca.name category,doc.uploadtime,if(us.name is null,'用户不存在',us.name) username,us.id uid,doc.url,doc.size")
                ->join("am_documentcategory doca on doc.category=doca.id",'LEFT')
                ->join("am_user us on us.id=doc.uid","LEFT")
                ->page($pagenow,10)
                ->select();
        }

        $num = $count/10 < 1? 1:ceil($count/10);//页数
        $prepage = $pagenow-1;
        $nextpage = $pagenow+1;
        $document_chart_pie = $this->document_chart_pie();
        $document_chart_pie_category = $this->document_chart_pie_category();
        $document_chart_bar_category_data = $this->document_chart_bar_category();
        $document_chart_bar_data = $this->document_chart_bar();

        $this->assign('pagenow',$pagenow);
        $this->assign("prepage",$prepage);
        $this->assign("nextpage",$nextpage);

        $this->assign("document_chart_pie",$document_chart_pie);
        $this->assign("document_chart_pie_category",$document_chart_pie_category);
        $this->assign("document_chart_bar_category_data",$document_chart_bar_category_data);
        $this->assign("document_chart_bar_data",$document_chart_bar_data);

        $this->assign('num',$num);// 页数
        $this->assign('count',$count);

        $this->assign("arr", $arr);
        $this->display();
    }

    public function document_chart_pie(){
        $model = M();
        $document = $model->table("am_documentcategory doca")
            ->field("sum(if(doc.id is null,0,1)) as value,doca.name as name")
            ->join("am_document doc on doca.id=doc.category","LEFT")
            ->group("doca.name")->select();
        return json_encode($document);
    }

    public function document_chart_pie_category(){
        $model = M();
        $document = $model->table("am_documentcategory")
            ->field("name")->select();
        for($i = 0;$i < count($document); $i++){
            $arr[] = $document[$i]['name'];
        }
        return json_encode($arr);
    }

    public function document_chart_bar_category(){
        $model = M("documentcategory");
        $arr = $model->field("name")->select();
        $res = [];
        for($i=0;$i<count($arr);$i++){
            $res[] = $arr[$i]['name'];
        }
        return json_encode($res);
    }

    public function document_chart_bar(){
        $model = M();
        $year = date("Y");
        $last = $year-1;
        $sql = "select sum(if( b.uploadtime not like '$year%' || b.id is null ,0 ,1)) value from am_documentcategory as a 
left join am_document b on a.id=b.category  group by a.id";

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

        $sql1 = "select sum(if( b.uploadtime not like '$last%' || b.id is null ,0 ,1)) value from am_documentcategory as a 
left join am_document b on a.id=b.category  group by a.id";

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


    public function add(){

        $model = M("documentcategory");
        $category = $model->select();
        $this->assign("category",$category);
        $this->display();
    }

    public function add_save(){
        $upload = new \Think\Upload();
        $upload->maxSize = 5000000;
        $upload->exts = array("txt","doc","docx","xlsx","csv","zip","rar","tar.gz","tar.xz");
        $upload->rootPath = ".".DOCS_UPLOADURL;
        $upload->savePath = '';
        $upload->subName = '';

        $info = $upload->upload();
        $arr = $upload->getError();
        if(!$info){
            $json = array(
                "code"  =>  -1,
                "msg"   =>  "没有文件被上传",
                "arr"   =>  $arr
            );

        }else{
            $doc = $info['file']['savename'];
            $oldname = $info['file']['name'];
            $size = $info['file']['size'];
            $model = M("document");
            $model1 = M("user");
            $email = EMAIL;
            $uid = $model1->field("id")->where("email='$email'")->select();
            $arr = $model->create();
            $model->url = $doc;
            $model->uid = $uid[0]['id'];
            $model->oldname = $oldname;
            switch ($arr['category']){
                case '技术文档':
                    $model->category = "1";
                    break;
                case '使用手册':
                    $model->category = "2";
                    break;
                case '专利文档':
                    $model->category = "3";
                    break;
                default:
                    break;
            }
            $model->uploadtime = date("Y-m-d H-i-s");
            $model->size = $size;

            $res = $model->add();
            if($res){
                $json = array(
                    "code"  =>  1,
                    "msg"   =>  "上传成功",
                    "arr"   =>  $arr,
                    "id"    =>  $res
                );
            }else{
                $json = array(
                    "code"  =>  0,
                    "msg"   =>  "上传失败"
                );
            }
        }
        echo json_encode($json);
    }

    public function edit(){
        $id = I("get.id");
        $model = M("documentcategory");
        $model1 = M();
        $arr = $model1->table("am_document doc,am_documentcategory doca,am_user us")
            ->field("doc.id id,doc.name,doc.source,doc.tag,doc.remarks,doca.name category,doca.id cid,doc.uploadtime,us.name username,us.id uid,doc.url,doc.size")
            ->where("doc.category=doca.id and doc.uid=us.id and doc.id='$id'")
            ->select();
        $category = $model->select();
        $this->assign("category",$category);
        $this->assign("arr",$arr);
        $this->display();
    }

    public function edit_save(){
        $id = I("get.id");
        $upload = new \Think\Upload();
        $upload->maxSize = 5000000;
        $upload->exts = array("txt","doc","docx","xlsx","csv","zip","rar","tar.gz","tar.xz");
        $upload->rootPath = ".".DOCS_UPLOADURL;
        $upload->savePath = '';
        $upload->subName = '';

        $info = $upload->upload();
        $arr = $upload->getError(); // 上传错误信息

        $model = M("document");
        $model1 = M("user");
        $email = EMAIL;
        $uid = $model1->field("id")->where("email='$email'")->select();
        $arr = $model->create();
        if($info){
            $doc = $info['file']['savename'];
            $oldname = $info['file']['name'];
            $size = $info['file']['size'];
            $model->url = $doc;
            $model->uid = $uid[0]['id'];
            $model->oldname = $oldname;
            $model->size = $size;
        }
        $model->category = str_replace("category","",$arr['category']);
        $model->updatetime = date("Y-m-d H-i-s");

        $res = $model->where("id=$id")->save();
        if($res){
            $json = array(
                "code"  =>  1,
                "msg"   =>  "编辑成功"
            );
        }else{
            $json = array(
                "code"  =>  0,
                "msg"   =>  "编辑失败"
            );
        }

        echo json_encode($json);
    }

    public function detail(){

        $id = I("get.id");
        $model1 = M();
        $arr = $model1->table("am_document doc,am_documentcategory doca,am_user us")
            ->field("doc.id id,doc.name,doc.source,doc.oldname,doc.tag,doc.remarks,doca.name category,doca.id cid,doc.uploadtime,us.name username,us.id uid,doc.url,doc.size")
            ->where("doc.category=doca.id and doc.uid=us.id and doc.id='$id'")
            ->select();
        $this->assign("arr",$arr);
        $this->display();
    }

    public function download(){
        $id = I("get.id");
        $model = M("document");
        $url = $model->field("url")->where("id=$id")->select();
        //echo $url[0]['url'];
        redirect(DOCS_UPLOADURL.$url[0]['url']);
    }

    public function del(){
        $id = I("get.id");
        $model = M("document");
        $url = $model->field("url")->where("id=$id")->select();
        $res = $model->where("id=$id")->delete();
        unlink(DOCS_UPLOADURL.$url);
        if($res){
            $this->redirect("document/look");
        }else{
            $this->error("删除失败");
        }
    }

    public function deletemulti(){
        $id = $_POST;
        $data = array_values($id);
        $data = implode(',',$data);
        $model = M('document');

        $res = $model->delete($data);
        if($res){
            echo 1;
        }else{
            echo 0;
        }

    }
}
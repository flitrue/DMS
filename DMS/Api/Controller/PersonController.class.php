<?php

namespace Api\Controller;
use Think\Controller;

class PersonController extends CommonController{
    /**
     * 人员信息
     * (params) int 当前页
     * (params) unit 一页显示几条
     *
     * return 人员信息 当前页 下一页 上一页 总数 总页数
     */
    public function info(){
        $model = M('user');
        $pagenow = I('page')?I('page'):1 ;
        $unit = I("unit")? I("unit"): 20;

        $arr = $model->table("am_user a,am_depart b")->field("a.id,a.name,a.sex,b.name depart,a.position,a.address,a.email,a.status,a.entrytime")->page($pagenow, $unit)->where("a.depart=b.id and a.id>1")->select();

        // 除去管理员 -1
        $count = $model->count() -1;
        $num = $count/$unit < 1? 1: ceil($count/$unit);

        $prepage = $pagenow-1;
        $nextpage = $pagenow+1;
        $data = array(
            "info"          => $arr,
            "pagenow"       => $pagenow,
            "prepage"       => $prepage,
            "nextpage"      => $nextpage,
            "totol"         => $count,
            "num"           => $num
        );
        if($arr){
            $json = success($data, "获取人员信息成功");
            echo $json;
        }else{
            $json = failure([], "获取人员信息失败");
            echo $json;
        }
    }


    public function one(){
        $model = M("user");
        $id = I("uid");
        $arr = $model->table("am_user a,am_depart b")->field("a.id,a.name,a.sex,b.name depart,a.phone,a.brith,a.position,a.address,a.email,a.comment,a.status,a.entrytime")->where("a.depart=b.id and a.id=".$id)->select();
        if($arr){
            echo success($arr[0], "获取员工个人信息成功！");
        }else{
            echo failure([], "获取员工个人信息失败！");
        }
    }

    /**
     * 所有人员的姓名
     *
     * return 人员姓名 部门
     */
    public function name(){
        $model = M('depart');
        // 除去管理员 -1
        $departs = $model->select();
        $arr = $model->table("am_user a,am_depart b")->field("a.id,a.name,a.position,b.name as depart")->where("a.depart=b.id and a.id>1")->select();

        $data = [];
        for($j=0;$j<count($departs);$j++){
            $a = array(
                "id"        =>  $departs[$j]["id"],
                "name"    =>  $departs[$j]["name"],
                "children"  =>  []
            );
            for($i=0;$i<count($arr);$i++){
                if($arr[$i]['depart'] == $departs[$j]['name']){
                    $arr[$i]["name"] = $arr[$i]["name"] ." - ". $arr[$i]['position'];
                    array_push($a['children'], $arr[$i]);
                }
            }
            array_push($data, $a);
        }

        if($arr){
            $json = success($data, "获取人员姓名成功");
            echo $json;
        }else{
            $json = failure([], "获取人员姓名失败");
            echo $json;
        }
    }

    public function setHeader(){
        $uid = I("uid");
        $depart = I("depart");
        $model = M("depart");
        $res = $model->data(array( "header" => $uid))->where("id=".$depart)->save();
        if($res){
            echo success([], "设置部门负责人成功");
        }else{
            echo failure([], "设置部门负责人失败");
        }
    }

    /**
     * 我的下属
     *
     * return 下属信息
     */
    public function under(){
        $model = M("user");
        $uid = session("uid");
        $model1 = M("depart");
        $did = $model1->field("id")->where("header=".$uid)->select();
        $arr = $model->field("id,name,brith,sex,phone,comment,avatar,wordcloud,depart,position,address,idcard,group,email,status,entrytime")->where("depart=".$did[0]["id"]." and id>1 and id !=".$uid)->select();

        $json = success($arr, "获取下属信息成功");
        echo $json;
    }

    public function excel(){
        $model = M();

        $arr = $model->table("am_user a,am_depart b")->field("a.id,a.name,a.sex,b.name depart,a.position,a.address,a.email,a.status,a.entrytime")->where("a.depart=b.id and a.id>1")->select();

        if($arr){
            $data = array(
                "name"      =>"姓名",
                "email"     =>  "邮箱",
                "sex"       =>"性别",
                "depart"        =>  "部门",
                "position"      =>"职位",
                "status"        => "状态",
                "entrytime"     =>"入职时间"
            );
            array_unshift($arr, $data);
            $this->downloadExcel($arr, "员工信息表");
            //dump($arr);
        }
    }


    public function downloadExcel($result, $title){


        /** Error reporting */
        error_reporting(E_ALL);
        ini_set('display_errors', TRUE);
        ini_set('display_startup_errors', TRUE);

        if (PHP_SAPI == 'cli')
            die('This example should only be run from a Web Browser');

        /** Include PHPExcel */
        Vendor("PHPExcel.PHPExcel");


// Create new PHPExcel object
        $objPHPExcel = new \PHPExcel();

// Set document properties

        $objPHPExcel->getProperties()->setCreator("王平平")
            ->setLastModifiedBy("王平平")
            ->setTitle("")
            ->setSubject("")
            ->setDescription("")
            ->setKeywords("")
            ->setCategory("");


// Add some data

        for($i=0;$i<count($result);$i++){
            if($result[$i]["status"] == 1){
                $result[$i]["status"] = "在职";
            }elseif($result[$i]["status"] == 0){
                $result[$i]["status"] = "审核中";
            }elseif( $result[$i]["status"] == 2){
                $result[$i]["status"] = "离职";
            }
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.($i+1), $result[$i]["name"])
                ->setCellValue('B'.($i+1), $result[$i]["email"])
                ->setCellValue('C'.($i+1), $result[$i]["sex"])
                ->setCellValue('D'.($i+1), $result[$i]["depart"])
                ->setCellValue('E'.($i+1), $result[$i]["position"])
                ->setCellValue('F'.($i+1), $result[$i]["status"])
                ->setCellValue('G'.($i+1), $result[$i]["entrytime"]);
        }


// Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle($title);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename='.$title.".xlsx");
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }

    public function edit(){
        $uid = I("uid");
        $data["name"] = I("name");
        $data["brith"] = I("brith");
        $data["position"] = I("position");
        $data["comment"] = I("comment");
        $data["sex"] = I("sex");
        $data["email"] = I("email");
        $model = M("user");
        $model1 = M("depart");
        $depart = $model1->field("id")->where("name='".I("depart")."'")->select();
        $data["depart"] = $depart[0]["id"];
        $res = $model->data($data)->where("id=".$uid)->save();
        if($res){
            echo success([], "保存成功！");
        }else{
            echo failure($data, "保存失败");
        }
    }

    public function join(){
        $model = M("user");
        $arr1 = $model->field("entrytime as name, count(*) as value")->group("entrytime")->where("id>1")->select();
        $arr2 = $model->field("leavetime as name, count(*) as value")->group("leavetime")->where("id>1")->select();
        $startTime = $model->where("id>1")->max("entrytime");
        $endTime = date("Y-m-d");
        
        $data = array(
            "entry"      =>  $arr1,
            "leave"      => $arr2[0]['name']?$arr2: []
        );
        echo success($data, "获取入职离职情况成功！");
    }

    // 人员状态改变
    public function statusChange(){
        $model = M("user");

        if(I("uid") && I("status") != ""){

        }else{
            echo error([], "缺少uid和status参数");exit();
        }
        $data['id'] = I("uid");
        $data['status'] = I("status");
        $model->data($data)->save();
        echo success([], "员工状态修改成功");
    }

}

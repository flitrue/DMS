<?php

namespace Api\Controller;
use Think\Controller;

class DeviceController extends CommonController{
    // 管理员获取设备信息
    public function info(){
        $model = M("device");
        $arr = $model->select();
        $json = success($arr, "获取设备成功");

        echo $json;
    }

    // 普通人员获取设备信息
    public function infop(){
        $id = I("uid");
        $model = M();
        $sql = <<<EOF
        select a.id id,b.id tid,a.category,a.brand,a.tags,a.remarks,a.price,a.buytime,a.code,a.version,b.usetime
from am_device as a left join am_transfer as b on a.id=b.did where b.user=$id
EOF;


        $arr = $model->query($sql);
        $json = success($arr, "获取设备成功");

        echo $json;
    }

    // 由于添加、编辑设备信息需要上传图片，所以将添加设备的方法移动到FileController.class.php 下


    public function detail(){
        $did = I("did");
        $model = M();
        $sql = <<<EOF
        select a.id id,a.category,a.brand,a.tags,a.remarks,a.price,a.buytime,a.code,a.version,b.usetime,c.name user,c.id uid,d.name depart
from am_device as a left join am_transfer as b on a.id=b.did left join am_user as c on c.id=b.user left join am_depart as d 
on d.id=c.depart where a.id=$did
EOF;

        $arr = $model->query($sql);
        if($arr){
            $category = explode("/",$arr[0]['category']);
            $arr[0]['category'] = $category;
            $arr[0]['name'] =  $arr[0]['brand'].$category[0];
            $arr[0]['tags'] = explode("/",$arr[0]["tags"]);
            //$arr[0]["category"] = explode("/", $arr[0]["category"]);
            $arr[0]["remarks"] = html_entity_decode($arr[0]["remarks"]);
            echo success($arr[0], "获取该设备成功！");
        }else{
            echo failure([], "获取该设备失败!");
        }
    }


    public function del(){
        $did = I("did");
        $model = M("device");
        $res = $model->delete($did);
        echo successp($res, "删除设备成功！");
    }

    // 设备分配

    public function transfer(){
        $data["did"] = I("did");
        $data["user"] = I("uid");
        $data["transferor"] = session("uid");
        $data["remark"] = $data["transferor"]."将设备".$data["did"]."转让给了".I("user");
        $data["usetime"] = date("Y-m-d H:i:s");

        $model = M("transfer");
        $res = $model->field("id")->where("did=".I("did")." and user=".I("uid"))->select();
        if($res){
            echo failure([], "该设备已经分配给了".I("user"));exit;
        }
        $res = $model->data($data)->add();
        if($res){
            echo success($data, "设备转让成功！");
        }else{
            echo failure([], "设备转让失败！");
        }
    }

    public function excel(){
        $model = M("device");
        $arr = $model->select();
        $data = array(
            "id"      =>"设备ID",
            "category"     =>  "设备类型",
            "brand"     =>  "设备品牌",
            "version"     =>  "设备型号",
            "code"       =>"序列号",
            "price"        =>  "价格",
            "buytime"      =>"购买时间"
        );
        array_unshift($arr, $data);
        //dump($arr);
        $this->downloadExcel($arr, "设备信息表");
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

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.($i+1), $result[$i]["id"])
                ->setCellValue('B'.($i+1), $result[$i]["category"])
                ->setCellValue('C'.($i+1), $result[$i]["brand"])
                ->setCellValue('D'.($i+1), $result[$i]["version"])
                ->setCellValue('E'.($i+1), $result[$i]["code"])
                ->setCellValue('F'.($i+1), $result[$i]["price"])
                ->setCellValue('G'.($i+1), $result[$i]["buytime"]);
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

    // 设备退还
    public function giveBack(){
        $id = I("tid");
        $content = I("content");
        $model = M("transfer");
        $res = $model->delete($id);
        if($res){
            echo success([], "退还成功！");
        }
    }

}
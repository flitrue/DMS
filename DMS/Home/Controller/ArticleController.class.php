<?php
namespace Home\Controller;
use Think\Controller;
class ArticleController extends Controller {

    public function index(){
        $content = I("content");
        $this->assign("content",$content);
        $this->display();
    }

    public function test(){
        $content = I("content");
        $arr = array(
            "content"   =>  $content
        );
        echo json_encode($arr);
    }

    public function ueditup(){
        header("Content-Type: text/html; charset=utf-8");
        $editconfig = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents(COMMON_PATH."Conf/ueditconfig.json")), true);
        //dump($editconfig);
        $action = I('get.action');
        //echo $action;
        switch ($action) {
            case 'config':
                $result =  json_encode($editconfig);
                break;

            /* 上传图片 */
            case 'uploadimage':
                $result = $this->editup('img');
                break;
            /* 上传涂鸦 */
            case 'uploadscrawl':
                $result = $this->editup('img');
                break;
            case 'uploadvideo':
                $result = $this->editup('video');
                break;
            case 'uploadfile':
                $result = $this->editup('file');
                //$result = include("action_upload.php");
                break;

            /* 列出图片 */
            case 'listimage':
                $result = $this->editlist('listimg');
                break;
            /* 列出文件 */
            case 'listfile':
                $result = $this->editlist('listfile');
                break;

            /* 抓取远程文件 */
            case 'catchimage':
                //$result = include("action_crawler.php");
                break;

            default:
                $result = json_encode(array(
                    'state'=> '请求地址出错'
                ));
                break;
        }

        /* 输出结果 */
        if (isset($_GET["callback"])) {
            if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
                echo htmlspecialchars($_GET["callback"]) . '(' . $result . ')';
            } else {
                echo json_encode(array(
                    'state'=> 'callback参数不合法'
                ));
            }
        } else {
            echo $result;
        }

    }


    public function editup($uptype){


        $editconfig = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents(COMMON_PATH."Conf/ueditconfig.json")), true);
        $upload = new \Think\Upload();// 实例化上传类
        $upload->rootPath = './Public/Uploads/';
        $upload->saveName = time().rand(100000,999999);
        switch ($uptype) {
            case 'img':
                $upload->maxSize   =     $editconfig['imageMaxSize'];
                $upload->exts      =     explode('.', trim(join('',$editconfig['imageAllowFiles']),'.'));
                $upload->savePath = 'editor/image/';
                $info = $upload->uploadOne($_FILES[$editconfig['imageFieldName']]);
                break;
            case 'file':
                $upload->maxSize   =     $editconfig['fileMaxSize'];
                $upload->exts      =     explode('.', trim(join('',$editconfig['fileAllowFiles']),'.'));
                $upload->savePath = 'editor/file/';
                $info = $upload->uploadOne($_FILES[$editconfig['fileFieldName']]);
                break;
            case 'video':
                $upload->maxSize   =     $editconfig['videoMaxSize'];
                $upload->exts      =     explode('.', trim(join('',$editconfig['videoAllowFiles']),'.'));
                $upload->savePath = 'editor/video/';
                $info = $upload->uploadOne($_FILES[$editconfig['videoFieldName']]);
                break;
            default:
                return false;
                break;
        }

        if(!$info) {// 上传错误提示错误信息
            $_re_data['state'] = $upload->getError();
            $_re_data['url'] = '';
            $_re_data['title'] = '';
            $_re_data['original'] = '';
            $_re_data['type'] = '';
            $_re_data['size'] = '';
        }else{// 上传成功 获取上传文件信息
            $_re_data['state'] = "SUCCESS";
            $_re_data['url'] = "/Public/Uploads/".$info['savepath'].$info['savename'];
            $_re_data['title'] = $info['savename'];
            $_re_data['original'] = $info['name'];
            $_re_data['type'] = '.'.$info['ext'];
            $_re_data['size'] = $info['size'];
        }

        return json_encode($_re_data);

    }

    public function editlist($listtype){
        $editconfig = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents(COMMON_PATH."Conf/ueditconfig.json")), true);
        switch ($listtype) {
            case 'listimg':
                $allowFiles = $editconfig['imageManagerAllowFiles'];
                $listSize = $editconfig['imageManagerListSize'];
                $path = $editconfig['imageManagerListPath'];
                break;

            case 'listfile':
                $allowFiles = $editconfig['fileManagerAllowFiles'];
                $listSize = $editconfig['fileManagerListSize'];
                $path = $editconfig['fileManagerListPath'];
                break;

            default:
                return false;
                break;
        }
        /* 获取参数 */
        $size = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : $listSize;
        $start = isset($_GET['start']) ? htmlspecialchars($_GET['start']) : 0;
        $end = $start + $size;

        /* 获取文件列表 */
        $path = $_SERVER['DOCUMENT_ROOT'] . (substr($path, 0, 1) == "/" ? "":"/") . $path;

        $files = $this->getfiles($path, $allowFiles);

        if (!count($files)) {
            return json_encode(array(
                "state" => "no match file",
                "list" => array(),
                "start" => $start,
                "total" => count($files)
            ));
        }

        /* 获取指定范围的列表 */
        $len = count($files);
        for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--){
            $list[] = $files[$i];
        }
        //倒序
        //for ($i = $end, $list = array(); $i < $len && $i < $end; $i++){
        //    $list[] = $files[$i];
        //}

        /* 返回数据 */
        $result = json_encode(array(
            "state" => "SUCCESS",
            "list" => $list,
            "start" => $start,
            "total" => count($files)
        ));

        return $result;

    }


    /**
     * 遍历获取目录下的指定类型的文件
     * @param $path
     * @param array $files
     * @return array
     */
    public function getfiles($path, $allowFiles, &$files = array())
    {
        if (!is_dir($path)) return null;

        if(substr($path, strlen($path) - 1) != '/') $path .= '/';
        $handle = opendir($path);

        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..') {
                $path2 = $path . $file;
                if (is_dir($path2)) {
                    $this->getfiles($path2, $allowFiles, $files);
                } else {
                    //dump(pathinfo($file, PATHINFO_EXTENSION));	// 获取文件扩展名
                    if(in_array('.'.pathinfo($file, PATHINFO_EXTENSION), $allowFiles)){

                        $files[] = array(
                            'url'=> substr($path2, strlen($_SERVER['DOCUMENT_ROOT'])),
                            'mtime'=> filemtime($path2)
                        );
                    }
                }
            }
        }
        return $files;
    }

}

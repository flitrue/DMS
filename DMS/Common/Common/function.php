<?php

function success($data, $msg = "success"){
    $data = [
        'code'      => 0,
        'msg'       => $msg,
        'data'      => $data,
    ];
    return I("callback")."(".json_encode($data).")";
}

function successp($data, $msg = "success"){
    $data = [
        'code'      => 0,
        'msg'       => $msg,
        'data'      => $data,
    ];
    return json_encode($data);
}

function failure($data = [], $msg = "failure"){
    $data = [
        'code'      => 1,
        'msg'       => $msg,
        'data'      => $data,
    ];
    return I("callback")."(".json_encode($data).")";
}

function failurep($data = [], $msg = "failure"){
    $data = [
        'code'      => 1,
        'msg'       => $msg,
        'data'      => $data,
    ];
    return json_encode($data);
}

function unlogin($data = [], $msg = "您离开太久了，请重新登录！"){
    $data = [
        'code'      => 2,
        'msg'       => $msg,
        'data'      => $data,
    ];
    return I("callback")."(".json_encode($data).")";
}

function unloginp($data = [], $msg = "您离开太久了，请重新登录！"){
    $data = [
        'code'      => 2,
        'msg'       => $msg,
        'data'      => $data,
    ];
    return json_encode($data);
}

function error($data = [], $msg = "error"){
    $data = [
        'code'      => 3,
        'msg'       => $msg,
        'data'      => $data,
    ];
    return I("callback")."(".json_encode($data).")";
}
/**
 * 邮件发送函数
 */
function sendMail($to, $title, $content) {
    Vendor('PHPMailer.PHPMailerAutoload');
    $mail = new PHPMailer(); //实例化
    $mail->isSMTP(); // 启用SMTP
    $mail->Host= C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
    $mail->SMTPAuth = true; //启用smtp认证
    $mail->Username = C('MAIL_USERNAME'); //你的邮箱名
    $mail->Password = C('MAIL_PASSWORD') ; //邮箱密码
    $mail->Port = C('MAIL_PORT');
    $mail->CharSet = "UTF-8";
    //$mail->SMTPDebug = true;
    $mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
    $mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）

    $mail->addAddress($to);
    $mail->WordWrap = 50; //设置每行字符长度
    $mail->isHTML(true); // 是否HTML格式邮件
    $mail->Subject ="=?utf-8?B?" . base64_encode($title) . "?="; //邮件主题
    $mail->Body = $content; //邮件内容
    $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示

    /* $mail->setFrom('812863096@qq.com', 'Mailer');
     $mail->addAddress('1149489506@qq.com');     // Add a recipient
    */

    return $mail->send();
}

function loginKey(){
    $code = '0123456789';
    $arr1 = str_split($code);
    $num = 6;
    $arr2 =array();
    for($i=0;$i<$num;$i++){
        $arr2[$i] = $arr1[intval((rand(0,9)))];
    }
    $key = implode($arr2);
    return intval($key);
}

/**
 * 字符串截取，支持中文和其他编码
 * static
 * access public
 * @param string $str 需要转换的字符串
 * @param string $start 开始位置
 * @param string $length 截取长度
 * @param string $charset 编码格式
 * @param string $suffix 截断显示字符
 * return string
 */
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
    if(function_exists("mb_substr")){
        $slice = mb_substr($str, $start, $length, $charset);
        $strlen = mb_strlen($str,$charset);
    }elseif(function_exists('iconv_substr')){
        $slice = iconv_substr($str,$start,$length,$charset);
        $strlen = iconv_strlen($str,$charset);
    }else{
        $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
        $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
        $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
        $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
        preg_match_all($re[$charset], $str, $match);
        $slice = join("",array_slice($match[0], $start, $length));
        $strlen = count($match[0]);
    }
    if($suffix && $strlen>$length)$slice.='...';
    return $slice;
}

/**
 * 功能：生成二维码
 * @param string $qr_data   手机扫描后要跳转的网址
 * @param string $qr_level  默认纠错比例 分为L、M、Q、H四个等级，H代表最高纠错能力
 * @param string $qr_size   二维码图大小，1－10可选，数字越大图片尺寸越大
 * @param string $save_path 图片存储路径
 * @param string $save_prefix 图片名称前缀
 */
function createQRcode($save_path,$qr_data='PHP QR Code :)',$qr_level='L',$qr_size=4,$save_prefix='qrcode'){
    if(!isset($save_path)) return '';
    //设置生成png图片的路径
    $PNG_TEMP_DIR = & $save_path;
    //导入二维码核心程序
    Vendor('PHPQRcode.phpqrcode');  //注意这里的大小写哦，不然会出现找不到类，PHPQRcode是文件夹名字，phpqrcode就代表class.phpqrcode.php文件名
    //检测并创建生成文件夹
    if (!file_exists($PNG_TEMP_DIR)){
        mkdir($PNG_TEMP_DIR);
    }
    $filename = $PNG_TEMP_DIR.'test.png';
    $errorCorrectionLevel = 'L';
    if (isset($qr_level) && in_array($qr_level, array('L','M','Q','H'))){
        $errorCorrectionLevel = & $qr_level;
    }
    $matrixPointSize = 4;
    if (isset($qr_size)){
        $matrixPointSize = & min(max((int)$qr_size, 1), 10);
    }
    if (isset($qr_data)) {
        if (trim($qr_data) == ''){
            die('data cannot be empty!');
        }
        //生成文件名 文件路径+图片名字前缀+md5(名称)+.png
        $filename = $PNG_TEMP_DIR.$save_prefix.md5($qr_data.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
        //开始生成
        QRcode::png($qr_data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
    } else {
        //默认生成
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);
    }
    if(file_exists($PNG_TEMP_DIR.basename($filename)))
        return basename($filename);
    else
        return FALSE;
}


/*
*	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
*/
function saveimg(){

    $imagePath = ".".BIG_AVATARSURL;

    $allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
    $temp = explode(".", $_FILES["img"]["name"]);
    $extension = end($temp);

    //Check write Access to Directory

    if(!is_writable($imagePath)){
        $response = Array(
            "status" => 'error',
            "message" => 'Can`t upload File; no write Access'
        );
        return json_encode($response);
    }

    if ( in_array($extension, $allowedExts))
    {
        if ($_FILES["img"]["error"] > 0)
        {
            $response = array(
                "status" => 'error',
                "message" => 'ERROR Return Code: '. $_FILES["img"]["error"],
            );
        }
        else
        {

            $filename = $_FILES["img"]["tmp_name"];
            list($width, $height) = getimagesize( $filename );

            move_uploaded_file($filename,  $imagePath . $_FILES["img"]["name"]);
            $imagePath = trim($imagePath,".");

            $response = array(
                "status" => 'success',
                "url" => _ROOT.$imagePath.$_FILES["img"]["name"],
                "width" => $width,
                "height" => $height
            );
        }
    }
    else
    {
        $response = array(
            "status" => 'error',
            "message" => 'something went wrong, most likely file is to large for upload. check upload_max_filesize, post_max_size and memory_limit in you php.ini',
        );
    }
    return $response;
}
/*
*	!!! THIS IS JUST AN EXAMPLE !!!, PLEASE USE ImageMagick or some other quality image processing libraries
*/
function cropimg(){

    $imgUrl = $_POST['imgUrl'];
    $imgurl = str_replace(_ROOT,"",$imgUrl);
// original sizes
    $imgInitW = $_POST['imgInitW'];
    $imgInitH = $_POST['imgInitH'];
// resized sizes
    $imgW = $_POST['imgW'];
    $imgH = $_POST['imgH'];
// offsets
    $imgY1 = $_POST['imgY1'];
    $imgX1 = $_POST['imgX1'];
// crop box
    $cropW = $_POST['cropW'];
    $cropH = $_POST['cropH'];
// rotation angle
    $angle = $_POST['rotation'];

    $jpeg_quality = 100;

    $output_filename = ".".SMALL_AVATARSURL."croppedImg_".rand();

// uncomment line below to save the cropped image in the same location as the original image.
//$output_filename = dirname($imgUrl). "/croppedImg_".rand();

    $what = getimagesize($imgUrl);
    switch(strtolower($what['mime']))
    {
        case 'image/png':
            $img_r = imagecreatefrompng($imgUrl);
            $source_image = imagecreatefrompng($imgUrl);
            $type = '.png';
            break;
        case 'image/jpeg':
            $img_r = imagecreatefromjpeg($imgUrl);
            $source_image = imagecreatefromjpeg($imgUrl);
            error_log("jpg");
            $type = '.jpeg';
            break;
        case 'image/gif':
            $img_r = imagecreatefromgif($imgUrl);
            $source_image = imagecreatefromgif($imgUrl);
            $type = '.gif';
            break;
        default: die('image type not supported');
    }

//Check write Access to Directory

    if(!is_writable(dirname($output_filename))){
        $response = Array(
            "status" => 'error',
            "message" => 'Can`t write cropped File'
        );
    }else{

        // resize the original image to size of editor
        $resizedImage = imagecreatetruecolor($imgW, $imgH);
        imagecopyresampled($resizedImage, $source_image, 0, 0, 0, 0, $imgW, $imgH, $imgInitW, $imgInitH);
        // rotate the rezized image
        $rotated_image = imagerotate($resizedImage, -$angle, 0);
        // find new width & height of rotated image
        $rotated_width = imagesx($rotated_image);
        $rotated_height = imagesy($rotated_image);
        // diff between rotated & original sizes
        $dx = $rotated_width - $imgW;
        $dy = $rotated_height - $imgH;
        // crop rotated image to fit into original rezized rectangle
        $cropped_rotated_image = imagecreatetruecolor($imgW, $imgH);
        imagecolortransparent($cropped_rotated_image, imagecolorallocate($cropped_rotated_image, 0, 0, 0));
        imagecopyresampled($cropped_rotated_image, $rotated_image, 0, 0, $dx / 2, $dy / 2, $imgW, $imgH, $imgW, $imgH);
        // crop image into selected area
        $final_image = imagecreatetruecolor($cropW, $cropH);
        imagecolortransparent($final_image, imagecolorallocate($final_image, 0, 0, 0));
        imagecopyresampled($final_image, $cropped_rotated_image, 0, 0, $imgX1, $imgY1, $cropW, $cropH, $cropW, $cropH);
        // finally output png image
        //imagepng($final_image, $output_filename.$type, $png_quality);
        imagejpeg($final_image, $output_filename.$type, $jpeg_quality);
        $response = Array(
            "status" => 'success',
            "url" => trim($output_filename,".").$type
        );
    }
    return $response;
}


function checkBrower(){
    $user_agent = $_SERVER["HTTP_USER_AGENT"];
    if(preg_match("/Opera/",$user_agent)){
        $brower = "Opera";
    }elseif(preg_match("/Edge/",$user_agent)){
        $brower = "Edge";
    }elseif(preg_match("/Chrome/",$user_agent)){
        $brower = "Chrome";
    }elseif(preg_match("/Firefox/",$user_agent)){
        $brower = "Firefox";
    }elseif(preg_match("/MSIE/",$user_agent)) {
        $brower = "IE";
    }elseif(preg_match("/Opera/",$user_agent)) {
        $brower = "Opera";
    }elseif(preg_match("/Safari/",$user_agent)) {
        $brower = "Safari";
    }else {
        $brower = "其他";
    }
    return $brower;

}


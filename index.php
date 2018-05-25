<?php

// 应用入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',true);
//define('BIND_MODULE','Home');   //指定默认的访问模块是home
// 定义应用目录
define('APP_PATH','./DMS/');        // 站点目录
define("SITE_URL", "/");
define('JS_URL',SITE_URL.'Public/assets/js/');     // js目录
define('MYJS_URL',SITE_URL.'Public/Js/');     // myjs目录
define('MYCSS_URL',SITE_URL.'Public/Css/');     // myjs目录
define('CSS_URL',SITE_URL.'Public/assets/css/');   // 样式目录
define('ASSETS_URL',SITE_URL.'Public/assets/');   // assets目录
define('IMAGE_URL',SITE_URL.'Public/assets/images/');   // 图片资源目录
define('IMAGE_UPLOADURL',SITE_URL.'Public/Uploads/');   // 上传图片资源目录
define("UEDITOR_URL", SITE_URL."Public/Ueditor/");   //Ueditor路径
define('SMALL_AVATARSURL',SITE_URL.'Public/assets/avatars/');   // 用户小头像图片资源目录
define('BIG_AVATARSURL',SITE_URL.'Public/Uploads/big_avatars/');   // 用户大头像目录
define('ALBUM_UPLOADURL',SITE_URL.'Public/Uploads/album/');   // 相册上传的路径
define('GALLERY_UPLOADURL',SITE_URL.'Public/Uploads/album/gallery/');   // 相片上传的路径
define('DOCS_UPLOADURL',SITE_URL.'Public/Uploads/docs/');   // 文档上传的路径
if($_SERVER['HTTP_HOST']){
    $ip = $_SERVER['HTTP_HOST'];
}else{
    $ip = $_SERVER['SERVER_ADDR'];
}

if($_SERVER['SERVER_PORT'] == '80' || $_SERVER['SERVER_PORT'] == '443'){
    $port = '';
}else{
    $port = ":".$_SERVER['SERVER_PORT'];
}
//define("_ROOT", $_SERVER["REQUEST_SCHEME"]."://".$_SERVER['SERVER_NAME']);
define("_ROOT", $_SERVER["REQUEST_SCHEME"]."://".$ip.$port);

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

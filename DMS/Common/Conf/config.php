<?php
return array(
	//'配置项'=>'配置值'
    'URL_MODEL'             =>  2,
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式
    'URL_CASE_INSENSITIVE'  =>  true, // url大小写敏感 true为不敏感
    'SHOW_PAGE_TRACE'       =>  false,
    // 错误信息提示
    'SHOW_ERROR_MSG'        =>  true,
    //'ERROR_MESSAGE'         =>  '发生错误!',
    //'ERROR_PAGE'            =>  "/",

    //'URL_ROUTER_ON'         => true, //  是否开启 URL 路由
    //'URL_ROUTE_RULES'       => array(), //  默认路由规则 针对模块
    //'URL_MAP_RULES' => array(), // URL 映射定义规则

    'TMPL_ENGINE_TYPE'      =>  'Think',


    /* 数据库设置 */
    'DB_TYPE'               =>  'mysqli',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'assetmanage',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  'flitrue@2017',           // 密码
    'DB_PORT'               =>  '20511',        // 端口
    'DB_PREFIX'             =>  'am_',    // 数据库表前缀
    'DB_FIELDTYPE_CHECK'    =>  false,       // 是否进行字段类型检查
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8,
    'LANG_SWITCH_ON'        =>  true,   // 开启语言包功能
    'DATA_CACHE_COMPRESS'   => true, //  数据缓存是否压缩缓存

    // 邮箱配置项
    'MAIL_HOST'             =>  'smtp.126.com',
    'MAIL_SMTPAUTH'         =>  true,
    'MAIL_USERNAME'         =>  'wenxuan045@126.com',
    'MAIL_PASSWORD'         =>  '15735926271lulu',
    'MAIL_PORT'             =>  25,
    'MAIL_FROM'             =>  'wenxuan045@126.com',
    'MAIL_FROMNAME'         =>  '企业信息管理系统',
    'MAIL_ISHTML'           =>  true,
    'MAILCHARSET'           =>  "UTF-8",


    // 模版布局
    'LAYOUT_ON'=>true,
    'LAYOUT_NAME'=>'layout',

    // 日志记录
    'LOG_MAIL'              =>  '812863096@qq.com',

    // 表单令牌
    'TOKEN_ON'              =>  true,
    'TOKEN_NAME'            => '__hash',
    'TOKEN_TYPE'            =>  'md5',
    'TOKEN_RESET'           =>  true,//令牌验证出错后是否重置令牌，默认为true

    // 修改密码发送邮件

    'PWD_TITLE'             =>  '您的密码已修改',
    'PWD_CONTENT1'          =>  '提醒您，您的密码修改为',
    'PWD_CONTENT2'          =>  ',下次请使用新密码登陆。',
    'DEFAULT_AVATAR'        =>  'avatar.png'

);

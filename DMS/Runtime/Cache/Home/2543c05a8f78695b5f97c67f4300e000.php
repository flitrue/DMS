<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title><?php echo (L("APP_NAME")); ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Page-Enter" content="revealTrans(duration=10, transition=8)">
    <meta http-equiv="Page-Exit" content="revealTrans(duration=10, transition=20)">
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="bookmark" href="/favicon.ico"/>
    <!-- basic styles -->
    <link href="<?php echo (CSS_URL); ?>bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>font-awesome.min.css" />

    <!--[if IE 7]-->
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>font-awesome-ie7.min.css" />
    <!--[endif]-->

    <!-- page specific plugin styles -->
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>bootstrapValidator.min.css" />
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>colorbox.css" />
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>dropzone.css" />
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>croppic.css" />


    <!--fonts-->
    <style>
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 300;
            src: local('Open Sans Light'), local('OpenSans-Light'), url(<?php echo (ASSETS_URL); ?>font/DXI1ORHCpsQm3Vp6mXoaTegdm0LZdjqr5-oayXSOefg.woff2) format('woff2');
        }
        @font-face {
            font-family: 'Open Sans';
            font-style: normal;
            font-weight: 400;
            src: local('Open Sans'), local('OpenSans'), url(<?php echo (ASSETS_URL); ?>font/cJZKeOuBrn4kERxqtaUH3VtXRa8TVwTICgirnJhmVJw.woff2) format('woff2');
        }

    </style>
    <!-- 打印 -->
    <style>
        @media print {
            .noprint {
                display: none;
            }
        }

    </style>
    <!-- 相册 相片提示信息-->
    <style>
        .copy-tips{position:fixed;z-index:999;bottom:50%;left:50%;margin:0 0 -20px -80px;background-color:rgba(0, 0, 0, 0.2);filter:progid:DXImageTransform.Microsoft.Gradient(startColorstr=#30000000, endColorstr=#30000000);padding:6px;}
        .copy-tips-wrap{padding:10px 20px;text-align:center;border:1px solid #F4D9A6;background-color:#FFFDEE;font-size:14px;}

        #preimg:hover{
            border: solid 2px lightgrey;
            cursor: pointer;
        }
    </style>

    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>jquery-ui-1.10.3.full.min.css" />
    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo (MYCSS_URL); ?>style.css"/>
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>ace.min.css"/>

    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>ace-rtl.min.css"/>
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>ace-skins.min.css"/>

    <!--[if lte IE 8]-->
    <link rel="stylesheet" href="<?php echo (CSS_URL); ?>ace-ie.min.css" />
    <!--[endif]-->

    <!-- inline styles related to this page -->
    <style>
        .table th, .table td {
            text-align: center;
        }
        .huandeng{
            width: 90%;
            height: auto;
        }
    </style>
    <!-- ace settings handler -->

    <script src="<?php echo (JS_URL); ?>ace-extra.min.js"></script>

    <!-- 大搜索框样式 -->
    <style>

        body,
        input {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        .searchcontainer { margin: 4px auto 40px auto; width: 800px; text-align: center; }

        #searchinput{
            font-size: 13px;
            min-height: 32px;
            margin: 0;
            padding: 7px 8px;
            outline: none;
            color: #333;
            background-color: #fff;
            background-repeat: no-repeat;
            background-position: right center;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.075);
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            transition: all 0.15s ease-in;
            -webkit-transition: all 0.15s ease-in 0;
            vertical-align: middle;
        }
        .searchbutton {
            position: relative;
            display: inline-block;
            margin: 0;
            padding: 8px 15px;
            font-size: 13px;
            font-weight: bold;
            color: #333;
            text-shadow: 0 1px 0 rgba(255,255,255,0.9);
            white-space: nowrap;
            background-color: #eaeaea;
            background-image: -moz-linear-gradient(#fafafa, #eaeaea);
            background-image: -webkit-linear-gradient(#fafafa, #eaeaea);
            background-image: linear-gradient(#fafafa, #eaeaea);
            background-repeat: repeat-x;
            border-radius: 3px;
            border: 1px solid #ddd;
            border-bottom-color: #c5c5c5;
            box-shadow: 0 1px 3px rgba(0,0,0,.05);
            vertical-align: middle;
            cursor: pointer;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-appearance: none;
        }
        .searchbutton:hover,
        .searchbutton:active {
            background-position: 0 -15px;
            border-color: #ccc #ccc #b5b5b5;
        }
        .searchbutton:active {
            background-color: #dadada;
            border-color: #b5b5b5;
            background-image: none;
            box-shadow: inset 0 3px 5px rgba(0,0,0,.15);
        }
        .searchbutton:focus,
        #searchinput:focus {
            outline: none;
            border-color: #51a7e8;
            box-shadow: inset 0 1px 2px rgba(0,0,0,.075), 0 0 5px rgba(81,167,232,.5);
        }


        #search label {
            font-weight: 200;
            padding: 5px 0;
        }
        #search input[type=text] {
            font-size: 18px;
            width: 605px;
        }
        #search .searchbutton {
            padding: 10px;
            width: 90px;
        }
    </style>


</head>

<body>
<div class="navbar navbar-default noprint" id="navbar">
    <script type="text/javascript">
        try{ace.settings.check('navbar' , 'fixed')}catch(e){}
    </script>

    <div class="navbar-container" id="navbar-container">
        <div class="navbar-header pull-left">
            <a href="/" class="navbar-brand">
                <small>
                    <img src="/favicon.ico" width="25px" height="25px"/>
                    <?php echo (L("APP_NAME")); ?>
                </small>
            </a><!-- /.brand -->
        </div><!-- /.navbar-header -->

        <div class="navbar-header pull-right" role="navigation">
            <ul class="nav ace-nav">

                <!--<li class="green">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="icon-envelope icon-animated-vertical"></i>
                        <span class="badge badge-success">5</span>
                    </a>

                    <ul class="pull-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <li class="dropdown-header">
                            <i class="icon-envelope-alt"></i>
                            5条消息
                        </li>

                        <li>
                            <a href="#">
                                <img src="<?php echo (ASSETS_URL); ?>avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
                                <span class="msg-body">
											<span class="msg-title">
												<span class="blue">王平平:</span>
												嗨 ...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>1分钟以前</span>
											</span>
										</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <img src="<?php echo (ASSETS_URL); ?>avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
                                <span class="msg-body">
											<span class="msg-title">
												<span class="blue">吴威:</span>
												不知道...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>20分钟以前</span>
											</span>
										</span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <img src="<?php echo (ASSETS_URL); ?>avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
                                <span class="msg-body">
											<span class="msg-title">
												<span class="blue">许小平:</span>
												什么鬼 ...
											</span>

											<span class="msg-time">
												<i class="icon-time"></i>
												<span>下午3:15</span>
											</span>
										</span>
                            </a>
                        </li>

                        <li>
                            <a href="inbox.html">
                                查看所有消息
                                <i class="icon-arrow-right"></i>
                            </a>
                        </li>
                    </ul>
                </li>-->

                <li class="light-blue">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="<?php echo (_ROOT); echo (cookie('dms_avatar')); ?>" onerror="javascript:this.src='<?php echo (ASSETS_URL); ?>images/avatar.png'" alt="avatar"/>
                        <span class="user-info">
									<small><?php echo (L("WELCOME")); ?>,</small>
									<?php echo (cookie('dms_name')); ?>
								</span>

                        <i class="icon-caret-down"></i>
                    </a>

                    <ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li class="needhidden" >
                            <a href="<?php echo U('index/setting');?>">
                                <i class="icon-cog"></i>
                                <?php echo (L("SETTING")); ?>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo U('index/profile');?>">
                                <i class="icon-user"></i>
                                <?php echo (L("PROFILE")); ?>
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="<?php echo U('login/exitsys');?>">
                                <i class="icon-off"></i>
                                <?php echo (L("EXIT")); ?>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul><!-- /.ace-nav -->
        </div><!-- /.navbar-header -->
    </div><!-- /.container -->
</div>
<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>

    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>

<div class="sidebar noprint" id="sidebar">
    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
    </script>

   <!-- <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <a href="<?php echo U('index/index');?>" class="btn btn-success" title="<?php echo (L("Console")); ?>">
                <i class="icon-home"></i>
            </a>

            <a href="<?php echo U('device/look');?>" class="btn btn-info" title="设备列表">
                <i class="icon-desktop"></i>
            </a>

            <a href="<?php echo U('staff/look');?>" class="btn btn-warning" title="员工列表">
                <i class="icon-group"></i>
            </a>

            <a href="<?php echo U('index/profile');?>" class="btn btn-danger" title="个人资料">
                <i class="icon-user"></i>
            </a>
        </div>

    </div>-->
    <!-- #sidebar-shortcuts -->

    <ul id="nav" class="nav nav-list">
        <li >
            <a href="<?php echo U('index/index');?>">
                <i class="icon-home"></i>
                <span class="menu-text"><?php echo L('Console');?></span>
            </a>
        </li>

        <li>
            <a href="<?php echo U('staff/look');?>" class="dropdown-toggle">
                <i class="icon-text-width"></i>
                <span class="menu-text">员工管理</span>
            </a>
        </li>

        <li>
            <a href="<?php echo U('device/look');?>" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text">设备管理</span>
            </a>
        </li>

        <li>
            <a href="<?php echo U('asset/depart');?>" class="dropdown-toggle">
                <i class="icon-list"></i>
                <span class="menu-text">资产统计</span>
            </a>
        </li>


        <!--<li>
            <a href="#" class="dropdown-toggle">
                <i class="icon-list"></i>
                <span class="menu-text"> 资产统计 </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">

                <li>
                    <a href="<?php echo U('asset/depart');?>">
                        <i class="icon-double-angle-right"></i>
                        部门资产
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('asset/group');?>">
                        <i class="icon-double-angle-right"></i>
                        小组资产
                    </a>
                </li>

            </ul>
        </li>-->

        <!--<li>
            <a href="#" class="dropdown-toggle">
                <i class="icon-list"></i>
                <span class="menu-text"> <?php echo L('LOGMAG');?> </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">

                <li>
                    <a href="<?php echo U('log/look');?>">
                        <i class="icon-double-angle-right"></i>
                        <?php echo L('LOOKLOG');?>
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('log/add');?>">
                        <i class="icon-double-angle-right"></i>
                        <?php echo L('ADDLOG');?>
                    </a>
                </li>

            </ul>
        </li>
-->

        <!--<li>
            <a href="<?php echo U('index/search');?>">
                <i class="icon-search"></i>

                <span class="menu-text">
							<?php echo L('SEARCH');?>
						</span>
            </a>
        </li>-->

        <li class="needhidden">
            <a href="<?php echo U('patent/look');?>" class="dropdown-toggle">
                <i class="icon-trophy"></i>
                <span class="menu-text">专利管理</span>
            </a>
        </li>

        <li>
            <a href="<?php echo U('document/look');?>" class="dropdown-toggle">
                <i class="icon-book"></i>
                <span class="menu-text">文档管理</span>
            </a>
        </li>

        <li>
            <a href="<?php echo U('album/gallery');?>">
                <i class="icon-picture"></i>
                <span class="menu-text"> <?php echo L('MEDIAMEG');?> </span>
            </a>
        </li>

        <li>
            <a href="https://misc.stockemotion.com">
                <i class=" icon-external-link"></i>
                <span class="menu-text"> 股市综合榜 </span>
            </a>
        </li>
        <!--<li>
            <a href="#" class="dropdown-toggle">
                <i class="icon-desktop"></i>
                <span class="menu-text"> 其他页面 </span>

                <b class="arrow icon-angle-down"></b>
            </a>

            <ul class="submenu">

                <li>
                    <a href="<?php echo U('index/addlog');?>">
                        <i class="icon-double-angle-right"></i>
                        addlog.html
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('index/blank');?>">
                        <i class="icon-double-angle-right"></i>
                        blank.html
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('index/form-wizard');?>">
                        <i class="icon-double-angle-right"></i>
                        form-wizard.html
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('index/inbox');?>">
                        <i class="icon-double-angle-right"></i>
                        inbox.html
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('index/jqgrid');?>">
                        <i class="icon-double-angle-right"></i>
                        jqgrid.html
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('index/tables');?>">
                        <i class="icon-double-angle-right"></i>
                        tables.html
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('index/timeline');?>">
                        <i class="icon-double-angle-right"></i>
                        timeline.html
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('index/typography');?>">
                        <i class="icon-double-angle-right"></i>
                        typography.html
                    </a>
                </li>

                <li>
                    <a href="<?php echo U('test/index');?>">
                        <i class="icon-double-angle-right"></i>
                        test.html
                    </a>
                </li>

            </ul>

        </li>-->


    </ul><!-- /.nav-list -->

    <div class="sidebar-collapse" id="sidebar-collapse">
        <i class="icon-double-angle-left" data-icon1="icon-double-angle-left" data-icon2="icon-double-angle-right"></i>
    </div>

    <script type="text/javascript">
        try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
    </script>
</div>
<div class="ace-settings-container noprint" id="ace-settings-container">
    <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
        <i class="icon-cog bigger-150"></i>
    </div>

    <div class="ace-settings-box" id="ace-settings-box">
        <div>
            <div class="pull-left">
                <select id="skin-colorpicker" class="hide">
                    <option data-skin="default" value="#438EB9">#438EB9</option>
                    <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                    <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                    <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                </select>
            </div>
            <span>&nbsp; 选择皮肤</span>
        </div>

        <div>
            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-navbar" />
            <label class="lbl" for="ace-settings-navbar"> 固定导航条</label>
        </div>

        <div>
            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-sidebar" />
            <label class="lbl" for="ace-settings-sidebar"> 固定滑动条</label>
        </div>

        <div>
            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-breadcrumbs" />
            <label class="lbl" for="ace-settings-breadcrumbs">固定面包屑</label>
        </div>

        <div>
            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" />
            <label class="lbl" for="ace-settings-rtl">切换到左边</label>
        </div>

        <div>
            <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-add-container" />
            <label class="lbl" for="ace-settings-add-container">
                切换窄屏
                <b></b>
            </label>
        </div>
    </div>
</div><!-- /#ace-settings-container -->

<div class="main-content">
    <div class="breadcrumbs" id="breadcrumbs">
        <script type="text/javascript">
            try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
        </script>

        <ul class="breadcrumb">
            <li>
                <i class="icon-home home-icon"></i>
                <a href="<?php echo U('index/index');?>"><?php echo (L("HOME")); ?></a>
            </li>

            <li class="active">设置</li>
        </ul><!-- .breadcrumb -->

        <!--<div class="nav-search" id="nav-search">
            <form class="form-search">
                <span class="input-icon">
                    <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                    <i class="icon-search nav-search-icon"></i>
                </span>
            </form>
        </div>-->
        <!-- #nav-search -->
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="tabbable">
                    <ul class="nav nav-tabs padding-18">

                    <li class="active">
                        <a data-toggle="tab" href="#loginbg-box">
                            <i class="info icon-picture bigger-120"></i>
                            登录背景
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#huandengpian-box">
                            <i class="info icon-anchor bigger-120"></i>
                            幻灯片设置
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#admin-box">
                            <i class="info icon-wrench bigger-120"></i>
                            设置管理员
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#depart-box">
                            <i class="info icon-circle"></i>
                            部门类别
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#group-box">
                            <i class="info icon-bolt"></i>
                            小组类别
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#patent-box">
                            <i class="info icon-trophy bigger-120"></i>
                            专利类别
                        </a>
                    </li>

                    </ul>
                </div>

                <div class="tab-content no-border padding-24">

                        <div id="loginbg-box" class="tab-pane in active">
                            <div class="space-4"></div>
                            <form id="loginbg-form" action="" method="post" >
                                <div class="col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" >首页图片</label>

                                    <div class="col-sm-5">
                                        <div class="form-group ">
                                            <span>请上传500*300的图片</span>
                                            <input type="file" name="loginbg" id="id-input-file-2" />
                                        </div>
                                        <button class="btn btn-info" type="button" onclick="loginbgupload()">
                                            <i class="icon-ok bigger-110"></i>
                                            <?php echo (L("SAVE")); ?>
                                        </button>
                                    </div>

                                    <div class="col-sm-5">
                                        <img id="loginbg" src="<?php echo ($loginbg); ?>" title="首页图片">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="huandengpian-box" class="tab-pane">
                            <form id="slide-form" action="" method="post" enctype="multipart/form-data">
                                <div class="form-group col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" >第一张图片</label>

                                    <div class="col-sm-5">

                                        <span>请上传1000*350的图片</span>
                                        <input type="file" name="url1" id="id-input-file-3" />
                                    </div>

                                </div>
                                <div class="form-group col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" >第二张图片</label>

                                    <div class="col-sm-5">
                                        <span>请上传1000*350的图片</span>
                                        <input type="file" name="url2" id="id-input-file-4" />
                                    </div>

                                </div>
                                <div class="form-group col-xs-12">
                                    <label class="col-sm-1 control-label no-padding-right" >第三张图片</label>

                                    <div class="col-sm-5">
                                        <span>请上传1000*350的图片</span>
                                        <input type="file" name="url3" id="id-input-file-5" />
                                    </div>

                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-1 col-xs-9">
                                        <div class="col-xs-2">
                                            <button class="btn btn-info" type="button" onclick="slideupload()">
                                                <i class="icon-ok bigger-110"></i>
                                                <?php echo (L("SAVE")); ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div id="admin-box" class="tab-pane">
                            <div class="row">
                                <form id="addadmin-form" action="">
                                    <div class="space-4"></div>
                                    <div class="col-sm-1"></div>
                                    <div class="col-sm-9">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <select name="admin" id="admin" style="width:100%;">
                                                        <option value="">请选择一名员工</option>
                                                        <?php if(is_array($user)): $i = 0; $__LIST__ = $user;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["id"]); ?>"><?php echo ($vol["name"]); ?>(<?php echo ($vol["email"]); ?>)</option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                                    <div class="space-16"></div>
                                                    <button class="btn btn-info" type="button" onclick="addadmin()">
                                                        <i class="icon-ok bigger-110"></i>
                                                        <?php echo (L("SAVE")); ?>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div id="admin-table" class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>姓名</th>
                                                        <th>邮箱</th>
                                                        <th>操作</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php if(is_array($admin)): $i = 0; $__LIST__ = $admin;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
                                                            <td><nobr><?php echo ($vol["name"]); ?></nobr></td>
                                                            <td><nobr><?php echo ($vol["email"]); ?></nobr></td>
                                                            <td>
                                                                <nobr>
                                                                    <a href="<?php echo U('index/admin_del');?>&id=<?php echo ($vol["id"]); ?>" class="btn btn-info btn-xs btn-danger bootbox-confirm">
                                                                        <i class="icon-trash bigger-120"></i>
                                                                    </a>
                                                                    <a href="<?php echo U('staff/detail');?>&uid=<?php echo ($vol["id"]); ?>" class="btn btn-xs btn-warning" title="查看详细信息">
                                                                        <i class="icon-eye-open bigger-120"></i>
                                                                    </a>
                                                                </nobr>
                                                            </td>
                                                        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                    </div>
                        <div id="depart-box" class="tab-pane">
                        <form method="post" id="depart-form">
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" >部门类别</label>

                                <div class="col-sm-9">
                                    <div class="col-sm-6">
                                        <input type="text" name="depart">
                                        <div class="space-16"></div>
                                        <button class="btn btn-info" type="button" onclick="departsave()">
                                            <i class="icon-ok bigger-110"></i>
                                            <?php echo (L("SAVE")); ?>
                                        </button>
                                    </div>
                                    <div id="depart-table" class="table-responsive col-sm-6">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>名称</th>
                                                <th>员工数</th>
                                                <th>设备数</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if(is_array($depart)): $i = 0; $__LIST__ = $depart;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
                                                    <td><?php echo ($vol["name"]); ?></td>
                                                    <td><?php echo ($vol["membercount"]); ?></td>
                                                    <td><?php echo ($vol["devicecount"]); ?></td>
                                                    <td>
                                                        <a href="<?php echo U('index/depart_del');?>&id=<?php echo ($vol["id"]); ?>" class="btn btn-info btn-xs btn-danger bootbox-confirm">
                                                            <i class="icon-trash bigger-120"></i>
                                                        </a>
                                                    </td>
                                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                        <div id="group-box" class="tab-pane">
                            <form method="post" id="group-form">
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" >小组类别</label>

                                <div class="col-sm-9">
                                    <div class="col-sm-6">
                                        <input type="text" name="group">
                                        <div class="space-16"></div>
                                        <button class="btn btn-info" type="button" onclick="groupsave()">
                                            <i class="icon-ok bigger-110"></i>
                                            <?php echo (L("SAVE")); ?>
                                        </button>
                                    </div>
                                    <div id="group-table" class="table-responsive col-sm-6">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>名称</th>
                                                <th>员工数</th>
                                                <th>设备数</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if(is_array($group)): $i = 0; $__LIST__ = $group;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
                                                    <td><?php echo ($vol["name"]); ?></td>
                                                    <td><?php echo ($vol["membercount"]); ?></td>
                                                    <td><?php echo ($vol["devicecount"]); ?></td>
                                                    <td>
                                                        <a href="<?php echo U('index/group_del');?>&id=<?php echo ($vol["id"]); ?>" class="btn btn-info btn-xs btn-danger bootbox-confirm">
                                                            <i class="icon-trash bigger-120"></i>
                                                        </a>
                                                    </td>
                                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </form>
                        </div>
                        <div id="patent-box" class="tab-pane">
                        <form method="post" id="patent-form">
                            <div class="space-4"></div>

                            <div class="form-group">
                                <label class="col-sm-1 control-label no-padding-right" >专利类别</label>

                                <div class="col-sm-9">
                                    <div class="col-sm-6">
                                        <input type="text" name="patent">
                                        <div class="space-16"></div>
                                        <button class="btn btn-info" type="button" onclick="patentsave()">
                                            <i class="icon-ok bigger-110"></i>
                                            <?php echo (L("SAVE")); ?>
                                        </button>
                                    </div>
                                    <div id="patent-table" class="table-responsive col-sm-6">
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                            <tr>
                                                <th>名称</th>
                                                <th>数量</th>
                                                <th>操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php if(is_array($category)): $i = 0; $__LIST__ = $category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
                                                    <td><?php echo ($vol["name"]); ?></td>
                                                    <td><?php echo ($vol["count"]); ?></td>
                                                    <td>
                                                        <a href="<?php echo U('index/setting_del');?>&id=<?php echo ($vol["id"]); ?>" class="btn btn-info btn-xs btn-danger bootbox-confirm">
                                                            <i class="icon-trash bigger-120"></i>
                                                        </a>
                                                    </td>
                                                </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->
</div><!-- /.main-content -->

</div><!-- /.main-container-inner -->

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
    <i class="icon-double-angle-up icon-only bigger-110"></i>
</a>
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->

<script src="<?php echo (JS_URL); ?>jquery-2.0.3.min.js"></script>

<!-- <![endif]-->



<script type="text/javascript">
    if("ontouchend" in document) document.write("<script src='<?php echo (JS_URL); ?>jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>

<script src="<?php echo (JS_URL); ?>bootstrap.min.js"></script>
<script src="<?php echo (JS_URL); ?>typeahead-bs2.min.js"></script>

<!-- page specific plugin scripts -->
<script src="<?php echo (JS_URL); ?>dropzone.min.js"></script>

<!-- ace scripts -->

<script src="<?php echo (JS_URL); ?>ace-elements.min.js"></script>
<script src="<?php echo (JS_URL); ?>ace.min.js"></script>
<script>
    var power = "<?php echo (session('power')); ?>";
    function checkpower(){
        if(power.trim() == "0"){
            alert("您不是管理员");
            exit;
        }
    }
    if(power.trim() == "0"){
        $(".needhidden").remove();
    }
</script>

<!-- inline scripts related to this page -->
<script>

    $('#id-input-file-2').ace_file_input({
        no_file:'No File ...',
        btn_choose:'Choose',
        btn_change:'Change',
        droppable:false,
        onchange:null,
        icon_remove: "",
        thumbnail:true, //| true | large
        whitelist:'gif|png|jpg|jpeg',
        blacklist:'exe|php',
        //onchange:''
        //
    });

    $('#id-input-file-3').ace_file_input({
        no_file:'No File ...',
        btn_choose:'Choose',
        btn_change:'Change',
        droppable:false,
        onchange:null,
        icon_remove: "",
        thumbnail:true, //| true | large
        whitelist:'gif|png|jpg|jpeg',
        blacklist:'exe|php',
        //onchange:''
        //
    });

    $('#id-input-file-4').ace_file_input({
        no_file:'No File ...',
        btn_choose:'Choose',
        btn_change:'Change',
        droppable:false,
        onchange:null,
        icon_remove: "",
        thumbnail:true, //| true | large
        whitelist:'gif|png|jpg|jpeg',
        blacklist:'exe|php',
        //onchange:''
        //
    });

    $('#id-input-file-5').ace_file_input({
        no_file:'No File ...',
        btn_choose:'Choose',
        btn_change:'Change',
        droppable:false,
        onchange:null,
        icon_remove: "",
        thumbnail:true, //| true | large
        whitelist:'gif|png|jpg|jpeg',
        blacklist:'exe|php',
        //onchange:''
        //
    });

    function loginbgupload(){
        var data = new FormData(document.getElementById('loginbg-form'));
        $.ajax({
            url: "<?php echo U('index/setting_save');?>",
            type: "post",
            dataType: "json", // 必须的
            processData:false, // 必须的
            contentType:false, // 必须的
            data: data,
            success: function(res){
                if(eval(res).code == 200){
                    $("#loginbg").attr("src",eval(res).url);
                }
            }
        });
    }

    function slideupload(){
        var data = new FormData(document.getElementById('slide-form'));
        $.ajax({
            url: "<?php echo U('index/slide_save');?>",
            type: "post",
            dataType: "json", // 必须的
            processData:false, // 必须的
            contentType:false, // 必须的
            data: data,
            success: function(res){
                if(eval(res).code == 200){
                    alert("设置成功，请到首页查看");
                }
            }
        });
    }

    function departsave(){
        var depart=$("input[name=depart]").val();
        if(depart){
            var data = $("#depart-form").serialize();
            $.ajax({
                url: "<?php echo U('index/depart_save');?>",
                type: "post",
                dataType: "json", // 必须的
                data: data,
                success: function(res){
                    if(eval(res).code == 200){
                        $('#depart-table').html(eval(res).html);
                    }
                }
            });
        }
    }

    function groupsave(){
        var group=$("input[name=group]").val();
        if(group){
            var data = $("#group-form").serialize();
            $.ajax({
                url: "<?php echo U('index/group_save');?>",
                type: "post",
                dataType: "json", // 必须的
                data: data,
                success: function(res){
                    if(eval(res).code == 200){
                        $('#group-table').html(eval(res).html);
                    }
                }
            });
        }
    }

    function patentsave(){
        var patent=$("input[name=patent]").val();
        if(patent){
            var data = $("#patent-form").serialize();
            $.ajax({
                url: "<?php echo U('index/depart_save');?>",
                type: "post",
                dataType: "json", // 必须的
                data: data,
                success: function(res){
                    console.log(res);
                    if(eval(res).code == 200){
                        $('#depart-table').html(eval(res).html);
                    }
                }
            });
        }
    }

    function addadmin() {
        var bool=$("#admin option:selected").attr("value");
        if(bool){
            var data = $("#addadmin-form").serialize();
            $.ajax({
                url: "<?php echo U('index/addadmin_save');?>",
                type: "post",
                dataType: "json", // 必须的
                data: data,
                success: function(res){
                    console.log(res);
                    if(eval(res).code == 200){
                        $('#admin-table').html(eval(res).html);
                    }
                }
            });
        }
    }
</script>


<script>
    var aa = $("#breadcrumb").text();
    var bb = $("#nav li a span");
    var cc = bb.map(function () {
        return $(this).text();
    });
    var ee = $("#nav li ul a");

    var ff = ee.map(function () {

        var gg = $(this).text();

        if(gg.trim() == aa.trim()){
            $(this).parent().addClass("active");
        }

    });

    var dd = cc.get();
    for(var i=0;i<dd.length;i++){

        if(dd[i].trim() == aa.trim()){

        }
    }

    function bigsearchinfo(name){

        if($('#searchinput').val()){
            var data = $("#searchinput").serialize();
            $.ajax({
                url: "<?php echo U('search/search');?>&name="+name,
                type: "post",
                data: data,
                dataType: "json",
                success: function(res){
                    if(eval(res).code == '200'){
                        $('.searchinfo').html(eval(res).html)
                    }else{
                        $('.searchinfo').html(eval(res).msg)
                    }
                }
            });
        }
    }

</script>

<script type="text/javascript">
    var isIE = /msie/i.test(navigator.userAgent) && !window.opera;
    function fileChange(target) {
        var fileSize = 0;
        var filetypes =[".rar",".zip"];
        var filepath = target.value;
        var filemaxsize = 1024*50;//50M
        if(filepath){
            var isnext = false;
            var fileend = filepath.substring(filepath.indexOf("."));
            if(filetypes && filetypes.length>0){
                for(var i =0; i<filetypes.length;i++){
                    if(filetypes[i]==fileend){
                        isnext = true;
                        break;
                    }
                }
            }
            if(!isnext){
                alert("不接受此文件类型！");
                target.value ="";
                return false;
            }
        }else{
            return false;
        }
        if (isIE && !target.files) {
            var filePath = target.value;
            var fileSystem = new ActiveXObject("Scripting.FileSystemObject");
            if(!fileSystem.FileExists(filePath)){
                alert("附件不存在，请重新输入！");
                return false;
            }
            var file = fileSystem.GetFile (filePath);
            fileSize = file.Size;
        } else {
            fileSize = target.files[0].size;
        }

        var size = fileSize / 1024;
        if(size>filemaxsize){
            alert("附件大小不能大于"+filemaxsize/1024+"M！");
            target.value ="";
            return false;
        }
        if(size<=0){
            alert("附件大小不能为0M！");
            target.value ="";
            return false;
        }
    }
</script>
</body>
</html>
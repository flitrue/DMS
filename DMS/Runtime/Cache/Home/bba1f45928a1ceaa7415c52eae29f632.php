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
    <div class="noprint">
        <div class="breadcrumbs" id="breadcrumbs">
            <script type="text/javascript">
                try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
            </script>

            <ul class="breadcrumb">
                <li>
                    <i class="icon-home home-icon"></i>
                    <a href="<?php echo U('index/index');?>"><?php echo L('HOME');?></a>
                </li>

                <li class="active"><?php echo L('LOOKSTAFF');?></li>
            </ul><!-- .breadcrumb -->
           <!-- <div class="nav-search" id="nav-search">
                <form class="form-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
                        <i class="icon-search nav-search-icon"></i>
                    </span>
                </form>
            </div>-->
            <!-- #nav-search -->
        </div>
    </div>

    <div class="page-content">

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">
                        <div class="btn-toolbar noprint needhidden">
                            <div class="btn-group">
                                <button onclick="checkpower();window.location.href='<?php echo U('staff/add');?>'" class="btn btn-success" title="添加员工"><i class="icon-plus-sign icon-2x icon-only"></i></button>
                            </div>

                            <div class="btn-group needhidden">
                                <button class="btn btn-danger" id="deleteselected" title="删除所选内容"><i class="icon-trash icon-2x icon-only"></i></button>
                            </div>

                            <div class="btn-group">
                                <button class="btn btn-warning" title="打印所选内容" onclick="printinfo();"><i class="icon-print icon-2x icon-only"></i></button>
                            </div>
                            <div class="searchcontainer">
                                <div id="search">
                                    <input id="searchinput" type="text" name="bigsearch">
                                    <button class="searchbutton" onclick="bigsearchinfo('user');">Search</button>
                                </div>
                            </div>
                        </div>

                        <div class="space-2"></div>

                        <div class="searchinfo">
                            <div class="col-xs-12">
                                <div class="col-xs-6">
                                    <div class="widget-box transparent">
                                        <div class="widget-header widget-header-flat">
                                            <h4 class="lighter">
                                                员工状态统计
                                            </h4>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="icon-chevron-up"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="widget-body">
                                            <div class="widget-main no-padding">
                                                <div id="people_chart_pie" style="height:200px;"></div>
                                            </div><!-- /widget-main -->
                                        </div><!-- /widget-body -->
                                    </div><!-- /widget-box -->
                                </div>

                                <div class="col-xs-6">
                                    <div class="widget-box transparent">
                                        <div class="widget-header widget-header-flat">
                                            <h4 class="lighter">
                                                员工分布
                                            </h4>

                                            <div class="widget-toolbar">
                                                <a href="#" data-action="collapse">
                                                    <i class="icon-chevron-up"></i>
                                                </a>
                                            </div>
                                        </div>

                                        <div class="widget-body">
                                            <div class="widget-main no-padding">
                                                <div id="people_chart_bar" style="height:200px;"></div>
                                            </div><!-- /widget-main -->
                                        </div><!-- /widget-body -->
                                    </div><!-- /widget-box -->
                                </div>

                            </div>

                            <div class="space-8"></div>
                            <div class="table-responsive">
                                <form id="select" action="" method="post" enctype="multipart/form-data">
                                    <table id="staff-table" class="sortable table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th class="noprint sorttable_nosort">
                                                <label>
                                                    <input type="checkbox" name="checkbox" class="ace" />
                                                    <span class="lbl"></span>
                                                </label>
                                            </th>
                                            <th>姓名</th>
                                            <th><?php echo L('STATUS');?></th>
                                            <th><?php echo L('EMAIL');?></th>
                                            <th><?php echo L('IDCARD');?></th>
                                            <th>部门</th>
                                            <th>小组</th>
                                            <th><?php echo L(JOINTIME);?></th>

                                            <th class="noprint">操作</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <?php if(is_array($arr)): $i = 0; $__LIST__ = $arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><tr>
                                                <td class="center noprint">
                                                    <label>
                                                        <input type="checkbox" name="<?php echo ($vol["name"]); ?>" value="<?php echo ($vol["id"]); ?>" class="ace" />
                                                        <span class="lbl"></span>
                                                    </label>
                                                </td>

                                                <td><a href="<?php echo U('staff/detail');?>&uid=<?php echo ($vol["id"]); ?>" title="查看详细信息"><?php echo ($vol["name"]); ?></a></td>
                                                <td>
                                                    <span class="staffstatus label label-lg"><?php echo ($vol["status"]); ?></span>
                                                </td>

                                                <td><a href="<?php echo U('staff/writeemail');?>&uid=<?php echo ($vol["id"]); ?>" title="点击发送邮件"><?php echo ($vol["email"]); ?></a></td>
                                                <td><?php echo ($vol["idcard"]); ?></td>
                                                <td><nobr><?php echo ($vol["depart"]); ?></nobr></td>
                                                <td><nobr><?php echo ($vol["group"]); ?></nobr></td>
                                                <td><?php echo ($vol["time"]); ?></td>

                                                <td class="noprint">
                                                    <nobr>
                                                        <div>

                                                            <a onclick="checkpower();editstaffinfo('<?php echo ($vol["id"]); ?>');" class="btn btn-xs btn-info needhidden" title="编辑">
                                                                <i class="icon-edit bigger-120"></i>
                                                            </a>
                                                            <a class="btn btn-info btn-xs btn-danger bootbox-confirm needhidden" onclick="checkpower();deletestaffinfo('<?php echo ($vol["id"]); ?>')" title="删除">
                                                                <i class="icon-trash bigger-120"></i>
                                                            </a>
                                                            <a href="<?php echo U('staff/detail');?>&uid=<?php echo ($vol["id"]); ?>" class="btn btn-xs btn-warning" title="查看详细信息">
                                                                <i class="icon-eye-open bigger-120"></i>
                                                            </a>

                                                            <a href="<?php echo U('staff/writeemail');?>&uid=<?php echo ($vol["id"]); ?>" class="btn btn-xs btn-inverse" title="发送邮件">
                                                                <i class="icon-plane bigger-120"></i>
                                                            </a>
                                                        </div>
                                                    </nobr>
                                                </td>
                                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </tbody>
                                    </table>
                                </form>
                                <div class="message-footer clearfix noprint">
                                    <div class="pull-left"> 总共 <?php echo ($count); ?> 条记录 </div>

                                    <div class="pull-right">
                                        <div class="inline middle">  共<?php echo ($num); ?> 页 </div>

                                        <ul class="pagination middle">
                                            <li>
                                                <a href="<?php echo U('staff/look');?>&page=<?php echo ($prepage); ?>">
                                                    <i class="icon-caret-left bigger-140 middle"></i>
                                                </a>
                                            </li>

                                            <li>
                                                <form id="page" action="" method="post" class="inline">
                                                    <span class="form-group">
                                                        <input  value="<?php echo ($pagenow); ?>" maxlength="3" type="text" name="page"/>
                                                    </span>
                                                </form>
                                            </li>

                                            <li class="pull-right">
                                                <a href="<?php echo U('staff/look');?>&page=<?php echo ($nextpage); ?>">
                                                    <i class="icon-caret-right bigger-140 middle"></i>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div><!-- /.table-responsive -->
                        </div>
                        <!-- UY BEGIN -->
                        <!--<div id="uyan_frame" class="noprint"></div>
                            <script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=2119618"></script>-->
                        <!-- UY END -->
                        </div><!-- /span -->
                </div><!-- /row -->
                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->
</div><!-- /.main-content -->

</div><!-- /.main-container-inner -->

</div><!-- /.main-container -->


<!-- basic scripts -->

<!--[if !IE]> -->

<script src="<?php echo (JS_URL); ?>jquery-2.0.3.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="<?php echo (JS_URL); ?>jquery-1.10.2.min.js"></script>
<![endif]-->

<!--[if !IE]> -->

<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo (JS_URL); ?>jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>
<script src="<?php echo (JS_URL); ?>jquery-1.10.2.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo (JS_URL); ?>jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

<script type="text/javascript">
    if("ontouchend" in document) document.write("<script src='<?php echo (JS_URL); ?>jquery.mobile.custom.min.js'>"+"<"+"/script>");
</script>
<script src="<?php echo (JS_URL); ?>bootstrap.min.js"></script>
<script src="<?php echo (JS_URL); ?>typeahead-bs2.min.js"></script>

<!-- page specific plugin scripts -->

<script src="<?php echo (JS_URL); ?>jquery.dataTables.min.js"></script>
<script src="<?php echo (JS_URL); ?>jquery.dataTables.bootstrap.js"></script>
<script src="<?php echo (JS_URL); ?>bootbox.min.js"></script>

<!-- ace scripts -->

<script src="<?php echo (JS_URL); ?>ace-elements.min.js"></script>
<script src="<?php echo (JS_URL); ?>ace.min.js"></script>

<script src="<?php echo (JS_URL); ?>jquery.gritter.min.js"></script>
<script src="<?php echo (JS_URL); ?>jquery.slimscroll.min.js"></script>
<script src="<?php echo (JS_URL); ?>jquery.easy-pie-chart.min.js"></script>
<script src="<?php echo (JS_URL); ?>jquery.hotkeys.min.js"></script>
<script src="<?php echo (JS_URL); ?>bootstrap-wysiwyg.min.js"></script>
<script src="<?php echo (JS_URL); ?>select2.min.js"></script>
<script src="<?php echo (JS_URL); ?>bootstrapValidator.min.js"></script>

<script src="<?php echo (JS_URL); ?>fuelux/fuelux.spinner.min.js"></script>
<script src="<?php echo (JS_URL); ?>x-editable/bootstrap-editable.min.js"></script>
<script src="<?php echo (JS_URL); ?>x-editable/ace-editable.min.js"></script>


<script src="<?php echo (JS_URL); ?>jquery.maskedinput.min.js"></script>
<script src="<?php echo (JS_URL); ?>jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo (JS_URL); ?>jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo (JS_URL); ?>jquery-ui-1.10.3.full.min.js"></script>
<script src="<?php echo (JS_URL); ?>croppic.js"></script>
<script src="<?php echo (JS_URL); ?>sorttable.js"></script>
<script src="<?php echo (JS_URL); ?>echarts.min.js"></script>

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
    jQuery(function(){
        // 监听搜索后div内容变化时重新加载js代码
        $(".searchinfo").bind('DOMNodeInserted', function(e) {
            checkstatus();
        });

        $('table th input:checkbox').on('click' , function(){
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                    .each(function(){
                        this.checked = that.checked;
                        $(this).closest('tr').toggleClass('selected');
                    });

        });

        $('#page').bootstrapValidator({
            message: '请输入有效的值',
            feedbackIcons: {
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                page: {
                    message: '页数不足',
                    validators: {
                        between: {
                            min: 1,
                            max: "<?php echo ($num); ?>",
                            message: '页数在1~<?php echo ($num); ?>之间'
                        }
                    }
                }
            }
        });

        $('#deleteselected').click(function(){
            checkpower();
            showdialogs();
        });

        function showdialogs(){
            if($('input:checked').length > 0){
                bootbox.confirm('你确定要删除选中的内容吗?', function (result) {
                    if (result) {
                        var data = $('#select').serialize();
                        $.ajax({
                            url: "<?php echo U('staff/deletemulti');?>",
                            type: 'post',
                            data: data,
                            success: function (res) {
                                if(res == 1 ){
                                    bootbox.alert({
                                        buttons: {
                                            ok: {
                                                label: 'OK',
                                                className: 'btn-default'
                                            }
                                        },
                                        message: '友谊的小船说翻就翻，我也不要和你做朋友了',
                                        title: "删除成功",
                                        callback: function (){
                                            window.location.reload();
                                        }
                                    });

                                }else{
                                    bootbox.alert({
                                        buttons: {
                                            ok: {
                                                label: 'OK',
                                                className: 'btn-default'
                                            }
                                        },
                                        message: '你们同事的不同意你这么做，且行且珍惜',
                                        title: "删除失败",
                                        callback: function (){
                                            window.location.replace();
                                        }
                                    });
                                }
                            }
                        });
                    }
                });
            }
        }

        var people_chart_pie = echarts.init(document.getElementById('people_chart_pie'));
        var people_chart_pie_data = '<?php echo ($people_chart_pie); ?>';
        var people_chart_pie_category_data = '<?php echo ($people_chart_pie_category); ?>';
        option1 = {
            color: [
                    '#3A87AD','#D6487E','#ABBAC3'
            ],
            tooltip : {
                trigger: 'item',
                formatter: "{a} <br/>{b} : {c} ({d}%)"
            },
            legend: {
                orient : 'vertical',
                x : 'left',
                data: eval(people_chart_pie_category_data)
            },
            toolbox: {
                show : true,
                feature : {
                    mark : {show: true},
                    dataView : {show: true, readOnly: false},
                    magicType : {
                        show: true,
                        type: ['pie', 'funnel'],
                        option: {
                            funnel: {
                                x: '25%',
                                width: '50%',
                                funnelAlign: 'left',
                                max: 1548
                            }
                        }
                    },
                    restore : {show: true},
                    saveAsImage : {show: true}
                }
            },
            calculable : true,
            series : [
                {
                    name:'员工状态统计',
                    type:'pie',
                    radius : '60%',
                    center: ['50%', '40%'],
                    data: eval(people_chart_pie_data)
                }
            ]
        };
        people_chart_pie.setOption(option1);

        var people_chart_bar = echarts.init(document.getElementById('people_chart_bar'));

        var depart = eval('<?php echo ($people_chart_bar_category); ?>');
        var membernum = eval('<?php echo ($people_chart_bar); ?>');

        people_chart_bar.setOption(option = {

            tooltip: {
                trigger: 'axis'
            },

            toolbox: {
                show: true,
                feature: {
                    mark: {show: true},
                    dataView: {show: true, readOnly: false},
                    magicType: {show: true, type: ['line', 'bar']},
                    restore: {show: true},
                    saveAsImage: {show: true}
                }
            },
            calculable: true,
            xAxis: [
                {
                    type: 'category',
                    data: depart
                }
            ],
            yAxis: [
                {
                    type: 'value'
                }
            ],
            series: [
                {
                    name: '员工个数',
                    type: 'bar',
                    data: membernum
                }
            ]
        });
    });

    function checkstatus(){
        $(".staffstatus").each(function(){
            if($(this).text() == "在职"){
                $(this).addClass("label-info");
            }else if($(this).text() == "离职"){
                $(this).addClass("label-blue");
            }else{
                $(this).addClass("label-pink");
            }
        });
    }

    function editstaffinfo(uid){
        window.location.href='<?php echo U('staff/edit');?>&uid='+uid;
    }

    function deletestaffinfo(uid){
        bootbox.confirm('你确定要删除吗?', function (result) {
            if (result) {
                location.href='<?php echo U('staff/del');?>&uid='+uid;
            }
        });
    }

    // 打印
    function printinfo(){

        $(".main-content").css('margin-left',0);
        $("a").removeAttr('href');

        window.print();
        window.location.reload();

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
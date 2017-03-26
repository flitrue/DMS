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
				<a href="/"><?php echo (L("HOME")); ?></a>
			</li>
			<li class="active"><?php echo (L("PROFILE")); ?></li>
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
		<div class="page-header">
			<h1>
				<?php echo (L("PROFILE")); ?>
				<small>
					<i class="icon-double-angle-right"></i>
					<?php echo (L("LOOK")); ?>
				</small>
			</h1>
		</div><!-- /.page-header -->

		<div class="row">
			<div class="col-xs-12">
				<!-- PAGE CONTENT BEGINS -->
				<div>
					<div id="user-profile-3" class="user-profile row">
						<div class="col-sm-offset-1 col-sm-10">
							<div class="well well-sm">
								<button type="button" class="close" data-dismiss="alert">&times;</button>

								<div class="inline middle blue bigger-110"> 你的资料完成了<?php echo ($progess); ?>%... </div>
								<div style="width:200px;" data-percent="<?php echo ($progess); ?>%" class="inline middle no-margin progress progress-striped active">
									<div class="progress-bar progress-bar-success" style="width:<?php echo ($progess); ?>%"></div>
								</div>
							</div><!-- /well -->

							<div class="space"></div>


							<div class="tabbable">
								<ul class="nav nav-tabs padding-16">
									<li class="active">
										<a data-toggle="tab" href="#edit-basic">
											<i class="green icon-edit bigger-125"></i>
											<?php echo L('BASICINFO');?>
										</a>
									</li>

									<li>
										<a data-toggle="tab" href="#edit-settings">
											<i class="purple icon-key bigger-125"></i>
											重置密码
										</a>
									</li>
								</ul>

								<div class="tab-content profile-edit-tab-content">

									<div id="edit-basic" class="tab-pane  in active">
										<form id="form1" class="form-horizontal" enctype="multipart/form-data" method="post">
											<h4 class="header blue bolder smaller"><?php echo L('GENERAL');?></h4>

											<div class="row text-center">
												<div id="preimg"  style="width:150px;height: 155px;display: inline-block">
													<img class="img-circle" src="<?php echo ($arr[0]["avatar"]); ?>" onerror="javascript:this.src='<?php echo (IMAGE_URL); ?>nopicture.jpg'" width="150px" height="150px" onclick="show();" />
												</div>
												<div id="upoadimg" class="col-xs-6 col-sm-3 col-md-2">

													<input type="file" name="avatar"/>
												</div>

											</div>

											<div class="form-group col-md-6">
												<label class="col-sm-3 control-label no-padding-right" ><?php echo L('NAME');?></label>

												<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input class="input" name="name" type="text" value="<?php echo ($arr[0]["name"]); ?>"/>
																		<i class="icon-user"></i>
																	</span>
												</div>
											</div>


											<div class="form-group col-md-6">
												<label class="col-sm-3 control-label no-padding-right" >出生日期</label>

												<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input class="datepicker" name="brith" type="text" data-date-format="yyyy-mm-dd"  readonly="readonly" value="<?php echo ($arr[0]["brith"]); ?>"/>
																		<i class="icon-calendar"></i>
																	</span>
												</div>
											</div>


											<div class="form-group col-md-6">
												<label class="col-sm-3 control-label no-padding-right"><?php echo L('GENDER');?></label>

												<div class="col-sm-9">
													<label class="inline">
														<input type="radio" name="sex" value="男" class="ace"/>
														<span class="lbl"> <?php echo L('MALE');?></span>
													</label>


													<label class="inline">
														<input type="radio" name="sex" value="女" class="ace" />
														<span class="lbl"> <?php echo L('FEMALE');?></span>
													</label>
												</div>
											</div>


											<div class="form-group col-md-6">
												<label class="col-sm-3 control-label no-padding-right" for="form-field-comment"><?php echo (L("COMMENT")); ?></label>

												<div class="col-sm-9">
													<textarea id="form-field-comment" name="comment"><?php echo ($arr[0]["comment"]); ?></textarea>
												</div>
											</div>
											<br>
											<h4 class="header blue bolder smaller col-xs-12 col-md-12"><?php echo (L("CONTACT")); ?></h4>
											<br>
											<!--<div class="form-group">
                                                <label class="col-md-3 control-label no-padding-right" for="email">Email</label>

                                                <span style="margin-left: 1%">
                                                    <input type="text" id="email" name="email"/>@
                                                    <select name="domain" id="domain">
                                                        <?php if(is_array($domain)): $i = 0; $__LIST__ = $domain;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="{/*$vol.name /*}">{/*$vol.name /*}</option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                                </span>
                                            </div>-->


											<div class="form-group col-md-6">
												<label class="col-sm-3 control-label no-padding-right" ><?php echo (L("PHONE")); ?></label>

												<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input class="input" name="phone" type="text" value="<?php echo ($arr[0]["phone"]); ?>"/>
																		<i class="icon-phone icon-flip-horizontal"></i>
																	</span>
												</div>
											</div>


											<div class="form-group col-md-6">
												<label class="col-sm-3 control-label no-padding-right" >微信</label>

												<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input class="input" name="weixin" type="text" value="<?php echo ($arr[0]["weixin"]); ?>"/>
																		<i class="icon-comments icon-flip-horizontal"></i>
																	</span>
												</div>
											</div>

											<div class="form-group col-md-6">
												<label class="col-sm-3 control-label no-padding-right" ><?php echo (L("QQ")); ?></label>

												<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input class="input" name="qq" type="text" value="<?php echo ($arr[0]["qq"]); ?>"/>
																		<img class="icon-flip-horizontal" src="<?php echo (IMAGE_URL); ?>sqq.png" title="qq"/>
																	</span>
												</div>
											</div>

											<div class="clearfix">
												<div class="col-md-offset-3 col-md-9">
													<button id="submitbtn" class="btn btn-info" type="button">
														<i class="icon-ok bigger-110"></i>
														<?php echo L('SAVE');?>
													</button>

													&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													<button class="btn" type="reset">
														<i class="icon-undo bigger-110"></i>
														<?php echo L('RESET');?>
													</button>
												</div>
											</div>
										</form>
									</div>

									<div id="edit-settings" class="tab-pane">
										<div class="space-10"></div>

										<form id="changepassword" >
											<div class="form-group">
												<p>密码长度为6~16个字符，支持数字和大小写字母，不支持标点符号和空格</p>
												<label class="inline">
													<span class="lbl text-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 密码</span>
													<input type="password" name="password">
												</label>
											</div>

											<div class="space-8"></div>

											<div class="form-group">
												<label class="inline">
													<span class="lbl"> 确认密码</span>
													<input type="password" name="repassword">

												</label>
											</div>
											<div class="space-8"></div>
											<div>
												<label class="inline">
													<span class="lbl">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
													<button class="btn" onclick="changepassword();">确定</button>
												</label>
											</div>
										</form>

										<div class="space-8"></div>

									</div>

								</div>
							</div>

						</div><!-- /span -->
					</div><!-- /user-profile -->
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

<!--[if IE]>
<script src="<?php echo (JS_URL); ?>jquery-1.10.2.min.js"></script>
<![endif]-->

<!--[if !IE]> -->

<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo (JS_URL); ?>jquery-2.0.3.min.js'>"+"<"+"/script>");
</script>

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

<!--[if lte IE 8]>
<script src="<?php echo (JS_URL); ?>excanvas.min.js"></script>
<![endif]-->

<script src="<?php echo (JS_URL); ?>jquery-ui-1.10.3.custom.min.js"></script>
<script src="<?php echo (JS_URL); ?>jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo (JS_URL); ?>jquery.gritter.min.js"></script>
<script src="<?php echo (JS_URL); ?>bootbox.min.js"></script>

<script src="<?php echo (JS_URL); ?>select2.min.js"></script>

<script src="<?php echo (JS_URL); ?>bootstrapValidator.min.js"></script>

<script src="<?php echo (JS_URL); ?>jquery-ui-1.10.3.full.min.js"></script>
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

<script type="text/javascript">

    jQuery(function($) {
        $(".datepicker").datepicker({
            changeYear: true,
            defaultDate: "1992-05-11",
            maxDate: "2000-12-31",
            minDate: "1949-10-01",
            showMonthAfterYear:true,
            changeMonth: true,
            monthNamesShort: ["1月","2月","3月","4月","5月","6月","7月","8月","9月","10月","11月","12月"],
            dateFormat: "yy-mm-dd"
        });

        ///////////////////////////////////////////
        $('#user-profile-3').find('input[type=file]').ace_file_input({
            style:'well',
            btn_choose:'修改头像',
            btn_change:null,
            no_icon:'icon-picture',
            thumbnail:'large',
            droppable:true,
            before_change: function(files, dropped) {
                var file = files[0];

                if(typeof file === "string") {
                    //files is just a file name here (in browsers that don't support FileReader API)
                    if(! (/\.(jpe?g|png|gif)$/i).test(file) ) return false;
                }else{
                    var type = $.trim(file.type);
                    if( ( type.length > 0 && ! (/^image\/(jpe?g|png|gif)$/i).test(type) )
                        || ( type.length == 0 && ! (/\.(jpe?g|png|gif)$/i).test(file.name) )
                    //for android default browser!
                    ) return false;

                    if( file.size > 5000000 ) {
                        //~100Kb
                        return false;
                    }
                }
                return true;
            }
        }).end().find('button[type=reset]').on(ace.click_event, function(){

        });

        var sex = "<?php echo ($arr[0]["sex"]); ?>";
        if(sex == "女"){
            $("input[value=女]").attr("checked",true);
        }else{
            $("input[value=男]").attr("checked",true);
        }

        var avatar = "<?php echo (cookie('dms_avatar')); ?>";
        if(avatar){
            $("preimg").show();
            $("#upoadimg").hide();
        }else{
            $("preimg").hide();
            $("#upoadimg").hide();
        }
    });
    function show() {

        $("#preimg").hide();
        $("#upoadimg").show();

    }

    $("#submitbtn").on("click",function () {

        var data = new FormData(document.getElementById('form1'));
        $.ajax({
            url: "<?php echo U('index/updateProfile');?>&uid=<?php echo ($arr[0]["id"]); ?>",
            type: 'post',
            dataType: "json", // 必须的
            processData:false, // 必须的
            contentType:false,
            data: data,
            success: function (res) {
                if(eval(res).code){
                    alert("更新成功");
                    window.location.reload();
                }else{
                    alert("更新失败");
                }

            }
        });

    });
    $("#form1").bootstrapValidator({
        message: '请输入有效的值',
		/*feedbackIcons: {
		 valid: 'glyphicon glyphicon-ok',
		 invalid: 'glyphicon glyphicon-remove',
		 validating: 'glyphicon glyphicon-refresh'
		 },*/
        fields: {
            name: {
                message: '姓名无效',
                validators: {
                    notEmpty: {
                        message: '姓名不能为空'
                    },
                    stringLength: {
                        min: 2,
                        max: 8,
                        message: '姓名的长度为2~8'
                    }
                }
            },
            birth: {
                message: '生日无效',
                validators: {
                    notEmpty: {
                        message: '生日不能为空'
                    }
                }
            },
            qq: {
                validators: {
                    regexp: {
                        regexp: /^[0-9]{5,12}$/,
                        message: "QQ号格式不正确"
                    }
                }
            },
            phone: {
                message: '手机号无效',
                validators: {
                    notEmpty: {
                        message: '手机号不能为空'
                    },
                    regexp: {
                        regexp: /^1(3[0-9]|4[57]|5[0-35-9]|7[01678]|8[0-9])\d{8}$/,
                        message: "手机号格式不正确"
                    }
                }
            },
            comment: {
                message: '无效',
                validators: {
                    stringLength: {
                        max: 50,
                        message: '姓名的长度为50'
                    }
                }
            }
        }
    });

    $("#changepassword").bootstrapValidator({
        message: '请输入有效的值',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            password: {
                message: '密码无效',
                validators: {
                    notEmpty: {
                        message: '密码不能为空'
                    },
                    stringLength: {
                        min: 6,
                        max: 16,
                        message: '密码的长度为6~16'
                    },
                    identical: {
                        field: 'repassword', //需要进行比较的input name值
                        message: '两次密码不一致'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9]{6,16}$/,
                        message: "密码格式不正确"
                    }
                }
            },
            repassword: {
                message: '确认密码无效',
                validators: {
                    notEmpty: {
                        message: '确认密码不能为空'
                    },
                    stringLength: {
                        min:6,
                        max: 16,
                        message: '确认密码的长度为6~16'
                    },
                    identical: {
                        field: 'password', //需要进行比较的input name值
                        message: '两次密码不一致'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9]{6,16}$/,
                        message: "密码格式不正确"
                    }
                }
            }
        }
    });
    function changepassword(){
        var bootstrapValidator = $("#changepassword").data('bootstrapValidator');
        bootstrapValidator.validate();
        if(bootstrapValidator.isValid()){
            bootbox.confirm('你确定要提交吗?', function (result) {
                if (result) {
                    var data = $("#changepassword").serialize();
                    $.ajax({
                        url: "<?php echo U('index/changepassword');?>&id=<?php echo ($arr[0]["id"]); ?>",
                        type: "post",
                        data: data,
                        dataType: "json",
                        success: function(res){
                            console.log(res);
                            showdialogs(res);
                        }
                    });
                }
            });
        }
    }
    function showdialogs(res){
        if(eval(res).code == '200' ){
            bootbox.alert({
                buttons: {
                    ok: {
                        label: 'OK',
                        className: 'btn-default'
                    }
                },
                message: '密码修改成功',
                title: "提交成功",
                callback: function(){
                    window.location.href="<?php echo U('index/profile');?>";
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
                message: '密码修改失败',
                title: "提交失败了",
                callback: function(){
                    window.location.reload();
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
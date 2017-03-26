<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title><?php echo L('APP_NAME');?></title>
		<meta name="keywords" content="<?php echo L('KEYWORDS');?>" />
		<meta name="description" content="<?php echo L('KEYWORDS');?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->

		<link href="<?php echo (CSS_URL); ?>bootstrap.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="<?php echo (CSS_URL); ?>font-awesome.min.css" />

		<!--[if IE 7]-->
		  <link rel="stylesheet" href="<?php echo (CSS_URL); ?>font-awesome-ie7.min.css" />
		<!--[endif]-->

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="<?php echo (CSS_URL); ?>bootstrapValidator.min.css" />
		<!-- fonts -->

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
			html,body{height:100%}
		</style>

		<!-- ace styles -->

		<link rel="stylesheet" href="<?php echo (CSS_URL); ?>ace.min.css" />
		<link rel="stylesheet" href="<?php echo (CSS_URL); ?>ace-rtl.min.css" />

		<!--[if lte IE 8]>
		  <link rel="stylesheet" href="<?php echo (CSS_URL); ?>ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lt IE 9]-->
		<script src="<?php echo (JS_URL); ?>html5shiv.js"></script>
		<script src="<?php echo (JS_URL); ?>respond.min.js"></script>
		<!--[endif]-->
	</head>

	<body class="login-layout" style="background-color: white">
	<div class="header" style="height:62px;overflow: hidden;background-color: whitesmoke;border-bottom:1px solid #d6dfea;margin-top: 0">
		<h1 style="margin: 0;padding: 0;margin-left: 20px">
			<img src="/favicon.ico" width="50px" height="50px" style="margin: 5px"/>
			<span class="blue"><?php echo L('APP_NAME');?></span>
		</h1>
	</div>
		<div class="main-container" >
			<div class="main-content" style="min-height:500px;max-height:1024px;">

				<div class="row" >
					<div class="col-sm-6 col-sm-offset-1" style="min-height:500px;max-height:1024px;background-image:url('<?php echo ($loginbg); ?>');background-position:center center;background-repeat: no-repeat;" >

					</div>
					<div class="col-sm-4 " style="margin-top: 6%">
						<div class="login-container">

							<div class="space-6"></div>
							<div class="position-relative">
								<div id="login-box" class="login-box visible widget-box no-border" style="background-color: rgba(89, 46, 51, 0); border: 1px solid lightgrey">
									<div class="widget-body">
										<div class="widget-main">
											<h4 class="header blue lighter bigger">
												<i class="icon-coffee green"></i>
												帐号密码登录
											</h4>

											<div class="space-6"></div>

											<form id="loginform" method="post" action="">

												<div class="form-group">
													<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input id="email1" type="text" name="email" class="form-control" placeholder="邮箱/手机号/QQ号" value="<?php echo ($_GET['email']); ?>"/>
														<i class="icon-user"></i>
													</span>
													</label>
												</div>

												<div class="form-group">
													<label class="block clearfix">
													<span class="block input-icon input-icon-right">
														<input type="password" name="password" class="form-control" placeholder="你的密码" value="<?php echo ($_GET['key']); ?>"/>
														<i class="icon-lock"></i>
													</span>
													</label>
													<label id="tixing" class="red"></label>

												</div>
												<div class="form-group">

													<div id="yanzhengma" class="col-sm-7" style="height: 60px">
														<img class="col-sm-12" height="100%" src="<?php echo U('login/loadcode');?>" onclick="this.src='<?php echo U('login/loadcode');?>&rand='+Math.random()"  title="点击刷新">
													</div>
													<div class="col-sm-5">
														<input type="text" name="code" class="form-control" placeholder="验证码" />
													</div>
												</div>


												<div class="clearfix">

													<button style="margin-top: 10%;" type="button" id="loginbtn" class="width-35 pull-right btn btn-sm btn-primary">
														<i class="icon-key"></i>
														<?php echo L('LOGIN');?>
													</button>
												</div>


												<div class="space-4"></div>

											</form>

										</div><!-- /widget-main -->

										<div class="toolbar clearfix" style="padding-left: 10px;font-size:14px;">
											<a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link">

												忘记密码?
											</a>
											|
											<a href="<?php echo U('register/register');?>"  class="forgot-password-link">
												注册新账号
											</a>

										</div>

									</div><!-- /widget-body -->
								</div><!-- /login-box -->

								<div id="forgot-box" class="forgot-box widget-box no-border" style="background-color: rgba(89, 46, 51, 0); border: 1px solid lightgrey">
									<div class="widget-body">
										<div class="widget-main" style="padding: 16px">
											<h4 class="header red lighter bigger">
												<i class="icon-key"></i>
												获取密钥
											</h4>

											<div class="space-6"></div>
											<p>
												请进入邮箱查看密钥
											</p>

											<form id="sendmailform" method="post" class="form-group" action="">

												<fieldset>
													<div class="form-group">
														<label>
															<input type="text" id="email2" name="email" style="width: 40%"/>@
															<select name="domain">
																<?php if(is_array($domain)): $i = 0; $__LIST__ = $domain;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vol): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vol["name"]); ?>"><?php echo ($vol["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
															</select>
														</label>
													</div>

													<div class="clearfix">
														<button type="button" id="sendmailbtn" class="width-35 pull-right btn btn-sm btn-danger">
															<i class="icon-lightbulb"></i>
															发送
														</button>
													</div>
												</fieldset>
											</form>

										</div><!-- /widget-main -->

										<div class="toolbar center" style="padding: 0">
											<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">
												返回登录页面
											</a>
										</div>
									</div><!-- /widget-body -->
								</div><!-- /forgot-box -->

							</div><!-- /position-relative -->

						</div>
					</div><!-- /.col -->
				</div><!-- /.row -->


			</div>
		</div><!-- /.main-container -->
	<footer class="container-fluid foot-wrap center"  style="background-color: whitesmoke;border-top:1px solid #d6dfea;position:fixed;bottom:0;width: 100%;font-size: 15px;padding: 10px">
		<div class="footer"><a href="http://www.stockemotion.com" target="_blank">关于我们</a>&nbsp;|&nbsp;<a href="#" title="13811423600">联系我们</a>&nbsp;|&nbsp;<span class="blue">&copy; 沃民高新科技（北京）股份有限公司</span></div>
	</footer>
		<!-- basic scripts -->

		<!--[if !IE]> -->

		<script src="<?php echo (JS_URL); ?>jquery-2.0.3.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
		<script src="<?php echo (JS_URL); ?>jquery-1.10.2.min.js"></script>
		<![endif]-->
		<script src="<?php echo (JS_URL); ?>bootstrapValidator.min.js"></script>

		<script type="text/javascript">
			if("ontouchend" in document) document.write("<script src='<?php echo (JS_URL); ?>jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>

		<!-- inline scripts related to this page -->

		<script type="text/javascript">
			function show_box(id) {
			 jQuery('.widget-box.visible').removeClass('visible');
			 jQuery('#'+id).addClass('visible');
			}

			jQuery(function(){
				var tixing = $("#tixing");
				$("input[type=password]").on("change",function (){
					tixing.text("")
				});

				$("#loginbtn").on("click",function(){
					var bootstrapValidator = $("#loginform").data('bootstrapValidator');
					bootstrapValidator.validate();
					if(bootstrapValidator.isValid()){
						var data = $("#loginform").serialize();
						$.ajax({
							url: "<?php echo U('login/checklogin');?>",
							type: "post",
							data: data,
							dataType: "json",
							success: function(res){
								console.log(res);
								if(eval(res).code == 200){
									window.location.href=eval(res).url;
								}else if(eval(res).code == 405){
									if(!tixing.text()){
										tixing.text("你已经离职，不能登录");
										$("input[type=password]").val('');
									}
								}else{
									if(!tixing.text()){
										tixing.text("账户或密码不正确");
										$("input[type=password]").val('');
									}
								}

							}
						});
					}
				});

				$('#sendmailbtn').click(function(){

					var bootstrapValidator = $("#sendmailform").data('bootstrapValidator');
					bootstrapValidator.validate();
					if(bootstrapValidator.isValid()){
						var data = $('#sendmailform').serialize();
						$.ajax({
							url: "<?php echo U('login/sendmail');?>",
							type: 'post',
							data: data,
							dataType: "json",
							success: function(res){
								console.log(res);
								if(eval(res).code == '200'){
									alert("发送成功");
									show_box("login-box");
									$("input[type=password]").val('');
								}else if(eval(res).code == '500'){
									alert('该邮箱不存在，请核对您的邮箱');
								}else{
									alert('邮件发送失败');
								}
							}
						});
					}
				});
				/*$("#email1").on("change",function(){
					$("#email2").val($(this).val());
				});
				$("#email2").on("change",function(){
					$("#email1").val($(this).val());
				});*/
			});


			$('#loginform')
					.bootstrapValidator({
						message: '请输入有效值',
						feedbackIcons: {
							validating: 'glyphicon glyphicon-refresh'
						},
						fields: {
							email: {
								validators: {
									notEmpty: {
										message: '帐号不能为空'
									},
									regexp: {
										regexp: /(^([a-zA-Z])+@(\bwordemotion\b|\bstockemotion\b)\.(com|cn|net)$)|(^1(3[0-9]|4[57]|5[0-35-9]|7[01678]|8[0-9])\d{8}$)|(^\d{4,12}$)/,
										message: '帐号格式不正确'
									},
									remote: {
										url: "<?php echo U('login/checkemail');?>",
										message: '邮箱不存在',
										delay :  2000,
										type: 'POST'
									}
								}
							},
							password: {
								validators: {
									notEmpty: {
										message: '密钥不能为空'
									},
									stringLength: {
										min: 6,
										max: 16,
										message: '密钥长度为6~16'
									}
								}
							},
							code: {
								validators: {
									notEmpty: {
										message: '请输入验证码'
									},
									remote: {
										url: "<?php echo U('login/check_verify');?>",
										message: '验证码不正确',
										delay :  2000,
										type: 'POST'
									}
								}
							}
						}
					});

			$('#sendmailform')
					.bootstrapValidator({
						message: '请输入有效值',
						feedbackIcons: {
							validating: 'glyphicon glyphicon-refresh'
						},
						fields: {
							email: {
								validators: {
									notEmpty: {
										message: '邮箱不能为空'
									},
									regexp: {
										regexp: /^[a-zA-Z][a-zA-Z]+/,
										message: '邮箱格式不正确'
									},
									remote: {
										url: "<?php echo U('login/emailcheck');?>",
										message: '帐号不存在',
										delay :  2000,
										type: 'POST'
									}
								}
							}
						}
					});

			$("body").on("keydown",function(event) {
				if (event.keyCode == "13") {
					$("#loginbtn").click();
				}
			});
		</script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="" >
<meta name="keywords" content=""> 
<title>SMS Striker Login</title> 
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
</head>
<body>
<div class="col-sm-12 col-md-12 header-main sms-innerpage-header col-xs-12 padding-zero">
<div class="col-sm-12 col-md-12 col-xs-12 container01">
<div class="col-sm-12 col-md-12 col-xs-12 header-top padding-zero">
<div class="col-sm-3 col-md-3 col-xs-12 padding-zero">
<a href="index.html"><img src="<?php echo  base_url(); ?>images/sms-striker-logo.png" alt="sms striker logo"></a>
</div>
<div class="col-sm-7 col-md-7 top-menu col-xs-12 padding-zero">
<nav class="navbar navbar-default">
  <div class="container-fluid padding-zero">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     
    </div>
                          
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="padding-zero collapse navbar-collapse" id="bs-example-navbar-collapse-1">
   <ul class="nav navbar-nav">
	   
        <li><a href="<?php echo  base_url(); ?>index.html">Home</a></li>
	    <li><a href="<?php echo  base_url(); ?>about-us.html">About</a></li>
		<li><a href="<?php echo  base_url(); ?>bulk-sms.html">SMS</a></li>
		<li><a href="<?php echo  base_url(); ?>long-code-sms-services.html">Long Code</a></li>
		<li><a href="<?php echo  base_url(); ?>short-link-url-services.html">Short Url</a></li>
        

		<li><a href="<?php echo  base_url(); ?>developers-overview.html">Developer</a>
		<div class="sub-menu-list">
		<ul class="sub-menu-striker">
		<li><a href="<?php echo  base_url(); ?>developers-overview.html">Overview</a></li>
		<li><a href="<?php echo  base_url(); ?>sms-gateway-api-integration-services.html">API</a></li>
		</ul>
		</div>
		</li>
<li><a href="http://blog.smsstriker.com/">Blog</a></li>
		<li><a href="<?php echo  base_url(); ?>index.html#sms-striker-contact-us">Contact</a></li>
		
       </ul>
    
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
<div class="col-sm-2 col-md-2 col-xs-12 login-reg-mcnter padding-zero">
<a href="<?php echo  base_url(); ?>User/login/<?php echo $this->uri->segment(3)?>" class="login-menu">Login or Register</a>
</div>
</div>


</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 login-padding-maindiv padding-zero">
<div class="container-login">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<div class="thanks-leftlogin">
<div class="col-sm-12 col-md-12 col-xs-12 thanks-padding-ltimg padding-zero">
<img src="<?php echo  base_url(); ?>images/sms-price-logo.png" class="img-responsive" alt="">
</div>
</div>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-zero">
<div class="thanks-rightlogin">
<span class="invalid-login"><?php if(isset($errmsg)){echo $errmsg;} ?></span>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">

<form class="login-form-smsstriker" id="validation-login" name="login_form" action="login" method="post">
<span class="invalid-login" id="userloginmsg"></span>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<input type="text" name="username" id="username" maxlength="20" minlength="5" placeholder="User Name">
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<input type="password" name="userpass" id="Password" maxlength="20" minlength="5" placeholder="Password">
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-6 col-md-6 col-xs-12 padding-mzero padding-rtzero">
<input type="text" name="captch"  id="entercaptchacode" class="form-login" placeholder="Enter Code">
</div>
<div class="col-sm-6 col-md-6 col-xs-12 padding-mzero padding-rtzero">
<input type="text" name="codetypecopy"  id="txtCaptcha" style="background: url(<?php echo  base_url(); ?>images_n/captcha.png);text-align:center; border:none; font-weight:bold; font-family:Modern; font-size:20px; font-size: 20px; width: 100px;" class="valid imgcaptcha" readonly oncopy="return false" onpaste="return false" oncontextmenu="return false">
<img title="Refresh new Captcha Code!" id="refresh-captcha" src="<?php echo  base_url(); ?>/images_n/refresh_1.png" class="refresh">
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<input type="hidden" name="priceid"  value="<?php if(isset($id)) echo $id; ?>" >
<input type="submit" name="login" id="Login" class="form-login" value="Login">
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-6 col-md-6 col-xs-12 padding-zero">
<a href="<?php echo  base_url(); ?>forgot.html" class="forgot-link">Forgot password?</a>
</div>

<!-- 
<div class="col-sm-6 col-md-6 col-xs-12 padding-zero">
<a href="<?php echo  base_url(); ?>index.php/User/signup/<?php echo  @$id; ?>" class="createaccount-link">Create an account</a>
</div>
-->
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>

<div class="col-sm-12 col-md-12 footer-bottom-top footer-border footer-services col-xs-12 padding-zero">
<div class="col-sm-12 col-md-12 col-xs-12 container01">
<div class="col-sm-6 col-md-6 col-xs-12 padding-zero">
<ul class="footer-menu">
<li><a href="<?php echo  base_url(); ?>index.html">Home </a></li>
<li><a href="<?php echo  base_url(); ?>about-us.html">About </a></li>
<li><a href="<?php echo  base_url(); ?>bulk-sms.html">Bulk SMS</a></li>
<li><a href="http://blog.smsstriker.com/">Blog</a></li>
<li><a href="<?php echo  base_url(); ?>index.html#sms-striker-contact-us">Contact</a></li>
</ul>
</div>
<div class="col-sm-6 col-md-6 col-xs-12 padding-zero">
<ul class="footer-social-icons">
<li><a href="https://www.facebook.com/smsstriker/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
<li><a href="https://twitter.com/smsstriker" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
<li><a href="https://plus.google.com/111944089972259140770" target="_blank"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
<li><a href="https://www.linkedin.com/company/striker-soft-solutions" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
<li><a href="https://www.pinterest.com/smsstrikerindia/" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
<li><a href="https://www.youtube.com/channel/UCqEm9n00y-XZ9LlQXvvvo4w" target="_blank"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
</ul>
</div>
</div>
</div>
<div class="col-sm-12 col-md-12 footer-bottom-copyright col-xs-12 padding-zero">
<div class="col-sm-12 col-md-12 col-xs-12 container01">
<div class="col-sm-6 col-md-6 col-xs-12 text-center-mob padding-zero">
<a href="<?php echo  base_url(); ?>privacy-policy.html">Disclaimers & Privacy Policy</a>
</div>
<div class="col-sm-6 col-md-6 col-xs-12 copy-right text-center-mob text-right padding-zero">
<p>2016 Striker Soft Solutions Pvt. Ltd. All Rights Reserved</p>
</div>
</div>
</div>
</body>

<link rel="stylesheet" href="<?php echo  base_url(); ?>css_newui/style1.css" type="text/css">
<link rel="stylesheet" href="<?php echo  base_url(); ?>css_newui/style.css" type="text/css">
<link rel="stylesheet" href="<?php echo  base_url(); ?>css_newui/bootstrap.min.css" type="text/css">

<link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>css/font-awesome.min.css" media="screen"/>

<script src="<?php echo  base_url(); ?>js/jquery.min.js"></script>
<script src="<?php echo  base_url(); ?>js/bootstrap.min.js"></script>

<script src="<?php echo  base_url(); ?>js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?php echo  base_url(); ?>js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo  base_url(); ?>js/form_validation/js/jquery-validate.bootstrap-tooltip.js" type="text/javascript"></script>

 <script type="text/javascript">
    
function DrawCaptcha()
{
	var chars = "0123456789abcdefghiklmnopqrstuvwxyz";
	var string_length = 6;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	   document.getElementById("txtCaptcha").value = randomstring; 
}
DrawCaptcha();	
    </script>



<script type="text/javascript">
	$( document ).ready(function( $ ) {

		$("#username").val('');
		$("#Password").val('');

		$("#username").on("click",function() {
			 $("#username").val('');
		});

		$("#Password").on("click",function() {
			 $("#Password").val('');
		});
		
		// refresh-captcha code
	$("#refresh-captcha").on("click",function(){
		DrawCaptcha();
	});

	$("#Login").on("click",function(){
		if($("#entercaptchacode").val() != $("#txtCaptcha").val()){
			DrawCaptcha();
			}
		
	});
	
	$("#validation-login").validate({
		 rules:  {
				username: {
				required: true,
				minlength:5,
				maxlength:25,
				alphanumeric: true
				},
				userpass: {
				required: true,
				minlength:5,
				maxlength:10


				},
				captch: {
				required: true,
				equalTo:"#txtCaptcha"
				}
				
			},
			messages: 
			{
				username: {
				required: "Please Enter UserName",
				minlength: "username must be at least 5 characters long"

				},
				userpass: {
				required: "Please Enter Password",
				minlength: "Password must be at least 5 characters long", 
				maxlength: "Password must be 10 characters only"	
				},
				captch: {
				required: "Please Enter Captcha Code",
				equalTo: "Please Enter valid Captcha Code"
				}
				
			}
			,
			tooltip_options: 
			{
				username: {placement:'bottom',html:true},
				userpass: {placement:'bottom',html:true},
				captch: {placement:'bottom',html:true},
				
			}
	    });
		
	});
</script>

</html>

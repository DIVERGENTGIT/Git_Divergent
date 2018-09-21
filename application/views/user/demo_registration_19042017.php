<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="" >
<meta name="keywords" content=""> 
<title>Demo Register</title> 
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
		<li><a href="<?php echo  base_url(); ?>bulk-sms.html">Bulk SMS</a></li>
		<li><a href="<?php echo  base_url(); ?>long-code-sms-services.html">Long Code</a></li>
		<li><a href="<?php echo  base_url(); ?>short-link-url-services.html">Short URL</a></li>

		<li><a href="<?php echo  base_url(); ?>developers-overview.html">Developer</a>
		<div class="sub-menu-list">
		<ul class="sub-menu-striker">
		<li><a href="<?php echo  base_url(); ?>developers-overview.html">Overview</a></li>
		<li><a href="<?php echo  base_url(); ?>sms-gateway-api-integration-services.html">API</a></li>
		</ul>
		</div>
		</li>
		<li><a href="http://blog.smsstriker.com/" target="_blank">Blog</a></li>
		<li><a href="<?php echo  base_url(); ?>index.html#sms-striker-contact-us">Contact</a></li>
		
       </ul>
    
    
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
<div class="col-sm-2 col-md-2 col-xs-12 login-reg-mcnter padding-zero">
<a href="<?php echo  base_url(); ?>/index.php/login" class="login-menu">Login or Register</a>
</div>
</div>


</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 mrg-btm65 padding-dzero">

<form class="regform-form-smsstriker" id="validation-signup" >

<div class="col-sm-12 col-md-12 col-xs-12 padding-zero reg-border">
 <span id="userexist" style="float:right;"> </span>
<div class="col-sm-12 col-md-12 col-xs-12 account-details padding-zero">
Account Details
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-lrt75">
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">

<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>Username</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<input type="text" name="username" id="username"  maxlength="20" minlength="5"  placeholder="User Name">
<span class="usernamemsg"></span>
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>Password</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<input type="password" id="userpassword" name="userpassword"  maxlength="20" minlength="5" placeholder="Password">
</div>
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 contact-details padding-zero">
Contact Details
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-lrt75">
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>First Name</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<input type="text" name="firstname" id="firstname"  maxlength="20" minlength="5" placeholder="First Name">
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>Last Name</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<input type="text" name="lastname" id="lastname"  maxlength="20" minlength="5" placeholder="Last Name">
</div>

</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>Email Address</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<input type="text" name="email" value="<?php echo @$email;?>" id="emailid" maxlength="30" minlength="4" placeholder="Email address">
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>Mobile Number</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<input type="text" name="mobile" value="<?php echo @$mobile;?>" id="mobileno" maxlength="10" minlength="10" placeholder="Mobile number">
<span class="mobilenomsg"></span>
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>Organization Name</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12  padding-ltzero padding-mzero">
<input type="text" name="organization" id="organization" maxlength="50" minlength="4" placeholder="Organization name">
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>Address 1</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<input type="text" name="address1" id="address1" placeholder="Address 1">
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>Address 2</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<input type="text" name="address2" id="address2"  placeholder="Address 2">
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>State</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">

<select name="state" id="state_id"  >
<option value="">Select State</option></select>
</select>

</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>City</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<select name="city" id="city_id" ><option value="">Select City</option></select>
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>Zip Code</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<input type="text" name="pincode" maxlength="9" id="pincode" placeholder="Pin Code">
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-4 col-md-4 col-xs-12 padding-zero">
<label>Captcha</label>
</div>
<div class="col-sm-8 col-md-8 col-xs-12 padding-ltzero padding-mzero">
<div class="col-sm-6 col-md-6 col-xs-12 padding-rtzero">
<input type="text" name="captcha" id="captchacode" maxlength="10" minlength="4" class="form-registration" placeholder="Enter Captcha Code">
</div>
<div class="col-sm-6 col-md-6 col-xs-12 padding-zero">
<input type="text" name="codetypecopy"  id="txtCaptcha" style="background: url(<?php echo base_url()?>/images_n/captcha.png);text-align:center; border:none; font-weight:bold; font-family:Modern; font-size:20px; font-size: 20px; width: 100px;" class="valid imgcaptcha" readonly oncopy="return false" onpaste="return false" oncontextmenu="return false">
<img title="Refresh new Captcha Code!" id="refresh-captcha" src="<?php echo base_url()?>/images_n/refresh_1.png" class="refresh">
</div>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-8 col-md-8 col-sm-offset-4 col-md-offset-4 col-xs-12 padding-ltzero padding-mzero">
<input type="hidden" name="priceid" id="priceid" value="<?php echo  @$id; ?>" >
<input type="button" name="registration" class="sms-first-form form-registration" id="registration" value="Registration">

</div>
</div>
</div>
</div>
</form>
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
<link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>css_newui/slider-pro.min.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="<?php echo  base_url(); ?>css/font-awesome.min.css" media="screen"/>


<script src="<?php echo  base_url(); ?>js/jquery.min.js"></script>
<script src="<?php echo  base_url(); ?>js/bootstrap.min.js"></script>
<script src="<?php echo  base_url(); ?>js/jquery.validate.min.js"></script>
<script src="<?php echo  base_url(); ?>js/additional-methods.min.js"></script>
<script src="<?php echo  base_url(); ?>js/form_validation/js/jquery-validate.bootstrap-tooltip.js" type="text/javascript"></script>
<!--  
<script type="text/javascript" src="<?php echo  base_url(); ?>js/registration/registration.js"></script>
-->
<script type="text/javascript" >
$( document ).ready(function( $ ) {
	var baseurl="<?php echo  base_url(); ?>";

	$.validator.addMethod("alphanumericspace", function(value, element) {
	        return this.optional(element) || /^[A-Za-z0-9-_]+( [A-Za-z0-9-_]+)*$/i.test(value);
	    },'Should allowed Numbers, Letters, hyphen, underscore, space between word');
		
	$.validator.addMethod("regexpcol", function(value, element, param) { 
	  return this.optional(element) || !(/['"]/).test(value); 
	},'Single quotes and double quotes not allowed');

	jQuery.validator.addMethod("myEmail", function(value, element) {
	    return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
	}, 'Please enter valid email address.'); 



		 $("#validation-signup").validate({
			 rules:  {
					username: {
					required: true,
					minlength:5,
					maxlength:25,
					alphanumeric: true,
					regexpcol: true
					},
					firstname: {
					required: true,
					minlength:5,
					maxlength:25,
					alphanumeric: true,
					regexpcol: true
					},
					lastname: {
					required: true,
					minlength:5,
					maxlength:25,
					alphanumeric: true
					
					},
					mobile: {
					required: true,
					minlength:10,
					maxlength:10,
					number: true			
					},
					userpassword: {
					required: true,
					minlength:5,
					maxlength:10,
					
					regexpcol: true

					},
					email: {
					required: true,
					maxlength:50,
					myEmail:true

					},
					organization: {
					required: true,
					regexpcol: true
					},
					address1: {
					required: true,
					regexpcol: true
					},
					address2: {
					required: true,
					regexpcol: true
					},
					state: {
					required: true,
					},
					city: {
					required: true,
					},
					pincode: {
					required: true,
					number: true
					},
					captcha: {
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
					firstname: {
					required: "Please Enter First Name",
					minlength: "username must be at least 5 characters long"

					},
					lastname: {
					required: "Please Enter Last Name",
					minlength: "username must be at least 5 characters long"

					},
					mobile: {
					required: "Please Enter Mobile Number",
					minlength: "Please Enter 10 Digit Mobile Number", 
					maxlength: "Please Enter 10 Digit Mobile Number",

					number: "Please Enter Numbers Only"				
					},
					userpassword: {
					required: "Please Enter Password",
					minlength: "Password must be at least 5 characters long", 
					maxlength: "Password must be 10 characters only"	
					},
					
					email: {
					required: "Please Enter Email",
					email: "Please Enter Valid Email" 				
					},
					organization: {
					required: "Please Enter Organization Name"
					},
					address1: {
					required: "Please Enter Address1"
					},
					address2: {
					required: "Please Enter Address2"
					},
					state: {
					required: "Please Select State"
					},
					city: {
					required: "Please Select City"
					},
					pincode: {
					required: "Please Enter Pin Code"
					},
					 captcha: {
						required: "Please Enter Captcha Code",
						equalTo: "Please Enter valid Captcha Code"
						}
					
						
				}
				,
				tooltip_options: 
				{
					username: {placement:'bottom',html:true},
					firstname: {placement:'bottom',html:true},
					lastname: {placement:'bottom',html:true},
					email: {placement:'bottom',html:true},
					userpassword: {placement:'bottom',html:true},
					mobile: {placement:'bottom',html:true},
					organization: {placement:'bottom',html:true},
					address1: {placement:'bottom',html:true},
					address2: {placement:'bottom',html:true},
					state: {placement:'bottom',html:true},
					city: {placement:'bottom',html:true},
					pincode: {placement:'bottom',html:true},
					captcha: {placement:'bottom',html:true}
				}
		    })



	//user registration start
		$(".form-registration").on("click",function(event){
			
			// enter press validation
		if($("#validation-signup").valid())
			{
			
				var username=$("#username").val();
				var firstname=$("#firstname").val();
				var lastname=$("#lastname").val();
				var password=$("#userpassword").val();
				var emailid=$("#emailid").val();
				var mobileno=$("#mobileno").val();
				var organization=$("#organization").val();
				var address1=$("#address1").val();
				var address2=$("#address2").val();
				var state_id=$("#state_id").val();
				var city_id=$("#city_id").val();
				var pincode=$("#pincode").val();
				var captchacode=$("#captchacode").val();
				var originalcaptchacode=$("#originalcaptchacode").val();
				var registration=$("#registration").val();
				var id=$("#priceid").val();

				//validation start
				var username=$("#username").val();
				if(username.length > 5)
				{
				$(".usernamemsg").show();
				$.ajax({
					type:"GET",
					url:urlstr,
					data:{unvalidation:"unvalidation",username:username},
					dataType:"json",
					success:function(response)
					{
						console.log(response);
						
						$(".usernamemsg").html(response.message);
						$(".usernamemsg").css('color',response.color);
					
						if(response.color=='green')
						{
						
							var mobileno=$("#mobileno").val();
							if(mobileno.length=='10')
							{
							$(".mobilenomsg").show();
							$.ajax({
								type:"GET",
								url:urlstr,
								data:{mbnovalidation:"mbnovalidation",mobileno:mobileno},
								dataType:"json",
								success:function(response1)
								{
									console.log(response1);
									
									$(".mobilenomsg").html(response1.message);
									$(".mobilenomsg").css('color',response1.color);
									
									//validation on captchacode code
									if(response1.color=='green')
										{
										// calling server side php script start
										var urlstr=baseurl+"registration.php";
										$.ajax({
											type:"GET",
											url:urlstr,
											data:{registration:registration,username:username,firstname:firstname,lastname:lastname,password:password,emailid:emailid,
											mobileno:mobileno,organization:organization,address1:address1,address2:address2,
											state_id:state_id,city_id:city_id,pincode:pincode,demo:"demo",id:id},
											success:function(response)
											{
												console.log(response);
												if(response.status=='1'){
													
													//console.log("http://10.10.10.112/smsnewui/login.html");
												    //alert("You have successfully registered with us.");
												 
												// window.location.href = baseurl+"index.php/login";
										//window.location.href=baseurl+"thank-you.php?sendemail=registration&ud="+username+"&id="+id;
													window.location.href=baseurl+"message.php?sendemail=registration&ud="+username+"&id="+id;	 
												 }else{

												 $("#userexist").html('User Already Exist');
												 $("#userexist").css('color','red');
												 }
											},
											error:function(error)
											{
												//alert(error);
												console.log(error);
											}
										    });
										}
								},
								error:function(error)
								{
									//alert(error);
									console.log(error);
								}
							});

							}
							else
							{
							$(".mobilenomsg").hide();
							}
							
							
						}
						
						
					},
					error:function(error)
					{
						//alert(error);
						console.log(error);
					}
				});

				}
				else
				{
				$(".usernamemsg").hide();
				}
			
				// validation end
			}
		  else
			  {
			  DrawCaptcha();
			  }
			
		});

		// get all state names	
			$.ajax({
				type:"GET",
				url:baseurl+"registration.php",
				data:{getstate:"all"},
				dataType:"html",
				success:function(response)
				{
					console.log(response);
					
					$("#state_id").html(response);
				},
				error:function(error)
				{
					//alert(error);
					console.log(error);
				}
					
			});
	var urlstr=	baseurl+"registration.php";
			// get all cities names
			console.log(urlstr);
			$("#state_id").on("change",function(){
				var state_id=$("#state_id").val();
				$.ajax({
					type:"GET",
					url:urlstr,
					data:{getcity:"all",state_id:state_id},
					dataType:"html",
					success:function(response)
					{
						console.log(response);
						
						$("#city_id").html(response);
					},
					error:function(error)
					{
						//alert(error);
						console.log(error);
					}
						
				});
				
			});
			
			// user name validation
			$("#username").on("blur",function(){
				var username=$("#username").val();
				if(username.length > 5)
				{
				$(".usernamemsg").show();
				$.ajax({
					type:"GET",
					url:urlstr,
					data:{unvalidation:"unvalidation",username:username},
					dataType:"json",
					success:function(response)
					{
						console.log(response);
						
						$(".usernamemsg").html(response.message);
						$(".usernamemsg").css('color',response.color);
					},
					error:function(error)
					{
						//alert(error);
						console.log(error);
					}
				});

				}
				else
				{
				$(".usernamemsg").hide();
				}
				
			});

			// user Mobile no validation
			$("#mobileno").on("blur",function(){
				var mobileno=$("#mobileno").val();
				if(mobileno.length=='10')
				{
				$(".mobilenomsg").show();
				$.ajax({
					type:"GET",
					url:urlstr,
					data:{mbnovalidation:"mbnovalidation",mobileno:mobileno},
					dataType:"json",
					success:function(response)
					{
						console.log(response);
						
						$(".mobilenomsg").html(response.message);
						$(".mobilenomsg").css('color',response.color);
					},
					error:function(error)
					{
						//alert(error);
						console.log(error);
					}
				});

				}
				else
				{
				$(".mobilenomsg").hide();
				}
				
			});
			
			
			//mobile no validation
			$("#mobileno").keydown(function (e) {
			       // Allow: backspace, delete, tab, escape, enter and .
			       if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
			            // Allow: Ctrl+A, Command+A
			           (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
			            // Allow: home, end, left, right, down, up
			           (e.keyCode >= 35 && e.keyCode <= 40)) {
			                // let it happen, don't do anything
			                return;
			       }
			       // Ensure that it is a number and stop the keypress
			       if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
			           e.preventDefault();
			       }
			   });
			
			// refresh-captcha code
			
			$("#refresh-captcha").on("click",function(){
				DrawCaptcha();
			});
			
			
	});

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

</body>
</html>

</html>

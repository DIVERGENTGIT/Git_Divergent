<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Register in smsstriker.com and free Trial bulk sms service In India">
<meta name="keywords" content="Register Smsstriker"> 
<title>SMS Striker Register</title> 
<link rel="icon" href="<?php echo base_url();?>images-new/favicon.gif" type="image/gif">
<link rel="stylesheet" href="<?php echo base_url();?>smsstriker-css/font-awesome.min.css" type="text/css"> 
<link rel="stylesheet" href="<?php echo base_url();?>smsstriker-css/bootstrap.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>smsstriker-css/style.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>smsstriker-css/aos.css" type="text/css"> 
<script type="text/javascript" src="<?php echo base_url();?>smsstriker-js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>smsstriker-js/bootstrap.js"></script>
<style>
.containerreg1 {
    width: 100%;
    max-width: 380px;
    margin: auto;
    background: #f1f1f2;
    padding: 15px;
    overflow: hidden;
    margin-bottom: 40px;
}
</style>
</head>

<body>
 
 <div class="col-sm-12 col-md-12 col-xs-12 header-border padding-zero">
<div class="container01" data-include="nav"> 

</div>
</div>  
  

<section class="col-sm-12 col-md-12 col-xs-12 regmrgcontain padding-zero">
<div class="col-sm-offset-4 col-sm-4 padding-zero vcenter">
<article class="containerreg">
<form class="regform-form-smsstriker" id="validation-signup" >
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-12 col-md-12 col-xs-12 regform-div padding-zero">
<h1 class="detail-title">Account Details</h1>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 regform-div padding-zero">
<input type="text" name="username" id="username" maxlength="20" minlength="5" placeholder="User Name"  >
<span class="usernamemsg"></span>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 regform-div padding-zero">
<input type="password" id="userpassword" name="userpassword" maxlength="20" minlength="5" placeholder="Password"  >
<span class="userpwdmsg" style='color:red;'></span>
</div>  
<div class="col-sm-12 col-md-12 col-xs-12 regform-div padding-zero">
<h4 class="detail-title">Contact Details</h4>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="row">
<div class="col-sm-6 col-md-6 col-xs-12 regform-div">
<input type="text" name="fname" id="firstname"  placeholder="First Name"  >
</div>
<div class="col-sm-6 col-md-6 col-xs-12 regform-div">
<input type="text" name="lname" id="lastname" placeholder="Last Name"  >
</div>
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 regform-div padding-zero">  
<input type="text" name="email"   value="<?php echo @$email;?>" id="emailid" placeholder="Email address" >
</div>
<div class="col-sm-12 col-md-12 col-xs-12 regform-div padding-zero">  
<input type="text" name="phone"  value="<?php echo @$mobile;?>" id="mobileno" placeholder="Mobile number" >
<span class="mobilenomsg"></span>
</div>  
<div class="col-sm-12 col-md-12 col-xs-12 regform-div padding-zero">
<input type="text" name="organization" id="organization" placeholder="Organization Name" >
</div>
<div class="col-sm-12 col-md-12 col-xs-12 regform-div padding-zero">
<input type="text"  name="address1" id="address1" placeholder="Address 1" >
</div>
<div class="col-sm-12 col-md-12 col-xs-12 regform-div padding-zero">
<input type="text"  name="address2" id="address2" placeholder="Address 2"  ">
</div>
<div class="col-sm-12 col-md-12 col-xs-12 regform-div padding-zero" >

<select name="state" id="state_id"  >
<option value="">Select State</option></select>
</select>

</div>
<div class="col-sm-12 col-md-12 col-xs-12 regform-div padding-zero">

<select name="city" id="city_id" ><option value="">Select City</option></select>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 regform-div padding-zero">
<input type="text" name="pincode" maxlength="9" id="pincode" placeholder="Pin Code"  >
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="col-sm-6 col-md-6 col-xs-12 regform-div padding-ltzero">
<input type="text" name="captcha" id="captchacode" maxlength="10" minlength="4" placeholder="Enter Captcha Code">
</div>

<div class="col-sm-6 col-md-6 col-xs-12 regform-div padding-zero">
<input type="text" name="codetypecopy" id="txtCaptcha" class="valid imgcaptcha" readonly oncopy="return false" onpaste="return false" oncontextmenu="return false" aria-invalid="false">
<i class="fa fa-refresh refresh" id="refresh-captcha" aria-hidden="true"></i>
</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 regform-div padding-zero">
<input type="hidden" name="priceid" id="priceid" value="<?php echo  @$id; ?>" >

<div class="checkbox">
  <label><input type="checkbox" id='termsConds" name="termsConds" vlues='' >Agree with the <a href="https://www.smsstriker.com/terms-of-services.html">Terms and Conditions</a>*</label>
<p id='termsValidError' style='color:red;'></p>
</div>

<input type="button" name="registration" class="regfrmbtn registration-submit" id="registration" value="Register">

</div>
</div>
</form>
</article>
 
</div><!--
--><div class="col-sm-3 padding-zero vcenter">
    <ul class="password-note">
    <li><strong>Password must be</strong></li>
    <li>Be at least 9 characters</li>
    <li>Include an Uppercase letter</li>
    <li>Include a lowercase letter</li>
    <li>Include a number</li>
    <li>No start or end with a space</li>
    </ul>
	</div>
</section> 
 
 
 
 
<footer class="col-sm-12 col-md-12 col-xs-12 main-footer padding-zero" data-include="footer">

</footer>
</body>

 
 
 
  <script src="<?php echo base_url();?>smsstriker-js/jquery.validate.min.js"></script>
    <script src="<?php echo base_url();?>smsstriker-js/additional-methods.min.js"></script> 
    <script src="<?php echo base_url();?>smsstriker-js/form_validation/js/jquery-validate.bootstrap-tooltip.js" type="text/javascript"></script>
<script type="text/javascript" >
$(document).ready(function($) {
 


function checkPolicyIsCheck()
{	
 
 
    if($('input[type="checkbox"]').prop("checked") == true){
       	$('#termsValidError').text('');
	return true;
    }
    else if($('input[type="checkbox"]').prop("checked") == false){
       	 $('#termsValidError').text('Please accept our policy');
	return false;
	}
    
}


$('#userpassword').on('change',function() {
   	var password = $("#userpassword").val();
	if(password.length > 10) {
		//$('.userpwdmsg').text('Password must be 10 characters only');
	}else if(password.search(/\d/) == -1) {
		$('.userpwdmsg').text('Password must include a number');
	}else if(password.search(/[a-z]/) == -1) {  
		$('.userpwdmsg').text('Password must include an lowercase letter');
	}else if(password.search(/[A-Z]/) == -1) {
		$('.userpwdmsg').text('Password must include an uppercase letter'); 
	}else if(!(/^\S*$/).test(password)) {
		$('.userpwdmsg').text('Password must not start or end with a space');
	}else{  
		$('.userpwdmsg').text('');   
	}
   
});

$.validator.addMethod("alphanumericspace", function(value, element) {
        return this.optional(element) || /^[A-Za-z0-9-_]+( [A-Za-z0-9-_]+)*$/i.test(value);
    },'Should allowed Numbers, Letters, hyphen, underscore, space between word');
	
$.validator.addMethod("regexpcol", function(value, element, param) { 
  return this.optional(element) || !(/['"]/).test(value); 
},'Single quotes and double quotes not allowed');

jQuery.validator.addMethod("myEmail", function(value, element) {
    return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
}, 'Please enter valid email address.'); 


 var baseurl = "<?php echo base_url();?>";
 
	 $("#validation-signup").validate({
		 rules:  {
				username: {
				required: true,
				minlength:5,
				maxlength:25,
				alphanumeric: true,
				regexpcol: true
				},
				fname: {
				required: true,
				minlength:5,
				maxlength:25,
				alphanumeric: true,
				regexpcol: true
				},
				lname: {
				required: true,
				minlength:1,
				maxlength:25,
				alphanumeric: true
				
				},
				phone: {
				required: true,
				//minlength:10,
				//maxlength:10,
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
				fname: {
				required: "Please Enter First Name",
				minlength: "username must be at least 5 characters long"

				},
				lname: {
				required: "Please Enter Last Name",
				minlength: "username must be at least 5 characters long"

				},
				phone: {
				required: "Please Enter Mobile Number",
				//minlength: "Please Enter 10 Digit Mobile Number", 
				//maxlength: "Please Enter 10 Digit Mobile Number",

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
				fname: {placement:'bottom',html:true},
				lname: {placement:'bottom',html:true},
				email: {placement:'bottom',html:true},
				userpassword: {placement:'bottom',html:true},
				phone: {placement:'bottom',html:true},
				organization: {placement:'bottom',html:true},
				address1: {placement:'bottom',html:true},
				address2: {placement:'bottom',html:true},
				state: {placement:'bottom',html:true},
				city: {placement:'bottom',html:true},
				pincode: {placement:'bottom',html:true},
				captcha: {placement:'bottom',html:true}
			}
	    });


		$(".registration-submit").on("click",function(event){
			var checkPlolicy = checkPolicyIsCheck();
		 	$("#userexist").html('');	
 
		       if($("#validation-signup").valid()) {

 			 if(checkPlolicy) {
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

					$(".usernamemsg").html(response.message);
					$(".usernamemsg").css('color',response.color);
				
					if(response.color=='green')
					{
						if(password.length > 10) {
								//$('.userpwdmsg').text('Password must be 10 characters only');
							}else if(password.search(/\d/) == -1) {
								$('.userpwdmsg').text('Password must include a number');
							}else if(password.search(/[a-z]/) == -1) {
								$('.userpwdmsg').text('Password must include an lowercase letter');
							}else if(password.search(/[A-Z]/) == -1) {
								$('.userpwdmsg').text('Password must include an uppercase letter'); 
							}else if(!(/^\S*$/).test(password)) {
								$('.userpwdmsg').text('Password must not start or end with a space');
							}else{  
							$('.userpwdmsg').text('');
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

									$(".mobilenomsg").html(response1.message);
									$(".mobilenomsg").css('color',response1.color);
																			
									if(response1.color=='green') 
										{
										var urlstr=baseurl+"registration.php";
	 									 
										$.ajax({
											type:"GET",
											url:urlstr,
											dataType:"json",
											data:{registration:registration,username:username,firstname:firstname,lastname:lastname,password:password,emailid:emailid,									mobileno:mobileno,organization:organization,address1:address1,address2:address2,									state_id:state_id,city_id:city_id,pincode:pincode,paynow:"paynow",id:id},
											success:function(response)
											{
	 

													if(response.code=='1'){
									window.location.href=baseurl+"message.php?sendemail=registration&ud="+username+"&id="+id;
												 }
												 
												 if(response.code=='2'){
												 $(".usernamemsg").html('User Name already in use');
												 $(".usernamemsg").css('color','red');
												 }
											},
											error:function(error)
											{
											}
										    });

									    
										}
								
								},
								error:function(error)
								{
								}
							});

							}
							else
							{
							$(".mobilenomsg").hide();
							}
						}
						
					}
					
					
				},
				error:function(error)
				{
				}
			});

			}
			else
			{
			$(".usernamemsg").hide();
			}
		
			}
		    }  else  {   DrawCaptcha();  }
			
		});

			$.ajax({
				type:"GET",
				url:baseurl+"registration.php",
				data:{getstate:"all"},
				dataType:"html",
				success:function(response)
				{
					
					$("#state_id").html(response);
				},
				error:function(error)
				{
				}
					
			});
	var urlstr= baseurl+"registration.php";
			$("#state_id").on("change",function(){
				var state_id=$("#state_id").val();
				$.ajax({
					type:"GET",
					url:urlstr,
					data:{getcity:"all",state_id:state_id},
					dataType:"html",
					success:function(response)
					{
						
						$("#city_id").html(response);
					},
					error:function(error)
					{
					}
						
				});
				
			});

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
						
						$(".usernamemsg").html(response.message);
						$(".usernamemsg").css('color',response.color);
					},
					error:function(error)
					{
					}
				});

				}
				else
				{
				$(".usernamemsg").hide();
				}
				
			});

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
						
						$(".mobilenomsg").html(response.message);
						$(".mobilenomsg").css('color',response.color);
					},
					error:function(error)
					{
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

 
  <script type="text/javascript">

    $(function () {
    	var base_url = "<?php echo base_url();?>";
        var includes = $('[data-include]');

        jQuery.each(includes, function () {
            var file = base_url+'includesview/' + $(this).data('include') + '.html';
            $(this).load(file);  
            
        });
    });

    $(document).ready(function () {
        $(".product-hover, .sub-menu-list02").hover(function (event) {
            $(".sp-layer").toggle();
        });

        $(".subemenumob").click(function () {
            $(".sub-menu-list02").toggleClass("mobsub-menu");

        });

    });
    </script>
</body>
</html>

</html>

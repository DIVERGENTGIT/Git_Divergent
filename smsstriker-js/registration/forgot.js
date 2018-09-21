$( document ).ready(function( $ ) {
	// refresh-captcha code
	//var baseurl="http://www.smsstriker.com/";
	$("#refresh-captcha").on("click",function(){
		DrawCaptcha();
	});	
	// Login form validation
	$("#username").val('');
	$("#username").on("click",function() {
		 $("#username").val('');
	});
	
	$.validator.addMethod("regexpcol", function(value, element, param) { 
  return this.optional(element) || !(/['"]/).test(value); 
},'Single quotes and double quotes not allowed');
	$("#validation-forgot").validate({
		 rules:  {
				username: {
				required: true,
				minlength:5,
				maxlength:25,
				regexpcol:true
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
				    captch: {
					required: "Please Enter Captcha Code",
					equalTo: "Please Enter valid Captcha Code"
					}
			}
			,
			tooltip_options: 
			{
				username: {placement:'bottom',html:true},
				captch: {placement:'bottom',html:true}
			}
	    });
	    
	var status='';
	$("#forgot").on("click",function(e){
			e.preventDefault();
	/*
			if($("#entercaptchacode").val() != $("#txtCaptcha").val()){
				DrawCaptcha();
				}
		*/	
		if($("#validation-forgot").valid())
		{  
			
			var username=$("#username").val();
			var forgot=$("#forgot").val();
			var entercaptchacode=$("#entercaptchacode").val();
			var txtCaptcha=$("#txtCaptcha").val();
			
			if(entercaptchacode==txtCaptcha)
			{
				$("#userloginmsg").html("");
				if(username!='')
				{
					
					if(status=='')
					{
				var urlstr=baseurl+"registration.php";
					// calling server side php script start
					$.ajax({
					type:"post",
					url:urlstr,
					dataType:"json",
					data:{forgot:forgot,username:username},
					success:function(response)
					{
 
 
							if(response.status=='failed')
							{   
							$("#forgotmsg").html("Invalid username.please try again!..");
							$("#forgotmsg").css("color","red");
							}else
							if(response.errorCode == 200)
							{  
							 	
							 	$('#validation-forgot').css('display','none');
								$('#otpVerify').css('display','block');	
								$('#fpuserID').val(response.username);	 
							}else if(response.errorCode == 201) {
								$("#forgotmsg").html("Please contact admin to rest your password !!..");
								$("#forgotmsg").css("color","red");
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
					DrawCaptcha();
					$("#forgotmsg").html("Please check your E-mail/Mobile for password!..");
					$("#forgotmsg").css("color","red");
					}
				}
				else
				{
				DrawCaptcha();
				$("#forgotmsg").html("Please enter username!...");
				$("#forgotmsg").css("color","red");
				}
			}
		else
			{
			DrawCaptcha();
			$("#forgotmsg").html("Invalid Captcha Code!..");
			$("#forgotmsg").css("color","red");
		   }
				
		}
		  else
			  {
			  DrawCaptcha();
			  }
		
			return false;
		});



  
$('#verifyOTP').on('click',function(e) {
 
	 e.preventDefault();  
	var otpCode = $('#otpCode').val();
	var fpuserID = $('#fpuserID').val();	
	if(otpCode.length == '') {
		$('#otperror').text('Please Enter OTP'); 
	}else{
		var urlstr=baseurl+"registration.php"; 
		$.ajax({  
			type:"post",  
			url:urlstr,
			dataType:"json",
			data:{'OTP':'verification','fpuserID':fpuserID,'otpCode':otpCode},
			success:function(response)
			{  
 
				if(response.status=='failed')
				{   
					$("#otperror").html("Invalid OTP. Please try again!..");
					$("#otperror").css("color","red");
				}else if(response.errorCode == 200)
				{  
					$("#otperror").html("Password sent to your E-mail & Mobile !!..");
					$("#otperror").css("color","green");
				 
					$.ajax({
						type:"post",
						url:urlstr,
						data:{forgotmsg:"forgotmsg"},
						success:function(response)
						{
			  
						} 
	 				});
				}else if(response.errorCode == 201) { 
					$("#otperror").html("Please contact admin to rest your password !!..");
					$("#otperror").css("color","red");
				}else if(response.errorCode == 202) {
					$("#otperror").html("Please check your E-mail/Mobile for password!..");
					$("#otperror").css("color","red");
				} 
				 
			}
  
		});	
	}    

	return false;  

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

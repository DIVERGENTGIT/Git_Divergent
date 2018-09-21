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
					type:"GET",
					url:urlstr,
					dataType:"json",
					data:{forgot:forgot,username:username},
					success:function(response)
					{
							console.log(response);	
							//console.log(response.errorCode);
							if(response.status =='failed' && response.errorCode == 201)
							{   
							$("#forgotmsg").html("Invalid username.please try again!..").css("color","red");
							}else
							if(response.errorCode == 200) 
							{
							 	status='success';
								$("#forgotmsg").html("Password sent to your E-mail & Mobile !!..").css("color","green");
								  
								var mobile=response.mobile;
								$.ajax({
								type:"GET",
								url:urlstr,
								data:{forgotmsg:"forgotmsg"},
								success:function(response)
								{
								    
								}
								 });
							//$("#forgotmsg").html(response.message);
							//$("#forgotmsg").css("color",response.color);
							}else if(response.errorCode == 201 && response.status=='success') {
								$("#forgotmsg").html("Please contact admin to rest your password !!..");
								$("#forgotmsg").css("color","red");
							}  
					},
					error:function(error)
					{
						//alert(error);
							//console.log(error);
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

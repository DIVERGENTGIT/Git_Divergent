$( document ).ready(function( $ ) {
//var baseurl="http://localhost/smsstriker/";

//var baseurl=" ";

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
	    })

 
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


//user registration start
	 $('#registration').click(function() {
		var checkPlolicy = checkPolicyIsCheck();		
	if($("#validation-signup").valid())
		{
 
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
				// validation start
				var username=$("#username").val();
				if(username.length >= 5)
				{
				$(".usernamemsg").show();
				$.ajax({
					type:"GET",
					url:urlstr,
					data:{unvalidation:"unvalidation",username:username},
					dataType:"json",
					success:function(response)
					{
						//console.log(response);
					
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
										//console.log(response1);
								
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
												dataType:"json",
												data:{registration:registration,username:username,firstname:firstname,lastname:lastname,password:password,emailid:emailid,
												mobileno:mobileno,organization:organization,address1:address1,address2:address2,
												state_id:state_id,city_id:city_id,pincode:pincode},
												success:function(response)
												{
												//console.log(response);
													if(response.code=='1')
													{
											var username=response.data;
											window.location.href=baseurl+"thank-you.php?sendemail=sendemail&un="+username;
													}
													if(response.code=='2')
													{
											window.location.href=baseurl+"index.php/login";
													}
												},
												error:function(error)
												{
													//alert(error);
													//console.log(error);
												}
											    });
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
								$(".mobilenomsg").hide();
								}
						
							    }
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
				$(".usernamemsg").hide();
				}
		
			// validation end
		    	 }
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
				//console.log(response);
				
				$("#state_id").html(response);
			},
			error:function(error)
			{
				//alert(error);
				//console.log(error);
			}
				
		});
var urlstr=	baseurl+"registration.php";
		// get all cities names
		//console.log(urlstr);
		$("#state_id").on("change",function(){
			var state_id=$("#state_id").val();
			$.ajax({
				type:"GET",
				url:urlstr,
				data:{getcity:"all",state_id:state_id},
				dataType:"html",
				success:function(response)
				{
					//console.log(response);
					
					$("#city_id").html(response);
				},
				error:function(error)
				{
					//alert(error);
					//console.log(error);
				}
					
			});
			
		});
		
		
		// user name validation
		$("#username").on("blur",function(){
			
			var username=$("#username").val();
			if(username.length >= 5)  
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
					//alert(error);
					//console.log(error);
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
			//$(".mobilenomsg").show();
			$.ajax({
				type:"GET",
				url:urlstr,
				data:{mbnovalidation:"mbnovalidation",mobileno:mobileno},
				dataType:"json",
				success:function(response)
				{
					//console.log(response);
					
					$(".mobilenomsg").html(response.message);
					$(".mobilenomsg").css('color',response.color);
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
				$(".mobilenomsg").text('Please Enter 10 Digit Mobile Number').css('color','red');
			//$(".mobilenomsg").hide();
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



	    


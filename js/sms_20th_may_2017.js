
$(document).ready(function() {
	$.validator.addMethod("alphanumericspace", function(value, element) {
        return this.optional(element) || /^[A-Za-z0-9-_]+( [A-Za-z0-9-_]+)*$/i.test(value);
    },'Should allowed Numbers, Letters, hyphen, underscore, space between word');
	$.validator.addMethod('minStrict', function (value, el, param) {
	    return value > param;
	},'Please enter 500 or above 500 SMS');
$.validator.addMethod("regexpcol", function(value, element, param) { 
  return this.optional(element) || !(/['"]/).test(value); 
},'Single quotes and double quotes not allowed');

jQuery.validator.addMethod("myEmail", function(value, element) {
    return this.optional( element ) || ( /^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test( value ) && /^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test( value ) );
}, 'Please enter valid email address.');
 
 
	$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
	// sms-form-save1 validation
	$("#sms-form-save1").validate({
		 rules:  {
					noofsms: {
					required: true,
					minStrict: 499,
					number: true
					},
					smstype: {
					required: true
					},
					subcription: {
					required: true
					}
			},
			messages: 
			{
				noofsms: {
				required: "Please Enter No of SMS"
				},
				smstype: {
				required: "Please select sms type"
				},
				subcription: {
					required: "Please select subcription"
				}
			}
			,
			tooltip_options: 
			{
				noofsms: {placement:'bottom',html:true},
				smstype: {placement:'bottom',html:true},
				subcription: {placement:'bottom',html:true}
			}
	    });
  //var baseurl="http://localhost/smsstriker/";
// sms form save1
	$("#save").on("click",function(){

 


		if($("#sms-form-save1").valid())
		{
			$('.price-form-sms01').hide();
			$('.price-form-sms-mail').show();

			var noofsms=$("#noofsms").val();
			var smstype=$("#smstype").val();
			var couponCode = $("#couponText").val();   
console.log(couponCode);	   
			//var couponCode = $(".couponVal").val(); 
			var subcription=$("#subcription").val();
			var totalsms=$("#totalsms").html($("#noofsms").val());
			var acttype=$("#acttype").html($("#smstype").val());
			var noofmonths=$("#noofmonths").html($("#subcription").val());
			var urlstr=baseurl+"smsequiry.php?noofsms="+noofsms+"&smstype="+smstype+"&subcription="+subcription+"&couponCode="+couponCode+"&method_save=save";
 			console.log(urlstr);	    		
   
			 $.ajax({
					type: "GET",
					url: urlstr,
					async: true,
					dataType: 'json',
					success: function(data){
					console.log(data);
						$("#userid").val(data[0].id);
					},
					error: function(error){
				
						 //console.log("Error:"+error);
						 
					}
			});     
			}
			else
			{
			$('.price-form-sms01').show();  
			$('.price-form-sms-mail').hide();
			}  
	
		});
		
	  
    var resendotpcount=1;
	$(".resendotp").click(function () {
		
		if(resendotpcount<=3)
			{
			resendotpcount++;
			var name=$("#name").val();
			var email=$("#email").val();
			var mobile=$("#mobile").val();
				var id=$('#userid').val();

				var urlstr=baseurl+"smsequiry.php?email="+email+"&mobile="+mobile+"&name="+name+"&userid="+id+"&resendotp";
////console.log(urlstr);
			$.ajax({
					type: "GET",
					url: urlstr,
					async: true,
					dataType: 'json',
					success: function(data){
								if(data.resend){
				 			$(".emsg").html('OTP Sent to Register Email & Mobile');

	var urlstr=baseurl+"sendemail.php?sendotp=sendotp&pid="+id;
		
				//////console.log(urlstr);
				// send email
				 $.ajax({
					type: "GET",
					url: urlstr,
					async: true,
					dataType: 'json',
					success: function(data){
					////console.log(data);
				      }
					
				});
				  
								}
					},
					error: function(error){
						 //console.log("Error:");
					}
			});
			
			}
		$(".emsg").html("You have exceeded no of attempts !.. ");
		$(".emsg").css("color","red");
		
		});
	
	// sms-form-save1 validation
	$("#sms-form-save2").validate({
		 rules:  {
					username: {
					required: true,
					minlength:5,
					maxlength:25,
					alphanumericspace: true
					},
					mobile: {
						required: true,
						minlength:10,
						maxlength:10,
						number: true			
						},
						email: {
							required: true,
							maxlength:50,
							myEmail:true
					
							}
			},
			messages: 
			{
				username: {
				required: "Please Enter UserName",
				minlength: "username must be at least 5 characters long"
				},
				mobile: {
					required: "Please Enter Mobile Number",
					minlength: "Please Enter 10 Digit Mobile Number", 
					maxlength: "Please Enter 10 Digit Mobile Number",
					number: "Please Enter Numbers Only"				
					},
					email: {
						required: "Please Enter Email",
						email: "Please Enter Valid Email" 				
						}
			},
			tooltip_options: 
			{
				username: {placement:'bottom',html:true},
				mobile: {placement:'bottom',html:true},
				email: {placement:'bottom',html:true}
			}
	    });
	
	$("#save2").click(function () {
		if($("#sms-form-save2").valid())
		{
			
			var name=$("#name").val();
			var email=$("#email").val();
			var couponCode = $("#couponText").val();
console.log(couponCode);
			var mobile=$("#mobile").val();
				var id=$('#userid').val();
				var urlstr=baseurl+"smsequiry.php?username="+name+"&email="+email+"&mobile="+mobile+"&userid="+id+"&couponCode="+couponCode+"&save2"; 
 
			$.ajax({
					type: "GET",
					url: urlstr,  
					async: true,
					dataType: 'json',
					success: function(result){   
 						 console.log(result);  
  						if(result.status == 200) { 
							$('.price-form-sms-mail').hide();
							$('.price-form-smsotp').show(); 
						 alert("OTP Sent to Register Email & Mobile");
						var urlstr=baseurl+"sendemail.php?sendotp=sendotp&pid="+id;
				 
						 $.ajax({  
							type: "GET", 
							url: urlstr,  
							async: true,
							dataType: 'json',
							success: function(data){  
							////console.log(data);
						      }
					
						});    
						}else if(result.status == 201) {
							$('#couponError').text('You already used this coupon...').css('color','red');
						} 
					},
					error: function(error){
						 //console.log("Error:");
					}
			});
	
		}
		else
		{
			$('.price-form-sms-mail').show();
			$('.price-form-smsotp').hide();
		}

		});
	
	// sms-form-save1 validation
	/*
	$(".price-form-smsotp").validate({
					rules:  {
		            otpverify: {
					required: true,
					number: true
					           }
					},
					messages: 
					{
						otpverify: {
						required: "Please Enter OTP Code"
					               }
					
					},
					tooltip_options: 
					{
					otpverify: {placement:'bottom',html:true}
					}
	    });
	 */
	$("#save3").click(function () {
		
		//if($(".price-form-smsotp").valid())
		//{
			var otpverify=$("#otpverify").val();
                
			if(otpverify!='')
				{
				var id=$('#userid').val();
				
			var urlstr=baseurl+"smsequiry.php?otpverify="+otpverify+"&userid="+id+"&save3";
			//console.log(urlstr);
			$.ajax({
					type: "GET",
					url: urlstr,
					async: true,
					dataType: 'json',
					success: function(data){
					//console.log(data);

							
			if(data.verifystatus==1){
				
				
				var urlstr=baseurl+"sendemail.php?sendemail=sendemail&type=sms&userid="+id;
				//console.log(urlstr);
				// send email
				 $.ajax({
					type: "GET",
					url: urlstr,
					async: true,
					dataType: 'json',
					success: function(data){
					//console.log(data);
				      }
					
				});
				
				$('.price-form-smsotp').hide();
				$('.price-thanks-message').show();
				
				
				
				
				
			}else if(data.verifystatus==0){
					$(".emsg").html('Invalid OTP');
					$(".emsg").css("color","red");

			}else 	
			if(data.verifystatus==2){
				$(".emsg").html('3 min over please send again your otp code');
				}
			//console.log(data);
					},
					error: function(error){

						 //console.log("Error:");
					}
			});
			
	     }
	/*		
	}
	else
	{
		$('.price-form-sms-mail').hide();
		$('.price-form-smsotp').show();
	}*/

		});
		
	/******************** longcode*******************************/
	
	// sms-form-save1 validation
	$(".price-form-longcode01").validate({
		 rules:  {
		longcodetype: {
		required: true

		},
		noofkeywords: {
					required: true,
					number: true
					},
					replaytype: {
					required: true
					},
					subscription: {
					required: true
					}
			},
			messages: 
			{
				longcodetype: {
				required: "Please Select Loncode type"
				},
				noofkeywords: {
				required: "Please enter noofkeywords/longcodes"
				},
				replaytype: {
				required: "Please select replay type"
				},
				subscription: {
					required: "Please select subcription"
				}
			}
			,
			tooltip_options: 
			{
				longcodetype: {placement:'bottom',html:true},
				noofkeywords: {placement:'bottom',html:true},
				replaytype: {placement:'bottom',html:true},
				subscription: {placement:'bottom',html:true}
			}
	    });
	$("#longcodesave").click(function () {

		if($(".price-form-longcode01").valid())
		{
			$('.price-form-longcode01').hide();
			$('.price-form-longcode-mail').show();
			var servicetype=$("#longcodetype").val();
			var noofkeywords=$("#noofkeywords").val();
			var subscription=$("#longcodesubscription").val();
			var replaytype=$("#replaytype").val();
			
		$("#longcodeacttype").html($("#longcodetype").val());
		$("#totalkeywords").html($("#noofkeywords").val());
		$("#noofmonthslongcode").html($("#longcodesubscription").val());
		$("#replytype").html($("#replaytype").val());
		
		var urlstring=baseurl+"longcode.php?noofkeywords="+noofkeywords+"&servicetype="+servicetype+"&subscription="+subscription+"&replaytype="+replaytype+"&method_save=save";
		//console.log(urlstring);
				$.ajax({
					type: "GET",
					url: urlstring,
					async: true,
					dataType: 'json',
					success: function(data){
					//console.log(data);
				   $("#longuserid").val(data[0].id);
																		
					},
					error: function(){
				
						 //console.log("Error:");
						 
					}
			});
		}
		else
		{
			$('.price-form-longcode01').show();
			$('.price-form-longcode-mail').hide();
		}
	
		});
		
	

	$("#resendotplongcode").click(function () {

			var name=$("#longusrname").val();
			var email=$("#longusremail").val();
			var mobile=$("#longusrmobile").val();
			var id=$('#longuserid').val();
			var urlstring =baseurl+"longcode.php?email="+email+"&mobile="+mobile+"&name="+name+"&userid="+id+"&resendotp";
		//console.log(urlstring);
			$.ajax({
					type: "GET",
					url: urlstring,
					async: true,
					dataType: 'json',
					success: function(data){
								if(data.resend==1){

							$(".emsg").html('OTP Sent to Register Email & Mobile');

	var urlstr=baseurl+"sendemail.php?sendotp=sendotp&pid="+id;
				//////console.log(urlstr);
				// send email
				 $.ajax({
					type: "GET",
					url: urlstr,
					async: true,
					dataType: 'json',
					success: function(data){
					////console.log(data);
				      }
					
				});
								}
					},
					error: function(error){
						 //console.log("Error:");
					}
			});

		});
	
	// sms-form-save1 validation loncode save2
	$(".price-form-longcode-mail").validate({
		 rules:  {
					username: {
					required: true,
					minlength:5,
					maxlength:25,
					alphanumericspace: true
					},
					mobile: {
						required: true,
						minlength:10,
						maxlength:10,
						number: true			
						},
						email: {
							required: true,
							maxlength:50,
							myEmail:true
					
							}
			},
			messages: 
			{
				username: {
				required: "Please Enter UserName",
				minlength: "username must be at least 5 characters long"
				},
				mobile: {
					required: "Please Enter Mobile Number",
					minlength: "Please Enter 10 Digit Mobile Number", 
					maxlength: "Please Enter 10 Digit Mobile Number",
					number: "Please Enter Numbers Only"				
					},
					email: {
						required: "Please Enter Email",
						email: "Please Enter Valid Email" 				
						}
			},
			tooltip_options: 
			{
				username: {placement:'bottom',html:true},
				mobile: {placement:'bottom',html:true},
				email: {placement:'bottom',html:true}
			}
	    });
	$("#longcodesave2").click(function () {

		if($(".price-form-longcode-mail").valid())
		{
			$('.price-form-longcode-mail').hide();
			$('.price-form-longcodeotp').show();
			var name=$("#longusrname").val();
			var email=$("#longusremail").val();
			var mobile=$("#longusrmobile").val();
				var id=$('#longuserid').val();
				var urlstring=baseurl+"longcode.php?username="+name+"&email="+email+"&mobile="+mobile+"&userid="+id+"&save2";
		//console.log(urlstring);
			$.ajax({
					type: "GET",
					url: urlstring,
					async: true,
					dataType: 'json',
					success: function(data){
					////console.log(data);

					alert("OTP Sent to Register Email & Mobile");
		var urlstr=baseurl+"sendemail.php?sendotp=sendotp&pid="+id;
		//var urlstr=baseurl+"sendemail.php?name="+name+"&email="+email+"&otp="+data.otp+"&userid="+id;
				////console.log(urlstr);
				// send email
				 $.ajax({
					type: "GET",
					url: urlstr,
					async: true,
					dataType: 'json',
					success: function(data){
					////console.log(data);
				      }
					
				});
					},
					error: function(error){
						 //console.log("Error:");
					}
			});
		}
		else
		{
			$('.price-form-longcode-mail').show();
			$('.price-form-longcodeotp').hide();
		}
		});
	
	
	// sms-form-save1 validation
	/*
	$(".price-form-longcodeotp").validate({
					rules:  {
		otpsendlongcode: {
					required: true,
					number: true
					           }
					},
					messages: 
					{
						otpsendlongcode: {
						required: "Please Enter OTP Code"
					               }
					
					},
					tooltip_options: 
					{
						otpsendlongcode: {placement:'bottom',html:true}
					}
	    });
	*/
	$("#otpsave").click(function () {

		//if($(".price-form-longcodeotp").valid())
		//{
			var otpverify=$("#otpsendlongcode").val();
                if(otpverify!='')
                {
				var id=$('#longuserid').val();
				var urlstring=baseurl+"longcode.php?otpverify="+otpverify+"&userid="+id+"&save3";
			//console.log(urlstring);
			$.ajax({
					type: "GET",
					url: urlstring,
					async: true,
					dataType: 'json',
					success: function(data){
					//console.log(data.verifystatus);
		
if(data.verifystatus==1){
		
$('.price-form-longcodeotp').hide();
$('.price-longcode-thanks-message').show();

var urlstr=baseurl+"sendemail.php?sendemail=sendemail&type=longcode&userid="+id;
////console.log(urlstr);
// send email
$.ajax({
type: "GET",
url: urlstr,
async: true,
dataType: 'json',
success: function(data){
//console.log(data);
}

});

			}else if(data.verifystatus==0){

					$(".emsg").html('Invalid OTP');
					$(".emsg").css("color","red");
			}else 	
			if(data.verifystatus==2){
				$(".emsg").html('3 min over please send again your otp code');
				}else{
				return false;
				}
			//console.log(data);
					},
					error: function(error){
						//console.log(data);
						 //console.log("Error:");
					}
			});
			
                }
		/*	
		}
		else
		{
			$('.price-form-sms-mail').hide();
			$('.price-form-smsotp').show();
		}*/
		});
	/**********************  shorturl ********************/
	$(".price-form-shorturl01").validate({
		 rules:  {
		shorturl: {
					required: true,
					number: true,
					maxlength: 12
					
					},
					shortreplay: {
					required: true
					},
					shortsubcription: {
					required: true
					}
			},
			messages: 
			{
				shorturl: {
				required: "Please Enter shorturl"
				},
				shortreplay: {
				required: "Please select replay type"
				},
				shortsubcription: {
					required: "Please select subcription"
				}
			}
			,
			tooltip_options: 
			{
				shorturl: {placement:'bottom',html:true},
				shortreplay: {placement:'bottom',html:true},
				shortsubcription: {placement:'bottom',html:true}
			}
	    });
	
	$("#shortsave").click(function () {

		if($(".price-form-shorturl01").valid())
		{
			$('.price-shorturl-section02').hide();
			$('.price-shorturl-section03').show();
			var noofshorturl=$("#shorturl").val();
			var shortreplay=$("#shortreplay").val();
			var shortsubcription=$("#shortsubcription").val();
			
		$("#shorturlnos").html($("#shorturl").val());
		$("#shorturlreplay").html($("#shortreplay").val());
		$("#monthsnos").html($("#shortsubcription").val());
		var urlstr=baseurl+"shorturlenquiry.php?noofshorturl="+noofshorturl+"&shortreplay="+shortreplay+"&shortsubcription="+shortsubcription+"&method_save=save";
		////console.log(urlstr);
			$.ajax({
					type: "GET",
					url: urlstr,
					async: true,
					dataType: 'json',
					success: function(data){

						$("#shorturluserid").val(data[0].id);
											
											
	
					},
					error: function(error){
				
						 //console.log("Error:"+error);
						 
					}
			});
		}
		else
		{
			$('.price-shorturl-section02').show();
			$('.price-shorturl-section03').hide();
		}
	
		});

	// sms-form-save1 validation
	$(".price-form-shorturl-mail").validate({
		 rules:  {
		shortlusrname: {
					required: true,
					minlength:5,
					maxlength:25,
					alphanumericspace: true
					},
					shorturlmobile: {
						required: true,
						minlength:10,
						maxlength:10,
						number: true			
						},
						shortusremail: {
							required: true,
							maxlength:50,
							myEmail:true
					
							}
			},
			messages: 
			{
				shortlusrname: {
				required: "Please Enter UserName",
				minlength: "username must be at least 5 characters long"
				},
				shorturlmobile: {
					required: "Please Enter Mobile Number",
					minlength: "Please Enter 10 Digit Mobile Number", 
					maxlength: "Please Enter 10 Digit Mobile Number",
					number: "Please Enter Numbers Only"				
					},
					shortusremail: {
						required: "Please Enter Email",
						email: "Please Enter Valid Email" 				
						}
			},
			tooltip_options: 
			{
				shortlusrname: {placement:'bottom',html:true},
				shorturlmobile: {placement:'bottom',html:true},
				shortusremail: {placement:'bottom',html:true}
			}
	    });
	
	$("#shorturlsave2").click(function () {

		if($(".price-form-shorturl-mail").valid())
		{
			$('.price-shorturl-section03').hide();
			$('.price-form-shortotp').show();
				var name=$("#shortlusrname").val();
				var email=$("#shortusremail").val();
				var mobile=$("#shorturlmobile").val();
				var id=$('#shorturluserid').val();
				var urlstr=baseurl+"shorturlenquiry.php?username="+name+"&email="+email+"&mobile="+mobile+"&userid="+id+"&save2";
			////console.log(urlstr);
			$.ajax({
					type: "GET",
					url: urlstr,
					async: true,
					dataType: 'json',
					success: function(data){
					////console.log(data);

					alert("OTP Sent to Register Email & Mobile");
		//var urlstr=baseurl+"sendemail.php?name="+name+"&email="+email+"&otp="+data.otp+"&userid="+id;
		var urlstr=baseurl+"sendemail.php?sendotp=sendotp&pid="+id;
				////console.log(urlstr);
				// send email
				 $.ajax({
					type: "GET",
					url: urlstr,
					async: true,
					dataType: 'json',
					success: function(data){
					////console.log(data);
				      }
					
				});
					},
					error: function(error){
						 //console.log("Error:");
					}
			});
		}
		else
		{
			$('.price-shorturl-section03').show();
			$('.price-form-shortotp').hide();
		}
		});
	
	// sms-form-save1 validation
	/*
	$(".price-form-shortotp").validate({
					rules:  {
		shorturlotpverify: {
					required: true,
					number: true
					           }
					},
					messages: 
					{
						shorturlotpverify: {
						required: "Please Enter OTP Code"
					               }
					
					},
					tooltip_options: 
					{
						shorturlotpverify: {placement:'bottom',html:true}
					}
	    });
	*/
	$("#shorturlsave3").click(function () {

		//if($(".price-form-shortotp").valid())
		//{
		

			var otpverify=$("#shorturlotpverify").val();
			
			if(otpverify!='')
				{

				var id=$('#shorturluserid').val();
				var urlstr=baseurl+"shorturlenquiry.php?otpverify="+otpverify+"&userid="+id+"&save3";
			////console.log(urlstr);
			$.ajax({
					type: "GET",
					url: urlstr,
					async: true,
					dataType: 'json',
					success: function(data){
					//console.log(data);
				//	$('#userid').val(data[0].id);	
			
							
			if(data.verifystatus==1){
				
				$('.price-form-shortotp').hide();
				$('.price-shorturl-section04').show();
				var urlstr=baseurl+"sendemail.php?sendemail=sendemail&type=shorturl&userid="+id;
				////console.log(urlstr);
				// send email
				$.ajax({
				type: "GET",
				url: urlstr,
				async: true,
				dataType: 'json',
				success: function(data){
				//console.log(data);
				}

				});
			}else if(data.verifystatus==0){
					$(".emsg").html('Invalid OTP');
					$(".emsg").css("color","red");
			}else 	
			if(data.verifystatus==2){
				$(".emsg").html('3 min over please send again your otp code');
				}
			//console.log(data);
					},
					error: function(error){
						//console.log(data);
						 //console.log("Error:");
					}
			});
			
				}
		/*
		}
		else
		{
			$('.price-form-sms-mail').hide();
			$('.price-form-smsotp').show();
		}
		*/
		});
	

	$("#resendotpshorturl").click(function () {



				var name=$("#shortlusrname").val();
				var email=$("#shortusremail").val();
				var mobile=$("#shorturlmobile").val();
				var id=$('#shorturluserid').val();
				var urlstr=baseurl+"shorturlenquiry.php?email="+email+"&mobile="+mobile+"&name="+name+"&userid="+id+"&resendotp";
				
		////console.log(urlstr);
			$.ajax({
					type: "GET",
					url: urlstr,
					async: true,
					dataType: 'json',
					success: function(data){
								if(data.resend){
							$(".emsg").html('OTP Sent to Register Email & Mobile');
	//var urlstr=baseurl+"sendemail.php?name="+name+"&email="+email+"&otp="+data.otp+"&userid="+id;
	var urlstr=baseurl+"sendemail.php?sendotp=sendotp&pid="+id;
				//////console.log(urlstr);
				// send email
				 $.ajax({
					type: "GET",
					url: urlstr,
					async: true,
					dataType: 'json',
					success: function(data){
					////console.log(data);
				      }
					
				});

								}
					},
					error: function(error){
						 //console.log("Error:");
					}
			});

		});


	$(".shorturllinkdiv").validate({
		 rules:  {
				
		        short_input: {
				required: true,
				
				},
				entercaptchacode: {
					required: true,
					equalTo:"#txtCaptcha",
					minlength:5,
					maxlength:10,
					}
			},
			messages: 
			{
				
				short_input: {
				required: "Please Enter URL",
				
					
				},
				entercaptchacode: {
					required: "Please Enter Captcha Code",
					equalTo: "Please Enter valid Captcha Code",
					minlength: "Please Enter 10 Digit Captcha Code", 
					maxlength: "Please Enter 10 Digit Captcha Code"

					}
			}
			,
			tooltip_options: 
			{
				short_input: {placement:'bottom',html:true},
				entercaptchacode: {placement:'bottom',html:true}
				
			}
	    });
	
$("#shorturlgenerate").click(function () {
	
	if($(".shorturllinkdiv").valid())
	{

var localurl="http://ion.bz/";
	var enterurl = $.trim($(".short_input").val());
	var id=$('#shorturluserid').val();

	//console.log(localurl);
	var entercaptchacode=$("#entercaptchacode").val();
		var txtCaptcha=$("#txtCaptcha").val();
if ($(".short_input").val().match(/http:\/\//) || $(".short_input").val().match(/https?:\/\//) || $(".short_input").val().match(/www./)) {
		
	if(entercaptchacode==txtCaptcha)
			{
		    $('.shorturllinkdemodiv').show();
			//console.log(entercaptchacode);
				$("#captchamatched").hide();
				
				var	urlstr=localurl+"smsnewui_api.php?get_shorturl=success&user_url="+enterurl;
			 $.ajax({
				url: urlstr,
				type: 'POST',
				dataType: "JSON",
				success: function(data) {
console.log(data);
			$("#operatingsystem").html(data.operatingsystem);
			$("#date").html(data.date);
			$("#browserdetail").html(data.browserdetail);
			$("#devicetype").html(data.devicetype);
			$("#buidby").html(data.build_by);
			$("#city").html(data.city);
			$("#shortlinkgen").html(localurl+data.short_code+'\n');
			},
				error: function(){
						         alert("error");
						  }
				 });
			
			}	else
			{
			DrawCaptcha();	
			$("#shorurlcaptcha").html("Invalid Captcha Code!..");
				$(".shortcaptchacolor").css("color","red");
			}
	}
		else
		{
			DrawCaptcha();
			$("#invalidurl").html("Invalid URL");
			$("#invalidurl").css("color","red");
		}		

	}
	else
		{
		$('.shorturllinkdemodiv').hide();
		}
			});
			
	/**********************   contact        ***************************/
	
//validation contact form

	
	
$(".validation-contact").validate({
	 rules:  {
				username: {
				required: true,
				minlength:5,
				maxlength:25,
				
				alphanumericspace: true
				},
				mobile: {
				required: true,
				minlength:10,
				maxlength:10,
				number: true			
					},
				email: {
				required: true,
				maxlength:50,
				myEmail:true
				
					},
				message: {
				required: true,
				regexpcol: true
				}
		},
		messages: 
		{
			username: {
			required: "Please Enter Name",
			},
			mobile: {
				required: "Please Enter Phone Number",
				minlength: "Please Enter 10 Digit Phone Number", 
				maxlength: "Please Enter 10 Digit Phone Number",
				number: "Please Enter Numbers Only"				
				},
				email: {
					required: "Please Enter Email",
					email: "Please Enter Valid Email" 				
					},
					message: {
					required: "Please Enter Message"
					}
		}
		,
		tooltip_options: 
		{
			username: {placement:'bottom',html:true},
			mobile: {placement:'bottom',html:true},
			email: {placement:'bottom',html:true},
			message: {placement:'bottom',html:true}
		}
    });

	$("#contactsave").click(function () {
		if($(".validation-contact").valid())
		{
			var personname=$("#personname").val();
			var personphone=$("#personphone").val();
			var personemail=$("#personemail").val();
			var personmessage=$("#personmessage").val();
			//var urlstr=baseurl+"contact_form.php?personname="+personname+"&personphone="
			//+personphone+"&personemail="+personemail+"&personmessage="+personmessage+"&contactsave";		
			var urlstr=baseurl+"contact_form.php";	
			$.ajax({
				method: "POST",  
					url: urlstr,
					data:{personname:personname,personphone:personphone,personemail:personemail,
					personmessage:personmessage,contactsave:"contactsave"},
					//async: true,
					//dataType: 'json',
					success: function(data){
						//console.log(data);
				////console.log(data.contact_id);
						var encoded = encodeURIComponent(data.contact_id);

				window.location.href=baseurl+"thank-you.php?sendemail=sendemail&id="+encoded;
															
	
					},
					error: function(){
					
						 //console.log("Error");
						 
					}
			      });
		
		}
		});
	
	
	
	$("#cartremove").click(function () {
	
			var id=$("#productid").val();
			
			var urlstr=baseurl+"index.php/products/removeCart";	
			$.ajax({
				method: "POST",
					url: urlstr,
					data:{pid:id,del:"del"},
					success: function(data){
						//console.log(data);
						alert('successfully deleted');
												
	
					},
					error: function(){
					
						 //console.log("Error");
						 
					}
			      });
		
		
		});

	

});


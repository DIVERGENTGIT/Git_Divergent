$(document).ready(function(){$.validator.addMethod('minStrict',function(value,el,param){return value>param;},'Please enter 500 or above 500 SMS');jQuery.validator.addMethod("myEmail",function(value,element){return this.optional(element)||(/^[a-z0-9]+([-._][a-z0-9]+)*@([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,4}$/.test(value)&&/^(?=.{1,64}@.{4,64}$)(?=.{6,100}$).*/.test(value));},'Please enter valid email address.');var base_url="https://www.smsstriker.com/";var baseUrl="https://www.smsstriker.com/ppc/";$("input#couponCode").on('change',function(){var coupon_code=$('#couponCode').val();if(coupon_code!=''){$.ajax({url:baseUrl+"checkCouponValidity",type:"post",data:{'coupon':coupon_code},success:function(response){var result=$.parseJSON(response);if(result.status==200){var message="Coupon code verified..";$('#couponValid_Error').text('');$('#couponVal').val(coupon_code);$('#couponText').val(coupon_code);$('#couponValid_Error').text(message).css('color','green');}else if(result.status==201){$('#couponValid_Error').text('');$('#couponValid_Error').text("Coupon Already Used...").css('color','red');}else{$('#couponValid_Error').text('');$('#couponValid_Error').text("Invalid Coupon.").css('color','red');}}});}});$("#landingPage").validate({rules:{userName:{required:true},userMobile:{required:true,minlength:10,maxlength:10,number:true},userEmail:{required:true,maxlength:50,myEmail:true},noofsms:{required:true,minStrict:499,number:true},couponCode:{required:true}},messages:{noofsms:{required:"Please Enter No of SMS"},couponCode:{required:"Please Enter Coupon Code"},userEmail:{required:"Please Enter Email",email:"Please Enter Valid Email"},userMobile:{required:"Please Enter Phone Number",minlength:"Please Enter 10 Digit Phone Number",maxlength:"Please Enter 10 Digit Phone Number",number:"Please Enter Numbers Only"},userName:{required:"Please Enter Name"}},tooltip_options:{noofsms:{placement:'bottom',html:true},couponCode:{placement:'bottom',html:true},userMobile:{placement:'bottom',html:true},userName:{placement:'bottom',html:true},userEmail:{placement:'bottom',html:true}}});$('form#landingPage').submit(function(e){e.preventDefault();if($("#landingPage").valid()){var userName=$('#userName').val();var userMobile=$('#userMobile').val();var userEmailID=$('#userEmail').val();var noOfSMS=$('#noofsms').val();var pageName=$('#pageName').val();var couponCode=$('#couponCode').val();$.ajax({type:"GET",url:base_url+"registration.php",data:{unvalidation:"unvalidation",username:userName},dataType:"json",success:function(response){$("#usernamemsg").html(response.message).css('color',response.color);if(response.color=='green'){$.ajax({type:"GET",url:base_url+"registration.php",data:{mbnovalidation:"mbnovalidation",mobileno:userMobile},dataType:"json",success:function(response1){$("#usermobilemsg").html(response1.message).css('color',response1.color);if(response1.color=='green'){$.ajax({type:"GET",url:base_url+"registration.php",data:{emailvalidation:"emailvalidation",userEmailID:userEmailID},dataType:"json",success:function(response2){$("#useremailmsg").html(response2.message).css('color',response2.color);if(response2.color=='green'){$.ajax({url:baseUrl+"userLandingPage",type:"post",data:{'coupon':couponCode,'userName':userName,'userMobile':userMobile,'userEmailID':userEmailID,'noOfSMS':noOfSMS,'pageName':pageName},success:function(response){var result=$.parseJSON(response);if(result.status==200){var id=result.id;var pid=result.pid;localStorage.setItem('enquiryID',id);localStorage.setItem('encodedID',pid);var urlstr=base_url+"sendemail.php?sendotp=sendotp&source=landingPage&pid="+id;console.log(urlstr);$.ajax({type:"GET",url:urlstr,success:function(data){  

}   
}); 	window.location.href=base_url+"ppc/otp.html?id="+pid; 
}else if(result.status==201){$('#couponValid_Error').text('');$('#couponValid_Error').text('You already used this coupon...').css('color','red');}else{$('#couponValid_Error').text('');$('#couponValid_Error').text('Request Failed').css('color','red');}}});}




}});}}});}}});}});$('#save3').click(function(e){e.preventDefault();$(".emsg").html('');

var otpverify=$("#otpverify").val();
var id=localStorage.getItem('enquiryID');
var pid=localStorage.getItem('encodedID');
var urlstr=base_url+"smsequiry.php?otpverify="+otpverify+"&userid="+id+"&save3";

$.ajax({
type:"GET",  
url:urlstr,
async:true,
dataType:'json',
success:function(data){  
if(data.verifystatus==1){
//var urlstr=base_url+"sendemail.php?sendotp=sendotp&pid="+id;
//$.ajax({type:"GET",url:urlstr,async:true,dataType:'json',success:function(data){}});

location.href=base_url+"ppc/confirmOrder/"+pid;}else if(data.verifystatus==0){$(".emsg").html('');$(".emsg").html('Invalid OTP');$(".emsg").css("color","red");}else if(data.verifystatus==2){$(".emsg").html('');$(".emsg").html('Your max time limit expired, please register once again');window.location.href= base_url+'ppc/bulk-sms-services.html';  }else{$(".emsg").html('');$(".emsg").html('Request Failed');}}});

});$('#ResendOTP').click(function(){
var counter = localStorage.getItem('resendcounter');
counter++;      
localStorage.setItem('resendcounter',counter);    
var resendCounter = localStorage.getItem('resendcounter');    
var id = localStorage.getItem('enquiryID');  
   
if(resendCounter > 3)  { 
	$(".emsg").html('Your max time limit expired, please register once again');
	localStorage.setItem('encodedID','');
	localStorage.setItem('enquiryID','');  
	localStorage.setItem('resendcounter',0);
	window.location.href= base_url+'ppc/bulk-sms-services.html';  
}else{        
	var urlstr=base_url+"smsequiry.php?userid="+id+"&resendotp";$.ajax({type:"GET",url:urlstr,async:true,dataType:'json',success:function(data){if(data.resend){$(".emsg").html('');$(".emsg").html('OTP Sent to Register Email & Mobile');
	}}});
  	 
} 
});

$("#userName").on("blur",function(){ 
			var username=$("#userName").val();
			if(username.length > 5)
			{
			$("#usernamemsg").text('');
			$.ajax({
				type:"GET",
				url:base_url+"registration.php",
				data:{unvalidation:"unvalidation",username:username},
				dataType:"json",
				success:function(response)
				{
 
					
					$("#usernamemsg").html(response.message);
					$("#usernamemsg").css('color',response.color);
					
					
				} 
			});

			}
			 
			
		});
		
		
$("#userMobile").on("blur",function(){ 
			var mobileno=$("#userMobile").val();
			if(mobileno.length >= 10)
			{
			$("#usermobilemsg").text('');
			$.ajax({
				type:"GET",
				url:base_url+"registration.php",
				data:{mbnovalidation:"mbnovalidation",mobileno:mobileno},
				dataType:"json",
				success:function(response)
				{
 
					
					$("#usermobilemsg").html(response.message);
					$("#usermobilemsg").css('color',response.color);
					
					
				} 
			});

			}
			 
			
		});
		
		
$("#userEmail").on("blur",function(){ 
		var userEmailID =$("#userEmail").val();
		$("#useremailmsg").text('');
		var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

		if(pattern.test(userEmailID))
		{  
			if(userEmailID) {
				$.ajax({
					type:"GET",
					url:base_url+"registration.php",
					data:{emailvalidation:"emailvalidation",userEmailID:userEmailID},
					dataType:"json",
					success:function(response)
					{

						$("#useremailmsg").html(response.message);
						$("#useremailmsg").css('color',response.color); 
				
					} 
				});

		 	}
		}	 
	});

	
	$('#clicktocall').on('click',function(e) {
		$('#dialog_fail').css('display','none');
		e.preventDefault();
		var mobileNum = $('#mobileNumber').val();
		var sourceType = $('#source').val();
		if(mobileNum && mobileNum.length == 10 ) {
			$.ajax({  
				url:baseUrl+"clicktocallAPI", 
				type:"post",
				data:{'number':mobileNum,'source':sourceType},     
				success:function(response) { 
					$("#dialog_fail").hide();  
					$("#dialog").hide();   
					$("#dialog").fadeTo(5000, 5000).slideUp(500, function(){
						$("#dialog").slideUp(5000);
					});    
					/*$("#dialog").dialog({
						modal: true,
						title: "Success Alert",
						width: 550,
						height: 150,
						open: function (event, ui) {
							setTimeout(function () {
								$("#dialog").dialog("close");
							}, 20000);
						}
					});  */ 
				}  
			});	
		}  else { 
				$("#dialog_fail").hide(); $("#dialog").hide();   
					$("#dialog_fail").fadeTo(5000, 5000).slideUp(500, function(){
						$("#dialog_fail").slideUp(5000);  
					});    
				 }
		return false;
	});


});




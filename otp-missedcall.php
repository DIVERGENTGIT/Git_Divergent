<?php
session_start();  ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="" >
<meta name="keywords" content=""> 
<title>SMS Striker OTP</title> 

<!-- SCRIPT FILE -->
<script src="http://localhost/smsstriker/js/jquery.min.js"></script>


<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
<link rel="stylesheet" href="css_newui/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="css_newui/otp.css" type="text/css">
</head>
<body>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<div class="containerotp">
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero missedcall-smsotp">
<div class="col-sm-12 col-md-12 col-xs-12 mrg-btmotpimg padding-zero">
<img src="images_n/firstring-logo.png" width="120px" alt="">
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<p class="emsg">Please enter 4 digit OTP number that sent to your  Email &amp; Mobile</p>
<div><input type="text" name="otpverify" id="otpverify" ></div>
<div>OTP<span class="resend-missed-otp-btn"><input type="button"  class="sms-missedotp-resend-btn resendotp" value="Resend OTP"></span></div>
<div><input type="button" autofocus="" name="" class="missed-otp-submit-btn" value="Submit" onClick="checkUserOTP();"></div>
</div>
</div>
</div>
</div>
</body>
</html>



<?php // echo $_SESSION['firstRing_OTP']; ?>
 
<script>
 
function checkUserOTP() {  
	var user_entered_otp = $('#otpverify').val();
	var gen_sess_otp = "<?php echo $_SESSION['firstRing_OTP']; ?>"; 
	if(gen_sess_otp == user_entered_otp) {
		window.location.href = "http://www.firstring.in/index";
	}else{
		alert("Not a valid OTP.");
	}	  
}

 

</script>

 
















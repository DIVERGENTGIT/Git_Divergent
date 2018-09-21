<?php
error_reporting(0);
session_start();
    if(isset($_POST['optcode']))
	{		
	
 $verify=str_replace(' ','',$_REQUEST['otpcode_check']); // this step is to remove white spaces from input
 echo $_SESSION['end'];
		if($_SESSION['end'] > time()) /// check if 2 mins over or not
 {
			if($_SESSION['otp']==$verify)
{
	$user_id=$_SESSION['user_id'];
				$mobile = $_SESSION['mobile'];
				$values = array(
				'mverify' =>1,
				'mobile' => $mobile
				
				);
				$this->db->where('user_id',$user_id) 
				->update('users',$values);
	//$url="http://localhost/new/index.php/myaccount/index";
	

		//$url="http://www.smsstriker.com/myaccount/index";


				?>
<script language="javascript" type="text/javascript">
//window.self.location='<?php print($url);?>';
window.self.location="<?php echo base_url();?>myaccount/index";
</script>
	<?php
		unset($_SESSION['otp']);			
			unset($_SESSION['end']);
			unset($_SESSION['user_id']);			
			unset($_SESSION['mobile']);
		
				session_destroy();
				
				return true;	
			}
			else
			{
								echo "<script> alert('Enter Wrong OTP Plz try again');</script>";
								

			}
		 }
		 else
		 {			
			unset($_SESSION['otp']);			
			unset($_SESSION['end']);
		
			session_destroy();
			echo "<script> alert('2 min over please send again your otp code');</script>";
			//return false;
			
		 }
		
		
	}
	?>
<!DOCTYPE html>
<html class="no-js" lang="en">
  
<!-- Mirrored from rudhisasmito.com/demo/laundryes/about.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 26 Sep 2015 04:42:03 GMT -->
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMS Strikers</title>
    <meta name="description" content="Laundryes - Laundry Business Html Template. It is built using bootstrap 3.3.2 framework, works totally responsive, easy to customise, well commented codes and seo friendly.">
    <meta name="keywords" content="laundry, multipage, business, clean, bootstrap">
    <meta name="author" content=""> 
	
    <style type="text/css">
    

.login-block {
    width: 450px;
    padding: 0px 20px;
    background: #fff;
    border-radius: 5px;
}

.login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
}


.login-block input#username {
    background: #fff url('<?php echo  base_url(); ?>images_n/u0XmBmv.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#username:focus {
    background: #fff url('<?php echo  base_url(); ?>images_n/u0XmBmv.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input#password {
    background: #fff url('<?php echo  base_url(); ?>images_n/Qf83FTt.png') 20px top no-repeat;
    background-size: 16px 80px;
}

.login-block input#password:focus {
    background: #fff url('<?php echo  base_url(); ?>images_n/Qf83FTt.png') 20px bottom no-repeat;
    background-size: 16px 80px;
}

.login-block input:active, .login-block input:focus {
    border: 1px solid #29ABE2;
}

.login-block button {
    width: 100%;
    height: 40px;
    background: #29ABE2;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #29ABE2;
    color: #fff;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
    font-family: Montserrat;
    outline: none;
    cursor: pointer;
    margin-bottom: 20px;
}

.login-block button:hover {
    background: #29ABE2;
}
        
        
       /* forgot possword*/
        
        
.panel-default {

    border: none !important;
}
        
.panel-default > .panel-heading {
   
    background-color: transparent !important;
   
} 
        .panel-default > .panel-heading + .panel-collapse > .panel-body {
    border-top-color: transparent !important;
}

    </style>
</head>


 <body>
	
	<!-- Load page -->
	
	<!-- NAVBAR SECTION -->
	
 
	<!-- login code -->
	
<script>
var seconds = 120;
function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds;  
    }
    document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
    if (seconds == 0) {
        clearInterval(countdownTimer);
        document.getElementById('countdown').innerHTML = "Time Up";
    } else {
        seconds--;
    }
}
var countdownTimer = setInterval('secondPassed()', 1000);
</script>

<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
  <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/sms-icon.png" class="right-title-img">Enter OTP Code</h3>
</div>    

   
<div class="login-block" style="padding-top:20px  !importat; padding-bottom:40px  !importat;">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero otp_code">
    <p style="text-align: center;margin-top: 14px;">Check for OTP code which will be valid for <span class="label label-success" style=" background-color:#005C9F;font-weight:bold; font-size:18px;"><span id="countdown"></span></span> mins.</p>
    <form action="http://www.smsstriker.com/index.php/myaccount/codeotp_mverify" method="post" class="col-sm-12" style="margin-top:17px;">
    
<!--        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="col-sm-12" style="margin-top:17px;">
-->
	<input type="hidden"  name="send" value="<?php echo $_SESSION['end']?>" >
	
    <div class="col-md-12 col-sm-12 col-xs-12 padding_zero form-group" style="margin-bottom:0px;">
        <label class="col-xs-12 col-md-4 col-sm-4 control-label" style="margin-top: 7px;color: #0066A2;">OTP Code :</label>
        <div class="col-md-7 col-sm-7 col-xs-12 padding_zero">
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
		<input type="password"  name="otpcode_check" style="padding: 0px 10px !important;" class="form-control" required>
		</div>
          <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
   <input type="submit" name="optcode" class="submit_btn" value="Check">
   </div>  
        </div>
    </div>
	
    </form>
    
    
 </div>   
    
</div>
   
 

		     
    
	
	<!-- login code end -->
	
	
	<div class="clearfix"></div>
	
	
	
	
	<!-- FOOTER SECTION -->
	
	
	
	<!-- -Login Modal -->

 	<!-- - Login Model Ends Here -->
	
	
    
   </div> 
    
    
   
	
</body>
    <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
 <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</html>
       

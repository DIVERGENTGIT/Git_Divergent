<script type="text/javascript" src="<?php echo  base_url(); ?>js/bootstrap.min.js"></script>
<?php
error_reporting(0);
session_start();
    if(isset($_POST['optcode']))
	{		
	
 $verify=str_replace(' ','',$_REQUEST['otpcode_check']); // this step is to remove white spaces from input
		if($_SESSION['end'] > time()) /// check if 2 mins over or not
		 {
		if($_SESSION['otp']==$verify)
		{		
		$servicenos = $_SESSION['servicenos'];			
		$quantity=$_SESSION['quantity'];	
		$amount=$_SESSION['amount'];		
		$name =$_SESSION['name'];
		$customerid = $_SESSION['customerid'];
		$cmpname =$_SESSION['cname'];		
		$mobile = $_SESSION['mobile'];
		$email =$_SESSION['email'];
		$address1 = $_SESSION['address1'];
		$address2 = $_SESSION['address2'];
		$address3 =$_SESSION['address3'];
		$state = $_SESSION['state'];
		$city = $_SESSION['city'];
		$zip =$_SESSION['zip'];
		$description =$_SESSION['description'];
		$url="http://10.10.10.112/striker/payment/TestSsl.php?amount=".$amount."&name=".$name."&trnsale=".$quantity."&customerid=".$customerid."&address1=".$address1."&address2=".$address2."&address3=".$address3."&city=".$city."&state=".$state."&email=".$email."&cname=".$cmpname."&desc=".$description."&service_nos=".$servicenos."&mobile=".$mobile ."&zip=".$zip ;		 
		?>
		
<script language="javascript" type="text/javascript">
window.self.location='<?php print($url);?>';
</script>

	<?php
			unset($_SESSION['otp']);			
			unset($_SESSION['end']);
			unset($_SESSION['customerid']);			
			unset($_SESSION['name']);
			unset($_SESSION['address1']);			
			unset($_SESSION['address2']);
			unset($_SESSION['address3']);			
			unset($_SESSION['state']);
			unset($_SESSION['city']);			
			unset($_SESSION['zip']);
			unset($_SESSION['amount']);			
			unset($_SESSION['quantity']);
			unset($_SESSION['cname']);
			unset($_SESSION['service_nos']);
		
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
			unset($_SESSION['customerid']);			
			unset($_SESSION['name']);
			unset($_SESSION['address1']);			
			unset($_SESSION['address2']);
			unset($_SESSION['address3']);			
			unset($_SESSION['state']);
			unset($_SESSION['city']);			
			unset($_SESSION['zip']);
			unset($_SESSION['amount']);			
			unset($_SESSION['quantity']);
			unset($_SESSION['cname']);
			unset($_SESSION['service_nos']);
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
    width: 400px;
    padding: 0px 20px;
    background: #fff;
    border-radius: 5px;
    border-top: 5px solid #29ABE2;
    margin: 0 auto;
}
        
  

.login-block h1 {
    text-align: center;
    color: #000;
    font-size: 18px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
}

.login-block input {
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 20px;
    font-size: 14px;
    font-family: Montserrat;
    padding: 0 20px 0 50px;
    outline: none;
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

        <div class="logo_f"></div>
      
    
   <div class="col-sm-12">
<h1 style="font-size:27px;text-align:center;margin:20px 0px">Eneter OTP Code  </h1>
<div class="login-block" style="padding-top:20px  !importat; padding-bottom:40px  !importat;">

    <p style="    margin-top: 14px;">Check for OTP code which will be valid for  <span class="label label-success" style=" background-color:#005C9F;font-weight:bold; font-size:18px;"><span id="countdown"></span></span> mins.</p>
    <form action="" method="post">
	<input type="hidden"  name="send" value="<?php echo $_SESSION['end']?>" >
	
    <div class="form-group">
        <label class="col-xs-12 col-md-4 control-label" style="margin-top: 7px;">OTP Code :</label>
        <div class=" col-xs-12 col-md-7">
		<input type="password"  name="otpcode_check" class="form-control" required>
            
        </div>
    </div>
   <input type="submit" name="optcode" class="button" value="Check">
   
    </form>
    
    
    
    
</div>
   </div>
 

		     
    
	
	<!-- login code end -->
	
	
	<div class="clearfix"></div>
	
	
	
	
	<!-- FOOTER SECTION -->
	
	
	
	<!-- -Login Modal -->

 	<!-- - Login Model Ends Here -->
	
	
    
    
    
    
   
	
</body>


</html>
       

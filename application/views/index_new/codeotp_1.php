	<?php
	error_reporting(0);
session_start();

    if(isset($_REQUEST['optcode']))
	{		
	
	
		
		
		
		
 $verify=str_replace(' ','',$_REQUEST['otpcode_check']); // this step is to remove white spaces from input
		

		if($_SESSION['end'] > time()) /// check if 2 mins over or not
		 {
			if($_SESSION['otp']==$verify)
			{
			
		$name =$_SESSION['name'];
		$cmpname =$_SESSION['cname'];
		$customerid = $_SESSION['customerid'];
		$mobile = $_SESSION['mobile'];
		$email =$_SESSION['email'];
		$address1 = $_SESSION['address1'];
		$address2 = $_SESSION['address2'];
		$address3 =$_SESSION['address3'];
		$state = $_SESSION['state'];
		$city = $_SESSION['city'];
		$zip =$_SESSION['zip'];
		$amount=$_SESSION['amount'];
		$trnsale=$_SESSION['trnsale'];
		$cname=$_SESSION['cname'];
		$description=$_SESSION['description'];

		
		
				
		echo $url="http://www.smsstriker.com/payment/TestSsl.php?amount=".$amount."&name=".$name."&trnsale=".$trnsale."&customerid=".$customerid."&address1=".$address1."&address2=".$address2."&address3=".$address3."&city=".$city."&state=".$state."&email=".$email."&cname=".$cname."&desc=".$description."&mobile=".$mobile ."&zip=".$zip ;
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
			unset($_SESSION['trnsale']);
		
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
			unset($_SESSION['trnsale']);
			session_destroy();
			echo "<script> alert('2 min over please send again your otp code');</script>";
			//return false;
			
		 }
		
		
	}
	?>
    <header id="myCarousel" class="carousel slide height5">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="carousel-caption container">
                </div>
            </div>
        </div>
  <!-- Wrapper for slides -->
  <!-- Controls -->
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="icon-prev"></span>
  </a>
  
  </header>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css_otp/bootstrap.css">

<script type="text/javascript" src="<?php echo base_url(); ?>js_otp/jquery-2.0.3.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js_otp/jquery.countdownTimer.js"></script>
<script>
$(function(){
$('#m_timer').countdowntimer({
minutes :2,
size : "lg"
});
});
</script>


<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css_otp/jquery.countdownTimer.css" />
    	 <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="wrapper">
    <div class="inner_col">
    
   
    Message sent. Check for OTP code which will be valid for<?php //echo $_SESSION['otp'];?> <span id="m_timer"></span> mins.
                       
	  <form  method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
          <input type="hidden"  name="send" value="<?php echo $_SESSION['send'];?>" >

    <table class="table table-striped"><tr class="warning">
    <td>
    <font color="black"><b>OTP Code :</b></font>
    </td>
    <td>
    <input type="password"  name="otpcode_check" required>
    </td>
    <td>
    <input type="submit" name="optcode" class="btn" value="Check">
    </td>
    </tr>
    </table>
    </form>	
				</div></div></div></div>		  <!-- Footer -->
       
<?php
include('config/config.php');
require($Email_lib);
if(isset($_GET['save3'])) {
	$id = mysqli_real_escape_string($link,$_GET['userid']);
$otpverify = mysqli_real_escape_string($link,$_GET['otpverify']);

 $query = "SELECT * FROM price_enquery where id=".$id;
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
$rec=mysqli_fetch_array($result);

 	    $otpcode = $rec['otpcode'];
		$sendtime = $rec['otptime'];
		$smstype = $rec['smstype'];
		$noofsms = $rec['noofsms'];
		$subcription = $rec['subcription'];
		if($subcription==0){
		 $months="One Time";
		}else{
		 $months = $subcription."Months";
		}
		$email = $rec['email'];
		$name = $rec['name'];
	 $mobile = $rec['mobile'];

 
	if($otpcode==$otpverify)
		{
		
			if($sendtime > time()) /// check if 3 mins over or not
			 {
				
					 $query="UPDATE `price_enquery` SET `otpverify` = '1'   WHERE `id` =".$id;
					 mysqli_query($link,$query);

					$verify=1;
			  }else{
			  	$verify=2; // time out
			 	
			 	}
		}
		else
		{
		 $verify=0;
		}

echo json_encode(array("status"=>200,'verifystatus'=>$verify));		
	
	@mysqli_close($link);
	
 
 }
 

/*******For resend otp user **************/
 if(isset($_GET['resendotp'])) {
		$generateotp=substr(mt_rand(), 0, 4); /// to generate random number
		$time = time() + 1 * 60;	// set sesion time to 3 mins
		
		$otp =array("otp"=>$generateotp);

		$name = mysqli_real_escape_string($link,$_GET['name']);
		$email = mysqli_real_escape_string($link,$_GET['email']);
		
		$mobile = mysqli_real_escape_string($link,$_GET['mobile']);
		 $query="UPDATE `price_enquery` SET `otpcode`= '$generateotp',`otptime`= '$time'   WHERE `id` =".$_GET['userid'];
		mysqli_query($link,$query);
   $affectrow= mysqli_affected_rows($link);
   
if($affectrow){
echo json_encode(array("status"=>200,'resend'=>1,"otp"=>$generateotp));		
}

	@mysqli_close($link);
}
	

/*******For user information and send otp**************/
 if(isset($_GET['save2'])) {
 
 
		$generateotp=substr(mt_rand(), 0, 4); /// to generate random number
		$time = time() + 3 * 60;	// set sesion time to 3 mins	
		$otp =array("otp"=>$generateotp);
		$name = mysqli_real_escape_string($link,$_GET['username']);
		$email = mysqli_real_escape_string($link,$_GET['email']);
		$mobile = mysqli_real_escape_string($link,$_GET['mobile']);
		$query="UPDATE `price_enquery` SET `name` = '$name',
		`email`= '$email', `mobile`= '$mobile' ,`otpcode`= '$generateotp' ,`otptime`= '$time'   WHERE `id` =".$_GET['userid'];
		mysqli_query($link,$query);
   $affectrow= mysqli_affected_rows($link);

if($affectrow){
echo json_encode(array("status"=>200,"otp"=>$generateotp));		
}

	@mysqli_close($link);
}


/*******************required sms information **********************/

 if(isset($_GET['method_save']) && $_GET['method_save']=='save' ) {
	
$noofsms = mysqli_real_escape_string($link,$_GET['noofsms']);
$smstype = mysqli_real_escape_string($link,$_GET['smstype']);
$subcription = mysqli_real_escape_string($link,$_GET['subcription']);
$insert_query = "INSERT INTO `price_enquery` (`noofsms`, `smstype`, `servicetype`, `subcription`) VALUES
 ('$noofsms','$smstype','sms','$subcription');";
  
	mysqli_query($link,$insert_query);
	$id=mysqli_insert_id($link);
	$query = "SELECT * FROM price_enquery where id=".$id;
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	$price_enquery = array();
		while($result1=mysqli_fetch_object($result))
		{
		 $price_enquery[] = $result1;
		}
		echo json_encode($price_enquery) ;

	@mysqli_close($link);
}







?>

<?php
session_start();
include('config/config.php');
// username validation
if(isset($_REQUEST['mbnovalidation']) || $_REQUEST['mbnovalidation']=='mbnovalidation') {
	$mobileno=$_REQUEST['mobileno'];
	$usrexistquery=	mysqli_query($link,"select count(*) as cnt from users where mobile='$mobileno'");
$existornot=	mysqli_fetch_array($usrexistquery);
if($existornot['cnt']!=0)
{
		 echo json_encode(array("message"=>"User Mobile No already in use","color"=>"red","status"=>200));

}else{

     echo json_encode(array("message"=>"User Mobile No is available","color"=>"green","status"=>200));
}
	
}


if(isset($_REQUEST['emailvalidation']) || $_REQUEST['emailvalidation']=='emailvalidation') {
	$userEmailID=$_REQUEST['userEmailID'];
	$usrexistquery=	mysqli_query($link,"select count(*) as cnt from users where email='".trim($userEmailID)."'");
$existornot= mysqli_fetch_array($usrexistquery);
if($existornot['cnt']!=0)
{
		 echo json_encode(array("message"=>"User Email already in use","color"=>"red","status"=>200));

}else{

     echo json_encode(array("message"=>"User Email is available","color"=>"green","status"=>200));
}
	
}
  

if(isset($_REQUEST['unvalidation']) || $_REQUEST['unvalidation']=='unvalidation') {
	$username=$_REQUEST['username'];
	$usrexistquery=	mysqli_query($link,"select count(*) as cnt from users where username='$username'");
$existornot=	mysqli_fetch_array($usrexistquery);
if($existornot['cnt']!=0)
{
		 echo json_encode(array("message"=>"User Name already in use","color"=>"red","status"=>200));

}else{

     echo json_encode(array("message"=>"User Name is available","color"=>"green","status"=>200));
}
	
}


 
$debug=true;
if(isset($_REQUEST['registration']) || $_REQUEST['registration']=='Registration') {
	$username=$_REQUEST['username'];
	$firstname=$_REQUEST['firstname'];
	$lastname=$_REQUEST['lastname'];
	$_SESSION['userpassword']=trim($_REQUEST['password']);
	$password=md5($_REQUEST['password']);
	$emailid=$_REQUEST['emailid'];
	$mobileno=$_REQUEST['mobileno'];
	$organization=$_REQUEST['organization'];
	$address1=$_REQUEST['address1'];
	$address2=$_REQUEST['address1'];
	$state_id=trim($_REQUEST['state_id']);
	$city_id=trim($_REQUEST['city_id']);
	$zipcode=$_REQUEST['pincode'];
	$shorturl_credits = 100000;
	
	$sql="select * from users where username='$username'";
	$result=mysqli_query($link,$sql);
	
	if(mysqli_num_rows($result)==0)
	{
	
	$query = "insert into users (username,password,first_name,last_name,email,mobile,otpMobileNo,
	organization,address1,address2,city_id,state_id,zipcode,registered_on,mverify,shorturl_credits)
	values('$username','$password','$firstname','$lastname','$emailid',
	'$mobileno','$mobileno','$organization','$address1','$address2',$city_id,$state_id,$zipcode,'".date('Y-m-d H:i:s')."','1','$shorturl_credits')"; 
		$result = mysqli_query($link,$query) or die('Error query:  '.$query);
		$userid=mysqli_insert_id($link);
		if($userid) {
			$leadQ = "INSERT INTO price_enquery (name,mobile,email,registeruser_id,pagetype) VALUES('".$username."','".$mobileno."','".$emailid."','".$userid."','home-reg')";
			mysqli_query($link,$leadQ);	  	  
		} 
		
				if($_REQUEST['paynow']=='paynow')
				{
					$id=base64_decode($_REQUEST['id']);
					$data=mysqli_fetch_array(mysqli_query($link,"select smstype from price_enquery where id=$id"));
					$smstype=$data['smstype'];
		             $no_ndnc=0;
					 $dnd_check=0;
					if($smstype=='Transactional'){
					 $no_ndnc=1;
					 $dnd_check=1;
					}
					$query="update price_enquery set registeruser_id=$userid,payment_status=0 where id=$id";
					mysqli_query($link,$query) or die('Error query:  '.$query);
					// update mverify 0 as 1
					$uquery="update users set mverify=1,no_ndnc=$no_ndnc,dnd_check=$dnd_check where user_id=$userid";
					mysqli_query($link,$uquery) or die('Error query:  '.$uquery);
				}
				
				if($_REQUEST['demo']=='demo')
				{
					$id=base64_decode($_REQUEST['id']);
					$data=mysqli_fetch_array(mysqli_query($link,"select smstype from price_enquery where id=$id"));
					$smstype=$data['smstype'];
		             $no_ndnc=0;
					 $dnd_check=0;
					if($smstype=='Transactional'){
					 $no_ndnc=1;
					 $dnd_check=1;
					}
					$query="update price_enquery set registeruser_id=$userid,payment_status=0 where id=$id";
					mysqli_query($link,$query) or die('Error query:  '.$query);
					// update mverify 0 as 1
					// $uquery="update users set mverify=1,no_ndnc=$no_ndnc,dnd_check=$dnd_check,available_credits=100 where user_id=$userid";
					$uquery="update users set mverify=1,no_ndnc=$no_ndnc,dnd_check=$dnd_check,available_credits= 50 where user_id=$userid";  
					mysqli_query($link,$uquery) or die('Error query:  '.$uquery);
				}
	$userid=base64_encode($userid);		
	$data=array("status"=>200,"message"=>"Registration Successfully","code"=>1,"data"=>$userid);
		//   send_email_admin($username,$emailid,$mobileno,$Email_lib); 
	}
	else
	{  
	$data=array("status"=>200,"message"=>"User Name already in use","code"=>2);
	}  
	
	if($debug){
	error_log($query,3,$registrationlog);
	}
	print_r(json_encode($data));
	//send_email_admin($username,$emailid,$mobileno,$Email_lib); 
}
// get all states
if(isset($_REQUEST['getstate']) || $_REQUEST['getstate']=='all') {
	$query = "SELECT * FROM new_statelist"; 
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	echo "<option value=''>Select State</option>";
	while($row=mysqli_fetch_assoc($result))
	{
	?>
	<option value="<?php echo $row['state_id']?>"><?php echo $row['state']?></option>
	<?php
	}
}

// get confirm order all states
if(isset($_REQUEST['cnfrmgetstate']) || $_REQUEST['cnfrmgetstate']=='all') {
	$query = "SELECT * FROM new_statelist"; 
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	echo "<option value=''>Select State</option>";
	$selected="";
	while($row=mysqli_fetch_assoc($result))
	{
	?>
	<option value="<?php echo $row['state_id']?>" <?php if($_REQUEST['stateid']==$row['state_id']){ echo $selected="selected";}?> ><?php echo $row['state']?></option>
	<?php
	}
}
// get all cities
if(isset($_REQUEST['getcity']) || $_REQUEST['getcity']=='all') {
	$state_id=$_REQUEST['state_id'];
	$query = "SELECT * FROM new_citylist where state_id='$state_id'"; 
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	echo "<option value=''>Select City</option>";
	while($row=mysqli_fetch_assoc($result))
	{
	?>
	<option value="<?php echo $row['city_id']?>"><?php echo $row['city_name']?></option>
	<?php  
	}
}

// get all cities
if(isset($_REQUEST['cnfrmgetcity']) || $_REQUEST['cnfrmgetcity']=='all') {
	$state_id=$_REQUEST['state_id'];
	$query = "SELECT * FROM new_citylist where state_id='$state_id'"; 
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	echo "<option value=''>Select City</option>";
	$selected="";
	while($row=mysqli_fetch_assoc($result))
	{
	
	/*
	if($_REQUEST['city_id']>0)
	{
	  if($_REQUEST['city_id']==$row['city_id'])
	  {
	  $selected="selected";
	  }
	}
	*/
	
	?>
<option value="<?php echo $row['city_id']?>" <?php if($_REQUEST['city_id']==$row['city_id']){ echo $selected="selected";}?> ><?php echo $row['city_name']?></option>
	<?php
	}
}

// user login
if(isset($_REQUEST['Login']) || $_REQUEST['Login']=='Login') {
	$username=$_REQUEST['username'];
	$password=md5($_REQUEST['password']);
	$query = "SELECT * FROM users where username='$username' and password='$password'"; 
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	if(mysqli_num_rows($result)>0)
	{
	session_start();
	$userdetails=mysqli_fetch_assoc($result);
	$_SESSION['userdetails']=$userdetails;
	print_r(json_encode(array('status'=>"success")));
	}
	else
	{
	print_r(json_encode(array('status'=>"failed")));
	}
}
// user forgot password
if(isset($_REQUEST['forgot']) || $_REQUEST['forgot']=='submit') {
	unset($_SESSION['newpassword']);
	$username=$_REQUEST['username'];
	$query = "SELECT * FROM users where username='$username'"; 
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	if(mysqli_num_rows($result)>0)
	{
	$userdetails=mysqli_fetch_assoc($result);
	$mobile=$userdetails['mobile'];
	$email= $userdetails['email'];
	$user_id = $userdetails['user_id'];  
		if($user_id == 4130) { 
			print_r(json_encode(array('status'=>"success",'errorCode' => 201)));
		}else{
			$new_password = generatePassword();//rand(100000,999999);
			$_SESSION['new_password']=$new_password;
			$_SESSION['mobileno']=$mobile;  
			$_SESSION['username']=$username;  
			$_SESSION['email']=$email;
			/*$password=md5($new_password);
			$query = "update users set password='$password' where username='$username'"; 
			$result = mysqli_query($link,$query) or die('Error query:  '.$query);
			print_r(json_encode(array('status'=>"success",'errorCode' => 200)));*/
  
			$otpCode = generateOtpCode();
			sendOTP($mobile,$otpCode,$username);
			$query = "update users set otpCode='$otpCode' where user_id ='".$user_id."'"; 
			$result = mysqli_query($link,$query) or die('Error query:  '.$query);
			print_r(json_encode(array('status'=>"success",'errorCode' => 200,'username' => $username)));		
		}  
	}  
	else  
	{
	print_r(json_encode(array('status'=>"failed",'errorCode' => 201)));
	}
}
// user forgot password message sending!...
if(isset($_REQUEST['forgotmsg']) || $_REQUEST['forgotmsg']=='forgotmsg') {
	
	        
	if(isset($_SESSION['new_password']) && isset($_SESSION['mobileno']) && isset($_SESSION['username']) && isset($_SESSION['email']))
	{
	$new_password=$_SESSION['new_password'];
	$mobile=$_SESSION['mobileno'];
	$username=$_SESSION['username']; 
	$email=$_SESSION['email'];
	
	$sms_text = "Your SMS Striker's User Id : $username ,New Password is: $new_password. - Support, ".$_SERVER['SERVER_NAME'];
	$sms_url = "https://www.smsstriker.com/API/sms.php?";
	$sms_url .= "username=support&password=Str!k3r2020&from=STRIKR&to=$mobile&msg=".urlencode($sms_text)."&type=1";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $sms_url);
			curl_setopt($ch, CURLOPT_header_new, 0);
			curl_exec($ch);
			curl_close($ch);
			send_email($username,$new_password,$email,$mobile,$Email_lib);
	unset($_SESSION['new_password']);
	unset($_SESSION['mobileno']);
	unset($_SESSION['username']);
	echo json_encode(array("message"=>"Password sent to your E-mail & Mobile !!..","color"=>"green","status"=>200));
	}
	else 
	{
	 echo json_encode(array("message"=>"Alredy your request sent","color"=>"red","status"=>200));
	}
		
}  




if(isset($_REQUEST['fpuserID']) && isset($_REQUEST['OTP']) && isset($_REQUEST['otpCode'])) {
	$username = $_REQUEST['fpuserID'];
	$otpCode = $_REQUEST['otpCode'];	  
	$query = "SELECT mobile,email,user_id FROM users where username='$username' and otpCode = '$otpCode'"; 
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);
	if(mysqli_num_rows($result)>0)
	{  
		$userdetails=mysqli_fetch_assoc($result);
		$mobile=$userdetails['mobile'];
		$email= $userdetails['email'];
		$user_id = $userdetails['user_id'];  
		if($user_id == 4130) {   
				print_r(json_encode(array('status'=>"success",'errorCode' => 201)));
		}else{
			if(isset($_SESSION['new_password'])) {
				$new_password = $_SESSION['new_password'];
				$password=md5($new_password);  
				$query = "update users set password='$password' where username='$username'"; 
				$result = mysqli_query($link,$query) or die('Error query:  '.$query);
				print_r(json_encode(array('status'=>"success",'errorCode' => 200)));
			}else{
				print_r(json_encode(array('status'=>"success",'errorCode' => 202)));
			}
		}       
	}else{     
  
		print_r(json_encode(array('status'=>"failed",'errorCode' => 201)));
	} 
  
}



function generateOtpCode($l = 8, $c = 0, $n = 8, $s = 0) {
	   // get count of all required minimum special chars
	   $count = $c + $n + $s;
	 
	   // sanitize inputs; should be self-explanatory
	   if(!is_int($l) || !is_int($c) || !is_int($n) || !is_int($s)) {
	      trigger_error('Argument(s) not an integer', E_USER_WARNING);
	      return false;
	   }
	   elseif($l < 0 || $l > 20 || $c < 0 || $n < 0 || $s < 0) {
	      trigger_error('Argument(s) out of range', E_USER_WARNING);
	      return false;
	   }
	   elseif($c > $l) {
	      trigger_error('Number of password capitals required exceeds password length', E_USER_WARNING);
	      return false;
	   }  
	   elseif($n > $l) {
	      trigger_error('Number of password numerals exceeds password length', E_USER_WARNING);
	      return false;
	   }
	   elseif($s > $l) {
	      trigger_error('Number of password capitals exceeds password length', E_USER_WARNING);
	      return false;
	   }
	   elseif($count > $l) {
	      trigger_error('Number of password special characters exceeds specified password length', E_USER_WARNING);
	      return false;
	   }
	 
	   // all inputs clean, proceed to build password
	 
	   // change these strings if you want to include or exclude possible password characters
	   $chars = "abcdefghijklmnopqrstuvwxyz";
	   $caps = strtoupper($chars);
	   $nums = "0123456789";
	   $syms = "!@#%^&*$?";
	   $out = '';
	   // build the base password of all lower-case letters
	   for($i = 0; $i < $l; $i++) {
	      $out .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
	   }
	 
	   // create arrays if special character(s) required
	   if($count) {
	      // split base password to array; create special chars array
	      $tmp1 = str_split($out);
	      $tmp2 = array();
	 
	      // add required special character(s) to second array
	      for($i = 0; $i < $c; $i++) {
		 array_push($tmp2, substr($caps, mt_rand(0, strlen($caps) - 1), 1));
	      }
	      for($i = 0; $i < $n; $i++) {
		 array_push($tmp2, substr($nums, mt_rand(0, strlen($nums) - 1), 1));
	      }
	      for($i = 0; $i < $s; $i++) {
		 array_push($tmp2, substr($syms, mt_rand(0, strlen($syms) - 1), 1));
	      }
	 
	      // hack off a chunk of the base password array that's as big as the special chars array
	      $tmp1 = array_slice($tmp1, 0, $l - $count);
	      // merge special character(s) array with base password array
	      $tmp1 = array_merge($tmp1, $tmp2);
	      // mix the characters up
	      shuffle($tmp1);
	      // convert to string for output
	      $out = implode('', $tmp1);
	   }
	 
	   return $out;  
	}






function generatePassword($l = 9, $c = 4, $n = 1, $s = 4) {
	   // get count of all required minimum special chars
	   $count = $c + $n + $s;
	 
	   // sanitize inputs; should be self-explanatory
	   if(!is_int($l) || !is_int($c) || !is_int($n) || !is_int($s)) {
	      trigger_error('Argument(s) not an integer', E_USER_WARNING);
	      return false;
	   }
	   elseif($l < 0 || $l > 20 || $c < 0 || $n < 0 || $s < 0) {
	      trigger_error('Argument(s) out of range', E_USER_WARNING);
	      return false;
	   }
	   elseif($c > $l) {
	      trigger_error('Number of password capitals required exceeds password length', E_USER_WARNING);
	      return false;
	   }  
	   elseif($n > $l) {
	      trigger_error('Number of password numerals exceeds password length', E_USER_WARNING);
	      return false;
	   }
	   elseif($s > $l) {
	      trigger_error('Number of password capitals exceeds password length', E_USER_WARNING);
	      return false;
	   }
	   elseif($count > $l) {
	      trigger_error('Number of password special characters exceeds specified password length', E_USER_WARNING);
	      return false;
	   }
	 
	   // all inputs clean, proceed to build password
	 
	   // change these strings if you want to include or exclude possible password characters
	   $chars = "abcdefghijklmnopqrstuvwxyz";
	   $caps = strtoupper($chars);
	   $nums = "0123456789";
	   $syms =  $chars;
	   $out = '';
	   // build the base password of all lower-case letters
	   for($i = 0; $i < $l; $i++) {
	      $out .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
	   }
	 
	   // create arrays if special character(s) required
	   if($count) {
	      // split base password to array; create special chars array
	      $tmp1 = str_split($out);
	      $tmp2 = array();
	 
	      // add required special character(s) to second array
	      for($i = 0; $i < $c; $i++) {
		 array_push($tmp2, substr($caps, mt_rand(0, strlen($caps) - 1), 1));
	      }
	      for($i = 0; $i < $n; $i++) {
		 array_push($tmp2, substr($nums, mt_rand(0, strlen($nums) - 1), 1));
	      }
	      for($i = 0; $i < $s; $i++) {
		 array_push($tmp2, substr($syms, mt_rand(0, strlen($syms) - 1), 1));
	      }
	 
	      // hack off a chunk of the base password array that's as big as the special chars array
	      $tmp1 = array_slice($tmp1, 0, $l - $count);
	      // merge special character(s) array with base password array
	      $tmp1 = array_merge($tmp1, $tmp2);
	      // mix the characters up
	      shuffle($tmp1);
	      // convert to string for output
	      $out = implode('', $tmp1);
	   }
	 
	   return $out;  
	}




function sendOTP($mobile,$otp,$name) {
	$user="support";    
	$password="Str!k3r2020"; 

	$message = "Dear $name,Your OTP Code to change password is : $otp";

	$messagetype="1";  

  
	$message = urlencode($message);   
	 $senderid="STRIKR";    


	$url = "https://www.smsstriker.com/API/sms.php?username=$user&password=$password&from=$senderid&to=$mobile&msg=$message&type=$messagetype";
	$res = file_get_contents($url); 


}  
  
  










 

 

function send_email_admin($name,$email,$mobile,$Email_lib) {
require($Email_lib);
//*** sent sms plan status **// 
$username=ucfirst($name);

$mail = new PHPMailer();
 
// set mailer to use SMTP
$mail->IsSMTP();
  
$mail -> SMTPDebug = 2;
$mail->Host = 'mail.office24by7.in';
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Port = 465;
$mail->Username = "app@office24by7.in";  // SMTP username
$mail->Password = "Str!ker@123"; // SMTP password
$mail->FromName = "smsstriker";
$mail->SetFrom("support@smsstriker.com", 'smsstriker'); 
 
 //$mail->AddBCC("sandeepthicse@gmail.com", "SMSSTRIKER");
//$mail->AddBCC("supraja.thanga@smsstriker.in", "SMSSTRIKER");
//$mail->AddBCC("accounts@smsstriker.com", "SMSSTRIKER");
//$mail->AddBCC("naveen@smsstriker.com", "SMSSTRIKER");
//$mail->AddBCC("muzaffar@strikersoft.in", "SMSSTRIKER");
$mail->WordWrap = 50;
$mail->IsHTML(true);   
$mail->Subject = "SMSSTRIKER - New User Registration";

 $message = '<html><head><link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	<style>
	.price-title:before{position:absolute;;border-top:8px solid #e6e6e6;   width: 100%;
	    height: 24px;
	    left: 0px;
	    top: -9px;}
		.price-title h4{margin:0px;padding-top:15px;padding-bottom:15px;font-size: 18px;}

	.contactbtm:before{position:absolute;content:"";border-top:8px solid #e6e6e6;    width: 100%;
	    height: 24px;
	    left: 0px;
	    top: -9px;}

		.halfwidthlist{width:100%;max-width: 200px;    float: left;}
		@media (max-width:525px){
		.reponsive-table{overflow-x: scroll;}
		.play-btn a{border:0px;}
		}
	</style>
	</head>
	<body style="padding:0px;margin:0px;font-family: Lato,sans-serif;">
	<div style="width:100%;max-width:600px;float: left;">
	       <p> Dear Team,</p></br>
	        
	        <p>Here are the new user information.</p>
		<p>Name : '.$username.'</p>	
		<p>Email : '.$email.'</p>
		<p>Mobile : '.$mobile.'</p>
		 
	</div>
	</body>
</html>';


	$mail->Body    = $message;
	$mail->AltBody = $message;

	if(!$mail->Send())
	{
	   echo "Message could not be sent. <p>";
	   echo "Mailer Error: " . $mail->ErrorInfo;

	}else{

		echo "Message has been sent";
	}
}







function  send_email($name,$new_password,$email,$mobile,$Email_lib){
require($Email_lib);


$mail = new PHPMailer();
// set mailer to use SMTP
$mail->IsSMTP();
$mail -> SMTPDebug = 3;
$mail->Host = 'mail.office24by7.in';
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Port = 465;
$mail->Username = "app@office24by7.in";  // SMTP username
$mail->Password = "Str!ker@123"; // SMTP password
$mail->FromName = "smsstriker";
$mail->SetFrom('support@smsstriker.com', 'SMSSTRIKER');
//$mail->AddBCC("supraja.thanga@smsstriker.in", "SMSSTRIKER");
//$mail->AddBCC("accounts@smsstriker.com", "SMSSTRIKER");
//$mail->AddBCC("naveen@smsstriker.com", "SMSSTRIKER");
//$mail->AddBCC("muzaffar@strikersoft.in", "SMSSTRIKER");
//$mail->AddReplyTo($email, $name); // indicates ReplyTo headers
$mail->AddAddress($email, $name);
$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = "Forgot password successfully sent";
  

 $message = '<!DOCTYPE html> 
					<head> 
					<title>SMS Striker</title> 
					<meta name="viewport" content="width=device-width, initial-scale=1"> 
					<meta name="description" content="" > 
					<meta name="keywords" content="">  
					<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> 
					 
					 
					<style> 
					body{margin:0px;padding:0px;font-family: sans-serif; font-size: 13px;   color: #1f497d;    line-height: 1.5;} 
					p{    margin-top: 0px; 
					   margin-bottom: 0px;} 
					.col-sm-12{width:100%;float:left;} 
					.container{width:600px;margin:auto;} 
					.signature p{color: gray;} 
					a{color:#15c !important;} 
					 
					</style> 
					</head> 
					 
					   <body> 
					   <div class="col-sm-12"> 
					   <div class="container"> 
					<p>Dear '.ucfirst($name).'</p> 
					<br> 
						<p>Username : '.$name.' </p>
						<p>Mobile : '.$mobile.' </p>
						<p>New Password : '.$new_password.' </p>
					<br> 
					

					<p>Link: <a href="https://www.smsstriker.com/login.html">https://www.smsstriker.com</a></p> 
					
					<p>For any services related issues, please contact to <a href="mailto:support@smsstriker.com" target="_top">support@smsstriker.com&#59;</a> contact : 040 &#45;79417711.</p>  
					<br> 
					<p>For providing your feedback, please click the URL : <a href="https://www.smsstriker.com/contact-us.html">https://www.smsstriker.com </a></p> 
					<p>Thanks for being our valid customer....Have a great day ahead.....</p> 
					<br>
					<p><b>Best Regards&#44;</b></p><br> 
					<p><b>Striker Soft Solutions Pvt Ltd.&#44;</b></p> 
					<div> 
					<img src="https://www.smsstriker.com/images_n/logo.png" style="width:155px;margin-top:7px;margin-bottom:7px;"> 
					</div> 
					<div class="signature"> 
					<p><b>(Delloitte India&#39;s Fast 50 Tech companies)</b></p> 
					<p><b>Sinmon Dwaraka| Opp: Cyber Gateways</b></p> 
					<p><b>Hightech City| Hyderabad &#45; 81 | +91  7097 19 19 19</b></p> 

					</div> 
					</div> 
					</div> 
					</body> 
					    
					</html>'; 


				$mail->Body    = $message;
				$mail->AltBody = $message;

				if(!$mail->Send())
				{
				 echo "Message could not be sent. <p>";
				 echo "Mailer Error: " . $mail->ErrorInfo;

				}else{

				echo "Message has been sent";
				}

							 
        

      }

?>

 

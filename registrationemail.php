<?php
session_start();
include('config/config.php');
/****************** OTP verify *********************/
// contact email send.....
if(isset($_POST['sendemail']) && $_POST['sendemail'] == "registration") {

 $username=mysqli_real_escape_string($link, $_POST['ud']);

 $result=mysqli_query($link,"select * from users where username='$username' and is_send=0");
  if(mysqli_num_rows($result)>0)
  {
	  
		 $row=mysqli_fetch_assoc($result);
		 $username=ucfirst($row['username']);
		 $userpassword=$_SESSION['userpassword'];
		 $email=$row['email'];
		 $mobile=$row['mobile'];
         $sql="update users set is_send=1 where username='$username' and is_send=0";
		 mysqli_query($link,$sql);
		 send_email($username,$userpassword,$email,$mobile);
		 echo json_encode(array("message"=>"your request has been sent","color"=>"green","status"=>200));
  }
  else
  {
     echo json_encode(array("message"=>"your request has been sent","color"=>"green","status"=>200));
    //echo json_encode(array("message"=>"Alredy your request sent","color"=>"red","status"=>200));
  }
  
  mysqli_close($link);
}
function  send_email($name,$userpassword,$email,$mobile){


$username=ucfirst($name);

require("PHPMailer-master/PHPMailerAutoload.php");
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
$mail->SetFrom('support@smsstriker.com', 'Registration from Striker');
//$mail->AddReplyTo($email, $name); // indicates ReplyTo headers
$mail->AddAddress($email, $name);
//$mail->AddBCC("joshi.herald@smsstriker.in", "Registration from Striker");
//$mail->AddBCC("naveen@smsstriker.com", "Registration from Striker");
$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = "Registration successfully";


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
					<p>Dear '.$username.' ,</p>
					<br> 
						<p>Username : '.$name.' </p>
						<p>Password : '.$userpassword.' </p>
						<p>Mobile : '.$mobile.' </p>
					<br> 
					

					<p>Link: <a href="https://www.smsstriker.com/login.html">https://www.smsstriker.com</a></p> 
					
					<p>For any services related issues, please contact to <a href="mailto:support@smsstriker.com" target="_top">support@smsstriker.com&#59;</a> contact : +91  7097 19 19 19.</p>  
					<br> 
					<p>For providing your feedback, please click the URL : <a href="https://www.smsstriker.com/contact-us.html">https://www.smsstriker.com </a></p> 
					<p>Thanks for being our valid customer....Have a great day ahead.....</p> 
					<br>
					<p><b>Best Regards&#44;</b></p> 
					<p><b>Striker Soft Solutions Pvt Ltd.&#44;</b></p> 
					<div> 
					<img src="https://www.smsstriker.com/images_n/logo.png" style="width:155px;margin-top:7px;margin-bottom:7px;"> 
					</div> 
					<div class="signature"> 
					<p><b>(Delloitte India&#39;s Fast 50 Tech companies)</b></p> 
					<p><b>Sinmon Dwaraka| Opp: Cyber Gateways</b></p> 
					<p><b>Hightech City| Hyderabad &#45; 81 |</b></p> 

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

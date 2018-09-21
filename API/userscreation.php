<?php 
include("dbconnect/config.php");  

require("/var/www/html/strikerapp/PHPMailer-master/PHPMailerAutoload.php");
 
if($_REQUEST['api_keys'] && $_REQUEST['username'] && $_REQUEST['password'] && $_REQUEST['first_name'] && $_REQUEST['last_name'] && $_REQUEST['email'] && $_REQUEST['organization'] && $_REQUEST['pincode'] && $_REQUEST['mobile'] && $_REQUEST['address'] && $_REQUEST['sender_id'] && $_REQUEST['senderidpurpose'])
{        
   
	 $username=trim(urldecode($_REQUEST['username']));
	$password=trim(urldecode($_REQUEST['password']));
	$passwordset=md5($password);
	$senderid=trim(urldecode($_REQUEST['sender_id']));
	$senderiddesc=trim(urldecode($_REQUEST['senderidpurpose']));
	$first_name=trim(urldecode($_REQUEST['first_name']));
	$last_name=trim(urldecode($_REQUEST['last_name']));
	$email=trim(urldecode($_REQUEST['email']));
	$mobile=trim(urldecode($_REQUEST['mobile']));
	$organization=trim(urldecode($_REQUEST['organization']));
	$address=trim(urldecode($_REQUEST['address']));
	$pincode=trim(urldecode($_REQUEST['pincode']));
	$apikey=trim(urldecode($_REQUEST['api_keys']));
	$sql_query=$mysqli->query("select count(*) as cnt, user_id from api_keys where user_keys='$apikey'");
	$apidata=$sql_query->fetch_array();
	$reseller_id =$apidata['user_id'];
 
	if($apidata['cnt']==1){
		$sql_username=$mysqli->query("select count(*) as cntusers, username from users where username='$username'");
		$apiusers= $sql_username->fetch_array();
		if($apiusers['cntusers']==0){
			$sql_nondnc=$mysqli->query("select no_ndnc,username,organization from users where user_id='$reseller_id'");
			$nondnc_type=$sql_nondnc->fetch_array();
			$no_ndnc_users=$nondnc_type['no_ndnc'];
			$resellername=$nondnc_type['username'];
			$organization=$nondnc_type['organization'];
			$sql=$mysqli->query("insert into users (`username`, `password`, `first_name`, `last_name`, `email`, `mobile`, `organization`, `address1`,  `zipcode`,  `reseller_id`,`no_ndnc`,registered_on) VALUES ('$username','$passwordset','$first_name','$last_name','$email','$mobile','$organization','$address','$pincode','$reseller_id','$no_ndnc_users',NOW())");
			$userid=$mysqli->insert_id;

			$mysqli->query("INSERT INTO `sms`.`sender_names` (`user_id`, `sender_name`, `status`, `on_date`, `added_by`) VALUES ($userid,'$senderid', 0, NOW(),$reseller_id)");

 			send_email_forbal($username,$email,$senderid,$senderiddesc,$resellername,$organization);
	
			$response["sucess"]="User Created Successfully.";
		}
		else
		{
			$response["sucess"]=" Already User Exist.Please Choose Another UserName.";
		}
	}
	else
	{
		$response["sucess"]="Invalid Key.";
	} 
	print_r(json_encode($response));   
}else{
   echo "Required Parameters Missing.";
}
   


function send_email_forbal($username,$email,$senderid,$senderiddesc,$resellername,$organization){


$mail = new PHPMailer();

// set mailer to use SMTP
$mail->IsSMTP();

 $mail -> SMTPDebug = 2;

$mail->Host = 'mail.office24by7.in';
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Port = 465;
$mail->Username = "app@office24by7.in";  // SMTP username
$mail->Password = "Str!ker@123"; // SMTP password


$mail->FromName = "$username";

$mail->SetFrom($email, $username);

$mail->AddReplyTo("support@smsstriker.com", "Support"); // indicates ReplyTo headers
$mail->AddAddress('support@smsstriker.com', $username);


$mail->WordWrap = 50;
// set email format to HTML
$mail->IsHTML(true);

$mail->Subject = "Sender ID Approval Request!";

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
					<p>Dear Team,</p> 
					<br> 
					<p>Greetings from '.$organization.' !</p> 
					<br> 
							
					<p>Please Approve My Sender ID:<b> '.$senderid.' </b>  My Username is <b> '.$username.' </b></p> 
					<br> 
					
					<p>Purpose of Sender ID: '.$senderiddesc.'</p> 

					<p><b>Best Regards&#44;</b></p>
					<p><b>Striker Reseller&#44;</b></p>
					<p><b>'.$resellername.'</b></p>
					<p><b>'.$organization.'</b></p> 

					
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

$mysqli->close();
?>

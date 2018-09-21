<?php
session_start();
include('config/config.php');


$base_url="http://www.smsstriker.com";
/****************** OTP verify *********************/

/*******************required sms information **********************/
if(isset($_POST['contactsave']) && $_POST['contactsave'] == "contactsave") {
	
	$name=$_POST['personname'];
	$email=$_POST['personemail'];
	$mobile=$_POST['personphone'];
	$messege=$_POST['personmessage'];
	$orgName = $_POST['personOrg'];
	//send_email($name,$email,$mobile,$messege);
	  $sql="insert into contact_form(name,mobile,email,message,company_name) values('$name','$mobile','$email','$messege','$orgName')";
	mysqli_query($link,$sql);
	$contact_id = mysqli_insert_id($link);
		echo json_encode(array("contact_id"=>$contact_id,"status"=>200));		
	if($contact_id) {
		$source = 'enquiry-form';
		send_leadInfo_to_sales($name,$mobile,$email,$source,$base_url); 
		header("Location:https://www.smsstriker.com/thank-you.html");
	}
		            

}


  


function send_leadInfo_to_sales($name,$number,$email,$source,$base_url) { 
	$tmp_number = trim($number);
	if(strlen($tmp_number)==10 )
	{  
		if($tmp_number[0]==7 or $tmp_number[0]==8 or $tmp_number[0]==9 )
		{ 
			$username = ucfirst($name);	   
			$sms_text = "Striker Enquiry From User : $username,Email : $email, Mobile : $number, source : $source.";
			$sms_url = "http://www.smsstriker.com/API/sms.php?";
			$toNumbers = '8886638814';
			if($number == 8885966361) { $toNumbers = '8885966361';	}
			$sms_url .= "username=support&password=Str!k3r2020&from=STRIKR&to=$toNumbers&msg=".urlencode($sms_text)."&type=1";
			$ch = curl_init();  
			curl_setopt($ch, CURLOPT_URL, $sms_url);
			curl_setopt($ch, CURLOPT_header_new, 0);  
			curl_exec($ch);
			curl_close($ch);    
		 
			if($number != 8885966361) {    
				$result = file_get_contents("http://inhostapis.office24by7.com/LeadGenerate/AddLead?API_Key=175b2d4f-bd75-4878-8d53-7aaa2eca4731&cust_number=$number&listname=PPC&source_type=$source"); 
				
				$username =   str_replace(' ', '%20', $username);  
				
				
				$request = "https://demo.office24by7.com/inhost/apis/Generate/Tracker?API_Key=175b2d4f-bd75-4878-8d53-7aaa2eca4731&First_Name=$username&Email_ID=$email&Mobile_Number=$number&Source_Event=SEO&Source_Type=Landing%20Page&Source_Value=Smart%20SMS&Budget=0";   
			    
				$date = date('Y-m-d');  
			
				error_log("\n".date('Y-m-d H:i:s')."| Inhost API Request |".$number.' - '.$request."\r\n",3,"/var/www/html/logs/striker_leads_logs/request_".$date.".log"); 
			
				$resultInhost = file_get_contents($request);
				error_log("\n".date('Y-m-d H:i:s')."| Inhost API Response |".$number.' - '.$resultInhost."\r\n",3,"/var/www/html/logs/striker_leads_logs/request_".$date.".log");        
			}
		}

	}
} 







// contact email send.....
if(isset($_POST['sendemail']) && $_POST['sendemail'] == "sendemail") {
 $id=mysqli_real_escape_string($link, $_POST['id']);
 
 $result=mysqli_query($link,"select * from contact_form where contact_id=$id");
  if(mysqli_num_rows($result)>0)
  {
  
      //$sql="update contact_form set status=0 where contact_id=$id";
	 // mysqli_query($link,$sql);
		 
	  $sql="select * from contact_form where contact_id=$id and status=0";
	  $result=mysqli_query($link,$sql);
	  if(mysqli_num_rows($result)>0)
	  {
		 $row=mysqli_fetch_assoc($result);
		 $name=ucfirst($row['name']);
		 $email=$row['email'];
		 $mobile=$row['mobile'];
		 $message=$row['message'];
		 $sql="update contact_form set status=1 where contact_id=$id";
		mysqli_query($link,$sql);
		 send_email($name,$email,$mobile,$message);
		 echo json_encode(array("message"=>"your request has been sent","color"=>"green","status"=>200));
	  }
	  else
	  {
	  echo json_encode(array("message"=>"Alredy your request sent","color"=>"red","status"=>200));
	  }
  
  }
  else
  {
  echo json_encode(array("message"=>"Alredy your request sent","color"=>"red","status"=>200));
  }
  
  
 
 mysqli_close($link); 
}




function  send_email($name,$email,$mobile,$message){
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
$mail->SetFrom($email, $name);
$mail->AddReplyTo($email, $name); // indicates ReplyTo headers
$mail->AddAddress('support@smsstriker.com', 'Contact Form'); 
  
$mail->AddAddress('sales@smsstriker.com', 'Contact Form'); 
$mail->AddBCC("joshi.herald@smsstriker.in", "Contact Form");
$mail->AddBCC("naveen@smsstriker.com", "Contact Form");

$mail->WordWrap = 50; 
$mail->IsHTML(true);
$mail->Subject = "Contact Form Information"; 


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
					<p>Dear '.$name.',</p> 
					<br> 
					<p>Contact Form Information !</p> 
					<br> 
		
						<p>Username : '.$name.' </p>
						<p>Email : '.$email.' </p>
						<p>Mobile : '.$mobile.' </p>
						<p>Message : '.$message.' </p>
					
								
 

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

$redirect = "thank-you.html";
header("location:$redirect");


?>

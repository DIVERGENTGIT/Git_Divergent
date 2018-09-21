
<?php
 

include("dbconnect/config.php");  
	require('/var/www/html/strikerapp/PHPMailer-master/PHPMailerAutoload.php'); 
 

$getUserID = $mysqli->query("SELECT * FROM credits_manager WHERE email != '' AND is_notified = 0 ");
      
 
if($getUserID->num_rows > 0)
{           

	while($userIDRes = $getUserID->fetch_array(MYSQLI_ASSOC)) {
 		$emailID = '';
 		
		   $emailID = $userIDRes['email'];   
		$id = $userIDRes['id'];  
		$previous_credits = $userIDRes['previous_credits'];
		$prevoiusprice = $userIDRes['previous_price'];
		$newPrice = $userIDRes['new_price'];
		$newCredits = $userIDRes['new_credits'];
 
  		if($previous_credits > $newCredits ) {
  		  	 
  		  	// echo "update credits_manager SET is_notified = 1 WHERE id = '".$id."' "; echo "</bR>";
  		  	 $mysqli->query("update credits_manager SET is_notified = 1 WHERE id = '".$id."' ");
  			sendMail($emailID,$previous_credits,$prevoiusprice,$newPrice,$newCredits);

		}
		
	 $emailID = '';
 
  }
 
  
}



function sendMail($emailID,$previous_credits,$prevoiusprice,$newPrice,$newCredits) {

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
	$mail->SetFrom('support@smsstriker.com', 'Credits Report');  
	// $mail->AddAddress('sandeepthicse@gmail.com', 'SMSSTRIKER');
	
	
	$mail->AddAddress($emailID, 'SMSSTRIKER');
	$mail->AddCC('krishna@smsstriker.net', 'Credits Report');	
	//$mail->AddCC('prasad.k@smsstriker.in', 'Credits Report');
	//$mail->AddCC('naveen@strikersoft.in', 'Credits Report');
	
	
	$mail->WordWrap = 50;      
	$mail->IsHTML(true);    
	$mail->Subject = "SMS Credits Report"; 
 
	$mailContent = "<p>Dear Customer,</p></br>";
	$mailContent .=	"<p>Thank you for being with us. As communicated in the earlier mail regarding the increase of SMS price , please be informed of the details of your account and SMS balance credits as given below.</p></br>";
	$mailContent .=	"<p>Your current SMS credits are ".$previous_credits." at the cost of INR ".$prevoiusprice." paise. </p></br>";
	
	$mailContent .=	"<p>New implacable price is INR ".$newPrice." paise</p></br>";
	
	$mailContent .=	"<p>Left over credits are ".$newCredits.". (With the implication of new price) </p></br>";
	$mailContent .=	"<p>New prices implication will be effective from 14 th May, 2018 midnight that is 15 th May, 2018 early morning. </p></br>";
	$mailContent .="<p>The new tariff are as follows for new purchase.</p></br>";
	
	$mailContent .="<p><table style='width:100%'>
	 			<table>
	  <tr>  
	    <th>S NO </th>
	    <th>Sms Quantity</th> 
	    <th>Prices</th>
	  </tr>
	  <tr>
	    <td>1</td>
	    <td>0-99999 Thousands</td>
	    <td>12.5Paise</td>
	  </tr>
	  <tr>
	    <td>2</td>
	    <td>100000 Lakh - 999999 Lakh</td>
	    <td>12Paise</td>
	  </tr>
	  <tr>
	    <td>3</td>
	    <td>1000000 Lakh - 1999999 Lakh</td>
	    <td>11.5Paise</td>
	  </tr>
	  <tr>
	    <td>4</td>
	    <td>2000000 Lakh - 50Lakh</td>
	    <td>11Paise</td>
	  </tr>
	</table></p>";
	 
	$mailContent .="<p>Note: Service Tax of 18% is applicable on all your Packages.</p></br>";
	$mailContent .="<p>Kindly treat this email as written notice of price change.</p></br>";
	$mailContent .="<p>We assure you that we shall continue to provide great and quality services at our best possible way.</p></br>";
	  $mailContent .="<p>In case of any query reach us at 8886638814 or support@smsstriker.com</p>";
	 
	 
	$mail->Body    = $mailContent;  
	$mail->AltBody = $mailContent; 

	if(!$mail->Send())
	{
		 echo "Message could not be sent. <p>";
		// echo "Mailer Error: " . $mail->ErrorInfo;

	}else{   

		echo "Message has been sent";
	}  
}


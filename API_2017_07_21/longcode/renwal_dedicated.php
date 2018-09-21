<?php 



//http://localhost/smsstriker/API/longcode/invoice_dedicated.php?payment=payment&trn_id=201703020866819&servicetax=&tax=15&smsprice=

include('../../config/config.php');

require($Email_lib);
if(isset($_GET['payment'])) {
	$trn_id=$_REQUEST['trn_id'];
	$servicetax=$_REQUEST['servicetax'];
	$noofsms="";
	$smsprice="";  
	// service tax 
	$query2 = "SELECT * FROM global_settings where	setting_name='Service Tax'";
	$result2 = mysqli_query($link,$query2) or die('Error query:  '.$query2);
	$rec2=mysqli_fetch_assoc($result2);
	$ServiceTax=$rec2['value'];
	
	$query="SELECT pe.registeruser_id,pe.servicetype,pe.name,pe.mobile,pe.email,pe.epg_txnID,pe.created_on,pe.smstype,th.payment_id,th.noofsms,th.sms_price as smsprice,th.amount,th.tax_amount,pe.longcode_numbers,th.total_amount,pe.pgresponse,th.epg_txnID FROM transaction_history th INNER JOIN price_enquery pe on pe.epg_txnID=th.epg_txnID
	WHERE th.epg_txnID = $trn_id group by th.payment_id order by th.payment_id desc limit 1 "; 
	$result = mysqli_query($link,$query) or die('Error query:  '.$query);

	$count=1;
	
	//echo mysqli_num_rows($result);
	
	// check  price table transaction ID
	if(mysqli_num_rows($result)>0)
	{
			while($value=mysqli_fetch_assoc($result))
			{
                  // print_r($value);exit;
			extract($value);
			// check number available
			$checknumstatussql = "SELECT sum(no_of_keywords)  as no_of_keywords ,sum(no_of_sms)  as no_of_sms FROM longcode_tmp
			WHERE user_id IN($registeruser_id) and  longcode_number IN ($longcode_numbers) 
			and status = 2 and service_type='dedicated'
			group by longcode_number limit 3";
			$checknumstatusresult = mysqli_query($link,$checknumstatussql) or die('Error query:  '.$checknumstatussql);
		
			if(mysqli_num_rows($checknumstatusresult)>0)
			{
			
			//$sql1="update price_enquery set is_created=0 where epg_txnID=$trn_id";
			//$result = mysqli_query($link,$sql1) or die('Error query:  '.$sql1);
			
			   $sql="select * from price_enquery where epg_txnID=$trn_id and is_created=0"; 
			   $result = mysqli_query($link,$sql) or die('Error query:  '.$sql);
				if(mysqli_num_rows($result)>0)
				{
				  if($pgresponse=='Transaction Successful')
					//if($pgresponse=='Transaction Cancelled')
					 { 
					  
	// after invoice create update number status start
	$updateServiceDetails = "update  longcode_tmp set status = 3 
	WHERE  user_id IN($registeruser_id) and longcode_number IN ($longcode_numbers) and status = 2 and service_type='dedicated'"; 
	mysqli_query($link,$updateServiceDetails);
	// after invoice create update number status start



	$on_date=date("Y-m-d H:i:s");
	/*
	$query1="INSERT INTO `user_payments` ( `user_id`, `amount`,`price`, `service_tax`, `service_tax_percent`, `total_amount`, `on_date`, `payment_type`, `transaction_id`) VALUES ('$registeruser_id', '$amount',$smsprice, '$tax_amount', '$ServiceTax', '$total_amount','$on_date',1,$trn_id)";*/
	
	$query1="INSERT INTO `user_payments` ( `user_id`, `amount`, `service_tax`, `service_tax_percent`, `total_amount`, `on_date`, `payment_type`, `transaction_id`) VALUES ('$registeruser_id', '$amount', '$tax_amount', '$ServiceTax', '$total_amount','$on_date',1,$trn_id)";
	
	mysqli_query($link,$query1) or die('Error query:  '.$query1);
	$payment_id=mysqli_insert_id($link); 

	$sql1="update price_enquery set is_created=1 where epg_txnID=$trn_id";
	$result = mysqli_query($link,$sql1) or die('Error query:  '.$sql1);
						  

	$query1 = "SELECT no_ndnc,dnd_check,organization,username,first_name,last_name FROM users where user_id=".$registeruser_id;  
	$result1 = mysqli_query($link,$query1) or die('Error query:  '.$query1);
	$rec1=mysqli_fetch_assoc($result1);
	$organization=$rec1['organization'];
	$username=$rec1['username'];
	$name=$rec1['first_name'].' '.$rec1['last_name'];
	
	$smstype = $servicetype;
	if($name=='')
	{
	$sql1="update price_enquery set name='$name' where registeruser_id=$registeruser_id";
	$result = mysqli_query($link,$sql1) or die('Error query:  '.$sql1);
	}
	//generate invoice insert start
	$query2="INSERT INTO `generate_invoice` (`user_id`, `transaction_id`, `sms_type`, `amount`, `create_on`)
	VALUES ('$registeruser_id', '$trn_id', '$smstype', '$total_amount', '$on_date');";
	mysqli_query($link,$query2) or die('Error query:  '.$query2);
	$inv_id=mysqli_insert_id($link);
	$invoice_id="MID/SM/".$inv_id;
	
	$getServiceDetails = "SELECT * FROM longcode_tmp WHERE  user_id IN($registeruser_id) and longcode_number IN ($longcode_numbers) and status = 3 and service_type='dedicated' group by longcode_number limit 3"; 
	$getServiceDetails_res = mysqli_query($link,$getServiceDetails); 
	$data_array = array();
	$noofsms=0;
	while($data = mysqli_fetch_array($getServiceDetails_res)) {
	$data_array[] = $data;	  
	$noofsms=$noofsms+$data['no_of_sms'];
	}
	//$email="gotte.naresh@gmail.com";
	//$email="naresh.gotte@smsstriker.in";
	$no_of_keywords=0;
	send_invoice_generator($invoice_id,$epg_txnID,$created_on,$registeruser_id,$smstype,$payment_id,$organization,$name,
	$username,$on_date,$noofsms,$smsprice,$amount,$ServiceTax,$service_tax,$total_amount,$longcode_numbers,$data_array,
	$no_of_keywords,$noofsms); 

	send_email_invoice($epg_txnID,$created_on,$registeruser_id,$smstype,$payment_id,$organization,$name,$username,$on_date,
	$noofsms,$smsprice,$amount,$ServiceTax,$service_tax,$total_amount,$pgresponse,$mobile,$email,$no_of_keywords);

				          print_r(json_encode(array('status'=>"success","Transaction Successful")));	
				          
				          break;
					}
					else
					{
					
				$sql1="update price_enquery set  is_created=0 where epg_txnID=$trn_id";
				$result = mysqli_query($link,$sql1) or die('Error query:  '.$sql1);
				
				print_r(json_encode(array('status'=>"failed","message"=>"Transaction Cancelled")));
					}
			

				}
				else
				{
				
				print_r(json_encode(array('status'=>"failed","message"=>"is_created 1")));
								
				}
			
			}
			else
			{
			 print_r(json_encode(array('status'=>"failed","code"=>"2")));
			}
			break;
		}
		
	
	}
	else
	{
	print_r(json_encode(array('status'=>"failed","message"=>"Invalid Transaction Id")));
	}
}



function send_invoice_generator($invoice_id,$epg_txnID,$created_on,$registeruser_id,$smstype,$payment_id,$organization,$name,$username,$on_date,$no_of_sms,$price_per_sms,$amount,$ServiceTax,$service_tax,$total_amount,$longcode_numbers,$serviceData,$no_of_keywords,$noofsms)
{	
    
 //echo $invoice_id;exit;
 
 	$array = array();
 	
  	for($i=0;$i<count($serviceData);$i++){
		$array[$i]['longcode_number'] = $serviceData[$i]['longcode_number'];
		$array[$i]['longcode_type'] = $serviceData[$i]['longcode_type'];
		$array[$i]['no_of_sms'] = $serviceData[$i]['no_of_sms'];
		$array[$i]['subscription_duration'] = $serviceData[$i]['subscription_duration'];
		
		//$array[$i]['no_of_keywords'] = $serviceData[$i]['no_of_keywords'];
		
		$array[$i]['no_of_keywords'] = $serviceData[$i]['no_of_keywords'];
		
		$array[$i]['keywords_cost'] = $serviceData[$i]['keywords_cost'];
		$array[$i]['number_cost'] = $serviceData[$i]['number_cost'];
		$array[$i]['package_cost'] = $serviceData[$i]['package_cost'];
		$array[$i]['amount'] = $serviceData[$i]['amount'];
		$array[$i]['total_tax'] = $serviceData[$i]['total_tax'];
		//$array[$i]['total_amount'] = $serviceData[$i]['total_amount'];
		$array[$i]['price_per_long_code'] = $serviceData[$i]['price_per_long_code']; 
		$array[$i]['tn'] = $epg_txnID;
		$array[$i]['invoice_id'] = $invoice_id;
		$array[$i]['cd'] = $created_on;
		$array[$i]['rid'] = $registeruser_id;
		$array[$i]['smstype'] = $smstype;
		$array[$i]['payment_id'] = $payment_id;
		$array[$i]['od'] = $on_date; 
		$array[$i]['org'] = $organization;
		$array[$i]['name'] = $name;
		$array[$i]['st'] = $ServiceTax; 
		$array[$i]['amt'] = $amount;
		$array[$i]['noofsms'] = $no_of_sms;
		$array[$i]['total_amount'] = $total_amount; 
		$array[$i]['prices'] = $price_per_sms;  
		$array[$i]['username'] = $username;
		$array[$i]['tax_amt'] = $service_tax; 
		$array[$i]['longcode'] = $longcode_numbers;
	}
 
       global $invoice_url;
  //$url = "http://www.smsstriker.com/invoice_code/index.php";
       $url = $invoice_url."invoice_code/index_dedicated.php"; 
	$ch = curl_init();  
	curl_setopt($ch, CURLOPT_URL, $url);     
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);    
	curl_setopt($ch, CURLOPT_POST,count($arary));
	curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($array));    
	$response = curl_exec($ch);   
	echo $response;  
	curl_close($ch);  
}  



// send invoice email


function send_email_invoice($epg_txnID,$created_on,$registeruser_id,$smstype,$payment_id,$organization,$name,$username,$on_date,$no_of_sms,$price_per_sms,$amount,$ServiceTax,$service_tax,$total_amount,$pgresponse,$mobile,$email,$no_of_keywords)
{


$username=ucfirst($name);
 
$sms_text = "Your payment ".$pgresponse."!..";
$sms_text .= " No of SMS ".$noofsms;
$sms_text .= " Amount ".$total_amount;
$sms_text .= " Transaction ID ".$epg_txnID;

$sms_url = "http://www.smsstriker.com/API/sms.php?username=support&password=Str!k3r2020&from=STRIKR&to=$mobile&msg=".urlencode($sms_text)."&type=1";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $sms_url);
curl_setopt($ch, CURLOPT_header_new, 0);
//curl_exec($ch);
curl_close($ch);


$mail = new PHPMailer();

// set mailer to use SMTP
$mail->IsSMTP();

$mail -> SMTPDebug = 2;
$mail->Host = 'smtp.sendgrid.net';
$mail->SMTPAuth = true;     // turn on SMTP authentication
$mail->Port = 587;
$mail->Username = "smsstriker";  // SMTP username
$mail->Password = "striker@123"; // SMTP password
$mail->FromName = "smsstriker";
$mail->SetFrom("support@smsstriker.com", 'SMSSTRIKER');
//$mail->AddReplyTo($email, $name); // indicates ReplyTo headers
$mail->AddAddress($email, $name);
//$mail->AddBCC("supraja.thanga@smsstriker.in", "SMSSTRIKER");
//$mail->AddBCC("accounts@smsstriker.com", "SMSSTRIKER");
//$mail->AddBCC("naveen@smsstriker.com", "SMSSTRIKER");
$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = "INVOICE";

  $message = '<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
<style>
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;}
body{padding:0px;margin:0px;font-family: Lato,sans-serif;}
.mrgleft{margin-left:-25px;}
.main-newsletter{width:100%;max-width:600px;    float: left;}
.fullwidth{width:100%;float:left; }
.header-newsletr{background:url(http://smsstriker.com/images/about-page-bg.png) no-repeat;background-size: 100% 100%;
padding: 15px 25px;}
.padding25{padding-left:25px;padding-right:25px;}
.bold-name{color:#00B8B5;}
.halfwidth{width:100%;max-width: 275px;float:left;}
.halfwidth02{width:100%;max-width: 300px;float:left;}
.halfwidth03{width:100%;max-width: 200px;float:left;}

	
	.newsletter-table td{text-align:center;}
	.paddinglt25{padding-right:25px;}
	.footer-top-list{float:right;}
	.footer-top-list li:first-child{margin-bottom:16px;font-size:15px;}
	.footer-top-list li{text-align:right;list-style-type:none;margin-bottom: 6px;    font-size: 12px;
    font-weight: bold;}
	.footer-top-list span{margin-left:5px;}
	.footer-top-list b{color:#00B8B5;}
	.footerbtm{background:#58595B;padding-bottom: 7px;padding-top: 7px;}
	.footer-social-list{float:right;margin: 0px;}
	.footer-social-list li{list-style-type:none;float:left;margin-right:15px;}
	.footerlast{background:#BBBDBF;padding-top: 10px;padding-bottom: 10px;}
	.footerlast a, .footerlast p{font-size:9px;color:#fff;text-decoration:none;}
	.footerlast p{margin:0px;text-align:right;}
	.footer-social-list li:last-child{margin:0px;}
	.table-btmcont b{color:#00B8B5;}
	.text-right{text-align:right;}
	.table-btmcont p{font-size:11px;font-weight: bold;}
	.democlass a{background:#00b8b6;color:#fff;    color: #fff;
    padding: 3px 6px;
    margin-left: 4px;text-decoration:none;
    border-radius: 5px;}
	.mrgtbbotom{margin-top:10px;margin-bottom:10px;}

	.contactbtm02{position:relative;margin-top: 20px;    padding-top: 15px;
    padding-bottom: 15px;}

	.firstcontent p{font-size: 12px;
    font-weight: bold;}
	.play-btn a{text-decoration:none;color:#00B8B5;border:1px solid #00B8B5;    padding: 3px 5px;}
	.indian-rupee img{    width: 9px;
    margin-left: 2px;}
	.fltright{float:right !important;}
	.oneotp-content b{color: #00B8B5;}
	
	.btmotpcontent p{    background: #cdf1f1;
    padding: 15px;
    border-radius: 10px;}
	.oneotp-content p.otpnumber{font-weight:bold;    font-size: 16px;}
	.oneotp-content p{font-size: 14px;}
	.otp-padding{width:100%;max-width:470px;margin: auto;}
</style>

</head>
<body>
<div class="main-newsletter">
<div class="fullwidth header-newsletr">
<a href="index.html"><img src="http://smsstriker.com/images/sms-striker-logo.png" width="100px" alt="sms striker"></a>
</div>
<div class="fullwidth padding25 firstcontent">
<p>Hi</p>
<b class="bold-name">Mr/Mrs. '.$username.',</b>
<p>Thank you for showing interest in our services</p>
</div>
<div class="fullwidth padding25 oneotp-content">
<div class="otp-padding">
					<br> 
						<p>Long Code Hits     : '.$no_of_sms.' </p>
						<p>Amount             : '.$total_amount.' </p>
						<p>Transaction ID     : '.$epg_txnID.' </p>
						<p>Transaction status : '.$pgresponse.' </p>
					<br> 

</div>
</div>



<div class="fullwidth padding25 contactbtm02">

<div class="halfwidth fltright">
<ul class="footer-top-list">
<li><b>Need help?</b></li>
<li>+91  7097 19 19 19 <span><img src="http://strikersoftsolutions.com/images/newslet-phone.png" alt=""></span></li>
<li>support@smsstriker.com <span><img src="http://strikersoftsolutions.com/images/newsltr-mail.png" alt=""></span></li>
<li>www.smsstriker.com <span><img src="http://strikersoftsolutions.com/images/newsltr-web.png" alt=""></span></li>
</ul>
</div>
</div>
<div class="fullwidth footerbtm padding25">
<div class="halfwidth">
<img src="http://strikersoftsolutions.com/images/newsletter-footer-logo.png" alt="">
</div>
<div class="halfwidth">
<ul class="footer-social-list">
<li><a href="https://www.facebook.com/strikersoftsolutions/" target="_blank"><img src="http://strikersoftsolutions.com/images/fb.png" alt=""></a></li>
<li><a href="https://twitter.com/strikersofthyd" target="_blank"><img src="http://strikersoftsolutions.com/images/twiter.png" alt=""></a></li>
<li><a href="https://plus.google.com/110633432043392276134/about?gmbpt=true&hl=en" target="_blank"><img src="http://strikersoftsolutions.com/images/gpluse.png" alt=""></a></li>
</ul>
</div>
</div>
<div class="fullwidth footerlast padding25">
<div class="halfwidth">
<a href="http://www.smsstriker.com/privacy-policy.html">Disclaimers & Privacy Policy</a>
</div>
<div class="halfwidth">
<p>&copy; 2017 Striker Soft Solutions Pvt. Ltd. All Rights Reserved</p>
</div>
</div>
</div>
<div>

</div>
</body>
</html>';


 
 


$mail->Body    = $message;
$mail->AltBody = $message;

//$mail->AddAttachment($file);
global $invoicepath;
  
$pdffilename = "SMSStriker_invoice_".$epg_txnID;
$filepath=$invoicepath.$pdffilename.'.pdf';
$mail->AddAttachment($filepath);

if(!$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;

}else{

echo "Message has been sent";
}

}

?>

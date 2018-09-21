
<?php

include('/var/www/html/smsstriker/config/config.php');

require($Email_lib);


if(isset($_GET['tn'])) {
$epg_txnID = mysqli_real_escape_string($link,$_GET['tn']);
 $query = "SELECT * FROM price_enquery pe INNER JOIN  user_payments up on pe.epg_txnID=up.transaction_id where pe.epg_txnID=".$epg_txnID;
$result = mysqli_query($link,$query) or die('Error query:  '.$query);
$rec=mysqli_fetch_assoc($result);

extract($rec);

$query1 = "SELECT organization,username FROM users where user_id=".$registeruser_id;
$result1 = mysqli_query($link,$query1) or die('Error query:  '.$query1);
$rec1=mysqli_fetch_assoc($result1);
 $organization=$rec1['organization'];
 $username=$rec1['username'];

// service tax 
$query2 = "SELECT * FROM global_settings where 	setting_name='Service Tax'";
$result2 = mysqli_query($link,$query2) or die('Error query:  '.$query2);
$rec2=mysqli_fetch_assoc($result2);
 $ServiceTax=$rec2['value'];


send_invoice_generator($epg_txnID,$created_on,$registeruser_id,$smstype,$payment_id,$organization,$name,$username,$on_date,$no_of_sms,$price_per_sms,$amount,$ServiceTax,$service_tax,$total_amount);

send_email_invoice($epg_txnID,$created_on,$registeruser_id,$smstype,$payment_id,$organization,$name,$username,$on_date,$no_of_sms,$price_per_sms,$amount,$ServiceTax,$service_tax,$total_amount);
}





function send_email_invoice($epg_txnID,$created_on,$registeruser_id,$smstype,$payment_id,$organization,$name,$username,$on_date,$no_of_sms,$price_per_sms,$amount,$ServiceTax,$service_tax,$total_amount)
{


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
$mail->SetFrom("support@smsstriker.com", 'INVOICE');
//$mail->AddReplyTo($email, $name); // indicates ReplyTo headers
$mail->AddAddress($email, $name);
$mail->AddBCC("krishna@smsstriker.net", "INVOICE");
$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = "INVOICE";

 $message = '<html>
<head>
<title>SMS Striker</title>
<style>
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
@font-face {
    font-family: "My Custom Font";
    src: url(http://strikersoftsolutions.com/fonts2/HelveticaNeueLTCom-Cn_0.ttf) format("truetype");
}
@font-face {
    font-family: "My Custom Font2";
    src: url(http://strikersoftsolutions.com/fonts2/HelveticaNeueLTCom-LtCn_0.ttf) format("truetype");
}
body{ font-family: "My Custom Font";letter-spacing: 0.5px;font-size:10px;line-height: 14px;color:#58595B;}
.font12{font-size:12px;}
.font10{font-size:10px;}
.font8{font-size:8px;color:#000;text-align: center;}
.tb02font9{font-size:9px;text-align: right;font-weight: bold;}
.tb02font13{font-size:10px;color:#000;text-align: right;font-weight: bold;}
.main-body{width:595px;border:1px solid;float: left;position:relative;}
.pos-absolute{margin-bottom: 10px;}
.fullwidth{width:100%;float:left;position:relative;}
.table01{border:1px solid;border-collapse: collapse;width:100%;}
.table01 td{border:1px solid #58595b;padding: 10px;}
.table03{border:1px solid #58595b;border-collapse: collapse;width:100%;}
.table03 td{border:1px solid #58595b;padding: 2px 10px 10px;vertical-align:top;}
.table02{border:1px solid #58595b;border-collapse: collapse;width:100%;}
.table02 thead td{border:1px solid #58595b;padding: 8px 5px;text-align: center;color: #58595B;}
.table02 tfoot tr:last-child{border:1px solid #58595b;padding: 10px;}
.table02 tfoot tr:nth-child(1) td{padding-top: 15px;}
.table02 tfoot tr:nth-child(3) td{padding-bottom: 35px;}
.table02 tbody td{border-right:1px solid #58595b;padding: 10px 8px;vertical-align: top;}
.table02 tfoot td{border-right:1px solid #58595b;    padding-left: 10px;
    padding-right: 10px;}
.half-width{width:50%;float:left;}
.temptitle{font-size:45px;margin: 0px;float:right;color:#929497;font-family: "My Custom Font2";    letter-spacing: 13px;line-height: 40px;}
.padding25{padding: 0px 25px 10px;}
.top01{margin-bottom:2px;}
.mrg2px{margin-bottom:5px;}
.halfwidth01{width:50%;float:left;}
.halfwidth02{width:50%;float:left;}
.companyvat{background:#F1F1F2;padding: 10px 10px 10px 10px;}
.blackbg{background:#58595B;padding:5px 25px 5px 25px;}
.footer-bt{text-align:center;font-size:9px;margin:4px 0px;}
.footerlt, .footerrt{margin:0px;color:#fff;}
.footerrt a{margin:0px;color:#fff;text-decoration:none;float:right;}
.remarklist{padding-left: 11px;margin-top:0px;}
.remarklist li{color:#000;}
.companyvat ul{padding:0px;width:100%;float:left;margin:0px;}
.companyvat ul li{list-style-type:none;font-size:9px;color:#231F20;}
.companyvat ul.compnylist02{border-left: 2px solid #fff;
    padding-left: 15px;}
.companyvat ul li .comp-ltspn, .companyvat ul li .comp-ltspn02{color:#58595B;}
.companyvat ul li .comp-rtspn, .companyvat ul li .comp-rtspn02{color:#231F20;}
.tb01bold{font-size:11px;margin-top:3px;color:#231F20;}
.comp-rtspn02, .comp-rtspn{width:55%;float:left;}
.comp-ltspn02, .comp-ltspn{width:45%;float:left;}
</style>
</head>

<body>
<div class="main-body">
<div class="fullwidth pos-absolute">
<img src="http://strikersoftsolutions.com/images/top-border.png" width="100%;">
</div>
<div class="fullwidth padding25">
<div class="fullwidth top01">
<div class="half-width">
<img src="http://strikersoftsolutions.com/images/invoice-logo.png" width="100px;">
</div>
<div class="half-width">
<h4 class="temptitle">INVOICE</h4>
</div>
</div>
<div class="fullwidth mrg2px">
<table class="table01">
<tr>
<td rowspan="3">
<div style="margin-bottom:30px">
Striker Soft Solutions Private Limited<br>
Plot no : 164/3, 4th Floor,<br>
Sinman Dwarka Building,<br>
Patrika Nagar, Madhapur,<br>
Hyderabad. 040-64547711<br>
</div>
<b style="color: #231F20;">CIN:</b> <br>U72300AP2012PTC081552<br>
</td>
<td>Invoice No.<br>
<div class="tb01bold"><b>'.$epg_txnID.'</b></div>
</td>
<td>Dated<br>
<div class="tb01bold"><b>'.$created_on.'</b></div>
</td>
</tr>
<tr>
<td>Supplier’s Ref.<br>
<div class="tb01bold"><b>'.$registeruser_id.'</b></div>
</td>
<td>Other Reference(s)<br>
<div class="tb01bold"><b>'.$smstype.'</b></div>
</td>
</tr>
<tr>
<td>Buyers Order No.<br>
<div class="tb01bold"><b>'.$payment_id.'</b></div>
</td>
<td>Dated<br>
<div class="tb01bold"><b>'.$on_date.'</b></div>
</td>
</tr>
<tr>
<td>Consignee<br>
<div class="tb01bold"><b>'.$organization.'</b></div>
</td>
<td colspan="2">Buyer (If other than consignee)<br>
<div class="tb01bold"><b>Mr.'.$name.'</b></div>
</td>
</tr>
</table>
</div>
<div class="fullwidth">
<table class="table02">
<thead>
<tr><td>SL No.</td><td>Description of Goods</td><td>Quantity</td><td>Rate</td><td>Amount</td></tr>
</thead>
<tbody>
<tr><td>1.</td><td>
<span style="font-size:13px;color:#231F20;line-height: 24px;">SMS login</span><br>
SMS Login username: '.$username.'<br>
sms Added on : '.$on_date.'<br>
Price Per Sms @ '.$price_per_sms.'
</td>
<td><div class="font8">'.$no_of_sms.' Imp</div></td>
<td><div class="font8">'.$price_per_sms.'  &#37;</div></td>

<td><div class="tb02font13">'.$amount.'.00</div>
</td></tr>
</tbody>
<tfoot>
<tr><td>&nbsp;</td><td>
<div class="tb02font9">Service Tax @ '.$ServiceTax.'% (On assessable value '.$amount.'.00)</div>
</td>
<td>&nbsp;</td>
<td><div class="font8">'.$ServiceTax.' &#37;</div></td>


<td><div class="tb02font13">'.$service_tax.'.00</div>
</td></tr>
<tr>
<td colspan="2">
<div class="font8" style="float:right;">Total</div>
</td>
<td><div class="font8">'.$no_of_sms.' Imp</div></td>
<td>&nbsp;</td>
<td><div class="tb02font13">'.$total_amount.'.00</div>
</td></tr>
</tfoot>
</table>
</div>
<div class="fullwidth">
<div class="fullwidth" style="margin-left:55px;">
<p style="font-size:8px;margin-bottom: 0px;">Amount Chargeable (in words)</p>
<p style="font-size:11px;font-weight:bold;margin-top: 0px;">INR Thirteen Thousand Eight Hundred Only</p>
</div>
</div>
<div class="fullwidth">
<p style="margin-bottom:2px;">Remarks:</p>
<ol class="remarklist">
<li>Payment should be done within 15days from the date of Invoice</li>
<li>Paymetns to be made by a/c payee cheque favouring Striker soft solution Private limited.</li>
<li>In the event that Client fails to pay the amount within 15 days, client shall become liable 
    to pay 1% interest per month and 12% interest per annum.</li>
</ol>
</div>
<div class="fullwidth companyvat">
<div class="halfwidth01">
<ul class="compnylist01">
<li><div class="comp-ltspn">Company’s VAT TIN</div><div class="comp-rtspn">: IEC Code: 0916901726</div></li>
<li><div class="comp-ltspn">Company’s CST No</div><div class="comp-rtspn">: SWIFT CODE: ICICINBBCTS</div></li>
<li><div class="comp-ltspn">Company’s Service Tax No</div><div class="comp-rtspn">: AARCS6831KSD001</div></li>
<li><div class="comp-ltspn">Company’s PAN No</div><div class="comp-rtspn">: AARCS6831K </div></li>
</ul>
</div>
<div class="halfwidth02">
<ul class="compnylist02">
<li><div>Company’s Bank Details:</div></li>
<li><div class="comp-ltspn02">Bank Name</div><div class="comp-rtspn02">:  ICICI Bank</div></li>
<li><div class="comp-ltspn02">A/C No</div><div class="comp-rtspn02">: 630505500105</div></li>
<li><div class="comp-ltspn02">Branch &IFC Code</div><div class="comp-rtspn02">: Himayathnagar & ICIC006305</div></li>
</ul>
</div>
</div>
<div class="fullwidth">
<p style="color:#000;font-size:9px;">Declaration: We declare that his invoice shows the actual price of the goods described and that all particulars are true and correct.</p>
</div>
<div class="fullwidth">
<table class="table03">
<tr>
<td>Customer’s Seal and Signature

</td>
<td><div style="width:100%;margin-bottom:20px;"><span style="float:right;">For Striker Soft Solutions Private Limited</span></div><br>
<div style="float:right;">Authorised Signatory</div>
</td>
</tr>
</table>
</div>
</div>
<div class="fullwidth blackbg">
<div class="half-width">
<p class="footerlt">Striker Soft Solutions Pvt. Ltd.</p>
</div>
<div class="half-width">
<p class="footerrt"><a href="http://smsstriker.com/">www.smsstriker.com</a></p>
</div>
</div>
<div class="fullwidth">
<p class="footer-bt">This is a Computer Generated Invoice</p>
</div>
<div class="fullwidth">
<img src="http://strikersoftsolutions.com/images/top-border.png" width="100%;">
</div>
</div>
</body>

</html>';

 
 


$mail->Body    = $message;
$mail->AltBody = $message;

//$mail->AddAttachment($file);

$pdffilename = "invoice_".$epg_txnID;
$filepath='/var/www/html/smsstriker/invoice_code/reports/'.$pdffilename.'.pdf';
$mail->AddAttachment($filepath);

if(!$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;

}else{

echo "Message has been sent";
}

}

function send_invoice_generator($epg_txnID,$created_on,$registeruser_id,$smstype,$payment_id,$organization,$name,$username,$on_date,$no_of_sms,$price_per_sms,$amount,$ServiceTax,$service_tax,$total_amount)
{
  	
  $url = 'http://10.10.10.199/smsstriker/invoice_code/index.php';
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,"tn=$epg_txnID&cd=$created_on&rid=$registeruser_id&smstype=$smstype&payment_id=$payment_id&od=$on_date&org=$organization&name=$name&st=$ServiceTax&amt=$amount&noofsms=$no_of_sms&total_amount=$total_amount&prices=$price_per_sms&username=$username&tax_amt=$service_tax");    
	$response = curl_exec($ch);   
	echo $response;
	curl_close($ch);
}
?>




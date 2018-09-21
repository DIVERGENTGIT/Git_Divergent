<?php
//http://10.10.10.199/smsstriker/invoice_email.php?tn=201701038785471
//http://10.10.10.199/smsstriker/sendemail.php?name=naresh&email=gotte.naresh@gmail.com&mobile=8688388672&otp=1061&userid=37
include('/var/www/html/smsstriker/config/config.php');
require($Email_lib);
require('/var/www/html/smsstriker/pdfcrowd-php-master/pdfcrowd.php');

if(isset($_GET['tn'])) {
$epg_txnID = mysqli_real_escape_string($link,$_GET['tn']);
send_email_invoice($epg_txnID,$base_url,$link);
}

function send_email_invoice($epg_txnID,$base_url,$link){

echo $query = "SELECT * FROM price_enquery pe INNER JOIN  user_payments up on pe.epg_txnID=up.transaction_id where pe.epg_txnID=".$epg_txnID;
$result = mysqli_query($link,$query) or die('Error query:  '.$query);
$rec=mysqli_fetch_assoc($result);
print_r($rec);
extract($rec);

$query1 = "SELECT organization,username FROM users where user_id=".$registeruser_id;
$result1 = mysqli_query($link,$query1) or die('Error query:  '.$query1);
$rec1=mysqli_fetch_assoc($result1);
echo $organization=$rec1['organization'];
echo $username=$rec1['username'];

// service tax 
$query2 = "SELECT * FROM global_settings where 	setting_name='Service Tax'";
$result2 = mysqli_query($link,$query2) or die('Error query:  '.$query2);
$rec2=mysqli_fetch_assoc($result2);
echo $ServiceTax=$rec2['value'];

//exit;

	
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
$mail->SetFrom("support@smsstriker.com", 'INVOICE');
//$mail->AddReplyTo($email, $name); // indicates ReplyTo headers
//$mail->AddAddress($email, $name);
$mail->AddAddress("swaroopk2015@gmail.com", $name);
//$mail->AddBCC("krishnabati@gmail.com", "INVOICE");
$mail->WordWrap = 50;
$mail->IsHTML(true);
$mail->Subject = "INVOICE";
 $message = '<!DOCTYPE html>
<html>
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
.table03{border:1px solid #58595b;border-collapse: collapse;width:100%;}
.table03 td{border:1px solid #58595b;padding: 2px 10px 10px;vertical-align:top;}
.table02{border:1px solid #58595b;border-collapse: collapse;width:100%;}
.table02 thead td{border:1px solid #58595b;padding: 8px 5px;text-align: center;color: #58595B;}
.table02 tfoot tr:nth-child(3) td{padding-bottom: 35px;}
.table02 tbody td{border-right:1px solid #58595b;padding: 10px 8px;vertical-align: top;}
.table02 tfoot td{border-right:1px solid #58595b;    padding-left: 10px;
    padding-right: 10px;}
.half-width{width:50%;float:left;}
.temptitle{font-size:42px;margin: 0px;float:right;color:#929497;font-family: "My Custom Font2";    letter-spacing: 3px;line-height: 40px;}
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
.remarklist li{color:#000;font-size: 10px;}
.companyvat ul{padding:0px;width:100%;float:left;margin:0px;}
.companyvat ul li{list-style-type:none;font-size:9px;color:#231F20;    width: 100%;
    float: left;margin-bottom:2px;margin-left:0px;}
.companyvat ul.compnylist02{border-left: 2px solid #fff;
    padding-left: 15px;}
.companyvat ul li .comp-ltspn, .companyvat ul li .comp-ltspn02{color:#58595B;}
.companyvat ul li .comp-rtspn, .companyvat ul li .comp-rtspn02{color:#231F20;}
.tb01bold{font-size:11px;margin-top:3px;color:#231F20;}

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
<table class="table01" style="border:1px solid;border-collapse: collapse;width:100%;">
<tr>
<td rowspan="3" style="border:1px solid #58595b;padding: 10px;">
<div style="margin-bottom:30px;color: #58595B;">
Striker Soft Solutions Private Limited<br>
Plot no : 164/3, 4th Floor,<br>
Sinman Dwarka Building,<br>
Patrika Nagar, Madhapur,<br>
Hyderabad. 040-64547711<br>
</div>
<b style="color: #231F20;">CIN:</b> <br><span style="color: #58595B;">U72300AP2012PTC081552</span><br>
</td>
<td style="border:1px solid #58595b;color: #58595B;padding: 10px;">Invoice No.<br>
<div class="tb01bold"><b>2016-17/HYD/STR/930</b></div>
</td>
<td style="border:1px solid #58595b;color: #58595B;padding: 10px;">Dated<br>
<div class="tb01bold"><b>31-Dec-2016</b></div>
</td>
</tr>
<tr>
<td style="border:1px solid #58595b;color: #58595B;padding: 10px;">Supplier&#39;s Ref.<br>
<div class="tb01bold"><b>274</b></div>
</td>
<td style="border:1px solid #58595b;color: #58595B;padding: 10px;">Other Reference(s)<br>
<div class="tb01bold"><b>Promo</b></div>
</td>
</tr>
<tr>
<td style="border:1px solid #58595b;color: #58595B;padding: 10px;">Buyers Order No.<br>
<div class="tb01bold"><b>60862</b></div>
</td>
<td style="border:1px solid #58595b;color: #58595B;padding: 10px;">Dated<br>
<div class="tb01bold"><b>31-Dec-2016</b></div>
</td>
</tr>
<tr>
<td style="border:1px solid #58595b;color: #58595B;padding: 10px;">Consignee<br>
<div class="tb01bold"><b>Gradeur Homes Pvt Ltd</b></div>
</td>
<td style="border:1px solid #58595b;color: #58595B;padding: 10px;" colspan="2">Buyer (If other than consignee)<br>
<div class="tb01bold"><b>Mr.Praveen Kunyan</b></div>
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
<span style="font-size:13px;color:#231F20;line-height: 24px;font-weight:bold;">SMS login</span><br>
Sms login username: Modibuilders<br>
sms Added on : 17.12.2016<br>
Price Per Sms @ 0.12
</td>
<td><div class="font8">1,00,000.00 Imp</div></td>
<td><div class="font8">0.12 &#37;</div></td>

<td><div class="tb02font13">12000.00</div>
</td></tr>
</tbody>
<tfoot>
<tr><td style="padding-top: 15px;">&nbsp;</td><td style="padding-top: 15px;">
<div class="tb02font9" style="font-size: 9px;text-align: right;color: #58595B;font-weight: bold;">Service Tax @ 14% (On assessable value 12000.00)</div>
</td>
<td style="padding-top: 15px;">&nbsp;</td>
<td style="padding-top: 15px;"><div class="font8">14 &#37;</div></td>


<td style="padding-top: 15px;"><div class="tb02font13">12000.00</div>
</td></tr>
<tr><td>&nbsp;</td><td>
<div class="tb02font9" style="font-size: 9px;text-align: right;color: #58595B;font-weight: bold;">SwachhBharath Cess</div>
</td>
<td>&nbsp;</td>
<td><div class="font8">14 &#37;</div></td>


<td><div class="tb02font13">12000.00</div>
</td></tr>
<tr><td>&nbsp;</td><td>
<div class="tb02font9" style="font-size: 9px;text-align: right;color: #58595B;font-weight: bold;">Krishi Kalyan Cess</div>
</td>
<td>&nbsp;</td>
<td><div class="font8">14 &#37;</div></td>

<td><div class="tb02font13">12000.00</div>
</td></tr>
<tr style="border: 1px solid #58595b;padding: 10px;">
<td colspan="2" style="border-right: 1px solid #58595b;padding-left: 10px;padding-right: 10px;">
<div class="font8" style="float:right;">Total</div>
</td>
<td style="border-right: 1px solid #58595b;padding-left: 10px;padding-right: 10px;"><div class="font8">1,00,000.00 Imp</div></td>
<td style="border-right: 1px solid #58595b;padding-left: 10px;padding-right: 10px;">&nbsp;</td>
<td style="border-right: 1px solid #58595b;padding-left: 10px;padding-right: 10px;"><div class="tb02font13">12000.00</div>
</td></tr>
</tfoot>
</table>
</div>
<div class="fullwidth">
<div class="fullwidth" style="margin-left:55px;">
<p style="font-size:8px;margin-bottom: 0px;">Amount Chargeable (in words)</p>
<p style="font-size:11px;font-weight:bold;color: #58595B;margin-top: 0px;">INR Thirteen Thousand Eight Hundred Only</p>
</div>
</div>
<div class="fullwidth">
<p style="margin-bottom:2px;">Remarks:</p>
<ol class="remarklist">
<li>Payment should be dome within15days from the date of Invoice</li>
<li>Paymetns to be made by a/c payee chequefavouring Striker soft solution Private limited.</li>
<li>In the event that Client fails to pay the amount within 15 days, client shall become liable 
    to pay 1% interest per month and 12% interest per annum.</li>
</ol>
</div>
<div class="fullwidth companyvat">
<div class="halfwidth01">
<ul class="compnylist01">
<li><div class="comp-ltspn" style="width: 45%;float: left;">Company&#39;s VAT TIN</div><div class="comp-rtspn" style="width: 55%;float: left;">: IEC Code: 0916901726</div></li>
<li><div class="comp-ltspn" style="width: 45%;float: left;">Company&#39;s CST No</div><div class="comp-rtspn" style="width: 55%;float: left;">: SWIFT CODE: ICICINBBCTS</div></li>
<li><div class="comp-ltspn" style="width: 45%;float: left;">Company&#39;s Service Tax No</div><div class="comp-rtspn" style="width: 55%;float: left;">: AARCS6831KSD001</div></li>
<li><div class="comp-ltspn" style="width: 45%;float: left;">Company&#39;s PAN No</div><div class="comp-rtspn" style="width: 55%;float: left;">: AARCS6831K </div></li>
</ul>
</div>
<div class="halfwidth02">
<ul class="compnylist02">
<li><div>Company&#39;s Bank Details:</div></li>
<li><div class="comp-ltspn02" style="width: 45%;float: left;">Bank Name</div><div class="comp-rtspn02" style="width: 55%;float: left;">:  ICICI Bank</div></li>
<li><div class="comp-ltspn02" style="width: 45%;float: left;">A/C No</div><div class="comp-rtspn02" style="width: 55%;float: left;">: 630505500105</div></li>
<li><div class="comp-ltspn02" style="width: 45%;float: left;">Branch &IFC Code</div><div class="comp-rtspn02" style="width: 55%;float: left;">: Himayathnagar &amp; ICIC006305</div></li>
</ul>
</div>
</div>
<div class="fullwidth">
<p style="color:#000;font-size:9px;">Declaration: We declare that his invoice shows the actual price of the goods described and that all particulars are true and correct.</p>
</div>
<div class="fullwidth">
<table class="table03">
<tr>
<td style="color: #58595B;font-size: 10px;">Customer&#39;s Seal and Signature

</td>
<td><div style="width:100%;margin-bottom:20px;"><span style="color: #58595B;font-size: 10px;float:right;">For Striker Soft Solutions Private Limited</span></div><br>
<div style="float:right;color: #58595B;font-size: 10px;">Authorised Signatory</div>
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

</html>

';

try
{   
    // create an API client instance
    $client = new Pdfcrowd("nareshgotte", "519ad3a7fc04252d1f3bca8486bd65af");

    // convert a web page and store the generated PDF into a $pdf variable
   $pdf = $client->convertHtml($message);
   
  
   file_put_contents("/var/www/html/smsstriker/pdfcrowd-php-master/pdf/document.pdf",$pdf);
  // $file_name="document.pdf";
  // header('Content-type: application/pdf');
   //header('Content-Disposition: attachment; filename="'.$file_name.'"');

    // set HTTP response headers
   // header("Content-Type: application/pdf");
   // header("Cache-Control: max-age=0");
   // header("Accept-Ranges: none");
   // header("Content-Disposition: attachment; filename=\"document.pdf\"");

    // send the generated PDF 
    //echo $pdf;
}
catch(PdfcrowdException $why)
{
    echo "Pdfcrowd Error: " . $why;
}


/*
    $out_file = fopen("/var/www/html/smsstriker/pdfcrowd-php-master/pdf/document.pdf", "wb");
    $client->convertHtml("<head></head><body>My HTML Layout</body>", $out_file);
    fclose($out_file);
 */
 
 


$mail->Body    = $message;
$mail->AltBody = $message;

//$mail->AddAttachment($file);

$mail->AddAttachment('/var/www/html/smsstriker/pdfcrowd-php-master/pdf/document.pdf');

//$mail->AddAttachment('/var/www/html/smsstriker/pdfcrowd-php-master/pdf/document.pdf');
//$path="/var/www/html/smsstriker/pdfcrowd-php-master/pdf/document.pdf";
 //$mail->AddAttachment($path, '', $encoding = 'base64', $type = 'application/pdf');

if(!$mail->Send())
{
   echo "Message could not be sent. <p>";
   echo "Mailer Error: " . $mail->ErrorInfo;

}else{

echo "Message has been sent";
}
}


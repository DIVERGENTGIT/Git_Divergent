<?php
include('database.php');
 
 
$query = "SELECT * FROM global_settings";
$result = mysqli_query($link,$query) or die('Error query:  '.$query);
$serviceTax='';
$application_url='';
$Email_lib='';
$config='';
 
while($rec=mysqli_fetch_assoc($result))
{
//print_r($rec);
	if($rec['setting_name']=='Service Tax')
	{
	$serviceTax=$rec['value'];
	// for payment
	$tax=$row['value'];
	}
    if($rec['setting_name']=='application_url')
	{
	$application_url=$rec['value'];
	}
   if($rec['setting_name']=='base_url')
	{
	$base_url=$rec['value'];
	}
    if($rec['setting_name']=='PHPMailer')
	{
	$Email_lib=$rec['value'];
	}
   if($rec['setting_name']=='config')
	{
	 $config=$rec['value'];
	}
}

/* for Live
$registrationlog="/var/www/vhosts/www.smsstriker.com/htdocs/strikerapp/Error_log/registration.log";
$invoice_url="http://".$_SERVER['HTTP_HOST']."/strikerapp/";
$invoicepath="/var/www/vhosts/www.smsstriker.com/htdocs/strikerapp/invoice_code/reports/";
*/

/*** for Local ***/
$registrationlog=$application_url."Error_log/registration.log";

//$invoice_url="http://".$_SERVER['HTTP_HOST']."/";

$invoice_url = $_SERVER["REQUEST_SCHEME"].'://'.$_SERVER['HTTP_HOST']."/";

$invoicepath=$application_url."invoice_code/reports/";






?>

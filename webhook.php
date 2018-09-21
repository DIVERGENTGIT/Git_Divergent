<?php
$server="localhost";
$dbuser="emailgateway";
$dbpass='emailgateway@321';
$db="email_gateway";
$con=mysqli_connect($server,$dbuser,$dbpass,$db);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }


$content =trim(file_get_contents("php://input"));
$response = json_decode($content, true );

if($response){
$PostFields=array();
 $eventType=$response['eventType'];
$timestamp=$response['mail']['timestamp'];
$source=$response['mail']['source'];
$messageId=$response['mail']['messageId'];
$destination=$response['mail']['destination'][0];
$date=$response['mail']['headers'][1]['value'];
$to=$response['mail']['headers'][2]['value'];
$from=$response['mail']['headers'][3]['value'];
$ReplyTo=$response['mail']['headers'][4]['value'];
$Subject=$response['mail']['headers'][5]['value'];
$MessageID=$response['mail']['headers'][6]['value'];
$campaign_uid=$response['mail']['headers'][8]['value'];
$sourceip=$response['tags']['ses:source-ip'][0];

sendEmailDLR($eventType,$campaign_uid,$source);
//sendEmailDLR2($eventType,$campaign_uid,$to);

mysqli_query($con,"update mw_campaign_delivery_log set delivery_confirmed='$eventType',delivered_on=now() where email_message_id='$campaign_uid' ") ;

mysqli_close($con);
}

error_log(print_r($response,true)."\r\n",3,"/var/www/html/logs/aws/awsRES.log");

function sendEmailDLR($eventType,$campaign_uid,$source){
$api='https://demo.office24by7.com/emailDLRs.php?';
		$api .= "status=$eventType&";
		$api .= "msgid=$campaign_uid&";
		 $api .= "toemail=$source";
		return file_get_contents($api);
//error_log($api."\r\n",3,"/var/www/html/logs/aws/api.log");
	}
function sendEmailDLR2($eventType,$campaign_uid,$to){
$api='https://demo.office24by7.com/emailDLRs.php?';
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,$api);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,
            "eventType=$eventType&msgid=$campaign_uid&toemail=$to");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);
// further processing ....
if ($server_output) { 
//error_log($api."\r\n",3,"/var/www/html/logs/aws/curlsucessapi.log");
 } else { 
//error_log($api."\r\n",3,"/var/www/html/logs/aws/curlfailsapi.log");
 }
}
?>

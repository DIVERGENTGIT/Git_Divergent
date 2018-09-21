 <?php  
include("dbconnect/config.php");  
  

$username = ($_REQUEST['username'])?$_REQUEST['username']:'';
$password = ($_REQUEST['password'])?$_REQUEST['password']:'';
$from = ($_REQUEST['from'])?$_REQUEST['from']:''; 
$to_mobile = ($_REQUEST['to'])?$_REQUEST['to']:''; 
$type = ($_REQUEST['type'])?$_REQUEST['type']:''; 
$message= ($_REQUEST['msg'])?$_REQUEST['msg']:''; 
$dnd_check = ($_REQUEST['dnd_check'])?$_REQUEST['dnd_check']:0;
 
if($to_mobile) {  
	$phoneCode = substr($to_mobile, 0, 2); 
	if($phoneCode == 91) {
		//echo "https://www.smsstriker.com/API/sms.php?username=$username&password=$password&from=$from&to=$to_mobile&msg=$message&type=$type&dnd_check=$dnd_check";
		// echo file_get_contents("https://www.smsstriker.com/API/sms.php?username=$username&password=$password&from=$from&to=$to_mobile&msg=$message&type=$type&dnd_check=$dnd_check");
	}else{  
		//echo "https://www.smsstriker.com/API/internationalSMS.php?username=$username&password=$password&from=$from&to=$to_mobile&msg=$message&type=$type&dnd_check=$dnd_check";   
		//echo file_get_contents("https://www.smsstriker.com/API/internationalSMS.php?username=$username&password=$password&from=$from&to=$to_mobile&msg=$message&type=$type&dnd_check=$dnd_check");
	}     
}

 
$mysqli->close();

?>

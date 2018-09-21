<?php 
if(isset($_REQUEST['sender']))
{
	
$sender = $_REQUEST['sender'];
$dest = $_REQUEST['dest'];
$body = urldecode($_REQUEST['body']);
$smscinfo = urldecode($_REQUEST['smscinfo']);

$date=urldecode($_REQUEST['senttime']);


$datesplit=explode("/",$date);
 $day= $datesplit[0];

 $month= $datesplit[1];

 $datesplit[2];
$yearsplt=explode(" ",$datesplit[2]);
 $year="20".$yearsplt[0];
 $on_time=$year."-".$month."-".$day." ".$yearsplt[1];


$link = mysql_connect("localhost", "longcodeuser", "admin123");
mysql_select_db("longecode_db",$link); 



preg_match_all('!\d+!', $body, $matches);
$separtenum= $matches[0][0];
$arr=str_split($separtenum,3);
 $n= $arr[0];  //for priya foods sctract card code first three numbers

$user="priyafoodslng2"; //your username
$password="priyafoods"; //your password
$senderid="PRIYAF"; //Your senderid
$messagetype="1"; //Type Of Your Message

switch ($dest) {
    case 9666821111:
       $user_id=4065; // priya
	 
	 
	 	
switch ($n) {
    case 111:
    $couponcode=range(111000001,111900000);
        break;
    case 222:

	
        $couponcode=range(222000001 ,222210000);
        break;
    	case 333:
        $couponcode=range(333000001 ,333210000);
		break;
		case 444:
        $couponcode=range(444000001,444350000);
		break;
       
    default:
        $couponcode=range(111000001,111900000);
			break;
}




if(in_array($separtenum,$couponcode))
{

$message_from=mysql_query("select f_n,d_n,s_n, message_from,coupn_id from sms_messages where message_from=$sender and message like '%$separtenum%' ");
$res=mysql_fetch_array($message_from);
$count= mysql_num_rows($message_from);

if($count>=1)
{
	
		if(empty($res['d_n'])&&empty($res['s_n']))
		{
			$d_n=1;
		}else
		{
			$s_n=1;
		}
	}
else
{
	$isavail=mysql_query("select f_n,d_n,s_n, message_from,message from sms_messages where  message like '%$separtenum%'");
$codevail= mysql_num_rows($isavail);
	if($codevail>=1)
	{
		$s_n=1;
	}else{
	 $f_n=1;
	}

}
	
	
$mobile_rec_no = "insert into sms_messages SET
		message = '$body',
		message_from = '$sender',
		service_number = '$dest',
		message_time = '$on_time',
		smscinfo= '$smscinfo',
		user_id = '$user_id'";
		
			if(!empty($f_n))
		{
			 $mobile_rec_no .= ", f_n = '$f_n'";
$message = "Thank U for choosing Priya the brand trusted for its quality.Congrats!No.$separtenum is enrolled for lucky draw.Winners will be announced and contacted directly";

		}
		if(!empty($d_n))
		{
					 $mobile_rec_no .= ", d_n = '$d_n'";
			 $message ="Sorrry! This code is already enrolled. Please try with new code";	
		}
		if(!empty($s_n))
		{
					 $mobile_rec_no .= ", s_n = '$s_n'";
					 $message ="Sorrry! This code is already enrolled. Please try with new code";	

		}
		
	mysql_query($mobile_rec_no);

	
	
	// call_sms_api($user, $password,$message,$sender, $senderid, $messagetype);
	
}else
{
	 $mobile_rec_no = "insert into sms_messages SET
		message = '$body',
		message_from = '$sender',
		service_number = '$dest',
		message_time = '$on_time',
		smscinfo= '$smscinfo',
		user_id = '$user_id'";
			mysql_query($mobile_rec_no);

		 $message ="Invalid Scratch Card code";
		 

	//call_sms_api($user, $password,$message,$sender, $senderid, $messagetype);
}

        break;

       case 9666221111:
       $user_id=4066; // monster
//Normal  longecode	
	
		$insert_query = "insert into sms_messages SET
		message = '$body',
		message_from = '$sender',
		service_number = '$dest',
		message_time = '$on_time',
		smscinfo= '$smscinfo',
		user_id = '$user_id'";
		
mysql_query($insert_query,$link);	
mysql_close($link);

$code=substr(mt_rand(), 0, 4); /// to generate random number
 call_monster_api($sender, $status="v_y",$code);

        break;
		
		
		   break;

       case 9542288000:
       $user_id=2514; // cybercity 
	
		$insert_query = "insert into sms_messages SET
		message = '$body',
		message_from = '$sender',
		service_number = '$dest',
		message_time = '$on_time',
		smscinfo= '$smscinfo',
		user_id = '$user_id'";
		
mysql_query($insert_query,$link);	
mysql_close($link);

        break;
		
		
		
	 case 9505158888:
       $user_id=4084; // waterboard
	
		$insert_query = "insert into sms_messages SET
		message = '$body',
		message_from = '$sender',
		service_number = '$dest',
		message_time = '$on_time',
		smscinfo= '$smscinfo',
		user_id = '$user_id'";
		
mysql_query($insert_query,$link);	
mysql_close($link);
$username="waterboard";
$password="123456";

 call_waterboard_api($username,$password,$sender, $dest,$body);
        break;
     	

case 9133488800: 



$user="apsrtccompliants"; //your username
$pwd="Ap5r7c1ng"; //your password
$senderid="APSRTC"; //Your senderid
$messagetype="1"; //Type Of Your Message


$user_id=4323; // APSRTC

                $insert_query = "insert into sms_messages SET
                message = '$body',
                message_from = '$sender',
                service_number = '$dest',
                message_time = '$on_time',
                smscinfo= '$smscinfo',
                user_id = '$user_id'";

mysql_query($insert_query,$link);
mysql_close($link);
$username="TecHubAPSRTC";
$password="RTCTecHubAPS";
call_apsrtc_api($username,$password,$sender, $dest,$body);

$needle="?";
$body= trim($body);
$pos = strpos(trim($body),$needle);
if($pos!==FALSE) {
	
if(empty($body[$pos+1]) && empty($body[$pos-1]))
 {

$message= call_apsrtc_api_questionmarks($sender,$body);

$smsresponse=call_sms_api($user,$pwd,$message,$sender, $senderid, $messagetype);
echo "Single question mark";
$data="Mobile ".$sender."SericeNumber ".$dest." success text ".$body."urlresponse".$message ."smsresponse ".$smsresponse ."Date ".$on_time;

error_log($data."\r\n",3,"/var/www/html/Reseller_User/idea/error_log/logecode.log");

 }else
{
	echo "Message Content Question Mark along with Data";
	
	$data="Mobile ".$sender."SericeNumber ".$dest." msg with question text ".$body."urlresponse".$message."Date ".$on_time;
	error_log($data."\r\n",3,"/var/www/html/Reseller_User/idea/error_log/logecode.log");
}
	
}else
 {
	 echo "Message Does not Contain Question Marks";
	 
	 	$data="Mobile ".$sender."SericeNumber ".$dest." msg doen't contain question text ".$body."urlresponse".$urlresponse."Date ".$on_time;
	 	error_log($data."\r\n",3,"/var/www/html/Reseller_User/idea/error_log/logecode.log");
	 	
 }



break;
	
}

$sucess["status"]="Success";

	echo json_encode($sucess);

}else
{
	$sucess["status"]="failure";

	echo json_encode($sucess);

}
function call_sms_api($user,$pwd,$message,$sender, $senderid, $messagetype){
		$api = "http://www.smsstriker.com/API/sms.php?";
		$api .= "username=$user&";
		$api .= "password=$pwd&";
		$api .= "to=".$sender."&";
		$api .= "msg=".urlencode($message)."&";
		$api .= "from=".$senderid."&";
		  $api .= "type=".$messagetype;
		 return file_get_contents($api);
	}

	function call_monster_api($sender, $status,$code){
		$api = "http://recruiter.monsterindia.com/v2/resumedatabase/sms_update_api.html?";
		$api .= "mobile=$sender&";
		$api .= "status=$status&";
		 $api .= "code=".$code;
		
		 return file_get_contents($api);
	}


	function  call_waterboard_api($username,$password,$sender, $dest,$body){
		$api = "http://www.hyderabadwater.gov.in/ppmp/SmsReceiver.aspx?";
		$api .= "username=$username&";
		$api .= "password=$password&";
		$api .= "src=$sender&";
		$api .= "dest=$dest&";
		 $api .= "msg=".urlencode($body);
		
		 return file_get_contents($api);
	}






//http://rtcfeedbacktest.appspot.com/preAuth/sms/complaint?query=user-options
 function  call_apsrtc_api_questionmarks($sender,$body){
                $api = "http://rtcfeedbacktest.appspot.com/preAuth/sms/complaint?";
                $api .= "query=$body&";
                 $api .= "from=$sender";               

                 return file_get_contents($api);
        }

 function  call_apsrtc_api($username,$password,$sender, $dest,$body){
                $api = "http://rtcfeedbacktest.appspot.com/preAuth/sms/complaint?";
                $api .= "username=$username&";
                $api .= "password=$password&";
                $api .= "src=$sender&";
                $api .= "dest=$dest&";
                 $api .= "msg=".urlencode($body);

                 return file_get_contents($api);
        }


?>

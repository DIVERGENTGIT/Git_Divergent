<?php 

$mobile = $_REQUEST['mobile'];
$service_number = urldecode($_REQUEST['service_number']);
$status = urldecode($_REQUEST['status']);
$code = urldecode($_REQUEST['code']);

$on_time = urldecode($_REQUEST['msg_time']);
$user_id = urldecode($_REQUEST['user_id']);



$link = mysql_connect("localhost", "strikerapp", "Off!c3@v2017");
mysql_select_db("longecode_db",$link); 



preg_match_all('!\d+!', $code, $matches);
$separtenum= $matches[0][0];
$arr=str_split($separtenum,3);
 $n= $arr[0];  //for priya foods sctract card code first three numbers

$user="priyafoodslng"; //your username
$password="priyafoods"; //your password
$senderid="PRIYAF"; //Your senderid
$messagetype="1"; //Type Of Your Message


if($user_id==3958) // priya food longe code
{



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

$message_from=mysql_query("select f_n,d_n,s_n, message_from,coupn_id from sms_messages where message_from=$mobile and message like '%$separtenum%' ");
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
		message = '$code',
		message_from = '$mobile',
		service_number = '$service_number',
		message_time = '$on_time',
		user_id = '$user_id',
		status = '$status'";
		
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

	
	
	call_sms_api($user, $password,$message,$mobile, $senderid, $messagetype);
	
}else
{
	$mobile_rec_no = "insert into sms_messages SET
		message = '$code',
		message_from = '$mobile',
		service_number = '$service_number',
		message_time = '$on_time',
		user_id = '$user_id',
		status = '$status'";
			mysql_query($mobile_rec_no);

		 $message ="Invalid Scratch Card code";
		 

	call_sms_api($user, $password,$message,$mobile, $senderid, $messagetype);
}



	
}else
{

	
//Normal  longecode	
	
	 $insert_query = "insert into sms_messages SET
		message = '$code',
		message_from = '$mobile',
		service_number = '$service_number',
		message_time = '$on_time',
		user_id = '$user_id',
		status = '$status'";
mysql_query($insert_query,$link);	
mysql_close($link);
	
}
function call_sms_api($user, $password,$message,$mobile, $senderid, $messagetype){
		$api = "http://www.smsstriker.com/API/sms.php?";
		$api .= "username=$user&";
		$api .= "password=$password&";
		$api .= "to=".$mobile."&";
		$api .= "msg=".urlencode($message)."&";
		$api .= "from=".$senderid."&";
		$api .= "type=".$messagetype;
		 return file_get_contents($api);
	}
?>
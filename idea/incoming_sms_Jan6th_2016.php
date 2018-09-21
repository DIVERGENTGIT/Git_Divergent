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

	
	
	 call_sms_api($user, $password,$message,$sender, $senderid, $messagetype);
	
}else
{
	 $mobile_rec_no = "insert into sms_messages SET
		message = '$body',
		message_from = '$sender',
		service_number = '$dest',
		message_time = '$on_time',
		user_id = '$user_id'";
			mysql_query($mobile_rec_no);

		 $message ="Invalid Scratch Card code";
		 

	call_sms_api($user, $password,$message,$sender, $senderid, $messagetype);
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
		user_id = '$user_id'";
		
mysql_query($insert_query,$link);	
mysql_close($link);

$code=substr(mt_rand(), 0, 4); /// to generate random number
 call_monster_api($sender, $status="v_y",$code);

        break;
		
		 case 9505158888:
       $user_id=4084; // waterboard
		//Normal  longecode	
	
		$insert_query = "insert into sms_messages SET
		message = '$body',
		message_from = '$sender',
		service_number = '$dest',
		message_time = '$on_time',
		user_id = '$user_id'";
		
mysql_query($insert_query,$link);	
mysql_close($link);

        break;
		

	
}
/*  $insert_query = "insert into incoming_sms SET
		sender = '$sender',
		dest = '$dest',
		body = '$body',
		smscinfo = '$smscinfo',
		senttime = '$on_time',
		user_id = '$user_id'";
mysql_query($insert_query,$link);	
mysql_close($link);
*/
/*








if($user_id==3958) // priya food longe code
{




	
}else
{


}*/
// AUTO RESPONSE SMS API FUNCTION




}else
{
	$sucess["failure"]="Record Not Inserted";

	echo json_encode($sucess);

}
function call_sms_api($user, $password,$message,$sender, $senderid, $messagetype){
		$api = "http://www.smsstriker.com/API/sms.php?";
		$api .= "username=$user&";
		$api .= "password=$password&";
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



?>
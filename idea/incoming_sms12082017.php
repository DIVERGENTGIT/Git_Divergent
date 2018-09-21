<?php 
if(isset($_REQUEST['sender']))
{
	
$sender = $_REQUEST['sender'];
$dest = $_REQUEST['dest'];
$body = urldecode($_REQUEST['body']);
$smscinfo = urldecode($_REQUEST['smscinfo']);
$stime=urldecode($_REQUEST['senttime']);
$date=urldecode($_REQUEST['senttime']);


$datesplit=explode("/",$date);
 $day= $datesplit[0];

 $month= $datesplit[1];

 $datesplit[2];
$yearsplt=explode(" ",$datesplit[2]);
 $year="20".$yearsplt[0];
 $on_time=$year."-".$month."-".$day." ".$yearsplt[1];

$date=date('Y-m-d');  
$req = json_encode($_REQUEST,true);
error_log($req,3,"/var/www/html/strikerapp/API/longcode_log/incoming_$date.log");

call_striker_longcode_api($sender,$dest,$body,$stime,$smsinfo);

$link = mysql_connect("localhost","strikerapp",'Off!c3@v2017');

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
  /*  case 9666821111:
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

		
   case 8367000020:

       $user_id=4945; // striker test number for longcode

	

		$insert_query = "insert into sms_messages SET

		message = '$body',

		message_from = '$sender',

		service_number = '$dest',

		message_time = '$on_time',

		smscinfo= '$smscinfo',

		user_id = '$user_id'";

		

mysql_query($insert_query,$link);	

mysql_close($link);
call_striker_longcode_api($sender,$dest,$body,$stime,$smsinfo);
//call_strikersoft_longcode_api($sender,$dest,$body,$stime,$smsinfo);
break;	
	
   case 8367000030:

       $user_id=2917; // striker test number for longcode



                $insert_query = "insert into sms_messages SET

                message = '$body',

                message_from = '$sender',

                service_number = '$dest',

                message_time = '$on_time',

                smscinfo= '$smscinfo',

                user_id = '$user_id'";



mysql_query($insert_query,$link);

mysql_close($link);
call_striker_longcode_api($sender,$dest,$body,$stime,$smsinfo);
//call_strikersoft_longcode_api($sender,$dest,$body,$stime,$smsinfo);

break;

		   case 8367000040:

       $user_id=2917; // striker test number for longcode



                $insert_query = "insert into sms_messages SET

                message = '$body',

                message_from = '$sender',

                service_number = '$dest',

                message_time = '$on_time',

                smscinfo= '$smscinfo',

                user_id = '$user_id'";



mysql_query($insert_query,$link);

mysql_close($link);
call_striker_longcode_api($sender,$dest,$body,$stime,$smsinfo);
//call_strikersoft_longcode_api($sender,$dest,$body,$stime,$smsinfo);

break;

   case 8367000060:

       $user_id=2917; // striker number for longcode



                $insert_query = "insert into sms_messages SET

                message = '$body',

                message_from = '$sender',

                service_number = '$dest',

                message_time = '$on_time',

                smscinfo= '$smscinfo',

                user_id = '$user_id'";



mysql_query($insert_query,$link);

mysql_close($link);
call_striker_longcode_api($sender,$dest,$body,$stime,$smsinfo);
//call_strikersoft_longcode_api($sender,$dest,$body,$stime,$smsinfo);


break;
*/
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
     	
     	
     	
     	 case 8886638800:
       $user_id=4724; // TSRTC 
    //  $user_id=4131; // TSRTC 
	
		$insert_query = "insert into sms_messages SET
		message = '$body',
		message_from = '$sender',
		service_number = '$dest',
		message_time = '$on_time',
		smscinfo= '$smscinfo',
		user_id = '$user_id'";
		
mysql_query($insert_query,$link);	
mysql_close($link);
$res=call_tsrtc_api($sender,$body);
call_tsrtc_api_test($sender,$body);
$data=$insert_query;
error_log($data." Response: ".$res."\r\n",3,"/var/www/html/strikerapp/idea/error_log/tsrtc.log");

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
mysql_close($link);http://www.smsstriker.com/index.php/longcode/reports
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

error_log($data."\r\n",3,"/var/www/html/strikerapp/idea/error_log/logecode.log");

 }else
{
	echo "Message Content Question Mark along with Data";
	
	$data="Mobile ".$sender."SericeNumber ".$dest." msg with question text ".$body."urlresponse".$message."Date ".$on_time;
	error_log($data."\r\n",3,"/var/www/html/strikerapp/idea/error_log/logecode.log");
}
	
}else
 {
	 echo "Message Does not Contain Question Marks";
	 
	 	$data="Mobile ".$sender."SericeNumber ".$dest." msg doen't contain question text ".$body."urlresponse".$urlresponse."Date ".$on_time;
	 	error_log($data."\r\n",3,"/var/www/html/strikerapp/idea/error_log/logecode.log");
	 	
 }



break;
	

case '639065588088':

$user_id=4094; // monster philphines with 63 international

$insert_query = "insert into sms_messages SET
message = '$body',

message_from = '$sender',
service_number = '$dest',

message_time = '$on_time',
smscinfo= '$smscinfo',
user_id = '$user_id'";

mysql_query($insert_query,$link);	
mysql_close($link);

call_monster_api_international($sender,$dest,$body);
break;


case '09065588088':

$user_id=4094; // monster philphines with zero international

$insert_query = "insert into sms_messages SET
message = '$body',

message_from = '$sender',
service_number = '$dest',

message_time = '$on_time',
smscinfo= '$smscinfo',
user_id = '$user_id'";

mysql_query($insert_query,$link);	
mysql_close($link);

call_monster_api_international($sender,$dest,$body);
break;
	
case '9065588088':


$user_id=4094; // monster philphines without zero international

$insert_query = "insert into sms_messages SET
message = '$body',

message_from = '$sender',
service_number = '$dest',

message_time = '$on_time',
smscinfo= '$smscinfo',
user_id = '$user_id'";

mysql_query($insert_query,$link);	
mysql_close($link);

call_monster_api_international($sender,$dest,$body);
break;
	
	
			

case '4282':

$user_id=4094; // monster gulf international

$insert_query = "insert into sms_messages SET
message = '$body',
message_from = '$sender',
service_number = '$dest',
message_time = '$on_time',
smscinfo= '$smscinfo',
user_id = '$user_id'";

mysql_query($insert_query,$link);	
mysql_close($link);

call_monster_api_international($sender,$dest,$body);
break;


		

case '63001':

$user_id=4094; // monster malasya international

$insert_query = "insert into sms_messages SET
message = '$body',

message_from = '$sender',
service_number = '$dest',
message_time = '$on_time',
smscinfo= '$smscinfo',

user_id = '$user_id'";

mysql_query($insert_query,$link);	
mysql_close($link);

call_monster_api_international($sender,$dest,$body);
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

    function  call_striker_longcode_api($sender,$dest,$body,$stime,$smsinfo){
                $api = "http://www.smsstriker.com/API/longcode_sms_api.php?";
                $api .= "sender=$sender&";
                $api .= "dest=$dest&";
                $api .= "smsinfo=$smsinf&";
               $api.="body=".urlencode($body)."&";
               $api.="senttime=".urlencode($stime);
               return file_get_contents($api);


        }

/*
 function  call_strikersoft_longcode_api($sender,$dest,$body,$stime,$smsinfo){
                $api = "http://www.smsstriker.com/API/longcode_sms_api.php?";
                $api .= "sender=$sender&";
                $api .= "dest=$dest&";
                $api .= "smsinfo=$smsinf&";
               $api.="body=".urlencode($body)."&";
               $api.="senttime=".urlencode($stime);
               return file_get_contents($api);


        }*/


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



/*
 function  call_tsrtc_api($sender,$body){
                 $api = "http://tsrtcfeedback.appspot.com/preAuth/sms/complaint?";
                 $api .= "query=$body&";
                 $api .= "from=$sender";  
              	error_log($api."\r\n",3,"/var/www/html/strikerapp/idea/error_log/tsrtc_urlcall.log");
                 return file_get_contents($api);

        }*/
         function  call_tsrtc_api_test($sender,$body){
               $api = "http://smsstriker.com/idea/check.php?";
                 $api .= "query=".urlencode($body);
                 $api .= "&from=".urlencode($sender);  
error_log($api."\r\n",3,"/var/www/html/strikerapp/idea/error_log/tsrtc_urlcall_test.log");
                 return file_get_contents($api);
                       
                		

        }
        
         function  call_tsrtc_api($sender,$body){

         $api = "http://tsrtcfeedback.appspot.com/preAuth/sms/complaint?";
                 $api .= "query=".urlencode($body);
                 $api .= "&from=".$sender;  
error_log($api."\r\n",3,"/var/www/html/strikerapp/idea/error_log/tsrtc_urlcall.log");
                 return file_get_contents($api);

/*
$data = array('query' => '$body', 'from' => '$sender');
  $url = 'http://tsrtcfeedback.appspot.com/preAuth/sms/complaint';

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url); 

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	curl_setopt($ch, CURLOPT_POST,1);

	curl_setopt($ch, CURLOPT_POSTFIELDS,$data);    

	$resp = curl_exec($ch);   

	echo $resp;

	curl_close($ch);*/
                       
                		

        }


 /*
http://jobsearch.monsterindia.noida/seeker_mobile/seeker_mobile.html?login=monster&passwd=seekermobile&reqMsg=UNSUB%204282&mobileNo=9659876543211
*/
	function call_monster_api_international($sender,$dest,$body){
		$api = "http://jobsearch.monsterindia.noida/seeker_mobile/seeker_mobile.html?";
		$api .= "login=monster&";
		$api .= "passwd=$sender&";
		 $api .= "reqMsg=$body&";
		 $api .= "mobileNo=$dest";
		return file_get_contents($api);
	}

?>

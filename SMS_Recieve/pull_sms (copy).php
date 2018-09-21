<?php 

//http://www.smsstriker.com/SMS_Recieve/pull_sms.php?sms_txt=Hi%20How%20are%20&to=9246222290&from=9849098490
//input parameters
$from = $_REQUEST['from'];
$to = $_REQUEST['to'];

if(strlen($to)==12 && substr($to,0,2) == "91"){
    $to = substr($to,2,10);
} elseif(strlen($to)==13 && substr($to,0,3) == "+91"){
    $to = substr($to,3,10);
}

if(strlen($from)==12 && substr($from,0,2) == "91"){
    $from = substr($from,2,10);
} elseif(strlen($from)==13 && substr($from,0,3) == "+91"){
    $from = substr($from,3,10);
}

$sms_txt = trim($_REQUEST['sms_txt']);
$on_time = $_REQUEST['on_time'];
$split = explode(" ",$sms_txt);
$key_word = trim(strtoupper($split[0]));


$link = mysql_connect("localhost", "strikerapp", 'Off!c3@v2017');
mysql_select_db("sms",$link);

$user_id0=0;
$query0 = "select user_id from user_long_code_keywords where keyword='$key_word'";
$rs0 = mysql_query($query0);

if(mysql_num_rows($rs0)>0) 
{
	 while($row0 = mysql_fetch_array($rs0))
	 {
        $user_id0 = $row0['user_id'];
      }
}

//fetching code_id and user_id
$query = "select code_id, user_id, code_type from long_short_codes where code_number='$to'";

if($user_id0>0)
{
	$query.=" and user_id='$user_id0'";
}

$rs = mysql_query($query);

if(mysql_num_rows($rs)>0) {
	$row = mysql_fetch_array($rs);

	$code_id = $row['code_id'];
	$user_id = $row['user_id'];
	$code_type = $row['code_type'];
	
$smscinfo="TATA";
$service_type="dedicated";
	/*$mobile_rec_no = "insert into longecode_db.sms_messages SET
		message = '$sms_txt',
		message_from = '$from',
		service_number = '$to',
		message_time = '$on_time',
		smscinfo= '$smscinfo',
		user_id = '$user_id'";
mysql_query($mobile_rec_no);*/

	$sql_insert="insert into longcode_smsmessages (service_number,message_from,status,error_message,message,message_time,user_id,keyword,smscinfo,service_type)
 values ('$to','$from','Recieved','Recieved','$sms_txt','$on_time',$user_id,'$code_type','$smscinfo','$service_type')";

mysql_query($sql_insert);

	$insert_query = "insert into sms_inbox SET
		user_id = '$user_id',
		code_id = '$code_id',
		from_number = '$from',
		sms_text = '$sms_txt',
		received_on = '$on_time',
		key_word = '$key_word',
		is_sms_sent = '0',
		created_on = now()						
	";
	
	mysql_query($insert_query);

//call_striker_longcode_api($from,$to,$sms_txt,$on_time,$smsinfo);	
	
	if($to=="9246190909") // enadu
	{
		$msg=urlencode($sms_txt);
		$sms_url="http://ramojifoundation.org/yuvabharat/getsms.php?from='$from'&to='$to'&date='$on_time'&mesg='$msg'";  
		$h=fopen($sms_url,"r");
		fclose($h);
		//http://ramojifoundation.org/yuvabharat/getsms.php?from=&to=&date=&mesg=
	}

	if($to=="9246399299") // romoji velugu
	{
	$msg=urlencode($sms_txt);
		$sms_url="http://ramojifoundation.org/tvdictionary/getsms.php?from='$from'&to='$to'&date='$on_time'&mesg='$msg'";  
		$h=fopen($sms_url,"r");
		fclose($h);

	}

	if($to=="9246010011") 
	{
	$msg=urlencode($sms_txt);
		$sms_txt =urlencode($_REQUEST['sms_txt']);
		$sms_url="http://felr.org/cms-sms/getsms.php?from='$from'&to='$to'&date='$on_time'&mesg='$msg'";  
		$h=fopen($sms_url,"r");
		fclose($h);
		//http://ramojifoundation.org/yuvabharat/getsms.php?from=&to=&date=&mesg=
	}
	if($user_id=="3152")
	{
		$sms_txt_t=urldecode($sms_txt);
		
		
		$hostname='WIFIAPP.db.3476135.hostedresource.com';
		$username='WIFIAPP';
		$password='c123W!F!';
		
		$dbh2 = mysql_connect($hostname, $username, $password, true); 
		mysql_select_db('WIFIAPP', $dbh2);
	
	
	
		
 		mysql_query("insert into free_sms SET
		From_No = '$from',To_No='$to',SMS_Text='$sms_txt_t'");
		$lastid=mysql_insert_id();
		
		
		
	
		
		
	}
	
	if($user_id=="1267") // lemon media
	{
		
		
 		$queryinsert = "insert into longecode_db.sms_messages SET
		message = '$sms_txt',
		message_from = '$from',
		service_number = '$to',
		message_time = now(),
		user_id = '$user_id',
		status = '1'";
		
		mysql_query($queryinsert);	
	
	}
	
	if($user_id=="3297")
	{
		
		
		/*$defmsg="Thank you for connecting. MEC wishes you success in JEE! You will hear from us soon. Visit us at http://j.mp/visitmec";
		$final_msg=urlencode($defmsg);
		$sms_url="http://www.smsstriker.com/API/sms.php?username=TECHMAHINDRA&password=TECHMAHINDRA&from=MECHYD&to=$from&msg=$final_msg&type=1"; 
		$h=fopen($sms_url,"r");
		fclose($h);*/
		//http://ramojifoundation.org/yuvabharat/getsms.php?from=&to=&date=&mesg=
		
		$defmsg="Thank you for connecting. MEC wishes you success in JEE! You will hear from us soon. Visit us at j.mp/applytoMEC";
		$final_msg=urlencode($defmsg);
		$sms_url="http://www.smsstriker.com/API/sms.php?username=TECHMAHINDRA&password=TECHMAHINDRA&from=MECHYD&to=$from&msg=$final_msg&type=1"; 
		$h=fopen($sms_url,"r");
		fclose($h);
		
		
	}
	
	
}

    function  call_striker_longcode_api($sender,$dest,$body,$stime,$smsinfo){
                $api = "https://www.smsstriker.com/API/longcode_sms_api.php?";
                $api .= "sender=$sender&";
                $api .= "dest=$dest&";
                $api .= "smsinfo=$smsinf&";
               $api.="body=".urlencode($body)."&";
               $api.="senttime=".urlencode($stime);
               return file_get_contents($api);


        }

mysql_close($link);
?>

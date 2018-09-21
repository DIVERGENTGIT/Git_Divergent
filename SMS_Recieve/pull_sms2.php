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

print_r($_REQUEST);

$link = mysql_connect("localhost", "smsstrikerapp", '$tr!k3r@2009');
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
	$mobile_rec_no = "insert into longecode_db.sms_messages SET
		message = '$sms_txt',
		message_from = '$from',
		service_number = '$to',
		message_time = '$on_time',
		smscinfo= '$smscinfo',
		user_id = '$user_id'";
mysql_query($mobile_rec_no);

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
	
//	mysql_query($insert_query);

//call_striker_longcode_api($from,$to,$sms_txt,$on_time,$smsinfo);	
	

	
	
	
	
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

mysql_close($link);
?>

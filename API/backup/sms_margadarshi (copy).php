 <?php  
include("dbconnect/config.php");  

 include("/var/www/html/strikerapp/smslib/config.inc");
  include("/var/www/html/strikerapp/smslib/functions.inc");

 
$custom_parameter=NULL;
$db_link=NULL;  
$temp_check=NULL;
$no_of_messages=0;
$no_of_messages_tmp=0;
$message_length=1;
//$r_username = isset($_REQUEST['r_username']) ? $_REQUEST['r_username'] : '';


$username=$_REQUEST['username'];
$password=$_REQUEST['password']; 
 
if(strlen(trim($_REQUEST['from'])) == 6)	
{
$from=$_REQUEST['from'];  
$to_mobiles=$_REQUEST['to'];
$type=$_REQUEST['type'];

$dnd_check = 0;
$error = false;
$message='';
if(isset($_REQUEST['dnd_check']) && $_REQUEST['dnd_check']){
    $dnd_check = $_REQUEST['dnd_check'];
}



   $message =trim($_REQUEST['msg']); 

$data = json_encode($_REQUEST,true);
$datelog= date('Y-m-d');
  //if($from=='GHMCHY'){$datelog= date('Y-m-d');
if(trim($username)=='actstrikerdigi'){
error_log($data."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/actstrikerdigi".$datelog.".log");
}
 //}
     
   if(strlen($message) <= 0) {
	echo 'Message should not empty.';exit;
   }


$message = urldecode(urldecode(urldecode(urldecode(urldecode($message)))));  
if($username=='saboorks'){

$message=explode('\n',$message);
$message= implode(" ",$message);
$message=explode('\r',$message);
$message= implode(" ",$message);
$message=explode('\t',$message);
$message= implode(" ",$message);
$message=str_replace("\'","'",$message);
$message=str_replace('\"','"',$message);
$message = str_replace("\n", " ", $message);
$message = str_replace("\t", " ", $message);
 $message = str_replace("\r", " ", $message); 
 $message = preg_replace('/\s+/', ' ', $message);
}
 $message = trim($message);  
 $message1 = trim($message);  
 if (!preg_match("~^(?:f|ht)tps?://~i", $message)) {
        $http = "http:";
        $message =str_replace(array('\\', $http.'/'), $http.'//',$message); // output hello
       $https = "https:";
      $message =str_replace(array('\\', $https.'/'), $https.'//', $message); // output hello
    }   

 $message=$mysqli->real_escape_string($message);
$message = stripslashes($message);
$message=trim($message);
  

$splMessage = strtolower(trim($message));
$special_char = array(',','.','-','!','&','’','_','#','(',')','<','>','%',':',';','.','?','*','+','-','/','&','∼','!','=',',','"','’','’');


$sms_text_spl = str_replace($special_char, ' ', $splMessage); 

$special_char_2 = array('{','}','[',']','^','|','€','~');
$sms_text_spl2 = str_replace($special_char_2, '  ', $sms_text_spl);

$message_length=strlen($sms_text_spl2); 
if($message_length == 0){ 
    $message_length = 1;
}

 $date= date('Y-m-d');
// calculate SMS length
if($message_length>160)  
	$no_of_messages_tmp=ceil($message_length/153);
else
	$no_of_messages_tmp=ceil($message_length/160);

$no_of_messages=$no_of_messages_tmp;  // changed on 26-12-2013 as per santosh request
//$no_of_messages=ceil($message_length/160);


  
$to_mobiles = rtrim($to_mobiles,',');
$to_mobiles = ltrim($to_mobiles,',');
$mm=explode(",",$to_mobiles);

$rs=$mysqli->query("select user_id,available_credits,no_ndnc,dnd_check,template_check,checkDuplicates from users where username='".$username."' and password='".md5($password)."'");
if($rs->num_rows > 0)
{
    $val=$rs->fetch_array();
    $user_id=$val[0];
    $available_credits = $val[1];
	$dnd_check=$val['dnd_check'];
	$user_type=$val['no_ndnc'];
	$template_check=$val['template_check'];
	$checkDuplicates=$val['checkDuplicates'];
	$isValidSenderName=false;
		$error = FALSE;
	 if($val['no_ndnc']==1){


	// checking sendernames
		$sender_names_query = "SELECT sender_name from sender_names where user_id='$user_id' and sender_name='".trim($from)."'" ;
		$sender_names_rs = $mysqli->query($sender_names_query);
		//mysql_num_rows($sender_names_rs);

		if($sender_names_rs->num_rows == 0)
		{
		$error = true;
		$isValidSenderName =true;
		//echo $error_msg = "Invalid Sender Name "; exit;

		 
		}

		}
if($user_id==4668 || $user_id==4667){
	$isValidSenderName=false;

}
	if($user_id==3843) // monster
	{
		  
		//echo "Monster ID";
		
				
		
	 $sender = $from;
        $sms_port = 47113;
		
    //get job id
    //$job_id_rs = $mysqli->query("INSERT INTO  sms_api_job_ids SET user_id = '$user_id',created_on = NOW() ");  
	$job_id_rs = $mysqli->query("INSERT INTO  sms_api_job_ids(user_id,created_on) VALUES('".$user_id."', NOW()) ");    
    $job_id = $mysqli->insert_id;
    
    /*
$checkSenderName = $mysqli->query("SELECT * FROM sender_names WHERE user_id = '".$user_id."' AND sender_name = '".trim($from)."' AND status = 1 ");

    if($checkSenderName->num_rows == 0) {  
	$getNASPortNumber = $mysqli->query("SELECT sending_port_no FROM sms_queue WHERE application_priority = 'NAS'");
    		if($getNASPortNumber->num_rows > 0) {
    			$getNASPortNumberRes = $getNASPortNumber->fetch_array();
    			$sms_port = $getNASPortNumberRes['sending_port_no'];
    		}    
    }  */
    
    
    for($i=0;$i<count($mm);$i++) {
        $to=trim($mm[$i]);
	if( !ctype_alnum( $to ) ){
		 continue;
	} 
       	 $remove[] = "'";     
	$remove[] = '"';
	//$remove[] = "-"; // just as another example

	$to = str_replace($remove, "", $to );
	 
        $to=trim($to);

		$isValidMobileNo=TRUE;
		$is_duplicate = 0;
		$numberlength=strlen($to);
		if($numberlength==12)
			$to=substr($to,2);
		if($numberlength==11)
			$to=substr($to,1);
		if($numberlength==10)
			$to=$to;
		
		if(strlen($to) != 10) 
		{
			//echo "invalid no:".$to;
			$invalid_nos_count++;	
			$error = TRUE;
			$isValidMobileNo=FALSE;
			//echo $error_msg .= "Invalid Number"; exit;
			
		}	
		
		

		
		if($no_of_messages<=$available_credits) 
		{
			if($error)
			{
				if(!$isValidMobileNo)
				{
				$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message','$no_of_messages','$to',now(),'16','Invalid Number','$job_id','$sms_port')";
				
					$mysqli->query($query);
					  echo "{Job Id: $job_id, Ack: Invalid Number,mobileNo:$to}";
				}else if($isValidSenderName)
				{
				$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message','$no_of_messages','$to',now(),'12','Not a valid Sender Name','$job_id','$sms_port')";
					$mysqli->query($query);
					  echo "{Job Id: $job_id, Ack: Not a valid Sender Name,mobileNo:$to}";
				} else if(!$isValidTemplate)
				{
				
				$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message','$no_of_messages','$to',now(),'13','Not a valid Template','$job_id','$sms_port')";
				
					$mysqli->query($query);
					  echo "{Job Id: $job_id, Ack: Not a valid Template,mobileNo:$to}";
				}else if(!$send_api_sms)
				{
				$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)	values('$user_id','$from','$message','$no_of_messages','$to',now(),'5', 'Vendor Specific Error: Please contact your provider','$job_id','$sms_port'mm)";	
					  echo "{Job Id: $job_id, Ack: Vendor Specific Error: Please contact your provider,mobileNo:$to}";
					$mysqli->query($query);				
				}	
			
			}else
			{
			
			if($checkDuplicates == 1) {
				$text1 = $username.$message.$from.$to;
				$textmd5 = md5($text1);
				$checkContent = $mysqli->query("SELECT count(*) as duplicate FROM duplicatecheck_api WHERE md5text = '$textmd5'");
				$checkContentData = $checkContent->fetch_array();
				$is_duplicate = $checkContentData['duplicate'];
   			}
			if($is_duplicate > 0){
				$error_text = "Duplicate Msg";
				$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message','$no_of_messages','$to',now(),'16','$error_text','$job_id','$sms_port')");
				echo "{Job Id: $job_id, Ack: Duplicate Msg,mobileNo:$to}"; 
			} else{  

            //check is block listed number?
            $blockedNumberRes = $mysqli->query("SELECT count(*) as blocked FROM sms.block_listed_numbers WHERE user_id = '$user_id' AND mobile_no = '{$to}'");
            $blockedNumberRow = $blockedNumberRes->fetch_array();
            $is_block_listed = $blockedNumberRow['blocked'];
            if($is_block_listed > 0)
			{
			$query=	"insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
values('$user_id','$from','$message','$no_of_messages','$to',now(),'2','Block Listed Number','$job_id','$sms_port')";	

$mysqli->query($query);
		  echo "{Job Id: $job_id, Ack: Block Listed Number,mobileNo:$to}";
			}
                        //check for dnd number
$checkDndRes = $mysqli->query("SELECT count(*) as dnd FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
$checkDndRow = $checkDndRes->fetch_array();
$checkDndRow = $checkDndRow['dnd'];
                        if($checkDndRow > 0){
                            //$is_dnd_number = 1;
							
$query=	"insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)values('$user_id','$from','$message','$no_of_messages','$to',now(),'3','DND Number','$job_id','$sms_port')";					
$mysqli->query($query);
		  echo "{Job Id: $job_id, Ack: DND Number,mobileNo:$to}";
 }
                  
 else {
		if($checkDuplicates == 1) {
			$text1=$username.$message.$from.$to;
			$textmd5=md5($text1);
			$mysqli->query("INSERT INTO `duplicatecheck_api`(`md5text`, `datetime`) VALUES ('$textmd5',NOW())"); 		
		}	
				$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no)
								values('$user_id','$from','$message','$no_of_messages','$to',now(),'$job_id','$sms_port')";
												
						$mysqli->query($query);
								$smsId = $mysqli->insert_id;
		
								$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to&text=".urlencode($message1);
										if($type=="0"){
											$URL .="&mclass=0";
										}
								$URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/apidlr.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port"); 
		// error_log($URL."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/apistriker_".$date.".log");    
								 http_send($URL, $sms_port);   
								    
				$balance = $available_credits - $no_of_messages;
				//$mysqli->query("insert into user_credits_log(before_campaign_credits,after_campaign_credits,current_campaign_credits,user_id,job_id) values('$available_credits','$balance','$no_of_messages','$user_id','$job_id')");	
								
								        $mysqli->query("update users set available_credits=available_credits-$no_of_messages where user_id='$user_id'");
							$available_credits=$available_credits-$no_of_messages; 
							
						
							



  
							}
							
					 echo "{Job Id: $job_id, Ack: Messages has been sent,mobileNo:$to}";	
					}
		
    }

		
		}
	else 
		 { // nofunds
		 
		 $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
                            values('$user_id','$from','$message','$no_of_messages','$to',now(),'11','Insufficient Balance','$job_id','$sms_port')";
                            
            $mysqli->query($query);
echo "{Job Id: $job_id, Ack: Insufficient Credits}";
        }
	
		
    } //for


		
 
$date= date('Y-m-d');
		//error_log($query."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/apistriker_".$date.".log"); 
//error_log($query."\r\n",3,"/var/www/html/strikerapp/api_log/monster_api_log/apistriker_".$date.".log"); 	
		
		
	}else{
		
		// normal api users 
	
	
$error = FALSE;  
			$isValidSenderName = FALSE;
			$isValidTemplate = true;
	if($user_type==1)
	{
		
		
		if($template_check)
		{
 
		$isValidTemplate = true;
		//check for templates
			//lower case
		$sms_text = strtolower($message);
	
			//remove special characters
			$special_char = array(',','.','-','!','&');
			$sms_text = str_replace($special_char, ' ', $sms_text);
			$sms_text_array = explode(" ", $sms_text);
			$txt_array1 = array();
			for($i = 0; $i < count($sms_text_array); $i++){
				$txt1 = trim($sms_text_array[$i]);
				if(strlen($txt1) > 0){
					$txt_array1[] = $txt1;
				}
			   }
		/*	echo "<br> -- original start <br>";
			print_r($txt_array1);  
			echo "<br> -- original end <br>";*/
			
			$templates_query = "SELECT template from templates where user_id='$user_id' and status='2' " ;
			$templates_rs = $mysqli->query($templates_query);
			//mysql_num_rows($templates_rs);
			if($templates_rs->num_rows > 0)
			{  
				while ($row = $templates_rs->fetch_array())
				{
				$temp = strtolower($row['template']);
				$txt2 = str_replace($special_char, ' ', $temp);
				$sms_template = str_replace('xxxx','', $txt2);
				$sms_template_array = explode(" ", $sms_template);
	
				$txt_array2 = array();
				for($i = 0; $i < count($sms_template_array); $i++){
					$txt3 = trim($sms_template_array[$i]);
					if(strlen($txt3) > 0){
						$txt_array2[] = $txt3;
					}
				}

		   
				/*echo "<br> -- from table start <br>";
				print_r($txt_array2);  
				echo "<br> ".count($txt_array2);
				echo "<br> -- from table  end <br>";
				*/
				
				$diff_array = array_diff($txt_array2, $txt_array1);

				
				/*
				echo "<br> -- difference start <br>";
				print_r($diff_array);  
				echo "<br> ".count($diff_array);
				echo "<br> -- difference  end <br>";*/
				
				$text_array2_count = count($txt_array2);
				$diff_array_count = count($diff_array);
	
				
	
				 $diff_percentage = ($diff_array_count/$text_array2_count)*100;
	
				if($diff_percentage <= 40)
				{
					$temp_check=true;
				}
				else 
				{
					$temp_check=false;
				}
			}
			//$temp_check=false;
			 
			  
			}
	
			if(!$temp_check){
				
				$error = true;
				$isValidTemplate = false;
				//echo $error_msg .= "SMS Text not matching with Approved Templates";
			}
		
		
		}
		
		
		

		// checking sendernames
		$sender_names_query = "SELECT sender_name from sender_names where user_id='$user_id' and sender_name='".trim($from)."'" ;
		$sender_names_rs = $mysqli->query($sender_names_query);
  		
		if($sender_names_rs->num_rows == 0)
		{
			$error = true;  
			$isValidSenderName = true;
 
		}

	
	}
	//sender names
	if($val['no_ndnc'] == 1 && $val['dnd_check'] == 0){  //Transactional SMPP
		 
		$sender = $from;
		$port_type="LT2"; $portTypeNAS= 'NAST2';	
	} elseif($val['no_ndnc'] == 0){  //Promo SMPP

	  $portTypeNAS= 'NASP2';	
		$sender = $from;
	$port_type="LP2";
	} else if($val['dnd_check'] == 1 && $val['no_ndnc'] == 1){  // semi Transactional SMPP
 $portTypeNAS= 'NASP2';	
        $sender = $from;
	$port_type="LS2";
    }
  
$port = $mysqli->query("select sending_port_no from sms_queue where application_priority='$port_type' order by queued asc limit 1");    
$portarr=$port->fetch_array();
$sms_port=$portarr['sending_port_no'];


 
    $job_id_rs = $mysqli->query("INSERT INTO  sms_api_job_ids(user_id,created_on) VALUES('".$user_id."', NOW()) ");    
    //$job_id_rs = $mysqli->query(" INSERT INTO  sms_api_job_ids SET user_id = '$user_id',  created_on = NOW() ");
    $job_id = $mysqli->insert_id;
    
    if($val['no_ndnc'] == 1 ) {
$checkSenderName = $mysqli->query("SELECT * FROM sender_names WHERE user_id = '".$user_id."' AND sender_name = '".trim($from)."' AND status = 1 ");
 
    if($checkSenderName->num_rows == 0) {  
	 $getNASPortNumber = $mysqli->query("SELECT sending_port_no FROM sms_queue WHERE application_priority = '$portTypeNAS'");
    		if($getNASPortNumber->num_rows > 0) {
    			$getNASPortNumberRes = $getNASPortNumber->fetch_array();  
    			$sms_port = $getNASPortNumberRes['sending_port_no'];
    		}    
    }  
} 



 //if($user_id == 5857 ) { $sms_port = '47213'; }
    
if($user_id==5020  ) { // APSRTC 
$sms_port ="46213"; }
   
   
if($user_id == 4453 ) {  
$sms_port ="34013"; }



if($user_id==647){ // STRIKER SUPPORT - OTP
	$senderName = trim($from);
	if($senderName == 'STRIKR' || $senderName == 'PWDOTP' || $senderName == 'OFCOTP') { 
		//$sms_port ="22213";
		$sms_port ="46013";    
	} // || $senderName == 'PASWRD'  
	
 
}     

if($sender=='MCFPVT'){ // Margadharsi
	$sms_port = "46413";
	
}
  
if($sender=='ABIBUS'){ // ABIBUS
	$sms_port ="47913";
	
}
 
 
    for($i=0;$i<count($mm);$i++) {
         $to=trim($mm[$i]);
	if( !ctype_alnum( $to ) ){
		 continue;
	} 
$error = FALSE;  
	/** Removing quotes and spaces **/
        $remove[] = "'";
	$remove[] = '"';
	//$remove[] = "-"; // just as another example

	$to = str_replace($remove, "", $to );
	 
        $to=trim($to);
if($user_id == '5482' || $user_id == '2917') {
	$Service_Areas = '';$zonecode = ''; $checkDuplicates = 0;
}else{
	$seriers = $mysqli->query("SELECT Circle as Service_Areas,Destination as zonecode FROM `new_series` where Destination_Code_Domestic_Format=substring($to,1,length(Destination_Code_Domestic_Format))"); 
	$seriersarr=$seriers->fetch_array();
	$Service_Areas=$seriersarr['Service_Areas'];   
	$zonecode=$seriersarr['zonecode'];  
}

 
		$isValidMobileNo=TRUE;
		$is_duplicate = 0;
		$numberlength=strlen(trim($to));
			if($numberlength==12)
				$to=substr($to,2);
			if($numberlength==11)
				$to=substr($to,1);
			if($numberlength==10)
				$to=$to;
			$numberlength=strlen(trim($to));
			if($numberlength != 10) 
			{
				//echo "invalid no:".$to;
				$invalid_nos_count++;	
				$error = TRUE;
				$isValidMobileNo=FALSE;
				//echo $error_msg .= "Invalid Number"; exit;
		
			}	
		
		$sender_names_query = "SELECT sender_name from sender_names where user_id='$user_id' and sender_name='".trim($from)."'" ;
		$sender_names_rs = $mysqli->query($sender_names_query);
		//echo $sender_names_rs->num_rows;
		//if($sender_names_rsv->num_rows == 0)
		if($sender_names_rs->num_rows == 0)
		{  
			$error = true;  
			$isValidSenderName = true;
			 //echo $error_msg .= "Invalid Sender Name "; exit;
		}
		
if($user_id==4668 || $user_id==4667){
	$error = false;
	$isValidSenderName=false;

}           
		$message=$mysqli->real_escape_string($message);
		if($no_of_messages<=$available_credits) 
		{
			if($error)
			{
				if(!$isValidMobileNo)
				{
				
				$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no,Service_Areas,zonecode) values('$user_id','$from','$message','$no_of_messages','$to',now(),'16','Invalid Number','$job_id','$sms_port','$Service_Areas','$zonecode')";
				
					$mysqli->query($query);
		    echo "{Job Id: $job_id, Ack: Invalid Number,mobileNo:$to}";exit;
				}else if($isValidSenderName)
				{  
				
				$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no,Service_Areas,zonecode) values('$user_id','$from','$message','$no_of_messages','$to',now(),'12','Not a valid Sender Name','$job_id','$sms_port','$Service_Areas','$zonecode')";
					$mysqli->query($query);
   echo "{Job Id: $job_id, Ack: Not a valid Sender Name,mobileNo:$to}";exit;
				} else if(!$isValidTemplate)
				{
				$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no,Service_Areas,zonecode) values('$user_id','$from','$message','$no_of_messages','$to',now(),'13','Not a valid Template','$job_id','$sms_port','$Service_Areas','$zonecode')";
				
					$mysqli->query($query);
   echo "{Job Id: $job_id, Ack: Not a valid Template,mobileNo:$to}";exit;
				}else if(!$send_api_sms)
				{
				
				$query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no,Service_Areas,zonecode)	values('$user_id','$from','$message','$no_of_messages','$to',now(),'5', 'Vendor Specific Error: Please contact your provider','$job_id','$sms_port','$Service_Areas','$zonecode')";

				
					$mysqli->query($query);	
					   echo "{Job Id: $job_id, Ack: Vendor Specific Error: Please contact your provider,mobileNo:$to}";			exit;
				}	
			$date= date('Y-m-d');
 
		//error_log($query."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/apistriker_".$date.".log"); 
//error_log($query."\r\n",3,"/var/www/vhosts/www.smsstriker.com/htdocs/api_log/striker_api_log/apistriker_".$date.".log");
			}
			else
			{
			    
			if($checkDuplicates == 1) {

				$text1 = $username.$message.$from.$to;
				$textmd5 = md5($text1);
				$checkContent = $mysqli->query("SELECT count(*) as duplicate FROM duplicatecheck_api WHERE md5text = '$textmd5'");
				$checkContentData = $checkContent->fetch_array();
				$is_duplicate = $checkContentData['duplicate'];
			}
			if($is_duplicate > 0){
				$error_text = "Duplicate Msg";
				$mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message','$no_of_messages','$to',now(),'16','$error_text','$job_id','$sms_port')");
				echo "{Job Id: $job_id, Ack: Duplicate Msg,mobileNo:$to}";  exit;
			} else{  

            //check is block listed number?
            $blockedNumberRes = $mysqli->query("SELECT count(*) as blocked FROM sms.block_listed_numbers WHERE user_id = '$user_id' AND mobile_no = '{$to}'");
            $blockedNumberRow = $blockedNumberRes->fetch_array();
            $is_block_listed = $blockedNumberRow['blocked'];
            if($is_block_listed > 0){
            
            $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no,Service_Areas,zonecode)
                        values('$user_id','$from','$message','$no_of_messages','$to',now(),'2','Block Listed Number','$job_id','$sms_port','$Service_Areas','$zonecode')";
                        
                $mysqli->query($query);
		$error = TRUE;
		  echo "{Job Id: $job_id, Ack: Block Listed Number,mobileNo:$to}";  exit;
            } else {
                if(!$val['no_ndnc']){  
                    //check for dnd number
                    $checkDndRes = $mysqli->query("SELECT count(*)  as dnd FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
                    $checkDndRow = $checkDndRes->fetch_array();
                    $isDND = $checkDndRow['dnd'];
                    if($isDND > 0){
                    
                    $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no,Service_Areas,zonecode)
                            values('$user_id','$from','$message','$no_of_messages','$to',now(),'3','DND Number','$job_id','$sms_port','$Service_Areas','$zonecode')";
                            
                        $mysqli->query($query);
		  echo "{Job Id: $job_id, Ack: DND Number,mobileNo:$to}"; exit;
                    } else {
			if($checkDuplicates == 1) {
		            	$text1=$username.$message.$from.$to;
				$textmd5=md5($text1);
				$mysqli->query("INSERT INTO `duplicatecheck_api`(`md5text`, `datetime`) VALUES ('$textmd5',NOW())"); 
			}
                    $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no,Service_Areas,zonecode)
                            values('$user_id','$from','$message','$no_of_messages','$to',now(),'$job_id','$sms_port','$Service_Areas','$zonecode')";
                            
                        $mysqli->query($query);
                        $smsId = $mysqli->insert_id;
                        if($user_id == 5482) {      
                      		$tempQuery = "insert into sms_api_bulk_messages (message_id,user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no,Service_Areas,zonecode,type) values('$smsId','$user_id','$from','$message','$no_of_messages','$to',now(),'$job_id','$sms_port','$Service_Areas','$zonecode','$type')"; 
  				$mysqli->query($tempQuery);
  			}else{
	   			$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to&text=".urlencode($message1);
		                if($type=="0"){
		                    $URL .="&mclass=0";
		                }
		                $URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/apidlr.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port");
			 	//error_log($URL."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/apistriker_".$date.".log"); 
		                http_send($URL, $sms_port);  
                        }
                    }
                } else {
                    $is_dnd_number = 0;
                    if($dnd_check){
                        //check for dnd number
                        $checkDndRes = $mysqli->query("SELECT count(*) as dndcount FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
                        $checkDndRow = $checkDndRes->fetch_array();
                        if($checkDndRow['dndcount'] > 0){
                            $is_dnd_number = 1;
                        }
                    }

                    if($is_dnd_number){
                    $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no,Service_Areas,zonecode)
                            values('$user_id','$from','$message','$no_of_messages','$to',now(),'3','DND Number','$job_id','$sms_port','$Service_Areas','$zonecode')";
                        $mysqli->query($query);
		echo "{Job Id: $job_id, Ack: DND Number,mobileNo:$to}"; exit;
                    } else {
			if($checkDuplicates == 1) {
				$text1=$username.$message.$from.$to;
				$textmd5=md5($text1);
				$mysqli->query("INSERT INTO `duplicatecheck_api`(`md5text`, `datetime`) VALUES ('$textmd5',NOW())"); 
			}
                    $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no,Service_Areas,zonecode)
                        values('$user_id','$from','$message','$no_of_messages','$to',now(),'$job_id','$sms_port','$Service_Areas','$zonecode')";
                        
                        $mysqli->query($query);
                        $smsId = $mysqli->insert_id;

  			if($user_id == 5482) {   
                      		$tempQuery = "insert into sms_api_bulk_messages (message_id,user_id,sender_name,message,noofmessages,to_mobileno,ondate,job_id,port_no,Service_Areas,zonecode,type) values('$smsId','$user_id','$from','$message','$no_of_messages','$to',now(),'$job_id','$sms_port','$Service_Areas','$zonecode','$type')"; 
  				$mysqli->query($tempQuery);
  			}else{
	   			$URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to&text=".urlencode($message1);
		                if($type=="0"){
		                    $URL .="&mclass=0";
		                }
		                $URL .= "&dlr-mask=19&dlr-url=".urlencode(SERVER_NAME."/apidlr.php?campaign_id=$smsId&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T&sms_port=$sms_port");
			// error_log($data."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/apistriker_".$date.".log"); 
		                http_send($URL, $sms_port);
				$data=$query."URL--".$URL ; 
			}
                    }
                }
		    echo "{Job Id: $job_id, Ack: Messages has been sent,mobileNo:$to}";
            }
            
		if(!$error) { 
          		  $balance = $available_credits - $no_of_messages;
				//$mysqli->query("insert into user_credits_log(before_campaign_credits,after_campaign_credits,current_campaign_credits, user_id,job_id) values('$available_credits','$balance','$no_of_messages','$user_id','$job_id')");
				
            $mysqli->query("update users set available_credits=available_credits-$no_of_messages where user_id='$user_id'");
            
            							$available_credits=$available_credits-$no_of_messages; 
				}

		        }  
		}
        $date= date('Y-m-d');
 

//error_log($query."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/apistriker_".$date.".log");

		}
		 else { // nofunds
		 
		 $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no,Service_Areas,zonecode)
                            values('$user_id','$from','$message','$no_of_messages','$to',now(),'11','Insufficient Balance','$job_id','$sms_port','$Service_Areas','$zonecode')";
                            
                            
            $mysqli->query($query);
            $date= date('Y-m-d'); 
		//error_log($query."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/apistriker_".$date.".log"); 
		echo "{Job Id: $job_id, Ack: Insufficient Credits}";
 
  
//error_log($query."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/apistriker_".$date.".log"); 
        }
  
    } //for  

    

}  

}
else { //user Authentication
    echo "Invalid User Details";

}

}else{

$data = json_encode($_REQUEST,true);
$datelog= date('Y-m-d');
//error_log($data."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/invalidsender".$datelog.".log");

echo "invalid sender ID please use six characters sender ID";
}
$mysqli->close();
?>

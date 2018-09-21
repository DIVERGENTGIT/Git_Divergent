<?php 
include("../dbconnect/config.php");  

$from=$_REQUEST['from'];
$to_mobiles=$_REQUEST['to'];
$type=$_REQUEST['type'];
$user_id=$_REQUEST['user_id'];
//$is_schedule=$_REQUEST['type'];
$scheduled_date=$_REQUEST['scheduled_date'];
$scheduled_time=$_REQUEST['scheduled_time'];
$scheduled_on=$scheduled_date.' '.$scheduled_time;


$dnd_check = 0;
if(isset($_REQUEST['dnd_check']) && $_REQUEST['dnd_check']){
    $dnd_check = $_REQUEST['dnd_check'];
}

$dlr_url=trim($_REQUEST['dlr_url']);
$custom_parameter=$_REQUEST['custom_parameter'];
$message=$_REQUEST['msg'];
$message=str_replace("\'","'",$message);
$message=str_replace('\"','"',$message);
$message_length=strlen($message);
if($message_length == 0){
    $message_length = 1;
}

// calculate SMS length
if($message_length>160)
	$no_of_messages_tmp=ceil($message_length/153);
else
	$no_of_messages_tmp=ceil($message_length/160);

$no_of_messages=$no_of_messages_tmp;  // changed on 26-12-2013 as per santosh request		
//$no_of_messages=ceil($message_length/160);

$mm=explode(",",$to_mobiles);


$rs=$mysqli->query("select user_id,available_credits,no_ndnc,dnd_check,template_check from users where user_id =$user_id");
 
if($rs->num_rows > 0)   
{
    $val= $rs->fetch_array();  
 
	
   // $user_id=$val[0];   
    $available_credits = $val[1];


	 //$createCampaign=$mysqli->query("INSERT INTO  sms_api_job_ids SET user_id = '$user_id',created_on = NOW(),is_scheduled =1,campaign_status=1,message='$message',noofmessages=$no_of_messages,scheduled_on='$scheduled_on',sender_name='$from' ");
          $createCampaign=$mysqli->query("INSERT INTO  sms_api_job_ids(user_id,created_on,is_scheduled,campaign_status,message,noofmessages,scheduled_on,sender_name) VALUES ('".$user_id."',NOW(),1,1,'".$message."','".$no_of_messages."','".$scheduled_on."','".$from."') ");
           // echo $user_id.' ## '.$message.' ## '.$no_of_messages. ' ## '.$scheduled_on. ' ## ' . $from;exit;  
  	  $job_id = $mysqli->insert_id;
 
	    for($i=0;$i<count($mm);$i++) 
		{
		
		$to=trim($mm[$i]);
		if($val['no_ndnc']==1){


	// checking sendernames
		$sender_names_query = "SELECT sender_name from sender_names where user_id='$user_id' and sender_name='".trim($from)."'" ;
		$sender_names_rs = $mysqli->query($sender_names_query);
		//mysql_num_rows($sender_names_rs);

		if($sender_names_rs->num_rows == 0)
		{
		$error = true;
		$isValidSenderName =true;
		$error_msg = "Invalid Sender Name ";
		

		}

		}
		if(strlen($to) != 10)
		{
		$error = true;
		
		$error_msg = "Invalid Mobile Number";
		

		}
		if($no_of_messages<=$available_credits) 
			{
				$message1=$mysqli->real_escape_string($message);
		    $mysqli->query("update users set available_credits=available_credits-$no_of_messages where user_id='$user_id'");
				 $insert_q="insert into schedule_api_campaigns_to SET job_id='$job_id',sms_text='$message',to_mobile_no='$to',sender_name='$from',created_on=now()";
				$mysqli->query($insert_q);
			
			

		}else if($isValidSenderName)
				{

				 $query="insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no) values('$user_id','$from','$message1','$no_of_messages','$to',now(),'12','Not a valid Sender Name','$job_id','$sms_port')";
					$mysqli->query($query);
					
				}elseif(strlen($to) != 10){
              			 $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,error_text,job_id,port_no)
                        values('$user_id','$from','$message1','$no_of_messages','$to',now(),'16','Invalid Number','$job_id','$sms_port')");
            }       else { // nofunds
		    $mysqli->query("insert into sms_api_messages(user_id,sender_name,message,noofmessages,to_mobileno,ondate,dlr_status,job_id,port_no)
		                    values('$user_id','$from','$message1','$no_of_messages','$to',now(),'11','$job_id','$sms_port')");
		}
	  if($error_msg){
  $results[]=array("JobId" =>$job_id, "toMobileno"=>$to,"Ack"=> $error_msg);
    }else{
  $results[]=array("JobId" =>$job_id, "toMobileno"=>$to,"Ack"=> "Messages has been sent");

    }
 
    } //for
     echo   json_encode($results); 
} else { //user Authentication
    echo "Invalid User Details";
}

$mysqli->close();
?>

<?php

include("dbconnect/config.php");  

function daysDifference($date1, $date2)
    {
        $month1 = substr($date1,5,2);
        $day1 = substr($date1,8,2);
        $year1 = substr($date1,0,4);

        $month2 = substr($date2,5,2);
        $day2 = substr($date2,8,2);
        $year2 = substr($date2,0,4);

        $date1 = mktime(0,0,0,$month1,$day1,$year1);
        $date2 = mktime(0,0,0,$month2,$day2,$year2);

        if($date1 > $date2){
            $dateDiff = $date1 - $date2;
        } else {
            $dateDiff = $date2 - $date1;
        }
        return $fullDays = floor($dateDiff/(60*60*24));
    }

$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$job_id = $_REQUEST['job_id'];

//check username
/*
if(!$db_link){
    $db_link=mysql_connect("localhost","root","myadmin") or die(mysql_error());
} else {
    $db_link=mysql_pconnect("localhost","root","myadmin") or die(mysql_error());
}
mysql_select_db("sms",$db_link) or die(mysql_error()); */

$rs= $mysqli->query("SELECT user_id
    FROM users
    WHERE username='".$username."' AND password='".md5($password)."'");
 


//echo $table_name;

$result = "{Job Id: $job_id, Report: ";
if($rs->num_rows > 0){	
    $val= $rs->fetch_array(MYSQLI_NUM);
    $user_id=$val[0];
	
	$getJIdQuery = $mysqli->query("SELECT created_on FROM sms_api_job_ids WHERE user_id='".$user_id."' and job_id = '{$job_id}'");
while($getJIdQuery_rs = $getJIdQuery->fetch_array(MYSQLI_ASSOC))
{
 $created_date = $getJIdQuery_rs['created_on'];
 $curdate = date('Y-m-d');
 $days_diff=daysDifference($curdate, $created_date);
 
 if($days_diff <= 1){
            $table_name = "sms.sms_api_messages";
 } else {
            $year = substr($created_date,0,4); 
            $month = substr($created_date,5,2);
            $table_name = "campaigns_backup.sms_api_messages_".$month.$year;
        }
}

$reportArr = array();

  $result .= "{";
    $getDLRQuery = $mysqli->query("SELECT to_mobileno, dlr_status, error_text FROM $table_name WHERE user_id=$user_id and  job_id = '{$job_id}'");
if($getDLRQuery->num_rows > 0){
        while($dlrRow = $getDLRQuery->fetch_array(MYSQLI_ASSOC)) {
	    $error_text="";
            $to_mob = $dlrRow['to_mobileno'];
            $error_code = $dlrRow['dlr_status'];
            $error_txt = $dlrRow['error_text'];

            if($error_code == 0 && $error_text == ""){
                $error_text = "Pending DLR";
            }

            if(strlen($to_mob) != 10){
                $error_text = "Invalid Mobile Number";
                $error_code = 16;
            } else {
                if($error_code == 1){
                    $error_text = "Delivered";
                } else if($error_code == 2) {
                    $error_text = "Failed - $error_txt";
                } else if($error_code == 3) {
                    $error_text = "DND Number";
                } else if($error_code == 4) {
                    $error_text = "Message Queued at SMSC";
                } else if($error_code == 16) {
                    $error_text = "Invalid Number";
                } else if($error_code == 11) {
                    $error_text = "Insufficient Funds";
                }
            }
            $result .= "$to_mob : {Dlr Code: $error_code, Dlr Text: $error_text}, ";
              
           array_push($reportArr,array('To'=>$to_mob,'Dlr Code'=>$error_code,'Dlr Text' =>$error_text ));
        }
    }
    $result .= "}";    
    
   
     if($user_id == '6111') { 
    	echo json_encode(array('Job Id' => $job_id,'Report' => $reportArr));
    }else{    
   	 echo $result;       
    } 
    
   
    
    
     //echo $result;
} else {   
    echo "Invalid User Details";
}

$mysqli->close();
?>

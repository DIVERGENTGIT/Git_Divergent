<?php 
include("../dbconnect/config.php");  
$username=$_REQUEST['username'];
$password=$_REQUEST['password'];
$sender=$_REQUEST['sender'];
$month=$_REQUEST['month'];
//echo $month;
//echo $password;


 $sq="select * from users where username='".$username."' and password='".$password."'";
 $rs= $mysqli->query($sq);
if($rs->num_rows > 0)
{
	while($val=$rs->fetch_array())
	{
	//print_r($val);
	$user_id=$val['user_id'];
	}
	
	//echo $user_id;
	//print_r($rs);
//	echo "select sender_name from sender_names where user_id='$user_id'	 and sender_name='$sender'";
	$rs1=$mysqli->query("select sender_name from sender_names where user_id='$user_id'	 and sender_name='$sender'");
	
	if($rs1->num_rows > 0)
	{		
	//echo "yes";
	while($res=$rs1->fetch_array()){
		//echo "done";
		//print_r($res);
			}
	
	//print_r($res);
	if(!$month)
	{
		
	
	$rs2=$mysqli->query("select sender_name,message,to_mobileno,error_text,ondate from sms_api_messages where user_id='$user_id' and sender_name='$sender'");
		}
		else{
			$rs2=$mysqli->query("select sender_name,message,to_mobileno,error_text,ondate from campaigns_backup.sms_api_messages_$month where user_id='$user_id' and sender_name='$sender'");
		}
	if($rs2->num_rows > 0)
	
	{
	     $filename = "senderwise_data" . date('Ymd') . ".xls";
         header("Content-Disposition: attachment; filename=\"$filename\"");
         header("Content-Type: application/vnd.ms-excel");
         $con="sender Name  \t  message  \t  mobile  \t  status \t ondate \t \n"; 
         echo $con;
 
  while($res1=$rs2->fetch_array(MYSQLI_ASSOC))
		{
			echo implode("\t", array_values($res1)) . "\r\n";
				}   
			exit;   
	}
	}
	else{
		echo "enter valid details sendername";
	}
	}	
else
{
	echo "Please enter valid user details";
	}
$mysqli->close();
	?>

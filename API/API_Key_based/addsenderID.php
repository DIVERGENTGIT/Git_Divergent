<?php 
include("../dbconnect/config.php");
$user_id=$_REQUEST['user_id'];
if(isset($_REQUEST['sender'])){
$sender=trim($_REQUEST['sender']);
}



if(isset($user_id) && isset($sender)){

$rs=$mysqli->query("select * from users where user_id =$user_id");
	
		$response=array();
		 $stmnt="select count(*) as cnt from sender_names where user_id='$user_id' and sender_name='$sender'";
		$sql_unique=$mysqli->query($stmnt);
		$row= $mysqli->fetch_array($sql_unique);
	  $cnt=	$row['cnt'];
	if($cnt==0)
		{


			$sql="INSERT INTO sender_names (user_id,sender_name,on_date) VALUES ('$user_id','$sender',NOW())";
			$sql_query=$mysqli->query($sql);

						print_r(json_encode(array('status'=>'Sender ID Added Successfully')));
		}
		else
		{
		    print_r(json_encode(array('status'=>'Sender ID Already Exist')));
		}
	}else{
	$respons["status"]="Required Parmeter Missing";
	echo json_encode($respons,true);

	}
?>


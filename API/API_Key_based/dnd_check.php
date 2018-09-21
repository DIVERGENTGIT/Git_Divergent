<?php 
include("../dbconnect/config.php");

/* Parameters */

$to_mobiles=$_REQUEST['to'];
$user_id=$_REQUEST['user_id'];
$mm=explode(",",$to_mobiles);

$rs= $mysqli->query("select user_id,available_credits,no_ndnc,dnd_check,template_check from users where user_id =$user_id");
if($rs->num_rows > 0){
    

for($i=0;$i<count($mm);$i++) {
	$to=trim($mm[$i]);
	if(strlen($to) == 10){
	     //check for dnd number
    $checkDndRes = $mysqli->query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to}'");
    $checkDndRow =$checkDndRes->fetch_array(MYSQLI_NUM);
    $isDND = $checkDndRow[0];
    if($isDND){
		echo "DND Number";
	} else {
        echo "Non DND Number";
            }
    } else{ 
		echo "Invalid Details";
	}	
	}
} 

else {
    echo "Invalid User Details";
}
$mysqli->close();
?>

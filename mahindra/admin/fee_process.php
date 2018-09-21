<?php
require_once("../db/config.php");
//date_default_timezone_set("Asia/Kolkata");
//$today = date("d-m-Y H:i:s");
 extract($_REQUEST);
 
 echo $prod_res="insert into  fee_receipt(`app_no`, `branch`,  `received_amount`, `from_name`, `towards`, `for_name`, `from_bank`, `branch_name`, `ddutrno`, `create_date`,`ddutrdate`,`currency_type`) values('$app_no','$branch','$receivedamount','$from_name','$towards','$For_Name','$from_bank','$branch_name','$ddutrno','$paiddate','$ddutrdate','$currency')"; 
 
/* echo $prod_res="insert into  fee_receipt(`roll_no`, `app_no`, `branch`, `installment`, `received_amount`, `from_name`, `towards`, `for_name`, `from_bank`, `branch_name`, `dd-utrno`, `create_date`) values('$roll_no','$app_no','$branch','$installment','$receivedamount','$from_name','$towards','$For_Name','$from_bank','$branch_name','$ddutrno','$paiddate')"; */
 
  $res=mysql_query($prod_res);  
$lastid=  mysql_insert_id();
$receptno=1000+$lastid;
  mysql_query("update fee_receipt set `roll_no`='$receptno'  where id='$lastid'");
  
   echo "<script>alert('Fee Payment Add successfully.');";	 
   echo "self.location='dispfee.php'"; 
   echo "</script>";
   exit();  
	
  
		
?>

<?php  
include('../../config/config.php');
	if($_REQUEST['did_no']!='')
	{
		$did_no=$_REQUEST['did_no'];
		$sql3="update  order_numbers set  status=2 where did_number='$did_no'";
		mysqli_query($link,$sql3);
	}
?>

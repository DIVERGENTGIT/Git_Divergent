<?php
session_start();
require_once("../db/config.php");


extract($_POST);  
$txtusername=$_REQUEST['txtusername'];
$txtpass=$_REQUEST['txtpass'];

   
    $adminlogin_sql="select * from tbl_adminlogin where username='$txtusername' and password='$txtpass'";
 
$result=mysql_query($adminlogin_sql);
$count=mysql_num_rows($result);


if($count==1){	 
	$_SESSION['ausername'] = $_REQUEST['txtusername'];
    //header("Location:homepage.php");
	echo "<script type='text/javascript'>
window.location='dispfee.php'
</script>";

}
else{
	//header("Location:index.php?msg=n");
	echo "<script type='text/javascript'>
window.location='index.php?msg=n'
</script>";
	 
}

?>

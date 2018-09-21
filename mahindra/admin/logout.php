<?php
/*session_start();
session_destroy();
header('Location: index.php');*/

session_start(); 
$id=$_SESSION['ausername'];
if (session_destroy()){
unset($id);
}

if($id=="")
{
//print_r($_SESSION);
header("Location: index.php");
exit();
}
?>

 
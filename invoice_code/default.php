<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Generating Report</title>
</head>
<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
<?php 
$red_score=@$_REQUEST['red_score']; //red
$blue_score=@$_REQUEST['blue_score'];//blue
$green_score=@$_REQUEST['green_score'];//green
$yellow_score=@$_REQUEST['yellow_score'];//yellow

$name=@$_REQUEST['name'];//name
$rdate=date('d-M-Y');//rdate

if($name!=""){
?>
<a href="http://localhost/finalpdf-generator/report.php?name=<?php echo $name;?>&red_score=<?php echo $red_score;?>&blue_score=<?php echo $blue_score;?>&green_score=<?php echo $green_score;?>&yellow_score=<?php echo $yellow_score;?>" target="_blank">Click here to save the report</a>
<?php } ?>
</body>
</html>

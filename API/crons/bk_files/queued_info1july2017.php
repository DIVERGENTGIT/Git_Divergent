<?php
$link=mysqli_connect("localhost","smsstrikerapp",'$tr!k3r@2009',"sms") or die(mysqli_error($link));

$rs=mysqli_query($link,"select distinct port_no from sms_queue ");
while($val=mysqli_fetch_array($rs))
{
  $port=$val[0];

  $cmd="lynx --dump http://localhost:".$port."/cgi-bin/status?password=ara111";
  $output=shell_exec($cmd);
  $a=explode("msgs",$output);
  $c=explode("(",trim($a[0]));
  $string=trim($c[count($c)-1]);
  $b=explode(",",$string);
  $queued=trim(str_replace("queued","",trim($b[count($b)-1])));
  $failed=trim(str_replace("failed","",trim($b[count($b)-2])));
  $sent_=trim(str_replace("sent","",trim($b[count($b)-3])));
  $d=explode(" ",trim($b[count($b)-3]));
  $sent=trim($d[2]);
  $e=explode(" ",trim($b[count($b)-4]));
  $received=trim($e[count($e)-1]);
  $online=trim(str_replace("online","",trim($b[count($b)-5])));
  
 mysqli_query($link,"update sms_queue set queued='$queued',failed='$failed',sent='$sent_',received='$received',online='$online' where port_no='$port'") or die(mysqli_error());
  	

 
 
  	
 
}



$link2=mysqli_connect("localhost","pointsmsapp",'po!nt$m$@2009',"sms_reseller") or die(mysqli_error());
$rs2=mysqli_query($link2,"select distinct port_no from sms_queue ");
while($val=mysqli_fetch_array($rs2))
{

  	
$port=$val[0];

  $cmd="lynx --dump http://localhost:".$port."/cgi-bin/status?password=ara111";
  $output=shell_exec($cmd);
  $a=explode("msgs",$output);
  $c=explode("(",trim($a[0]));
  $string=trim($c[count($c)-1]);
  $b=explode(",",$string);
  $queued=trim(str_replace("queued","",trim($b[count($b)-1])));
  $failed=trim(str_replace("failed","",trim($b[count($b)-2])));
  $sent_=trim(str_replace("sent","",trim($b[count($b)-3])));
  $d=explode(" ",trim($b[count($b)-3]));
  $sent=trim($d[2]);
  $e=explode(" ",trim($b[count($b)-4]));
  $received=trim($e[count($e)-1]);
  $online=trim(str_replace("online","",trim($b[count($b)-5])));
  
  mysqli_query($link2,"update sms_queue set queued='$queued',failed='$failed',sent='$sent_',received='$received',online='$online' where port_no='$port'") or die(mysqli_error($link2));
}
  	mysqli_close($link);	
  	mysqli_close($link2);
?>

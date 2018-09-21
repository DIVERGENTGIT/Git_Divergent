<?php
$link=mysql_pconnect("localhost","root","myadmin") or die(mysql_error());
mysql_select_db("sms",$link);
$rs=mysql_query("select distinct port_no from sms_queue");
while($val=mysql_fetch_array($rs))
{
  $port=$val[0];
  $cmd="lynx --dump http://localhost:".$port."/status?password=bar";
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
  
  mysql_query("update sms_queue set queued='$queued',failed='$failed',sent='$sent_',received='$received',online='$online' where port_no='$port'") 
  	or die(mysql_error());
 echo "update sms_reseller.sms_queue set queued='$queued',failed='$failed',sent='$sent_',received='$received',online='$online' where port_no='$port'"; 	
  mysql_query("update sms_reseller.sms_queue set queued='$queued',failed='$failed',sent='$sent_',received='$received',online='$online' where port_no='$port'") 
  	or die(mysql_error());	
 
}
mysql_close($link);
?>

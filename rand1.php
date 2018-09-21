<?php

$db_link=mysql_connect("localhost","root","myadmin") or die(mysql_error());

mysql_select_db("sms",$db_link) or die(mysql_error());

   for($i=0;$i<1000;$i++)
   {
       $randstring=rand(100000,999999);
      // echo $randstring;
     mysql_query("insert into CARE_PWDS set PWD='$randstring'");
     
    // echo "insert into CARE_PWDS ('PWD'=$randstring)";

   }
   //return $randstring;



?>
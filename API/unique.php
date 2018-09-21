<?php 


$test=shell_exec("sudo /bin/ls /var/www/html/strikerapp/uploads/test.xlsx | xargs sudo /usr/bin/unoconv -f csv 2>&1");
//$test=exec("sudo /bin/ls /var/www/html/strikerapp/uploads/test.xlsx | xargs sudo /usr/bin/unoconv -f csv 2>&1") or die("not working");
//$test=exec("libreoffice --headless --convert-to csv /var/www/html/strikerapp/uploads/test.xlsx --outdir /var/www/html/strikerapp/uploads/ 2>&1");

echo $test;


?>



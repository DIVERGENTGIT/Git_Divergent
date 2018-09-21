<?php
/**** redirect to Login 
@name redirect_login
@author Rushyendra
***/
function redirect_login($user_id)
{
	if(!$user_id)            
        	redirect('login');
}
/**
*@name error_handlers
*@author Rushyendra
*/
function error_handlers($errno, $errstr, $errfile, $errline)
{
//$logfilename = "/var/www/html/sms/logs/file_log.log";
$logfilename = FILEPATH."uploads/file_log.log";

   
  if(isset($errno))
error_log(" \nError: ". $errno." ". $errstr." Fatal Error is occured on". $errline,3,$logfilename);
    
    /* Don't execute PHP internal error handler */
    return true;
}
/***
*@name fatal_error_handlers
*@author Rushyendra
*/
function fatal_error_handlers()
{
//$logfilename = "/var/www/html/sms/logs/file_log.log";
$logfilename = FILEPATH."application/logs/file_log.log";
	  $last_error =  error_get_last();
          $error_type = (isset($last_error['type']))?$last_error['type']: "";
	   $error_msg = (isset($last_error['message']))?$last_error['message']: "";
               if($error_msg != "")  
		error_log(" <br/> \n Error:". $error_type." : ".$error_msg,3,$logfilename);
		

}
/**
*@name disp_error_log
*@author Rushyendra
*/
function disp_error_log($msg)
{
  /*$duration = '';	
  if($end !== '' && $start !== '')
  	$duration = abs($end - $start);	
  $logfilename = "/var/www/html/sms/logs/time_log.log";
  
  error_log("\n".$msg." ".$duration,3, $logfilename);*/
	
  //$logfilename = "/var/www/html/sms/logs/time_log.log";
 //  $logfilename = FILEPATH."logs/time_log.log";
  $logfilename = FILEPATH."application/logs/time_log.log";	
  
  error_log("\n".$msg,3, $logfilename);
}
?>

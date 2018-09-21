<?php

	session_start();
 
	session_destroy(); 
unset($_session['username']);
unset($_session['user_id']);
 
	 header('location:https://www.smsstriker.com/login.html');

?>

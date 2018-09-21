<?php
header("Access-Control-Request-Origin: *");

	$localhost = "localhost";
	$user_name = "strikerapp"; 
	$user_pwd = 'Off!c3@v2017';

	$db_connect = mysql_connect($localhost,$user_name,$user_pwd);
//print_r($db_connect);

	if (!$db_connect)
  	{
  		die("Error in database connection." );
  	}

	$select_db = mysql_select_db("shorturl_db",$db_connect);

	if (!$select_db)
  	{
  		die("Error in database select. ");
  	}

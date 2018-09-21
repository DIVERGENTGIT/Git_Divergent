<?php
 header('Access-Control-Allow-Origin: *');  

include "database.php";

	if(isset($_POST['get_shorturl']) && isset($_POST['user_url']))
	{
		$url = $_POST['user_url'];		
		$short_code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);

		date_default_timezone_set('asia/kolkata');
		$current_date = DATE('Y-m-d');
		
			$user_id=$_POST['user_id'];
		$query = mysql_query("insert into short_urls(long_url,short_code,date_created,user_id) values('$url','$short_code','$current_date',$user_id)");
		if(mysql_insert_id() != 0)
		{
			header('Content-type: application/json');
 			echo json_encode($short_code);
		}
		else
		{
			return 0;
		}
		
		
	}

?>

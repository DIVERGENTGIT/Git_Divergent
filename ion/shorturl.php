<?php
include "database.php";
class shorturl
{
	function generate_shortcode($url)
	{
		$short_code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);

		date_default_timezone_set('asia/kolkata');
		$current_date = DATE('Y-m-d');
		
		$query = mysql_query("insert into short_urls(long_url,short_code,date_created) values('$url','$short_code','$current_date')");
		if(mysql_insert_id() != 0)
		{
			return $short_code;
		}
		else
		{
			return 0;
		}
	}
}
?>

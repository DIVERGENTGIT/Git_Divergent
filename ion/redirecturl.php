<?php 
ob_start();
include "database.php";

  echo  "<pre>";
      
     print_r($_SERVER);
      
            
    echo  "<pre>";
     
       $str=$_SERVER['HTTP_USER_AGENT'];
      
      
     
      $operatingsystem=substr($str,13,17);
      $operating_system= str_replace(";"," ",$operatingsystem);
      
       $build_by='';
      if($str1=explode(";",$str))
      {

      if(!isset($str1[2])){
            $build_by=substr($str1[1],0,17);
      }else{
      $build_by=substr($str1[2],0,17);
      }
     
      }


	/*$url = $_SERVER['REQUEST_URI'];
	$val = explode("/",$url);
	$short_code = $val['1']; live url*/
	$url = $_SERVER['REQUEST_URI'];
	$val = explode("/",$url);
	$short_code = $val['2'];

	$query = mysql_query("select * from short_urls where short_code = '$short_code'");
	$result = mysql_fetch_array($query);
	echo "select * from short_urls where short_code = '$short_code'";

	if(mysql_num_rows($query) > 0)
	{	
		$count = $result['counter'] + 1;
		$sql = mysql_query("update short_urls set counter=' $count' where id='".$result['id']."' AND short_code = '$short_code'");
		
		
	// ********* insert ip dt bt **********************

	$tablet_browser=0;
	$mobile_browser=0;
	if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
	    $tablet_browser++;
	}
	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
	    $mobile_browser++;
	}
	if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
	    $mobile_browser++;
	}
	 $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
	$mobile_agents = array(
	    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
	    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
	    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
	    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
	    'newt','noki','palm','pana','pant','phil','play','port','prox',
	    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
	    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
	    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
	    'wapr','webc','winw','winw','xda ','xda-');
	if (in_array($mobile_ua,$mobile_agents)) {
	    $mobile_browser++;
	}
	if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
	    $mobile_browser++;
	    //Check for tablets on opera mini alternative headers
	    $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
	    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
		$tablet_browser++;
	    }
	}
	if ($tablet_browser > 0) {
	   // do something for tablet devices

	    $devicetype= 'tablet';
	}
	else if ($mobile_browser > 0) {
	   // do something for mobile devices

	    $devicetype= 'mobile';
	}
	else {
	   // do something for everything else
	 
	    $devicetype=  'desktop';
	}   

	//echo  $devicetype;

	function getBrowser($devicetype) 
	{ 
	    $u_agent = $_SERVER['HTTP_USER_AGENT']; 
	    $bname = 'Unknown';
	    $platform = 'Unknown';
	    $version= "";

	    //First get the platform?
	    if (preg_match('/linux/i', $u_agent)) {
		  $platform = 'linux';
	    }
	    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
		  $platform = 'mac';
	    }
	    elseif (preg_match('/windows|win32/i', $u_agent)) {
		  $platform = 'windows';
	    }
	    
	    // Next get the name of the useragent yes seperately and for good reason
	    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
	    { 
		  $bname = 'Internet Explorer'; 
		  $ub = "MSIE"; 
	    } 
	    elseif(preg_match('/Firefox/i',$u_agent)) 
	    { 
		  $bname = 'Mozilla Firefox'; 
		  $ub = "Firefox"; 
	    } 
	    elseif(preg_match('/Chrome/i',$u_agent)) 
	    { 
		  $bname = 'Google Chrome'; 
		  $ub = "Chrome"; 
	    } 
	    elseif(preg_match('/Safari/i',$u_agent)) 
	    { 
		  $bname = 'Apple Safari'; 
		  $ub = "Safari"; 
	    } 
	    elseif(preg_match('/Opera/i',$u_agent)) 
	    { 
		  $bname = 'Opera'; 
		  $ub = "Opera"; 
	    } 
	    elseif(preg_match('/Netscape/i',$u_agent)) 
	    { 
		  $bname = 'Netscape'; 
		  $ub = "Netscape"; 
	    } 
	    
	    // finally get the correct version number
	    $known = array('Version', $ub, 'other');
	    $pattern = '#(?<browser>' . join('|', $known) .
	    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
	    if (!preg_match_all($pattern, $u_agent, $matches)) {
		  // we have no matching number just continue
	    }
	    
	    // see how many we have
	    $i = count($matches['browser']);
	    if ($i != 1) {
		  //we will have two since we are not using 'other' argument yet
		  //see if version is before or after the name
		  if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
		      $version= $matches['version'][0];
		  }
		  else {
		      $version= $matches['version'][1];
		  }
	    }
	    else {
		  $version= $matches['version'][0];
	    }
	    
	    // check if we have a number
	    if ($version==null || $version=="") {$version="?";}
	    
	    return array(
		  'userAgent' => $u_agent,
		  'name'      => $bname,
		  'version'   => $version,
		  'platform'  => $platform,
		  'pattern'    => $pattern,
		  'IpAddress' =>$_SERVER['REMOTE_ADDR'],
		  'systemType' => $devicetype
	    );
	} 

	// now try it
	$ua=getBrowser($devicetype);
	//echo "<pre>";
	//print_r($ua);

	//print_r($_SERVER);

	//echo "<pre>";
	//$yourbrowser=  $ua['name'] . " " . $ua['version'] ;

	 $yourbrowser=  $ua['name'];
	 
	$ip_address = $_SERVER['REMOTE_ADDR']; 
	//$short_url = $_SERVER['SCRIPT_NAME']; 
	
		 $sql="INSERT INTO `shorturl_db`.`shorturl_table_info` (
	`id` ,
	`ip_address` ,
	`device_type` ,
	`browser_type` ,
	`short_url` ,
	`operating_system` ,
	`build_by` ,
	`created_on`
	)
	VALUES (
	NULL , '$ip_address', '$devicetype', '$yourbrowser', '$short_code','$operating_system','$build_by', NOW( )
	);
	";
	
	if (mysql_query($sql) === TRUE) {
	    echo "Inserted successfully";
	} else {
	    echo "Inserting fail: " . $conn->error;
	}
	
	

// ********* insert it dt bt **********************

		if(mysql_affected_rows() > 0)
		{
			if(stristr($result['long_url'],'http'))
			{
			

				if(stristr($result['long_url'],'dynamicform'))
				{
					header("LOCATION:".$result['long_url']."/".$short_code);
				}else
				{
					header("LOCATION:".$result['long_url']);
				}
			
			
				
			}
			else
			{
			
				if(stristr("http://".$result['long_url'],'dynamicform'))
				{
										
					header("LOCATION: http://".$result['long_url']."/".$short_code);
				}else
				{
					header("LOCATION: http://".$result['long_url']);
				}
			
				
			}
		}
	}
ob_flush();	
?>

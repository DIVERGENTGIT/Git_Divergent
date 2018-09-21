<?php
include "database.php";


if (!isset($_SERVER['HTTP_ORIGIN'])) {
    // This is not cross-domain request
    exit;
}

$wildcard = FALSE; // Set $wildcard to TRUE if you do not plan to check or limit the domains
$credentials = FALSE; // Set $credentials to TRUE if expects credential requests (Cookies, Authentication, SSL certificates)
$allowedOrigins = array('http://www.smsstriker.com', 'http://www.strikersoft.in/ion/','http://ion.bz');
if (!in_array($_SERVER['HTTP_ORIGIN'], $allowedOrigins) && !$wildcard) {
    // Origin is not allowed
    exit;
}
$origin = $wildcard && !$credentials ? '*' : $_SERVER['HTTP_ORIGIN'];

header("Access-Control-Allow-Origin: " . $origin);
if ($credentials) {
    header("Access-Control-Allow-Credentials: true");
}
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Origin");
header('P3P: CP="CAO PSA OUR"'); // Makes IE to support cookies
	if(isset($_REQUEST['get_shorturl']) && isset($_REQUEST['user_url']))
	{
	
	  	$str=$_SERVER['HTTP_USER_AGENT'];

      $operatingsystem=substr($str,13,17);
      $operating_system= str_replace(";"," ",$operatingsystem);
      $build_by='';
      if($str1=explode(";",$str))
      {
      
      $build_by=substr($str1[2],0,17);
     
      }
      
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


		$ua=getBrowser($devicetype);
		$yourbrowser=  $ua['name'];

		if($ip_address='10.10.10.*')
		{
				$ip_address='182.18.163.215';
		}else{
					$ip_address = $_SERVER['REMOTE_ADDR']; 
		}
		$url = $_REQUEST['user_url'];		
		$short_code = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyz"), 0, 7);

		date_default_timezone_set('asia/kolkata');
		$current_date = DATE('Y-m-d');
		$user_id=$_REQUEST['user_id'];
				
		$query = mysql_query("insert into short_urls(long_url,user_id,short_code,date_created) 
		values('$url','$user_id','$short_code','$current_date')");
		if(mysql_insert_id() != 0)
		{

				$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip_address));
				if($query && $query['status'] == 'success')
				{
				     $city= $query['city'];
				}
 			$current_date_time = DATE('Y-m-d h:m:s');
 		$resultarr=array("operatingsystem"=>$operatingsystem,"browserdetail"=>$yourbrowser,"devicetype"=>$devicetype,"build_by"=>$build_by,
 		"short_code"=>$short_code,"city"=>$city,"date"=>$current_date_time);
		echo json_encode($resultarr) ;

 	 	
		}
		else
		{
			return 0;
		}
		

	
	}
	

?>

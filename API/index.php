<?php




require '../config/database.php'; 

/**
 * Step 1: Require the Slim Framework using Composer's autoloader
 *
 * If you are not using Composer, you need to load Slim Framework with your own
 * PSR-4 autoloader.
 */

 
require 'vendor/autoload.php';
  
$c = ['settings' => [
    'addContentLengthHeader' => false,
]];

$c = new \Slim\Container(); //Create Your container
$app = new \Slim\App($c);

global $link;
$db = $link;  

$app->get('/', function ($request, $response, $args) { 
    $response->write("Welcome to Slim framework....!"); 
    return $response;              
});         



$app->any('/{segment1}/{segment2}', function ($request, $response, $args) 
{
global $db;

$Method = $args['segment1'];
$apikey= $args['segment2'];
$getkey=explode("=",$apikey);
$api_key=$getkey[0];
$api_key_value=$getkey[1];
$Args_Ary = $request->getParams();
 
$apimethodarr=array('single','xml','bulk','multimsgs','getdlr','getbal','dndcheck','scheduledsms','getdlrcount','addsender','getsenders');
if($api_key=='api_key' && in_array($Method,$apimethodarr))
{
//$url="http://".$_SERVER['HTTP_HOST']."/API/index.php/".$Method."/".$apikey


$query = $db->query("SELECT count(*) as cnt,user_id FROM `api_keys` WHERE `user_keys` LIKE '%$api_key_value%'");  
$rw=$query->fetch_array();
 if($rw['cnt']>0){
 $user_id=$rw['user_id'];

/*$usrquery = $db->query("SELECT username,password FROM `users` where user_id = $user_id");  
$usrdata=$usrquery->fetch_array(MYSQLI_ASSOC);
$username=$usrdata['username'];
$password=$usrdata['password'];*/
$usrarr=array("user_id"=>$user_id);
$Request_Args_Ary=(array_merge($usrarr,$Args_Ary));

}else{

$statusCode = 501;
$statusMessage = 'Invalid User Key';
return $json_encode =  json_encode(array('statusCode' => $statusCode,'statusMessage' => $statusMessage));
$c['response']->withStatus(404)->withHeader('Content-Type', 'text/html')->write($json_encode);
}
//print_r($rw);
switch($Method){

case 'single' :
$url="http://".$_SERVER['HTTP_HOST']."/API/API_Key_based/sms.php";
  $final = $url . "?" . http_build_query($Request_Args_Ary);
 echo sendsms($final);
break;


case 'bulk' :
$url="http://".$_SERVER['HTTP_HOST']."/API/API_Key_based/sms.php";
 $final = $url . "?" . http_build_query($Request_Args_Ary);
 echo sendsms($final);
break;

case 'multimsgs' :
$url="http://".$_SERVER['HTTP_HOST']."/API/API_Key_based/multi_messages.php";
 $final = $url . "?" . http_build_query($Request_Args_Ary);
 echo sendsms($final);
break;

case 'xml' :
$url="http://".$_SERVER['HTTP_HOST']."/API/API_Key_based/xmlapi.php";
 $final = $url . "?" . http_build_query($Request_Args_Ary);
 echo sendsms($final);
break;
case 'getdlr' :
$url="http://".$_SERVER['HTTP_HOST']."/API/API_Key_based/get_dlr_status.php";
 $final = $url . "?" . http_build_query($Request_Args_Ary);
 echo sendsms($final);
break;

case 'getbal' :
$url="http://".$_SERVER['HTTP_HOST']."/API/API_Key_based/get_balance.php";
 $final = $url . "?" . http_build_query($Request_Args_Ary);
 echo sendsms($final);
break;
case 'dndcheck' :
$url="http://".$_SERVER['HTTP_HOST']."/API/API_Key_based/dnd_check.php";
 $final = $url . "?" . http_build_query($Request_Args_Ary);
 echo sendsms($final);
break;
case 'scheduledsms' :
$url="http://".$_SERVER['HTTP_HOST']."/API/API_Key_based/scheduled_sms.php";
 $final = $url . "?" . http_build_query($Request_Args_Ary);
 echo sendsms($final);
break;
case 'getdlrcount' :
$url="http://".$_SERVER['HTTP_HOST']."/API/API/get_dlr_status_count.php";
 $final = $url . "?" . http_build_query($Request_Args_Ary);
 echo sendsms($final);

break;
case 'addsender' :
$url="http://".$_SERVER['HTTP_HOST']."/API/API_Key_based/addsenderID.php";
 $final = $url . "?" . http_build_query($Request_Args_Ary);
 echo sendsms($final);

break;

case 'getsenders' :
$url="http://".$_SERVER['HTTP_HOST']."/API/API_Key_based/getsenders.php";
 $final = $url . "?" . http_build_query($Request_Args_Ary);
 echo sendsms($final);

break;




}





}else{
$statusCode = 501;
$statusMessage = 'Invalid method!. or API KEY';
return $json_encode =  json_encode(array('statusCode' => $statusCode,'statusMessage' => $statusMessage));
$c['response']->withStatus(404)->withHeader('Content-Type', 'text/html')->write($json_encode);
}
	}); 


/** Handling 404 error **/
$c['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
		$statusCode = 404;
		$statusMessage = 'Page not found!.';
		$json_encode =  json_encode(array('statusCode' => $statusCode,'statusMessage' => $statusMessage));
        	return $c['response']->withStatus(404)->withHeader('Content-Type', 'text/html')->write($json_encode);
    };
}; 


/** Handling 405 error **/
$c['notAllowedHandler'] = function ($c) {
    return function ($request, $response, $methods) use ($c) {
		$statusCode = 405;
		$statusMessage = 'Method must be one of: ' . implode(', ', $methods);
		$json_encode =  json_encode(array('statusCode' => $statusCode,'statusMessage' => $statusMessage));
        	return $c['response']->withStatus(405)->withHeader('Allow', implode(', ', $methods))->withHeader('Content-type', 'text/html')->write($json_encode);
    };   
};


/** Handling 500 error **/
$c['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
		$statusCode = 500;
		$statusMessage = 'Something went wrong!.';
		$json_encode =  json_encode(array('statusCode' => $statusCode,'statusMessage' => $statusMessage));
	        return $c['response']->withStatus(500)->withHeader('Content-Type', 'text/html')->write($json_encode);   
    };
};     
 function sendsms($url)
{ 

       return file_get_contents($url);
}

$app->run();




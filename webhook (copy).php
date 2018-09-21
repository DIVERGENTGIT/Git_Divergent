<?php
 
 echo $inputJSON = file_get_contents("php://input");

 $input = json_decode($inputJSON, true);
$prar="<pre>".$input."</pre>";
error_log($input."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/awss.log");
error_log($prar."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/awsRES.log");
/*
$challenge = $_REQUEST['hub_challenge'];
 $mode = $_REQUEST['hub_mode'];
 $verify_token = $_REQUEST['hub_verify_token'];
 
$token ='4c999fe4f3c0cd5a17d091d0459b5110'; 
 
if($token == $verify_token) {
	echo  ($challenge);
}  
  
   
*/

 
?>
 <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 <script src="https://connect.facebook.net/en_US/sdk.js"></script>
<script>
FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
    // the user is logged in and has authenticated your
    // app, and response.authResponse supplies
    // the user's ID, a valid access token, a signed
    // request, and the time the access token 
    // and signed request each expire
    var uid = response.authResponse.userID;
    var accessToken = response.authResponse.accessToken;
    console.log(uid+','+accessToken);
  } else if (response.status === 'not_authorized') {
    // the user is logged in to Facebook, 
    // but has not authenticated your app
  } else {
    // the user isn't logged in to Facebook.
  }
 });
 </script> -->
 
<!--

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php
$challenge = $_REQUEST['hub_challenge'];
 //$verify_token = $_REQUEST['hub_verify_token'];
 $verify_token = $_REQUEST['hub_verify_token'];
if ($verify_token === 'sandeepthi') {
  echo $challenge;

}

//mysql_connect("localhost","fcm","Fcm@4321");
//mysql_select_db("fcm");
 

 
$inputJSON = file_get_contents('php://input');
 $input = json_decode($inputJSON, true);
 $data = json_decode($_REQUEST, true);
error_log($data."\r\n",3,"/var/www/html/strikerapp/api_log/striker_api_log/fb.log");

$page_id = $input['entry'][0]['changes'][0]['value']['page_id'];
$field = $input['entry'][0]['changes'][0]['value']['field'];
$leadgen_id = $input['entry'][0]['changes'][0]['value']['leadgen_id'];
$form_id = $input['entry'][0]['changes'][0]['value']['form_id'];




 

$token="EAACEdEose0cBAHxtJIh4Lm3ntTxKppwU01wc84rg0NlQgW5ZCWx4B3n0cLsSg0gV9WfTzWLmbqPsZAsZCOpmiBnSLHzRkt7l8ilLuGUpOqAPp9ZCyCzZCr56svIAYxFzmhZBG4C2yWaGYWnFc8RI2tlxRYkdvE7Vnw34SGEEMZA1b0ZBvcZBamVFrrccpZBYZCqhSmZBTSXGPt4ofAZDZD";

 $url="https://graph.facebook.com/v2.8/$leadgen_id?access_token=$token";
 /* 
 $url="https://graph.facebook.com/v2.5/$leadgen_id?access_token=CAAH5Co09BGIBACfEbZANdv95ewJbvFlBbB11OveDJPj7A8PIDWaHyrS9XsEI4N9P3D2mwz405XZBM089wviPEG55TDMhd5KXC2F5OVjtyjz6UlqTMoSvgt2QTVZANWmZAkgNtKJrpvTCbimrEGFOzZBfEPNGKuqVoZBEgyrlDZCxFDx0sdbhBi99khzn1AWZCxwZD";*/

  $leads = file_get_contents($url);
$objson = json_decode($leads, true);

 foreach($objson as $row) {
	if(is_array($row))
	{

		
		foreach($row as $lead =>$val)
		{
			
			//error_log(print_r($row,true));

			$name= $val['name'];
		
			 
			 switch($name)
			 {
				 case 'email' :
					 $email= $val['values'][0];
				 break;
				  case 'full_name' :
				  echo	 $full_name= $val['values'][0];
				  break;
				    case 'phone_number' :
						 $phone_number= $val['values'][0];
				  break;
				    case 'work_email' :
						 $work_email= $val['values'][0];
					
					break;
				    case 'city' :
					  	 $city= $val['values'][0];
				  break;
			 }
			 
			
		}
			

		}
		else
		{
			$date_lead_id .= $row.",";
		
			
		}
	
	
}

$d_l=explode(",",$date_lead_id);
$leaddate=$d_l[0];
$lead_id=$d_l[1];
if($lead_id){

 $rawdataquery = "INSERT INTO `lead_create` (`lead_id`,`created_time`, `name`,`phone`,`email`,`work_email`, `city`, `create_on`) VALUES ('$lead_id','$leaddate','$full_name', '$phone_number', '$email','$work_email', '$city',NOW())";
//mysql_query($rawdataquery);

	//$key="8f0414cf-d525-11e5-8e1c-001e67193c7d";
	//$mobile= strright($phone_number,10);
   // $result=call_crux_api($key,$full_name,$mobile,$email,$lead_id);  
//error_log($result);
}


function strright($rightstring, $length) {
  return(substr($rightstring, -$length));
}


/*
      function call_crux_api($key,$full_name,$mobile,$email,$lead_id)
	  {  
		
        $api = "http://vapi.cruxdigital.in/?src=php_cf&";
        $api .= "key=$key&";
        $api .= "cname=".urlencode($full_name)."&";
        $api .= "contact=".urlencode($mobile)."&";
        $api .= "email=".urlencode($email)."&";
        $api .= "id=".$lead_id;
        return file_get_contents($api);
		

		
}*/
?>
-->
 

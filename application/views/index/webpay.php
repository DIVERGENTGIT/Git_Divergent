<?php 
session_start();

error_reporting(0);
if(isset($_POST['send']))
{
if(empty($_POST['name'])||empty($_POST['cname'])||empty($_POST['customerid'])||empty($_POST['mobile'])||empty($_POST['email'])||empty($_POST['address1'])||empty($_POST['address2'])||empty($_POST['address3'])||empty($_POST['state'])||empty($_POST['city'])||empty($_POST['zip'])) {
					  // collect all input and trim to remove leading and trailing whitespaces
					$name = trim($_POST['name']);
					$cmpname = trim($_POST['cname']);
					$customerid = trim($_POST['customerid']);
					$mobile = trim($_POST['mobile']);
					$email = trim($_POST['email']);
					$address1 = trim($_POST['address1']);
					$address2 = trim($_POST['address2']);
					$address3 = trim($_POST['address3']);
					$state = trim($_POST['state']);
					$city = trim($_POST['city']);
					$zip = trim($_POST['zip']);
					
					
					
					if (strlen($state) == 0)
					  {
					$errorsstate="<p class='output'>Please enter state </p>";
					  }
					  if (strlen($city) == 0)
					  {
					  $errorscity="<p class='output'>Please enter City </p>";
					  }
					
					 
					  if (strlen($name) == 0)
					  {
					  $errorsname="<p class='output'>Please enter your name </p>";
					  }
					
					 if (strlen($cmpname) == 0)
					  {
					  $cmpnameerrors="<p class='output'>Please enter your Company Name </p>";
					  }
					
					
					
					if(empty($customerid)) {
					$customeriderrors = '<p class="output"> Please enter your User  ID</p>';
					} /*elseif(strlen($customerid) != 6) {
					$customeriderrors = '<p class="output"> The User ID should be 6 characters </p>';
					}*/
					
					
					
					if(empty($zip)) {
					$errorzip = '<p class="output"> Please enter Zip Code</p>';
					} else if(!is_numeric($zip)) {
					$errorzip = '<p class="output"> Data entered was not numeric</p>';
					} elseif(strlen($zip) != 6) {
					$errorzip = '<p class="output"> The Zip Code should be 6 digits </p>';
					}
					  
					  
					if(empty($mobile)) {
					$errorsmobile = '<p class="output"> Please enter a mobile value</p>';
					} else if(!is_numeric($mobile)) {
					$errorsmobile = '<p class="output"> Data entered was not numeric</p>';
					} else if(strlen($mobile) != 10) {
					$errorsmobile = '<p class="output"> The number entered was not 10 digits long</p>';
					}
					
					if (strlen($address1) == 0)
					{
					$errorsaddress1="<p class='output'>Please enter your Address Line1 </p>";
					}
					  
					if (strlen($address2) == 0)
					{
					$errorsaddress2="<p class='output'>Please enter your Address Line2 </p>";
					}
					  
					if (strlen($address3) == 0)
					{
					$errorsaddress3="<p class='output'>Please enter your Address Line3 </p>";
					}
					  
					if(empty($mobile)) {
						$errorsmobile = '<p class="output"> Please enter a mobile value</p>';
					} else if(!is_numeric($mobile)) {
						$errorsmobile = '<p class="output"> Data entered was not numeric</p>';
					} else if(strlen($mobile) != 10) {
						 $errorsmobile = '<p class="output"> The number entered was not 10 digits long</p>';
					} else {
						/* Success */
					}
					 
					  if (!filter_var($email, FILTER_VALIDATE_EMAIL))
					  {
						$emailerrors="<p class='output'>Please specify a valid email address </p>";
					  }
						
					$amount=$_REQUEST['amount'];
					$trnsale=$_REQUEST['trnsale'];

		}else {
		$name =$_SESSION['name'] = trim($_POST['name']);
		$cmpname =$_SESSION['cname'] = trim($_POST['cname']);
		$customerid = $_SESSION['customerid'] =trim($_POST['customerid']);
		$mobile = $_SESSION['customerid']=trim($_POST['mobile']);
		$email =$_SESSION['mobile']= trim($_POST['email']);
		$address1 = $_SESSION['address1']=trim($_POST['address1']);
		$address2 = $_SESSION['address2']=trim($_POST['address2']);
		$address3 =$_SESSION['address3']= trim($_POST['address3']);
		$state = $_SESSION['state']=trim($_POST['state']);
		$city = $_SESSION['city']= trim($_POST['city']);
		$zip =$_SESSION['zip']= trim($_POST['zip']);
		$amount=$_SESSION['amount']=$_REQUEST['amount'];
		$trnsale=$_SESSION['trnsale']=$_REQUEST['trnsale'];
		$cname=$_SESSION['cname']=$_REQUEST['cname'];
		$description=$_SESSION['description']=$_REQUEST['description'];

		
		
		
		$otpcode=substr(mt_rand(), 0, 4); /// to generate random number
		$body="Your One Time Password (OTP) is : ".$otpcode;
		$subject="One Time Password : OTP";
		
		$_SESSION['otp']=$otpcode;	/// save otp code in sesion	
		$_SESSION['end'] = time() + 2 * 60;	// set sesion time to 5 mins
		
if(isset($_REQUEST['mobile']))
	{
	$message =$body;

$mobileno=$_REQUEST['mobile'];

//$ticketid="DLL-903-66894";
$cur = date('Y-m-d H:i:s');
$user="support"; //your username
$password="striker123"; //your password
$mobilenumbers=$mobileno; //enter Mobile numbers comma seperated
$message = $message; //enter Your Message
$senderid="STRIKR"; //Your senderid
$messagetype="1"; //Type Of Your Message
$url="http://www.smsstriker.com/API/sms.php";

$message = urlencode($message);
$ch = curl_init();
if (!$ch){die("Couldn't initialize a cURL handle");}
$ret = curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt ($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt ($ch, CURLOPT_POSTFIELDS,
"username=$user&password=$password&to=$mobilenumbers&msg=$message&from=$senderid&type=$messagetype");
$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//If you are behind proxy then please uncomment below line and provide your proxy ip with port.
// $ret = curl_setopt($ch, CURLOPT_PROXY, "PROXY IP ADDRESS:PORT");
$final_url = $url."?"."username=$user&password=$password&mobilenumber=$mobilenumbers&msg=$message&from=$senderid&type=$messagetype";

//echo $final_url;

$curlresponse = curl_exec($ch); // execute
if(curl_errno($ch))
echo 'curl error : '. curl_error($ch);
if (empty($ret)) {
// some kind of an error happened
die(curl_error($ch));
curl_close($ch); // close cURL handler
} else 
{
$info = curl_getinfo($ch);
curl_close($ch); // close cURL handler
//var_dump($info);

//$url='http://localhost/projects/striker/index.php/index/codeotp.html';

$url='https://www.smsstriker.com/index/codeotp.html';
		?>
<script language="javascript" type="text/javascript">
window.self.location='<?php print($url);?>';
</script>
<?php

}
			echo "<script>alert('Message Sent Succesfully');</script>";	

}
		 
		


?>



<?php 
}

}
$profile_data=$this->User_model->getUserDetails($this->_userId);
		
		foreach($profile_data as $row)
		    {
		     
			 	$profile['username']=$row->username;
				$profile['user_id']= $row->user_id;
		     	$profile['username']=$row->username;
		     	$profile['first_name']=$row->first_name;
		     	$profile['last_name']=$row->last_name;
		     	$profile['email']=$row->email;
		     	$profile['mobile']=$row->mobile;
		     	$profile['organization']=$row->organization;
		     	$profile['address1']=$row->address1;
		     	$profile['address2']=$row->address2;
		     	$profile['region']=$row->region;
				$profile['zipcode']=$row->zipcode;

				$profile['state_id']=$row->state_id;
				$profile['city_id']=$row->city_id;


        }
			$query=mysql_query("select state from new_citylist where state_id='".$profile['state_id']."'");
			$rec=mysql_fetch_array($query);
			
			$querycity=mysql_query("select city_name from new_citylist where  city_id='".$profile['city_id']."'");
			$reccity=mysql_fetch_array($querycity);
?>

	<head>
<style type="text/css">
    .label {width:100px;text-align:right;float:left;padding-right:10px;font-weight:bold;}
    #register-form label.error, .output {
	
	color: #FB3A3A;
font-weight: bold;
margin-left: 206px;
float: right;
position: absolute;
margin-top: -37px;}
  </style>
  <script type="text/javascript" src="<?php  echo base_url();?>js_n/jquery.js"></script>




</head>

<body >

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="wrapper">
    <div class="inner_col">
    
<!-- http://www.smsstriker.com/payment/TestSsl.php
--><h2>Pay Now</h2>
<form  method="post" id="enquiry"  name="enquiry"  action="<?php echo $_SERVER['PHP_SELF']; ?>"  >
          <h2>Transaction Details</h2>
        <p class="name">
        <label> Sales Quantity :</label><br/>
		<input type="text" name="trnsale" id="trnsale"    required   />
			
		</p>
        <p class="name">
                <label> Amount :</label><br/>

		<input type="text" name="amount" id="amount"    required   />
			
		</p>
        <h2>Billing Address</h2>
		<p class="name">
		<input type="text" name="name" id="name" placeholder="Customer Name"  value="<?php echo $profile['first_name']; ?>"  />

			<span><?php echo $errorsname ; ?></span>
		</p>
      
       <p class="name">
		<input type="text" name="customerid" id="customerid" placeholder="User ID" value="<?php echo $profile['username'] ?>" >
                   <span><?php echo $customeriderrors ; ?></span> </p>
                   
         <p class="name">
		<input type="text" name="cname" id="cmpname" placeholder="Company Name" value="<?php echo $profile['organization']; ?>" >
                   <span><?php echo $cmpnameerrors ; ?></span> 
		</p>
		
		<p class="email">
			<input type="text" name="mobile" id="mobile" placeholder="Mobile Number"  maxlength="10"  value="<?php echo $profile['mobile']; ?>" >
              <span><?php echo $errorsmobile ; ?></span> 

		</p>
		
		<p class="web">
			<input type="text" name="email" id="email" placeholder="Email Address" value="<?php echo $profile['email']; ?>" >
           <span><?php echo $emailerrors ; ?></span> 
		</p>		
        <p class="text">
        			<input type="text" name="address1" id="address" placeholder="address line1"  value="<?php echo $profile['address1']; ?>">
<span><?php echo $errorsaddress2 ; ?></span>
		</p>
          <p class="text">
        			<input type="text" name="address2" id="address" placeholder="address line2"  value="<?php 
					echo $profile['address2']; ?>" >
<span><?php echo $errorsaddress2 ; ?></span>
		</p>
          <p class="text">
        			<input type="text" name="address3" id="address" placeholder="address line3" value="<?php 
					echo $profile['address2']; ?>" >
<span><?php echo $errorsaddress3 ; ?></span>
		</p>
    
        
         <p class="name">
         		<input type="text" name="state" id="state" placeholder="state" value="<?php echo $rec['state']; ?>"  >


<span><?php echo $errorsstate ; ?></span>
			
		</p>
           
      <p class="name">
		<input type="text" name="city" id="city" placeholder="City" value="<?php echo $reccity['city_name']; ?>">

			<span><?php echo $errorscity ; ?></span>

		</p>
         
         <p class="name">
<input type="text" name="zip" id="zip" placeholder="zipcode" value="<?php echo $profile['zipcode']; ?>">
			<span><?php echo $errorzip ; ?></span>
		</p>
		
		
        <p class="text">
			<textarea  placeholder="Description" name="description"></textarea>
		</p>
        
		<p class="submit">
			<input type="submit" value="Submit" name="send" >
		</p>
	</form>

  
  </div>
</body>

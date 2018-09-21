<?php
session_start();

if(isset($_POST['send']))
{ 
if(empty($_POST['name'])||empty($_POST['cname'])||empty($_POST['customerid'])||empty($_POST['mobile'])||empty($_POST['email'])||empty($_POST['address1'])||empty($_POST['address2'])||empty($_POST['address3'])||empty($_POST['state'])||empty($_POST['city'])||empty($_POST['zip'])) {
				// collect all input and trim to remove leading and trailing whitespaces
					$name = trim($_POST['name']);
					$cmpname = trim($_POST['cname']);
					$qnty = trim($_POST['qnty']);
					$planprice = trim($_POST['planprice']);
					$customerid = trim($_POST['customerid']);
					$mobile = trim($_POST['mobile']);
					$email = trim($_POST['email']);
					$address1 = trim($_POST['address1']);
					$address2 = trim($_POST['address2']);
					$address3 = trim($_POST['address3']);
					$state = trim($_POST['state']);
					@$city = trim($_POST['city']);
					@$zip = trim($_POST['zip']);
					
					if (strlen($state) == 0)
					  {
					  $errorsstate="<p class='output'>Please Select state </p>";
					  }
					  if (strlen($city) == 0)
					  {
					  $errorscity="<p class='output'>Please Select City </p>";
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
					} elseif(strlen($customerid) != 6) {
					$customeriderrors = '<p class="output"> The User ID should be 6 characters </p>';
					}
					
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
		$_SESSION['end'] = time() + 2 * 60;	// set sesion time to 2 mins
		$body="Your One Time Password (OTP) is : ".$otpcode;
		$subject="One Time Password : OTP";
		$_SESSION['otp']=$otpcode;	/// save otp code in sesion	
		
	
if(isset($_REQUEST['mobile']))
	{
		
	$message =$body;

$mobileno=$_REQUEST['mobile'];

$cur = date('Y-m-d H:i:s');
$user="support"; //your username
$password="Str!k3r2020"; //your password
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

//$url='http://localhost/projects/striker/index.php/index_new/codeotp.html';

$url='http://www.smsstriker.com/codeotp';
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
?>




<!DOCTYPE html>
<html class="no-js" lang="en">
 
<head>
    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="x-ua-compatible" content="IE=9" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMS Strikers</title>
    <meta name="description" content="Laundryes - Laundry Business Html Template. It is built using bootstrap 3.3.2 framework, works totally responsive, easy to customise, well commented codes and seo friendly.">
    <meta name="keywords" content="laundry, multipage, business, clean, bootstrap">
    <meta name="author" content="rudhisasmito.com"> 
	
	
	
	
</head>
<style type="text/css">
    
    .breadcrumb > li {
    display: inline-block;
}

    .modal-dialog {
   
        left: 0% !important;}

.span_v {
    color: red;
   
}	
label.error {
    color: red !important;
    font-size: 12px !important;
    font-weight: 100 !important;
}	
    </style>
	
	

<body>
	
	<!-- Load page -->
	
	
	
	<!-- NAVBAR SECTION -->
	

 
	<!-- BANNER ROTATOR -->
	<div class="section subbanner col-sm-12">
		<div class="container">
			<div class="row" >
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                  
					<div class="caption">
                         
					
						<ol class="breadcrumb">
						  <li class="active">Home</li>
						  <li class="active">Register</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	
	
	<!-- ABOUT SECTION -->
	
	
	
	
	<!-- STATS SECTION FACTS --> 
		<div class="col-md-12 "  >
	<form class="form-horizontal" method="post" id="enquiry"  name="enquiry"  action="" >	

        
        <h2 class="col-sm-offset-3" style="font-size:20px; padding:15px 10px;">Transaction </h2>
        
       
        <div class="form-group">
            
        <label class="col-xs-5 col-md-3 control-label">Sales Quantity :</label>
        <div class="col-md-4">
           
			<input type="text" name="trnsale" id="trnsale" class="form-control" readonly value="<?php echo  @$_REQUEST['qnty']; ?>"   />
        </div>
    </div>
        <div class="form-group">
        <label class="col-xs-5 col-md-3 control-label">Amount :</label>
        <div class="col-md-4">
        
			<input type="text" name="amount" id="amount" class="form-control"  readonly value="<?php echo  @$_REQUEST['planprice']; ?>" />
        </div>
    </div>
      <h2 class="col-sm-offset-3" style="font-size:20px; padding:15px 10px; padding-top:0px !important;">Billing Address</h2>
     
    <div class="form-group">
        <label class="col-xs-5 col-md-3 control-label">Customer Name</label>
        <div class="col-xs-12 col-md-4    ">
		<input type="text" name="name" id="name" class="form-control" placeholder="Customer Name"   />
          
        </div>
       
    </div>

   

    <div class="form-group">
        <label class="col-xs-5 col-md-3  control-label">User ID</label>
        <div class="col-md-4">
		<input type="text" name="customerid" id="customerid" class="form-control" placeholder="User ID" >
             
        </div>
    </div>
        
   <div class="form-group">
        <label class="col-xs-3 control-label">Company Name</label>
        <div class="col-md-4">
		<input type="text" name="cname" id="cmpname" class="form-control" placeholder="Company Name" >
            
        </div>
    </div>
   
    <div class="form-group">
        <label class="col-xs-6 col-md-3 control-label">Mobile number</label>
        <div class="col-md-4 ">
		<input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile Number"  maxlength="10" >
          
        </div>
    </div>
        
        <div class="form-group">
        <label class="col-xs-6 col-md-3 control-label">Email Address</label>
        <div class="col-md-4 ">
		<input type="text" name="email" id="email" class="form-control" placeholder="Email Address" >
           
        </div>  
    </div>
        
   
        
        <div class="form-group">
        <label class="col-xs-5 col-md-3 control-label">Address1:</label>
        <div class="col-xs-12 col-md-4    ">
		<input type="text" name="address1" id="address1" class="form-control" placeholder="address line1" >
          
        </div> 
        </div>
        
          <div class="form-group">
        <label class="col-xs-5 col-md-3 control-label">Address2:</label>
        <div class="col-xs-12 col-md-4    ">
		<input type="text" name="address2" id="address2" placeholder="address line2" class="form-control" >
            
        </div>
              
        </div>
          <div class="form-group">
        <label class="col-xs-5 col-md-3 control-label">Address3:</label>
        <div class="col-xs-12 col-md-4    ">
		<input type="text" name="address3" id="address3" class="form-control" placeholder="address line3" >
          
        </div>
        </div>
        
        <div class="form-group">
        <label class="col-xs-5 col-md-3 control-label">State:</label>
        <div class="col-xs-12 col-md-4 selectContainer">
		<?php
		$statesAll = $this->user_model->getNew_StatesList(); ?>
<select name="state" id="state" onChange="get_city(this.value)"  class="form-control">
<option  value=""> --select--</option>
<?php foreach($statesAll as $key): ?>
<option value="<?php echo $key->state; ?>" ><?php echo $key->state; ?></option>
<?php endforeach; ?>
</select>

        </div>
    </div>
        
         <div class="form-group">
        <label class="col-xs-5 col-md-3 control-label">City:</label>
        <div class="col-xs-12 col-md-4 selectContainer">
    <select name="city" id="city" class="form-control">
								<?php foreach($city_all as $key => $val): ?>
								<option value="<?php echo $key; ?>" <?php echo ($key == $city_id_post) ? "selected" : ''; ?>><?php echo $val; ?></option>
								<?php endforeach; ?>
							</select>
       
		</div> 
    </div>
        
        
         <div class="form-group">
        <label class="col-xs-5 col-md-3  control-label">  Pin Code:</label>
        <div class="col-xs-12 col-md-4 ">
		<input type="text" name="zip" id="zip" class="form-control" placeholder="PIN code" >
          
        </div>
    </div>
        <div class="form-group">
        <label class="col-xs-3 control-label">Description</label>
        <div class="col-xs-12 col-md-4">
		
          <textarea  placeholder="Description" name="description" class="form-control" rows="5"></textarea>
        </div>
    </div>
        
      

   <!-- <div class="form-group">
        <label class="col-xs-3 control-label">Password</label>
        <div class="col-md-4">
            <input type="password" class="form-control" name="password" />
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-3 col-xs-offset-3">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="agree" value="agree" /> Agree with the terms and conditions
                </label>
            </div>
        </div>
    </div>-->


   <!-- <div class="form-group">
        <label class="col-xs-3 control-label">Date of birth</label>
        <div class="col-xs-3">
            <input type="text" class="form-control" name="birthday" placeholder="YYYY/MM/DD" />
        </div>
    </div>
-->
<input type="hidden" name="qnty" value="<?php echo  @$_REQUEST['qnty']; ?>">
<input type="hidden" name="planprice" value="<?php echo  @$_REQUEST['planprice']; ?>">

    <div class="form-group">
        <div class="col-xs-9 col-xs-offset-3">
		<input type="submit" value="Submit" name="send" class="btn btn-primary" >
        </div>
    </div>
</form>
    
    
    </div>
	
	
	<!-- ABOUT SECTION -->
	
	
	<div class="clearfix"></div>
	
	
	
	
	<!-- FOOTER SECTION -->
	
	
	
	<!-- -Login Modal -->

 	<!-- - Login Model Ends Here -->

    
   <script type="text/javascript" src="<?php  echo base_url();?>js/jquery.min.js"></script>
  
   <script type="text/javascript">
$(document).ready(function() {
    $("#zip").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)||$('#zip').val().length >= 6 || $('#zip').val().length == 6) {
            e.preventDefault();
        }
    });
	
	

});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $("#mobile").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)||$('#mobile').val().length >= 10 || $('#mobile').val().length == 10) {
            e.preventDefault();
        }
    });
	
	

});
</script>
    

	
    <script>
  function get_city(state_id)
	{
		

		var data ={state_id:state_id};
		
		$('#city').html("Please Wait.....");
		$.ajax({
		
			url: "<?php echo site_url(); ?>cities_ajax",
			type: "POST",
			data: data,
			//data: {'passcode': '1'},
			cache: false,
			success: function (callback_data) 
			{
				$('#city').html(callback_data);
			}
		});
	}
</script>
    <script>

(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#enquiry").validate({
                rules: {
					trnsale:"required",
					amount:"required",
                    name: "required",
                    customerid: "required",
					 email: {
                        required: true,
                        email: true
                    },
					 cname: "required", 
					 mobile: "required", 
					 address1: "required", 
					 address2: "required", 
					 state: "required", 
					 city: "required",
					 zip: "required",
					 description: "required"
                },
                messages: {
					trnsale: "Please Select Sales Quantity",
                    amount: "Please select Amount",
                    name: "Please enter Customer Name",
                    customerid: "Please enter customerid",
                    email: "Please enter a valid email address",
					cname: "Please enter your Company Name",
					mobile: "Please enter your Mobile Number",
					address1: "Please enter your Address",
					address2: "Please enter your Address2",
					state: "Please Select your State",
					city: "Please Select your City",
					zip:"Please enter Pincode",
                    description: "Please Enter Description"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);
</script>
    
   <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
	
</body>


</html>

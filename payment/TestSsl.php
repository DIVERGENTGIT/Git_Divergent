<?php
//http://localhost/newui/app/index.php/Payment/confirm_order/
//?tn=201612281957848&rm=Transaction%20Successful&user_name=
session_start();

 
include("Sfa/BillToAddress.php");
include("Sfa/CardInfo.php");
include("Sfa/Merchant.php");
include("Sfa/MPIData.php");
include("Sfa/ShipToAddress.php");
include("Sfa/PGResponse.php");
include("Sfa/PostLibPHP.php");
include("Sfa/PGReserveData.php");
include("config.php");

$oMPI 			= 	new MPIData();
$oCI			=	new	CardInfo();
$oPostLibphp	=	new	PostLibPHP();
$oMerchant		=	new	Merchant();
$oBTA			=	new	BillToAddress();
$oSTA			=	new	ShipToAddress();
$oPGResp		=	new	PGResponse();
$oPGReserveData =	new PGReserveData();
$amount = base64_decode($_REQUEST['amount']);

if(intval($amount))
{
$amount = intval($amount);
}
else
{
$amount = base64_decode($_REQUEST['amount']);
}

if($amount > 0)
{
$tax_amount= base64_decode($_REQUEST['tax_amount']);
$notax_amount= base64_decode($_REQUEST['amount']);
$total_amount= base64_decode($_REQUEST['total_amount']);
//$amount=$total_amount;

$name= base64_decode($_REQUEST['name']);
$trnsale= base64_decode($_REQUEST['trnsale']);
$sms_price= base64_decode($_REQUEST['sms_price']);
$customerid= base64_decode($_REQUEST['customerid']);
$address1= base64_decode($_REQUEST['address1']);
$address2= base64_decode($_REQUEST['address2']);
$address3= base64_decode($_REQUEST['address2']);
$city= base64_decode($_REQUEST['city']);
$state= base64_decode($_REQUEST['state']);
$email= base64_decode($_REQUEST['email']);
$mobile= base64_decode($_REQUEST['mobile']);
$zip= base64_decode($_REQUEST['zip']);
$ids= base64_decode($_REQUEST['ids']);

// get description
$description= base64_decode($_REQUEST['description']);

$errorlog_path="/var/www/html/smsstriker/payment/Error_Logs/TestSSL_paramesters".date("Ymd").".log";
$curdate=date('Y-m-d H:i:s');
error_log($curdate."|amount : $amount | tax_amount :  $tax_amount | total_amount : $total_amount | Ids : $ids |User Name : $name |trnsale : $trnsale | user_id : $customerid | address1 : $address1 | address2 : $address2 | address3 : $address3 | city : $city | state : $state | email : $email | $email |mobile : $mobile | zip : $zip |  cname : $name "."\n",3,$errorlog_path);
/***  insert into trasaction history start ***/
$transaction_id=mt_rand();

$queryid="update price_enquery set transaction_id=$transaction_id where id IN ($ids)";
mysqli_query($link,$queryid); 

//echo $description;
if($description=='Add Longcode Credits')
{
$longcode_credits= base64_decode($_REQUEST['longcode_credits']);
$query = "insert into transaction_history (user_id,longcode_credits,sms_price,amount,tax_amount,total_amount,transaction_id)
 values ($customerid,$longcode_credits,$sms_price,$amount,$tax_amount,$total_amount,$transaction_id)";
}
//echo $description;
else if($description=='longcode Dedicated Renewal')
{

$query = "insert into transaction_history (user_id,noofsms,sms_price,amount,tax_amount,total_amount,transaction_id)
 values ($customerid,$trnsale,$sms_price,$amount,$tax_amount,$total_amount,$transaction_id)";
 
}
//echo $description;
else if($description=='longcode Shared Renewal')
{

//$query = "insert into transaction_history (user_id,no_of_keywords,sms_price,amount,tax_amount,total_amount,transaction_id)
 //values ($customerid,$trnsale,$sms_price,$amount,$tax_amount,$total_amount,$transaction_id)";
 
 $query = "insert into transaction_history (user_id,sms_price,amount,tax_amount,total_amount,transaction_id)
 values ($customerid,$sms_price,$amount,$tax_amount,$total_amount,$transaction_id)";
 
}
else if($description=='Add Shorturl Credits')
{

$shorturl_credits= base64_decode($_REQUEST['shorturl_credits']);
$query = "insert into transaction_history (user_id,shorturl_credits,sms_price,amount,tax_amount,total_amount,transaction_id)
 values ($customerid,$shorturl_credits,$sms_price,$amount,$tax_amount,$total_amount,$transaction_id)";
}
else
{
 $query = "insert into transaction_history (user_id,noofsms,sms_price,amount,tax_amount,total_amount,transaction_id)
 values ($customerid,$trnsale,$sms_price,$amount,$tax_amount,$total_amount,$transaction_id)";
} 

//echo $query;
//exit;

mysqli_query($link,$query); 

/// AMount update 1 Rs as  $total_amount ****///

//$oMerchant->setMerchantDetails("96018619","96018619","96018619","175.101.23.51",rand()."",$trnsale."sms","$web_url/payment/SFAResponse.php","POST","INR",rand()."INV","req.Sale","$total_amount","","$name","true","$trnsale","$mobile","$customerid");


$oMerchant->setMerchantDetails("96018619","96018619","96018619","175.101.23.51",rand()."",$trnsale."sms","$web_url/payment/SFAResponse.php","POST","INR",rand()."INV","req.Sale","$total_amount","","$name","true","$trnsale","$mobile","$customerid");

$oBTA->setAddressDetails ("$customerid","$name","$address1","$address2","$address3","$city","$state",
"$zip","IND","$email");

#$oBTA->setAddressDetails ("$customerid","$name","$address1","$address2","$address3","$state","$zip","IND","$email");

$oSTA->setAddressDetails ("$address1","$address2","$address3","$city","$state","$zip","IND","$email");

#$oMPI->setMPIRequestDetails("1245","12.45","356","2","2 shirts","12","20011212","12","0","","image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/vnd.ms-powerpoint, application/vnd.ms-excel, application/msword, application/x-shockwave-flash, */*","Mozilla/4.0 (compatible; MSIE 5.5; Windows NT 5.0)");


$oPGResp=$oPostLibphp->postSSL($oBTA,$oSTA,$oMerchant,$oMPI,$oPGReserveData);
  
$trnId = $oPGResp->getTxnId();
//$epgTxnId = $oPGResp->getEpgTxnId();
	
	echo $oPGResp->getRespCode();
if($oPGResp->getRespCode() == '000'){ // success case for payment
	   
	 /* 
	 $query = "update price_enquery set amount=$notax_amount,tax_amount=$tax_amount,total_amount=$total_amount,transaction_id='$trnId' where id in($ids)";
	   mysqli_query($link,$query);*/
	   
	    
	  $query = "update price_enquery set transaction_id='$trnId' where id in($ids)";
	   mysqli_query($link,$query);
	   
	   $query1 = "update transaction_history set transaction_id='$trnId' where transaction_id in($transaction_id)";
	   mysqli_query($link,$query1); 
	 
	   $url=$oPGResp->getRedirectionUrl();	
	   redirect($url);	
	}
	else
	{ 
	// failed case for payment
	    $query = "update price_enquery set amount=$notax_amount,tax_amount=$tax_amount,total_amount=$total_amount,transaction_id='$trnId' where id in($ids)";
	    mysqli_query($link,$query); 
	    
	    $query2 = "update transaction_history set transaction_id='$trnId' where transaction_id in($transaction_id)";
	   mysqli_query($link,$query2); 
	  
		print "Error Occured.<br>";
		print "Error Code:".$oPGResp->getRespCode()."<br>";
		print "Error Message:".$oPGResp->getRespMessage()."<br>";
	    echo "<br><br><a href='$web_url/Payment/confirm_order' >Back to Order</a>";	
	}
	
} else {

	// failed case for payment
	 $query = "update price_enquery set amount=$notax_amount,tax_amount=$tax_amount,total_amount=$total_amount,transaction_id='$trnId' where id in($ids)";
	   mysqli_query($link,$query);

	    $query3 = "update transaction_history set transaction_id='$trnId' where transaction_id in($transaction_id)";
	   mysqli_query($link,$query3); 

		print "Error Occured.<br>";
		print "Error Code:".$oPGResp->getRespCode()."<br>";
		print "Error Message:".$oPGResp->getRespMessage()."<br>";
	echo "<br><br><a href='$web_url/Payment/confirm_order' >Back to Order</a>";	
}
# This will remove all white space
#$oResp =~ s/\s*//g;
#$oPGResp->getResponse($oResp);
#print $oPGResp->getRespCode()."<br>";
#print $oPGResp->getRespMessage()."<br>"; 
#print $oPGResp->getTxnId()."<br>";
$trnId = $oPGResp->getTxnId();
//$epgTxnId = $oPGResp->getEpgTxnId();
#print $oPGResp->getEpgTxnId()."<br>";
	

mysqli_close($link);
function redirect($url) {
	if(headers_sent()){
	?>
		<html><head>
			<script language="javascript" type="text/javascript">
				window.self.location = '<?php print($url);?>';
			</script>
		</head></html>
	<?php
		exit;
	} else {
		header("Location: ".$url);
		exit;
	}
}
?>


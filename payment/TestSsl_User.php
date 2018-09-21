<?php
require("/var/www/html/striker/PHPMailer-master/PHPMailerAutoload.php");
include("Sfa/BillToAddress.php");
include("Sfa/CardInfo.php");
include("Sfa/Merchant.php");
include("Sfa/MPIData.php");
include("Sfa/ShipToAddress.php");
include("Sfa/PGResponse.php");
include("Sfa/PostLibPHP.php");
include("Sfa/PGReserveData.php");
include("../core_config/config.php");

$oMPI 			= 	new MPIData();
$oCI			=	new	CardInfo();
$oPostLibphp	=	new	PostLibPHP();
$oMerchant		=	new	Merchant();
$oBTA			=	new	BillToAddress();
$oSTA			=	new	ShipToAddress();
$oPGResp		=	new	PGResponse();
$oPGReserveData =	new PGReserveData();

$amount=$_REQUEST['amount'];
$name=$_REQUEST['name'];
$trnsale=$_REQUEST['trnsale'];
$customerid=$_REQUEST['customerid'];
$address1=$_REQUEST['address1'];
$address2=$_REQUEST['address2'];
$address3 = $_REQUEST['address3'];
$city=$_REQUEST['city'];
$state=$_REQUEST['state'];
$email=$_REQUEST['email'];
$mobile=$_REQUEST['mobile'];
$zip=$_REQUEST['zip'];
$cname=$_REQUEST['name'];
$des=$_REQUEST['description']='UserPayment';
$service_nos = rtrim(@$_REQUEST['service_nos'],',');
$pdays = $_REQUEST['pdays'];
$plancost = $_REQUEST['plancost'];
$did_types = rtrim(@$_REQUEST['did_types'],',');
$did_plans = rtrim(@$_REQUEST['did_plans'],',');
$did_costs = $_REQUEST['did_costs'];
$pservice = $_REQUEST['pservice']; 
$uservice = $_REQUEST['uservice'];
$freesms = $_REQUEST['fsms'];
$freecalls = $_REQUEST['fcalls'];
$pkg_id = $_REQUEST['pkg_id'];

$oMerchant->setMerchantDetails("96018619","96018619","96018619","175.101.23.51",rand()."",$trnsale."sms","$web_url/payment/SFAResponse_User.php","POST","INR",rand()."INV","req.Sale","$amount","","$name","true","$trnsale","$mobile","$customerid");

$oBTA->setAddressDetails ("$customerid","$name","$customerid","$name","$customerid","$city","$cname","Rs".$amount,"IND","$email");

#$oBTA->setAddressDetails ("$customerid","$name","$address1","$address2","$address3","$address3","$state","$zip","IND","$email");

$oSTA->setAddressDetails ("$address1","$address2","$address3","$city","$state","$zip","IND","$email");

#$oMPI->setMPIRequestDetails("1245","12.45","356","2","2 shirts","12","20011212","12","0","","image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/vnd.ms-powerpoint, application/vnd.ms-excel, application/msword, application/x-shockwave-flash, */*","Mozilla/4.0 (compatible; MSIE 5.5; Windows NT 5.0)");


$oPGResp=$oPostLibphp->postSSL($oBTA,$oSTA,$oMerchant,$oMPI,$oPGReserveData);

$trnId = $oPGResp->getTxnId();
$epgTxnId = $oPGResp->getEpgTxnId();
	
	
if($oPGResp->getRespCode() == '000'){
	
	#$url =~ s/http/https/;
	#print "Location: ".$url."\n\n";
	#header("Location: ".$url);		
	$sdate = date('Y-m-d');
	$sdays = $pdays;
	$pay_edate = date('Y-m-d', strtotime($sdate . ' + '.$sdays.' days'));
	$alldid_nos = array();
	$alldid_nos = explode(',',$service_nos);
	$tot_nos = count($alldid_nos);
	
	$alldid_types = array();
	$alldid_types = explode(',',$did_types);
	$tot_types = count($alldid_types);
	
	$alldid_plans = array();
	$alldid_plans = explode(',',$did_plans);
	$tot_plans = count($alldid_plans);
	
	$alldid_costs = array();
	$alldid_costs = explode(',',$did_costs);
	$tot_costs = count($alldid_costs);
	
	$sn = 0;	
	while($sn < $tot_nos) {	 
	$did_snos = $alldid_nos[$sn];
	$did_type = $alldid_types[$sn];
	$did_plan = $alldid_plans[$sn];
	$did_cost_mn = $alldid_costs[$sn];
	if($pdays == 30){ $did_cost = $did_cost_mn; }
	if($pdays == 60){ $did_cost = $did_cost_mn * 2; }
	if($pdays == 90){ $did_cost = $did_cost_mn * 3; }
	if($pdays == 180){ $did_cost = $did_cost_mn * 6; }
	if($pdays == 365){ $did_cost = $did_cost_mn * 12; }
	$netamount = $plancost + $did_cost;
	$tax_mount = $netamount * ($tax / 100);
	$totamount = $netamount + $tax_mount;
	
	$query = "INSERT INTO voice_billing ( `service_nos`, `mc_quantity`, `amount`, `cust_name`, `user_id`, `company_name`, `mobile`, `email`, `address1`, `address2`, `state`, `city`, `pincode`, `description`, `package_id`, `plan_days`, `plan_service`, `user_service`, `sms_credits`, `vc_amount`, `billing_date`, `renewal_date`, `transaction_id`, `status`, `tax_percentage`, `package_cost`, `did_plan`, `did_type`, `did_amount`) VALUES ('$did_snos', '$trnsale', '$totamount', '$name', '$customerid', '$cname', '$mobile', '$email', '$address1', '$address2', '$state', '$city', '$zip', '$des', '$pkg_id', $pdays, '$pservice', '$uservice', $freesms, $freecalls, NOW(), '$pay_edate', '$trnId', '0', $tax, '$plancost', '$did_plan', '$did_type', '$did_cost');";
	//exit;
	mysql_query($query,$conn);	
	$sn++;
	}
	//exit;
	
	if($totamount > 0)
	{		
	$url=$oPGResp->getRedirectionUrl();	
	redirect($url);	
	}
	else
	{
	  echo "<script>alert('Transaction Failed');</script>";	
	}
	
} else {		
	$sdate = date('Y-m-d');
	$sdays = $pdays;
	$pay_edate = date('Y-m-d', strtotime($sdate . ' + '.$sdays.' days'));
	$alldid_nos = array();
	$alldid_nos = explode(',',$service_nos);
	$tot_nos = count($alldid_nos);
	
	$alldid_types = array();
	$alldid_types = explode(',',$did_types);
	$tot_types = count($alldid_types);
	
	$alldid_plans = array();
	$alldid_plans = explode(',',$did_plans);
	$tot_plans = count($alldid_plans);
	
	$alldid_costs = array();
	$alldid_costs = explode(',',$did_costs);
	$tot_costs = count($alldid_costs);
	
	$sn = 0;	
	while($sn < $tot_nos) {	 
	$did_snos = $alldid_nos[$sn];
	$did_type = $alldid_types[$sn];
	$did_plan = $alldid_plans[$sn];
	$did_cost_mn = $alldid_costs[$sn];
	if($pdays == 30){ $did_cost = $did_cost_mn; }
	if($pdays == 60){ $did_cost = $did_cost_mn * 2; }
	if($pdays == 90){ $did_cost = $did_cost_mn * 3; }
	if($pdays == 180){ $did_cost = $did_cost_mn * 6; }
	if($pdays == 365){ $did_cost = $did_cost_mn * 12; }
	$netamount = $plancost + $did_cost;
	$tax_mount = $netamount * ($tax / 100);
	$totamount = $netamount + $tax_mount;
	$query = "INSERT INTO voice_billing ( `service_nos`, `mc_quantity`, `amount`, `cust_name`, `user_id`, `company_name`, `mobile`, `email`, `address1`, `address2`, `state`, `city`, `pincode`, `description`, `package_id`, `plan_days`, `plan_service`, `user_service`, `sms_credits`, `vc_amount`, `billing_date`, `renewal_date`, `transaction_id`, `status`, `tax_percentage`, `package_cost`, `did_plan`, `did_type`, `did_amount`) VALUES ('$did_snos', '$trnsale', '$totamount', '$name', '$customerid', '$cname', '$mobile', '$email', '$address1', '$address2', '$state', '$city', '$zip', '$des', '$pkg_id', $pdays, '$pservice', '$uservice', $freesms, $freecalls, NOW(), '$pay_edate', '$trnId', '0', $tax, '$plancost', '$did_plan', '$did_type', '$did_cost');";
	//exit;
	mysql_query($query,$conn); 	
	
	$sn++;
	}
	$query = "UPDATE voice_billing SET status=0, response_code='$ResponseCode', message='$Message', RRN='$RRN', epg_txnID='$ePGTxnID', authcode=$AuthIdCode where transaction_id=$TxnID";
	mysql_query($query);
	
/* ?>
<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/index.php/payments/cancel.html?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
</script>
<?php */
	print "Error Occured.<br>";
	print "Error Code:".$oPGResp->getRespCode()."<br>";
	print "Error Message:".$oPGResp->getRespMessage()."<br>";
	
}

# This will remove all white space
#$oResp =~ s/\s*//g;
#$oPGResp->getResponse($oResp);
#print $oPGResp->getRespCode()."<br>";
#print $oPGResp->getRespMessage()."<br>"; 
#print $oPGResp->getTxnId()."<br>";
$trnId = $oPGResp->getTxnId();
$epgTxnId = $oPGResp->getEpgTxnId();
#print $oPGResp->getEpgTxnId()."<br>";
	

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
mysql_close($conn);
?>


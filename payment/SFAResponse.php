<?php
session_start();
include("Sfa/EncryptionUtil.php");
include("config.php");
$currentdata=date("Y-m-d H:i:s");
	 $strMerchantId="96018619";
	 $astrFileName="/var/www/key/96018619.key";
	 $astrClearData;
	 $ResponseCode = "";
	 $Message = "";
	 $TxnID = "";
	 $ePGTxnID = "";
     $AuthIdCode = "";
	 $RRN = "";
	 $CVRespCode = "";
	 $Reserve1 = "";
	 $Reserve2 = "";
	 $Reserve3 = "";
	 $Reserve4 = "";
	 $Reserve5 = "";
	 $Reserve6 = "";
	 $Reserve7 = "";
	 $Reserve8 = "";
	 $Reserve9 = "";
	 $Reserve10 = "";

		if($_POST){

			if($_POST['DATA']==NULL){
				print "null is the value";
			}
			 $astrResponseData=$_POST['DATA'];
			 $astrDigest = $_POST['EncryptedData'];
			 $oEncryptionUtilenc = 	new EncryptionUtil();
			 $astrsfaDigest  = $oEncryptionUtilenc->getHMAC($astrResponseData,$astrFileName,$strMerchantId);

			if (strcasecmp($astrDigest, $astrsfaDigest) == 0) {
			 parse_str($astrResponseData, $output);
			 if( array_key_exists('RespCode', $output) == 1) {
			 	$ResponseCode = $output['RespCode'];
			 }
			 if( array_key_exists('Message', $output) == 1) {
			 	$Message = $output['Message'];
			 }
			 if( array_key_exists('TxnID', $output) == 1) {
			 	$TxnID=$output['TxnID'];
			 }
			 if( array_key_exists('ePGTxnID', $output) == 1) {
			 	$ePGTxnID=$output['ePGTxnID'];
			 }
			 if( array_key_exists('AuthIdCode', $output) == 1) {
			 	$AuthIdCode=$output['AuthIdCode'];
			 }
			 if( array_key_exists('RRN', $output) == 1) {
			 	$RRN = $output['RRN'];
			 }
			 if( array_key_exists('CVRespCode', $output) == 1) {
			 	$CVRespCode=$output['CVRespCode'];
			 }
		}

			 
		 }
	//print_r($_REQUEST);
	
 // get price equery
 
   
if($ResponseCode==0)
	{
	$upd_mcbill = "UPDATE price_enquery SET payment_status=1, pgresponse_code='$ResponseCode',pgresponse='$Message', RRN='$RRN', epg_txnID='$ePGTxnID', 
	authcode='$AuthIdCode' WHERE transaction_id = $TxnID";
	mysqli_query($link,$upd_mcbill);
	
	$trn_mcbill = "UPDATE transaction_history SET  payment_status='$Message', RRN='$RRN', epg_txnID='$ePGTxnID', 
	authcode='$AuthIdCode' WHERE transaction_id = $TxnID";
	mysqli_query($link,$trn_mcbill);
	
	$get_bill = "SELECT * FROM price_enquery WHERE transaction_id = $TxnID";
	$bill_result = mysqli_query($link,$get_bill); 
	while($mbill = mysqli_fetch_assoc($bill_result)) {
	        $order_type = $mbill['description'];
		$bill_id = $mbill['id'];
		$amount = $mbill['amount'];
		$ePGTxnID = $mbill['epg_txnID'];
		$mobile = $mbill['mobile'];
		$ResponseCode = $mbill['response_code'];
		$message = $mbill['message'];
		$AuthIdCode = $mbill['authcode'];
	}
	
	$smsText = "Thank you for choosing our product.  This is to  acknowledge you that we have received payment of Rs $amount Pertaining to the Transaction ID : $ePGTxnID .";
    $sms_url = "https://www.smsstriker.com/API/sms.php?username=support&password=Str!k3r2020&from=SMSSTR&to=$mobile&msg=".urlencode($smsText)."&type=1";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $sms_url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    //$res=curl_exec($ch);
    $res=true;
    if($res){


// redirect success case start

    if($order_type == "Add SMS Credits")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/Payment/confirm_add_credits/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php
	}
	else if($order_type == "Add Longcode Credits")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode/confirm_add_credits/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php
	}
	else if($order_type == "dedicated")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode/confirm_order/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php
	}
	else if($order_type == "shared")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode_shared/confirm_order/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php
	}
	else if($order_type == "shorturl")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/campaign/confirm_order/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php     
	}
	else if($order_type == "longcode Dedicated Renewal")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode/renwaldedicated/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>  
	<?php     
	} 
	else if($order_type == "longcode Shared Renewal")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode_shared/renwalshared/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php     
	} else if($order_type == "landingPage")
	{ 
	?>
	<script language="javascript" type="text/javascript">
	window.self.location='<?php print $web_url;?>index.php/ppc/paymentStatus?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php      
	}        
	else
	{
	?>
	<script language="javascript" type="text/javascript">
	window.self.location='<?php print $web_url;?>/Payment/confirm_order/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
      <?php
	}
// redirect success case start

     } 
    curl_close($ch);
} 
else {

$get_bill = "SELECT * FROM price_enquery WHERE transaction_id = $TxnID";
	$bill_result = mysqli_query($link,$get_bill); 
	while($mbill = mysqli_fetch_assoc($bill_result)) {
	    $order_type = $mbill['description'];
	}
	$upd_mcbill = "UPDATE price_enquery SET payment_status=1, pgresponse_code='$ResponseCode',
	pgresponse='$Message', RRN='$RRN', epg_txnID='$ePGTxnID', authcode='$AuthIdCode' WHERE transaction_id = $TxnID";
	mysqli_query($link,$upd_mcbill);

	 $trn_mcbill = "UPDATE transaction_history SET pgresponse_code='$ResponseCode',
	payment_status='$Message', RRN='$RRN', epg_txnID='$ePGTxnID', authcode='$AuthIdCode' WHERE transaction_id = $TxnID";
	mysqli_query($link,$trn_mcbill);

	// redirect cancel case start

	if($order_type == "Add SMS Credits")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/Payment/confirm_add_credits/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php
	}
	else if($order_type == "Add Longcode Credits")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode/confirm_add_credits/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php
	}smsstriker
	else if($order_type == "dedicated")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode/confirm_order/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php
	}
	else if($order_type == "shared")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode_shared/confirm_order/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php
	}
	else if($order_type == "shorturl")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/campaign/confirm_order/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php     
	}
	else if($order_type == "longcode Dedicated Renewal")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode/renwaldedicated/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>  
	<?php     
	} 
	else if($order_type == "longcode Shared Renewal")
	{
	?>
	<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/longcode_shared/renwalshared/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php     
	} else if($order_type == "landingPage")
	{ 
	?>
	<script language="javascript" type="text/javascript">
	window.self.location='<?php print $web_url;?>ppc/paymentStatus?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
	<?php     
	}       
	else
	{
	?>
	<script language="javascript" type="text/javascript">
	window.self.location='<?php print $web_url;?>/Payment/confirm_order/?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
	</script>
      <?php
	}
// redirect cancel case end
	
 }
 
error_log($upd_mcbill."\n",3,$errorlog_path);
 mysqli_close($link);
?> 


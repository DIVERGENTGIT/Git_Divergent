<?php   
		
include("Sfa/EncryptionUtil.php");
include("../core_config/config.php");

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

			if($_POST['DATA']==null){
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
	
if($ResponseCode==0){
		
	$upd_mcbill = "UPDATE voice_billing SET status=1, response_code='$ResponseCode', message='$Message', RRN='$RRN', epg_txnID='$ePGTxnID', authcode=$AuthIdCode WHERE transaction_id = $TxnID";
	mysql_query($upd_mcbill);
	//exit;
	$get_mcbill = "SELECT * FROM voice_billing WHERE transaction_id = $TxnID";
	$bill_result = mysql_query($get_mcbill); 
	while($mbill = mysql_fetch_assoc($bill_result)) {
		$bill_id = $mbill['mcbill_id'];
		$did_no = $mbill['service_nos'];
		$quantity = $mbill['mc_quantity'];	
		$amount = $mbill['amount'];
		$user_id = $mbill['user_id'];
		$mobile = $mbill['mobile'];
		$plan_days = $mbill['plan_days'];
		$pservice = $mbill['plan_service'];
		$uservice = $mbill['user_service'];
		$fsms = $mbill['sms_credits'];
		$fcalls = $mbill['vc_amount'];
		$did_type = $mbill['did_type'];
		$did_plan = $mbill['did_plan'];
		$package_cost = $mbill['package_cost'];
		$tax = $mbill['tax_percentage'];
		$package_id = $mbill['package_id'];
		$did_amount = $mbill['did_amount'];
		$epgTid = $mbill['epg_txnID'];
				
			date_default_timezone_set('Asia/Calcutta');
			$sdate = date('Y-m-d H:i:s');
			$sdays = $plan_days;
			$pay_edate = date('Y-m-d', strtotime($sdate . ' + '.$sdays.' days')); 	
			$active = '1';			
		
		$totalplanprice = $package_cost + $did_amount;
		$tax_tot = $totalplanprice * ($tax/100);
		$tot_amount = $totalplanprice + $tax_tot;
		// new added code for did payment price end
		
		$delete_did = "delete from users_servicewise_credits where did_number='$did_no';";
		mysql_query($delete_did);	
		
		$insert_query = "INSERT  INTO users_servicewise_credits (user_id,user_service,did_number,did_type,did_plan,did_service,amount,max_calls,sms_credits,vc_amount,active,subscription_date,subscription_duration,expire_date,renewal_date,renewal_mc_id,entry_date,package_cost,tax,package_id) VALUES ($user_id,'$uservice','$did_no','$did_type','$did_plan','$pservice',$tot_amount,$quantity,$fsms,$fcalls,'$active','$sdate',$plan_days,'$pay_edate','$pay_edate',$bill_id,'$sdate','$package_cost','$tax',$package_id);";	
		mysql_query($insert_query);
		
		$log_data = 'did :' . $did_no . 'sms :' . $fsms . ', calls :'. $fcalls .', user_id :'. $user_id .', date :'.date('Y-m-d').' Transaction Completed'; 
		error_log("\n $log_data", 3, "/var/www/html/FirstRing/logs/mybill.log");		
		
	$smsText = "Thank you for choosing our product.  This is to  acknowledge you that we have received payment of Rs $amount Pertaining to the Transaction ID : $ePGTxnID .";
                        
    $sms_url = "http://www.rkadvertisings.com/API/sms.php?username=support&password=striker123&from=SMSSTR&to=$mobile&msg=".urlencode($smsText)."&type=1";
 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $sms_url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_exec($ch);
    curl_close($ch);		
	}	
	
?> 
<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/index.php/payments/thank.html?tn=<?php print $ePGTxnID; ?>&rm= <?php print $Message ?>';
</script><?php 

} 
else {	
	print "<h6>Response Code:: $ResponseCode <br>";
	print "<h6>Response Message:: $Message <br>";
	print "<h6>Auth ID Code:: $AuthIdCode <br>";
	print "<h6>RRN:: $RRN<br>";
	print "<h6>Transaction id:: $TxnID<br>";
	print "<h6>Epg Transaction ID:: $ePGTxnID<br>";
	print "<h6>CV Response Code:: $CVRespCode<br>";
	
	$upd_mcbill = "UPDATE voice_billing SET status=1, response_code='$ResponseCode', message='$Message', RRN='$RRN', epg_txnID='$ePGTxnID', authcode=$AuthIdCode WHERE transaction_id = $TxnID";
	mysql_query($upd_mcbill);	
	echo "<br><br><a href='$web_url/index.php/payments/index' >Back to Order</a>";
/* 	?>
<script language="javascript" type="text/javascript">
window.self.location='<?php print $web_url;?>/index.php/payments/cancel.html?tn=<?php print $ePGTxnID; ?>&rm=<?php print $Message ?>';
</script>
<?php */
	
 }
 mysql_close($conn);
?> 


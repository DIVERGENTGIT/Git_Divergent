<?php
$key = 1263052692505500;

$MerchantId = 129258;

echo 'Key: '.$key;
echo '<br />';
echo 'Merchant Id: '.$MerchantId;
echo '<br />';


function aes128Encrypt($str,$key)
{
	$block = mcrypt_get_block_size('rijndael_128', 'ecb');
	$pad = $block - (strlen($str) % $block);
	$str .= str_repeat(chr($pad), $pad);
	return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $str, MCRYPT_MODE_ECB));
}


//Mandatory Fields Start
$six_digit_random_number = mt_rand(100000, 999999);

	$ReferenceNo =$six_digit_random_number;
	$SubMarchantID =$MerchantId;
	$TransactionAmt =3;

	$mandatoryfields = $ReferenceNo.'|'.$SubMarchantID.'|'.$TransactionAmt;
	
	echo $Encrypt_MandatoryFields = aes128Encrypt($mandatoryfields,$key);
	
	


//Optional Fields End

	$returnurl = 'http://smsstriker.com/Payment/confirm/?tn=xxxxxxx&rm=xxxxxx';
	$Encrypt_ReturnUrl = aes128Encrypt($returnurl,$key);
	
	echo 'ReturnURL: '. $returnurl;
	echo '<br />';
	echo 'Encrypt ReturnURL: '. $Encrypt_ReturnUrl;
	echo '<br />';
	echo '<br />';	
	

	$Encrypt_ReferenceNo = aes128Encrypt($ReferenceNo,$key);
	echo 'ReferenceNo: ' .$ReferenceNo;
	echo '<br />';
	echo 'Encrypt ReferenceNo: ' .$Encrypt_ReferenceNo;
	echo '<br />';
	echo '<br />';
	


	$Encrypt_SubMerchantId = aes128Encrypt($SubMarchantID,$key);
	echo 'SubMarchantID: ' .$SubMarchantID;
	echo '<br />';
	echo 'Encrypt SubMarchantID: ' .$Encrypt_SubMerchantId;
	echo '<br />';
	echo '<br />';	
	

	$Encrypt_TransactionAmount = aes128Encrypt($TransactionAmt,$key);
	echo 'TransactionAmount: '.$TransactionAmt; 
	echo '<br />';
	echo 'Encrypt TransactionAmount: '.$Encrypt_TransactionAmount; 
	echo '<br />';
	echo '<br />';	
	
	$paymode = 9;
	$Encrypt_PaymentMode = aes128Encrypt($paymode,$key);
	echo 'PaymentMode: ' .$paymode;
	echo '<br />';
	echo 'Encrypt PaymentMode: ' .$Encrypt_PaymentMode;
	echo '<br />';
	echo '<br />';	

echo 'Before Encryption:';
echo '<br />';
echo '<br />';	


echo "https://eazypay.icicibank.com/eazypg?merchantid=129258&mandatoryfields=$mandatoryfields&optional fields=&returnurl=$returnurl&ReferenceNo=$ReferenceNo&submerchantid=$SubMarchantID&transaction amount=$transactionamount&paymode=$paymode";
echo "<br/>";

echo "https://eazypay.icicibank.com/EazyPG?merchantid=129258&mandatory fields=$Encrypt_MandatoryFields&optional fields=&returnurl=$Encrypt_ReturnUrl&Reference No=$Encrypt_ReferenceNo&submerchantid=$Encrypt_SubMerchantId&transaction amount=$Encrypt_TransactionAmount&paymode=$Encrypt_PaymentMode";


echo "<br/>";
echo "<a href='https://eazypay.icicibank.com/EazyPG?merchantid=129258&mandatory fields=$Encrypt_MandatoryFields&optional fields=&returnurl=$Encrypt_ReturnUrl&Reference No=$Encrypt_ReferenceNo&submerchantid=$Encrypt_SubMerchantId&transaction amount=$Encrypt_TransactionAmount&paymode=$Encrypt_PaymentMode'> PayNow</a>";


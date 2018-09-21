<?php
$key = 1263052692505500;

$MerchantId = 129258;


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
	$TransactionAmt =1;
	$mandatoryfields = $ReferenceNo.'|'.$SubMarchantID.'|'.$TransactionAmt;
	$Encrypt_MandatoryFields = aes128Encrypt($mandatoryfields,$key);
	$returnurl = 'http://pointsms.in/Payment/confirm/?tn=xxxxxxx&rm=xxxxxx';
	$Encrypt_ReturnUrl = aes128Encrypt($returnurl,$key);
	$Encrypt_ReferenceNo = aes128Encrypt($ReferenceNo,$key);
	$Encrypt_SubMerchantId = aes128Encrypt($SubMarchantID,$key);
	$Encrypt_TransactionAmount = aes128Encrypt($TransactionAmt,$key);
	$paymode = 9;
	$Encrypt_PaymentMode = aes128Encrypt($paymode,$key);
	

echo "<a href='https://eazypay.icicibank.com/EazyPG?merchantid=129258&mandatory fields=$Encrypt_MandatoryFields&optional fields=&returnurl=$Encrypt_ReturnUrl&Reference No=$Encrypt_ReferenceNo&submerchantid=$Encrypt_SubMerchantId&transaction amount=$Encrypt_TransactionAmount&paymode=$Encrypt_PaymentMode'> PayNow</a>";


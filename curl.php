<?php
/*
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_POSTFIELDS, $PostFields);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
echo $get_api_response = curl_exec ($ch);
*/
$ch= curl_init();
//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch,CURLOPT_POST, count($PostFields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $PostFields);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTREDIR, 3);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$get_api_response = curl_exec($ch);

?>

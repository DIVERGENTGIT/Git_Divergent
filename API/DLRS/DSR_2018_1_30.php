﻿<?php
$delivery=$_GET['delivery'];
//$delivery = 1;
$smscreply=$_GET['smscreply'];
//$smscreply = "";
$smscID=$_GET['smscid'];
//$smscid= "smsc1";
$id=$_GET['id'];
//$id = "186ced47";
$recipient=$_GET['receiver'];
//$recipient = "9";
$from = $_GET['sender'];
//$from = "temp";
$message=$_GET['message'];
//$message = "temp";
$username = $_GET['username'];
//$username="demo";
$type = $_GET['type'];
/* Make connection to database */


$dbase=mysql_pconnect("localhost","strikerapp",'Off!c3@v2017');
mysql_select_db("smpp", $dbase) or die(mysql_error());

$unicel_error_codes = array(
        '-01' => 'New Error Code',
        '000' => 'SMSC queue',
        '001' => 'DELIVRD',
        '002' => 'FAILED',
        '004' => 'DND Number',
        '044' => 'Promo Blocked',
        '005' => 'Blacklist',
        '006' => 'Whitelist',
        '007' => 'Invalid Series',
        '008' => 'Prepaid Reject',
        '009' => 'Night_Expiry',
        '099' => 'Night_Purge',
        '031' => 'EXP-AbsSubs',
        '032' => 'EXP-MEM-EXCD',
        '033' => 'EXP-NW-FAIL',
        '034' => 'EXP-NW-TMOUT',
        '035' => 'EXP-SMS-TMOUT',
        '036' => 'EXP-HDST-BUSY',
        '037' => 'EXP-MSG-Q-EXD'
);

$root_error_codes = array(
        '000' => 'Delivered',
        '001' => 'Unidentified subscriber',
        '005' => 'Unidentified subscriber',
        '009' => 'Illegal subscriber',
        '011' => 'Tele service not provisioned',
        '012' => 'Illegal Equipment',
        '013' => 'Call Barred',
        '021' => 'Facility not supported',
        '027' => 'Absent subscriber',
        '031' => 'Subscriber busy for MT_SMS',
        '032' => 'SM-Delivery Failure',
        '034' => 'System failure',
        '035' => 'Data missing',
        '036' => 'Unexpected Data value',
        '144' => 'Unrecognized component',
        '145' => 'Mistyped Component',
        '146' => 'Body structured component',
        '160' => 'Duplicate invoke ID',
        '161' => 'Unrecognized Operation',
        '162' => 'Mistyped Parameter',
        '163' => 'Resource Limitation',
        '164' => 'Initiating release',
        '165' => 'Unrecognized linked ID',
        '166' => 'Linked Response expected',
        '167' => 'Unexpected linked operation',
        '176' => 'Unrecognized invoke ID',
        '177' => 'Return result expected',
        '178' => 'Mistyped Parameter',
        '192' => 'Unrecognized invoke ID',
        '193' => 'Return Error unexpected',
        '194' => 'Unrecognized error',
        '195' => 'Unexpected Error',
        '196' => 'Mistyped parameter',
        '200' => 'Unable to decode response',
        '201' => 'Provider Abort',
        '202' => 'User Abort',
        '203' => 'Timeout',
        '204' => 'API error',
        '205' => 'Unknown Error',
        '404' => 'Invalid message content',
        '408' => 'DND error code',
        '409' => 'Source/template error code',
        '410' => 'Source/Template long message error code',
        '411' => 'Duplicate Submission',
       '412' => 'Destination Barred',
        '0x00000001' => 'Message Length is invalid',
        '0x00000002' => 'Command Length is invalid',
        '0x00000003' => 'Invalid Command ID',
        '0x00000004' => 'Incorrect BIND Status for given command.',
        '0x00000005' => 'ESME Already in Bound State',
        '0x00000006' => 'Invalid Priority Flag',
        '0x00000007' => 'Invalid Registered Delivery Flag',
        '0x00000008' => 'System Error',
        '0x0000000A' => 'Invalid Source Address',
        '0x0000000B' => 'Invalid Dest Addr',
        '0x0000000C' => 'Message ID is invalid.',
        '0x0000000D' => 'Bind Failed',
        '0x0000000E' => 'Invalid Password.',
        '0x0000000F' => 'Invalid System ID',
        '0x00000015' => 'Invalid Service Type',
        '0x00000043' => 'Invalid esm_class field data',
        '0x00000045' => 'submit_sm failed',
        '0x00000048' => 'Invalid Source address TON',
        '0x00000049' => 'Invalid Source address NPI',
        '0x00000050' => 'Invalid Destination address TON',
        '0x00000051' => 'Invalid Destination address NPI',
        '0x00000053' => 'Invalid system_type field',
         '1032' => 'DND Number'
);

/*$sinfini_error_codes = array(
        '000' => 'Delivered',
        '002' => 'Out of Range or Switched Off',
        '027' => 'Out of Range or Switched Off',
        '003' => 'Handset Memory Exceeded',
        '032' => 'Handset Memory Exceeded',
        '033' => 'Handset Memory Exceeded',
        '004' => 'Handset Error ( Illegal Equipment or Subscriber Busy )',
        '012' => 'Handset Error ( Illegal Equipment or Subscriber Busy )',
        '031' => 'Handset Error ( Illegal Equipment or Subscriber Busy )',
        '034' => 'Handset Error ( Illegal Equipment or Subscriber Busy )',
        '005' => 'Network Error',
        '088' => 'Network Error',
        '008' => 'Time Out ( No Delivery Status Possible )',
        '203' => 'Time Out ( No Delivery Status Possible )',
        '001' => 'Invalid Subscriber',
        '006' => 'Call & SMS Barred by the Subscriber',
        '013' => 'Call & SMS Barred by the Subscriber',
        '021' => 'Call & SMS Barred by the Subscriber',
        '123' => 'Call & SMS Barred by the Subscriber',
        '023' => 'Unknown Subscriber',
        '050' => 'Unknown Subscriber',
        '144' => 'Unknown Subscriber',
        '194' => 'Unknown Subscriber',
        '195' => 'Unknown Subscriber',
        '007' => 'Sender ID Blocked',
        '010' => 'Failed ( Data Not In Proper Format )',
        '035' => 'Failed ( Data Not In Proper Format )',
        '036' => 'Failed ( Data Not In Proper Format )',
        '100' => 'Failed ( Data Not In Proper Format )',
        '145' => 'Failed ( Data Not In Proper Format )',
        '015' => 'Failed ( Data Not In Proper Format )',
        '063' => 'Failed ( Data Not In Proper Format )',
        '089' => 'Failed ( Data Not In Proper Format )',
        '090' => 'Failed ( Data Not In Proper Format )',
        '091' => 'Failed ( Data Not In Proper Format )',
        '092' => 'Failed ( Data Not In Proper Format )',
        '146' => 'Failed ( Data Not In Proper Format )',
        '160' => 'Failed ( Data Not In Proper Format )',
        '161' => 'Failed ( Data Not In Proper Format )',
        '162' => 'Failed ( Data Not In Proper Format )',
        '163' => 'Failed ( Data Not In Proper Format )',
        '164' => 'Undelivered ( Out of Range or Switched off )',
        '165' => 'Undelivered ( Out of Range or Switched off )',
        '166' => 'Undelivered ( Out of Range or Switched off )',
        '0x00000450' => 'Blacklisted Number',
        '1104' => 'Blacklisted Number',
        '0x00000481' => 'DND Number',
        '1153' => 'DND Number',
        '0x00000500' => 'Not an Opt - In data',
        '1280' => 'Not an Opt - In data',
        '0x00000400' => 'Series has been Temporary / Permanently Blocked',
        '1024' => 'Series has been Temporary / Permanently Blocked',
        '0x00000404' => 'Invalid Destination number',
        '1028' => 'Invalid Destination number',
        '0x00000444' => 'Message rejected as Sender Id not allotted for ESME',
        '1092' => 'Message rejected as Sender Id not allotted for ESME',
        '0x00000555' => 'Time Out for Promotional Message',
        '1365' => 'Time Out for Promotional Message',
        '0x00000454' => 'Text Template does not match',
        '1108' => 'Text Template does not match',
        '0x00000455' => 'Sender ID not Found',
        '1109' => 'Sender ID not Found',
        '0x00000453' => 'Template not Found',
        '1107' => 'Template not Found'
);*/
$sinfini_error_codes = array(
'000'=>' DELIVRD',
'001'=> 'INVALID-SUB',
'002'=> 'INVALID-SUB',
'003'=> 'ABSENT-SUB',
'004'=> 'HANDSET-ERR',
'005' => 'BARRED',
'006' =>'HANDSET-ERR',
'007'=> 'HANDSET-ERR ',
'008'=> 'NET-ERR',
'009' => 'MEMEXEC',
'010'=> 'ABSENT-SUB',
'011' => 'FAILED',
'012'=> 'NET-ERR',
'013'=> 'MOB-OFF',
'014'=> 'FAILED',
'015'=> 'INVALID-SUB',
'016'=> 'HANDSET-BUSY',
'017'=> 'NET-ERR',
'018'=> 'SERIES-BLK',
'019'=> 'NET-ERR',
'019'=> 'NET-ERR',
'020'=> 'BARRED CUG reject',
'021'=> 'EXPIRED SMS timeout',
'0x00000400'=>'Series has been temporary / permanently blocked',
'1024'=>'Series has been temporary / permanently blocked',
'0x00000401'=>'Credit exhausted',
'1025'=>'Credit exhausted',
'0x00000404'=>'Invalid destination number',
'1028'=>'Invalid destination number',
'0x00000405'=>'ESME client error',
'1029'=>'ESME client error',
'0x00000421'=>'Message rejected due to Empty SMS',
'1057'=>'Message rejected due to Empty SMS',
'0x00000444'=>'Message rejected as sender id not allotted for ESME',
'1092'=>'Message rejected as sender id not allotted for ESME',
'0x00000454'=>'Text template does not match',
'1108'=>'Text template does not match',
'0x00000455'=>'Sender ID not found',
'1109'=>'Sender ID not found',
'0x00000453'=>'Template not found',
'1107'=>'Template not found',
'0x00000450'=>'Black-listed number',
'1104'=>'Black-listed number',
'0x00000481'=>'DND number',
'1153'=>'DND number',
'0x00000500'=>'Not an Opt - In data',
'1280'=>'Not an Opt - In data',
'0x00000555'=>'Time out for promotional message',
'1365'=>'Time out for promotional message',
'0x00000777'=>'Multiple Submission',
'777'=>'Multiple Submission',
'26' => 'Error in SRI response',
'28' => 'TPDU due to baring of MS',
'31' => 'Subscriber busy for MT SMS',
'34' => 'System failure, far end not responding',
'35' => 'DATA MISSING',
'36' => 'UNEXPECTED DATA VALUE',
'40' => 'Absent subscriber SM',
'270' => 'unknown subscriber',
'271' => 'Absent Subscriber',
'272' => 'temporary network issue',
'273' => 'Memory Capacity Exceeded',
'274' => 'Mobile Equipment Error',
'276' => 'Call Barred'
);


/*
$vfirst_error_codes = array(

        '000' => 'Delivered',
        '001' => 'Invalid Number',
    '002' => 'Out of Range or Switched Off',
    '003' => 'Memory Capacity Exceeded',
    '004' => 'Mobile Equipment Error',
    '005' => 'Network Error',
    '006' => 'Barring',
    '007' => 'Invalid Sender ID',
    '008' => 'Dropped',
    '009' => 'DND Number',
    '010' => 'Invalid Source Address',
        '011' => 'Invalid Dest Addr',
        '012' => 'Message ID is invalid',
        '013' => 'Bind Failed',
        '014' => 'Invalid Password',
        '015' => 'Invalid System ID',
        '017' => 'Cancel SM Failed',
        '019' => 'Replace SM Failed',
        '020' => 'Message Queue Full',
        '021' => 'Invalid Service Type',
        '051' => 'Invalid number of destinations',
        '052' => 'Invalid Distribution List name',
        '064' => 'Destination flag is invalid (submit_multi)',
        '066' => 'Invalid ▒submit with replace▒ request (i.e. submit_sm with replace_if_present_flag set)',
        '067' => 'Invalid esm_class field data',
        '068' => 'Cannot Submit to Distribution List',
        '069' => 'submit_sm or submit_multi failed',
        '072' => 'Invalid Source address TON',
        '073' => 'Invalid Source address NPI',
        '080' => 'Invalid Destination address TON',
        '081' => 'Invalid Destination address NPI',
        '083' => 'Invalid system_type field',
        '084' => 'Invalid replace_if_present flag',
        '085' => 'Invalid number of messages',
        '088' => 'Throttling error (ESME has exceeded allowed message limits)',
        '097' => 'Invalid Scheduled Delivery Time',
        '098' => 'Invalid message validity period (Expiry time)',
        '099' => 'Predefined Message Invalid or Not Found',
        '100' => 'ESME Receiver Temporary App Error Code',
        '101' => 'ESME Receiver Permanent App Error Code',
        '102' => 'ESME Receiver Reject Message Error Code',
        '103' => 'query_sm request failed',
        '192' => 'Error in the optional part of the PDU Body.',
        '193' => 'Optional Parameter not allowed',
        '194' => 'Invalid Parameter Length.',
        '195' => 'Expected Optional Parameter missing',
        '196' => 'Invalid Optional Parameter Value',
    '254' => 'Delivery Failure (used for data_sm_resp)',
        '255' => 'Unknown Error',
        '1024' => 'Cannot route message.',
        '1025' => 'Credit Check Failed.',
        '1027' => 'User account is frozen.',
        '1075' => 'Account not configured.',
        '1076' => 'Account Expired',
        '1077' => 'Spam Error',
        '1078' => 'DND Number',
        '1079' => 'Either Source or Destination number is empty',
    '1080' => 'Invalid Number Length',
        '1279' => 'Internal Error'

);
*/


$vfirst_error_codes = array(
'000' => 'Delivered',
'001' => 'Invalid Number',
'002' => 'Out of Range or Switched Off',
'003' => 'Memory Capacity Exceeded',
'004' => 'Mobile Equipment Error',
'005' => 'Network Error',
'006' => 'Barring',
'007' => 'Invalid Sender ID',
'008' => 'Dropped',
'009' => 'DND Number',
'010' => 'Invalid Source Address',
'011' => 'Invalid Dest Addr', 
'012' => 'Message ID is invalid',
'013' => 'Bind Failed',
'014' => 'Invalid Password',
'015' => 'Invalid System ID', 
'017' => 'Cancel SM Failed', 
'019' => 'Replace SM Failed', 
'020' => 'Message Queue Full', 
'021' => 'Invalid Service Type', 
'051' => 'Invalid number of destinations',
'052' => 'Invalid Distribution List name',
'064' => 'Destination flag is invalid (submit_multi)', 
'066' => 'Invalid \91submit with replace\92 request (i.e. submit_sm with replace_if_present_flag set)', 
'067' => 'Invalid esm_class field data',
'068' => 'Cannot Submit to Distribution List', 
'069' => 'submit_sm or submit_multi failed',
'072' => 'Invalid Source address TON',
'073' => 'Invalid Source address NPI',
'080' => 'Invalid Destination address TON',
'081' => 'Invalid Destination address NPI',
'083' => 'Invalid system_type field', 
'084' => 'Invalid replace_if_present flag', 
'085' => 'Invalid number of messages',
'088' => 'Throttling error (ESME has exceeded allowed message limits)',
'097' => 'Invalid Scheduled Delivery Time',
'098' => 'Invalid message validity period (Expiry time)',
'099' => 'Predefined Message Invalid or Not Found',
'100' => 'ESME Receiver Temporary App Error Code',
'101' => 'ESME Receiver Permanent App Error Code',
'102' => 'ESME Receiver Reject Message Error Code',
'103' => 'query_sm request failed', 
'192' => 'Error in the optional part of the PDU Body.',
'193' => 'Optional Parameter not allowed',
'194' => 'Invalid Parameter Length.', 
'195' => 'Expected Optional Parameter missing',
'196' => 'Invalid Optional Parameter Value',
'254' => 'Delivery Failure (used for data_sm_resp)',
'255' => 'Unknown Error',
'1024' => 'Cannot route message.', 	
'1025' => 'Credit Check Failed.', 
'1027' => 'User account is frozen.',
'1075' => 'Account not configured.', 
'1076' => 'Account Expired',
'1077' => 'Spam Error',
'1078' => 'DND Number',
'1079' => 'Either Source or Destination number is empty',
'1080' => 'Invalid Number Length',
'1279' => 'Internal Error',
'0x00000000' => 	'No Error' ,
'0x00000001'  =>	'Message Length is invalid' ,
'0x00000002'  =>	'Command Length is invalid' ,
'0x00000003'  =>	'Invalid Command ID' ,
'0x00000004'  =>	'Incorr ect BIND Status for given Command' ,
'0x00000005'  =>	'ESME Already in Bound State' ,
'0x00000006'  =>	'Invalid Priority Flag' ,
'0x00000007'  =>	'Invalid Registered Deliver y Flag' ,
'0x00000008'  =>	'System Error' ,
'0x0000000A'  =>	'Invalid Source Address' ,
'0x0000000B'  =>	'Invalid Destination Address' ,
'0x0000000C'  =>	'Message ID is invalid' ,
'0x0000000D'  =>	'Bind Failed' ,
'0x0000000E'  =>	'Bind Failed' ,
'0x0000000F'  =>	'Invalid System ID' ,
'0x00000011'  =>	'Cancel SM Failed' ,
'0x00000013'  =>	'Replace SM Failed' ,
'0x00000014'  =>	'Message Queue Full' ,
'0x00000015'  =>	'Invalid Service Type' ,
'0x00000033'  =>	'Invalid number of destinations' ,
'0x00000034'  =>	'Invalid Distribution List name' ,
'0x00000040'   =>	'Destination flag is invalid (submit_multi)',
'0x00000043'   =>	'Invalid esm_class field data' ,
'0x00000044'   =>	'Cannot Submit to Distribution List' ,
'0x00000045'   =>	'submit_sm or submit_multi failed /Tempalte /Sender Id mis match',
'0x00000048'   =>	'Invalid Source address TON' ,
'0x00000049'   =>	'Invalid Source address NPI' ,
'0x00000050'   =>	'Invalid Destination address TON' ,
'0x00000051'   =>	'Invalid Destination address NPI' ,
'0x00000053'   =>	'Invalid system_type field ',
'0x00000054'   =>	'Invalid replace_if_present flag' ,
'0x00000055'   =>	'Invalid number of messages ',
'0x00000058'   => 'Throttling error (ESME has exceeded allowed message limits)' ,
'0x00000061'  =>	'Invalid Scheduled Delivery Time' ,
'0x00000062'   => 'Invalid message validity  period (Expiry   time)' ,
'0x00000063'  =>	'Predefined Message Invalid or Not  Found' ,
'0x00000064'   => 'ESME Receiver Temporary App Error  Code ',
'0x00000065'   => 'ESME Receiver Permanent App Error  Code' ,
'0x00000066'   => 'ESME Receiver Reject Message Error Code' ,
'0x00000067'   =>	'query_sm request failed' ,
'0x000000C0'   => 'Error in the optional part of the PDU Body'   ,
'0x000000C1'   =>	'Optional Parameter not allowed' ,
'0x000000C2'   =>	'Invalid Parameter Length' ,
'0x000000C3'   =>	'Expected Optional Parameter missing' ,
'0x000000C4'   =>	'Invalid Optional Parameter Value ',
'0x000000FE'   => 'Delivery Failure (used for  data_sm_resp)' ,
'0x000000FF'   =>	'Unknown Error' ,
'0x00000400'   =>	'Cannot route message' ,
'0x00000401'   => 'Credit Check Failed' ,
'0x00000403'  =>	'User account is frozen' ,
'0x00000433'   =>	'Account not configured' ,
'0x00000434'  =>	'Account Expired' ,
'0X00000435'  => 'Duplicate Message',
'0x00000436'	=>'DNC Error' ,
'0x00000437'	=>'Either Source or Destination number is  Empty' ,
'0x00000438' =>	'Invalid Number Length' ,
'0x00000439'	=>'SPAM Check',
'0x000004ff'	=>'Internal Error' 
);


$loop_tran_error_codes = array(
    "000" => "Delivered",
    "001" => "Unknown subscriber",
    "009" => "Illegal subsciber(Not yet defined)",
    "11" => "Invalid Number",
    "011" => "Telecom services haven't been commissioned",
    "012" => "Illegal Equipment(Not yet defined)",
    "013" => "Call is Prohibited",
    "019" => "MS doesn't support short message service",
    "020" => "MS receiving error",
    "021" => "Facility doesn't support",
    "022" => "Memory is overflowed",
    "029" => "Absent Subscriber",
    "036" => "System Error",
    "037" => "GMSC applies for resource unsuccessfully",
    "038" => "Dialogue between GMSC and HLR is failure",
    "039" => "Dialogue between GMSC and HLR times out",
    "040" => "HLR Abort failure",
    "041" => "Routing acknowledgement data is wrong",
    "042" => "Inform indication parameter is wrong",
    "043" => "Dialogue between GMSC and VMSC is failure",
    "044" => "VMSC Abort failure",
    "045" => "VMSC system error",
    "046" => "UI length error",
    "047" => "Error code versions are not consistent",
    "050" => "Call doesn't respond",
    "051" => "Subscriber switches off mobile",
    "052" => "Roaming limitation",
    "052" => "Roaming limitation",
    "053" => "Unidentified subscriber",
    "054" => "Subscriber is cleared",
    "055" => "Subscriber is busy",
    "056" => "Response times out",
    "057" => "Valid data is passed",
    "059" => "HLR doesn't registrate subscriber",
    "060" => "Refuse by monitoring center",
    "061" => "VMSC fault is isolated",
    "062" => "HLR fault is isolated",
    "070" => "HlR returns to illegal destination SCCP address",
    "071" => "HLR returns to illegal source SCCP address",
    "072" => "HLR returns to unkown error",
    "073" => "HLR returns to potential versions which are unmatched",
    "074" => "HLR returns to remote versions which are not compatible",
    "075" => "HLR returns to remote address which can not be reached",
    "076" => "HLR returns to repeated Invoke ID",
    "077" => "HLR returns to the opposite end which doesn't support this service",
    "078" => "HLR returns to unidentified parameter",
    "079" => "HLR returns to resource which can not be used because of congestion",
    "080" => "HLR returns to dialogue which has began to be released",
    "081" => "HLR returns to unexpected operation response which  has been received from the opposite end",
    "082" => "HLR returns to services which haven't been completed",
    "083" => "HLR returns to response which hasn't been received",
    "084" => "HLR returns to  unexpected response which have been received",
    "085" => "VMSC returns to illegal SCCP address",
    "086" => "VMSC returns to illegal source SCCP address",
    "087" => "VMSC returns to unknown error",
    "088" => "Vmsc returns to potential versions which are unmatched with VMSC",
    "089" => "Vmsc returns to remote versions which are not compatible",
    "090" => "Vmsc returns to remote address which can not be reached",
    "091" => "VMSC returns to repeated Invoke ID",
    "092" => "Vmsc returns to the opposite end which doesn't support this service",
    "093" => "VMSC returns to unidentified parameter",
    "094" => "Resource can not be used because of congestion of VMSC return",
    "095" => "Dialogue of VMSC has began to be released",
    "096" => "VMSC returns to unexpected operation response from the opposite end which has been received",
    "097" => "Service of VMSC hasn't been completed",
    "098" => "VMSC returns to  response which hasn▒t been received",
    "099" => "VMSC returns to unexpected response which has been received",
    "100" => "VMSC traffic is overloaded",
    "501" => "Message blocked for illegal Sender ID prefix",
    "502" => "Message blocked for illegal category of Sender ID",
    "503" => "Message blocked for illegal time frame",
    "504" => "Message blocked for SP sender id",
    "505" => "Message blocked for preferences of destination subscriber",
    "506" => "Message blocked for failure to get preferences of destination"
);

$loop_promo_error_codes = array(
    "0" => "Delivered",
    "1" => "Unknown subscriber",
        "2" => "Undefined subscriber",
        "3" => "Invalid subscriber",
        "4" => "Teleservice not provisioned",
    "5" => "Call barred,The SMS of this subscriber is barred",
        "6" => "Closed user group (CUG) refuses",
        "7" => "Facility not supported",
        "8" => "Absent subscriber",
    "10" => "Sending SM fails",
        "11" => "Message queue full",
        "12" => "System failure",
        "13" => "Some mandatory fields are missing",
        "14" => "Unexpected data",
        "15" => "MS error data",
        "16" => "MS not equipped",
        "17" => "Phone memory full",
        "18" => "The SMSC is congested",
        "19" => "The MS does not register in the SMSC",
        "20" => "Invalid SME address",
        "21" => "Unknown SMSC",
        "22" => "Invalid mobile phone.The IMEI flag of the mobile phone is invalid",
        "23" => "Subscriber busy",
    "24" => "Subscriber power off",
        "30" => "HLR message decoding error",
        "31" => "HLR message decoding error",
        "32" => "INFORM_SC message decoding error",
        "33" => "The routing information obtained by the SMC is not enough.",
        "34"=>"Unexpected data from the HLR",
        "35"=>"Unexpected data from the MSC",
        "36"=>"Unknown error from the MSC",
        "37"=>"Unknown error from the HLR",
        "40"=>"HLR does not knowledge after the SMC sends a query request.",
        "41"=>"HLR does not acknowledge after the message of setting flag bit is sent by the SMC.",
        "45"=>"MAP version error",
        "46"=>"HLR version negotiation error",
        "48"=>"MSC does not acknowledge",
        "49"=>"HLR does not acknowledge",
        "50"=>"GIW (signaling gateway) not acknowledge",
        "51"=>"MSC refuses",
        "52"=>"HLR refuses",
        "53"=>"GIW refuses",
        "54"=>"Serving GPRS support node (SGSN) does not acknowledge.",
        "55"=>"SGSN refuses",
        "56"=>"HLR system error",
        "57"=>"MSC system error",
        "58"=>"SGSN system error",
        "61"=>"MAP server fails to deliver the SM due to flow control",
        "62"=>"MTI server fails to deliver the SM due to flow control",
        "63"=>"The destination signaling point or signaling connection control part (SCCP) cannot convey the message.",
        "64"=>"The interface has no right to deliver SMs.",
        "65"=>"GIW does not acknowledge within the time limit.",
        "66"=>"Delivering SM fails due to interface temporary error (has logged off or still has not logged on).",
        "67"=>"Invalid interface",
        "68"=>"The service module does not acknowledge within time limit after the SMC delivers an SM to it",
        "71"=>"The SMSC is disconnected from the L2CacheDaemon; therefore, the SMs to be stored into the L2Cache database are deleted.",
        "77"=>"Interface buffer full",
        "78"=>"Deleting SM in protection mode",
        "79"=>"The number of SMs exceeds the maximum submission number of the calling party. ",
        "128"=>"Teleservice facility interaction not supported",
        "129"=>"SM type not supported",
        "130"=>"Cannot replace SM",
        "143"=>"Unspecified TP-PID error",
        "144"=>"DCS of alphabet not supported",
        "145"=>"SM type not supported",
        "159"=>"Unspecified TP-DCS error",
        "160"=>"Operation cannot be performed.",
        "175"=>"Unspecified TP-Command error",
        "176"=>"TPDU not supported",
        "192"=>"SMC busy",
        "193"=>"No SMC specified (subscription)",
        "194"=>"SMC system error",
        "195"=>"Invalid external SM entity (ESME) address",
        "196"=>"SME barred",
        "208"=>"Subscriber identity module (SIM) full",
        "209"=>"The SIM does not have the capability to store SMs.",
        "210"=>"MS error.",
        "211"=>"ESME memory overflow.",
        "231"=>"The forwarded SM fails to be authenticated in the home SMC of the calling party.",
        "255"=>"Unspecified error cause"

        );

//$text="id:a6caf51d-66e6-4d80-933a-e227c47d7815 sub:000 dlvrd:001 submit date:100406123043 done date:100406123752 stat:DELIVRD err:000 text:";
//$text=$_GET['smscreply'];
// DSR.php?delivery=1&smscreply=id%3Ac8960424-cf3d-427c-ac95-673136abd84a+sub%3A001+dlvrd%3A001+submit+date%3A140826193136+done+date%3A140826193157+stat%3ADELIVRD+err%3A000+text%3A&smscid=c8960424-cf3d-427c-ac95-673136abd84a&messageid=&receiver=919550461310&id=2d897b89-4185-483a-9a12-108df04ab441
	$ans = $smscreply;	
	$error_txt = "";
	$datetemp = explode("done+date%3A",$ans);
	$datetemp1 = explode("+",$datetemp[1]);
	$smscdonedate = trim($datetemp1[0]);
          if($smscID == "unicel_promo" || $smscID == "unicel_home") {

               //$err_arry = explode("err%3A",$ans);
                //$err_array1 = explode("+",$err_arry[1]);
                //$error_code = trim($err_array1[0]);
                //$error_txt = $unicel_error_codes[$error_code];
				$err_arry = explode("err:",$ans);
                //print_r($err_arry);
                $err_array1 = explode(" ",$err_arry[1]);
                //echo "<br>"; 
               //print_r($err_array1);
                $error_code = trim($err_array1[0]);
                //echo $error_code;
				$error_txt = $unicel_error_codes[$error_code];
				

          } else if($smscID == "sinfini_tran" || $smscID == "sinfini_promo" || $smscID == "sinfini_home") {

                if($dlr == 16) {
                        $err_arry = explode("%2F",$ans);
                        $error_code = trim($err_arry[1]);
                        $error_txt = $sinfini_error_codes[$error_code];
                        if($error_txt =="")
					$error_txt ="Black Listed/Spam Error/DND Number";
                } else {
                        $err_arry = explode("err%3A",$ans);
                        $err_array1 = explode("+",$err_arry[1]);
                        $error_code = trim($err_array1[0]);
                        $error_txt = $sinfini_error_codes[$error_code];
                }

          } else if($smscID == "vfirst_home" || $smscID == "vfirst_promo") {

            if($dlr == 16) {
                $err_arry = explode("%2F",$ans);
                $error_code = trim($err_arry[1]);
                            $error_txt = $vfirst_error_codes[$error_code];
                                if($error_txt =="")
                                        $error_txt ="Invalid Number";

            } else {
				$err_arry = explode("err:",$ans);
				$err_array1 = explode(" ",$err_arry[1]);
				$error_code = trim($err_array1[0]);
				
                //$err_arry = explode("err%3A",$ans);
                //$err_array1 = explode("+",$err_arry[1]);
                //$error_code = trim($err_array1[0]);
                $error_txt = $vfirst_error_codes[$error_code];
            }
          } else if($smscID == "loop_tran" || $smscID == "loop_promo"){

          if($dlr == 16) {
              $err_arry = explode("%2F",$ans);
              $error_code = trim($err_arry[1]);
                         if($smscID == "loop_promo")
                          {
                                $error_txt = $loop_promo_error_codes[$error_code];
                          }
                          else
                          {
                                $error_txt = $loop_tran_error_codes[$error_code];
                          }

              //$error_txt = $loop_tran_error_codes[$error_code];
          } else {
              $err_arry = explode("err%3A",$ans);
              $err_array1 = explode("+",$err_arry[1]);
              $error_code = trim($err_array1[0]);
                         if($smscID == "loop_promo")
                          {
                                $error_txt = $loop_promo_error_codes[$error_code];
                          }
                          else
                          {
                                $error_txt = $loop_tran_error_codes[$error_code];
                          }

                         // $error_txt = $loop_tran_error_codes[$error_code];
          }

      } else if($smscID == "striker_promo" || $smscID == "striker_tran"){

          if($dlr == 16) {
              $err_arry = explode("%2F",$ans);
              $error_code = trim($err_arry[1]);
              $error_txt = $loop_tran_error_codes[$error_code];
          } else {
              $err_arry = explode("err%3A",$ans);
              $err_array1 = explode("+",$err_arry[1]);
              $error_code = trim($err_array1[0]);
              $error_txt = $loop_tran_error_codes[$error_code];
          }

      }else if($smscID == "root_trans" || $smscID == "root_promo") {

            if($dlr == 16) {
                $err_arry = explode("%2F",$ans);
                $error_code = trim($err_arry[1]);
                            $error_txt = $root_error_codes[$error_code];
                                if($error_txt =="")
                                        $error_txt ="Invalid Number";

            } else {
                $err_arry = explode("err%3A",$ans);
                $err_array1 = explode("+",$err_arry[1]);
                $error_code = trim($err_array1[0]);
                $error_txt = $root_error_codes[$error_code];
            }
	}

          if($error_txt == "DND Number") {
                        $delivery = 3;
          }
//mysql_query("INSERT INTO `smppdlr` VALUES ('".$text."')");

preg_match("([err]{3}[:]{1}[0-9]{3})",$text,$matchArray);

if(isset($matchArray[0])){
	
	$re=explode(':',$matchArray[0]);
$mt=", reply='".trim($re[1])." ' ";

}
else
$mt='';
$query = "INSERT INTO `smppdlr`(tonumber,fromnumber,text,ton,npi,smsctext,messageid,username,status,error,route) VALUES ('".$recipient."','".$from."','".$smscreply."','1','1','".$smscreply."','".$id."','".$username."','".$delivery."','','".$smscID."')";
echo $query;
mysql_query($query);

$sql="update sentsms set status='".$delivery."',error='".$error_txt."',smscdonedate=now() where messageid='".$id." ' ";

echo $sql;
$query=mysql_query($sql);

?>

<?php

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

$idea_error_codes = array( 
 '000'	    =>  'DELIVRD',
 '236'      =>  'Position Method Failure', 
 '247'      =>  'Unknown Alphabet', 
 '248'      =>  'USSD Busy', 
 '275'      =>  'Error Gateway', 
 '300'      =>  'Provider Error Duplicate Invoke ID', 
 '301'      =>  'Provider Error Service Not Supported', 
 '302'      =>  'Provider Error Mistyped Paramter', 
 '303'      =>  'Provider Error Resource Limitation', 
 '304'      =>  'Provider Error Initiating Release', 
 '305'      =>  'Provider Error Unexpected Response', 
 '306'      =>  'Provider Error Service Completion Failure', 
 '308'      =>  'Provider Error Invalid Response', 
 '401'      =>  'Stack/Sig Error Map User specific Reason', 
 '402'      =>  'Stack/Sig Error Map User Resource Limitation', 
 '403'      =>  'Stack/Sig Error Map Resource Unavailable', 
 '404'      =>  'Stack/Sig Error Map Application Procedure Cancellation', 
 '40A'      =>  'Stack/Sig Error Map Provider Malfunction', 
 '40B'      =>  'Stack/Sig Error Map Unrecognised Transaction ID', 
 '40C'      =>  'Stack/Sig Error Dialog Resource Limitation', 
 '40D'      =>  'Stack/Sig Error Map Maintenance Activity', 
 '40E'      =>  'Stack/Sig Error Map Version Incompatibility', 
 '40F'      =>  'Stack/Sig Error Abnormal Map Dialogue', 
 '414'      =>  'Stack/Sig Error Abnormal Event Detected by Peer', 
 '415'      =>  'Stack/Sig Response Rejected By Peer', 
 '416'      =>  'Stack/Sig Abnormal Event Recieved From Peer', 
 '417'      =>  'Stack/Sig Cannot deliver Message', 
 '41E'      =>  'Stack/Sig Application Context Not Supported', 
 '41F'      =>  'Stack/Sig Dlg Invalid Destination Reference', 
 '420'      =>  'Stack/Sig Invalid Origination Reference', 
 '421'      =>  'Stack/Sig No Reson', 
 '422'      =>  'Stack/Sig Remote Node Not Reachable', 
 '424'      =>  'Stack/Sig Secured Transport Not Possible', 
 '423'      =>  'Stack/Sig Map Potential Version Incompatibility', 
 '425'      =>  'Stack/Sig Usr Transport Protection Not Adequate', 
 '417'      =>  'Sig Error Map Invalid Response from peer', 
 '418'      =>  'Sig Error Map Dialogue Does not Exist', 
 '419'      =>  'Sig Error Map Max evoke reached', 
 '41A'      =>  'Sig Error Map guard Timer Expired', 
 '41B'      =>  'Sig Error Map SPCAUSE mask', 
 '41C'      =>  'Sig Error MAP No Translation Basd Address', 
 '41D'      =>  'Sig Error MAP No Translation specific address', 
 '428'      =>  'Sig Error MAP Subsystem congested', 
 '429'      =>  'Sig Error MAP Subsystem failure', 
 '42A'      =>  'Sig Error MAP Un Equipped User', 
 '42B'      =>  'Sig Error MAP Network Failure', 
 '42C'      =>  'Sig Error MAP Network Conjestion', 
 '42D'      =>  'Sig Error MAP un Qualified', 
 '42E'      =>  'Sig Error MAP HOP Counter violaion ANS92', 
 '42F'      =>  'Sig Error MAP Error in message transport CCIT92', 
 '430'      =>  'Sig Error MAP Error in local processing CCIT92', 
 '431'      =>  'Sig Error MAP Re assembly failure', 
 '432'      =>  'Sig Error MAP SCCP failure', 
 '433'      =>  'Sig Error MAP HOP counter violation ITU', 
 '434'      =>  'Sig Error MAP segmentation not supported', 
 '435'      =>  'Sig Error MAP Segmentation failure', 
 '206'      =>  'Absent Subscriber for SM', 
 '20D'      =>  'Call Barred', 
 '23A'      =>  'Unknown or Unreachable LCS Client', 
 '247'      =>  'Unknown Alphabet', 
 '248'      =>  'USSD Busy', 
 '275'      =>  'Error Gateway', 
 '300'      =>  'Provider Error Duplicate Invoke ID', 
 '301'      =>  'Provider Error Service Not Supported', 
 '302'      =>  'Provider Error Mistyped Paramter', 
 '303'      =>  'Provider Error Resource Limitation', 
 '304'      =>  'Provider Error Initiating Release', 
 '305'      =>  'Provider Error Unexpected Response', 
 '306'      =>  'Provider Error Service Completion Failure', 
 '308'      =>  'Provider Error Invalid Response', 
 '401'      =>  'Stack/Sig Error Map User specific Reason', 
 '236'      =>  'Position Method Failure', 
 '402'      =>  'Stack/Sig Error Map User Resource Limitation', 
 '403'      =>  'Stack/Sig Error Map Resource Unavailable', 
 '404'      =>  'Stack/Sig Error Map Application Procedure Cancellation', 
 '40A'      =>  'Stack/Sig Error Map Provider Malfunction', 
 '40B'      =>  'Stack/Sig Error Map Unrecognised Transaction ID', 
 '40C'      =>  'Stack/Sig Error Dialog Resource Limitation', 
 '40D'      =>  'Stack/Sig Error Map Maintenance Activity', 
 '40E'      =>  'Stack/Sig Error Map Version Incompatibility', 
 '40F'      =>  'Stack/Sig Error Abnormal Map Dialogue', 
 '414'      =>  'Stack/Sig Error Abnormal Event Detected by Peer', 
 '415'      =>  'Stack/Sig Response Rejected By Peer', 
 '416'      =>  'Stack/Sig Abnormal Event Recieved From Peer', 
 '417'      =>  'Stack/Sig Cannot deliver Message', 
 '41E'      =>  'Stack/Sig Application Context Not Supported', 
 '41F'      =>  'Stack/Sig Dlg Invalid Destination Reference', 
 '420'      =>  'Stack/Sig Invalid Origination Reference', 
 '421'      =>  'Stack/Sig No Reson', 
 '422'      =>  'Stack/Sig Remote Node Not Reachable', 
 '424'      =>  'Stack/Sig Secured Transport Not Possible', 
 '423'      =>  'Stack/Sig Map Potential Version Incompatibility', 
 '425'      =>  'Stack/Sig Usr Transport Protection Not Adequate', 
 '21F'      =>  'Subscriber Busy for MT', 
 '215'      =>  'Facility Not Supported', 
 '214'      =>  'SS Incompatible', 
 '220'      =>  'SM Delivery Fail', 
 '221'      =>  'Message List Full', 
 '222'      =>  'Network System Failure', 
 '223'      =>  'Data Missing', 
 '224'      =>  'Unexpected Data', 
 '21B'      =>  'Absent Subscriber for MT', 
 '22D'      =>  'Busy Subscriber', 
 '22E'      =>  'No Subscriber Reply', 
 '307'      =>  'Provider No Response from Peer', 
 '20B'      =>  'Tele Service Not Provisioned', 
 '407'      =>  'HLR/MSC Timeout', 
 '201'      =>  'Unknown Subscriber', 
 '202'      =>  'Unknown Base Station', 
 '203'      =>  'Unknown MSC', 
 '205'      =>  'Unidentified Subscriber', 
 '207'      =>  'Unknown Equipment', 
 '208'      =>  'Roaming Not Allowed', 
 '209'      =>  'Illegal Subscriber', 
 '20A'      =>  'Bearer Service Not Supported', 
 '20C'      =>  'Error Equipment', 
 '20E'      =>  'Error Forward Violation', 
 '20F'      =>  'Error CUG Reject', 
 '210'      =>  'Illegal SS Operation', 
 '211'      =>  'SS Error Status', 
 '212'      =>  'SS Not Available', 
 '213'      =>  'SS Subscription Violation', 
 '219'      =>  'No Handover Number Available', 
 '21A'      =>  'Subsequent Handover Failure', 
 '21C'      =>  'Incompatible Terminal', 
 '21D'      =>  'Short Term Denial', 
 '21E'      =>  'Long Term Denial', 
 '225'      =>  'PW Registration Failure', 
 '226'      =>  'Negative PW Check', 
 '227'      =>  'No Roaming Number Available', 
 '228'      =>  'Tracing Buffer Full', 
 '22C'      =>  'Number of PW attempts Violation', 
 '22F'      =>  'Forwarding Failed', 
 '230'      =>  'Not Allowed', 
 '231'      =>  'ATI Not Allowed', 
 '232'      =>  'No Group Call Number Available', 
 '233'      =>  'Resource Limitation', 
 '234'      =>  'Unauthorized Requesting Network', 
 '235'      =>  'Unathorized LCS Client', 
 '41D'      =>  'Sig Error MAP No Translation specific address', 
 '428'      =>  'Sig Error MAP Subsystem congested', 
 '429'      =>  'Sig Error MAP Subsystem failure', 
 '42A'      =>  'Sig Error MAP Un Equipped User', 
 '42B'      =>  'Sig Error MAP Network Failure', 
 '42C'      =>  'Sig Error MAP Network Conjestion', 
 '42D'      =>  'Sig Error MAP un Qualified', 
 '42E'      =>  'Sig Error MAP HOP Counter violaion ANS92', 
 '42F'      =>  'Sig Error MAP Error in message transport CCIT92', 
 '430'      =>  'Sig Error MAP Error in local processing CCIT92', 
 '431'      =>  'Sig Error MAP Re assembly failure', 
 '432'      =>  'Sig Error MAP SCCP failure', 
 '417'      =>  'Sig Error Map Invalid Response from peer', 
 '418'      =>  'Sig Error Map Dialogue Does not Exist', 
 '419'      =>  'Sig Error Map Max evoke reached', 
 '41A'      =>  'Sig Error Map guard Timer Expired', 
 '41B'      =>  'Sig Error Map SPCAUSE mask', 
 '41C'      =>  'Sig Error MAP No Translation Basd Address', 
 '433'      =>  'Sig Error MAP HOP counter violation ITU', 
 '434'      =>  'Sig Error MAP segmentation not supported', 
 '435'      =>  'Sig Error MAP Segmentation failure', 
 '220'      =>  'SM Delivery Fail - Equipment Protocol Err', 
 '220'      =>  'SM Delivery Fail - EQuipmet Not SM-Supported', 
 '220'      =>  'SM Delivery Fail - Unknown Service Centre', 
 '220'      =>  'SM Delivery Fail - SC Congestion', 
 '220'      =>  'SM Delivery Fail - Invalid SME Address', 
 '220'      =>  'SM Delivery Fail - Subscriber Not SC Subscriber', 
 '220'      =>  'SM Delivery Fail - Memory Capacity Exceeded', 
 '206'      =>  'Absent Subscriber for SM - IMSI Detach', 
 '206'      =>  'Absent Subscriber for SM - Restricted Area', 
 '206'      =>  'Absent Subscriber for SM - No Page Response', 
 '206'      =>  'Absent Subscriber for SM - Purge MS', 
 '400'      =>  'MAPPAbort', 
 '602'      =>  'Expired SM', 
 '600'      =>  'Failed due to congestion', 
'21455'   =>  'Destination IMSI barred', 
'409'   => 'Stack/SigInvalidConfirmation');

$bsnl_error_codes =  array(
'000' =>'DELIVRD',
'001' =>'Unknown Subscriber',
'023' =>'Unknown Subscriber',
'005' =>'Unmarked Subscriber',
'006'=>'VMSC:SM subscriber absent',
'009'=>'VMSC:illegal subscriber',
'011' =>'teleservice not supported',
'026' =>'teleservice not supported',
'012'=>'illegal device',
'013'  =>'call forbidden',
'024'=>'call forbidden',
'021' =>'the network does not support SMS',
'025' =>'the network does not support SMS',
'027'=>'VMSC:subscriber absent',
'031'=>'failure because the subscriber is busy',
'032'=>'Deliver fail',
'033' =>'HLR:Message Waiting List is Full',
'034'=>'GMSC:unknown reason',
'035'=>'VMSC:data lacked',
'036'=>'VMSC:unexpected data',
'090'=>'MS error',
'091' =>'SMS not supported by MS',
'092'=>'MS store is full',
'093'=>'SMSC is congestion',
'094'=>'subscriber is not mobile',
'095'=>'Illegal address',
'100'=>'no response from the called subscriber',
'101'=>'VMSC:the called MS poweroff',
'102'=>'VMSC:limited due to MS roaming',
'103'=>'the subscriber is erased',
'104'=>'unmarked SM subscriber',
'106'=>'MS response is overtime',
'107'=>'HLR:the subscriber is unregistered',
'110'=>'GMSC fails to apply for resource',
'111'=>'session between GMSC and HLR failed',
'112'=>'session between GMSC and HLR overtime',
'113'=>'GMSC receives abort message from HLR',
'114'=>'HLR:data error in route signal',
'115'=>'HLR:inform parameter error',
'116'=>'session between GMSC and VMSC failed',
'117'=>'GMSC receives abort message from VMSC',
'118'=>'VMSC system error received',
'119'=>'GMSC:incorrect SM length',
'120'=>'GMSC:inconsistent error code version',
'121'=>'SMS release message exception',
'122'=>'VMSC isolated',
'181'=>'service barred',
'182'=>'operation barred',
'190'=>'memCapaExc',
'191'=>'equiProtErr',
'192'=>'equiNotSMEqui',
'193'=>'unknServCent',
'194'=>'sc_Congestion',
'195'=>'invaSME_Add',
'196'=>'subsNotSC_Subsc',
'215'=>'HLR:limited due to MS roaming',
'217'=>'HLR:SM subscriber absent',
'218'=>'HLR:illegal subscriber',
'219'=>'HLR:subscriber absent',
'220'=>'HLR:the called MS poweroff',
'221'=>'HLR:data lacked',
'222'=>'HLR:unexpected data',
'223'=>'VMSC:Over Flow',
'225'=>'HLR:illegal destionation SCCP address',
'226'=>'HLR:illegal original SCCP address',
'227'=>'HLR:unknown error',
'228'=>'HLR:inconsistent version',
'229'=>'HLR:the remote version incompatible',
'230'=>'HLR:the remote address not reachable',
'231'=>'HLR:duplicated InvokeID',
'232'=>'HLR:the service not supported by the peer',
'233'=>'HLR:unrecognized parameter',
'234'=>'HLR:resource not available due to congestion',
'235'=>'HLR:session is rleasing',
'236'=>'HLR:unexpected operation response received from the peer',
'237'=>'HLR:service is not complete',
'238'=>'HLR:no response',
'239'=>'HLR:unexpected response received',
'240'=>'VMSC:illegal destionation SCCP address',
'241'=>'VMSC:illegal original SCCP address',
'242'=>'VMSC:unknown error',
'243'=>'VMSC:inconsistent version',
'244'=>'the content not supported',
'245'=>'VMSC:Invalid Destination',
'246'=>'VMSC:duplicated InvokeID',
'247'=>'VMSC:the service not supported by the peer',
'248'=>'VMSC:times of unrecognized parameter error',
'249'=>'VMSC:resource not available due to congestion',
'250'=>'VMSC:session is rleasing',
'251'=>'VMSC:unexpected operation response received from the peer',
'252'=>'VMSC:service not complete',
'253'=>'VMSC:no response','254'=>'VMSC:unexpected response received',
'009' => 'Illegal users',
'020' => 'Terminal receives an error',
'022' => 'Phone memory full',
'029' => 'Absent user',
'037' => 'GMSC application resource failed',
'038' => 'GMSC and HLR dialogue fails',
'039' => 'GMSC and HLR session timeout',
'040' => 'HLR Abort failure',
'041' => 'Routing confirmed data errors',
'042' => 'Inform indication parameter error',
'043' => 'GMSC and VMSC dialogue fails',
'044' => 'VMSC Abort failed VMSC Abort',
'045' => 'VMSC system error VMSC System Failure',
'046' => 'UI length error',
'047' => 'Error Code Error Code Version inconsistent versions',
'050' => 'Call unresponsive',
'051' => 'Users shutdown',
'052' => 'Roaming restrictions',
'053' => 'User is not identified',
'054' => 'Users are cleared',
'055' => 'User Busy',
'056' => 'Response Timeout',
'057' => 'Had valid',
'058' => 'Message deletion',
'059' => 'HLR unregistered users',
'060' => 'SMMC monitoring center is rejected',
'061' => 'VMSC fault isolation',
'062' => 'HLR fault isolation',
'070' => 'HLR return illegal purposes SCCP address',
'071' => 'HLR returns the illegal source SCCP address',
'072' => 'HLR returned an unknown error',
'073' => 'Potential returns do not match the version HLR',
'074' => 'HLR returns the version is not compatible with the distal',
'075' => 'HLR returns the remote address unreachable',
'076' => 'HLR return duplicate Invoke ID',
'077' => 'HLR returns the peer does not support this business',
'078' => 'HLR returns unrecognized parameter',
'079' => 'HLR returns the congestion caused by the resource unavailable',
'080' => 'HLR returns the dialogue has begun to release',
'081' => 'HLR returns received from peer unpredictable operation response',
'082' => 'HLR returns the service is not completed',
'083' => 'HLR returns a response is not received',
'084' => 'HLR returns did not receive the expected response',
'085' => 'vmsc return illegal purposes SCCP address',
'086' => 'vmsc return illegal source SCCP address',
'087' => 'vmsc returned an unknown error',
'088' => 'Potential returns do not match the version vmsc',
'089' => 'vmsc return is not compatible with versions of the distal',
'096' => 'vmsc returns received from peer unpredictable operation response',
'097' => 'vmsc return service is not completed',
'098' => 'vmsc returns not received a response',
'099' => 'vmsc return receive unexpected response',
'100' => 'vmsc traffic overload' 
);



$sinfini_error_codes = array(
'000'=>' DELIVRD',
'982' => 'Blacklist Number',
'928' => 'Blacklist Number',
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

$Gupshup_error_codes = array(
	'000' => 'Delivered',
	'001' => 'ABSENT_SUBSCRIBER',
	'002' => 'CALL_BARRED',
	'003' => 'UNKNOWN_SUBSCRIBER',
	'004' => 'SERVICE_DOWN',
	'005' => 'SYSTEM_FAILURE',
	'006' => 'DND_FAIL',
	'007' => 'BLOCKED',
	'008' => 'DND_TIMEOUT',	
	'009' => 'OUTSIDE_WORKING_HOURS',
	'010' => 'Message rejected due to service tempaorary not available',
	'011' => 'INBOXFULL',
	'012' => 'CONGESTION',
	'013' => 'NO_ACK_FROM_OPERATOR',
	'014' => 'Mobile Operator end issue',
	'015' => 'Mobile Operator end issue',
	'016' => 'Mobile Operator end issue',
	'017' => 'Mobile Operator end issue',
	'018' => 'Mobile Operator end issue',
	'019' => 'Mobile Operator end issue',
	'00a' => 'Mobile Operator end issue',
	'00b' => 'BLOCKED_MASK',
	'00c' => 'SMSCTIMEDOUT',
	'00d' => 'CANCEL_CAUSEID',
	'00e' => 'CANCEL_SCHEDULE',
	'01a' => 'Mobile Operator end issue',
	'01b' => 'Mobile Operator end issue',
	'01c' => 'Mobile Operator end issue',
	'020' => 'Mobile Operator end issue',
	'022' => 'BLOCKED_FOR_USER',
	'023' => 'UNKNOWN_SUBSCRIBER',
	'0x00000000' => 'NoError',
	'0x00000001' => 'MessageLengthisinvalid',
	'0x00000002' => 'CommandLengthisinvalid',
	'0x00000003' => 'InvalidCommandID',
	'0x00000004' => 'IncorrectBINDStatusforgivencommand',
	'0x00000005' => 'ESMEAlreadyinBoundState',
	'0x00000006' => 'Invalid Priority Flag',
	'0x00000007' => 'Invalid Registered Delivery Flag',
	'0x00000008' => 'System Error',	
	'0x0000000A' => 'Invalid Source Address',
	'0x0000000B' => 'Invalid DestAddr',
	'0x0000000C' => 'MessageIDisinvalid',
	'0x0000000D' => 'BindFailed',
	'0x0000000E' => 'InvalidPassword',
	'0x0000000F' => 'InvalidSystemID',
	'0x00000011' => 'CancelSMFailed',
	'0x00000013' => 'ReplaceSMFailed',
	'0x00000014' => 'MessageQueueFull',
	'0x00000015' => 'InvalidServiceType',
	'0x00000033' => 'Invalidnumberofdestinations',
	'0x00000034' => 'InvalidDistributionListname',
	'0x00000040' => 'Destinationflagisinvalid(submit_multi)',
	'0x00000042' => 'Invalid submitwithreplace request(i.e.submit_smwithreplace_if_present_flagset)',
	'0x00000043' => 'Invalidesm_classfielddata',
	'0x00000044' => 'CannotSubmittoDistributionList',
	'0x00000045' => 'submit_smorsubmit_multifailed',
	'0x00000048' => 'InvalidSourceaddressTON',
	'0x00000049' => 'InvalidSourceaddressNPI',
	'0x00000050' => 'InvalidDestinationaddressTON',
	'0x00000051' => 'InvalidDestinationaddressNPI',
	'0x00000053' => 'Invalidsystem_typefield',
	'0x00000054' => 'Invalidreplace_if_presentflag',
	'0x00000055' => 'Invalidnumberofmessages',
	'0x00000058' => 'Throttlingerror(ESMEhasexceededallowed messagelimits)',
	'0x00000061' => 'InvalidScheduledDeliveryTime',
	'0x00000062' => 'Invalidmessagevalidityperiod(Expirytime)',
	'0x00000063' => 'PredefinedMessageInvalidorNotFound',
	'0x00000064' => 'ESMEReceiverTemporaryAppErrorCode',
	'0x00000065' => 'ESMEReceiverPermanentAppErrorCode',
	'0x00000066' => 'ESMEReceiverRejectMessageErrorCode',	
	'0x00000067' => 'query_smrequestfailed',
	'0x000000C0' => 'ErrorintheoptionalpartofthePDUBody',
	'0x000000C1' => 'OptionalParameternotallowed',
	'0x000000C2' => 'InvalidParameterLength',
	'0x000000C3' => 'ExpectedOptionalParametermissing',
	'0x000000C4' => 'InvalidOptionalParameterValue',
	'0x000000FE' => 'DeliveryFailure(usedfordata_sm_resp)',
	'0x000000FF' => 'UnknownError',
	'0x00000400' => 'Cannotroutemessage',
	'0x00000401' => 'CreditCheckFailed',
	'0x00000403' => 'Useraccountisfrozen',
	'0x00000433' => 'Accountnotconfigured',
	'0X00000435' => 'SpamError',
	'0x00000436' => 'DNCError',
	'0x00000437' => 'EitherSourceorDestinationnumberisempty',
	'0x00000438' => 'InvalidNumberLength',
	'0x000004ff' => 'InternalError'
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

$route_error_codes = array(
	'000' => 'DELIVRD',
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
        '0x00000000'=>'DELIVRD',
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
	'0x00000058' => 'Exceeded allowed message limits',
	'0x00000062' => 'Invalid message validity period',
	'0x000000C0' => 'Error in the optional part of the PDU Body',
	'0x000000C1' => 'Optional Parameter not allowed',
	'0x000000C2' => 'Invalid Parameter Length',
	'0x000000C3' => 'Expected Optional Parameter missing',
	'0x000000C4' => 'Invalid Optional Parameter Value',
	'0x000000FE' => 'Delivery Failure',
	'0x00000401' => 'Credits are over',
	'0x00000404' => 'Spam content',
	'0x00000405' => 'Message length is exceeding',
	'0x00000406' => 'Invalid UDH length indicator',
	'0x00000407' => 'Message body not found',
	'0x00000408' => 'DND Number',
	'0x00000409' => 'Invalid template',
	'0x00000410' => 'Template long message error code',
	'0x00000411' => 'Duplicate Submission',
	'0x00000412' => 'Destination Source Barred', 
        '1032' => 'DND Number',
        '23' => 'ERR_DUMP_SUB',
	'19' => 'INVALID_VALIDITY_TIME',
	'40' => 'VMSC:data lacked',
	'41' => 'VMSC:unexpected data',
	'42' => 'MS error',
	'131' => 'EC_OR_remoteNodeNotReachable',
	'153' => 'EC_NNR_noTranslationForThisSpecificAddress',
	'157' => 'EC_NNR_MTPfailure',
	'180' => 'MAP-Open Refuse reason: Node Not Reached ',
	'189' => 'MAP-U-Abort User Reason: User Specific Reason ',
	'20b' => 'EC_SS_INCOMPATIBILITY',
	'222' => 'Undelivered',
	'256' => 'EC_SM_DF_memoryCapacityExceeded',
	'281' => 'EC_UA_userSpecificReason',
	'502' => 'EC_NO_RESPONSE',
	'88' => 'ITC_ERR_DB_UPD_FAILURE',
	'0x00000011'=>'Cancelling message failed',
'0x00000013'=>'Message recplacement failed',
'0x00000014'=>'Message queue full', 
'0x00000033'=>'Invalid number of destinations',
'0x00000034'=>'Invalid distribution list name',
'0x00000040'=>'Invalid destination flag',
'0x00000042'=>'Invalid submit with replace request',
'0x00000044'=>'Invalid submit to ditribution list',
'0x00000054'=>'Invalid replace_if_present flag',
'0x00000055'=>'Invalid number of messages',
'0x00000061'=>'Invalid scheduled delivery time',
'0x00000063'=>'Predefined message not found',
'0x00000064'=>'ESME Receiver temporary error',
'0x00000065'=>'ESME Receiver permanent error',
'0x00000066'=>'ESME Receiver reject message error',
'0x00000067'=>'Message query request faile',
'0x000000FF'=>'Unknown error',
'0x00000100'=>'ESME not authorised to use specified servicetype',
'0x00000101'=>'ESME prohibited from using specified operation',
'0x00000102'=>'Specified servicetype is unavailable',
'0x00000103'=>'Specified servicetype is denied',
'0x00000104'=>'Invalid data coding scheme',
'0x00000105'=>'Invalid source address subunit',
'0x00000106'=>'Invalid destination address subunit',
'0x0000040B'=>'Insufficient credits to send message',
'0x0000040C'=>'Destination address blocked by the ActiveXperts SMPP Demo Server',
'8'=>'ESME_RSYSERR',
'10'=>'ESME_RINVSRCADR',
'11'=>'ESME_RINVDSTADR',
'13'=>'ESME_BIND_FAILED',
'14'=>'ESME_RINVPASWD',
'15'=>'ESME_RINVSYSID',
'16'=>'ESME_BLACKLISTIP',
'18'=>'ESME_RINUSERIP',
'69'=>'ESME_RSUBMITFAIL',
'83'=>'ESME_RINSYSTYPE',
'110'=>'NO_RECORD_FOUND',
'1025'=>'INSUFFICIENT_CREDIT_USER',
'1026'=>'INSUFFICIENT_CREDIT_RUSER',
'1027'=>'INSUFFICIENT_CREDIT_DUSER',
'1028'=>'ESME_SPAM_MESSAGE',
'1029'=> 'ESME_RINVSMLEN',
'1030'=>'INVALID_UDH',
'1033'=>'MSG_TEMPLATE_MISMATCH',
'1035'=>'USER_OPTOUT',
'1036'=>'RESELLER_OPTOUT',
'1037'=>'DISTRIBUTOR_OPTOUT',
'1041'=>'DUPLICATE_MESSAGE',
'1042'=> 'EXPLICIT_DND_REJECT',
'1701'=>'SUCCESS',
'1702'=>'BAD_URL',
'1703'=>'BAD_USER_PASSWORD',
'1704'=>'BAD_TYPE',
'1705'=>'BAD_MESSAGE',
'1706'=>'BAD_DESTINATION',
'1707'=>'BAD_SOURCE',
'1708'=>'BAD_REGISTERED_DELIVERY',
'1709'=>'BIND_FAILED',
'1710'=>'UNKNOWN_ERROR',
'1711'=>'BAD_ENVIRONMENT',
'1712'=>'BAD_DB_CONNECTION',
'1713'=>'TOO_MANY_DESTINATIONS',
'1714'=>'NOT_ROUTABLE',
'1715'=>'RESPONSE_TIMEOUT',
'1813'=>'DATABASE_LOGGING_ERROR',
'1901'=>'INVALID_REQUEST_CONTENT_TYPE',
'1902'=>'BAD_SCHEDULE_DATE',
'1903'=>'BAD_GMT',
'1904'=>'BAD_SCHEDULE_TIME',
'1905'=>'BAD_SCHEDULE_TIMESTAMP',
'1913'=>'TOO_MANY_REQUEST',
'1914'=>'INVALID_DATE',
'1915'=>'NO_GROUP_AVAILABLE',
'1916'=>'NO_CONTACTS_AVAILABLE',
'0x00000435' => 'Multiple Submission' 
);

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
	'100' => 'Misc Error',
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
	'0x00000435' => 'Multiple Submission' 
    
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
    "098" => "VMSC returns to  response which hasn\92t been received",
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
//$file="/var/log/lighttpd/access.log.1";
//$string=trim(file_get_contents($file));
//$a=explode("\n",$string);
$link=mysql_pconnect("localhost","strikerapp",'Off!c3@v2017');
mysql_select_db("sms");

   $ss2 = $_SERVER['QUERY_STRING'];

  $c=explode("&",$ss2);
 
  $c1=$c[0];  
  $c2=$c[2];  
  $ans = $c[3];
   $c3=$c[4];
 $c4=$c[5];
  $c5=$c[6];
  
  //$c7 = $c[7];
  $c8 = $c[7];
  //print_r($c);
  $campaign_id=trim(str_replace("campaign_id=","",$c1));
  $dlr=trim(str_replace("dlr=","",$c2));
  $pos = strpos($c3, 'to=91');
  if (($pos === 0)) {
    $to=trim(str_replace("to=91","",$c3));
  }else{
    $to=trim(str_replace("to=","",$c3));
  }
  
   $port_no = '';      
  $port_no = trim(str_replace("sms_port=","",$c8));
  
  
 // $file_name = trim(str_replace("file_name=","",$c8));
  //echo "\n".$file_name."\n";
  if($dlr != 8) {
  
    $smscID = trim(str_replace('smscID=','',$c[1]));
    //$uType = trim(str_replace('uType=','',$c7));
  
  	$error_txt = "";
	  if($smscID == "unicel_promo" || $smscID == "unicel_home") {
	  
	  	$err_arry = explode("err%3A",$ans);
  		$err_array1 = explode("+",$err_arry[1]);
  		$error_code = trim($err_array1[0]);  		
	  	$error_txt = $unicel_error_codes[$error_code];
	  	
	  } else if($smscID == "sinfini_tran" || $smscID == "sinfini_promo" || $smscID == "sinfini_home") {
	  	
	  	if($dlr == 16) {
	  		$err_arry = explode("%2F",$ans);
  			$error_code = trim($err_arry[1]);
	  		$error_txt = $sinfini_error_codes[$error_code];
	  		if($error_txt =="")
				//$error_txt ="DND Number";
				$error_txt="";
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
					$error_txt ="Misc Error";
				
            } else {
                $err_arry = explode("err%3A",$ans);
                $err_array1 = explode("+",$err_arry[1]);
                $error_code = trim($err_array1[0]);
                $error_txt = $vfirst_error_codes[$error_code];
            }
	  } else if($smscID == "root_trans" || $smscID == "root_promo") {

            if($dlr == 16) {
                $err_arry = explode("%2F",$ans);
                $error_code = trim($err_arry[1]);
			    $error_txt = $root_error_codes[$error_code];
				//echo "ERROR CODE : ".$error_code."ERROR :".$error_txt;
				if($error_txt =="")
					$error_txt ="Misc Error";
				
            } else {
                $err_arry = explode("err%3A",$ans);
                $err_array1 = explode("+",$err_arry[1]);
                $error_code = trim($err_array1[0]);
                $error_txt = $root_error_codes[$error_code];
            }
	  } else if($smscID == "route_home" || $smscID == "route_trans" || $smscID == "route_promo"  || $smscID == "route_otp") {

            if($dlr == 16) {
                $err_arry = explode("%2F",$ans);
                $error_code = trim($err_arry[1]);
			    $error_txt = $route_error_codes[$error_code];
				//echo "ERROR CODE : ".$error_code."ERROR :".$error_txt;
				if($error_txt =="")
					$error_txt ="Misc Error";
				
            } else {    
           	
                $err_arry = explode("err%3A",$ans);
                $err_array1 = explode("+",$err_arry[1]);
                $error_code = trim($err_array1[0]);
                if(!$error_code) {
                 	$cd = date('Y-m-d');
            	 	error_log("\n".date('Y-m-d H:i:s')."| API Data |".$ss2."\n",3,"/var/www/html/strikerapp/api_log/dlrs_log/response_dlrs_".$cd.".log"); 
                }
                $error_txt = $route_error_codes[$error_code];
            	if(!$error_txt) {
                	 $err_arry = explode("stat%3A",$ans); 
                	 $err_array1 = explode("+",$err_arry[1]);
                	 $error_txt = trim($err_array1[0]);
                	 
                }
            }
	  }else if($smscID == "BS-TRANS" || $smscID == "BS-PRO" || $smscID == "strikersoftsmpp" || $smscID == "strikersoft" ) {

            if($dlr == 16) {
                $err_arry = explode("%2F",$ans);
                $error_code = trim($err_arry[1]);
			    $error_txt = $bsnl_error_codes[$error_code];
				//echo "ERROR CODE : ".$error_code."ERROR :".$error_txt;
				if($error_txt =="")
					$error_txt ="Misc Error";
				
            } else {    
           	  
                $err_arry = explode("err%3A",$ans);
                $err_array1 = explode("+",$err_arry[1]);
                $error_code = trim($err_array1[0]);
                if(!$error_code) {
                 	$cd = date('Y-m-d');
            	 	error_log("\n".date('Y-m-d H:i:s')."| API Data |".$ss2."\n",3,"/var/www/html/strikerapp/api_log/dlrs_log/response_dlrs_".$cd.".log"); 
                }
                $error_txt = $bsnl_error_codes[$error_code];
            	if(!$error_txt) {
                	 $err_arry = explode("stat%3A",$ans); 
                	 $err_array1 = explode("+",$err_arry[1]);
                	 $error_txt = trim($err_array1[0]);
                	 
                }
            }
	  }
	  
	  else if($smscID == "AI-TRANS") {

            if($dlr == 16) {
                $err_arry = explode("%2F",$ans);
                $error_code = trim($err_arry[1]);
			    $error_txt = $idea_error_codes[$error_code];
				//echo "ERROR CODE : ".$error_code."ERROR :".$error_txt;
				if($error_txt =="")
					$error_txt ="Misc Error";
				
            } else {    
           	  
                $err_arry = explode("err%3A",$ans);
                $err_array1 = explode("+",$err_arry[1]);
                $error_code = trim($err_array1[0]);
                if(!$error_code) {
                 	$cd = date('Y-m-d');
            	 	error_log("\n".date('Y-m-d H:i:s')."| API Data |".$ss2."\n",3,"/var/www/html/strikerapp/api_log/dlrs_log/response_dlrs_".$cd.".log"); 
                }
                $error_txt = $idea_error_codes[$error_code];
            	if(!$error_txt) {
                	 $err_arry = explode("stat%3A",$ans); 
                	 $err_array1 = explode("+",$err_arry[1]);
                	 $error_txt = trim($err_array1[0]);
                	 
                }
            }
	  }
	  
	  else if($smscID == "Gupshup_trans" || $smscID == "Gupshup_promo") {

            if($dlr == 16) {
                $err_arry = explode("%2F",$ans);
                $error_code = trim($err_arry[1]);
			    $error_txt = $Gupshup_error_codes[$error_code];
				//echo "ERROR CODE : ".$error_code."ERROR :".$error_txt;
				if($error_txt =="")
					$error_txt ="Misc Error";
				
            } else {
                $err_arry = explode("err%3A",$ans);
                $err_array1 = explode("+",$err_arry[1]);
                $error_code = trim($err_array1[0]);
                $error_txt = $Gupshup_error_codes[$error_code];
            }
	  }
            else if($smscID == "loop_tran" || $smscID == "loop_promo"){

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

      }
	  
	  if($error_txt == "DND Number")
	   {
  			$dlr = 3;
  	  }
  
	  $from=trim(str_replace("from=","",$c4));
	  $ts=trim(str_replace("ts=","",$c5));
	  $d=explode(" ",$ts);
	  $date_time=trim($d[0]);
	  
	//  echo $file_name. "Campaign ID: ".$campaign_id. " to: ".$to." DLR: ".$dlr." smscID: ".$smscID." Error code: ".$error_code." Error Text: ".$error_txt."\n";
	  
      $error_code = mysql_real_escape_string($error_code);
      $error_txt = mysql_real_escape_string($error_txt);
     // $fp = fopen('/tmp/tempdata.txt', 'a');
$backup_table="sms_api_messages_dlr";

if($dlr == 2 && $error_code == '000' ) {
	
	$cd = date('Y-m-d');
	$cdTime = date('Y-m-d H:i:s');
	$requestBody = "  dlr_status=$dlr,error_code=$error_code,error_text=$error_txt,  message_id=$campaign_id ,to_mobileno=$to, Route = $smscID ";
	error_log("\n".date('Y-m-d H:i:s')."| API Data |".$requestBody."\n",3,"/var/www/html/strikerapp/api_log/dlrs_log/dlrs_2_".$cd.".log");
	//$dlr = 1; 
	$error_txt = 'EXPIRED';  
}




if(empty($error_txt)) { 
	$error_txt = "Misc Error";
}


   
mysql_query("update sms_api_messages set dlr_status='$dlr',error_code='$error_code',error_text='$error_txt',delivered_on=FROM_UNIXTIME($ts) where message_id='$campaign_id' and to_mobileno='$to'");



  /** Changed by Saisandeepthi 2018-07-10 Starts **/
  
  // Means knowing that first reprocess dlr's updated for that changing flag 're_campaign_dlr_status' as 1 
  mysql_query("update sms_api_messages set re_campaign_dlr_status=1 where message_id='$campaign_id' and to_mobileno='$to' AND re_campaign_status = 1");
    
  // Means knowing that second reprocess dlr's updated for that changing flag 're_campaign_dlr_status' as 2
  mysql_query("update sms_api_messages set re_campaign_dlr_status=2 where message_id='$campaign_id' and to_mobileno='$to' AND re_campaign_status = 2");
   
    /** Changed by Saisandeepthi 2018-07-10 Ends **/
  

mysql_query("insert into $backup_table set dlr_status='$dlr',to_mobileno='$to',message_id='$campaign_id',error_code='$error_code',error_text='$error_txt',delivered_on=FROM_UNIXTIME($ts),port_no='$port_no'"); 


//$jobID = $campaign_id;  

	$date = date('Y-m-d');
$retrunURL = ''; 
  
 
$getUserData = mysql_query("SELECT user_id,job_id FROM sms_api_messages WHERE message_id='".$campaign_id."'");

if(mysql_num_rows($getUserData) > 0) {
	$getUserDataRes = mysql_fetch_array($getUserData);   
	$userID = $getUserDataRes['user_id'];
	$jobID = $getUserDataRes['job_id'];  
	$userReturnURL = mysql_query("SELECT returnURL FROM userReturnDLRsURL WHERE user_id = $userID ");
	$text = "SELECT returnURL FROM userReturnDLRsURL WHERE user_id = $userID ";
	if($userID == 6260) {
		//error_log($text."\r\n",3,"/var/www/html/logs/office24by7_log/demores_".$date.".log");
	}
	    
	$rows = mysql_num_rows($userReturnURL);  

	if(mysql_num_rows($userReturnURL) > 0) { 
	$date = date('Y-m-d');
		$userReturnURLRes = mysql_fetch_array($userReturnURL);  
		
		$retrunURL = $userReturnURLRes['returnURL'];
		//error_log($retrunURL."\r\n",3,"/var/www/html/logs/office24by7_log/demores_".$date.".log"); 
 		returnDLRs($retrunURL,$jobID,$to,$dlr,$error_code,$error_txt,$ts);
		   	  			
	}     
}
  
}    

function returnDLRs($retrunURL,$campaign_id,$to,$dlr,$error_code,$error_txt,$ts) {
	$date = date('Y-m-d');
	$request = array("CampaignID" => $campaign_id,"ToMobile" => $to,"DLR" => $dlr,"ErrorCode" => $error_code,"ErrorText" => $error_txt,"DeliveredON" => ($ts),'retrunURL'=>$retrunURL);      
	 $requestL = json_encode($request,true);    
	//error_log($requestL."\r\n",3,"/var/www/html/logs/office24by7_log/demores_".$date.".log");   
	 $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$retrunURL);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');  
	curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$response = curl_exec($ch);//echo $response;   
}


    
  
  
 	
mysql_close($link);
?>

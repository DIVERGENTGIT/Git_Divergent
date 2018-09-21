<?php

$server_ip = "localhost";
$db_user = "strikerapp";
$db_pass = 'Off!c3@v2017';  
$db_name = "sms";  

mysql_connect($server_ip,$db_user,$db_pass);
mysql_select_db($db_name);


include("/var/www/html/strikerapp/smslib/config.inc");
include("/var/www/html/strikerapp/smslib/functions.inc");



        $campaign_no_rs = mysql_query("SELECT sms_text,to_mobile_no FROM campaigns_to WHERE campaign_id=1530221  AND dlr_status='0' AND error_code is NULL ");
      

   $available_port=47313;
                
                    while($to_details_val = mysql_fetch_array($campaign_no_rs))
                    {
                        $sms_txt = $to_details_val['sms_text'];
                        $sms_txt1 = mysql_real_escape_string($sms_txt);
                        $to_mobile = $to_details_val['to_mobile_no'];

                        //check is block listed number?
                        $blockedNumberRes = mysql_query("SELECT count(*) FROM sms.block_listed_numbers WHERE mobile_no = '{$to_mobile}'");
                        $blockedNumberRow = mysql_fetch_array($blockedNumberRes);
                        $is_block_listed = $blockedNumberRow[0];
                        if($is_block_listed){
                            mysql_query("insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,dlr_status,error_text) values('$new_campaign_id','$to_mobile','$sms_txt1',now(),'2','Block Listed Number')");
                        } else {
                            if(!$user_type){
                                //check for dnd number
                                $checkDndRes = mysql_query("SELECT count(*) FROM dnd_db.ndnc_data WHERE dnc_number = '{$to_mobile}'");
                                $checkDndRow = mysql_fetch_array($checkDndRes);
                                $isDND = $checkDndRow[0];
                                if($isDND){
                                    mysql_query("insert into campaigns_to(campaign_id,to_mobile_no,sms_text,sent_on,dlr_status) values('$new_campaign_id','$to_mobile','$sms_txt1',now(),'3')");
                                } else {
                                    $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_txt);
                                    $URL .= "$mclass&dlr-mask=31&dlr-url=".urlencode("https://www.smsstriker.com/API/DLRS/dlr.php?campaign_id=$new_campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

                                    http_send($URL,$available_port);
                           
                                }
                            } else {
                                $URL = "/cgi-bin/sendsms?username=".USERNAME."&password=".PASSWORD."&from=".urlencode($sender)."&to=91$to_mobile&text=".urlencode($sms_txt);
                                $URL .= "$mclass&dlr-mask=31&dlr-url=".urlencode("https://www.smsstriker.com/API/DLRS/dlr.php?campaign_id=$new_campaign_id&smscID=%i&dlr=%d&answer=%A&to=%p&from=%P&ts=%T");

                                http_send($URL,$available_port);
                               
                            }
                        }
                    }
                    


<?php 

include("/var/www/html/strikerapp/API/dbconnect/config.php"); 
 global $mysqli;

 
$table_name="large_campaign_activities";
 $sqlto="SELECT COUNT(*) AS COUNT FROM $table_name  WHERE status='0'";
$campaignresultto = $mysqli->query($sqlto);
$campaignto = $campaignresultto->fetch_array(MYSQLI_ASSOC);
//print_r($campaignto);

if ($campaignto['COUNT'] > 0) 
{
$query="SELECT * FROM $table_name  WHERE status='0' order by 1 limit 1";
$rslt = $mysqli->query($query);
    
if($rslt->num_rows > 0)
	{
	$data = $rslt->fetch_array(MYSQLI_ASSOC);
	$id=$data['id'];  
	$userId=$data['user_id'];
	$campaign_id=$data['campaign_id'];
	$original_file="/var/www/vhosts/www.smsstriker.com/htdocs/".$data['file_path'];
	$original_file = str_replace(" ","_",$original_file);
        $mobile_no_column=$data['mobile_no_column'];
        $sms_text=$data['sms_text'];
        
        $is_schedule=$data['is_schedule'];
        $from_row=$data['from_row'];
        $to_row=$data['to_row']; 
        $totalnoofsms=$data['no_of_sms'];       
        
	
	$Filepath=$original_file;
	//require('/var/www/vhosts/www.smsstriker.com/htdocs/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
	//require('/var/www/vhosts/www.smsstriker.com/htdocs/spreadsheet-reader-master/SpreadsheetReader.php');
	require('/var/www/html/strikerapp/spreadsheet-reader-master/php-excel-reader/excel_reader2.php');
	require('/var/www/html/strikerapp/spreadsheet-reader-master/SpreadsheetReader.php');
	date_default_timezone_set('UTC');
	$StartMem = memory_get_usage();

      	if($campaign_id) 
      		{
		$mysqli->query("update $table_name set status='1' where id='$id'");
		$Spreadsheet = new SpreadsheetReader($Filepath);
		$BaseMem = memory_get_usage();
		$Sheets = $Spreadsheet -> Sheets();
		
		$i=0;$string = "";
		$maxrows=0;$maxcols=0;
		
		$var_positions_msg=explode("#",$sms_text);
		$varpositionscount=count($var_positions_msg);
		$data_array = array();
		$total_no_of_sms = 0;
		
		
		foreach ($Sheets as $Index => $Name)
			{
			$Spreadsheet -> ChangeSheet($Index);
			foreach ($Spreadsheet as $Key => $Row)
				{
				/*if ($Row){print_r($Row);}else	{var_dump($Row);}if ($Key && ($Key % 500 == 0))	{}*/
				//echo "Key $Key and row  ";print_r($Row);
				$maxrows++;$i++;
				for($j = 0; $j < sizeof($Row); $j++) 
				   { 
				      $uploded_data[$i-1][$j] = $Row[$j];
		                   }
		                   
             			}
                	break;
               		}
                $max_rows=$maxrows;
                
                if(!$mobile_no_column){$mobile_no_column=0;}
                if(!$sms_text){$sms_text=1;}
                
                if(!$from_row){$from_row=2;}
		if($to_row > $max_rows){$to_row=$max_rows;}
		for ($i = $from_row-1; $i <= $to_row; $i++) 
			{
                        $mobile_no = trim($uploded_data[$i][$mobile_no_column]);
                        
                        if(strlen($mobile_no)>0 && $mobile_no!=0)
                            {
                            $message = "";
                            for($j=0;$j<$varpositionscount;$j++) 
                                {
                                if($j%2 == 1) 
                                    {
                                    $colstringValue = $var_positions_msg[$j];
                                    $colIndex = $colstringValue;
                                    $message .= trim($uploded_data[$i][$colIndex]);
                                    }
                                else 
                                    {
                                    $message .= $var_positions_msg[$j];
                                    }
                                }
                                // calculate SMS length
                       
			        if(strlen($message)>160)	$sms_length_tmp=ceil(strlen($message)/153);
			        else	$sms_length_tmp=ceil(strlen($message)/160);
			        $sms_length=$sms_length_tmp;
			        $total_no_of_sms = $total_no_of_sms + $sms_length;
			        //$data_array[] = array($mobile_no, $message);
			    
			              /*   if(strlen($message)>160)	$sms_length_tmp=ceil(strlen($message)/153);
				else	$sms_length_tmp=ceil(strlen($message)/160);
				$sms_length=$sms_length_tmp; // changed on 26-12-2013 as per santosh request
				*/
				$mysqli->query("insert into schedule_campaigns_to set campaign_id='$campaign_id',sms_text='$message',to_mobile_no='$mobile_no'");
				//mysql_query("update users set available_credits = available_credits - $sms_length where user_id='$userId'");
				
				


				
				
                            }

               		}
               					
	
				//update customized SMS sample SMS 
				//$this->Campaign_model->update_campaign_sample_text($campaign_id, $message);
			if($is_schedule > 0) 
				{
                                /// $this->Campaign_model->update_campaign_status($campaign_id, '1');
                                $mysqli->query("update campaigns set campaign_status='1' where campaign_id='$campaign_id'");
                            	}
                        else 
                        	{
                                 //   $this->Campaign_model->update_campaign_status($campaign_id, '2');
                                $mysqli->query("update campaigns set campaign_status='1' where campaign_id='$campaign_id'");
                                }
			$mysqli->query("update $table_name set status='2' where id='$id'");
                        }
              
  $usr= $mysqli->query("select username from users where user_id=$userId");
	$usr = $usr->fetch_array(MYSQLI_ASSOC);
		$uname=$usr['username'];
  if($totalnoofsms>200000)
		{
			//sms_alert($uname,$total_no_of_sms,$campaign_id);
		}
				
	}
}

function sms_alert($uname,$totalnoofsms,$campaign_id){
	$user="support"; //your username
	$password="Str!k3r2020"; //your password
$message = "Large Campaign Alert. From User $uname ,Campaign ID: $campaign_id and Total Campaign Size : $totalnoofsms"; //enter Your Message

	$senderid="STRIKR"; //Your senderid
	$messagetype="1"; //Type Of Your Message
	$url="http://www.smsstriker.com/API/sms.php";
	
	$message = urlencode($message);
	$ch = curl_init();
	if (!$ch){die("Couldn't initialize a cURL handle");}
	$ret = curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt ($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	//curl_setopt ($ch, CURLOPT_POSTFIELDS,
	//"username=$user&password=$password&to=$mno&msg=$message&from=$senderid&type=$messagetype");
		
	  curl_setopt ($ch, CURLOPT_POSTFIELDS,
	"username=$user&password=$password&to=9581479111,7659897711,9701019800,9966487711&msg=$message&from=$senderid&type=$messagetype");

	$ret = curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$curlresponse = curl_exec($ch); // execute
	     }
echo "end";
mysql_close();
?>

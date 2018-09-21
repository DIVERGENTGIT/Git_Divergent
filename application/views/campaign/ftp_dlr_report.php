<script type="text/javascript">
$(document).ready(function(){
	$(".btn").click(function(){
		$("#myModal").modal('show');
	});
});
</script>
 <script>
 $(document).ready(function(){
  $(function() {
    $( "#datepicker" ).datepicker();
  });
});
 </script>
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/analytics-icon.png" class="right-title-img">SMS Delivery Report</h3>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
    <table id="rounded-corner" class="table_all">
    <thead>
    	<tr>
		 <th colspan="2">DLR Status</th>
		 <th class="rounded-q4" colspan="2"> 
	
	
	<br/>
	
    <?php
    		 
 
			$dnd_count= $dlr_report['dnd_count'];
			$delivered_count= $dlr_report['delivered_count'];
			$invalid_nos_count= $dlr_report['invalid_nos_count'];
			$out_of_range_count= $dlr_report['out_of_range_count'];
			$memory_capacity_exceeded_count= $dlr_report['memory_capacity_exceeded_count'];
			$network_error_count= $dlr_report['network_error_count'];
			$barring_count= $dlr_report['barring_count']; 
			//$dnd_count= $dlr_report['total_count'];
			$invalid_number_length_count= $dlr_report['invalid_number_length_count'];
			$dest_no_empty_count= 0;
			$multiple_submit_count= $dlr_report['multiple_submit_count'];
			$account_expired_count= 0;
			$delivery_failure_count= 0;
			$misc_error_count= $dlr_report['misc_error_count'];  
			$dropped_count= 0;
			$invalid_sender_ids_count= $dlr_report['invalid_sender_ids_count'];
			$mobile_equipment_error_count= $dlr_report['mobile_equipment_error_count'];
			$pending_dlrs_count= $dlr_report['pending_dlr_count'];
			$total_count = $dlr_report['total_count'];
			$promo_blocked_count= $dlr_report['promo_blocked_count'];
			/*foreach($dlr_report as $dlr):
				$total_count++;	 
 			if($dlr->dlr_status==3)
			{
				$dnd_count++;  
			}
			//if($dlr->dlr_status==1 or $dlr->dlr_status=='0'  ) [Change1] ref: Excel point1, mail subject : Technical Works To Be Done
										//Line commented on 16 July 2014
			if($dlr->dlr_status==1) // [Change1] Updates for  16 July 2014
			{
				$delivered_count++;
			}
			
			//if($dlr->dlr_status=="") //[Change1] Line commented on 16 July 2014
			if($dlr->dlr_status=="" or $dlr->dlr_status=='0')//[Change1]New if cond added on 16 July 2014
			{ 
				$pending_dlrs_count++; //[Change1] uncommented line on 16 july 2014
				//$delivered_count++;
			}

if($dlr->dlr_status==16 )
{
		if($dlr->error_text=='Duplicate Msg')
		{
			$multiple_submit_count++;
		}
		
		if($dlr->error_code=='1080' || $dlr->error_code=='1081' || $dlr->error_code=='NULL' || $dlr->error_code==''
		|| $dlr->error_text=='Invalid Number')
		{
				$invalid_nos_count++;
		}
			
		
		
		if($dlr->error_code=='0x00000404' || $dlr->error_text=='Invalid destination number')
		{
			$invalid_number_length_count++;
		}
		
		if($dlr->error_code=='0x00000450' || $dlr->error_text=='Black-listed number')
		{
			$misc_error_count++;
		}
		
		if($dlr->error_code=='0x00000455' || $dlr->error_text=='Sender ID not found')
		{
			$invalid_sender_ids_count++;
		}

	if($dlr->error_code=='1077' || $dlr->error_text=='Spam Error')
	{
		$misc_error_count++;
	}
	if($dlr->error_code=='0x00000481' || $dlr->error_text=='DND number' || $dlr->error_code=='0x00000436')
		{
					$dnd_count++;	
		}



}

	
		
		if($dlr->dlr_status==2)
		{
if($dlr->error_code=='001' || $dlr->error_code=='005' || $dlr->error_code=='015' ||  $dlr->error_code=='1080')
$invalid_nos_count++;


if($dlr->error_code=='002' || $dlr->error_code=='027' || $dlr->error_code=='203'|| 
$dlr->error_code=='010' || $dlr->error_code=='016' )


$out_of_range_count++;	


if($dlr->error_code=='003' || $dlr->error_code=='013' || $dlr->error_code=='412'|| $dlr->error_code=='009' )
$memory_capacity_exceeded_count++;	


if($dlr->error_code=='004' || $dlr->error_code=='012' || $dlr->error_code=='007')
$mobile_equipment_error_count++;

							
if($dlr->error_code=='005' ||$dlr->error_code=='008'|| 
$dlr->error_code=='161' || $dlr->error_code=='034' || $dlr->error_code=='033'|| $dlr->error_code=='017' )
$network_error_count++;	


if($dlr->error_code=='006')
$barring_count++;

if($dlr->error_code=='006')
$barring_count++;

if($dlr->error_code=='1077' || $dlr->error_code=='411') 
$multiple_submit_count++;
	
if($dlr->error_code=='1078' || $dlr->error_code=='478' || $dlr->error_code=='1032' || $dlr->error_code=='1078' || $dlr->error_code=='0x00000481' || $dlr->error_code=='0x00000436')
$dnd_count++;	




if($dlr->error_code=='100' || $dlr->error_code=='020' || 
$dlr->error_code=='019' || $dlr->error_code=='410' || 
$dlr->error_code=='409' || $dlr->error_code=='404' || 
$dlr->error_code=='205' || $dlr->error_code=='204' || 
$dlr->error_code=='202' || $dlr->error_code=='201' || 
$dlr->error_code=='200' || $dlr->error_code=='196' || 
$dlr->error_code=='195' || $dlr->error_code=='194' || 
$dlr->error_code=='193' || $dlr->error_code=='192' || 
$dlr->error_code=='178' || $dlr->error_code=='177' || 
$dlr->error_code=='176' || $dlr->error_code=='167' || 
$dlr->error_code=='166' || $dlr->error_code=='165' || 
$dlr->error_code=='164' || $dlr->error_code=='163' || 
$dlr->error_code=='162' || $dlr->error_code=='161' || 
$dlr->error_code=='160' || $dlr->error_code=='146' || 
$dlr->error_code=='145' || $dlr->error_code=='144' || 
$dlr->error_code=='036' || $dlr->error_code=='035' || 
$dlr->error_code=='034' || $dlr->error_code=='032' || 
$dlr->error_code=='031' || $dlr->error_code=='021' || 
$dlr->error_code=='011' || $dlr->error_code=='037' ||
$dlr->error_code=='090' || $dlr->error_code=='102' || 
$dlr->error_code=='109' || $dlr->error_code=='124' || 
$dlr->error_code=='252')						
$misc_error_count++;

if($dlr->error_code=='044')

$promo_blocked_count++;

				}

			endforeach; */
	?> 
    </th>
		</tr>
	</thead>
    <tr>
		<td>Delivered</td>
		<td><?php echo $delivered_count; ?></td>
		<td>Invalid Destination Number</td>
		<td><?php echo $invalid_nos_count; ?></td>
    </tr>    
    <tr>
		<td >Out of Range or Switched Off</td>
		<td><?php echo $out_of_range_count; ?></td>
		<td>Handset Memory Capacity Exceeded</td>
		<td><?php echo $memory_capacity_exceeded_count; ?></td>
        
    </tr>    

      

    <tr>
		<td>Mobile Equipment Error</td>
		<td><?php echo $mobile_equipment_error_count; ?></td>
		<td>Network Error</td>
		<td><?php echo $network_error_count; ?></td>
    </tr>    
      

    <tr>
		<td>Barring</td>
		<td><?php echo $barring_count; ?></td>
		<td>Invalid Sender ID</td>
		<td><?php echo $invalid_sender_ids_count; ?></td>
    </tr>    

       

    <tr>
		<td>Dropped</td>
		<td><?php echo $dropped_count; ?></td>
		<td>Misc. Error</td>
		<td><?php echo $misc_error_count+$delivery_failure_count; ?></td>
    </tr> 
      

    <tr>
		<td >Promo Blocked</td>
		<td><?php echo $promo_blocked_count; ?></td>
		<td>Invalid Destination Number Length</td>
		<td><?php echo $account_expired_count; ?></td>
    </tr>    

  
    <tr>
		<td>Multiple Submission</td>
		<td><?php echo $multiple_submit_count; ?></td>
		<td>DND Number</td>
		<td><?php echo $dnd_count; ?></td>
    </tr> 
      
      <tr>
		<td nowrap>Either Source or Destination number is empty</td>
		<td><?php echo $dest_no_empty_count; ?></td>
		<td>Invalid Number Length</td>
		<td><?php echo $invalid_number_length_count; ?></td>
    </tr> 
     
    <tr>
		<td>Pending DLRs</td>
		<td><?php echo $pending_dlrs_count; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
    </tr> 
    <tr>
		<td ><strong>Total </strong></td>
		<td>&nbsp;</td>
		<td ><strong>  &nbsp; </strong></td>
		<td><strong><?php echo $total_count; ?></strong></td>
    </tr>           
   </table>
   </div> 
<!--   dispaly numbers ols style -->
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<?php if($detailed_dlr_report==1)
	{
	?> <a style="float: right;" href="<?php echo site_url('ftpcampaign/download_dlr_report/'.$campaign_id); ?>" class="bt_green"><span class="submit_btn">Download Report</span></a>
    <?php } else { ?>
    <a style="float: right;" href="<?php echo site_url('ftpcampaign/download_dlr_report/'.$campaign_id); ?>" class="submit_btn">
     Download Report </strong><span class="bt_green_r"></a>	    
    <?php } ?>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 mrgtop40 padding_zero">
<table id="rounded-corner" class="table_all">
    <thead>
    	<tr class="sendee-color sorting">
		 <th class="rounded-company">SL.No</th>
		 <!--<th scope="col" class="rounded">Mobile No</th> -->
		  <th class="rounded">Account No</th>
		 <th class="rounded">Sent time</th>
		 <th class="rounded">Delivery time</th>
		 <th class="rounded-q4">DLR Status</th>
		</tr>
	</thead>

	<tbody>
	<?php 
	
		$count= $offset + 1;
		foreach($dlr_report_old as $dlr):		 
	?>
	<tr>
		<td><?php echo $count; ?></td>
		<td><?php echo $dlr->acccount_num;//$dlr->to_mobile_no; ?></td>
		<td><?php echo $dlr->sent_on; ?></td>
		<td><?php echo $dlr->delivered_on; ?></td>
		<td>
            <?php
            //if(strlen($dlr->to_mobile_no) < 10): //[Change1] two lines were commented on July 16 2014
            //    echo "Invalid Number";
            //elseif($dlr->dlr_status == "" || $dlr->dlr_status == 0 || $dlr->dlr_status == 1):
            // [Change1] Above line commented on 16 July 2014
            // [Change1] Below if added on 16 July 2014
            //elseif($dlr->dlr_status == 1): [Change1] Line commented on 16 July 2014
           /* if($dlr->dlr_status == 1):
                echo "Delivered";
                //elseif($dlr->dlr_status == 1) :
                //echo "Delivered";
                // [Change1] below two line uncommented on 16 July 2014
            elseif($dlr->dlr_status == "" || $dlr->dlr_status == 0) :
                echo "Pending DLR";
            elseif($dlr->dlr_status == 16 && ($dlr->error_code=='1080' || $dlr->error_code=='1081' || $dlr->error_code=='NULL' || $dlr->error_code=='')):
                echo "Invalid Number";
                elseif($dlr->dlr_status==16 && $dlr->error_code=='1077'):
                echo "Same Msg submit to multiple times";
            else:
                if($dlr_report_type == 0):
                    echo "Delivered";
                elseif(($dlr_report_type != 0) && $dlr->dlr_status == 3):
                    echo "DND Number";
                elseif($dlr_report_type == 2):
                    if($dlr->dlr_status == 2):
                    
                    
                        echo "Failed - " . $dlr->error_text;
                    elseif($dlr->dlr_status == 4):
                        echo "Queued at SMSC - " . $dlr->error_text;
                    endif;
                else:
                    echo "Delivered";
                endif;
            endif;*/
            
            //code change on 12 aprl 2016
            
            if($dlr->dlr_status == 1)
            {
              echo "Delivered";  
            }
            elseif($dlr->dlr_status == "" || $dlr->dlr_status == 0)
            {
              echo "Pending DLR";
            }
            elseif($dlr->dlr_status == 16)
            {
            //  echo "Invalid Number";
		echo $dlr->error_text;
            }
            elseif($dlr->dlr_status==16 && $dlr->error_code=='1077')
            {
                echo "Same Msg submit to multiple times";
               
            }
            elseif($dlr->dlr_status == 2)
            {
             echo "Failed - " . $dlr->error_text;
            }
           
             elseif($dlr->dlr_status == 3 || $dlr->error_code=='0x00000481')
            {
             echo "DND";
            }
            
            
            elseif($dlr->dlr_status == 2 && ($dlr->error_code=='1078' || $dlr->error_code=='478' || $dlr->error_code=='1032'))
           {
            echo "DND";
           }
           elseif($dlr->dlr_status==4) 
           {
           echo "Queued at SMSC - " . $dlr->error_text;
           }
            
              
            ?>
		</td>		 	
	</tr>
		    
	<?php 
	$count++; 
	endforeach;
	?>
	</tbody>
	</table>
	</div>
	<?php
if($this->session->userdata('user_id')==4022 || $this->session->userdata('user_id')==4330 || $this->session->userdata('user_id')==4456 || $this->session->userdata('user_id')==4410 || $this->session->userdata('user_id')==2917){
?>

	<div align='' class="back col-md-4 well"  class="pagination" style=" float:left; background-color:transparent !important; border:none !important; box-shadow:none !important;">
		<a href="<?php echo site_url('ftpcampaign/viewcampaigns/'); ?>" class="bt_green"><span class="bt_green_lft"></span><strong>Back</strong><span class="bt_green_r"></span></a>	 
	</div>    
	<?php }else {?>
	  
		<div align='' class="back col-md-4 well"  class="pagination" style=" float:left; background-color:transparent !important; border:none !important; box-shadow:none !important;">
		<a href="<?php echo site_url('ftpcampaign/viewcampaigns/'); ?>" class="bt_green"><span class="bt_green_lft"></span><strong>Back</strong><span class="bt_green_r"></span></a>	 
	</div>
	<?php } ?>
	
	
		 <div align='' class="pagination col-md-6 well" style="background-color:transparent !important; border:none !important; box-shadow:none !important; margin-top: -2px;margin-bottom:50px; float:right; text-align:right;">
		  <?php echo $this->pagination->create_links(); ?>
		</div>
</div>

    </div>



    </div><!-- ./wrapper -->
</div>
  
  
  
</html>

<script type="text/javascript">
$(document).ready(function(){
	$(".btn").click(function(){
		$("#myModal").modal('show');
	});
});
</script>
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/sms-icon.png" class="right-title-img">SMS Delivery Report</h3>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
 
    <div class="table-responsive">
    <table class="table_all">
    <thead>
    	<tr>
		 <th colspan="2">DLR Status</th>
		 <th colspan="2"> <?php /*?> <?php
	$file_type_options = array(
                  'xls'  => 'Excel',
                  'txt'    => 'Text',
                );	
	?>
   File Format :  <?php echo  form_dropdown('file_format', $file_type_options , 'all' ,'class="selectText"');?> &nbsp;<?php */?>
    
	
	
	
    <?php  
			// print_r($dlr_report);
 
			$dnd_count= $dlr_report['dnd_count'];
			$delivered_count= $dlr_report['delivered_count'];   
			$invalid_nos_count= $dlr_report['invalid_nos_count'];
			$out_of_range_count= $dlr_report['out_of_range_count'];
			$memory_capacity_exceeded_count= $dlr_report['memory_capacity_exceeded_count'];
			$network_error_count=   $dlr_report['network_error_count'];
			$barring_count= $dlr_report['barring_count'];
   
			$invalid_number_length_count= $dlr_report['invalid_number_length_count'];
			$dest_no_empty_count= 0;
			$multiple_submit_count= $dlr_report['multiple_submit_count'];
			$account_expired_count= 0;  
			$delivery_failure_count= 0; 
			$misc_error_count= $dlr_report['misc_error_count'];  
			$dropped_count= 0;  
			$invalid_sender_ids_count=  $dlr_report['invalid_sender_ids_count'];
			$mobile_equipment_error_count= $dlr_report['mobile_equipment_error_count'];
			$pending_dlrs_count= $dlr_report['pending_dlr_count'];
			$total_count= $dlr_report['total_count'];
			$promo_blocked_count= $dlr_report['promo_blocked_count'];
			 
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
    </div>
<!--   dispaly numbers ols style -->
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<?php if($detailed_dlr_report==1)
	{
	?> <a style="float: right;" href="<?php echo site_url('campaign/downloadDlrReport_new/'.$campaign_id); ?>" class="bt_green"><span class="submit_btn">Download Report</span></a>
    <?php } else { ?>
    <a style="float: right;" href="<?php echo site_url('campaign/downloadDlrReport/'.$campaign_id); ?>" class="submit_btn">
     Download Report </strong><span class="bt_green_r"></a>	 
    <?php } ?>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 mrgtop40 form-div padding_zero">
 <div class="table-responsive">
<table id="rounded-corner" class="table_all">
    <thead>
    	<tr>
		 <th>SL.No</th>
		 <th>Mobile No</th>
		 <th>Sent time</th>
		 <th>Delivery time</th>
		 <th>DLR Status</th>
		</tr>
	</thead>
    
                        
 
	<tbody>
	<?php 
	
		$count= $offset + 1;
		foreach($dlr_report_old as $dlr):		 
	?>
	<tr>
		<td><?php echo $count; ?></td>
		<td><?php echo $dlr->to_mobile_no; ?></td>
		<td><?php echo $dlr->sent_on; ?></td>
		<td><?php echo $dlr->delivered_on; ?></td>  
		<td>
            <?php
           
            
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
           } elseif($dlr->dlr_status==11)
           {
           echo $dlr->error_text;
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
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
	<?php
if($this->session->userdata('user_id')==4022 || $this->session->userdata('user_id')==4330 || $this->session->userdata('user_id')==4456 || $this->session->userdata('user_id')==4410 || $this->session->userdata('user_id')==2917){
?>

	<div align='' class="col-md-6 col-sm-6 padding_ltzero col-xs-12"  class="pagination" style=" float:left; background-color:transparent !important; border:none !important;padding-left:0px;box-shadow:none !important;">
		<a href="<?php echo site_url('campaign/viewcampaigns/'); ?>" class="bt_green"><span class="bt_green_lft"></span><strong>Back</strong><span class="bt_green_r"></span></a>	 
	</div>
	<?php }else {?>
	
		<div class="col-md-6 col-sm-6 col-xs-12 padding_ltzero"  class="pagination" style=" float:left; background-color:transparent !important; border:none !important; box-shadow:none !important;">
		<a href="<?php echo site_url('campaign/viewcampaigns/'); ?>" class="bt_green"><span class="bt_green_lft"></span><strong>Back</strong><span class="bt_green_r"></span></a>	 
	</div>
	<?php } ?>
	
	
		 <div class="pagination col-sm-6 col-md-6 col-xs-12" style="background-color:transparent !important; border:none !important; box-shadow:none !important; margin-top: -2px;margin-bottom:50px; float:right; text-align:right;">
		  <?php echo $this->pagination->create_links(); ?>
		</div>
		</div>
</div>

    </div>


    </div><!-- ./wrapper -->

  
  
  
</html>


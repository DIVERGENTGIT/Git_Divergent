
 <script type="text/javascript">	
			$(function(){
				 $('#rangeA').daterangepicker({arrows:false,dateFormat: 'yy-mm-dd'}); 
			 });
		</script>
            
<script type="text/javascript">
$(document).ready( function(){
	 $('#from_date').datetimepicker({	
		 	dateFormat: 'yyyy-mm-dd'
	 });

	 $('#to_date').datetimepicker({	
		 	dateFormat: 'yyyy-mm-dd'
	 });
});
</script>
<h2>SMS Campaign Report</h2>
	<div class="form">	 
		 <?php echo form_open('campaign/viewcampaigns1',array('name' => 'campaign_search', 'id' => 'campaign_search')); ?>
		<?php 
		 $options = array(
                  'all'  => 'All',
                  '000'    => 'Delivered',
                  'expired_count'   => 'Expired',
                  'dnd_count' => 'DND',
				  'invalid_count'   => 'Invalid',
                  'pending_dlrs_count' => 'Pending DLR',
				  
                );
				
		$file_type_options = array(
                  'xls'  => 'Excel',
                 // 'txt'    => 'Text',
                );		
		//$status_ = array('small', 'large');
				
		 ?>
         
         <table width="426" align="center" cellpadding=0 cellspacing=0 class="textsmstd" >
		 <tr><td width="108">Date :&nbsp;</td>
		 <td width="51"><?php echo form_input(array('name' => 'rangeA', 'id' => 'rangeA', 'placeholder' => 'Date Range', 'class' => 'inputText', 'style' => 'width:200px;', 'value' => set_value('rangeA')))?>&nbsp;</td> 
		
        <?php if($user_type)
		{?><td width="86">Sender:&nbsp; </td>
           <td width="133"><?php echo form_dropdown('sender', $sender_names, set_value('sender'),  'class="selectText"');?> &nbsp;</td>
		</tr>
        <?php } ?> 
         
         <tr>
           <td width="108">Mobile  :&nbsp;</td>
		 <td width="51"><?php echo form_input(array('name' => 'mobile_no_', 'id' => 'mobile_no_', 'placeholder' => 'Mobile number', 'class' => 'inputText', 'style' => 'width:200px;', 'value' => set_value('mobile_no_')))?>&nbsp;</td> 
		
       
		</tr>
         
         <tr>
           <!--<td>Status :&nbsp; </td>
           <td><?php echo  form_dropdown('status_', $options, set_value('status_') ,'class="selectText"');?> &nbsp;</td>-->
           <td>File Format:&nbsp; </td>
           <td><?php echo  form_dropdown('file_format', $file_type_options , 'all' ,'class="selectText"');?> &nbsp;</td>
           
		 <td width="46">&nbsp;<?php echo form_submit(array('name' => 'Search','value' => 'Go', 'class' => 'button'));?></td>
		 </tr>
		 </table>
         * Reports from  <b><?php echo date('Y-m-d', time()-60*60*48 );?> </b> only can be viewed / downloaded through search option
		 <?php echo form_close();?>
	
	<br>
	</br>
    
  <?php /*?> <?php 
   			$total_count=0;
			$delivered_count=0;
			$expired_count=0;
			$dnd_count=0;
			$invalid_count=0;
			$pending_dlrs_count=0;
			$undelivered_count=0;
			$dnd_count=0;
			$delivered_count=0;
			$invalid_nos_count=0;
			$out_of_range_count=0;
			$memory_capacity_exceeded_count=0;
			$network_error_count=0;
			$barring_count=0;
			$dnd_count=0;
			$invalid_number_length_count=0;
			$dest_no_empty_count=0;
			$multiple_submit_count=0;
			$account_expired_count=0;
			$delivery_failure_count=0;
			$misc_error_count=0;
			$dropped_count=0;
			$invalid_sender_ids_count=0;
			$mobile_equipment_error_count=0;
			$pending_dlrs_count=0;
			$total_count=0;
			if($search_result_rs!='')
			{
				
			foreach($search_result_rs as $dlr):
			
			
			
 			if($dlr->dlr_status==3)
			{
				if($mobile_no_)
					$dnd_count++;	
				else
					$dnd_count=$dlr->cnt;		
					
				$total_count=$total_count+$dnd_count;
			}
			if($dlr->dlr_status==1)
			{
				if($mobile_no_)
					$delivered_count++;	
				else
					$delivered_count=$dlr->cnt;		
					
				$total_count=$total_count+$delivered_count;
			}
			
			if($dlr->dlr_status=="")
			{ 
				//$pending_dlrs_count++;
				$delivered_count=$dlr->cnt;	
				$total_count=$total_count+$delivered_count;
			}
			if($dlr->dlr_status==16)
			{
				$invalid_nos_count=$dlr->cnt;
				$total_count=$total_count+$invalid_nos_count;	
			}
			if($dlr->dlr_status==2)
			{
				
				
				
				$total_count++;
				$undelivered_count++;	
				if($dlr->error_code=='000')
				{
					//$delivered_count=$dlr->cnt;	
					//$total_count=$total_count+$invalid_nos_count;
				}
				if($dlr->error_code=='001' )
				{
					$invalid_nos_count=$dlr->cnt;	
				}
				if($dlr->error_code=='1080')
					$invalid_nos_count=$dlr->cnt;	
				if($dlr->error_code=='002')
					$out_of_range_count=$dlr->cnt;	
				if($dlr->error_code=='003')
					$memory_capacity_exceeded_count=$dlr->cnt;	
				if($dlr->error_code=='004')
					$mobile_equipment_error_count=$dlr->cnt;							
				if($dlr->error_code=='005')
					$network_error_count=$dlr->cnt;	
				if($dlr->error_code=='006')
					$barring_count=$dlr->cnt;		
				if($dlr->error_code=='1077')
					$multiple_submit_count=$dlr->cnt;	
				if($dlr->error_code=='100')
					$misc_error_count=$dlr->cnt;					
						
			}
			endforeach;
			//print_r(array_sum_combine($myArray));
	
	//var_dump(array_sum_combine($myArray));
	

	
	?> 
    
    
<table id="rounded-corner" summary="SMS Campaign's Report">

		 <tr>
	         
			 <td>Delivered :&nbsp; <?php echo $delivered_count; ?></td><td>&nbsp;</td>
			 <td>DND :&nbsp; <?php echo $dnd_count; ?></td><td>&nbsp; </td>
              <td>Not Delivered :&nbsp; <?php echo $undelivered_count; ?></td><td>&nbsp;</td>
             <td>Pending :&nbsp; <?php echo $pending_dlrs_count; ?></td><td>&nbsp;</td>

         </tr>
        
         <tr>
         <td><strong>Total</strong> :&nbsp; <?php echo $total_count; ?></td><td>&nbsp;</td>
         <td>Expired :&nbsp; <?php echo $expired_count; ?></td><td>&nbsp;</td>
           <td>Miscellaneous :&nbsp; <?php echo $misc_error_count; ?></td><td>&nbsp; </td>
           <td>Invalid :&nbsp;<?php echo $invalid_count; ?> </td><td>&nbsp;</td>
            <td>Und:&nbsp; <?php echo $undelivered_count; ?></td><td>&nbsp;</td>
		 </tr>
		 </table>  <br></br>  
    
   <?php } ?><?php */?>
   
   <table id="rounded-corner" summary="SMS Campaign's Report">
		   <?php
		   if($errorTextArray!='')
		   {
			$totalNumbers=0;   
		   	foreach($errorTextArray as $key => $value): 
			$tempKey=$key;
			$tempValue=$value;
			$totalNumbers+=$value;
			?>
			
            
            
             <tr>
				 <td><?php 
				 if($tempKey=='')
					 echo "Delivered"; //DLR Pending
					else
					echo $tempKey;
				 ?> :&nbsp; <?php echo $tempValue; ?></td><td>&nbsp;</td>
			</tr>
     <?php  endforeach; ?>
      <tr> <td> <strong>Total Sent :&nbsp; <?php echo $totalNumbers; ?> </strong> </td> <td>&nbsp;</td></tr>	 


<?php   } 

if($rangeA!='' && $totalNumbers>0)
		   {
// end if   ?>
<tr> <td>&nbsp;</td> <td>&nbsp;  
      <a href="./downloadDlrReport_new1.html?mobile_no_=<?php echo $mobile_no_; ?>&rangeA=<?php echo $rangeA; ?>" class="bt_green" target="_blank"><span class="bt_green_lft"></span><strong>Download Report</strong><span class="bt_green_r"></span></a></td> </tr>
  <?php } ?>    
</table>   
		 

	
	<?php    

if($search=='')
		   {
// end if   ?>
    
    <table id="rounded-corner" summary="SMS Campaign's Report">
    <thead>
    	<tr>
		 <th scope="col" class="rounded-company">S.No</th>
		 <th scope="col" class="rounded">On Date</th>
		 <th scope="col" class="rounded">Sender</th>
         <th scope="col" class="rounded">Campaign</th>
		 <th scope="col" class="rounded">SMS Text</th>
		 <th scope="col" class="rounded">No. of SMS </th>
		 <th scope="col" class="rounded">Status </th>
		 <th scope="col" class="rounded-q4">Report</th>
		</tr>
	</thead>
	<tfoot>
    	<tr>
        	<td colspan="6" class="rounded-foot-left">&nbsp;</td>
        	<td class="rounded-foot-right">&nbsp;</td>

        </tr>
    </tfoot>
	<tbody>
	<?php 
		$count=1;
		foreach($campaigns as $campaign):		 
		$user_id=$campaign->user_id;
	?>
	<tr>
		<td><?php echo $count; ?></td>
		<td><?php echo $campaign->created_on; ?></td>
		<td><?php echo $campaign->sender_name; ?></td>
  		<td><?php echo $campaign->campaign_name; ?></td>
	  
        
        <?php 
	   if($campaign->campaign_type=="4")
				   	{?>
                    <td><strong>Customized SMS</strong>( <?php echo $campaign->sms_text; ?> ) => <?php echo wordwrap($campaign->sms_text_sample,43,"\n",1);  ?> </td>
                   	<?php }else {?>
                    <td><?php echo $campaign->sms_text; ?></td>
                     <?php }?>
        
       
		<td><?php echo $campaign->no_of_messages; ?></td>
		<td align='center'>
		<?php 
		 	if($campaign->campaign_status == 0):
		 		echo "Processing";
		 	elseif($campaign->campaign_status == 1 && $campaign->is_scheduled == 1):
		 		echo "Scheduled@ ". $campaign->scheduled_on ;
		 	else:
		 		echo "Done";
		 	endif;
		 ?>
		 </td>
		 <td align='center'>
		 	<?php if($campaign->campaign_status == 2 || ($campaign->campaign_status == 1 && $campaign->is_scheduled == 0)) { ?>
		 	<!-- <a href='<?php echo site_url('/campaign/downloadDlrReport/'.$campaign->campaign_id);?>'>Save</a>  -->

            <a href='<?php echo site_url('/campaign/viewReport/campaign/'.$campaign->campaign_id);?>'>View</a>
		 	<?php } else if($campaign->campaign_status == 1 && $campaign->is_scheduled == 1) {?>
		 	<a href='<?php echo site_url();?>/campaign/editcampaign/<?php echo $campaign->campaign_id?>'>Edit</a>&nbsp;		 
			<a href='<?php echo site_url();?>/campaign/cancelcampaign/<?php echo $campaign->campaign_id?>' 
		 		onclick='return confirm("Are you really want to Cancel this Campaign?");'>Cancel</a>
		 	<?php } else { ?>
		 	---
		 	<?php } ?>
		 </td>		 	
	</tr>
		 
	<?php 
	$count++; 
	endforeach;
	?>
	</tbody>
	</table>
		 <div align='center' class="pagination">
		<?php echo $this->pagination->create_links(); ?>
		</div>
        <?php } ?>
</div>		










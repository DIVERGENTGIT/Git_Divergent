
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url(); ?>images/reports-icon.png" class="right-title-img">Reports</h3>
</div>
<section class="col-sm-12 col-md-12 col-xs-12 padding_zero">
 <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">  
 <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">

  <!-- <form class="col-sm-12 col-md-12 missedcall_allform form-div col-xs-12 padding_zero" role="form" action="<?php echo base_url(); ?>campaign/viewcampaignssearch/" name="campaign_search" id="campaign_search" method="post" > -->
  
  <form class="col-sm-12 col-md-12 missedcall_allform form-div col-xs-12 padding_zero" role="form" action="<?php echo base_url(); ?>campaign/viewcampaigns/" name="campaign_search" id="campaign_search" method="post" >
  <ul class="search-list05 missedcall_allform">
<li><input type="text" id="from_date" name="from_date" value="<?php if($from_date){echo $from_date;} ?>" placeholder=" " class="data-pickerbg"></li>
<li><input type="text" id="to_date" name="to_date" value="<?php if($to_date){echo $to_date;} ?>" placeholder=" " class="data-pickerbg"></li>
<li> 
<select name="sender">     
 <option value="">Select Sender Id</option>  
<?php 
	foreach($sender_names as $sender) {  
 ?>
  	<option value="<?php echo $sender;?>" <?php if($sender == $sender_name) { echo 'selected';} ?> > <?php echo $sender; ?>
	</option>    
 <?php 
}  ?> 
</select>   </li> 
 
<li><?php //echo form_dropdown('selected_sms_type',array('NormalSms' => 'SMS','ApiSms' => 'ApiSms'), set_value('selected_sms_type'),'class=""');?> 
  
<select name="selected_sms_type">
   

	<option value="NormalSms"<?=$selected_sms_type == 'SMS' ? ' selected="selected"' : '';?>>SMS</option>
	<option value="ApiSms"<?=$selected_sms_type == 'ApiSms' ? ' selected="selected"' : '';?>>ApiSms</option>
</select> 
 <?php 

$file_type_options = array(
'xls'  => 'Excel',
// 'txt'    => 'Text',
);		?>
  <!-- <div class="form-group">
    <label class="control-label col-sm-3" for="pwd">File Formate</label>
    <div class="col-sm-8"> 
	<?php echo  form_dropdown('file_format', $file_type_options , 'all' ,'class="form-control"');?>
    </div>
  </div> -->
</li>

<li><input  type="submit" class="submit_btn" value="Search" name="submit"></li>
</ul>


 </form>
 <!--  <p style="font-size: 12px;"> * Reports from  <b><?php echo date('Y-m-d', time()-60*60*48 );?> </b> only can be viewed / downloaded through search option</p> -->
 </div>
 </div>
<div class="col-sm-12 col-md-12 form-div col-xs-12 padding_zero">
<div class="table-responsive">
                  <table class="table_all"  >
                 <?php if(!empty($api_data)) { ?>
			<thead>
				<tr>  
					<th>SL.No</th>
					<th>On Date</th>
					<th>No. of SMS</th>
					<th>View</th>
					<th>Download</th>
				</tr>
			</thead>
			<tbody>
				 <?php 
				 $count=0;
				 foreach($api_data as $sms_api) {		
				 	 $count=$count+1; 
				 ?>
				 	<tr>
				 	<td class="tdee" width='15'><?php echo $count; ?></td>
				 	<td class="tdee"><?php echo $sms_api['ondate']; ?></td>
				 	<td class="tdee"><?php echo $sms_api['noofmsg']; ?></td>
			    
			    <td class="tdee"> <a href="<?php echo site_url('campaign/apiViewReport/campaign/'.$sms_api['ondate'])?>">View</a></td>	
			    <td class="tdee"><a  href="<?php echo site_url('campaign/download_report/'.$sms_api['ondate'])?>" >Download</a>  </td>	 	 	
				 	</tr>
				 
				 <?php 
				 }
				 ?>
			 </tbody>	
			  </table> 
                    <?php }else{ ?>
                    	<thead>
				<tr>
					<th>SL.No</th>
					<th> Date</th>
					<!-- <th>Sender</th> -->
					<th>Sender Name</th>  
					<th style="width:250px !important;">SMS Text</th>
					<th>No. of SMS</th>
					<th>Status</th>
					<th>Reports</th>
				</tr>
			</thead>
                    
                    
                    <?php } ?>
                    <tbody>
					<?php 
		$count=0;
		if(!empty($per_page)){
	$count=$count+$per_page;
	}
		foreach($campaigns as $campaign){		 
		$user_id=$campaign->user_id;
	$count++;
	
		
			
				$cur_date = date('Y-m-d H:i:s');
		//		$days_diff = $this->daysDifference($cur_date, $campaign->created_on);
				
		 $month1 = substr($campaign->created_on,5,2);
         $day1 = substr($campaign->created_on,8,2);
        $year1 = substr($campaign->created_on,0,4);

        $month2 = substr($cur_date,5,2);
        $day2 = substr($cur_date,8,2);
        $year2 = substr($cur_date,0,4);

        $date1 = mktime(0,0,0,$month1,$day1,$year1);
        $date2 = mktime(0,0,0,$month2,$day2,$year2);

        if($date1 > $date2){
           $dateDiff = $date1 - $date2;
        } else {
           $dateDiff = $date2 - $date1;
        }
        $fullDays = floor($dateDiff/(60*60*24));
	
	 		      //  $dlr_report = $this->Campaign_model->get_campaign_numbers($campaign->campaign_id, $fullDays, $campaign->created_on);		
	
	 $dlr_report = $this->Campaign_model->get_all_smsreports_basedoncampaign($campaign->campaign_id, $fullDays, $campaign->created_on);		
	//	print_r($dlr_report);  
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

	?>
                      <tr>
                        <td><?php echo $count; ?></td>
                        <td style="width:130px!important;"><?php echo $campaign->created_on; ?>
                         </td>
                        <td><?php echo $campaign->sender_name; ?></td>
			<!--<td><?php echo $campaign->sender; ?></td> -->
<!--<td><?php echo $campaign->campaign_name; ?></td>
-->
<td style="width:200px !important important;">  <p class="row-fluid alert alert- alert-dismissable " data-toggle="tooltip" data-placement="bottom" title="" 

  data-original-title="<?php echo htmlspecialchars($campaign->sms_text); ?>" >
<?php	 
$array = str_split($campaign->sms_text,30);
echo $array[0];
?>
             </p> 
</td>
                        <td><?php 
echo    $campaign->no_of_messages; 
$delivered_count =  $dlr_report[0]->delivered_count?$dlr_report[0]->delivered_count:0;
$expired_count =  $dlr_report[0]->expired_count?$dlr_report[0]->expired_count:0;
$dnd_count = $dlr_report[0]->dnd_count?$dlr_report[0]->dnd_count:0;
$pending_dlr_count =  $dlr_report[0]->pending_dlr_count?$dlr_report[0]->pending_dlr_count:0;
$invalid_count =  $dlr_report[0]->invalid_count?$dlr_report[0]->invalid_count:0;
                         ?>
             
               <div class="btn-group" >
                <span data-toggle="dropdown" style="margin-left:10px; cursor:pointer;" class="dropdown-toggle "><i class="fa fa-eye" style="font-size:16px; color:#777;"></i> </span>
                <ul class="dropdown-menu bullet pull-right"  style=" padding:5px; width:250px;background-color:#fff;">
       <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example" style="margin-bottom:0px !important;">
    
      
	    <tbody>
		<tr style="width:200px; background-color:#EFEFEF;" class="odd gradeX">
			<td  style="width:200px; ">Delivered</td>
			<td style="width:50px; "><?php echo $delivered_count; ?></td>
			
		</tr>
		<tr style="width:200px; background-color:#F5F5F5;" class="even gradeC">
			<td  style="width:200px;">DND</td>
			<td  style="width:50px;"><?php echo $dnd_count; ?></td>
			
		</tr>
          
		<tr style="width:200px; background-color:#EFEFEF;" class="odd gradeX">
			<td style="width:200px;">Pending</td>
			<td style="width:50px;"> <?php echo $pending_dlr_count; ?></td>
			
		</tr>
      
		<tr style="width:200px; background-color:#EFEFEF;" class="odd gradeX">
			<td style="width:200px;">Failed Numbers</td>
			<td style="width:50px;"> <?php echo $expired_count+$invalid_count; ?></td>
			
		</tr>
      
        </tbody>
        </table>
                  
                  
                </ul>
              </div> 
              </td>
						 
                         <td><?php 
		 	if($campaign->campaign_status == 0):
		 		echo "Processing";
		 elseif($campaign->campaign_status == 1 && $campaign->is_scheduled == 1):
		 		echo "Scheduled@ ". $campaign->scheduled_on ;
		 	else:
		 		echo "Done";
		 	endif;
		 ?>
         
         
         </td>
         
        <!-- <td> 
         <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#" ><a href='<?php echo site_url('/campaign/viewReport/campaign/'.$campaign->campaign_id);?>'>View</a>  </button>
        
         
         </td>-->
         
         
		   <td>
			
				<a href='<?php echo site_url('/campaign/viewReport/campaign/'.$campaign->campaign_id);?>' class="btn_cls01">	<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#" >View  </button></a>
       <?php if($campaign->campaign_status == 2 || ($campaign->campaign_status == 1 && $campaign->is_scheduled == 0)) 
					  { ?>
		 	 <a class="btn btn-sm btn-default btn_cls01" href='<?php echo site_url('/campaign/download_dlr_report/'.$campaign->campaign_id);?>'>Download
			 </a> 

        <!--    <a href='<?php echo site_url('/campaign/viewReport/campaign/'.$campaign->campaign_id);?>'>View</a>-->
		 	<?php } elseif($campaign->campaign_status == 1 && $campaign->is_scheduled == 1) {?>
		 	<!--<a href='<?php echo site_url();?>/campaign/editcampaign/<?php echo $campaign->campaign_id?>'>Edit</a>&nbsp;		 
			<a href='<?php echo site_url();?>/campaign/cancelcampaign/<?php echo $campaign->campaign_id?>' 
		 		onclick='return confirm("Are you really want to Cancel this Campaign?");'>Cancel</a> -->
		 	<?php } else { ?>
		 	
		 	<?php } ?>
                      </td>
		  <?php 
		  }
	?>
                      </tbody>
                    </tfoot>
                  </table>
		
</div>
              </div>
	<div class="col-sm-12 col-md-12 col-xs-12 ">	  
         <?php echo $this->pagination->create_links(); 
		?>
		</div>	
   </div>
          	




		  


        </section><!-- /.content -->
</div>
</div>

  </body>
</html>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
<script>
   $(document).ready(function() {

    $('#example1').DataTable( {
       lengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
       paging: false,
	   info: false,
		bLengthChange: false,
        filter: false,
		fnDrawCallback:function(){
if (Math.ceil((this.fnSettings().fnRecordsDisplay()) / this.fnSettings()._iDisplayLength) > 1) {
$('#example_wrapper .dataTables_paginate').css("display", "block");	
} else {
$('#example_wrapper .dataTables_paginate').css("display", "none");
}
}
    } );
} );

</script>

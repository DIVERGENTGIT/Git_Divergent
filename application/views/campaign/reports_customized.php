<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/reports-icon.png" class="right-title-img">Customized Reports</h3>
</div>

        <section class="col-sm-12 col-md-12 col-xs-12 padding_zero">
        	
           
           <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">

                
  <form class="form-horizontal col-md-12 col-sm-12 col-xs-12 form-div padding_zero" role="form" action="<?php echo base_url(); ?>customized/viewcampaignssearch/" name="campaign_search" id="campaign_search" method="post" >
<ul class="search-list05 missedcall_allform">
<li><input type="text" id="from_date" name="" value="<?php if($from_date){echo $from_date;} ?>" placeholder="2016-12-21" class="data-pickerbg hasDatepicker"></li>
<li><input type="text" id="to_date" name="" value="<?php if($to_date){echo $to_date;} ?>" placeholder="2016-12-21" class="data-pickerbg hasDatepicker"></li>
<li>  <?php echo form_dropdown('sender', $sender_names, set_value('sender'),'class="form-control"');?>  </li>
<li>  <?php echo form_dropdown('sender', $sender_names, set_value('sender'),'class="form-control"');?> 
 
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
<li><input  type="submit" class="submit_btn" name="submit"></li>
</ul>
</form>
  <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
     <p style="font-size: 12px;"> * Reports from  <b><?php echo date('Y-m-d', time()-60*60*48 );?> </b> only can be viewed / downloaded through search option</p>          
     </div>    
   
 </div>


              
               <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
                  <table class="table_all">
                    <thead>
                      <tr>
					   <th class="sendee-color" >SL.No</th>
                        <th class="sendee-color" style="text-align:center; "> Date</th>
                        <th class="sendee-color" style="text-align:center; ">Sender</th>
<!--						<th class="sendee-color" style="text-align:center; ">Campaign Name</th>
-->
                        
                          <th class="sendee-color" style="text-align:center; width:250px !important; important;">SMS Text</th>

                        <th class="sendee-color" style="text-align:center; ">No. of SMS</th>
                        <th class="sendee-color" style="text-align:center; ">Status</th>
<!--                        <th class="sendee-color" style="text-align:center; ">View</th>
-->						  <th class="sendee-color" style="text-align:center; ">Reports</th>
                      </tr>
                    </thead>
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
	

  $dlr_report = $this->customized_model->get_all_smsreports_basedoncampaign($campaign->campaign_id, $fullDays, $campaign->created_on);
 // print_r($dlr_report);

	 
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
                      <tr style="height:30px !important;" >
                        <td><?php echo $count; ?></td>
                        <td style="width:130px!important;"><?php echo $campaign->created_on; ?>
                         </td>
                        <td><?php echo $campaign->sender_name; ?></td>
<!--<td><?php echo $campaign->campaign_name; ?></td>
-->
<td style="width:200px !important important;">  <p class="row-fluid alert alert- alert-dismissable " data-toggle="tooltip" data-placement="bottom" title="" 

  data-original-title="<?php echo htmlspecialchars($campaign->sms_text); ?>" >
<?php	 
$array = str_split($campaign->sms_text,50);
echo $array[0];
?>
             </p> </td>
                        <td><?php echo $campaign->no_of_messages;
                        

$delivered_count =  $dlr_report['delivered_count'];
$expired_count =  $dlr_report['expired_count'];
$dnd_count = $dlr_report['dnd_count'];
$pending_dlr_count =  $dlr_report['pending_dlr_count'];
$invalid_count =  $dlr_report['invalid_count'];
							
                         ?>
                    <div class="btn-group" >
                <span data-toggle="dropdown" style="margin-left:10px; cursor:pointer;" class="dropdown-toggle "><i class="fa fa-eye" style="font-size:16px; color:#777;"></i> </span>
                <ul class="dropdown-menu bullet pull-middle pull-left"  style=" padding:5px; width:250px; margin-top: -72.5px; margin-left: 34px; background-color:#fff;">
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
		<?php echo $this->pagination->create_links(); 
		?>
	
                </div><!-- /.box-body -->
           

           
          </div><!-- /.row -->
          	




		  


        </section><!-- /.content -->
  
                              

     
    </div><!-- ./wrapper -->

  
  </body>
</html>

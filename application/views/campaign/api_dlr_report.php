   
 <script type="text/javascript">
/* UPDATED ON 2017-02-07 
	$(document).ready(function(){
	$(".btn").click(function(){
		$("#myModal").modal('show');
	});
}); */
</script>
 <script>
 $(document).ready(function(){
  $(function() {
    $( "#datepicker" ).datepicker();
  });
});
 </script>
 
 <style type="text/css">
.pagination ul > li > a:hover, .pagination ul > .active > a, .pagination ul > .active > span {
background-color: #337AB7 !important;
color:#ffffff !important;
}
 #rounded-corner th{color:#000;}

 .paging-nav{margin-top:20px;margin-bottom:20px;}
.paging-nav a{padding:5px 8px;background: #0073B7;color:#fff;margin-right:5px;}
.paging-nav .selected-page{background:#fff ;color:#0073B7;}
.word_wrap01{width: 350px;
word-wrap: break-word;}
 </style>

  <body>
  <div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
	<div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/analytics-icon.png" class="right-title-img"> API Delivery Report</h3>
</div>

<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
        <section class="col-md-12 col-xs-12 col-sm-12 padding_zero">
        <div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
           

 <div class="col-md-12 col-xs-12 col-sm-12 form-div padding_zero">

            <table summary="SMS Campaign's "  class="table_all">
    <thead>
    	<tr>
		 <th scope="col" class="rounded-company" colspan="2" style="padding:13px;">DLR Status</th>
		 <th scope="col" class="rounded-q4" colspan="2"> <?php /*?> <?php
	$file_type_options = array(
                  'xls'  => 'Excel',
                  'txt'    => 'Text',
                );	
	?>
   File Format :  <?php echo  form_dropdown('file_format', $file_type_options , 'all' ,'class="selectText"');?> &nbsp;<?php */?>
    
	
	
	<br/>
	
    <?php 
     
			//print_r($dlr_report);
			$dnd_count= $dlr_report['dnd_count'];
			$delivered_count= $dlr_report['delivered_count'];
			$invalid_nos_count= $dlr_report['invalid_nos_count'];//$dlr_report['invalid_count'];    
			$out_of_range_count= $dlr_report['out_of_range_count'];
			$memory_capacity_exceeded_count= $dlr_report['memory_capacity_exceeded_count'];
			$network_error_count= $dlr_report['network_error_count'];
			$barring_count= $dlr_report['barring_count'];
			//$dnd_count=0;
			$invalid_number_length_count= $dlr_report['invalid_number_length_count'];
			$dest_no_empty_count=0;
			$multiple_submit_count= $dlr_report['multiple_submit_count'];
			$account_expired_count= 0;//$dlr_report['expired_count'];
			$delivery_failure_count=0;
			$misc_error_count= $dlr_report['misc_error_count'];
			$dropped_count=0;
			$invalid_sender_ids_count= $dlr_report['invalid_sender_ids_count'];
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
     <div class="col-sm-12">
	      	<a style="float: right; color: #009BFA !important;font-weight:400 !important;" href="<?php echo site_url('campaign/download_report/'.$this->uri->segment(4)); ?>" class="bt_green btn btn-sm btn-default">
	     Download Report </strong><span class="bt_green_r"></a>	
	     	 





<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
	<form class="missedcall_allform" method="post">   
		<div class="col-sm-4 col-md-4 col-xs-12 padding_ltzero">
			<input type="text" name="mobile_number" id="mobileNum" maxlength=10 placeholder="Mobile Number" value="">  
		</div>
		<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
 			<input type="submit" name="api_report_Search" class="submit_btn" value="Search">  
		</div>
	</form>  

</div>











	<?php /* if($detailed_dlr_report==1)
		{
		?> <a style="float: right; color: #009BFA !important; font-weight:400 !important;" href="<?php echo site_url('campaign/downloadDlrReport_new/'.$campaign_id); ?>" class="bt_green"><span class="bt_green_lft btn btn-sm btn-default">Download Report</span></a>
	    <?php } else { ?>
	    <a style="float: right; color: #009BFA !important;" href="<?php echo site_url('campaign/downloadDlrReport/'.$campaign_id); ?>" class="bt_green btn btn-sm btn-default">
	     Download Report </strong><span class="bt_green_r"></a>	 
	    <?php }  */?> 
   </div>   
   <div class="col-sm-12">
   	<!--<form method="post" action="<?php echo base_url();?>campaign/apiViewReport/campaign/<?php echo $this->uri->segment(4);?>">
   	
	   	<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_dzero">
			<div class="col-sm-7 col-md-7 col-sm-12">
				<input type="text" name="sender" placeholder="Sender Name" />       
				<input type="text" name="mobile_number" placeholder="Mobile Number" />

				<input type="submit" name="api_report_Search" value="submit" />
			
			  
			</div>
		</div>
   		 
   	</form>	 -->
   </div>  
	<div class="clearfix"></div>
	<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">

	 <table class="table_all">
   	 	<thead>
    	<tr class="sendee-color sorting">
		 <th scope="col" class="rounded-company">SL.No</th>
		 <th scope="col" class="rounded">Mobile No</th>
		 <th scope="col" class="rounded">Sent time</th>
		 <th scope="col" class="rounded">Delivered On</th>
<th scope="col" class="rounded">No. of SMS</th>

		 <th scope="col" class="rounded">sender</th>
         <th scope="col" class="rounded">Message</th>
         
		 <th scope="col" class="rounded-q4">DLR Status</th>
		</tr>
	</thead>
    
                        

	<tbody>

	<?php 
	$count= 0;
	foreach($apireportview as $dlr):	
	$count= $count+1;
	?>
	<tr>
	<td><?php echo $count; ?></td>
	<td><?php echo $dlr->to_mobileno; ?></td>
	<td><?php echo $dlr->ondate; ?></td>  
	<td><?php echo $dlr->delivered_on; ?></td>
	<td><?php echo $dlr->noofmessages; ?></td>
	<td><?php echo $dlr->sender_name; ?></td>
	<td><p class="word_wrap01"><?php echo $dlr->message; ?></p></td>
	<td>
	<?php

	$string = '';
	 
	if(strlen($dlr->to_mobileno) < 10){
	$string .= "Invalid Number";
	} elseif($dlr->dlr_status == 1){
	$string .= "Delivered";
	} elseif($dlr->dlr_status == "" || $dlr->dlr_status == 0){
	$string .= "Pending DLR";
	}elseif($dlr->dlr_status == 16){
	$string .= $dlr->error_text;
	} elseif($dlr->dlr_status == 12){
	$string .= "Not a valid Sender Name";		
	} elseif($dlr->dlr_status == 13){
	$string .= "Not a valid Template";	
	} elseif($dlr->dlr_status == 11){
	$string .= "insufficient balance";

	}elseif($dlr->dlr_status == 2){
	$string .= "Failed - " . $dlr->error_text;
	} elseif($dlr->dlr_status == 4){
	$string .= "Queued at SMSC - " . $dlr->error_text;
	} else {
	if($dlr_report_type == 0){
	 
	$string .= "Delivered";
	} elseif(($dlr_report_type != 0) && $dlr->dlr_status == 3){
	$string .= "DND Number";
	} elseif($dlr_report_type == 2){
	if($dlr->dlr_status == 2){
	$string .= "Failed - " . $dlr->error_text;
	} elseif($dlr->dlr_status == 4){
	$string .= "Queued at SMSC - " . $dlr->error_text;
	}
	} else {
	$string .= 'Delivered';
	}
	}
	echo   $string;
	?>

	</td>		 	 
	</tr>

	<?php 

	endforeach;  
	 
	?>
	</tbody>
	</table>
<div align='' class="back col-md-4 well"  class="pagination" style=" float:left; background-color:transparent !important; border:none !important; box-shadow:none !important;">
         <a href="<?php echo site_url('campaign/viewcampaigns/'); ?>" class="bt_green"><span class="bt_green_lft"></span><strong>Back</strong><span class="bt_green_r"></span></a>   
    </div>
		 <div align='' class="pagination col-md-6 well" style="background-color:transparent !important; border:none !important; box-shadow:none !important; margin-top: -2px;margin-bottom:50px; float:right; text-align:right;">
		  <?php  echo $this->pagination->create_links(); ?>
		</div> 
</div>

<div class="col-md-1 well" style="background-color:transparent !important; border:none !important; box-shadow:none !important;"></div>
   
        </div>
        </section>
        
      
       
                   
<div class="clearfix"></div>




           <!--footer starts-->                


      <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->

   <!-- pagination start-->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
    $(document).ready(function() {
    $('#rounded-corner').DataTable( {
       lengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
       pageLength: 10,
	   info: false,
		bLengthChange: false,
        filter: false
    } );
} );
        </script>
    
     <!-- pagination End -->
 
  <script>
  $('#mobileNum').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  });
    </script>    
  
  
</html>

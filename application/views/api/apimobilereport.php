
 
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
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">

      <!-- Left side column. contains the logo and sidebar -->


      
      <!-- Content Wrapper. Contains page content -->
     <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
        <!-- Content Header (Page header) -->
       

        <!-- Main content -->
        <section class="col-md-8 col-sm-12 col-xs-12 right-content">
        <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
           
        
         <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
		 <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<h4 class="camp-title">API Delivery Report</h4>
</div>
  

      
	 

    </div>
        </div>
 
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero " style="display:none;">
	<form class="missedcall_allform" method="post"> 
		<div class="col-sm-6 col-md-6 col-xs-12 padding_ltzero">
			<input type="text" name="mobileno" id="mobileNum"  maxlength=10 placeholder="Mobile Number" value="">  
		</div>
		<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
		 		<input type="submit" name="mob_search" class="submit_btn" value="Search">  
		</div>
	</form>     
</div>  
        </section>



  
    </div><!-- ./wrapper -->

 


 <div class="col-sm-12">
	      	<a style="float: right; color: #009BFA !important;font-weight:400 !important;" href="<?php echo site_url('campaign/apiReport_download'); ?>" class="bt_green btn btn-sm btn-default">
	     Download Report </strong><span class="bt_green_r"></a>	
</div>
 
 <div class="col-sm-12"></div>
<div class="clearfix"></div>

<div class="col-sm-12 col-md-12 col-xs-12 table-padding">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="table-responsive">
	<table class="table_all">
    <thead>
    	<tr>
		 <th>SL.No</th>
		 <th>Mobile No</th>
		 <th>Sent time</th>
		<th>No of Messages</th>
		 <th>sender name</th>
         	<th>Message</th>
		 <th>DLR Status</th>
		</tr>
	</thead>
    
                        

	<tbody>
	<?php 
 
		if($this->uri->segment(3)) {
			$count= $this->uri->segment(3);
		}else{
			$count= 0; 
		}
		 foreach($apireportview as $key=>$value):	
		 		 foreach($value as $dlr):	
 
		$count= $count+1;

	?>
	<tr>
		<td><?php echo $count; ?></td>
		<td><?php echo $dlr['to_mobileno']; ?></td>
		<td><?php echo $dlr['ondate']; ?></td>
		<td><?php echo $dlr['noofmessages']; ?></td>
		<td><?php echo $dlr['sender_name']; ?></td>
        <td><p class="word_wrap01"><?php echo $dlr['message']; ?></p></td>

		<td>  
            <?php
          
                  // echo   $string = $dlr['error_text'];  
                   
	$string = '';
	 
	if(strlen($dlr['to_mobileno']) < 10){
	$string .= "Invalid Number";
	} elseif($dlr['dlr_status'] == 1){
	$string .= "Delivered";
	} elseif($dlr['dlr_status'] == "" || $dlr['dlr_status'] == 0){
	$string .= "Pending DLR";
	}elseif($dlr['dlr_status'] == 16){
	$string .= $dlr['error_text'];
	} elseif($dlr['dlr_status'] == 12){
	$string .= "Not a valid Sender Name";		
	} elseif($dlr['dlr_status'] == 13){
	$string .= "Not a valid Template";	
	} elseif($dlr['dlr_status'] == 11){
	$string .= "insufficient balance";

	}elseif($dlr['dlr_status'] == 2){
	$string .= "Failed - " . $dlr['error_text'];
	} elseif($dlr['dlr_status'] == 4){
	$string .= "Queued at SMSC - " . $dlr['error_text'];
	} else {
	if($dlr_report_type == 0){
	 
	$string .= "Delivered";
	} elseif(($dlr_report_type != 0) && $dlr['dlr_status'] == 3){
	$string .= "DND Number";
	} elseif($dlr_report_type == 2){
	if($dlr['dlr_status'] == 2){
	$string .= "Failed - " . $dlr['error_text'];
	} elseif($dlr['dlr_status'] == 4){
	$string .= "Queued at SMSC - " . $dlr['error_text'];
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
	endforeach;
	?>
	</tbody>
	</table>
</div>
</div>	
 <div align='' class="pagination col-md-6 well" style="background-color:transparent !important; border:none !important; box-shadow:none !important; margin-top: -2px;margin-bottom:50px; float:right; text-align:right;">
         <?php echo $this->pagination->create_links(); 
		?>
		</div>	


<div align='' class="back col-md-4 well"  class="pagination" style=" float:left; background-color:transparent !important; border:none !important; box-shadow:none !important;">
        <a href="<?php echo site_url('campaign/viewcampaigns/'); ?>" class="bt_green"><span class="bt_green_lft"></span><strong>Back</strong><span class="bt_green_r"></span></a>    
    </div>

<!-- 
 <a href="<?php echo base_url();?>api/reports"><button class="bt_green submit_btn" onclick="goBack();" ><span class="bt_green_lft"></span>
	<strong>Back</strong><span class="bt_green_r"></span></button></a> -->
  
</div>
    
 
</html> 

<script>
function goBack() {
window.history.back();
}
</script>


  <script>
  $('#mobileNum').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  });
    </script>

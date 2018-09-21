

   
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
 
 <style type="text/css">
.pagination ul > li > a:hover, .pagination ul > .active > a, .pagination ul > .active > span {
background-color: #337AB7 !important;
color:#ffffff !important;
}
 #rounded-corner th{color:#000;}

 .paging-nav{margin-top:20px;margin-bottom:20px;}
.paging-nav a{padding:5px 8px;background: #0073B7;color:#fff;margin-right:5px;}
.paging-nav .selected-page{background:#fff ;color:#0073B7;}
.word_wrap01{width: 400px;
word-wrap: break-word;}
 </style>

  <body>
    <div class="col-sm-9 col-md-9 col-xs-12 padding_zero">

      <!-- Left side column. contains the logo and sidebar -->


      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       

        <!-- Main content -->
        <section class="col-sm-12">
        <div class="col-md-12 ng-scope" style="padding:0px;" data-ng-controller="formConstraintsCtrl">
           
        
         <div class="panel panel-default">
  <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> SMS Delivery Report</strong></div>

      
	<div class="form col-md-12 " style="background-color:#fff!important; ">
  
<style>
	#rounded-corner{ width:656px;	}
</style>


      
    
   
<!--   dispaly numbers ols style -->

 <form name="" action="" method="post" style="margin-top:20px !important;">
 <div class="col-sm-3">
<input type="text" name="to_mobileno" style="height: auto !important;">
</div>
<input type="submit" name="smsapi_mobileno" class="btn btn-default btn-sm" value="search">
</form> 


	
             <table id="rounded-corner" class="table tableData01 table-nonfluid table-bordered table-striped  no-footer"  style="background-color:#fff;padding-left:0px;padding-right:0px;"summary="SMS API sms_api's Report">
    <thead>
    	<tr class="sendee-color sorting">
		 <th scope="col" class="rounded-company">SL.No</th>
		 <th scope="col" class="rounded">Mobile No</th>
		 <th scope="col" class="rounded">Sent time</th>
<th scope="col" class="rounded">noofmessages</th>

		 <th scope="col" class="rounded">sender name</th>
         <th scope="col" class="rounded">Message</th>
         
		 <th scope="col" class="rounded-q4">DLR Status</th>
		</tr>
	</thead>
    
                        

	<tbody>

	<?php  if($seacrh_mobileno!=''){
	$i=0;
	foreach($seacrh_mobileno as $key=> $dlr1){
	$i++; ?>



	<tr>
	<td><?php echo $i; ?></td>
	<td><?php echo $dlr1->to_mobileno; ?></td>
	<td><?php echo $dlr1->ondate; ?></td>
	<td><?php echo $dlr1->noofmessages; ?></td>
	<td><?php echo $dlr1->sender_name; ?></td>
	<td><p class="word_wrap01"><?php echo $dlr1->message; ?></p></td>
	<td>
	<?php

	$string = '';



	if(strlen($dlr1->to_mobileno) < 10){
	$string .= "Invalid Number";
	} elseif($dlr1->dlr_status == 1){
	$string .= "Delivered";
	} elseif($dlr1->dlr_status == "" || $dlr1->dlr_status == 0){
	$string .= "Pending DLR";
	}elseif($dlr1->dlr_status == 16){
	$string .= $dlr1->error_text;
	} elseif($dlr1->dlr_status == 12){
	$string .= "Not a valid Sender Name";		
	} elseif($dlr1->dlr_status == 13){
	$string .= "Not a valid Template";	
	} elseif($dlr1->dlr_status == 11){
	$string .= "insufficient balance";

	} else {
	if($this->_dlr_report_type == 0){
	$string .= "Delivered";
	} elseif(($this->_dlr_report_type != 0) && $dlr1->dlr_status == 3){
	$string .= "DND Number";
	} elseif($this->_dlr_report_type == 2){
	if($dlr1->dlr_status == 2){
	$string .= "Failed - " . $dlr1->error_text;
	} elseif($dlr->dlr_status == 4){
	$string .= "Queued at SMSC - " . $dlr1->error_text;
	}
	} else {
	$string .= "Delivered";
	}
	}
	echo   $string;
	?>
	</td>		 	
	</tr>
	<?php 
	}
	} else{

	$count= 0;
	foreach($apireportview as $dlr):	
	$count= $count+1;
	?>
	<tr>
	<td><?php echo $count; ?></td>
	<td><?php echo $dlr->to_mobileno; ?></td>
	<td><?php echo $dlr->ondate; ?></td>
	<td><?php echo $dlr->noofmessages; ?></td>
	<td><?php echo $dlr->sender_name; ?></td>
	<td><p class="word_wrap01"><?php echo $dlr->message; ?></p></td>
	<td>
	<?php

	$string = '';

	/* if(strlen($dlr->to_mobileno) < 10){
	$string .= "Invalid Number";
	} elseif($dlr->dlr_status == "" || $dlr->dlr_status == 0 || $dlr->dlr_status == 1){
	$string .= "Delivered";
	} elseif($dlr->dlr_status == 16){
	$string .= "Invalid Number";
	} elseif($dlr->dlr_status == 12){
	$string .= "Not a valid Sender Name";		
	} elseif($dlr->dlr_status == 13){
	$string .= "Not a valid Template";	

	} else {
	if($this->_dlr_report_type == 0){
	$string .= "Delivered";
	} elseif(($this->_dlr_report_type != 0) && $dlr->dlr_status == 3){
	$string .= "DND Number";
	} elseif($this->_dlr_report_type == 2){
	if($dlr->dlr_status == 2){
	$string .= "Failed - " . $dlr->error_text;
	} elseif($dlr->dlr_status == 4){
	$string .= "Queued at SMSC - " . $dlr->error_text;
	}
	} else {
	$string .= "Delivered";
	}
	}*/

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
	if($this->_dlr_report_type == 0){
	$string .= "Delivered";
	} elseif(($this->_dlr_report_type != 0) && $dlr->dlr_status == 3){
	$string .= "DND Number";
	} elseif($this->_dlr_report_type == 2){
	if($dlr->dlr_status == 2){
	$string .= "Failed - " . $dlr->error_text;
	} elseif($dlr->dlr_status == 4){
	$string .= "Queued at SMSC - " . $dlr->error_text;
	}
	} else {
	$string .= "Delivered";
	}
	}

	echo   $string;
	?>

	</td>		 	
	</tr>

	<?php 

	endforeach;
	}
	?>
	</tbody>
	</table>
<div align='' class="back col-md-4 well"  class="pagination" style=" float:left; background-color:transparent !important; border:none !important; box-shadow:none !important;">
        <a href="<?php echo site_url('api/reports/'); ?>" class="bt_green"><span class="bt_green_lft"></span><strong>Back</strong><span class="bt_green_r"></span></a>    
    </div>
		 <div align='' class="pagination col-md-6 well" style="background-color:transparent !important; border:none !important; box-shadow:none !important; margin-top: -2px;margin-bottom:50px; float:right; text-align:right;">
		  <?php //echo $this->pagination->create_links(); ?>
		</div>
</div>

<div class="col-md-1 well" style="background-color:transparent !important; border:none !important; box-shadow:none !important;"></div>
    </div>
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
     
  
  
</html>

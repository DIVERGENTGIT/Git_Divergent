<style type="text/css">
.table-nonfluid {
   width: 100% !important;
   margin:0px !important;
}
.panel-heading{margin:0px;}
td.numeric {
    padding: 6px 40px !important;
}
th.numeric {   
    padding: 6px 40px !important;
}
.form_credits span{float:left;display:inline;margin-right: 20px;}
.pagination a{ padding: 7px 11px;
			background: #fff;}
.pagination strong{background:#08c;color:#fff;padding: 7px 11px;}
</style>
<link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
<body class="skin-blue sidebar-mini">
 
    <div class="col-sm-9">    
      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="" >
          <!-- title row -->
          <div class="">
          
            <div class="col-xs-12" style="padding: 0px !important;">
            <div class="col-md-12 padding_zero top_page_heading">
			<div class="col-md-12 padding_zero">
             <h2>Shortcode Feedback Form Result</h2>
			</div>

				<div class="col-md-12 search_top01 padding_zero">
				<div class="col-md-11 padding_zero">
<form name="" action="" method="post" onsubmit="return validation()">
             <span id="basicExample1">
			
        <input type="text" class="date1 input_hgt30 start1 datescls" name="from_date" id="from_date" style="margin-right: 10px;" placeholder="From Date" />
        </span>	
		<span id="basicExample1">
	
        <input type="text" class="date1 end1 input_hgt30 datescls" name="to_date" id="to_date" placeholder="To Date" />
        </span>	
			
  <span class="spn_01">
<input type="submit" name="feedbackform_report_search" class="btn btn-primary" value="Search" >
			</span>
		</form>	
      </div>
        <div class="col-md-1 padding_zero">
          <form name="" action="" method="post">

          <input type="hidden" name="from_date" value="<?php echo $_REQUEST['from_date']?>">
         
           <input type="hidden" name="to_date" value="<?php echo $_REQUEST['to_date']?>">
           
         <input type="submit" name="shorturl_download" class="btn btn-primary conf_download" value="Download" >
   </form>
      </div>
  

			</div>
    
			</div>






	<div class="form">   
    <table id="example" class="table_all" summary="Added Credits">
        <thead>
        <tr>
	<th scope="col" class="rounded">S.NO</th>
	<?php 
	foreach($header_form as $header)
	{
	?>
	<th scope="col" class="rounded-company"><?php echo $header?></th>
     <?php }?>
        </tr>
        </thead>       
        <tbody>   
  
 

        <?php
if(count($feedback_form)>0)
{
foreach($feedback_form as $feedback)
{
		 
$count++;
?>
	<tr style="height:30px !important;" >
		<td><?php echo $count; ?></td>
		<?php for($xy=0;$xy<=count($feedback)-1;$xy++) {?>
		<td><?php echo $feedback[$xy]; ?></td>
		<?php }?>
	</tr>
	<?php }}
	else{
	//echo '<tr style="height:30px !important;" ><td valign="top" colspan="7" class="dataTables_empty">No data available in table</td></tr>';
	}
	?>
  
	
  
        </tbody>
    </table>
    <div align='center' class="pagination">		
    </div>
</div>
</div>
</div>
<button onclick="goBack()">Go Back</button>
</section></div></div></body>
 <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>
	

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<link rel="stylesheet" media="all" type="text/css" href="<?php echo base_url(); ?>assets/css/timepicker-ui.css" />
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui-timepicker-addon-i18n.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui-sliderAccess.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery-validate.bootstrap-tooltip.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript">
			
$(document).ready(function(){ 
$('#from_date').datetimepicker( {
    	changeMonth: true,
    	changeYear: true, 
    	dateFormat: "yy-mm-dd",
		onSelect: function (selectedDate) {
                var orginalDate = new Date(selectedDate);
                var monthsAddedDate = new Date(new Date(orginalDate).setMonth(orginalDate.getMonth() + 1));
                
                $("#to_date").datetimepicker("option", 'minDate', selectedDate);
                $("#to_date").datetimepicker("option", 'maxDate', monthsAddedDate);
            }
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });
	$('#to_date').datetimepicker( {
    	changeMonth: true,
    	changeYear: true, 
    	dateFormat: "yy-mm-dd",
		onSelect: function (selectedDate) {
                var orginalDate = new Date(selectedDate);
                var monthsAddedDate = new Date(new Date(orginalDate).setMonth(orginalDate.getMonth() - 1));
               
                $("#from_date").datetimepicker("option", 'minDate', monthsAddedDate);
                $("#from_date").datetimepicker("option", 'maxDate', selectedDate);
            }
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });
});
</script>
			
	<!-- view start-->
<div class="modal model_01 fade" id="modelconferenceview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modelconferenceview">Conferences</h4>
      </div>

<script>
function goBack() {
    window.history.back();
}
</script>

      <script>

       function ViewRecord(room_id,room_desc,admin_pin,user_pin,announcement,moh,join_leave,wait_for_admin,exit_with_admin,active,entry_time)
  {
	 
	// $("#empeditmobile").attr("value",mobile);
	 $("#room_id").html(room_id);
	 $("#room_desc").html(room_desc);
	 $("#admin_pin").html(admin_pin);
	 $("#user_pin").html(user_pin);
	 $("#announcement").html(announcement);

     $("#moh").html(moh);
	 $("#join_leave").html(join_leave);
     $("#wait_for_admin").html(wait_for_admin);
     $("#exit_with_admin").html(exit_with_admin);
     $("#active").html(active);
     $("#entry_time").html(entry_time);
	 
	 //$("#empviewphoto").attr("src","<?php echo "http://".$_SERVER['SERVER_NAME']?>/emptracker/uploads/"+photo);
	 //$("#req_id").attr("value",id);
	// console.log($("#empviewphoto").attr("src",photo));
	// console.log(empid);
	// console.log(id);
	 
  }
      </script>
      <div class="col-sm-12 modal-body">
       <div class="col-sm-12">  
       
                                <div class="x_content">
								<div class="col-sm-12">
					<table id="rounded-corner" class="table_all" summary="Added Credits">
        <thead>
        <tr>
            <th scope="col" class="rounded-company">Sno</th>
            <th scope="col" class="rounded">Login ID</th>
            <th scope="col" class="rounded">User Type</th>
</tr>
        </thead>       
        <tbody> 
		<tr>
		<td>1</td>
		<td>46464</td>
		<td>Admin</td>
		</tr>
		<tr>
		<td>1</td>
		<td>46464</td>
		<td>Admin</td>
		</tr>
		<tr>
		<td>1</td>
		<td>46464</td>
		<td>Admin</td>
		</tr>
		</tbody>
		</table>


</div>
                                </div>


</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- view End-->
<script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable( {
       lengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
       pageLength: 5,
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


function validation()
{
	if($("#from_date").val() != '' || $("#to_date").val() != '')
	{
		if($("#from_date").val() == '' || $("#to_date").val() == '')
		{
			alert("Please select from date and to date.");
			return false;
		}
	}
}
</script>

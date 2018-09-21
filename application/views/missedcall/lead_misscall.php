<style type="text/css">
.table-nonfluid {
   width: 100% !important;
   margin:0px !important;
}
.pagination{float:right;}
.panel-heading{margin:0px;}
td.numeric {
    padding: 6px 40px !important;
}
#basicExample1 input[type="text"], .spn_01 input[type="text"]{height:30px;}
th.numeric {   
    padding: 6px 40px !important;
}
.form_credits span{float:left;display:inline;margin-right: 20px;}
.pagination a{ padding: 7px 11px;
			background: #fff;}
.pagination strong{background:#08c;color:#fff;padding: 7px 11px;}
</style>
<link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
<body>
    <div class="col-sm-9 col-md-9 col-xs-12 padding_zero">    
      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="" >
          <!-- title row -->
          <div class="">
          
            <div class="col-md-12 col-sm-12 col-xs-12" style="padding: 0px !important;">
            <div class="col-md-12 col-sm-12 col-xs-12 padding_zero top_page_heading">
			<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
             <h2>Missed Call</h2>
			</div>

				<div class="col-md-12 col-sm-12 col-xs-12 search_top01 padding_zero">
				<div class="col-md-11 col-sm-11 col-xs-12 padding_zero">
				 <form name="" action="" method="post">
             <span id="basicExample1">
			
        <input type="text" class="date1 start1 datescls" name="from_date" id="from_date" style="margin-right: 10px;" placeholder="From Date" />
        </span>	
		<span id="basicExample1">
	
        <input type="text" class="date1 end1 datescls" name="to_date" id="to_date" placeholder="To Date" />
        </span>	
     
        <span class="spn_01">
<input type="text" name="phone_no" placeholder="Phone No" >
			</span>
			  <span class="spn_01">
			  
<select  name="service_no" placeholder="Service No" >
<option value="">--select Service Number--</option>
<?php foreach($getdid_calllist_api as $key=> $calllistapi)  { ?>
<option value="<?php echo $calllistapi['did_number']; ?>"><?php echo $calllistapi['did_number']; ?></option>
<?php } ?>
</select>
			</span>
  <span class="spn_01">
<input type="submit" name="misscall_report_search" class="btn btn-primary" value="Search" >
			</span>
		</form>	
      </div>
        <div class="col-md-1 padding_zero">
          <form name="" action="" method="post">

          <input type="hidden" name="from_date" value="<?php echo $_REQUEST['from_date']?>">
         
           <input type="hidden" name="to_date" value="<?php echo $_REQUEST['to_date']?>">
           
           <input type="hidden" name="phone_no" value="<?php echo $_REQUEST['phone_no']?>">
         
           <input type="hidden" name="service_no" value="<?php echo $_REQUEST['service_no']?>">

         <input type="submit" name="misscall_download" class="btn btn-primary conf_download" value="Download" >
   </form>
      </div>
  

			</div>
    
			</div>







	<div class="form">   
    <table id="example" class="table_all" summary="Added Credits">
        <thead>
        <tr>
	<th scope="col" class="rounded-company">S.No</th>
	<th scope="col" class="rounded">Phone No</th>
	<th scope="col" class="rounded">Service No</th>
	<th scope="col" class="rounded">Date</th>
         
        </tr>
        </thead>       
        <tbody>   
      <?php 
 if($_REQUEST['misscall_report_search']){
 $i=0;
foreach($misscallsearch_reportresult as $key=> $misscallsearch){
$i++;
?>
<tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $misscallsearch['phone_number']; ?></td>
             <td><?php echo $misscallsearch['did_number']; ?></td>
            <td><?php echo $misscallsearch['call_time']; ?></td>
        </tr> 

<?php 
}
} else{

  $i=0;
foreach($misscall_reportresult as $key=>$miss_call_result){
$i++;
 ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $miss_call_result['phone_number']; ?></td>
             <td><?php echo $miss_call_result['did_number']; ?></td>
            <td><?php echo $miss_call_result['call_time']; ?></td>
        </tr> 
<?php } } ?>
  
        </tbody>
    </table>
    <div align='center' class="pagination">		
    </div>
</div>
</div>
</div>
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
    $(document).ready(function() {
    $('#example').DataTable( {
       lengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
       pageLength: 25,
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


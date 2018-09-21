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
<body class="skin-blue sidebar-mini">
    <div class="col-sm-9 col-md-9 col-xs-12">    
      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="" >
          <!-- title row -->
          <div class="">
          
            <div class="col-sm-12 col-md-12 col-xs-12" style="padding: 0px !important;">
            <div class="col-md-12 col-sm-12 col-xs-12 padding_zero top_page_heading">
			<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
             <h2>SMS Credits Transaction History</h2>
			</div>

	<div class="col-md-12 col-sm-12 col-xs-12 search_top01 padding_zero">
				<div class="col-sm-11 col-md-11 col-xs-12 padding_zero">
				 <form name="" action="" method="post" onsubmit="return validation()">
             <span id="basicExample1">
			
        <input type="text" class="date1 start1 datescls" name="from_date" id="from_date" value="<?php if($this->session->userdata('from_date')) echo $this->session->userdata('from_date');?>" style="margin-right: 10px;" placeholder="From Date" />
        </span>	
		<span id="basicExample1">
	
        <input type="text" class="date1 end1 datescls" name="to_date" value="<?php if($this->session->userdata('to_date')) echo $this->session->userdata('to_date');?>" id="to_date" placeholder="To Date" />
        </span>	
     
  <span class="spn_01">
<input type="submit" name="report_search" class="btn btn-primary" value="Search" >
			</span>
		</form>	
      </div>
        <div class="col-md-1 padding_zero">
          <form name="" action="" method="post">

		  <input type="hidden" name="from_date" value="<?php echo $this->input->post('from_date')?>">
		 
		   <input type="hidden" name="to_date" value="<?php echo $this->input->post('to_date')?>">
		   
		 <input type="submit" name="report_Download" class="btn btn-primary conf_download" value="Download" >
   </form>
      </div>
  

</div>

</div>

	<div class="form">   
    <table id="example" class="table_all" summary="Added Credits">
        <thead>
        <tr>
		<th scope="col" class="rounded-company">S.No</th>
		<th scope="col" class="rounded">Before Campaign Credits</th>
		<th scope="col" class="rounded">After Campaign Credits</th>
		<th scope="col" class="rounded">Used Credits</th>
		<th scope="col" class="rounded">Campaign Type</th>
		<th scope="col" class="rounded">Date</th>
        </tr>
        </thead>       
        <tbody>   
<?php 
	if($this->uri->segment(3) != '')
	{
		$i= $this->uri->segment(3);
	}	
	else
	{
		$i= 0;
	}
	
	foreach($logs_result as $key=> $logs){
	$i++;
	?>
	<tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $logs->before_campaign_credits; ?></td>
            <td><?php echo $logs->after_campaign_credits; ?></td>
            <td><?php echo $logs->current_campaign_credits; ?></td>
            <td>
            	<?php 
            		if($logs->campaign_id != 0)
            		{
            			echo "Campaign(".$logs->campaign_id.")"; 
            		}
            		else
            		{
            			echo "API(".$logs->job_id.")"; 
            		}	
            	?>
            </td>
            <td><?php echo $logs->date; ?></td>
        </tr> 
<?php }?>
  
        </tbody>
    </table>
    <?php echo $this->pagination->create_links();?>
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
$(document).ready(function(){ 
$('#from_date').datepicker( {
    	changeMonth: true,
    	changeYear: true, 
    	dateFormat: "yy-mm-dd",
		onSelect: function (selectedDate) {
                var orginalDate = new Date(selectedDate);
                var monthsAddedDate = new Date(new Date(orginalDate).setMonth(orginalDate.getMonth() + 1));
                
                $("#to_date").datepicker("option", 'minDate', selectedDate);
                $("#to_date").datepicker("option", 'maxDate', monthsAddedDate);
            }
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });
	$('#to_date').datepicker( {
    	changeMonth: true,
    	changeYear: true, 
    	dateFormat: "yy-mm-dd",
		onSelect: function (selectedDate) {
                var orginalDate = new Date(selectedDate);
                var monthsAddedDate = new Date(new Date(orginalDate).setMonth(orginalDate.getMonth() - 1));
               
                $("#from_date").datepicker("option", 'minDate', monthsAddedDate);
                $("#from_date").datepicker("option", 'maxDate', selectedDate);
            }
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });
    
});
</script>
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
	
<script>
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

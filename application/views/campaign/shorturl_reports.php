<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jtab.min.css" type="text/css"> 
<link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/reports-icon.png" class="right-title-img">Bulk Short Urls  Report</h3>
</div>


<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <ul class="addshorttabs">

  <!-- Updated ON 2017-02-4 -->
        <li><a href="<?php echo base_url();?>campaign/shorturl_allreports">Short URL Reports</a></li>
        <li class="currentshorttab"><a href="<?php echo base_url();?>campaign/shorturlReports">Bulk URL Reports</a></li>
       
          
    </ul>    

</div>

<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
<div class="col-md-12 col-xs-12 col-sm-12 mrgtop25 padding_zero"> 

<form   class="col-md-12 col-xs-12 col-sm-12 form-div padding_zero" action="" method="post" onsubmit="return validation()">
<ul class="search-list05 missedcall_allform">
<li><input type="text" id="from_date" value="<?php if($from_date){echo $from_date;} ?>" name="from_date" placeholder="" class="data-pickerbg"></li>
<li><input type="text" id="to_date" name="to_date"   value="<?php if($to_date){echo $to_date;} ?>"  placeholder="" class="data-pickerbg"></li> 
<li><input type="submit" name="shorturl_report_search" class="submit_btn" value="Search" ></li>
</ul>
</form>	

<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
   
</div>
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
	    <div class="col-md-7 padding_zero re_campain_btns" style="float:right;">
	 
	  </div>
 </div>
    
			</div>
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
    <table  class="table_all">
        <thead>
        <tr>
	<th>S.No</th>
	<th>Long Url</th> 
	<th>No of Url </th>  
	<th>Date & Time</th>  
	<th>Reports</th>	
        </tr>
        </thead>       
        <tbody>   

        <?php

   $count = 0;
foreach($userurl as $shorturl)
{
   
	$count++;
		
 
 
 
?>
		 
	<tr style="height:30px !important;" >
		<td><?php echo $count; ?></td> 
		<td><?php  echo  substr($shorturl->long_url,0,30);  ?></td>   
		<td><?php  echo $shorturl->number_of_url; ?></td>   
		<td><?php echo $shorturl->created_date; ?></td>
		<td>
			
			<a href="<?php echo site_url('campaign/bulkurl/'.$shorturl->shorturl_id);?>" class="btn_cls01">	<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#" >View  </button></a>
  			<a class="btn btn-sm btn-default btn_cls01" href="<?php echo site_url('campaign/download_url_report/'.$shorturl->shorturl_id);?>">Download</a> 
		</td>
  
	</tr>
	<?php }  ?>
    
  
 
    </table>
	</div>
 
   <div class="col-md-12 col-sm-12 col-xs-12 pagination_div padding_zero">
		<?php echo $this->pagination->create_links(); 
		?>
		</div>

</div>
 
</div>
</div></div></body>

	<!-- FastClick -->
	<script src="<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>



	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui-sliderAccess.js"></script>

	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery-validate.bootstrap-tooltip.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
	<script>

  
  
  
$(document).ready(function(){
    $("tr .dropdown-toggle").click(function(){
		 $(this).parent().children().toggleClass("selected_001");
        
    });
   
});
</script>
<script>
$(document).ready(function(){
    $(".close_dropdown").click(function(){
		 $(".dropdown-menu").removeClass("selected_001");
        
    });
   
});


</script>
		
			
<script>
function goBack() {
    window.history.back();
}
</script>

    <script>
	$(document).ready(function() {
	
      $(".assign").on("change",function () {
          
            $(".assigncampaign").prop('checked', $(this).prop("checked"));
      });
      
      $(".masking").on("change",function () {
           
            $(".maskingcampaign").prop('checked', $(this).prop("checked"));
      });
      
      
       $(".unassign").on("change",function () {
          
            $(".unassigncampaign").prop('checked', $(this).prop("checked"));
      });
      
      $(".unmasking").on("change",function () {
           
            $(".unmaskingcampaign").prop('checked', $(this).prop("checked"));
      });
      
      });
     </script>     
     
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

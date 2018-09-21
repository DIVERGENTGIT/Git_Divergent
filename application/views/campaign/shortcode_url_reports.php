<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jtab.min.css" type="text/css"> 
<link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/reports-icon.png" class="right-title-img">Short Code Reports</h3>
</div>
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero"> 
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero"> 
</div>
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
	    <div class="col-md-7 padding_zero re_campain_btns" style="float:right;">
	 
	  </div>
 </div>
    
			</div>
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
    <table class="table_all">
        <thead>
        <tr>
	<th scope="col" class="rounded-company">S.No</th> 
	<!-- ADDED on 2017-01-23 -->
	<th scope="col" class="rounded">Ip address</th> 
	<th scope="col" class="rounded">Device type</th>
	<th scope="col" class="rounded">Browser type</th>
	<th scope="col" class="rounded">Operating System</th> 
	<th scope="col" class="rounded">Date & Time</th>
         </tr>
        </thead>       
        <tbody>   

        <?php
  
  

if(count($shorturlreports)>0)
{
	foreach($shorturlreports as $shorturl)
	{
 
		$count++;  ?>
		<tr style="height:30px !important;" >
			<td><?php  echo $count; ?></td> 
			<td><?php  echo $shorturl->ip_address; ?></td>
			<td><?php  echo $shorturl->device_type; ?></td>
			<td><?php  echo $shorturl->browser_type; ?></td>
			<td><?php echo $shorturl->operating_system; ?></td>
			<td><?php echo $shorturl->created_on; ?></td>
		</tr>
		
<?php }   } ?>
    
  </tbody>   
 
    </table>
	</div>
 
    <div align='center' class="pagination">		
    </div>
	 
 	<div align='' class="back col-md-4 well"  class="pagination" style=" float:left; background-color:transparent !important; border:none !important; box-shadow:none !important;">
		<span class="bt_green_lft"></span><a onclick="history.back();" style="cursor:default"; ><strong>Back</strong></a><span class="bt_green_r"></span> 
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

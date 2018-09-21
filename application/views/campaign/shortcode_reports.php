<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/reports-icon.png" class="right-title-img">All Short URL Reports</h3>
</div>
        <!-- Main content -->
        <section class="col-md-12 col-xs-12 col-sm-12 padding_zero">  
          <!-- title row -->
          <div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
          
            <div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
            <div class="col-md-12 col-xs-12 col-sm-12 padding_zero form-div top_page_heading">
			

				<div class="col-md-12 col-xs-12 col-sm-12 search_top01 padding_zero">
				<div class="col-md-10 col-xs-12 col-sm-10 padding_zero">
<form name="" action="" method="post" onsubmit="return validation()">
<ul class="search-list05 mrg-zero missedcall_allform">
<li><input type="text" id="from_date" name="from_date" value="<?php if($from_date){echo $from_date;} ?>" placeholder="<?php echo date('Y-m-d');?>"  class="data-pickerbg"></li>
<li><input type="text" id="to_date" name="to_date" value="<?php if($to_date){echo $to_date;} ?>" placeholder="<?php echo date('Y-m-d');?>"  class="data-pickerbg"></li>
<li>
<input type="submit" name="shorturl_report_search" class="submit_btn" value="Search" >
</li>
</ul>
           <!--  <span id="basicExample1">
			
        <input type="text" class="date1 input_hgt30 start1 datescls" name="from_date" id="from_date" style="margin-right: 10px;" placeholder="From Date" />
        </span>	  
		<span id="basicExample1">
	
        <input type="text" class="date1 end1 input_hgt30 datescls" name="to_date" id="to_date" placeholder="To Date" />
        </span>	
			
  <span class="spn_01">
<input type="submit" name="shorturl_report_search" class="btn btn-primary" value="Search" >
			</span>-->
		</form>	
      </div>
        <div class="col-md-2 col-xs-12 col-sm-2 padding_zero">
          <form name="" action="" method="post">

          <input type="hidden" name="from_date" value="<?php echo $_REQUEST['from_date']?>">
         
           <input type="hidden" name="to_date" value="<?php echo $_REQUEST['to_date']?>">
           
         <input type="submit" name="shorturl_download" class="pull-right submit_btn" value="Download" >
   </form>
      </div>
  

			</div>
    
			</div>


	<div class="col-md-12 col-xs-12 col-sm-12 form-div padding_zero">  
<div class="">	
    <table  class="table_all" summary="Added Credits">
        <thead>
        <tr>
	<th scope="col" class="rounded-company">S.No</th>
	
	<th scope="col" class="rounded">Phone1</th>   
	<!-- ADDED on 2017-01-23 
	<th scope="col" class="rounded">City</th> -->
	<th scope="col" class="rounded">Device type</th>
	<th scope="col" class="rounded">Browser type</th>
	<th scope="col" class="rounded">Operating System</th>
	<th scope="col" class="rounded">Build By</th>
	<th scope="col" class="rounded">Short Url</th>
	<th scope="col" class="rounded">Date & Time</th>
     
        </tr>
        </thead>       
        <tbody>   
  
 

        <?php
        
   $sno=1;
   if($this->uri->segment(5)!='')
   {
    $sno=$this->uri->segment(5)+1;
   }

if(count($shorturlreports)>0)
{
	foreach($shorturlreports as $shorturl)
	{
 
		$count++;  ?>
		<tr style="height:30px !important;" >
			<td><?php echo $sno; ?></td>
			<td><?php echo $shorturl['to_mobile_no']; ?></td>		
			<td><?php echo $shorturl['device_type']; ?></td>
			<td><?php echo $shorturl['browser_type']; ?></td>
			<td><?php echo $shorturl['operating_system']; ?></td>
			<td><?php echo $shorturl['build_by']; ?></td>
			<td><?php echo $UrlGenIp.$shorturl['short_code']; //$shorturl['long_url']; ?></td>
			<td><?php echo $shorturl['created_on']; ?></td>
		</tr>
		
<?php
  $sno++;
 }   
	
} else{  
	//echo '<tr style="height:30px !important;" ><td valign="top" colspan="7" class="dataTables_empty">No data available in table</td></tr>';
	}  
	?>
  
	
  
        </tbody>
    </table>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 pagination_div padding_zero">
<?php echo $this->pagination->create_links(); 
?>
</div>

</div>
</div>
</div>
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero"> 
<button class="submit_btn" onclick="goBack()">Go Back</button>
</div>
</section></div></div>
</body>


			
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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
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

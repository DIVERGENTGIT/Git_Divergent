<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jtab.min.css" type="text/css"> 
<link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/reports-icon.png" class="right-title-img">Short Url Reports</h3>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <ul class="addshorttabs">

  <!-- Updated ON 2017-02-4 -->
        <li class="currentshorttab"><a href="<?php echo base_url();?>campaign/shorturl_allreports">Short URL Reports</a></li>
        <li><a href="<?php echo base_url();?>campaign/shorturlReports">Bulk URL Reports</a></li>
       
          
    </ul>  

</div>
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
<div class="col-md-12 col-xs-12 col-sm-12 mrgtop25 padding_zero"> 
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
<form name="" class="col-md-10 col-xs-10 col-sm-12 form-div padding_zero" action="" method="post" onsubmit="return validation()">
<ul class="search-list05 missedcall_allform">
<li><input type="text" id="from_date" value="<?php if($from_date){echo $from_date;} ?>" name="from_date" placeholder="<?php echo date('Y-m-d');?>" class="data-pickerbg"></li>
<li><input type="text" id="to_date"name="to_date"   value="<?php if($to_date){echo $to_date;} ?>"  placeholder="<?php echo date('Y-m-d');?>" class="data-pickerbg"></li>
<!--
<li><select  name="longurl" placeholder="Service No" >
<option value="">--select url--</option>
<?php
  $longurl = array_unique($shorturlreportsdropdown);
 

$change_code = implode(",",$longurl);
$long_url = explode(",",$change_code);
 
for($x=0;$x<count($long_url);$x++)
{
	 $selected;
 
	if($this->session->userdata('longurl') == $long_url[$x]) 
	{	
		 $selected = "selected";
	}
?>
<option value="<?php echo $long_url[$x]; ?>" <?php  echo $selected?>><?php echo $long_url[$x]; ?></option>

<?php
} 
?>
</select></li> -->
 
<li><input type="submit" name="shorturl_report_search" class="submit_btn" value="Search" ></li>
</ul>
</form>	
<form name="" action="" class="form-div col-md-2 col-xs-2 col-sm-12 padding_zero" method="post">
<span class="spn_01">
<!-- <input type="submit" name="shorturl_report_reset" class="flt-right submit_btn" value="Reset" >-->
</span>
</form>   
</div>
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
	    <div class="col-md-7 padding_zero re_campain_btns" style="float:right;">
	 
	  </div>
 </div>
    
			</div>
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
    <table class="table_all"  >
        <thead>
        <tr>
	<th>S.No</th>
	<th>CampaignID</th>
	<th>Message</th> 
	<th>Short Url </th>  
	<th>No of shorturls </th>  
	<th>Date & Time</th>
	<th>Reports</th> 	
        </tr>
        </thead>       
        <tbody>     

        <?php

if(count($shorturlreports)>0)
 {
if($this->uri->segment(3) != "")
{
	$count = $this->uri->segment(3);
}
else
{
	$count = 0;
}
   
   
foreach($shorturlreports as $shorturl)
{
 
$number_of_shorturl = substr_count($shorturl['sms_text'], $UrlGenIp);  
$total_urls = $shorturl['phone_nos_count']*$number_of_shorturl;
$count++;
		
  
?>
		
<tr>
		<td><?php echo $count; ?></td>
		<td><?php echo $shorturl['campaign_id']; ?></td> 
 
		<td><p data-toggle="tooltip" data-placement="bottom" title="<?php echo wordwrap($shorturl['sms_text'], 150,'..'); ?>" class="wordwraptxt"><?php echo wordwrap($shorturl['sms_text'], 150,'..'); ?></p></td>
		<!-- <td><?php echo $shorturl['to_mobile_no']; ?></td> --> 
		
		 
		<td><?php echo $shorturl['long_url']; ?></td>  
		  
				  		<td><?php echo $total_urls; ?></td>  
		 
		<td><?php echo $shorturl['date_created']; ?></td>

		<td><a href="<?php echo base_url(); ?>campaign/getshortcode_reports/<?php echo $shorturl['campaign_id'];?>/<?php echo $shorturl['short_code'];?>" class="btn_cls01">	<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#">View  </button></a></td>
 
			
			<div class="dropdown">  
			 
  </div> 
 
 
 
<script>
$(document).ready(function(){
   // $(".close_dropdown").click(function(){
		// $(".dropdown-menu").removeClass("selected_001");
        
   // });  
    
  
    
   
});


 
function campaignFeedback<?php echo $count; ?>(userphoneno)
{

var users_phoneno=userphoneno;
console.log(users_phoneno);
var users_reason = $(".user_reason<?php echo $count; ?>").val();
var users_comment = $(".user_comment<?php echo $count; ?>").val();
//console.log(status);
console.log(users_reason);
console.log(users_comment);
$.ajax({
type:"GET",
data:{users_reason:users_reason,users_comment:users_comment,users_phoneno:users_phoneno},
url:'<?php echo base_url(); ?>campaign/campaignallleadsFeedback',
success:function(response)
{

console.log(response);

$(".feedbackdisplaytable").html(response);

 $(".user_reason"+userphoneno).val('');
 $(".user_comment"+userphoneno).val('');

//console.log("success!..");
//alert("success");
},
error:function()
{
console.log("Failed!..");
}
});
}


function campaignFeedbacksubmit<?php echo $count; ?>(userphoneno)
{

var users_phoneno=userphoneno;
console.log(users_phoneno);
var users_reason = $(".user_reason<?php echo $count; ?>").val();
var users_comment = $(".user_comment<?php echo $count; ?>").val();
//console.log(status);
console.log(users_reason);
console.log(users_comment);

 if(users_reason=='')
      {
        $(".user_reasonmsgerror<?php echo $count; ?>").show();
      }
      if(users_comment=='')
      {
        $(".user_commentmsgerror<?php echo $count; ?>").show();
      }
 
 if(users_reason!='' && users_comment!='')
  {
     
	$.ajax({
	type:"GET",
	data:{users_reason:users_reason,users_comment:users_comment,users_phoneno:users_phoneno},
	url:'<?php echo base_url(); ?>campaign/campaignallleadsFeedback',
	success:function(response)
	{

	console.log(response);

	$(".feedbackdisplaytable").html(response);

	$(".user_reason<?php echo $count; ?>").val('');
	$(".user_comment<?php echo $count; ?>").val('');
	
	 $(".user_reasonmsgerror<?php echo $count; ?>").hide();
      $(".user_commentmsgerror<?php echo $count; ?>").hide();

	//console.log("success!..");
	//alert("success");
	},
	error:function()
	{
	console.log("Failed!..");
	}
	});

  }
}

</script>
  

  </td>   
	</tr>
	<?php } 
} ?>
  
        </tbody>
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
	<script src='<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js'></script>
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


<link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">  
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/analytics-icon.png" class="right-title-img">Missed Call Reports</h3>
</div>
<div class="col-md-12 col-xs-12 col-sm-12 padding_zero">
<div class="col-md-12 col-xs-12 col-sm-12 form-div padding_zero">
<form name="" class="col-md-12 col-xs-12 col-sm-12 padding_zero" action="" method="post">
<ul class="search-list05 missedcall_allform">
<li><input type="text" id="from_date" name="" placeholder="2016-12-21" class="data-pickerbg"></li>
<li><input type="text" id="to_date" name="" placeholder="2016-12-21" class="data-pickerbg"></li>
<li><input type="text" name="phone_no" class="input_hgt30" placeholder="Phone No" ></li>
<li><select  name="service_no" placeholder="Service No" >
<option value="">--Select Service Number--</option>
    <?php
foreach($didnumbers as $didnumber)
{
?>
<option value="<?php echo $didnumber ?>"><?php echo substr($didnumber,-10); ?></option>

<?php
}
?>
</select></li>
<li><input type="submit" name="misscall_report_search" class="submit_btn" value="Search" ></li>
</ul>

		</form>	
      </div>
	<!-- <div class="col-md-12 padding_zero all_report_icon_cdv">
	 <span class="view_bt_ftaw dropdown-toggle" data-toggle="dropdown" title="Download">
		<i class="fa fa-download" aria-hidden="true"></i>
			</span>
			<span class="view_bt_ftaw dropdown-toggle" data-toggle="dropdown" title="Re Campaign Voice" >
			<i class="fa fa-volume-up" aria-hidden="true"></i>
			</span>
	 <span class="view_bt_ftaw dropdown-toggle" data-toggle="dropdown" title="Re Campaign" >
			<i class="fa fa-bullhorn" aria-hidden="true"></i>
			</span>
			
			
	  </div>-->
	  <div class="col-md-6 padding_zero re_campain_btns" style="float:right;">
	  <!-- <span class="re_camp01_spn">
<span class="re_camp01">
          <form name="campaignleads" action="<?php echo base_url(); ?>index.php/inboundservice/multiselected_normalsms" method="post">

         <input type="submit" name="send_normalsmas" class="btn btn-primary" value="Re Campaign">
           <input type="hidden" name="from_date" value="<?php echo $_REQUEST['from_date']?>">
         
           <input type="hidden" name="to_date" value="<?php echo $_REQUEST['to_date']?>">
           
           <input type="hidden" name="phone_no" value="<?php echo $_REQUEST['phone_no']?>">
         
           <input type="hidden" name="service_no" value="<?php echo $_REQUEST['service_no']?>">
           <input type="hidden" name="numbers" value="<?php echo @$numbers;?>">
   </form>
   
      </span>
      
      
      <span class="re_camp01">
          <form name="campaignleads" action="<?php echo base_url(); ?>index.php/outboundservice/leadcampaignmissedcallreport" method="post">

         <input type="submit" name="send_normalsmas" class="btn btn-primary" value="Re Campaign Voice">
           <input type="hidden" name="from_date" value="<?php echo $_REQUEST['from_date']?>">
         
           <input type="hidden" name="to_date" value="<?php echo $_REQUEST['to_date']?>">
           
           <input type="hidden" name="phone_no" value="<?php echo $_REQUEST['phone_no']?>">
         
           <input type="hidden" name="service_no" value="<?php echo $_REQUEST['service_no']?>">
           
            <input type="hidden" name="numbers" value="<?php echo @$numbers;?>">

   </form>
   
      </span>
   <span class="re_camp01">
          <form name="" action="" method="post">

         
           <input type="hidden" name="from_date" value="<?php echo $_REQUEST['from_date']?>">
         
           <input type="hidden" name="to_date" value="<?php echo $_REQUEST['to_date']?>">
           
           <input type="hidden" name="phone_no" value="<?php echo $_REQUEST['phone_no']?>">
         
           <input type="hidden" name="service_no" value="<?php echo $_REQUEST['service_no']?>">

         <input type="submit" name="misscall_download" class="btn btn-primary conf_download" value="Download" >
   </form>
   
      </span>
	  </span>  -->
</div>
    
	 <form method="post" action="" >
	



    <table id="example" class="table_all" summary="Added Credits">
        <thead>
        <tr>
	<th scope="col" class="rounded-company">S.No</th>
	<th scope="col" class="rounded">Phone No</th>
	<th scope="col" class="rounded">No of Tries</th>
	<th class="sendee-color" scope="col" >Assigned To</th>
	<th scope="col" class="rounded">Service No</th>
	<th scope="col" class="rounded">Date & Time</th>
	<!-- <th scope="col" class="rounded">Call</th>
	<th scope="col" class="rounded">Action</th> -->
        </tr>
        </thead>       
        <tbody>   

        <?php

if(count($misscall_reportresult)>0)
{
foreach($misscall_reportresult as $missedcall)
{

     
	 
$count++;
 $rs=$this->campaign_model->assigncampainsvausernames($missedcall['phone_number'],$missedcall['user_id']);
 $rs_1=$this->campaign_model->get_call_status($missedcall['phone_number'],$missedcall['user_id']);
 
?>
<tr style="height:30px !important;" >
<td><?php echo $count; ?></td>
<td style="width:130px!important;"><?php echo $missedcall['phone_number']; ?>
<td style="width:130px!important;"><a href="#modelphone_count" data-toggle="modal" data-target="#modelphone_count_<?php echo $missedcall['call_id']; ?>"><?php echo $missedcall['phonenocount']; ?></a>
<div id="modelphone_count_<?php echo $missedcall['call_id']; ?>" class="modal fade" tabindex="-1" role="dialog">

        <div class="modal-dialog modal-md">
        
            <div class="modal-content ">
           
           
           
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">No of tries</h4>
                </div>


               <div class="modal-body">
			   <table class="table_all">
			   <thead>
			  
    <tr>
     
	<th>S.No</th>
	<th>Phone Number</th>
	<th>Date & Time</th>
	
	</tr>
	</thead>
	 <tbody>
	  <?php 
           
     
	$user_id =$this->session->userdata('user_id');
	$nooftries='NOOFTRIES';
	$mobileno=$missedcall['phone_number'];
	$did_number=$missedcall['did_number'];
	$ivr_system_fields = array(
		'user_id' => urlencode($user_id),'nooftries'=>$nooftries,'mobileno'=>$mobileno,'did_number'=>$did_number);
	// $rscount_url = $this->config->item('host_api_url')."/get_missedcall_api_count.php";
	 
	 // ADDED on 2017-01-23
	  $rscount_url = 'http://10.10.10.136/VoiceAPIs/get_missedcall_api_count.php';
	  
	$rscount_string = http_build_query($ivr_system_fields);
	//print_r($rscount_string);
	$rscount_conn= curl_init();
	//set the url, number of POST vars, POST data
	curl_setopt($rscount_conn,CURLOPT_URL, $rscount_url);
	curl_setopt($rscount_conn,CURLOPT_POST, count($_POST));
	curl_setopt($rscount_conn,CURLOPT_POSTFIELDS, $rscount_string);
	curl_setopt($rscount_conn, CURLOPT_FORBID_REUSE, 1);
	curl_setopt($rscount_conn, CURLOPT_RETURNTRANSFER, true);
	//execute post
	 $rscount_result = curl_exec($rscount_conn);
	
	
	curl_close($rscount_conn);
	
	$rscount_result_response =json_decode($rscount_result);
	
	//print_r($rscount_result_response);

        $j=0;
           foreach($rscount_result_response as $value) 
           {
           $j++;
            ?>
            
            
    <tr>
    
   
    
	<td><?php echo $j; ?></td>
	<td><?php echo  $value->phone_number; ?></td>  
	
	<td><?php echo  $value->call_time; ?></td>
	
	</tr>
	  
	<?php } ?>
	</tbody>
			   </table>
  </div> 

            </div>
             
        </div>
</div>
</td>
<td><?php echo $rs ?></td>
</td>


	<td><?php echo substr($missedcall['did_number'],-10); ?></td>
	<td><?php echo $missedcall['call_time']; ?></td>
	
     <?php /* <td><a href="#modeltest_mobile<?php echo $count; ?>" data-toggle="modal" data-target="#modeltest_mobile<?php echo $count; ?>" ><img src="<?php echo base_url(); ?>images_n/cal.png"></a>


<div class="modal fade" id="modeltest_mobile<?php echo $count; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modeltest_mobile">Click To Call</h4>
      </div>
      <div class="col-sm-12 modal-body">
       <div class="col-sm-12">  
                              
             <form id="test_audio_msg" method="post" action="">
                <div class="x_content">
             <div class="col-sm-12">
			<div class="col-sm-12 empl_detl">
					<label class="col-sm-4 padding_zero col-xs-12">Your number please</label>
					<div class="col-sm-8 col-xs-12">
						<select name="dropdwnagent_number<?php echo $count; ?>" class="getagent_number<?php echo $count; ?>">
						<option value="">--select--</option>
						<?php foreach($getagent_numbers as $agetnumbers){ ?>
						<option value="<?php  echo $agetnumbers->mobile ?>"><?php  echo $agetnumbers->mobile ?>(<?php  echo $agetnumbers->username ?>)</option>
						
						<?php } ?>
						<option value="other">--other--</option>
						</select>
					</div>
				</div>
                      <div class="col-sm-12 empl_detl getotherphoneno" style="display:none;">
					<label class="col-sm-4 padding_zero col-xs-12"></label>
					<div class="col-sm-8 col-xs-12">
					
						<input type="text"  id="call_mob_num" class="otherphoneno<?php echo $count; ?>">
						
					</div>
				</div>
				<div class="col-sm-12 empl_detl">
					<label class="col-sm-4 padding_zero col-xs-12"></label>
					<div class="col-sm-8 col-xs-12">
					
					
		<input type="hidden" name="client_number" id="client_number<?php echo $count; ?>" value="<?php //echo $dlr->to_mobile_no; ?>" class="btn btn-primary">
					<input type="button" name=""  data-dismiss="modal" id="clicktocall<?php echo $count; ?>" value="Call" class="btn btn-primary">
					</div>
				</div>

			</div>
		</div>
     </form>
     
     

  <?php 
  
   $is_call_record=$this->session->userdata('is_call_record');
  
       $caller_id=$this->session->userdata('caller_id');
  
   ?>

<script>
 $(document).ready(function(){
  $(".getagent_number<?php echo $count; ?>").on("change",function(){
  
  var getagent_number=$(this).val();
  console.log(getagent_number);
  
  if(getagent_number=="other")
  {
  $(".getotherphoneno").show();
  }
  if(getagent_number!="other")
  {
  $(".getotherphoneno").hide();
  }
  });
  
  // get call status 
  
   $("#clicktocall<?php echo $count; ?>").on("click",function() {
   
   // click to call 
   var getagent_number = $(".getagent_number<?php echo $count; ?>").val();
   var otherphoneno = $(".otherphoneno<?php echo $count; ?>").val();
  // var client_number = $("#client_number<?php echo $count; ?>").val(); 
   var sno = '<?php echo $count; ?>';
   var service_num = "<?php echo $caller_id;?>";
   var call_record = "<?php echo $is_call_record;?>";
   
   console.log(getagent_number); 
   
    console.log(otherphoneno);
   // console.log(getagent_number);
   
   $.ajax({
   type:"GET",
    url:"<?php echo base_url()?>/index.php/campaign/clicktocall",
    data:{getagent_number:getagent_number,otherphoneno:otherphoneno,callerid: service_num,record_call: call_record,client_number:'<?php echo $missedcall["phone_number"]; ?>',},
   success:function(data) 
   {
  
   
      
   },
   error:function(data)
   {
   console.log("error!");
   }
   }); 
	    
	  
}); 
});
 </script>
</div>
      </div>
     
    </div>
  </div>
</div>
</td>

	
	
	<!--<td><audio src="http://10.10.10.136/voice_files/audio_files/2016/201605/20160516/2917_1463378215_ABOUTCLG.wav" preload="auto" controls=""></audio></td>-->   
	<td><div class="dropdown">
    <span class="view_bt_ftaw dropdown-toggle" data-toggle="dropdown" title="Feedback" onclick="campaignFeedback<?php echo $count; ?>('<?php echo $missedcall['phone_number']; ?>')">
			<i class="fa fa-comment" aria-hidden="true"></i>
			</span>
    <!--<span class="view_bt_ftaw" data-toggle="tooltip" title="Download"><a href="<?php echo site_url('index/download_audiofile/'.$array[0][0]); ?>"> <i class="fa fa-download"></i></a></span>-->
    <ul class="dropdown-menu dp_design">
      <li class="col-sm-12">
	<! -- feedback -- >
	<div class="col-sm-12 col-xs-12 padding_zero">
	  <span class="close_dropdown" >X</span>
</div>
	 
	
	   <div class="col-sm-12 mrg_top13 col-xs-12 padding_zero">
	  <div class="col-sm-6 col-xs-12 padding_zero">
	  <label>Reason</label>
	  </div>
	  
	  <div class="col-sm-6 col-xs-12 padding_zero">
	   <div class="col-sm-12 col-xs-12  padding_zero">
	 <select name="user_reason18" id="user_reason18" class="user_reason<?php echo $count; ?>">
	  <option value="">Select Reason</option>
	  <option value="Interest to Join">Interest to Join</option>
	  <option value="Already Got Admission">Already Got Admission</option>
	  <option value="Not Interested">Not Interested</option>
	   <option value="Not Answered">No Answered</option>
	  <option value="Other Reason">Other Reason</option>
	  </select>
	  </div>
	  <div class="col-sm-12 col-xs-12  padding_zero">
	  <span class="user_reasonmsgerror<?php echo $count; ?>" style="color:red;display:none">The Field is required</span>
	  </div>
	  </div>
	  </div>

	 <div class="col-sm-12 col-xs-12 mrg_top padding_zero">
	  <div class="col-sm-6 col-xs-12 padding_zero">
	  <label>Comment</label>
	  </div>
	  <div class="col-sm-6 col-xs-12 padding_zero">
	   <div class="col-sm-12 col-xs-12  padding_zero">
	 <textarea name="user_comment18" id="user_comment18" class="user_comment<?php echo $count; ?>" ></textarea>
	 </div>
	  <div class="col-sm-12 col-xs-12  padding_zero">
	  <span class="user_commentmsgerror<?php echo $count; ?>" style="color:red;display:none">The Field is required</span>
	  </div>
	  </div>
	  </div>
	  
	   <div class="col-sm-12 col-xs-12 mrg_top padding_zero">
      <div class="col-xs-12 col-xs-offset-6 padding_zero">
  <input type="hidden" name="usersphoneno" value="<?php echo $missedcall['phone_number']; ?>">
	  <input type="button" name="usercampaign" class="btn btn-primary" value="submit" onclick="campaignFeedbacksubmit<?php echo $count; ?>('<?php echo $missedcall['phone_number']; ?>')">
	  </div>
	  </div>
	
	<! -- feedback -- >
	   <table class="table_all dp_table">
	   <thead>
	    
        <tr>
            <th>User Name</th>
            <th>Reason</th>
           <th>Comment</th>
        </tr>
     
      </thead>
	    	<tbody class="feedback_display feedbackdisplaytable">
	   
		</tbody>
	</table>
	</li>
      
    </ul>
  </div>
  
  <script>
$(document).ready(function(){
    $(".close_dropdown").click(function(){
		 $(".dropdown-menu").removeClass("selected_001");
        
    });
    
  
    
   
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
  
  
  
  </td>    */ ?>  
	
	</tr>
	<?php }}
	?>
	
	
  
        </tbody>
    </table>
	</form>
	
    
    	      <?php echo $this->pagination->create_links(); 
		 ?>	

</div>
</div></div></body>

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

<script type="text/javascript">
    $(document).ready(function() {

    $('#example').DataTable( {
       lengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
       pageLength: 50,
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
$(document).ready(function(){
    $("tr .dropdown-toggle").click(function(){
		 $(this).parent().children().toggleClass("selected_001");
        
    });
   
});
</script>



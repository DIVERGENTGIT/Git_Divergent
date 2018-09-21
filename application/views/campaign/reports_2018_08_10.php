<style>
.search-list05 li{
margin-bottom: 10px;
}
</style>
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url(); ?>images/reports-icon.png" class="right-title-img">Reports</h3>
</div>
<section class="col-sm-12 col-md-12 col-xs-12 padding_zero">
 <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">  
 <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">

  
   
  <form class="col-sm-12 col-md-12 missedcall_allform form-div col-xs-12 padding_zero" role="form" action="<?php echo base_url(); ?>index.php/campaign/viewcampaigns/" name="campaign_search" id="campaign_search" method="post" >
  <ul class="search-list05 missedcall_allform">
  <li><input type="text" id="from_date" name="from_date" value="<?php if($from_date){echo $from_date;} ?>" placeholder=" " class="data-pickerbg"></li>
<li><input type="text" id="to_date" name="to_date" value="<?php if($to_date){echo $to_date;} ?>" placeholder="" class="data-pickerbg"></li>
 



<?php   if(in_array($loginUserID,$abhibusUsers)) {
	//if($loginUserID == 2917) {  ?>
		<li> 
			<select name="usersList" id="usersList">       
				<option value="">Select User Name</option>  
				<?php  foreach($abhiBusUserNames as $userNames) {  ?>
					 <option value="<?php echo $userNames['user_id'];?>" <?php if($selectedUser == $userNames['user_id']) { echo 'selected';} ?> > <?php echo $userNames['username']; ?> </option> 
					<!-- <option value="<?php echo $userNames['user_id']; ?>" > <?php echo $userNames['username']; ?> </option>    -->
				<?php }  ?> 
			</select>  
		</li> 
	<?php } ?>
	
	
<li> 
<select name="sender" id="sender">       
 <option value="">Select Sender ID</option>  
<?php 
	foreach($sender_names as $sender) {   
 ?>
  	<option value="<?php echo $sender;?>" <?php if($sender == $sender_name) { echo 'selected';} ?> > <?php echo $sender; ?>
	</option>    
 <?php 
}  ?> 
</select>  </li>   
<?php 
if($selected_sms_type == 'ApiSms') { ?>
 
<li>
<input type="text" id="mobileNum" name="mobileNum" maxlength=10 placeholder="Mobile Number Search" value="<?php if($mobileNum) { echo $mobileNum; }?>">
</li>
<?php } ?> 
 
<li> 
  
<select name="selected_sms_type">
   

	<option value="NormalSms"<?=$selected_sms_type == 'SMS' ? ' selected="selected"' : '';?>>Campaign</option>
	<option value="ApiSms"<?=$selected_sms_type == 'ApiSms' ? ' selected="selected"' : '';?>>API SMS</option>
</select> 
 <?php 

$file_type_options = array(
'xls'  => 'Excel',
 
);		?>
   
</li>

<li><input  type="submit" class="submit_btn" value="Search" name="submit"></li>
</ul>
  <?php if($selected_sms_type == 'ApiSms') { ?>  
   	<p style="color: #0b4c8b; display: inline-block; width:100%; text-align: center"> Note: On mobile/senderid search you will get one month reports only on selected date </p>
  <?php } ?>

 </form>
 
 </div>
 </div>
<div class="col-sm-12 col-md-12 form-div col-xs-12 padding_zero">
<div class="table-responsive">
                  <table class="table_all"  >
                 <?php if(!empty($api_data)) { ?>
			<thead>
				<tr>  
					<th>SL.No</th>
					<th>On Date</th>
					<th>No. of SMS</th>
					<th>View</th>
					<th>Download</th>
				</tr>
			</thead>
			<tbody>
				 <?php 
				 $count=0; 
				 
				 foreach($api_data as $sms_api) {		
							  		 	
					 $count++;  
				 ?>    
				 	<tr>
				 	<td class="tdee" width='15'><?php echo $count; ?></td>
				 	<td class="tdee"><?php echo $sms_api['ondate']; ?></td>
				 	<td class="tdee"><?php echo $sms_api['noofmsg']; ?></td>
			    
			    <td class="tdee"> <a href="<?php echo site_url('campaign/apiViewReport/campaign/'.$sms_api['ondate'])?>">View</a></td>	
			    <td class="tdee"><a  href="<?php echo site_url('campaign/download_report/'.$sms_api['ondate'])?>" >Download</a>  </td>	 	 	
				 	</tr>  
				   
				 <?php 
				 }
				 ?>
			 </tbody>	
			  </table> 
                    <?php }else{ ?>
                    	<thead>
				<tr>
					<th>SL.No</th>
					<th>Campaign Name</th> 
					<th> Date</th> 
					<th>Sender Name</th>  
					<th style="width:250px !important;">SMS Text</th>
					<th>No. of SMS</th>
					<th>Status</th>
					<th>Reports</th>
				</tr>
			</thead>
                    
                    
                    <?php } ?>
                    <tbody>
					<?php 
		$count=0;
		if(!empty($per_page)){
	$count=$count+$per_page;
	}
		foreach($campaigns as $campaign){		 
		$user_id=$campaign->user_id;
	$count++;
	
		
			
				$cur_date = date('Y-m-d H:i:s');
		//		$days_diff = $this->daysDifference($cur_date, $campaign->created_on);
				
		 $month1 = substr($campaign->created_on,5,2);
         $day1 = substr($campaign->created_on,8,2);
        $year1 = substr($campaign->created_on,0,4);

        $month2 = substr($cur_date,5,2);
        $day2 = substr($cur_date,8,2);
        $year2 = substr($cur_date,0,4);

        $date1 = mktime(0,0,0,$month1,$day1,$year1);
        $date2 = mktime(0,0,0,$month2,$day2,$year2);

        if($date1 > $date2){
           $dateDiff = $date1 - $date2;
        } else {
           $dateDiff = $date2 - $date1;
        }
        $fullDays = floor($dateDiff/(60*60*24));
	
	 		      //  $dlr_report = $this->Campaign_model->get_campaign_numbers($campaign->campaign_id, $fullDays, $campaign->created_on);		
	
	 $dlr_report = $this->Campaign_model->get_all_smsreports_basedoncampaign($campaign->campaign_id, $fullDays, $campaign->created_on);		
	//	print_r($dlr_report);  
			$dnd_count=0;
			$delivered_count=0;
			$invalid_nos_count=0;
			$out_of_range_count=0;
			$memory_capacity_exceeded_count=0;
			$network_error_count=0;
			$barring_count=0;
			$dnd_count=0;
			$invalid_number_length_count=0;
			$dest_no_empty_count=0;
			$multiple_submit_count=0;
			$account_expired_count=0;
			$delivery_failure_count=0;
			$misc_error_count=0;
			$dropped_count=0;  
			$invalid_sender_ids_count=0;
			$mobile_equipment_error_count=0;
			$pending_dlrs_count=0;
			$total_count=0;
  
	?>
                      <tr>
                        <td><?php echo $count; ?></td>  
                        <td><?php echo $campaign->campaign_name; ?></td>
                        <td style="width:130px!important;"><?php echo $campaign->created_on; ?>
                         </td>
                        <td><?php echo $campaign->sender_name; ?></td>
			<!--<td><?php echo $campaign->sender; ?></td> -->
<!--<td><?php echo $campaign->campaign_name; ?></td>
-->
<td style="width:200px !important important;">  <p class="pos_p row-fluid">

<?php	
 
ini_set('mbstring.substitute_character', "none"); 
  
$array = str_split($campaign->sms_text,30);
$text= mb_convert_encoding($array[0], 'UTF-8', 'UTF-8');    
echo htmlspecialchars($text);  
$text1= mb_convert_encoding(($campaign->sms_text), 'UTF-8', 'UTF-8');    
?> 
 <abbr class="clipboardhrf" title="<?php echo htmlspecialchars($campaign->sms_text); ?>"><i class="fa fa-clipboard" aria-hidden="true" id="copyText<?php echo $campaign->campaign_id; ?>" value="<?php echo htmlspecialchars($text1); ?>"></i></abbr>
 <span class="tooltiptext" id="tooltiptext<?php echo $campaign->campaign_id; ?>">Copied</span>
             </p>  
</td>   
                        <td><?php 
echo    $campaign->no_of_messages; 
$delivered_count =  $dlr_report[0]->delivered_count?$dlr_report[0]->delivered_count:0;
$expired_count =  $dlr_report[0]->expired_count?$dlr_report[0]->expired_count:0;
$dnd_count = $dlr_report[0]->dnd_count?$dlr_report[0]->dnd_count:0;
$pending_dlr_count =  $dlr_report[0]->pending_dlr_count?$dlr_report[0]->pending_dlr_count:0;
$invalid_count =  $dlr_report[0]->invalid_count?$dlr_report[0]->invalid_count:0;
                         ?>
             
               <div class="btn-group" >
                <span data-toggle="dropdown" style="margin-left:10px; cursor:pointer;" class="dropdown-toggle "><i class="fa fa-eye" ></i> </span>
                <ul class="dropdown-menu bullet pull-right"  style=" padding:5px; width:250px;background-color:#fff;">
       <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example" style="margin-bottom:0px !important;">
    
      
	    <tbody>
		<tr style="width:200px; background-color:#EFEFEF;" class="odd gradeX">
			<td  style="width:200px; ">Delivered</td>
			<td style="width:50px; "><?php echo $delivered_count; ?></td>
			
		</tr>
		<tr style="width:200px; background-color:#F5F5F5;" class="even gradeC">
			<td  style="width:200px;">DND</td>
			<td  style="width:50px;"><?php echo $dnd_count; ?></td>
			
		</tr>
          
		<tr style="width:200px; background-color:#EFEFEF;" class="odd gradeX">
			<td style="width:200px;">Pending</td>
			<td style="width:50px;"> <?php echo $pending_dlr_count; ?></td>
			
		</tr>
      
		<tr style="width:200px; background-color:#EFEFEF;" class="odd gradeX">
			<td style="width:200px;">Failed Numbers</td>
			<td style="width:50px;"> <?php echo $expired_count+$invalid_count; ?></td>
			
		</tr>
      
        </tbody>
        </table>
                  
                  
                </ul>
              </div> 
              </td>
						 
                         <td><?php 
			if($campaign->campaign_status == 1 && $campaign->is_scheduled == 1 ) {
				echo "Scheduled@ ". $campaign->scheduled_on ;
			}elseif($campaign->campaign_status < 2){
				echo "Processing";
			}else{
				echo "Done";  
			}
		 	 
		 ?>  
         
         
         </td>
         
        <!-- <td> 
         <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#" ><a href='<?php echo site_url('/campaign/viewReport/campaign/'.$campaign->campaign_id);?>'>View</a>  </button>
        
         
         </td>-->
         
         
		   <td>
			<?php //if($campaign->campaign_status == 0) { ?>
				<!-- <a  class='btn_cls01' >	<button class="btn btn-sm btn-default disabled" data-toggle="modal" data-target="#"  >View  </button></a> --> 
			<?php //}elseif($campaign->campaign_status >= 1){ ?>
				<a href="<?php echo site_url('campaign/viewReport/campaign/'.$campaign->campaign_id);?>" class="btn_cls01">	<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#" >View  </button></a>
 <?php //} ?>	
      			 <?php //if($campaign->campaign_status == 2 || ($campaign->campaign_status == 1 && $campaign->is_scheduled == 0)) 
				if($campaign->campaign_status >=  2 )   { ?>
		 	 <a class="btn btn-sm btn-default btn_cls01" href="<?php echo site_url('campaign/download_dlr_report/'.$campaign->campaign_id);?>">Download
			 </a>   

    
		 	<?php }    ?>

			<?php if($campaign->campaign_status == 1 && $campaign->is_scheduled == 1) {  ?>

			  <a href="#<?php echo $campaign->campaign_id;?>" class="btn btn-sm btn-default btn_cls01" data-remodal-target="<?php echo $campaign->campaign_id;?>" data-toggle="modal" > Edit </a>  
 			<?php //if($campaign->user_id == 2917) { ?>
				<a class="btn_cls01" onClick="checkCampaignStatus(<?php echo $campaign->campaign_id?>);" ><button class="btn btn-sm btn-default" data-toggle="modal" data-target="#" >Cancel</button></a> 
			<?php //}else{ ?>
			<!-- <a id="check_status" href="<?php echo site_url();?>/campaign/cancelcampaign/<?php echo $campaign->campaign_id?>" 
		 		class="btn_cls01" onclick="return confirm('Are you really want to Cancel this Campaign?');" ><button class="btn btn-sm btn-default" data-toggle="modal" data-target="#" >Cancel</button></a>  -->

			<?php } //} ?>       
                      
  
<div id="<?php echo $campaign->campaign_id;?>" class="modal fade in"   role="dialog" >

        <div class="modal-dialog">
        <div class="modal-content col-md-12 col-sm-12 col-xs-12 padding_zero">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
           
        </div>

        <div class="modal-body col-md-12 col-sm-12 col-xs-12 padding_zero">
 <form name="scheduleCamp" method="post" id="scheduleCamp<?php echo $campaign->campaign_id?>" class="missedcall_allform" action="#" >
	       
    <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">  

	<div class="col-sm-3 col-md-3 col-xs-12 padding_zero">
        <label class="form_lable">Schedule Date Time</label>    
		</div>
        <div class="col-sm-5 col-md-5 col-xs-12">  
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero"> 
    <input type="text" name="on_date" id="on_date<?php echo $campaign->campaign_id?>" placeholder="<?php echo $campaign->scheduled_on;?>"; class="scheduler_report">
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero"> 
 <p class="scheduleStatus" style="font-weight:bold;"></p>  
        </div>   </div> 
    </div> 
    <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
        <div class="col-sm-5 col-md-5 col-xs-12 col-sm-offset-3 col-md-offset-3"> 
       	
	<input type="hidden" name="campaignId" id="campaignId<?php echo $campaign->campaign_id?>" value="<?php echo $campaign->campaign_id?>" />
       <input type="submit" value="Edit" name="sendsms"   class="submit_btn pull-right"> 
         
        </div>  
    </div>



</form> 
        </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
        </div><!-- End of Modal dialog -->
    </div>




   
<script>
$(document).ready(function() {
  		 			$('.scheduleStatus').text('');
	$("form#scheduleCamp<?php echo $campaign->campaign_id?>").submit(function() {

		var on_date = $("#on_date<?php echo $campaign->campaign_id?>").val();
		var campaign_id = $("#campaignId<?php echo $campaign->campaign_id?>").val();
		
		if(on_date.length == 0) {
 
   		 			$('.scheduleStatus').text('');
			 $('.scheduleStatus').text('Please enter schedule date').css('color','red');
			return false;  
		}else{
			$.ajax({  
				url:"<?php echo base_url();?>campaign/updateschedulecampaign",
				type:'post',
				data:{'on_date':on_date,'campaign_id':campaign_id},
				success:function(data) {
  		 			$('.scheduleStatus').text('');
					var result = $.parseJSON(data);

 					if(result.status == 200) {
 
 
						$('.scheduleStatus').text('Scheduled sms has been updated').css('color','green');
						return false;
					}else{  

 
						$('.scheduleStatus').text('Please enter valid schedule date').css('color','red');
						return false;
					}
				}	    
				  
			});  
		}
		return false;
	});

});
</script>


	<script>
    $(document).ready(function() {
    $(".scheduler_report").datetimepicker({
	dateFormat: "yy-mm-dd",
        minDate: new Date()
	}
	);
  });
  </script>


<script type="text/javascript">//<![CDATA[


 
		
$(document).ready(function() {


	$("#copyText<?php echo $campaign->campaign_id; ?>").click(function() {

$('#tooltiptext<?php echo $campaign->campaign_id; ?>').show();
  
setTimeout(function(){ $('#tooltiptext<?php echo $campaign->campaign_id; ?>').hide(); }, 1000);


//$('.tooltiptext').hide();
		var textMsg =  "<?php echo $campaign->sms_text; ?>";
			
		copyToClipboardMsg(document.getElementById("copyText<?php echo $campaign->campaign_id; ?>"),textMsg);
  
	});   

	//$("#copyText<?php echo $campaign->campaign_id; ?>").click(function() {
 
	//	copyToClipboardMsg(document.getElementById("copyText<?php echo $campaign->campaign_id; ?>"), textMsg);
	//});

	$("#pasteTarget<?php echo $campaign->campaign_id; ?>").mousedown(function() {
 
		this.value = "";
	});


}); 
 

function copyToClipboardMsg(elem, msgElem) {
 
	  var succeed = copyToClipboard(elem,msgElem);
    var msg;
    if (!succeed) {
        msg = "Copy not supported or blocked.  Press Ctrl+c to copy."
    } else {
        msg = "Text copied to the clipboard."
    }
    if (typeof msgElem === "string") {
        msgElem = document.getElementById(msgElem);
    }
    msgElem.innerHTML = msg;
    setTimeout(function() {
        msgElem.innerHTML = "";
    }, 2000);
}

function copyToClipboard(elem,msg) {

	  // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {

        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }  
 
 
        target.textContent = msg; 
 
    }    
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}
 

</script>
</td>    
		  <?php 
		  }
	?>
                      </tbody>
                    </tfoot>
                  </table>
		
</div>
              </div>
	<div class="col-sm-12 col-md-12 col-xs-12 ">	  
         <?php echo $this->pagination->create_links(); 
		?>
		</div>	
   </div>
          	




		  


        </section><!-- /.content -->
</div>
</div>
  <span id="msg"></span>
  </body>
</html>

  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>

<script>
   $(document).ready(function() {

    $('#example1').DataTable( {
       lengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
       paging: false,
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
 

});
</script>
 
 
<script>
function checkCampaignStatus(campaign_id) {
 	$.ajax({
		url:"<?php echo base_url();?>campaign/getCampaignStatus",
		type:"POST",
		data:{'campaign_id':campaign_id},
		success:function(response) {
			 if(response == 1) {
 				var res = confirm('Are you really want to Cancel this Campaign?');
				if(res) {  
					window.location.href = "<?php echo site_url();?>campaign/cancelcampaign/"+campaign_id;
		 		 } 
			 }else{
 				alert("Campaign already completed.");
				window.location.href='';
			 }
		}          
	});   
}  

</script>



 <script type="text/javascript">
/*$(document).ready(function(){ 
$('#join_date1').datepicker( {
    	changeMonth: false,
    	changeYear: false, 
    	dateFormat: "yy-mm-dd",
    	defaultDate: -1,
    	    stepMonths: false,

	numberOfMonths: 1,  
  		  maxDate: new Date() 
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });
	$('#relieve_date1').datepicker( {
    	changeMonth: false,    
    	changeYear: false,     
    	dateFormat: "yy-mm-dd",
    	    	    stepMonths: false,   
		  maxDate: new Date() 
	 
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });
});

 $(document).ready(function(){ 
 $('#join_date1').datepicker( {
    	changeMonth: false,
    	changeYear: false, 
    	dateFormat: "yy-mm-dd",
    	defaultDate: -1,
    	    stepMonths: false,

	numberOfMonths: 1,
 
  		 onSelect: function (selectedDate) {
                var orginalDate = new Date(selectedDate);
                var monthsAddedDate = new Date(new Date(orginalDate).setMonth(orginalDate.getMonth()));

       $("#join_date").datepicker("option", 'minDate', selectedDate);
 
            } 
    }).click(function(){  
    	$('.ui-datepicker-calendar').show();  
    });  
	$('#relieve_date1').datepicker( {
    	changeMonth: false,    
    	changeYear: false,     
    	dateFormat: "yy-mm-dd",   
   	stepMonths: false,  
  
		numberOfMonths: 1,  
		  onSelect: function (selectedDate) {
                var orginalDate = new Date(selectedDate);
                var monthsAddedDate = new Date(new Date(orginalDate).setMonth(selectedDate.getMonth()));
                
                $("#relieve_date").datepicker("option", 'maxDate', monthsAddedDate);
              //  $("#relieve_date").datepicker("option", 'minDate', monthsAddedDate);
            } 
	   
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });  
});*/

</script>


  <script>
  $('#mobileNum').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  });
    </script>


<script>
$('#usersList').on('change',function() {
	var selectedUser = $('#usersList').val();
 	if(selectedUser > 0) {
 		$.ajax({
 			url:"<?php echo base_url();?>campaign/getAbhiBusSenderNames",
 			type:"post",
 			data:{'selectedUser':selectedUser},
 			success:function(res) {
 				var senderNames = $.parseJSON($.trim(res));
 				if(senderNames != '') {
 					$('#sender').text('');
 					var options = '<option value="">Select Sender ID</option>';
 					$.each(senderNames,function(i,v) {
 						//console.log(i+','+v);
 						options +="<option value="+v+">"+v+"</option>";
 					});
 					$('#sender').append(options);
 				}
 				
 			}	
 		
 		});
 	}

});

</script>




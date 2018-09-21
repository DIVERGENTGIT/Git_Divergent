<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">

    <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/sms-icon.png" class="right-title-img">Normal SMS</h3>
</div>



<div class="col-md-10 col-sm-10 col-xs-12 servicewidth padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">

 <div class="col-sm-9 col-md-9 col-xs-12">
<?php if(isset($error)) {   ?>
 		<div class="error_msgspn"><?php echo $error;  ?></div>
 <?php
 		}else{ ?>

<div class="error_msgspn">Please note - If you are sending more than 100000 sms please use FILE SMS or CUSTOM SMS.</div>
		<?php }?>

 </div>
 </div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
      <!-- Content Wrapper. Contains page content -->
      
    
      <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
      
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="col-sm-12 col-md-12 col-xs-12 padding_zero">
  
  
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<?php echo form_open('campaign/normalSMS',
array('id' => 'single_sms_form', 'name' => 'single_sms_form', 'class' => 'missedcall_allform', 'method' => 'post', 'style' => 'margin:0px !important')
); ?>   
 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-sm-7 col-md-7 col-sm-offset-2 col-md-offset-2 mrg20tab padding_mzero col-xs-12">
               <div class="col-sm-5 col-md-5 col-xs-12 padding_zero">
			   <div class="radiobtn">
			   
			    <!-- Updated ON 2017-02-4 -->
			       <input type="radio" class="" id="normsms" value='0' name="sms_type" checked >
			   <!--	<?php echo form_radio('sms_type','0',TRUE,'id="normsms"'); ?> -->
    
    <label for="normsms" class="mob_lable">Normal SMS</label>
<div class="check"></div>  
</div>
</div>
<div class="col-sm-5 col-md-5 col-xs-12 padding_zero">
<div class="radiobtn">

 <!-- Updated ON 2017-02-4 -->
    <input type="radio" class="" id="flashsms" value='1' name="sms_type"  >
<!--<?php echo form_radio('sms_type','1',set_radio('sms_type','id="flashsms"')); ?>-->
<label for="flashsms" class="mob_lable">Flash SMS</label>
<div class="check"></div>
</div>
</div>
				   </div>
              </div>


               <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
			   <div class="col-sm-2 col-md-2 col-xs-12 tbresp-label padding_zero">
 <label class="form_lable">Campaign Name</label>
 </div>
                    <div class="col-sm-7 col-md-7 col-xs-12 tbresp-rt padding_mzero">
                        
						<?php echo form_input(array('name' => 'campaign_name', 
						'id' => 'campaign_name', 'placeholder' => 'Campaign Name','class' => '',
						'value' => set_value('campaign_name')));?>
                        	<div class="form_error"></div>
							
							
                    </div>
                </div>
                
 
              <!-- ADDED ON 2017-01-23 
            
			<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
			<div class="col-sm-3 col-md-3 col-sm-12 padding_zero">
			<label class="form_lable">Missed Call</label>
			</div>
			<div class="col-sm-7 col-md-7 col-xs-12">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
				<select name="mc_nos[]"  id="mc_nos" placeholder="Long Code" class="lc_nos01" style="margin-bottom:0px !important;"> 
					<option value="">--Select DID Number--</option>

					<?php 
					foreach($did_result_response as $key=>$mobileno)
					{  
					?>
					<option  class="" value="<?php echo $mobileno['did_number'] ?>"><?php echo $mobileno['did_number'] ?></option>

					<?php
					}
					?>
				</select>
				</div>
				<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
				<span class="saveselected" style="display:none;"></span>
				<div class="msd_error"></div>
</div>				
			</div> 
		
			</div>   -->

			<!--<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
			<div class="col-sm-3 col-md-3 col-xs-12 padding_zero">
			<label class="form_lable">Short Url</label>
			</div>
			<div class="col-sm-7 col-md-7 col-xs-12">

				<input type="text" name="shorturl_input" value="<?php echo $_REQUEST['shorturl_input'];?>" id="checkit1" placeholder="Short Url" class="short_input" style="margin-bottom:0px !important;"> 

				<input type="button" name="" value="Short"  id="checkit2" class="short_url_btn btn btn-default btn-sm">


				<div class="short_error"></div>	

				</div>
			</div>-->

 <div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
 <div class="col-sm-2 col-md-2 col-xs-12 tbresp-label padding_zero">
 <label class="form_lable">Sender ID </label>
</div>
 <div class="col-sm-7 col-md-7 col-xs-12 tbresp-rt padding_mzero">

	  	<?php echo form_dropdown('sender', $sender_names, set_value('sender'),
		array( 'class'=>''));?> 
        </span>
<div class="form_error"><?php echo form_error('sender'); ?></div>

                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
 
						  <div class="col-md-7 col-sm-7 col-xs-12 padding_mzero mrg20tab tbresp-rt col-sm-offset-2 col-md-offset-2">
						  <div class="col-md-12 col-sm-12 col-xs-12 form-divadd add-btns-div padding_zero">
						
						 <!-- Updated ON 2017-02-4 -->

						<span class="add-btns-divspan addspan01"><a href="#addtemplatemodel" data-toggle="modal" class="add_pluse" data-target="#addtemplatemodel" onClick="getTemplatesInfo();">
                                    <i class="fa fa-plus"></i>
                                    <span> Add/Select Templates</span>
                                </a></span>
								<span class="add-btns-divspan addspan02"><a href="#addshorturlmodel" data-toggle="modal" class="add_pluse" data-target="#addshorturlmodel">
                                    <i class="fa fa-plus"></i>
                                    <span> Add Short URL</span>
                                </a></span>
								<span class="add-btns-divspan addspan03">
					<a href="#addmissedcallmodel" data-toggle="modal" class="add_pluse" data-target="#addmissedcallmodel">
                                    <i class="fa fa-plus"></i>
                                    <span> Add Missed Call</span>
                                </a>
                                </span>
						
						 </div>
						 
						  </div>
</div>
                 <div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
    <div class="col-sm-2 col-md-2 col-xs-12 tbresp-label padding_zero">
                    <label class="form_lable">Text </label>
					</div>
                   <div class="col-sm-7 col-md-7 col-xs-12 tbresp-rt padding_mzero">
				    <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
				   	<?php echo form_textarea(array('name' => 'sms_text', 'onKeyup' =>"calculateSMSLength()", 'id' => 'sms_text', 'placeholder' => 'Type here', 'rows' => 4, 'cols' => 30, 'style' => 'margin-bottom:0px !important;', 'class' => '', 'value' => set_value('sms_text')));?>
						
</div>
           <div class="col-sm-12 col-md-12 col-xs-12 padding_zero"> 
<div class="col-md-6 col-sm-6 col-xs-6 numwfull padding_zero">		   
                        <h6  class="label count_message count_num" id="count_message">0</h6><small>Number of Characters</small>
</div>
<div class="col-md-6 col-sm-6 col-xs-6 pull-right numwfull txt_alignrt padding_zero">
                        <span class="label count_message count_num" id="hwmnysms">0</span><small>Number of SMS</small>
						</div>
							</div>
						<div class="col-sm-12 col-md-12 col-xs-12 padding_zero form_error"><?php
						
						
						 echo form_error('sms_text'); ?></div>
                    </div>
                    
		                    
                </div>
				<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
                <div class="col-sm-7 col-md-7 col-sm-offset-2 col-md-offset-2 mrg20tab padding_mzero col-xs-12">
               <a href="#addgroupmodel" data-toggle="modal" data-target="#addgroupmodel" class="contct-mob add_pluse">
                                    <i class="fa fa-plus"></i>
                                    <span class=""> Add Contacts </span>
                                </a>
						   </div>
						   </div>
                <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">

			<div class="col-sm-2 col-md-2 col-xs-12 tbresp-label padding_zero">


			</div>
			<div class="col-sm-7 col-md-7 col-xs-12 tbresp-rt padding_mzero append_data">

				<p id="uniqueNumCount" style='color:#0b4c8b;'>  </p>

  
			</div>

		</div>
               <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
                <div class="col-sm-2 col-md-2 col-xs-12 tbresp-label padding_zero">
                    <label class="form_lable">Mobile No </label>
					</div>
                    <div class="col-sm-7 col-md-7 col-xs-12 tbresp-rt padding_mzero append_data">
					
					<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<?php 

echo form_textarea(array('name' => 'to_mobileno', 'id' => 'to_mobileno', 'placeholder' => 'Mobile numbers (one number each line)', 'rows' => 7, 'cols' => 30, 'class' => 'form-control', 'style' => 'padding: 5px !important;', 'value' => set_value('to_mobileno')));?>
</div>
	<div class="col-sm-12 col-md-12 col-xs-12 padding_zero form_error"><?php echo form_error('to_mobileno'); ?></div>

                    </div>
                    	
                </div>
				
		<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
         
                    <div class="col-sm-7 col-md-7 col-xs-12 mrg20tab padding_mzero col-sm-offset-2 col-md-offset-2">
					<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
						 <div class="col-md-6 col-sm-6 col-xs-6 numwfull padding_zero">
						<div class="all_checkbox">
 <?php echo form_checkbox(array('name' => 'remove_duplictes', 'class'=>'flat-red', 'id' => 'remove_duplictes', 
                    'value' => 1)); ?>
  <label class="font_normal" for="removedup"><span><span></span></span>Remove Duplicate</label>
</div>
						 </div>
						<div class="col-md-6 col-sm-6 col-xs-6 numwfull pull-right txt_alignrt padding_zero">
									<div class="all_checkbox">
  <?php echo form_checkbox(array('name' => 'numbers_count', 'id' => 'numbers_count', 'value' => 1)); ?>
  <label class="font_normal" for="showcount"><span><span></span></span>Show Count</label>
</div>
						 
						 </div>
						 </div>
 </div>
       </div>
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero"> 
  <div class="col-sm-2 col-md-2 col-xs-12 tbresp-label padding_zero">
                    <label class="form_lable">Date & time :</label>
					</div>    
 <div class="col-sm-7 col-md-7 col-xs-12 tbresp-rt padding_mzero">
            
          <div id="datetimepicker1" class="input-append date">
            
            
            <?php echo form_input(array('name' => 'on_date', 'class' => 'data-pickerbg scheduler_time01', 'id' => 'on_date', 'placeholder' => 'Schedule Date & Time', 'value' => set_value('on_date'),'data-format'=>'yyyy-MM-dd hh:mm:ss','style'=>'width:200px;')); ?>
           
          </div>
           
          </div>
                                    <div class="form_error"><?php echo form_error('on_date'); ?></div>
        
        
                        </div>
   <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
                    
                    <div class="col-sm-9 col-md-9 col-xs-9 col-sm-offset-2 mrg20tab padding_mzero col-md-offset-2">
			<!--		
 <input type="button" class="btn warning" value="Send"  data-placement="top" tooltip-trigger="focus" style=" height:30px; width:200px; background-color:#04A8ED; border:none; color:#fff;"> -->
 
  <!-- Updated ON 2017-02-4 
  <input type="hidden" name="shorturl_text[]" id="shorturl_text1"  />
  <input type="hidden" name="shorturl_text[]" id="shorturl_text2"  />
  <input type="hidden" name="shorturl_text[]" id="shorturl_text3"  />
  <input type="hidden" name="shorturl_text[]" id="shorturl_text4"  />


  <input type="hidden" name="shorturl_input[]" id="shorturl_input1" />
  <input type="hidden" name="shorturl_input[]" id="shorturl_input2" />
  <input type="hidden" name="shorturl_input[]" id="shorturl_input3" />
  <input type="hidden" name="shorturl_input[]" id="shorturl_input4" />-->

 
   <input type="hidden" name="shorturl_input" id="shorturl_input" />  
	    <input type="hidden" name="shorturl_text" id="shorturl_text"  />


                    		<?php echo form_submit(array('name' => 'sendsms','value' => 'Send', 'type' => 'submit',
							'class' => 'submit_btn sendbtnmrgn','data-placement' => 'top','style' => ''));?>
 	  <?php //echo form_reset(array('name' => 'reset','value' => 'Reset', 'class' => 'submit_btn mrg2px sendbtnmrgn','data-placement' => 'top','style' => ''));?>
                    </div>   
                </div>
                
          
            
 
                
                </div>
            </div>
        </div>
       
        </section>
   
	   
	<!-- Add template -->
<div id="modal-add" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="margin-top: 0px !important;">
        <div class="modal-content" style="border:0px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title"><center>Add Templates</center></h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" name="templateform" method="post" action="<?php echo base_url(); ?>campaign/normalSMS">
		  
  
    <div class="form-group">
        <label class="control-label col-md-2" for="template">Templates</label>
        <div class="col-md-8">
    <textarea rows="4" class="form-control" id="addtemp" name="addtemp" ></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6">
<button type="button" class="btn btn-default btn-sm pull-right" data-dismiss="modal">Close</button>
       <button type="submit" value="Submit" name="addsubmit"  class="btn btn-default btn-sm pull-right" style="margin-right:20px;">Submit</button>
        
        </div>
    </div>
</form>
        </div><!-- End of Modal body -->
        </div><!-- End of Modal content -->
        </div><!-- End of Modal dialog -->
    </div><!-- End of Modal -->		


    </div><!-- ./wrapper -->
	</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/jquery.loadingoverlay/latest/loadingoverlay.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.loadingoverlay/latest/loadingoverlay_progress.min.js"></script>
<?php


if(isset($validatationtrue) && (!$no_balance) && (!$error)) {

$start=1000;  
$y=0;
for($x=0;$x<1000;$x++)
{
$end=round(number_format((microtime(true)-$start),2))*1000;
}

?>


<script>
var customtext   = "Please do not refresh the Page. !!!!!!";
var customElement   = $("<div>", 
{
    id      : "countdown",
    css     : {
        "font-size" : "20px",
        "color"    : "red",
	 "margin-top"    : "200px",

    },
    text    : customtext
});

$.LoadingOverlay("show", {
    image   : "<?php echo base_url();?>/loading.gif",
    custom  : customElement

});


 

var interval = setInterval(function(){

    customElement.text(customtext);
    if (customtext) { 
        clearInterval(interval);
	$.LoadingOverlay("hide");
         window.location = "<?php echo base_url();?>campaign/viewcampaigns.html";
        return;
         
    }
	
}, <?php echo $end; ?>);
    
        </script>
 


			<?php

			 } ?>

<script>    
$(document).ready(function() { 
 	$('form#single_sms_form').submit(function() {
 
	  	$(this).find(":input[type='submit']").hide(); 
	});




});     
</script>  



<script>
function calculateSMSLength() {
	var smsText = $('#sms_text').val();
	$.ajax({
		url:"<?php echo base_url();?>campaign/calculateSMSLength",
		type:'post',
		data: {'smsText':smsText},
		success:function(data) {
			//console.log(data);
			var result = $.parseJSON(data);
			$('#count_message').html(result.characters);
			    $('#hwmnysms').html(result.slength);
		}

	});
} 

</script>
  
<script type="text/javascript">
$(document).ready(function () {
 $("#to_mobileno").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 17, 86, 67, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode == 65 && ( e.ctrlKey === true || e.metaKey === true ) ) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
</script>
<script type='text/javascript'>
     $(document).ready(function() {
 $('.additional-info-wrap input[type=checkbox]').click(function() {         if($(this).is(':checked')) {             $(this).closest('.additional-info-wrap').find('.additional-info').removeClass('hide').find('input,select').removeAttr('disabled');         }         else {             $(this).closest('.additional-info-wrap').find('.additional-info').addClass('hide').find('input,select').val('').attr('disabled','disabled');         }     }); 
     });
  </script>      

    <!-- text box text count code-->
	<script>
    $(document).ready(function() {
    $(".scheduler_time01").datetimepicker({
	dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        minDate: new Date()
	}
	);
  });
  </script>

    <!-- contacts only javascript-->
    <script type="text/javascript">
	
			$(document).ready(function(){
			


			$('.menu a').click(function(e)
			{
				console.log(e);
			 hideContentDivs();
			 var tmp_div = $(this).parent().index();
			
			 $('.main div').eq(tmp_div).show();
			 
			 
		
			 
			 
		  });
			
		function hideContentDivs(){
			$('.main div').each(function(){
			$(this).hide();});
		}
		hideContentDivs();
		  });

    

		$(function() {
			$('[data-toggle="confirmation"]').confirmation();
			$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
			$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });
		})

	
   </script> 
   


 
   <script type='text/javascript'>
        
 $(document).ready(function() {
var text_max = 0;
$('#count_message').html(text_max + '');
$('#sms_text').keyup(function() {
  var text_length = $('#sms_text').val().length;
  var text_remaining = text_max + text_length;
 
    if(text_remaining>160)
		{
			persms = Math.ceil(text_remaining/153);
		}else
		{
			persms = Math.ceil(text_remaining/160);
		}
  $('#count_message').html(text_remaining + '');
    $('#hwmnysms').html(persms+ '');
});
 
 
	$('#remove_duplictes').click(function() {
		
		if ($('#remove_duplictes').is(':checked') == true) {
			/*var to_mobileno = $("textarea#to_mobileno").val();
if(to_mobileno == '') {

			}else{  
			var to_mobileno = to_mobileno.split('\n'); 
			var unique = to_mobileno.filter(function(itm, i, to_mobileno) {
  			  	return i == to_mobileno.indexOf(itm);
			});

		        alert(unique.length + " Unique Numbers out of " + to_mobileno.length);
			var callback_data = unique.join("\n");

 
		        $('textarea#to_mobileno').val(callback_data);
} */

				removeDuplicates();
			 
		}
		 
	});
	
$('#recenttemp').click(function() {

if($('#recenttemp').val()!= "") {  
var colum = $('#recenttemp').val();

var text = $('textarea#sms_text').val();
var s =	$('#sms_text').val(text+colum);



}
});
					 
	 
	$('#numbers_count').click(function() {
		
		if ($('#numbers_count').is(':checked') == true) {


			/*var to_mobileno = $("textarea#to_mobileno").val();
if(to_mobileno == '') {

			}else{
			var to_mobileno = to_mobileno.split('\n'); 
			var unique = to_mobileno.filter(function(itm, i, to_mobileno) {
  			  	return i == to_mobileno.indexOf(itm);
			});

		        alert(unique.length + " Unique Numbers out of " + to_mobileno.length);
}
*/
				removeDuplicates();

		}
		 
	});
	

        });
        
        </script>

		
<script>	
/*$('textarea#to_mobileno').keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
    removeDuplicates();
  }
}); */

        </script> 

<script>
function removeDuplicates() { 
 		$('#uniqueNumCount').text('');
		var to_mobileno = $("textarea#to_mobileno").val();
		if(to_mobileno == '') {

		}else{
			var to_mobileno = to_mobileno.split('\n'); 
			var unique = to_mobileno.filter(function(itm, i, to_mobileno) {
  			  	return i == to_mobileno.indexOf(itm);
			});
 
			$('#uniqueNumCount').text(unique.length + " Unique Numbers out of " + to_mobileno.length);
			var callback_data = unique.join("\n");

   
			$('textarea#to_mobileno').val(callback_data);
		}
  
	}   
</script>	
<script type='text/javascript'>	

 $(document).ready(function() {			
		$('#myDelet').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
})

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#myDelet').data('id', id).modal('show');
});

$('#btnYes').click(function() {
    // handle deletion here
  	var id = $('#myDelet').data('id');
  	$('[data-id='+id+']').remove();
  	$('#myDelet').modal('hide');
});
  }); 	

</script>


<!-- conformation-->

    <script>
		$(function() {
			$('[data-toggle="confirmation"]').confirmation();
			$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
			$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });
		})
	</script>

 <script>
$(document).click("click", function(e) {
	if ((e.target.value != undefined) && (e.target.id == "checkit")) 
		{ 
			if((e.target.id != "if") && (e.target.id != "while")) {
				console.log('krishna');
				$('#sms_text').val($('#sms_text').val() + e.target.value+'\n');
				
var text_max = 0;
$('#count_message').html(text_max + '');

  var text_length = $('#sms_text').val().length;
  var text_remaining = text_max + text_length;
 
    if(text_remaining>160)
		{
			persms = Math.ceil(text_remaining/153);
		}else
		{
			persms = Math.ceil(text_remaining/160);
		}
  $('#count_message').html(text_remaining + '');
    $('#hwmnysms').html(persms+ '');
	
	
		}	else
$('#sms_text').val($('#sms_text').val() + e.target.value+'\n');		
	}
});


</script>

<?php if($user_id == 5813) { $maxLength = 20;} else { $maxLength = 10; }; ?>
 <script>
var maxLength = "<?php echo $maxLength;?>";    
$('#to_mobileno').on('input focus keydown keyup', function() {
    var text = $(this).val();
    var lines = text.split(/(\r\n|\n|\r)/gm); 
    for (var i = 0; i < lines.length; i++) {
        if (lines[i].length > maxLength) {
            lines[i] = lines[i].substring(0, maxLength);
        }
    }
    $(this).val(lines.join(''));
});

/*
	$(document).ready(function(){
      $('#sms_text').bind("cut copy paste",function(e) {
		  alert('Dont cut copy paste');
          e.preventDefault();
      });
    });*/
</script>
<SCRIPT LANGUAGE="JavaScript">

function CheckAll(chk)  
{
for (i = 0; i < chk.length; i++)
	chk[i].checked = true ;  
}

function UnCheckAll(chk)
{

for (i = 0; i < chk.length; i++)
	chk[i].checked = false ;
}

</script>

<script type="text/javascript">
        function isInteger(s)
        {
        var i;s = s.toString();
        for (i = 0; i < s.length; i++)
        {
        var c = s.charAt(i);
        if (isNaN(c))
        {
        alert("Given value is not a number");return false;
        }
        }return true;
        }
        </script>
        
        
        
        
        
         <!--  ===============================group details javascript===================================================== -->
  
   
     <!-- group details javascript-->
   
  <!-- contacts only javascript-->
    <script type="text/javascript">
	
			$(document).ready(function(){
			


			$('.menu a').click(function(e)
			{
				console.log(e);
			 hideContentDivs();
			 var tmp_div = $(this).parent().index();
			
			 $('.main div').eq(tmp_div).show();
			 
			 
		
			 
			 
		  });
			
		function hideContentDivs(){
			$('.main div').each(function(){
			$(this).hide();});
		}
		hideContentDivs();
		  });

    

		$(function() {
			$('[data-toggle="confirmation"]').confirmation();
			$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
			$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });
		})

	
function DoAction(id,uid)
{
	
    $.ajax({
         type: "POST",
         url: "<?php echo base_url(); ?>campaign/contact_list_ajax2",
		  dataType: "html",
         data: {id:id,uid:uid},
		 
		         success: function(data){
                  //   alert( "Data Saved: " + msg );
				      $('#ajax-content-container').html(data);

                  }
				  
    });
}


function DoActionGroup(id,uid)
{
	
    $.ajax({
         type: "POST",
         url: "<?php echo base_url(); ?>contacts/group_view_details",
		  dataType: "html",
         data: {id:id,uid:uid},
		 
		         success: function(data){
                  //   alert( "Data Saved: " + msg );
				      $('#ajaxgroup-content-container').html(data);

                  }
				  
    });
}


function DoActionContact(id,cid)
{
	
    $.ajax({
         type: "POST",
         url: "<?php echo base_url(); ?>contact_view.php",
		  dataType: "html",
         data: {id:id,cid:cid},
		 
		         success: function(data){
                  
				      $('#ajaxcontact-content-container').html(data);

                  }
				  
    });
}


   </script> 
   
   
   
   <!-- test group details javascript-->
   
    <script type="text/javascript">
	$('#menu-2 a').click(function(e){
     hideContentDivs();
     var tmp_div = $(this).parent().index();
     $('.main-2 div').eq(tmp_div).show();
  });

function hideContentDivs(){
    $('.main-2 div').each(function(){
    $(this).hide();});
}
hideContentDivs();
   </script>  
   
   
  <!-- contact details javascript-->
   
   
  <script type="text/javascript">
   $(document).ready(function(){
	   

	$('#kk-1 a').click(function(e){
     hideContentDivs();
     var tmp_div = $(this).parent().index();
     $('.mm-1 div').eq(tmp_div).show();
  });

function hideContentDivs(){
    $('.mm-1 div').each(function(){
    $(this).hide();});
}
hideContentDivs();
});
   </script> 

  <script type="text/javascript">
function DoAction(id)
{
	var group_ids=document.getElementsByName('group_ids[]');
	
	var group_ids_array=new Array();
	for(i=0,j=0; i<group_ids.length; i++)
	{
		if(group_ids[i].checked)
		{
			group_ids_array[j]=group_ids[i].value;
			j++;
	   }
    }
       group_ids=group_ids_array.join();
	//alert(group_ids);
		var xmlhttp;
		if (window.XMLHttpRequest)
		{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
		}  
		else
		{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
		{ 
			//alert(xmlhttp.readyState);
 
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
 
			
		document.getElementById("contact_list").innerHTML=xmlhttp.responseText;
		}
				document.getElementById("contact_list").innerHTML=xmlhttp.responseText;

		}
		

		xmlhttp.open("POST","<?php echo base_url(); ?>campaign/contact_list_ajax2?group_ids="+group_ids,true);
		xmlhttp.send();
}
</script>
     
      
 <script type="text/javascript">

    $(document).click(function(e){
		$('#checkall').on('click',function(){
        if(this.checked){
            $('.check_all input').each(function(){
                this.checked = true;
            });
        }else{
             $('.check_all input').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.check_all input').on('click',function(){
        if($('.check_all input:checked').length == $('.check_all input').length){
            $('#checkall').prop('checked',true);
        }else{
            $('#checkall').prop('checked',false);
        }
    });
	
	
	// 3
	$('.group_select').on('click',function(){
        if(this.checked){
            $('.grp_check input').each(function(){
                this.checked = true;
            });
        }else{
             $('.grp_check input').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.grp_check input').on('click',function(){
        if($('.grp_check input:checked').length == $('.grp_check input').length){
            $('.group_select').prop('checked',true);
        }else{
            $('.group_select').prop('checked',false);
        }
    });
	
	// data insert
	  
	var checkboxes = $("#sectionC input[type='checkbox']");

checkboxes.on('change', function() {
    $('.append_data .form-control').val(
        checkboxes.filter('.checkboxstyle:checked').map(function(item) {
            return this.value;
        }).get().join('\n')
     );
}); 
  
    
});
   </script>   

 
   
   <?php
//ADDED ON 2017-01-23
   
  

  $api_url= $UrlGenIp;
//$api_url= 'http://ion.bz';  

//$api_url= 'http://10.10.10.199/shorturl/';

?>
 <script>
 
 
 /* ADDED ON 2017-02-2
 
$(document).click("click", function(e) {
	if ((e.target.id == "checkit2")) 
		{ 
 
 		if((e.target.id != "if") && (e.target.id != "while")) {

				if ($(".short_input").val().match(/http:\/\//) || $(".short_input").val().match(/https?:\/\//) || $(".short_input").val().match(/www./)) {

  var txt = $.trim($(".short_input").val());
   var box = $("#sms_text");



   $.ajax({
	url: '<?php echo $api_url?>/api.php',
	type: 'POST',
      	data: {
         	get_shorturl: 'success',user_url: txt,user_id:'<?php echo $user_id ?>'
      	},
	dataType: "JSON",
	success: function(data) {
									

//box.val(box.val() + "http://ion.bz/"+data+'\n');
box.val(box.val() + '<?php echo $api_url?>'+data+'\n');


$("#shorturltext").val('<?php echo $api_url?>'+data+'\n');

var text_max = 0;
$('#count_message').html(text_max + '');  

  var text_length = $('#sms_text').val().length;
  var text_remaining = text_max + text_length;
 
    if(text_remaining>160)
		{
			persms = Math.ceil(text_remaining/153);
		}else
		{
			persms = Math.ceil(text_remaining/160);
		}
  $('#count_message').html(text_remaining + '');
    $('#hwmnysms').html(persms+ '');
	},
	error: function(){

	console.log('i am here');
               alert("error");
        }
   });
		}
		else
		{
			
	 alert("Invalid URL");
		}		

	
	
		}	
		
	}
});


*/


 
 
$(document).click("click", function(e) {
	
	if ((e.target.id == "checkit2")) 
		{ 
 
 		if((e.target.id != "if") && (e.target.id != "while")) {

 
				if ($(".shorturlenter").val().match(/http:\/\//) || $(".shorturlenter").val().match(/https?:\/\//) || $(".shorturlenter").val().match(/www./)) {
				
   

  var txt = $.trim($(".shorturlenter").val());
  // Changing iframe  
 if (!txt.match(/https:\/\//)) {
        if (!txt.match(/http:\/\//)) {
 	 	txt = 'http://'+txt;  
	}  
   
      }
      
 
  $("#load_frame").attr("src",txt); 
 
//var urlInput = $("#shorturl_input");
  // urlInput.val(urlInput.val() + txt );
var smsContent = $('#sms_text').val();
 			 var shortText = $("#shorturl_text").val();
 
  			var SMSText = smsContent.replace(shortText, '');
  			$('#sms_text').val($.trim(SMSText));
   $("#shorturl_input").val('');
  $("#shorturl_input").val(txt);

   $.ajax({
	url: "<?php echo base_url();?>campaign/getShortCodeView",
	type: 'POST',
      	data: { user_url: txt },
	dataType: "JSON",
	success: function(data) {
					  				
 

$("#checkshorturl").val('<?php echo $api_url?>'+data+'\n');


//var urltext = $("#shorturl_text");
  // urltext.val(urltext.val() + '<?php echo $api_url?>'+data+'\n' );
$("#shorturl_text").val('');
   $("#shorturl_text").val('<?php echo $api_url?>'+data);
	},
	error: function(){

 
              // alert("error");
        }
   });
		}
		else
		{
			
	 alert("Please Enter Your Url");
		}		

	
	
		}	
		
	}
});




</script>



<script>
$(document).ready(function() {
    $(".addtemptabs a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("currenttemptab");
        $(this).parent().siblings().removeClass("currenttemptab");
        var tab = $(this).attr("href");
        $(".tempadmintab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
	 $(".addshorttabs a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("currentshorttab");
        $(this).parent().siblings().removeClass("currentshorttab");
        var tab = $(this).attr("href");
        $(".shortadmintab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
	 $(".addmisstabs a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("currentmisstab");
        $(this).parent().siblings().removeClass("currentmisstab");
        var tab = $(this).attr("href");
        $(".missadmintab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
	$(".chartcredit_three a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("creditcurrent");
        $(this).parent().siblings().removeClass("creditcurrent");
        var tab = $(this).attr("href");
        $(".crdttab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
});
</script>
 <script>
$(document).ready(function(){
	var taVal;
  var taArr;
	$('.recent_temp li input').on('click', function(){
  	
  	$('#sms_text').val($('#sms_text').val()+' '+$(this).val());
  	
  	 calculateSMSLength();
	/*var text_max = 0;
$('#count_message').html(text_max + '');

  var text_length = $('#sms_text').val().length;
  var text_remaining = text_max + text_length;
 
    if(text_remaining>160)
		{
			persms = Math.ceil(text_remaining/153);
		}else
		{
			persms = Math.ceil(text_remaining/160);
		}
  $('#count_message').html(text_remaining + '');
    $('#hwmnysms').html(persms+ '');*/
  });
  
  
  $('#sms_text').on('blur', function(){
  	taVal=	$('#sms_text').val();
  })
  
  $('#mc_nos').on('change', function(){
  	taVal=	$('#sms_text').val(); // store textara text in a variable
     taArr=taVal.split(" "); // split string into words and store it as an array taArr
    	
    // traverse throug the dropdown
      $('#mc_nos option').each(function(i){
      
      // check whether the dropdown value exists in textarea text
      	if($.inArray(this.value,taArr)!=-1){
        	//if found remove it
         taArr.splice(taArr.indexOf(this.value ), 1);;
        }
      });
      
      var newtaArr="";
      $.each(taArr,function(i, value){
      	newtaArr+=value+' ';
      });
    $('#sms_text').val(newtaArr+$('#mc_nos').val());
         calculateSMSLength();
   /* var text_max = 0;
$('#count_message').html(text_max + '');

  var text_length = $('#sms_text').val().length;
  var text_remaining = text_max + text_length;
 
    if(text_remaining>160)
		{
			persms = Math.ceil(text_remaining/153);
		}else
		{
			persms = Math.ceil(text_remaining/160);
		}
  $('#count_message').html(text_remaining + '');
    $('#hwmnysms').html(persms+ ''); */
  });
});

  
</script>


<script>
 
 /**  -------------  shorturl start  --------------**/
 
 /** ADDED ON 2017-02-2 **/ 
function submit_url() {
	var smsContent = $('#sms_text').val();
	var shortText = $("#shorturl_text").val();

	var SMSText = smsContent.replace(shortText, '');
	$('#sms_text').val($.trim(SMSText)); 
	var url_input =$('#shorturl_input').val();
	var url_text = $('#shorturl_text').val();  
	if(url_input == '') {
		//alert('Shorturl is empty');
	}else{
	//alert(url_input+ ', ' +url_text);
	var box = $("#sms_text");
	box.val(box.val() + url_text +'\n');
	/*var text_max = 0;
	$('#count_message').html(text_max + '');  

	var text_length = $('#sms_text').val().length;
	var text_remaining = text_max + text_length;
  
	if(text_remaining>160)
		{
			persms = Math.ceil(text_remaining/153);
		}else
		{
			persms = Math.ceil(text_remaining/160);
		}
	$('#count_message').html(text_remaining + ''); 
	$('#hwmnysms').html(persms+ '');*/
	calculateSMSLength();
}
 
}
</script>
 

<script>
 
 
$(document).ready(function() {
	$('form#imge_validation').submit(function(e)  {
 		e.preventDefault();

var smsContent = $('#sms_text').val();
 			 var shortText = $("#shorturl_text").val();
 
  			var SMSText = smsContent.replace(shortText, '');
  			$('#sms_text').val($.trim(SMSText)); 
	var url_input =$('#shorturl_input').val();
	var url_text = $('#shorturl_text').val();   
 
	if(url_input == '') {
		//alert('Shorturl is empty');
	}else{
	var box = $("#sms_text");
	box.val(box.val() + url_text +'\n');
	/*var text_max = 0;
	$('#count_message').html(text_max + '');  

	var text_length = $('#sms_text').val().length;
	var text_remaining = text_max + text_length;
  
	if(text_remaining>160)
		{
			persms = Math.ceil(text_remaining/153);
		}else
		{
			persms = Math.ceil(text_remaining/160);
		}
	$('#count_message').html(text_remaining + ''); 
	$('#hwmnysms').html(persms+ '');*/
		 calculateSMSLength();
  $('#addshorturlmodel').modal('hide');
  
}
 
});
});
</script>
 

<script>
 
$(document).ready(function() {
	$('form#video_file_upload').submit(function(e)  {
 		e.preventDefault();

  var smsContent = $('#sms_text').val();
 			 var shortText = $("#shorturl_text").val();
 
  			var SMSText = smsContent.replace(shortText, '');
  			$('#sms_text').val($.trim(SMSText)); 
	var url_input =$('#shorturl_input').val();
	var url_text = $('#shorturl_text').val();   
 
	if(url_input == '') {  
		//alert('Shorturl is empty');
	}else{  
	var box = $("#sms_text");
	box.val(box.val() + url_text +'\n');
	/*var text_max = 0;
	$('#count_message').html(text_max + '');  

	var text_length = $('#sms_text').val().length;
	var text_remaining = text_max + text_length;
  
	if(text_remaining>160)
		{
			persms = Math.ceil(text_remaining/153);
		}else
		{
			persms = Math.ceil(text_remaining/160);
		}
	$('#count_message').html(text_remaining + ''); 
	$('#hwmnysms').html(persms+ '');
	*/
		calculateSMSLength();
  $('#addshorturlmodel').modal('hide');
}
 
});
});
</script>
 
<script>
 
 
$(document).ready(function() {
	$('form#audio_file_upload').submit(function(e)  {
 		e.preventDefault();

var smsContent = $('#sms_text').val();
 			 var shortText = $("#shorturl_text").val();
 
  			var SMSText = smsContent.replace(shortText, '');
  			$('#sms_text').val($.trim(SMSText)); 

	var url_input =$('#shorturl_input').val();
	var url_text = $('#shorturl_text').val();   
 
	if(url_input == '') {
		//alert('Shorturl is empty');
	}else{
	var box = $("#sms_text");
	box.val(box.val() + url_text +'\n');
	/*var text_max = 0;
	$('#count_message').html(text_max + '');  

	var text_length = $('#sms_text').val().length;
	var text_remaining = text_max + text_length;
  
	if(text_remaining>160)
		{
			persms = Math.ceil(text_remaining/153);
		}else
		{
			persms = Math.ceil(text_remaining/160);
		}
	$('#count_message').html(text_remaining + ''); 
	$('#hwmnysms').html(persms+ ''); */
		 calculateSMSLength();
 $('#addshorturlmodel').modal('hide');  
}
 
});
});
</script>

<script>
   
  function upload_audio() {  
//$(document).ready(function() {
	//$('form#audio_file_upload').submit(function(e) { 
 var file = $("#audio_input").prop('files')[0];
		var ext = $("#audio_input").val().split('.').pop().toLowerCase();
		var size = file.size / 1048576;
		 if($.inArray(ext, ['mp3']) == -1) {
		  	//alert('invalid extension!');
		}else if(size > 2){
			//alert("Allowed file size exceeded. (Max. 10 MB) ");
		}else{
	 var formData = new FormData(document.getElementById("audio_file_upload")); 
	 console.log(formData);
 	   $.ajax({
		url: "<?php echo base_url();?>campaign/upload_file_data",
		type: "POST",
 		enctype: 'multipart/form-data',  
    		processData: false,  // tell jQuery not to process the data
   		 contentType: false,
	      	data: formData,  
   		success: function(data) {  
			console.log(data);
			var file_location = $.trim(data);  
			if(file_location != '') {
				 var player = document.getElementById('audio_play');

				 var mp4Vid = document.getElementById('audio_frame');

				 player.pause(); 
				 // Now simply set the 'src' property of the mp4Vid variable!!!!

				  mp4Vid.src = file_location; 
				  player.load();
				  player.play();  
				var smsContent = $('#sms_text').val();
 			 var shortText = $("#shorturl_text").val();
 
  			var SMSText = smsContent.replace(shortText, '');
  			$('#sms_text').val($.trim(SMSText));
		  		// var urlInput = $("#shorturl_input");
				  //urlInput.val(urlInput.val() + file_location );
 $("#shorturl_input").val('');
				$("#shorturl_input").val(file_location);
		  		 $.ajax({
					//url: '<?php echo $api_url?>/api.php',
					url: "<?php echo base_url();?>campaign/getShortCodeView",
					type: 'POST',
				      	data: {
					 	get_shorturl: 'success',user_url: file_location,user_id:'<?php echo $user_id ?>'
				      	},
					dataType: "JSON",
					success: function(data) { 	 
						$("#short_url_audio").val('<?php echo $api_url?>'+data+'\n');
						//var urltext = $("#shorturl_text");
						 // urltext.val(urltext.val() + '<?php echo $api_url?>'+data+'\n' );
$("#shorturl_text").val('');
$("#shorturl_text").val('<?php echo $api_url?>'+data);

			
					},
					error: function(){

						//console.log('i am here');
						       //alert("error");
					}
				});
			}else{
					$('#error_audio').text('Uploaded file is not a valid MIME type.');
				}
		}
	});
	}
		//e.preventDefault(); 
	//});
//});  
}  
  
</script>  
<script>
   
function upload_video() { 
//$(document).ready(function() {
	//$('form#video_file_upload').submit(function(e) {
 var file = $("#video_input").prop('files')[0];
		var ext = $("#video_input").val().split('.').pop().toLowerCase();
		var size = file.size / 1048576;
		 if($.inArray(ext, ['mp4']) == -1) {  
		  	//alert('invalid extension!');
		}else if(size > 10){
			//alert("Allowed file size exceeded. (Max. 10 MB) ");
		}else{
	 var formData = new FormData(document.getElementById("video_file_upload")); 
 	   $.ajax({
		url: "<?php echo base_url();?>campaign/upload_file_data",
		type: "POST",
 		enctype: 'multipart/form-data',  
    		processData: false,  // tell jQuery not to process the data
   		 contentType: false,
	      	data: formData,  
   		success: function(data) {  
			var file_location = $.trim(data);  
			if(file_location != '') {
				  var player = document.getElementById('video_play');

					  var mp4Vid = document.getElementById('video_frame');

					 player.pause(); 
					 // Now simply set the 'src' property of the mp4Vid variable!!!!

					  mp4Vid.src = file_location; 
					  player.load();
					  player.play();
var smsContent = $('#sms_text').val();
 			 var shortText = $("#shorturl_text").val();
 
  			var SMSText = smsContent.replace(shortText, '');
  			$('#sms_text').val($.trim(SMSText));
			  		//var urlInput = $("#shorturl_input");
					//urlInput.val(urlInput.val() + file_location );
 $("#shorturl_input").val('');
 					$("#shorturl_input").val(file_location);
		  		 $.ajax({
					//url: '<?php echo $api_url?>/api.php',
					url: "<?php echo base_url();?>campaign/getShortCodeView",
					type: 'POST',
				      	data: {
					 	get_shorturl: 'success',user_url: file_location,user_id:'<?php echo $user_id ?>'
				      	},
					dataType: "JSON",
					success: function(data) { 	 
						$("#short_url_video").val('<?php echo $api_url?>'+data+'\n');
						//var urltext = $("#shorturl_text");
						 //  urltext.val(urltext.val() + '<?php echo $api_url?>'+data+'\n' );
			$("#shorturl_text").val('');
$("#shorturl_text").val('<?php echo $api_url?>'+data);

					},
					error: function(){

						//console.log('i am here');
						       //alert("error");
					}
				});
			}else{
					$('#error_video').text('Uploaded file is not a valid MIME type.');
				}
		}
	});
	 }  
		//e.preventDefault();
	//});
//});
}

</script>
 



<script>
 /** ADDED ON 2017-02-2 **/ 
function upload_image() {    
   //var file = $("#image_input").prop('files')[0]['name'];
   	var file = $("#image_input").prop('files')[0]; 
	var ext = $("#image_input").val().split('.').pop().toLowerCase();
	var size = file.size / 1048576; 
	if($.inArray(ext, ['jpg','png']) == -1) {
		//alert('invalid extension!');
	}else if(size > 1) {
		 //alert("Allowed file size exceeded. (Max. 2 MB) ");
	}else{
	       var reader = new FileReader(); // instance of the FileReader
	      reader.readAsDataURL(file);
	      reader.onloadend = function(){ // set image data as background of div 
          	$.ajax({  
          	url:"<?php echo base_url();?>campaign/upload_encoded_image",
          	type:"POST",
          	data:{'image_data' : this.result },
          	success:function(data) {
          		var file_location = $.trim(data);
          		//$('#encoded_data').val(file_location); 
          		$("#load_frame1").attr("src", file_location);  
 			var smsContent = $('#sms_text').val();
 			 var shortText = $("#shorturl_text").val();
 
  			var SMSText = smsContent.replace(shortText, '');
  			$('#sms_text').val($.trim(SMSText));  
 $("#shorturl_input").val('');
          		//var urlInput = $("#shorturl_input");
			//urlInput.val(urlInput.val() + file_location );  
 $("#shorturl_input").val(file_location);  
          		  $.ajax({
				//url: '<?php echo $api_url?>/api.php',
				url: "<?php echo base_url();?>campaign/getShortCodeView",
				type: 'POST',  
			      	data: {
				 	get_shorturl: 'success',user_url:file_location,user_id:'<?php echo $user_id ?>'
			      	},
				dataType: "JSON",
				success: function(data) { 	 
					$("#short_url_image").val('<?php echo $api_url?>'+data+'\n');
					//var urltext = $("#shorturl_text");
					 //  urltext.val(urltext.val() + '<?php echo $api_url?>'+data+'\n' );
 $("#shorturl_text").val('');
			 $("#shorturl_text").val('<?php echo $api_url?>'+data);
			
				}, 
				error: function(){
  
					//console.log('i am here');
					      // alert("error");
				}
			});
          	}
          });	
   
	}
          
      }     
}   

 /**  -------------  shorturl end  --------------**/
</script>

<script>

/** ---------  Template start --------  **/

/** 
  * ADDED ON 2017-02-3
  * Create template     
  */  

function CreateTemplate() {
	var template = $("#template").val();
	var template_name = $('#template_name').val();
	var templateId = $('#templateId').val();
 	$('#template_status').text('');
	var alphanumers = "/^[a-zA-Z0-9]+$/";
	 
	 	if(template_name == '' || template == '') {
			$('#template_status').append('<div class="alert a" style="background:#dff0d8 !important;color:#3c763d !important; border: 0px;">  <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">×</a>Please enter valid Template and Template Name.</div>'); 
		}else{ 
			 $.ajax({
				url:"<?php echo base_url();?>campaign/templates",  
				type:"post",
				data:{'template':template,'template_name':template_name,'templateId':templateId},
				success:function(data) { 
					$('#template_status').text('');
					$('#template_name').val('');
					$('#template').val('');		
					$('#templateId').val('');
					if(data == 1) {
		 				$('#template_status').append('<div class="alert a  " style="background:#dff0d8 !important;color:#3c763d !important; border: 0px;">  <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">×</a> Template has been Added </div>'); 
		 			
		 			}else if(data == 2) {
		 				$('#template_status').append('<div class="alert a  " style="background:#dff0d8 !important;color:#3c763d !important; border: 0px;">  <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">×</a> Template has been Updated </div>'); 
		 			
		 			}else if(data == 3) {
		 				$('#template_status').append('<div class="alert a  " style="background:#dff0d8 !important;color:#3c763d !important; border: 0px;">  <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">×</a> Template name aleady added, Please choose another Name</div>'); 
		 			  
		 			}else if(data == 4) {
		 				$('#template_status').append('<div class="alert a  " style="background:#dff0d8 !important;color:#3c763d !important; border: 0px;">  <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">×</a> Template Name should be less than 15 characters</div>'); 
		 			
		 			}else{
		 				$('#template_status').append('<div class="alert a  " style="background:#dff0d8 !important;color:#3c763d !important; border: 0px;">  <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">×</a> Template Not Added</div>'); 
		 			
		 			}
		 			getTemplatesInfo(); 
				}
			}); 
		} 
	
}
  
 
/**
  * ADDED ON 2017-02-3
  * Count template content characters
  */ 
   
function countCharacters() {   
	/*var text_max = 0; 
	var text_length = $('#template').val().length;
	var text_remaining = text_max + text_length;
	//console.log(text_length);
	if(text_remaining>160)
	{
		persms = Math.ceil(text_remaining/153);
	}else
	{
		persms = Math.ceil(text_remaining/160);
	}
	$('#count_message1').html(text_remaining + '');
	$('#hwmnysms1').html(persms+ '');*/
	
	var smsText = $('#template').val();
	$.ajax({
		url:"<?php echo base_url();?>campaign/calculateSMSLength",
		type:'post',
		data: {'smsText':smsText},
		success:function(data) {
 
			var result = $.parseJSON(data);
			$('#count_message1').html(result.characters);
			    $('#hwmnysms1').html(result.slength);
		}

	});
 
}


</script>

<script>


/** ADDED ON 2017-02-3 
  * Get templates
  **/ 
function getTemplatesInfo() {
 
	$.ajax({
		url:"<?php echo base_url();?>campaign/getTemplates",
		type:"post", 
		success:function(data) {
			$('#temp_info').text('');  
			 $('#temp_info').append(data);  
			
			 
		}    
	});

}; 
</script>
  

<script>

/**
  * ADDED ON 2017-02-3
  * Select campaign template content
  */
function campaignTemplateContent(campaign_id) { 	
 	  $.ajax({
		url:"<?php echo base_url();?>campaign/getSelectedCampaignTemplateContent",
		type:"post", 
		data:{'campaign_id':campaign_id},
		success:function(res) {  
 			 var result = $.parseJSON(res);
 			 
 			  var box = $("#sms_text");  
			  box.val(box.val() + result[0].sms_text +'\n'); 
 	calculateSMSLength();  
 		}  
 	});	 
}

</script>  

<!--
<script>

/** 
  * ADDED ON 2017-02-3
  * Select template content
  */
function selectTemplateContent(template_id) { 
	
 	  $.ajax({
		url:"<?php echo base_url();?>campaign/getSelectedTemplateContent",
		type:"post", 
		data:{'template_id':template_id},
		success:function(res) {  
 			 var result = $.parseJSON(res);
 			  var box = $("#sms_text");
			  box.val(box.val() + result[0].template +'\n'); 	
 
 		}
 	});	 
}

</script> 
 -->


<!--
<script>

/**
  * ADDED ON 2017-02-3
  * Select template content 
  */
function editTemplateContent(template_id) { 
	event.preventDefault();
	 $('#template').text();
 	  $.ajax({
		url:"<?php echo base_url();?>campaign/getSelectedTemplateContent",
		type:"post", 
		data:{'template_id':template_id},
		success:function(res) {  
 			 var result = $.parseJSON(res); 
 
 			 $('#template').val(result[0].template);
 			 $("#template_name").val(result[0].template_name);
 			 $('#templateId').val(result[0].template_id); 
 			 countCharacters();
 		}
 	});	 
}  

</script>  

-->
 

<script> 


/** ADDED ON 2017-02-3 
  * Get recent templates by From & To dates
  **/ 
function getRecentTemplates() {
	var to_date = $('#to_date').val();
	var from_date = $('#from_date').val();
	//var template_name = $('#templateNames').val();
	//  console.log(from_date);
	 $.ajax({
		url:"<?php echo base_url();?>campaign/getRecentTemplates",
		type:"post", 
		//data:{'to_date':to_date,'from_date':from_date,'template_name':template_name},
		data:{'to_date':to_date,'from_date':from_date },
		success:function(data) { 
			 $('.recenttemplatesData').text(''); 
 			var templates = $.parseJSON(data);  
 			var tbody = '';      
			var count = 0;          
			$.each(templates, function (i, item) {	
				count +=1;		    
			    tbody += '<tr><td>' + count + '</td><td>' +item.created_on + '</td><td>' +item.sms_text + '</td><td><button data-dismiss="modal" class="btn btn-sm btn-default" onClick="campaignTemplateContent('+item.campaign_id+');">select</button> </td> </tr>'; 
  
			});  
	       
			$('.recenttemplatesData').append(tbody);   

			 
		}    
	});

}

/** ----------  Template end ------- **/

</script>



  
<script>
/** Groups **/
function getGroupData(groupId) {
 	$.ajax({
		url:"<?php echo base_url();?>contacts/getGroupDetails",
		type:"post",
		data:{'group_id':groupId},
		success:function(data) {  
			var response = $.parseJSON(data);
  			$('#group_name').text(response[0].group_name);
			$('#created_date').text(response[0].created_on);
			$('#group_count').text(response[0].count);
		}
		
	});
}

</script>  

<script>
function getGroupContacts(groupId,contactId) {  
 	$.ajax({
		url:"<?php echo base_url();?>contacts/getGroupDetails",
		type:"post",
		data:{'group_id':groupId,'contact_id':contactId},
		success:function(data) {
		 	 var response = $.parseJSON(data);
			 $('#group_con_name').text(response[0].name);
			 $('#group_con_num').text(response[0].mobile_no);
			 $('#group_con_gen').text(response[0].gender);
 			 $('#group_con_dob').text(response[0].dob);
			 $('#group_con_addr').text(response[0].address);
			 $('#group_con_joinDate').text(response[0].join_date);
 			 $('#group_con_relDate').text(response[0].relieve_date); 
		}
		
	});
  
}



</script>



<script>

 
function getuserfile() { 
 
 	var file = $("#userfile").prop('files')[0];
 	var ext = $("#userfile").val().split('.').pop().toLowerCase();
 	var size = file.size / 1048576;  
 	if(size > 20){
		//alert("Allowed file size exceeded. (Max. 20 MB) ");
	}else if($.inArray(ext, ['xls','xlsx']) == -1) {
	  	//alert('invalid extension!');  
	
	}else{    

	   	$('#uploaded_img').text(file.name);  
	 }

	 
} 
</script>


<script>
function getCheckedMobileno() {
	$("#to_mobileno").val('');
 	var mobile_nums = $("#to_mobileno"); 
 
        $('.gr_check_data li :checked').each(function(i){
 
		mobile_nums.val(mobile_nums.val() + $(this).val()+'\n');
        });  
 
 
 
}



/** Groups **/
</script>

 



 <!-- SMS Model Start -->
  <div class="modal fade" id="addtemplatemodel" role="dialog">
    <div class="modal-dialog template_modal_div">
    
      <!-- Modal content-->
      <div class="modal-content col-md-12 col-sm-12 col-xs-12 padding_zero">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        </div>
        <div class="modal-body col-md-12 col-sm-12 col-xs-12">
         <ul class="addtemptabs">  
         
          <!-- Updated ON 2017-02-4 -->
        <li class="currenttemptab"><a href="#template-model" onClick ="getTemplatesInfo();">Template</a></li>
        <li><a href="#recentemplate-model" onClick ="getRecentTemplates();">Recent Template</a></li>
       
        
    </ul>
	<div class="smsadmintabdiv">
	 <div id="template-model" class="tempadmintab-content">
 <!-- Updated ON 2017-02-4 -->
	<form class="missedcall_allform" method="post"  >
	
	     <!-- Updated ON 2017-02-4 -->
		<div class="col-sm-12 col-md-12 col-xs-12 padding_zero" id="template_status">
        	<!-- Template Status content -->
		 
		</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
         	
						<span class="form_lable">Template Name</span> 
						 </div>
						  <div class="col-md-7 col-sm-8 col-xs-12 padding_mzero">
						  <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
						  
						   <!-- Updated ON 2017-02-4 -->
						   <input type="hidden"  name="templateId" id="templateId" >
						  <input type="text" class="valuetemptxt" name="template_name" id="template_name" placeholder="Template Name">
						
						 </div>
						 
						  </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
 <div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
						<span class="form_lable">SMS Content</span> 
						 </div>
						  <div class="col-md-7 col-sm-8 padding_mzero col-xs-12">
						  <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
						  
						   <!-- Updated ON 2017-02-4 -->
						  <textarea class="valuetemparea" name="template" onkeyup="countCharacters();" id="template" placeholder="Type here"></textarea>
						  
						 </div>
						 
						  </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-7 col-sm-8 col-md-offset-3 col-sm-offset-3 padding_mzero col-xs-12">
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
						  <div class="col-md-6 col-sm-6 col-xs-6 tempnumod padding_zero">
						  
						   <!-- Updated ON 2017-02-4 -->
						 <span id="count_message1" class="count_num">0</span><span class="count_txt07">Number Of Characters</span>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-6 tempnumod txt_alignrt padding_zero">
						
						 <!-- Updated ON 2017-02-4 -->
						  <span id="hwmnysms1" class="count_num">0</span><span class="count_txt07">Number Of SMS</span>
						</div>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
						<!-- <input type="button" name="" class="temp-append-btn create-btn" data-dismiss="modal" value="Create" onClick="CreateTemplate();"> -->
						 
						  <!-- Updated ON 2017-02-4 -->
						  <input type="button" name="" class="temp-append-btn submit_btn"   value="Save" onClick="CreateTemplate();">
						</div>
						</div>
						</div>
</form>
<div class="col-md-12 col-sm-12 form-div col-xs-12">
	<div class="row">
		<div class="col-md-12 col-sm-12 form-div col-xs-12 padding_mzero" id="temp_info">
		 
			
 
 
			
		</div>
	</div> 
	
	
</div>
</div>
 
</div>
 <div id="recentemplate-model"  class="tempadmintab-content" style="display:none">
  <div class="col-md-12 col-sm-12 mrgbtom55 col-xs-12 missedcall_allform padding_zero"  >
  <ul class="search-list05 missedcall_allform">
<li>
<input type="text" id="from_date" name="" placeholder="<?php echo date('Y-m-d');?>" class="data-pickerbg">
</li>
<li>
<input type="text" id="to_date" name="" placeholder="<?php echo date('Y-m-d');?>" class="data-pickerbg">
</li>
<li>
<input type="submit" class="submit_btn" value="Search" onClick="getRecentTemplates();">
</li>
</ul>

  <!--  <div class="col-md-4 col-sm-4 col-xs-12">
  Updated ON 2017-02-4 
	<select id="templateNames">
	 </select> 
	 </div>-->

  
  </div>
 <div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
 <div class="table-responsive">
<table class="table_all">
	<thead>
	<tr><th>S.No</th><th>Date</th><th>Template</th><th>Action</th></tr>
	</thead>
	 <!-- Updated ON 2017-02-4 -->
	<tbody class="recenttemplatesData">
	 
	</tbody>
</table>
 </div>
 </div>
  </div>
</div>
        </div>
        
      </div>
      
    </div>
  </div>
  <!-- Model End -->
  
  <!-- short url Model Start -->
  <div class="modal fade" id="addshorturlmodel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content col-md-12 col-sm-12 col-xs-12 padding_zero">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body col-md-12 col-sm-12 col-xs-12">
<div class="col-md-12 col-sm-12 col-xs-12"> 
 <ul class="addshorttabs">
 
  <!-- Updated ON 2017-02-4 -->
        <li class="currentshorttab"><a href="#shorturltb">Web Short URL</a></li>
        <li><a href="#shorturlimgeurltb">Image Short URL</a></li>
       <li><a href="#shorturlvideo">Video Short URL</a></li>
        <li><a href="#shorturlaudio">Audio Short URL</a></li>
    </ul>  
    <div class="smsadmintabdiv">
        <div id="shorturltb" class="shortadmintab-content">
		<form class="col-md-12 col-sm-12 col-xs-12 padding_zero" id="shorturl_valid_modl" method="post">
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
         <input type="text" name="shorturlenter" placeholder="www.example.com" class="shorturlenter"> <input type="button" id="checkit2"   class="gobtn" value="Go">
        </div>
		<div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		<label class="shorlurl-lable">Short URL</label>
		</div>
		 <!-- Updated ON 2017-02-4 -->
		 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">  
		  <div class="col-md-6 col-sm-6 col-xs-12 form-div padding_ltzero">
         <input type="text" name="checkshorturl" id="checkshorturl" readonly placeholder="Your Short URL" value="" class="shorturl-txt">
		 </div>
		 <div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
		 <input type="submit"  onClick="submit_url();"  class="submit_btn" data-dismiss="modal" value="Submit">
		 </div>
		 </div>
        </div>
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
         <div class="col-md-2 col-sm-2 col-xs-12 padding_zero"><label class="priviewurl-lable">Preview</label></div>
		 <div class="col-md-10 col-sm-10 col-xs-12 padding_zero">
		 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
			<iframe class="iframe-shorturl" id="load_frame" src="https://www.smsstriker.com/"></iframe>

     
		 <img src="<?php echo base_url();?>images/short-url-mobile.png" alt="short url preview" class="img-responsive">
		  <!-- Updated ON 2017-02-4 -->
		 
		 </div>
		 </div>
		 
        </div>
		</form>
		</div>
        <div id="shorturlimgeurltb" class="shortadmintab-content" style="display:none;">
		<form id="imge_validation" class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
      <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
	  <div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
         <span class="select-yourimage">Select Your Image</span>  
		 </div>
		 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
		 
<div class="fileUpload btn submit_btn">  
    <span>Upload</span>
    <input id="image_input" name="image_input" type="file" class="upload" onChange="upload_image();"  />
</div>
		 </div>
		 <div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
				 <ul class="note-list02">
<li>Upload only jpg,png filetypes and size must be less than 1MB.</li>
</ul>
 </div>
        </div>
		<div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
		<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
		<label class="shorlurl-lable">Short image URL</label>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
		<div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
         <input type="text" id="short_url_image" name="short_url_image" readonly placeholder="Your Short URL" class="flinp-width shorturl-txt">
		 </div>
		 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		 <input type="submit" id="submit_url_image"  class="submit_btn" value="Submit">
		</div>
		</div>
		
		
        </div>
		</form>
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
         <div class="col-md-2 col-sm-2 col-xs-12 padding_zero"><label class="priviewurl-lable">Preview</label></div>
		 <div class="col-md-10 col-sm-10 col-xs-12 padding_zero">
		 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		 
		 <img src="<?php echo base_url();?>images/short-url-img-mob.png" id="load_frame1" alt="short url preview" class="mob-inner-shortimg img-responsive"> 
		 <img src="<?php echo base_url();?>images/short-url-mobile.png" alt="short url preview" class="img-responsive">
		   <!-- Updated ON 2017-02-4 -->
		 
		 </div>
		 </div>
		 
        </div>    
        
        </div>
		<div id="shorturlvideo" class="shortadmintab-content" style="display:none;">
 			 <form id="video_file_upload" name="video_file_upload" method="post" enctype="multipart/form-data" action="#" >   
	     			
 <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
				 	<input type="hidden" name="filetype" value="video"/>
 <p class="errortxt" id="error_video"> </p>  
			  		<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
					 <span class="select-yourimage">Select Your Video</span>
				 	</div>
					 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
				 
					<div class="fileUpload btn submit_btn">
					    <span>Upload</span>
					    <input id="video_input" name="file_input" onChange="upload_video();"  type="file" class="upload" />
					</div>
					 </div>
					 <div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
				 <ul class="note-list02">
<li>Upload only MP4 filetypes and size must be less than 10MB.</li>
</ul>
 </div>
				  </div>
				  <div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
				  
		<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
		<label class="shorlurl-lable">Short Video URL</label>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
                <input type="text" id="short_url_video" name="short_url_video" placeholder="Your Short URL" readonly class="shorturl-txt flinp-width">
				</div>
				<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		 <input type="submit"  id="submit_url_video" class="submit_btn" value="Submit">
		</div>
		</div>
		
		  
        </div>
			 </form>  
       		
 
		
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
         <div class="col-md-2 col-sm-2 col-xs-12 padding_zero"><label class="priviewurl-lable">Preview</label></div>
		 <div class="col-md-10 col-sm-10 col-xs-12 padding_zero">
		 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		 
		 <video width="100%" height="240"  id="video_play" controls> 

			  <source src="<?php echo base_url();?>vjc.mp4" type="video/mp4" id="video_frame"  > 
 
		</video>
		 

		 </div>  
		 </div>
		 
        </div>
        
        </div>
      <div id="shorturlaudio" class="shortadmintab-content" style="display:none;">
	 <form id="audio_file_upload" name="audio_file_upload" method="post" enctype="multipart/form-data" action="#">
 
     		 <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
			  <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
				 	<input type="hidden" name="filetype" value="audio"/>
 <p class="errortxt" id="error_audio"> </p>
		  <div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
		 <span class="select-yourimage">Select Your Audio</span>      
			 </div>
			 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
						 
				<div class="fileUpload btn submit_btn">
				    <span>Upload</span>
				    <input  id="audio_input" name="file_input" onChange="upload_audio();" type="file" class="upload" />
				</div>
			 </div> 
<div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
				 <ul class="note-list02">
<li>Upload only MP3 filetypes and size must be less than 2MB.</li>
</ul>
 </div>	
</div> 
			 <div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
			<div class="col-md-4 col-sm-4 col-xs-12 padding_zero">
			<label class="shorlurl-lable">Short Audio URL</label>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
		<div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
		 <input type="text" id="short_url_audio" name="short_url_audio" placeholder="Your Short URL" readonly class="flinp-width shorturl-txt">
		 </div>
		 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
			 <input type="submit" id="submit_url_audio"  class="submit_btn" value="Submit">
			</div>
			</div>
			
		
        </div>
		</div>
			 </form>
      		  
			
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
         <div class="col-md-2 col-sm-2 col-xs-12 padding_zero"><label class="priviewurl-lable">Preview</label></div>
		 <div class="col-md-10 col-sm-10 col-xs-12 padding_zero">
		 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		 
		<audio  id="audio_play" controls>
 
  <source src="<?php echo base_url();?>Audio.mp3" type="audio/mp3" id="audio_frame" >
 
</audio>
		 
		 </div>
		 </div>
		 
        </div>
        
        </div>
       
    </div>
</div>

        </div>
        
      </div>
      
    </div>
  </div>
  <!-- short url Model End -->
  <!-- SMS Model Start -->
  <div class="modal fade" id="addgroupmodel" role="dialog">
    <div class="modal-dialog template_modal_div">
    
      <!-- Modal content-->
      <div class="modal-content col-md-12 col-sm-12 padding_zero col-xs-12">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body col-md-12 col-sm-12 col-xs-12">
        
      <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
        
       <div class="col-md-12 col-sm-12 col-xs-12">
 <ul class="smsadmintabs">
        <li class="currentsmstab"><a href="#newgroup">Add New</a></li>
        <li><a href="#existinggroup">Add Existing</a></li>
       
        
    </ul>  
    <div class="smsadmintabdiv">
        <div id="newgroup" class="smsadmintab-content">
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero missedcall_allform05"  >
		<!--<form method="post"  name="add_group_form" id="addnew-group-valid" action="<?php echo base_url();?>contacts/addGroupData" enctype="multipart/form-data">-->
				<form method="post"   name="add_group_form" action="<?php echo base_url();?>contacts/addGroupData" id="addnew-group-valid" enctype="multipart/form-data">  

			<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 			<div class="col-md-2 col-sm-2 col-sm-12 padding_zero">
						<span class="form_lable">Group Name</span> 
						 </div>
						  <div class="col-md-7 col-sm-8 col-xs-12 padding_mzero">
							 <input list="groupNames" name="group_name" placeholder="Enter Group Name">
							  <datalist id="groupNames">
							    <?php foreach($groups as $group) {  ?> 
								<option value="<?php echo  $group->group_name;?>"> 
							    <?php } ?>
							  </datalist>    
      
							 </div>
			</div>
			<!--<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
			<div class="col-md-7 col-sm-7 col-md-offset-2 col-sm-offset-2 col-xs-12">
									<select><option>Select</option></select>
									 </div>
			</div> -->
			<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
			<div class="col-md-7 col-sm-8 col-md-offset-2 padding_mzero col-sm-offset-2 col-xs-12">
				<div class="col-md-6 col-sm-6 col-xs-12 padding_ltzero">
					<div class="radiobtn">
					    <input type="radio"  id="addlistcnt" value=1 name="addgrouptype" checked>
					    <label for="addlistcnt" class="mob_lable">Add Contact List</label>
						<div class="check"></div>
					</div>
				 </div>
				<div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
					<div class="radiobtn">
					    <input type="radio"  id="addmanucnt" value=2 name="addgrouptype">
					    <label for="addmanucnt" class="mob_lable">Add Contact manually</label>
						<div class="check"></div>
					</div>
				</div>
			</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 addlist-showdiv padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<h4 class="group-subtitle">Add contact list</h4>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">


						<span class="form_lable">Upload File</span> 
						 </div>


<div class="col-md-2 col-sm-2 padding_mzero col-xs-12">
    
						<div class="fileUpload btn submit_btn">
    <span>Upload</span>  
    <input type="file" class="upload" name="userfile" id="userfile" onChange="getuserfile();" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" >
	
</div>  
 

<p id="uploaded_img">  </p>			
  
	 </div>
						 <div class="col-md-6 col-sm-8 padding_ltzero col-xs-12">
						 <div class="col-md-12 col-sm-12 padding_zero upload-note-text col-xs-12">
						 <ul class="note-list">
<li>Upload only xls,xlsx filetypes and size must be less than 20MB.</li>
<li>Excel Should Contain The Header In the first row.</li>
<li>Excel Order - Name. Mobile No, Gender, DOB, Address Join Date, Relive Date Etc.</li>
<li>Moble No Is Mandatory.</li>
<li>Date Form DD-MM-YYYY.</li>  
</ul>
						 </div>
						 </div>

</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-3 col-sm-3 col-xs-12 col-sm-offset-2 padding_mzero col-md-offset-2 add-contactbtns">
<input type="submit"  name="add_group" class="submit_btn"  value="Create" >
 </div>
</div>
</div>
 
<div class="col-md-12 col-sm-12 col-xs-12 addmanul-showdiv padding_zero" style="display:none;">
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<h4 class="group-subtitle">Add contact manually</h4>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
						<span class="form_lable">Name</span> 
						 </div>
						  <div class="col-md-7 col-sm-7 col-sm-12">
						<input type="text" id="contact_name" name="contact_name" placeholder="Enter Name">
						 </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
						<span class="form_lable">Mobile Number</span> 
						 </div>
						  <div class="col-md-7 col-sm-7 col-xs-12">
						<input type="text" id="contcat_mobileno" name="contcat_mobileno" placeholder="Enter Mobile Number">
						 </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
	 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">

 
 		<span class="form_lable">Gender</span> 
	 </div>
  	<div class="col-md-7 col-sm-7 col-xs-12">
	<div class="col-md-5 col-sm-5 col-xs-12 padding_zero">
		<div class="radiobtn">
	  		<input type="radio" id="gen_type2"   value='Male' name="contact_gender" >
		  	  <label for="gen_type2">Male</label>
			   <div class="check"></div>
		</div>
	</div> 
	<div class="col-md-5 col-sm-5 col-xs-12 padding_zero">
		<div class="radiobtn">  
	  		<input type="radio" id="gen_type1"   value='Female' name="contact_gender" >
		  	  <label for="gen_type1">Female</label>
			   <div class="check"></div>
		</div>
	</div> 
 </div>  
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
						<span class="form_lable">Date Of Birth</span> 
						 </div>
						  <div class="col-md-7 col-sm-7 col-xs-12">
						<input type="text" id="dob"  name="dob" placeholder="DD/MM/YYYY">
						 </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
						<span class="form_lable">Address</span> 
						 </div>
						  <div class="col-md-7 col-sm-7 col-xs-12">
						<input type="text" id="address" name="address" placeholder="Enter Address">
						 </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
						<span class="form_lable">Join Date</span> 
						 </div>
						  <div class="col-md-7 col-sm-7 col-xs-12">
						<input type="text" id="join_date" name="join_date" placeholder="DD/MM/YYYY">
						 </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
						<span class="form_lable">Relieve Date</span> 
						 </div>
						  <div class="col-md-7 col-sm-7 col-xs-12">
						<input type="text" id="relieve_date" name="relieve_date" placeholder="DD/MM/YYYY">
						 </div>
						 <div class="col-md-3 col-sm-3 col-xs-12">
						 
						<input type="submit" name="add_group"   class="create-btn" value="Create"  >
						<input type="button"  class="create-btn" value="Cancel" data-dismiss="modal">
						 </div>
</div>  
</form>

</div>
</div>
	</div>	
		
        <div id="existinggroup" class="smsadmintab-content" style="display:none;">
	 <form class="missedcall_allform" method="post">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">

<div class="col-md-12 col-sm-12 padding_zero form-div col-xs-12">
<div class="row">
<div class="col-md-6 col-sm-6 col-xs-12">  
<div class="col-md-12 col-sm-12 padding_zero select_numbers_bg col-xs-12">
<div class="panel-heading"><span>
<input type="checkbox" class="group_select" style="float:left; margin-right:10px;"  
 onchange="DoAction(0)" name="group_ids[]" value="0"/></span><p style="margin-left:15px;">Group Name</p></div> 
<div class="col-md-12 col-sm-12 col-xs-12 form-div cntnam-height">
<div class="panel-body grp_check">									
<ul class="scroll_numbar2 scroll_num scroll_numbar"> 
  <?php 
   $groups_count=0;	

foreach($groups as $group=>$groupname):
	$groups_count++;
	?>
         <li><input type="checkbox" value="<?php echo $groupname->group_id; ?>" name="group_ids[]"  onClick="DoAction(<?php echo $groupname->group_id;?>)"><span onClick ="getGroupData(<?php echo $groupname->group_id;?>);">
		 
 <?php echo $groupname->group_name; ?> 
         </span>
         </li>  
   
               <?php  endforeach;?>  
</ul>
</div>
</div>
</div>
</div>
<div class="col-md-6 col-sm-6 col-xs-12">
<div class="col-md-12 col-sm-12 padding_zero select_numbers_bg col-xs-12">
<div class="panel-heading">Group Details</div>

</div>

<div class="col-md-12 col-sm-12 padding_zero grpd-hgt group-details col-xs-12">
<div class="col-md-12 col-sm-12 grp-padding col-xs-12">
<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
<div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
<span class="grc_left">Group Name   </span>
</div>
<div class="col-md-6 col-sm-6 padding_zero col-xs-12">
<span class="grc_right"  id="group_name"> </span>
</div>
</div>


<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
<div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
<span class="grc_left">Created On  </span>
</div>
<div class="col-md-6 col-sm-6 padding_zero col-xs-12">
<span class="grc_right" id="created_date"> </span>
</div>
</div>


<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
<div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
<span class="grc_left">No. of Contacts  </span>
</div>
<div class="col-md-6 col-sm-6 padding_zero col-xs-12">
<span class="grc_right" id="group_count"> </span>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
<div class="row">
<div class="col-md-6 col-sm-6 form-div col-xs-12">
<div class="col-md-12 col-sm-12 padding_zero select_numbers_bg col-xs-12">
<div class="panel-heading"><span>
 <input type="checkbox"   name="checkall" id="checkall" style="float:left; margin-right:10px;"  
 value="0"/>  
 </span><p style="margin-left:15px;">Check All Contacts</p></div>  
<div class="panel-body"> 
 <div class="col-md-12 col-sm-12 col-xs-12 cntnam-height group-details">
<span id="contact_list"> 
</span>
</div>

 </div>
 </div>  
</div>
<div class="col-md-6 col-sm-6 form-div col-xs-12">
<div class="col-md-12 col-sm-12 padding_zero select_numbers_bg col-xs-12">
<div class="panel-heading">Contact Details</div>
</div>
<div class="col-md-12 col-sm-12 padding_zero grpd-hgt group-details col-xs-12">
<div class="col-md-12 col-sm-12 grp-padding col-xs-12">
<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
<div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
<span class="grc_left">Name</span>
</div>
<div class="col-md-6 col-sm-6 padding_zero col-xs-12">
<span class="grc_right" id="group_con_name"> </span>
</div>
</div>
<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
<div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
<span class="grc_left">Mobile Number</span>
</div>
<div class="col-md-6 col-sm-6 padding_zero col-xs-12">
<span class="grc_right" id="group_con_num"> </span>
</div>
</div>
<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
<div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
<span class="grc_left">Gender</span>
</div>
<div class="col-md-6 col-sm-6 padding_zero col-xs-12">
<span class="grc_right" id="group_con_gen"> </span>
</div>
</div>
<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
<div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
<span class="grc_left">Date Of Birth</span>
</div>
<div class="col-md-6 col-sm-6 padding_zero col-xs-12">
<span class="grc_right" id="group_con_dob"> </span>
</div>
</div>
<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
<div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
<span class="grc_left">Address</span>
</div>
<div class="col-md-6 col-sm-6 padding_zero col-xs-12">
<span class="grc_right" id="group_con_addr"> </span>
</div>
</div>
<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
<div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
<span class="grc_left">Join Date</span>
</div>
<div class="col-md-6 col-sm-6 padding_zero col-xs-12">
<span class="grc_right" id="group_con_joinDate"> </span>
</div>
</div>
<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
<div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
<span class="grc_left">Relieve Date</span>
</div>
<div class="col-md-6 col-sm-6 padding_zero col-xs-12">
<span class="grc_right" id="group_con_relDate"> </span>
</div>
</div>
</div> 

</div>
	       
</div>

</div>
</div>
</div>
<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
	<button type="button" class="submit_btn" onClick="getCheckedMobileno();" data-dismiss="modal">Submit</button>  
</div>
</div>
        </div>
       

    </div>

        </div>

        </div>
        
      </div>
      	


    </div>
  </div>
  <!-- Model End -->

<script src="<?php echo base_url();?>js/form_validation/js/bootstrap-tooltip.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/jquery-validate.bootstrap-tooltip.js" type="text/javascript"></script>
 <script src=" <?php echo base_url();?>js/jquery.validate.file.js" type="text/javascript"></script>

    <script src=" <?php echo base_url();?>assets/js/bootstrap-confirmation.min.js" type="text/javascript"></script>
	
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js" type="text/javascript"></script>	
	
	<script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js" type="text/javascript"></script>
	
	<script>
$(document).ready(function(){

$.validator.addMethod("notEqualTo", function (value, element, param)
{
    var target = $(param);
    if (value) return value != target.val();
    else return this.optional(element);
}, "Repeated field");


$("#video_file_upload").validate({
    rules: {
	file_input: {
          required:true,
           extension: "mp4",
maxFileSize: {
"unit": "MB",
 "size": 10
}		   
        },
		short_url_video: {
			required:true
		}


    },
	messages: {
		file_input: {
            required: "Please Upload Video File",
            extension: "Please Upload MP4 Formate"	            
        }

    },
  
	tooltip_options: {
    	file_input: {placement:'bottom',html:true},
		short_url_video: {placement:'bottom',html:true}
		}
});  
}); 
 </script>
 <script>
$(document).ready(function(){
$.validator.addMethod("notEqualTo", function (value, element, param)
{
    var target = $(param);
    if (value) return value != target.val();
    else return this.optional(element);
}, "Repeated field");

 
$("#audio_file_upload").validate({
    rules: {
	file_input: {
          required:true,
           extension: "mp3",
          maxFileSize: {
"unit": "MB",
 "size": 2
}	  
        },
		short_url_audio: {
		required:true
			
		}

    },
	messages: {
		file_input: {
            required: "Please Upload Audio File",
            extension: "Please Upload MP3 Formate",
            maxFileSize: "File cannot larger than 2MB"			
        }

    },
  
	tooltip_options: {
    	file_input: {placement:'bottom',html:true},
		short_url_audio: {placement:'bottom',html:true}
		}
});  
}); 
 </script>
  <script>
$(document).ready(function() {
    $(".smsadmintabs a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("currentsmstab");
        $(this).parent().siblings().removeClass("currentsmstab");
        var tab = $(this).attr("href");
        $(".smsadmintab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
});
</script>


 <!-- missedcall start-->
 <?php 
 			$did_types=array();
	            $rs=array();
	            $smsstriker_id=$this->session->userdata('user_id');
	            $real_url=$this->config->item('firstring_url');
			$qry_fields =array('service_name' => urlencode('free_service'),'smsstriker_id' => urlencode($smsstriker_id));
			$did_url = $real_url."API/smsstriker/free_service/registration.php";
			$qry_fields_string = http_build_query($qry_fields);
			$did_conn= curl_init();
			//set the url, number of POST vars, POST data
			curl_setopt($did_conn,CURLOPT_URL, $did_url);
			curl_setopt($did_conn,CURLOPT_POST, count($_POST));
			curl_setopt($did_conn,CURLOPT_POSTFIELDS, $qry_fields_string);
			curl_setopt($did_conn, CURLOPT_FORBID_REUSE, 1);
			curl_setopt($did_conn, CURLOPT_RETURNTRANSFER, true);
			//execute post
			$did_result = curl_exec($did_conn);
			$getsilver_didlist_api=json_decode($did_result, true);
		 	curl_close($did_conn);
			$rs =$getsilver_didlist_api;
			if(count($getsilver_didlist_api)>0)
			{
			 $freeservice =$getsilver_didlist_api;
			}
			else
			{
			$freeservice=array();
			}
			
//print_r($freeservice);
if($freeservice['message']=='available')
{		
	$this->load->view("missedcall_payments/free_service/missedcall");
}
else if($freeservice['message']=='used')
{		
	$this->load->view("missedcall_payments/missedcall");
}
else
{
	$this->load->view("missedcall_payments/free_service/missedcall");
}
 
 
 ?>
 <!-- missedcall End-->
 
<script>
	$(document).ready(function() {
	$("#addlistcnt").click( function(){
	if( $(this).is(':checked') ) 
	{
	$(".addmanul-showdiv").hide();
	$(".addlist-showdiv").show();
}
});
$("#addmanucnt").click( function(){
	if( $(this).is(':checked') ) 
	{
	$(".addmanul-showdiv").show();
	$(".addlist-showdiv").hide();
}
});
  
	});
</script>
<script>
$(document).ready(function(){
$.validator.addMethod("notEqualTo", function (value, element, param)
{
    var target = $(param);
    if (value) r

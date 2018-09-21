<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script src="<?php echo base_url();?>js/jquery.ui.datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/jquery.blockUI.js" type="text/javascript"></script>
     
<script type="text/javascript">
$(document).ready( function(){
	$('#schedule').click(function() {
		if ($('#schedule').is(':checked')) {
		    $("div#schedule_sms"). show();
		} else {				
			$("div#schedule_sms"). hide();
		}	
	});

	$('#sms_text').keyup(function(){
		$('#msg_len').html($('#sms_text').val().length);	

	});
	
	$('#sms_text').keydown(function(){
		$('#msg_len').html($('#sms_text').val().length);
	});
	
	$('#on_date').datetimepicker({	
		dateFormat: 'yyyy-mm-dd HH:MM'
	});

	$('#remove_duplictes').click(function() {
		
		if ($('#remove_duplictes').is(':checked') == true) {
			var to_mobileno = $("textarea#to_mobileno").val();
			var data ={to_mobileno:to_mobileno};
			$.ajax({
		        url: "<?php echo site_url('/campaign/normalSmsRemoveDublicates'); ?>", 
		        type: "POST",       
		        data: data,    
		        cache: false,
		        success: function (callback_data) {		        	
		        	var substr = callback_data.split('\n');
		        	var to_mobileno_count = to_mobileno.split('\n');
		        	alert(substr.length + " Unique Numbers out of " + to_mobileno_count.length);
		        	$('textarea#to_mobileno').val(callback_data);				    
		    	}
			});
		}
		 
	});

    $('#single_sms_form').submit(function() {
        var sms_length = $('#sms_text').val().length;
       
	    var no_of_sms=1;
		if(sms_length>160)
		{
			no_of_sms = Math.ceil(sms_length/153);
		}else
		{
			no_of_sms = Math.ceil(sms_length/160);
		}
	    //var no_of_sms = Math.ceil(sms_length/160); // changed on 26-12-2013 as per santosh request
       
	    if(no_of_sms > 1) {
            if (!confirm('Message length is '+sms_length+'. 1Message = '+no_of_sms+' SMS')){
                return false;
            }
        }
        $.blockUI({
            message: $("#processing")
        });
    });

    /*$.blockUI({
       message: $("#message")
    });*/

    $('input#msg_alert_ok').click(function(){
        $.unblockUI();
    });
	
});
</script>
<div id="processing" style="display: none;">
    <img src="<?php echo base_url(); ?>images/loader.gif" alt="processing" />&nbsp;&nbsp;<strong>Processing...</strong>
    <p>Please do not refresh the Page.</p>
</div>
<h2>Edit Scheduled SMS</h2>
<div class="form" style="margin-top:30px;">
			<?php echo form_open('campaign/updateschedulecampaign',
							array('id' => 'single_sms_form', 'name' => 'single_sms_form', 'method' => 'post')
			); ?>       	
              	<fieldset>
                    <div id='schedule_sms'>
                    <dl>
                        <dt><label for="address1" style="font-size:13px;">Schedule Date Time:</label></dt>
                        <dd>
                        	<?php echo form_input(array('name' => 'on_date', 'id' => 'on_date', 'class' => 'inputText', 'value' => $campaign)); ?>
                        	<div class="form_error"><?php echo form_error('on_date'); ?></div>
                        </dd>
                    </dl>
                    </div>
                                        
                     <dl class="submit" style="margin-left:-20px;">
                   		<?php echo form_hidden('campaign_id',$campaign_id);?>
						<?php echo form_submit(array('name' => 'sendsms','value' => 'Edit', 'class' => 'button'));?>
                     </dl>
                     
                     
                 </fieldset>   
               
                
        <?php echo form_close(); ?>
</div>

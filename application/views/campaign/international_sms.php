
   <script src="<?php echo base_url();?>/js/jquery.ui.datetimepicker.min.js" type="text/javascript"></script>
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

});
</script>
<h2>International SMS</h2>
<?php if(isset($no_balance)): ?>
	<div class="error_box">
	 	<?php echo $no_balance; ?>
	</div> 
<?php elseif(isset($error)): ?>
	<div class="error_box">
	 	<?php echo $error; ?>
	</div> 
<?php endif; ?>

<div class="form">		 
	<?php 
		echo form_open_multipart('campaign/internationalSMS',
			array('id' => 'international_sms_form', 'name' => 'international_sms_form')	
		);
	?>
		<fieldset>
                    <dl>
                        <dt><label for="first_name">SMS Type:</label></dt>
                        <dd>
                        	<?php echo form_radio('sms_type','0',TRUE,'class="radio"'); ?> Normal SMS
			   				<?php echo form_radio('sms_type','1',set_radio('sms_type','class="radio"')); ?> Flash SMS
                        	<div class="form_error"><?php echo form_error('sms_type'); ?></div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="last_name">SMS Text:</label></dt>
                        <dd>
                        	<?php echo form_textarea(array('name' => 'sms_text', 'id' => 'sms_text', 'rows' => 5, 'cols' => 30, 'class' => 'inputTextArea', 'value' => set_value('sms_text')));?>
                        	<span>SMS Length: <span id="msg_len" style="color:red;">0 </span> </span>
                        	<div class="form_error"><?php echo form_error('sms_text'); ?></div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="email">Sender:</label></dt>
                        <dd>
                        	<?php echo form_dropdown('sender', $sender_names, set_value('sender'), 'class="selectText"');?> 
                        	<div class="form_error"><?php echo form_error('sender'); ?></div>
                        </dd>
                    </dl>
                     <dl>
                        <dt><label for="mobile">To File:</label></dt>
                        <dd>
                        	<?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile', 'value' => set_value('userfile')));?>
                        	<div class="form_error"><?php echo form_error('userfile'); ?></div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="tnc"><?php echo form_checkbox(array('name' => 'schedule', 'id' => 'schedule', 'value' => 1))?></label></dt>
                        <dd> <label class="check_label"> Schedule Message </label>
                        	<div class="form_error"><?php echo form_error('schedule'); ?></div>
                        </dd>
                    </dl>
                    <div id='schedule_sms' style='display:none;' >
                    <dl>
                        <dt><label for="address1">Schedule Date Time:</label></dt>
                        <dd>
                        	<?php echo form_input(array('name' => 'on_date', 'id' => 'on_date', 'class' => 'inputText', 'value' => set_value('on_date'))); ?>
                        	<div class="form_error"><?php echo form_error('on_date'); ?></div>
                        </dd>
                    </dl>
                    </div>
                                        
                     <dl class="submit">
                   		<?php echo form_submit(array('name' => 'sendsms','value' => 'Send', 'class' => 'button'));?>
                     </dl>
                     
                     
                 </fieldset>
	<?php echo form_close(); ?>
</div>
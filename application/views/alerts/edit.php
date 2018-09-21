<script type="text/javascript">
$(document).ready( function(){
    $('input#add_alert').click(function(){
        var n = $("input#groups:checked").length;
        if(n == 0) {
            alert("Please Select atleast one Group");
            return false;
        }

        $('form#add_alert_form').submit();
    });
});
</script>
<h2>Edit SMS Alert</h2>
<?php if(isset($error)): ?>
	<div class="error_box">
	 	<?php echo $error; ?>
	</div>
<?php endif; ?>
<div>
	<?php foreach($alert as $row): ?>
	<?php echo form_open('alerts/edit/'.$row->alert_id,
		array(
			'id' => 'add_alert_form',
			'name' => 'add_alert_form',
			'method' => 'post')
		); 
	?>
	
		<table class="form">
		<tr><td valign="top">
			<table>				
		    	<tr>
			    	<td><label for="first_name">Field:</label></td>
			        <td>
			        	<?php echo form_dropdown('field', $field, set_value('field') ? set_value('field') : $row->field_id, 'class="selectText"');?> 
	                    <div class="form_error"><?php echo form_error('field'); ?></div>
			        </td>
		    	</tr>
		    	<tr>
			    	<td><label for="first_name">Days before:</label></td>
			        <td>
			        	<?php echo form_input(array('name' => 'days_before', 'id' => 'days_before', 'class' => 'inputText', 'value' => set_value('days_before') ? set_value('days_before') : $row->days_before));?>
	                    <div class="form_error"><?php echo form_error('days_before'); ?></div>
			        </td>
			    </tr>
			    <?php $ot = explode(":",$row->on_time); ?>
			    <?php $hr1 = $ot[0]; $min1 = $ot[1]; ?>
		    	<tr>
			       	<td><label for="last_name">On Time:</label></td>
			        <td>
			        	<?php echo form_dropdown('hr', $hr, set_value('hr') ? set_value('hr') : $hr1, 'class="selectText" style="width:100px;"');?> hr &nbsp;&nbsp;
			        	<?php echo form_dropdown('min', $min, set_value('min') ? set_value('min') : $min1, 'class="selectText" style="width:100px;"');?> min
	                    <div class="form_error"><?php echo form_error('hr'); ?></div>
	                    <div class="form_error"><?php echo form_error('min'); ?></div>
			        </td>
			    </tr>
		    	<tr>
			       	<td><label for="last_name">SMS Text:</label></td>
			        <td>
			        	<?php echo form_textarea(array('name' => 'sms_txt', 'id' => 'sms_txt', 'class' => 'inputTextArea', 'value' => set_value('sms_txt')?set_value('sms_txt'):$row->sms_text, 'rows' => 5));?>
	                    <div class="form_error"><?php echo form_error('sms_txt'); ?></div>
			        </td>
		    	</tr>
		    	<tr>
		    		<td></td>
            		<td><?php echo form_submit(array('name' => 'edit_alert','value' => 'Edit Alert', 'class' => 'button'));?></td>
            	</tr>
			</table>
		</td>
		<td valign="top">
			<label>groups</label>
			<div style="height:300px; overflow:auto;">
                <?php $group_count = 0; ?>
				<?php foreach($groups as $group_id => $group_name): ?>
                <?php $group_count++; ?>
					<div>
						<input type="checkbox" id="groups" name="group_<?php echo $group_count; ?>" value='<?php echo $group_id; ?>'
							<?php if(in_array($group_id,$alert_grps)): echo "checked"; endif;?> /><?php echo $group_name; ?>
					</div>
				<?php endforeach;?>
			</div>
		</td>
	</tr>
	</table>
	<?php endforeach; ?>
	<input type="hidden" name="group_count" value="<?php echo $group_count; ?>" />		
	<?php echo form_close(); ?>
</div>
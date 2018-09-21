<script type="text/javascript">
$(document).ready( function(){
    $('input#add_contact').click(function(){
        var n = $("input#groups:checked").length;
        if(n == 0) {
            alert("Please Select atleast one Group");
            return false;
        }

        var mobile = $("input#contcat_mobileno").val();
        if(mobile == null || mobile == "") {
            alert("Please Enter Mobile Number");
            return false;
        }
    });
});
</script>
<h2>Add Contact</h2>
<?php if(isset($error)): ?>
	<div class="error_box">
	 	<?php echo $error; ?>
	</div>
<?php endif; ?>
<div>
	<?php echo form_open('contacts/addContact',
		array(
			'id' => 'add_contact_form',
			'name' => 'add_contact_form',
			'method' => 'post')
		); 
	?>
		<table class="form">
		<tr><td>
			<table>
				
				<tr>
			       	<td><label for="last_name">Name:</label></td>
			        <td>
			        	<?php echo form_input(array('name' => 'contact_name', 'id' => 'contact_name', 'class' => 'inputText', 'value' => set_value('contact_name')));?>
	                    <div class="form_error"><?php echo form_error('contact_name'); ?></div>
	                </td>    
		        </tr>
		        <tr>
			       	<td><label for="last_name">Mobile Number:</label></td>
			        <td>
			        	<?php echo form_input(array('name' => 'contcat_mobileno', 'id' => 'contcat_mobileno', 'class' => 'inputText', 'value' => set_value('contcat_mobileno')));?>
	                    <div class="form_error"><?php echo form_error('contcat_mobileno'); ?></div>
			        </td>
		    	</tr>
		    	<tr>
			       	<td><label for="last_name">Gender:</label></td>
			        <td>
			        	<?php echo form_radio('contact_gender','0',set_radio('contact_gender'),'class="radio"'); ?> Male
				   		<?php echo form_radio('contact_gender','1',set_radio('contact_gender'),'class="radio"'); ?> Female
	                    <div class="form_error"><?php echo form_error('contact_gender'); ?></div>
			        </td>
		    	</tr>
		    	<tr>
			       	<td><label for="last_name">Date Of Birth:</label></td>
			        <td>
			        	<?php echo form_input(array('name' => 'dob', 'id' => 'dob', 'class' => 'inputText', 'value' => set_value('dob') ? set_value('dob') : 'DD / MM / YYYY' ));?>
	                    <div class="form_error"><?php echo form_error('name'); ?></div>
			        </td>
		    	</tr>
		    	<tr>
		       		<td><label for="last_name">Address:</label></td>
		        	<td>
		        		<?php echo form_textarea(array('name' => 'address', 'id' => 'address', 'rows' => 5, 'cols' => 30, 'class' => 'inputTextArea', 'value' => set_value('address')));?>
                    	<div class="form_error"><?php echo form_error('address'); ?></div>
		        	</td>
		        </tr>
		        <tr>
			       	<td><label for="last_name">Join Date:</label></td>
			        <td>
			        	<?php echo form_input(array('name' => 'join_date', 'id' => 'join_date', 'class' => 'inputText', 'value' => set_value('join_date') ? set_value('join_date') : 'DD / MM / YYYY' ));?>
	                    <div class="form_error"><?php echo form_error('join_date'); ?></div>
			        </td>
		    	</tr>
		    	<tr>
			       	<td><label for="last_name">Relieve Date:</label></td>
			        <td>
			        	<?php echo form_input(array('name' => 'relieve_date', 'id' => 'relieve_date', 'class' => 'inputText', 'value' => set_value('relieve_date') ? set_value('relieve_date') : 'DD / MM / YYYY' ));?>
	                    <div class="form_error"><?php echo form_error('relieve_date'); ?></div>
			        </td>
		    	</tr>
		    	<tr>
		    		<td></td>
		    		<td><?php echo form_submit(array('name' => 'add_contact', 'id'=> 'add_contact', 'value' => 'Add Contact', 'class' => 'button'));?></td>
            	</tr>
			</table>		
		</td>
		<td valign="top">
			<label>Groups</label>
			<div style="height:300px; overflow:auto;">
                <?php $group_count = 0; ?>
				<?php foreach($groups as $group_id => $group_name): ?>
                <?php $group_count++; ?>
					<div>
						<input type="checkbox" id="groups" name="group_<?php echo $group_count; ?>" value='<?php echo $group_id; ?>' /><?php echo $group_name; ?>
					</div>
				<?php endforeach;?>
			</div>
		</td>
		</tr>
		</table>
    <input type="hidden" name="group_count" value="<?php echo $group_count; ?>" />
	<?php echo form_close(); ?>
</div>

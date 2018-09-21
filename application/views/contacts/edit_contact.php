<h2>Edit Contact</h2>
<?php if(isset($error)): ?>
	<div class="error_box">
	 	<?php echo $error; ?>
	</div>
<?php endif; ?>
<div class="form">
	<?php echo form_open('contacts/editContact/contact/'.$contact_id,
		array(
			'id' => 'edit_contact_form',
			'name' => 'edit_contact_form',
			'method' => 'post')
		); 
	?>
		<fieldset>
		<?php foreach($contact_detils as $row): ?>
			<dl>
		    	<dt><label for="first_name">Group:</label></dt>
		        <dd>
		        	<?php echo form_dropdown('group', $groups, set_value('group') ? set_value('group') : $row->group_id, 'class="selectText"');?> 
                    <div class="form_error"><?php echo form_error('group'); ?></div>
		        </dd>
		    </dl>
		    <dl>
		       	<dt><label for="last_name">Name:</label></dt>
		        <dd>
		        	<?php echo form_input(array('name' => 'contact_name', 'id' => 'contact_name', 'class' => 'inputText', 'value' => set_value('contact_name')? set_value('contact_name') : $row->name ));?>
                    <div class="form_error"><?php echo form_error('contact_name'); ?></div>
		        </dd>
		    </dl>
		    <dl>
		       	<dt><label for="last_name">Mobile Number:</label></dt>
		        <dd> 
		        	<?php if($International == 1) { ?>
		        		<?php echo form_input(array('name' => 'contcat_mobileno', 'id' => 'contcat_mobileno', 'class' => 'inputText', 'value' => set_value('contcat_mobileno') ? set_value('contcat_mobileno') : $row->mobile_no));?>
                    <div class="form_error"><?php echo form_error('contcat_mobileno'); ?></div>
		        	
		        	<?php }else{ ?>
		        		<?php echo form_input(array('name' => 'contcat_mobileno', 'maxlength' => '10','id' => 'contcat_mobileno', 'class' => 'inputText', 'value' => set_value('contcat_mobileno') ? set_value('contcat_mobileno') : $row->mobile_no));?>
                    <div class="form_error"><?php echo form_error('contcat_mobileno'); ?></div>
                    		<?php } ?>
		        </dd>
		    </dl>
		    <dl>
		       	<dt><label for="last_name">Gender:</label></dt>
		        <dd>
		        	<?php echo form_radio('contact_gender','0',set_radio('contact_gender')?set_radio('contact_gender'):$row->gender,'class="radio"'); ?> Male
			   		<?php echo form_radio('contact_gender','1',set_radio('contact_gender')?set_radio('contact_gender'):$row->gender,'class="radio"'); ?> Female
                    <div class="form_error"><?php echo form_error('contact_gender'); ?></div>
		        </dd>
		    </dl>
		    <dl>
		       	<dt><label for="last_name">Date Of Birth:</label></dt>
		        <dd>
		        	<?php echo form_input(array('name' => 'dob', 'id' => 'dob', 'class' => 'inputText', 'value' => set_value('dob') ? set_value('dob') : substr($row->dob, 8,2)."-".substr($row->dob, 5,2)."-".substr($row->dob, 0,4)));?>
                    <div class="form_error"><?php echo form_error('name'); ?></div>
		        </dd>
		    </dl>
		    <dl>
		       	<dt><label for="last_name">Address:</label></dt>
		        <dd>
		        	<?php echo form_textarea(array('name' => 'address', 'id' => 'address', 'rows' => 5, 'cols' => 30, 'class' => 'inputTextArea', 'value' => set_value('address')?set_value('address'):$row->address));?>
                    <div class="form_error"><?php echo form_error('address'); ?></div>
		        </dd>
		    </dl>
		    <dl>
		       	<dt><label for="last_name">Join Date:</label></dt>
		        <dd>
		        	<?php echo form_input(array('name' => 'join_date', 'id' => 'join_date', 'class' => 'inputText', 'value' => set_value('join_date') ? set_value('join_date') : substr($row->join_date, 8,2)."-".substr($row->join_date, 5,2)."-".substr($row->join_date, 0,4) ));?>
                    <div class="form_error"><?php echo form_error('join_date'); ?></div>
		        </dd>
		    </dl>
		    <dl>
		       	<dt><label for="last_name">Relieve Date:</label></dt>
		        <dd>
		        	<?php echo form_input(array('name' => 'relieve_date', 'id' => 'relieve_date', 'class' => 'inputText', 'value' => set_value('relieve_date') ? set_value('relieve_date') : substr($row->relieve_date, 8,2)."-".substr($row->relieve_date, 5,2)."-".substr($row->relieve_date, 0,4)));?>
                    <div class="form_error"><?php echo form_error('relieve_date'); ?></div>
		        </dd>
		    </dl>
		    <dl class="submit">
            	<?php echo form_submit(array('name' => 'edit_contact','value' => 'Edit Contact', 'class' => 'button'));?>
            </dl>
            <?php endforeach; ?>
		</fieldset>
	<?php echo form_close(); ?>
</div>

<h2>Edit Group</h2>
<?php if(isset($error)): ?>
	<div class="error_box">
	 	<?php echo $error; ?>
	</div>
<?php endif; ?>
<div class="form">
	<?php echo form_open_multipart('contacts/editGroup/group/'.$group_id,
		array(
			'id' => 'edit_group_form',
			'name' => 'edit_group_form',
			'method' => 'post')
		); 
	?>
		<fieldset>
			<dl>
		    	<dt><label for="first_name">Group Name:</label></dt>
		        <dd>
		        	<?php echo form_input(array('name' => 'group_name', 'id' => 'group_name', 'class' => 'inputText', 'value' => set_value('add_group_name') ? set_value('add_group_name') : $group_name)); ?>
		            <div class="form_error"><?php echo form_error('group_name'); ?></div>
		        </dd>
		    </dl>
		    <dl class="submit">
            	<?php echo form_submit(array('name' => 'edit_group','value' => 'Edit Group', 'class' => 'button'));?>
            </dl>
		</fieldset>
	<?php echo form_close(); ?>
</div>

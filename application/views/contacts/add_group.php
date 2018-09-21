<h2>Add Group</h2>
<?php if(isset($error)): ?>
	<div class="error_box">
	 	<?php echo $error; ?>
	</div>
<?php else: ?>
    <?php if($nogroups): ?>
        <div class="error_box">
            No Groups Exist. Please Add Group according to below instructions
        </div>
    <?php endif; ?>
    <div class="warning_box">
        1. upload Only Excel Files<br />
        2. Excel should contain the headers in the first row.<br />
        3. Excel Order: Name,Mobile Number,Gender,Date of Birth,Address,Join Date,Relieve Date.<br />
        4. Mobile Number is mandatory<br/>
        5. Date should be in the format of YYYY-MM-DD.<br />
    </div> 
<?php endif; ?>
<div class="form">
	<?php echo form_open_multipart('contacts/addGroup',
		array(
			'id' => 'add_group_form',
			'name' => 'add_group_form',
			'method' => 'post')
		); 
	?>
		<fieldset>
			<dl>
		    	<dt><label for="first_name">Group Name:</label></dt>
		        <dd>
		        	<?php echo form_input(array('name' => 'group_name', 'id' => 'group_name', 'class' => 'inputText', 'value' => set_value('add_group_name'))); ?>
		            <div class="form_error"><?php echo form_error('group_name'); ?></div>
		        </dd>
		    </dl>
		    <dl>
		       	<dt><label for="last_name">Excel File:</label></dt>
		        <dd>
		        	<?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile', 'value' => set_value('userfile')));?>
                    <div class="form_error"><?php echo form_error('userfile'); ?></div>
		        </dd>
		    </dl>
		    <dl class="submit">
            	<?php echo form_submit(array('name' => 'add_group','value' => 'Add Group', 'class' => 'button'));?>
            </dl>
		</fieldset>
	<?php echo form_close(); ?>
</div>

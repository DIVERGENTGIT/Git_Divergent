<h2>Complaint Box</h2>
<?php if(isset($msg)): ?>
	<div class="valid_box">
	 	<?php echo $msg; ?>
	</div>
<?php else: ?>
<div class="warning_box">
 	All the fields are mandatory
</div>
<?php endif; ?>
<div class="form">
	<?php echo form_open('index/complaintBox',
					array('id' => 'complaint_form', 'name' => 'complaint_form', 'method' => 'post')
	); ?>
	<fieldset>
		<dl>
			<dt><label for="type">Complaint For</label></dt>
			<dd>
				<?php echo form_dropdown('issue_type', 
					array('' => '--select--',
						'Sales Team' => 'Sales Team',
						'Support Team' => 'Support Team',
						'Technical Team' => 'Technical Team'), set_value('issue_type'), 'class = "selectText"'); ?>
				<div class="form_error"><?php echo form_error('issue_type'); ?></div>
			</dd>
			
		</dl>
        <dl>
    		<dt><label for="username">Contact Number:</label></dt>
            <dd>
				<?php echo form_input(array('name' => 'contact_number', 'id' => 'contact_number', 'value' => set_value('contact_number'), 'class' => 'inputText',)); ?>
				<div class="form_error"><?php echo form_error('contact_number'); ?></div>
			</dd>
         </dl>
         <dl>
             <dt><label for="password">Title:</label></dt>
             <dd>
                 <?php echo form_input(array('name' => 'title', 'id' => 'title', 'value' => set_value('title'), 'class' => 'inputText', 'style' => 'width:400px;' ));?>
                 <div class="form_error"><?php echo form_error('title'); ?></div>
             </dd>
         </dl>
         <dl>
             <dt><label for="password">Complaint:</label></dt>
             <dd>
                 <?php echo form_textarea(array('name' => 'complaint_text', 'id' => 'complaint_text', 'class' => 'inputTextArea', 'value' => set_value('complaint_text'),'style' => 'width:400px;'));?>
                 <div class="form_error"><?php echo form_error('complaint_text'); ?></div>
             </dd>
         </dl>
         <dl class="submit">
         	<dt><?php echo form_submit(array('name' => 'submit','value' => 'Submit', 'class' => 'button'));?></dt>
         </dl>
    </fieldset>                
    <?php echo form_close(); ?>
 </div>



<h2>Register</h2>
<?php if(isset($userExist)): ?>
	<div class="error_box">
	 	<?php echo $userExist; ?>
	</div>
<?php else: ?>
<div class="warning_box">
 	All the fields are mandatory
</div>
<?php endif; ?>
<div class="form">
	<?php echo form_open('index/register',
					array('id' => 'register_form', 'name' => 'register_form', 'method' => 'post')
	); ?>
	<h3>Account Details</h3>
         
                <fieldset>
                    <dl>
                        <dt><label for="username">Username:</label></dt>
                        <dd>
							<?php echo form_input(array('name' => 'username', 'id' => 'username', 'value' => set_value('username'), 'class' => 'inputText',)); ?>
							<div class="form_error"><?php echo form_error('username'); ?></div>
						</dd>
                    </dl>
                    <dl>
                        <dt><label for="password">Password:</label></dt>
                        <dd>
                        	<?php echo form_password(array('name' => 'userpass', 'id' => 'userpass', 'value' => set_value('userpass'), 'class' => 'inputText' ));?>
                        	<div class="form_error"><?php echo form_error('userpass'); ?></div>
                        </dd>
                    </dl>
              	</fieldset>
    <h3>Contact Details</h3>          	
              	<fieldset>
                    <dl>
                        <dt><label for="first_name">First Name:</label></dt>
                        <dd>
                        	<?php echo form_input(array('name' => 'first_name', 'id' => 'first_name', 'maxlength' => 45, 'value' => set_value('first_name'), 'class' => 'inputText' ));?>
                        	<div class="form_error"><?php echo form_error('first_name'); ?></div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="last_name">Last Name:</label></dt>
                        <dd>
                        	<?php echo form_input(array('name' => 'last_name', 'id' => 'last_name', 'maxlength' => 45, 'value' => set_value('last_name'), 'class' => 'inputText' ));?>
                        	<div class="form_error"><?php echo form_error('last_name'); ?></div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="email">Email:</label></dt>
                        <dd>
                        	<?php echo form_input(array('name' => 'email', 'id' => 'email', 'maxlength' => 45, 'value' => set_value('email'), 'class' => 'inputText' ));?>
                        	<div class="form_error"><?php echo form_error('email'); ?></div>
                        </dd>
                    </dl>
                     <dl>
                        <dt><label for="mobile">Mobile:</label></dt>
                        <dd>
                        	<?php echo form_input(array('name' => 'mobile', 'id' => 'mobile', 'maxlength' => 45, 'value' => set_value('mobile'), 'class' => 'inputText' ));?>
                        	<div class="form_error"><?php echo form_error('mobile'); ?></div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="address1">Address1:</label></dt>
                        <dd>
                        	<?php echo form_input(array('name' => 'address1', 'id' => 'address1', 'maxlength' => 45, 'value' => set_value('address1'), 'class' => 'inputText' ));?>
                        	<div class="form_error"><?php echo form_error('address1'); ?></div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="address2">Address2:</label></dt>
                        <dd>
                        	<?php echo form_input(array('name' => 'address2', 'id' => 'address2', 'maxlength' => 45, 'value' => set_value('address2'), 'class' => 'inputText' ));?>
                        	<div class="form_error"><?php echo form_error('address2'); ?></div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="city">City:</label></dt>
                        <dd>
                        	<?php echo form_dropdown('city_id', $cities, set_value('city_id'), 'class = "selectText"'); ?>
                        	<div class="form_error"><?php echo form_error('city_id'); ?></div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="pincode">Pin/Zip Code:</label></dt>
                        <dd>
                        	<?php echo form_input(array('name' => 'pincode', 'id' => 'pincode', 'maxlength' => 45, 'value' => set_value('pincode'), 'class' => 'inputText' ));?>
                        	<div class="form_error"><?php echo form_error('pincode'); ?></div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="tnc"><?php echo form_checkbox(array('name' => 'tnc', 'id' => 'tnc', 'value' => 1));?></label></dt>
                        <dd> <label class="check_label">I Accepted All the <a href="<?php echo site_url('/index/terms'); ?>"> Terms & Conditions</a></label>
                        	<div class="form_error"><?php echo form_error('tnc'); ?></div>
                        </dd>
                    </dl>
                                        
                     <dl class="submit">
                   		<?php echo form_submit(array('name' => 'register','value' => 'Register', 'class' => 'button'));?>
                     </dl>
                     
                     
                 </fieldset>   
               
                
        <?php echo form_close(); ?>
 </div>



<h2>User Login</h2>
<?php if(isset($invalid)): ?>
	<div class="error_box">
	 	<?php echo $invalid; ?>
	 </div>
<?php else: ?>
	 <div class="warning_box">
	 	Login with User Name and Password
	 </div>	
<?php endif; ?>
<div class="form">
 	<?php echo form_open('index/login', array('id' => 'login_form', 'name' => 'login_form') ); ?>
         
                <fieldset>
                    <dl>
                        <dt><label for="username">Username:</label></dt>
                        <dd><?php echo form_input(array('name' => 'username', 'id' => 'username', 'maxlength' => 45, 'class' => 'inputText', 'value' => set_value('username')));?>
                        	<div class="form_error"><?php echo form_error('username'); ?></div>
                        </dd>
                    </dl>
                    <dl>
                        <dt><label for="password">Password:</label></dt>
                        <dd><?php echo form_password(array('name' => 'userpass', 'id' => 'userpass', 'maxlength' => 45, 'class' => 'inputText', 'value' => set_value('userpass')));?>
                        	<div class="form_error"><?php echo form_error('userpass'); ?></div>
                        </dd>
                    </dl>
                                        
                     <dl class="submit">
                   		<?php echo form_submit(array('name' => 'login','value' => 'Login', 'class' => 'button'));?>
                     </dl>
                     
                     
                    
                </fieldset>
                
         <?php echo form_close(); ?>
 </div>
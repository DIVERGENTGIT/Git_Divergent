
    <div class="col-sm-9 col-md-9 col-xs-12 padding_zero main-right-div">
      
      <!-- Left side column. contains the logo and sidebar -->

      <!-- Content Wrapper. Contains page content -->
      <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
        <!-- Content Header (Page header) -->
		 <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
        <!-- Main content -->
        <section class="col-sm-12 col-md-12 col-xs-12 padding_zero">
        
       
          <!-- Info boxes -->

 
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
   <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images-new/welcome-icon.png" class="right-title-img">Change Password</h3>
</div>
<?php if(isset($error)): ?>
 <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
	<div class="error_box" style="color:red;">
	 	<?php echo $error; ?>
	</div>
	</div>
<?php elseif(isset($changed)): ?>
 <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
	<div class="valid_box" style="color:red;">
	 	<?php echo $changed; ?>
	</div>	
	</div>
<?php endif; ?>
<div  class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-md-5 col-sm-12 col-xs-12 padding_zero">  

<div class="form col-sm-12 col-md-12 col-xs-12 padding_zero">
	<?php echo form_open('index.php/myaccount/changePassword',
					array('id' => 'change_password_form', 'name' => 'change_password_form', 'class' => 'missedcall_allform', 'method' => 'post')
	); ?>
	<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
	
	<label for="first_name" class="col-sm-12 col-md-12 col-xs-12 padding_zero form_lable">Current Password:</label>
	<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
	<?php echo form_password(array('name' => 'current_password', 'placeholder' => 'Type Current Password ','id' => 'current_password', 'maxlength' => 45, 'value' => set_value('current_password'), 'class' => 'form-control' ));?>
	</div>
	<div class="col-sm-12 col-md-12 col-xs-12 padding_zero form_error"><?php echo form_error('current_password'); ?></div>
	</div>
	
	<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
	
	<label for="last_name" class="col-sm-12 col-md-12 col-xs-12 padding_zero form_lable">New Password:</label>
	<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
	<?php echo form_password(array('name' => 'new_password', 'placeholder' => 'New Password ', 'id' => 'new_password', 'maxlength' => 45, 'value' => set_value('new_password'), 'class' => 'form-control' ));?>
	</div>
	<div class="col-sm-12 col-md-12 col-xs-12 padding_zero userpwdmsg form_error"><?php echo form_error('new_password'); ?></div>
	</div>  
	
	
	 <div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
	
	<label for="" class="col-sm-12 col-md-12 col-xs-12 padding_zero form_lable">Confirm Password:</label>
	<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
	<?php echo form_password(array('name' => 'confirm_password', 'placeholder' => 'Confirm Password ', 'id' => 'confirm_password', 'maxlength' => 45, 'value' => set_value('confirm_password'), 'class' => 'form-control' ));?>
	</div>
	<div class="col-sm-12 col-md-12 col-xs-12 padding_zero form_error"><?php echo form_error('confirm_password'); ?></div>
	</div>
	
	 <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
	<div class="col-sm-12 col-md-12 col-xs-12 padding_zero submit">
	<?php echo form_submit(array('name' => 'change_password','value' => 'Submit', 'class' => 'submit_btn'));?>
	</div>
	
	</div>

  
    <?php echo form_close(); ?>    


</div>
</div> 
</div>

</div>

</section>
</div>
</div>
  
 

    </div><!-- ./wrapper -->
  

<script>
$('#new_password').on('change',function() {
   	var password = $("#new_password").val();
	if(password.length > 10) {
		$('.userpwdmsg').text('Password must be 10 characters only');
	}else if(password.search(/\d/) == -1) {
		$('.userpwdmsg').text('Password must include a number');
	}else if(password.search(/[a-z]/) == -1) {  
		$('.userpwdmsg').text('Password must include an lowercase letter');
	}else if(password.search(/[A-Z]/) == -1) {
		$('.userpwdmsg').text('Password must include an uppercase letter'); 
	}else if(!(/^\S*$/).test(password)) {
		$('.userpwdmsg').text('Password must not start or end with a space');
	}else{  
		$('.userpwdmsg').text('');   
	} 
});   

$('#change_password_form').submit(function() {
	var password = $("#new_password").val();
	if(password.length > 10) {
		$('.userpwdmsg').text('Password must be 10 characters only');
		return false;
	}else if(password.search(/\d/) == -1) {
		$('.userpwdmsg').text('Password must include a number');
		return false;
	}else if(password.search(/[a-z]/) == -1) {  
		$('.userpwdmsg').text('Password must include an lowercase letter');
		return false;
	}else if(password.search(/[A-Z]/) == -1) {
		$('.userpwdmsg').text('Password must include an uppercase letter'); 
		return false;
	}else if(!(/^\S*$/).test(password)) {
		$('.userpwdmsg').text('Password must not start or end with a space');
		return false;
	}else{  
		$('.userpwdmsg').text('');  
		return true; 
	} 
});

</script>  
  </body>


</html>


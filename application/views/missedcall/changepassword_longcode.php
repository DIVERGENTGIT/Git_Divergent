<style type="text/css">
 body{     background-color: #ECF0F5;}
 section.sidebar {
    height: 600px !important;
}
 /*.form-group {
  margin-bottom: 6px !important;
}

 .info-box-content {
  padding: 5px 5px !important;
  margin-left: 80px !important;
}*/
.panel-body{background-color: #fff;}
.form dd{margin-left:0px !important;}
.form dl{margin:0px;}
 </style>
  <body>
    <div class="col-sm-9 col-md-9 col-xs-12 padding_zero">
      
      <!-- Left side column. contains the logo and sidebar -->

      <!-- Content Wrapper. Contains page content -->
      <div class="col-sm-12 col-md-12 col-xs-12">
        <!-- Content Header (Page header) -->
		 <div  class="">
        <!-- Main content -->
        <section>
        
       
          <!-- Info boxes -->
<?php if(isset($error)): ?>
	<div class="error_box">
	 	<?php echo $error; ?>
	</div>
<?php elseif(isset($changed)): ?>
	<div class="valid_box">
	 	<?php echo $changed; ?>
	</div>	
<?php endif; ?>
 
<div class="col-md-12 padding_ltrt" style="padding-top: 10px;">
<div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Change Password</strong></div>
<div  class="panel-body">
<div class="col-md-5">
<div class="form">
	<?php echo form_open('myaccount/changePassword',
					array('id' => 'change_password_form', 'name' => 'change_password_form', 'method' => 'post')
	); ?>
	<section>
	  <fieldset>

    	<dl>
        	<dt><label for="first_name">Current Password:</label></dt>
			<dd>
				<?php echo form_password(array('name' => 'current_password', 'placeholder' => 'Type Current Password ','id' => 'current_password', 'maxlength' => 45, 'value' => set_value('current_password'), 'class' => 'form-control' ));?>
				<div class="form_error"><?php echo form_error('current_password'); ?></div>
            </dd>
        </dl>
        <dl>
			<dt><label for="last_name">New Password:</label></dt>
			<dd>
				<?php echo form_password(array('name' => 'new_password', 'placeholder' => 'New Password ', 'id' => 'new_password', 'maxlength' => 45, 'value' => set_value('new_password'), 'class' => 'form-control' ));?>
				<div class="form_error"><?php echo form_error('new_password'); ?></div>
			</dd>
		</dl>
		 <dl>
			<dt><label for="last_name">Confirm Password:</label></dt>
			<dd>
				<?php echo form_password(array('name' => 'confirm_password', 'placeholder' => 'Confirm Password ', 'id' => 'confirm_password', 'maxlength' => 45, 'value' => set_value('confirm_password'), 'class' => 'form-control' ));?>
				<div class="form_error"><?php echo form_error('confirm_password'); ?></div>
			</dd>
		</dl>
		<dl class="submit">
        	<?php echo form_submit(array('name' => 'change_password','value' => 'Submit', 'class' => 'btn btn-default btn-sm'));?>
        </dl>
    </fieldset>
    <?php echo form_close(); ?>    

</section>
</div>
</div> 
</div>

</div>

</section>
</div>
</div>
  
 

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>
    
    <!-- jvectormap -->
    <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
   
    <!--<script type="text/javascript">
     $(document).ready(function(){
    
      var wow = new WOW(
  {
    boxClass:     'wow',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       0,          // distance to the element when triggering the animation (default is 0)
    mobile:       true,       // trigger animations on mobile devices (default is true)
    live:         true,       // act on asynchronously loaded content (default is true)
    callback:     function(box) {
      // the callback is fired every time an animation is started
      // the argument that is passed in is the DOM node being animated
    }
  }
);
wow.init();

   
			});
    </script>-->
    
  </body>
</html>


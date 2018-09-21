<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SMS Striker</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo base_url(); ?>assets/css/striker.min.css" rel="stylesheet" type="text/css" />
   
   
   
    <link href="<?php echo base_url(); ?>assets/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/css/custom-css.css" rel="stylesheet" type="text/css">

<style type="text/css">
hr {
  -moz-border-bottom-colors: none;
  -moz-border-image: none;
  -moz-border-left-colors: none;
  -moz-border-right-colors: none;
  -moz-border-top-colors: none;
  border-color: #ECF0F5 -moz-use-text-color #ECF0F5;
  
  color:#ECF0F5;
  border-style: solid none;
  border-width: 1px 0;
  margin: 18px 0;
}
.control-label{ text-align:right;}
</style>
  

 <script>
 $(document).ready(function(){
  $(function() {
    $(":file").filestyle({input: false});
  });
});
 </script>
 
 
 
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      
      <!-- Left side column. contains the logo and sidebar -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
               <!-- Main content -->
        <section class="content">
        <div class="col-md-12 col-md-12 col-xs-12 ng-scope" data-ng-controller="formConstraintsCtrl">
   <div class="panel panel-default">
            <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Reseller</strong></div>
			  
			  
			  
			  
         <div class="panel panel-default col-md-12" >
        
       
                      <div class="panel panel-default col-md-12"  style="top:10px;">
                     
                     
                     
                      <?php echo form_open('reseller/createUser',
					array('id' => 'add_user_form', 'name' => 'add_user_form', 'method' => 'post','class'=>'form-inline')
	); ?>
                     
  
  <div class="col-lg-10"  >
          <h4  style="color:#777; margin-bottom:10px !important; background-color:#F5F5F5; line-height:25px;  padding:5px 10px !important;">Account Details</h4>
        </div>
  
  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="username">Username:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span> 
    <?php echo form_input(array('name' => 'username', 'id' => 'username', 'value' => set_value('username'), 'class' => 'form-control',)); ?>
    	<div class="form_error"><?php echo form_error('username'); ?></div>
     </div>
  </div>
  
  
  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="password">Password :</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span> 
    	<?php echo form_password(array('name' => 'userpass', 'id' => 'userpass', 'value' => set_value('userpass'), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('userpass'); ?></div>
   
     </div>
  </div>
 
 
 
 
  <div class="clearfix"></div>
 
 
 
       <hr>
 
 
 

 <div class="col-lg-10" >
  <h4  style="color:#777;   margin-bottom:20px !important; background-color:#F5F5F5; line-height:25px;  padding:5px 10px !important;">Contact Details</h4>
 </div>
 
 
  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="first_name">First Name:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span> 
 
    <?php echo form_input(array('name' => 'first_name', 'id' => 'first_name', 'maxlength' => 45, 'value' => set_value('first_name'), 'class' => 'form-control' ));?>
      <div class="form_error"><?php echo form_error('first_name'); ?></div>
     </div>
  </div>
  
  
  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="last_name">Last Name:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span> 
	<?php echo form_input(array('name' => 'last_name', 'id' => 'last_name', 'maxlength' => 45, 'value' => set_value('last_name'), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('last_name'); ?></div>
     </div>
     <div style=" margin-bottom:20px;"><!--singil--></div><!--singil-->
  </div>

  
 
  
   <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="email">Email:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span> 
  <?php echo form_input(array('name' => 'email', 'id' => 'email', 'maxlength' => 45, 'value' => set_value('email'), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('email'); ?></div>
     </div>
  </div>
  
  
  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="email">Mobile:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class=" glyphicon glyphicon-phone"></span></span> 
 <?php echo form_input(array('name' => 'mobile', 'id' => 'mobile', 'maxlength' => 45, 'value' => set_value('mobile'), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('mobile'); ?></div>
     </div>
     <div style=" margin-bottom:20px;"><!--singil--></div><!--singil-->
  </div>
 
 
 
 
 <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="address1">Address1:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></span> 
	<?php echo form_input(array('name' => 'address1', 'id' => 'address1', 'maxlength' => 45, 'value' => set_value('address1'), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('address1'); ?></div>     </div>
  </div>
  
  
  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="address2">Address2:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></span> 
  	<?php echo form_input(array('name' => 'address2', 'id' => 'address2', 'maxlength' => 45, 'value' => set_value('address2'), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('address2'); ?></div>
     </div>
     <div style=" margin-bottom:20px;"><!--singil--></div><!--singil-->
  </div>
 
 
 <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="city">City:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></span> 
   	<?php echo form_dropdown('city_id', $cities, set_value('city_id'), 'class = "form-control"'); ?>
                        	<div class="form_error"><?php echo form_error('city_id'); ?></div>
     </div>
  </div>
  
  
  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="pincode">Pin/Zip Code:</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-th-list"></span></span> 
   <?php echo form_input(array('name' => 'pincode', 'id' => 'pincode', 'maxlength' => 45, 'value' => set_value('pincode'), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('pincode'); ?></div>
     </div>
     <div style=" margin-bottom:20px;"><!--singil--></div><!--singil-->
  </div>
  
  
  
 <div class="col-lg-10" >
  <h4  style="color:#777; background-color:#F5F5F5; margin-bottom:20px !important;  line-height:25px;  padding:5px 10px !important;">SMS Credits</h4>
 </div>
  
  
  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="no_of_sms">No.of SMS :</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-th-list"></span></span> 

    	<?php echo form_input(array('name' => 'no_of_sms', 'id' => 'no_of_sms', 'maxlength' => 45, 'value' => set_value('no_of_sms'), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('no_of_sms'); ?></div>
     </div>
  </div>
  
  
  <div class="form-group col-md-5">
    <label class="control-label col-sm-4" for="email">Price :</label>
    <div class="col-md-8 input-group input-group-sm">
    <span class="input-group-addon"><span class="glyphicon glyphicon-usd"></span></span> 
   <?php echo form_input(array('name' => 'price', 'id' => 'price', 'maxlength' => 45, 'value' => set_value('price'), 'class' => 'form-control' ));?>
                        	<div class="form_error"><?php echo form_error('price'); ?></div>
     </div>
     <div style=" margin-bottom:20px;"><!--singil--></div><!--singil-->
  </div>
 
 <div class="form-group col-md-12">
   
    <div class="col-md-8 " style="float:right;;">
                       		<?php echo form_submit(array('name' => 'register','value' => 'Create User', 'class' => 'btn btn-default'));?>

    </div>
  </div>       
 
   <?php echo form_close(); ?>

        </div>
    
     <div class="col-md-12" style="padding:20px;"></div>   
      
  </div>
           
        </div>
        </section>
                   
<div class="clearfix"></div>


      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class='control-sidebar-menu'>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class='control-sidebar-menu'>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-waring pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->

          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked />
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right" />
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url(); ?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
   
    <script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url(); ?>dist/js/pages/dashboard2.js" type="text/javascript"></script>

    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>assets/js/demo.js" type="text/javascript"></script>
  </body>
</html>
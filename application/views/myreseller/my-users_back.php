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

   <link href="<?php echo base_url(); ?>assets/css/table.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

 <script>
 $(document).ready(function(){
  $(function() {
    $(":file").filestyle({input: false});
  });
});
 </script>
 
<style type="text/css">

.T-Color:hover{ text-decoration:underline;}
.T-Color{ color:#F60; }
</style>
 
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!--<section class="content-header">
          <h1>
         
            <small>SMS Striker</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>-->

        <!-- Main content -->
        <section class="content">
      
         <div class="panel panel-default">
              <!--  <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Reports</strong></div>-->
			  
			  
			  
		
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span>Create User</strong></div>
                         <div class="panel panel-default col-md-12" >
                            
                          
                          
                          
                          <div class="box" >
                <div class="box-header">
                  <h3 class="box-title">Data Table With Full Features</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="sendee-color">Sc No</th>
                        <th class="sendee-color">User Name</th>
                        <th class="sendee-color">First Name</th>
                        <th class="sendee-color">Registered On</th>
                        <th class="sendee-color">Last Login</th>
                         <th class="sendee-color">Balance</th>
                          <th class="sendee-color">Add Balance</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?php 
		$count=1;
		foreach($users as $user) :		 
	?>
                      <tr>
                      <td><?php echo $count; ?></td>
                        <td><?php echo $user->username; ?></td>
                        <td><?php echo $user->first_name; ?></td>
                        <td><?php echo $user->registered_on; ?></td>
                        <td><?php if($user->login_time) { echo $user->login_time; } else { echo "---"; } ?></td>
                        <td><?php echo $user->available_credits; ?></td>
                        <td> 
                        <a  href="<?php echo site_url('/reseller/addBalance/'.$user->user_id)?>" class="T-Color"  data-toggle="modal" data-target="#Creat-user-Modal">Add Balance</a>
                        
                        </td>
                                               
                      </tr>
                      
                  <?php
					 
	$count++; 
	endforeach;
	?>
                    </tbody>
                  
                  </table>
                </div><!-- /.box-body -->
              </div>
                          
                          
                          
                           
	  <!--Creat-user-Modal small modal start -->
	   
	   
	   
	   <div id="Creat-user-Modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">User Payments</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="<?php $_SERVER['PHP_SELF'];?>index.php/reseller/addBalance" name="add_sms_form">
        <div class="form-group">
            <label for="inputEmail" class="control-label col-xs-3">No. Of SMS :</label>
            <div class="col-xs-9">
                <input type="text" class="form-control" id="no_of_sms" placeholder="No. Of SMS" name="no_of_sms">
            </div>
        </div>
        <div class="form-group">
            <label for="form_error" class="control-label col-xs-3">Price :</label>
            <div class="col-xs-9">
                <input type="text" class="form-control" id="resellers_user_id" name="resellers_user_id" value="" placeholder="Price">
            </div>
        </div>
            <div class="col-xs-offset-3 col-xs-9">
                <button type="submit"  class="btn btn-primary">Add Balance</button>
            </div>
  
                 </form>
                 <div class="box" >
                <div class="box-header">
                  <h3 class="box-title">Total User Payments Data</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1_1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="sendee-color">Sc No</th>
                        <th class="sendee-color">On Date</th>
                        <th class="sendee-color">No. of SMS</th>
                        <th class="sendee-color">Price/SMS</th>
                        <th class="sendee-color">Total Amount</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                       <td>1</td>
                        <td>2015-07-31 10:20:32</td>
                        <td>5454</td>
                        <td>0.12</td>
                        <td>0.6</td>
                      </tr>
                    </tbody>
                   
                  </table>
                </div><!-- /.box-body -->
              </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"  data-dismiss="modal">Cancel</button>
                   
                </div>  </div>
            </div>
        </div>
    
</div></div></section></div></div>
                   
<div class="clearfix"></div>

           <!--footer starts-->

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
   
  
    
    
     <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script> 
    
    
    
    
    
    
   <!-- model data table js code-->
    
    
     <script type="text/javascript">
      $(function () {
        $("#example1_1").dataTable();
        $('#example2_2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script> 
  </body>
</html>
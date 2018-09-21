<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SMS Striker</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="assets/css/striker.min.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    
    <link href="assets/css/jquery.datetimepicker.css" type="text/css" rel="stylesheet">
    
    <link href="assets/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    
    <link href="assets/css/custom-css.css" rel="stylesheet" type="text/css">
    
    <link href="assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css">
    
    <link href="assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css">

   
 
    <!-- jQuery 2.1.4 -->
    <script src="assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="assets/js/app.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="assets/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
  
   
   

  
	
      <!-- InputMask -->
    <script src="assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="assets/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="assets/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script> 
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    
    <!-- bootstrap time picker -->
    <script src="assets/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    

 
 
 
  </head>
  <body>
    <div class="col-sm-9 col-md-9 col-xs-12 padding_zero">

       <?php require_once('includes/header.php');?>
      <!-- Left side column. contains the logo and sidebar -->
            <?php require_once('includes/leftmenu.php');?>


      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>SURENDER</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="col-md-12 ng-scope" data-ng-controller="formConstraintsCtrl">
            <div class="panel panel-default">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Long Code</strong></div>
                <div class="panel-body">
                
                <dl class="dl-horizontal" style=" ">
                
               
              
            </dl>
            
            
               
                
                
                
                
                    
                </div>
            </div>
        
        
         <div class="panel panel-default">
        <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Long Code Report</strong></div>
        <h2>SMS Delivery Report</h2>
	<div class="form">
   <?php /*?> <?php
	$file_type_options = array(
                  'xls'  => 'Excel',
                  'txt'    => 'Text',
                );	
	?>
   File Format :  <?php echo  form_dropdown('file_format', $file_type_options , 'all' ,'class="selectText"');?> &nbsp;<?php */?>
    
	<?php if($detailed_dlr_report==1)
	{
	?> <a href="<?php echo site_url('campaign/downloadDlrReport_new/'.$campaign_id); ?>" class="bt_green"><span class="bt_green_lft"></span><strong>Download Report</strong><span class="bt_green_r"></span></a>	 
    <?php } else { ?>
    <a href="<?php echo site_url('campaign/downloadDlrReport/'.$campaign_id); ?>" class="bt_green"><span class="bt_green_lft"></span><strong>Download Report</strong><span class="bt_green_r"></span></a>	 
    <?php } ?>
	
	<br/>
	
    <?php 
			$dnd_count=0;
			$delivered_count=0;
			$invalid_nos_count=0;
			$out_of_range_count=0;
			$memory_capacity_exceeded_count=0;
			$network_error_count=0;
			$barring_count=0;
			$dnd_count=0;
			$invalid_number_length_count=0;
			$dest_no_empty_count=0;
			$multiple_submit_count=0;
			$account_expired_count=0;
			$delivery_failure_count=0;
			$misc_error_count=0;
			$dropped_count=0;
			$invalid_sender_ids_count=0;
			$mobile_equipment_error_count=0;
			$pending_dlrs_count=0;
			$total_count=0;
			foreach($dlr_report as $dlr):
				$total_count++;	 
 			if($dlr->dlr_status==3)
			{
				$dnd_count++;
			}
			//if($dlr->dlr_status==1 or $dlr->dlr_status=='0'  ) [Change1] ref: Excel point1, mail subject : Technical Works To Be Done
										//Line commented on 16 July 2014
			if($dlr->dlr_status==1) // [Change1] Updates for  16 July 2014
			{
				$delivered_count++;
			}
			
			//if($dlr->dlr_status=="") //[Change1] Line commented on 16 July 2014
			if($dlr->dlr_status=="" or $dlr->dlr_status=='0')//[Change1]New if cond added on 16 July 2014
			{ 
				$pending_dlrs_count++; //[Change1] uncommented line on 16 july 2014
				//$delivered_count++;
			}
			if($dlr->dlr_status==16 && ($dlr->error_code=='1080' || $dlr->error_code=='1081' || $dlr->error_code=='NULL' || $dlr->error_code==''))
			{
				$invalid_nos_count++;
			}
			if($dlr->dlr_status==16 && $dlr->error_code=='1077')
			{
				$multiple_submit_count++;
			}
					
			if($dlr->dlr_status==2)
			{

				if($dlr->error_code=='001' || $dlr->error_code=='005' )
					$invalid_nos_count++;
				if($dlr->error_code=='1080')
					$invalid_nos_count++;
				if($dlr->error_code=='002' || $dlr->error_code=='027' || $dlr->error_code=='203' )
					$out_of_range_count++;	
				if($dlr->error_code=='003' || $dlr->error_code=='013' || $dlr->error_code=='412')
					$memory_capacity_exceeded_count++;	
				if($dlr->error_code=='004' || $dlr->error_code=='012')
					$mobile_equipment_error_count++;							
				if($dlr->error_code=='005' || $dlr->error_code=='161' || $dlr->error_code=='034')
					$network_error_count++;	
				if($dlr->error_code=='006')
					$barring_count++;	
				if($dlr->error_code=='1077' || $dlr->error_code=='411')
					$multiple_submit_count++;	
				if($dlr->error_code=='1078' || $dlr->error_code=='478' || $dlr->error_code=='1032' )
					$dnd_count++;	
				if($dlr->error_code=='100' || $dlr->error_code=='410' || $dlr->error_code=='409' || $dlr->error_code=='404' || $dlr->error_code=='205' || $dlr->error_code=='204' || $dlr->error_code=='202' || $dlr->error_code=='201' || $dlr->error_code=='200' || $dlr->error_code=='196' || $dlr->error_code=='195' || $dlr->error_code=='194' || $dlr->error_code=='193' || $dlr->error_code=='192' || $dlr->error_code=='178' || $dlr->error_code=='177' || $dlr->error_code=='176' || $dlr->error_code=='167' || $dlr->error_code=='166' || $dlr->error_code=='165' || $dlr->error_code=='164' || $dlr->error_code=='163' || $dlr->error_code=='162' || $dlr->error_code=='161' || $dlr->error_code=='160' || $dlr->error_code=='146' || $dlr->error_code=='145' || $dlr->error_code=='144' || $dlr->error_code=='036' || $dlr->error_code=='035' || $dlr->error_code=='034' || $dlr->error_code=='032' || $dlr->error_code=='031' || $dlr->error_code=='021' || $dlr->error_code=='011')						
					$misc_error_count++;	
					//echo "Test". $dlr->error_code;
					//exit;

					
					
			}
			

			endforeach;
	?> 
    
<style>
	#rounded-corner{ width:656px;	}
</style>
    
    <table id="rounded-corner" summary="SMS Campaign's Report">
    <thead>
    	<tr>
		 <th scope="col" class="rounded-company" colspan="2">DLR Status</th>
		 <th scope="col" class="rounded-q4" colspan="2">&nbsp;</th>
		</tr>
	</thead>
    <tr>
		<td>Delivered</td>
		<td><?php echo $delivered_count; ?></td>
		<td>Invalid Number</td>
		<td><?php echo $invalid_nos_count; ?></td>
    </tr>    
    <tr>
		<td >Out of Range or Switched Off</td>
		<td><?php echo $out_of_range_count; ?></td>
		<td>Memory Capacity Exceeded</td>
		<td><?php echo $memory_capacity_exceeded_count; ?></td>
        
    </tr>    

      

    <tr>
		<td>Mobile Equipment Error</td>
		<td><?php echo $mobile_equipment_error_count; ?></td>
		<td>Network Error</td>
		<td><?php echo $network_error_count; ?></td>
    </tr>    
      

    <tr>
		<td>Barring</td>
		<td><?php echo $barring_count; ?></td>
		<td>Invalid Sender ID</td>
		<td><?php echo $invalid_sender_ids_count; ?></td>
    </tr>    

       

    <tr>
		<td>Dropped</td>
		<td><?php echo $dropped_count; ?></td>
		<td>Misc. Error</td>
		<td><?php echo $misc_error_count+$delivery_failure_count; ?></td>
    </tr> 
      

    <tr>
	<!--	<td >Delivery Failure (used for data_sm_resp)</td>
		<td><?php echo $delivery_failure_count; ?></td>-->
		<td>Account Expired</td>
		<td><?php echo $account_expired_count; ?></td>
    </tr>    

  
    <tr>
		<td>Same Msg submit to multiple times</td>
		<td><?php echo $multiple_submit_count; ?></td>
		<td>DND Number</td>
		<td><?php echo $dnd_count; ?></td>
    </tr> 
      
      <tr>
		<td nowrap>Either Source or Destination number is empty</td>
		<td><?php echo $dest_no_empty_count; ?></td>
		<td>Invalid Number Length</td>
		<td><?php echo $invalid_number_length_count; ?></td>
    </tr> 
     
    <tr>
		<td>Pending DLRs</td>
		<td><?php echo $pending_dlrs_count; ?></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
    </tr> 
    <tr bgcolor="#897976">
		<td ><strong>Total </strong></td>
		<td>&nbsp;</td>
		<td ><strong>  &nbsp; </strong></td>
		<td><strong><?php echo $total_count; ?></strong></td>
    </tr>           
   </table>
   
<!--   dispaly numbers ols style -->




	<table id="rounded-corner" summary="SMS Campaign's Report">
    <thead>
    	<tr>
		 <th scope="col" class="rounded-company"></th>
		 <th scope="col" class="rounded">Mobile No</th>
		 <th scope="col" class="rounded">Sent time</th>
		 <th scope="col" class="rounded">Delivery time</th>
		 <th scope="col" class="rounded-q4">DLR Status</th>
		</tr>
	</thead>
    
                        

	<tfoot>
    	<tr>
        	<td colspan="4" class="rounded-foot-left">&nbsp;</td>
        	<td class="rounded-foot-right">&nbsp;</td>
        </tr>
    </tfoot>
	<tbody>
	<?php 
		$count= $offset + 1;
		foreach($dlr_report_old as $dlr):		 
	?>
	<tr>
		<td><?php echo $count; ?></td>
		<td><?php echo $dlr->to_mobile_no; ?></td>
		<td><?php echo $dlr->sent_on; ?></td>
		<td><?php echo $dlr->delivered_on; ?></td>
		<td>
            <?php
            //if(strlen($dlr->to_mobile_no) < 10): //[Change1] two lines were commented on July 16 2014
            //    echo "Invalid Number";
            //elseif($dlr->dlr_status == "" || $dlr->dlr_status == 0 || $dlr->dlr_status == 1):
            // [Change1] Above line commented on 16 July 2014
            // [Change1] Below if added on 16 July 2014
            //elseif($dlr->dlr_status == 1): [Change1] Line commented on 16 July 2014
            if($dlr->dlr_status == 1):
                echo "Delivered";
                //elseif($dlr->dlr_status == 1) :
                //echo "Delivered";
                // [Change1] below two line uncommented on 16 July 2014
            elseif($dlr->dlr_status == "" || $dlr->dlr_status == 0) :
                echo "Pending DLR";
            elseif($dlr->dlr_status == 16 && ($dlr->error_code=='1080' || $dlr->error_code=='1081' || $dlr->error_code=='NULL' || $dlr->error_code=='')):
                echo "Invalid Number";
                elseif($dlr->dlr_status==16 && $dlr->error_code=='1077'):
                echo "Same Msg submit to multiple times";
            else:
                if($dlr_report_type == 0):
                    echo "Delivered";
                elseif(($dlr_report_type != 0) && $dlr->dlr_status == 3):
                    echo "DND Number";
                elseif($dlr_report_type == 2):
                    if($dlr->dlr_status == 2):
                        echo "Failed - " . $dlr->error_text;
                    elseif($dlr->dlr_status == 4):
                        echo "Queued at SMSC - " . $dlr->error_text;
                    endif;
                else:
                    echo "Delivered";
                endif;
            endif;
            ?>
		</td>		 	
	</tr>
		 
	<?php 
	$count++; 
	endforeach;
	?>
	</tbody>
	</table>
	<div align='left' class="back">
		<a href="<?php echo site_url('campaign/viewcampaigns/'); ?>" class="bt_green"><span class="bt_green_lft"></span><strong>Back</strong><span class="bt_green_r"></span></a>	 
	</div>
		 <div align='center' class="pagination">
		<?php echo $this->pagination->create_links(); ?>
		</div>
</div>
    </div>
        </div>
        </section>
        
      
       
	  
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
	   
        
        
        
        
        
      
      
   





                   
<div class="clearfix"></div>




           <!--footer starts-->                 <?php //require_once('includes/footer.php');?>



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
      </aside>
      <!----><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->

	
	
  </body>
  
  
  <script type="text/javascript">
  
      $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                  ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                    'Last 7 Days': [moment().subtract('days', 6), moment()],
                    'Last 30 Days': [moment().subtract('days', 29), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                  },
                  startDate: moment().subtract('days', 29),
                  endDate: moment()
                },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });
	  
    </script> 
  
 
</html>
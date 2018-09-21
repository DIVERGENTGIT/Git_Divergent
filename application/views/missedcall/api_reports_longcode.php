<script>
 $(document).ready(function(){
  $(function() {
    $( "#datepicker" ).datepicker();
  });
});
 </script>
 
 <style type="text/css">
 .panel {
    
    margin-bottom: 0px;}
table#rounded-corner {
    
    margin-left: 0px !important;
}	
 

.table-nonfluid {
   width: auto !important;
   margin:0px 10px !important;
}
th.sendee-color {
    max-width: 160px !important;
    min-width: 162px !important;
}
th .sendee-color {
    padding: 6px 50px !important;
}
td.tdee {
   
    padding: 6px 10px !important;
}
       /*  date picker  */

button.cancelBtn.btn.btn-small.btn-sm.btn-default {
    margin-top: 22px !important;
	    margin-left: 7px;
}
button.applyBtn.btn.btn-small.btn-sm.btn-success {
    margin-top: 22px !important;
    margin-left: 12px !important;
}
button.applyBtn.btn.btn-small.btn-sm.btn-success {
    background-color: #357EBD !important;
    border-color: #215A94 !important;
}
.daterangepicker.dropdown-menu.show-calendar.opensleft {
    margin-left: 248px !important;
	 
}
.ranges {
    width: 330px !important;
}
button.cancelBtn.btn.btn-small.btn-sm.btn-default {
    margin-top: 22px;
}
 #rounded-corner{width: 100% !important;}
  #rounded-corner th{color:#000;}
  #sms_api_search input{
    margin: 0px !important;
}
 </style>

  <body>
    <div class="col-sm-9 col-md-9 col-xs-12 padding_zero">

      <!-- Left side column. contains the logo and sidebar -->


      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       

        <!-- Main content -->
        <section>
        <div class="col-sm-12 col-md-12 col-xs-12 ng-scope" data-ng-controller="formConstraintsCtrl">
            <div class="panel panel-default">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> API Report</strong></div>
                <div class="panel-body">
                
                <dl class="dl-horizontal" style=" ">
                
               
              
            </dl>
            
          <?php //echo form_open('api/reports',array('name' => 'sms_api_search', 'id' => 'sms_api_search')); ?>
  <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>missedcall/smsapi_report" name="sms_api_search" id="sms_api_search" method="post" >

                <div class="form-group">
                    <label for="" class="col-sm-2" style="text-align:right;">From Date - To Date</label>
                    <div class="col-sm-4">
                        <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
					  <?php //echo form_input(array('name' => 'rangeA', 'id' => 'reservationtime','placeholder' => 'Pick Hear Date ','class' => 'form-control pull-right active', 'value' => set_value('rangeA')))?>
                      <input type="text" name="rangeA" class="form-control pull-right active" id="reservationtime">
                    </div>
                    </div>
                    <div class="col-sm-2">
					<?php //echo form_submit(array('name' => 'Search','value' => 'Submit', 'style' => '', 'class' => 'btn btn-sm btn-default'));?>
                    
                     <button  type="submit" class="btn btn-default btn-sm">
	  
Search</button>
	  
                     
                    </div> 
                </div>
              

                  
</form>
                
        		 <?php //echo form_close();?>

                
                
                
                
                    
                </div>
            </div>
        
        
         <div class="panel panel-default">
        
		

		 </div>
		 <!--<br></br>-->
		 <table id="rounded-corner" class="table table-nonfluid table-bordered table-striped  no-footer"  style="background-color:#fff;"summary="SMS API sms_api's Report">
		 <thead>
		 <tr>
		 <th scope="col" style="width:15px;" class="sendee-color"> Sl. No</th>
		 <th scope="col" class="sendee-color">On Date</th>
		 <th scope="col" class="sendee-color">No. of SMS</th>
		<th scope="col" class="sendee-color">View</th>
		 <th scope="col" class="sendee-color">Download</th>
		 </tr>
		 </thead>
		<!-- <tfoot>
    	<tr>
        	<td colspan="3" class="rounded-foot-left">&nbsp;</td>
        	<td class="rounded-foot-right">&nbsp;</td>

        </tr>
    	</tfoot>-->
		<tbody>
		 <?php 
		 $count=0;
		 foreach($api_data as $sms_api) {		
		 	 $count=$count+1; 
		 ?>
		 	<tr>
		 	<td class="tdee" width='15'><?php echo $count; ?></td>
		 	<td class="tdee"><?php echo $sms_api['ondate']; ?></td>
		 	<td class="tdee"><?php echo $sms_api['noofmsg']; ?></td>
            
<td class="tdee"> <a href="<?php echo site_url('api/apiview/'.$sms_api['ondate'])?>">View</a></td>	
              <td class="tdee"> <a href="<?php echo site_url('api/download_report/'.$sms_api['ondate'])?>">Download</a></td>		 	
		 	</tr>
		 
		 <?php 
		 }
		 ?>
		 </tbody>
		 </table>
		<?php echo $this->pagination->create_links(); ?>

		

       
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
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class='control-sidebar-bg'></div>
<script src="<?php echo base_url();?>/js/jquery.ui.datetimepicker.min.js" type="text/javascript"></script>

     
<script type="text/javascript">
$(document).ready( function(){
	 $('#from_date').datetimepicker({	
		 	dateFormat: 'yyyy-mm-dd'
	 });

	 $('#to_date').datetimepicker({	
		 	dateFormat: 'yyyy-mm-dd'
	 });
});
</script>
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
   
   

  
	
      <!-- InputMask -->
    <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script> 
    <!-- date-range-picker -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo  base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    
    <!-- bootstrap time picker -->
    <script src="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
    
	
	
  </body>
  
  <script>

  
      $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY-MM-DD'});
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
          $('#reportrange span').html(start.format('YYYY D, MM') + ' - ' + end.format('YYYY D, MM'));
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

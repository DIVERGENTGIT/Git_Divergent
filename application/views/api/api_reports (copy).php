<div class="col-md-9 col-sm-9 col-xs-12 main-right-div">
 <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/reports-icon.png" class="right-title-img"> API Report</h3>
</div>			
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">

  <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>index.php/api/reports" name="sms_api_search" id="sms_api_search" method="post" >

                <div class="form-group">
                    <label for="" class="col-sm-2" style="text-align:right;">From Date - To Date</label>
                    <div class="col-sm-3 padding_zero">
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
</div>
            </div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
		<table class="table_all">
		 <thead>
		 <tr>
		 <th>Sl. No</th>
		 <th>On Date</th>
		 <th>No. of SMS</th>
		<th>View</th>
		 <th>Download</th>
		 </tr>
		 </thead>
		
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
            
            <td class="tdee"> <a href="<?php echo site_url('api/apiviewreport/'.$sms_api['ondate'])?>">View</a></td>	
              <td class="tdee"> <a href="<?php echo site_url('api/download_report/'.$sms_api['ondate'])?>">Download</a></td>		 	
		 	</tr>
		 
		 <?php 
		 }
		 ?>
		 </tbody>
		 </table>
</div>

		

       
    </div>
        </div>
 </div>
        
  

    </div><!-- ./wrapper -->


	 <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
    $(document).ready(function() {
    $('#rounded-corner').DataTable( {
       lengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
       pageLength: 10,
	   info: false,
		bLengthChange: false,
        filter: false
    } );
} );
        </script>
	
	
  
   <!-- pagination End -->
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

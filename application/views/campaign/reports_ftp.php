
  
    <script src="<?php echo  base_url(); ?>assets/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo  base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>
  
     <!-- InputMask -->
  <script src="<?php echo  base_url(); ?>assets/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="<?php echo  base_url(); ?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="<?php echo  base_url(); ?>assets/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script> 
    <!-- date-range-picker -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>

    <script src="<?php echo  base_url(); ?>assets/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- bootstrap color picker -->
    
    <!-- bootstrap time picker -->
    
 <script src="<?php echo  base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo  base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/reports-icon.png" class="right-title-img">Ftp Reports</h3>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<form class="form-horizontal col-md-12 col-sm-12 col-xs-12 padding_zero form-div" role="form" action="<?php echo base_url(); ?>ftpcampaign/viewcampaigns/" name="campaign_search" id="campaign_search" method="post" >
<ul class="search-list05 missedcall_allform">
<li><input type="text" id="from_date"  name="from_date" value="<?php if($from_date){echo $from_date;} ?>" placeholder=" " class="data-pickerbg"></li>
<li><input type="text" id="to_date" name="to_date" value="<?php if($to_date){echo $to_date;} ?>"   placeholder=" " class="data-pickerbg"></li>
<li> 
   
<select name="sender">     
 <option value="">Select Sender Id</option>  
<?php 
	foreach($sender_names as $sender) {  
 ?>
  	<option value="<?php echo $sender;?>" <?php if($sender == $sender_name) { echo 'selected';} ?> > <?php echo $sender; ?>
	</option>    
 <?php 
}  ?> 
</select>    
 
  </li>
<li><input  type="submit" class="submit_btn" name="submit"></li>
</ul>

</form>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
   <!-- <p style="font-size: 12px;"> * Reports from  <b><?php echo date('Y-m-d', time()-60*60*48 );?> </b> only can be viewed / downloaded through search option</p> -->
 </div>
</div>

               <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
                  <table class="table_all" >
                    <thead>  
                      <tr>
					   <th class="sendee-color" >SL.No</th>
                        <th class="sendee-color" style="text-align:center; "> Date</th>
                        <th class="sendee-color" style="text-align:center; ">Sender</th>
<!--						<th class="sendee-color" style="text-align:center; ">Campaign Name</th>
-->
                        
                          <th class="sendee-color" style="text-align:center; width:250px !important; important;">SMS Text</th>

                        <th class="sendee-color" style="text-align:center; ">No. of SMS</th>
                        <th class="sendee-color" style="text-align:center; ">Status</th>
<!--                        <th class="sendee-color" style="text-align:center; ">View</th>
-->						  <th class="sendee-color" style="text-align:center; ">Reports</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php 
		$count=0;
		if(!empty($per_page)){
	$count=$count+$per_page;
	}

		foreach($campaigns as $campaign){		 
		$user_id=$campaign->user_id;
	$count++;
	
		
			
				$cur_date = date('Y-m-d H:i:s');
		//		$days_diff = $this->daysDifference($cur_date, $campaign->created_date_time);
				
		 $month1 = substr($campaign->created_date_time,5,2);
         $day1 = substr($campaign->created_date_time,8,2);
        $year1 = substr($campaign->created_date_time,0,4);

        $month2 = substr($cur_date,5,2);
        $day2 = substr($cur_date,8,2);
        $year2 = substr($cur_date,0,4);
  
        $date1 = mktime(0,0,0,$month1,$day1,$year1);
        $date2 = mktime(0,0,0,$month2,$day2,$year2);

        if($date1 > $date2){
           $dateDiff = $date1 - $date2;
        } else {
           $dateDiff = $date2 - $date1;
        }
        $fullDays = floor($dateDiff/(60*60*24));    
	

  $campaigns_report = $this->ftp_campaign_model->get_all_ftp_smsreports_basedoncampaign($campaign->campaign_id, $fullDays, $campaign->created_date_time);


	 
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
			
			
	?>
                      <tr style="height:30px !important;" >
                        <td><?php echo $count; ?></td>  
                        <td style="width:130px!important;"><?php echo $campaign->created_date_time; ?>
                         </td>
                        <td><?php echo $campaign->sender_id; ?></td>
<!--<td><?php echo $campaign->campaign_name; ?></td>
-->
<td style="width:200px !important important;">  <p class="row-fluid alert alert- alert-dismissable " data-toggle="tooltip" data-placement="bottom" title="" 

  data-original-title="<?php echo htmlspecialchars($campaign->sms_text); ?>" >
<?php	 
$array = str_split($campaign->sms_text,50);
echo $array[0];
?>
             </p> </td>
                        <td><?php echo $campaign->no_of_messages;  
                        
 
$delivered_count =  $campaigns_report[0]['delivered_count']?$campaigns_report[0]['delivered_count']:0;
$expired_count =  $campaigns_report[0]['expired_count']?$campaigns_report[0]['expired_count']:0;
$dnd_count = $campaigns_report[0]['dnd_count']?$campaigns_report[0]['dnd_count']:0;
$pending_dlr_count =  $campaigns_report[0]['pending_dlrs_count']?$campaigns_report[0]['pending_dlrs_count']:0;
$invalid_count =  $campaigns_report[0]['invalid_count']?$campaigns_report[0]['invalid_count']:0;   
							  
                         ?>
                    <div class="btn-group" >
                <span data-toggle="dropdown" style="margin-left:10px; cursor:pointer;" class="dropdown-toggle "><i class="fa fa-eye" style="font-size:16px; color:#777;"></i> </span>
                <ul class="dropdown-menu bullet pull-middle pull-left"  style=" padding:5px; width:250px; margin-top: -72.5px; margin-left: 34px; background-color:#fff;">
       <table cellpadding="0" cellspacing="0" border="0" class="table  table-bordered" id="example" style="margin-bottom:0px !important;">
    
      
	    <tbody>
		<tr style="width:200px; background-color:#EFEFEF;" class="odd gradeX">  
			<td  style="width:200px; ">Delivered</td>
			<td style="width:50px; "><?php echo $delivered_count; ?></td>
			
		</tr>
		<tr style="width:200px; background-color:#F5F5F5;" class="even gradeC">
			<td  style="width:200px;">DND</td>
			<td  style="width:50px;"><?php echo $dnd_count; ?></td>
			
		</tr>
          
		<tr style="width:200px; background-color:#EFEFEF;" class="odd gradeX">
			<td style="width:200px;">Pending</td>
			<td style="width:50px;"> <?php echo $pending_dlr_count; ?></td>
			
		</tr>
      
		<tr style="width:200px; background-color:#EFEFEF;" class="odd gradeX">
			<td style="width:200px;">Failed Numbers</td>
			<td style="width:50px;"> <?php echo $expired_count+$invalid_count; ?></td>
			
		</tr>
      
        </tbody>
        </table>
                  
                  
                </ul>
              </div> 
              
              
              
             
              </td>
 
                         <td><?php 
		 	if($campaign->status == 0):
		 		echo "Processing";
		       elseif($campaign->status == 1 && $campaign->is_scheduled == 1):
		 		echo "Scheduled@ ". $campaign->scheduled_on ;
		 	else:
		 		echo "Done";
		 	endif;
		 ?>
         
           
         </td>
         
        <!-- <td> 
         <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#" ><a href='<?php echo site_url('/campaign/viewReport/campaign/'.$campaign->campaign_id);?>'>View</a>  </button>
        
         
         </td>-->
         
         
		   <td>
			
				<a href="<?php echo site_url('ftpcampaign/viewReport/campaign/'.$campaign->campaign_id);?>" class="btn_cls01">	<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#" >View  </button></a>
         
		 	 <a class="btn btn-sm btn-default btn_cls01" href="<?php echo site_url('ftpcampaign/download_dlr_report/'.$campaign->campaign_id);?>">Download
			 </a>  
                      </td>
		  <?php 
		  }
	?>
                      </tbody>
                    </tfoot>
                  </table>
		<?php echo $this->pagination->create_links(); 
		?>
	
                </div><!-- /.box-body -->
            

          </div><!-- /.row -->

      </div><!-- /.content-wrapper -->


<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.1','packages':['corechart']}]}"></script>

	  <script type="text/javascript">
 
          $(document).ready(function() {  

    $('#example1').DataTable( {
       lengthMenu: [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
       paging: false,
	   info: false,
		bLengthChange: false,
        filter: false,
		fnDrawCallback:function(){
if (Math.ceil((this.fnSettings().fnRecordsDisplay()) / this.fnSettings()._iDisplayLength) > 1) {
$('#example_wrapper .dataTables_paginate').css("display", "block");	
} else {
$('#example_wrapper .dataTables_paginate').css("display", "none");
}
}
    } );
} );
    </script>                                      
     
		  
	<script type="text/javascript">
      $(function () {
		
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("yyyy-mm-dd", {"placeholder": "yyyy-mm-dd"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservationtime').daterangepicker();
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
          $('#reservationtime span').html(start.format('MMMM D, YYYY') + ' / ' + end.format('MMMM D, YYYY'));
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
	
	
	<script type="text/javascript">
	$( document ).ready(function() {
      google.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Bulk SMS', 'Voice SMS'],
          ['Work',     1001],
          ['Eat',      5092],
          ['Commute',  400],
          ['Watch TV', 2000],
          ['Sleep',    789]
        ]);

        var options = {
          title: 'My Daily Activities'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
   });
    </script>
	
	
	
	
	<script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Bulk SMS',     345311],
          ['UniCode SMS',     234342],
          ['Voice SMS',  25434],
          ['Email', 21567],
          ['Domains',    7231]
        ]);

        var options = {
			width: 500,
			height:250,
          title: 'Year Waise Chart',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
    <?php // $dlrd+$dnds+$pndng+$exprd+$invald+$processcnt; 
	
	//$processcnt?>
<script type="text/javascript">

      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
			
          ['Task', 'Hours per Day'],
          ['Pending', <?php echo $pndng; ?>],
		  ['Failed', <?php echo $exprd+$invald; ?>],
          ['DND', <?php echo $dnds; ?>], 
          ['Deliverd ',<?php echo $dlrd; ?>]
		  
		  
		 
        ]);

        var options = {
			width: 500,
			height:250,
          title: '',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d-1'));
        chart.draw(data, options);
      }
    </script>
	
	
	<script type="text/javascript">
      google.load("visualization", "1.1", {packages:["bar"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses', 'Profit'],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
          ['2016', 660, 1120, 300],
          ['2017', 1030, 540, 350]
        ]);

        var options = {
			width: 500,
			height: 250,
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales, Expenses, and Profit: 2014-2017',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, options);
      }
    </script>
	
		<script type="text/javascript">
	
	google.load('visualization', '1', {packages: ['corechart', 'bar']});
google.setOnLoadCallback(drawMultSeries);

function drawMultSeries() {
      var data = new google.visualization.DataTable();
      data.addColumn('timeofday', 'Time of Day');
      data.addColumn('number', 'Motivation Level');
      data.addColumn('number', 'Energy Level');

      data.addRows([
        [{v: [8, 0, 0], f: '8 am'}, 1, .25],
        [{v: [9, 0, 0], f: '9 am'}, 2, .5],
        [{v: [10, 0, 0], f:'10 am'}, 3, 1],
        [{v: [11, 0, 0], f: '11 am'}, 4, 2.25],
        [{v: [12, 0, 0], f: '12 pm'}, 5, 2.25],
        [{v: [13, 0, 0], f: '1 pm'}, 6, 3],
        [{v: [14, 0, 0], f: '2 pm'}, 7, 4],
        [{v: [15, 0, 0], f: '3 pm'}, 8, 5.25],
        [{v: [16, 0, 0], f: '4 pm'}, 9, 7.5],
        [{v: [17, 0, 0], f: '5 pm'}, 10, 10],
      ]);

      var options = {
		  width:500,
		    height:250,
        title: 'SMS Striker Bulk SMS Month Chart',
        hAxis: {
          title: 'Time of Day',
          format: 'h:mm a',
          viewWindow: {
            min: [7, 30, 0],
            max: [17, 30, 0]
          }
        },
        vAxis: {
          title: 'Rating (scale of 1-10)'
        }
      };

      var chart = new google.visualization.ColumnChart(
        document.getElementById('chart_div'));

      chart.draw(data, options);
    }

	</script>
    
       <script>
	     $(document).ready(function () {
			 
			// mobil number validation
			
			$('#mobile_no_').keypress(function (evt) {
                if ($('#mobile_no_').val().length >= 10 || $('#mobile_no_').val().length == 10) {
				     $('#mobile_no_').focus(); // focus to next element.
					
					 evt.preventDefault();
                }
				
                var keyCode = (evt.which) ? evt.which : evt.keyCode;
                if ((keyCode < 48 || keyCode > 57) && keyCode != 8 && keyCode != 46 && keyCode != 37 && keyCode != 39) // 32-Space & 8-Backspace & 46-Delete & 37 Left & 39 Right Arrow //

                    return false;

                return true;
            });
			
			  });
			  </script>
  </body>
</html>

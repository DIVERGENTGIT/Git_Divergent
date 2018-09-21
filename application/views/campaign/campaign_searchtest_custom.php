
       
	     <link href="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />


  
    <script src='<?php echo  base_url(); ?>assets/plugins/fastclick/fastclick.min.js'></script>
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

   
	 <style>
     
        iframe {
            display: block;
            overflow: auto;
            border: 0;
            margin: 0;
            padding: 0;
            margin: 0 auto;
        }
        .frame {
            height: 49px;
            margin: 0;
            padding: 0;
            border-bottom: 1px solid #ddd;
        }
        .frame a {
            color: #666;
        }
        .frame a:hover {
            color: #222;
        }
        .frame .buttons a {
            height: 49px;
            line-height: 49px;
            display: inline-block;
            text-align: center;
            width: 50px;
            border-left: 1px solid #ddd;
        }
        .frame .brand {
            color: #444;
            font-size: 20px;
            line-height: 49px;
            display: inline-block;
            padding-left: 10px;
        }
        .frame .brand small {
            font-size: 14px;
        }
        a,a:hover {
            text-decoration: none;
        }
        .container-fluid {
            padding: 0;
            margin: 0;
        }
        .text-muted {
            color: #999;
        }
        .ad {
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            background: #222;
            background: rgba(0,0,0,0.8);
            width: 100%;
            color: #fff;
            display: none;
        }
        #close-ad {
            float: left;
            margin-left: 10px;
            margin-top: 10px;
            cursor: pointer;
        }
#example1 th{color:#fff !important;}
.progress{ margin-right:40px !important;}	
.my-progrss{width:70px; font-size:12px; margin-left: -9px;  border:1px solid:#ccc;}
.progress.vertical { border:1px solid #DBE6F4 !important; border-radius:3px;}	

#example1 .alert {

text-shadow: none !important;
background: transparent !important;
  
}
.colome-window{  height:15px; display: table-cell;  padding:5px 15px; }


.my-scroll{
	
overflow-y: scroll;
overflow-x: hidden;

visibility: visible;


} 
.my-scroll -webkit-scrollbar { 
width: 6px;
}
.my-scroll-webkit-scrollbar-button {
    background:
}
.my-scroll-webkit-scrollbar-thumb {
  background-color:  #215A94; border:none;
  outline: 1px solid slategrey;
}
.modal-header .close {
    margin-top: 11px important;
    margin-right: 15px important;
}

th.sendee-color.sorting{ width:200px !important;}
	.panel{ margin-bottom:0px !important;
	}
	
	 /*  date picker  */
	  /* input.input-mini {
    width: 80px !important;*/
}
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
#example1_length select {
    padding: 6px 10px !important;
    margin: 16px 10px;
}
#example1_filter input {
    padding: 6px !important;
    margin-top: 12px;
	margin-left: 10px;
}
#campaign_search input{
    margin: 0px !important;
}	
.row{margin:0px;}  
.select_01 select{    padding: 0px 5px !important;
    height: 42px;}
	#example1_filter label{ float: right;}
	#example1{padding:10px 0px !important;}
	#example1 td{text-align:center !important;}
	#example1_paginate{display:none;}
	#example1_info{display:none;}
	#example1 tr:lastchild td{width:100px !important;}
	.pagination-sm{margin:30px 0px !important;}
	</style>
    
  </head>
  <body class="skin-blue sidebar-mini">
  <div class="col-sm-9 col-md-9 col-xs-12 padding_zero">
   
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="col-sm-12 col-md-12 col-xs-12">
        	
           
            <div class="panel panel-default">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Reports</strong></div>
                <div class="panel-body col-md-6" style="background-color:#fff;margin-top: 10px !important;" >
                
                <dl class="dl-horizontal" style="">
                
  <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>customized/viewcampaignssearch/" name="campaign_search" id="campaign_search" method="post" >

  <div class="form-group">
    <label class="control-label col-sm-3" for="email">From - To</label>
    <div class="col-sm-8">
     <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                      <input type="text" name="rangeA" class="form-control pull-right active" id="reservationtime">
                    </div>
    </div>
  </div>
  <!--<div class="form-group">
    <label class="control-label col-sm-3" for="pwd">Mobile No</label>
    <div class="col-sm-8"> 
      <input type="text" class="form-control" id="mobile_no_" name="mobile_no_" placeholder="Enter Mobile No">  
    </div>
  </div>-->
   
   <div class="form-group">
    <label class="control-label col-sm-3" for="email">Sender ID</label>
    <div class="col-sm-8 select_01">
          <?php echo form_dropdown('sender', $sender_names, set_value('sender'),'class="form-control"');?> 
    </div>
  </div>
  <?php 

$file_type_options = array(
'xls'  => 'Excel',
// 'txt'    => 'Text',
);    ?>
  <!-- <div class="form-group">
    <label class="control-label col-sm-3" for="pwd">File Formate</label>
    <div class="col-sm-8"> 
  <?php echo  form_dropdown('file_format', $file_type_options , 'all' ,'class="form-control"');?>
    </div>
  </div> -->
 
  <div class="form-group"> 
    <div class="col-sm-offset-5 col-sm-12" style="margin-left:150px;" >
      <input  type="submit" class="btn btn-default btn-sm" name="submit">
    

    
    
      
    </div>
  </div>
    <p style="font-size: 12px;"> * Reports from  <b><?php echo date('Y-m-d', time()-60*60*48 );?> </b> only can be viewed / downloaded through search option</p>

  
</form>
             
                </dl>
           
         
      </div>
      
       <div class="col-md-6 padding_rt" style="padding-top:10px;">
              <!-- AREA CHART -->
              
			  
<div class="bs-example"  style=" padding-top:0px !important;">
	
    <div class="tab-content"  style=" padding-top:0px !important;">
              
        <div id="sectionB" class="tab-pane fade in active" style=" overflow:hidden !important;background-color:#fff !important;    height: 325px !important;">
         <?php if($userid!=4134){ ?>
		 <div id="piechart_3d-1" style=""></div>
         <?php } ?>
            </div>
		 
            </div>
		        
    </div>
</div>
  <!--    
      <div class="panel-body col-md-5" >
                
                <dl class="dl-horizontal" style="">
               
     
                </dl>
           
         
      </div> -->
      
      
            </div>
          
          <div class="row">
           

<!--  +++++++++++++++++++++++++++==========================-->

              

</div><!-- /.col (RIGHT) -->

<!---++++   ===============================+++++++++++++++++++++++++-->		
          
		  <div class="box"  style="margin-top:10px;     border-top:0px !important;">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body" style="padding-top:0px;">
                  <table class="table_all">
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
                    
                    <input type = "hidden" id="countofcampaign" value ="<?php echo count($campaigns) ?>" >
                    
					<?php 
		$count=0;

    
if(!empty($per_page)){
	$count=$count+$per_page;
	}
		foreach($campaigns as $campaign){		 
		$user_id=$campaign->user_id;
	$count++;
	
		
			
				$cur_date = date('Y-m-d H:i:s');
		//		$days_diff = $this->daysDifference($cur_date, $campaign->created_on);
				
		 $month1 = substr($campaign->created_on,5,2);
         $day1 = substr($campaign->created_on,8,2);
         $year1 = substr($campaign->created_on,0,4);

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
	
	 		        $dlr_report = $this->Campaign_model->get_campaign_numbers($campaign->campaign_id, $fullDays, $campaign->created_on);		
	
	 
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
			if($dlr->dlr_status==16)
			{
				$invalid_nos_count++;
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

					
										
			}
						endforeach;

			
	?>
                      <tr style="height:30px !important;"  class="linkcountall" >
                        <td><?php echo $count; ?></td>
                        <td style="width:130px!important;"><?php echo $campaign->created_on; ?>
                         </td>
                        <td><?php echo $campaign->sender_name; ?></td>
<!--<td><?php echo $campaign->campaign_name; ?></td>
-->
<td style="width:200px !important important;">  <p class="row-fluid alert alert- alert-dismissable " data-toggle="tooltip" data-placement="bottom" title="" 

  data-original-title="<?php echo htmlspecialchars($campaign->sms_text); ?>" >
<?php	 
$array = str_split($campaign->sms_text,50);
echo $array[0];
?>
             </p> </td>
                        <td><?php echo $campaign->no_of_messages; ?>
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
			<td style="width:50px;"> <?php echo $pending_dlrs_count ?></td>
			
		</tr>
      
		<tr style="width:200px; background-color:#EFEFEF;" class="odd gradeX">
			<td style="width:200px;">Failed Numbers</td>
			<td style="width:50px;"> <?php echo $failure=$invalid_nos_count+$invalid_number_length_count+$multiple_submit_count+$account_expired_count+$delivery_failure_count+$misc_error_count+$barring_count+$dropped_count+$invalid_sender_ids_count+$network_error_count+$mobile_equipment_error_count+$memory_capacity_exceeded_count+$out_of_range_count; ?></td>
			
		</tr>
      
        </tbody>
        </table>
                  
                  
                </ul>
              </div>
              </td>
						 
                         <td><?php 
		 	if($campaign->campaign_status == 0):
		 		echo "Processing";
		 elseif($campaign->campaign_status == 1 && $campaign->is_scheduled == 1):
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
			
				<a href='<?php echo site_url('/campaign/viewReport/campaign/'.$campaign->campaign_id);?>' class="btn_cls01">	<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#" >View  </button></a>
       <?php if($campaign->campaign_status == 2 || ($campaign->campaign_status == 1 && $campaign->is_scheduled == 0)) 
					  { ?>
		 	 <a class="btn btn-sm btn-default btn_cls01" href='<?php echo site_url('/campaign/download_dlr_report/'.$campaign->campaign_id);?>'>Download
			 </a> 

        <!--    <a href='<?php echo site_url('/campaign/viewReport/campaign/'.$campaign->campaign_id);?>'>View</a>-->
		 	<?php } elseif($campaign->campaign_status == 1 && $campaign->is_scheduled == 1) {?>
		 	<!--<a href='<?php echo site_url();?>/campaign/editcampaign/<?php echo $campaign->campaign_id?>'>Edit</a>&nbsp;		 
			<a href='<?php echo site_url();?>/campaign/cancelcampaign/<?php echo $campaign->campaign_id?>' 
		 		onclick='return confirm("Are you really want to Cancel this Campaign?");'>Cancel</a> -->
		 	<?php } else { ?>
		 	
		 	<?php } ?>
                      </td>
		  <?php 
		  }
	?>
                      </tbody>
                    </tfoot>
                  </table>
        <div id = "linkcount" >
		<?php 
		
		 echo $this->pagination->create_links();
		
		?>
        <div>
	
                </div><!-- /.box-body -->
              </div>
		  
            </div><!-- /.col (LEFT) -->
			
            
            
            
            
            
            
           
          </div><!-- /.row -->
          	




		  


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
                              
                              
                             <!-- ===== view model gose to hear ======== -->

      
      
      
      
      
      
      
      
     
      
       <div class="clearfix"></div> <?php //require_once('includes/footer.php');?>
     
    </div><!-- ./wrapper -->

   
      
	
	 
	
    
    
 
   

<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.1','packages':['corechart']}]}"></script>

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

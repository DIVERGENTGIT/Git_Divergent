<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SMS Striker Soft Solutions</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo  base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    
    
    <link href="<?php echo  base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo  base_url(); ?>assets/css/striker.min.css" rel="stylesheet" type="text/css" />
  
       <link href="<?php echo  base_url(); ?>assets/css/table.css" rel="stylesheet" type="text/css" />
      
      
       
	     <link href="<?php echo  base_url(); ?>assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />

    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo  base_url(); ?>assets/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

<link href="<?php echo  base_url(); ?>assets/css/custom-css.css" rel="stylesheet" type="text/css">


 

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    
  
    
	 <style>
        html, body {
            min-height: 100%;
            padding: 0;
            margin: 0;
            font-family: 'Source Sans Pro', "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
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
    </style>
	<style type="text/css">
	
.progress{ margin-right:40px !important;}	
.my-progrss{width:70px; font-size:12px; margin-left: -9px;  border:1px solid:#ccc;}
.progress.vertical { border:1px solid #DBE6F4 !important; border-radius:3px;}	
	</style>
    
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      

      <!-- Left side column. contains the logo and sidebar -->





     

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
      

        <!-- Main content -->
        <section class="content">
        	
           
            <div class="panel panel-default">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Reports</strong></div>
                <div class="panel-body col-md-5" >
                
                <dl class="dl-horizontal" style="">
                
				
				

 <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>./index.php/campaign/viewcampaigns/" name="campaign_search" id="campaign_search" method="post" >

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
  
  <div class="form-group">
    <label class="control-label col-sm-3" for="pwd">Mobile No</label>
    <div class="col-sm-8"> 
      <input type="text" class="form-control" id="mobile_no_" name="mobile_no_" placeholder="Enter Mobile No">	
    </div>
  </div>
  
        
                </dl>
           
         
      </div>
     
      <div class="panel-body col-md-5" >
                
                <dl class="dl-horizontal" style="">
                
  <div class="form-group">
    <label class="control-label col-sm-4" for="email">Sender ID</label>
    <div class="col-sm-8">
	
	        <?php echo form_dropdown('sender', $sender_names, set_value('sender'),  'class="form-control"');?> 

    </div>
  </div>
  <?php 

$file_type_options = array(
'xls'  => 'Excel',
// 'txt'    => 'Text',
);		?>

  <div class="form-group">
    <label class="control-label col-sm-4" for="pwd">File Formate </label>
    <div class="col-sm-8"> 
	<?php echo  form_dropdown('file_format', $file_type_options , 'all' ,'class="form-control"');?>
    </div>
  </div>
 
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-12" style="margin-left:0px;" >
      <button  type="submit" class="btn btn-default btn-sm">Search</button>
      
    </div>
  </div>
   * Reports from  <b><?php echo date('Y-m-d', time()-60*60*48 );?> </b> only can be viewed / downloaded through search option
  
</form>
                
              
           
         
      </div>
      
      
            </div>
          
          <div class="row">
            <div class="col-md-6">
              <!-- AREA CHART -->
              
			  
<div class="bs-example">
    <ul class="nav nav-tabs">
        
      
        <li class="active"><a data-toggle="tab" href="#sectionB">Section B</a></li>
        <li><a data-toggle="tab" href="#sectionC">Section C</a></li>
       
    </ul>
	
    <div class="tab-content">
              
        <div id="sectionB" class="tab-pane fade in active" style="background-color:#fff !important;">
         
		<!--<div id="piechart" style="width:400px !important; height: 250px !important; background:transparent;"></div>-->
		 <div id="piechart_3d-1" style=""></div>
	
         </div>
		 
		 <div id="sectionC" class="tab-pane fade" style="background-color:#fff !important;" >
           <div id="piechart_3d" style=""></div>
		   

        </div>
                </div>
		        
    </div>
</div>

<!--  +++++++++++++++++++++++++++==========================-->

<div class="col-md-6">
       <div class="" style="height:50px;"></div>
	   
		
		<div class="" style="float:left;" id="example5">
               <div class="progress progress-1 progress-striped active vertical"><div class="progress-bar progress-bar-2 progress-bar-striped" role="progressbar" data-transitiongoal-backup="20" data-transitiongoal="20" aria-valuenow="20" style="height: 20%;">20%</div></div>
				  <div class="my-progrss"style="color:#337ab7;" >  
				Bulk SMS
				</div>
	    </div>
		
		<div class="" style="float:left; margin-left:6px !important;">
                  <div class="progress progress-1 vertical progress-striped active"><div class="progress-bar progress-bar-2 progress-bar-success six-sec-ease-in-out" role="progressbar" data-transitiongoal-backup="40" data-transitiongoal="40" aria-valuenow="40" style="height: 40%;">40%</div></div>
				  <div class="my-progrss" style="color:#00a65a;" >  
				 Emails
				</div>
	    </div>
		
		<div class="" style="float:left;">
                   <div class="progress progress-1 vertical progress-striped active"><div class="progress-bar progress-bar-2 progress-bar-info six-sec-ease-in-out" role="progressbar" data-transitiongoal-backup="60" data-transitiongoal="60" aria-valuenow="60" style="height: 28%; background-color:rgb(153, 0, 153);">28%</div></div>
				  <div class="my-progrss"  style="color:#770077;">  
				 Domains
				</div>
	    </div>
		
                
          
		<div class="" style="float:left;">
                   <div class="progress progress-1 vertical progress-striped active"><div class="progress-bar progress-bar-2 progress-bar-2 progress-bar-warning six-sec-ease-in-out" role="progressbar" data-transitiongoal-backup="80" data-transitiongoal="80" aria-valuenow="80" style="height: 08%;">8%</div></div>
				  <div class="my-progrss" style="color:#ee970c;">  
				 Voice SMS
				</div>
	    </div>
		
		<div class="" style="float:left;">
                   <div class="progress progress-1 vertical progress-striped active"><div class="progress-bar  progress-bar-danger six-sec-ease-in-out" role="progressbar" data-transitiongoal-backup="100" data-transitiongoal="100" aria-valuenow="100" style="height: 10%;">10%</div></div>
				  <div class="my-progrss" style="color:#c73220;">  
				UniCode SMS
				</div>
	    </div>
		  


		  
                
                
 </div>
	
              

</div><!-- /.col (RIGHT) -->

<!---++++   ===============================+++++++++++++++++++++++++-->		
              
 
		  <div class="box" >
               
                <div class="box-body">
							
					 
	<table id="example1" class="table table-bordered table-striped" summary="SMS Campaign's Report">
    <thead>
    	<tr style="height:40px !important;">
		 <th scope="col" class="sendee-color"></th>
		 <th scope="col" class="sendee-color">On Date</th>
		 <th scope="col" class="sendee-color">Sender</th>
		 <th scope="col" class="sendee-color" style="width:100px !important;">SMS Textfrgdsfgd</th>
		 <th scope="col" class="sendee-color">No. of SMS </th>
		 <th scope="col" class="sendee-color">Status </th>
		 <th scope="col" class="sendee-color">Report</th>
		</tr>
	</thead>
	<tfoot>
    	<tr>
        	<td colspan="6" class="rounded-foot-left">&nbsp;</td>
        	<td class="rounded-foot-right">&nbsp;</td>

        </tr>
    </tfoot>
	<tbody>
	<?php 
		$count=1;
		foreach($campaigns as $campaign):		 
		$user_id=$campaign->user_id;
	?>
	<tr>
		<td role="row" class="odd"><?php echo $count; ?></td>
		<td role="row" class="odd"><?php echo $campaign->created_on; ?></td>
		<td role="row" class="odd"><?php echo $campaign->sender_name; ?></td>
		<td role="row" class="odd" width="200"><?php echo wordwrap($campaign->sms_text,43,"\n",1); ?></td>
		<td role="row" class="odd"><?php echo $campaign->no_of_messages; ?></td>
		<td align='center' role="row" class="odd">
		<?php 
		 	if($campaign->campaign_status == 0):
		 		echo "Processing";
		 	elseif($campaign->campaign_status == 1 && $campaign->is_scheduled == 1):
		 		echo "Scheduled@ ". $campaign->scheduled_on ;
		 	else:
		 		echo "Done";
		 	endif;
		 ?>
		 </td>
		 <td align='center' role="row" class="odd">
		 	<?php if($campaign->campaign_status == 2 || ($campaign->campaign_status == 1 && $campaign->is_scheduled == 0)) { ?>
		 	<a href='<?php echo site_url('/campaign/downloadDlrReport/'.$campaign->campaign_id);?>'>Download</a>

            <a href='<?php echo site_url('/campaign/viewReport/campaign/'.$campaign->campaign_id);?>'></a><span class="badge bg-blue" data-toggle="modal" 
data-target="#view-contact-modal<?php echo $campaign->campaign_id; ?>" >view</span>
			<div id="view-contact-modal<?php echo $campaign->campaign_id; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header" style="background-color:#0067B3;">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">×</button>
<h4 class="modal-title" style="color:#fff;" >View Campaign</h4>
</div>
<div class="modal-body">
<div class="bs-example" style=" margin-left:10px;">

	Campaign ID <?php echo $campaign->campaign_id; ?>

</div>
</div>



<div class="callout bg-info">

<?php 
$cur_date = date('Y-m-d H:i:s');

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
$dlr_report_new = $this->Campaign_model->get_campaign_numbers($campaign->campaign_id, $dateDiff, $campaign->created_on);	

	 
	
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
			$total =0;
			foreach($dlr_report_new as $dlr):
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
				
			
			$failure=$invalid_nos_count+$invalid_number_length_count+$multiple_submit_count+$account_expired_count+$delivery_failure_count+$misc_error_count+$barring_count+$dropped_count+$invalid_sender_ids_count+$network_error_count+$mobile_equipment_error_count+$memory_capacity_exceeded_count+$out_of_range_count;
$total_count=+ $total_count;
$this->_data['total_dlrs_count'] = $total;
$this->_data['total_count'] = $total_count;
$this->_data['pending_dlrs_count'] =+ $pending_dlrs_count;
$this->_data['pending_dlrs_count'] =+ $pending_dlrs_count;
$this->_data['dlr_report'] = $dlr_report_new;

$this->_data['failure'] = +$failure;
$this->_data['dnd_count'] = +$dnd_count;

$this->_data['delivered_count'] = +$delivered_count;


endforeach;
?>
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
		<td><?php echo $misc_error_count; ?></td>
    </tr> 
      

    <tr>
		<td >Delivery Failure (used for data_sm_resp)</td>
		<td><?php echo $delivery_failure_count; ?></td>
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
</div>				


</div>

</div>

</div>
		 	<?php } else if($campaign->campaign_status == 1 && $campaign->is_scheduled == 1) {?>
		 	<a href='<?php echo site_url();?>/campaign/editcampaign/<?php echo $campaign->campaign_id?>'>Edit</a>&nbsp;		 
			<a href='<?php echo site_url();?>/campaign/cancelcampaign/<?php echo $campaign->campaign_id?>' 
		 		onclick='return confirm("Are you really want to Cancel this Campaign?");'>Cancel</a>
		 	<?php } else { ?>
		 	---
		 	<?php } ?>
		 </td>		 	
	</tr>
		 
	<?php 
	$count++; 
		

	endforeach;
	?>
	
	</tbody>
	
	</table>

		 <div align='center' class="pagination">
		<?php // echo $this->pagination->create_links(); ?>
		</div>
				 
                </div><!-- /.box-body -->
              </div>
			  
			  
			  
			  
			  
			  
		  
            </div><!-- /.col (LEFT) -->
			
          </div><!-- /.row -->
          	
        </section><!-- /.content -->
		
		
		
		
		
		
		
		
		
      </div><!-- /.content-wrapper -->

      
      
       <div class="clearfix"></div> 
	   
     
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    
    <script src="<?php echo  base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo  base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
  
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
         
     
      <script src="<?php echo  base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo  base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
      <?php
  
			
		
				?>

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
          $('#reservationtime span').html(start.format('MMMM D, YYYY') + '-' + end.format('MMMM D, YYYY'));
		  

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
<script type="text/javascript">

      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
			
          ['Task', 'Hours per Day'],
          ['Total SMS ',<?php echo $dlrd+$dnds+$pndng+$exprd+$invald+$processcnt; ?>],
          ['Deliverd', <?php echo $dlrd; ?>],
          ['DND', <?php echo $dnds; ?>],
		  ['Pending', <?php echo $pndng; ?>],
          ['Failed', <?php echo $exprd+$invald; ?>],
		  ['Processing',<?php echo $processcnt; ?>]
		  
		  
		 
        ]);

        var options = {
			width: 500,
			height:250,
          title: 'Monthly SMS Flow',
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
  </body>
</html>

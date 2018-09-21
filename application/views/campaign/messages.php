<?php
error_reporting(0);

?>

  
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

<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
		<div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/analytics-icon.png" class="right-title-img">Messages</h3>
</div>
<section class="col-sm-12 col-md-12 col-xs-12 padding_zero">
 <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<form class="form-horizontal col-sm-12 col-md-12 col-xs-12 padding_zero" role="form" action="<?php echo base_url(); ?>campaign/messages" name="campaign_search" id="campaign_search" method="post" >
  <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<ul class="search-list05 missedcall_allform">
<li><input type="text" id="from_date" name="" placeholder="2016-12-21" class="data-pickerbg"></li>
<li><input type="text" id="to_date" name="" placeholder="2016-12-21" class="data-pickerbg"></li>
<li><input type="text" class="form-control" id="mobile_no_" name="mobile_no_" placeholder="Enter Mobile No">	</li>
<li><select name=""><option>Keyword</option></select></li>
<li><input type="submit" name="" value="Search" class="submit_btn"></li>
</ul>
</div>
</form>
 <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<?php 
$notallowed = array('3958','4065');

if(!in_array($user_id,$notallowed)): 

 ?>
  <a href="<?php echo site_url('missedcall/download/'.trim($from_date).'/'.trim($to_date)); ?>" class="bt_green btn btn-default" style="float:right;" >Download</a>
<?php  endif;  ?>
</div>
 <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">

<table class="table_all">
                    <thead>
                 
        <tr>
        <th>SL.No</th>
        <th>Messaged To</th>
        <th>Message From</th>
        <th>Message</th>
         <?php if($user_id==3958 || $user_id==4065): ?>
         <th>
          Scratch Card No</th>
          
           <th>
         City</th>
          <?php endif; ?>
        <th>Message Date</th>
        </tr>
   
                    </thead>
                    <tbody>
				

<?php
if($user_id==3958 || $user_id==4065): 
$hydcnt = 0;
$krishnapatnamcnt = 0;
$kakinadacnt = 0;
$vijayawadacnt = 0;
foreach($getcityCount as $sms111)
{

preg_match_all('!\d+!', $sms111->message, $matchess);


 $arrss=str_split($matchess[0][0],3);
  $n= $arrss[0];
 
	
	switch ($n) {
    case 111:
       $hydcnt++;
        break;
    case 222:
        $krishnapatnamcnt++;
        break;
    	case 333:
        $kakinadacnt++;
		break;
		case 444:
        $vijayawadacnt++;
		break;
       
    default:
		break;
	}
      
	
	
}
?>
<div class="col-sm-12">
<div class="col-sm-2">
<div class="col-sm-12 message_01 padding_ltrt">
<div class="citymsg_01">Hyderabad</div>
<span class="sms_source02"><h4 class="quksend1_h4"> 
	<?php echo  $hydcnt; ?> </h4></span>
</div>
</div>
<div class="col-sm-2">
<div class="col-sm-12 message_01 padding_ltrt">
<div class="citymsg_01">Krishnapatnam</div>
<span class="sms_source02"><h4 class="quksend1_h4"><?php echo  $krishnapatnamcnt; ?></h4></span>
</div>
</div>
<div class="col-sm-2">
<div class="col-sm-12 message_01 padding_ltrt">
<div class="citymsg_01">Kakinada</div>
<span class="sms_source02"><h4 class="quksend1_h4"> <?php echo $kakinadacnt; ?></h4></span>
</div>
</div>
<div class="col-sm-2">
<div class="col-sm-12 message_01">
<div class="citymsg_01">Vijayawada</div>
<span class="sms_source02"><h4 class="quksend1_h4">
 <?php echo $vijayawadacnt; ?></h4></span>
</div>
</div>
<div class="col-sm-4" style="text-align: right;">

    <a href="<?php echo site_url('missedcall/download_priya_food/'.trim($from_date).'/'.trim($to_date)); ?>" class="bt_green btn btn-default" style="margin-top: 120px;">Export to Excel</a>
  
  
</div>
</div>
<?php
endif;

foreach($sms_reports as $smsreport)
{		 
$count++;
?>
<tr>
<td><?php echo $count; ?></td>


<td><?php echo $smsreport->service_number; ?></td>

<td><?php echo $smsreport->message_from; ?>
</td>

<td>  <p class="row-fluid alert alert- alert-dismissable word_brk" data-toggle="tooltip" data-placement="bottom" title="" 
data-original-title="<?php echo $smsreport->message; ?>" >
<?php	 $words = explode(" ",$smsreport->message);
echo  implode(" ",array_splice($words,0,50));
?></p> </td>
<?php if($user_id==3958 || $user_id==4065): ?>
<td><?php
preg_match_all('!\d+!', $smsreport->message, $matches);
$separtenum= $matches[0][0];
echo $separtenum; ?></td>


<td><?php
preg_match_all('!\d+!', $smsreport->message, $matches);
$separtenum= $matches[0][0];

$arr=str_split($separtenum,3);
 $n= $arr[0];

switch ($n) {
    case 111:
    echo "Hyderabad";
        break;
    case 222:
        echo "Krishnapatnam";
        break;
    	case 333:
        echo "Kakinada";
		break;
		case 444:
        echo "Vijayawada";
		break;
       
    default:
         echo "Hyderabad";
			break;
}
?></td>

<?php endif; ?>

<td><?php echo $smsreport->message_time; ?></td>

</tr>
<?php 
}
// end here msg
    	
		
		?>
    
    
         
         
		             </tbody>
                    </tfoot>
                  </table>
                  <div class="F_pagination">
                              <?php echo $this->pagination->create_links(); ?>
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
         <!--   <div class="col-md-6" style="padding-top:10px;">
                
              
			  
<div class="bs-example"  style=" padding-top:0px !important;">
	
    <div class="tab-content"  style=" padding-top:0px !important;">
              
        <div id="sectionB" class="tab-pane fade in active" style=" overflow:hidden !important;background-color:#fff !important;    height: 275px !important;">
         
		 <div id="piechart_3d-1" style=""></div>
            </div>
		 
            </div>
		        
    </div>
</div>-->

<!--  +++++++++++++++++++++++++++==========================-->

              

</div><!-- /.col (RIGHT) -->

            </div><!-- /.col (LEFT) -->
			

          </div><!-- /.row -->



        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
                              
                              
                             <!-- ===== view model gose to hear ======== -->

      
      
      
      
      
      
      
      
     
      
       <div class="clearfix"></div>
     
    </div><!-- ./wrapper -->

   
      
	
	 
	
    
    
   
    
    <script language="Javascript">

function validate_form()
{
//alert("test");
   //alert(document.frm_name.country.value);

   if ( document.frm_name.selopt.value == "None" )
   {
      alert ("Please select the service option" );
      document.frm_name.selopt.focus();
      return false;
   }
//alert(document.frm_name.selopt.value);
   if ( document.frm_name.selopt.value == "sms" )
{
document.frm_name.option_value.value="1";
//alert(document.frm_name.option_value.value);
document.frm_name.method="post";
document.frm_name.submit();
return true;
}
 if ( document.frm_name.selopt.value == "calls" )
{
document.frm_name.option_value.value="2";
//alert(document.frm_name.option_value.value);
document.frm_name.method="post";
document.frm_name.submit();
return true;
}

}
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
        $('#reservationtime').daterangepicker({timePicker: false, timePickerIncrement: 30, format: 'YYYY-MM-DD'});
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
	
	
	
	
	
    <?php // $dlrd+$dnds+$pndng+$exprd+$invald+$processcnt; 
	
	//$processcnt?>
<script type="text/javascript">

      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
			
          ['Task', 'Hours per Day'],
          ['Pending', <?php echo $pndng=0; ?>],
		  ['Failed', <?php echo $exprd=2+$invald=1; ?>],
          ['DND', <?php echo $dnds=4; ?>],
          ['Deliverd ',<?php echo $dlrd=20; ?>]
		  
		  
		 
        ]);

        var options = {
			width: 500,
			height:250,
          title: 'Missed Calls Report',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d-1'));
        chart.draw(data, options);
      }
    </script>
	

	
  </body>
</html>

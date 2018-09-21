<?php
error_reporting(0);

?>

       
	     <link href="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />

    <style>
.opensleft {
    margin-left: 103px !important;
}
	
  .F_pagination a {
   position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #337ab7;
    text-decoration: none;
    background-color: #fff;
    border: 1px solid #ddd;
	   
}
.F_pagination {
    margin-left: 15px;
}	
.F_pagination a:hover {
    background-color: #337ab7;
    color: #fff;
}

strong {
    
    border-radius: 2px;
    
    background-color: #337ab7;

	
	
	
	position: relative;
    float: left;
    padding: 6px 12px;
    margin-left: -1px;
    line-height: 1.42857143;
    color: #fff;
    text-decoration: none;
    
    border: 1px solid #ddd;
}     
	   
	   
	   
	   
	   
   
.alert {

text-shadow: none !important;
background: transparent !important;
}

.sl_1{width:10% !important;}
.sl_2{width:30% !important;}     
   
.box-header {
    padding: 0px !important;
}

form#campaign_search {
    padding-top: 0px !important;
}
.form-horizontal {
    margin-top: 13px !important;
} 

div#example1_length {
    display: none;
}
div#example1_filter {
    display: none !important;
}
div#example1_info {
    display: none !important;
}

ul.pagination {
    float: right;
}
.pagination{
	    display: none;
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
    margin-left: 93px !important;
	 
}
.daterangepicker .calendar.right {
    
    margin-left: 20px !important;
}
.ranges {
    width: 330px !important;
}
button.cancelBtn.btn.btn-small.btn-sm.btn-default {
    margin-top: 22px;
}	
#example1_wrapper select {
    padding: 6px 10px !important;
    margin: 16px 10px;
}	 
#example1_filter input[type="search"]{    padding: 5px 10px !important;
    margin: 0px 0px 0px 8px !important;}  
	#example1_filter label{    float: right;}
	#example1_wrapper .row{margin:0px !important;}
	.form-horizontal{margin-top: 8px;} 
	.sr_btn01{    border: 0px;
    background: #215A94;
    color: #fff;
    padding: 10px 25px;}
        
        
        
      /*30-09-2015 - edited tables */  
        
        
     th.sendee-color.sorting_asc {
    width: 59px !important;
}
        th.sendee-color.sorting_desc {
    width: 59px !important;
}
        
        td {
    text-align: center !important;
}
        
        
	</style>
  <body>
  <div class="col-sm-9 col-md-9 col-xs-12 padding_zero">
   
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="col-sm-12 col-md-12 col-xs-12">
        	
           
            <div class="panel panel-default">
                <div class="panel-heading"><span class="glyphicon glyphicon-th"></span><b> Missed Calls</b></div>
                <div class="panel-body col-md-12" style="background-color:#fff;  margin-top: 10px !important;" >
               
                <dl class="dl-horizontal" style="">
              <ul class="nav nav-tabs" style="padding:0px !important; text-align:left; margin-bottom: 10px !important;">
       
	    <li class="active"><a href="<?php echo base_url(); ?>campaign/missedcall">Missed Calls</a></li>
      
	   <!-- <li><a href="<?php echo base_url(); ?>missedcall/messages">Masseges</a></li> -->

   </ul> 
   <div class="tab-content">  
   <div>
  <form class="form-horizontal col-sm-12" role="form" action="<?php echo base_url(); ?>./campaign/missedcall" name="campaign_search" id="campaign_search" method="post" >
<div class="col-sm-4 padding_zero">
  <div class="form-group">
    <label class="col-sm-3 padding_lt" style="margin-top: 10px;" for="email">From - To</label>
    <div class="col-sm-8 padding_zero">
     <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                      <input type="text" name="rangeA" class="form-control pull-right active" id="reservationtime" style="margin-bottom: 0px !important;">
                    </div>
    </div>
  </div>
  </div>
  <div class="col-sm-4 padding_zero">
  <div class="form-group">
    <label class="col-sm-3 padding_rt" style="margin-top: 10px;" for="pwd">Mobile No</label>
    <div class="col-sm-8 padding_rt"> 
      <input type="text" class="form-control" id="mobile_no_" name="mobile_no_" placeholder="Enter Mobile No">	
    </div>
  </div>
    </div>
    <!--<div class="col-sm-3 padding_zero">
  <div class="form-group">
    <label class="col-sm-3" style="margin-top: 10px;" for="pwd">GVMN</label>
    <div class="col-sm-8 padding_rt"> 
    <select name="servicenumber" class="form-control" style="padding: 0px 5px !important; height: 42px;">
    <option value="">Select Number </option>
    <?php foreach($getGVMN as $servicenumber){ ?>
    <option value="<?php echo $servicenumber->service_number; ?>"><?php echo $servicenumber->service_number; ?></option>
    <?php }?>
    </select>
 </div>
  </div>
    </div>-->
 <div class="col-sm-1 padding_zero">
  <div class="form-group"> 
    <div style="text-align:center;" >
      <button  type="submit" class="btn btn-default btn-sm  sr_btn01">
	  
Search</button>
	  

      
    </div>
  </div>
  </div>  
  
</form>

  <a href="<?php echo site_url('missedcall/download_missedcall/'.trim($from_date).'/'.trim($to_date)); ?>" class="bt_green btn btn-default" style="float:right; margin-right:42px;">Export to Excel</a>
<div class="col-sm-12">
<div class="box"  style="margin-top:10px;     border-top:0px !important;">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body" style="padding-top:0px;">
                  <table id="example1" class="table table-bordered table-striped" style="text-align:center;">
                    <thead>
                 
      


       <tr style="text-align:center; height:30px !important; ">
        <th class="sendee-color sl_1" >SL.No</th>
        <th class="sendee-color sl_2" style="text-align:center; "> Dialled Number</th>
        <th class="sendee-color sl_2" style="text-align:center; ">Called From</th>
        <th class="sendee-color sl_2" style="text-align:center; ">Called Date</th>
        </tr>
                    </thead>
                    <tbody>
				

<?php

foreach($missedcalld_reports as $missedcall)
{		 
$count++;
?>
<tr style="height:30px !important;" >
<td><?php echo $count; ?></td>
<td style="width:130px!important;"><?php echo $missedcall->service_number; ?>
</td>
	<td><?php echo $missedcall->called_from; ?></td>
	<td><?php echo $missedcall->called_time; ?></td>
    
    
	</tr>
	<?php }	?>
    
    
         
         
		             </tbody>
                    </tfoot>
                  </table>
                  <div class="F_pagination">
                        <?php echo $this->pagination->create_links(); ?>
                        </div>
                </div><!-- /.box-body -->
              </div>
              </div>
</div>


             
                </dl>
            </div>
             
                </dl>
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

<!---++++   ===============================+++++++++++++++++++++++++-->		
              
 
		  
		  
            </div><!-- /.col (LEFT) -->
			
            
            
            
            
            
            
           
          </div><!-- /.row -->
          	




		  


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
                              
                              
                             <!-- ===== view model gose to hear ======== -->

      
      
      
      
      
      
      
      
     
      
       <div class="clearfix"></div>
     
    </div><!-- ./wrapper -->

   
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
    <!-- bootstrap color picker -->
    
    <!-- bootstrap time picker -->

     
     
      <script src="<?php echo  base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo  base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    
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
	
	 
	
    
    
 
   

<!--<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.1','packages':['corechart']}]}"></script>

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
    </script>  -->                                    
     
		  
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

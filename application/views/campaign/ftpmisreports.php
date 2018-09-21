<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
   
      <!-- Content Wrapper. Contains page content -->
      <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="col-sm-12 col-md-12 col-xs-12">
        	
           
            <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
	<h3 class="right-content-title"><img src="<?php echo base_url();?>images/analytics-icon.png" class="right-title-img">Reports</h3>		

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">

  <form class="col-sm-10 padding_zero form-horizontal" role="form" action="" name="campaign_search" id="campaign_search" method="post" >

<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<ul class="search-list05 missedcall_allform">
<li>
 <select class="form-control" name="username"> 
	       		<option value="">Please Select User</option>
	       		<?php 
	       			if($this->session->userdata('agent_id') == $this->session->userdata('user_id')) 
		    		{	
		    			$selected1 = "selected";
		    		}
	       		?>
	       			<option value="<?php echo $this->session->userdata('user_id')?>" <?php echo $selected1?>><?php echo $this->session->userdata('username')?>(Admin)</option>
	       		
	       		<?php foreach($users AS $user) {
		       		$selected = "";
		       		$this->session->userdata('agent_id');
		    		if($this->session->userdata('agent_id') == $user->user_id) 
		    		{	
		    			$selected = "selected";
		    		}
	       		?>
	       			<option value="<?php echo $user->user_id;?>" <?php echo $selected?>><?php echo $user->users?></option>
	       		<?php }?>
	       		 
	       </select>
  
</li>
<li>
<input type="text" id="from_date" name="from_date" value="<?php echo $from_date ?>"   class="data-pickerbg scheduler_time01">
</li>
<li>
<input type="text" id="to_date" name="to_date" value="<?php echo $to_date ?>"  class="data-pickerbg scheduler_time01"> 
</li>
<li><input type="submit" class="submit_btn" name="submit_search"></li>  
</ul>
   
 <!-- <div class="col-sm-5 padding_zero">
    <label class="col-sm-3 padding_zero" for="email">From - To</label>
    <div class="col-sm-9">
     <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                      </div>
                      <input type="text" name="rangeA" class="form-control pull-right active" id="reservationtime" value="<?php if($this->session->userdata('rangeA')) echo $this->session->userdata('rangeA');?>">
                         <input type="hidden" name="from_date" class="form-control pull-right active" value="" >
                         <input type="hidden" name="to_date" class="form-control pull-right active" value="" >

                    </div>
    </div>
  </div>-->
 
  </div>
</form>
<!--<form action="" method="post" class="col-sm-1 padding_zero text_aln_bt">

    <div class="col-sm-12" style="text-align: left;">
     
       <input  type="submit" class="btn btn-primary btn-sm" name="submit_reset" value="Reset">

       
    </div>

  
</form>-->
 </div>
      <form action="" method="post" class="col-md-12 col-sm-12 col-xs-12 padding_zero form-div text_aln_bt">

    <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
     
       <input  type="submit" class="btn btn-default btn-sm" name="submit_download" value="Download">

       
    </div>

  
</form>


       <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
              <!-- AREA CHART -->
			    <div class="col-md-12 col-sm-12 col-xs-12 padding_zero border_div_pie">
			   <div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
               <table cellpadding="0" cellspacing="0" border="0" class="table table_all table-rd1f table-bordered" id="example">
    
      
	    <tbody>
		<tr class="odd gradeX">
			<td class="">Delivered</td>
			<td class=""><?php echo $result[0]; ?></td>
			
		</tr>
		<tr class="even gradeC">
			<td class="">DND</td>
			<td class=""><?php echo $result[1]; ?></td>
			
		</tr>
          <tr class="odd gradeX">
			<td class=""><div data-toggle="collapse" data-target="#demo">Failed </div>
			</td>
			<td class=""> <?php echo $result[2] ?></td>
			
		</tr>
<!--		
		<tr id="demo" class="collapse odd gradeX">
			<td>1</td>
			<td> 1</td>
			
		</tr>
-->		
		<tr class="odd gradeX">
			<td class="">Pending</td>
			<td class=""> <?php echo $result[3] ?></td>
			
		</tr>
      
		<tr class="odd gradeX">
			<td class="">Invalid</td>
			<td class=""> <?php echo $result[4] ?></td>
			
		</tr>
		<tr class="odd gradeX">
			<td class="">Total</td>
			<td class=""> <?php echo $result[0] + $result[1] + $result[2] + $result[3] + $result[4]?></td>
			
		</tr>
      
        </tbody>
        </table>
			</div>  
<div class="col-md-6 col-sm-6 col-xs-12 padding_zero">
	
    <div class="tab-content"  style="float:right;padding-top:0px !important;">
              
        <div id="sectionB" class="tab-pane fade in active" style=" overflow:hidden !important;background-color:#fff !important;    height: 230px !important;">
         <?php if($userid!=4134){ ?>
		 <div id="piechart_3d-1" style=""></div>
            </div>
            <?php } ?>
		 
            </div>
		        
    </div>
</div>	
</div>

            </div>


            </div><!-- /.col (LEFT) -->

          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 
     
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

      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
			
          ['Task', 'MIS REPORTS'],
          ['Deliverd', <?php  if(empty($result[0])){ echo 0;}else {echo $result[0]; }?>],
	  ['DND', <?php  if(empty($result[1])){ echo 0;}else {echo $result[1]; }?>],
	  ['Failed',<?php  if(empty($result[2])){ echo 0;}else {echo $result[2]; }?>],
          ['Pending', <?php  if(empty($result[3])){ echo 0;}else { echo $result[3]; }?>],
          ['Invalid',<?php  if(empty($result[4])){ echo 0;}else {echo $result[4]; }?>]
		 
        ]);

        var options = {
			width: 300,
			height:250,
          title: '',
          is3D: true,
		  legend: 'none'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d-1'));
        chart.draw(data, options);
      }
    </script>
		<script>
    $(document).ready(function() {
    $(".scheduler_time01").datetimepicker({
	dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        minDate: new Date()
	}
	);
  });
  </script>
	
	
  </body>
</html>

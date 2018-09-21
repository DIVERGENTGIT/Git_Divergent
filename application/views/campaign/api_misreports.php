<?php //print_r($result);?>
       
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
	     width: 525px;
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
	.fail_color{background:#990099 !important;color:#fff;}
	.pend_color{background:#109618 !important;color:#fff;}
	.dnd_color{background:#dc3912 !important;color:#fff;}
	.delv_color{background:#3366cc !important;color:#fff;}
	.table_color{background: #c6d3da !important;
    color: #565050;}
	.text_aln_bt{text-align:right;}
	.border_div_pie{border:1px solid #e4e1e1;margin-bottom:25px;}
	.calendar-time{display:none;}
	.table-rd1f tr{border-bottom:1px solid !important;}
	.table-rd1f tr td{border:0px !important;}
	.total_color{background:#ccc;}
	</style>
    
  </head>
  <body>
  <div class="col-sm-9 col-md-9 col-xs-12 padding_zero">
   
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="col-sm-12">
        	
           
            <div class="col-sm-12 panel panel-default padding_zero">
                <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> API Consulate Reports</strong></div>
                <div class="panel-body col-md-12" style="background-color:#fff;  margin-top: 10px !important;" >
                
                <dl class="dl-horizontal" style="margin:0px;">
                
  <form class="col-sm-10 padding_zero form-horizontal" role="form" action="" name="campaign_search" id="campaign_search" method="post" >

  <div class="col-sm-12 padding_zero">
     <div class="col-sm-5 padding_zero">
    <label class="col-sm-3 padding_zero" for="email">UserName</label>
    <div class="col-sm-9 select_01">
  <?php
	$userID = $this->session->userdata('user_id');
	if(in_array($userID,$abhibusUsers)) {  ?>
	
	
 
	       <select class="form-control" name="user_name"> 
	       		<option value="">Please Select User</option>
	       		 
	       		<?php foreach($abhiBusUserNames as $user) {
		       		$selected = "";
		       		$this->session->userdata('agent_id');
		    		if($this->session->userdata('agent_id') == $user['user_id']) 
		    		{	  
		    			$selected = "selected";
		    		}  
	       		?>
	       			<option value="<?php echo $user['user_id'];?>" <?php echo $selected?>><?php echo $user['username']?></option>
	       		<?php }?>
	       		 
	       </select>
 
	
	
	<?php } else { ?>

 

	       <select class="form-control" name="user_name"> 
	       		<option value="">Please Select User</option>
	       		<?php 
	       			if($this->session->userdata('agent_id') == $this->session->userdata('user_id')) 
		    		{	
		    			$selected1 = "selected";
		    		}
	       		?>
	       			<option value="<?php echo $this->session->userdata('user_id')?>" <?php echo $selected1?>><?php echo $this->session->userdata('username')?>(Admin)</option>
	       		
	       		<?php foreach($users as $user) {
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
   
<?php }  ?>
 </div>
  </div>
  <div class="col-sm-5 padding_zero">
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
  </div>
  <div class="col-sm-2 padding_zero" style="float:right;"> 
    <div class="col-sm-12">
       <input  type="submit" class="btn btn-primary btn-sm" name="submit_search">
      
    </div>
  </div>
  </div>
</form>
<form action="" method="post" class="col-sm-1 padding_zero text_aln_bt">

    <div class="col-sm-12" style="text-align: left;">
     
       <input  type="submit" class="btn btn-primary btn-sm" name="submit_reset" value="Reset">

       
    </div>

  
</form>


             
                </dl>
           
         
      </div>
      <form action="" method="post" class="col-sm-12 text_aln_bt">

    <div class="col-sm-12">
     
       <input  type="submit" class="btn btn-default btn-sm" name="submit_download" value="Download">

       
    </div>

  
</form>


       <div class="col-md-12" style="">
              <!-- AREA CHART -->
			    <div class="col-md-12 border_div_pie">
			   <div class="col-sm-6">
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
<div class="col-sm-6 bs-example"  style=" padding-top:0px !important;">
	
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
	
	
	
  </body>
</html>

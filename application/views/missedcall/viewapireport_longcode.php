<script type="text/javascript">
$(document).ready(function(){
	$(".btn").click(function(){
		$("#myModal").modal('show');
	});
});
</script>
 <script>
 $(document).ready(function(){
  $(function() {
    $( "#datepicker" ).datepicker();
  });
});
 </script>
 
 <style type="text/css">
.pagination ul > li > a:hover, .pagination ul > .active > a, .pagination ul > .active > span {
background-color: #337AB7 !important;
color:#ffffff !important;
}
 #rounded-corner th{color:#000;}
 </style>
<body>
    <div class="col-sm-9 col-md-9 col-xs-12 padding_zero">

      <!-- Left side column. contains the logo and sidebar -->


      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       

        <!-- Main content -->
        <section class="col-sm-12 col-md-12 col-xs-12">
        <div class="col-md-12 ng-scope" style="padding:0px;" data-ng-controller="formConstraintsCtrl">
           
        
         <div class="panel panel-default">
  <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> SMS Delivery Report</strong></div>

      
	<div class="form col-md-12 " style="background-color:#fff!important; ">
  
<style>
	#rounded-corner{ width:656px;	}
</style>


      
    
   
<!--   dispaly numbers ols style -->




	<table id="rounded-corner" summary="SMS Campaign's Report" class=" table table-bordered table-hover table-striped">
    <thead>
    	<tr class="sendee-color sorting">
		 <th scope="col" class="rounded-company">SL.No</th>
		 <th scope="col" class="rounded">Mobile No</th>
		 <th scope="col" class="rounded">Sent time</th>
<th scope="col" class="rounded">noofmessages</th>

		 <th scope="col" class="rounded">sender name</th>
         <th scope="col" class="rounded">Message</th>
         
		 <th scope="col" class="rounded-q4">DLR Status</th>
		</tr>
	</thead>
    
                        

	<tbody>
	<?php 
		$count= 0;
		foreach($apireportview as $dlr):	
		$count= $count+1;
				
	?>
	<tr>
		<td><?php echo $count; ?></td>
		<td><?php echo $dlr->to_mobileno; ?></td>
		<td><?php echo $dlr->ondate; ?></td>
		<td><?php echo $dlr->noofmessages; ?></td>
		<td><?php echo $dlr->sender_name; ?></td>
        <td><?php echo $dlr->message; ?></td>

		<td>
            <?php
			$string = '';
			
		  if(strlen($dlr->to_mobileno) < 10){
                        $string .= "Invalid Number";
                    } elseif($dlr->dlr_status == 1){
                        $string .= "Delivered";
                    } elseif($dlr->dlr_status == "" || $dlr->dlr_status == 0){
                        $string .= "Pending DLR";
                    }elseif($dlr->dlr_status == 16){
                        $string .= "Invalid Number";
                    } elseif($dlr->dlr_status == 12){
                        $string .= "Not a valid Sender Name";		
                    } elseif($dlr->dlr_status == 13){
                        $string .= "Not a valid Template";	
					
					} else {
                        if($this->_dlr_report_type == 0){
                            $string .= "Delivered";
                        } elseif(($this->_dlr_report_type != 0) && $dlr->dlr_status == 3){
                            $string .= "DND Number";
                        } elseif($this->_dlr_report_type == 2){
                            if($dlr->dlr_status == 2){
                                $string .= "Failed - " . $dlr->error_text;
                            } elseif($dlr->dlr_status == 4){
                                $string .= "Queued at SMSC - " . $dlr->error_text;
                            }
                        } else {
                            $string .= "Delivered";
                        }
                    }
					
			
			
			/*
              if(strlen($dlr->to_mobileno) < 10){
                        $string .= "Invalid Number";
                    } elseif($dlr->dlr_status == "" || $dlr->dlr_status == 0 || $dlr->dlr_status == 1){
                        $string .= "Delivered";
                    } elseif($dlr->dlr_status == 16){
                        $string .= "Invalid Number";
                    } elseif($dlr->dlr_status == 12){
                        $string .= "Not a valid Sender Name";		
                    } elseif($dlr->dlr_status == 13){
                        $string .= "Not a valid Template";	
					
					} else {
                        if($this->_dlr_report_type == 0)
						{
                            $string .= "Delivered";
                        } elseif(($this->_dlr_report_type != 0) && $dlr->dlr_status == 3){
                            $string .= "DND Number";
                        } elseif($this->_dlr_report_type == 2){
							
                            if($dlr->dlr_status == 2){
                                $string .= "Failed - " . $dlr->error_text;
                            } 
							elseif($dlr->dlr_status == 4){
                                $string .= "Queued at SMSC - " . $dlr->error_text;
                            }
							
                        } else 
						{
                            $string .= "Delivered";
                        }
                    }*/
					echo   $string;
            ?>
            
		</td>		 	
	</tr>
		 
	<?php 

	endforeach;
	?>
	</tbody>
	</table>

		 <div align='' class="pagination col-md-6 well" style="background-color:transparent !important; border:none !important; box-shadow:none !important; margin-top: -2px;margin-bottom:50px; float:right; text-align:right;">
		  <?php //echo $this->pagination->create_links(); ?>
		</div>
</div>

<div class="col-md-1 well" style="background-color:transparent !important; border:none !important; box-shadow:none !important;"></div>
    </div>
        </div>
        </section>
        
      
       
                   
<div class="clearfix"></div>




           <!--footer starts-->                


      <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->

  
  
  
</html>
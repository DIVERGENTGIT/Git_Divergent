
   <link href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />

 <script>
 $(document).ready(function(){
  $(function() {
    $(":file").filestyle({input: false});
  });
});
 </script>
 
<style type="text/css">

.T-Color:hover{ text-decoration:underline;}
.T-Color{ color:#585655; }
#example1 th{color:#000;}
#Creat-user-Modal3716{width: 602px !important;    padding: 0px !important;    height: 463px;}
.modal-footer.span3{width: 96% !important;}
.modal-dialog{margin-top: 0px  !important;}
#example1_length select{padding: 6px 10px !important;
    margin: 16px 10px;}
	#example1_filter input{padding: 6px !important;
    margin-top: 12px;}
	#Creat-user-Modal3716 .modal-content {    box-shadow: none !important;
    border: 0px !important;}
	.modal-header .close{    margin-top: 8px;
    margin-right: 12px;
    color: #fff;
    opacity: 1;
    font-size: 35px;}
	#Creat-user-Modal3716 .modal-body{padding: 0px 20px 15px 0px;}
	.Table{display:block !important;}
	
	/* pagination */
	
	div#example1_length {
    display: none;
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

ul.pagination {
    display: none;
}
div#example1_info {
    display: none;
}
div#example1_filter {
    display: none;
}
	
</style>

  <body class="skin-blue sidebar-mini">
    <div class="col-sm-9 col-md-9 col-xs-12 padding_zero">


      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <!--<section class="content-header">
          <h1>
         
            <small>SMS Striker</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>-->

        <!-- Main content -->
        <section class="col-sm-12 col-md-12 col-xs-12">
      
         <div class="panel panel-default">
              <!--  <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Reports</strong></div>-->
			  
			  
			  
		
                <div class="panel-heading" style="font-weight: bold;"><span class="glyphicon glyphicon-th"  ></span>My Users</div>
                         <div class="panel panel-default col-md-12" >
                     
                          <div class="box" style="border-top:0px !important;">
                <div class="box-header">
                </div><!-- /.box-header -->
                <div class="box-body">
				<div class="col-sm-12">
				<a href="<?php echo base_url();?>index.php/reseller/createUser" class="add_usericon">+ Add user</a>
				</div>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th class="sendee-color">Sc No</th>
                        <th class="sendee-color">User Name</th>
                        <th class="sendee-color">First Name</th>
                        <th class="sendee-color">Registered On</th>
                        <th class="sendee-color">Last Login</th>
                         <th class="sendee-color">Balance</th>
                          <th class="sendee-color">Add Balance</th>
                      </tr>
                    </thead>
                    <tbody>
                    	<?php 
		$countu=0;
		 if(!empty($rownum)){
			 $countu=$countu+$rownum; 
		}
		foreach($users as $user) :		 
		$countu++;
	?>
                      <tr>
                      <td><?php echo $countu; ?></td>
                        <td><?php echo $user->username; ?></td>
                        <td><?php echo $user->first_name; ?></td>
                        <td><?php echo $user->registered_on; ?></td>
                        <td><?php if($user->login_time) { echo $user->login_time; } else { echo "---"; } ?></td>
                        <td><?php echo $user->available_credits; ?></td>
                        <td> 
                        <a data-href="<?php echo base_url(); ?>index.php/reseller/myUsers/usersbalance/puid/<?php echo $user->user_id; ?>";  class="T-Color btn btn-default btn-sm" style="text-decoration:none;"  data-toggle="modal" data-target="#Creat-user-Modal<?php echo $user->user_id;?>"> Add Balance</a>
                                 </td>
                                               
                      </tr>

         <div id="Creat-user-Modal<?php echo $user->user_id;?>" class="modal fade" tabindex="-1" role="dialog">
         
          

        <div class="modal-dialog modal-md">
        
            <div class="modal-content ">
           
            
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">User Payments </h4>
                </div>
                <div class="modal-body">
                                     <form class="form-horizontal" method="POST" action="<?php echo base_url()?>index.php/reseller/myUsers" name="add_sms_form">

        <div class="form-group" >
            <label for="no_of_sms"  style="text-align:right;" class="control-label col-xs-3">No. Of SMS :</label>
            <div class="col-xs-9">
                <input type="text" class="form-control" id="no_of_sms" placeholder="No. Of SMS" name="no_of_sms">
            </div>
        </div>
     <div style="margin-bottom:1px !important;">&nbsp;</div>
        
        <div class="form-group">
            <label for="form_error"  style="text-align:right;" class="control-label col-xs-3">Price :</label>
            <div class="col-xs-9">
                <input type="text" class="form-control" id="price" name="price"  placeholder="Price"/>
            </div>
        </div>
		  <div style="margin-bottom:1px !important;">&nbsp;</div>
            <div class="col-xs-offset-3 col-xs-9">
            <input type="hidden" class="form-control" id="resellers_user_id" name="resellers_user_id" value="<?php echo $user->user_id;?>" />
                <input type="submit"  name="add_balance" class="btn btn-sm btn-primary" value="Add Balance"/>
                    <button type="button" class="btn btn-sm btn-primary"  data-dismiss="modal">Cancel</button>
  
               
                       
                </div>
                <div style="margin-bottom:1px !important;">&nbsp;</div>
                
                <div class="modal-footer span3" >
                
                
                   <div  id="example1_1" class="table table-bordered  " style="height:200px !important;">
    <div class="Title">
       
    </div>
	
    <div class="Heading" >
        <div class="Cell">
            <p>Sl. No</p>
        </div>
        
        <div class="Cell">
            <p>On Date</p>
        </div>
        
        <div class="Cell">
            <p>No. of SMS</p>
        </div>
        <div class="Cell">
            <p>Price/SMS</p>
        </div>
        
        <div class="Cell">
            <p>Total Amount</p>
        </div>
        
    </div>
        <?php
       $total_payments = $this->reseller_model->get_user_payments_count($user->user_id, $mainusersid);
		$off_set = $this->uri->segment(4);
		$limit = 1000;
		$payments_data = $this->reseller_model->get_user_payments($user->user_id, $mainusersid, $off_set, $limit);

	$count=0;
	foreach($payments_data as $payment) :	
	$count=$count+1;	 
	?>
    <div class="Row">
        <div class="Cell">
            <p><?php echo $count; ?></p>
        </div>
        <div class="Cell">
            <p><?php echo $payment->on_date; ?></p>
        </div>
        <div class="Cell">
            <p><?php echo $payment->no_of_sms; ?></p>
        </div>
         <div class="Cell">
            <p><?php echo $payment->price; ?></p>
        </div>
        <div class="Cell">
            <p><?php echo $payment->total_amount; ?></p>
        </div>
        <!--<div align='center' class="pagination">
	<?php //echo $this->pagination->create_links(); ?>
</div>-->
    </div>
<?php 
	endforeach;
	?>
  
</div> 

                </div></form>  </div> 
                <style type="text/css">
				.span3 {  
    height:auto !important;
    overflow: scroll;
}
    .Table
    {
        display: table; 
    overflow: scroll;
    }
    .Title
    {
        display: table-caption;
        text-align: center;
        font-weight: bold;
        font-size: larger;
    }
    .Heading
    {   
        display: table-row;
        font-weight: bold;
        text-align: center;
    }
    .Row
    { 
        display: table-row;
    }
    .Cell
    {
        display: table-cell;
        border: solid;
        border-width: thin;
        padding-left: 5px;
        padding-right: 5px;
    }
	
</style>
                 
              
            </div>
             
        </div>
       
   
        </div>
               
    
                  <?php
					 
	$count++; 
	endforeach;
	?>
                    </tbody>
                  
                  </table>
				  <style>
				  
				  </style>
				  <div align='center' class="F_pagination">
				
				<?php echo $this->pagination->create_links(); ?>
				
	   </div>
                  <!--
                   <table id="example1_1" class="table table-bordered table-striped">
                    <thead>
                    <?php 
	$count=1;
	foreach($payments as $payment) :		 
	?>
                      <tr>
                        <th class="sendee-color">Sc No</th>
                        <th class="sendee-color">On Date</th>
                        <th class="sendee-color">No. of SMS</th>
                        <th class="sendee-color">Price/SMS</th>
                        <th class="sendee-color">Total Amount</th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
		<td><?php echo $count; ?></td>
		<td><?php echo $payment->on_date; ?></td>
		<td><?php echo $payment->no_of_sms; ?></td>
		<td><?php echo $payment->price; ?></td>
		<td><?php echo $payment->total_amount; ?></td>				 	
	</tr><?php 
	$count++; 
	endforeach;
	?>
                    </tbody>
                   
                  </table> -->
           
                </div><!-- /.box-body -->
              </div>
                          
           
                          
                           
	  <!--Creat-user-Modal small modal start -->
	   
	   
	   
	 
</div></div></section></div></div>
                   
<div class="clearfix"></div>

           <!--footer starts-->


      <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url(); ?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/js/app.min.js" type="text/javascript"></script>

     <script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
    
    
    
    
    
    
    
   <!-- model data table js code-->
    
    
     
  </body>
</html>

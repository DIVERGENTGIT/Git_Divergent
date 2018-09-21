<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>SMS Striker</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="<?php echo base_url();?>assets/css/striker.min.css" rel="stylesheet" type="text/css" />
    <!-- jvectormap -->
    <link href="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/css/jquery.datetimepicker.css" type="text/css" rel="stylesheet">
    <!-- Theme style -->
    <!--<link href="sassets/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />-->
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url();?>assets/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/custom-css.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    
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
 .panel.panel-default.col-md-4 {
    margin-left: 30px;
}
 .table-nonfluid {
   width: auto !important;
   margin:0px 10px !important;
}
th.sendee-color {
    padding: 9px 10px !important;
}

td.my-td {
    padding: 9px 10px !important;
}
th.sendee-color {
    max-width: 150px ;
    min-width: 127px ;
	border-right:1px solid #fff !important;
}
.panel.panel-default.col-md-7.my-scroll {
    min-height: 156px !important;
    max-height: 470px  !important;
}

section.content {
    margin-top: 36px !important;
}

.panel>.table:last-child {
 
    width: 609px !important;}
	
	
.my-scroll{
overflow-y: scroll;
overflow-x: hidden;

visibility: visible;


} 
::-webkit-scrollbar { 
width: 6px;
}
::-webkit-scrollbar-button {
    background:
}
::-webkit-scrollbar-thumb {
  background-color:  #ccc; border:none;
  outline: 1px solid slategrey;
}	
 </style>
 
 
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
       
		
		
        
        
      
       
	   
	   
	   
	   
	   
	   
	<section class="content" style="padding-left:0px;">
    <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span>Sender ID</strong></div>
        <div class="col-md-12 col-sm-12 col-xs-12 ng-scope" data-ng-controller="formConstraintsCtrl"  style="padding-right: 5px !important;
">

            <div class="panel panel-default col-md-7 my-scroll" style=" padding:0px; ">
              
               <table class="table table-bordered  table-striped  table-nonfluid" style="padding:0px !important; margin:0px !important;">
                    <tbody>
					<tr >
                      <th class="sendee-color" style="">S No</th>
                      <th class="sendee-color" style="">Date</th>
					<th class="sendee-color">Sender Name</th>
                      <th class="sendee-color">Status</th>
					    <th class="sendee-color" style="">Action</th>
                    </tr>
					<?php 
	if(count($sender_names)>0): ?>
	<?php $count = 0; ?>
	<?php foreach($sender_names as $row): ?>
	<?php if($count%2 == 0): $class = ""; else: $class = "alternate-row"; endif; ?>
	<?php $count++; ?>
                    
					<tr height="35" class="<?php echo $class; ?>">
		
		  <td class="my-td"  ><?php echo $count; ?></td>
          <td class="my-td"  ><?php echo $row->on_date; ?></td>
		<td  class="my-td"><?php echo $row->sender_name; ?></td>
						<td class="">
							<?php
							if($row->status == 0):
								echo "Pending";
							elseif($row->status == 1):
								echo "Approved";
							elseif($row->status == 2):
								echo "Rejected";
							endif;
							?>
						</td>
						 <td class="my-td">
					<!-- <span  href="#Sender-Modal" data-toggle="modal" class="badge bg-blue">Edit</span>  -->
							 
							 
						 <span class="btn btn-sm btn-default"   
					data-toggle="confirmation" 
					data-btn-ok-label="Yes" 
					data-btn-ok-icon="glyphicon glyphicon-share-alt"
					data-btn-ok-class="btn-success" data-btn-cancel-label="NO!" 
					data-btn-cancel-icon="glyphicon glyphicon-ban-circle" 
					data-btn-cancel-class="btn-danger"
					data-original-title="" title="" 
					style="" 
					data-href="<?php echo site_url('myaccount/delete_sender_name/'.$row->id); ?>";
					>Delete</span> 
					
			
				 
				 
				 </td>
				 <!--
		<td class="options-width">
							   <input type="button" alt="Delete" class="delete_icon" value="" onClick=" if(confirm('Do you want to delete this sender name?')) { window.location.href='<?php echo site_url('myaccount/delete_sender_name/'.$row->id); ?>'; } "  />
						</td> -->
		
		
	</tr>
		 
	<?php endforeach; ?>
	<?php else: ?>
	<tr>
                        <td  class="my-td"colspan="5" align="center" height="100"> No Records</td>
                    </tr>
                        <?php endif; ?>

	
					
                   
                
                  </tbody></table>  

				  
				   
			
      </div>
	  
	  
	   <div class="panel panel-default col-md-5 " style=" background-color: #ECF0F5;     HEIGHT: 156px;">
        <div class="panel panel-default col-md-12" style=" background-color: #fff;     HEIGHT: 156px; margin: 0px 5px;">
	   <h4 style=" font-size: 15px;
    color: #215A94;"> Request For A Sender ID</h4>
	  
<?php echo form_open('myaccount/sender_names',
									array('id' => 'form', 'name' => 'add_sender_name_form', 'method' => 'post', 'class' => 'login_text ','style' => 'height:28px; border-radius:2px;' )
								); ?>
  <div class="form-group">
    
   <?php echo form_input(array('name' => 'sender_name', 'id' => 'sender_name', 'value' => set_value('sender_name'), 'class'=> form_error('sender_name') ? 'inp-form-error' : 'inp-form', 'maxlength' => 6 ));?>&nbsp; &nbsp; &nbsp; 
 
 
 <?php echo form_submit(array('name' => 'add_sender_name','value' => 'Add', 'class' => 'btn btn-default btn-sm', 'style'=>' margin-top:0px'));?>
<?php if(form_error('sender_name')): ?>	
  </div>
  
  
  
											
											<div class="fa fa-exclamation-triangle" >
											<?php echo form_error('sender_name', '<span style="float:left;color:#dd4b39; font-size:14px;font-weight:bold;">', '</span>'); ?></div>
											<?php endif; ?>
		
			
           <div class="direct-chat-messages" style="margin-top:20px;     height: auto; padding-bottom: 40px;">
                    <!-- Message. Default to the left -->
                  
                      
                     
  
                        <p>
		
		<?php if(isset($added)): ?>
		 <span class="direct-chat-img"><i class="fa fa-exclamation-triangle" style=" color:#dd4b39; font-size:25px;" >  </i></span>
		<div class="direct-chat-text">
		 	<?php echo $added; ?>
		</div>
	<?php elseif(isset($edited)): ?>
	 <span class="direct-chat-img"><i class="fa fa-exclamation-triangle" style=" color:#dd4b39; font-size:25px;" >  </i></span>
		<div class="direct-chat-text">
		 	<?php echo $edited; ?>
		</div>
	<?php elseif(isset($deleted)): ?>
	 <span class="direct-chat-img"><i class="fa fa-exclamation-triangle" style=" color:#dd4b39; font-size:25px;" >  </i></span>
		<div class="direct-chat-text">
		 	<?php echo $deleted; ?>
		</div>		
	<?php endif; ?>
		</p>
                      </div><!-- /.direct-chat-text -->
                    </div><!-- /.direct-chat-msg -->
	<?php echo form_close();?>

                   </div> 
                                
                  </div>    
                  
	  </div>
	  
        </div>
		
        
        </section>  

		
		 
		
	   
	 
	   
	   
	   
	  <!-- Edit modal start-->
	   
	   
	    <!--<div id="Edit-Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Template</h4>
                </div>
                <div class="modal-body">
                     <div class="form-group">
                
                    <label for="" class="col-sm-3">Text </label>
                    <div class="col-sm-9">
                        <textarea name="" id="text" class="form-control" rows="4"></textarea>
                        <td> 
                        <h6  class="label label-info" id="count_message">0</h6><small  style="margin-left:10px; color:#016EC7">Number of Charters</small></td><br>
                        <td><span class="label label-info" id="hwmnysms">0</span></td> <small  style="margin-left:10px; color:#016EC7">Number of SMS</small>
                    </div>
                     
                </div>
                
                    <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info">Save changes</button>
                </div>
            </div>
        </div>
    </div>-->
	   
	   
	   
	  <!-- Edit modal end-->  
	   
	   
	   
	    <!-- Delete modal start-->
	   
	   
	  
        
	   
	   
	  <!-- Edit Sender ID modal end-->  
        
        
        <!--<div id="Sender-Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Edit Sender ID</h4>
                </div>
                <div class="modal-body">
                     <div class="form-group">
                
                    <label for="" class="col-sm-3">Edit Sender ID </label>
                    <div class="col-sm-9">
                       <input type="text"  class="form-control col-md-4" > 
                    </div>
                     
                </div>
                
                    <p class="text-warning"><small>If you don't save, your changes will be lost.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-info">Save changes</button>
                </div>
            </div>
        </div>
    </div>-->
        
      
      
    





                   
<div class="clearfix"></div>




           <!--footer starts-->     
		   <?php //require_once('includes/footer');?>


      <!-- Control Sidebar -->
    
         
      <div class='control-sidebar-bg'></div>

    </div><!-- ./wrapper -->
</div>
   <!-- jQuery 2.1.4 -->
    
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>assets/js/app.min.js" type="text/javascript"></script>
   
    <!-- jvectormap -->
    <!-- SlimScroll 1.3.0 -->
    <script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>
   

<script src=" <?php echo base_url();?>assets/js/bootstrap-confirmation.min.js" type="text/javascript"></script>


<!--<script src="http://www.kptemplates.com/preview/unicorn/js/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>-->

<!-- check box event for datepicker-->

<!--<script type='text/javascript'>
     $(document).ready(function() {
 $('.additional-info-wrap input[type=checkbox]').click(function() {         if($(this).is(':checked')) {             $(this).closest('.additional-info-wrap').find('.additional-info').removeClass('hide').find('input,select').removeAttr('disabled');         }         else {             $(this).closest('.additional-info-wrap').find('.additional-info').addClass('hide').find('input,select').val('').attr('disabled','disabled');         }     }); 
     });
  </script>   -->

    <!-- conformation-->
    <script>
		$(function() {
			$('[data-toggle="confirmation"]').confirmation();
			$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
			$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });
		})
	</script>

  

    <!-- text box text count code-->
<!--<script type='text/javascript'>
        
        $(document).ready(function() {
        
       var text_max = 0;
$('#count_message').html(text_max + '');

$('#text').keyup(function() {
  var text_length = $('#text').val().length;
  var text_remaining = text_max + text_length;
  var persms=text_remaining/160;
    var singlecnt=Math.ceil(persms);
  $('#count_message').html(text_remaining + '');
    $('#hwmnysms').html(singlecnt+ '');
});
        });
        
        </script>-->
		
<!--<script type='text/javascript'>	
 $(document).ready(function() {	
$('[data-toggle=tooltip]').tooltip();
	     });    
        </script>-->	
		
<!--<script type='text/javascript'>	
 $('#myModal').on('show', function() {
    var id = $(this).data('id'),
        removeBtn = $(this).find('.danger');
})

$('.confirm-delete').on('click', function(e) {
    e.preventDefault();

    var id = $(this).data('id');
    $('#myModal').data('id', id).modal('show');
});

$('#btnYes').click(function() {
    // handle deletion here
  	var id = $('#myModal').data('id');
  	$('[data-id='+id+']').remove();
  	$('#myModal').modal('hide');
});
        </script>-->		
		
</html>
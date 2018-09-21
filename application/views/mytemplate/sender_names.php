<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/manage-icon.png" class="right-title-img">Sender ID</h3>
</div>
        <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
        <div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
		 <div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
	  <label for="normsms" class="senderid_lable">Request for Sender ID</label>
	  </div> 
	   <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<?php echo form_open('mytemplate/sender_names',
array('id' => 'form', 'name' => 'add_sender_name_form', 'method' => 'post', 'class' => 'login_text ','style' => 'height:28px; border-radius:2px;' )
); ?>
 	<div class="col-md-3 col-sm-3 col-xs-6 padding_zero">
   
   <?php //echo form_input(array('name' => 'sender_name', 'id' => 'sender_name', 'value' => set_value('sender_name'), 'class'=> form_error('sender_name') ? 'inp-form-error' : 'full-width-input', 'style'=>'', 'maxlength' => 6 ));?>
   <input type="text" name="sender_name" value="" id="sender_name" class="full-width-input alpha-only" style="" maxlength="6">
   </div>
 
 <div class="col-md-4 col-sm-4 col-xs-6">
 <?php echo form_submit(array('name' => 'add_sender_name','value' => 'Add', 'class' => 'submit_btn', 'style'=>' margin-top:0px'));?>
   
  </div>
   </div>
<div class="col-sm-12 col-md-12 col-xs-12 errortxt padding_zero">
<?php if(form_error('sender_name')): ?>	
</div>  
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
											<?php echo form_error('sender_name', '<span class="errortxt">', '</span>'); ?>
											<?php endif; ?>
											</div>
											
	
 
 <div class="col-sm-12 col-md-12 col-xs-12 errortxt padding_zero">
                   <?php  if(isset($senderadded)) { ?>
				  <!-- <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
		  <div class="alert alert-warning">
                   <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">&times;</a>	
				   </div>
				   </div>-->
		 		<?php echo $senderadded; } ?> 
				</div>
		
		 <?php   if(isset($deleted)) { ?>
		  <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
		  <!-- <span class="direct-chat-img"></span>-->
			
			 	<span class="errortxt"><?php echo $deleted; ?></span>
			
</div>			
		 	<?php   } ?>
 </div>
 
        <!--   <div class="direct-chat-messages col-sm-12 col-md-12 col-xs-12">
 <p>
                        	<?php if(isset($senderadded)): ?>
		<div class="alert alert-warning" style="background:#dff0d8 !important;color:#3c763d !important; border: 0px;">
    <a href="#" class="close" style="color:#3c763d;font-weight:bold;right:0px;" data-dismiss="alert">&times;</a>	
		 	<?php echo $senderadded; ?>
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
                      </div>-->
                    </div><!-- /.direct-chat-msg -->
	<?php echo form_close();?>

                   </div> 
            <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
               <div class="table-responsive">
               <table class="table_all">
			    <thead>
			   <tr>
                      <th>S No</th>
                      <th>Date</th>
					<th>Sender Name</th>
                      <th>Status</th>
					    <th>Action</th>
                    </tr>
					 </thead>
                    <tbody>
					
					<?php 
	if(count($sender_names)>0): ?>
	<?php $count = 0; ?>
	<?php foreach($sender_names as $row): ?>
	<?php if($count%2 == 0): $class = ""; else: $class = "alternate-row"; endif; ?>
	<?php $count++; ?>
                    
					<tr class="<?php echo $class; ?>">
		
		  <td><?php echo $count; ?></td>
          <td><?php echo $row->on_date; ?></td>
		<td><?php echo $row->sender_name; ?></td>
						<td>
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
						 <td>
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
					data-href="<?php echo site_url('mytemplate/delete_sender_name/'.$row->id); ?>";
					>Delete</span> 
					
			
				 
				 
				 </td>

	</tr>
		 
	<?php endforeach; ?>
	<?php else: ?>
	<tr>
                        <td colspan="5" align="center" height="100"> No Records</td>
                    </tr>
                        <?php endif; ?>

	
					
                   
                
                  </tbody></table>  

				  
				   
			
      </div>
 </div>    
 </div>

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
   
   

<script src=" <?php echo base_url();?>assets/js/bootstrap-confirmation.min.js" type="text/javascript"></script>


<script type="text/javascript">
$(".alpha-only").on("keydown", function(event){
  // Ignore controls such as backspace
  var arr = [8,16,17,20,35,36,37,38,39,40,45,46];

  // Allow letters
  for(var i = 65; i <= 90; i++){
    arr.push(i);
  }

  if(jQuery.inArray(event.which, arr) === -1){
    event.preventDefault();
  }
});

$(".alpha-only").on("input", function(){
    var regexp = /[^a-zA-Z]/g;
    if($(this).val().match(regexp)){
      $(this).val( $(this).val().replace(regexp,'') );
    }
});
</script>
    <!-- conformation-->
    <script>
		$(function() {
			$('[data-toggle="confirmation"]').confirmation();
			$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
			$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });
		})
	</script>

     
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
		
</html>

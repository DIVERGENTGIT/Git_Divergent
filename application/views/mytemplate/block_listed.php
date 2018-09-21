<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/manage-icon.png" class="right-title-img">Blocked Numbers</h3>
</div>
        <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
        <div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
		 <div class="col-md-12 col-sm-12 form-div col-xs-12 padding_zero">
	  <label for="normsms" class="senderid_lable">Mobile Number</label>
	  </div> 
	   <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<?php echo form_open('mytemplate/block_listed_numbers',
array('id' => 'form', 'name' => 'add_block_number_form', 'method' => 'post', 'class' => 'login_text ','style' => 'height:28px; border-radius:2px;' )
); ?>
 	<div class="col-md-3 col-sm-3 col-xs-6 padding_zero">
   
      <input type="text" name="bNumber"  id="bNumber"   maxlength=10 class="full-width-input" >
 
   </div>
   
 <div class="col-md-4 col-sm-4 col-xs-6">
 <?php echo form_submit(array('name' => 'add_number','value' => 'Add', 'class' => 'submit_btn', 'style'=>' margin-top:0px'));?>
   
  </div>
   </div>
<div class="col-sm-12 col-md-12 col-xs-12 errortxt padding_zero">
<?php if(form_error('sender_name')): ?>	
</div>  

											<?php endif; ?>
											
	 	<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
			 <?php echo form_error('bNumber', '<span class="errortxt">', '</span>'); ?>
			 </div>
											
	
 
 <div class="col-sm-12 col-md-12 col-xs-12 errortxt padding_zero">
                   <?php  if(isset($number)) { ?>
				 
		 		<?php echo $number; 
		 		} ?> 
				</div>
		
		 <?php   if(isset($deleted)) { ?>
		  <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
 
			
			 	<span class="errortxt"><?php echo $deleted; ?></span>
			
</div>			
		 	<?php   } ?>
 </div>
  
                    </div> 
	<?php echo form_close();?>

                   </div> 
            <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
               <div class="table-responsive">
               <table class="table_all">
			    <thead>
			   <tr>
                      <th>S No</th>
                      <th>Date</th>
 			<th>Number</th>
 
					    <th>Action</th>
                    </tr>
					 </thead>
      			 </thead>
                    <tbody>
					
					<?php 
	if(count($blockedNumbers)>0): ?>
	<?php $count = 0; ?>
	<?php foreach($blockedNumbers as $row): ?>
	<?php if($count%2 == 0): $class = ""; else: $class = "alternate-row"; endif; ?>
	<?php $count++; ?>
                    
					<tr class="<?php echo $class; ?>">
		
		  <td><?php echo $count; ?></td>
          <td><?php echo $row->dateTime; ?></td>
		<td><?php echo $row->mobile_no; ?></td>
						 
		 <td>
 
							 
							 
						 <span class="btn btn-sm btn-default"   
					data-toggle="confirmation" 
					data-btn-ok-label="Yes" 
					data-btn-ok-icon="glyphicon glyphicon-share-alt"
					data-btn-ok-class="btn-success" data-btn-cancel-label="NO!" 
					data-btn-cancel-icon="glyphicon glyphicon-ban-circle" 
					data-btn-cancel-class="btn-danger"
					data-original-title="" title="" 
					style="" 
					data-href="<?php echo site_url('mytemplate/delete_blocked_number/'.$row->id); ?>";
					>Delete</span> 
					
			 
				 
				 
				 </td>				  
	</tr>
		 
	<?php endforeach; ?>
	<?php else: ?>
	<tr>
                        <td colspan="4" align="center" height="100"> No Records</td>
                    </tr>
                        <?php endif; ?>

	
					
                   
                
                  </tbody></table>  

				  
				   
			
      </div>
 </div>    
 </div>

</div>
   <!-- jQuery 2.1.4 -->
        <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> 
  
   

<script src=" <?php echo base_url();?>assets/js/bootstrap-confirmation.min.js" type="text/javascript"></script>



    <!-- conformation-->
    <script>
		$(function() {
			$('[data-toggle="confirmation"]').confirmation();
			$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
			$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });
		})
	</script>

     

 
  <script>
  $('#bNumber').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  });
    </script>
		
</html>


 
<?php
foreach($groupdetails as $rec):
 
?>
				 
                   <div id="page1" class="col-md-12 col-sm-12 col-xs-12 padding_zero">
      
                            <ul class="list-unstyled gr_list list-info">
                             <li> 
                             <div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
                             <span class="grc_left">Group Name : </span>
									</div>
									<div class="col-md-6 col-sm-6 padding_zero col-xs-12">
                                  <?php echo $rec['group_name']; ?>
                                   </div>
                                </li>
                               
                                <li>
                                    <div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
                                  <span class="grc_left">Created On : </span>
									</div>
									 <div class="col-md-6 col-sm-6 padding_zero col-xs-12">
									<?php echo $rec['created_on']; ?>
                                   </div>
                                </li>
                                
                                  <li>
                                   <div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
                                   <span class="grc_left">No. of Contacts : </span>
									</div>
									 <div class="col-md-6 col-sm-6 padding_zero col-xs-12">
									<?php echo $groupcount; ?>
                                   </div>
                                </li>
								</div>
                                       
					 
					  

<input type="button" class="submit_btngrp" data-toggle="modal" data-target="#Add-Contact" value="Add" />
       <button class="submit_btngrp" data-toggle="modal" data-target="#largeModal">Edit</button>       
              <!--  <input type="button" data-toggle="modal" data-target="#Addcontacto-group"class="btn btn-default" value="Add Multiple Contacts" style="height:30px;line-height:10px;   margin-left:4px;color:#222;"/>-->
 <a class="submit_btngrp ancbtn" href="<?php echo site_url('contacts/deleteGroup/group/'.$rec['group_id']); ?>"
			onClick=" return confirm('Are you sure you want to delete this group? you will lose all the contacts in this Group.')"
		><span>Delete</span> </a>

<a href="#add-multiple" data-toggle="modal" data-target="#add-multiple" class="submit_btngrp">Add Multiple</a>  
<a  c class="submit_btngrp ancbtn" href="<?php echo site_url('contacts/Download/group/'.$rec['group_id']);?>"><span>Download</span> </a>  
 <form method="POST" style="float:right; margin-right:7px;" action="<?php echo base_url(); ?>contacts/sendGroupSMS">
     <input class="#Send-group" type="hidden" name="groups" id="group_<?php echo $groups_count=1; ?>" value="<?php echo $rec['group_id'];?>">

<!--  <input class="#Send-group" type="hidden" id="groups" name="group_<?php echo $groups_count=1; ?>" value="<?php echo $rec['group_id'];?>">
 -->

					  	<input type="hidden"  name="groups_count" value="<?php echo $groups_count=1; ?>" />
  <button type="submit" style=" margin-right: 9px;" data-toggle="modal" data-target="#Send-group2" value="Contact" class="submit_btngrp">Send SMS</button> 
  </form>
                            </ul>
                     
			   
				
<div id="add-multiple"class="modal fade">
        <div class="modal-dialog modal-md">
            <div class="modal-content col-sm-12 col-md-12 col-xs-12 padding_zero">
                <div class="modal-header">
				
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                   
                </div>
                <div class="modal-body col-sm-12 col-md-12 col-xs-12">
<form class="add-multple-form" action="<?php echo base_url();?>contacts/multiContactsToGroup" method="post" enctype="multipart/form-data">
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
		<div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
		<label class="form_lable">Group Name:</label>
		</div>
	<div class="col-md-7 col-md-7 col-xs-12">
		<input type="text" name="group_multple" value="<?php echo $rec['group_name']; ?>" >
		</div>
        </div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
		<div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
		<label class="form_lable">Upload File:</label>  
		</div>  
	<div class="col-md-7 col-md-7 col-xs-12">  
		<div class="fileUpload btn submit_btn">
					    <span>Upload</span>
					  <!--  <input   name="userfile" type="file" class="upload"> -->
 <input type="file" name="userfile" class="upload" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"   >  
					</div>
		</div>
        </div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
		
	<div class="col-md-7 col-md-7 col-sm-offset-3 col-md-offset-3 col-xs-12">
		<input type="submit" name="submitMultpleContacts" class="submit_btn">
		</div>
        </div>
</form>

</div>	
</div>	
</div>	
</div>	


				   
<div id="largeModal"class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" style="background: transparent;">
        <div class="modal-dialog modal-md">
            <div class="modal-content col-sm-12 col-md-12 col-xs-12 padding_zero">
                <div class="modal-header">
				
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                   
                </div>
                <div class="modal-body col-sm-12 col-md-12 col-xs-12"> 
                <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
    
<?php echo form_open_multipart('contacts/editGroup/group/'.$group_id,
		array(
			'id' => 'edit_group_form', 'class' => 'missedcall_allform',
			'name' => 'edit_group_form',
			'method' => 'post')
		); 
	?>
    <div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
	 <div class="col-sm-3 col-md-3 col-xs-12 padding_zero">
      <label class="form_lable">Group Name:</label>
	  </div>
	   <div class="col-sm-7 col-md-7 col-xs-12">
      <input type="text" class="" id="groupName"  name="group_name" value="<?php echo $rec['group_name']; ?>">
    </div>    </div>
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
	   <div class="col-sm-7 col-md-7 col-xs-12 col-sm-offset-3 col-md-offset-3">
<?php echo form_submit(array('name' => 'edit_group','value' => 'Save', 'class' => 'submit_btn','style'=>''));?>
    </div>
	</div>
 
	<?php echo form_close(); ?>
				
				   </div>
				   </div>
				   </div>
				   </div>
				   </div>
				   

										 
	 
 </div>
	 </div>
</html>
	
				   
			<?php endforeach; ?>	   
				   
				   
			   
	<script>
$(document).ready(function() {
$("#edit_group_form").validate({
    rules: {
        
		'group_name': {
            required: true
		        }
		 
		
    },
    messages: {
        
		'group_name': {
            required: "Please Enter Group Name"            
        }
    },
	tooltip_options: {
		'group_name': {placement:'bottom',html:true}
		}
}); 
}); 
 </script>
			   
				   
				   
	
<script>
	
$(".add-multple-form").validate({
    rules: {
	group_multple: {
          required:true			
        },
		userfile: { 
          required:true		
        }
    },
	messages: {
		group_multple: {
            required: "Please Enter Group Name"            
        },
		userfile: {
            required: "Please Upload File"            
        }

    },
  
	tooltip_options: {

		group_multple: {placement:'bottom',html:true},
		userfile: {placement:'bottom',html:true}
		}
});
  
</script>			   
				   
				   
				   
				   
				   
				   
				   
				   
				   
                   


 
 


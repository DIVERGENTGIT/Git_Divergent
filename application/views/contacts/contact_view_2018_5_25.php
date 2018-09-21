 
   <?php //$contacts = $contact[0]; 
   	foreach($contact as $contacts) { ?>
    <div id="page1" class="col-md-12 col-sm-12 col-xs-12 padding_zero">
        
                            <ul class="list-unstyled gr_list list-info">
                             <li>
                                    <div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
                                   <span class="grc_left">Contact Name</span>
									</div>
									 <div class="col-md-6 col-sm-6 padding_zero col-xs-12">
                            <?php  echo $contacts->name;  ?>
                                   </div>
                                </li>
                                <li>
                                    <div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
                                   <span class="grc_left">Mobile No</span>
                                      </div>
								  	   <div class="col-md-6 col-sm-6 padding_zero col-xs-12">
									<?php  echo $contacts->mobile_no;  ?>
                                   </div>
                                </li>
                                
                                  <li>
                                    <div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
                                   <span class="grc_left">Address</span> 
									</div>
									 <div class="col-md-6 col-sm-6 padding_zero col-xs-12">
									<?php  echo $contacts->address;  ?>
                                   </div>
                                </li>
                                <li>
                                    <div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
                                   <span class="grc_left">Joining Date</span>
</div>
 <div class="col-md-6 col-sm-6 padding_zero col-xs-12">
									<?php  echo $contacts->join_date;  ?>
                                   </div>
                                </li>
                                  
                    

              </ul>
             
                  
                   </div>
        <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
  <button type="submit"  data-toggle="modal" data-target="#contact-edited" class="submit_btn">Edit  </button>
	<button class="submit_btn" id="deleteCont">	  
		<!-- <a style="color:#58595b !important" href="<?php echo base_url();?>contacts/deleteContact/contact/<?php echo $contacts->contact_id; ?>" onClick="return confirm('Are you sure you want to delete this contact?');"  id="deleteCont">Delete</a></button>
-->
  Delete </button> 
       
<form name="contacts_sms" style="float:right;" id="contacts_sms" method="post" action="<?php echo base_url();?>contacts/sendSMS">
 <input type="submit"  value="Send Contact SMS" class="submit_btn">
        <input type="hidden" id="contacts" name="contact_<?php echo $contacts_count=1; ?>" value="<?php echo $contacts->contact_id;?>"></input>
        <input type="hidden" name="group" value="<?php echo $contacts->group_id; ?>"></input>
	<input type="hidden" name="contacts_count" value="<?php echo $contacts_count=1; ?>"></input>
  
  
          </form> 
</div>
<div id="contact-edited" class="modal fade">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                   
                </div>
                <div class="modal-body"> 
				
				<?php
				
			

?>
<form method="POST" class="form-horizontal"  role="form" action="<?php echo base_url();?>contacts/editContact" name="edit_contact_form" id="edit_contact_form">

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
      <label class="form_lable">Group</label>
	  </div>
   <div class="col-md-7 col-sm-7 col-xs-12">
	  <select name="group" class="form-control" style="padding:0px !important;height:42px;"> 
	  <?php foreach($groups as $grouplist ){  ?>

	  <option value="<?php echo $grouplist->group_id; ?>" <?php if($grouplist->group_id==$contacts->group_id){ echo "selected";} ?>><?php echo $grouplist->group_name; ?></option>
	  <?php }?>  
	  </select>	
       </div>

	 </div>
     
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
      <label class="form_lable">Name</label>
	  </div>
      <div class="col-md-7 col-sm-7 col-xs-12">
	      <input type="text" class="form-control" id="contact_name"  name="contact_name" value="<?php echo $contacts->name; ?>">

	 </div>
	 </div>
	<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
	<div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
      <label class="form_lable">Mobile Number</label>
	  </div>
      <div class="col-md-7 col-sm-7 col-xs-12">
	      <input type="text" class="form-control" id="contcat_mobileno"  name="contcat_mobileno" value="<?php echo $contacts->mobile_no; ?>">

	 </div>
	 </div>
     
	<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
	<div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
      <label class="form_lable">Gender</label>
	  </div>
	  <div class="col-md-7 col-sm-7 col-xs-12">
	     <label for="radio" class="" style="padding-right:5px;text-align: left;"> <input type="radio"   name="contact_gender" value="Male" <?php if($contacts->gender=='Male'){ echo "checked"; } ?> style="margin-top:0px;"> Male </label>
		  	     <label for="radio" class="" style="padding:4px 0px;text-align: left;">   <input type="radio"   name="contact_gender" value="Female" <?php if($contacts->gender=='Female'){ echo "checked"; } ?>  style="margin-top:0px;"> Female </label> 
	 </div>
	 </div>
     
     
	<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
	<div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
      <label class="form_lable">Date Of Birth</label>
	  </div>
     <div class="col-md-7 col-sm-7 col-xs-12">
<input type="text" class="form-control" id="dob2"  name="dob" value="<?php echo $contacts->dob; ?>">
     </div>

	 </div>
	 <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
	 <div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
      <label class="form_lable">Address</label>
	  </div>
      <div class="col-md-7 col-sm-7 col-xs-12">
	      <input type="text" class="form-control" id="address"  name="address" value="<?php echo $contacts->address; ?>">
      </div>
	 
	 </div>
	  <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
	  <div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
      <label class="form_lable">Join Date</label>
	  </div>
     <div class="col-md-7 col-sm-7 col-xs-12">
	      <input type="text" class="form-control" id="join_date2"  name="join_date" value="<?php echo $contacts->join_date; ?>">

	 </div>
	 </div>
	  <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
	  <div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
      <label class="form_lable">Relieve Date</label>
	  </div>
     <div class="col-md-7 col-sm-7 col-xs-12">
	      <input type="text" class="form-control" id="relieve_date2"  name="relieve_date" value="<?php echo $contacts->relieve_date; ?>">

	  </div>
	 </div>
	     <div class="modal-footer" style="background:transparent;border:0px;">
		 <div class="col-md-7 col-sm-7 col-sm-offset-3 col-md-offset-3 col-xs-12">
			<input type="hidden" name="contact_id" value="<?php echo $contacts->contact_id; ?>" />
              
<input type="submit" name="edit_contact" value="Edit Contact" class="btn btn-default btn-sm">
                </div> </div>
	  

</div>	</div>
            
           
	</form>
<?php } ?>
 
 
 
 <script>
 $('#deleteCont').on('click',function() {
	var deleteConf = confirm('Are you sure you want to delete this contact?');
	if(deleteConf) {
	window.location.href="<?php echo base_url();?>contacts/deleteContact/contact/<?php echo $contacts->contact_id; ?>";	
	}else{}
 
 });
 
 </script>
   <script>
    $(document).ready(function() {
    $("#dob2").datepicker({
	dateFormat: "yy-mm-dd",
        changeMonth: true,
    	changeYear: true
	}
	);
  });
  </script>
<script type="text/javascript">
$(document).ready(function(){ 
 
$('#join_date2').datepicker( {
    	changeMonth: true,
    	changeYear: true, 
    	dateFormat: "yy-mm-dd",
		 maxDate: new Date(),
		 
		onSelect: function (selectedDate) {
                var orginalDate = new Date(selectedDate);
               var monthsAddedDate = new Date(new Date(orginalDate).setMonth(orginalDate));
                
       $("#relieve_date2").datepicker("option", 'minDate', selectedDate);
               // $("#relieve_date").datepicker("option", 'maxDate', monthsAddedDate);
            }
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });   
	$('#relieve_date2').datepicker( {
    	changeMonth: true,
    	changeYear: true, 
    	dateFormat: "yy-mm-dd",    
		// maxDate: new Date(),
	
		onSelect: function (selectedDate) {
                var orginalDate = new Date(selectedDate);
               var monthsAddedDate = new Date(new Date(orginalDate).setMonth(orginalDate - 1));
               
               $("#join_date2").datepicker("option", 'minDate', monthsAddedDate);
                //$("#join_date").datepicker("option", 'minDate', selectedDate);
            }
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });
});
</script>
 
 <script>
	


$("#edit_contact_form").validate({
    rules: {
	contact_name: {
          required:true,
            regexpcol: true			
        },
		contcat_mobileno: {
          required:true		
        }/*,
		contact_gender: {
          required:true,
            regexpcol: true			
        },
		dob: {
          required:true,
            regexpcol: true			
        },  
	 	address: {
          required:true,
            regexpcol: true			
        },
	 	join_date: {
          required:true,
            regexpcol: true			
        },
		relieve_date: {
          required:true,
            regexpcol: true			
        }   */

    },
	messages: {
		contact_name: {
            required: "Please Enter Contact Name"            
        },
		contcat_mobileno: {
            required: "Please Enter Mobile Number"            
        }/*,
		contact_gender: {
            required: "Please Select Gender"            
        },
	   dob: {
            required: "Please Enter Date Of birth"            
         },
		address: {  
            required: "Please Enter Address"            
        },
		join_date: {
            required: "Please Enter join date"            
        },
		relieve_date: {
            required: "Please Enter relieve date"            
        }   */

    },
  
	tooltip_options: {

		contact_name: {placement:'bottom',html:true},
		contcat_mobileno: {placement:'bottom',html:true} 
		/* contact_gender: {placement:'bottom',html:true},
		 dob: {placement:'bottom',html:true},
		address: {placement:'bottom',html:true},
		join_date: {placement:'bottom',html:true},
		relieve_date: {placement:'bottom',html:true}  */
		}
});
  
</script>


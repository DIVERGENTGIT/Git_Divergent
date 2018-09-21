
<div class="col-md-9 col-sm-9 col-xs-12 main-right-div">
<section class="col-sm-12 col-md-12 col-xs-12 padding_zero">

 
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/manage-icon.png" class="right-title-img">My Contacts</h3>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
 <p class="errortxt"> 
<?php if(isset($added)) { 
	echo $added; 
    }elseif(isset($edited)) {
echo $edited;
   }elseif(isset($deleted)) {
echo $deleted;
  
   }elseif(isset($file)) {
	echo $file;
   
   } 
?>
</p>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<ul class="smsadmintabs">  
       
        <li  class="currentsmstab"><a href="#existinggroup">Add Existing</a></li>
        <li><a href="#newgroup">Add New</a></li>
        
    </ul>
</div>

 

 <div class="smsadmintabdiv">  
<div id="newgroup" class="col-sm-12 col-md-12 col-xs-12 smsadmintab-content padding_zero" style="display:none;">
<form id="createGroup" class="col-md-12 col-sm-12 col-xs-12 padding_zero missedcall_allform05" method="post" action="<?php echo base_url();?>index.php/contacts/addGroupData" enctype="multipart/form-data">
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero" id="error_alert">
		
 <div class="col-md-2 col-sm-2 col-sm-12 padding_zero">

						<span class="form_lable">Group Name</span> 
						 </div>

						  <div class="col-md-7 col-sm-7 col-xs-12 padding_mzero">

						 <input list="groupNames" name="group_name" id="group_name" placeholder="Enter Group Name" >
							  <datalist id="groupNames">
							    <?php foreach($groups as $group) {  ?> 
								<option value="<?php echo  $group->group_name;?>"> 
							    <?php } ?>
							  </datalist>    
						 </div>
 
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-7 col-sm-7 col-md-offset-2 col-sm-offset-2 padding_mzero col-xs-12">
<div class="col-md-7 col-sm-7 col-xs-12 padding_ltzero">
<div class="radiobtn">
    <input type="radio"  id="addlistcnt" value=1 name="addgrouptype" checked>
    <label for="addlistcnt" class="mob_lable">Add Contact List</label>
<div class="check"></div>
</div>
</div>
<div class="col-md-5 col-sm-5 col-xs-12 padding_zero">
<div class="radiobtn">
 <input type="radio"  id="addmanucnt" value=2 name="addgrouptype">
    <label for="addmanucnt" class="mob_lable">Add Contact manually</label>
<div class="check"></div>
</div>
</div>
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 addlist-showdiv padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<h4 class="group-subtitle">Add contact list</h4>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
						<span class="form_lable">Upload File</span> 
						 </div>
<div class="col-md-2 col-sm-2 padding_mzero col-xs-12">
						<div class="fileUpload btn submit_btn">
    <span>Upload</span>
    <input type="file" class="upload" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" name="userfile" id="userfile" onChange="getuserfile();"  >
</div>
 
 <p id="uploaded_img"> </p>
 
						 </div>
						 <div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
						 <div class="col-md-12 col-sm-12 padding_zero upload-note-text col-xs-12">
						 <ul class="note-list">
<li>Upload only xls,xlsx filetypes and contacts must be less 5000.</li>
<li>Excel Should Contain The Header In the first row.</li>
<li>Excel Order - Name. Mobile No, Gender, DOB, Address Join Date, Relive Date Etc.</li>
<li>Moble No Is Mandatory.</li>
<li>Date Form DD-MM-YYYY.</li>
</ul> 
						 </div>
						 </div>
						  </div>

</div>

</div>
<div class="col-md-12 col-sm-12 col-xs-12 addmanul-showdiv padding_zero" style="display:none;">
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<h4 class="group-subtitle">Add contact manually</h4>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
						<span class="form_lable">Name</span> 
						 </div>
						  <div class="col-md-7 col-sm-7 padding_mzero col-sm-12">
						<input type="text" id="contact_name" name="contact_name" placeholder="Enter Name">
						 </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
						<span class="form_lable">Mobile Number</span> 
						 </div>
						  <div class="col-md-7 col-sm-7 padding_mzero col-xs-12">
<input type="text" id="contcat_mobileno" name="contcat_mobileno" placeholder="Enter Mobile Number">
						 </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero"><div class="col-md-2 col-sm-2 col-xs-12 padding_zero">

 
 		<span class="form_lable">Gender</span> 
	 </div>
  	<div class="col-md-7 col-sm-7 col-xs-12 padding_mzero">
	<div class="col-md-5 col-sm-5 col-xs-12 padding_zero">
		<div class="radiobtn">
	  		<input type="radio" id="gen_type2"   value='Male' name="contact_gender" >
		  	  <label for="gen_type2">Male</label>
			   <div class="check"></div>
		</div>
	</div> 
	<div class="col-md-5 col-sm-5 col-xs-12 padding_zero">
		<div class="radiobtn">  
	  		<input type="radio" id="gen_type1"   value='Female' name="contact_gender" >
		  	  <label for="gen_type1">Female</label>
			   <div class="check"></div>
		</div>
	</div> 
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
						<span class="form_lable">Date Of Birth</span> 
						 </div>
						  <div class="col-md-7 col-sm-7 col-xs-12 padding_mzero">
						<input type="text" id="dob"  name="dob" placeholder="YYYY-MM-DD">
						 </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
						<span class="form_lable">Address</span> 
						 </div>
						  <div class="col-md-7 col-sm-7 col-xs-12 padding_mzero">
						<input type="text" id="address" name="address" placeholder="Enter Address">
						 </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
						<span class="form_lable">Join Date</span> 
						 </div>
						  <div class="col-md-7 col-sm-7 col-xs-12 padding_mzero">
						<input type="text" id="join_date" name="join_date" placeholder="YYYY-MM-DD">
						 </div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-2 col-sm-2 col-xs-12 padding_zero">
						<span class="form_lable">Relieve Date</span> 
						 </div>
						  <div class="col-md-7 col-sm-7 col-xs-12 padding_mzero">
						<input type="text" id="relieve_date" name="relieve_date" placeholder="YYYY-MM-DD">
						 </div>
						
</div>
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 <div class="col-md-7 col-sm-7 col-sm-offset-2 col-md-offset-2 col-xs-12 padding_mzero add-contactbtns">
<input type="submit"  name="add_group" class="submit_btn"  value="Create" >

						 </div>
</div>
</form>

</div>
<div id="existinggroup" class="col-sm-12 col-md-12 col-xs-12 smsadmintab-content padding_zero" >
<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
	<form action="#" class="missedcall_allform" method="post">

		<div class="col-sm-4 col-md-4 col-xs-12 padding_ltzero">
		 <input type="text" list="groupList" name="groupS" id="groupS" value="<?php echo $groupS;?>" placeholder="Select Group" >
			 <datalist id="groupList">  

		<!-- <select name="groupS" class="form-control" id="groupS" >
			<option value=''>Select Group</option> -->
			<?php foreach($groups as $group1=>$groupname1):  ?>
			<option value="<?php echo $groupname1->group_name; ?> <?php //if($groupS == $groupname1->group_name) { echo 'selected';} ?>">    
				<?php  //echo  $groupname1->group_name; ?> 
			</option>      
       
		      <?php endforeach; ?>    
 			</datalist>       
		<!-- </select>   -->

			<!-- <input type="text" name="groupS" id ="groupS"  placeholder="Group Name" value="<?php if(isset($groupS)) { echo $groupS;}?>" >    -->
		</div>  
<div class="col-sm-4 col-md-4 col-xs-12 padding_ltzero">
		<input type="text" name="mobileNum" id ="mobileNum" maxlength=10 placeholder = "Mobile Number" value="<?php if(isset($mobileNum)) { echo $mobileNum;}?>">  
</div>
<div class="col-sm-4 col-md-4 col-xs-12 padding_zero">
 		<input type="submit" name="mobileSearch" class="submit_btn" value="Search">  
</div>
	</form>  

</div> 
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-6 col-xs-12 padding_ltzero">
<form method="POST" class="missedcall_allform" id="group_sms" enctype="multipart/form-data" action="<?php echo base_url(); ?>index.php/contacts/sendGroupSMS">
<div class="col-md-12 col-sm-12 padding_zero select_numbers_bg col-xs-12">
<div class="panel-heading"><span>
<?php if(count($groups) > 0) { ?> <input type="checkbox" class="group_select" style="float:left; margin-right:10px;"  
 onchange="DoAction(0)" name="group_ids[]" value="0"/> <?php } ?></span>  
Select Group </div>	 
<div class="col-md-12 col-sm-12 col-xs-12 form-div cntnam-height">	  
<div class="panel-body grp_check">									
   <ul class="scroll_numbar2 scroll_num scroll_numbar">  
	
   
   <?php 
	$groups_count=0;	
	
foreach($groups as $group=>$groupname):
	$groups_count++;
 ?>
 <!-- <input type="checkbox" id="groups" name="group_<?php echo $groups_count; ?>" value="<?php echo $groupname->group_id;?>"> -->
    
     <li class="gr-color active" id="link1">
	 <div class="all_checkbox model_check">
 <!-- <input class="#Send-group" id="groups" type="checkbox"  name="group_<?php echo $groups_count; ?>" value="<?php echo $groupname->group_id;?>"> -->
 <input class="#Send-group" id="group_<?php echo $groups_count; ?>" type="checkbox"  name="groups[]" value="<?php echo $groupname->group_id;?>"   >  
  <label class="font_normal" for="groups"><span><span></span></span>
  <a  onClick="DoAction(<?php echo $groupname->group_id;?>,<?php echo $userid; ?>), DoActionGroup(<?php echo $groupname->group_id;?>,<?php echo $userid; ?>)"><?php echo $groupname->group_name; ?></a></label>
</div>
  

	     </li>  
	  
	<?php endforeach;?>  
</ul>
</div> 
</div> 
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
	<input type="submit" name="groupSms" class="submit_btn" id="bt_red" value="Send SMS">
	  <a href="#add-multipleGroupCont" data-toggle="modal" id="multipleGroupCont" data-target="#add-multipleGroupCont" class="submit_btn">Add Contacts</a> 
 </div>
</div>
 
</div>




<div id="add-multipleGroupCont" class="modal fade in" aria-hidden="false"  >
        <div class="modal-dialog modal-md">
            <div class="modal-content col-sm-12 col-md-12 col-xs-12 padding_zero">
                <div class="modal-header">
				
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                   
                </div>
                <div class="modal-body col-sm-12 col-md-12 col-xs-12">
  <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 
 
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">   
 
		<div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
		<label class="form_lable">Upload File:</label>  
		</div>    
	<div class="col-md-7 col-md-7 col-xs-12">    
		<div class="fileUpload btn submit_btn">
					    <span>Upload</span>
					  <!--  <input   name="userfile" type="file" class="upload"> -->
 <input type="file" name="userfile" id="multiGroupFile" class="upload" accept="application/vnd.ms-excel, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" onChange="getMultipleContUserfile();">  
					</div>
<p id="fileErrorMsg"> </p>
		</div>
		<!-- <div class="col-md-6 col-sm-6 padding_ltzero col-xs-12">
	
			  <div class="callout bg-info" >
				    <h4>Note :</h4>
				    <p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
					Upload only Excel Files.</p>
		
						<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
					Excel Should Contain The Header In the first row. </p>
		
						<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
					Excel Order - Name. Mobile No, Gender, DOB, Address Join Date, Relive Date Etc.</p>
		
					<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
					Moble No Is Mandatory.</p>
		
					<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
				Date Form DD-MM-YYYY.</p>
			  </div>	
		</div> -->
        </div>			

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
 	<div class="col-md-3 col-md-3 col-xs-12"></div>
	<div class="col-md-7 col-md-7 col-xs-12">

		<input type="submit" name="submitMultpleGroupContacts" value="Submit" id="multiGroupCont" class="submit_btn">
		</div>
        </div>
</form>

</div>	
</div>	
</div>	
</div>



<div class="col-sm-12 col-md-6 form-div padding_m9ltzero col-xs-12">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">     
<div class="col-md-12 col-sm-12 padding_zero select_numbers_bg col-xs-12">
<div class="panel-heading">Group Details</div>
</div>  
<div class="col-md-12 col-sm-12 col-xs-12 grp-height group-details main-2">
<span id="ajaxgroup-content-container"></span>
 </div>
                </div>
				</div>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-6 col-xs-12 padding_ltzero">

<form name="contacts_sms" id="contacts_sms" method="post" action="<?php echo base_url();?>index.php/contacts/sendSMS">

<div class="col-md-12 col-sm-12 padding_zero select_numbers_bg col-xs-12">  

<div class="panel-heading"> <span>
<?php if(count($groups) > 0) { ?> 
 <input type="checkbox"   name="checkall" id="checkall" style="float:left; margin-right:10px;"  
 value="0"/>  <?php } ?>
 </span>  
Select Contact  </div>  
  
 <!--<div class="main check_all2">-->
                <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 cntnam-height form-div group-details">
				  <span id="ajax-content-container">
				  
				  </span>  
				                     
                </div>                   
                </div>  
  <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
	<input type="submit" name="contactsms" id="bt_red_1" class="submit_btn" value="Send SMS">
</div>
     </div>    

 </form>
                        
             </div>
<div class="col-md-6 col-sm-12 padding_m9ltzero col-xs-12">
<div class="col-md-12 col-sm-12 padding_zero select_numbers_bg col-xs-12">
<div class="panel-heading">Contact Details</div>
   
<div class="col-md-12 col-sm-12 col-xs-12 group-details cnt-height">	
<span id="ajaxcontact-content-container"> </span>
</div> 
 </div>
</div>
   </div>
 </div>
        
           
     </div>
	 </div>
	 </div>
		</section>
	


    <div id="" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content col-md-12 col-sm-12 col-xs-12 padding_zero">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                   
                </div>
                <div class="modal-body col-md-12 col-sm-12 col-xs-12">

	 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
                     <label for="" class="col-sm-3">Group Name : </label>
                     <select class="selectpicker" data-style="btn-info">
                            <option>Mustard</option>
                            <option>Ketchup</option>
                            <option>Relish</option>
                     </select>
                </div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
       <label for="" class="col-sm-2">Excel File : </label>
                     <div class="col-sm-10" style="float:right;">
     <input type="button" class="btn filestyle" value="Choose File"  data-input="true" data-placement="top" tooltip-trigger="focus"  style=" height:30px; width:103px; background-color:#04A8ED; border:none; color:#fff;">
		           </div>
		
                </div>
	<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
       <label for="" class="col-sm-2"> </label>
                     <div class="col-sm-10" style="float:right;">
                        <input type="button" class="btn warning" value="Add Group"  data-placement="top" tooltip-trigger="focus"  style=" height:30px; width:103px; background-color:#04A8ED; border:none; color:#fff;">
		           </div>
		
                </div>
	
<div class="callout bg-info" >
            <h4>Note :</h4>
            <p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
		Upload only Excel Files.</p>
		
			<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
		Excel Should Contain The Header In the first row. </p>
		
			<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
		Excel Order - Name. Mobile No, Gender, DOB, Address Join Date, Relive Date Etc.</p>
		
		<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
		Moble No Is Mandatory.</p>
		
		<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
		Date Form DD-MM-YYYY.</p>
          </div>				


                </div>
                <div class="modal-footer">
                  
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>



		
<!--  
<div id="Add-group" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
<div class="modal-dialog modal-md">
<div class="modal-content col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body col-md-12 col-sm-12 col-xs-12">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">

	<?php echo form_open_multipart('contacts/addGroup',
		array(
			'id' => 'add_group_form',
			'name' => 'add_group_form',
			'method' => 'post','class'=>'form-horizontal','style'=>'')
		); 
	?>

<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
<label class="">Group Name</label>
</div>
<div class="col-md-7 col-sm-7 col-xs-12 padding_zero">
<?php echo form_input(array('name' => 'group_name', 'id' => 'group_name', 'class' => '', 'value' => set_value('add_group_name'))); ?>
		            <div class="form_error"><?php echo form_error('group_name'); ?></div>

</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
<label class="">Upload File</label>
</div>
<div class="col-md-7 col-sm-7 col-xs-12 padding_zero">
<a class="btn btn-file btn-default btn-sm" style="">
<i class="fa fa-upload "></i> 
<?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile', 'value' => set_value('userfile')));?>
Upload File
</a>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-7 col-sm-7 col-sm-offset-3 col-md-offset-3 col-xs-12 padding_zero">						
<?php echo form_submit(array('name' => 'add_group','value' => 'Add Group', 'class' => 'btn btn-default btn-sm','style'=>'height: 30px !important;'));?>

</div>
</div>
	<?php echo form_close(); ?>


<div class="callout bg-info">
<h4>Note :</h4>
<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Upload only Excel Files.</p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Excel Should Contain The Header In the first row. </p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Excel Order - Name. Mobile No, Gender, DOB, Address Join Date, Relive Date Etc.</p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Moble No Is Mandatory.</p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Date Form DD-MM-YYYY.</p>
</div>				


</div>

</div>

</div>
</div>
</div>

-->
		



<div id="Addcontacto-group" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" >
<div class="modal-dialog modal-md">
<div class="modal-content col-md-12 col-sm-12 col-xs-12">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<?php echo form_open_multipart('index.php/contacts/addContactsToGroup',
		array(
			'id' => 'add_multiplegroupcontacts_form',
			'name' => 'add_multiplegroupcontacts_form',
			'method' => 'post')
		); 
	?>

<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<label for="inputEmail" class="col-md-3 control-label">
Group Name</label>
<div class="col-md-8">
  <div class="form-group">
	<select name="group" class="form-control" data-style="btn-info" style="padding:0px !important;height:42px;">
		<?php foreach($groups as $group1=>$groupname1):
		?>
		<option value="<?php echo $groupname1->group_id; ?>">
		<?php echo  $groupname1->group_name; ?> 
		</option>
<!--view contact modal End-->
		<?php
		endforeach;
		?>
		</select>
        </div>
  <div class="form_error"><?php echo form_error('group_name'); ?></div>

</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<label for="inputPassword" class="col-md-3 control-label">
Upload File</label>

<div class="col-md-4">

<a class="btn btn-file btn-default btn-sm" style="">
<i class="fa fa-upload "></i> 
	
<input type="file"  name="userfile" id="userfile">Upload File</a>

</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-offset-3 col-md-10" style="padding-top: 10px;padding-bottom: 10px;">

								

            	<?php echo form_submit(array('name' => 'add_multiplecontacts','value' => 'Add Contacts', 'class' => 'btn btn-default btn-sm','style'=>'height: 30px !important;'));?>


<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#Addcontacto-group" style="">Cancel</button>
</div>
</div>
	<?php echo form_close(); ?>


<div class="callout bg-info" style="border:0px !important; margin-bottom:10px;">
<h4>Note :</h4>
<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Upload only Excel Files.</p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Excel Should Contain The Header In the first row. </p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Excel Order - Name. Mobile No, Gender, DOB, Address Join Date, Relive Date Etc.</p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Moble No Is Mandatory.</p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Date Form DD-MM-YYYY.</p>
</div>				


</div>

</div>

</div>
</div>
</div>


    <div id="Send-Group" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Send Group SMS</h4>
                </div>
                <div class="modal-body">

	<form class="form-horizontal" role="form" style=" margin-top:20px;">
							<div class="form-group">
								<label for="inputEmail" class="col-md-3 control-label">Group Name</label>
									
								<div class="col-md-6">
									<input type="email" class="form-control" id="inputEmail" placeholder="Group Name">
								</div>
							</div>
							<div class="form-group">
								<label for="inputPassword" class="col-md-3 control-label">
									Upload File</label>
								<div class="col-md-4">
									<a class="btn btn-file btn-default btn-sm" style="">
                    <i class="fa fa-upload "></i> <input type="file"  name="attachment">Upload File</a>
                  
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-offset-3 col-md-10">
									<button type="submit" class="btn btn-default btn-sm">
										Submit</button>
										<button type="submit" class="btn btn-default btn-sm" data-toggle="modal" data-target="#Send-Add-group" style="">Cancel</button>
								</div>
								
								
							</div>
							</form>
	
        
<div class="callout bg-info">
            <h4>Note :</h4>
            <p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
		Upload only Excel Files.</p>
		
			<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
		Excel Should Contain The Header In the first row. </p>
		
			<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
		Excel Order - Name. Mobile No, Gender, DOB, Address Join Date, Relive Date Etc.</p>
		
		<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
		Moble No Is Mandatory.</p>
		
		<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
		Date Form DD-MM-YYYY.</p>
          </div>				


                </div>
                
            </div>
        </div>
    </div>

	   
	   

 
    <div id="Add-Contact" class="modal fade">
        <div class="modal-dialog modal-md">
            <div class="modal-content col-md-12 col-sm-12 col-xs-12">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                </div>
       <div class="modal-body col-md-12 col-sm-12 col-xs-12 padding_zero">

	<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
	<?php echo form_open('index.php/contacts/addContact',
		array(
			'id' => 'add_contact_form',
			'name' => 'add_contact_form',
			'method' => 'post','class' => 'form-horizontal')
		); 
	?>
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
		<div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
		<label class="form_lable">Group Name:</label>
		</div>
	<div class="col-md-7 col-md-7 col-xs-12">
		<select name="gid" class="form-control" id="gid" data-style="btn-info">
		<?php foreach($groups as $group1=>$groupname1):
		?>
		<option value="<?php echo $groupname1->group_id; ?>">
		<?php echo  $groupname1->group_name; ?> 
		</option>
<!--view contact modal End-->
		<?php
		endforeach;
		?>
		</select>
		</div>
        </div>
				
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
		<div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
		<label class="form_lable">Name:</label>
		</div>
        <div class="col-md-7 col-md-7 col-xs-12">
			     
			        	<?php echo form_input(array('name' => 'contact_name', 'id' => 'contact_name', 'class' => 'form-control', 'value' => set_value('contact_name')));?>
	                    <div class="form_error"><?php echo form_error('contact_name'); ?></div>
	     </div>
        </div>
        
                    <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
					<div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
			       	<label class="form_lable">Mobile Number:</label>
					</div>
			         <div class="col-md-7 col-md-7 col-xs-12">
			        	<?php echo form_input(array('name' => 'contcat_mobileno', 'id' => 'contcat_mobileno', 'class' => 'form-control', 'value' => set_value('contcat_mobileno')));?>
	                    <div class="form_error"><?php echo form_error('contcat_mobileno'); ?></div>
			        </div>
                 </div>
			

           <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">	
                 <div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
              <label class="form_lable">Gender:</label>
			  </div>
			        <div class="col-md-7 col-md-7 col-xs-12">
			        	<?php echo form_radio('contact_gender','0',set_radio('contact_gender'),'class="radio-inline"'); ?> Male
                        
				   		<?php echo form_radio('contact_gender','1',set_radio('contact_gender'),'class="radio-inline"'); ?> Female
	                    <div class="form_error"><?php echo form_error('contact_gender'); ?></div>
			        </div>
				</div>
                
                
		    	   <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
				   <div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
			       	<label class="form_lable">Date Of Birth:</label>
					</div>
			        <div class="col-md-7 col-md-7 col-xs-12">
			        	<?php echo form_input(array('name' => 'dob', 'id' => 'dob1', 'class' => 'form-control', 'value' => set_value('dob') ? set_value('dob') : 'YYYY-MM-DD' ));?>
	                    <div class="form_error"><?php echo form_error('name'); ?></div>
			    </div>
				</div>
                
              <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
			  <div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
		       		<label class="form_lable">Address:</label>
					</div>
		        	<div class="col-md-7 col-md-7 col-xs-12">
		        		<?php echo form_textarea(array('name' => 'address', 'id' => 'address', 'rows' => 2, 'cols' => 30, 'class' => 'form-control', 'value' => set_value('address')));?>
                    	<div class="form_error"><?php echo form_error('address'); ?></div>
		        	 </div>
				</div>
                <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
				<div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
			       <label class="form_lable" >Join Date:</label>
				   </div>
			       <div class="col-md-7">
			        	<?php echo form_input(array('name' => 'join_date', 'id' => 'join_date1', 'class' => 'form-control', 'value' => set_value('join_date') ? set_value('join_date') : 'YYYY-MM-DD' ));?>
	                    <div class="form_error"><?php echo form_error('join_date'); ?></div>
			         </div>  
				</div>
                
                 <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
				 <div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
			       	<label class="form_lable">Relieve Date:</label>
					</div>
			         <div class="col-md-7">
			        	<?php echo form_input(array('name' => 'relieve_date', 'id' => 'relieve_date1', 'class' => 'form-control', 'value' => set_value('relieve_date') ? set_value('relieve_date') : 'YYYY-MM-DD' ));?>
	                    <div class="form_error"><?php echo form_error('relieve_date'); ?></div>
			         </div>
				</div>
                
				 <div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
                
                 <div class="col-md-7 col-md-7 col-sm-offset-3 col-md-offset-3 col-xs-12">
		    		<?php echo form_submit(array('name' => 'add_contact', 'id'=> 'add_contact', 'value' => 'Save', 'class' => 'submit_btn','style'=>''));?></td>
            	</div>
				</div>
	<?php echo form_close(); ?>
</div>


                </div>
                
            </div>
        </div>
    </div>

<!-- Send Group Large modal  

<div id="Add-group" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
<div class="modal-dialog modal-md">
<div class="modal-content col-md-12 col-sm-12 col-xs-12">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
 
	<?php echo form_open_multipart('contacts/addGroup',
		array(
			'id' => 'add_group_form',
			'name' => 'add_group_form',
			'method' => 'post','class'=>'form-horizontal','style'=>'')
		); 
	?>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
<label class="form_lable">
Group Name</label>
</div>
<div class="col-md-7 col-sm-7 col-xs-12">
<?php echo form_input(array('name' => 'group_name', 'id' => 'group_name', 'class' => 'form-control', 'value' => set_value('add_group_name'))); ?>
		            <div class="form_error"><?php echo form_error('group_name'); ?></div>

</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-3 col-sm-3 col-xs-12 padding_zero">
<label class="form_lable">Upload File</label>
</div>

<div class="col-md-7 col-sm-7 col-xs-12">

<a class="btn btn-file btn-default btn-sm" style="">
<i class="fa fa-upload "></i> 
<?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile', 'value' => set_value('userfile')));?>
Upload File
</a>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-7 col-sm-7 col-sm-offset-3 col-md-offset-3 col-xs-12">

            	<?php echo form_submit(array('name' => 'add_group','value' => 'Add Group', 'class' => 'btn btn-default btn-sm'));?>
</div>
</div>
	<?php echo form_close(); ?>


<div class="callout bg-info">
<h4>Note :</h4>
<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Upload only Excel Files.</p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Excel Should Contain The Header In the first row. </p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Excel Order - Name. Mobile No, Gender, DOB, Address Join Date, Relive Date Etc.</p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Moble No Is Mandatory.</p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Date Form DD-MM-YYYY.</p>
</div>				


</div>

</div>

</div>
</div>
</div>

-->


<div id="Send-Group" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
<div class="modal-dialog modal-md">
<div class="modal-content col-md-12 col-sm-12 col-xs-12">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title">Send Group SMS</h4>
</div>
<div class="modal-body col-md-12 col-sm-12 col-xs-12 padding_zero">

<form class="col-md-12 col-sm-12 col-xs-12 padding_zero form-horizontal" role="form">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-3 col-sm-3 col-xs-12">
<label class="form_lable">Group Name</label>
</div>
<div class="col-md-7 col-sm-7 col-xs-12 padding_zero">
<input type="email" class="form-control" id="inputEmail" placeholder="Group Name">
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-3 col-sm-3 col-xs-12">
<label class="form_lable">Upload File</label>
</div>
<div class="col-md-7 col-sm-7 col-xs-12 padding_zero">
<a class="btn btn-file btn-default btn-sm" style="">
<i class="fa fa-upload "></i> <input type="file"  name="attachment">Upload File</a>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-offset-3 col-md-10">
<button type="submit" class="btn btn-default btn-sm">
Submit</button>
<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#Add-group" style="">Cancel</button>
</div>


</div>
</form>


<div class="callout bg-info">
<h4>Note :</h4>
<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Upload only Excel Files.</p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Excel Should Contain The Header In the first row. </p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Excel Order - Name. Mobile No, Gender, DOB, Address Join Date, Relive Date Etc.</p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Moble No Is Mandatory.</p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Date Form DD-MM-YYYY.</p>
</div>				


</div>

</div>
</div>
</div>



<div id="Send-Contact" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
<div class="modal-dialog modal-md">
<div class="modal-content col-md-12 col-sm-12 col-xs-12 form-div">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body col-md-12 col-sm-12 col-xs-12 padding_zero">

<form class="col-md-12 col-sm-12 col-xs-12 padding_zero form-horizontal" role="form">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-3 col-sm-3 col-xs-12">
<label class="form_lable">Group Name</label>
</div>
<div class="col-md-7 col-sm-7 col-xs-12 padding_zero">
<input type="email" id="inputEmail" placeholder="Group Name">
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-3 col-sm-3 col-xs-12">
<label class="form_lable">Upload File</label>
</div>
<div class="col-md-7 col-sm-7 col-xs-12 padding_zero">
<a class="btn btn-file btn-default btn-sm" style="">
<i class="fa fa-upload "></i> <input type="file"  name="attachment">Upload File</a>
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-7 col-sm-7 col-xs-12 col-md-offset-3 col-sm-offset-3">
<button type="submit" class="btn btn-default btn-sm">Submit</button>
</div>
</div>
</form>


<div class="callout bg-info">
<h4>Note :</h4>
<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Upload only Excel Files.</p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Excel Should Contain The Header In the first row. </p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Excel Order - Name. Mobile No, Gender, DOB, Address Join Date, Relive Date Etc.</p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Moble No Is Mandatory.</p>

<p style="color:#222;"><span><i class="fa fa-edit" style="margin-right:10px;"></i></span>
Date Form DD-MM-YYYY.</p>
</div>				


</div>

</div>
</div>
</div>





</div>   


                </div>
                
            </div>
        </div>
  
     
   
</div>
	

</div> <!--content wrapper end-->



    <div id="edit-view-modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Edit the Group</h4>
                </div>
                <div class="modal-body">
                    <div class="bs-example">
    
	<form role="form">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Name </label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Mobile Nomber </label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Mobile Nomber">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Home</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Work">
                    </div>
					<input type="text" class="form-control" id="usr">
					<div class="form-group">
                      <label for="exampleInputEmail1">Date Of Birth </label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Date Of Birth">
                    </div>
					<div class="form-group">
                      <label for="exampleInputEmail1">Date OF Joining </label>
                      <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Date OF Joining">
                    </div>
					
                     <div class="modal-footer" style="text-align:center;  ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-info">Save</button>
                </div>
                    
                    
                  </div>
				  <!-- /.box-body -->

                  
                </form>
	
	
        
			

</div>

                </div>
                
            </div>
        </div>
    </div>
     






 
<!--send group sms modal start  ====<div id="Send-group" =============================== send group  with normal sms & =========================================================  -->

<?php echo form_open('index.php/contacts/sendGroupSMS', array('id' => 'group_sms_form', 'name' => 'group_sms_form', 'method' => 'post','class'=>'form-horizontal ng-pristine ng-valid')
	); ?> 


<div class="bs-example col-md-12" >
    
<div id="Send-group" class="modal fade ">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
           <div class="modal-header">
     <button type="button" class="close" 
             data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Send Group SMS</h4>
         </div>
     <div class="modal-body">

	   <!-- Main content -->
        <section class="content" style="padding-top:0px !important;">
        <div class="col-md-6 ng-scope" data-ng-controller="formConstraintsCtrl">
            <div class="panel panel-default">
                
                <div class="panel-body">
                 
				 
				 <div class="col-md-12" style="margin:10px 0px ">
                
                
                <label class="ui-radio">
				
				<?php echo form_radio('sms_type','0',TRUE,'class="ui-radio"'); ?> 

				<span>Normal SMS</span></label>
            
			  
			  
                <label class="ui-radio">
				
				<?php echo form_radio('sms_type','1',set_radio('sms_type','class="ui-radio"')); ?>
				
				<span>Flash SMS</span></label>
              </div>

            

                <div class="form-group">
                    <label for="" class="col-sm-3">Campaign Name</label>
                    <div class="col-sm-9" >
                    
							<?php echo form_input(array('name' => 'campaign_name', 
						'id' => 'campaign_name', 'placeholder' => 'Campaign Name','class' => 'form-control',
						'value' => set_value('campaign_name'),'style'=>'height:32px;'));?>
                        	<div class="form_error"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="label-focus" class="col-sm-3">Sender ID </label>
                    <div class="col-sm-9">
                     
	  	<?php echo form_dropdown('sender', $sender_names, set_value('sender'), 'class="form-control"');?> 
		                        	<div class="form_error"><?php echo form_error('sender'); ?></div>

                    </div>
                </div>
                
   
                
                
                
                 <label for="" class="col-sm-3">Text </label>
                    <div class="col-sm-9" style="margin-left:0px;">
					
                      
						
										   	<?php echo form_textarea(array('name' => 'sms_text', 'id' => 'text', 'placeholder' => 'Message', 'rows' => 4, 'cols' => 30, 'class' => 'form-control', 'value' => set_value('sms_text')));?>

						
                       <div style="margin-left:0px; text-align:left;">
                        <h6  class="label label-info" id="count_message">0</h6><small  style="margin-left:10px; color:#016EC7">Number of Charters</small>
                       
                        <td><span class="label label-info" id="hwmnysms">0</span></td> <small  style="margin-left:10px; color:#016EC7">Number of SMS</small>
											<div class="form_error"><?php echo form_error('sms_text'); ?></div>

					
						</div>
                    </div>
                
                                             
                
               
                
				
				
				<div class="additional-info-wrap form-group"> 
				<label class=" col-sm-4" for="Checkboxes_Grape" style="" > Schedule SMS  
				
					<?php echo form_checkbox(array('name' => 'schedule', 'id' => 'schedule', 'value' => 1,'style'=>' border:none !importent;width:17px; height:17px; border-style:1px solid #04A8ED; margin-left:20px; background-color:#04A8ED; margin-top: 11px;'))?>

				
				
				                      </label> 

<div class="additional-info hide icheckbox_minimal-blue checked col-sm-8">                             

	<div id="datetimepicker1" class="input-append date">

	
	<?php echo form_input(array('name' => 'on_date', 'id' => 'on_date', 'placeholder' => 'Schedule Date & Time', 'class' => 'inputText', 'value' => set_value('on_date'),'data-format'=>'yyyy-MM-dd hh:mm:ss','style'=>'height:30px;')); ?>
	
		<span class="add-on" style=" height:30px;">
	<i data-time-icon="icon-time" data-date-icon="icon-calendar" >
	</i>
	</span>

                        	<div class="form_error"><?php echo form_error('on_date'); ?></div>
	

	</div>
	</div>  									  
			 
				</div>  
				
			
			<!--Date =============                =======================               ==========================                            ====-->
			
			

			
                <div class="form-group">
                    
                     <div class="form-group" style="text-align:left; ">
                    
                    <div class="col-sm-9 col-md-9  col-xs-9  " style="float:right;">
			
			  
	
					<?php echo form_submit(array('name' => 'sendsms','value' => 'Send', 
							'class' => 'btn btn-info','data-placement' => 'top','style' => 'height:30px;  background-color:#04A8ED !importent; border:none; color:#fff;'));?>
 	  <?php echo form_reset(array('name' => 'reset','value' => 'Cancel', 'class' => 'btn btn-info','data-placement' => 'top','style' => 'height:30px;  background-color:#04A8ED !importent; border:none; color:#fff;'));?>
                    </div>
                </div>
                </div>  
                
        <input type="text" name="selected_groups" value="<?php echo $groups; ?>" />
            <?php echo form_close(); ?>
                                    
                </div>
            </div>
        </div>
        
        </section>
        	           

      
       
	   
	  
	   
	   
	   
	   
	<section class="content"   style="padding:0px !important;">
        <div class="col-md-6 ng-scope" data-ng-controller="formConstraintsCtrl" style="margin-top:0px; ">
            <div class="panel panel-default" style="margin-top:15px; background-color:#F1F5FA;">
            
                     <div class="bs-example" >
    <ul class="nav nav-tabs" style="padding:0px 0px; text-align:center;">
        
        <li class="active"><a data-toggle="tab"  href="#sectionA">Recent Templates</a></li>
       
        <li><a data-toggle="tab" href="#sectionB">Templates</a></li>
       
    </ul>
    <div class="tab-content"  >
        <div id="sectionA" class="tab-pane fade in active" style="padding:0px 0px;">
           
            <div class="box-body">
                 <div class="alert alert- alert-dismissable " data-toggle="tooltip" data-placement="bottom"
				 title="Info alert preview. Info alert previewInfo alert preview. Info alert preview. This alert is dismissable....Info alert preview. Info alert preview. This alert i.">
 
                   <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
                    <span class="col-md-1" ><i class="fa fa-file-text-o " style=""></i> </span>
                    <p style=" padding:0px 35px;" >Info alert preview.  
					Info alert preview. This alert is dismissable....
					    
						     
							 </p>
                  </div>
				  
				  <div class="alert alert- alert-dismissable " data-toggle="tooltip" data-placement="bottom"
				 title="Info alert preview. Info alert previewInfo alert preview. Info alert preview. This alert is dismissable....Info alert preview. Info alert preview. This alert i.">
                    <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
                   <span class="col-md-1" ><i class="fa fa-file-text-o " style=""></i> </span>
                    Info alert preview. This alert is dismissable.
                  </div>
				  
				  <div class="alert alert- alert-dismissable " data-toggle="tooltip" data-placement="bottom"
				 title="Info alert preview. Info alert previewInfo alert preview. Info alert preview. This alert is dismissable....Info alert preview. Info alert preview. This alert i.">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>-->
                    <span class="col-md-1" ><i class="fa fa-file-text-o " style=""></i> </span>
                    Info alert preview. This alert is dismissable.
                  </div>
				   <div class="alert alert- alert-dismissable "  data-toggle="tooltip" data-placement="bottom"
				 title="Info alert preview. Info alert previewInfo alert preview. Info alert preview. This alert is dismissable....Info alert preview. Info alert preview. This alert i." >
                   <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> -->
                    <span class="col-md-1" style=" margin:0px; padding:0px; margin-top:3px;"><i class="fa fa-file-text-o " style=""></i> </span>
                    <p style=" padding:0px 35px;" >Info alert preview.  
					Info alert preview. This alert is dismissable....
					    
						     
							 </p>
                  </div>
                </div>
        </div>
       

	   
	   
	   
	   
	   
	   


        <div id="sectionB" class="tab-pane fade" style="padding:0px 10px;">
		
		
            <div class="box-body" style="padding:0px;">
			
			 <button type="button" data-remodal-target="modal-add" class="btn btn-default btn-sm" style=" padding:8px;float:right; margin-right:20px;"><span href="#modal" 
					 data-toggle="modal">Add Template</span></button>
                      
                  <table class="table table-bordered">
                    <tbody>
					
                     
                      
                    
                    <tr class="my-template" style="background-color:#d0e7ff !important;  border-radius:5px !important; border:3px solid:#fff !important; "> 
					
                      <td><i class="fa fa-check-circle"></i></td>
        <td> 
		<span class="temp-bg" data-toggle="tooltip" data-placement="right" title="Info alert preview. Info alert previewInfo alert preview. Info alert preview. This alert is dismissable....Info alert preview. Info alert preview. This alert i.">Update software.. </span></td>
                      <td>
                       <td><a href="#Edit-Modal"  data-remodal-target="modal-edit" data-toggle="modal"><span class="badge bg-yellow">Edit</span></a></td>
                      </td>
                      <td><span class="btn btn-sm btn-default"   data-toggle="confirmation" data-btn-ok-label="Yes" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-ok-class="btn-success" data-btn-cancel-label="NO!" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-cancel-class="btn-danger" data-original-title="" title="" style="margin-left:10px;"class="btn btn-sm btn-default">Delete</span></td>
                    </tr>
					
					
					
					
					
					
					
					
                    <tr class="my-template" style="background-color:#d0e7ff !important;  border-radius:5px !important; margin-bottom:4px !important; border-top:3px solid :#fff; ">
                      <td><i class="fa fa-check-circle"></i></td>
                      <td><span data-toggle="tooltip" data-placement="right"
				 title="Info alert preview. Info alert previewInfo alert preview. Info alert preview. This alert is dismissable....Info alert preview. Info alert preview. This alert i.">Update software.. </span></td>
                      <td>
                        <td><a href="#Edit-Modal" data-toggle="modal"><span class="badge bg-yellow">Edit</span></a></td>
                      </td>
					  
                      <td><span class="btn btn-sm btn-default"   data-toggle="confirmation" data-btn-ok-label="Yes" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-ok-class="btn-success" data-btn-cancel-label="NO!" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-cancel-class="btn-danger" data-original-title="" title="" style="margin-left:10px;"class="btn btn-sm btn-default">Delete</span>
					  </td>
					  
                    </tr>
					
					
					
					
					
                    <tr >
                      <td><i class="fa fa-check-circle"></i></td>
                <td><span data-toggle="tooltip" data-placement="right"
				 title="Info alert preview. Info alert previewInfo alert preview. Info alert preview. This alert is dismissable....Info alert preview. Info alert preview. This alertInfo alert preview. Info alert previewInfo alert preview. Info alert preview. This alert is dismissable....Info alert preview. Info alert preview. This alertInfo alert preview. Info alert previewInfo alert preview. Info alert preview. This alert is dismissable....Info alert preview. Info alert preview. This alert i.">Update software.. </span>
				 </td>
                      <td>
                      <td><a href="#Edit-Modal" data-toggle="modal"><span class="badge bg-yellow">Edit</span></a>
                     </td>
                      </td>
                      <td><span class="btn btn-sm btn-default"  class="badge bg-green"   data-toggle="confirmation" data-btn-ok-label="Yes" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-ok-class="btn-success" data-btn-cancel-label="NO!" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-cancel-class="btn-danger" data-original-title="" title="" style="margin-left:10px;"class="btn btn-sm btn-default">Delete</span></td>
                    </tr>
                    <tr>
                      <td><i class="fa fa-check-circle "></i></td>
                      <td><span data-toggle="tooltip" data-placement="right"
				 title="Info alert preview. Info alert previewInfo alert preview. Info alert preview. This alert is dismissable....Info alert preview. Info alert preview. This alert i.">Update software.. </span></td>
                      <td>
                       <td><a href="#Edit-Modal" data-toggle="modal"><span class="badge bg-yellow">Edit</span></a></td>
                      </td>
                      <td><span  class="btn btn-sm btn-default"   data-toggle="confirmation" data-btn-ok-label="Yes" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-ok-class="btn-success" data-btn-cancel-label="NO!" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-cancel-class="btn-danger" data-original-title="" title="" style="margin-left:10px;"class="btn btn-sm btn-default">Delete</span></td>
                    </tr>
					
					
					 <tr>
                      <td><i class="fa fa-check-circle "></i></td>
                      <td><span data-toggle="tooltip" data-placement="right"
				 title="Info alert preview. Info alert previewInfo alert preview. Info alert preview. This alert is dismissable....Info alert preview. Info alert preview. This alert i.">Update software.. </span></td>
                      <td>
                       <td><a href="#Edit-Modal" data-toggle="modal"><span class="badge bg-yellow">Edit</span></a></td>
                      </td>
                      <td><span  class="btn btn-sm btn-default"   data-toggle="confirmation" data-btn-ok-label="Yes" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-ok-class="btn-success" data-btn-cancel-label="NO!" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-cancel-class="btn-danger" data-original-title="" title="" style="margin-left:10px;"class="btn btn-sm btn-default">Delete</span></td>
                    </tr>
					
					
					 <tr>
                      <td><i class="fa fa-check-circle "></i></td>
                      <td><span data-toggle="tooltip" data-placement="right"
				 title="Info alert preview. Info alert previewInfo alert preview. Info alert preview. This alert is dismissable....Info alert preview. Info alert preview. This alert i.">Update software.. </span></td>
                      <td>
                       <td><a href="#Edit-Modal" data-toggle="modal"><span class="badge bg-yellow">Edit</span></a></td>
                      </td>
                      <td><span  class="btn btn-sm btn-default"   data-toggle="confirmation" data-btn-ok-label="Yes" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-ok-class="btn-success" data-btn-cancel-label="NO!" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-cancel-class="btn-danger" data-original-title="" title="" style="margin-left:10px;"class="btn btn-sm btn-default">Delete</span></td>
                    </tr>
					
					
					
					 <tr>
                      <td><i class="fa fa-check-circle "></i></td>
                      <td><span data-toggle="tooltip" data-placement="right"
				 title="Info alert preview. Info alert previewInfo alert preview. Info alert preview. This alert is dismissable....Info alert preview. Info alert preview. This alert i.">Update software.. </span></td>
                      <td>
                       <td><a href="#Edit-Modal" data-toggle="modal"><span class="badge bg-yellow">Edit</span></a></td>
                      </td>
                      <td><span  class="btn btn-sm btn-default"   data-toggle="confirmation" data-btn-ok-label="Yes" data-btn-ok-icon="glyphicon glyphicon-share-alt" data-btn-ok-class="btn-success" data-btn-cancel-label="NO!" data-btn-cancel-icon="glyphicon glyphicon-ban-circle" data-btn-cancel-class="btn-danger" data-original-title="" title="" style="margin-left:10px;"class="btn btn-sm btn-default">Delete</span></td>
                    </tr>
					
					
					
					
                  </tbody></table>
                </div>	
			
			
        </div>
        
    </div>
</div>
      </div>
        </div>
        
        </section>   
 </div>
</div>
        </div>
    </div>

</div>

   
<div id="Send-contact" class="modal fade ">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
           <div class="modal-header">
     <button type="button" class="close" 
             data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title">Send Contact SMS</h4>
         </div>
     <div class="modal-body">

	  
	   <!-- Main content -->
        <section class="content" style="padding-top:0px !important;">
        <div class="col-md-6 ng-scope" data-ng-controller="formConstraintsCtrl">
            <div class="panel panel-default">
                
                <div class="panel-body">
                 
				 
				 <div class="col-md-12" style="margin:10px 0px ">
                
                
                <label class="ui-radio"><input name="radio1" type="radio" value="option1"><span>Normal SMS</span></label>
            
			  
			  
                <label class="ui-radio"><input name="radio1" type="radio" val	ue="option1"><span>Flash SMS</span></label>
              </div>

                <form class="form-horizontal ng-pristine ng-valid">

                <div class="form-group">
                    <label for="" class="col-sm-3">Campaign Name</label>
                    <div class="col-sm-9" >
                        <input type="text" style="height:32px;" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="label-focus" class="col-sm-3">Sender ID </label>
                    <div class="col-sm-9">
                       <select  class="form-control" id="sel1">
        <option >Select Your ID</option>
        <option>4456462</option>
        <option>6486543</option>
        <option>445685658</option>
      </select>
                    </div>
                </div>
                
   
                
                
                
                 <div class="form-group">
                
                    <label for="" class="col-sm-3">Text </label>
                    <div class="col-sm-9">
                        <textarea name="" id="text" class="form-control" rows="2"></textarea>
                        <td> 
                        <h6  class="label label-info" id="count_message">0</h6><small  style="margin-left:10px; color:#016EC7">Number of Charters</small></td><br>
                        <td><span class="label label-info" id="hwmnysms">0</span></td> <small  style="margin-left:10px; color:#016EC7">Number of SMS</small>
                    </div>
                     
                </div>
                
               
                
                
                
               
                
				
				
				<div class="additional-info-wrap form-group"> 
				<label class=" col-sm-4" for="Checkboxes_Grape" style="" > Schedule SMS  
				<input type="checkbox" class="flat-red" name="Checkboxes" id="Checkboxes_Grape" value="Grape"  style=" border:none !importent;width:17px; height:17px; border-style:1px solid #04A8ED; margin-left:20px; background-color:#04A8ED ;  margin-top: 11px;"> 
				
				        </label>                         
		
				</div>  
				
			           
			<!--Date =============                =======================               ==========================                            ====-->
			
			

			
                <div class="form-group">
                    
                     <div class="form-group" style="text-align:left; ">
                    
                    <div class="col-sm-9 col-md-9  col-xs-9  " style="float:right;">
                      <button type="submit" class="btn btn-default btn-sm" style="margin-right:15px;">Send  </button>
					   <button type="button" class="btn btn-default btn-sm">Reset</button>
                    </div>
                </div>
                </div>
                
            </form>
                
                                    
                </div>
            </div>
        </div>
        
        </section>
</div>

    
               
            </div>
        </div>
    </div>


    </div><!-- ./wrapper -->
 
<script src="<?php echo base_url();?>js/form_validation/js/bootstrap-tooltip.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/jquery-validate.bootstrap-tooltip.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){ 
$('#join_date').datepicker( {
    	changeMonth: true,
    	changeYear: true, 
    	dateFormat: "yy-mm-dd",
		 maxDate: new Date(),
		 
		onSelect: function (selectedDate) {
                var orginalDate = new Date(selectedDate);
               var monthsAddedDate = new Date(new Date(orginalDate).setMonth(orginalDate));
                
       $("#relieve_date").datepicker("option", 'minDate', selectedDate);
               // $("#relieve_date").datepicker("option", 'maxDate', monthsAddedDate);
            }
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });
	$('#relieve_date').datepicker( {
    	changeMonth: true,
    	changeYear: true, 
    	dateFormat: "yy-mm-dd",
		// maxDate: new Date(),
	
		onSelect: function (selectedDate) {
                var orginalDate = new Date(selectedDate);
               var monthsAddedDate = new Date(new Date(orginalDate).setMonth(orginalDate - 1));
               
               $("#join_date").datepicker("option", 'minDate', monthsAddedDate);
                //$("#join_date").datepicker("option", 'minDate', selectedDate);
            }
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });
});
</script>

<script type="text/javascript">
$(document).ready(function(){ 
$('#join_date1').datepicker( {
    	changeMonth: true,
    	changeYear: true, 
    	dateFormat: "yy-mm-dd",
		 maxDate: new Date(),
		 
		onSelect: function (selectedDate) {
                var orginalDate = new Date(selectedDate);
               var monthsAddedDate = new Date(new Date(orginalDate).setMonth(orginalDate));
                
       $("#relieve_date1").datepicker("option", 'minDate', selectedDate);
               // $("#relieve_date").datepicker("option", 'maxDate', monthsAddedDate);
            }
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });
	$('#relieve_date1').datepicker( {
    	changeMonth: true,
    	changeYear: true,     
    	dateFormat: "yy-mm-dd",
		// maxDate: new Date(),
	
		onSelect: function (selectedDate) {
                var orginalDate = new Date(selectedDate);
               var monthsAddedDate = new Date(new Date(orginalDate).setMonth(orginalDate - 1));
               
               $("#join_date1").datepicker("option", 'minDate', monthsAddedDate);
                //$("#join_date").datepicker("option", 'minDate', selectedDate);
            }
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });
});
</script>
<script>
    $(document).ready(function() {
    $("#dob").datepicker({
	dateFormat: "yy-mm-dd",
       changeMonth: true,
    	changeYear: true
	}
	);
  });
  </script>

<script>
    $(document).ready(function() {
    $("#dob1").datepicker({
	dateFormat: "yy-mm-dd",
        changeMonth: true,
    	changeYear: true
	}
	);
  });
  </script>
<script>
$(document).ready(function(){
$.validator.addMethod("notEqualTo", function (value, element, param)
{
    var target = $(param);
    if (value) return value != target.val();
    else return this.optional(element);
}, "Repeated field");

$.validator.addMethod("regexpcol", function(value, element, param) { 
  return this.optional(element) || !(/['"]/).test(value); 
},'Single quotes and double quotes not allowed');
	
 $.validator.addMethod("alphanumeric", function(value, element) {
        return this.optional(element) || /^[a-z0-9]+$/i.test(value);
    },'Should Enter Numbers, Letters');

$("#createGroup ").validate({
    rules: {
	group_name: {
          required:true,
            regexpcol: true			
        },
		userfile: {
          required:true		
        },
		contact_name: {
          required:true,
            regexpcol: true			
        },
		contcat_mobileno: {
          required:true,
            regexpcol: true			
        }
	/*,
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
        }
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
		group_name: {
            required: "Please Enter Group Name"            
        },
		contact_name: {
            required: "Please Enter Contact Name"            
        },
		userfile: {
            required: "Please Upload File"            
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
        } */  

    },
  
	tooltip_options: {
    	group_name: {placement:'bottom',html:true},
		contact_name: {placement:'bottom',html:true},
		contcat_mobileno: {placement:'bottom',html:true},
		 contact_gender: {placement:'bottom',html:true},
		//dob: {placement:'bottom',html:true},
		address: {placement:'bottom',html:true},
		//join_date: {placement:'bottom',html:true},
		//relieve_date: {placement:'bottom',html:true},
		userfile: {placement:'bottom',html:true} 
		}
}); 
}); 
 </script>
 
<script>
	


$("#add_contact_form").validate({
    rules: {
	contact_name: {
          required:true,
            regexpcol: true			
        },
		contcat_mobileno: {
          required:true		
        } 
	/*	contact_gender: {
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
        } 
	/*	contact_gender: {
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
<script>

/** Check all check boxes **/
 $('.grp_check input').on('click',function(){
        if($('.grp_check input:checked').length == $('.grp_check input').length){
            $('.group_select').prop('checked',true);
        }else{
            $('.group_select').prop('checked',false);
        }
    });  
	

 
$('.group_select').on('click',function(){
        if(this.checked){
            $('.grp_check input').each(function(){
                this.checked = true;
            });
        }else{ 
             $('.grp_check input').each(function(){
                this.checked = false;
            });
        }
    });

  
function CheckAll(chk)
{
for (i = 0; i < chk.length; i++)
	chk[i].checked = true ;
}

function UnCheckAll(chk)
{

for (i = 0; i < chk.length; i++)
	chk[i].checked = false ;
}

</script>

	 <script>
$(document).ready(function() {
    $(".smsadmintabs a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("currentsmstab");
        $(this).parent().siblings().removeClass("currentsmstab");
        var tab = $(this).attr("href");
        $(".smsadmintab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
});
</script>
	 <script>
	$(document).ready(function() {
	$("#addlistcnt").click( function(){
	if( $(this).is(':checked') ) 
	{
	$(".addmanul-showdiv").hide();
	$(".addlist-showdiv").show();
}
});
$("#addmanucnt").click( function(){
	if( $(this).is(':checked') ) 
	{
	$(".addmanul-showdiv").show();
	$(".addlist-showdiv").hide();
}
});
  
	});
</script> 

    <!-- contacts only javascript-->
    <script type="text/javascript">
	
			$(document).ready(function(){
			


			$('.menu a').click(function(e) {
				console.log(e);
			 hideContentDivs();
			 var tmp_div = $(this).parent().index();
			
			 $('.main div').eq(tmp_div).show(); 
		
			 
			 
		  });
			
		function hideContentDivs(){
			$('.main div').each(function(){
			$(this).hide();});
		}
		hideContentDivs();
		  });

    

		
	  
function DoAction(id,uid)    
{
  	var mobileNum = $('#mobileNum').val();
    $.ajax({
         type: "POST",
         url: "<?php echo base_url(); ?>index.php/contacts/contact_list_ajax",
		  dataType: "html",
         data: {id:id,uid:uid,mobileNum:mobileNum},
		  
		         success: function(data){ 

				      $('#ajax-content-container').html(data);

                  }
				  
    });
}


function DoActionGroup(id,uid)
{
 
    $('#gid').val(id);
    $.ajax({  
         type: "POST",
         url: "<?php echo base_url(); ?>index.php/contacts/group_view_details",
	 dataType: "html",
         data: {id:id,uid:uid},
		 
		         success: function(data){      
 
				      $('#ajaxgroup-content-container').html(data);

                  }
				  
    });
}


function DoActionContact(id,cid)
{
 
    $.ajax({
         type: "POST",
         url: "<?php echo base_url(); ?>index.php/contacts/contact_view",
		  dataType: "html",
         data: {id:id,cid:cid},
		 
		         success: function(data){
 
				      $('#ajaxcontact-content-container').html(data);

                  }
				  
    });
}


   </script> 
 

  
   
   <!-- group details javascript-->
   
    <script type="text/javascript">
	$('#menu-2 a').click(function(e){
     hideContentDivs();
     var tmp_div = $(this).parent().index();
     $('.main-2 div').eq(tmp_div).show();
  });

function hideContentDivs(){
    $('.main-2 div').each(function(){
    $(this).hide();});
}
hideContentDivs();
   </script>  
   
   
  <!-- contact details javascript-->
   
   
  <script type="text/javascript">
   $(document).ready(function(){
	   

	$('#kk-1 a').click(function(e){
     hideContentDivs();
     var tmp_div = $(this).parent().index();
     $('.mm-1 div').eq(tmp_div).show();
  });

function hideContentDivs(){
    $('.mm-1 div').each(function(){
    $(this).hide();});
}
hideContentDivs();
});  
   </script> 

<script type='text/javascript'>
        
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
        $(".menu-2 li").click(function(){
      		  $(".mm-1").addClass( "hid_01" );
}); 
		$(".ct_shl05").click(function(){
       			 $(".mm-1").removeClass( "hid_01" );
    		}); 
         

 </script>

		 <!-- File SMS text box text count code-->	
 <script type='text/javascript'>

        
        $(document).ready(function() {
        
       var text_max = 0;
$('#count_message-F').html(text_max + '');

$('#text').keyup(function() {
  var text_length = $('#text').val().length;
  var text_remaining = text_max + text_length;
  var persms=text_remaining/160;
    var singlecnt=Math.ceil(persms);
  $('#count_message-F').html(text_remaining + '');
    $('#hwmnysms-F').html(singlecnt+ '');
});
        });
        
  </script>
		
		
	
	 
    
    <script type="text/javascript">
$(document).ready( function(){
	/*$('input#checkAll').click(function() {
		var checked_status = this.checked;
		$("input#groups").each(function()
		{
			this.checked = checked_status;
		});	
	});
      */

	$('#bt_red').click(function(){

		var n = $("input[type=checkbox]:checked").length;
		//alert(n);
		if(n == 0) {
			alert("Please Select Groups to Send SMS");
			return false;
		}	
		//$('form#group_sms').submit();
	});
	$('#multipleGroupCont').click(function(){

		var n = $("input[type=checkbox]:checked").length;
 
		if(n == 0) {
			alert("Please Select Groups to Add Contacts");
			return false;
		}	
		//$('form#group_sms').submit();
	});

	$('#bt_red_1').click(function(){

		var n = $("input[type=checkbox]:checked").length;
		//alert(n);
		if(n == 0) {
			alert("Please Select Contact to Send SMS");
			return false;
		}	
		//$('form#group_sms').submit();
	});




	/*$('a#bt_red').click(function(){
		var n = $("input#groups:checked").length;
		if(n == 0) {
			alert("Please Select Groups to Send SMS");
			return false;
		}	
		$('form#group_sms').submit();  
	}); */
});
</script>

<script type="text/javascript">
     $('.additional-menu').on('click','li', function(){
   $(this).addClass('active22').siblings().removeClass('active22');
});
  </script>  
   <script type="text/javascript">
  
    $(document).click(function(e){
		$('#checkall').on('click',function(){

        if(this.checked){
            $('.check_all input').each(function(){
                this.checked = true;
            });
        }else{
             $('.check_all input').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.check_all input').on('click',function(){

 
        if($('.check_all input:checked').length == $('.check_all input').length){
 
            $('#checkall').prop('checked',true);
        }else{
 
 
            $('#checkall').prop('checked',false);
        }
    });



	//2
	/*$('#checkall-2').on('click',function(){
        if(this.checked){
            $('.check_all2 input').each(function(){
                this.checked = true;
            });
        }else{
             $('.check_all2 input').each(function(){
                this.checked = false;
            });
        }  
    });
    
    $('.check_all2 input').on('click',function(){
        if($('.check_all2 input:checked').length == $('.check_all2 input').length){
            $('#checkall-2').prop('checked',true);
        }else{
            $('#checkall2').prop('checked',false);
        }
    }); */
	}); 
  </script>



<script>

function getuserfile() {    
 
 	var file = $("#userfile").prop('files')[0];
 	var ext = $("#userfile").val().split('.').pop().toLowerCase();
 	var size = file.size / 1048576;  
 	if(size > 20){
		//alert("Allowed file size exceeded. (Max. 20 MB) ");
	}else if($.inArray(ext, ['xls','xlsx']) == -1) {
	  	//alert('invalid extension!'); 
	}else{      

	   	$('#uploaded_img').text(file.name);  
	 }

	 
}
</script>
<!--
<script>
$(document).ready(function() {
	$('form#createGroup').submit(function(e) {
		var group_name = $('#group_name').val();
		var file = $("#userfile").val();
 		var flag = 0;  
 		if(group_name == '') {
 			alert('Please enter group name.');
			flag = 1;
		}else if(file == '') {
 			 alert('Please upload your file.');
			 flag = 1;
		 }else{
			 flag = 0;
		 }  

		if(flag == 1) { 
			e.preventDefault();
			return false;
		}



	});	
});
</script>
-->
  </body>


  <script>
  $('#mobileNum').bind('keyup paste', function(){
        this.value = this.value.replace(/[^0-9]/g, '');
  });
    </script>
<script>

function getMultipleContUserfile() {    
 	$('#fileErrorMsg').text('');
 	var file = $("#multiGroupFile").prop('files')[0];
 	var ext = $("#multiGroupFile").val().split('.').pop().toLowerCase();

 	var size = file.size / 1048576;  

 	if(size > 20){
  		$('#fileErrorMsg').text('File size must be less than 20MB').css('color','red');  
	}else if($.inArray(ext, ['xls','xlsx']) == -1) {
  		$('#fileErrorMsg').text('File Must be xl/xlsx').css('color','red');  
	}else{      
 		  $('#fileErrorMsg').text(''); 
	   	  $('#fileErrorMsg').text(file.name).css('color','black');;  
	 }

	 
}
</script>
 

  </html>


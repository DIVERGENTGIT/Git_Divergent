
<body>
<div class="col-sm-9 col-md-9 col-xs-12 padding_zero">

<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">

<section>
<div class="col-sm-12 col-md-12 col-xs-12 ng-scope" data-ng-controller="formConstraintsCtrl">
<div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span>My Contacts</strong></div>
<div class="panel panel-default">
<!--  <div class="panel-heading"><strong><span class="glyphicon glyphicon-th"></span> Reports</strong></div>-->
<div class="panel panel-default col-md-12" style="background-color:#;  padding:0px;" >
<div class="panel-heading" style="float:left; padding:6px 0px; background-color:#;  " >

<div class="col-md-4">
<input type="text" name="message" placeholder="Serch Contacts ..." class="form-control" style="width: 75%; float: left;    margin-right: 10px;">
<span class="input-group-btn">
<button type="button" style=" bottom:2px;    margin-top: 7px;"  class="btn btn-default btn-flat">Serch</button>
</span>
</div>

<div class="col-md-4 horizontal">
<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#Add-group"style="float:left; margin-left:20px; padding:5px;">Add Group</button>
<button type="button" class="btn btn-default btn-sm"  data-toggle="modal" data-target="#Add-Contact" style="float:right;margin-right:15px; padding:5px;">Add Contact</button>
</div>

<div class="col-md-4">
<input type="text" name="message" placeholder="Serch Contacts ..." class="form-control">
<span class="input-group-btn">
<button type="button" style=" bottom:2px; "  class="btn btn-default btn-flat">Serch</button>
</span>
</div>
</div>

<form method="Post" action="sendGroupSMS">

<div class="col-md-12" style= " padding:0px 0px;  ">
<span  class="col-md-6 col-xs-6 col-sm-6"style=" line-height:34px; color:#fff; background-color:#9E9E9E; font-weight:400; font-size:16px;padding:px;">
<span class="col-md-1 col-xs-1 col-sm-1" style=" margin-left:8px; margin-top:7px;">
<input type="checkbox" class="checkbox" checked="checked"/>


</span> &nbsp; All Groups &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
<button type="submit" data-toggle="modal" data-target="#Send-Group" class="btn btn-default btn-sm">Send Group SMS</button>
</span> 



<span  class="col-md-6 col-xs-6 col-sm-6"style=" line-height:34px; color:#fff; background-color:#9E9E9E; font-weight:400; font-size:16px;padding:0px;"><span class="col-md-1 col-xs-1 col-sm-1" style=" margin-left:-15px; margin-top:7px;">
<input type="checkbox" class="checkbox" checked="checked"/>
</span> &nbsp;  All Contacts&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <button type="submit" data-toggle="modal" data-target="#sendSMS" class="btn btn-default btn-sm">Contact</button>
</span>   
			
</div>
<div class="clearfix"></div>

<div class="col-md-12" style="padding:0px 0px!important;margin-bottom:10px;">
 <!-- tabs left statr ========================================= -->
 <div class="tabbable tabs-left additional-menu"  >
<ul class="nav nav-tabs col-md-5  col-xs-5  col-sm-5 My-tab-pane tab-pane " style=" background-color:#DEE5E7; ">

<table class="table" style="margin-left:14px;">

<tbody>
<?php 
	$groups_count=0;	
	
foreach($groups as $group=>$groupname):
	$groups_count++;
 ?>

<li  class="active" >
<tr>
<td><span>

	<input type="checkbox" id="groups" name="group_<?php echo $groups_count; ?>" value="<?php echo $groupname->group_id;?>">
</span></td>
<td><span data-toggle="modal" data-target="#view-modal<?php echo $groupname->group_id; ?>" class="badge bg-default-1">view</span></td>
<td> 

<a id="tab<?php echo $groupname->group_id;?>" href="<?php echo base_url();?>contact_tab.php?id=<?php echo $groupname->group_id;?>?uid=<?php echo $userid; ?>" data-toggle="tab">

<?php echo $groupname->group_name; ?></a>

</td>

</tr>
</li>


<div class="form">
	<?php echo form_open_multipart('contacts/editGroup/group/'.$groupname->group_id,
		array(
			'id' => 'edit_group_form',
			'name' => 'edit_group_form',
			'method' => 'post')
		); 
	?>
<!--view modal start-->

<div class="bs-example " >
<div id="view-modal<?php echo $groupname->group_id; ?>" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header" style="background-color:#0067B3;">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">�</button>
<h4 class="modal-title" style="color:#fff;" >View Group Details</h4>
</div>
<div class="modal-body">
<div class="bs-example" style=" margin-left:10px;">

<div id="table1">	<div class="media-body">
<ul class="list-unstyled list-info">
<li class="ng-binding">
<span class="icon glyphicon glyphicon-user"></span>
<label  > Name </label>
<?php echo form_input(array('name' => 'group_name', 'id' => 'group_name', 'class' => 'inputText', 'value' => set_value('add_group_name') ? set_value('add_group_name') : $groupname->group_name)); ?>
</li>
</ul>
<div class="modal-footer">

<button  style="float:left;" type="button"  data-toggle="modal" data-target="#Send-group" class="btn btn-default btn-sm" data-dismiss="modal">Send Group SMS</button>



<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
<?php echo form_submit(array('name' => 'edit_group','value' => 'Update', 'class' => 'btn btn-primary btn-sm'));?>

</div>
	
</div> 
</div>

</div>
</div>
</div>
</div>
</div>

</div>

<?php echo form_close(); ?>
</div>
<!--view modal End-->
	
	<input type="hidden" name="groups_count" value="<?php echo $groups_count; ?>" />
<?php endforeach; ?>




</tbody>
</table>

</ul>
	  
	  		
           
        </tbody>
    </table>
	
 </ul></form>
 
	  <!-- contact list middil statr ========================================================== -->

<form name="contacts_sms" id="contacts_sms" method="post" action="<?php echo base_url().'contacts/sendSMS'; ?>">

<div class=" col-md-7  col-xs-7  col-sm-7 " style="padding:0px;">
<div class="tab-content scroll-right" style="background-color:#F5F5F5;"> 

<div class="tab-pane active My-tab-pane"  style="margin-left:10px;">
<span id="tabcontent"> </span>
</div>

</div>
</div>

	 
 <input type="submit" value="Send sms" />
</form>

	   </div>
      <!-- /tabs end =============================-->
      
    </div>



</div>
<!--Edit contacts inner pages================== start===================== -->

</div>

</div>
</section>
<script>

</script>
<!--
<div class="col-md-12 ng-scope"  style="margin-top:0px; padding:10px; margin-left:20px;">

<div class=" col-md-4  col-ms-4 col-xs-4">
<div class="bs-example">
<button type="button" data-toggle="modal" data-target="#Send-Contact" class="btn btn-default btn-sm">Send Contact SMS</button>

</div>
</div>

</div> -->


<div class="clearfix"></div>

<!-- Send Contact sms Large modal -->

 <div id="Add-Contact" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md" style="margin-top:0px;">
            <div class="modal-content">
                <div class="modal-header" style="background-color:#0067B3;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">�</button>
                    <h4 class="modal-title" style="color:#fff;" >Add Contact</h4>
                </div>
                <div class="modal-body">
                    <div class="bs-example" style=" margin-left:10px;">
    
	<div>
	<?php echo form_open('contacts/addContact',
		array(
			'id' => 'add_contact_form',
			'name' => 'add_contact_form',
			'method' => 'post')
		); 
	?>
		<table class="form">
		<tr><td>
			<table>
		<tr>
		<td><label for="last_name">Group Name:</label></td>
		<td>
	<div class="form-group ">
		<select name="gid" class="form-control" data-style="btn-info" style="width:220px !important;margin:10px 10px;">
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
				
		
		</td>    
		</tr>
				<tr>
			       	<td><label for="last_name">Name:</label></td>
			        <td>
			        	<?php echo form_input(array('name' => 'contact_name', 'id' => 'contact_name', 'class' => 'form-control', 'value' => set_value('contact_name'),'style'=>'margin:10px 10px;'));?>
	                    <div class="form_error"><?php echo form_error('contact_name'); ?></div>
	                </td>    
		        </tr>
		        <tr>
			       	<td><label for="last_name">Mobile Number:</label></td>
			        <td>
			        	<?php echo form_input(array('name' => 'contcat_mobileno', 'id' => 'contcat_mobileno', 'class' => 'form-control', 'value' => set_value('contcat_mobileno'),'style'=>'margin:10px 10px;'));?>
	                    <div class="form_error"><?php echo form_error('contcat_mobileno'); ?></div>
			        </td>
		    	</tr>
			<div class="form-group ol-sm-6">

		    	<tr>
			       	<td><label for="last_name">Gender:</label></td>
			        <td>
			        	<?php echo form_radio('contact_gender','0',set_radio('contact_gender'),'class="radio-inline"'); ?> Male
				   		<?php echo form_radio('contact_gender','1',set_radio('contact_gender'),'class="radio-inline"'); ?> Female
	                    <div class="form_error"><?php echo form_error('contact_gender'); ?></div>
			        </td>
		    	</tr>
				</div>
		    	<tr>
			       	<td><label for="last_name">Date Of Birth:</label></td>
			        <td>
			        	<?php echo form_input(array('name' => 'dob', 'id' => 'dob', 'class' => 'form-control', 'value' => set_value('dob') ? set_value('dob') : 'DD / MM / YYYY','style'=>'margin:10px 10px;' ));?>
	                    <div class="form_error"><?php echo form_error('name'); ?></div>
			        </td>
		    	</tr>
		    	<tr>
		       		<td><label for="last_name">Address:</label></td>
		        	<td>
		        		<?php echo form_textarea(array('name' => 'address', 'id' => 'address', 'rows' => 2, 'cols' => 30, 'class' => 'form-control', 'value' => set_value('address'),'style'=>'margin:10px 10px;'));?>
                    	<div class="form_error"><?php echo form_error('address'); ?></div>
		        	</td>
		        </tr>
		        <tr>
			       	<td><label for="last_name">Join Date:</label></td>
			        <td>
			        	<?php echo form_input(array('name' => 'join_date', 'id' => 'join_date', 'class' => 'form-control', 'value' => set_value('join_date') ? set_value('join_date') : 'DD / MM / YYYY','style'=>'margin:10px 10px;' ));?>
	                    <div class="form_error"><?php echo form_error('join_date'); ?></div>
			        </td>
		    	</tr>
		    	<tr>
			       	<td><label for="last_name">Relieve Date:</label></td>
			        <td>
			        	<?php echo form_input(array('name' => 'relieve_date', 'id' => 'relieve_date', 'class' => 'form-control', 'value' => set_value('relieve_date') ? set_value('relieve_date') : 'DD / MM / YYYY','style'=>'margin:10px 10px;' ));?>
	                    <div class="form_error"><?php echo form_error('relieve_date'); ?></div>
			        </td>
		    	</tr>
				<tr > <td ><td></td><tr>
		    	<tr>
		    		<td></td>
		    		<td><?php echo form_submit(array('name' => 'add_contact', 'id'=> 'add_contact', 'value' => 'Add Contact', 'class' => 'btn btn-primary btn-sm','style'=>'margin:10px 0px;'));?></td>
            	</tr>
			</table>		
		</td>
	
		</tr>
		</table>
	<?php echo form_close(); ?>
</div>
        
			
			
				
       
 
</div>

                </div>
                
            </div>
        </div>
    </div>

<!-- Send Group Large modal -->

<div class="bs-example " >
<div id="Add-group" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header" style="background-color:#0067B3;">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">�</button>
<h4 class="modal-title" style="color:#fff;" >Add Group</h4>
</div>
<div class="modal-body">
<div class="bs-example" style=" margin-left:10px;">

	<?php echo form_open_multipart('contacts/addGroup',
		array(
			'id' => 'add_group_form',
			'name' => 'add_group_form',
			'method' => 'post','class'=>'form-horizontal','style'=>'margin-top:20px;')
		); 
	?>

<div class="form-group">
<label for="inputEmail" class="col-md-3 control-label">
Group Name</label>
<div class="col-md-6">
<?php echo form_input(array('name' => 'group_name', 'id' => 'group_name', 'class' => 'form-control', 'value' => set_value('add_group_name'))); ?>
		            <div class="form_error"><?php echo form_error('group_name'); ?></div>

</div>
</div>
<div class="form-group">
<label for="inputPassword" class="col-md-3 control-label">
Upload File</label>
<div class="col-md-4">

<a class="btn btn-file btn-default btn-sm" style="">
<i class="fa fa-upload "></i> 
<?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile', 'value' => set_value('userfile')));?>
Upload File
</a>
</div>
</div>

<div class="form-group">
<div class="col-md-offset-3 col-md-10">

            	<?php echo form_submit(array('name' => 'add_group','value' => 'Add Group', 'class' => 'btn btn-default btn-sm'));?>

<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#Add-group" style="">Cancel</button>
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


</div>


<!-- Add Group Large modal -->

<div class="bs-example " >

<div id="Send-Group" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header" style="background-color:#0067B3;">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">�</button>
<h4 class="modal-title" style="color:#fff;" >Send Group SMS</h4>
</div>
<div class="modal-body">
<div class="bs-example" style=" margin-left:10px;">


<form class="form-horizontal" role="form" style=" margin-top:20px;">
<div class="form-group">
<label for="inputEmail" class="col-md-3 control-label">
Group Name</label>
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
</div>


</div>



<!-- Add Contact Large modal -->  

<div class="bs-example " >



<div id="Send-Contact" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
<div class="modal-dialog modal-md">
<div class="modal-content">
<div class="modal-header" style="background-color:#0067B3;">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">X</button>
<h4 class="modal-title" style="color:#fff;" >Send Contact SMS</h4>
</div>
<div class="modal-body">
<div class="bs-example" style=" margin-left:10px;">


<form class="form-horizontal" role="form" style=" margin-top:20px;">
<div class="form-group">
<label for="inputEmail" class="col-md-3 control-label">
Group Name</label>
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
</div>


</div>



</div>   





</div> <!--content wrapper end-->





<div class="bs-example col-md-12" >



<div id="Send-group" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header" style="background-color:#0067B3;">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color:#fff;">�</button>
<h4 class="modal-title" style="color:#fff;" >Send Group wise SMS</h4>
</div>
<div class="modal-body">
<div class="bs-example" style=" margin-left:10px;">

<div class="panel panel-default">



<div class="panel-body">



<div class="col-md-4" style="margin-bottom:10px;">
<label class="ui-radio"><input name="radio1" type="radio" value="option1"><span>Normal SMS</span></label>
</div>

<div class="col-md-4" style="margin-bottom:10px;">
<label class="ui-radio"><input name="radio1" type="radio" value="option1"><span>Flash SMS</span></label>
</div>


<form class="form-horizontal ng-pristine ng-valid col-md-6">



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
<textarea name="" id="text" class="form-control" rows="4"></textarea>
<td> 
<h6  class="label label-info" id="count_message">0</h6><small  style="margin-left:10px; color:#016EC7">Number of Charters</small></td><br>
<td><span class="label label-info" id="hwmnysms">0</span></td> <small  style="margin-left:10px; color:#016EC7">Number of SMS</small>
</div>

</div>

</form>
<form class="form-horizontal ng-pristine ng-valid col-md-6">


<div class="form-group">

<label for="" class="col-sm-3">Mobile No </label>
<div class="col-sm-9">
<textarea name="" id="" class="form-control" rows="4"></textarea>
</div>
</div>

<div class="form-group" style="text-align:left; ">

<div class="col-sm-9 col-md-9  col-xs-9  " style="float:right;">

<div class="col-sm-3 " style="float:left;">
<div class="form-group col-sm-4" style=" ">
<div id='testForm' class="btn-group" data-toggle="buttons">
<label class="btn btn-default btn-sm  " >
<input type="checkbox" name='Option'value='1'/>Remove Duplicate</label>
</div>

</div>

</div>


</div>
</div>



<div class="additional-info-wrap form-group"> 
<label class=" col-sm-4" for="Checkboxes_Grape" style="" > Schedule SMS  
<input type="checkbox" class="flat-red" name="Checkboxes" id="Checkboxes_Grape" value="Grape"  style=" border:none !importent;width:17px; height:17px; border-style:1px solid #04A8ED; margin-left:20px; background-color:#04A8ED ;  margin-top: 11px;"> 

</label>                         
<div class="additional-info hide icheckbox_minimal-blue checked col-sm-8">                             


<label>Date and time range</label>	
</div>   
</div>  

<div class="form-group">
<div class="modal-footer" style="text-align:center;  ">
<button type="submit" class="btn btn-default ">Send </button>
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
</div>
</div>
</form>

</div>
</div>



</div>

</div>

</div>
</div>
</div>


</div>


<!-- jQuery 2.1.4 -->
  
 <script src="<?php echo base_url();?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- FastClick -->
<script src='<?php echo base_url();?>assets/plugins/fastclick/fastclick.min.js'></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/js/app.min.js" type="text/javascript"></script>


<script src="<?php echo base_url();?>assets/plugins/daterangepicker/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>

<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url();?>assets/js/pages/dashboard2.js" type="text/javascript"></script>

 

  <script src="<?php echo base_url();?>assets/js/jquery-1.2.3.pack.js" type="text/javascript"></script>


	<script type="text/javascript">	

			function loadTabContent(tabUrl){
				jQuery.ajax({
					url: tabUrl, 
					cache: false,
					success: function(message) {
						jQuery("#tabcontent").empty().append(message);
					}
				});
			}
			
			jQuery(document).ready(function(){				
				
						
				jQuery("[id^=tab]").click(function(){	
					
					// get tab id and tab url
					tabId = $(this).attr("id");										
					tabUrl = jQuery("#"+tabId).attr("href");
					
					jQuery("[id^=tab]").removeClass("current");
					jQuery("#"+tabId).addClass("current");
					
					// load tab content
					loadTabContent(tabUrl);
					return false;
				});
			});
			
		</script>
	
	
	





<script type="text/javascript">
 $("#checkAll").click(function () {
    $(".check").prop('checked', $(this).prop('checked'));
});


</script>






</body>



</html>


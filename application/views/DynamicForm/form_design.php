<div class="col-sm-12 col-md-12 col-xs-12 padding-container">
<div class="col-sm-12 col-md-12 col-xs-12 main-contaner">
<div class="col-sm-12 col-md-12 col-xs-12 mainpgtitle padding-zero">
<div class="col-sm-6">
<!--
<h4 class="details-title"> Dynamic Form</h4>
-->
<p style="color:green;"><?php echo $this->session->flashdata('success');?></p>
<p style="color:red;"><?php echo $this->session->flashdata('error');?></p>
</div>
</div>

<div class="col-sm-12 col-md-12 col-xs-12 padding-none">

<div class="col-sm-12 col-md-12 col-xs-12 padding-zero">
<form  method="POST" enctype="multipart/form-data" action="<?php echo base_url()?>DynamicForm/view_form">
<div class="col-sm-12 col-xs-12 padding_zero empl_detl">

<?php 
//print_r($form_structure);

foreach($form_structure as $key=>$field) 
	{


	if($field['field_type'] == "radio") { ?>
	<div class="col-sm-12 feed_back_radio col-xs-12 padding_zero">
	<label class="col-sm-4 padding_zero col-xs-12"><?php echo $field['field_name']?></label>
	<div class="col-sm-7 padding_lt col-xs-12">
	<?php 
	if(count($field['field_options'])>0)
	{	
	foreach($field['field_options'] as $key=>$option) 
	{?>
	<span class="col-sm-6 padding_mlt radio_btns01">
	<input name="<?php echo str_replace(' ','_',$field['field_name'])?>" type="radio" class="mobile_rec"
	 value="<?php echo $option['option']?>" ><span><?php echo $option['option']?></span>
	</span>
	<?php 
	}
	}
	?>
	</div>
	</div>
	<?php }

	if($field['field_type'] == "checkbox") { ?>
	<div class="col-sm-12 col-xs-12 feed_back_radio padding_zero">
	<label class="col-sm-4 padding_zero col-xs-12"><?php echo $field['field_name']?></label>
	<div class="col-sm-7 padding_lt col-xs-12">
	<?php 
	if(count($field['field_options'])>0)
	{	
	foreach($field['field_options'] as $key=>$option) 
	{?>
	<span class="col-sm-6 padding_mlt radio_btns01">
	<input name="<?php echo str_replace(' ','_',$field['field_name'])?>[]" type="checkbox" class="mobile_rec"
	 value="<?php echo $option['option']?>" ><span><?php echo $option['option']?></span>
	</span>
	<?php 
	}
	}
	?>
	</div>
	</div>
	<?php } 

	if($field['field_type'] == "select") { ?>
	<div class="col-sm-12 col-xs-12 padding_zero empl_detl">
	<label class="col-sm-4 padding_zero col-xs-12"><?php echo $field['field_name']?></label>
	<div class="col-sm-7 col-xs-12 padding_mzero">
	
	<select name="<?php echo str_replace(' ','_',$field['field_name'])?>">
	<option value="">--Please Select--</option>
	<?php 
	if(count($field['field_options'])>0)
	{	
	foreach($field['field_options'] as $key=>$option) 
	{
	?>
		<option value="<?php echo $option['option']?>"><?php echo $option['option']?></option>
	<?php 
	}
	}?>
	</select>
	</div>
	</div>
	<?php } 

	if($field['field_type'] == "textarea") { ?>
	<div class="col-sm-12 col-xs-12 padding_zero empl_detl">
	<label class="col-sm-4 padding_zero col-xs-12"><?php echo  $field['field_name']?></label>
	<div class="col-sm-7 col-xs-12 padding_mzero">
	<textarea style="width:100%;" name="<?php echo str_replace(' ','_', $field['field_name'])?>"></textarea>
	</div>
	</div>
	<?php } 

	if($field['field_type'] == "text" || $field['field_type'] == "password") { ?>
	<div class="col-sm-12 col-xs-12 padding_zero empl_detl">
	<label class="col-sm-4 padding_zero col-xs-12"><?php echo $field['field_name']?></label>
	<div class="col-sm-7 col-xs-12 padding_mzero">
	<input type="<?php echo $field['field_type']?>" name="<?php echo str_replace(' ','_',$field['field_name'])?>">
	</div>
	</div>
	<?php } }?>

	<?php if($form_id != '')
	{?>
		<div class="col-sm-12 col-xs-12 padding_zero empl_detl">
		<label class="col-sm-4 padding_zero col-xs-12"></label>
		<div class="col-sm-7 col-xs-12 padding_mzero">
		 <input type="hidden" name="form_id" value="<?php echo isset($form_id)?$form_id:'';?>">
		  <input type="hidden" name="form_name" value="<?php echo isset($form_name)?$form_name:'';?>">
		  <input type="submit" name="dynamic_form" class="submit_btn" value="Submit">
		</div>
		</div>
	<?php }?>
  </div>
</form>
</div>

<!--
<div class="col-sm-12 col-md-12 col-xs-12 mrgtop20 padding-zero">
<a href="<?php echo base_url();?>DynamicForm/Reports"
		 title="Back">Back</a>
</div>
-->
</div>
</div>


	





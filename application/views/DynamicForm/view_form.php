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

<?php foreach($result AS $res) {
	if($res['ftype'] == "radio") { ?>
	<div class="col-sm-12 feed_back_radio col-xs-12 padding_zero">
	<label class="col-sm-4 padding_zero col-xs-12"><?php echo $res['lname']?></label>
	<div class="col-sm-7 padding_lt col-xs-12">
	<?php 	
		      $records=array();
			$post_fields = array(
			'test_id' => $res['test_id'],
			'method'=>'getFieldOptions'
			);
			// get form data
			$url = $this->config->item('api_url')."DynamicForm.php?";
			$qry_fields_string = http_build_query($post_fields);
			$PostFields =$qry_fields_string;
			include('curl.php');//echo $url.'?'.$PostFields;exit;
			$result_response =json_decode($get_api_response, true);
			//print_r($result_response);exit;
			if(count(@$result_response['result'])>0)
			{
				$records=$result_response['result'];
			}
		
	foreach($records AS $r) {?>
	<span class="col-sm-6 padding_mlt radio_btns01">
	<input name="<?php echo str_replace(' ','_',$res['lname'])?>" type="radio" class="mobile_rec" value="<?php echo $r['opt_value']?>" ><span><?php echo $r['opt_lable']?></span>
	</span>
	<?php }?>
	</div>
	</div>
	<?php }

	if($res['ftype'] == "checkbox") { ?>
	<div class="col-sm-12 col-xs-12 feed_back_radio padding_zero">
	<label class="col-sm-4 padding_zero col-xs-12"><?php echo $res['lname']?></label>
	<div class="col-sm-7 padding_lt col-xs-12">
	<?php 	
			$records=array();
			$post_fields = array(
			'test_id' => $res['test_id'],
			'method'=>'getFieldOptions'
			);
			// get form data
			$url = $this->config->item('api_url')."DynamicForm.php?";
			$qry_fields_string = http_build_query($post_fields);
			$PostFields =$qry_fields_string;
			include('curl.php');//echo $url.'?'.$PostFields;exit;
			$result_response =json_decode($get_api_response, true);
			//print_r($result_response);exit;
			if(count(@$result_response['result'])>0)
			{
				$records=$result_response['result'];
			}
		
	foreach($records AS $r) {?>
	<span class="col-sm-6 padding_mlt radio_btns01">
	<input name="<?php echo str_replace(' ','_',$res['lname'])?>[]" type="checkbox" class="mobile_rec" value="<?php echo $r['opt_value']?>" ><span><?php echo $r['opt_lable']?></span>
	</span>
	<?php }?>
	</div>
	</div>
	<?php } 

	if($res['ftype'] == "select") { ?>
	<div class="col-sm-12 col-xs-12 padding_zero empl_detl">
	<label class="col-sm-4 padding_zero col-xs-12"><?php echo $res['lname']?></label>
	<div class="col-sm-7 col-xs-12 padding_mzero">
	<?php 	
		
			$records=array();
			$post_fields = array(
			'test_id' => $res['test_id'],
			'method'=>'getFieldOptions'
			);
			// get form data
			$url = $this->config->item('api_url')."DynamicForm.php?";
			$qry_fields_string = http_build_query($post_fields);
			$PostFields =$qry_fields_string;
			include('curl.php');//echo $url.'?'.$PostFields;exit;
			$result_response =json_decode($get_api_response, true);
			//print_r($result_response);exit;
			if(count(@$result_response['result'])>0)
			{
				$records=$result_response['result'];
			}
	?>
	<select name="<?php echo str_replace(' ','_',$res['lname'])?>">
	<option value="">--Please Select--</option>
	<?php foreach($records AS $r) {?>
		<option value="<?php echo $r['opt_value']?>"><?php echo $r['opt_lable']?></option>
	<?php }?>
	</select>
	</div>
	</div>
	<?php } 

	if($res['ftype'] == "textarea") { ?>
	<div class="col-sm-12 col-xs-12 padding_zero empl_detl">
	<label class="col-sm-4 padding_zero col-xs-12"><?php echo $res['lname']?></label>
	<div class="col-sm-7 col-xs-12 padding_mzero">
	<textarea style="width:100%;" name="<?php echo str_replace(' ','_',$res['lname'])?>"></textarea>
	</div>
	</div>
	<?php } 

	if($res['ftype'] == "text" || $res['ftype'] == "password") { ?>
	<div class="col-sm-12 col-xs-12 padding_zero empl_detl">
	<label class="col-sm-4 padding_zero col-xs-12"><?php echo $res['lname']?></label>
	<div class="col-sm-7 col-xs-12 padding_mzero">
	<input type="<?php echo $res['ftype']?>" name="<?php echo str_replace(' ','_',$res['lname'])?>">
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


	





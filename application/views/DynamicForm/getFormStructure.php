<style>
.form-horizontal .form-group {
    text-align: left;
}
</style>

<form method="POST" enctype="multipart/form-data"  action="<?php echo base_url()?>Calls/view_form" class="form-horizontal">

<?php foreach($result AS $res) {
	if($res['ftype'] == "radio") { ?>
	<div class="form-group">
	<label class="col-sm-4 control-label"><?php echo $res['lname']?></label>
	<div class="col-sm-6">
	<?php 	
		      $records=array();
			$post_fields = array(
			'test_id' => $res['test_id'],
			);
			// get form data
			$url = $this->config->item('api_org_url')."DynamicForm/getFieldOptions?";
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
	<label class="radio-inline">
	<input name="<?php echo str_replace(' ','_',$res['lname'])?>" type="radio" value="<?php echo $r['opt_value']?>" >
	<?php echo $r['opt_lable']?></label>
	<?php }?>
	</div>
	</div>
	<?php }

	if($res['ftype'] == "checkbox") { ?>
	<div class="form-group">
	<label class="col-sm-4 control-label"><?php echo $res['lname']?></label>
	<div class="col-sm-6">
	<?php 	
			$records=array();
			$post_fields = array(
			'test_id' => $res['test_id'],
			);
			// get form data
			$url = $this->config->item('api_org_url')."DynamicForm/getFieldOptions?";
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
	<label class="checkbox-inline">
	<input name="<?php echo str_replace(' ','_',$res['lname'])?>[]" type="checkbox" value="<?php echo $r['opt_value']?>" >			    <?php echo $r['opt_lable']?>
	</label>
	<?php }?>
	</div>
	</div>
	<?php } 

	if($res['ftype'] == "select") { ?>
	<div class="form-group">
	<label class="col-sm-4 control-label"><?php echo $res['lname']?></label>
	<div class="col-sm-6">
	<?php 	
		
			$records=array();
			$post_fields = array(
			'test_id' => $res['test_id'],
			);
			// get form data
			$url = $this->config->item('api_org_url')."DynamicForm/getFieldOptions?";
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
	<select name="<?php echo str_replace(' ','_',$res['lname'])?>" class="form-control">
	<option value="">--Please Select--</option>
	<?php foreach($records AS $r) {?>
		<option value="<?php echo $r['opt_value']?>"><?php echo $r['opt_lable']?></option>
	<?php }?>
	</select>
	</div>
	</div>
	<?php } 

	if($res['ftype'] == "textarea") { ?>
	<div class="form-group">
	<label class="col-sm-4 control-label"><?php echo $res['lname']?></label>
	<div class="col-sm-6">
	<textarea name="<?php echo str_replace(' ','_',$res['lname'])?>" class="form-control"></textarea>
	</div>
	</div>
	<?php } 

	if($res['ftype'] == "text" || $res['ftype'] == "password") { ?>
	<div class="form-group">
	<label class="col-sm-4 control-label"><?php echo $res['lname']?></label>
	<div class="col-sm-6">
	<input type="<?php echo $res['ftype']?>" class="form-control" name="<?php echo str_replace(' ','_',$res['lname'])?>">
	</div>
	</div>
	<?php } }?>

	<?php if($form_name != '')
	{?>
    <div class="form-group">
    <label class="col-sm-4 control-label"></label>
    <div class="col-sm-6">
      <input type="hidden" name="form_name"  value="<?php echo $form_name;?>">
      <input type="submit" name="dynamic_form" class="submitbtn" value="Submit">
    </div>
    </div>
	<?php }?>

</form>



	





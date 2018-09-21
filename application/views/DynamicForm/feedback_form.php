<style>
.profilebg {
	background:#f2f2f2;
	padding:30px 15px;
	margin: 30px auto;
	border-radius: 4px;
}
.succes-msg {
text-align: center;
background: #d9ffd9;
border: 1px solid green;
padding: 10px;
margin: 15px auto;
border-radius: 6px;	
}

.error-msg {
text-align: center;
background: #ffd6d6;
border: 1px solid red;
padding: 10px;
margin: 15px auto;
border-radius: 6px;	
}
.title-head {
font-size:32px;
font-weight:bold;
color:red;
text-align:center;
margin:20px auto;
text-transform:capitalize;	
}

</style>

<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jtab.min.css" type="text/css">
<link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css" type="text/css">
 
<div class="col-sm-6 col-sm-offset-3">
<div class="profilebg">


<?php
if($this->session->flashdata('success')!='')
{
?>
	
<div class="succes-msg">
<!--
We have taken your request. Our executive will get in touch with you shortly.
-->

Thank you for filling
out your information!...
<!--
	<?php echo ($this->session->flashdata('success'))?$this->session->flashdata('success'):''?>
	
    <?php echo ($this->session->flashdata('feedback_id'))? 'Your Request ID # '.$this->session->flashdata('feedback_id'):''?>
  -->  
 </div>
 <?php }?>
 
 <?php
if($this->session->flashdata('error')!='')
{
?>
	
<div class="error-msg">
	<?php echo ($this->session->flashdata('error'))?$this->session->flashdata('error'):''?>
   
 </div>
 <?php }?>
 
 <?php
$formvalues=array();
if($status=='200')
{
?>
  <?php
if($this->uri->segment(3)!='')
{
?>
	
<div class="title-head">
	<?php 
	$formname=str_replace("_",' ',$formname);
	$formname=str_replace("-",' ',$formname);
	echo $displayformname=str_replace(" ",' ',$formname);
	
	?>
   
 </div>
 <?php }?>
 
	

	 <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal" id="myform" style="align:center;margin: -14px 112px 136px 543px;">

<?php 
//print_r($result);
foreach($result AS $res) {
	if($res['ftype'] == "radio") { ?>

	<div class="form-group">
    <label class="col-sm-4 control-label"><?php echo $res['lname']?></label>
	<div class="col-sm-6">
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
	<label class="radio-inline">
	<input name="<?php echo str_replace(' ','_',$res['lname'])?>" type="radio" class="" value="<?php echo $r['opt_value']?>" ><?php echo $r['opt_lable']?></label>

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
	<label class="checkbox-inline">
	<input name="<?php echo str_replace(' ','_',$res['lname'])?>[]" type="checkbox" class="" value="<?php echo $r['opt_value']?>" ><?php echo $r['opt_lable']?></label>

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
	<textarea class="form-control" name="<?php echo str_replace(' ','_',$res['lname'])?>"></textarea>
	</div>
	</div>
	<?php } 

	if($res['ftype'] == "text" || $res['ftype'] == "password") {
	
	array_push($formvalues,array('labelname'=>$res['lname']));
	
	 ?>
	<div class="form-group">
	<label class="col-sm-4 control-label"><?php echo $res['lname']?></label>
	<div class="col-sm-6">
	<input class="form-control" type="<?php echo $res['ftype']?>" name="<?php echo str_replace(' ','_',$res['lname'])?>">
	</div>
	</div>
	<?php } }
	?>

	<?php if($this->uri->segment(3) != '' && $status != '201' )
	{?>
		<div class="form-group">
		<label class="col-sm-4 control-label"></label>
		<div class="col-sm-6">
		  <input type="submit" name="dynamic_form" class="btn btn-primary" value="Submit">
		</div>
		</div>
	<?php }?>
  </div>
</form>

<?php
}
?>

 </div>
</div>

	<script src="<?php echo base_url();?>striker-js/jquery.min.js"></script>
 <script src="<?php echo base_url();?>striker-js/bootstrap.js" type="text/javascript"></script>
   <script src="<?php echo base_url();?>striker-js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>striker-js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>striker-js/jquery-validate.bootstrap-tooltip.js" type="text/javascript"></script>

<?php
if(count($formvalues)>0)
{
?>	
<script>

$(document).ready(function() {
$("#myform").validate({
 rules:  {
		<?php
		$count=count($formvalues)-1;
		$i=0;
		foreach($formvalues as $key=>$value)
		{
		if($count==$i)
		{
		 $coma="";
		}
		else
		{
		 $coma=",";
		}
		?>
				<?php echo $value['labelname']?>: {
					required: true
					//url: true
				}<?php echo $coma;?>
		<?php
		$i++;
		}
		?>
		}	,
		messages:  {
		<?php
		$count=count($formvalues)-1;
		$i=0;
		foreach($formvalues as $key=>$value)
		{
		if($count==$i)
		{
		 $coma="";
		}
		else
		{
		 $coma=",";
		}
		?>
				<?php echo $value['labelname']?>: {
					required: "This Field is Required"<?php echo $coma;?>
					
					//url: true
				}, 
		<?php
		$i++;
		}
		?>
		}	,
			tooltip_options: 
			{
		<?php
		$count=count($formvalues)-1;
		$i=0;
		foreach($formvalues as $key=>$value)
		{
		
		if($count==$i)
		{
		 $coma="";
		}
		else
		{
		 $coma=",";
		}
		
		?>
				<?php echo $value['labelname']?>: {placement:'bottom',html:true}<?php echo $coma;?>
		<?php
		$i++;
		}
		?>
				
			} 
	    });
	    
	    
	});

</script>
<?php
}
?>



<link rel="stylesheet" href="<?php echo base_url();?>assets/css/jtab.min.css" type="text/css">


	<body class="skin-blue sidebar-mini">
	<div class="col-sm-10 col-xs-12 mbl_left">


	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<!-- Main content -->
	<section class="" >
	<!-- title row -->
	<div class="">

<div class="col-sm-12 DynamicForm_sms_tabs padding_zero">
		<ul class="jtab-trigger jtab-ul">
			<li>
				<a href="<?php echo base_url();?>DynamicForm/Create" class="jtab-selected">Creat Dynamic Form</a>
			</li>
			<li>
				<a href="<?php echo base_url(); ?>DynamicForm/getList">Dynamic Forms List</a>
			</li>
			
			<li>
				<a href="<?php echo base_url(); ?>DynamicForm/Reports">Dynamic Forms Reprt</a>
			</li>
		</ul>
	</div>
	


<div class="jtab-content-list col-xs-12 col-sm-12">
	
	<div class="jtab-content">
	<section>
	<?php echo ($this->session->flashdata('success'))?$this->session->flashdata('success'):''?>
	<?php echo ($this->session->flashdata('error'))?$this->session->flashdata('error'):''?>
	<div class="col-sm-6 col-xs-12 padding_zero">
	<ul class="dny_form_list">
	<?php foreach($dynamic_result AS $dynamic)
	{?>
    <li>
        <a href="<?php echo base_url(); ?>DynamicForm/getList/<?php echo $dynamic['form_name']?>" class="jtab-selected"><?php echo $dynamic['form_name']?></a>
    </li>
<?php }?>
   
</ul>
</div>
	<div class="col-sm-6 col-xs-12 empl_detl">
	<div class="col-sm-12 col-xs-12 padding_zero">

	 <form action="" method="POST" enctype="multipart/form-data">
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
	<span class="col-sm-6 padding_mlt radio_btns01">
	<input name="<?php echo str_replace(' ','_',$res['lname'])?>" type="checkbox" class="mobile_rec" value="<?php echo $r['opt_value']?>" ><span><?php echo $r['opt_lable']?></span>
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

	<?php if($this->uri->segment(3) != '')
	{?>
		<div class="col-sm-12 col-xs-12 padding_zero empl_detl">
		<label class="col-sm-4 padding_zero col-xs-12"></label>
		<div class="col-sm-7 col-xs-12 padding_mzero">
		  <input type="submit" name="dynamic_form" class="dynamic_sbmt btn btn-primary" value="Submit">
		</div>
		</div>
	<?php }?>
  </div>
</form>

 
	</div>
	
	 
	</div>


	
	</section>
	</div>
	

	</div>

	</div>
	</div>
	</section></div></div></body>

	


	<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

	<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	



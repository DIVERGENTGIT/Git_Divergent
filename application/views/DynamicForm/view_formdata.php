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
//print_r($formdata);
foreach($formdata as $key=>$value)
{
?>
<div class="col-sm-12 feed_back_radio col-xs-12 padding_zero">
	<label class="col-sm-4 padding_zero col-xs-12"><?php echo $value['field_name']?></label>
	<div class="col-sm-7 padding_lt col-xs-12">
	<?php echo $value['value']?>
	</div>
</div>

<?php
}
?>

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


	





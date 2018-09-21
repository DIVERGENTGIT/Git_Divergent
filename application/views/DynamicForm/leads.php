


<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">

    <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/reports-icon.png" class="right-title-img">Lead Details</h3>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">

<?php if($this->session->flashdata('error_message')){?> 
<span class="" style="color:red">  <?php echo $this->session->flashdata('error_message')?> 
</span> 
<?php } ?>

<?php if($this->session->flashdata('success_message')){?> 
<span class="" style="color:green">  <?php echo $this->session->flashdata('success_message')?> 
</span> 
<?php } ?>
<!--
<a href="<?php echo base_url();?>DynamicForm/Create" class="submit_btn pull-right" id='action' value='add' onclick='return OpenForm();' >
Add New</a>
--->
<form method="post" action="<?php echo base_url();?>DynamicForm/lead_download">
<input type="hidden" name="form_id" value="<?php echo $form_id;?>">
<input type="hidden" name="field_count" value="<?php echo $field_count;?>">
<input type="submit" name="download" value="Download" class="submit_btn pull-right" >
</form>
<!--
<a href="<?php echo base_url();?>DynamicForm/Leads/" class="submit_btn pull-right" id='action' value='add' onclick='return OpenForm();' >
Download</a>
-->
</div>

<section class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
  <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
        <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
        <!--
<form class="col-sm-12 col-md-12 missedcall_allform form-div col-xs-12 padding_zero" role="form" action="" name="campaign_search" id="campaign_search" method="post">
  <ul class="search-list05 missedcall_allform">
<li><input type="text" id="from_date" name="from_date" value="<?php echo @$from_date;?>" placeholder="" class="data-pickerbg"></li>
<li><input type="text" id="to_date" name="to_date" value="<?php echo @$to_date;?>" placeholder="" class="data-pickerbg"></li>
<li>
					
                      <select name="form_name">
<option value="">--Select--</option>
<?php 
	//echo count($header_form);
	
	foreach($formnames as $key=>$value)
	{
	?>
	<option value="<?php echo $value['form_name'];?>" 
	<?php echo ($value['form_name']==$form_name)?'selected':'';?> ><?php echo $value['form_name'];?></option>
	<?php
	}
	?>
</select>
 
</li>
<li><input type="submit" class="submit_btn" value="Search" name="search"></li>
</ul>


 </form>
 -->		
		<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
		<span>Form Name : </span><?php echo @$form_name;?>
		</div>
            </div>
        </div>
       
        </section>
        
		<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
		<span>No of Records : </span><?php echo @$total_rows;?>
		</div>
		
		<div class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
		<div class="table-responsive">
		<table class="table_all">
		<thead>
<tr> <th> S.No</th> <th> Mobile</th> <th> Date & Time</th>
<?php
foreach($field_names as $key=>$column)
{
?>
<th> <?php echo $column['column']?></th>
<?php
}
?>

		 <!--<th> Action</th>-->
		 </tr>
</thead>
<tbody>
	
	<?php 
	///print_r($formsdata);
	if(count($formsdata)) {
		$count=1;
	if($this->uri->segment(5)!='')
	{
	$count = $this->uri->segment(5)+1;
	}
		foreach($formsdata as $key=>$value)
		{
		//echo $value['form_id'];
		?>
		<tr style="height:30px !important;" >
		<td><?php echo $count++;?></td>
		<!--
		<td><?php echo isset($value['form_name'])?$value['form_name']:'---';?></td>
		-->
		<td>
		<?php echo isset($value['to_mobile_no'])?$value['to_mobile_no']:'---';?>
		</td>
		<td>
		<?php echo isset($value['created_on'])?$value['created_on']:'---';?>
		</td>
		
		<?php
		foreach($field_names as $key=>$column)
		{
			$labelname=$column['column'];
		?>
		<td>
		<?php echo isset($value[$labelname])?$value[$labelname]:'---';?>
		</td>
		<?php
		}
		?>
<!--
		<td>

<!--
<a  class="action-btns submit_btn call_id<?php echo $value['lead_id'];?>" data-toggle="modal" data-target="#kyc-view<?php echo $value['lead_id'];?>" title="Lead Details" >
View</a>

<!-- SMS Model Start 
  <div class="modal fade" id="kyc-view<?php echo $value['lead_id'];?>" role="dialog" >
    <div class="modal-dialog kyc-view">
    
      <!-- Modal content
      <div class="modal-content col-md-12 col-sm-12 col-xs-12 padding_zero">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 style="color: red;
text-align: center;
margin: 0px;
font-size: 18px;
font-weight: bold;">Dynamic Form Details</h3>
        </div>
        <div class="modal-body col-md-12 col-sm-12 col-xs-12 getevents" >
		
        </div>
        
      </div>
      
    </div>
  </div>
<!-- Model End -->
<!--
<script>
$(document).ready(function(){
    $(".call_id<?php echo $value['lead_id'];?>").click(function(){
    
        $.ajax({
        url:"<?php echo base_url()?>DynamicForm/leadinfo",
        data:{form_id:"<?php echo $value['lead_id'];?>"},
        type:"GET",
        success:function(data)
        {
        	$(".getevents").html(data);
        }
        });
        
    });
});
</script>

<!-- SMS Model Start 

</td>
-->

		</tr>
		<?php
			}	?>
	<?php $count++;  } else {?><tr><td colspan="10">No Records Available!...</td></tr> <?php }?>

</tbody>
</table>
			</div>	
		</div>
	<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">	  
	<?php echo $this->pagination->create_links(); 
	?>
	</div>
	<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">	  
	<a  class="action-btns " href="<?php echo base_url();?>DynamicForm/reports" >
Back</a>
	</div>
</div>
</div>
</div>
</div>

<script src="<?php echo base_url();?>js/form_validation/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/bootstrap-tooltip.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/jquery-validate.bootstrap-tooltip.js" type="text/javascript"></script>




  

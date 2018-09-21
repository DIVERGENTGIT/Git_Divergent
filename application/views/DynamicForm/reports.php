


<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">

    <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/reports-icon.png" class="right-title-img">Dynamic Form</h3>
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
<a href="<?php echo base_url();?>DynamicForm/Create" class="submit_btn pull-right" id='action' value='add' onclick='return OpenForm();' >
Add New</a>
</div>

<section class="col-sm-12 col-md-12 col-xs-12 form-div padding_zero">
  <div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
        <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
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
<tr> <th> S.No</th> <th> Form Name  </th> <th> No of Fields</th> <th> No of Leads</th> <th> Date & Time</th>
		 <th> Lead URL</th><th> Action</th></tr>
</thead>
<tbody>
	
	<?php 
	///print_r($formsdata);
	if(count($formsdata)) {
		$count=1;
	if($this->uri->segment(3)!='')
	{
	$count = $this->uri->segment(3)+1;
	}
		foreach($formsdata as $key=>$value)
		{
		//echo $value['form_id'];
		?>
		<tr style="height:30px !important;" >
		<td><?php echo $count++;?></td>
		<td><?php echo isset($value['form_name'])?$value['form_name']:'---';?></td>
		<td>
		<?php echo isset($value['no_of_fields'])?$value['no_of_fields']:'---';?>
		</td>
		<td>
		<?php
		if(isset($value['no_of_leads']) && $value['no_of_leads']>0)
		{
		?>
		<a href="<?php echo base_url();?>DynamicForm/Leads/<?php echo $value['form_id'];?>/<?php echo $value['no_of_fields'];?>"
		 title="No of Leads"><?php echo isset($value['no_of_leads'])?$value['no_of_leads']:'0';?></a>
		<?php
		}
		else
		{
		echo isset($value['no_of_leads'])?$value['no_of_leads']:'0';
		}
		?>
		</td>
		
		<td>
		<?php echo isset($value['created_on'])?$value['created_on']:'---';?>
		</td>
		
		<td>
		<?php
		 if($_SERVER['HTTP_HOST']=='localhost')
		 {
		 ?>
		<a href="<?php echo base_url()?>Dy/pr/<?php echo base64_encode($value['form_id']);?>"
		 title="URL"  target="_blank" >
		 <?php echo base_url()."Dy/pr/";?><?php echo base64_encode($value['form_id']);?></a>
		 <?php
		 }
		 else
		 {
		 ?>
		 <a href="<?php echo $this->config->item('customform_url');?><?php echo base64_encode($value['form_id']);?>"
		 title="URL"  target="_blank" >
		 <?php echo $this->config->item('customform_url');?><?php echo base64_encode($value['form_id']);?></a>
		 <?php
		 }
		 ?>
		</td>
		<!--
		<td>
		<a href="<?php echo base_url();?>DynamicForm/view_form/<?php echo $value['form_name'];?>/<?php echo $value['no_of_fields'];?>"
		 title="Dynamic Form" target="_blank">View</a>
		</td>
		-->
		<td>

<a  class="action-btns submit_btn call_id<?php echo $value['form_id'];?>" data-toggle="modal" data-target="#kyc-view<?php echo $value['form_id'];?>" title="Events" >
View</a>

<!-- SMS Model Start -->
  <div class="modal fade" id="kyc-view<?php echo $value['form_id'];?>" role="dialog" >
    <div class="modal-dialog kyc-view">
    
      <!-- Modal content-->
      <div class="modal-content col-md-12 col-sm-12 col-xs-12 padding_zero">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 style="color: red;
text-align: center;
margin: 0px;
font-size: 18px;
font-weight: bold;">Dynamic Form</h3>
        </div>
        <div class="modal-body col-md-12 col-sm-12 col-xs-12 getevents" >
		
        </div>
        
      </div>
      
    </div>
  </div>
<!-- Model End -->

<script>
$(document).ready(function(){
    $(".call_id<?php echo $value['form_id'];?>").click(function(){
    
        $.ajax({
        url:"<?php echo base_url()?>DynamicForm/view_form",
        data:{form_id:"<?php echo $value['form_id'];?>",form_name:"<?php echo $value['form_name'];?>"},
        type:"GET",
        success:function(data)
        {
        	$(".getevents").html(data);
        }
        });
        
    });
});
</script>

<!-- SMS Model Start -->

</td>

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
</div>
</div>
</div>
</div>

<script src="<?php echo base_url();?>js/form_validation/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/bootstrap-tooltip.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/jquery-validate.bootstrap-tooltip.js" type="text/javascript"></script>




  

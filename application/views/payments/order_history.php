<body oncontextmenu="return false;">
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
 <div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/payments-icon.png" class="right-title-img">Order History</h3>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">

<form method="post" id="order_history_report" class="missedcall_allform">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero margncenter"> 
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
<div class="col-sm-3 col-md-3 padding_ltzero form-div padding-memty col-xs-12">
<!--  
<input type="text" name="from_date" value="<?php echo @$from_date;?>" id="from_date"  class="form-control datepicker_img" placeholder="From Date"/>
-->
<input type="text" name="from_date" value="<?php echo @$from_date;?>"  id="from_date" class="data-pickerbg" placeholder="From Date"/>
</div>
<div class="col-sm-3 col-md-3 padding_rtzero form-div padding-memty col-xs-12">
<!--  
<input type="text" name="to_date" value="<?php echo @$to_date;?>"  id="to_date"  class="form-control datepicker_img" placeholder="To Date"/>
-->
<input type="text" name="to_date" value="<?php echo @$to_date;?>"  id="to_date"  class="data-pickerbg" placeholder="To Date"/>
</div>
<div class="col-sm-3 col-md-3 padding_rtzero form-div padding-memty col-xs-12">
<input type="text" name="trn_transid"  value="<?php echo @$_SESSION['trn_transid'];?>"  class="form-control" placeholder="Transaction ID"/>
</div>

<div class="col-sm-3 col-md-3 padding_rtzero form-div padding-memty col-xs-12">
<select name="trn_service" class="form-control"><option value="">Select Service Type</option>
<option value="sms" <?php if(@$_SESSION['trn_service']=='sms') echo "selected" ?> >SMS</option>
<option value="shorturl" <?php if(@$_SESSION['trn_service']=='shorturl') echo "selected" ?>>Short URL</option>
<option value="longcode" <?php if(@$_SESSION['trn_service']=='longcode') echo "selected" ?>>Long Code</option>
</select>
</div>

<div class="col-sm-3 col-md-3 padding_ltzero form-div padding-memty col-xs-12">
<select name="trn_status" class="form-control"><option value="">Select Status</option>
<option value="Transaction Successful" <?php if(@$_SESSION['trn_status']=='Transaction Successful') echo "selected" ?> >Success</option>
<option value="Transaction Cancelled" <?php if(@$_SESSION['trn_status']=='Transaction Cancelled') echo "selected" ?>>Cancelled</option>

</select>
</div>
<div class="col-sm-3 col-md-3 form-div padding_rtzero col-xs-12" style="margin-bottom:20px;">
<input type="Submit" name="Search" value="Search" class="submit_btn"/>
</div>
</div>


</div>
</div>
</form> 
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
    <div class="col-sm-12 col-md-12 col-xs-12 padding_zero table-responsive">          
  <table class="table_all table">
  <thead>
                <tr>
                <th>S.no</th>
                <th>Service Type</th>
                 <th>Transaction ID</th>
                <!-- 
                <th>SMS Type</th>
                 -->
                 <th>No.of.SMS</th>
                 <th>Longcode Credits</th>
                  <th>Shorturl Credits</th>
                 <th>Amount ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> ) </th>
               
                 <th>Status</th>
                 <th>Date</th>
                <th colspan=2>Action</th>
                </tr>
				</thead>
				<tbody>
        <?php
       // print_r($products);
	$user_id=$this->session->userdata('user_id');
	$sql="SELECT u.no_ndnc,u.dnd_check,u.state_id,u.city_id,u.address1,u.zipcode,u.organization,u.email,u.mobile FROM users u WHERE u.user_id = $user_id";
	$user=$this->db->query($sql)->result();
	$usertype='';
	foreach($user as $key => $value)
	{
	
	if($value->no_ndnc=="0")
	{
	$usertype="Promotional";
	$usertypecol="promotional";
	}
	if($value->no_ndnc=="1")
	{
	$usertype="Transactional";
	$usertypecol="transactional";
	}
	if($value->no_ndnc=="1" && $value->dnd_check=='1')
	{
	$usertype="Semi Trans";
	$usertypecol="semitrans";
	}
	}
	
	//echo $usertype;
	//print_r($products);
	 if(count($products)>0)
	   { 
	   
	   $sno=1;
	   if($this->uri->segment(3)!='')
		{
		 	$sno=$this->uri->segment(3)+1;
		}
        foreach($products as $key=>$product)
        {
                                        
         ?>
                        <tr>
                        <td>
                        <?php echo  $sno ?>
                     <input type = "hidden" name = "id" id="productid<?php echo $product['id'] ?>" value = "<?php echo $product['id'] ?>"/>
                        </td>
                        
                         <td><?php
                           if($product['servicetype']!='')
                           {
                             //echo $product['servicetype'];
                             if(@$product['servicetype']=='sms') echo "SMS";
                              if(@$product['servicetype']=='shorturl') echo "ShortURL";
                              if(@$product['servicetype']=='longcode') echo "LongCode";
                           }
                           else
                           {
                           echo "---";
                           }
                           
                          
                          ?></td>
                         
                         <td><?php echo $product['epg_txnID'] ?></td>
                        <!-- 
                        <td>
                        <?php echo $usertype; ?>
                        <input type = "hidden" name = "description" value = "<?php echo $product['smstype'] ?>"/>
                        </td>
                       -->
                       
                        <td>
                        <?php //echo $product['noofsms'];
                         if($product['noofsms']!='')
                           {
                             echo $product['noofsms'];
                           }
                           else
                           {
                           echo "0";
                           }
                         ?>
                        </td>
                         <td>
                        <?php //echo $product['longcode_credits'];
                        if($product['longcode_credits']!='')
                           {
                             echo $product['longcode_credits'];
                           }
                           else
                           {
                           echo "0";
                           }
                         ?>
                        </td>
                        <td>
                        <?php //echo $product['longcode_credits'];
                        if($product['shorturl_credits']!='')
                           {
                             echo $product['shorturl_credits'];
                           }
                           else
                           {
                           echo "0";
                           }
                         ?>
                        </td>
                        
                          <td>
                          <span class="displayprice<?php echo $product['id'] ?>">
                        <?php 
                      
                             $amount=$product['amount'];
                             $tax_amount=$product['tax_amount'];
                             echo $total_amount=$product['total_amount'];
                             
                         ?>
                         </span>
                        <input type = "hidden" class="price<?php echo $product['id'] ?>"  name = "price" value = "<?php echo $product['noofsms']*$price; ?>"/>
                         <input type = "hidden"  name = "tax" value ="<?php echo $tax; ?>"/>
                        </td>
                     
                       <td>
                       
                      <?php 
					 // echo $product['payment_status'];
						if($product['payment_status']=='Transaction Successful')
						{
						echo "Success";
						}
						else if($product['payment_status']=='Transaction Cancelled')
						{
						echo "Cancelled";
						}
						else 
						{
						echo "Cancelled";
						}
						?>
                       
                       </td>
                        <td>
                       
                      <?php 
						//echo $product['created_on'];
						echo date('d-m-Y H:i:m', strtotime($product['created_on']));
                      ?>
                       
                       </td>
                       <td>
                       <a href="<?php echo base_url(); ?>Payment/order_details/<?php echo $product['epg_txnID'] ?>" ><input type ="button" class="btn btn-sm btn-default" value ="View" /></a>
</td>
                        <td>
                        <a  href="#view_alldetails<?php echo $product['epg_txnID'] ?>" data-toggle="modal" data-taget="#view_alldetails<?php echo $product['epg_txnID'] ?>">

 <input type ="button" class="btn btn-sm btn-default" value ="Invoice" /></a>
  <?php 
  if($product['payment_status']=='Transaction Successful')
//if($product['payment_status']=='1')
  {
 ?>
 <!-- SMS Model Start-->
<div class="modal fade" id="view_alldetails<?php echo $product['epg_txnID'] ?>" role="dialog">
<div class="modal-dialog">
    
    <?php 
    //print_r($product);
    ?>
      <!-- Modal content-->
<div class="modal-content col-md-12 col-sm-12 col-xs-12">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title"><span class="form_lable02">Invoice Details</span></h4>
    </div>
    
<div class="modal-body col-md-12 col-sm-12 col-xs-12">
<object data="<?php echo base_url(); ?>invoice_code/reports/SMSStriker_invoice_<?php echo $product['epg_txnID'] ?>.pdf" type="application/pdf" width="500px" height="500px">
  <p>Alternative text - include a link <a href="<?php echo base_url(); ?>invoice_code/reports/invoice_<?php echo $product['epg_txnID'] ?>.pdf">to the PDF!</a></p>
</object>
</div>
</div>
</div>
</div>
<!-- SMS Model end -->

<?php }?>
                        
                        </td>
                        </tr>
                    
         <?php 
          $sno++;
        }
	   }
	   else 
	   {
       ?>
      <tr><td colspan="7">No Records Available.</td></tr>
        <?php 
        }
        ?>
		</tbody>
        </table>
        
        
        
       </div>
       <div class="col-md-12 col-sm-12 col-xs-12 pagination_div padding_zero">
		<?php echo $this->pagination->create_links(); 
		?>
		</div>
       
     </div>   
</div>
</div>


<script src="<?php echo base_url();?>js/form_validation/js/bootstrap-tooltip.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>js/form_validation/js/jquery-validate.bootstrap-tooltip.js" type="text/javascript"></script>

<script>
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

$("#order_history_report").validate({
    rules: {
	trn_transid: {
          
            regexpcol: true			
        }

    },
  
	tooltip_options: {
    	trn_transid: {placement:'bottom',html:true}
		
		}
}); 
 </script>


<script type="text/javascript">
$(document).ready(function(){ 
$('#to_date').datepicker( {
    	changeMonth: true,
    	changeYear: true, 
    	dateFormat: "yy-mm-dd",
		 maxDate: new Date(),
		 
		onSelect: function (selectedDate) {
                var orginalDate = new Date(selectedDate);
                var monthsAddedDate = new Date(new Date(orginalDate).setMonth(orginalDate.getMonth()));
                
       //$("#to_date").datepicker("option", 'minDate', selectedDate);
                $("#from_date").datepicker("option", 'maxDate', monthsAddedDate);
            }
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });
	$('#from_date').datepicker( {
    	changeMonth: true,
    	changeYear: true, 
    	dateFormat: "yy-mm-dd",
		 maxDate: new Date(),
	
		onSelect: function (selectedDate) {
                var orginalDate = new Date(selectedDate);
             //   var monthsAddedDate = new Date(new Date(orginalDate).setMonth(orginalDate.getMonth() - 1));
               
              //  $("#to_date").datepicker("option", 'minDate', monthsAddedDate);
                $("#to_date").datepicker("option", 'minDate', selectedDate);
            }
    }).click(function(){
    	$('.ui-datepicker-calendar').show();
    });
});
</script>	



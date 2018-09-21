<body oncontextmenu="return false;">
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
 <div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/payments-icon.png" class="right-title-img">Order Details</h3>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">

</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
    <div class="col-sm-12 col-md-12 col-xs-12 padding_zero table-responsive">          
      
  <table class="table_all table">
  <thead>
                <tr>
                <th>S.no</th>
                <th>SMS Type</th>
                <th>No.of.SMS</th>
                <th>Longcode Credits</th>
                <th>Shorturl Credits</th>
                 <th>Amount ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;""></i> ) </th>
                <th>Tax Amount ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> ) </th>
                 <th>Total Amount ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> ) </th>
                <th colspan=1>Action</th>
                </tr>
				</thead>
				<tbody>
        <?php
       // print_r($products);
	$user_id=$this->session->userdata('user_id');
	$sql="SELECT u.no_ndnc,u.dnd_check,u.state_id,u.city_id,u.address1,u.zipcode,u.organization,u.email,u.mobile FROM users u WHERE u.user_id = $user_id";
	$user=$this->db->query($sql)->result();
	$usertype='';
	
	$getnoofsms=0;
	$getloncodecredits=0;
	$getshorturlcredits=0;
	$getamount=0;
	$gettaxamount=0;
	$gettotalamount=0;
	
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
	
	                        $noofsms=$getnoofsms;
                      
	
	
	   $sno=1;
	   if($this->uri->segment(4)!='')
		{
		 	$sno=$this->uri->segment(4)+1;
		}
	   if(count($products)>0)
	   {
	   
	   
        foreach($products as $key=>$product)
        {
           // print_r($product);                              
         ?>
         
                    
                        <tr>
                        <td>
                        <?php echo  $sno ?>
                        <input type = "hidden" name = "id" id="productid<?php echo $product['id'] ?>" value = "<?php echo $product['id'] ?>"/>
                        </td>
                        <td>
                        <?php echo $usertype; ?>
                        <input type = "hidden" name = "description" value = "<?php echo $product['smstype'] ?>"/>
                        </td>
                      
                        
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
                     /*
			           $price=$sms_price;
                        echo $amount=$product['noofsms']*$price;
                             $tax_amount=round(($amount *$tax)/100);
                             $total_amount=$amount+$tax_amount;
                             */
                             echo $amount=$product['amount'];
                             $tax_amount=$product['tax_amount'];
                             $total_amount=$product['total_amount'];
                             
					$getnoofsms=$getnoofsms+$product['noofsms'];
					$getloncodecredits=$getloncodecredits+$product['longcode_credits'];
					$getshorturlcredits=$getshorturlcredits+$product['shorturl_credits'];
					$getamount=$getamount+$amount;
					$gettaxamount=$gettaxamount+$tax_amount;
					$gettotalamount=$gettotalamount+$total_amount;
                         ?>
                         </span>
                        <input type = "hidden" class="price<?php echo $product['id'] ?>"  name = "price" value = "<?php echo ceil($product['noofsms']*$price); ?>"/>
                         <input type = "hidden"  name = "tax" value ="<?php echo $tax; ?>"/>
                        </td>
                      <td><?php echo $tax_amount; ?></td>
                        <td><?php echo $total_amount; ?></td>
<td><a href="#view_alldetails<?php echo $product['id'] ?>" data-toggle="modal" data-taget="#view_alldetails<?php echo $product['id'] ?>"><span data-toggle="tooltip" data-original-title="View more"><i class="fa fa-eye" aria-hidden="true"></i></span></a>
                       		
<!-- SMS Model Start -->
<div class="modal fade" id="view_alldetails<?php echo $product['id'] ?>" role="dialog">
<div class="modal-dialog">
    
    <?php 
    //print_r($product);
    ?>
      <!-- Modal content-->
<div class="modal-content col-md-12 col-sm-12 col-xs-12">
	<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
       
    </div>
    
<div class="modal-body col-md-12 col-sm-12 col-xs-12">
		
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">Transaction ID :</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">

<?php  
if($product['epg_txnID']!=''){
echo $product['epg_txnID'];
} 
else{
echo "--";
};
?>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">Transaction Status :</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">

<?php 
if( $product['pgresponse']=='Transaction Successful' ||  $product['pgresponse']=='Added by admin' )
{
echo "Success";
}
else if( $product['pgresponse']=='Transaction Cancelled')
{
echo "Cancelled";
}
else 
{
echo "Cancelled";
}
?>

</div>
</div>


<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">SMS Credits:</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">

<?php  
if($product['noofsms']!=''){
echo $product['noofsms'];
} 
else{
echo "--";
};
?>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">Longcode Credits :</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">

<?php  
if($product['longcode_credits']!=''){
echo $product['longcode_credits'];
} 
else{
echo "--";
};
?>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">Shorturl Credits :</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">

<?php  
if($product['shorturl_credits']!=''){
echo $product['shorturl_credits'];
} 
else{
echo "--";
};
?>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">Price Per Credit:</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">

<?php  
if($product['price_per_sms']!=''){
echo $product['price_per_sms'];
} 
else{
echo "--";
};
?>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">SMS Type:</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">

<?php  
if($product['smstype']!=''){
echo $product['smstype'];
} 
else{
echo "--";
};
?>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">Description:</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">
<?php  
if($product['description']!=''){
echo $product['description'];
} 
else{
echo "--";
};
?>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">Subscription:</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">
<?php  
if($product['subcription']!=''){
echo $product['subcription'];
} 
else{
echo "--";
};
?>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">Name:</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">

<?php  
if($product['name']!=''){
echo $product['name'];
} 
else{
echo "--";
};
?>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">Mobile:</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">

<?php  
if($product['mobile']!=''){
echo $product['mobile'];
} 
else{
echo "--";
};
?>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">E-Mail:</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">

<?php  
if($product['email']!=''){
echo $product['email'];
} 
else{
echo "--";
};
?>
</div>
</div>

<!--
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">Registered User Id:</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">

<?php  
if($product['registeruser_id']!=''){
echo $product['registeruser_id'];
} 
else{
echo "--";
};
?>
</div>
</div>
-->
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">Payment Status:</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">

<?php  
if($product['payment_status']=='1'){
echo "Yes";
} 
else{
echo "No";
};
?>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">Add Credits :</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">

<?php  
if($product['is_created']=='1'){
echo "Yes";
} 
else{
echo "No";
};
?>
</div>
</div>

<!--
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">Order Status:</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">

<?php  
if($product['order_status']=='1'){
echo "Yes";
} 
else{
echo "No";
};
?>
</div>
</div>
-->


<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">Amount ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> ) :</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">
<?php  echo $amount;?>
</div>
</div>


<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">Tax(15%) ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> ) :</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">
<?php  echo $tax_amount;?>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">Total Amount ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> ) :</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">
<?php  echo $total_amount;?>
</div>
</div>


<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty padding_mzero col-xs-12">
<span class="form_lable03">Date :</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">
<?php  echo $product['created_on'];?>
</div>
</div>



</div>   

        </div>
        
      </div>
      
    </div>
  </div>  
  <!-- Model End -->
                       </td>
                        
                        </tr>
         <?php 
         $sno++;
      
        }
        ?>
        
         <tr><td></td><td></td><td><?php echo $getnoofsms;?></td><td><?php echo $getloncodecredits;?></td>
         <td><?php echo $getshorturlcredits;?></td><td><?php echo $getamount;?></td><td><?php echo $gettaxamount;?></td>
         <td><?php echo $gettotalamount;?></td><td></td></tr>
         
         <?php
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
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">	   
<div class="col-sm-6 col-md-6 padding_ltzero col-xs-12">
<a href="<?php echo base_url();?>Payment/order_history"><input type="button" name="back" value="Go Back" class="submit_btn"></a>
</div>   
<div class="col-md-6 col-sm-6 col-xs-12 pagination_div padding_zero">
<?php echo $this->pagination->create_links(); 
?>
</div>
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



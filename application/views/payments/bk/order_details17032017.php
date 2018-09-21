
<div class="col-sm-9 col-md-9 col-xs-12">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">

Transaction ID : <?php echo $this->uri->segment(3);?>
    <div class="table-responsive"> 
       
  <table class="table_all table">
  <thead>
                <tr>
                <th>S.no</th>
                <th>SMS Type</th>
                <th>No.of.SMS</th>
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
                       
                       /*
                            $pkg_range='';
							if($noofsms<=5000)
							{
							$pkg_range="1000-5000";
							}
							else if($noofsms<=10000 && $noofsms>=5000)
							{
							$pkg_range="5001-10000";
							}
							else if($noofsms<=25000 && $noofsms>=10001)
							{
							$pkg_range="10001-25000";
							}
							else if($noofsms<=50000 && $noofsms>=25000)
							{
							$pkg_range="25001-50000";
							}
							else if($noofsms<=100000 && $noofsms>=50001)
							{
							$pkg_range="50001-100000";
							}
							else if($noofsms<=500000 && $noofsms>=100001)
							{
							$pkg_range="100001-500000";
							}
                            else if($noofsms<=1000000 && $noofsms>=500001)
							{
							$pkg_range="500001-1000000";
							}
							else if($noofsms>1000001)
							{
							$pkg_range="10 Lakh above";
							}
					$sql="select * from sms_price_list where pkg_range='$pkg_range'";
					$rs=$this->db->query($sql)->result();
					//print_r($rs);
					 $sms_price ='';
					
					foreach($rs as $key=>$pricevalue)
					{
					
						 $sms_price = $pricevalue->$usertypecol;
						
					}
					
					*/
	
	//echo $usertype;
	//print_r($products);
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
                        <?php echo $product['noofsms'] ?>
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
        <h4 class="modal-title"><span class="form_lable02">Order Details</span></h4>
    </div>
    
<div class="modal-body col-md-12 col-sm-12 col-xs-12">
		
<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">Transaction ID :</span>
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
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">Transaction Status :</span>
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
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">No of SMS :</span>
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
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">No of Longcode credits :</span>
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
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">No of Shorturl credits :</span>
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
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">Price Per SMS:</span>
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
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">SMS Type:</span>
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
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">Description:</span>
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
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">subcription:</span>
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
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">Name:</span>
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
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">Mobile:</span>
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
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">E-Mail:</span>
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

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">Registred user Id:</span>
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

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">Payment Status:</span>
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
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">Add Credits :</span>
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

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">order_status:</span>
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



<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">Amount ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> ) :</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">
<?php  echo $amount;?>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">Tax(15%) ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> ) :</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">
<?php  echo $tax_amount;?>
</div>
</div>

<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">Total Amount ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> ) :</span>
</div>
<div class="col-md-7 col-sm-7 padding_zero col-xs-12">
<?php  echo $total_amount;?>
</div>
</div>


<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
<div class="col-md-5 col-sm-5 padding-memty col-xs-12">
<span class="form_lable03 pull-right">Date :</span>
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
        <div class="col-md-6 col-sm-6 col-xs-12 pagination_div padding_zero">
		<a href="<?php echo base_url(); ?>Payment/order_history" >
		<input type ="button" class="cart-first-form" " value ="Back" />
		</a>
		</div>
        <div class="col-md-6 col-sm-6 col-xs-12 pagination_div padding_zero">
		<?php echo $this->pagination->create_links(); 
		?>
		</div>
		</div>
       
     </div>   
</div>
</div>




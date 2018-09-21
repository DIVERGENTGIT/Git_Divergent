
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
 <div class="col-md-12 col-sm-12 col-xs-12 padding_dzero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/payments-icon.png" class="right-title-img"> Buy sms pack</h3>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">

 <div class="table-responsive">          
                       
                        <?php if(isset($this->session->userdata['user'])){?>
                        <div>
                        <?php $this->session->userdata['user']['msg'];
                              $this->session->unset_userdata('user');
                        ?>
                        </div>
                        <?php } ?>
<form method='post' action="<?php echo base_url()?>products/saveCartProducts">
 
                         <table class="table_all table">  
<thead>						   
                        <tr>
                                        <th>ID</th>  
                                        <th>SMS Type</th>
                                          <th>Noofsms</th>
                                        <th>Amount ( <i class="fa fa-inr" aria-hidden="true" style="color:black !important;"></i> ) </th>
                                        <th>Action</th>
                        </tr>
						</thead>
						<tbody>    
                        <?php 
                        
$user_id=$this->session->userdata('user_id');
$sql="SELECT u.no_ndnc,u.dnd_check,u.state_id,u.city_id,u.address1,u.zipcode,u.organization,u.email,u.mobile FROM users u WHERE u.user_id = $user_id";
$user=$this->db->query($sql)->result();
//print_r($user);
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
                                    foreach($products as $product) { 

                                    $user_id=$this->session->userdata('user_id');
						$rowid = $product['rowid'];
						$noofsms = $product['qty'];
						$price = $product['price'];;
						$data = array(
						'rowid' => $rowid,
						'qty'   => $noofsms,
						'price'=>$price,  
						'couponCode'=>$product['couponCode'],
						'user_id'=>$user_id
						);
						$this->cart->update($data); 

						$this->product->update_price_rowid($product['id'],$noofsms,$price,$rowid,$product['couponCode']);
 
                                        ?> 
               
                                        <tr>
                                        <td>
                                        <?php //echo $product['id']
					                        echo $sno;
					                        ?>
                                        <input type = "hidden" name = "id[]" value = "<?php echo $product['id'] ?>"/>
                                         <input type = "hidden" name = "rowid[]" id="rowid<?php echo $product['rowid'] ?>" value = "<?php echo $product['rowid'] ?>"/>
                                        </td>
                                        <td>
                                        <?php 
                                      if($usertype===$product['name'])
					{ 
					echo $product['name'];
					}
					else
					{
                                    echo "<strike style=color:red;>".$product['name']. "<sup>*</sup></strike> ".$usertype; 
            $msg='<p style="color:red">Note : (Your not applicable for '.$product['name'].' because of account type is '.$usertype.')</p>';
                                       
                                         }?>
                                        <input type = "hidden" name = "name[]" value = "<?php echo $product['name'] ?>"/>
                                        </td>
                                       
                                        <td>
                                        <?php echo $product['qty'] ?>
                        <input type = "hidden"  name ="qty[]" style ="width:50px;" value = "<?php echo $product['qty']?>"/>
                                        </td>
                                        
                                         <td>
                                        <?php 
						   
							$noofsms=0;
							if($product['qty']>0) 
							{
							 $noofsms=$product['qty'];
							}
						  
					$pkg_range='';
					$sql="SELECT * FROM `sms_packages` where noofsms<=$noofsms order by id desc limit 1";
					$rs= $this->db->query($sql)->result();
					//print_r($rs);
					$sms_price ='';
					foreach($rs as $key=>$pricevalue)
					{
					
						  $sms_price = $pricevalue->$usertypecol;
						
					}
 
                             $amount=$noofsms*$sms_price;
                             $tax_amount=round(($amount *$tax)/100);
                           echo $total_amount=$amount+$tax_amount;
       
  $this->product->update_price_rowid($product['id'],$noofsms,$sms_price,$amount,$tax_amount,$total_amount,$product['rowid'],$product['couponCode']);
   
			$id=$product['id'];  
					?>
                                        <input type = "hidden" name = "price[]" value = "<?php echo $product['qty']*$sms_price; ?>"/>
                                        </td>
       <!--                                 
      <td>
     <input type ="button" class="btn btn-sm btn-default cart-first-form" id="itemremove<?php echo $product['rowid'] ?>" value ="Remove" />
      </td>
      -->
       <td>
		<span class="btn btn-sm btn-default"   
		data-toggle="confirmation"   
		data-btn-ok-label="Yes" 
		data-btn-ok-icon="glyphicon glyphicon-share-alt"
		data-btn-ok-class="btn-success" data-btn-cancel-label="NO!" 
		data-btn-cancel-icon="glyphicon glyphicon-ban-circle" 
		data-btn-cancel-class="btn-danger"
		data-original-title="" title="" 
		style="" 
		data-href="<?php echo site_url('products/delete_cart_product/'.$product['id'].'/'.$product['rowid']); ?>";
		>Delete</span> 
   </td>
                                        </tr>
                                        
                                        
                                        <script >
$(document).ready(function() {
	
$("#itemremove<?php echo $product['rowid'] ?>").click(function () {

	var id='<?php echo $product['id']; ?>';
	var rid='<?php echo $product['rowid'] ?>';
		
	var baseurl="<?php echo base_url()?>";

	
	var urlstr=baseurl+"products/remove_cart_product";	
	//alert(urlstr);
	if(confirm('Do you want to delete')==true)
	{
		$.ajax({
		method: "POST",
		url: urlstr,
		data:{pid:id,rowid:rid,del:"del"},
		success: function(data){
		console.log(data);
		//alert(data);
		//alert('successfully deleted');
		window.location=baseurl+"products/shoppingCartView";


		},
		error: function(){

		console.log("Error");

		}
		});
	}

});
});

</script>   

                                        <?php
                                        $sno++;
                                        }
                                        }
                                        else
                                        {?> 
                                        <tr>
                                        <td colspan="5">No records available</td>
                                        <tr>
                                        <?php
                                        }
                                        ?>
</tbody>										
                                        </table>
                                        <?php 
                       // print_r($products);
                       if(count($products)>0)
                       {
                       ?>
                       <input type ="submit" class="submit_btn cart-first-form" value ="Order Now"/>
                      <!--
                       <a href="<?php echo base_url(); ?>products/index/<?php echo $product['rowid'] ?>">
                        <input type ="button" class="submit_btn cart-first-form" value ="Back"/> </a>
                     -->
                     
                     <a href="<?php echo base_url(); ?>products/index">
                        <input type ="button" class="submit_btn cart-first-form" value ="Back"/> </a>
                        
                       <?php }
                       else
                       {
                       ?>
                       <!--
                       <a href="<?php echo base_url(); ?>products/index/<?php echo $product['rowid'] ?>"><input type ="button" class="cart-first-form" value ="Back"/></a>-->
                       
                       <a href="<?php echo base_url(); ?>products/index"><input type ="button" class="cart-first-form" value ="Back"/></a>
                       
                       <?php
                       }

						if(isset($msg)){ 	echo $msg;}
         
                        ?>
                                        
                        </form>
                        </div>
                         </div>
                          </div>
                           </div>
                            </body>
<!-- jvectormap -->
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<!-- ChartJS 1.0.1 -->
<script src=" <?php echo base_url();?>assets/js/bootstrap-confirmation.min.js" type="text/javascript"></script>

<!-- conformation-->
<script>
$(function() {
$('[data-toggle="confirmation"]').confirmation();
$('[data-toggle="confirmation-singleton"]').confirmation({ singleton: true });
$('[data-toggle="confirmation-popout"]').confirmation({ popout: true });
})
</script>
     


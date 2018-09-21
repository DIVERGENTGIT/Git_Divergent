
<div class="col-sm-9 col-md-9 col-xs-12 main-right-div">
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
 <div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<h3 class="right-content-title"><img src="<?php echo base_url();?>images/payments-icon.png" class="right-title-img">Select sms pack</h3>
</div>
<div class="col-sm-12 col-md-12 col-xs-12 padding_zero">
    <div class="table-responsive"> 
           
  <table class="table_all">
  <thead>
                <tr>
                <th>ID</th>
                <th>SMS Type</th>
               
                        <th>Noofsms</th>
                 <th>Amount ( <i class="fa fa-inr" aria-hidden="true"></i> ) </th>
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
	
	//print_r($products);
	$sno=1;
        foreach($products as $key=>$product)
        {
                                        
         ?>
         
                        
                        <tr>
                        <td>
                        <?php //echo $product['id']
                        echo $sno;
                        ?>
                       
                        </td>
                        <td>
                        <?php echo $product['smstype'] ?>
                        
                        </td>
                      
                        <td>
                        <input type = "text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="qty<?php echo $product['id'] ?>" name ="qty" class="clicknoofsms<?php echo $product['id'] ?>" style ="width:100px;" value = "<?php echo $product['noofsms'] ?>"/>
                        <span class="qtymsg<?php echo $product['id'] ?>"></span>
                        </td>
                        
                          <td>
                          <span class="displayprice<?php echo $product['id'] ?>">
                        <?php
                        $noofsms=0;
                        if($product['noofsms']>0) 
                        {
                        $noofsms=$product['noofsms'];
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
					$price=$sms_price;
					
                             $amount=$product['noofsms']*$price;
                             $tax_amount=round(($amount *$tax)/100);
                            echo  $total_amount=$amount+$tax_amount;
                         //  echo $product['couponCode'];exit; 
    $this->product->update_price_rowid($product['id'],$noofsms,$price,$amount,$tax_amount,$total_amount,$product['cartid'],$product['couponCode']);       
                         ?>
                         </span>  
                        
                          
                        </td>  
                        <td>
     <form method='post' action="<?php echo base_url()?>products/addToCart">   
     <input type = "hidden" name = "id" id="productid<?php echo $product['id'] ?>" value = "<?php echo $product['id'] ?>"/>
      <input type = "hidden" name = "qty"  class="getqty<?php echo $product[id]?>" value = "<?php echo $product['noofsms'] ?>" /> 
      <input type = "hidden"  name = "tax" value ="<?php echo $tax; ?>"/>
      <input type = "hidden" class="price<?php echo $product['id'] ?>"  name = "price" value = "<?php echo $product['noofsms']*$price; ?>"/>   
     <input type = "hidden" name = "description" class="description<?php echo $product['id'] ?>" value = "<?php echo $product['smstype'] ?>"/>    
<input type = "hidden" name = "couponCode" class="couponCode<?php echo $product['id'] ?>" value = "<?php echo $product['couponCode'] ?>"/>                      
     <input type ="button" class="btn btn-sm btn-default cart-first-form addtocart<?php echo $product['id'] ?>" value="Add to cart" />
     </form>  
     </td>
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
		data-href="<?php echo site_url('products/deleteCart/'.$product['id'].'/'.$product['cartid']); ?>";
		>Delete</span> 
   </td>
                        </tr>
                        
                        
 <script>
$(document).ready(function() {

$(".clicknoofsms<?php echo $product['id'] ?>").keypress(function(event){

    if (event.keyCode === 10 || event.keyCode === 13) 
        event.preventDefault();

  });
	
$("#cartremove<?php echo $product['id'] ?>").click(function () {

	var id=$("#productid<?php echo $product['id'] ?>").val();
	var rid="<?php echo $product['cartid']; ?>";
	var baseurl="<?php echo base_url(); ?>";
	var urlstr=baseurl+"products/removeCart";	
	//alert(urlstr);
	
	if(confirm('Do you want to delete')==true)
	{
		$.ajax({
		method: "POST",
		url: urlstr,
		data:{pid:id,rid:rid, del:"del"},
		success: function(data){
		console.log(data);
		//alert(data);
		//confirm('successfully deleted');
		window.location=baseurl+"products/index";
		},
		error: function(){

		console.log("Error");

		}
		});
	}


});

// onchange for price

$(".qty<?php echo $product[id] ?>").on("blur",function(){

		var noofsms=$(".qty<?php echo $product[id]?>").val();
		
		/*
		//var price=noofsms*(<?php echo $price;?>);
		$(".displayprice<?php echo $product['id']?>").html(price);
		*/
		var id=$("#productid<?php echo $product['id'] ?>").val();
		var baseurl="<?php echo base_url(); ?>";
		var urlstr=baseurl+"products/updateprice";	
		var cartid="<?php echo $product['cartid'] ?>";
		var tax="<?php echo $tax; ?>";
		var couponCode = "<?php echo $product['couponCode']; ?>";
		var noofsms=$(".qty<?php echo $product[id]?>").val();
		
		$(".getqty<?php echo $product[id]?>").val(noofsms);
		//alert(urlstr);
		
		if(noofsms>499)
		{
		$(".qtymsg<?php echo $product['id'] ?>").html("");
		$.ajax({
		method: "GET",
		url: urlstr,
		dataType:"json",
		data:{pid:id,noofsms:noofsms,update:"update",cartid:cartid,tax:tax,couponCode:couponCode},
		success: function(data){
		
		console.log(data);
		
		$(".displayprice<?php echo $product['id']?>").html(data.total_amount);
		
		//$(".displayprice<?php echo $product['id']?>").val(data.total_amount);
		
		
		},
		error: function(){

		console.log("Error");

		}
		});
		}
		else
		{
		$(".qtymsg<?php echo $product['id'] ?>").html("please enter min 500");
		$(".qtymsg<?php echo $product['id'] ?>").css("color","red");
		}
});

// add to card


// onchange for price

$(".addtocart<?php echo $product['id'] ?>").on("click",function(){

		var noofsms=$(".qty<?php echo $product[id]?>").val();
		var description=$(".description<?php echo $product[id]?>").val();
		/*
		//var price=noofsms*(<?php echo $price;?>);
		$(".displayprice<?php echo $product['id']?>").html(price);
		*/
		var id=$("#productid<?php echo $product['id'] ?>").val();
		var baseurl="<?php echo base_url(); ?>";
		var urlstr=baseurl+"products/addToCart";	
		var cartid="<?php echo $product['cartid'] ?>";
		var couponCode="<?php echo $product['couponCode'] ?>";
		var tax="<?php echo $tax; ?>";
		//alert(urlstr);
		
		if(noofsms>499)  
		{
			$(".qtymsg<?php echo $product['id'] ?>").html("");
			$.ajax({
			method: "GET",
			url: urlstr,
			dataType:"json",
			data:{id:id,qty:noofsms,update:"update",cartid:cartid,tax:tax,description:description,couponCode:couponCode},
			success: function(data){
		
				console.log(data);
		
				 window.location.href = '<?php echo base_url()?>products/shoppingCartView';
		
		
			 },
			 error: function(){

			 console.log("Error");   

			 }
			});
		}
		else
		{
		$(".qtymsg<?php echo $product['id'] ?>").html("please enter min 500");
		$(".qtymsg<?php echo $product['id'] ?>").css("color","red");
		}
});



});

</script> 
         
         <?php 
         $sno++;
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

     
 
 




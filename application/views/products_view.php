<script src="<?php echo base_url(); ?>/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>

    <script src="<?php echo base_url(); ?>/assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<body class="skin-blue sidebar-mini">
<div class="col-sm-10 col-xs-12 padding_zero">
<div class="panel panel-default col-md-12 col-sm-12 col-xs-12">
<div class="col-sm-12 col-md-12 col-xs-12 container01">
    <div class="table-responsive">          
  <table class="table_all table">
  <thead>
                <tr>
                <th>ID</th>
                <th>Description</th>
               
                        <th>noofsms</th>
                 <th>Price</th>
                <th colspan=2>Action</th>
                </tr>
				</thead>
				<tbody>
        <?php foreach($products as $product){ ?>
                        <form method='post' action="<?php echo base_url()?>products/addToCart">
                        <tr>
                        <td>
                        <?php echo $product['id'] ?>
                        <input type = "hidden" name = "id" id="productid<?php echo $product['id'] ?>" value = "<?php echo $product['id'] ?>"/>
                        </td>
                        <td>
                        <?php echo $product['smstype'] ?>
                        <input type = "hidden" name = "description" value = "<?php echo $product['smstype'] ?>"/>
                        </td>
                      
                        <td>
                        <input type = "text" class="qty<?php echo $product['id'] ?>" name ="qty" style ="width:50px;" value = " <?php echo $product['noofsms'] ?>"/>
                        </td>
                        
                          <td>
                          <span class="displayprice<?php echo $product['id'] ?>">
                        <?php 
                        $price=$smsprice;
                        echo ceil($product['noofsms']*$price);
                         ?>
                         </span>
                        <input type = "hidden" class="price<?php echo $product['id'] ?>"  name = "price" value = "<?php echo ceil($product['noofsms']*$price); ?>"/>
                        </td>
                        <td><input type ="submit" class="cart-first-form" value="Add to cart" /></td>
                         <td><input type ="button" class="cart-first-form" id="cartremove<?php echo $product['id'] ?>" value ="Remove" /></td>
                        </tr>
                        </form>
                        

<script >
$(document).ready(function() {
	
$("#cartremove<?php echo $product['id'] ?>").click(function () {

	var id=$("#productid<?php echo $product['id'] ?>").val();
	var rid='<?php echo $rowid; ?>';
	var baseurl="http://10.10.10.112/newui/app/";
	var urlstr=baseurl+"products/removeCart";	
	//alert(urlstr);
	$.ajax({
		method: "POST",
			url: urlstr,
			data:{pid:id,rid:rid, del:"del"},
			success: function(data){
				console.log(data);
				//alert(data);
				alert('successfully deleted');
				window.location=baseurl+"products/index";
			},
			error: function(){
			
				 console.log("Error");
				 
			}
	      });


});

// onchange for price

$(".qty<?php echo $product[id] ?>").on("blur",function(){
	var noofsms=$(".qty<?php echo $product[id]?>").val();
	var price=noofsms*(<?php echo $smsprice;?>);
	$(".displayprice<?php echo $product['id']?>").html(price);

	var id=$("#productid<?php echo $product['id'] ?>").val();
	var baseurl="http://10.10.10.112/newui/app/";
	var urlstr=baseurl+"products/updateprice";	
	//alert(urlstr);
	$.ajax({
		method: "POST",
			url: urlstr,
			data:{pid:id,noofsms:noofsms,price:price,update:"update"},
			success: function(data){
				console.log(data);
				//alert(data);
				//alert('successfully deleted');
				//window.location=baseurl+"products/index";
			},
			error: function(){
			
				 console.log("Error");
				 
			}
	      });

	

	
});

});

</script> 
        <? } ?>
		</tbody>
        </table>
        
       </div>
       
     </div>   
</div>
</div>




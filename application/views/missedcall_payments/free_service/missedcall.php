
 <div class="modal fade" id="addmissedcallmodel" role="dialog">
    <div class="modal-dialog template_modal_div">
    
      <!-- Modal content-->
      <div class="modal-content col-md-12 col-sm-12 col-xs-12 padding_zero">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        
        <div class="modal-body col-md-12 col-sm-12 col-xs-12">
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		<div class="col-md-10 col-sm-10 col-xs-12 padding_zero">
		<ul class="addmisstabs">
		<li class="currentmisstab"><a href="#exist-cust"  class="existing_order_numbers" >Existing
		
		</a></li>
		<li><a href="#new-cust" class="order_numbers">New</a></li>
		</ul>
		
		<input type="hidden" value="Missedcall" id="plan_service" class="plan_service" />
            <input type="hidden" class="append_service_num" value="<?php echo @$_SESSION['sel_nos'];?>" />
            <input type="hidden" class="exist_append_service_num"  />
	</div>
	
	</div>
	<div id="exist-cust" class="col-md-12 col-sm-12 col-xs-12 missadmintab-content padding_zero">
	<div class="col-md-12 col-sm-12 col-xs-12 form-div avalble_numbers">
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero service_avb_div">
<div class="scroll_num scroll_numbar">
<ul class="select_numbers existselect_numbers">
</ul>
</div>
</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
            <!--
		<input type="submit" name="" value="Submit" class="add_mrnumb create-btn" >
		-->
		</div>
	</div>
	
<!-- service numbers start -->

	<div id="new-cust" class="col-md-12 col-sm-12 col-xs-12 missadmintab-content padding_zero displayodernumbers" style="display:none;">
	</div>
<!-- service numbers end -->

<div class="col-md-12 col-sm-12 col-xs-12  padding_zero">
<!--
<input type="button" value="Buy" class="create-btn  buy-btnhide add_mrnumb neworderbtn" style="display:none;" >
-->
<input type="button" value="Add"  data-dismiss="modal"  class="submit_btn add_mrnumb existorderbtn" style="display:none;" >

</div>

<div class="col-md-12 col-sm-12 col-xs-12  padding_zero">
<p>Note : Free Service Number is validity 30 days.Missedcall Number will released to free pool If the customer not utilized the number for 15 days!!!...</p>
</div>		

<!-- display user forms start -->

<div class="displayuserfroms">
</div>
<!-- display user forms end -->	

	
		
		
		
		<?php 
$user_id=$this->session->userdata('user_id');
$sql="SELECT u.no_ndnc,u.state_id,u.city_id,u.address1,u.zipcode,u.organization,u.email,
u.mobile,u.address1,u.address2,u.first_name,u.last_name FROM users u WHERE u.user_id = $user_id";
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


$state_id=$value->state_id;
$city_id=$value->city_id;
$address1=$value->address1;
$address2=$value->address2;
$zipcode=$value->zipcode;
$address1=$value->address1;
$organization=$value->organization;
$email=$value->email;
$mobile=$value->mobile;
$first_name=$value->first_name;
$last_name=$value->last_name;

 $real_url=$this->config->item('firstring_url');
 
}

?>





<!--
<script>
$(document).ready(function(){

    $(".buy-btnhide").click(function(){
            $('.buy-divshow').show();
		$('.buy-divhide, .btnhidebuy').hide();
		
    });
    
	$(".addmisstabs li").click(function(){
	$('.buy-divshow').hide();
	});
	
	
});
</script>
-->



</div>

        </div>
        
      </div>
      
    </div>
    





<!-- get order numbers start-->

<script>
 $(document).ready(function() {
 
  $(".existorderbtn").show();
  var plan_service=$.trim($("#plan_service").val());
  
      if(plan_service=='')
      {
        $(".nos_div").hide();
      }
 	
    $(".order_numbers").on("click",function(event) {
        
    	// $(".neworderbtn").show();
    	  
    	 $(".existorderbtn").hide();  
  /*  
  $(".neworderbtn").show();
  $(".existorderbtn").hide();
  $(".userlogin_from").hide();*/
    		
    		// get order numbers
        var plan_service=$.trim($("#plan_service").val());
		console.log(plan_service);
		var snos = $(".append_service_num").val();		
		if(plan_service.length > 0 || plan_service != ''){
		$.ajax({
			type: "GET",
			data: {plan_service:plan_service,snos:snos},
			url: "<?php echo base_url();?>Free_service/order_numbers",
			success: function(data)
			{
				console.log(data);
				$(".displayodernumbers").html(data);
			}
		});
	      }
	      
	      //get_did_numbers
	      
	        $.ajax({
			type: "GET",
			data: {},
			url: "<?php echo base_url(); ?>Free_service/get_did_numbers",
			success: function (callback_data) 
			{
		
			console.log(callback_data);
			
			$('.didprice').html(callback_data);
			}
			});	

			// get user form

	        $.ajax({
				type: "GET",
				data: {},
				url: "<?php echo base_url(); ?>Free_service/getuserforms",
				success: function (callback_data) 
				{
				console.log(callback_data);
				
				$('.displayuserfroms').html(callback_data);
				}
				});	
	      
    });
    
// getexisting_numbers
var urlstr="<?php echo $this->config->item('firstring_url') ?>API/smsstriker/getexisting_numbers.php";
console.log(urlstr);
var user_id = "<?php echo $this->session->userdata('user_id')?>";
  
  
   
    var plan_service=$.trim($("#plan_service").val());
		console.log(plan_service);
		var snos = $(".append_service_num").val();		
		if(plan_service.length > 0 || plan_service != ''){
		$.ajax({
			type: "GET",
			data: {plan_service:plan_service,user_id:user_id},
			url: "<?php echo base_url(); ?>Free_service/existing_order_numbers",
			success: function(data)
			{
				console.log(data);
				$(".existselect_numbers").html(data);
			}
		});
	      }
   
   $(".existing_order_numbers").on("click",function(event) {

	   $(".neworderbtn").hide();
	   $(".existorderbtn").show();
	    
	/*   
   $(".neworderbtn").hide();
   $(".existorderbtn").show();
   $(".userlogin_from").hide();
    $(".buy-divshow").hide();*/
    		
        var plan_service=$.trim($("#plan_service").val());
		console.log(plan_service);
		var snos = $(".append_service_num").val();		
		if(plan_service.length > 0 || plan_service != ''){
		$.ajax({
			type: "GET",
			data: {plan_service:plan_service,user_id:user_id},
			url: "<?php echo base_url(); ?>Free_service/existing_order_numbers",
			success: function(data)
			{
				console.log(data);
				$(".existselect_numbers").html(data);
			}
		});
	      }
	      
		$('.displayuserfroms').html('');
    });
   
    
    
      });    

</script>
 <!--  Model End --> 
 <?php ?>
</body>


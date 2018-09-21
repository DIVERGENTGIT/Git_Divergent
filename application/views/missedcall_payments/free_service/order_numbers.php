

<form class="missedcall_allform">
<input type="hidden" class="append_service_num"/>		
<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
<!--<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
<input type="text" name="">
</div>-->
<div class="col-md-12 col-sm-12 padding_zero form-div col-xs-12">
<div class="row">

<div class="col-md-12 col-sm-12 padding_zero col-xs-12">
	<div class="col-md-8 col-sm-8 col-xs-12">
		<ul class="chartcredit_three">
		<!--
			<li class="creditcurrent"><a href="#silver">Silver</a></li>
			
			<li><a href="#gold">Gold</a></li>
			<li><a href="#platinum">Platinum</a></li>   
		-->     
		</ul>
</div>

	
<div class="col-md-12 col-sm-12 padding_zero col-xs-12 smsadmintabdiv missedcall_allform">
<div class="col-md-4 col-sm-4 price-abslut col-xs-12">

       <div class="total_price01">
	<img src="<?php echo base_url(); ?>images-new/free-missedcall-img.png" alt="free image">
	</div>
<!--<span class="pull-right pricemodal_total padding_rtzero">Total Price: <br><i class="fa fa-inr" aria-hidden="true"></i> <span id="snos_cost">0.00</span></span>-->
	</div>
<div id="silver" class="crdttab-content">
<div class="col-md-12 col-sm-12 price_search_mrn col-xs-12">
	<!--
	<div class="col-md-3 col-sm-3 padding_zero form-div col-xs-12">
	<select class="silver_didtype">
	<option value="">Select Number type</option>
	<?php
	//print_r($did_types);
	foreach($did_types as $key=>$didval)
	{
	?>
	<option value="<?php echo $didval['did_value'];?>"><?php echo $didval['did_name'];?></option>
	<?php
	}
	?>
     -->

	</select>
	</div> 
	
	<div class="col-md-3 col-sm-3 padding_rtzero padding_mzero form-div col-xs-12">
	<input type="text" name="silver_search" class="search_icon silver_search" placeholder="Service Number Search">
	</div>
	<div class="col-md-3 col-sm-3 padding_rtzero form-div padding_mzero col-xs-12">
	<input type="button" name="" value="Search" class="padding-btn submit_btn silver_search_button">
	</div>
		
	
</div>
<!--display silver numbers start-->
<div class="col-md-12 col-sm-12 col-xs-12">
<label>Available Numbers:</label>
<span class="service_number_msg"></span>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="col-md-12 col-sm-12 padding_zero select_numbers_bg col-xs-12">

<div class="col-md-12 col-sm-12 col-xs-12 form-div avalble_numbers">
<div class="col-md-12 col-sm-12 col-xs-12 scroll_num scroll_numbar">
<!--display silver numbers start-->
<ul class="select_numbers price_list getsilver_ul">
</ul>
<!--display silver numbers start-->
</div>					
</div>

</div>
</div>
<!--display silver numbers start-->
</div>
<div id="gold" class="crdttab-content" style="display:none;">
	<div class="col-md-12 col-sm-12 price_search_mrn col-xs-12">
	<div class="col-md-3 col-sm-3 padding_zero form-div col-xs-12">
		<select class="gold_didtype">
		<option value="">Select Number type</option>
		<?php
		//print_r($did_types);
		foreach($did_types as $key=>$didval)
		{
		?>
		<option value="<?php echo $didval['did_value'];?>"><?php echo $didval['did_name'];?></option>
		<?php
		}
		?>
		
		
		</select>
	      </div> 
	<div class="col-md-3 col-sm-3 padding_rtzero padding_mzero form-div col-xs-12">
		<input type="text" name="gold_search" class="search_icon gold_search" placeholder="Service Number Search">
	</div>
	<div class="col-md-3 col-sm-3 padding_rtzero padding_mzero form-div col-xs-12">
		<input type="button" name="" value="Search" class="padding-btn submit_btn gold_search_button">
	</div>
	</div>
	
<!--display gold numbers start-->
<div class="col-md-12 col-sm-12 col-xs-12">
<label>Available Numbers:</label>
<span class="service_number_msg"></span>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="col-md-12 col-sm-12 padding_zero select_numbers_bg col-xs-12">

<div class="col-md-12 col-sm-12 col-xs-12 form-div avalble_numbers">
<div class="col-md-12 col-sm-12 col-xs-12 scroll_num scroll_numbar">
<!--display silver numbers start-->
<ul class="select_numbers price_list getgold_ul">
</ul>
<!--display gold numbers start-->
</div>					
</div>

</div>
</div>
<!--display gold numbers start-->


</div>

<div id="platinum" class="crdttab-content" style="display:none;">
<div class="col-md-12 col-sm-12 price_search_mrn col-xs-12">
<div class="col-md-3 col-sm-3 padding_zero form-div col-xs-12">
		<select class="platinum_didtype">
		<option value="">Select Number type</option>
		<?php
		//print_r($did_types);
		foreach($did_types as $key=>$didval)
		{
		?>
		<option value="<?php echo $didval['did_value'];?>"><?php echo $didval['did_name'];?></option>
		<?php
		}
		?>
		
		
		</select>
	      </div> 
	<div class="col-md-3 col-sm-3 padding_rtzero padding_mzero form-div col-xs-12">
		<input type="text" name="platinum_search" class="search_icon platinum_search" placeholder="Service Number Search">
	</div>
	<div class="col-md-3 col-sm-3 padding_rtzero padding_mzero form-div col-xs-12">
		<input type="button" name="" value="Search" class="padding-btn submit_btn  platinum_search_button">
	</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<label>Available Numbers:</label>
<span class="service_number_msg"></span>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
<div class="col-md-12 col-sm-12 padding_zero select_numbers_bg col-xs-12">
<div class="col-md-12 col-sm-12 col-xs-12 form-div avalble_numbers">
<div class="col-md-12 col-sm-12 col-xs-12 scroll_num scroll_numbar">
<!--display platinum numbers start-->								
<ul class="select_numbers price_list getplatinum_ul">
</ul>
<!--display platinum numbers end-->
		</div>	
	</div>
	</div>
	</div>
</div>       
    </div>
    
    
</div>

<!--- display did numbers start---->
<div class="col-md-12 col-sm-12 padding_zero col-xs-12 didprice">
</div>
<!--- display did numbers end---->

</div>
</div>
</div>

 <script>
$(document).ready(function() {
   
	
	$(".chartcredit_three a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("creditcurrent");
        $(this).parent().siblings().removeClass("creditcurrent");
        var tab = $(this).attr("href");
        $(".crdttab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });

});
</script>
<!-- on click start-->
<script>
 $(document).ready(function() {
 
        /// get did numbers
	$.ajax({
	type: "GET",
	data: {},
	url: "<?php echo base_url(); ?>Free_service/DisplayNumbers",
	success: function (callback_data) 
	{
	console.log(callback_data);
	//console.log($('#rental_plan'));
	$('.didprice').html(callback_data);
	}
	});	

				
        var silverno=$.trim($(".silver_search").val());
        
        console.log(silverno);
        
		var checkedno=$.trim($(".append_service_num").val());
		
		var service_type = $.trim($(".plan_service").val());
		
		var Number_type = $.trim($(".silver_didtype").val());
		
		//console.log("silver"+service_type);
		//console.log(silverno.length);		
		
		$.ajax({
			type: "GET",
			data: {silverno:silverno,checkedno:checkedno,service_type:service_type,Number_type:Number_type},
			url: "<?php echo base_url();?>Free_service/Search_silverno",
			success: function(data)
			{
				console.log(data);
				$(".getsilver_ul").html(data);
			}
		});

 	
    $(".silver_search_button").on("click",function(event) {
    		
        var silverno=$.trim($(".silver_search").val());
        
        console.log(silverno);
        
		var checkedno=$.trim($(".append_service_num").val());
		
		var service_type = $.trim($(".plan_service").val());
		
		var Number_type = $.trim($(".silver_didtype").val());
		
		//console.log("silver"+service_type);
		//console.log(silverno.length);		
		if(silverno!='' || Number_type != ''){
		
		$.ajax({
			type: "GET",
			data: {silverno:silverno,checkedno:checkedno,service_type:service_type,Number_type:Number_type},
			url: "<?php echo base_url();?>Free_service/Search_silverno",
			success: function(data)
			{
				console.log(data);
				$(".getsilver_ul").html(data);
			}
		});
	}
	
    });
    
            var goldno=$.trim($(".gold_search").val());
		
		console.log(goldno);
		
		var checkedno=$.trim($(".append_service_num").val());
		
		var service_type = $.trim($(".plan_service").val());
		
		var Number_type = $.trim($(".gold_didtype").val());
		
		console.log(Number_type);
		$.ajax({
			type:"GET",
			data:{goldno:goldno,checkedno:checkedno,service_type:service_type,Number_type:Number_type},
			url:"<?php echo base_url();?>Free_service/Search_goldno",
			success:function(data){
				console.log(data);
				$(".getgold_ul").html(data);
			}			
		});
	
	$(".gold_search_button").on("click",function(event){
	
		var goldno=$.trim($(".gold_search").val());
		
		console.log(goldno);
		
		var checkedno=$.trim($(".append_service_num").val());
		
		var service_type = $.trim($(".plan_service").val());
		
		var Number_type = $.trim($(".gold_didtype").val());
		
		console.log(Number_type);
		
		if(goldno!='' || Number_type != ''){
		
		$.ajax({
			type:"GET",
			data:{goldno:goldno,checkedno:checkedno,service_type:service_type,Number_type:Number_type},
			url:"<?php echo base_url();?>Free_service/Search_goldno",
			success:function(data){
				console.log(data);
				$(".getgold_ul").html(data);
			}			
		});
		
		}
		
	});
	
	
	  var platinumno = $.trim($(".platinum_search").val());
		var checkedno=$.trim($(".append_service_num").val());
		var service_type = $.trim($(".plan_service").val());
		var Number_type = $.trim($(".platinum_didtype").val());
		//console.log("pla"+service_type);
		
		
		
		$.ajax({
			type:"GET",
			data:{platinumno:platinumno,checkedno:checkedno,service_type:service_type,Number_type:Number_type},
			url:"<?php echo base_url();?>Free_service/Search_platinumno",
			success:function(data){
				console.log(data);
				$(".getplatinum_ul").html(data);
			}
		});
		
	
	$(".platinum_search_button").on("click",function(event){
	
		var platinumno = $.trim($(".platinum_search").val());
		var checkedno=$.trim($(".append_service_num").val());
		var service_type = $.trim($(".plan_service").val());
		var Number_type = $.trim($(".platinum_didtype").val());
		//console.log("pla"+service_type);
		
		if(platinumno!='' || Number_type != ''){
		
		$.ajax({
			type:"GET",
			data:{platinumno:platinumno,checkedno:checkedno,service_type:service_type,Number_type:Number_type},
			url:"<?php echo base_url();?>Free_service/Search_platinumno",
			success:function(data){
				console.log(data);
				$(".getplatinum_ul").html(data);
			}
		});
		}
	});
	
	
}); 
</script>

<!-- on click end-->





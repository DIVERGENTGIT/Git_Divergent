
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		<div class="col-md-10 col-sm-10 col-xs-12 padding_zero">
		<div class="col-md-3 col-sm-3 col-xs-12 form-div padding_ltzero">
		<select class="getsilversubscription">
		<option value="">Select Subscription</option>
		<?php
		foreach($getsubscription_packages as $key=>$subscription_package)
		{
		?>
	     <option value="<?php echo $subscription_package->subscription_duration;?>">
	     <?php echo $subscription_package->subscription_duration;?></option>
		<?php
		}
		?>
		</select>
		<span class="silversubmsg"></span>
		</div>
		
		<div class="col-md-3 col-sm-3 col-xs-12 form-div padding_ltzero">
		
		<!--
		<select class="getsilverkeyword">
		<option value="">Select No.of.Keywords</option>
		<option value="1">1</option>
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
		<option value="5">5</option>
		<option value="6">6</option>
		<option value="7">7</option>
		<option value="8">8</option>
		<option value="9">9</option>
		<option value="10">10</option>
		</select>
		-->
		
		<!--
		<select class="getsilvernoofsms">
		<input type="text" class="getsilverkeyword" placeholder="Enter Keyword">
		-->
		<input type="text" class="getsilverkeyword" placeholder="Enter Keyword">
		<span class="silverkeywordmsg"></span>
		</div>
		
		<div class="col-md-3 col-sm-3 form-div padding_ltzero col-xs-12">
		<input type="text" class="getsilvernumber" placeholder="Number">
		</div>
		<div class="col-md-2 col-sm-2 col-xs-12 form-div padding_zero">
		<!--  
		<input type="submit" name="" class="create-btn" value="Search">
		-->
		<input type="submit" name="" class="submit_btn sharedsilversearch" value="Submit">
		</div>
		</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		<p class="aval-num-title">Available Numbers</p>
		<span class="service_number_msg"></span>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12 form-div avalble_numbers">
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero service_avb_div">
<div class="scroll_num scroll_numbar">
<ul class="select_numbers getsilver_searchnos">
<?php
$sno=1;
$checked = '';
foreach($longcode_numbers as $key=>$longcode_number)
{
              if(@$_SESSION['sel_nos']!= "")
				{
				$data = explode(",",@$_SESSION['sel_nos']);
				$checked = '';
				//print_r($data);
				for($z=0;$z<count($data);$z++)
				{
					if($data[$z] == $longcode_number->longcode_number)
					{
						$checked = "checked";
					}
				}
				}
?>
<li><div class="all_checkbox">
  <input id="silver-missd-num<?php echo $sno;?>" type="checkbox" class="checkboxsmsmis checkboxstyle
   getsilvernumber<?php echo $longcode_number->longcode_number;?>" name="field" 
 value="<?php echo  $longcode_number->longcode_id.','. $longcode_number->longcode_number.','. $longcode_number->longcode_type;?>"
    <?php echo $checked;?>  placeholder="">
  <label class="font_normal" for="silver-missd-num<?php echo $sno;?>"><span><span></span></span><?php echo $longcode_number->longcode_number;?></label>
</div>
</li>

<script type="text/javascript">
    $(document).ready(function(){
        $(".getsilvernumber<?php echo $longcode_number->longcode_number;?>").click(function(){
      
				var sno = this.value;
				console.log(this);
				console.log("test"+sno);
				var snos = sno.split(",");
				//return snos[1];
				var snosprice= snos[1];
				var getsilverkeyword = $(".getsilverkeyword").val();
				var getsilversubscription = $(".getsilversubscription").val();
        
            if($(this).prop("checked") == true){
				  //alert("Checkbox is checked.");
				if($('.checkboxstyle:checked').length<=3)
				{
				if(getsilversubscription!='')
				{
				$(".silversubmsg").html("");

				if(getsilverkeyword!='')
				{

				$('.service_number_msg').html("");
				$(".silverkeywordmsg").html('');

				//var snosprice= $('.append_service_num').val();

				if(snosprice!='')
				{
				$.ajax({
				type: "GET",
				data: {snosprice:snosprice,getkeyword:getsilverkeyword,getsubscription:getsilversubscription,status:'1'},
				url: "<?php echo base_url(); ?>longcode_shared/SelectedNumbers",
				success: function (callback_data) 
				{
				console.log(callback_data);
				//console.log($('#rental_plan'));
				$('.didprice').html(callback_data);
				}
				});	

				} 

				}
				else
				{
				$(".silverkeywordmsg").html("Please select no of keywords");
				$(".silverkeywordmsg").css('color','red');
				this.checked = false;
				}
				}
				else
				{
				$(".silversubmsg").html("please select subscription");
				$(".silversubmsg").css('color','red');
				this.checked = false;
				}

				}
				else
				{
				$('.service_number_msg').html("You have exceeded the maximum number of Service Number");
				$('.service_number_msg').css('color','red');
				this.checked = false;
				}  
                
                
                
                
            }
            else if($(this).prop("checked") == false){
            
                //alert("Checkbox is unchecked.");
                        if(snosprice!='')
				{
				$.ajax({
				type: "GET",
				data: {snosprice:snosprice,getkeyword:getsilverkeyword,getsubscription:getsilversubscription,status:'0'},
				url: "<?php echo base_url(); ?>longcode_shared/cancel_did_numbers",
				success: function (callback_data) 
				{
				console.log(callback_data);
				//console.log($('#rental_plan'));
				$('.didprice').html(callback_data);
				}
				});	

				} 
                
                
                
                
            }
        });
    });
</script>



<?php
$sno++;
}
?>
</ul>
</div>
</div>
</div>

<script>
$(document).ready(function(){

 $(".sharedsilversearch").on("click",function(){
            // get number list

                var getsilvernumber= $('.getsilvernumber').val();
        	    $.ajax({
        			type: "GET",
        			data: {getsilvernumber:getsilvernumber},

        			url: "<?php echo base_url(); ?>longcode_shared/searchSharedNumbers",
        			success: function (callback_data) 
        			{
        			console.log(callback_data);

        			
        			$('.getsilver_searchnos').html(callback_data);
        			}
        			});


            })
// silver search end		    
			

   
     
}); 
</script>

<!--
<script>
$(document).ready(function(){

var sno_cost=0;

//var checkboxes = $(".select_numbers li input[type='checkbox']");

var checkboxes = $(".checkboxstyle");

//console.log($(".checkboxsmsmis"));

checkboxes.on('change', function() {
	
// get uncheked check box did numbers start
console.log($(".checkboxstyle"));

checkboxes.filter('.checkboxstyle:not(:checked)').map(function(item) {
	
            var sno = this.value;

            console.log(this);
            
            console.log("test"+sno);
            
		    var snos = sno.split(",");
		   
	     var getsilverkeyword = $(".getsilverkeyword").val();
           var getsilversubscription = $(".getsilversubscription").val();

           if(getsilversubscription!='')
           {
               $(".silversubmsg").html("");
               if(getsilverkeyword!='')
               { 
		    
		    $(".silverkeywordmsg").html("");

		    if(snos[1]!='')
		    {
			$.ajax({
			type: "GET",
			data: {snosprice:snos[1]},
			url: "<?php echo base_url(); ?>longcode/cancel_did_numbers",
			success: function (callback_data) 
			{
			console.log(callback_data);
			console.log($('#rental_plan'));
			$('.didprice').html(callback_data);
			}
			});
		    }
		       
	           }
	           else
	           {
	              $(".silverkeywordmsg").html("Please select no of keywords");
	              $(".silverkeywordmsg").css('color','red');
	           }
           }
           else
           {
             $(".silversubmsg").html("please select subscription");
             $(".silversubmsg").css('color','red');
           }
		    
		    
			return snos[1];
        }).get().join(',');



// get uncheked check box did numbers end

    $('.append_service_num').val(
    
    checkboxes.filter('.checkboxstyle:checked').map(function(item) {
    
            var sno = this.value;
            console.log("test"+sno);
			var snos = sno.split(",");
			
			//sno_cost = snos[3];
			//$("#snos_cost").html(sno_cost);
			
			return snos[1];
        }).get().join(',')
     );
     
     
     
      console.log(checkboxes.filter('.checkboxstyle:checked'));
      
      if(checkboxes.filter('.checkboxstyle:checked').length<=3)
      {
           var getsilverkeyword = $(".getsilverkeyword").val();
           var getsilversubscription = $(".getsilversubscription").val();

           if(getsilversubscription!='')
           {
               $(".silversubmsg").html("");
                 
               if(getsilverkeyword!='')
               {
               
			            $('.service_number_msg').html("");
			            $(".silverkeywordmsg").html('');
					var snosprice= $('.append_service_num').val();
					if(snosprice!='')
					{
					$.ajax({
					type: "GET",
					data: {snosprice:snosprice,getkeyword:getsilverkeyword,getsubscription:getsilversubscription},
					url: "<?php echo base_url(); ?>longcode_shared/SelectedNumbers",
					success: function (callback_data) 
					{
					console.log(callback_data);
					//console.log($('#rental_plan'));
					$('.didprice').html(callback_data);
					}
					});	
			
					} 
	               
	           }
	           else
	           {
	              $(".silverkeywordmsg").html("Please select no of keywords");
	              $(".silverkeywordmsg").css('color','red');
	           }
           }
           else
           {
             $(".silversubmsg").html("please select subscription");
             $(".silversubmsg").css('color','red');
           }
		
	}
	else
	{
		 $('.service_number_msg').html("You have exceeded the maximum number of Service Number");
		 $('.service_number_msg').css('color','red');
		 $(".select_numbers li input[type='checkbox']").checked = false;
	}  
     
     
});
				      var getsilverkeyword = $(".getsilverkeyword").val();
                              var getsilversubscription = $(".getsilversubscription").val();
                              var snosprice= $('.append_service_num').val();
					if(snosprice!='')
					{
					$.ajax({
					type: "GET",
					data: {snosprice:snosprice,getkeyword:getsilverkeyword,getsubscription:getsilversubscription},
					url: "<?php echo base_url(); ?>longcode_shared/SelectedNumbers",
					success: function (callback_data) 
					{
					console.log(callback_data);
					//console.log($('#rental_plan'));
					$('.didprice').html(callback_data);

					}
					});	
			
					} 

/*
 if(checkboxes.filter('.checkboxstyle:checked').length<=3)
      {
           var getsilverkeyword = $(".getsilverkeyword").val();
           var getsilversubscription = $(".getsilversubscription").val();

           if(getsilversubscription!='')
           {
               $(".silversubmsg").html("");
                 
               if(getsilverkeyword!='')
               {
               
			            $('.service_number_msg').html("");
			            $(".silverkeywordmsg").html('');
					var snosprice= $('.append_service_num').val();
					if(snosprice!='')
					{
					$.ajax({
					type: "GET",
					data: {snosprice:snosprice,getkeyword:getsilverkeyword,getsubscription:getsilversubscription},
					url: "<?php echo base_url(); ?>longcode_shared/SelectedNumbers",
					success: function (callback_data) 
					{
					console.log(callback_data);
					//console.log($('#rental_plan'));
					$('.didprice').html(callback_data);
					}
					});	
			
					} 
	               
	           }
	           else
	           {
	              $(".silverkeywordmsg").html("Please select no of keywords");
	              $(".silverkeywordmsg").css('color','red');
	           }
           }
           else
           {
             $(".silversubmsg").html("please select subscription");
             $(".silversubmsg").css('color','red');
           }
		
	}
	else
	{
		 $('.service_number_msg').html("You have exceeded the maximum number of Service Number");
		 $('.service_number_msg').css('color','red');
		 $(".select_numbers li input[type='checkbox']").checked = false;
	} 
	
*/ 

// silver search start

        $(".sharedsilversearch").on("click",function(){
            // get number list
                var getsilvernumber= $('.getsilvernumber').val();
        	    $.ajax({
        			type: "GET",
        			data: {getsilvernumber:getsilvernumber},
        			url: "<?php echo base_url(); ?>longcode_shared/getsilvernossearch",
        			success: function (callback_data) 
        			{
        			console.log(callback_data);
        			
        			$('.getsilver_searchnos').html(callback_data);
        			}
        			});

            })
// silver search end		    
			
   
     
}); 
</script>

-->
    


		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		<div class="col-md-10 col-sm-10 col-xs-12 padding_zero">
		
		
		
		<div class="col-md-3 col-sm-3 col-xs-12 form-div padding_ltzero">
		<select class="getplatinumsubscription">
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
		<span class="platinumsubmsg"></span>
		</div>
		
		<div class="col-md-3 col-sm-3 col-xs-12 form-div padding_ltzero">
		<select class="getplatinumnoofsms">
		<option value="">Select No.of.SMS</option>
		<?php
		foreach($noofsms_packages as $key=>$noofsms_package)
		{
		?>
		<option value="<?php echo $noofsms_package->no_of_sms;?>">
		<?php echo $noofsms_package->no_of_sms;?></option>
		<?php
		}
		?>
		</select>
		<span class="platinumnoofsmsmsg"></span>
		</div>
		
		<div class="col-md-3 col-sm-3 col-xs-12 form-div padding_ltzero">
		<input type="text" class="getplatinumnumber" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Longcode Number" maxlength="15">
		</div>
		<div class="col-md-2 col-sm-2 col-xs-12 form-div padding_zero">
		<!--  
		<input type="submit" name="" class="create-btn" value="Search">
		-->
		<input type="submit" name="" class="submit_btn platinumsearch" value="Submit">
		</div>
		</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12 form-div padding_zero">
		<p class="aval-num-title">Available Numbers</p>
		<span class="service_number_msg"></span>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12 form-div avalble_numbers">
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero service_avb_div">
<div class="scroll_num scroll_numbar">
<ul class="select_numbers getplatinum_searchnos">
<?php
$sno=1;
$checked='';
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
  <input id="platinum-missd-num<?php echo $sno;?>" type="checkbox" class="checkboxsmsmis checkboxstyle 
   getplatinumnumber<?php echo $longcode_number->longcode_number;?> " name="field" 
 value="<?php echo  $longcode_number->longcode_id.','. $longcode_number->longcode_number.','. $longcode_number->longcode_type;?>"
    <?php echo $checked;?>  placeholder="">
  <label class="font_normal" for="platinum-missd-num<?php echo $sno;?>"><span><span></span></span><?php echo $longcode_number->longcode_number;?></label>
</div>
</li>


<script type="text/javascript">
    $(document).ready(function(){
        $(".getplatinumnumber<?php echo $longcode_number->longcode_number;?>").click(function(){
      
				var sno = this.value;
				console.log(this);
				console.log("test"+sno);
				var snos = sno.split(",");
				//return snos[1];
				var snosprice= snos[1];
				var getplatinumnoofsms = $(".getplatinumnoofsms").val();
				var getplatinumsubscription = $(".getplatinumsubscription").val();
        
            if($(this).prop("checked") == true){
				  //alert("Checkbox is checked.");
				if($('.checkboxstyle:checked').length<=3)
				{
				if(getplatinumsubscription!='')
				{
				$(".platinumsubmsg").html("");

				if(getplatinumnoofsms!='')
				{

				$('.service_number_msg').html("");
				$(".platinumnoofsmsmsg").html('');

				//var snosprice= $('.append_service_num').val();

				if(snosprice!='')
				{
				$.ajax({
				type: "GET",
				data: {snosprice:snosprice,getnoofsms:getplatinumnoofsms,getsubscription:getplatinumsubscription,status:'1'},
				url: "<?php echo base_url(); ?>longcode/SelectedNumbers",
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
				$(".platinumnoofsmsmsg").html("Select no of sms");
	                  $(".platinumnoofsmsmsg").css('color','red');
				this.checked = false;
				}
				}
				else
				{
				$(".platinumsubmsg").html("Select subscription");
				$(".platinumsubmsg").css('color','red');
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
				data: {snosprice:snosprice,getnoofsms:getplatinumnoofsms,getsubscription:getplatinumsubscription,status:'0'},
				url: "<?php echo base_url(); ?>longcode/cancel_did_numbers",
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
// platinum search start
        $(".platinumsearch").on("click",function(){
            // get number list
                var getplatinumnumber= $('.getplatinumnumber').val();
        	    $.ajax({
        			type: "GET",
        			data: {getplatinumnumber:getplatinumnumber},
        			url: "<?php echo base_url(); ?>longcode/getplatinumnossearch",
        			success: function (callback_data) 
        			{
        			console.log(callback_data);
        			
        			$('.getplatinum_searchnos').html(callback_data);
        			}
        			});

            })
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
		   
	     var getplatinumnoofsms = $(".getplatinumnoofsms").val();
           var getplatinumsubscription = $(".getplatinumsubscription").val();

           if(getplatinumsubscription!='')
           {
               $(".platinumsubmsg").html("");
               if(getplatinumnoofsms!='')
               { 
		    
		    $(".platinumnoofsmsmsg").html("");

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
	              $(".platinumnoofsmsmsg").html("Please select no of sms");
	              $(".platinumnoofsmsmsg").css('color','red');
	           }
           }
           else
           {
             $(".platinumsubmsg").html("please select subscription");
             $(".platinumsubmsg").css('color','red');
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
           var getplatinumnoofsms = $(".getplatinumnoofsms").val();
           var getplatinumsubscription = $(".getplatinumsubscription").val();

           if(getplatinumsubscription!='')
           {
               $(".platinumsubmsg").html("");
                 
               if(getplatinumnoofsms!='')
               {
               
			            $('.service_number_msg').html("");
			            $(".platinumnoofsmsmsg").html('');
					var snosprice= $('.append_service_num').val();
					if(snosprice!='')
					{
					$.ajax({
					type: "GET",
					data: {snosprice:snosprice,getnoofsms:getplatinumnoofsms,getsubscription:getplatinumsubscription},
					url: "<?php echo base_url(); ?>longcode/SelectedNumbers",
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
	              $(".platinumnoofsmsmsg").html("Please select no of sms");
	              $(".platinumnoofsmsmsg").css('color','red');
	           }
           }
           else
           {
             $(".platinumsubmsg").html("please select subscription");
             $(".platinumsubmsg").css('color','red');
           }
		
	}
	else
	{
		 $('.service_number_msg').html("You have exceeded the maximum number of Service Number");
		 $('.service_number_msg').css('color','red');
		 $(".select_numbers li input[type='checkbox']").checked = false;
	}  
     
     
});

 if(checkboxes.filter('.checkboxstyle:checked').length<=3)
      {
           var getplatinumnoofsms = $(".getplatinumnoofsms").val();
           var getplatinumsubscription = $(".getplatinumsubscription").val();

           if(getplatinumsubscription!='')
           {
               $(".platinumsubmsg").html("");
                 
               if(getplatinumnoofsms!='')
               {
               
			            $('.service_number_msg').html("");
			            $(".platinumnoofsmsmsg").html('');
					var snosprice= $('.append_service_num').val();
					if(snosprice!='')
					{
					$.ajax({
					type: "GET",
					data: {snosprice:snosprice,getnoofsms:getplatinumnoofsms,getsubscription:getplatinumsubscription},
					url: "<?php echo base_url(); ?>longcode/SelectedNumbers",
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
	              $(".platinumnoofsmsmsg").html("Please select no of sms");
	              $(".platinumnoofsmsmsg").css('color','red');
	           }
           }
           else
           {
             $(".platinumsubmsg").html("please select subscription");
             $(".platinumsubmsg").css('color','red');
           }
		
	}
	else
	{
		 $('.service_number_msg').html("You have exceeded the maximum number of Service Number");
		 $('.service_number_msg').css('color','red');
		 $(".select_numbers li input[type='checkbox']").checked = false;
	}  

// platinum search start

        $(".platinumsearch").on("click",function(){
            // get number list
                var getplatinumnumber= $('.getplatinumnumber').val();
        	    $.ajax({
        			type: "GET",
        			data: {getplatinumnumber:getplatinumnumber},
        			url: "<?php echo base_url(); ?>longcode/getplatinumnossearch",
        			success: function (callback_data) 
        			{
        			console.log(callback_data);
        			
        			$('.getplatinum_searchnos').html(callback_data);
        			}
        			});

            })
// platinum search end		    
			
   
     
}); 
</script>

-->
    

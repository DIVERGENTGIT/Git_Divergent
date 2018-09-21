
		<div class="col-md-12 col-sm-12 col-xs-12 padding_zero">
		<div class="col-md-10 col-sm-10 col-xs-12 padding_zero">
		<div class="col-md-3 col-sm-3 col-xs-12 form-div padding_ltzero">
		<select class="getsharedsubscription">
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
		<span class="sharedsubmsg"></span>
		</div>
		
		<div class="col-md-3 col-sm-3 col-xs-12 form-div padding_ltzero">
		
		<!--
		<select class="getsharedkeyword">
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
		<select class="getsharednoofsms">
		<input type="text" class="getsharedkeyword" placeholder="Enter Keyword">
		-->
		<input type="text" class="getsharedkeyword" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" placeholder="Enter No of Keywords" maxlength="15">
		<span class="sharedkeywordmsg"></span>
		</div>
		
		<div class="col-md-3 col-sm-3 form-div padding_ltzero col-xs-12">
		<input type="text" class="getsharednumber" placeholder="Longcode Number" maxlength="15">
		</div>
		<div class="col-md-2 col-sm-2 col-xs-12 form-div padding_zero">
		<!--  
		<input type="submit" name="" class="create-btn" value="Search">
		-->
		<input type="submit" name="" class="submit_btn sharedsharedsearch" value="Submit">
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
<ul class="select_numbers getshared_searchnos">
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
  <input id="shared-missd-num<?php echo $sno;?>" type="checkbox" class="checkboxsmsmis checkboxstyle
   getsharednumber<?php echo $longcode_number->longcode_number;?>" name="field" 
 value="<?php echo  $longcode_number->longcode_id.','. $longcode_number->longcode_number.','. $longcode_number->longcode_type;?>"
    <?php echo $checked;?>  placeholder="">
  <label class="font_normal" for="shared-missd-num<?php echo $sno;?>"><span><span></span></span><?php echo $longcode_number->longcode_number;?></label>
</div>
</li>

<script type="text/javascript">
    $(document).ready(function(){
        $(".getsharednumber<?php echo $longcode_number->longcode_number;?>").click(function(){
      
				var sno = this.value;
				console.log(this);
				console.log("test"+sno);
				var snos = sno.split(",");
				//return snos[1];
				var snosprice= snos[1];
				var getsharedkeyword = $(".getsharedkeyword").val();
				var getsharedsubscription = $(".getsharedsubscription").val();
        
            if($(this).prop("checked") == true){
				  //alert("Checkbox is checked.");
				if($('.checkboxstyle:checked').length<=3)
				{
				if(getsharedsubscription!='')
				{
				$(".sharedsubmsg").html("");

				if(getsharedkeyword!='')
				{

				$('.service_number_msg').html("");
				$(".sharedkeywordmsg").html('');

				//var snosprice= $('.append_service_num').val();

				if(snosprice!='')
				{
				$.ajax({
				type: "GET",
				data: {snosprice:snosprice,getkeyword:getsharedkeyword,getsubscription:getsharedsubscription,status:'1'},
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
				$(".sharedkeywordmsg").html("Please enter no of keywords");
				$(".sharedkeywordmsg").css('color','red');
				this.checked = false;
				}
				}
				else
				{
				$(".sharedsubmsg").html("please select subscription");
				$(".sharedsubmsg").css('color','red');
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
				data: {snosprice:snosprice,getkeyword:getsharedkeyword,getsubscription:getsharedsubscription,status:'0'},
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

 $(".sharedsharedsearch").on("click",function(){
            // get number list

                var getsharednumber= $('.getsharednumber').val();
        	    $.ajax({
        			type: "GET",
        			data: {getsharednumber:getsharednumber},

        			url: "<?php echo base_url(); ?>longcode_shared/searchSharedNumbers",
        			success: function (callback_data) 
        			{
        			console.log(callback_data);

        			
        			$('.getshared_searchnos').html(callback_data);
        			}
        			});


            })
// shared search end		    
			

   
     
}); 
</script>

<script>
$(document).ready(function() {  
    $(".getsharednumber,.getsharedkeyword").keydown(function (e) {
	if ((this.value.length == 0 && e.which == 48 ) || (this.value.length == 0 && e.which == 96 )){
    	              return false;
  	}
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 || (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||   (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
             return false;
        }
    });
}); 
</script>

    

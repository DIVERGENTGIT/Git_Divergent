<?php
//echo $getsilvernumber;
if(count($longcode_numbers)>0)
{
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
  <?php if($longcode_number->longcode_number==$getsilvernumber){ echo "checked"; }?>
   <?php echo $checked;?> placeholder="">
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
}
else 
{
echo "Service Numbers are not available with this criteria!.";
}
?>

<script>
$(document).ready(function(){

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

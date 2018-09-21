
$(document).ready(function(){

	$(".sms-type-slectbox .selectpicker").change(function(){
        $(this).find("option:selected").each(function(){
            if($(this).attr("class")=="sms-smstype"){
               
               
				$(".sms-type-slectbox .tooltip.bottom").hide();
				

            }

            else{
                 $(".sms-type-slectbox .tooltip.bottom").show();
            }
        });
    }).change();

	$(".subcription-slectbox .selectpicker").change(function(){
        $(this).find("option:selected").each(function(){
            if($(this).attr("class")=="sms-subscritype"){
               
               
				$(".subcription-slectbox .tooltip.bottom").hide();
				

            }

            else{
                 $(".subcription-slectbox .tooltip.bottom").show();
            }
        });
    }).change();
	
	$(".longcode-type-slectbox .selectpicker").change(function(){
        $(this).find("option:selected").each(function(){
            if($(this).attr("class")=="longcode-type-option"){
               
               
				$(".longcode-type-slectbox .tooltip.bottom").hide();
				

            }

            else{
                 $(".longcode-type-slectbox .tooltip.bottom").show();
            }
        });
    }).change();
	
	$(".longcode-replay-select .selectpicker").change(function(){
        $(this).find("option:selected").each(function(){
            if($(this).attr("class")=="longcode-replay-option"){
               
               
				$(".longcode-replay-select .tooltip.bottom").hide();
				

            }

            else{
                 $(".longcode-replay-select .tooltip.bottom").show();
            }
        });
    }).change();
	
	$(".longcode-subscrip-select .selectpicker").change(function(){
        $(this).find("option:selected").each(function(){
            if($(this).attr("class")=="longcode-subscrip-option"){
               
               
				$(".longcode-subscrip-select .tooltip.bottom").hide();
				

            }

            else{
                 $(".longcode-subscrip-select .tooltip.bottom").show();
            }
        });
    }).change();
	
	$(".shorturl-reply-select .selectpicker").change(function(){
        $(this).find("option:selected").each(function(){
            if($(this).attr("class")=="shorturl-replay-option"){
               
               
				$(".shorturl-reply-select .tooltip.bottom").hide();
				

            }

            else{
                 $(".shorturl-reply-select .tooltip.bottom").show();
            }
        });
    }).change();
	
	$(".shorturl-subscript-select .selectpicker").change(function(){
        $(this).find("option:selected").each(function(){
            if($(this).attr("class")=="shorturl-replay-option"){
               
               
				$(".shorturl-subscript-select .tooltip.bottom").hide();
				

            }

            else{
                 $(".shorturl-subscript-select .tooltip.bottom").show();
            }
        });
    }).change();
	
});

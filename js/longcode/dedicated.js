$(document).ready(function() {
	 $(".silvertab_numbers").on("click",function() {
		 
	       $.ajax({
                method:"GET",
                url:base_url+"getsilvernos",
                success:function(data){
                    $(".displaysilvertab").html(data);
                    },
		       });
    });
	


});
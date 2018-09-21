<script>
$(document).ready(function() {

	// get silver numbers
	        $.ajax({
	                method:"GET",
	                url:"<?php echo base_url()?>longcode/getsilvernos",
	                success:function(data){
	                    $(".displaysilvertab").html(data);
	                    },
	       });
			 $(".silvertab_numbers").on("click",function() {
			 
			       $.ajax({
			                method:"GET",
			                url:"<?php echo base_url()?>longcode/getsilvernos",
			                success:function(data){
			                    $(".displaysilvertab").html(data);
			                    },
			       });
			    });

	// get silver numbers
	        $.ajax({
                method:"GET",
                url:"<?php echo base_url()?>longcode/getgoldnos",
                success:function(data){
                    $(".displaygoldtab").html(data);
                    },
		       });
	 $(".goldtab_numbers").on("click",function() {
		 
	       $.ajax({
                method:"GET",
                url:"<?php echo base_url()?>longcode/getgoldnos",
                success:function(data){
                    $(".displaygoldtab").html(data);
                    },
		       });
    });

	// get silver numbers
	 $.ajax({
                method:"GET",
                url:"<?php echo base_url()?>longcode/getplatinumnos",
                success:function(data){
                    $(".displayplatinumtab").html(data);
                    },
		       });
     
	 $(".platinumtab_numbers").on("click",function() {
		 
	       $.ajax({
                method:"GET",
                url:"<?php echo base_url()?>longcode/getplatinumnos",
                success:function(data){
                    $(".displayplatinumtab").html(data);
                    },
		       });
    });

	 $(".addkeywords").on("click",function() {
		 
		$.ajax({
		method:"GET",
		url:"<?php echo base_url()?>longcode/keywords",
		success:function(data){
		$(".displaykeywords").html(data);
		},
		});
		
		
    });
    
        // get keywords
            $.ajax({
		method:"GET",
		url:"<?php echo base_url()?>longcode/getkewords",
		success:function(data){
		$(".getkeywords").html(data);
		},
		}); 

});
</script>

  






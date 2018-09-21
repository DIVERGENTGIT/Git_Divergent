<script>
$(document).ready(function() {

		// get silver numbers
		$.ajax({
		method:"GET",
		url:"<?php echo base_url()?>longcode_shared/getSharedNumbers",
		success:function(data){
		$(".displaysharednos").html(data);
		},
		});

	 $(".addkeywords").on("click",function() {
		 
		$.ajax({
		method:"GET",
		url:"<?php echo base_url()?>longcode_shared/keywords",
		success:function(data){
		$(".displaykeywords").html(data);
		},
		});
		
		
    });
    
        // get keywords
            $.ajax({
		method:"GET",
		url:"<?php echo base_url()?>longcode_shared/getkewords",
		success:function(data){
		$(".getkeywords").html(data);
		},
		}); 

        // getkeywordnumbers
        
            $(".getkeywordnumbers").on("click",function() {
       		 
        		$.ajax({
        		method:"GET",
        		url:"<?php echo base_url()?>longcode_shared/getkeywordnossearch",
        		success:function(data){
        		$(".displaykeywordnumbers").html(data);
        		},
        		});
        		
        		
            });

            

            

});
</script>

  






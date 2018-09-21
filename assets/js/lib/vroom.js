// Calculator for converting Miles to Kilometers



$(document).ready(function() {
TweenLite.to(needle, 2, {rotation:-31,  transformOrigin:"bottom right"});

	// convert miles to kilometers
	$('#miles').val(function() {
		var mi = $(this).val();
		var	miNum = parseInt(mi) * 1;
		//make sure kmNum is a number then output
		if ( (mi <= 75) && !isNaN(miNum) ){
            var speedMi = miNum * 2 - 31;	
            $('#numbers').css('text-align', 'center');  
            $('#kilometers').val(miNum.toFixed(2));	
            $('#numbers').html(miNum.toFixed(0)); 
            $('#mi-km').html('Kilometers');
	   } else if (!isNaN(miNum)){ 
	   		var speedMi = 215;
	   		$('#numbers').css('text-align', 'right');
	   		$('#kilometers').val(miNum.toFixed(2));	
            $('#numbers').html(miNum.toFixed(0)); 
            $('#mi-km').html('Kilometers');  	
	   } else { 
	   		$('#miles').val('');
	   		$('#kilometers').val('');
	   		$('#numbers').html('');	
	   		$("#errmsg").html("Numbers Only").show().fadeOut(1600);
	   }
	
		var needle = $("#needle");    
		TweenLite.to(needle, 2, {rotation:speedMi,  transformOrigin:"bottom right"});
	});


	
});
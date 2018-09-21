$(function () {
  $("#options_div_1, #options_delete_0, #options_div_2, #options_div_3, #options_div_4, #options_div_4, #options_div_4, #options_div_5, #options_div_6, #options_div_7, #options_div_8, #options_div_9, #options_div_10, #options_add_1, #options_add_2, #options_add_3, #options_add_4, #options_add_5, #options_add_6, #options_add_7, #options_add_8, #options_add_9, #options_add_10").hide(); 

	
$("#options_add_0").click(function(){
	$("#options_div_1").show(); 
	$("#options_add_1").show();
	$("#options_div_1").disabled=false; 
$("#options_add_0, #options_add_2, #options_delete_0, #options_add_3, #options_add_4, #options_add_5, #options_add_5, #options_add_6, #options_add_6, #options_add_7, #options_add_8, #options_add_9, #options_add_10").hide();
$("#options_add_0, #options_add_2, #options_delete_0, #options_add_3, #options_add_4, #options_add_5, #options_add_5, #options_add_6, #options_add_6, #options_add_7, #options_add_8, #options_add_9, #options_add_10").disabled=true;
	
});	

$("#options_add_1").click(function(){
	$("#options_div_2").show(); 
	$("#options_div_2").disabled=false; 
	$("#options_add_2").show(); 
$("#options_add_0, #options_add_1, #options_delete_1, #options_add_3, #options_add_4, #options_add_5, #options_add_6, #options_add_7, #options_add_8, #options_add_9, #options_add_10").hide();
$("#options_add_0, #options_add_1, #options_delete_1, #options_add_3, #options_add_4, #options_add_5, #options_add_6, #options_add_7, #options_add_8, #options_add_9, #options_add_10").disabled=true;
	
	
});	
$("#options_add_2").click(function(){
	$("#options_div_3").show(); 
	$("#options_add_3").show();
$("#options_add_0, #options_add_2, #options_delete_2, #options_add_1, #options_add_4, #options_add_5, #options_add_6, #options_add_7, #options_add_8, #options_add_9, #options_add_10").hide();	
	
	
});	
$("#options_add_3").click(function(){
	$("#options_div_4").show(); 
	$("#options_add_4").show(); 
$("#options_add_0, #options_add_2, #options_delete_3, #options_add_3, #options_add_1, #options_add_5, #options_add_6, #options_add_7, #options_add_8, #options_add_9, #options_add_10").hide();
	
	
});	
$("#options_add_4").click(function(){
	$("#options_div_5").show(); 
	$("#options_add_5").show(); 
	
$("#options_add_0, #options_add_2, #options_delete_4, #options_add_3, #options_add_4, #options_add_1, #options_add_6, #options_add_7, #options_add_8, #options_add_9, #options_add_10").hide();
	
	
});	
$("#options_add_5").click(function(){
	$("#options_div_6").show(); 
	$("#options_add_6").show(); 
	
$("#options_add_0, #options_add_1, #options_add_2, #options_delete_5, #options_add_3, #options_add_4, #options_add_5, #options_add_7, #options_add_8, #options_add_9, #options_add_10").hide();
	
	
});	
$("#options_add_6").click(function(){
	$("#options_div_7").show(); 
	$("#options_add_7").show(); 
	
	$("#options_add_0, #options_add_2, #options_add_3, #options_delete_6, #options_add_4, #options_add_5, #options_add_1, #options_add_6, #options_add_8, #options_add_9, #options_add_10").hide();
	
	
});	
$("#options_add_7").click(function(){
	$("#options_div_8").show(); 
	$("#options_add_8").show(); 
	
$("#options_add_0, #options_add_1, #options_add_2, #options_add_3, #options_delete_7, #options_add_4, #options_add_5, #options_add_6, #options_add_7, #options_add_9, #options_add_10").hide();
	
	
});	
$("#options_add_8").click(function(){
	$("#options_div_9").show(); 
	$("#options_add_9").show(); 
$("#options_add_0, #options_add_2, #options_add_3, #options_add_4, #options_delete_8, #options_add_5, #options_add_6, #options_add_7, #options_add_8, #options_add_1, #options_add_10").hide();
});	
$("#options_add_9").click(function(){
	$("#options_div_10").show(); 
	
	
$("#options_add_0, #options_add_2, #options_add_3, #options_add_4, #options_delete_9, #options_add_5, #options_add_6, #options_add_7, #options_add_8, #options_add_9, #options_add_1, #options_add_10").hide();
	
	
});	

$("#options_delete_10").click(function(){
	$("#options_div_10, #options_add_10").hide(); 
$("#options_add_9, #options_delete_9").show(); 
});	

$("#options_delete_9").click(function(){
	$("#options_div_9, #options_add_9").hide(); 
$("#options_add_8, #options_delete_8").show(); 
});	

$("#options_delete_8").click(function(){
	$("#options_div_8, #options_add_8").hide(); 
$("#options_add_7, #options_delete_7").show(); 
});	

$("#options_delete_7").click(function(){
	$("#options_div_7, #options_add_7").hide(); 
$("#options_add_6, #options_delete_6").show(); 
});	

$("#options_delete_6").click(function(){
	$("#options_div_6, #options_add_6").hide(); 
$("#options_add_5, #options_delete_5").show(); 
});	 

$("#options_delete_5").click(function(){
	$("#options_div_5, #options_add_5").hide(); 
$("#options_add_4, #options_delete_4").show(); 
});

$("#options_delete_4").click(function(){
	$("#options_div_4, #options_add_4").hide(); 
$("#options_add_3, #options_delete_3").show(); 
});
$("#options_delete_3").click(function(){
	$("#options_div_3, #options_add_3").hide(); 
$("#options_add_2, #options_delete_2").show(); 
});
$("#options_delete_2").click(function(){
	$("#options_div_2, #options_add_2").hide(); 
$("#options_add_1, #options_delete_1").show(); 
});
$("#options_delete_1").click(function(){
	$("#options_div_1, #options_add_1, #options_delete_0").hide(); 
$("#options_add_0").show(); 
});
});

$(function () {
  $(".selectworkingdays_1, .selectworkingdays_2, .selectworkingdays_3, .selectworkingdays_4, .selectworkingdays_5, .selectworkingdays_6").hide(); 

	
$(".addworkingdaysmbt_0").click(function(){
	$(".selectworkingdays_1, .delete_workdays1, .addworkingdaysmbt_1").show(); 
$(".addworkingdaysmbt_0").hide();
});	

$(".addworkingdaysmbt_1").click(function(){
$(".selectworkingdays_2, .delete_workdays2, .addworkingdaysmbt_2").show(); 
$(".addworkingdaysmbt_1, .delete_workdays1").hide();
});	

$(".addworkingdaysmbt_2").click(function(){
$(".selectworkingdays_3, .delete_workdays3, .addworkingdaysmbt_3").show(); 
$(".addworkingdaysmbt_2, .delete_workdays1, .delete_workdays2").hide();
});	

$(".addworkingdaysmbt_3").click(function(){
$(".selectworkingdays_4, .delete_workdays4, .addworkingdaysmbt_4").show(); 
$(".addworkingdaysmbt_3, .delete_workdays1, .delete_workdays2, .delete_workdays3").hide();
});	

$(".addworkingdaysmbt_4").click(function(){
$(".selectworkingdays_5, .delete_workdays5, .addworkingdaysmbt_5").show(); 
$(".addworkingdaysmbt_4, .delete_workdays1, .delete_workdays2, .delete_workdays3, .delete_workdays4").hide();
});

$(".addworkingdaysmbt_5").click(function(){
$(".selectworkingdays_6, .delete_workdays6, .addworkingdaysmbt_6").show(); 
$(".addworkingdaysmbt_5, .delete_workdays1, .delete_workdays2, .delete_workdays3, .delete_workdays4, .delete_workdays5").hide();
});

$(".delete_workdays6").click(function(){
$(".addworkingdaysmbt_5, .delete_workdays5").show(); 
$(".selectworkingdays_6, .addworkingdaysmbt_6").hide();
});
$(".delete_workdays5").click(function(){
$(".addworkingdaysmbt_4, .delete_workdays4").show(); 
$(".selectworkingdays_5, .addworkingdaysmbt_5").hide();
});
$(".delete_workdays4").click(function(){
$(".addworkingdaysmbt_3, .delete_workdays3").show(); 
$(".selectworkingdays_4, .addworkingdaysmbt_4").hide();
});
$(".delete_workdays3").click(function(){
$(".addworkingdaysmbt_2, .delete_workdays2").show(); 
$(".selectworkingdays_3, .addworkingdaysmbt_3").hide();
});
$(".delete_workdays2").click(function(){
$(".addworkingdaysmbt_1, .delete_workdays1").show(); 
$(".selectworkingdays_2, .addworkingdaysmbt_2").hide();
});
$(".delete_workdays1").click(function(){
$(".addworkingdaysmbt_0").show(); 
$(".selectworkingdays_1, .addworkingdaysmbt_1").hide();
});

});

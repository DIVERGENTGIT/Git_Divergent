$(function () {

$(".service_adddup_1").click(function(){
$(".service_adddup_2, .servicenumberadd_2").show();
$(".service_adddup_1, .service_deldup_1").hide();
});

$(".service_adddup_2").click(function(){
$(".service_adddup_3, .servicenumberadd_3").show();
$(".service_adddup_2, .service_deldup_1, .service_deldup_2").hide();
});

$(".service_adddup_3").click(function(){
$(".service_adddup_4, .servicenumberadd_4").show();
$(".service_adddup_3, .service_deldup_1, .service_deldup_2, .service_deldup_3").hide();
});

$(".service_adddup_4").click(function(){
$(".servicenumberadd_5").show();
$(".service_adddup_4, .service_deldup_1, .service_deldup_2, .service_deldup_3, .service_deldup_4").hide();
});

$(".service_deldup_5").click(function(){
$(".servicenumberadd_5").hide();
$(".service_adddup_4, .service_deldup_4").show();
});

$(".service_deldup_4").click(function(){
$(".servicenumberadd_4").hide();
$(".service_adddup_3, .service_deldup_3").show();
});

$(".service_deldup_3").click(function(){
$(".servicenumberadd_3").hide();
$(".service_adddup_2, .service_deldup_2").show();
});

$(".service_deldup_2").click(function(){
$(".servicenumberadd_2").hide();
$(".service_adddup_1").show();
});
});

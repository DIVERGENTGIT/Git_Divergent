$(window).load(function () {
$(".missedcall-menu").click(function(){

	$(".missedcall-inner-nav").slideToggle(250);
	$(".missedcall-menu, .tollfree_menu_list, .dialler_menu_list, .profile_menu_list, .payment_menu_list").hide();
});

$(".missedcall_menu_list").each(function( index ) {
  	$( this ).css({'animation-delay': (index/10)+'s'});
  });
$(".missedcall-inner-nav a").each(function( index ) {
  	$( this ).css({'animation-delay': (index/10)+'s'});
  });
  
  $(".tollfree-menu").click(function(){

	$(".tollfree-inner-nav").slideToggle(250);
	$(".tollfree-menu, .missedcall_menu_list, .dialler_menu_list, .profile_menu_list, .payment_menu_list").hide();
});
$(".tollfree-inner-nav a").each(function( index ) {
  	$( this ).css({'animation-delay': (index/10)+'s'});
  });
  
  
  $(".dialler-menu").click(function(){

	$(".dialler-inner-nav").slideToggle(250);
	$(".dialler-menu, .missedcall_menu_list, .tollfree_menu_list, .profile_menu_list, .payment_menu_list").hide();
});
$(".dialler-inner-nav a").each(function( index ) {
  	$( this ).css({'animation-delay': (index/10)+'s'});
  });
});







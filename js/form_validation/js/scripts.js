$(document).ready(function() {
	
	setGoTop();
	toggleGoTop();
	buildContents();
	

	//#4
	var opt4 = {
		foreColor:'#e25a48',
		 foreColor:'#3eabc0'
		//horLabelPos:'topRight'
	}
	$('#test4').barIndicator(opt4);
	
	//#3
	var opt3 = {
		foreColor:'#e25a48',
		 foreColor:'#3eabc0'
	}
	$('#test3').barIndicator(opt3);
	
	//#2
	var opt2 = {
		foreColor:'#e25a48',
		 foreColor:'#3eabc0'
	}
	$('#test2').barIndicator(opt2);
	
	//#1
	var opt1 = {
		foreColor:'#e25a48',
		 foreColor:'#3eabc0'
	}
	$('#test1').barIndicator(opt1);
	
	

});

var buildContents = function() {
	var optHolder = $('#cont-options');
	var methodHolder = $('#cont-methods');
	var eventHolder = $('#cont-events');
	
	$('.secOpt').each(function() {
		var that = $(this);
		var id = that.attr('id');
		var txt = that.attr('data-content');
		optHolder.append('<a class="contAnchor" href="#' + id + '">' + txt + '</a>');
	});
	$('.secMethods').each(function() {
		var that = $(this);
		var id = that.attr('id');
		var txt = that.attr('data-content');
		methodHolder.append('<a class="contAnchor" href="#' + id + '">' + txt + '</a>');
	});
	$('.secEvents').each(function() {
		var that = $(this);
		var id = that.attr('id');
		var txt = that.attr('data-content');
		eventHolder.append('<a class="contAnchor" href="#' + id + '">' + txt + '</a>');
	});
}

var setGoTop = function() {
	var gt = $('#goTop');
	var w = $(window).width();
	var mw = $('#main-wrapper').outerWidth();
	var gtw = gt.outerWidth();
	var r = ((parseFloat(w) - parseFloat(mw)) / 2) - parseFloat(gtw) - 5;
	gt.css({'right': r + 'px'});
}
var toggleGoTop = function() {
	var gt = $('#goTop');
	var t = $(window).scrollTop();
	if (t > 200) {
		gt.show();
	} else {
		gt.hide();
	}
}





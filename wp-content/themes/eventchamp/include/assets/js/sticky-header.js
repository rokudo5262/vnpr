(function($){
	'use strict';
	
	$(window).scroll(function(){
		if ($(window).scrollTop() >= 350) {
			$('.gt-sticky-header').addClass('gt-active');
		} else {
			$('.gt-sticky-header').removeClass('gt-active');
		}
	});

} )( jQuery );
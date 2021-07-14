(function ( $ ) {
	"use strict";
	
 //Menu opening
    $(function () {
		jQuery('#toggle').on('click', function() {
			$("ul.pcmenu > li").fadeIn(0);
			$("#hide").fadeIn(0);
			$("#toggle").hide(0);

		});//one click function
		jQuery('#hide').on('click', function() {
			$("ul.pcmenu > li").fadeOut(0);
			$("#toggle").fadeIn(0);
			$("#hide").hide(0);

		});//one click function
		});//function
  
}(jQuery));
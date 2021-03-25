// anchor link for button "Dang ky ngay " on single-event page
jQuery( function($){
	$(document).ready(function() {
		$(".single-event .gt-event-buttons").click(function(e) {
		    var elementScrolledTo = $("[ data-gt-type='tickets']");
		    $('html, body').animate({
                scrollTop: elementScrolledTo.offset().top
            }, 1500);
		});
	});
});

jQuery( function($){
	$(document).ready(function() {
		$('a.event-about-link').click(function(e) {
		    var elementScrolledTo = $($(this).attr('href'));
		    e.preventDefault();
			$('html, body').animate({
				scrollTop: elementScrolledTo.offset().top
			},1000);
		});
	});
});


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

// jQuery(function($){
// 	$(document).ready(function(){
// 		$('#setting-congdong').css('cssText', 'margin: 30px 5% 0 !important');
// 		$('#setting-congdong .wpb_single_image.wpb_content_element img').css('cssText', 'margin-top: 5% !important');
		
// 		var strTemp = $('#asetting-congdong .gt-text').html();
// 		console.log(strTemp);
// 		var heightCongDong1 = $('#setting-congdong .wpb_single_image.wpb_content_element img').height();
// 		var heightCongDonginner1 = $('#setting-congdong .wpb_column.vc_column_container:nth-child(1) .vc_column-inner').height();

// 		var heightCongDong2 = null;
// 		var heightCongDonginner2= null;
// 		var result = null;
// 		$(window).bind('load resize', function(){
// 			heightCongDong2 = $('#setting-congdong .wpb_single_image.wpb_content_element img').height();
// 			heightCongDonginner2 = $('#setting-congdong .wpb_column.vc_column_container:nth-child(1) .vc_column-inner').height();
// 			var win = $(this);
// 			if(win.width() > 1024){
// 				$('#setting-congdong .gt-text').css('cssText', 'margin-top: 0px !important');
// 				if(heightCongDonginner2 >= heightCongDong2){
// 					result = strTemp.split('.');
// 					$('#setting-congdong .gt-text').text(result[0].concat(' ...'));
// 				}else{
// 					$('#setting-congdong .gt-text').text(strTemp);
// 				}
// 			}else if (win.width() <= 1024 && win.width() > 410) {
// 				$('#setting-congdong .gt-text').css('cssText', 'margin-top: 0px !important');
// 				$('#setting-congdong .wpb_single_image.wpb_content_element img').css('cssText', 'margin-top: 0 !important');
// 				result = strTemp.split('.');
// 				$('#setting-congdong .gt-text').text(result[0].concat(' ...'));
// 			}else if(win.width() <= 410 && win.width() >375){
// 				$('#setting-congdong .gt-text').css('cssText', 'margin-top: 10% !important');
// 				$('#setting-congdong .wpb_single_image.wpb_content_element img').css('cssText', 'margin-top: 20% !important');
// 				if(heightCongDonginner2 >= heightCongDong2){
// 					result = strTemp.split('.');
// 					$('#setting-congdong .gt-text').text(result[0].concat(' ...'));
// 				}else{
// 					$('#setting-congdong .gt-text').text(strTemp);
// 				}
// 			}else if(win.width() <= 375 && win.width() > 320){
// 				$('#setting-congdong .gt-text').css('cssText', 'margin-top: 30% !important');
// 				$('#setting-congdong .wpb_single_image.wpb_content_element img').css('cssText', 'margin-top: 30% !important');
// 				if(heightCongDonginner2 >= heightCongDong2){
// 					result = strTemp.split('.');
// 					$('#setting-congdong .gt-text').text(result[0].concat(' ...'));
// 				}else{
// 					$('#setting-congdong .gt-text').text(strTemp);
// 				}
// 			}else{
// 				$('#setting-congdong .gt-text').css('cssText', 'margin-top: 55% !important');
// 				$('#setting-congdong .wpb_single_image.wpb_content_element img').css('cssText', 'margin-top: 55% !important');
// 				if(heightCongDonginner2 >= heightCongDong2){
// 					result = strTemp.split('.');
// 					$('#setting-congdong .gt-text').text(result[0].concat(' ...'));
// 				}else{
// 					$('#setting-congdong .gt-text').text(strTemp);
// 				}
// 			}
// 			$('#setting-congdong .wpb_column.vc_column_container:nth-child(1)').css({'height' : heightCongDong2 , 'display': 'flex', 'align-items': 'center'});
// 		});
// 	});
// });

jQuery(function($) {
    var owl = $('.owl-carousel.owl-same');
    owl.owlCarousel({
        items:4,
        loop:true,
        margin:0,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        nav:true,
        responsive:{
            320:{
                items:1,
                nav:true
            },375:{
                items:1,
                nav:true
            },390:{
                items:1,
                nav:true
            },
            414:{
                items:1,
                nav:true
            },
            428:{
                items:1,
                nav:true
            },
            728:{
                items:2,
                nav:true
            },
            1024:{
                items:3,
                nav:true,  
            },1366:{
                items:4,
                nav:true,
            }
        }
    });

    $('.play').on('click',function(){
        owl.trigger('play.owl.autoplay',[5000])
    })
    $('.stop').on('click',function(){
        owl.trigger('stop.owl.autoplay')
    })
});

jQuery(function($) {
    var owl = $('.owl-carousel.RA-bgk-carousel');
    owl.owlCarousel({
        items:3,
        loop:true,
        margin:0,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        nav:true,
        responsive:{
            320:{
                items:1,
                nav:true
            },375:{
                items:1,
                nav:true
            },390:{
                items:1,
                nav:true
            },
            414:{
                items:1,
                nav:true
            },
            428:{
                items:1,
                nav:true
            },
            728:{
                items:2,
                nav:true
            },
            1024:{
                items:3,
                nav:true,  
            },1366:{
                items:3,
                nav:true,
            }
        }
    });

    $('.play').on('click',function(){
        owl.trigger('play.owl.autoplay',[5000])
    })
    $('.stop').on('click',function(){
        owl.trigger('stop.owl.autoplay')
    })
});
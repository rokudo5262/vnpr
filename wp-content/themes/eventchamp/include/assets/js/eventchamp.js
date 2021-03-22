(function($){
	'use strict';



	// === Loader ==================================== //

	function gt_loader() {

		setTimeout(function(){
			$('body').addClass('loaded');
		}, 2000);

	}
	gt_loader();



	// === Lazy ==================================== //
	function gt_lazy() {

		if ($.isFunction(window.LazyLoad)) {
			var lazyLoadInstance = new LazyLoad({
				elements_selector: ".gt-lazy-load",
			});
		}

	}
	gt_lazy();



	// === Get URL Vars ==================================== //

	function gt_get_url_vars() {

		var vars = {};
		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		vars[key] = value;
		});
		return vars;

	}



	// === Go to Scroll ==================================== //

	function gt_go_to_scroll() {

		$(function () {
			$('.go-top-icon').on("click", function () {
				$('body,html').animate({
					scrollTop: 0
				}, 800);
				return false;
			});
		});

	}
	gt_go_to_scroll();



	// === Go to Tickets ==================================== //

	function gt_go_to_tickets() {

		if( gt_get_url_vars()["section"] == "tickets" ) {

			$(function() {
				var target = $('.gt-event-section-tabs, .gt-event-sections .gt-section[data-gt-type="tickets"]');
				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
				}
			});

			$('.gt-event-section-tabs .gt-event-tabs > li > a[data-gt-type="tickets"]').tab('show');

		}

	}
	gt_go_to_tickets();



	// === Go to Contact Form ==================================== //

	function gt_go_to_contact_form() {

		$(function () {
			$('.gt-contact-button a[href*="#"]:not([href="#"])').on("click", function () {

				$(function() {
					var target = $('.gt-event-section-tabs, .gt-event-sections .gt-section[data-gt-type="contact-form"]');
					if (target.length) {
						$('html,body').animate({
							scrollTop: target.offset().top
						}, 1000);
						return false;
					}
				});

				$('.gt-event-section-tabs .gt-event-tabs > li > a[data-gt-type="contact-form"]').tab('show');

			});
		});

	}
	gt_go_to_contact_form();



	// === Select ==================================== //

	function gt_select() {

		$(document).ready(function() {
			$('.gt-select').selectpicker();
		});

	}
	gt_select();



	// === Bootstrap Tab Fix ==================================== //

	function gt_bootstrap_tab_fix() {

		var tab = $('.gt-tab-panel');

		tab.each(function() {

			var this_ = $(this),
				tab_id = this_.find('ul li'),
				tab_item = this_.find('.tab-pane');

			tab_id.on('click', function() {

				var current = $(this),
					index = current.index();

				tab_id.removeClass('active');
				current.addClass('active');
				tab_item.removeClass('active show');
				tab_item.filter(':nth-child('+(index+1)+')').addClass('active show');

			});

		});

	}
	gt_bootstrap_tab_fix();



	// === Range Slider ==================================== //

	function gt_range_slider() {

		$('.gt-range-slider').each( function() {
			var RangeSliderDatas = $(this),
				var_grid = $(this).data('gt-grid'),
				var_min = $(this).data('gt-min'),
				var_max = $(this).data('gt-max'),
				var_from = $(this).data('gt-from'),
				var_to = $(this).data('gt-to'),
				var_step = $(this).data('gt-step'),
				var_hide_min_max = $(this).data('gt-hide-min-max'),
				var_hide_from_to = $(this).data('gt-hide-from-to'),
				var_postfix = $(this).data('gt-postfix'),
				var_prefix = $(this).data('gt-prefix');

			$(this).ionRangeSlider({
				type: "double",
				grid: var_grid,
				min: var_min,
				max: var_max,
				from: var_from,
				to: var_to,
				step: var_step,
				hide_min_max: var_hide_min_max,
				hide_from_to: var_hide_from_to,
				postfix: var_postfix,
				prefix: var_prefix,
			}, RangeSliderDatas);
		});

	}
	gt_range_slider();



	// === Scroll Buttons ==================================== //

	function gt_scroll_buttons() {

		$(function() {
			$('.gt-countdown-slider a, .header a[href*="#"]:not([href="#"])').click(function() {
				if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
						if (target.length) {
						$('html, body').animate({
							scrollTop: target.offset().top
						}, 1000);
						return false;
					}
				}
			});
		});

	}
	gt_scroll_buttons();



	// === Tooltip ==================================== //

	function gt_tooltip() {

		$(function () {
			$('[data-toggle="tooltip"]').tooltip();
		});

	}
	gt_tooltip();



	// === Mobile Header ==================================== //

	function gt_mobile_header() {

		$(function () {
			$(document).on('click', '.gt-mobile-header .gt-menu-icon', function(){
				$('.gt-mobile-header').addClass('gt-mobile-menu-bars-actived');
				$('.gt-mobile-header .gt-menu-icon').addClass('gt-mobile-menu-bars-opened');
				$('.gt-mobile-menu').addClass('gt-mobile-menu-opened');
				$('.gt-mobile-background').addClass('gt-mobile-background-opened');
			});

			$(document).on('click', '.gt-mobile-header .gt-mobile-menu-bars-opened', function(){
				$('.gt-mobile-header .gt-menu-icon').removeClass('gt-mobile-menu-bars-opened');
			});

			$(document).on('click', '.gt-mobile-menu .gt-menu-icon, .gt-mobile-menu .gt-top .gt-menu > li a', function(){
				$('.gt-mobile-menu').removeClass('gt-mobile-menu-opened');
				$('.gt-mobile-menu').removeClass('gt-mobile-background-opened');
				$('.gt-mobile-header').removeClass('gt-mobile-menu-bars-actived');
				$('.gt-mobile-background').removeClass('gt-mobile-background-opened');
				$('.gt-mobile-header .gt-menu-icon').removeClass('gt-mobile-menu-bars-opened');
			});

			$(document).on('click', '.gt-mobile-background-opened', function(){
				$('.gt-mobile-menu').removeClass('gt-mobile-menu-opened');
				$('.gt-mobile-background').removeClass('gt-mobile-background-opened');
				$('.gt-mobile-header').removeClass('gt-mobile-menu-bars-actived');
				$('.gt-mobile-header .gt-menu-icon').removeClass('gt-mobile-menu-bars-opened');
			});

			if($('.gt-mobile-menu .gt-navbar li.dropdown .gt-dropdown-menu').length){
				$('.gt-mobile-menu .gt-navbar li.dropdown').append('<svg class="gt-caret" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>');
				$('.gt-mobile-menu .gt-navbar li.dropdown .gt-caret').on('click', function() {
					$(this).prev('.gt-dropdown-menu').slideToggle(500);
				});
			}

			$('.gt-mobile-menu').scrollbar();

			$(document).on('click', '.user-box .user-box-login>ul>li.user-box-login-form .user-box-login-form-top-links li a', function(){
				$('.eventchamp-class').addClass('modal-open').delay(900);
			});

			$(document).on('click', '.user-box .user-box-login .close', function(){
				$('body').removeClass('modal-open');
			});
		});

	}
	gt_mobile_header();



	// === Slider ==================================== //

	function gt_slider() {

		$('.gt-swiper-slider').each( function() {
			var swiperDatas = $(this),
				var_speed = $(this).data('gt-speed'),
				var_direction = $(this).data('gt-direction'),
				var_auto_height = $(this).data('gt-auto-height'),
				var_effect = $(this).data('gt-effect'),
				var_slides_per_view = $(this).data('gt-item'),
				var_slides_per_column = $(this).data('gt-item-column'),
				var_space_between = $(this).data('gt-item-space'),
				var_centered_slides = $(this).data('gt-centered-slides'),
				var_grab_cursor = $(this).data('gt-grab-cursor'),
				var_free_mode = $(this).data('gt-free-mode'),
				var_loop = $(this).data('gt-loop'),
				var_pag = $(this).find('.swiper-pagination'),
				var_next = $(this).find('.gt-slider-next'),
				var_prev = $(this).find('.gt-slider-prev'),
				var_parallax = $(this).data('gt-parallax');

			var swiper = new Swiper(swiperDatas, {
				speed: var_speed,
				direction: var_direction,
				autoHeight: var_auto_height,
				spaceBetween: var_space_between,
				slidesPerView: var_slides_per_view,
				slidesPerColumn: var_slides_per_column,
				centeredSlides: var_centered_slides,
				grabCursor: var_grab_cursor,
				freeMode: var_free_mode,
				loop: var_loop,
				parallax: var_parallax,
				effect: var_effect,
				lazy: {
					loadPrevNext: true,
					loadPrevNextAmount: 1,
					loadOnTransitionStart: true,
					elementClass: 'gt-lazy-load',
					preloaderClass: 'gt-lazy-preloader',
				},
				autoplay: {
					delay: 10000,
					disableOnInteraction: true,
				},
				pagination: {
					el: var_pag,
					type:'bullets',
					clickable: true,
				},
				navigation: {
					nextEl: var_next,
					prevEl: var_prev,
				},
				breakpoints: {
					1300: {
						slidesPerView: var_slides_per_view,
					},
					1280: {
						slidesPerView: var_slides_per_view < 5 ? var_slides_per_view: 4,
					},
					1198: {
						slidesPerView: var_slides_per_view < 4 ? var_slides_per_view: 3,
					},
					991: {
						slidesPerView: var_slides_per_view < 3 ? var_slides_per_view: 2,
					},
					480: {
						slidesPerView: var_slides_per_view < 2 ? var_slides_per_view: 1,
					},
					0: {
						slidesPerView: var_slides_per_view < 2 ? var_slides_per_view: 1,
					},
				}
			});
		});
	}

	jQuery(window).ready(function () {
		setTimeout(function () {
			gt_slider();
		}, 1);
	});



	// === Counter ==================================== //

	function gt_counter() {

		$('.gt-counter').each( function() {
			var counterUpDatas = $(this),
				var_delay = $(this).data('gt-delay'),
				var_time = $(this).data('gt-time');

			$(this).children('.gt-number').counterUp({
				delay: var_delay,
				time: var_time,
			}, counterUpDatas);
		});

	}
	gt_counter();



	// === Cookie Bar ==================================== //

	function gt_cookie_bar() {

		var cookieBar = $( '.gt-cookie-bar' ),
			cookieButton = $( '.gt-cookie-button a' ),
			cookieExpire = cookieBar.data( 'expires' );

		if ( cookieBar.length ) {

			if ( Cookies.get( 'gt-cookie-bar-visible' ) !== 'disable' ) {
				//cookieBar.fadeIn(500);
				cookieBar.css( 'opacity', 1 ).addClass( 'gt-visibility' );
			}

			cookieButton.on( 'click', function() {
			  Cookies.set( 'gt-cookie-bar-visible', 'disable', { expires: cookieExpire });
			  //cookieBar.fadeOut(500);
			  cookieBar.css( 'opacity', 0 ).removeClass( 'gt-visibility' );
				return false;
			});

		}

	}
	gt_cookie_bar();



	// === Event Labels ==================================== //

	function gt_event_labels() {

		$('.gt-event-style-1 > .gt-image > .gt-label.gt-style-4').each( function() {
			$(this).parent().parent('.gt-event-style-1').addClass("gt-overflow-hidden");
		});

		$('.gt-event-style-3 > .gt-image > .gt-label.gt-style-4').each( function() {
			$(this).parent().parent('.gt-event-style-3').addClass("gt-overflow-hidden");
		});

		$('.gt-event-style-4 > .gt-image > .gt-label.gt-style-4').each( function() {
			$(this).parent().parent('.gt-event-style-4').addClass("gt-overflow-hidden");
		});

	}
	gt_event_labels();



	// === Flex Menu Fix ==================================== //

	function gt_flex_menu_fix() {

		$(document).on('click', 'li.flexMenu-viewMore', function(){
			$('li.flexMenu-viewMore li a.active').removeClass('active show');
			$(this).toggleClass('actived');
		});

		$(document).on('click', 'li.flexMenu-viewMore ul > li > a', function(){
			$(this).parent().parent().parent().removeClass('actived');
			$(this).parent().parent().parent().removeClass('active');
			$(this).parent().parent().hide();
		});

	}
	gt_flex_menu_fix();



} )( jQuery );
<?php
/*======
*
* Customize
*
======*/
if( !function_exists( 'eventchamp_customize' ) ) {

	function eventchamp_customize() {

		$eventchamp_typgraphy_array = new eventchamp_font_settings;
		$eventchamp_custom_css = "";

		/*====== Font Settings ======*/
		$eventchamp_typgraphy_array->eventchamp_font_settings_echo( 'theme_main_font', 'body,.ui-widget-content', 'Poppins' );
		$eventchamp_typgraphy_array->eventchamp_font_settings_echo( 'body_text', 'body', '' );
		$eventchamp_typgraphy_array->eventchamp_font_settings_echo( 'h1_font', 'h1', '' );
		$eventchamp_typgraphy_array->eventchamp_font_settings_echo( 'h2_font', 'h2', '' );
		$eventchamp_typgraphy_array->eventchamp_font_settings_echo( 'h3_font', 'h3', '' );
		$eventchamp_typgraphy_array->eventchamp_font_settings_echo( 'h4_font', 'h4', '' );
		$eventchamp_typgraphy_array->eventchamp_font_settings_echo( 'h5_font', 'h5', '' );
		$eventchamp_typgraphy_array->eventchamp_font_settings_echo( 'h6_font', 'h6', '' );
		$eventchamp_typgraphy_array->eventchamp_font_settings_echo( 'input_font', 'input[type="email"], input[type="number"], input[type="password"], input[type="tel"], input[type="url"], input[type="text"], input[type="time"], input[type="week"], input[type="search"], input[type="month"], input[type="datetime"], input[type="date"], textarea, textarea.form-control, select, .woocommerce form .form-row .select2-container .select2-choice, .upload-input, .select2-dropdown, .select2-search--dropdown .select2-search__field, .select2-container--default .select2-search--dropdown .select2-search__field, .select2-container--default .select2-selection--single, #add_payment_method table.cart td.actions .coupon .input-text, .woocommerce-cart table.cart td.actions .coupon .input-text, .woocommerce-checkout table.cart td.actions .coupon .input-text, .form-control, .bootstrap-select.gt-select > button', '' );
		$eventchamp_typgraphy_array->eventchamp_font_settings_echo( 'button_font', '.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, button, input[type="submit"]', '' );
		$eventchamp_typgraphy_array->eventchamp_font_settings_echo( 'header_menu_link_font', '.gt-header .gt-navbar .gt-menu', '' );

		/*====== Font Output ======*/
		$eventchamp_typgraphy_array->eventchamp_font_output();

		/*====== Font CSS Output ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_output();

		/*====== Body Background ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'body_background', 'body', 'background-all', '' );

		/*====== Wrapper Background ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'wrapper_background', '.gt-site-wrapper', 'background-all', '' );

		/*====== Box Layout Background ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'box_layouts_bg', '.gt-widget, .gt-section, .gt-event-section-tabs, .gt-page-content', 'background-color', '' );

		/*====== Primary Fill ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'theme_main_color', '.gt-user-activity > ul > li svg, .gt-content-detail-box > ul > li > .gt-icon > svg', 'fill', '' );

		/*====== Primary Stroke ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'theme_main_color', '.gt-map.gt-events-map .gt-map-popup .gt-bottom-links > li > svg, .gt-events-slider .gt-slide-inner .gt-content .gt-information > li svg', 'stroke', '' );

		/*====== Primary Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'theme_main_color', '.gt-footer.gt-style-1 .gt-social-links-element.gt-style-6 ul li a:hover, .gt-footer.gt-style-1 .gt-social-links-element.gt-style-6 ul li a:focus, .gt-footer.gt-style-1 a:hover, .gt-footer.gt-style-1 a:focus, .gt-event-style-2 .gt-information > div a:focus, .gt-event-style-2 .gt-information > div a:hover, .gt-footer.gt-style-1 .post-list-style-3 .title a:hover, .gt-footer.gt-style-1 .post-list-style-3 .title a:focus, .gt-mobile-menu .gt-bottom .gt-social-links li a:hover, .gt-mobile-menu .gt-bottom .gt-social-links li a:focus, .gt-modal .gt-register-content .gt-modal-footer a:hover, .gt-modal .gt-register-content .gt-modal-footer a:focus, .gt-modal .gt-login-content .gt-modal-footer a:hover, .gt-modal .gt-login-content .gt-modal-footer a:focus, .gt-countdown.gt-style-3 ul li > .gt-inner, .gt-footer .post-list-style-3 .title a:hover, .gt-footer .post-list-style-3 .title a:focus, .gt-feature-box .gt-content .gt-title, .gt-feature-box .gt-icon, .gt-map.gt-events-map .gt-map-popup .gt-inner a:hover, .gt-map.gt-events-map .gt-map-popup .gt-inner a:focus, .gt-label.gt-style-4, .gt-post-style-1 .gt-bottom .gt-more:hover, .gt-post-style-1 .gt-bottom .gt-more:focus, .gt-post-style-1 .gt-bottom > ul a:hover, .gt-post-style-1 .gt-bottom > ul a:focus, .gt-post-style-2 .gt-bottom .gt-more:hover, .gt-post-style-2 .gt-bottom .gt-more:focus, .gt-post-style-2 .gt-bottom > ul a:hover, .gt-post-style-2 .gt-bottom > ul a:focus, .gt-page-content .gt-post-meta a:hover, .gt-page-content .gt-post-meta a:focus, .gt-pagination ul li > span.current, .gt-pagination ul li > a:hover, .gt-pagination ul li > a:focus, .gt-post-pagination ul li a:hover, .gt-post-pagination ul li a:focus, .gt-page-content .gt-post-meta ul li svg, .gt-event-ticket.gt-style-1 .gt-ticket-inner > .gt-details .gt-subtitle, .gt-event-ticket.gt-style-1 .gt-ticket-inner > .gt-details > .gt-price, .gt-event-ticket.gt-style-1 .gt-ticket-inner > .gt-ticket-features p:before, .gt-event-ticket.gt-style-2 .gt-ticket-inner .gt-title, .gt-event-ticket.gt-style-2 .gt-price, .gt-event-ticket.gt-style-3 .gt-ticket-inner .gt-title, .gt-event-ticket.gt-style-3 .gt-price, .gt-event-ticket.gt-style-4 .gt-price, .gt-event-ticket.gt-style-4 .gt-ticket-inner .gt-ticket-features p:before, .gt-event-ticket.gt-style-5 .gt-price, .gt-event-ticket.gt-style-5 .gt-ticket-inner .gt-ticket-features p:before, .gt-event-ticket.gt-style-6 .gt-ticket-features p:before, .gt-event-ticket.gt-style-6 .gt-ticket-header .gt-price, .gt-event-ticket.gt-style-7 .gt-ticket-features p:before, .gt-event-ticket.gt-style-7 .gt-ticket-header .gt-price, .gt-event-buttons ul li a:hover, .gt-event-buttons ul li a:focus, .gt-event-schedule.gt-style-2 .gt-schedule-tabs > li > a.active, .gt-event-schedule.gt-style-2 .gt-schedule-tabs > li > a.active:visited, .gt-event-schedule.gt-style-2 .gt-schedule-tabs > li > a:hover, .gt-event-schedule.gt-style-2 .gt-schedule-tabs > li > a:focus, .gt-speaker.gt-style-1 .gt-content .gt-name a:hover, .gt-speaker.gt-style-1 .gt-content .gt-name a:focus, .gt-speaker.gt-style-1 .gt-social-links ul li a:focus, .gt-speaker.gt-style-1 .gt-social-links ul li a:hover, .gt-speaker.gt-style-2 .gt-social-links ul li a:focus, .gt-speaker.gt-style-2 .gt-social-links ul li a:hover, .gt-speaker.gt-style-3 .gt-social-links ul li a:focus, .gt-speaker.gt-style-3 .gt-social-links ul li a:hover, .gt-speaker.gt-style-4 .gt-social-links ul li a:focus, .gt-speaker.gt-style-4 .gt-social-links ul li a:hover, .gt-speaker.gt-style-5 .gt-social-links ul li a:focus, .gt-speaker.gt-style-5 .gt-social-links ul li a:hover, .gt-speaker.gt-style-6 .gt-social-links ul li a:focus, .gt-speaker.gt-style-6 .gt-social-links ul li a:hover, .gt-content-detail-box > ul > li > .gt-content > .gt-inner a:hover, .gt-content-detail-box > ul > li > .gt-content > .gt-inner a:focus, .gt-content-detail-box > ul > li > .gt-icon > i, .gt-icon-list.gt-style-1 ul li i, .gt-icon-list.gt-style-2 ul li i, .gt-icon-list.gt-style-1 ul li svg, .gt-icon-list.gt-style-2 ul li svg, .gt-mailchimp-newsletter .title i, .gt-button.gt-style-6 a:hover, .gt-button.gt-style-6 a:focus, .gt-button.gt-style-5 a, .gt-button.gt-style-5 a:visited, .gt-button.gt-style-3 a:hover, .gt-button.gt-style-3 a:focus, .gt-button.gt-style-2 a:hover, .gt-button.gt-style-2 a:focus, .gt-button.gt-style-1 a:hover, .gt-button.gt-style-1 a:focus, .gt-contact-box svg, .gt-counter > .gt-title, .gt-counter > .gt-number, .gt-eventchamp-service-box.gt-style-1 .gt-title, .gt-eventchamp-service-box.gt-style-1 .gt-icon, .gt-categorized-contents .gt-nav > li > a.active, .gt-categorized-contents .gt-nav > li > a.active:visited, .gt-categorized-contents .gt-nav > li > a:hover, .gt-categorized-contents .gt-nav > li > a:focus, .gt-heading .gt-title span, .gt-eventchamp-slider .gt-slider-content .gt-title .gt-secondary, .gt-countdown-slider.gt-style-1 > .gt-slider-content .gt-title .gt-secondary, .gt-countdown-slider.gt-style-3 > .gt-slider-content > .gt-counter .gt-counter-inner > div, .gt-events-slider .gt-slide-inner .gt-content .gt-information > li i, .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li a:focus, .woocommerce div.product .stock, .woocommerce .woocommerce-MyAccount-navigation ul li a, .woocommerce .woocommerce-MyAccount-navigation ul li a:visited, .woocommerce-error::before, .woocommerce-info::before, .woocommerce-message::before, .woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li a:visited, .woocommerce div.product .woocommerce-tabs ul.tabs li a, .woocommerce div.product .woocommerce-tabs ul.tabs li a:visited, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce ul.products li.product .price, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .select2-container--default .select2-results__option--highlighted[aria-selected], .select2-container--default .select2-results__option--highlighted[data-selected], .select2-container--default .select2-results__option[aria-selected=true], .select2-container--default .select2-results__option[data-selected=true], .plyr__progress--played, .plyr__volume--display, .bootstrap-select.gt-select .dropdown-item:focus, .bootstrap-select.gt-select .dropdown-item:hover, .bootstrap-select.gt-select .dropdown-item.active, .bootstrap-select.gt-select .dropdown-item:active, blockquote:before, button:hover, input[type="submit"]:hover, button:active, input[type="submit"]:active, button:active:hover, input[type="submit"]:active:hover, button:active:focus, input[type="submit"]:active:focus, button:active:visited, input[type="submit"]:active:visited, button:focus, input[type="submit"]:focus, a:hover, a:focus, .gt-header.gt-style-1.gt-style-2 .gt-elements .gt-social-links li a:hover, .gt-header.gt-style-1.gt-style-2 .gt-elements .gt-social-links li a:focus, .gt-header.gt-style-1.gt-style-2 .gt-navbar .gt-menu > li a:hover, .gt-header.gt-style-1.gt-style-2 .gt-navbar .gt-menu > li a:focus, .gt-header.gt-style-1.gt-style-2 .gt-navbar .gt-menu > li:hover > a, .gt-header.gt-style-1.gt-style-2 .gt-navbar .gt-menu > li:hover > a:visited, .gt-header.gt-style-1.gt-style-2 .gt-navbar .gt-menu > li>a:hover, .gt-header.gt-style-1.gt-style-2 .gt-navbar .gt-menu > li>a:focus, .gt-header.gt-style-1.gt-style-2 .gt-navbar .gt-menu li .gt-dropdown-menu li a:hover, .gt-header.gt-style-1.gt-style-2 .gt-navbar .gt-menu li .gt-dropdown-menu li a:focus, .gt-header.gt-style-3.gt-style-4 .gt-elements .gt-social-links li a:hover, .gt-header.gt-style-3.gt-style-4 .gt-elements .gt-social-links li a:focus, .gt-header.gt-style-3.gt-style-4 .gt-navbar .gt-menu > li a:hover, .gt-header.gt-style-3.gt-style-4 .gt-navbar .gt-menu > li a:focus, .gt-header.gt-style-3.gt-style-4 .gt-navbar .gt-menu > li:hover > a, .gt-header.gt-style-3.gt-style-4 .gt-navbar .gt-menu > li:hover > a:visited, .gt-header.gt-style-3.gt-style-4 .gt-navbar .gt-menu > li > a:hover, .gt-header.gt-style-3.gt-style-4 .gt-navbar .gt-menu > li > a:focus, .gt-header.gt-style-3.gt-style-4 .gt-navbar .gt-menu li .gt-dropdown-menu li a:hover, .gt-header.gt-style-3.gt-style-4 .gt-navbar .gt-menu li .gt-dropdown-menu li a:focus, .gt-header.gt-style-5.gt-style-6 .gt-elements .gt-social-links li a:hover, .gt-header.gt-style-5.gt-style-6 .gt-elements .gt-social-links li a:focus, .gt-header.gt-style-5.gt-style-6 .gt-navbar .gt-menu > li a:hover, .gt-header.gt-style-5.gt-style-6 .gt-navbar .gt-menu > li a:focus, .gt-header.gt-style-5.gt-style-6 .gt-navbar .gt-menu > li:hover > a, .gt-header.gt-style-5.gt-style-6 .gt-navbar .gt-menu > li:hover > a:visited, .gt-header.gt-style-5.gt-style-6 .gt-navbar .gt-menu > li > a:hover, .gt-header.gt-style-5.gt-style-6 .gt-navbar .gt-menu > li > a:focus, .gt-header.gt-style-5.gt-style-6 .gt-navbar .gt-menu li .gt-dropdown-menu li a:hover, .gt-header.gt-style-5.gt-style-6 .gt-navbar .gt-menu li .gt-dropdown-menu li a:focus, .gt-footer a:hover, .gt-footer a:focus, .gt-page-title-bar .gt-breadcrumb nav > ol > li a:focus, .gt-page-title-bar .gt-breadcrumb nav > ol > li a:hover, .gt-page-title-bar .gt-breadcrumb nav > ol > li.gt-item-current, .gt-page-title-bar .gt-breadcrumb nav > ol > li.current-item > span, .gt-mobile-menu .gt-top .gt-menu .gt-dropdown-menu > .active > a, .gt-mobile-menu .gt-top .gt-menu .gt-dropdown-menu > .active > a:focus, .gt-mobile-menu .gt-top .gt-menu .gt-dropdown-menu > .active > a:hover, .gt-mobile-menu .gt-top .gt-menu > li a:hover, .gt-mobile-menu .gt-top .gt-menu > li a:focus, .gt-mobile-menu .gt-top .gt-menu li:hover > a, .gt-mobile-menu .gt-top .gt-menu li:focus > a:visited, .gt-mobile-menu .gt-top .gt-menu li:hover > i, .gt-mobile-menu .gt-top .gt-menu li:focus > i, .gt-flex-menu li a:focus, .gt-flex-menu li a:hover, .fc-state-default:hover, .fc-state-default:focus, .fc button:hover, .fc button:focus, .gt-post-style-1 .gt-bottom > ul > li svg, .gt-post-style-1 .gt-bottom .gt-more:hover, .gt-post-style-1 .gt-bottom .gt-more:focus, .gt-post-style-1 .gt-image .gt-category ul a, .gt-post-style-1 .gt-image .gt-category ul a:visited, .gt-post-style-1 .gt-image .gt-category ul, .gt-post-style-2 .gt-bottom > ul > li svg, .gt-post-style-2 .gt-bottom .gt-more:hover, .gt-post-style-2 .gt-bottom .gt-more:focus, .gt-post-style-2 .gt-image .gt-category ul a, .gt-post-style-2 .gt-image .gt-category ul a:visited, .gt-post-style-2 .gt-image .gt-category ul, .gt-post-style-3 .gt-information > div svg, .gt-event-style-1 .gt-venue a:focus, .gt-event-style-1 .gt-venue a:hover, .gt-event-style-1 .gt-location ul li a:focus, .gt-event-style-1 .gt-location ul li a:hover, .gt-event-style-1 .gt-location svg, .gt-event-style-1 .gt-date svg, .gt-event-style-1 .gt-time svg, .gt-event-style-1 .gt-venue svg, .gt-event-style-1 .gt-stock svg, .gt-event-style-1 .gt-event-status, .gt-event-style-2 .gt-information > div svg, .gt-event-style-3 .gt-venue a:focus, .gt-event-style-3 .gt-venue a:hover, .gt-event-style-3 .gt-location ul li a:focus, .gt-event-style-3 .gt-location ul li a:hover, .gt-event-style-3 .gt-price svg, .gt-event-style-3 .gt-status svg, .gt-event-style-3 .gt-location svg, .gt-event-style-3 .gt-date svg, .gt-event-style-3 .gt-time svg, .gt-event-style-3 .gt-stock svg, .gt-event-style-3 .gt-venue svg, .gt-event-style-4 .gt-venue a:focus, .gt-event-style-4 .gt-venue a:hover, .gt-event-style-4 .gt-location ul li a:focus, .gt-event-style-4 .gt-location ul li a:hover, .gt-event-style-4 .gt-price svg, .gt-event-style-4 .gt-status svg, .gt-event-style-4 .gt-location svg, .gt-event-style-4 .gt-date svg, .gt-event-style-4 .gt-time svg, .gt-event-style-4 .gt-venue svg, .gt-event-style-4 .gt-stock svg, .gt-white .gt-venue-style-1 .gt-title a:hover, .gt-white .gt-venue-style-1 .gt-title a:focus, .gt-venue-style-1 .gt-title a:hover, .gt-venue-style-1 .gt-title a:focus, .gt-venue-style-1 .gt-image .gt-location, .gt-venue-style-1 .gt-image .gt-location a, .gt-venue-style-1 .gt-image .gt-location a:visited, .gt-venue-style-1 .gt-image .status, .gt-content-favorite-add-popup:before, .gt-content-favorite-remove-popup:before, .gt-content-like-add-popup:before, .gt-content-like-remove-popup:before, .edit-link a:focus, .edit-link a:hover', 'color', '' );

		/*====== Primary Background Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'theme_main_color', '.gt-marker-cluster, .irs-bar, .irs-slider, .irs-from, .irs-to, .irs-single, .gt-countdown.gt-style-4 ul li > .gt-inner, .gt-countdown.gt-style-1 ul li > .gt-inner, .gt-feature-box .gt-content .gt-line, .gt-post-style-1 .gt-bottom .gt-more, .gt-post-style-1 .gt-bottom .gt-more:visited, .gt-post-style-2 .gt-bottom .gt-more, .gt-post-style-2 .gt-bottom .gt-more:visited, .gt-pagination ul li > span, .gt-pagination ul li > a, .gt-pagination ul li > a:visited, .gt-post-pagination ul li a, .gt-post-pagination ul li a:visited, .gt-event-section-tabs .gt-event-tabs > li > a:after, .gt-event-section-tabs .gt-event-tabs > li > a:visited:after, .woocommerce .woocommerce-MyAccount-navigation ul li.is-active a, .woocommerce .woocommerce-MyAccount-navigation ul li.is-active a:visited, .woocommerce .woocommerce-MyAccount-navigation ul li a:hover, .woocommerce .woocommerce-MyAccount-navigation ul li a:focus, .woocommerce .woocommerce-MyAccount-navigation ul li a:hover, .woocommerce .woocommerce-MyAccount-navigation ul li a:focus, .woocommerce .woocommerce-MyAccount-navigation ul li.is-active a, .woocommerce .woocommerce-MyAccount-navigation ul li.is-active a:visited, .woocommerce #respond input#submit.disabled:hover, .woocommerce #respond input#submit:disabled:hover, .woocommerce #respond input#submit:disabled[disabled]:hover, .woocommerce a.button.disabled:hover, .woocommerce a.button:disabled:hover, .woocommerce a.button:disabled[disabled]:hover, .woocommerce button.button.disabled:hover, .woocommerce button.button:disabled:hover, .woocommerce button.button:disabled[disabled]:hover, .woocommerce input.button.disabled:hover, .woocommerce input.button:disabled:hover, .woocommerce input.button:disabled[disabled]:hover, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a:visited, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a:focus, .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li a:focus, .woocommerce span.onsale, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .gt-event-schedule.gt-style-1 .gt-schedule-tabs, .gt-event-schedule.gt-style-1 .gt-dropdown .gt-panel-body .gt-schedule-speakers .gt-list ul li a:hover, .gt-event-schedule.gt-style-1 .gt-dropdown .gt-panel-body .gt-schedule-speakers .gt-list ul li a:focus, .gt-event-schedule.gt-style-2 .gt-dropdown .gt-panel-body .gt-schedule-speakers .gt-list ul li a:hover, .gt-event-schedule.gt-style-2 .gt-dropdown .gt-panel-body .gt-schedule-speakers .gt-list ul li a:focus, .gt-event-schedule.gt-style-3 .gt-dropdown .gt-panel-body .gt-schedule-speakers .gt-list ul li a:hover, .gt-event-schedule.gt-style-3 .gt-dropdown .gt-panel-body .gt-schedule-speakers .gt-list ul li a:focus, .gt-event-schedule.gt-style-4 > .gt-item > ul > li .gt-content .gt-schedule-speakers .gt-list ul li a:hover, .gt-event-schedule.gt-style-4 > .gt-item > ul > li .gt-content .gt-schedule-speakers .gt-list ul li a:focus, .gt-event-schedule.gt-style-5 > .gt-item > ul > li .gt-content .gt-schedule-speakers .gt-list ul li a:hover, .gt-event-schedule.gt-style-5 > .gt-item > ul > li .gt-content .gt-schedule-speakers .gt-list ul li a:focus, .gt-event-schedule.gt-style-6 > .gt-item > ul > li .gt-content .gt-schedule-speakers .gt-list ul li a:hover, .gt-event-schedule.gt-style-6 > .gt-item > ul > li .gt-content .gt-schedule-speakers .gt-list ul li a:focus, .gt-event-schedule.gt-style-2 .gt-schedule-tabs > li > a, .gt-event-schedule.gt-style-2 .gt-schedule-tabs > li > a:visited, .gt-event-schedule.gt-style-4 > .gt-item > .gt-heading, .gt-event-schedule.gt-style-5 > .gt-item > .gt-heading, .gt-event-schedule.gt-style-6 > .gt-item > .gt-heading, .gt-organizers.gt-style-1 ul li a:hover, .gt-organizers.gt-style-1 ul li a:focus, .gt-organizers.gt-style-2 ul li a:hover, .gt-organizers.gt-style-2 ul li a:focus, .gt-organizers.gt-style-3 ul li a, .gt-organizers.gt-style-3 ul li a:visited, .gt-tags.gt-style-1 ul li a:hover, .gt-tags.gt-style-1 ul li a:focus, .gt-tags.gt-style-2 ul li a:hover, .gt-tags.gt-style-2 ul li a:focus, .gt-tags.gt-style-3 ul li a, .gt-tags.gt-style-3 ul li a:visited, .gt-categories.gt-style-1 ul li a:hover, .gt-categories.gt-style-1 ul li a:focus, .gt-categories.gt-style-2 ul li a:hover, .gt-categories.gt-style-2 ul li a:focus, .gt-categories.gt-style-3 ul li a, .gt-categories.gt-style-3 ul li a:visited, .gt-social-sharing.gt-style-1 ul li a:hover, .gt-social-sharing.gt-style-1 ul li a:focus, .gt-social-sharing.gt-style-2 ul li a:hover, .gt-social-sharing.gt-style-2 ul li a:focus, .gt-social-sharing.gt-style-3 ul li a:hover, .gt-social-sharing.gt-style-3 ul li a:focus, .gt-social-sharing.gt-style-4 ul li a:hover, .gt-social-sharing.gt-style-4 ul li a:focus, .gt-social-sharing.gt-style-5 ul li a:hover, .gt-social-sharing.gt-style-5 ul li a:focus, .gt-social-sharing.gt-style-6 ul li a, .gt-social-sharing.gt-style-6 ul li a:visited, .gt-social-sharing.gt-style-7 ul li a:hover, .gt-social-sharing.gt-style-7 ul li a:focus, .gt-social-links-element.gt-style-1 ul li a:hover, .gt-social-links-element.gt-style-1 ul li a:focus, .gt-social-links-element.gt-style-2 ul li a:hover, .gt-social-links-element.gt-style-2 ul li a:focus, .gt-social-links-element.gt-style-3 ul li a:hover, .gt-social-links-element.gt-style-3 ul li a:focus, .gt-social-links-element.gt-style-4 ul li a:hover, .gt-social-links-element.gt-style-4 ul li a:focus, .gt-social-links-element.gt-style-5 ul li a:hover, .gt-social-links-element.gt-style-5 ul li a:focus, .gt-social-links-element.gt-style-6 ul li a, .gt-social-links-element.gt-style-6 ul li a:visited, .gt-social-links-element.gt-style-7 ul li a:hover, .gt-social-links-element.gt-style-7 ul li a:focus, .gt-event-buttons ul li a, .gt-event-buttons ul li a:visited, .gt-content-detail-box > ul > li.gt-event-counter, .gt-button.gt-style-3 a, .gt-button.gt-style-3 a:visited, .gt-button.gt-style-2 a, .gt-button.gt-style-2 a:visited, .gt-button.gt-style-1 a, .gt-button.gt-style-1 a:visited, .gt-app-box .gt-item a:hover, .gt-app-box .gt-item a:focus, .gt-blog-carousel .gt-slider-prev:hover, .gt-blog-carousel .gt-slider-prev:focus, .gt-blog-carousel .gt-slider-next:hover, .gt-blog-carousel .gt-slider-next:focus, .gt-blog-carousel .gt-all-button:hover, .gt-blog-carousel .gt-all-button:focus, .gt-venues-carousel .gt-slider-prev:hover, .gt-venues-carousel .gt-slider-prev:focus, .gt-venues-carousel .gt-slider-next:hover, .gt-venues-carousel .gt-slider-next:focus, .gt-venues-carousel .gt-all-button:hover, .gt-venues-carousel .gt-all-button:focus, .gt-events-carousel .gt-slider-prev:hover, .gt-events-carousel .gt-slider-prev:focus, .gt-events-carousel .gt-slider-next:hover, .gt-events-carousel .gt-slider-next:focus, .gt-events-carousel .gt-all-button:hover, .gt-events-carousel .gt-all-button:focus, .gt-testimonials-carousel .gt-slider-pagination .swiper-pagination-bullet:hover, .gt-testimonials-carousel .gt-slider-pagination .swiper-pagination-bullet:focus, .gt-testimonials-carousel .gt-slider-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active, .gt-categorized-contents .gt-all-button:hover, .gt-categorized-contents .gt-all-button:focus, .gt-categorized-contents .gt-nav > li > a, .gt-categorized-contents .gt-nav > li > a:visited, .gt-eventchamp-slider .gt-slider-content .gt-buttons a:hover, .gt-eventchamp-slider .gt-slider-content .gt-buttons a:focus, .gt-countdown-slider.gt-style-3 > .gt-slider-content .gt-buttons a:hover, .gt-countdown-slider.gt-style-3 > .gt-slider-content .gt-buttons a:focus, .gt-countdown-slider.gt-style-2 > .gt-slider-content .gt-buttons a:hover, .gt-countdown-slider.gt-style-2 > .gt-slider-content .gt-buttons a:focus, .gt-countdown-slider.gt-style-1 > .gt-slider-content .gt-buttons a:hover, .gt-countdown-slider.gt-style-1 > .gt-slider-content .gt-buttons a:focus, .gt-events-slider .gt-slide-inner .gt-content .buttons a:hover, .gt-events-slider .gt-slide-inner .gt-content .buttons a:focus, .gt-events-slider .gt-slide-inner .gt-content .gt-category, .gt-eventchamp-service-box.gt-style-1:hover .gt-icon, .gt-mobile-menu .gt-bottom .gt-user-box, .gt-header.gt-style-1.gt-style-2 .gt-elements .gt-user-box, .gt-header.gt-style-3.gt-style-4 .gt-elements .gt-user-box, .gt-header.gt-style-5.gt-style-6 .gt-elements .gt-user-box, .gt-style-4 .sk-fading-circle .sk-circle:before, .gt-style-3 .spinner, .gt-style-2 .spinner > div, .gt-style-1 .double-bounce1, .gt-style-1 .double-bounce2, .gt-event-style-1 .gt-category ul li, .gt-event-style-1 .gt-price, .gt-event-style-3 .gt-category ul li, .gt-event-style-4 .gt-category ul li, .gt-venue-style-1 .gt-image .price, .fc button, .fc-state-default, .fc-event, .fc-event-dot, .ui-datepicker .ui-datepicker-today > a, .ui-datepicker .ui-datepicker-today > a:visited, .ui-datepicker .ui-datepicker-header, .plyr--video .plyr__controls button.tab-focus:focus, .plyr--video .plyr__controls button:hover, .plyr--audio .plyr__controls button.tab-focus:focus, .plyr--audio .plyr__controls button:hover, .plyr__play-large, button, input[type="submit"], .widget_tag_cloud .tagcloud a:hover, .widget_tag_cloud .tagcloud a:focus, .gt-like-box a.gt-liked, .gt-like-box a.gt-liked:visited, .gt-like-box a.gt-favorited, .gt-like-box a.gt-favorited:visited, .gt-like-box a:hover, .gt-like-box a:focus, .fancybox-container .fancybox-progress', 'background-color', '' );

		/*====== Primary Border Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'theme_main_color', '.fancybox-container .fancybox-thumbs__list a:before, .gt-like-box a.gt-liked, .gt-like-box a.gt-liked:visited, .gt-like-box a.gt-favorited, .gt-like-box a.gt-favorited:visited, .gt-like-box a:hover, .gt-like-box a:focus, .gt-countdown.gt-style-3 ul li > .gt-inner, .gt-footer .gt-app-box .gt-item a:hover, .gt-footer .gt-app-box .gt-item a:focus, .gt-footer.gt-style-1 .gt-app-box .gt-item a:hover, .gt-footer.gt-style-1 .gt-app-box .gt-item a:focus, .gt-post-style-1 .gt-bottom .gt-more, .gt-post-style-1 .gt-bottom .gt-more:visited, .gt-post-style-2 .gt-bottom .gt-more, .gt-post-style-2 .gt-bottom .gt-more:visited, .gt-pagination ul li > span, .gt-pagination ul li > a, .gt-pagination ul li > a:visited, .gt-post-pagination ul li a, .gt-post-pagination ul li a:visited, .gt-event-ticket.gt-style-1.gt-active-on, .gt-event-ticket.gt-style-2.gt-active-on, .gt-event-ticket.gt-style-3.gt-active-on, .gt-event-ticket.gt-style-4, .gt-event-ticket.gt-style-5.gt-active-on, .gt-event-ticket.gt-style-6.gt-active-on, .gt-event-ticket.gt-style-7.gt-active-on, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce .woocommerce-MyAccount-navigation ul li a, .woocommerce .woocommerce-MyAccount-navigation ul li a:visited, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li a:visited, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li a:focus, .woocommerce div.product .woocommerce-tabs ul.tabs li, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .gt-button.gt-style-3 a, .gt-button.gt-style-3 a:visited, .gt-button.gt-style-2 a, .gt-button.gt-style-2 a:visited, .gt-button.gt-style-1 a:hover, .gt-button.gt-style-1 a:focus, .gt-button.gt-style-1 a, .gt-button.gt-style-1 a:visited, .gt-event-buttons ul li a, .gt-event-buttons ul li a:visited, .gt-event-schedule.gt-style-7 .gt-item > ul > li .gt-content > .gt-inner, .gt-event-schedule.gt-style-2 .gt-schedule-tabs > li > a, .gt-event-schedule.gt-style-2 .gt-schedule-tabs > li > a:visited, .gt-organizers.gt-style-2 ul li a:hover, .gt-organizers.gt-style-2 ul li a:focus, .gt-tags.gt-style-2 ul li a:hover, .gt-tags.gt-style-2 ul li a:focus, .gt-categories.gt-style-2 ul li a:hover, .gt-categories.gt-style-2 ul li a:focus, .gt-social-sharing.gt-style-7 ul li a:hover, .gt-social-sharing.gt-style-7 ul li a:focus, .gt-social-links-element.gt-style-7 ul li a:hover, .gt-social-links-element.gt-style-7 ul li a:focus, .gt-app-box .gt-item a:hover, .gt-app-box .gt-item a:focus, .gt-counter > .gt-number, .gt-testimonials-carousel .gt-slider-pagination .swiper-pagination-bullet:hover, .gt-testimonials-carousel .gt-slider-pagination .swiper-pagination-bullet:focus, .gt-testimonials-carousel .gt-slider-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active, .gt-eventchamp-service-box.gt-style-1 .gt-title, .gt-eventchamp-service-box.gt-style-1 .gt-icon, .gt-blog-carousel .gt-slider-prev:hover, .gt-blog-carousel .gt-slider-prev:focus, .gt-blog-carousel .gt-slider-next:hover, .gt-blog-carousel .gt-slider-next:focus, .gt-blog-carousel .gt-all-button:hover, .gt-blog-carousel .gt-all-button:focus, .gt-venues-carousel .gt-slider-prev:hover, .gt-venues-carousel .gt-slider-prev:focus, .gt-venues-carousel .gt-slider-next:hover, .gt-venues-carousel .gt-slider-next:focus, .gt-venues-carousel .gt-all-button:hover, .gt-venues-carousel .gt-all-button:focus, .gt-venues-carousel.gt-white .gt-slider-prev:hover, .gt-venues-carousel.gt-white .gt-slider-prev:focus, .gt-venues-carousel.gt-white .gt-slider-next:hover, .gt-venues-carousel.gt-white .gt-slider-next:focus, .gt-venues-carousel.gt-white .gt-all-button:hover, .gt-venues-carousel.gt-white .gt-all-button:focus, .gt-events-carousel .gt-slider-prev:hover, .gt-events-carousel .gt-slider-prev:focus, .gt-events-carousel .gt-slider-next:hover, .gt-events-carousel .gt-slider-next:focus, .gt-events-carousel .gt-all-button:hover, .gt-events-carousel .gt-all-button:focus, .gt-categorized-contents .gt-all-button:hover, .gt-categorized-contents .gt-all-button:focus, .gt-categorized-contents .gt-nav > li > a.active, .gt-categorized-contents .gt-nav > li > a.active:visited, .gt-categorized-contents .gt-nav > li > a:hover, .gt-categorized-contents .gt-nav > li > a:focus, .gt-categorized-contents .gt-nav > li > a, .gt-categorized-contents .gt-nav > li > a:visited, .gt-eventchamp-slider .gt-slider-content .gt-buttons a:hover, .gt-eventchamp-slider .gt-slider-content .gt-buttons a:focus, .gt-countdown-slider.gt-style-2 > .gt-slider-content .gt-buttons a:hover, .gt-countdown-slider.gt-style-2 > .gt-slider-content .gt-buttons a:focus, .gt-countdown-slider.gt-style-1 > .gt-slider-content .gt-buttons a:hover, .gt-countdown-slider.gt-style-1 > .gt-slider-content .gt-buttons a:focus, .gt-events-slider .gt-slide-inner .gt-content .buttons a:hover, .gt-events-slider .gt-slide-inner .gt-content .buttons a:focus, .fc button, .fc-state-default, .gt-header.gt-style-1.gt-style-2 .gt-navbar .gt-menu li .gt-dropdown-menu, .gt-header.gt-style-3.gt-style-4 .gt-navbar .gt-menu li .gt-dropdown-menu, .gt-header.gt-style-5.gt-style-6 .gt-navbar .gt-menu li .gt-dropdown-menu, button, input[type="submit"], button:hover, input[type="submit"]:hover, button:active, input[type="submit"]:active, button:active:hover, input[type="submit"]:active:hover, button:active:focus, input[type="submit"]:active:focus, button:active:visited, input[type="submit"]:active:visited, button:focus, input[type="submit"]:focus, button, input[type="submit"]', 'border-color', '' );

		/*====== Primary Border Top Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'theme_main_color', '.irs-from:after, .irs-to:after, .irs-single:after, .gt-event-style-3 .gt-content, .gt-event-ticket.gt-style-4.gt-active-on:before, .woocommerce-error, .woocommerce-info, .woocommerce-message, .gt-header.gt-style-1.gt-style-2 .gt-navbar .gt-menu li .gt-dropdown-menu, .gt-header.gt-style-3.gt-style-4 .gt-navbar .gt-menu li .gt-dropdown-menu, .gt-header.gt-style-5.gt-style-6 .gt-navbar .gt-menu li .gt-dropdown-menu, .gt-flex-menu', 'border-top-color', '' );

		/*====== Primary Border Bottom Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'theme_main_color', '.ui-datepicker:before, .gt-page-title-bar .gt-breadcrumb nav > ol > li.gt-item-current, .gt-page-title-bar .gt-breadcrumb nav > ol > li.current-item > span', 'border-bottom-color', '' );

		/*====== Secondary Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'theme_alternative_color', '.gt-header.gt-style-1 .gt-elements .gt-social-links li a:hover, .gt-header.gt-style-1 .gt-elements .gt-social-links li a:focus, .gt-header.gt-style-1 .gt-navbar .gt-menu li .gt-dropdown-menu li a:hover, .gt-header.gt-style-1 .gt-navbar .gt-menu li .gt-dropdown-menu li a:focus, .gt-header.gt-style-1 .gt-elements .gt-social-links li a:hover, .gt-header.gt-style-1 .gt-elements .gt-social-links li a:focus, .gt-header.gt-style-1 .gt-navbar .gt-menu > li a:hover, .gt-header.gt-style-1 .gt-navbar .gt-menu > li a:focus, .gt-header.gt-style-3 .gt-elements .gt-social-links li a:hover, .gt-header.gt-style-3 .gt-elements .gt-social-links li a:focus, .gt-header.gt-style-3 .gt-navbar .gt-menu li .gt-dropdown-menu li a:hover, .gt-header.gt-style-3 .gt-navbar .gt-menu li .gt-dropdown-menu li a:focus, .gt-header.gt-style-3 .gt-elements .gt-social-links li a:hover, .gt-header.gt-style-3 .gt-elements .gt-social-links li a:focus, .gt-header.gt-style-3 .gt-navbar .gt-menu > li a:hover, .gt-header.gt-style-3 .gt-navbar .gt-menu > li a:focus, .gt-header.gt-style-5 .gt-elements .gt-social-links li a:hover, .gt-header.gt-style-5 .gt-elements .gt-social-links li a:focus, .gt-header.gt-style-5 .gt-navbar .gt-menu li .gt-dropdown-menu li a:hover, .gt-header.gt-style-5 .gt-navbar .gt-menu li .gt-dropdown-menu li a:focus, .gt-header.gt-style-5 .gt-elements .gt-social-links li a:hover, .gt-header.gt-style-5 .gt-elements .gt-social-links li a:focus, .gt-header.gt-style-5 .gt-navbar .gt-menu > li a:hover, .gt-header.gt-style-5 .gt-navbar .gt-menu > li a:focus, .gt-header.gt-style-1 .gt-navbar .gt-menu > li:hover > a:visited, .gt-header.gt-style-3 .gt-navbar .gt-menu > li:hover > a:visited, .gt-header.gt-style-5 .gt-navbar .gt-menu > li:hover > a:visited, .gt-sticky-header .gt-elements .gt-social-links li a:hover, .gt-sticky-header .gt-elements .gt-social-links li a:focus, .gt-sticky-header .gt-navbar .gt-menu li .gt-dropdown-menu li a:hover, .gt-sticky-header .gt-navbar .gt-menu li .gt-dropdown-menu li a:focus, .gt-sticky-header .gt-elements .gt-social-links li a:hover, .gt-sticky-header .gt-elements .gt-social-links li a:focus, .gt-sticky-header .gt-navbar .gt-menu > li a:hover, .gt-sticky-header .gt-navbar .gt-menu > li a:focus, .gt-sticky-header .gt-navbar .gt-menu > li:hover > a, .gt-sticky-header .gt-navbar .gt-menu > li:hover > a:visited .gt-sticky-header .gt-navbar .gt-menu > li:focus > a, .gt-sticky-header .gt-navbar .gt-menu > li:focus > a:visited', 'color', '' );

		/*====== Secondary Background ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'theme_alternative_color', '.gt-header.gt-style-1 .gt-elements .gt-user-box, .gt-header.gt-style-3 .gt-elements .gt-user-box, .gt-header.gt-style-5 .gt-elements .gt-user-box, .gt-sticky-header .gt-elements .gt-user-box, .gt-countdown-slider.gt-style-1 > .gt-counter:before', 'background', '' );

		/*====== Secondary Border Top Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'theme_alternative_color', '.gt-header.gt-style-1 .gt-navbar .gt-menu li .gt-dropdown-menu, .gt-header.gt-style-3 .gt-navbar .gt-menu li .gt-dropdown-menu, .gt-header.gt-style-5 .gt-navbar .gt-menu li .gt-dropdown-menu, .gt-sticky-header .gt-navbar .gt-menu li .gt-dropdown-menu', 'border-top-color', '' );

		/*====== Theme Gradient ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'theme_gradient', '.gt-speaker.gt-style-2 .gt-content, .gt-banner-box a:before, .gt-banner-box a:visited:before', 'gradient', '' );

		/*====== Link Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'link_color', 'a, a:visited', 'color', '' );

		/*====== Link Hover Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'link_hover_color', 'a:hover, a:focus', 'color', '' );

		/*====== Heading Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'heading_color', 'h1, h2, h3, h4, h5, h6', 'color', '' );

		/*====== Input Border Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'input_border_color', 'input[type="email"], input[type="number"], input[type="password"], input[type="tel"], input[type="url"], input[type="text"], input[type="time"], input[type="week"], input[type="search"], input[type="month"], input[type="datetime"], input[type="date"], textarea, textarea.form-control, select, .woocommerce form .form-row .select2-container .select2-choice, .upload-input, .select2-dropdown, .select2-search--dropdown .select2-search__field, .select2-container--default .select2-search--dropdown .select2-search__field, .select2-container--default .select2-selection--single, #add_payment_method table.cart td.actions .coupon .input-text, .woocommerce-cart table.cart td.actions .coupon .input-text, .woocommerce-checkout table.cart td.actions .coupon .input-text, .form-control, .bootstrap-select.gt-select > button', 'border-color', '' );

		/*====== Input Background Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'input_background_color', 'input[type="email"], input[type="number"], input[type="password"], input[type="tel"], input[type="url"], input[type="text"], input[type="time"], input[type="week"], input[type="search"], input[type="month"], input[type="datetime"], input[type="date"], textarea, textarea.form-control, select, .woocommerce form .form-row .select2-container .select2-choice, .upload-input, .select2-dropdown, .select2-search--dropdown .select2-search__field, .select2-container--default .select2-search--dropdown .select2-search__field, .select2-container--default .select2-selection--single, #add_payment_method table.cart td.actions .coupon .input-text, .woocommerce-cart table.cart td.actions .coupon .input-text, .woocommerce-checkout table.cart td.actions .coupon .input-text, .form-control, .bootstrap-select.gt-select > button', 'background-color', '' );

		/*====== Input Text Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'input_text_color', 'input[type="email"], input[type="number"], input[type="password"], input[type="tel"], input[type="url"], input[type="text"], input[type="time"], input[type="week"], input[type="search"], input[type="month"], input[type="datetime"], input[type="date"], textarea, textarea.form-control, select, .woocommerce form .form-row .select2-container .select2-choice, .upload-input, .select2-dropdown, .select2-search--dropdown .select2-search__field, .select2-container--default .select2-search--dropdown .select2-search__field, .select2-container--default .select2-selection--single, #add_payment_method table.cart td.actions .coupon .input-text, .woocommerce-cart table.cart td.actions .coupon .input-text, .woocommerce-checkout table.cart td.actions .coupon .input-text, .form-control, .bootstrap-select.gt-select > button', 'color', '' );

		/*====== Input Placeholder Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'input_placeholder_color', 'input::-webkit-input-placeholder', 'color', '' );

		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'input_placeholder_color', 'input::-moz-placeholder', 'color', '' );

		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'input_placeholder_color', 'input:-ms-input-placeholder', 'color', '' );

		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'input_placeholder_color', 'input:-moz-placeholder', 'color', '' );

		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'input_placeholder_color', 'textarea::-webkit-input-placeholder', 'color', '' );

		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'input_placeholder_color', 'textarea::-moz-placeholder', 'color', '' );

		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'input_placeholder_color', 'textarea:-ms-input-placeholder', 'color', '' );

		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'input_placeholder_color', 'textarea:-moz-placeholder', 'color', '' );

		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'input_placeholder_color', 'select::-webkit-input-placeholder', 'color', '' );

		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'input_placeholder_color', 'select::-moz-placeholder', 'color', '' );

		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'input_placeholder_color', 'select:-ms-input-placeholder', 'color', '' );

		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'input_placeholder_color', 'select:-moz-placeholder', 'color', '' );

		/*====== Button Background Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'button_background_color', '.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, button, input[type="submit"]', 'background-color', '' );

		/*====== Button Border Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'button_background_color', '.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, button, input[type="submit"]', 'border-color', '' );

		/*====== Button Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'button_text_color', '.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, button, input[type="submit"]', 'color', '' );

		/*====== Button Hover Background Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'button_hover_background_color', '.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, button:hover, input[type="submit"]:hover, button:active, input[type="submit"]:active, button:active:hover, input[type="submit"]:active:hover, button:active:focus, input[type="submit"]:active:focus, button:active:visited, input[type="submit"]:active:visited, button:focus, input[type="submit"]:focus', 'background-color', '' );

		/*====== Input Hover Border Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'button_hover_background_color', '.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, button:hover, input[type="submit"]:hover, button:active, input[type="submit"]:active, button:active:hover, input[type="submit"]:active:hover, button:active:focus, input[type="submit"]:active:focus, button:active:visited, input[type="submit"]:active:visited, button:focus, input[type="submit"]:focus', 'border-color', '' );

		/*====== Button Hover Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'button_hover_text_color', '.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, button:hover, input[type="submit"]:hover, button:active, input[type="submit"]:active, button:active:hover, input[type="submit"]:active:hover, button:active:focus, input[type="submit"]:active:focus, button:active:visited, input[type="submit"]:active:visited, button:focus, input[type="submit"]:focus', 'color', '' );

		/*====== Footer Style 1 Background Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'footer_style_1_background', '.gt-footer.gt-style-1', 'background-color', '' );

		/*====== Footer Style 1 Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'footer_style_1_text_color', '.gt-footer.gt-style-1, .gt-footer.gt-style-1 .gt-app-box .gt-item i', 'color', '' );

		/*====== Footer Style 1 Link Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'footer_style_1_link_color', '.gt-footer.gt-style-1 a, .gt-footer.gt-style-1 a:visited, .gt-footer.gt-style-1 .widget_nav_menu li a, .gt-footer.gt-style-1 .widget_nav_menu li a:visited, .gt-footer.gt-style-1 .gt-social-links-element.gt-style-7 ul li a, .gt-footer.gt-style-1 .gt-social-links-element.gt-style-7 ul li a:visited, .gt-footer.gt-style-1 .gt-app-box .gt-item a:hover, .gt-footer.gt-style-1 .gt-app-box .gt-item a:focus, .gt-footer.gt-style-1 .gt-app-box .gt-item a:hover i, .gt-footer.gt-style-1 .gt-app-box .gt-item a:focus i, .gt-footer.gt-style-1 .gt-post-style-3 .gt-information, .gt-footer.gt-style-1 .gt-post-style-3 .gt-information > div a, .gt-footer.gt-style-1 .gt-post-style-3 .gt-information > div a:visited, .gt-footer.gt-style-1 .widget_nav_menu li, .gt-footer.gt-style-1 .post-list-style-3 .title a, .gt-footer.gt-style-1 .post-list-style-3 .title a:visited, .gt-footer.gt-style-1 .gt-post-style-3 .gt-information', 'color', '' );

		/*====== Footer Style Link Hover Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'footer_style_1_link_hover_color', '.gt-footer.gt-style-1 .gt-social-links-element.gt-style-6 ul li a:hover, .gt-footer.gt-style-1 .gt-social-links-element.gt-style-6 ul li a:focus, .gt-footer.gt-style-1 a:hover, .gt-footer.gt-style-1 a:focus, .gt-footer.gt-style-1 .post-list-style-3 .title a:hover, .gt-footer.gt-style-1 .post-list-style-3 .title a:focus', 'color', '' );

		/*====== Footer Style 1 Copyright Text Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'footer_style_1_copyright_text_color', '.gt-footer.gt-style-1 .gt-copyright', 'color', '' );

		/*====== Footer Style 2 Background Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'footer_style_2_background', '.gt-footer.gt-style-2', 'background-color', '' );

		/*====== Footer Style 2 Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'footer_style_2_text_color', '.gt-footer.gt-style-2, .gt-footer.gt-style-2 .gt-app-box .gt-item i', 'color', '' );

		/*====== Footer Style 2 Link Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'footer_style_2_link_color', '.gt-footer.gt-style-2 a, .gt-footer.gt-style-2 a:visited, .gt-footer.gt-style-2 .widget_nav_menu li a, .gt-footer.gt-style-2 .widget_nav_menu li a:visited, .gt-footer.gt-style-2 .gt-social-links-element.gt-style-7 ul li a, .gt-footer.gt-style-2 .gt-social-links-element.gt-style-7 ul li a:visited, .gt-footer.gt-style-2 .gt-app-box .gt-item a:hover, .gt-footer.gt-style-2 .gt-app-box .gt-item a:focus, .gt-footer.gt-style-2 .gt-app-box .gt-item a:hover i, .gt-footer.gt-style-2 .gt-app-box .gt-item a:focus i, .gt-footer.gt-style-2 .gt-post-style-3 .gt-information, .gt-footer.gt-style-2 .gt-post-style-3 .gt-information > div a, .gt-footer.gt-style-2 .gt-post-style-3 .gt-information > div a:visited, .gt-footer.gt-style-2 .widget_nav_menu li, .gt-footer.gt-style-2 .post-list-style-3 .title a, .gt-footer.gt-style-2 .post-list-style-3 .title a:visited, .gt-footer.gt-style-2 .gt-post-style-3 .gt-information', 'color', '' );

		/*====== Footer Style 2 Link Hover Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'footer_style_2_link_hover_color', '.gt-footer.gt-style-2 .gt-social-links-element.gt-style-6 ul li a:hover, .gt-footer.gt-style-2 .gt-social-links-element.gt-style-6 ul li a:focus, .gt-footer.gt-style-2 a:hover, .gt-footer.gt-style-2 a:focus, .gt-footer.gt-style-2 .post-list-style-3 .title a:hover, .gt-footer.gt-style-2 .post-list-style-3 .title a:focus', 'color', '' );

		/*====== Footer Style 2 Copyright Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'footer_style_2_copyright_text_color', '.gt-footer.gt-style-2 .gt-copyright', 'color', '' );

		/*====== Sidebar Widget Background Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'sidebar_widget_background_color', '.gt-widget', 'background-color', '' );

		/*====== Sidebar Widget Title Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'sidebar_widget_title_color', '.gt-widget-title', 'color', '' );

		/*====== Sidebar Widget Title Border Bottom Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'sidebar_widget_title_border_color', '.gt-widget-title', 'border-bottom-color', '' );

		/*====== Header Style 1 Background ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_1_background_color', '.gt-header.gt-style-1', 'background-all', '' );

		/*====== Header Style 1 Link Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_1_link_color', '.gt-header.gt-style-1 .gt-navbar .gt-menu > li > a, .gt-header.gt-style-1 .gt-navbar .gt-menu > li > a:visited', 'color', '' );

		/*====== Header Style 1 Link Hover Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_1_link_hover_color', '.gt-header.gt-style-1 .gt-navbar .gt-menu > li > a:hover, .gt-header.gt-style-1 .gt-navbar .gt-menu > li > a:focus, .gt-header.gt-style-1 .gt-navbar .gt-menu > li:hover > a, .gt-header.gt-style-1 .gt-navbar .gt-menu > li:hover > a:visited', 'color', '' );

		/*====== Header Style 1 Social Links Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_1_social_links_color', '.gt-header.gt-style-1 .gt-elements .gt-social-links li a, .gt-header.gt-style-1 .gt-elements .gt-social-links li a:visited', 'color', '' );

		/*====== Header Style 1 Social Links Hover Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_1_social_links_hover_color', '.gt-header.gt-style-1 .gt-elements .gt-social-links li a:hover, .gt-header.gt-style-1 .gt-elements .gt-social-links li a:focus', 'color', '' );

		/*====== Header Style 2 Background ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_2_background_color', '.gt-header.gt-style-1.gt-style-2', 'background-all', '' );

		/*====== Header Style 2 Link Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_2_link_color', '.gt-header.gt-style-1.gt-style-2 .gt-navbar .gt-menu > li > a, .gt-header.gt-style-1.gt-style-2 .gt-navbar .gt-menu > li > a:visited', 'color', '' );

		/*====== Header Style 2 Link Hover Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_2_link_hover_color', '.gt-header.gt-style-1.gt-style-2 .gt-navbar .gt-menu > li > a:hover, .gt-header.gt-style-1.gt-style-2 .gt-navbar .gt-menu > li > a:focus, .gt-header.gt-style-1.gt-style-2 .gt-navbar .gt-menu > li:hover > a, .gt-header.gt-style-1.gt-style-2 .gt-navbar .gt-menu > li:hover > a:visited', 'color', '' );

		/*====== Header Style 2 Social Links Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_2_social_links_color', '.gt-header.gt-style-1.gt-style-2 .gt-elements .gt-social-links li a, .gt-header.gt-style-1.gt-style-2 .gt-elements .gt-social-links li a:visited', 'color', '' );

		/*====== Header Style 2 Social Links Hover Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_2_social_links_hover_color', '.gt-header.gt-style-1.gt-style-2 .gt-elements .gt-social-links li a:hover, .gt-header.gt-style-1.gt-style-2 .gt-elements .gt-social-links li a:focus', 'color', '' );

		/*====== Header Style 3 Background ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_3_background_color', '.gt-header.gt-style-3', 'background-all', '' );

		/*====== Header Style 3 Link Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_3_link_color', '.gt-header.gt-style-3 .gt-navbar .gt-menu > li > a, .gt-header.gt-style-3 .gt-navbar .gt-menu > li > a:visited', 'color', '' );

		/*====== Header Style 3 Link Hover Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_3_link_hover_color', '.gt-header.gt-style-3 .gt-navbar .gt-menu > li > a:hover, .gt-header.gt-style-3 .gt-navbar .gt-menu > li > a:focus, .gt-header.gt-style-3 .gt-navbar .gt-menu > li:hover > a, .gt-header.gt-style-3 .gt-navbar .gt-menu > li:hover > a:visited', 'color', '' );

		/*====== Header Style 3 Social Links Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_3_social_links_color', '.gt-header.gt-style-3 .gt-elements .gt-social-links li a, .gt-header.gt-style-3 .gt-elements .gt-social-links li a:visited', 'color', '' );

		/*====== Header Style 3 Social Links Hover Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_3_social_links_hover_color', '.gt-header.gt-style-3 .gt-elements .gt-social-links li a:hover, .gt-header.gt-style-3 .gt-elements .gt-social-links li a:focus', 'color', '' );

		/*====== Header Style 4 Background ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_4_background_color', '.gt-header.gt-style-3.gt-style-4', 'background-all', '' );

		/*====== Header Style 4 Link Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_4_link_color', '.gt-header.gt-style-3.gt-style-4 .gt-navbar .gt-menu > li > a, .gt-header.gt-style-3.gt-style-4 .gt-navbar .gt-menu > li > a:visited', 'color', '' );

		/*====== Header Style 4 Link Hover Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_4_link_hover_color', '.gt-header.gt-style-3.gt-style-4 .gt-navbar .gt-menu > li > a:hover, .gt-header.gt-style-3.gt-style-4 .gt-navbar .gt-menu > li > a:focus, .gt-header.gt-style-3.gt-style-4 .gt-navbar .gt-menu > li:hover > a, .gt-header.gt-style-3.gt-style-4 .gt-navbar .gt-menu > li:hover > a:visited', 'color', '' );

		/*====== Header Style 4 Social Links Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_4_social_links_color', '.gt-header.gt-style-3.gt-style-4 .gt-elements .gt-social-links li a, .gt-header.gt-style-3.gt-style-4 .gt-elements .gt-social-links li a:visited', 'color', '' );

		/*====== Header Style 4 Social Links Hover Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_4_social_links_hover_color', '.gt-header.gt-style-3.gt-style-4 .gt-elements .gt-social-links li a:hover, .gt-header.gt-style-3.gt-style-4 .gt-elements .gt-social-links li a:focus', 'color', '' );

		/*====== Header Style 5 Background ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_5_background_color', '.gt-header.gt-style-5', 'background-all', '' );

		/*====== Header Style 5 Link Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_5_link_color', '.gt-header.gt-style-5 .gt-navbar .gt-menu > li > a, .gt-header.gt-style-5 .gt-navbar .gt-menu > li > a:visited', 'color', '' );

		/*====== Header Style 5 Link Hover Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_5_link_hover_color', '.gt-header.gt-style-5 .gt-navbar .gt-menu > li > a:hover, .gt-header.gt-style-5 .gt-navbar .gt-menu > li > a:focus, .gt-header.gt-style-5 .gt-navbar .gt-menu > li:hover > a, .gt-header.gt-style-5 .gt-navbar .gt-menu > li:hover > a:visited', 'color', '' );

		/*====== Header Style 5 Social Links Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_5_social_links_color', '.gt-header.gt-style-5 .gt-elements .gt-social-links li a, .gt-header.gt-style-5 .gt-elements .gt-social-links li a:visited', 'color', '' );

		/*====== Header Style 5 Social Links Hover Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_5_social_links_hover_color', '.gt-header.gt-style-5 .gt-elements .gt-social-links li a:hover, .gt-header.gt-style-5 .gt-elements .gt-social-links li a:focus', 'color', '' );

		/*====== Header Style 6 Background ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_6_background_color', '.gt-header.gt-style-5.gt-style-6', 'background-all', '' );

		/*====== Header Style 6 Link Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_6_link_color', '.gt-header.gt-style-5.gt-style-6 .gt-navbar .gt-menu > li > a, .gt-header.gt-style-5.gt-style-6 .gt-navbar .gt-menu > li > a:visited', 'color', '' );

		/*====== Header Style 6 Link Hover Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_6_link_hover_color', '.gt-header.gt-style-5.gt-style-6 .gt-navbar .gt-menu > li > a:hover, .gt-header.gt-style-5.gt-style-6 .gt-navbar .gt-menu > li > a:focus, .gt-header.gt-style-5.gt-style-6 .gt-navbar .gt-menu > li:hover > a, .gt-header.gt-style-5.gt-style-6 .gt-navbar .gt-menu > li:hover > a:visited', 'color', '' );

		/*====== Header Style 6 Social Links Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_6_social_links_color', '.gt-header.gt-style-5.gt-style-6 .gt-elements .gt-social-links li a, .gt-header.gt-style-5.gt-style-6 .gt-elements .gt-social-links li a:visited', 'color', '' );

		/*====== Header Style 6 Social Links Hover Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'header_style_6_social_links_hover_color', '.gt-header.gt-style-5.gt-style-6 .gt-elements .gt-social-links li a:hover, .gt-header.gt-style-5.gt-style-6 .gt-elements .gt-social-links li a:focus', 'color', '' );

		/*====== Sticky Header Background ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'sticky_header_background', '.gt-sticky-header', 'background-all', '' );

		/*====== Sticky Header Link Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'sticky_header_link_color', '.gt-sticky-header .gt-navbar .gt-menu > li > a, .gt-sticky-header .gt-navbar .gt-menu > li > a:visited', 'color', '' );

		/*====== Sticky Header Link Hover Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'sticky_header_link_hover_color', '.gt-sticky-header .gt-navbar .gt-menu > li > a:hover, .gt-sticky-header .gt-navbar .gt-menu > li > a:focus, .gt-sticky-header .gt-navbar .gt-menu > li:hover > a, .gt-sticky-header .gt-navbar .gt-menu > li:hover > a:visited .gt-sticky-header .gt-navbar .gt-menu > li:focus > a, .gt-sticky-header .gt-navbar .gt-menu > li:focus > a:visited', 'color', '' );

		/*====== Sticky Header Social Links Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'sticky_header_social_links_color', '.gt-sticky-header .gt-elements .gt-social-links li a, .gt-sticky-header .gt-elements .gt-social-links li a:visited', 'color', '' );

		/*====== Sticky Header Social Links Hover Color ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'sticky_header_social_links_hover_color', '.gt-sticky-header .gt-elements .gt-social-links li a:hover, .gt-sticky-header .gt-elements .gt-social-links li a:focus', 'color', '' );

		/*====== Footer Style 1 Background ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'eventchamp_footer_bg_style_1', '.gt-footer.gt-style-1', 'background-all', '' );

		/*====== Footer Style 2 Background ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'eventchamp_footer_bg_style_2', '.gt-footer.gt-style-2', 'background-all', '' );

		/*====== Page Title Bar Background ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'page_title_background', '.gt-page-title-bar .gt-background', 'background-all', '' );

		/*====== Page Title Bar Opacity ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'page_title_background_opacity', '.gt-page-title-bar .gt-background', 'opacity', '' );

		/*====== Page Title Bar Top Padding ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'page_title_bar_top_padding', '.gt-page-title-bar', 'top-padding', '' );

		/*====== Page Title Bar Bottom Padding ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'page_title_bar_bottom_padding', '.gt-page-title-bar', 'bottom-padding', '' );

		/*====== Color Reset ======*/
		$theme_primary_color = ot_get_option( 'theme_main_color' );
		$theme_secondary_color = ot_get_option( 'theme_alternative_color' );

		if( !empty( $theme_primary_color ) or !empty( $theme_primary_color ) ) {

			$eventchamp_custom_css .= ".woocommerce .woocommerce-MyAccount-navigation ul li a:hover, .woocommerce .woocommerce-MyAccount-navigation ul li a:focus, .woocommerce .woocommerce-MyAccount-navigation ul li.is-active a, .woocommerce .woocommerce-MyAccount-navigation ul li.is-active a:visited, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a:visited, .gt-event-schedule.gt-style-1 .gt-dropdown .gt-panel-body .gt-schedule-speakers .gt-list ul li a:hover, .gt-event-schedule.gt-style-1 .gt-dropdown .gt-panel-body .gt-schedule-speakers .gt-list ul li a:focus, .gt-event-schedule.gt-style-2 .gt-dropdown .gt-panel-body .gt-schedule-speakers .gt-list ul li a:hover, .gt-event-schedule.gt-style-2 .gt-dropdown .gt-panel-body .gt-schedule-speakers .gt-list ul li a:focus, .gt-event-schedule.gt-style-3 .gt-dropdown .gt-panel-body .gt-schedule-speakers .gt-list ul li a:hover, .gt-event-schedule.gt-style-3 .gt-dropdown .gt-panel-body .gt-schedule-speakers .gt-list ul li a:focus, .gt-event-schedule.gt-style-4 > .gt-item > ul > li .gt-content .gt-schedule-speakers .gt-list ul a:hover, .gt-event-schedule.gt-style-4 > .gt-item > ul > li .gt-content .gt-schedule-speakers .gt-list ul li a:focus, .gt-event-schedule.gt-style-5 > .gt-item > ul > li .gt-content .gt-schedule-speakers .gt-list ul a:hover, .gt-event-schedule.gt-style-5 > .gt-item > ul > li .gt-content .gt-schedule-speakers .gt-list ul li a:focus, .gt-event-schedule.gt-style-6 > .gt-item > ul > li .gt-content .gt-schedule-speakers .gt-list ul a:hover, .gt-event-schedule.gt-style-6 > .gt-item > ul > li .gt-content .gt-schedule-speakers .gt-list ul li a:focus, .gt-organizers.gt-style-1 ul li a:hover, .gt-organizers.gt-style-1 ul li a:focus, .gt-organizers.gt-style-2 ul li a:hover, .gt-organizers.gt-style-2 ul li a:focus, .gt-tags.gt-style-1 ul li a:hover, .gt-tags.gt-style-1 ul li a:focus, .gt-tags.gt-style-2 ul li a:hover, .gt-tags.gt-style-2 ul li a:focus, .gt-categories.gt-style-1 ul li a:hover, .gt-categories.gt-style-1 ul li a:focus, .gt-categories.gt-style-2 ul li a:hover, .gt-categories.gt-style-2 ul li a:focus, .gt-venues-carousel .gt-all-button:hover, .gt-venues-carousel .gt-all-button:focus, .widget_tag_cloud .tagcloud a:hover, .widget_tag_cloud .tagcloud a:focus { color: #FFFFFF; } .fc-state-default:hover, .fc-state-default:focus, .fc button:hover, .fc button:focus, .gt-post-style-1 .gt-bottom .gt-more:hover, .gt-post-style-1 .gt-bottom .gt-more:focus, .gt-post-style-2 .gt-bottom .gt-more:hover, .gt-post-style-2 .gt-bottom .gt-more:focus, .gt-pagination ul li > span.current, .gt-pagination ul li > a:hover, .gt-pagination ul li > a:focus, .gt-post-pagination ul li a:hover, .gt-post-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li a:focus, .gt-event-buttons ul li a:hover, .gt-event-buttons ul li a:focus, .gt-event-schedule.gt-style-2 .gt-schedule-tabs > li > a.active, .gt-event-schedule.gt-style-2 .gt-schedule-tabs > li > a.active:visited, .gt-event-schedule.gt-style-2 .gt-schedule-tabs > li > a:hover, .gt-event-schedule.gt-style-2 .gt-schedule-tabs > li > a:focus, .gt-detail-widget > ul > li.button-content a:hover, .gt-detail-widget > ul > li.button-content a:focus, .gt-categorized-contents .gt-nav > li > a.active, .gt-categorized-contents .gt-nav > li > a.active:visited, .gt-categorized-contents .gt-nav > li > a:hover, .gt-categorized-contents .gt-nav > li > a:focus, .gt-button.gt-style-3 a:hover, .gt-button.gt-style-3 a:focus, .gt-button.gt-style-2 a:hover, .gt-button.gt-style-2 a:focus, .gt-button.gt-style-1 a:hover, .gt-button.gt-style-1 a:focus { background: transparent; }";

		}

		/*====== Box Layout ======*/
		$box_layout = ot_get_option( 'eventchamp_box_layout', 'on' );

		if( $box_layout == 'off' ) {

			$eventchamp_custom_css .= ".gt-section, .gt-event-section-tabs, .gt-page-content {background: transparent !important;}";

			$eventchamp_custom_css .= ".gt-section, .gt-event-section-tabs, .gt-page-content {padding: 0;}";

			$eventchamp_custom_css .= ".gt-content-header.gt-image, .gt-event-section-tabs .gt-event-tabs, .gt-section .gt-section-title {margin-top:0;margin-left:0;margin-right:0;}";

			$eventchamp_custom_css .= ".gt-event-schedule.gt-style-1 .gt-schedule-tabs {margin-left:0;margin-right:0;}";

		}

		/*====== Custom CSS ======*/
		if ( is_page() ) {

			$header_style = get_post_meta( get_the_ID(), 'header_layout_select', true );

			if( empty( $header_style ) or $header_style == "default" ) {

				$header_style = ot_get_option( 'header_layout_select' , 'header-style-1' );

			}

		} else {

			$header_style = ot_get_option( 'header_layout_select', 'header-style-1' );

		}

		if( $header_style == "header-style-2" ) {

			$eventchamp_custom_css .= "@media (min-width: 1200px) {.gt-page-title-bar {margin-top: 0; padding-top: 200px;}}";

		}

		if( $header_style == "header-style-4" ) {

			$eventchamp_custom_css .= "@media (min-width: 1200px) {.gt-page-title-bar {margin-top: 0; padding-top: 200px;}}";

		}

		if( $header_style == "header-style-6" ) {

			$eventchamp_custom_css .= "@media (min-width: 1200px) {.gt-page-title-bar {margin-top: 0; padding-top: 200px;}}";

		}

		/*====== Page Custom Page Title Bar Background ======*/
		if( is_page() ) {

			$wrapper_bg = get_post_meta( get_the_ID(), 'wrapper_bg', true );

			if( !empty( $wrapper_bg ) ) {

				$eventchamp_custom_css .= '.gt-site-wrapper{background: ' . esc_attr( $wrapper_bg ) . ';}';

			}

		}

		/*====== Custom CSS ======*/
		$eventchamp_custom_css .= $eventchamp_typgraphy_array->eventchamp_css_echo( 'custom_css', '', 'css-codes', '' );
		
		/*====== Output ======*/
		wp_add_inline_style( 'eventchamp-main', $eventchamp_custom_css );

		/*====== Custom Scripts ======*/
		$custom_js = ot_get_option( 'custom_js' );

		if( !empty( $custom_js ) ) {

			wp_add_inline_script( "eventchamp", "jQuery(document).ready(function($){
				" . ot_get_option( 'custom_js' ) . "
			});" );

		}

		/*====== Event Starting Time Script ======*/
		if( is_single() ) {

			$event_start_date = get_post_meta( get_the_ID(), 'event_start_date', true );
			$event_start_time = get_post_meta( get_the_ID(), 'event_start_time', true );

			if( !empty( $event_start_date ) and !empty( $event_start_time ) ) {

				wp_add_inline_script( "eventchamp", "jQuery(document).ready(function($){
					$('.gt-event-starting-time').countdown('" . date( 'Y/m/d H:i:s', strtotime( $event_start_date . $event_start_time ) ) . "', function(event) {
						$('.gt-days .gt-count').html(event.strftime('%D'));
						$('.gt-hours .gt-count').html(event.strftime('%H'));
						$('.gt-minutes .gt-count').html(event.strftime('%M'));
						$('.gt-secondes .gt-count').html(event.strftime('%S'));
					});
				});" );

			}

		}

		/*====== Flex Menu for Event Tabs ======*/
		$flex_menu_single_events = ot_get_option( 'flex-menu-single-events', 'on' );

		if( $flex_menu_single_events == 'on' ) {

			if( is_singular( 'event' ) ) {

				wp_add_inline_script( "eventchamp", "jQuery(document).ready(function($){
					$('.gt-event-section-tabs > .gt-event-tabs').flexMenu({
						linkText:'" . esc_html__( 'More', 'eventchamp' ) . "',
						linkTitle:'" . esc_html__( 'View More', 'eventchamp' ) . "',
						linkTextAll:'" . esc_html__( 'Menu', 'eventchamp' ) . "',
						linkTitleAll:'" . esc_html__( 'Open/Close Menu', 'eventchamp' ) . "',
						popupClass: 'gt-flex-menu',
					});
				});" );

			}

		}

		/*====== Flex Menu for Categorized Events ======*/
		$flex_menu_categorized_events = ot_get_option( 'flex-menu-categorized-events', 'on' );

		if( $flex_menu_categorized_events == 'on' ) {

			wp_add_inline_script( "eventchamp", "jQuery(document).ready(function($){
				$('.gt-categorized-contents .gt-nav').flexMenu({
					linkText:'" . esc_html__( 'More', 'eventchamp' ) . "',
					linkTitle:'" . esc_html__( 'View More', 'eventchamp' ) . "',
					linkTextAll:'" . esc_html__( 'Menu', 'eventchamp' ) . "',
					linkTitleAll:'" . esc_html__( 'Open/Close Menu', 'eventchamp' ) . "',
					popupClass: 'gt-flex-menu',
				});
			});" );

		}

		/*====== Flex Menu for Schedule ======*/
		$flex_menu_schedule = ot_get_option( 'flex-menu-schedule', 'on' );

		if( $flex_menu_schedule == 'on' ) {

			wp_add_inline_script( "eventchamp", "jQuery(document).ready(function($){
				$('.gt-schedule-tabs').flexMenu({
					linkText:'" . esc_html__( 'More', 'eventchamp' ) . "',
					linkTitle:'" . esc_html__( 'View More', 'eventchamp' ) . "',
					linkTextAll:'" . esc_html__( 'Menu', 'eventchamp' ) . "',
					linkTitleAll:'" . esc_html__( 'Open/Close Menu', 'eventchamp' ) . "',
					popupClass: 'gt-flex-menu',
				});
			});" );

		}

	}
	add_action( 'wp_enqueue_scripts', 'eventchamp_customize' );

}
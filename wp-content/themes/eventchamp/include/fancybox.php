<?php
/*======
*
* Fancybox
*
======*/
if( !function_exists( 'eventchamp_fancybox' ) ) {

	function eventchamp_fancybox() {

		$fancybox = ot_get_option( 'fancybox', 'on' );

		if( $fancybox == "on" ) {

			wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/include/assets/js/fancybox.min.js', array(), false, true );
			wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/include/assets/css/fancybox.min.css' );

			$local_code = substr( get_locale(), 0, 2 );

			$fancybox_loop = ot_get_option( 'fancybox-loop', 'true' );
			$fancybox_keyboard = ot_get_option( 'fancybox-keyboard-control', 'true' );
			$fancybox_infobar = ot_get_option( 'fancybox-infobar', 'true' );
			$fancybox_animation_effect = ot_get_option( 'fancybox-animation-effect', 'fade' );
			$fancybox_animation_duration = ot_get_option( 'fancybox-animation-duration', '366' );
			$fancybox_transition_effect = ot_get_option( 'fancybox-transition-effect', 'fade' );
			$fancybox_transition_duration = ot_get_option( 'fancybox-transition-duration', '366' );
			$fancybox_zoom_button = ot_get_option( 'fancybox-zoom-button', 'on' );
			$fancybox_share_button = ot_get_option( 'fancybox-social-sharing-button', 'on' );
			$fancybox_slideshow_button = ot_get_option( 'fancybox-slideshow-button', 'on' );
			$fancybox_slideshow_button = ot_get_option( 'fancybox-slideshow-button', 'on' );
			$fancybox_slideshow_auto_start = ot_get_option( 'fancybox-slideshow-auto-start', 'true' );
			$fancybox_slideshow_speed = ot_get_option( 'fancybox-slideshow-speed', '3000' );
			$fancybox_fullscreen_button = ot_get_option( 'fancybox-fullscreen-button', 'on' );
			$fancybox_download_button = ot_get_option( 'fancybox-download-button', 'on' );
			$fancybox_thumbs_button = ot_get_option( 'fancybox-thumbs-button', 'on' );
			$fancybox_thumbs_button_auto_start = ot_get_option( 'fancybox-thumbs-auto-start', 'true' );
			$fancybox_close_button = ot_get_option( 'fancybox-close-button', 'on' );

			$fancybox_buttons = '';

			if( $fancybox_zoom_button == "on" ) {

				$fancybox_buttons .= '"zoom",';

			}

			if( $fancybox_share_button == "on" ) {

				$fancybox_buttons .= '"share",';

			}

			if( $fancybox_slideshow_button == "on" ) {

				$fancybox_buttons .= '"slideShow",';

			}

			if( $fancybox_fullscreen_button == "on" ) {

				$fancybox_buttons .= '"fullScreen",';

			}

			if( $fancybox_download_button == "on" ) {

				$fancybox_buttons .= '"download",';

			}

			if( $fancybox_thumbs_button == "on" ) {

				$fancybox_buttons .= '"thumbs",';

			}

			if( $fancybox_close_button == "on" ) {

				$fancybox_buttons .= '"close",';

			}

			$fancybox_custom = "$('[data-fancybox]').fancybox({
				loop: " . esc_attr( $fancybox_loop ) . ",
				keyboard: " . esc_attr( $fancybox_keyboard ) . ",
				infobar: " . esc_attr( $fancybox_infobar ) . ",
				animationEffect: '" . esc_attr( $fancybox_animation_effect ) . "',
				animationDuration: " . esc_attr( $fancybox_animation_duration ) . ",
				transitionEffect: '" . esc_attr( $fancybox_transition_effect ) . "',
				transitionDuration: " . esc_attr( $fancybox_transition_duration ) . ",
				slideShow: {
					autoStart: " . esc_attr( $fancybox_slideshow_auto_start ) . ",
					speed: " . esc_attr( $fancybox_slideshow_speed ) . "
				},
				thumbs: {
					autoStart: " . esc_attr( $fancybox_thumbs_button_auto_start ) . ",
					hideOnClose: true,
					parentEl: '.fancybox-container',
					axis: 'y',
				},
				buttons: [
					" . $fancybox_buttons . "
				],
				share: {
					url: function(instance, item) {
						return ((!instance.currentHash && !(item.type === 'inline' || item.type === 'html') ? item.origSrc || item.src : false) || window.location);
					},
					tpl: '" . eventchamp_social_share( $style = "style-1" ) . "',
				},
				lang: '" . esc_attr( $local_code ) . "',
				i18n: {
					" . esc_attr( $local_code ) . ": {
						CLOSE: '" . esc_html__( 'Close', 'eventchamp' ) . "',
						NEXT: '" . esc_html__( 'Next', 'eventchamp' ) . "',
						PREV: '" . esc_html__( 'Previous', 'eventchamp' ) . "',
						ERROR: '" . esc_html__( 'The requested content cannot be loaded. Please try again later.', 'eventchamp' ) . "',
						PLAY_START: '" . esc_html__( 'Start slideshow', 'eventchamp' ) . "',
						PLAY_STOP: '" . esc_html__( 'Pause slideshow', 'eventchamp' ) . "',
						FULL_SCREEN: '" . esc_html__( 'Fullscreen', 'eventchamp' ) . "',
						THUMBS: '" . esc_html__( 'Thumbnails', 'eventchamp' ) . "',
						DOWNLOAD: '" . esc_html__( 'Download', 'eventchamp' ) . "',
						SHARE: '" . esc_html__( 'Share', 'eventchamp' ) . "',
						ZOOM: '" . esc_html__( 'Zoom', 'eventchamp' ) . "',
					},
				},
			});";
			wp_add_inline_script( 'fancybox', 'jQuery(document).ready(function($){' . $fancybox_custom . '});' );

		}

	}
	add_action( 'wp_enqueue_scripts', 'eventchamp_fancybox' );

}
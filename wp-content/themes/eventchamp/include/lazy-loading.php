<?php
/*======
*
* Lazy Loading Define Attributes
*
======*/
if( !function_exists( 'gt_lazy_loading_attributes' ) ) {

	function gt_lazy_loading_attributes( $attr, $attachment, $size ) {

		if ( ! is_admin() ) {

			$src_placeholder = 'data:image/svg+xml,%3Csvg%20xmlns%3D%27http://www.w3.org/2000/svg%27%20viewBox%3D%270%200%203%202%27%3E%3C/svg%3E';

			if( isset( $attr['class'] ) and !empty( $attr['class'] ) ) {

				$attr['class'] .= ' gt-lazy-load';

			}

			if( isset( $attr['src'] ) and !empty( $attr['src'] ) ) {

				$attr['data-src'] = $attr['src'];

				$attr['src'] = $src_placeholder;

			}

			if( isset( $attr['srcset'] ) and !empty( $attr['srcset'] ) ) {

				$attr['data-srcset'] = $attr['srcset'];

				unset( $attr['srcset'] );

			}

			if( isset( $attr['sizes'] ) and !empty( $attr['sizes'] ) ) {

				$attr['data-sizes'] = $attr['sizes'];

				unset( $attr['sizes'] );

			}

		}

		return $attr;

	}
	add_filter( 'wp_get_attachment_image_attributes', 'gt_lazy_loading_attributes', 10, 3 );

}



/*======
*
* Lazy Loading Scripts
*
======*/
if( !function_exists( 'eventchamp_lazy_loading_scripts' ) ) {

	function eventchamp_lazy_loading_scripts() {

		wp_enqueue_script( 'lazyload', get_template_directory_uri() . '/include/assets/js/lazyload.min.js', array(), false, true );

	}
	add_action( 'wp_enqueue_scripts', 'eventchamp_lazy_loading_scripts' );

}
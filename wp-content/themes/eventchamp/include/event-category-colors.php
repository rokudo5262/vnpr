<?php
/*======
*
* Event Category Colors Output
*
======*/
if( !function_exists( 'eventchamp_event_category_colors' ) ) {

	function eventchamp_event_category_colors() {

		$category_css = "";
		$terms = get_terms(
			array(
				'taxonomy' => 'eventcat',
				'hide_empty' => false,
				'childless' => false,
			)
		);

		if( !empty( $terms ) ) {

			if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){

				foreach( $terms as $term ) {

					if( !empty( $term ) ) {

						if( !empty( get_term_meta( esc_attr( $term->term_id ), 'category_color', true ) ) ) {

							$category_css .= "ul > li.gt-category-" . esc_attr( $term->term_id ) . "{background-color: " . esc_attr( get_term_meta( esc_attr( $term->term_id ), 'category_color', true ) ) . " !important; color: #FFFFFF !important;}";
							$category_css .= "ul > li > a.gt-category-" . esc_attr( $term->term_id ) . "{background-color: " . esc_attr( get_term_meta( esc_attr( $term->term_id ), 'category_color', true ) ) . " !important; color: #FFFFFF !important;}";

						}

					}

				}

				wp_add_inline_style( 'eventchamp', $category_css );

			}

		}

	}
	add_action( 'wp_enqueue_scripts', 'eventchamp_event_category_colors' );

}
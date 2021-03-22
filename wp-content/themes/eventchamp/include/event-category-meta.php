<?php
/*======
*
* Event Category Colors Meta Fields
*
======*/
if( !function_exists( 'eventchamp_eventcat_edit_settings' ) ) {

	function eventchamp_eventcat_edit_settings( $term, $taxonomy ) {

		echo '<tr class="form-field">';
			echo '<th valign="top">';
				echo '<label>'  . esc_html__( 'Color', 'eventchamp' ) . '</label>';
			echo '</th>';
			echo '<td>';
				echo '<input type="text" name="category_color" class="colorpicker" value="' . esc_attr( get_term_meta( $term->term_id, 'category_color', true ) ) . '">';
				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_script('wp-color-picker');
				echo '<script>
					jQuery(document).ready(function($){
						$(".colorpicker").wpColorPicker();
					});
				</script>';
				echo '<p class="description">' . esc_html__( 'You can choose a color for this category.', 'eventchamp' ) . '</p>';
			echo '</td>';
		echo '</tr>';

	}
	add_action( 'eventcat_edit_form_fields', 'eventchamp_eventcat_edit_settings', 10,2 );

}

if( !function_exists( 'eventchamp_eventcat_settings_save' ) ) {

	function eventchamp_eventcat_settings_save( $term_id, $tt_id, $taxonomy ) {

		if ( isset( $_POST['category_color'] ) ) {

			update_term_meta( $term_id, 'category_color', $_POST['category_color'] );

		}

	}
	add_action( 'edit_term', 'eventchamp_eventcat_settings_save', 10,3 );

}
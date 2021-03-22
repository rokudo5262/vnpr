<?php
/**
 * @version    $Id$
 * @package   ZuFusion Core
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Display taxonomy as hierarchical
 *
 * @param        $taxonomy_args
 * @param array $field_args
 * @param string $type
 * @param string $term_key
 *
 * @return bool|string
 */
function zufusion_taxonomy_field_html( $taxonomy_args, $field_args = array(), $type = 'option', $term_key = 'slug' ) {

	$defaults = array(
		'orderby'      => 'name',
		'order'        => 'ASC',
		'show_count'   => 0,
		'hide_empty'   => 1,
		'child_of'     => 0,
		'feed'         => '',
		'feed_type'    => '',
		'feed_image'   => '',
		'exclude'      => '',
		'exclude_tree' => '',
		'selected'     => 0,
		'hierarchical' => true,
		'depth'        => 0,
		'taxonomy'     => 'category'
	);

	$field_args_default = array(
		'name'       => '',
		'id'         => '',
		'class'      => '',
		'selected'   => '',
		'extra_attr' => '',
		'symbol'     => '&nbsp;&nbsp;',
	);

	$field_args = wp_parse_args( $field_args, $field_args_default );

	$r = wp_parse_args( $taxonomy_args, $defaults );

	$walker = new Zufusion_Taxonomy_Walker ( $r['taxonomy'], $type, $term_key, $field_args );

	if ( ! isset( $r['pad_counts'] ) && $r['show_count'] && $r['hierarchical'] ) {
		$r['pad_counts'] = true;
	}

	if ( true == $r['hierarchical'] ) {
		$r['exclude_tree'] = $r['exclude'];
		$r['exclude']      = '';
	}


	if ( ! taxonomy_exists( $r['taxonomy'] ) ) {
		return false;
	}

	$categories = get_categories( $r );

	$output = '';

	if ( empty( $categories ) ) {

	} else {

		if ( $r['hierarchical'] ) {
			$depth = $r['depth'];
		} else {
			$depth = - 1; // Flat.
		}

		$output .= call_user_func_array( array( $walker, 'walk' ), array( $categories, $depth, $r ) );
	}


	return $output;
}

/**
 * HTML of checkbox
 *
 * @param $value
 * @param $text
 * @param $selected
 * @param $name
 * @param $class
 * @param $extra_attr
 */

function zufusion_checkbox_field_html( $value, $text, $selected, $name, $class, $extra_attr ) {

	$checked = '';
	if ( is_array( $selected ) ) {
		if ( in_array( $value, $selected ) ) {
			$checked = 'checked="checked"';
		} else {
			$checked = '';
		}
	} else {
		$checked = checked( $selected, $value, false );
	}

	return '<div class="checkbox-wrapper"><input type="checkbox" value="' . esc_attr( $value ) . '" name="' . esc_attr( $name ) . '" class="' . esc_attr( $class ) . '" ' . $checked . ' ' . $extra_attr. '><label class="checkbox-label"> ' . esc_html( $text ) . '</label></div>';
}

/**
 * HTML for radio
 *
 * @param $value
 * @param $text
 * @param $selected
 * @param $name
 * @param $class
 */
function zufusion_radio_field_html( $value, $text, $selected, $name, $class ) {

	return '<div class="radio-wrapper"><input type="radio" value="' . esc_attr( $value ) . '" name="' . esc_attr( $name ) . '" class="' . esc_attr( $class ) . '" ' . checked( $selected, $value, false ) . '><label class="radio-label"> ' . esc_html( $text ) . '</label></div>';
}

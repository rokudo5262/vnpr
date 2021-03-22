<?php
/**
 * @version    $Id$
 * @package   ZuFusion Core
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

class Zufusion_Taxonomy_Walker extends Walker {
	/**
	 * Taxonomy type
	 *
	 * @var string
	 */
	public $tree_type = 'category';

	/**
	 * Fields
	 * @var array
	 */
	public $db_fields = array( 'parent' => 'parent', 'id' => 'term_id' );

	/**
	 * @param string $taxonomy
	 * @param string $type may be is option, radio, checkbox
	 * @param string $term_key
	 * @param array $field_args
	 */
	function __construct( $taxonomy = 'category', $type = 'option', $term_key = 'slug', $field_args = array() ) {
		$this->type       = $type;
		$this->tree_type  = $taxonomy;
		$this->term_key   = $term_key;
		$this->field_args = $field_args;
	}

	/**
	 * Start the element output.
	 *
	 * @param string $output Used to append additional content (passed by reference).
	 * @param object $item The data object.
	 * @param int $depth Depth of the item.
	 * @param array $args An array of additional arguments.
	 * @param int $id ID of the current item.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$pad = str_repeat( $this->field_args['symbol'], $depth );

		$item_name = $item->name;
		$value     = $item->{$this->term_key};
		$item_text = $pad . ' ' . $item_name;

		if ( $args['show_count'] ) {
			$item_text .= '&nbsp;<span class="wcf-count-terms">(' . number_format_i18n( $item->count ) . ')</span>';
		}

		$args['selected'] = empty( $args['selected'] ) ? array() : $args['selected'];

		if ( 'option' === $this->type ) {

			$output .= "<option class=\"level-$depth\" value=\"" . esc_attr( $value ) . "\"";

			if ( is_array( $this->field_args['selected'] ) ) {
				if ( in_array( $value, (array) $this->field_args['selected'] ) ) {
					$output .= ' selected="selected"';
				}
			} else {
				if ( $value == $this->field_args['selected'] ) {
					$output .= ' selected="selected"';
				}
			}

			$output .= '>';
			$output .= $item_text;
			$output .= "</option>\n";

		} elseif ( 'radio' === $this->type ) {
			$output .= zufusion_radio_field_html( $value, $item_text, $this->field_args['selected'], $this->field_args['name'], $this->field_args['class'] );
		} elseif ( 'checkbox' === $this->type ) {
			$output .= zufusion_checkbox_field_html( $value, $item_text, $this->field_args['selected'], $this->field_args['name'], $this->field_args['class'], $this->field_args['extra_attr'] );
		}

	}

}

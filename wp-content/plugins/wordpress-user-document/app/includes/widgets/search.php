<?php

/**
 * @version    $Id$
 * @package   WordPress User Document
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

class WUD_Search_Widget extends WP_Widget {

	/**
	 * Sets up a new Tag Cloud widget instance.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'widget_search',
			'description'                 => esc_html__( 'A search form to search documents', 'wud' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'wud_document_search_form', esc_html__( 'WUD - Document Search', 'wud' ), $widget_ops );
	}

	/**
	 * @param $args
	 * @param $instance
	 */
	public function widget( $args, $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_attr__( 'Document Search', 'wud' );


		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo wp_kses_normalize_entities( $args['before_widget'] );

		if ( $title ) {
			echo wp_kses_normalize_entities( $args['before_title'] . $title . $args['after_title'] );
		}

		wud_get_template( 'widgets/search' );

		echo wp_kses_normalize_entities( $args['after_widget'] );

	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance          = array();
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		return $instance;
	}

	/**
	 * Outputs the search from widget settings form.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {

		$title_id          = $this->get_field_id( 'title' );
		$instance['title'] = ! empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

		echo '<p><label for="' . $title_id . '">' . esc_html__( 'Title:' ) . '</label>
			<input type="text" class="widefat" id="' . $title_id . '" name="' . $this->get_field_name( 'title' ) . '" value="' . esc_attr( $instance['title'] ) . '" />
		</p>';

	}

}
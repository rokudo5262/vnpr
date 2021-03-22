<?php

/**
 * @version    $Id$
 * @package   WordPress User Document
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Class WUD_Tags_Widget
 */
class WUD_Tags_Widget extends WP_Widget {

	/**
	 * Sets up a new Tag Cloud widget instance.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'widget_tag_cloud',
			'description'                 => esc_html__( 'A cloud of your most used tags.', 'wud' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'wud_tag_cloud', esc_html__( 'WUD - Document Tag Cloud', 'wud' ), $widget_ops );
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_attr__( 'Tags', 'wud' );

		$show_count = ! empty( $instance['count'] );

		$tag_cloud = wp_tag_cloud(
			apply_filters(
				'wud_widget_tag_cloud_args',
				array(
					'taxonomy'   => 'wud-tag',
					'echo'       => false,
					'show_count' => $show_count,
				),
				$instance
			)
		);

		if ( empty( $tag_cloud ) ) {
			return;
		}

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		echo wp_kses_normalize_entities( $args['before_widget']);

		if ( $title ) {
			echo wp_kses_normalize_entities( $args['before_title'] . $title . $args['after_title'] );
		}

		include wud_get_template( 'widgets/tags', false, false );

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
		$instance['count'] = ! empty( $new_instance['count'] ) ? 1 : 0;

		return $instance;
	}

	/**
	 * Outputs the Tag Cloud widget settings form.
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {

		$title_id          = $this->get_field_id( 'title' );
		$count             = isset( $instance['count'] ) ? (bool) $instance['count'] : false;
		$instance['title'] = ! empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

		echo '<p><label for="' . $title_id . '">' . esc_html__('Title:' ,'wud' ) . '</label>
			<input type="text" class="widefat" id="' . $title_id . '" name="' . $this->get_field_name( 'title' ) . '" value="' . esc_attr( $instance['title'] ). '" />
		</p>';

		$count_checkbox = sprintf(
			'<p><input type="checkbox" class="checkbox" id="%1$s" name="%2$s"%3$s /> <label for="%1$s">%4$s</label></p>',
			$this->get_field_id( 'count' ),
			$this->get_field_name( 'count' ),
			checked( $count, true, false ),
			esc_html__( 'Show tag counts', 'wud' )
		);

		echo wp_kses( $count_checkbox, array(
			'p' => true,
			'label' => array(
				'for' => true
			),
			'input' => array(
				'type' => true,
				'class' => true,
				'id' => true,
				'name' => true,
				'checked' => true,
			),
		));

	}

}
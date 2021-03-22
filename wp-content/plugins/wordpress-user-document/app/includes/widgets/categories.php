<?php

/**
 * @version    $Id$
 * @package   WordPress User Document
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

class WUD_Categories_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'                   => 'widget_categories',
			'description'                 => esc_html__( 'A list or dropdown of categories.', 'wud' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'wud_categories_widget', esc_html__( 'WUD - Document Categories', 'wud' ), $widget_ops );
	}

	public function form( $instance ) {

		$instance = wp_parse_args( $instance,
			array(
				'title' => esc_attr__( 'Categories', 'wud' ),
			)
		);

		$count        = isset( $instance['count'] ) ? (bool) $instance['count'] : false;
		$hierarchical = isset( $instance['hierarchical'] ) ? (bool) $instance['hierarchical'] : false;
		$dropdown     = isset( $instance['dropdown'] ) ? (bool) $instance['dropdown'] : false;
		$empty        = isset( $instance['empty'] ) ? (bool) $instance['empty'] : false;
		$title        = esc_attr( $instance['title'] );
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'wud' ); ?> : </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>"/>
        </p>
        <p><input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'dropdown' ) ); ?>"
                  name="<?php echo esc_attr( $this->get_field_name( 'dropdown' ) ); ?>"<?php checked( $dropdown ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'dropdown' ) ); ?>"><?php esc_html_e( 'Display as dropdown' ); ?></label><br/>

            <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>"<?php checked( $count ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Show post counts' ); ?></label><br/>

            <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'hierarchical' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'hierarchical' ) ); ?>"<?php checked( $hierarchical ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'hierarchical' ) ); ?>"><?php esc_html_e( 'Show hierarchy' ); ?></label>
            <br/>
            <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'empty' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'empty' ) ); ?>"<?php checked( $empty ); ?> />
            <label for="<?php echo esc_attr( $this->get_field_id( 'empty' ) ); ?>"><?php esc_html_e( 'Hide empty categories', 'wud' ); ?></label>
        </p>

		<?php

	}

	public function update( $new_instance, $old_instance ) {

		$instance                 = $old_instance;
		$instance['title']        = strip_tags( $new_instance['title'] );
		$instance['count']        = ! empty( $new_instance['count'] ) ? 1 : 0;
		$instance['hierarchical'] = ! empty( $new_instance['hierarchical'] ) ? 1 : 0;
		$instance['dropdown']     = ! empty( $new_instance['dropdown'] ) ? 1 : 0;
		$instance['empty']        = ! empty( $new_instance['empty'] ) ? 1 : 0;

		return $instance;
	}

	public function widget( $args, $instance ) {

		global $wp_query;
		static $first_dropdown = true;

		extract( $args, EXTR_SKIP );

		$count        = ! empty( $instance['count'] ) ? 1 : 0;
		$hierarchical = ! empty( $instance['hierarchical'] ) ? 1 : 0;
		$dropdown     = ! empty( $instance['dropdown'] ) ? 1 : 0;
		$empty        = ! empty( $instance['empty'] ) ? 1 : 0;

		echo wp_kses_normalize_entities( $before_widget );

		$widget_title = ! empty( $instance['title'] ) ? $instance['title'] : esc_attr__( 'Categories' );
		if ( ! empty( $widget_title ) ) {
			echo wp_kses_normalize_entities( $before_title . $widget_title . $after_title );
		}
		
		include wud_get_template( 'widgets/categories', false, false );

		echo wp_kses_normalize_entities( $after_widget );
	}


}
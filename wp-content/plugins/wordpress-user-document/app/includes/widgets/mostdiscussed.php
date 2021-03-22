<?php

/**
 * @version    $Id$
 * @package   WordPress File Download
 * @author     ZuFusion
 * @copyright  (C) 2019  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

use Zufusion\Core\Classes\Model;

/**
 * Class WUD_Mostdiscussed_Widget
 */
class WUD_Mostdiscussed_Widget extends WP_Widget {
	/**
	 * WUD_Mostdiscussed_Widget constructor.
     *
	 */
	public function __construct() {
		$widget_ops = array(
			'description'                 => esc_html__( 'Display Most Discussed Documents', 'wud' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'wud_mostdiscussed_documents_widget', esc_html__( 'WUD - Most Discussed Documents', 'wud' ), $widget_ops );
	}

	/**
	 * @param array $instance
	 *
	 * @return string|void
	 */
	public function form( $instance ) {

		$instance = wp_parse_args( $instance,
			array(
				'title'       => esc_attr__( 'Most Discussed Documents', 'wud' ),
				'category_id' => '',
				'limit'       => 5,
			)
		);
		$title    = esc_attr( $instance['title'] );

		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'wud' ); ?> : </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $title ); ?>"/>
        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'category_id' ) ); ?>"><?php esc_html_e( 'Select a category', 'wud' ); ?>
                : </label>

			<?php

			$taxonomy_args = array(
				'set_all'    => '',
				''           => esc_attr__( 'All', 'wud' ),
				'taxonomy'   => 'wud-category',
				'orderby'    => 'title',
				'order'      => 'ASC',
				'show_count' => false,
				'hide_empty' => false,
				'term_type'  => 'term_id',
			);
			$field_args    = array(
				'type'          => 'taxonomy_select',
				'name'          => $this->get_field_name( 'category_id' ),
				'id'            => $this->get_field_id( 'category_id' ),
				'value'         => $instance['category_id'],
				'taxonomy_args' => $taxonomy_args,
				'class'         => 'widefat',
				'label_attr'    => $instance['category_id'],
				'desc'          => '',
			);

			wud_app()->form->get_field( $field_args );
			?>

        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php esc_html_e( 'Limit count', 'wud' ); ?> : </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $instance['limit'] ); ?>"/>

            <br/>
            <small><?php esc_html_e( 'Number of most discussed documents.', 'wud' ); ?></small>
        </p>

		<?php

	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                = $old_instance;
		$instance['title']       = strip_tags( $new_instance['title'] );
		$instance['category_id'] = $new_instance['category_id'];
		$instance['limit']       = $new_instance['limit'];

		return $instance;
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		global $wud;

		extract( $args, EXTR_SKIP );
		$limit       = $instance['limit'];
		$category_id = $instance['category_id'];

		$docs_model = Model::get_site_instance( 'docs', $wud );
		$docs       = $docs_model->get_most_discussed_documents( $category_id, $limit );

		echo wp_kses_normalize_entities( $before_widget );

		$widget_title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		if ( ! empty( $widget_title ) ) {
			echo wp_kses_normalize_entities( $before_title . $widget_title . $after_title );
		}

		?>
		<?php
		include wud_get_template( 'widgets/mostdiscussed', false, false );
		?>

		<?php

		echo wp_kses_normalize_entities( $after_widget );
	}


}
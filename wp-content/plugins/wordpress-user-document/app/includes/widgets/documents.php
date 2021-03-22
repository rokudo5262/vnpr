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
 * Class WUD_Documents_Widget
 */
class WUD_Documents_Widget extends WP_Widget {
	/**
	 * WUD_Documents_Widget constructor.
	 */
	public function __construct() {
		$widget_ops = array(
			'description'                 => esc_html__( 'A list of Documents', 'wud' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'wud_documents_widget', esc_html__( 'WUD - Documents', 'wud' ), $widget_ops );
	}

	/**
	 * @param array $instance
	 *
	 * @return string|void
	 */
	public function form( $instance ) {

		$instance = wp_parse_args( $instance,
			array(
				'title'       => esc_attr__( 'Documents', 'wud' ),
				'category_id' => '',
				'show_by'     => '',
				'order_by'    => 'date',
				'order'       => 'desc',
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
				'wrapper'       => ''
			);
			wud_app()->form->get_field( $field_args );
			?>

        </p>


        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_by' ) ); ?>"><?php esc_html_e( 'Show by', 'wud' ); ?>: </label>

			<?php

			$show_by_options = array(
				''         => esc_html__( 'All Documents', 'wud' ),
				'featured' => esc_html__( 'Featured', 'wud' ),
			);

			$field_options = array(
				'type'    => 'select',
				'name'    => $this->get_field_name( 'show_by' ),
				'id'      => $this->get_field_id( 'show_by' ),
				'value'   => $instance['show_by'],
				'options' => $show_by_options,
				'class'   => 'widefat',
				'desc'    => '',
				'wrapper' => ''
			);

			wud_app()->form->get_field( $field_options );
			?>

        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'order_by' ) ); ?>"><?php esc_html_e( 'Order by', 'wud' ); ?>: </label>

			<?php

			$order_by_options = array(
				'date'  => esc_html__( 'Date', 'wud' ),
				'rand'  => esc_html__( 'Random', 'wud' ),
				'title' => esc_html__( 'Title', 'wud' ),
			);

			$field_options = array(
				'type'    => 'select',
				'name'    => $this->get_field_name( 'order_by' ),
				'id'      => $this->get_field_id( 'order_by' ),
				'value'   => $instance['order_by'],
				'options' => $order_by_options,
				'class'   => 'widefat',
				'desc'    => '',
				'wrapper' => ''
			);

			wud_app()->form->get_field( $field_options );
			?>

        </p>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Order', 'wud' ); ?>: </label>

			<?php

			$order_options = array(
				'asc'  => esc_html__( 'Asc', 'wud' ),
				'desc' => esc_html__( 'Desc', 'wud' ),
			);

			$field_options = array(
				'type'    => 'select',
				'name'    => $this->get_field_name( 'order' ),
				'id'      => $this->get_field_id( 'order' ),
				'value'   => $instance['order'],
				'options' => $order_options,
				'class'   => 'widefat',
				'desc'    => '',
				'wrapper' => ''
			);

			wud_app()->form->get_field( $field_options );
			?>

        </p>


        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"><?php esc_html_e( 'Limit count', 'wud' ); ?> : </label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'limit' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'limit' ) ); ?>" type="text"
                   value="<?php echo esc_attr( $instance['limit'] ); ?>"/>

            <br/>
            <small><?php esc_html_e( 'Number of documents.', 'wud' ); ?></small>
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
		$instance['show_by']     = $new_instance['show_by'];
		$instance['order_by']    = $new_instance['order_by'];
		$instance['order']       = $new_instance['order'];
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
		$docs       = $docs_model->get_documents( $category_id, $instance['show_by'], $instance['order_by'], $instance['order'], $limit );

		echo wp_kses_normalize_entities( $before_widget );

		$widget_title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		if ( ! empty( $widget_title ) ) {
			echo wp_kses_normalize_entities( $before_title . $widget_title . $after_title );
		}

		?>

		<?php
		include wud_get_template( 'widgets/documents', false, false );
		?>
		<?php

		echo wp_kses_normalize_entities( $after_widget );
	}


}
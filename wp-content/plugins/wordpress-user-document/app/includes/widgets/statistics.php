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
 * Class WUD_Statistics_Widget
 */
class WUD_Statistics_Widget extends WP_Widget {

	/**
	 * WUD_Statistics_Widget constructor.
	 */
	function __construct() {
		$widget_ops = array(
			'description'                 => esc_html__( 'Report the numbers of total documents created, the numbers of total views in Document , the numbers of total likes in Document of current list documents page ', 'wud' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'wud_statistics_documents_widget', esc_html__( 'WUD - Statistics', 'wud' ), $widget_ops );
	}

	/**
	 * @param array $instance
	 *
	 * @return string|void
	 */
	public function form( $instance ) {

		$instance = wp_parse_args( $instance,
			array(
				'title' => esc_attr__( 'Statistics', 'wud' ),
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

		<?php

	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {

		$instance          = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		global $wud;

		extract( $args, EXTR_SKIP );

		$statistics_model = Model::get_site_instance( 'statistics', $wud );
		$statistics       = $statistics_model->get_statistics();

		echo wp_kses_normalize_entities( $before_widget );

		$widget_title = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
		if ( ! empty( $widget_title ) ) {
			echo wp_kses_normalize_entities( $before_title . $widget_title . $after_title );

		}

		include wud_get_template( 'widgets/statistics', false, false );

		echo wp_kses_normalize_entities( $after_widget );
	}


}
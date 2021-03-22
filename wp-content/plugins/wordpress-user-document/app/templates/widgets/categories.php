<?php
/**
 * @version    $Id$
 * @package   WordPress User Document
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( $dropdown ) {
	$dropdown_id    = ( $first_dropdown ) ? 'document-cat' : "{$this->id_base}-dropdown-{$this->number}";
	$first_dropdown = false;

	$taxonomy_args = array(
		'set_all'      => '',
		''             => esc_attr__( 'Select a category', 'wud' ),
		'taxonomy'     => 'wud-category',
		'orderby'      => 'title',
		'order'        => 'ASC',
		'show_count'   => $count,
		'hide_empty'   => $empty,
		'term_type'    => 'slug',
		'hierarchical' => $hierarchical
	);
	$field_args    = array(
		'type'          => 'taxonomy_select',
		'name'          => $dropdown_id,
		'id'            => $dropdown_id,
		'value'         => isset( $wp_query->query_vars['wud-category'] ) ? $wp_query->query_vars['wud-category'] : '',
		'taxonomy_args' => $taxonomy_args,
		'class'         => 'form-control widefat',
		'desc'          => '',
		'wrapper'       => ''
	);

	wud_app()->form->get_field( $field_args );


	$page_id   = wud_get_page_id( 'documents' );
	$permalink = 0 < $page_id ? get_permalink( $page_id ) : '';
	if ( ! $permalink ) {
		$permalink = get_home_url();
	}

	?>
	<script type="text/javascript">
        /* <![CDATA[ */
        (function ($) {

            $('#<?php echo esc_attr( $dropdown_id );?>').on('change', function () {

                if ($(this).val() != '') {
                    var this_page = '';
                    var home_url = '<?php echo esc_url( home_url( '/' ) );?>';
                    if (home_url.indexOf('?') > 0) {
                        this_page = home_url + '&wud-category=' + $(this).val();
                    } else {
                        this_page = home_url + '?wud-category=' + $(this).val();
                    }
                    location.href = this_page;
                } else {
                    location.href = '<?php echo esc_url( $permalink );?>';
                }
            });

        })(jQuery);
        /* ]]> */
	</script>
	<?php
} else {
	?>
	<ul class="wud-list">
		<?php
		$cat_args['title_li']     = '';
		$cat_args['hide_empty']   = $empty;
		$cat_args['hierarchical'] = $hierarchical;
		$cat_args['show_count']   = $count;
		$cat_args['taxonomy']     = 'wud-category';
		wp_list_categories( apply_filters( 'wud_widget_categories_args', $cat_args, $instance ) );
		?>
	</ul>
	<?php
}

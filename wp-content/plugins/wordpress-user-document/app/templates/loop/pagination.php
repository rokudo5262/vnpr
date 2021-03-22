<?php
$total   = isset( $total ) ? $total : wud_get_loop_prop( 'total_pages' );
$current = isset( $current ) ? $current : wud_get_loop_prop( 'current_page' );
$base    = isset( $base ) ? $base : esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) );
$format  = isset( $format ) ? $format : '';

if ( $total <= 1 ) {
	return;
}
?>

<nav class="wud-pagination">

	<?php
	$page_links = paginate_links( apply_filters( 'wud_pagination_args', array(
		'base'     => $base,
		'format'   => $format,
		'add_args' => false,
		'current'  => max( 1, $current ),
		'total'    => $total,

		'show_all'  => false,
		'prev_next' => true,
		'prev_text' => esc_html__( '&laquo; Previous', 'wud' ),
		'next_text' => esc_html__( 'Next &raquo;', 'wud' ),
		'type'      => 'array',
		'end_size'  => 3,
		'mid_size'  => 3,
	) ) );

	$r = '';
	$r .= "<ul class='pagination-list'>\n\t<li>";
	$r .= join( "</li>\n\t<li>", $page_links );
	$r .= "</li>\n</ul>\n";

	echo wp_kses($r, array(
		'ul'   => array(
			'class' => true
		),
		'li'   => true,
		'a'    => array(
			'class' => true,
			'href'  => true,
		),
		'span' => array(
			'class' => true,
		),
    ));
	?>
</nav>


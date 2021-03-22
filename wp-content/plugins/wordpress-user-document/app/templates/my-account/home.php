<?php

global $wud_settings;
$user = wp_get_current_user();

do_action( 'wud_account_home_start' );
if ( $user->ID ) {
	$shortcode = new WUD_Shortcode_Documents(
		array_merge(
			wud_app()->query->get_catalog_ordering_args(),
			array(
				'page'         => absint( max( 1, absint( get_query_var( 'paged' ) ) ) ),
				'columns'      => 1,
				// table list is 1 column
				'rows'         => apply_filters( 'wud_table_rows_per_page', 10 ),
				// default is 10 rows on per page of table
				'orderby'      => '',
				'order'        => '',
				'paginate'     => true,
				'is_shortcode' => true,
				'cache'        => false,
				'author'       => $user->ID,
				'list_type'    => 'table',
			)
		),
		'author' );

	echo balanceTags( ent2ncr( $shortcode->get_content() ), true );
} else {
	echo esc_html__( 'You need to login to view documents', 'wud' );
}
do_action( 'wud_account_home_end' );
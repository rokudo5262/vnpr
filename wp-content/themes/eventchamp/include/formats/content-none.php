<?php
/*
	* The template used for displaying no content
*/
?>

<div class="gt-no-content">
	<?php echo eventchamp_content_title( $title = esc_html__( 'No Content', 'eventchamp' ), $sec_title =  "", $text = "", $separate = "true", $icon = "fas fa-exclamation-triangle" ); ?>

	<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) {

			echo wpautop( esc_html__( 'Ready to publish your first post?', 'eventchamp' ) . ' <a href="' . admin_url( 'post-new.php' ) . '">' . esc_html__( 'Get started here.', 'eventchamp' ) . '</a>' );

		} elseif ( is_search() ) {

			echo wpautop( esc_html__( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'eventchamp' ) );

			get_search_form();

		} else {

			echo wpautop( esc_html__( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'eventchamp' ) );

			get_search_form();

		}
	?>
</div>
<?php
/**
	* The template for displaying woocommerce single
*/
get_header(); ?>

	<?php echo eventchamp_sub_content_before(); ?>

		<?php echo eventchamp_page_title_bar(); ?>

		<?php echo eventchamp_container_before(); ?>

			<?php echo eventchamp_row_before(); ?>

				<?php
					if ( is_active_sidebar( 'shop-sidebar' ) )  {

						echo eventchamp_content_area_before();

					}
				?>

					<div class="gt-page-content">

						<?php woocommerce_content(); ?>

					</div>


				<?php
					if ( is_active_sidebar( 'shop-sidebar' ) )  {

						echo eventchamp_content_area_after();

					}
				?>

				<?php
					if ( is_active_sidebar( 'shop-sidebar' ) )  {

						echo eventchamp_sidebar_before();
							dynamic_sidebar( 'shop-sidebar' );
						echo eventchamp_sidebar_after();

					}
				?>

			<?php echo eventchamp_row_after(); ?>

		<?php echo eventchamp_container_after(); ?>

	<?php echo eventchamp_sub_content_after(); ?>

<?php get_footer();
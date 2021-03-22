<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">

		<?php
			$responsive = ot_get_option( 'eventchamp-responsive', 'on' );

			if( $responsive == "on" ) {

				echo '<meta name="viewport" content="width=device-width, initial-scale=1">';

			}
		?>

		<link rel="profile" href="gmpg.org/xfn/11" />
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>

		<?php wp_body_open(); ?>

		<?php echo eventchamp_loader(); ?>

		<?php echo eventchamp_wrapper_before(); ?>

			<?php echo eventchamp_mobile_header(); ?>

			<?php echo eventchamp_header(); ?>

			<?php echo eventchamp_sticky_header(); ?>
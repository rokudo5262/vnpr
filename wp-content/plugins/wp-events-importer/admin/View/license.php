<?php
$errors = \WPEventsImporter\UpdateHelper::isValidated();
$values = $this->setting_form->get_settings();

// Box starter html template
$box_start	= '<div class="content-box">';

// HEADER HTML OUTPUT
?>
<h1><?php _e( 'WP Events Importer', WPEVENTSIMPORTER_DOMAIN )?></h1>
<?php

// FACEBOOK HTML OUTPUT
echo $box_start;

if ( ! empty( $values[ 'license_token' ] ) && ! empty( $values[ 'purchase_code' ] ) ) {
	if ( ! empty( $errors ) ) {
		echo '<div class="error fade">';
		echo '	<p><strong>';
		esc_html_e( $errors, WPEVENTSIMPORTER_DOMAIN );
		echo '	</strong></p>';
		echo '</div>';
	}
}

$this->setting_form->run( 'wpeventsimporter_license' );
echo "</div>";

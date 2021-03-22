<?php
use WPEventsImporter\EventsManager;

$facebook	= EventsManager::connect( 'facebook' );
$meetup		= EventsManager::connect( 'meetup' );
$eventbrite	= EventsManager::connect( 'eventbrite' );

// FB auth link and controls
$fb_auth_link			= $facebook->authorize_link();
$fb_auth_control		= $facebook->authorize_control();
$fb_oauth_callback_url	= $facebook->oauth_callback_url();
$fb_token				= $fb_auth_control ? $facebook->get_token() : null;

// Meetup auth link and controls
$mup_auth_link			= $meetup->authorize_link();
$mup_auth_control		= $meetup->authorize_control();
$mup_oauth_callback_url	= $meetup->oauth_callback_url();
$mup_token				= $mup_auth_control ? $meetup->get_token() : null;

// Eventbrite auth link and controls
$eb_auth_link			= $eventbrite->authorize_link();
$eb_auth_control		= $eventbrite->authorize_control();
$eb_oauth_callback_url	= $eventbrite->oauth_callback_url();
$eb_token				= $eb_auth_control ? $eventbrite->get_token() : null;

// FACEBOOK AUTH HTML
$fb_auth_html = '<p>';
$fb_auth_html .= '	<b>' . esc_html__( 'Your callback url for facebook login settings ( Valid OAuth Redirect URIs )', WPEVENTSIMPORTER_DOMAIN ) . '</b> :';
$fb_auth_html .= '	<br/>' . $fb_oauth_callback_url;
$fb_auth_html .= '</p>';

// MEETUP AUTH HTML
$mup_auth_html = '<p>';
$mup_auth_html .= '	<b>' . esc_html__( 'Your callback url for meetup login settings ( Valid OAuth Redirect URIs )', WPEVENTSIMPORTER_DOMAIN ) . '</b> :';
$mup_auth_html .= '	<br/>' . $mup_oauth_callback_url;
$mup_auth_html .= '</p>';

// EVENTBRITE AUTH HTML
$eb_auth_html = '<p>';
$eb_auth_html .= '	<b>' . esc_html__( 'Your callback url for Eventbrite login settings ( Valid OAuth Redirect URIs )', WPEVENTSIMPORTER_DOMAIN ) . '</b> :';
$eb_auth_html .= '	<br/>' . $eb_oauth_callback_url;
$eb_auth_html .= '</p>';

if ( $fb_auth_link !== false ) {
	$fb_auth_html .= $fb_auth_link;
}

if ( $mup_auth_link !== false ) {
	$mup_auth_html .= $mup_auth_link;
}

if ( $eb_auth_link !== false ) {
	$eb_auth_html .= $eb_auth_link;
}

if ( ! $fb_auth_control ) {
	$fb_auth_html .= '<div class="alert">';
	$fb_auth_html .= __( 'Authorization required for facebook API!', WPEVENTSIMPORTER_DOMAIN );
	$fb_auth_html .= '</div>';
}

if ( ! $mup_auth_control ) {
	$mup_auth_html .= '<div class="alert">';
	$mup_auth_html .= __( 'Authorization required for Meetup API!', WPEVENTSIMPORTER_DOMAIN );
	$mup_auth_html .= '</div>';
}

if ( ! $eb_auth_control ) {
	$eb_auth_html .= '<div class="alert">';
	$eb_auth_html .= __( 'Authorization required for Eventbrite API!', WPEVENTSIMPORTER_DOMAIN );
	$eb_auth_html .= '</div>';
}

$connected_text		= '<h4 class="api-connected">' . esc_html__( 'Connected!', WPEVENTSIMPORTER_DOMAIN ) . '</h4>';
$notconnected_text	= '<h4 class="api-notconnected">' . esc_html__( 'Not Connected!', WPEVENTSIMPORTER_DOMAIN ) . '</h4>';

if ( empty( $fb_token ) ) {
	$fb_auth_html .= $notconnected_text;
} else {
	$fb_auth_html .= $connected_text;
	$fb_auth_html .= 'TOKEN : ' . $fb_token;
}

if ( empty( $mup_token ) ) {
	$mup_auth_html .= $notconnected_text;
} else {
	$mup_auth_html .= $connected_text;
	$mup_auth_html .= 'TOKEN : ' . $mup_token;
}

if ( empty( $eb_token ) ) {
	$eb_auth_html .= $notconnected_text;
} else {
	$eb_auth_html .= $connected_text;
	$eb_auth_html .= 'TOKEN : ' . $eb_token;
}

// Box starter html template
$box_start	= '<div class="content-box">';

// Header HTML output
?>
<h1>
	<?php _e( 'WP Events Importer', WPEVENTSIMPORTER_DOMAIN )?>
</h1>
<?php

// Facebook connection API form HTML output
echo $box_start;
$this->setting_form->run( 'wpeventsimporter_conn_fb' );
echo "<h3>Facebook Authorization</h3>" . $fb_auth_html . "</div>";

// Eventbrite connection API form HTML output
echo $box_start;
$this->setting_form->run( 'wpeventsimporter_conn_eventbrite' );
echo "<h3>Eventbrite Authorization</h3>" . $eb_auth_html . "</div>";

// Meetup connection API form HTML output
echo $box_start;
$this->setting_form->run( 'wpeventsimporter_conn_meetup' );
echo "<h3>Meetup Authorization</h3>" . $mup_auth_html . "</div>";

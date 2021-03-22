<?php
//nocache_headers();
global $wud_settings;

$message_login = $wud_settings->get_input_value( 'login_message', '' ) != '' ? $wud_settings->get_input_value( 'login_message', '' ) : esc_html__( 'Please login to view this page', 'wud' );
$login_text    = $wud_settings->get_input_value( 'login_text_link', '' ) != '' ? $wud_settings->get_input_value( 'login_text_link', '' ) : esc_html__( 'Click here', 'wud' );
?>

<div class="alert alert-warning" role="alert">
    <p><?php echo esc_html( $message_login ); ?> <a
                href="<?php echo esc_url( wp_login_url( wud_get_page_permalink( 'my-account' ) ) ); ?>"
                class="alert-link"><?php echo esc_html( $login_text ); ?></a></p>
</div>





<?php
// show message
wud_show_notices();

do_action( 'wud_account_navigation' ); ?>

<div class="wud_account-content">
	<?php
	/**
	 * My Account content.
	 */
	do_action( 'wud_account_content' );
	?>
</div>


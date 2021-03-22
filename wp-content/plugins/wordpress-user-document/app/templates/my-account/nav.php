<?php

global $wud_settings;
global $wp;

$tabs        = array(
	'home'     => esc_attr__( 'All documents', 'wud' ),
	'pending'  => esc_attr__( 'Pending', 'wud' ),
	'approved' => esc_attr__( 'Approved', 'wud' ),
);
$current_tab = isset( $wp->query_vars['tab-document'] ) ? $wp->query_vars['tab-document'] : 'home'
?>
<ul class="nav nav-tabs" id="my-tab" role="tablist">

	<?php

	foreach ( $tabs as $tab => $name_tab ) {
		$class_link = '';
		if ( $tab == $current_tab ) {
			$class_link = 'active';
		}
		$url = $tab == 'home' ? wud_get_page_permalink( 'my-account' ) : wud_get_account_endpoint_url( 'tab-document', $tab );
		?>
        <li class="nav-item">
            <a class="nav-link <?php echo esc_attr( $class_link ); ?>" id="wud-<?php echo esc_attr( $tab ); ?>-tab"
               href="<?php echo esc_url( $url ); ?>" role="tab"><?php echo esc_html__($name_tab); ?></a>
        </li>
		<?php
	}
	?>
</ul>

<?php
/**
 * @version    $Id$
 * @package    WordPress User Document
 * @author     ZuFusion
 * @copyright  Copyright (C) 2020 ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */
global $wud_settings;
?>

<?php if ( wud_get_loop_prop( "name" ) === 'author' ) { ?>
<form action="" method="post" id="wud-my-account-form">

    <input type="hidden" name="zufusion" value="site">
    <input type="hidden" name="zufusionapp" value="wud">
    <input type="hidden" name="controller" value="docs">
    <input type="hidden" name="task" value="delete">
	<?php wp_nonce_field( 'wud-delete-doc', 'wud-delete-doc-nonce' ); ?>

	<?php } ?>

	<?php if ( wud_get_loop_prop( 'list_type', 'list' ) === 'table' ) { ?>

    <table class="wud-table wud-theme-table <?php echo wud_get_loop_prop( 'name', '' ); ?>">
        <thead>
        <tr>
			<?php if ( $wud_settings->get_input_value( 'user_can_delete', 'yes' ) === 'yes' ) { ?>
                <th><input id="cb-select-all" type="checkbox"></th>
			<?php } ?>
            <th data-breakpoint="md" class="th-image"><?php echo esc_html__( 'Image', 'wud' ); ?></th>
            <th><?php echo esc_html__( 'Name', 'wud' ); ?></th>
            <th data-breakpoint="xlg"><?php echo esc_html__( 'Description', 'wud' ); ?></th>
            <th><?php echo esc_html__( 'Size', 'wud' ); ?></th>
            <th data-breakpoint="md"><?php echo esc_html__( 'Views', 'wud' ); ?></th>
            <th data-breakpoint="md"><?php echo esc_html__( 'Version', 'wud' ); ?></th>
            <th data-breakpoint="md"><?php echo esc_html__( 'Uploaded date', 'wud' ); ?></th>
            <th data-breakpoint="xlg"><?php echo esc_html__( 'Modified date', 'wud' ); ?></th>
            <th class="th-actions"><?php echo esc_html__( 'Actions', 'wud' ); ?></th>
        </tr>
        </thead>
        <tbody class="wud-list-files">
		<?php } else if ( wud_get_loop_prop( 'list_type', 'list' ) === 'list_table' ) { ?>
        <table class="wud-table <?php echo wud_get_loop_prop( 'name', '' ); ?>">
            <thead>
            <tr>
                <th><?php echo esc_html__( 'Name', 'wud' ); ?></th>
                <th data-breakpoint="md"><?php echo esc_html__( 'Uploaded date', 'wud' ); ?></th>
                <th><?php echo esc_html__( 'File type', 'wud' ); ?></th>
                <th class="th-categories"><?php echo esc_html__( 'Categories', 'wud' ); ?></th>
            </tr>
            </thead>
            <tbody class="wud-table-list-files">
	    <?php } else { ?>
        <ul class="wud-documents wud-columns-<?php echo esc_attr( wud_get_loop_prop( 'columns' ) ); ?>">
			<?php } ?>

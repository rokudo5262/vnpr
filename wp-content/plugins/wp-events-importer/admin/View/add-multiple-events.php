<?php
use WPEventsImporter\CronManager;

$importer_array		= $this->import_types + $this->custom_post_types;
$event_origin_tabs	= $this->tabs;
$go_back_link		= sprintf( __( '<a href="%s">go back</a>' ), wp_get_referer() );
$clean_query_args	= array(
	'import_type'	=> null,
	'edit'			=> null,
	'delete'		=> null,
	'_wpei_nonce'	=> null,
	'step'			=> null,
	'id'			=> null
);
?>
<h1 class="title">
	<?php esc_html_e( 'WP EVENTS IMPORTER', WPEVENTSIMPORTER_DOMAIN )?>
</h1>
<?php $this->tab_generator( $event_origin_tabs, $clean_query_args )?>
<div class="content-box">
	<h2 class="title">
		<?php esc_html_e( 'IMPORT EVENTS', WPEVENTSIMPORTER_DOMAIN )?>
	</h2>
	<?php
if ( $this->platform == 'welcome' ) {
	?>
	<h3>
		<?php esc_html_e( 'Welcome to Multi event importer page', WPEVENTSIMPORTER_DOMAIN )?>
	</h3>
	<div class="gt-content">
		<?php esc_html_e( 'You can get all events to your site automaticly. Please select your event source and create an update setting.', WPEVENTSIMPORTER_DOMAIN )?>
	</div>

	<?php
} elseif ( $this->platform == 'list' ) {

	if ( isset( $_REQUEST[ '_wpei_nonce' ] ) ) {
		$nonce = $_REQUEST[ '_wpei_nonce' ];

		if ( wp_verify_nonce( $nonce, 'wpeventsimporter-delete-setting' ) ) {
			$delete_settings_name	= sanitize_file_name( $_REQUEST[ 'delete' ] );
			$import_setting_id		= intval( $_REQUEST[ 'id' ] );
			$hook_name = WPEVENTSIMPORTER_DOMAIN . '_scheduler_' . $import_setting_id . '_hook';

			if ( get_option( $delete_settings_name, false ) !== false ) {
				$this->setting_form->delete_setting( $delete_settings_name );
				wp_unschedule_hook( $hook_name );
				?>
				<div class="notice notice-success">
					<p><?php printf( esc_html__( 'Settings ( %s ) deleted successfully', WPEVENTSIMPORTER_DOMAIN ), $delete_settings_name ) ?></p>
				</div>
				<?php
			}
		} else {
			?>
			<div class="notice notice-warning">
				<p><?php esc_html_e( 'Wrong or expired security nonce', WPEVENTSIMPORTER_DOMAIN ) ?></p>
			</div>
			<?php
		}
	}

	$nonce = wp_create_nonce( 'wpeventsimporter-delete-setting' );
	?>
	<table class="wp-list-table widefat fixed striped posts">
		<thead>
			<tr>
				<th scope="col"><?php esc_html_e( 'Name', WPEVENTSIMPORTER_DOMAIN ) ?></th>
				<th scope="col"><?php esc_html_e( 'Status', WPEVENTSIMPORTER_DOMAIN ) ?></th>
				<th scope="col"><?php esc_html_e( 'Schedule', WPEVENTSIMPORTER_DOMAIN ) ?></th>
				<th scope="col"><?php esc_html_e( 'Import Origin', WPEVENTSIMPORTER_DOMAIN ) ?></th>
				<th scope="col"><?php esc_html_e( 'Import Into', WPEVENTSIMPORTER_DOMAIN ) ?></th>
				<th scope="col"><?php esc_html_e( 'Actions', WPEVENTSIMPORTER_DOMAIN ) ?></th>
			</tr>
		</thead>
		<tbody>
	<?php
	$import_setting_list = $this->setting_form->getRows();

	if ( $import_setting_list !== false ) {
		$importer_count = 0;

		if ( $this->setting_form->_get( 'updated' ) === 'true' ) { ?>
			<div class="notice notice-success">
				<p><?php esc_html_e( 'Setting has been updated!', WPEVENTSIMPORTER_DOMAIN )?></p>
			</div>
			<?php
		}

		if ( is_array( $import_setting_list ) ) {
			foreach ( $import_setting_list as  $setting_id => $setting_values ) :
				$import_setting	= $setting_values[ 'fields' ];
				$setting_name		= $setting_values[ 'name' ];

				if ( empty( $import_setting ) ) continue;

				$schedule				= isset( $import_setting[ 'import_period' ] ) ? $import_setting[ 'import_period' ] : '';
				$schedule				= CronManager::importer_set_crons()[ $schedule ];
				$importer_name	= isset( $import_setting[ 'name' ] ) ? esc_html( $import_setting[ 'name' ] ) : null;
				$next_schedule	= CronManager::getScheduleTime( $setting_id );

				if ( empty( $importer_name ) ) {
					$importer_name = '<span class="gt-no-importer-name">Importer #' . $setting_id . '</span>';
				}
				?>
			<tr>
				<td scope="row">
					<?php echo $importer_name?>
				</td>
				<td scope="row">
					<?php
					$import_status = ( $import_setting[ 'ready' ] === 'ok' ) ? 'Ready' : 'Unfinished!';
					esc_html_e( $import_status, WPEVENTSIMPORTER_DOMAIN );
					?>
				</td>
				<td>
					<?php esc_html_e( $schedule, WPEVENTSIMPORTER_DOMAIN )?>
					<p><?php echo $next_schedule?></p>
				</td>
				<td scope="row">
					<?php esc_html_e( $event_origin_tabs[ $import_setting[ 'platform' ] ], WPEVENTSIMPORTER_DOMAIN )?>
				</td>
				<td scope="row">
					<?php
					$import_type_label = $importer_array[ $import_setting[ 'import_post_type' ] ];

					if ( is_array( $import_type_label ) ) {
						$import_type_label = $import_type_label[ 0 ];
					}

					esc_html_e( $import_type_label, WPEVENTSIMPORTER_DOMAIN );
					?>
				</td>
				<td scope="row">
					<a class="button action" href="<?php echo add_query_arg( [ 'import_type' => esc_attr( $import_setting[ 'import_post_type' ] ),'platform' => esc_attr( $import_setting[ 'platform' ] ),'edit' => esc_attr( $setting_id ) ] )?>">Edit</a>
					<a class="button action submitdelete" href="<?php echo add_query_arg( [ '_wpei_nonce' => $nonce, 'delete' => esc_attr( $setting_name ), 'id' => esc_attr( $setting_id ) ] )?>" onclick="return confirm( '<?php esc_attr_e( 'Are you sure to deleting this importer setting?', WPEVENTSIMPORTER_DOMAIN )?>' )">Delete</a>
				</td>
			</tr>
				<?php
				$importer_count++;
			endforeach;
		}
	}

	if ( $importer_count < 1 ) {
		?>
		<tr>
			<td colspan="5">
				<?php esc_html_e( 'You don&#39;t have any importer. Please use above tabs for adding new one.', WPEVENTSIMPORTER_DOMAIN )?>
			</td>
		</tr>
		<?php
	}
	?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="5">
					<?php
					echo sprintf(
						esc_html(
							_n(
								'You have only one event importer setting.',
								'You have %d event importer settings.',
								$importer_count,
								WPEVENTSIMPORTER_DOMAIN
							)
						),
						$importer_count
					);

					if ( isset( $test_output ) ) print_r( $test_output );
					?>
				</td>
			</tr>
		</tfoot>
	</table>
	<?php
} else if ( ! empty( $this->platform ) ) {

	if ( isset( $this->setting_form ) ) {
		?>
		<div class="gt-step-nav">
			<?php echo $this->get_step_nav()?>
		</div>
		<?php

		if ( $this->has_errors() ) {
			?>
			<div class="notice notice-warning">
				<p><?php _e( $this->show_errors( false ), WPEVENTSIMPORTER_DOMAIN ) ?></p>
			</div>
			<p>
				<?php echo $go_back_link?>
			</p>
			<?php
		} else {
			// Show success notice
			if( $this->setting_form->form_success() ) {
				?>
			<div class="notice notice-success">
				<p><?php esc_html_e( 'Your changes has been saved.', WPEVENTSIMPORTER_DOMAIN )?></p>
			</div>
				<?php
			}

			$this->setting_form->run();
		}

	}
}

?>
</div>

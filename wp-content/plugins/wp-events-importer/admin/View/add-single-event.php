<?php
use WPEventsImporter\EventsManager;
use WPEventsImporter\CronManager;

$platform			= $this->platform;
$event_origin_tabs	= $this->tabs;
$go_back_link		= sprintf( __( '<a href="%s">go back</a>' ), wp_get_referer() );
$clean_query_args	= array(
	'import_type'	=> null,
	'_wpei_nonce'	=> null,
	'step'			=> null
);
?>
<h1 class="title">
	<?php _e( 'WP EVENTS IMPORTER', WPEVENTSIMPORTER_DOMAIN )?>
</h1>
<?php $this->tab_generator( $event_origin_tabs, $clean_query_args )?>
<div class="content-box">
	<h2 class="title">
		<?php esc_html_e( 'IMPORT EVENTS', WPEVENTSIMPORTER_DOMAIN )?>
	</h2>
	<?php
// Welcome
if ( $platform === 'welcome' ) {
	?>
	<h3>
		<?php esc_html_e( 'Welcome to Single Event Importer Page', WPEVENTSIMPORTER_DOMAIN )?>
	</h3>
	<div class="gt-content">
		<?php esc_html_e( 'You can get an event to your site. Please select your event source and get your event.', WPEVENTSIMPORTER_DOMAIN )?>
	</div>
	<?php
}
// Import Results
elseif ( $platform === 'result' ) {
	if ( $this->setting_form->get_setting( 'ready' ) === 'ok' ) {
		$event_settings		= $this->setting_form->get_settings();
		$selected_events	= isset( $event_settings[ 'selected_events' ] ) ? $event_settings[ 'selected_events' ] : null;
		$events				= EventsManager::get( $event_settings );

		if ( empty( $selected_events ) || ! is_array( $selected_events ) || count( $selected_events ) < 1 ) {
			?>
			<div class="notice notice-warning">
				<p>
					<?php _e( 'You must select least one event!', WPEVENTSIMPORTER_DOMAIN )?>
				</p>
				<p>
					<?php echo $go_back_link?>
				</p>
			</div>
			<?php
		} elseif ( ! is_array( $events ) || count( $events ) < 1 ) {
			?>
			<div class="notice notice-warning">
				<p>
					<?php _e( 'No event found!', WPEVENTSIMPORTER_DOMAIN )?>
				</p>
			</div>
			<?php
		} else {
			$added_count = 0;

			foreach ( $selected_events as $event_key => $event_val ) {
				if ( isset( $events[ $event_key ] ) ) {
					$enqueue = $events[ $event_key ];

					$event_added = CronManager::enqueue_event( 'single', $enqueue, $event_settings );

					if ( $event_added ) {
						$added_count++;
					}
				}
			}

			if ( $added_count > 0 ) {?>
				<div class="notice notice-success">
					<h3><?php esc_html_e( 'Events Added to queue', WPEVENTSIMPORTER_DOMAIN )?></h3>
					<p>
						<?php _e( sprintf( '%s event(s) added to queue!', $added_count ), WPEVENTSIMPORTER_DOMAIN )?>
					</p>
					<p>
						<?php _e( 'Importer cron is currently created. Events will be imported in a short time. You may close this page if you wish.', WPEVENTSIMPORTER_DOMAIN )?>
					</p>
				</div>
				<?php
				} else {?>
				<div class="notice notice-warning">
					<h3><?php esc_html_e( 'Warning!', WPEVENTSIMPORTER_DOMAIN )?></h3>
					<p>
						<?php _e( 'Events already exists. There is no event will be imported.', WPEVENTSIMPORTER_DOMAIN )?>
					</p>
				</div>
				<?php
				}
				?>
			<?php
			// Delete trash setting
			$this->setting_form->delete_setting();

			// Is there any file uploaded?
			if ( isset( $settings[ 'ical_source_file' ] ) ) {
				$event_file	= $settings[ 'ical_source_file' ][ 'file' ];// and xml_source_file
			} elseif ( isset( $settings[ 'xml_source_file' ] ) ) {
				$event_file	= $settings[ 'xml_source_file' ][ 'file' ];
			}

			// Delete trash file
			if ( ! empty( $event_file ) ) {
				wp_delete_file( $event_file );
			}
		}
	}
}
// Display Forms
elseif ( ! empty( $this->platform ) ) {
	if ( isset( $this->setting_form ) ) {
		?>
		<div class="gt-step-nav">
			<?php echo $this->get_step_nav()?>
		</div>
		<?php
		$button_name = esc_attr__( 'Next', WPEVENTSIMPORTER_DOMAIN );

		if ( $this->has_errors() ) {
			?>
			<div class="notice notice-warning">
				<p><?php _e( $this->show_errors( false ), WPEVENTSIMPORTER_DOMAIN ) ?></p>
			</div>
			<?php
		} else {
			if ( $this->setting_form->form_success() ) {
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

// Show go back link below the form, if step in not null
if ( isset( $_GET[ 'step' ] ) ) :
	?>
	<p>
		<?php echo $go_back_link?>
	</p>
	<?php
endif;
?>
</div>

<?php
use WPEventsImporter\EventsManager;
use WPEventsImporter\CronManager;
use WPEventsImporter\Formats;

// Single importer marker ( boolean )
$is_single_importer = $this->single;

// Is final step default value
$final_step		= false;

$form_step_nav	= null;
$ready			= '0';
$next_step		= null;

// This variables get their values from the current setting form
$platform		= $this->setting_form->_get( 'platform' );
$step			= $this->setting_form->_get( 'step' );
$error			= $this->setting_form->_get( 'error' );
$noform_pages 	= [ 'welcome', 'list' ];

if ( empty( $platform ) || $platform == 'welcome' ) {
	if ( $this->single ) {
		$this->ajaxProgress->show(
			[
				[
					'id'	=> 'single',
					'name'	=> 'Single Importer Progress'
				]
			]
		);
	} else {
		$import_setting_list = $this->setting_form->getRows();
		$progressArr = [];

		if ( ! empty( $import_setting_list ) ) {
			foreach ( $import_setting_list as $setting_id => $setting_values ) {
				$import_setting = $setting_values[ 'fields' ];
				$name = isset( $import_setting[ 'name' ] ) ? $import_setting[ 'name' ] : '#' . $setting_id;
				$progressArr[] = [
					'id'	=> $setting_id,
					'name'	=> $name
				];
			}
		}

		if ( ! empty( $progressArr ) ) {
			$this->ajaxProgress->show( $progressArr );
		}
	}
}

if ( empty( $platform ) || in_array( $platform, $noform_pages ) ) return;

// Skip to final step if post type isn`t custom post type
$import_post_type	= $this->setting_form->get_setting( 'import_post_type' );

// Step navigator. Don't use "ok" as a name for the step key
$form_step_nav = [
	'0' => 'Step 1',
	'1' => 'Step 2',
	'2' => 'Final step'
];

if ( $is_single_importer ) {
	$form_step_nav = [
		'0'		=> 'Step 1',
		'1'		=> 'Step 2',
		'1a'	=> 'Step 3',
		'2'		=> 'Final step'
	];
}

if ( in_array( $import_post_type, Formats::get_custom_post_types( true ) ) ) {
	if ( $is_single_importer ) {
		$form_step_nav = [
			'0'		=> 'Step 1',
			'1'		=> 'Step 2',
			'1a'	=> 'Step 3',
			'2'		=> 'Step 4',
			'3'		=> 'Final step'
		];
	} else {
		$form_step_nav = [
			'0'	=> 'Step 1',
			'1'	=> 'Step 2',
			'2'	=> 'Step 3',
			'3'	=> 'Final step'
		];
	}
}

if ( is_array( $form_step_nav ) ) {
	$next_step_c1	= array_keys( $form_step_nav );
	$next_step_c2	= array_flip( $next_step_c1 );

	if ( empty( $step ) ) {
		$step = '0';
	}

	$next_step_num = $next_step_c2[ $step ] + 1;

	if ( isset( $next_step_c1[ $next_step_num ] ) ) {
		$next_step	= $next_step_c1[ $next_step_num ];
	} else {
		$final_step	= true;
	}

	// A value that gives information about the last state of the form
	$ready = $next_step;
}

$nav_settings = [
	'step'	=> $step,
	'steps'	=> $form_step_nav,
	'ready'	=> $this->setting_form->get_setting( 'ready' ),
];

$this->set_step_nav( $nav_settings );

// Select all boxes container HTML codes
$select_all_inline_start	= '<div id="checkbox-container">';
$select_all_inline_end		= '
</div>
<br/><br/>
<input type="checkbox" id="check-controller-box" />
<b>Select / Unselect All</b>
<br/>
';

// Next step default URL parameters
$next_updated	= null;
$next_edit		= ( $is_single_importer ) ? null : $this->setting_form->last_index();
$next_platform	= $platform;

// Default button label
$button_name	= 'Next Step &gt;&gt;';

if ( $this->setting_form->check_errors() ) {
	$form_errors = $this->setting_form->get_errors();
}

// Form Error Controls
if ( $platform === 'xml' ) {
	$xml_api = EventsManager::connect( 'xml' );

	if ( $step == '2' ) {
		$error_step			= '1';
		$xml_source			= null;
		$xml_source_file	= $this->setting_form->get_setting( 'xml_source_file' );
		$xml_source_url		= $this->setting_form->get_setting( 'xml_source_url' );

		if ( isset( $xml_source_file[ 'file' ] ) && !empty( $xml_source_file[ 'file' ] ) ) {
			$xml_source	= $xml_source_file[ 'file' ];
		} else if ( ! empty( $xml_source_url ) ) {
			$xml_source = $xml_source_url;
		}

		if( empty( $xml_source ) ) {
			$form_errors = 'XML Source Cannot be empty!';
		} else {
			$xml_results = null;

			try {
				$xml_results = $xml_api->load_xml( $xml_source );
			} catch ( Exception $err ) {
				$form_errors = $err->getMessage();
			}

			if ( $xml_results === false ) {
				$form_errors = 'XML URL is not valid!';
			}
		}
	}
}

// Definitions of the form steps
if ( empty( $step ) ) {
	$time_period_names = [];

	foreach ( CronManager::importer_set_crons() as $key => $value) {
		$time_period_names[] = [
			'value' => $key,
			'label' => $value,
		];
	}

	$custom_post_types = [];

	foreach ( $this->custom_post_types as $key => $value ) {
		$custom_post_types[] = [
			'value' => $key,
			'label' => $value,
		];
	}

	// All import post type grouping processes
	$group_marker		= [];

	foreach ( $this->import_types as $key => $val ) {
		if ( ! is_array( $val ) ) {
			continue;
		}

		list( $ptype_label, $group_name ) = $val;

		if ( ! empty( $group_name ) ) {
			$disabled = false;

			if ( $group_name === 'Plugins' ) {
				// Disables options which is belonging to unavailable plugins
				$disabled = ! Formats::check_activated_plugin( $key );

				if ( $disabled ) {
					$ptype_label .= '(not activated)';
				}
			}

			$group_marker[ $group_name ][] = [
				'value' 		=> $key,
				'label' 		=> $ptype_label,
				'disabled'	=> $disabled,
			];
		}
	}

	$group_marker[ 'Custom Post Types' ] = $custom_post_types;

	$stepConf = [
		'name'	=> 'wpeventsimporter_adj_fields',
		'title'	=> 'Selecting the target for import into',
		'desc'	=> 'Select the field below which is will be inserted into',
		'items' => [
			[
				'cond'		=> ( ! $is_single_importer ),
				'type'		=> 'text_input',
				'name'		=> 'name',
				'label'		=> 'Importer Name'
			],
			[
				'cond'		=> ( ! $is_single_importer ),
				'type'		=> 'select',
				'name'		=> 'import_period',
				'label'		=> 'Import Period',
				'options'	=> $time_period_names
			],
			[
				'type'		=> 'select',
				'name'		=> 'import_post_type',
				'label'		=> 'Import Into',
				'options'	=> $group_marker
			],
			[
				'type'		=> 'hidden',
				'name'		=> 'platform',
				'value' 	=> $platform,
				'save'		=> true,
			],
			// [
			// 	'type'		=> 'onecheckbox',
			// 	'name'		=> 'override',
			// 	'label'		=> 'Override Event?',
			// 	'option' 	=> '1',
			// 	'checked'	=> false
			// ],
		]
	];
} elseif ( $step === '1' ) {
	if ( $platform === 'facebook' ) {
		$stepConf = [
			'name'	=> 'wpeventsimporter_adj_fields',
			'title'	=> 'Facebook Events Import',
			'desc'	=> 'Fill the below gaps about your Facebook adjust',
			'items' => [
				[
					'cond'		=> ( $is_single_importer ),
					'type'		=> 'text_input',
					'name'		=> 'event_id',
					'label'		=> 'Event ID',
					'before'	=> null,
					'after'		=> '<h2>or</h2>'
				],
				[
					'type'		=> 'select',
					'name'		=> 'event_status',
					'label'		=> 'Event Status',
					'options'	=> [
						[
							'value'	=> 'upcoming',
							'label'	=> esc_attr__( 'Upcoming Events', 'wpeventsimporter' ),
						],
						[
							'value'	=> 'past',
							'label'	=> esc_attr__( 'Past Events', 'wpeventsimporter' ),
						]
					]
				],
				[
					'type'		=> 'radio',
					'name'		=> 'fb_selected_user_page_id',
					'label'		=> 'Events page',
					'ajax'		=> [ 'WPEventsImporter\Admin::get_fb_page_options' ]
				]
			]
		];

	} elseif ( $platform === 'meetup' ) {
		$stepConf = [
			'name'	=> 'wpeventsimporter_adj_fields',
			'title'	=> 'Meetup Events Setting',
			'desc'	=> 'Fill the below gaps about your Meetup adjust',
			'items' => [
				[
					'type'		=> 'text_input',
					'name'		=> 'mup_selected_group_id',
					'label'		=> 'Events group ID',
				],
				[
					'type'		=> 'select',
					'name'		=> 'event_status',
					'label'		=> 'Event Status',
					'options'	=> [
						[
							'value'	=> 'upcoming',
							'label'	=> esc_attr__( 'Upcoming Events', 'wpeventsimporter' ),
						],
						[
							'value'	=> 'past',
							'label'	=> esc_attr__( 'Past Events', 'wpeventsimporter' ),
						],
						[
							'value'	=> 'past,upcoming',
							'label'	=> esc_attr__( 'All Events', 'wpeventsimporter' ),
						]
					]
				]
			]
		];
	} elseif ( $platform === 'eventbrite' ) {
		$stepConf = [
			'name'	=> 'wpeventsimporter_adj_fields',
			'title'	=> 'Eventbrite Events Setting',
			'desc'	=> 'Fill the below gaps about your Eventbrite adjust',
			'items' => [
				[
					'type'		=> 'text_input',
					'name'		=> 'eb_selected_organizer_id',
					'label'		=> 'Events organizer ID',
				],
				[
					'type'		=> 'select',
					'name'		=> 'event_status',
					'label'		=> 'Event Status',
					'options'	=> [
						[
							'value'	=> 'draft',
							'label'	=> esc_attr__( 'Draft Events', 'wpeventsimporter' ),
						],
						[
							'value'	=> 'live',
							'label'	=> esc_attr__( 'Live Events', 'wpeventsimporter' ),
						],
						[
							'value'	=> 'started',
							'label'	=> esc_attr__( 'Started Events', 'wpeventsimporter' ),
						],
						[
							'value'	=> 'ended',
							'label'	=> esc_attr__( 'Ended Events', 'wpeventsimporter' ),
						],
						[
							'value'	=> 'completed',
							'label'	=> esc_attr__( 'Completed Events', 'wpeventsimporter' ),
						],
						[
							'value'	=> 'canceled',
							'label'	=> esc_attr__( 'Canceled Events', 'wpeventsimporter' ),
						],
					]
				]
			]
		];
	} elseif ( $platform === 'ical' ) {
		$stepConf = [
			'name'	=> 'wpeventsimporter_adj_fields',
			'title'	=> 'ICAL Events Setting',
			'desc'	=> 'Fill the below gaps about your ICAL adjust',
			'items' => [
				[
					'cond'	=> ( $is_single_importer ),
					'type'	=> 'file_input',
					'name'	=> 'ical_source_file',
					'label'	=> 'ICAL file',
					'mimes'	=> [ 'ical' => 'text/calendar' ]
				],
				[
					'type'	=> 'text_input',
					'name'	=> 'ical_source_url',
					'label'	=> 'ICAL url',
				]
			]
		];
	} elseif ( $platform === 'xml' ) {
		$stepConf = [
			'name'	=> 'wpeventsimporter_adj_fields',
			'title'	=> 'IMPORT Events from XML source Setting',
			'desc'	=> 'Fill the below gaps about your XML adjust',
			'items' => [
				[
					'cond'	=> ( $is_single_importer ),
					'type'	=> 'file_input',
					'name'	=> 'xml_source_file',
					'label'	=> 'XML file',
					'mimes'	=> 'text/xml,application/xml'
				],
				[
					'type'	=> 'text_input',
					'name'	=> 'xml_source_url',
					'label'	=> 'XML url',
				]
			]
		];
	}
} elseif ( $step === '1a' ) {
	$all_settings = $this->setting_form->get_settings();

	if ( ! empty( $platform ) ) {
		$all_settings[ 'platform' ] = $platform;
	}

	$stepConf = [
		'name'	=> 'wpeventsimporter_adj_fields',
		'title'	=> 'Available events',
		'desc'	=> 'Select events from the below list which you desired',
		'items' => [
			[
				'type'		=> 'checkbox',
				'name'		=> 'selected_events',
				'label'		=> 'Select Events',
				'ajax'		=> [
					'WPEventsImporter\Admin::get_events_options',
					$all_settings
				],
				'before'	=> $select_all_inline_start,
				'after'		=> $select_all_inline_end,
			]
		]
	];
} elseif ( $step === '2' ) {
	$selected_events = $this->setting_form->get_setting( 'selected_events' );
	$import_fields = [];

	foreach ( $this->import_fields as $key => $value ) {
		$import_fields[] = [
			'value' => $key,
			'label' => $value,
		];
	}

	if ( ! $selected_events && $is_single_importer ) {
		$form_errors = 'You must select least one event to import';
	} elseif ( $platform === 'xml' && ! empty( $xml_results ) ) {
		$events = $xml_results->get_results();
		$xml_source_arr	= array_keys( $events[ 0 ]->meta );
		unset( $events );

		$stepConf = [
			'name'	=> 'wpeventsimporter_adj_fields',
			'title'	=> 'XML Source Fields',
			'desc'	=> 'Match below xml sources with event source fields',
			'items' => [
				[
					'type'	=> 'hidden',
					'name'	=> 'event_xml_source_index',
					'value' => serialize( $xml_source_arr ),
					'save'	=> true,
				],
			]
		];

		$xmlSourceOptions = [ [ 'value' => '', 'label' => 'Skip' ] ] + $import_fields;

		foreach ( $xml_source_arr as $src_key => $src_val ) {
			$stepConf[ 'items' ][] = [
				'type'		=> 'select',
				'name'		=> 'event_xml_source_name_' . $src_key,
				'label'		=> $src_val,
				'options'	=> $xmlSourceOptions
			];
		}
	} else {
		$stepConf = [
			'name'	=> 'wpeventsimporter_adj_fields',
			'title'	=> 'Selecting the source fields',
			'desc'	=> 'Select the options below which are your desired fields',
			'items' => [
				[
					'type'		=> 'checkbox',
					'name'		=> 'event_selected_sources',
					'label' 	=> 'Events sources',
					'options'	=> $import_fields,
					'before'	=> $select_all_inline_start,
					'after'		=> $select_all_inline_end,
				],
			]
		];
	}
} elseif ( $step === '3' ) {
	$event_selected_sources	= $this->setting_form->get_setting( 'event_selected_sources' );
	$event_xml_source_index	= $this->setting_form->get_setting( 'event_xml_source_index' );
	$event_xml_source_index = stripslashes( $event_xml_source_index );
	$event_xml_source_index = unserialize( $event_xml_source_index );

	$stepConf_ = [
		'name'	=> 'wpeventsimporter_adj_fields',
		'title'	=> 'Rename the meta names',
		'desc'	=> 'Type the meta names which you desired',
		'items' => [],
	];

	if ( $platform === 'xml' && is_array( $event_xml_source_index ) ) {
		$xml_src_arr = [];

		foreach ( $event_xml_source_index as $src_key => $src_name ) {
			$xml_src_val = $this->setting_form->get_setting( 'event_xml_source_name_' . $src_key );
			$xml_src_arr[ $xml_src_val ] = $xml_src_val;
		}

		$custom_meta_fields = array_intersect_key( $this->import_fields, $xml_src_arr );
	} elseif ( is_array( $event_selected_sources ) ) {
		$custom_meta_fields = array_intersect_key( $this->import_fields, $event_selected_sources );
	}
	$custom_meta_fields_ = [];

	foreach ( $custom_meta_fields as $key => $value) {
		$custom_meta_fields_[] = [
			'value'	=> $key,
			'label'	=> $value,
		];
	}

	$stepConf_[ 'items' ][] = [
		'type'		=> 'multi_text_input',
		'name'		=> 'custom_meta_names',
		'label'		=> 'Custom Meta Keys',
		'options'	=> $custom_meta_fields_
	];

	$stepConf = [
		$stepConf_,
		[
			'name'	=> 'wpeventsimporter_adj_fields',
			'title'	=> 'Date and time formats',
			'desc'	=> 'Change date and time format',
			'items' => [
				[
					'type'		=> 'text_input',
					'name'		=> 'date_format',
					'label' 	=> 'Date Format',
					'default'	=> get_option( 'date_format' ),
				],
				[
					'type'		=> 'text_input',
					'name'		=> 'time_format',
					'label' 	=> 'Time Format',
					'default'	=> get_option( 'time_format' ),
				],
			]
		]
	];
}

$this->setting_form->loadForm( $stepConf );

// Final Step Process
if ( $final_step ) {
	$next_edit		= null;
	$next_platform	= 'list';
	$next_updated	= 'true';
	$button_name	= 'Save&amp;Finish';
	$ready			= 'ok';

	// For single importer
	if ( $is_single_importer ) {
		$next_platform	= 'result';
		$button_name	= 'Import';
	}

	CronManager::delete_cron( $this->setting_form->last_index() );
}

$facebook	= EventsManager::connect( 'facebook' );
$meetup		= EventsManager::connect( 'meetup' );
$eventbrite	= EventsManager::connect( 'eventbrite' );

if ( $platform === 'facebook' && ! $facebook->get_token() ) {
	$form_errors = 'There is no connection with Facebook API!';
}

if ( $platform === 'eventbrite' && ! $eventbrite->get_token() ) {
	$form_errors = 'There is no connection with Eventbrite API!';
}

if ( $platform === 'meetup' && ! $meetup->get_token() ) {
	$form_errors = 'There is no connection with Meetup API!';
}

if ( $platform === 'xml' && ! class_exists( "SimpleXMLElement" ) ) {
	$form_errors = 'Your host does not support "SimpleXMLElement"';
}

// FORM ERROR!
if ( ! empty( $form_errors ) ) {
	if ( is_array( $form_errors ) ) {
		foreach ( $form_errors as $form_error ) {
			$this->error( $form_error );
		}
	} else {
		$this->error( $form_errors );
	}

	return;
}

$routers = [
	'step'		=> $next_step,
	'edit'		=> $next_edit,
	'platform'	=> $next_platform,
	'updated'	=> $next_updated,
];

$this->setting_form->add_hidden_field( 'ready', $ready, true );
$this->setting_form->submit_name( $button_name );
$this->setting_form->route( $routers );
$this->setting_form->register();

// This module loaded successfully
return true;

<?php
/*======
*
* Meta Boxes
*
======*/
if( !function_exists( 'eventchamp_meta_boxes' ) ) {

	function eventchamp_meta_boxes() {

		/*======
		*
		* Post
		*
		======*/
		$post_meta_box = array(
			'id' => 'post_settings',
			'title' => esc_html__( 'Post Settings', 'eventchamp' ),
			'pages' => array( 'post' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'type' => 'tab',
					'id' => 'post-header',
					'label' => esc_html__( 'Post Header', 'eventchamp' ),
				),
					array(
						'type' => 'select',
						'id' => 'post-header-status',
						'label' => esc_html__( 'Post Header Status', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the post header. You can change default option from the Theme Settings > Posts > Post Header page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Show', 'eventchamp' ),
								'value' => 'true',
							),
							array(
								'label' => esc_html__( 'Hide', 'eventchamp' ),
								'value' => 'false',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'post-header-style',
						'label' => esc_html__( 'Post Header Style', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a content header style. You can change default option from the Theme Settings > Posts > Post Header page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Image', 'eventchamp' ),
								'value' => 'image',
							),
							array(
								'label' => esc_html__( 'Image Slider', 'eventchamp' ),
								'value' => 'image-slider',
							),
							array(
								'label' => esc_html__( 'Image Gallery', 'eventchamp' ),
								'value' => 'image-gallery',
							),
							array(
								'label' => esc_html__( 'Video', 'eventchamp' ),
								'value' => 'video',
							),
							array(
								'label' => esc_html__( 'Audio', 'eventchamp' ),
								'value' => 'audio',
							),
							array(
								'label' => esc_html__( 'Code', 'eventchamp' ),
								'value' => 'code',
							),
						),
					),
					array(
						'type' => 'upload',
						'id' => 'post-featured-image',
						'label' => esc_html__( 'Image', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload an image for the post header. If leave blank it, the image will come from the Featured Image field.', 'eventchamp' ),
					),
					array(
						'type' => 'gallery',
						'id' => 'header-image-gallery',
						'label' => esc_html__( 'Image Gallery & Image Slider Images', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload images to the image gallery or the image slider for the post header.', 'eventchamp' ),
					),
					array(
						'type' => 'textarea-simple',
						'id' => 'header-type-code',
						'label' => esc_html__( 'Code', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter custom codes for the post header. This feature works with video, audio or codes styles.', 'eventchamp' ),
					),
				array(
					'type' => 'tab',
					'id' => 'page-design',
					'label' => esc_html__( 'Page Design', 'eventchamp' ),
				),
					array(
						'type' => 'upload',
						'id' => 'custom_title_bg',
						'label' => esc_html__( 'Page Title Bar Background', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload a background image for the page title banner. Recommended: 1920x350', 'eventchamp' ),
					),
					array(
						'type' => 'select',
						'id' => 'sidebar_position',
						'label'	=> esc_html__( 'Sidebar Position', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a sidebar position. You can change default option from the Theme Settings > Pages > Layouts page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'No Sidebar', 'eventchamp' ),
								'value' => 'nosidebar',
							),
							array(
								'label' => esc_html__( 'Left Sidebar', 'eventchamp' ),
								'value' => 'left',
							),
							array(
								'label' => esc_html__( 'Right Sidebar', 'eventchamp' ),
								'value' => 'right',
							),
						),
					),
					array(
						'type' => 'sidebar-select',
						'id' => 'page_sidebar_select',
						'label' => esc_html__( 'Sidebar', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a sidebar.', 'eventchamp' ),
					),
			)
		);
		ot_register_meta_box( $post_meta_box );



		/*======
		*
		* Pages
		*
		======*/
		$post_meta_box = array(
			'id' => 'post_settings',
			'title' => esc_html__( 'Page Settings', 'eventchamp' ),
			'pages' => array( 'page' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'type' => 'tab',
					'id' => 'page-header',
					'label' => esc_html__( 'Page Header', 'eventchamp' ),
				),
					array(
						'type' => 'select',
						'id' => 'page-content-header-status',
						'label' => esc_html__( 'Page Header Status', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the page header. You can change default option from the Theme Settings > Pages > Page Header page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Show', 'eventchamp' ),
								'value' => 'true',
							),
							array(
								'label' => esc_html__( 'Hide', 'eventchamp' ),
								'value' => 'false',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'page-content-header-style',
						'label' => esc_html__( 'Page Header Style', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a content header style. You can change default option from the Theme Settings > Pages > Page Header page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Image', 'eventchamp' ),
								'value' => 'image',
							),
							array(
								'label' => esc_html__( 'Image Slider', 'eventchamp' ),
								'value' => 'image-slider',
							),
							array(
								'label' => esc_html__( 'Image Gallery', 'eventchamp' ),
								'value' => 'image-gallery',
							),
							array(
								'label' => esc_html__( 'Video', 'eventchamp' ),
								'value' => 'video',
							),
							array(
								'label' => esc_html__( 'Audio', 'eventchamp' ),
								'value' => 'audio',
							),
							array(
								'label' => esc_html__( 'Code', 'eventchamp' ),
								'value' => 'code',
							),
						),
					),
					array(
						'type' => 'upload',
						'id' => 'page-featured-image',
						'label' => esc_html__( 'Image', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload an image for the post header. If leave blank it, the image will come from the Featured Image field.', 'eventchamp' ),
					),
					array(
						'type' => 'gallery',
						'id' => 'page-gallery-images',
						'label' => esc_html__( 'Image Gallery & Image Slider Images', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload images to the image gallery or the image slider for the post header.', 'eventchamp' ),
					),
					array(
						'type' => 'textarea-simple',
						'id' => 'header-type-code',
						'label' => esc_html__( 'Code', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter your custom codes (For video, audio or codes styles) for the post header.', 'eventchamp' ),
					),
				array(
					'type' => 'tab',
					'id' => 'page-design',
					'label' => esc_html__( 'Page Design', 'eventchamp' ),
				),
					array(
						'type' => 'select',
						'id' => 'header_status',
						'label' => esc_html__( 'Header Status', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the header. You can change default option from the Theme Settings > Header page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Show', 'eventchamp' ),
								'value' => 'on',
							),
							array(
								'label' => esc_html__( 'Hide', 'eventchamp' ),
								'value' => 'off',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'header_layout_select',
						'label' => esc_html__( 'Header Style', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a header style. You can change default option from the Theme Settings > Header page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Style 1', 'eventchamp' ),
								'value' => 'header-style-1',
							),
							array(
								'label' => esc_html__( 'Style 2', 'eventchamp' ),
								'value' => 'header-style-2',
							),
							array(
								'label' => esc_html__( 'Style 3', 'eventchamp' ),
								'value' => 'header-style-3',
							),
							array(
								'label' => esc_html__( 'Style 4', 'eventchamp' ),
								'value' => 'header-style-4',
							),
							array(
								'label' => esc_html__( 'Style 5', 'eventchamp' ),
								'value' => 'header-style-5',
							),
							array(
								'label' => esc_html__( 'Style 6', 'eventchamp' ),
								'value' => 'header-style-6',
							),
						),
					),
					array(
						'type' => 'on_off',
						'id' => 'header_gap',
						'label' => esc_html__( 'Header Gap Status', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the header gap. If you choose Off, the gap will be hide.', 'eventchamp' ),
						'std' => 'on',
					),
					array(
						'type' => 'radio',
						'id' => 'page_menu_location',
						'label' => esc_html__( 'Header Menu', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a header menu location.', 'eventchamp' ),
						'choices' => array(
							array(
								'label' => esc_html__( 'Default Location', 'eventchamp' ),
								'value' => 'default'
							),
							array(
								'label' => esc_html__( 'Alternative Location', 'eventchamp' ),
								'value' => 'onepage'
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'page_title',
						'label' => esc_html__( 'Page Title Bar', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the page title bar. You can change default option from the Theme Settings > Page Title Bar page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Show', 'eventchamp' ),
								'value' => 'on',
							),
							array(
								'label' => esc_html__( 'Hide', 'eventchamp' ),
								'value' => 'off',
							),
						),
					),
					array(
						'type' => 'upload',
						'id' => 'custom_title_bg',
						'label' => esc_html__( 'Page Title Bar Background', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload a background image for the page title banner. Recommended: 1920x350', 'eventchamp' ),
					),
					array(
						'type' => 'select',
						'id' => 'box_layout',
						'label' => esc_html__( 'Box Layout', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the box layout. You can change default option from the Theme Settings > General page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Show', 'eventchamp' ),
								'value' => 'on',
							),
							array(
								'label' => esc_html__( 'Hide', 'eventchamp' ),
								'value' => 'off',
							),
						),
					),
					array(
						'type' => 'colorpicker',
						'id' => 'wrapper_bg',
						'label' => esc_html__( 'Page Wrapper Background Color', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a background color for the wrapper.', 'eventchamp' ),
					),
					array(
						'type' => 'select',
						'id' => 'sidebar_position',
						'label'	=> esc_html__( 'Sidebar Position', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a sidebar position. You can change default option from the Theme Settings > Pages > Layouts page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'No Sidebar', 'eventchamp' ),
								'value' => 'nosidebar',
							),
							array(
								'label' => esc_html__( 'Left Sidebar', 'eventchamp' ),
								'value' => 'left',
							),
							array(
								'label' => esc_html__( 'Right Sidebar', 'eventchamp' ),
								'value' => 'right',
							),
						),
					),
					array(
						'type' => 'sidebar-select',
						'id' => 'page_sidebar_select',
						'label' => esc_html__( 'Sidebar', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a sidebar.', 'eventchamp' ),
					),
					array(
						'type' => 'select',
						'id' => 'footer_status',
						'label' => esc_html__( 'Footer Status', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the footer. You can change default option from the Theme Settings > Footer page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Show', 'eventchamp' ),
								'value' => 'on',
							),
							array(
								'label' => esc_html__( 'Hide', 'eventchamp' ),
								'value' => 'off',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'footer_layout_select',
						'label' => esc_html__( 'Footer Style', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a footer style. You can change default option from the Theme Settings > Footer page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Style 1', 'eventchamp' ),
								'value' => 'footer-style-1',
							),
							array(
								'label' => esc_html__( 'Style 2', 'eventchamp' ),
								'value' => 'footer-style-2',
							),
						),
					),
					array(
						'type' => 'on_off',
						'id' => 'footer_gap',
						'label' => esc_html__( 'Footer Gap Status', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the footer gap. If you choose Off, the gap will be hide.', 'eventchamp' ),
						'std' => 'on',
					),
			)
		);
		ot_register_meta_box( $post_meta_box );



		/*======
		*
		* Event
		*
		======*/
		$page_meta_box = array( 
			'id' => 'event_details',
			'title' => esc_html__( 'Event Details', 'eventchamp' ),
			'pages' => array( 'event' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'type' => 'tab',
					'id' => 'general-details',
					'label' => esc_html__( 'General Details', 'eventchamp' ),
				),
					array(
						'type' => 'date-picker',
						'id' => 'event_start_date',
						'label' => esc_html__( 'Start Date', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a start date. Format: 2022-08-26', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'event_start_time',
						'label' => esc_html__( 'Start Time', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a start time. Format: 18:00', 'eventchamp' ),
					),
					array(
						'type' => 'date-picker',
						'id' => 'event_end_date',
						'label' => esc_html__( 'End Date', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter an end date. Format: 2022-08-26', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'event_end_time',
						'label' => esc_html__( 'End Time', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter an end time. Format: 18:00', 'eventchamp' ),
					),
					array(
						'type' => 'date-time-picker',
						'id' => 'event_expire_date',
						'label' => esc_html__( 'Expire Date', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter an expire date. The event will be expired when this date. Format: 2022-08-26 17:59', 'eventchamp' ),
					),
					array(
						'type' => 'select',
						'id' => 'event-attendees',
						'label' => esc_html__( 'Attendees', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose an attendees type. How do you want to show this info?', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Hide', 'eventchamp' ),
								'value' => 'hide',
							),
							array(
								'label' => esc_html__( 'Manual', 'eventchamp' ),
								'value' => 'manual',
							),
							array(
								'label' => esc_html__( 'WooCommerce Product', 'eventchamp' ),
								'value' => 'woocommerce-product',
							),
						),
					),
					array(
						'type' => 'text',
						'id' => 'event-attendees-count',
						'label' => esc_html__( 'Attendee Count', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a attendee count.', 'eventchamp' ),
						'condition' => 'event-attendees:is(manual)',
					),
					array(
						'type' => 'custom-post-type-select',
						'id' => 'event-attendees-woocommerce',
						'label' => esc_html__( 'WooCommerce Product', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a product ID for get the attendees.', 'eventchamp' ),
						'condition' => 'event-attendees:is(woocommerce-product)',
						'post_type' => 'product',
					),
					array(
						'type' => 'select',
						'id' => 'event-content-listing-type',
						'label' => esc_html__( 'Event Content Listing Type', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose an listing content type.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Section', 'eventchamp' ),
								'value' => 'section',
							),
							array(
								'label' => esc_html__( 'Tab', 'eventchamp' ),
								'value' => 'tab',
							),
						),
					),
					array(
						'type' => 'list-item',
						'id' => 'event_extra_tabs',
						'label' => esc_html__( 'Tabs and Sections', 'eventchamp' ),
						'desc' => esc_html__( 'You can create event tabs and sections from this panel.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'select',
								'id' => 'type',
								'label' => esc_html__( 'Type', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a content type.', 'eventchamp' ),
								'std' => 'content',
								'choices' => array(
									array(
										'label' => esc_html__( 'Content', 'eventchamp' ),
										'value' => 'content',
									),
									array(
										'label' => esc_html__( 'Speakers', 'eventchamp' ),
										'value' => 'speakers',
									),
									array(
										'label' => esc_html__( 'Schedule', 'eventchamp' ),
										'value' => 'schedule',
									),
									array(
										'label' => esc_html__( 'Tickets', 'eventchamp' ),
										'value' => 'tickets',
									),
									array(
										'label' => esc_html__( 'Photos', 'eventchamp' ),
										'value' => 'photos',
									),
									array(
										'label' => esc_html__( 'Map', 'eventchamp' ),
										'value' => 'map',
									),
									array(
										'label' => esc_html__( '3D Tour', 'eventchamp' ),
										'value' => '3d-tour',
									),
									array(
										'label' => esc_html__( 'FAQ', 'eventchamp' ),
										'value' => 'faq',
									),
									array(
										'label' => esc_html__( 'Contact Form', 'eventchamp' ),
										'value' => 'contact-form',
									),
								),
							),
							array(
								'type' => 'textarea',
								'id' => 'event_extra_tabs_content',
								'label' => esc_html__( 'Content', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a content for the content type. Shortcodes are allowed.', 'eventchamp' ),
								'condition' => 'type:is(content)',
							),
							array(
								'type' => 'text',
								'id' => 'event-extra-tabs-contact-form-shortcode',
								'label' => esc_html__( 'Contact Form Shortcode', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a contact form shortcode. If you enter blank this field, default contact form shortcode will add. You can change default contact form shortcode from the Theme Settings > Events page. An example shortcode: [contact-form-7 id="123"]', 'eventchamp' ),
								'condition' => 'type:is(contact-form)',
							),
							array(
								'type' => 'select',
								'id' => 'speaker-style',
								'label' => esc_html__( 'Speaker Style', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a speaker listing style. You can change default option from the Theme Settings > Events > Speakers page.', 'eventchamp' ),
								'condition' => 'type:is(speakers)',
								'std' => 'default',
								'choices' => array(
									array(
										'label' => esc_html__( 'Default', 'eventchamp' ),
										'value' => 'default',
									),
									array(
										'label' => esc_html__( 'Style 1', 'eventchamp' ),
										'value' => 'style-1',
									),
									array(
										'label' => esc_html__( 'Style 2', 'eventchamp' ),
										'value' => 'style-2',
									),
									array(
										'label' => esc_html__( 'Style 3', 'eventchamp' ),
										'value' => 'style-3',
									),
									array(
										'label' => esc_html__( 'Style 4', 'eventchamp' ),
										'value' => 'style-4',
									),
									array(
										'label' => esc_html__( 'Style 5', 'eventchamp' ),
										'value' => 'style-5',
									),
									array(
										'label' => esc_html__( 'Style 6', 'eventchamp' ),
										'value' => 'style-6',
									),
									array(
										'label' => esc_html__( 'Style 7', 'eventchamp' ),
										'value' => 'style-7',
									),
									array(
										'label' => esc_html__( 'Style 8', 'eventchamp' ),
										'value' => 'style-8',
									),
								),
							),
							array(
								'type' => 'select',
								'id' => 'speaker-column',
								'label' => esc_html__( 'Speaker Column', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a speaker listing column. You can change default option from the Theme Settings > Events > Speakers page.', 'eventchamp' ),
								'condition' => 'type:is(speakers)',
								'std' => 'default',
								'choices' => array(
									array(
										'label' => esc_html__( 'Default', 'eventchamp' ),
										'value' => 'default',
									),
									array(
										'label' => esc_html__( '1', 'eventchamp' ),
										'value' => '1',
									),
									array(
										'label' => esc_html__( '2', 'eventchamp' ),
										'value' => '2',
									),
									array(
										'label' => esc_html__( '3', 'eventchamp' ),
										'value' => '3',
									),
								),
							),
							array(
								'type' => 'select',
								'id' => 'speaker-column-space',
								'label' => esc_html__( 'Speaker Column Space', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a column space for the speaker listing. You can change default option from the Theme Settings > Events > Speakers page.', 'eventchamp' ),
								'condition' => 'type:is(speakers)',
								'std' => 'default',
								'choices' => array(
									array(
										'label' => esc_html__( 'Default', 'eventchamp' ),
										'value' => 'default',
									),
									array(
										'label' => esc_html__( '0', 'eventchamp' ),
										'value' => '0',
									),
									array(
										'label' => esc_html__( '5', 'eventchamp' ),
										'value' => '5',
									),
									array(
										'label' => esc_html__( '10', 'eventchamp' ),
										'value' => '10',
									),
									array(
										'label' => esc_html__( '15', 'eventchamp' ),
										'value' => '15',
									),
									array(
										'label' => esc_html__( '20', 'eventchamp' ),
										'value' => '20',
									),
									array(
										'label' => esc_html__( '25', 'eventchamp' ),
										'value' => '25',
									),
									array(
										'label' => esc_html__( '30', 'eventchamp' ),
										'value' => '30',
									),
									array(
										'label' => esc_html__( '35', 'eventchamp' ),
										'value' => '35',
									),
									array(
										'label' => esc_html__( '40', 'eventchamp' ),
										'value' => '40',
									),
									array(
										'label' => esc_html__( '45', 'eventchamp' ),
										'value' => '45',
									),
									array(
										'label' => esc_html__( '50', 'eventchamp' ),
										'value' => '50',
									),
								),
							),
							array(
								'type' => 'select',
								'id' => 'speaker-photo',
								'label' => esc_html__( 'Speaker Photo', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose status of the photo for the speaker listing. You can change default option from the Theme Settings > Events > Speakers page.', 'eventchamp' ),
								'condition' => 'type:is(speakers)',
								'std' => 'default',
								'choices' => array(
									array(
										'label' => esc_html__( 'Default', 'eventchamp' ),
										'value' => 'default',
									),
									array(
										'label' => esc_html__( 'Show', 'eventchamp' ),
										'value' => 'true',
									),
									array(
										'label' => esc_html__( 'Hide', 'eventchamp' ),
										'value' => 'false',
									),
								),
							),
							array(
								'type' => 'select',
								'id' => 'speaker-profession',
								'label' => esc_html__( 'Speaker Profession', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose status of the profession for the speaker listing. You can change default option from the Theme Settings > Events > Speakers page.', 'eventchamp' ),
								'condition' => 'type:is(speakers)',
								'std' => 'default',
								'choices' => array(
									array(
										'label' => esc_html__( 'Default', 'eventchamp' ),
										'value' => 'default',
									),
									array(
										'label' => esc_html__( 'Show', 'eventchamp' ),
										'value' => 'true',
									),
									array(
										'label' => esc_html__( 'Hide', 'eventchamp' ),
										'value' => 'false',
									),
								),
							),
							array(
								'type' => 'select',
								'id' => 'speaker-summary',
								'label' => esc_html__( 'Speaker Summary', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose status of the summary for the speaker listing. You can change default option from the Theme Settings > Events > Speakers page.', 'eventchamp' ),
								'condition' => 'type:is(speakers)',
								'std' => 'default',
								'choices' => array(
									array(
										'label' => esc_html__( 'Default', 'eventchamp' ),
										'value' => 'default',
									),
									array(
										'label' => esc_html__( 'Show', 'eventchamp' ),
										'value' => 'true',
									),
									array(
										'label' => esc_html__( 'Hide', 'eventchamp' ),
										'value' => 'false',
									),
								),
							),
							array(
								'type' => 'select',
								'id' => 'speaker-social',
								'label' => esc_html__( 'Speaker Social Links', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose status of the social links for the speaker listing. You can change default option from the Theme Settings > Events > Speakers page.', 'eventchamp' ),
								'condition' => 'type:is(speakers)',
								'std' => 'default',
								'choices' => array(
									array(
										'label' => esc_html__( 'Default', 'eventchamp' ),
										'value' => 'default',
									),
									array(
										'label' => esc_html__( 'Show', 'eventchamp' ),
										'value' => 'true',
									),
									array(
										'label' => esc_html__( 'Hide', 'eventchamp' ),
										'value' => 'false',
									),
								),
							),
						),
					),
					array(
						'type' => 'custom-post-type-checkbox',
						'id' => 'event_speakers',
						'label' => esc_html__( 'Speakers', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose all event speakers from here.', 'eventchamp' ),
						'post_type' => 'speaker',
					),
					array(
						'type' => 'list-item',
						'id' => 'event_faq',
						'label' => esc_html__( 'FAQ', 'eventchamp' ),
						'desc' => esc_html__( 'You can create a faq list.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'textarea',
								'id' => 'event_faq_description',
								'label' => esc_html__( 'Text', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a description text.', 'eventchamp' ),
							),
							array(
								'type' => 'on_off',
								'id' => 'collapse',
								'label' => esc_html__( 'Collapse', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose status of the collapse.', 'eventchamp' ),
								'std' => 'off',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'extra-event-details-position',
						'label' => esc_html__( 'Position of the Extra Event Details', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a position for the extra event details.', 'eventchamp' ),
						'std' => 'after-current',
						'choices' => array(
							array(
								'label' => esc_html__( 'After the Current Links', 'eventchamp' ),
								'value' => 'after-current',
							),
							array(
								'label' => esc_html__( 'Before the Current Links', 'eventchamp' ),
								'value' => 'before-current',
							),
						),
					),
					array(
						'type' => 'list-item',
						'id' => 'extra-event-details',
						'label' => esc_html__( 'Extra Event Details', 'eventchamp' ),
						'desc' => esc_html__( 'You can create extra event details for the event detail box.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'select',
								'id' => 'icon-type',
								'label' => esc_html__( 'Icon Type', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose an icon type.', 'eventchamp' ),
								'std' => 'font-icon',
								'choices' => array(
									array(
										'label' => esc_html__( 'Font Icon', 'eventchamp' ),
										'value' => 'font-icon',
									),
									array(
										'label' => esc_html__( 'Image Icon', 'eventchamp' ),
										'value' => 'image-icon',
									),
								),
							),
							array(
								'type' => 'text',
								'id' => 'font-icon',
								'label' => esc_html__( 'Font Icon', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter an icon. Example: fab fa-wordpress-simple, fas fa-map-marker-alt. Icon list: https://goo.gl/vdPEsc', 'eventchamp' ),
								'condition' => 'icon-type:is(font-icon)',
							),
							array(
								'type' => 'upload',
								'id' => 'image-icon',
								'label' => esc_html__( 'Image Icon', 'eventchamp' ),
								'desc' => esc_html__( 'You can upload an image icon.', 'eventchamp' ),
								'condition' => 'icon-type:is(image-icon)',
							),
							array(
								'type' => 'textarea',
								'id' => 'text',
								'label' => esc_html__( 'Text', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a text.', 'eventchamp' ),
							),
						),
					),
					array(
						'type' => 'list-item',
						'id' => 'event_extra_buttons',
						'label' => esc_html__( 'Sidebar Buttons', 'eventchamp' ),
						'desc' => esc_html__( 'You can create buttons for the sidebar. If you want to create buttons for all events, you can create buttons from the Theme Settings > Events page.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'text',
								'id' => 'event_extra_buttons_link',
								'label' => esc_html__( 'Link URL', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a link url.', 'eventchamp' ),
							),
							array(
								'type' => 'radio',
								'id' => 'event_extra_buttons_target',
								'label' => esc_html__( 'Target', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a target type.', 'eventchamp' ),
								'std' => '_self',
								'choices' => array(
									array(
										'label' => esc_html__( 'Self', 'eventchamp' ),
										'value' => '_self',
									),
									array(
										'label' => esc_html__( 'Blank', 'eventchamp' ),
										'value' => '_blank',
									),
								),
							),
						),
					),
					array(
						'type' => 'list-item',
						'id' => 'event-sidebar-boxes',
						'label' => esc_html__( 'Sidebar Boxes', 'eventchamp' ),
						'desc' => esc_html__( 'You can create extra sidebar content boxes from here.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'textarea',
								'id' => 'text',
								'label' => esc_html__( 'Text', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a text. Shortcodes are allowed.', 'eventchamp' ),
							),
						),
					),
				array(
					'type' => 'tab',
					'id' => 'schedule',
					'label' => esc_html__( 'Schedule', 'eventchamp' ),
				),
					array(
						'type' => 'select',
						'id' => 'event-schedule-style',
						'label' => esc_html__( 'Schedule Style', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a schedule style. You can change default option from the Theme Settings > Events > Schedule page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Style 1', 'eventchamp' ),
								'value' => 'style-1',
							),
							array(
								'label' => esc_html__( 'Style 2', 'eventchamp' ),
								'value' => 'style-2',
							),
							array(
								'label' => esc_html__( 'Style 3', 'eventchamp' ),
								'value' => 'style-3',
							),
							array(
								'label' => esc_html__( 'Style 4', 'eventchamp' ),
								'value' => 'style-4',
							),
							array(
								'label' => esc_html__( 'Style 5', 'eventchamp' ),
								'value' => 'style-5',
							),
							array(
								'label' => esc_html__( 'Style 6', 'eventchamp' ),
								'value' => 'style-6',
							),
							array(
								'label' => esc_html__( 'Style 7', 'eventchamp' ),
								'value' => 'style-7',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'event-grouped-schedule',
						'label' => esc_html__( 'Grouped Event Schedule', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the grouped event schedule. If you choose true, same dates will grouped by schedule order. You can change default option from the Theme Settings > Events > Schedule page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'True', 'eventchamp' ),
								'value' => 'true',
							),
							array(
								'label' => esc_html__( 'False', 'eventchamp' ),
								'value' => 'false',
							),
						),
					),
					array(
						'type' => 'list-item',
						'id' => 'event_schedule',
						'label' => esc_html__( 'Schedule', 'eventchamp' ),
						'desc' => esc_html__( 'You can create an event schedule.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'text',
								'id' => 'group-title',
								'label' => esc_html__( 'Group Title', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a group title. If you will use grouped schedule, you should a group title. This item will show under that group.', 'eventchamp' ),
							),
							array(
								'type' => 'date-picker',
								'id' => 'event_schedule_date',
								'label' => esc_html__( 'Date', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a date for this schedule item.', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'event_schedule_time',
								'label' => esc_html__( 'Time', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a time for this schedule item.', 'eventchamp' ),
							),
							array(
								'type' => 'textarea-simple',
								'id' => 'event_schedule_description',
								'label' => esc_html__( 'Text', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a description text for this schedule item.', 'eventchamp' ),
							),
							array(
								'type' => 'custom-post-type-checkbox',
								'id' => 'event_schedule_speakers',
								'label' => esc_html__( 'Speakers', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose speakers for this schedule item.', 'eventchamp' ),
								'post_type' => 'speaker',
							),
							array(
								'type' => 'upload',
								'id' => 'image',
								'label' => esc_html__( 'Image', 'eventchamp' ),
								'desc' => esc_html__( 'You can upload an image for this item. It will show only on the style 4, style 5, style 6 and style 7.', 'eventchamp' ),
							),
						),
					),
				array(
					'type' => 'tab',
					'id' => 'contact',
					'label' => esc_html__( 'Contact', 'eventchamp' ),
				),
					array(
						'type' => 'custom-post-type-checkbox',
						'id' => 'event_venue',
						'label' => esc_html__( 'Venue', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose the venue of the event.', 'eventchamp' ),
						'post_type' => 'venue',
					),
					array(
						'type' => 'text',
						'id' => 'event_detailed_address',
						'label' => esc_html__( 'Event Address', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter the address of the event. If you enter map lat and lng coordinates, will show standard map. If you enter the coordinates, will show designed map.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'event_phone',
						'label' => esc_html__( 'Phone Number', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter the phone number of the event.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'event-fax',
						'label' => esc_html__( 'Fax Number', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter the fax number of the event.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'event_email',
						'label' => esc_html__( 'Email Address', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter the email address of the event.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'event-map-lat',
						'label' => esc_html__( 'Map Lat', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter event lat coordinate of the event.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'event-map-lng',
						'label' => esc_html__( 'Map Lng', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter event lng coordinate of the event.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'event-map-zoom',
						'label' => esc_html__( 'Map Zoom', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a map zoom value. You can change default zoom value from Theme Settings > Events > Map page.', 'eventchamp' ),
					),
					array(
						'type' => 'select',
						'id' => 'event-map-style',
						'label' => esc_html__( 'Map Style', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a map style.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Style 1', 'eventchamp' ),
								'value' => '1',
							),
							array(
								'label' => esc_html__( 'Style 2', 'eventchamp' ),
								'value' => '2',
							),
							array(
								'label' => esc_html__( 'Style 3', 'eventchamp' ),
								'value' => '3',
							),
							array(
								'label' => esc_html__( 'Style 4', 'eventchamp' ),
								'value' => '4',
							),
							array(
								'label' => esc_html__( 'Style 5', 'eventchamp' ),
								'value' => '5',
							),
							array(
								'label' => esc_html__( 'Style 6', 'eventchamp' ),
								'value' => '6',
							),
							array(
								'label' => esc_html__( 'Style 7', 'eventchamp' ),
								'value' => '7',
							),
							array(
								'label' => esc_html__( 'Style 8', 'eventchamp' ),
								'value' => '8',
							),
							array(
								'label' => esc_html__( 'Style 9', 'eventchamp' ),
								'value' => '9',
							),
							array(
								'label' => esc_html__( 'Style 10', 'eventchamp' ),
								'value' => '10',
							),
							array(
								'label' => esc_html__( 'Style 11', 'eventchamp' ),
								'value' => '11',
							),
							array(
								'label' => esc_html__( 'Style 12', 'eventchamp' ),
								'value' => '12',
							),
							array(
								'label' => esc_html__( 'Style 13', 'eventchamp' ),
								'value' => '13',
							),
						),
					),
					array(
						'type' => 'upload',
						'id' => 'event-map-icon',
						'label' => esc_html__( 'Map Icon', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload a map icon. If leave blank, default map icon will come theme settings panel. You can change default icon from Theme Settings > Events > Map page.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'event_google_street_link',
						'label' => esc_html__( 'Google Street View Link', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a Google Street View link. You can learn how to find Google Street View link from the theme documentation.', 'eventchamp' ),
					),
				array(
					'type' => 'tab',
					'id' => 'ticket',
					'label' => esc_html__( 'Tickets', 'eventchamp' ),
				),
					array(
						'type' => 'text',
						'id' => 'event-ticket-main-price',
						'label' => esc_html__( 'Price', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a main price. This price will show on event listing elements and it uses in the event search system. Only enter a price, do not enter any price symbol. Example: 50', 'eventchamp' ),
					),
					array(
						'type' => 'select',
						'id' => 'event-remaining-tickets',
						'label' => esc_html__( 'Remaining Tickets', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the remaining tickets. How would you like to show the remaining tickets?', 'eventchamp' ),
						'choices' => array(
							array(
								'label' => esc_html__( 'Hide Remaining Tickets', 'eventchamp' ),
								'value' => 'hide',
							),
							array(
								'label' => esc_html__( 'WooCommerce Product', 'eventchamp' ),
								'value' => 'woocommerce-product',
							),
							array(
								'label' => esc_html__( 'Manual Quantity', 'eventchamp' ),
								'value' => 'manual-quantity',
							),
						),
					),
					array(
						'type' => 'text',
						'id' => 'event-remaining-ticket-quantity',
						'label' => esc_html__( 'Ticket Quantity', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a ticket quantity.', 'eventchamp' ),
						'condition' => 'event-remaining-tickets:is(manual-quantity)',
					),
					array(
						'type' => 'custom-post-type-select',
						'id' => 'event-remaining-ticket-woocommerce',
						'label' => esc_html__( 'WooCommerce Product', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a product ID for the remaining tickets.', 'eventchamp' ),
						'condition' => 'event-remaining-tickets:is(woocommerce-product)',
						'post_type' => 'product',
					),
					array(
						'type' => 'select',
						'id' => 'event-ticket-style',
						'label' => esc_html__( 'Ticket Style', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a ticket style. You can change default style from the Theme Settings > Events > Tickets page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Style 1', 'eventchamp' ),
								'value' => 'style-1',
							),
							array(
								'label' => esc_html__( 'Style 2', 'eventchamp' ),
								'value' => 'style-2',
							),
							array(
								'label' => esc_html__( 'Style 3', 'eventchamp' ),
								'value' => 'style-3',
							),
							array(
								'label' => esc_html__( 'Style 4', 'eventchamp' ),
								'value' => 'style-4',
							),
							array(
								'label' => esc_html__( 'Style 5', 'eventchamp' ),
								'value' => 'style-5',
							),
							array(
								'label' => esc_html__( 'Style 6', 'eventchamp' ),
								'value' => 'style-6',
							),
							array(
								'label' => esc_html__( 'Style 7', 'eventchamp' ),
								'value' => 'style-7',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'event-ticket-column',
						'label' => esc_html__( 'Ticket Column', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a ticket listing column. You can change default option from the Theme Settings > Events > Tickets page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( '1', 'eventchamp' ),
								'value' => '1',
							),
							array(
								'label' => esc_html__( '2', 'eventchamp' ),
								'value' => '2',
							),
							array(
								'label' => esc_html__( '3', 'eventchamp' ),
								'value' => '3',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'event-ticket-column-space',
						'label' => esc_html__( 'Ticket Column Space', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a column space for the ticket listing. You can change default option from the Theme Settings > Events > Tickets page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( '0', 'eventchamp' ),
								'value' => '0',
							),
							array(
								'label' => esc_html__( '5', 'eventchamp' ),
								'value' => '5',
							),
							array(
								'label' => esc_html__( '10', 'eventchamp' ),
								'value' => '10',
							),
							array(
								'label' => esc_html__( '15', 'eventchamp' ),
								'value' => '15',
							),
							array(
								'label' => esc_html__( '20', 'eventchamp' ),
								'value' => '20',
							),
							array(
								'label' => esc_html__( '25', 'eventchamp' ),
								'value' => '25',
							),
							array(
								'label' => esc_html__( '30', 'eventchamp' ),
								'value' => '30',
							),
							array(
								'label' => esc_html__( '35', 'eventchamp' ),
								'value' => '35',
							),
							array(
								'label' => esc_html__( '40', 'eventchamp' ),
								'value' => '40',
							),
							array(
								'label' => esc_html__( '45', 'eventchamp' ),
								'value' => '45',
							),
							array(
								'label' => esc_html__( '50', 'eventchamp' ),
								'value' => '50',
							),
						),
					),
					array(
						'type' => 'list-item',
						'id' => 'event_tickets',
						'label' => esc_html__( 'Tickets', 'eventchamp' ),
						'desc' => esc_html__( 'You can a create tickets from this field.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'on_off',
								'id' => 'active-style',
								'label' => esc_html__( 'Active Style', 'eventchamp' ),
								'desc' => esc_html__( 'You can make active this ticket from this option.', 'eventchamp' ),
								'std' => 'off',
							),
							array(
								'type' => 'text',
								'id' => 'subtitle',
								'label' => esc_html__( 'Subtitle', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a subtitle.', 'eventchamp' ),
							),
							array(
								'type' => 'select',
								'id' => 'purchase-type',
								'label' => esc_html__( 'Purchase Type', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a work type.', 'eventchamp' ),
								'choices' => array(
									array(
										'label' => esc_html__( 'WooCommerce', 'eventchamp' ),
										'value' => 'woocommerce',
									),
									array(
										'label' => esc_html__( 'Eventbrite', 'eventchamp' ),
										'value' => 'eventbrite',
									),
									array(
										'label' => esc_html__( 'Meetup', 'eventchamp' ),
										'value' => 'meetup',
									),
									array(
										'label' => esc_html__( 'Contact Form', 'eventchamp' ),
										'value' => 'contact-form',
									),
									array(
										'label' => esc_html__( 'External Link', 'eventchamp' ),
										'value' => 'external-link',
									),
								),
							),
							array(
								'type' => 'textarea-simple',
								'id' => 'event_tickets_package_feature',
								'label' => esc_html__( 'Package Features', 'eventchamp' ),
								'desc' => esc_html__( 'You can create package features from this textarea. Press enter for each line.', 'eventchamp' ),
								'class' => 'no-editor',
							),
							array(
								'type' => 'custom-post-type-select',
								'id' => 'woocommerce-product',
								'label' => esc_html__( 'WooCommerce Product', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a WooCommerce product for this ticket. This product will add to the cart when click on the buy now button and this product will ticket of the customers. Ticket price will come from this product.', 'eventchamp' ),
								'post_type' => 'product',
								'condition' => 'purchase-type:is(woocommerce)',
							),
							array(
								'type' => 'select',
								'id' => 'quantity',
								'label' => esc_html__( 'Quantity', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose status of the quantity chooser. You can change default option from the Theme Settings > Events > Tickets page.', 'eventchamp' ),
								'condition' => 'purchase-type:is(woocommerce)',
								'choices' => array(
									array(
										'label' => esc_html__( 'Default', 'eventchamp' ),
										'value' => 'default',
									),
									array(
										'label' => esc_html__( 'Show', 'eventchamp' ),
										'value' => 'true',
									),
									array(
										'label' => esc_html__( 'Hide', 'eventchamp' ),
										'value' => 'false',
									),
								),
							),
							array(
								'type' => 'text',
								'id' => 'price',
								'label' => esc_html__( 'Price', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a ticket price. Only enter a price, do not enter any price symbol. Example: 50. Blank enter it, if you use WooCommerce product for this ticket.', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'eventbrite-link',
								'label' => esc_html__( 'Eventbrite Link', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter an event link of Eventbrite.', 'eventchamp' ),
								'condition' => 'purchase-type:is(eventbrite)',
							),
							array(
								'type' => 'text',
								'id' => 'meetup-link',
								'label' => esc_html__( 'Meetup Link', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter an event link of Meetup.', 'eventchamp' ),
								'condition' => 'purchase-type:is(meetup)',
							),
							array(
								'type' => 'text',
								'id' => 'external-link',
								'label' => esc_html__( 'External Link', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter an external link.', 'eventchamp' ),
								'condition' => 'purchase-type:is(external-link)',
							),
							array(
								'type' => 'text',
								'id' => 'contact-form-link',
								'label' => esc_html__( 'Contact Form Link', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a contact form page link. If you enter blank, the contact form opens when click on the button.', 'eventchamp' ),
								'condition' => 'purchase-type:is(contact-form)',
							),
							array(
								'type' => 'text',
								'id' => 'button-title',
								'label' => esc_html__( 'Button Title', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a button title. Default: Buy Now', 'eventchamp' ),
							),
							array(
								'type' => 'radio',
								'id' => 'button-target',
								'label' => esc_html__( 'Button Target', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a target type.', 'eventchamp' ),
								'std' => '_self',
								'choices' => array(
									array(
										'label' => esc_html__( 'Self', 'eventchamp' ),
										'value' => '_self',
									),
									array(
										'label' => esc_html__( 'Blank', 'eventchamp' ),
										'value' => '_blank',
									),
								),
							),
						),
					),
				array(
					'type' => 'tab',
					'id' => 'event-header',
					'label' => esc_html__( 'Event Header', 'eventchamp' ),
				),
					array(
						'type' => 'select',
						'id' => 'event-header-status',
						'label' => esc_html__( 'Event Header Status', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the event header. You can change default option from the Theme Settings > Events > Event Header page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Show', 'eventchamp' ),
								'value' => 'true',
							),
							array(
								'label' => esc_html__( 'Hide', 'eventchamp' ),
								'value' => 'false',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'event-header-style',
						'label' => esc_html__( 'Event Header Style', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a content header style. You can change default option from the Theme Settings > Events > Event Header page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Image', 'eventchamp' ),
								'value' => 'image',
							),
							array(
								'label' => esc_html__( 'Image Slider', 'eventchamp' ),
								'value' => 'image-slider',
							),
							array(
								'label' => esc_html__( 'Image Gallery', 'eventchamp' ),
								'value' => 'image-gallery',
							),
							array(
								'label' => esc_html__( 'Video', 'eventchamp' ),
								'value' => 'video',
							),
							array(
								'label' => esc_html__( 'Audio', 'eventchamp' ),
								'value' => 'audio',
							),
							array(
								'label' => esc_html__( 'Code', 'eventchamp' ),
								'value' => 'code',
							),
						),
					),
					array(
						'type' => 'upload',
						'id' => 'event_featured_image',
						'label' => esc_html__( 'Image', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload an image for the event header. If leave blank it, the image will come from the Featured Image field.', 'eventchamp' ),
					),
					array(
						'type' => 'gallery',
						'id' => 'event_image_gallery',
						'label' => esc_html__( 'Image Gallery & Image Slider Images', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload images to the image gallery or the image slider for the event header.', 'eventchamp' ),
					),
					array(
						'type' => 'textarea-simple',
						'id' => 'header-type-code',
						'label' => esc_html__( 'Code', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter your custom codes (For video, audio or codes styles) for the event header.', 'eventchamp' ),
					),
				array(
					'type' => 'tab',
					'id' => 'media',
					'label' => esc_html__( 'Media', 'eventchamp' ),
				),
					array(
						'type' => 'upload',
						'id' => 'event_custom_title_bg',
						'label' => esc_html__( 'Page Title Bar Background', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload a background image for the page title banner. Recommended: 1920x350', 'eventchamp' ),
					),
					array(
						'type' => 'select',
						'id' => 'event-photos-status',
						'label' => esc_html__( 'Photos Status', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the photos. You can change default option from the Theme Settings > Events > Media page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Show', 'eventchamp' ),
								'value' => 'true',
							),
							array(
								'label' => esc_html__( 'Hide', 'eventchamp' ),
								'value' => 'false',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'event-photo-column',
						'label' => esc_html__( 'Photo Column', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a photo listing column. You can change default option from the Theme Settings > Events > Media page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( '1', 'eventchamp' ),
								'value' => '1',
							),
							array(
								'label' => esc_html__( '2', 'eventchamp' ),
								'value' => '2',
							),
							array(
								'label' => esc_html__( '3', 'eventchamp' ),
								'value' => '3',
							),
							array(
								'label' => esc_html__( '4', 'eventchamp' ),
								'value' => '4',
							),
							array(
								'label' => esc_html__( '5', 'eventchamp' ),
								'value' => '5',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'event-photo-column-space',
						'label' => esc_html__( 'Photo Column Space', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a column space for the photo listing. You can change default option from the Theme Settings > Events > Media page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( '0', 'eventchamp' ),
								'value' => '0',
							),
							array(
								'label' => esc_html__( '5', 'eventchamp' ),
								'value' => '5',
							),
							array(
								'label' => esc_html__( '10', 'eventchamp' ),
								'value' => '10',
							),
							array(
								'label' => esc_html__( '15', 'eventchamp' ),
								'value' => '15',
							),
							array(
								'label' => esc_html__( '20', 'eventchamp' ),
								'value' => '20',
							),
							array(
								'label' => esc_html__( '25', 'eventchamp' ),
								'value' => '25',
							),
							array(
								'label' => esc_html__( '30', 'eventchamp' ),
								'value' => '30',
							),
							array(
								'label' => esc_html__( '35', 'eventchamp' ),
								'value' => '35',
							),
							array(
								'label' => esc_html__( '40', 'eventchamp' ),
								'value' => '40',
							),
							array(
								'label' => esc_html__( '45', 'eventchamp' ),
								'value' => '45',
							),
							array(
								'label' => esc_html__( '50', 'eventchamp' ),
								'value' => '50',
							),
						),
					),
					array(
						'type' => 'gallery',
						'id' => 'event_media_tab_images',
						'label' => esc_html__( 'Photos for the Photos Tab/Section', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload photos for the photos tab/section.', 'eventchamp' ),
					),
				array(
					'type' => 'tab',
					'id' => 'sponsors',
					'label' => esc_html__( 'Sponsors', 'eventchamp' ),
				),
					array(
						'type' => 'select',
						'id' => 'event-sponsors-status',
						'label' => esc_html__( 'Event Sponsors Status', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the event sponsors for the event sidebar. You can change default option from the Theme Settings > Events > Sponsors page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Show', 'eventchamp' ),
								'value' => 'true',
							),
							array(
								'label' => esc_html__( 'Hide', 'eventchamp' ),
								'value' => 'false',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'event-sponsors-style',
						'label' => esc_html__( 'Event Sponsor Style', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a sponsor listing style. You can change default option from the Theme Settings > Events > Sponsors page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Style 1', 'eventchamp' ),
								'value' => 'style-1',
							),
							array(
								'label' => esc_html__( 'Style 2', 'eventchamp' ),
								'value' => 'style-2',
							),
							array(
								'label' => esc_html__( 'Style 3', 'eventchamp' ),
								'value' => 'style-3',
							),
							array(
								'label' => esc_html__( 'Style 4', 'eventchamp' ),
								'value' => 'style-4',
							),
							array(
								'label' => esc_html__( 'Style 5', 'eventchamp' ),
								'value' => 'style-5',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'event-sponsors-column',
						'label' => esc_html__( 'Event Sponsor Column', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a sponsor listing column. You can change default option from the Theme Settings > Events > Sponsors page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( '1', 'eventchamp' ),
								'value' => '1',
							),
							array(
								'label' => esc_html__( '2', 'eventchamp' ),
								'value' => '2',
							),
							array(
								'label' => esc_html__( '3', 'eventchamp' ),
								'value' => '3',
							),
							array(
								'label' => esc_html__( '4', 'eventchamp' ),
								'value' => '4',
							),
							array(
								'label' => esc_html__( '5', 'eventchamp' ),
								'value' => '5',
							),
							array(
								'label' => esc_html__( '6', 'eventchamp' ),
								'value' => '6',
							),
							array(
								'label' => esc_html__( '7', 'eventchamp' ),
								'value' => '7',
							),
							array(
								'label' => esc_html__( '8', 'eventchamp' ),
								'value' => '8',
							),
							array(
								'label' => esc_html__( '9', 'eventchamp' ),
								'value' => '9',
							),
							array(
								'label' => esc_html__( '10', 'eventchamp' ),
								'value' => '10',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'event-sponsors-column-space',
						'label' => esc_html__( 'Event Sponsor Column Space', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a column space. You can change default option from the Theme Settings > Events > Sponsors page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( '0', 'eventchamp' ),
								'value' => '0',
							),
							array(
								'label' => esc_html__( '5', 'eventchamp' ),
								'value' => '5',
							),
							array(
								'label' => esc_html__( '10', 'eventchamp' ),
								'value' => '10',
							),
							array(
								'label' => esc_html__( '15', 'eventchamp' ),
								'value' => '15',
							),
							array(
								'label' => esc_html__( '20', 'eventchamp' ),
								'value' => '20',
							),
							array(
								'label' => esc_html__( '25', 'eventchamp' ),
								'value' => '25',
							),
							array(
								'label' => esc_html__( '30', 'eventchamp' ),
								'value' => '30',
							),
							array(
								'label' => esc_html__( '35', 'eventchamp' ),
								'value' => '35',
							),
							array(
								'label' => esc_html__( '40', 'eventchamp' ),
								'value' => '40',
							),
							array(
								'label' => esc_html__( '45', 'eventchamp' ),
								'value' => '45',
							),
							array(
								'label' => esc_html__( '50', 'eventchamp' ),
								'value' => '50',
							),
						),
					),
					array(
						'type' => 'list-item',
						'id' => 'event_sponsors',
						'label' => esc_html__( 'Event Sponsors', 'eventchamp' ),
						'desc' => esc_html__( 'You can create event sponsors from this panel.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'upload',
								'id' => 'event_sponsor_logo',
								'label' => esc_html__( 'Sponsor Logo', 'eventchamp' ),
								'desc' => esc_html__( 'You can upload a logo. Upload same sizes logos for the sponsors. Recommended size: 400x400', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'text',
								'label' => esc_html__( 'Text', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a text.', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'event_sponsor_link',
								'label' => esc_html__( 'Link URL', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a sponsor link URL.', 'eventchamp' ),
							),
							array(
								'type' => 'select',
								'id' => 'grayscale',
								'label' => esc_html__( 'Grayscale', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose status of the grayscale. You can make the logo gray.', 'eventchamp' ),
								'std' => 'false',
								'choices' => array(
									array(
										'label' => esc_html__( 'False', 'eventchamp' ),
										'value' => 'false',
									),
									array(
										'label' => esc_html__( 'True', 'eventchamp' ),
										'value' => 'true',
									),
								),
							),
							array(
								'type' => 'radio',
								'id' => 'target',
								'label' => esc_html__( 'Target', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a target type.', 'eventchamp' ),
								'std' => '_blank',
								'choices' => array(
									array(
										'label' => esc_html__( 'Blank', 'eventchamp' ),
										'value' => '_blank'
									),
									array(
										'label' => esc_html__( 'Self', 'eventchamp' ),
										'value' => '_self',
									),
								),
							),
						),
					),
				array(
					'type' => 'tab',
					'id' => 'labels',
					'label' => esc_html__( 'Labels', 'eventchamp' ),
				),
					array(
						'type' => 'on_off',
						'id' => 'labels_status',
						'label' => esc_html__( 'Status of the Labels', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the labels.', 'eventchamp' ),
						'std' => 'off',
					),
					array(
						'type' => 'list-item',
						'id' => 'labels',
						'label' => esc_html__( 'Labels', 'eventchamp' ),
						'desc' => esc_html__( 'You can create labels from this panel.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'select',
								'id' => 'style',
								'label' => esc_html__( 'Style', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a label style.', 'eventchamp' ),
								'std' => 'style-1',
								'choices' => array(
									array(
										'label' => esc_html__( 'Style 1', 'eventchamp' ),
										'value' => 'style-1',
									),
									array(
										'label' => esc_html__( 'Style 2', 'eventchamp' ),
										'value' => 'style-2',
									),
									array(
										'label' => esc_html__( 'Style 3', 'eventchamp' ),
										'value' => 'style-3',
									),
									array(
										'label' => esc_html__( 'Style 4', 'eventchamp' ),
										'value' => 'style-4',
									),
								),
							),
							array(
								'type' => 'select',
								'id' => 'position',
								'label' => esc_html__( 'Position', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a label position.', 'eventchamp' ),
								'std' => 'top-left',
								'choices' => array(
									array(
										'label' => esc_html__( 'Top Left', 'eventchamp' ),
										'value' => 'top-left',
									),
									array(
										'label' => esc_html__( 'Top Center', 'eventchamp' ),
										'value' => 'top-center',
									),
									array(
										'label' => esc_html__( 'Top Right', 'eventchamp' ),
										'value' => 'top-right',
									),
									array(
										'label' => esc_html__( 'Middle Left', 'eventchamp' ),
										'value' => 'middle-left',
									),
									array(
										'label' => esc_html__( 'Middle Center', 'eventchamp' ),
										'value' => 'middle-center',
									),
									array(
										'label' => esc_html__( 'Middle Right', 'eventchamp' ),
										'value' => 'middle-right',
									),
									array(
										'label' => esc_html__( 'Bottom Left', 'eventchamp' ),
										'value' => 'bottom-left',
									),
									array(
										'label' => esc_html__( 'Bottom Center', 'eventchamp' ),
										'value' => 'bottom-center',
									),
									array(
										'label' => esc_html__( 'Bottom Right', 'eventchamp' ),
										'value' => 'bottom-right',
									),
									array(
										'label' => esc_html__( 'Custom Position', 'eventchamp' ),
										'value' => 'custom-position',
									),
								),
							),
							array(
								'type' => 'text',
								'id' => 'top-position',
								'label' => esc_html__( 'Top Postion', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a px value for top align.', 'eventchamp' ),
								'condition' => 'position:is(custom-position)',
							),
							array(
								'type' => 'text',
								'id' => 'bottom-position',
								'label' => esc_html__( 'Bottom Postion', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a px value for bottom align.', 'eventchamp' ),
								'condition' => 'position:is(custom-position)',
							),
							array(
								'type' => 'text',
								'id' => 'left-position',
								'label' => esc_html__( 'Left Postion', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a px value for left align.', 'eventchamp' ),
								'condition' => 'position:is(custom-position)',
							),
							array(
								'type' => 'text',
								'id' => 'right-position',
								'label' => esc_html__( 'Right Postion', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a px value for right align.', 'eventchamp' ),
								'condition' => 'position:is(custom-position)',
							),
							array(
								'type' => 'text',
								'id' => 'height',
								'label' => esc_html__( 'Height', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a height value.', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'width',
								'label' => esc_html__( 'Width', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a width value.', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'link',
								'label' => esc_html__( 'Link', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a link.', 'eventchamp' ),
							),
							array(
								'type' => 'radio',
								'id' => 'target',
								'label' => esc_html__( 'Target', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a target type.', 'eventchamp' ),
								'std' => '_self',
								'choices' => array(
									array(
										'label' => esc_html__( 'Self', 'eventchamp' ),
										'value' => '_self'
									),
									array(
										'label' => esc_html__( 'Blank', 'eventchamp' ),
										'value' => '_blank'
									),
								),
							),
							array(
								'type' => 'text',
								'id' => 'z-index',
								'label' => esc_html__( 'z-index', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a z-index value.', 'eventchamp' ),
							),
							array(
								'type' => 'background',
								'id' => 'background',
								'label' => esc_html__( 'Background', 'eventchamp' ),
								'desc' => esc_html__( 'You can create a background.', 'eventchamp' ),
							),
							array(
								'type' => 'colorpicker',
								'id' => 'text-color',
								'label' => esc_html__( 'Text Color', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a text color.', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'font-size',
								'label' => esc_html__( 'Font Size', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a font size. In pixel. Default: 12px', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'top-padding',
								'label' => esc_html__( 'Top Padding', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a px value. In pixel', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'bottom-padding',
								'label' => esc_html__( 'Bottom Padding', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a px value. In pixel', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'left-padding',
								'label' => esc_html__( 'Left Padding', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a px value. In pixel', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'right-padding',
								'label' => esc_html__( 'Right Padding', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a px value. In pixel', 'eventchamp' ),
							),
							array(
								'type' => 'colorpicker',
								'id' => 'border-color',
								'label' => esc_html__( 'Border Color', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a border color.', 'eventchamp' ),
							),
							array(
								'type' => 'select',
								'id' => 'border-style',
								'label' => esc_html__( 'Border Style', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a border style.', 'eventchamp' ),
								'std' => 'none',
								'choices' => array(
									array(
										'label' => esc_html__( 'None', 'eventchamp' ),
										'value' => 'none',
									),
									array(
										'label' => esc_html__( 'Hidden', 'eventchamp' ),
										'value' => 'hidden',
									),
									array(
										'label' => esc_html__( 'Dotted', 'eventchamp' ),
										'value' => 'dotted',
									),
									array(
										'label' => esc_html__( 'Solid', 'eventchamp' ),
										'value' => 'solid',
									),
									array(
										'label' => esc_html__( 'Double', 'eventchamp' ),
										'value' => 'double',
									),
									array(
										'label' => esc_html__( 'Groove', 'eventchamp' ),
										'value' => 'groove',
									),
									array(
										'label' => esc_html__( 'Ridge', 'eventchamp' ),
										'value' => 'ridge',
									),
									array(
										'label' => esc_html__( 'Inset', 'eventchamp' ),
										'value' => 'inset',
									),
									array(
										'label' => esc_html__( 'Outset', 'eventchamp' ),
										'value' => 'outset',
									),
									array(
										'label' => esc_html__( 'Initial', 'eventchamp' ),
										'value' => 'initial',
									),
									array(
										'label' => esc_html__( 'Inherit', 'eventchamp' ),
										'value' => 'inherit',
									),
								),
							),
							array(
								'type' => 'text',
								'id' => 'border-top-width',
								'label' => esc_html__( 'Border Top Width', 'eventchamp' ),
								'desc' => esc_html__( 'You can create a top border. In pixel.', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'border-bottom-width',
								'label' => esc_html__( 'Border Bottom Width', 'eventchamp' ),
								'desc' => esc_html__( 'You can create a bottom border. In pixel.', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'border-left-width',
								'label' => esc_html__( 'Border Left Width', 'eventchamp' ),
								'desc' => esc_html__( 'You can create a left border. In pixel.', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'border-right-width',
								'label' => esc_html__( 'Border Right Width', 'eventchamp' ),
								'desc' => esc_html__( 'You can create a right border. In pixel.', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'border-top-left-radius',
								'label' => esc_html__( 'Border Top Left Radius', 'eventchamp' ),
								'desc' => esc_html__( 'You can create a border top left radius. In pixel.', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'border-top-right-radius',
								'label' => esc_html__( 'Border Top Right Radius', 'eventchamp' ),
								'desc' => esc_html__( 'You can create a border top right radius. In pixel.', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'border-bottom-left-radius',
								'label' => esc_html__( 'Border Bottom Left Radius', 'eventchamp' ),
								'desc' => esc_html__( 'You can create a border bottom left radius. In pixel.', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'border-bottom-right-radius',
								'label' => esc_html__( 'Border Bottom Right Radius', 'eventchamp' ),
								'desc' => esc_html__( 'You can create a border bottom right radius. In pixel.', 'eventchamp' ),
							),
						),
					),
				array(
					'type' => 'tab',
					'id' => 'network',
					'label' => esc_html__( 'Network', 'eventchamp' ),
				),
					array(
						'type' => 'list-item',
						'id' => 'social-links',
						'label' => esc_html__( 'Social Links', 'eventchamp' ),
						'desc' => esc_html__( 'You can create the social links of the event from this panel.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'select',
								'id' => 'icon',
								'label' => esc_html__( 'Icon', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a brand icon.', 'eventchamp' ),
								'choices' => eventchamp_social_media_sites_array(),
							),
							array(
								'type' => 'text',
								'id' => 'url',
								'label' => esc_html__( 'Link URL', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a URL.', 'eventchamp' ),
							),
							array(
								'type' => 'radio',
								'id' => 'target',
								'label' => esc_html__( 'Target', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a target type.', 'eventchamp' ),
								'std' => '_blank',
								'choices' => array(
									array(
										'label' => esc_html__( 'Blank', 'eventchamp' ),
										'value' => '_blank'
									),
									array(
										'label' => esc_html__( 'Self', 'eventchamp' ),
										'value' => '_self'
									),
								),
							),
						),
					),
				array(
					'type' => 'tab',
					'id' => 'repeater',
					'label' => esc_html__( 'Repeater', 'eventchamp' ),
				),
					array(
						'type' => 'list-item',
						'id' => 'event_repeat_dates',
						'label' => esc_html__( 'Repeat Dates', 'eventchamp' ),
						'desc' => esc_html__( 'You can create repeat dates from this panel.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'date-time-picker',
								'id' => 'event_repeat_date',
								'label' => esc_html__( 'Repeat Date', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a date. The event dates will update when this date comes. Format: 2022-07-26', 'eventchamp' ),
							),
							array(
								'type' => 'date-picker',
								'id' => 'event_repeat_start_date',
								'label' => esc_html__( 'Repeat Start Date', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter an event start date. Format: 2022-08-26', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'event_repeat_start_time',
								'label' => esc_html__( 'Repeat Start Time', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter an event start time. Format: 18:00', 'eventchamp' ),
							),
							array(
								'type' => 'date-picker',
								'id' => 'event_repeat_end_date',
								'label' => esc_html__( 'Repeat End Date', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter an event end date. Format: 2022-08-26', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'event_repeat_end_time',
								'label' => esc_html__( 'Repeat End Time', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter an event end time. Format: 18:00', 'eventchamp' ),
							),
							array(
								'type' => 'date-time-picker',
								'id' => 'event_repeat_expire_date',
								'label' => esc_html__( 'Repeat Expire Date', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter an event expire date. The event will be expired when this date. Format: 2022-08-26 17:59', 'eventchamp' ),
							),
						),
					),
			)
		);
		ot_register_meta_box( $page_meta_box );



		/*======
		*
		* Speaker
		*
		======*/
		$page_meta_box = array( 
			'id' => 'speaker_details',
			'title' => esc_html__( 'Speaker Details', 'eventchamp' ),
			'pages' => array( 'speaker' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'type' => 'tab',
					'id' => 'general-details',
					'label' => esc_html__( 'General Details', 'eventchamp' ),
				),
					array(
						'type' => 'text',
						'id' => 'speaker_profession',
						'label' => esc_html__( 'Profession', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter the profession of the speaker.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'speaker_company',
						'label' => esc_html__( 'Company', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a company name.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'speaker-short-biography',
						'label' => esc_html__( 'Short Biography', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a short biography about the speaker.', 'eventchamp' ),
					),
					array(
						'type' => 'select',
						'id' => 'extra-speaker-details-position',
						'label' => esc_html__( 'Position of the Extra Speaker Details', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a position for the extra speaker details.', 'eventchamp' ),
						'std' => 'after-current',
						'choices' => array(
							array(
								'label' => esc_html__( 'After the Current Links', 'eventchamp' ),
								'value' => 'after-current',
							),
							array(
								'label' => esc_html__( 'Before the Current Links', 'eventchamp' ),
								'value' => 'before-current',
							),
						),
					),
					array(
						'type' => 'list-item',
						'id' => 'extra-speaker-details',
						'label' => esc_html__( 'Extra Speaker Details', 'eventchamp' ),
						'desc' => esc_html__( 'You can create extra speaker details for the speaker detail box.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'select',
								'id' => 'icon-type',
								'label' => esc_html__( 'Icon Type', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose an icon type.', 'eventchamp' ),
								'std' => 'font-icon',
								'choices' => array(
									array(
										'label' => esc_html__( 'Font Icon', 'eventchamp' ),
										'value' => 'font-icon',
									),
									array(
										'label' => esc_html__( 'Image Icon', 'eventchamp' ),
										'value' => 'image-icon',
									),
								),
							),
							array(
								'type' => 'text',
								'id' => 'font-icon',
								'label' => esc_html__( 'Font Icon', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter an icon. Example: fab fa-wordpress-simple, fas fa-map-marker-alt. Icon list: https://goo.gl/vdPEsc', 'eventchamp' ),
								'condition' => 'icon-type:is(font-icon)',
							),
							array(
								'type' => 'upload',
								'id' => 'image-icon',
								'label' => esc_html__( 'Image Icon', 'eventchamp' ),
								'desc' => esc_html__( 'You can upload an image icon.', 'eventchamp' ),
								'condition' => 'icon-type:is(image-icon)',
							),
							array(
								'type' => 'textarea',
								'id' => 'text',
								'label' => esc_html__( 'Text', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a text.', 'eventchamp' ),
							),
						),
					),
					array(
						'type' => 'list-item',
						'id' => 'speaker-extra-buttons',
						'label' => esc_html__( 'Sidebar Buttons', 'eventchamp' ),
						'desc' => esc_html__( 'You can create buttons for the sidebar. If you want to create buttons for all speakers, you can create buttons from the Theme Settings > Speakers page.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'text',
								'id' => 'link',
								'label' => esc_html__( 'Link URL', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a link url.', 'eventchamp' ),
							),
							array(
								'type' => 'radio',
								'id' => 'target',
								'label' => esc_html__( 'Target', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a target type.', 'eventchamp' ),
								'std' => '_self',
								'choices' => array(
									array(
										'label' => esc_html__( 'Self', 'eventchamp' ),
										'value' => '_self',
									),
									array(
										'label' => esc_html__( 'Blank', 'eventchamp' ),
										'value' => '_blank',
									),
								),
							),
						),
					),
					array(
						'type' => 'list-item',
						'id' => 'speaker-sidebar-boxes',
						'label' => esc_html__( 'Sidebar Boxes', 'eventchamp' ),
						'desc' => esc_html__( 'You can create extra sidebar content boxes from here.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'textarea',
								'id' => 'text',
								'label' => esc_html__( 'Text', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a text. Shortcodes are allowed.', 'eventchamp' ),
							),
						),
					),
				array(
					'type' => 'tab',
					'id' => 'contact',
					'label' => esc_html__( 'Contact', 'eventchamp' ),
				),
					array(
						'type' => 'text',
						'id' => 'speaker_address',
						'label' => esc_html__( 'Address', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter the address of the speaker.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'speaker_phone',
						'label' => esc_html__( 'Phone Number', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter the phone number of the speaker.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'speaker_email',
						'label' => esc_html__( 'Email Address', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter the email of the speaker.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'speaker_website',
						'label' => esc_html__( 'Website', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter the website of the speaker.', 'eventchamp' ),
					),
				array(
					'type' => 'tab',
					'id' => 'speaker-header',
					'label' => esc_html__( 'Speaker Header', 'eventchamp' ),
				),
					array(
						'type' => 'select',
						'id' => 'speaker-header-status',
						'label' => esc_html__( 'Speaker Header Status', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the speaker header. You can change default option from the Theme Settings > Speakers > Speaker Header page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Show', 'eventchamp' ),
								'value' => 'true',
							),
							array(
								'label' => esc_html__( 'Hide', 'eventchamp' ),
								'value' => 'false',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'speaker-header-style',
						'label' => esc_html__( 'Speaker Header Style', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a content header style. You can change default option from the Theme Settings > Speakers > Speaker Header page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Image', 'eventchamp' ),
								'value' => 'image',
							),
							array(
								'label' => esc_html__( 'Image Slider', 'eventchamp' ),
								'value' => 'image-slider',
							),
							array(
								'label' => esc_html__( 'Image Gallery', 'eventchamp' ),
								'value' => 'image-gallery',
							),
							array(
								'label' => esc_html__( 'Video', 'eventchamp' ),
								'value' => 'video',
							),
							array(
								'label' => esc_html__( 'Audio', 'eventchamp' ),
								'value' => 'audio',
							),
							array(
								'label' => esc_html__( 'Code', 'eventchamp' ),
								'value' => 'code',
							),
						),
					),
					array(
						'type' => 'upload',
						'id' => 'speaker-featured-image',
						'label' => esc_html__( 'Image', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload an image for the speaker header. If leave blank it, the image will come from the Featured Image field.', 'eventchamp' ),
					),
					array(
						'type' => 'gallery',
						'id' => 'header-image-gallery',
						'label' => esc_html__( 'Image Gallery & Image Slider Images', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload images to the image gallery or the image slider for the speaker header.', 'eventchamp' ),
					),
					array(
						'type' => 'textarea-simple',
						'id' => 'header-type-code',
						'label' => esc_html__( 'Code', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter your custom codes (For video, audio or codes styles) for the speaker header.', 'eventchamp' ),
					),
				array(
					'type' => 'tab',
					'id' => 'media',
					'label' => esc_html__( 'Media', 'eventchamp' ),
				),
					array(
						'type' => 'upload',
						'id' => 'speaker-profile-photo',
						'label' => esc_html__( 'Profile Photo', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload a profile photo for the speaker. If you will not any upload an image, the featured image shows as the profile photo. Recommended size: 615x640', 'eventchamp' ),
					),
					array(
						'type' => 'upload',
						'id' => 'custom_title_bg',
						'label' => esc_html__( 'Page Title Bar Background', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload a background image for the page title banner. Recommended: 1920x350', 'eventchamp' ),
					),
					array(
						'type' => 'select',
						'id' => 'speaker-photos-status',
						'label' => esc_html__( 'Photos Status', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the photos. You can change default option from the Theme Settings > Speakers > Media page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Show', 'eventchamp' ),
								'value' => 'true',
							),
							array(
								'label' => esc_html__( 'Hide', 'eventchamp' ),
								'value' => 'false',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'speaker-photo-column',
						'label' => esc_html__( 'Photo Column', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a photo listing column. You can change default option from the Theme Settings > Speakers > Media page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( '1', 'eventchamp' ),
								'value' => '1',
							),
							array(
								'label' => esc_html__( '2', 'eventchamp' ),
								'value' => '2',
							),
							array(
								'label' => esc_html__( '3', 'eventchamp' ),
								'value' => '3',
							),
							array(
								'label' => esc_html__( '4', 'eventchamp' ),
								'value' => '4',
							),
							array(
								'label' => esc_html__( '5', 'eventchamp' ),
								'value' => '5',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'speaker-photo-column-space',
						'label' => esc_html__( 'Photo Column Space', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a column space for the photo listing. You can change default option from the Theme Settings > Speakers > Media page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( '0', 'eventchamp' ),
								'value' => '0',
							),
							array(
								'label' => esc_html__( '5', 'eventchamp' ),
								'value' => '5',
							),
							array(
								'label' => esc_html__( '10', 'eventchamp' ),
								'value' => '10',
							),
							array(
								'label' => esc_html__( '15', 'eventchamp' ),
								'value' => '15',
							),
							array(
								'label' => esc_html__( '20', 'eventchamp' ),
								'value' => '20',
							),
							array(
								'label' => esc_html__( '25', 'eventchamp' ),
								'value' => '25',
							),
							array(
								'label' => esc_html__( '30', 'eventchamp' ),
								'value' => '30',
							),
							array(
								'label' => esc_html__( '35', 'eventchamp' ),
								'value' => '35',
							),
							array(
								'label' => esc_html__( '40', 'eventchamp' ),
								'value' => '40',
							),
							array(
								'label' => esc_html__( '45', 'eventchamp' ),
								'value' => '45',
							),
							array(
								'label' => esc_html__( '50', 'eventchamp' ),
								'value' => '50',
							),
						),
					),
					array(
						'type' => 'gallery',
						'id' => 'speaker_image_gallery',
						'label' => esc_html__( 'Photos for the Photos Section', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload photos for the photos section.', 'eventchamp' ),
					),
				array(
					'id' => 'network',
					'label' => esc_html__( 'Network', 'eventchamp' ),
					'type' => 'tab'
				),
					array(
						'type' => 'list-item',
						'id' => 'social-links',
						'label' => esc_html__( 'Social Links', 'eventchamp' ),
						'desc' => esc_html__( 'You can create the social links of the speaker from this panel.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'select',
								'id' => 'icon',
								'label' => esc_html__( 'Icon', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a brand icon.', 'eventchamp' ),
								'choices' => eventchamp_social_media_sites_array(),
							),
							array(
								'type' => 'text',
								'id' => 'url',
								'label' => esc_html__( 'Link URL', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a URL.', 'eventchamp' ),
							),
							array(
								'type' => 'radio',
								'id' => 'target',
								'label' => esc_html__( 'Target', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a target type.', 'eventchamp' ),
								'std' => '_blank',
								'choices' => array(
									array(
										'label' => esc_html__( 'Blank', 'eventchamp' ),
										'value' => '_blank'
									),
									array(
										'label' => esc_html__( 'Self', 'eventchamp' ),
										'value' => '_self'
									),
								),
							),
						),
					),
			)
		);
		ot_register_meta_box( $page_meta_box );



		/*======
		*
		* Venue
		*
		======*/
		$page_meta_box = array( 
			'id' => 'venue_settings',
			'title' => esc_html__( 'Venue Details', 'eventchamp' ),
			'pages' => array( 'venue' ),
			'context' => 'normal',
			'priority' => 'high',
			'fields' => array(
				array(
					'type' => 'tab',
					'id' => 'general-details',
					'label' => esc_html__( 'General Details', 'eventchamp' ),
				),
					array(
						'type' => 'text',
						'id' => 'venue_working_hours_weekdays',
						'label' => esc_html__( 'Working Hours for Weekdays', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter working hours for weekdays.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'venue_working_hours_saturday',
						'label' => esc_html__( 'Working Hours for Saturday', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter working hours for Saturday.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'venue_working_hours_sunday',
						'label' => esc_html__( 'Working Hours for Sunday', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter working hours for Sunday.', 'eventchamp' ),
					),
					array(
						'type' => 'select',
						'id' => 'extra-venue-details-position',
						'label' => esc_html__( 'Position of the Extra Venue Details', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a position for the extra venue details.', 'eventchamp' ),
						'std' => 'after-current',
						'choices' => array(
							array(
								'label' => esc_html__( 'After the Current Links', 'eventchamp' ),
								'value' => 'after-current',
							),
							array(
								'label' => esc_html__( 'Before the Current Links', 'eventchamp' ),
								'value' => 'before-current',
							),
						),
					),
					array(
						'type' => 'list-item',
						'id' => 'extra-venue-details',
						'label' => esc_html__( 'Extra Venue Details', 'eventchamp' ),
						'desc' => esc_html__( 'You can create extra venue details for the venue detail box.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'select',
								'id' => 'icon-type',
								'label' => esc_html__( 'Icon Type', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose an icon type.', 'eventchamp' ),
								'std' => 'font-icon',
								'choices' => array(
									array(
										'label' => esc_html__( 'Font Icon', 'eventchamp' ),
										'value' => 'font-icon',
									),
									array(
										'label' => esc_html__( 'Image Icon', 'eventchamp' ),
										'value' => 'image-icon',
									),
								),
							),
							array(
								'type' => 'text',
								'id' => 'font-icon',
								'label' => esc_html__( 'Font Icon', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter an icon. Example: fab fa-wordpress-simple, fas fa-map-marker-alt. Icon list: https://goo.gl/vdPEsc', 'eventchamp' ),
								'condition' => 'icon-type:is(font-icon)',
							),
							array(
								'type' => 'upload',
								'id' => 'image-icon',
								'label' => esc_html__( 'Image Icon', 'eventchamp' ),
								'desc' => esc_html__( 'You can upload an image icon.', 'eventchamp' ),
								'condition' => 'icon-type:is(image-icon)',
							),
							array(
								'type' => 'textarea',
								'id' => 'text',
								'label' => esc_html__( 'Text', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a text.', 'eventchamp' ),
							),
						),
					),
					array(
						'type' => 'list-item',
						'id' => 'venue-extra-buttons',
						'label' => esc_html__( 'Sidebar Buttons', 'eventchamp' ),
						'desc' => esc_html__( 'You can create buttons for the sidebar. If you want to create buttons for all venues, you can create buttons from the Theme Settings > Venues page.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'text',
								'id' => 'link',
								'label' => esc_html__( 'Link URL', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a link url.', 'eventchamp' ),
							),
							array(
								'type' => 'radio',
								'id' => 'target',
								'label' => esc_html__( 'Target', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a target type.', 'eventchamp' ),
								'std' => '_self',
								'choices' => array(
									array(
										'label' => esc_html__( 'Self', 'eventchamp' ),
										'value' => '_self',
									),
									array(
										'label' => esc_html__( 'Blank', 'eventchamp' ),
										'value' => '_blank',
									),
								),
							),
						),
					),
					array(
						'type' => 'list-item',
						'id' => 'venue-sidebar-boxes',
						'label' => esc_html__( 'Sidebar Boxes', 'eventchamp' ),
						'desc' => esc_html__( 'You can create extra sidebar content boxes from here.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'textarea',
								'id' => 'text',
								'label' => esc_html__( 'Text', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a text. Shortcodes are allowed.', 'eventchamp' ),
							),
						),
					),
				array(
					'type' => 'tab',
					'id' => 'contact',
					'label' => esc_html__( 'Contact', 'eventchamp' ),
				),
					array(
						'type' => 'text',
						'id' => 'venue_detailed_address',
						'label' => esc_html__( 'Address', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter the address of the venue.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'venue_phone',
						'label' => esc_html__( 'Phone Number', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter the phone number of the venue.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'venue_fax',
						'label' => esc_html__( 'Fax Number', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter the fax number of the venue.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'venue_email',
						'label' => esc_html__( 'Email Address', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter the email address of the venue.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'venue-website',
						'label' => esc_html__( 'Website', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter the website address of the venue.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'venue-map-lat',
						'label' => esc_html__( 'Map Lat', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter venue lat coordinate of the venue.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'venue-map-lng',
						'label' => esc_html__( 'Map Lng', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter venue lng coordinate of the venue.', 'eventchamp' ),
					),
					array(
						'type' => 'text',
						'id' => 'venue-map-zoom',
						'label' => esc_html__( 'Map Zoom', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a map zoom value. You can change default zoom value from Theme Settings > Venue > Map page.', 'eventchamp' ),
					),
					array(
						'type' => 'select',
						'id' => 'venue-map-style',
						'label' => esc_html__( 'Map Style', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a map style.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Style 1', 'eventchamp' ),
								'value' => '1',
							),
							array(
								'label' => esc_html__( 'Style 2', 'eventchamp' ),
								'value' => '2',
							),
							array(
								'label' => esc_html__( 'Style 3', 'eventchamp' ),
								'value' => '3',
							),
							array(
								'label' => esc_html__( 'Style 4', 'eventchamp' ),
								'value' => '4',
							),
							array(
								'label' => esc_html__( 'Style 5', 'eventchamp' ),
								'value' => '5',
							),
							array(
								'label' => esc_html__( 'Style 6', 'eventchamp' ),
								'value' => '6',
							),
							array(
								'label' => esc_html__( 'Style 7', 'eventchamp' ),
								'value' => '7',
							),
							array(
								'label' => esc_html__( 'Style 8', 'eventchamp' ),
								'value' => '8',
							),
							array(
								'label' => esc_html__( 'Style 9', 'eventchamp' ),
								'value' => '9',
							),
							array(
								'label' => esc_html__( 'Style 10', 'eventchamp' ),
								'value' => '10',
							),
							array(
								'label' => esc_html__( 'Style 11', 'eventchamp' ),
								'value' => '11',
							),
							array(
								'label' => esc_html__( 'Style 12', 'eventchamp' ),
								'value' => '12',
							),
							array(
								'label' => esc_html__( 'Style 13', 'eventchamp' ),
								'value' => '13',
							),
						),
					),
					array(
						'type' => 'upload',
						'id' => 'venue-map-icon',
						'label' => esc_html__( 'Map Icon', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload a map icon. If leave blank, default map icon will come theme settings panel. You can change default icon from Theme Settings > Venue > Map page.', 'eventchamp' ),
					),
				array(
					'type' => 'tab',
					'id' => 'venue-header',
					'label' => esc_html__( 'Venue Header', 'eventchamp' ),
				),
					array(
						'type' => 'select',
						'id' => 'venue-header-status',
						'label' => esc_html__( 'Venue Header Status', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the venue header. You can change default option from the Theme Settings > Venues > Venue Header page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Show', 'eventchamp' ),
								'value' => 'true',
							),
							array(
								'label' => esc_html__( 'Hide', 'eventchamp' ),
								'value' => 'false',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'venue-header-style',
						'label' => esc_html__( 'Venue Header Style', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a content header style. You can change default option from the Theme Settings > Venues > Venue Header page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Image', 'eventchamp' ),
								'value' => 'image',
							),
							array(
								'label' => esc_html__( 'Image Slider', 'eventchamp' ),
								'value' => 'image-slider',
							),
							array(
								'label' => esc_html__( 'Image Gallery', 'eventchamp' ),
								'value' => 'image-gallery',
							),
							array(
								'label' => esc_html__( 'Video', 'eventchamp' ),
								'value' => 'video',
							),
							array(
								'label' => esc_html__( 'Audio', 'eventchamp' ),
								'value' => 'audio',
							),
							array(
								'label' => esc_html__( 'Code', 'eventchamp' ),
								'value' => 'code',
							),
						),
					),
					array(
						'type' => 'upload',
						'id' => 'venue_featured_image',
						'label' => esc_html__( 'Image', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload an image for the venue header. If leave blank it, the image will come from the Featured Image field.', 'eventchamp' ),
					),
					array(
						'type' => 'gallery',
						'id' => 'header-image-gallery',
						'label' => esc_html__( 'Image Gallery & Image Slider Images', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload images to the image gallery or the image slider for the venue header.', 'eventchamp' ),
					),
					array(
						'type' => 'textarea-simple',
						'id' => 'header-type-code',
						'label' => esc_html__( 'Code', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter your custom codes (For video, audio or codes styles) for the venue header.', 'eventchamp' ),
					),
				array(
					'type' => 'tab',
					'id' => 'media',
					'label' => esc_html__( 'Media', 'eventchamp' ),
				),
					array(
						'type' => 'upload',
						'id' => 'custom_title_bg',
						'label' => esc_html__( 'Page Title Bar Background', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload a background image for the page title banner. Recommended: 1920x350', 'eventchamp' ),
					),
					array(
						'type' => 'select',
						'id' => 'venue-photos-status',
						'label' => esc_html__( 'Photos Status', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the photos. You can change default option from the Theme Settings > Venues > Media page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( 'Show', 'eventchamp' ),
								'value' => 'true',
							),
							array(
								'label' => esc_html__( 'Hide', 'eventchamp' ),
								'value' => 'false',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'venue-photo-column',
						'label' => esc_html__( 'Photo Column', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a photo listing column. You can change default option from the Theme Settings > Venues > Media page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( '1', 'eventchamp' ),
								'value' => '1',
							),
							array(
								'label' => esc_html__( '2', 'eventchamp' ),
								'value' => '2',
							),
							array(
								'label' => esc_html__( '3', 'eventchamp' ),
								'value' => '3',
							),
							array(
								'label' => esc_html__( '4', 'eventchamp' ),
								'value' => '4',
							),
							array(
								'label' => esc_html__( '5', 'eventchamp' ),
								'value' => '5',
							),
						),
					),
					array(
						'type' => 'select',
						'id' => 'venue-photo-column-space',
						'label' => esc_html__( 'Photo Column Space', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a column space for the photo listing. You can change default option from the Theme Settings > Venues > Media page.', 'eventchamp' ),
						'std' => 'default',
						'choices' => array(
							array(
								'label' => esc_html__( 'Default', 'eventchamp' ),
								'value' => 'default',
							),
							array(
								'label' => esc_html__( '0', 'eventchamp' ),
								'value' => '0',
							),
							array(
								'label' => esc_html__( '5', 'eventchamp' ),
								'value' => '5',
							),
							array(
								'label' => esc_html__( '10', 'eventchamp' ),
								'value' => '10',
							),
							array(
								'label' => esc_html__( '15', 'eventchamp' ),
								'value' => '15',
							),
							array(
								'label' => esc_html__( '20', 'eventchamp' ),
								'value' => '20',
							),
							array(
								'label' => esc_html__( '25', 'eventchamp' ),
								'value' => '25',
							),
							array(
								'label' => esc_html__( '30', 'eventchamp' ),
								'value' => '30',
							),
							array(
								'label' => esc_html__( '35', 'eventchamp' ),
								'value' => '35',
							),
							array(
								'label' => esc_html__( '40', 'eventchamp' ),
								'value' => '40',
							),
							array(
								'label' => esc_html__( '45', 'eventchamp' ),
								'value' => '45',
							),
							array(
								'label' => esc_html__( '50', 'eventchamp' ),
								'value' => '50',
							),
						),
					),
					array(
						'type' => 'gallery',
						'id' => 'venue_image_gallery',
						'label' => esc_html__( 'Photos for the Photos Section', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload photos for the photos section.', 'eventchamp' ),
					),
				array(
					'type' => 'tab',
					'id' => 'network',
					'label' => esc_html__( 'Network', 'eventchamp' ),
				),
					array(
						'type' => 'list-item',
						'id' => 'social-links',
						'label' => esc_html__( 'Social Links', 'eventchamp' ),
						'desc' => esc_html__( 'You can create the social links of the event from this panel.', 'eventchamp' ),
						'settings' => array(
							array(
								'type' => 'select',
								'id' => 'icon',
								'label' => esc_html__( 'Icon', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a brand icon.', 'eventchamp' ),
								'choices' => eventchamp_social_media_sites_array(),
							),
							array(
								'type' => 'text',
								'id' => 'url',
								'label' => esc_html__( 'Link URL', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a URL.', 'eventchamp' ),
							),
							array(
								'type' => 'radio',
								'id' => 'target',
								'label' => esc_html__( 'Target', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a target type.', 'eventchamp' ),
								'std' => '_blank',
								'choices' => array(
									array(
										'label' => esc_html__( 'Blank', 'eventchamp' ),
										'value' => '_blank'
									),
									array(
										'label' => esc_html__( 'Self', 'eventchamp' ),
										'value' => '_self'
									),
								),
							),
						),
					),
			)
		);
		ot_register_meta_box( $page_meta_box );

	}
	add_action( 'admin_init', 'eventchamp_meta_boxes' );

}
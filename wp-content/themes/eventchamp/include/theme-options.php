<?php
/*======
*
* Theme Options
*
======*/
if( !function_exists( 'eventchamp_theme_options' ) ) {

	function eventchamp_theme_options() {

		if ( ! function_exists( 'ot_settings_id' ) || ! is_admin() )
		return false;

		$saved_settings = get_option( ot_settings_id(), array() );
		
		$custom_settings = array(
			'contextual_help' => array(
				'content' => array(
					array(
						'id' => 'option_types_help',
						'title' => esc_html__( 'Header Settings', 'eventchamp' ),
						'content' => '<p>' . esc_html__( 'Help content goes here!', 'eventchamp' ) . '</p>',
					)
				),
				'sidebar' => '<p>' . esc_html__( 'Sidebar content goes here!', 'eventchamp' ) . '</p>',
			),
			
			'sections' => array(
				array(
					'title' => '<span class="dashicons dashicons-admin-site"></span>' . esc_html__( 'General', 'eventchamp' ),
					'id' => 'general',
				),
				array(
					'title' => '<span class="dashicons dashicons-editor-kitchensink"></span>' . esc_html__( 'Header', 'eventchamp' ),
					'id' => 'header',
				),
				array(
					'title' => '<span class="dashicons dashicons-image-rotate-left"></span>' . esc_html__( 'Footer', 'eventchamp' ),
					'id' => 'footer',
				),
				array(
					'title' => '<span class="dashicons dashicons-editor-kitchensink"></span>' . esc_html__( 'Page Title Bar', 'eventchamp' ),
					'id' => 'page-title-bar',
				),
				array(
					'title' => '<span class="dashicons dashicons-admin-users"></span>' . esc_html__( 'User Box', 'eventchamp' ),
					'id' => 'user-box',
				),
				array(
					'title' => '<span class="dashicons dashicons-calendar-alt"></span>' . esc_html__( 'Events', 'eventchamp' ),
					'id' => 'events',
				),
				array(
					'title' => '<span class="dashicons dashicons-location"></span>' . esc_html__( 'Venues', 'eventchamp' ),
					'id' => 'venues',
				),
				array(
					'title' => '<span class="dashicons dashicons-admin-users"></span>' . esc_html__( 'Speakers', 'eventchamp' ),
					'id' => 'speakers',
				),
				array(
					'title' => '<span class="dashicons dashicons-calendar"></span>' . esc_html__( 'Datepicker', 'eventchamp' ),
					'id' => 'datepicker',
				),
				array(
					'title' => '<span class="dashicons dashicons-menu"></span>' . esc_html__( 'Flex Menu', 'eventchamp' ),
					'id' => 'flex-menu',
				),
				array(
					'title' => '<span class="dashicons dashicons-admin-page"></span>' . esc_html__( 'Pages', 'eventchamp' ),
					'id' => 'pages',
				),
				array(
					'title' => '<span class="dashicons dashicons-media-text"></span>' . esc_html__( 'Posts', 'eventchamp' ),
					'id' => 'posts',
				),
				array(
					'title' => '<span class="dashicons dashicons-admin-appearance"></span>' . esc_html__( 'Color', 'eventchamp' ),
					'id' => 'colors',
				),
				array(
					'title' => '<span class="dashicons dashicons-editor-justify"></span>' . esc_html__( 'Typography', 'eventchamp' ),
					'id' => 'fonts',
				),
				array(
					'title' => '<span class="dashicons dashicons-archive"></span>' . esc_html__( 'Blog', 'eventchamp' ),
					'id' => 'archives',
				),
				array(
					'title' => '<span class="dashicons dashicons-images-alt2"></span>' . esc_html__( 'Fancybox', 'eventchamp' ),
					'id' => 'fancybox',
				),
				array(
					'title' => '<span class="dashicons dashicons-shield"></span>' . esc_html__( 'Cookie Bar', 'eventchamp' ),
					'id' => 'cookie-bar',
				),
				array(
					'title' => '<span class="dashicons dashicons-admin-network"></span>' . esc_html__( 'Password Protected', 'eventchamp' ),
					'id' => 'password-protected',
				),
				array(
					'title' => '<span class="dashicons dashicons-list-view"></span>' . esc_html__( 'Post Types & Taxonomies', 'eventchamp' ),
					'id' => 'post-types-taxonomies',
				),
				array(
					'title' => '<span class="dashicons dashicons-share"></span>' . esc_html__( 'Social Media', 'eventchamp' ),
					'id' => 'social-media',
				),
				array(
					'title' => '<span class="dashicons dashicons-hammer"></span>' . esc_html__( 'Custom Codes', 'eventchamp' ),
					'id' => 'customcodes',
				),
			),

			'settings' => array(
				/*====== General ======*/
					array(
						'type' => 'on-off',
						'id' => 'eventchamp_loader',
						'label' => esc_html__( 'Loader Status', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the loader.', 'eventchamp' ),
						'section' => 'general',
						'std' => 'off',
					),
					array(
						'type' => 'radio',
						'id' => 'loader_style',
						'label' => esc_html__( 'Loader Style', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a loader style.', 'eventchamp' ),
						'section' => 'general',
						'std' => 'style1',
						'choices' => array(
							array(
								'label' => esc_html__( 'Style 1', 'eventchamp' ),
								'value' => 'style1'
							),
							array(
								'label' => esc_html__( 'Style 2', 'eventchamp' ),
								'value' => 'style2'
							),
							array(
								'label' => esc_html__( 'Style 3', 'eventchamp' ),
								'value' => 'style3'
							),
							array(
								'label' => esc_html__( 'Style 4', 'eventchamp' ),
								'value' => 'style4'
							),
						),
					),
					array(
						'type' => 'text',
						'id' => 'googlemapapi',
						'label' => esc_html__( 'Google Maps API', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter your Google Maps API. You can find how to create an API key on the documentation.', 'eventchamp' ),
						'section' => 'general',
					),
					array(
						'type' => 'on-off',
						'id' => 'rtl',
						'label' => esc_html__( 'RTL', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the RTL.', 'eventchamp' ),
						'section' => 'general',
						'std' => 'off',
					),
					array(
						'type' => 'on-off',
						'id' => 'instantclick',
						'label' => esc_html__( 'InstantClick', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the InstantClick function. InstantClick is a JavaScript library that dramatically speeds up your website, making navigation effectively instant in most cases. Before visitors click on a link, they hover over that link. Between these two events, 200 ms to 300 ms usually pass by (test yourself here). InstantClick makes use of that time to preload the page, so that the page is already there when you click.', 'eventchamp' ),
						'section' => 'general',
						'std' => 'off',
					),
					array(
						'type' => 'on-off',
						'id' => 'eventchamp_boxed',
						'label' => esc_html__( 'Boxed Wrapper', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the wrapper layout.', 'eventchamp' ),
						'section' => 'general',
						'std' => 'off',
					),
					array(
						'type' => 'on-off',
						'id' => 'eventchamp_box_layout',
						'label' => esc_html__( 'Box Layout Design', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the box layout. If you do not want to use the box layout, choose off. Also you can customize the colors from the Colors tab.', 'eventchamp' ),
						'section' => 'general',
						'std' => 'on',
					),
					array(
						'type' => 'radio',
						'id' => 'pagination-style',
						'label' => esc_html__( 'Pagination Style', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a pagination style.', 'eventchamp' ),
						'section' => 'general',
						'std' => '1',
						'choices' => array(
							array(
								'label' => esc_html__( 'Next and Previous Links', 'eventchamp' ),
								'value' => '1'
							),
							array(
								'label' => esc_html__( 'Number Links', 'eventchamp' ),
								'value' => '2'
							),
						),
					),
					array(
						'type' => 'on-off',
						'id' => 'eventchamp_social_login',
						'label' => esc_html__( 'Social Login', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the social login status.', 'eventchamp' ),
						'section' => 'general',
						'std' => 'off',
					),
					array(
						'type' => 'text',
						'id' => 'eventchamp_social_login_shortcode',
						'label' => esc_html__( 'Social Login Shortcode', 'eventchamp' ),
						'desc' => esc_html__( 'Enter the shortcode of the social login plugin you are using. You can use WordPress Social Login plugin for the social login. You can find all details on the documentation.', 'eventchamp' ),
						'section' => 'general',
						'condition' => 'eventchamp_social_login:is(on)',
					),
					array(
						'type' => 'on-off',
						'id' => 'eventchamp-responsive',
						'label' => esc_html__( 'Responsive', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the responsive.', 'eventchamp' ),
						'section' => 'general',
						'std' => 'on',
					),
					array(
						'type' => 'numeric-slider',
						'id' => 'event-excerpt-length',
						'label' => esc_html__( 'Excerpt Length', 'eventchamp' ),
						'desc' => esc_html__( 'You can define an excerpt length.', 'eventchamp' ),
						'section' => 'general',
						'std' => '40',
						'min_max_step'=> '1,500,1',
					),
					array(
						'type' => 'on-off',
						'id' => 'sticky-sidebar',
						'label' => esc_html__( 'Sticky Sidebar', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the sticky sidebar.', 'eventchamp' ),
						'section' => 'general',
						'std' => 'off',
					),
					array(
						'type' => 'radio-image',
						'id' => 'sidebar_position',
						'label' => esc_html__( 'Default Sidebar Position', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a sidebar position for the default sidebar position.', 'eventchamp' ),
						'section' => 'general',
						'std' => 'right',
					),
					array(
						'type' => 'list-item',
						'id' => 'custom_sidebars',
						'label' => esc_html__( 'Create Sidebar', 'eventchamp' ),
						'desc' => esc_html__( 'You can create unlimited sidebars from here.', 'eventchamp' ),
						'section' => 'general',
						'settings' => array(
							array(
								'type' => 'text',
								'id' => 'id',
								'label' => esc_html__( 'Sidebar ID', 'eventchamp' ),
								'desc' => esc_html__( 'Please write a lowercase and unique id, with no spaces. Example: new-sidebar', 'eventchamp' ),
							)
						)
					),

				/*====== Header ======*/
					array(
						'type' => 'on-off',
						'id' => 'hide_header',
						'label' => esc_html__( 'Header Status', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the header.', 'eventchamp' ),
						'section' => 'header',
						'std' => 'on',
					),
					array(
						'type' => 'select',
						'id' => 'header_layout_select',
						'label' => esc_html__( 'Header Style', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a header style.', 'eventchamp' ),
						'section' => 'header',
						'std' => 'header-style-3',
						'choices' => array(
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
						'type' => 'on-off',
						'id' => 'hide_header_logo',
						'label' => esc_html__( 'Header Logo Status', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the header logo.', 'eventchamp' ),
						'section' => 'header',
						'std' => 'on',
					),
					array(
						'type' => 'upload',
						'id' => 'eventchamp_logo',
						'label' => esc_html__( 'Logo', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload a site logo for the header.', 'eventchamp' ),
						'section' => 'header',
					),
					array(
						'type' => 'upload',
						'id' => 'eventchamp_logo_alternative',
						'label' => esc_html__( 'Alternative Logo', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload an alternative site logo for the header.', 'eventchamp' ),
						'section' => 'header',
					),
					array(
						'type' => 'measurement',
						'id' => 'logo_height',
						'label' => esc_html__( 'Logo Height', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a logo height for the header. Recommended type px.', 'eventchamp' ),
						'section' => 'header',
					),
					array(
						'type' => 'measurement',
						'id' => 'logo_width',
						'label' => esc_html__( 'Logo Width', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a logo width for the header. Recommended type px.', 'eventchamp' ),
						'section' => 'header',
					),
					array(
						'type' => 'on-off',
						'id' => 'header_fixed',
						'label' => esc_html__( 'Sticky Header', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the sticky header.', 'eventchamp' ),
						'section' => 'header',
						'std' => 'off',
					),
					array(
						'type' => 'on-off',
						'id' => 'header_social_media',
						'label' => esc_html__( 'Social Links', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the social links for the header.', 'eventchamp' ),
						'section' => 'header',
						'std' => 'off',
					),
					array(
						'type' => 'on-off',
						'id' => 'header_cart',
						'label' => esc_html__( 'Cart', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the cart icon for the header.', 'eventchamp' ),
						'section' => 'header',
						'std' => 'off',
					),
					array(
						'type' => 'text',
						'id' => 'header_cart_custom_link',
						'label' => esc_html__( 'Cart Custom Link', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a custom link for the cart. If you leave blank it, WooCommerce cart link will added.', 'eventchamp' ),
						'section' => 'header',
					),
					array(
						'type' => 'upload',
						'id' => 'eventchamp_mobile_logo',
						'label' => esc_html__( 'Mobile Logo', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload a mobile logo for the header.', 'eventchamp' ),
						'section' => 'header',
					),
					array(
						'type' => 'measurement',
						'id' => 'mobile_header_logo_height',
						'label' => esc_html__( 'Mobile Header Logo Height', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a logo height for the mobile header. Recommended type px.', 'eventchamp' ),
						'section' => 'header',
					),
					array(
						'type' => 'measurement',
						'id' => 'mobile_header_logo_width',
						'label' => esc_html__( 'Mobile Header Logo Width', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a logo width for the mobile header. Recommended type px.', 'eventchamp' ),
						'section' => 'header',
					),
					array(
						'type' => 'measurement',
						'id' => 'mobile_menu_logo_height',
						'label' => esc_html__( 'Mobile Menu Logo Height', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a logo height for the mobile menu. Recommended type px.', 'eventchamp' ),
						'section' => 'header',
					),
					array(
						'type' => 'measurement',
						'id' => 'mobile_menu_logo_width',
						'label' => esc_html__( 'Mobile Menu Logo Width', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a logo width for the mobile menu. Recommended type px.', 'eventchamp' ),
						'section' => 'header',
					),

				/*====== Footer ======*/
					array(
						'type' => 'on-off',
						'id' => 'hide_footer',
						'label' => esc_html__( 'Footer Status', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the footer.', 'eventchamp' ),
						'section' => 'footer',
						'std' => 'on',
					),
					array(
						'type' => 'select',
						'id' => 'default_footer_style',
						'label' => esc_html__( 'Footer Style', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a footer style.', 'eventchamp' ),
						'section' => 'footer',
						'std' => 'footer-style-1',
						'choices' => array(
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
						'type' => 'page-select',
						'id' => 'page_footer_style_1',
						'label' => esc_html__( 'Footer Page', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a page for the footer.', 'eventchamp' ),
						'section' => 'footer',
					),
					array(
						'type' => 'background',
						'id' => 'eventchamp_footer_bg_style_1',
						'label' => esc_html__( 'Background for Footer Style 1', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload a background for the footer style 1.', 'eventchamp' ),
						'section' => 'footer',
					),
					array(
						'type' => 'background',
						'id' => 'eventchamp_footer_bg_style_2',
						'label' => esc_html__( 'Background for Footer Style 2', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload a background for the footer style 2.', 'eventchamp' ),
						'section' => 'footer',
					),
					array(
						'type' => 'text',
						'id' => 'footer_copyright_text',
						'label' => esc_html__( 'Copyright Text', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a copyright text.', 'eventchamp' ),
						'section' => 'footer',
					),
					array(
						'type' => 'on-off',
						'id' => 'hide_footer_logo',
						'label' => esc_html__( 'Footer Logo', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the footer logo.', 'eventchamp' ),
						'section' => 'footer',
						'std' => 'on',
					),
					array(
						'type' => 'measurement',
						'id' => 'footer_logo_height',
						'label' => esc_html__( 'Logo Height', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a height for the footer logo. Recommended type px.', 'eventchamp' ),
						'section' => 'footer',
					),
					array(
						'type' => 'measurement',
						'id' => 'footer_logo_width',
						'label' => esc_html__( 'Logo Width', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a width for the footer logo. Recommended type px.', 'eventchamp' ),
						'section' => 'footer',
					),
					array(
						'type' => 'upload',
						'id' => 'eventchamp_footer_logo',
						'label' => esc_html__( 'Logo Upload', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload a logo for the footer.', 'eventchamp' ),
						'section' => 'footer',
					),

				/*====== Page Title Bar ======*/
					array(
						'type' => 'on-off',
						'id' => 'page_title_bar',
						'label' => esc_html__( 'Page Title Bar', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the page title bar.', 'eventchamp' ),
						'section' => 'page-title-bar',
						'std' => 'on',
					),
					array(
						'type' => 'background',
						'id' => 'page_title_background',
						'label' => esc_html__( 'Background', 'eventchamp' ),
						'desc' => esc_html__( 'You can upload a background for the page title bar. Recommended size: 1920x350', 'eventchamp' ),
						'section' => 'page-title-bar',
					),
					array(
						'type' => 'numeric-slider',
						'id' => 'page_title_background_opacity',
						'label' => esc_html__( 'Background Opacity', 'eventchamp' ),
						'desc' => esc_html__( 'You can change the opacity of the page title bar. Default: 0.25', 'eventchamp' ),
						'section' => 'page-title-bar',
						'min_max_step'=> '0,1,0.01',
						'std' => '0.25'
					),
					array(
						'type' => 'text',
						'id' => 'page_title_bar_top_padding',
						'label' => esc_html__( 'Top Padding', 'eventchamp' ),
						'desc' => esc_html__( 'You can define a top padding for the page title bar. Example: 150px', 'eventchamp' ),
						'section' => 'page-title-bar',
					),
					array(
						'type' => 'text',
						'id' => 'page_title_bar_bottom_padding',
						'label' => esc_html__( 'Bottom Padding', 'eventchamp' ),
						'desc' => esc_html__( 'You can define a bottom padding for the page title bar. Example: 150px', 'eventchamp' ),
						'section' => 'page-title-bar',
					),
					array(
						'type' => 'on-off',
						'id' => 'page_title_bar_breadcrumbs',
						'label' => esc_html__( 'Breadcrumbs', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the breadcrumbs.', 'eventchamp' ),
						'section' => 'page-title-bar',
						'std' => 'on',
					),

				/*====== User Box ======*/
					array(
						'type' => 'on-off',
						'id' => 'header_user_box',
						'label' => esc_html__( 'User Box', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the user box.', 'eventchamp' ),
						'section' => 'user-box',
						'std' => 'on',
					),
					array(
						'type' => 'on-off',
						'id' => 'header_user_box_register_notice',
						'label' => esc_html__( 'Sign Up Notice', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the notice of the sign up.', 'eventchamp' ),
						'section' => 'user-box',
						'std' => 'on'
					),
					array(
						'type' => 'page-select',
						'id' => 'page_terms_and_conditions',
						'label' => esc_html__( 'Terms and Conditions Page', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a page for the terms and conditions.', 'eventchamp' ),
						'section' => 'user-box',
					),
					array(
						'type' => 'page-select',
						'id' => 'page_privacy_policy',
						'label' => esc_html__( 'Privacy Policy Page', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a page for the privacy policy.', 'eventchamp' ),
						'section' => 'user-box',
					),
					array(
						'type' => 'textarea',
						'id' => 'header_user_box_register_notice_text',
						'label' => esc_html__( 'Sign Up Notice Text', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a notice text for the sign up notice. If you enter any text, default text will be hide.', 'eventchamp' ),
						'section' => 'user-box',
					),
					array(
						'type' => 'on-off',
						'id' => 'header_user_box_language',
						'label' => esc_html__( 'Language Switcher', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the language switcher.', 'eventchamp' ),
						'section' => 'user-box',
						'std' => 'on',
					),
					array(
						'type' => 'radio',
						'id' => 'header_user_box_language_position',
						'label' => esc_html__( 'Language Switcher Position', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a position.', 'eventchamp' ),
						'section' => 'user-box',
						'std' => 'before-log-out',
						'choices' => array(
							array(
								'label' => esc_html__( 'Before the Log Out', 'eventchamp' ),
								'value' => 'before-log-out',
							),
							array(
								'label' => esc_html__( 'After the Profile', 'eventchamp' ),
								'value' => 'after-profile',
							),
							array(
								'label' => esc_html__( 'Before Available Links', 'eventchamp' ),
								'value' => 'before-content',
							),
							array(
								'label' => esc_html__( 'After Available Links', 'eventchamp' ),
								'value' => 'after-content',
							),
						),
					),
					array(
						'type' => 'on-off',
						'id' => 'header_user_box_language_flag',
						'label' => esc_html__( 'Flag on the Language Switcher', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the flag for the activate language on the language switcher.', 'eventchamp' ),
						'section' => 'user-box',
						'std' => 'off',
					),
					array(
						'type' => 'on-off',
						'id' => 'header_user_box_language_flag_dropdown',
						'label' => esc_html__( 'Flag on the Language Switcher Dropdown', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the flag for the language switcher dropdown.', 'eventchamp' ),
						'section' => 'user-box',
						'std' => 'on',
					),
					array(
						'type' => 'radio',
						'id' => 'header_user_box_language_name_type',
						'label' => esc_html__( 'Language Switcher Name Type', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a name type.', 'eventchamp' ),
						'section' => 'user-box',
						'std' => 'full-name',
						'choices' => array(
							array(
								'label' => esc_html__( 'Full Name', 'eventchamp' ),
								'value' => 'full-name',
							),
							array(
								'label' => esc_html__( 'Short Name', 'eventchamp' ),
								'value' => 'short-name',
							),
						),
					),
					array(
						'type' => 'on-off',
						'id' => 'header_user_box_login_button',
						'label' => esc_html__( 'Login Button', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the login button.', 'eventchamp' ),
						'section' => 'user-box',
						'std' => 'on',
					),
					array(
						'type' => 'text',
						'id' => 'header_user_box_custom_login',
						'label' => esc_html__( 'Custom Login Link', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a custom link for the login button.', 'eventchamp' ),
						'section' => 'user-box',
					),
					array(
						'type' => 'on-off',
						'id' => 'header_user_box_register_button',
						'label' => esc_html__( 'Register Button', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the register button.', 'eventchamp' ),
						'section' => 'user-box',
						'std' => 'on',
					),
					array(
						'type' => 'text',
						'id' => 'header_user_box_custom_register',
						'label' => esc_html__( 'Custom Register Link', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a custom link for the register button.', 'eventchamp' ),
						'section' => 'user-box',
					),
					array(
						'type' => 'on-off',
						'id' => 'header_user_box_reset_password_button',
						'label' => esc_html__( 'Reset Password Button', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the reset password button.', 'eventchamp' ),
						'section' => 'user-box',
						'std' => 'on',
					),
					array(
						'type' => 'text',
						'id' => 'header_user_box_custom_password',
						'label' => esc_html__( 'Custom Reset Password Link', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a custom link for the reset password button.', 'eventchamp' ),
						'section' => 'user-box',
					),
					array(
						'type' => 'on-off',
						'id' => 'header_user_box_profile_button',
						'label' => esc_html__( 'Profile Button', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the profile button.', 'eventchamp' ),
						'section' => 'user-box',
						'std' => 'on',
					),
					array(
						'type' => 'text',
						'id' => 'header_user_box_custom_profile',
						'label' => esc_html__( 'Custom Profile Link', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a custom link for the profile button.', 'eventchamp' ),
						'section' => 'user-box',
					),
					array(
						'type' => 'on-off',
						'id' => 'header_user_box_my_tickets_button',
						'label' => esc_html__( 'My Tickets Button', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the my tickets button.', 'eventchamp' ),
						'section' => 'user-box',
						'std' => 'on',
					),
					array(
						'type' => 'text',
						'id' => 'header_user_box_custom_tickets',
						'label' => esc_html__( 'Custom My Tickets Link', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a custom link for the my tickets button.', 'eventchamp' ),
						'section' => 'user-box',
					),
					array(
						'type' => 'on-off',
						'id' => 'header_user_box_logout_button',
						'label' => esc_html__( 'Log Out Button', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the log out button.', 'eventchamp' ),
						'section' => 'user-box',
						'std' => 'on',
					),
					array(
						'type' => 'text',
						'id' => 'header_user_box_custom_logout',
						'label' => esc_html__( 'Custom Log Out Link', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a custom link for the my tickets button.', 'eventchamp' ),
						'section' => 'user-box',
					),
					array(
						'type' => 'radio',
						'id' => 'header_custom_user_box_position',
						'label' => esc_html__( 'Custom User Box Position', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a position.', 'eventchamp' ),
						'section' => 'user-box',
						'std' => 'before-log-out',
						'choices' => array(
							array(
								'label' => esc_html__( 'Before the Log Out / Before the Register', 'eventchamp' ),
								'value' => 'before-log-out',
							),
							array(
								'label' => esc_html__( 'After the Profile / After the Login', 'eventchamp' ),
								'value' => 'after-profile',
							),
							array(
								'label' => esc_html__( 'Before Available Links', 'eventchamp' ),
								'value' => 'before-content',
							),
							array(
								'label' => esc_html__( 'After Available Links', 'eventchamp' ),
								'value' => 'after-content',
							),
						),
					),
					array(
						'type' => 'list-item',
						'id' => 'header_user_box_custom_links',
						'label' => esc_html__( 'Custom User Box Links', 'eventchamp' ),
						'desc' => esc_html__( 'You can create custom links for the user box.', 'eventchamp' ),
						'section' => 'user-box',
						'settings' => array(
							array(
								'type' => 'text',
								'id' => 'link',
								'label' => esc_html__( 'Link', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a link.', 'eventchamp' ),
							),
							array(
								'type' => 'on-off',
								'id' => 'only-members',
								'label' => esc_html__( 'Only for Members', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose visibility status of the link.', 'eventchamp' ),
								'std' => 'off',
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
						)
					),

				/*====== Events ======*/
					array(
						'type' => 'tab',
						'id' => 'event-tab-general',
						'label' => esc_html__( 'General', 'eventchamp' ),
						'section' => 'events',
					),
						array(
							'type' => 'page-select',
							'id' => 'event_search_result_page',
							'label' => esc_html__( 'Event Search Results Page', 'eventchamp' ),
							'desc' => esc_html__( 'You should choose a page for the event search results. An Event Search Results element should be in this page. Also a Search Results page comes with the demo content, you can choose it.', 'eventchamp' ),
							'section' => 'events',
						),
						array(
							'type' => 'radio',
							'id' => 'event-listing-style',
							'label' => esc_html__( 'Event Listing Style for the Archives', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose an event listing style for the archives and the taxonomies of the events.', 'eventchamp' ),
							'section' => 'events',
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
							),
						),
						array(
							'type' => 'numeric-slider',
							'id' => 'event-listing-column',
							'label' => esc_html__( 'Event Listing Column for the Archives', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose an event listing column for the archives and the taxonomies of the events.', 'eventchamp' ),
							'section' => 'events',
							'std' => '2',
							'min_max_step'=> '1,3,1',
						),
						array(
							'label' => esc_html__( 'Expired Events for Event Archives', 'eventchamp' ),
							'id' => 'event-expired-events-archives',
							'type' => 'on-off',
							'desc' => esc_html__( 'You can choose status of expired events for the event archives. If you choose off, they will be hide.', 'eventchamp' ),
							'std' => 'off',
							'section' => 'events',
						),
						array(
							'type' => 'radio',
							'id' => 'event-archive-order-type',
							'label' => esc_html__( 'Order Type for Event Archives', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose an order type for the event archives.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'start-date',
							'choices' => array(
								array(
									'label' => esc_html__( 'Start Date', 'eventchamp' ),
									'value' => 'start-date',
								),
								array(
									'label' => esc_html__( 'End Date', 'eventchamp' ),
									'value' => 'end-date',
								),
								array(
									'label' => esc_html__( 'Added Date', 'eventchamp' ),
									'value' => 'added-date',
								),
							),
						),
						array(
							'label' => esc_html__( 'Keep Search Options', 'eventchamp' ),
							'id' => 'event-keep-search-options',
							'type' => 'on-off',
							'desc' => esc_html__( 'If you want to keep event search options after search any events, choose on option.', 'eventchamp' ),
							'std' => 'on',
							'section' => 'events',
						),
						array(
							'label' => esc_html__( 'Event Status', 'eventchamp' ),
							'id' => 'event-status',
							'type' => 'on-off',
							'desc' => esc_html__( 'You can choose status of the event status. If you choose off option, the event status will remove from all elements.', 'eventchamp' ),
							'std' => 'on',
							'section' => 'events',
						),
						array(
							'label' => esc_html__( 'Multiple Categories on the Event Listing', 'eventchamp' ),
							'id' => 'event_multiple_categories',
							'type' => 'on-off',
							'desc' => esc_html__( 'You can choose status of the multiple categories on the event listing.', 'eventchamp' ),
							'std' => 'off',
							'section' => 'events',
						),
						array(
							'type' => 'radio',
							'id' => 'event-free-events-price',
							'label' => esc_html__( 'Price of Free Events', 'eventchamp' ),
							'desc' => esc_html__( 'How to do you want to show price of free events?', 'eventchamp' ),
							'section' => 'events',
							'std' => 'free',
							'choices' => array(
								array(
									'label' => esc_html__( 'Free', 'eventchamp' ),
									'value' => 'free',
								),
								array(
									'label' => esc_html__( '0', 'eventchamp' ),
									'value' => '0',
								),
								array(
									'label' => esc_html__( '0 With Currency', 'eventchamp' ),
									'value' => '0-currency',
								),
								array(
									'label' => esc_html__( 'Hide Price on the Free Events.', 'eventchamp' ),
									'value' => 'hide',
								),
							),
						),
						array(
							'type' => 'radio',
							'id' => 'event-price-currency-position',
							'label' => esc_html__( 'Price Currency Position', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a price currency. If you are using WooCommerce product for the tickets, you can change this setting from WooCommerce page.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'left',
							'choices' => array(
								array(
									'label' => esc_html__( 'Left', 'eventchamp' ),
									'value' => 'left',
								),
								array(
									'label' => esc_html__( 'Right', 'eventchamp' ),
									'value' => 'right',
								),
								array(
									'label' => esc_html__( 'Left With Space', 'eventchamp' ),
									'value' => 'left-space',
								),
								array(
									'label' => esc_html__( 'Right With Space', 'eventchamp' ),
									'value' => 'right-space',
								),
							),
						),
						array(
							'type' => 'text',
							'id' => 'event-price-currency',
							'label' => esc_html__( 'Currency of the Price', 'eventchamp' ),
							'desc' => esc_html__( 'You can enter a currency symbol. This price will show on event listing elements and it uses in the event search system. Example: $. If you are using WooCommerce product for the tickets, you can change this setting from WooCommerce page.', 'eventchamp' ),
							'section' => 'events',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-like-system',
							'label' => esc_html__( 'Event Like System', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the event like system. If you choose on, the like button will show on the single events.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-favorite-system',
							'label' => esc_html__( 'Event Favorite System', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the event favorite system. If you choose on, the favorite button will show on the single events.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'text',
							'id' => 'event_contact_form',
							'label' => esc_html__( 'Contact Form Shortcode', 'eventchamp' ),
							'desc' => esc_html__( 'You can enter a contact form shortcode for the contact form in the event details. You can use any contact form plugin. We recommend Contact Form 7 plugin. An example shortcode: [contact-form-7 id="123"]', 'eventchamp' ),
							'section' => 'events',
						),
						array(
							'type' => 'on-off',
							'id' => 'event_comments',
							'label' => esc_html__( 'Event Comments', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the comments for the event single pages.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'list-item',
							'id' => 'event-sidebar-buttons',
							'label' => esc_html__( 'Sidebar Buttons', 'eventchamp' ),
							'desc' => esc_html__( 'You can create buttons for the sidebar.', 'eventchamp' ),
							'section' => 'events',
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
						'type' => 'tab',
						'id' => 'event-tab-tabs-sections',
						'label' => esc_html__( 'Event Tabs & Sections', 'eventchamp' ),
						'section' => 'events',
					),
						array(
							'type' => 'select',
							'id' => 'event-content-listing-type',
							'label' => esc_html__( 'Event Content Listing Type', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose an event content listing type.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'tab',
							'choices' => array(
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
						'type' => 'tab',
						'id' => 'event-tab-speakers',
						'label' => esc_html__( 'Speakers', 'eventchamp' ),
						'section' => 'events',
					),
						array(
							'type' => 'select',
							'id' => 'event-speaker-style',
							'label' => esc_html__( 'Speaker Listing Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a speaker listing style.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'style-3',
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
							'id' => 'event-speaker-column',
							'label' => esc_html__( 'Speaker Listing Column', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a speaker listing column.', 'eventchamp' ),
							'section' => 'events',
							'std' => '2',
							'choices' => array(
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
							'id' => 'event-speaker-column-space',
							'label' => esc_html__( 'Speaker Listing Column Space', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a column space for the speaker listing.', 'eventchamp' ),
							'section' => 'events',
							'std' => '25',
							'choices' => array(
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
							'id' => 'event-speaker-photo',
							'label' => esc_html__( 'Speaker Photo', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the photo for the speaker listing.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'select',
							'id' => 'event-speaker-profession',
							'label' => esc_html__( 'Speaker Profession', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the profession for the speaker listing.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'select',
							'id' => 'event-speaker-summary',
							'label' => esc_html__( 'Speaker Summary', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the summary for the speaker listing.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'select',
							'id' => 'event-speaker-social',
							'label' => esc_html__( 'Speaker Social Links', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the social links for the speaker listing.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'true',
							'choices' => array(
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
						'type' => 'tab',
						'id' => 'event-tab-schedule',
						'label' => esc_html__( 'Schedule', 'eventchamp' ),
						'section' => 'events',
					),
						array(
							'type' => 'select',
							'id' => 'event-schedule-style',
							'label' => esc_html__( 'Schedule Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a schedule style.', 'eventchamp' ),
							'section' => 'events',
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
							'desc' => esc_html__( 'You can choose status of the grouped event schedule. If you choose true, same dates will grouped by schedule order.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'on-off',
							'id' => 'event-schedule-collapsed',
							'label' => esc_html__( 'Schedule Items Collapsed for the Dropdown', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose opening status of the schedule items for the dropdown version (Style 1, Style 2 and Style 3).', 'eventchamp' ),
							'section' => 'events',
							'std' => 'off',
						),
					array(
						'type' => 'tab',
						'id' => 'event-tab-header',
						'label' => esc_html__( 'Event Header', 'eventchamp' ),
						'section' => 'events',
					),
						array(
							'type' => 'select',
							'id' => 'event-header-status',
							'label' => esc_html__( 'Event Header Status', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the event header.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'radio',
							'id' => 'event_header_style',
							'label' => esc_html__( 'Event Header Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a style. It will be default event header style.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'image',
							'choices' => array(
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
							'type' => 'numeric-slider',
							'id' => 'event-header-image-slider-column',
							'label' => esc_html__( 'Image Slider Column for the Event Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a column for the image slider in the event header. Default: 1', 'eventchamp' ),
							'section' => 'events',
							'std' => '1',
							'min_max_step'=> '1,5,1',
						),
						array(
							'type' => 'numeric-slider',
							'id' => 'event-header-image-slider-space',
							'label' => esc_html__( 'Image Slider Space for the Event Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a space value for space between the slides in the event header. Default: 0', 'eventchamp' ),
							'section' => 'events',
							'std' => '0',
							'min_max_step'=> '0,50,5',
						),
						array(
							'type' => 'radio',
							'id' => 'event-header-image-slider-loop',
							'label' => esc_html__( 'Image Slider Loop for the Event Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the loop for the image slider in the event header.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'radio',
							'id' => 'event-header-image-slider-autoplay',
							'label' => esc_html__( 'Image Slider Autoplay for the Event Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the autoplay for the image slider in the event header.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'text',
							'id' => 'event-header-image-slider-autoplay-delay',
							'label' => esc_html__( 'Image Slider Autoplay Delay for the Event Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can enter an autoplay delay for the image slider in the event header. Default: 15000', 'eventchamp' ),
							'section' => 'events',
						),
						array(
							'type' => 'radio',
							'id' => 'event-header-image-slider-direction',
							'label' => esc_html__( 'Image Slider Direction for the Event Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a direction for the image slider in the event header.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'horizontal',
							'choices' => array(
								array(
									'label' => esc_html__( 'Horizontal', 'eventchamp' ),
									'value' => 'horizontal',
								),
								array(
									'label' => esc_html__( 'Vertical', 'eventchamp' ),
									'value' => 'vertical',
								),
							),
						),
						array(
							'type' => 'radio',
							'id' => 'event-header-image-slider-effect',
							'label' => esc_html__( 'Image Slider Effect for the Event Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose an effect for the image slider in the event header.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'slide',
							'choices' => array(
								array(
									'label' => esc_html__( 'Slide', 'eventchamp' ),
									'value' => 'slide',
								),
								array(
									'label' => esc_html__( 'Fade', 'eventchamp' ),
									'value' => 'fade',
								),
								array(
									'label' => esc_html__( 'Cube', 'eventchamp' ),
									'value' => 'cube',
								),
								array(
									'label' => esc_html__( 'Flip', 'eventchamp' ),
									'value' => 'flip',
								),
							),
						),
						array(
							'type' => 'select',
							'id' => 'event-header-label-status',
							'label' => esc_html__( 'Show Labels on Event Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status the labels for the event header.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'true',
							'choices' => array(
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
						'type' => 'tab',
						'id' => 'event-tab-sponsors',
						'label' => esc_html__( 'Sponsors', 'eventchamp' ),
						'section' => 'events',
					),
						array(
							'type' => 'select',
							'id' => 'event-sponsors-status',
							'label' => esc_html__( 'Event Sponsors Status', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the event sponsors for the event sidebar.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'radio',
							'id' => 'event-sponsors-style',
							'label' => esc_html__( 'Event Sponsor Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a style for the event sponsors.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'style-2',
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
								array(
									'label' => esc_html__( 'Style 5', 'eventchamp' ),
									'value' => 'style-5',
								),
							),
						),
						array(
							'type' => 'radio',
							'id' => 'event-sponsors-column-space',
							'label' => esc_html__( 'Event Sponsor Column Space', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a column space for the event sponsors.', 'eventchamp' ),
							'section' => 'events',
							'std' => '10',
							'choices' => array(
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
							'type' => 'numeric-slider',
							'id' => 'event-sponsors-column',
							'label' => esc_html__( 'Event Sponsor Column', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a column for the event sponsors.', 'eventchamp' ),
							'section' => 'events',
							'std' => '2',
							'min_max_step'=> '1,10,1',
						),
					array(
						'type' => 'tab',
						'id' => 'event-tab-detail-box',
						'label' => esc_html__( 'Detail Box', 'eventchamp' ),
						'section' => 'events',
					),
						array(
							'type' => 'on-off',
							'id' => 'event-detail-box-status',
							'label' => esc_html__( 'Event Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the event detail box.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-detail-box-countdown',
							'label' => esc_html__( 'Countdown for the Event Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the countdown for the event detail box.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-detail-box-start',
							'label' => esc_html__( 'Start Date for the Event Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the start date for the event detail box.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-detail-box-end',
							'label' => esc_html__( 'End Date for the Event Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the end date for the event detail box.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-detail-repeat-dates',
							'label' => esc_html__( 'Repeat Dates for the Event Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the repeat dates for the event detail box.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'off',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-detail-box-event-status',
							'label' => esc_html__( 'Event Status for the Event Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the event status for the event detail box.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-detail-box-location',
							'label' => esc_html__( 'Location for the Event Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the location for the event detail box.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-detail-box-venue',
							'label' => esc_html__( 'Venue for the Event Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the venue for the event detail box.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-detail-box-organizer',
							'label' => esc_html__( 'Organizer for the Event Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the organizer for the event detail box.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-detail-box-category',
							'label' => esc_html__( 'Category for the Event Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the category for the event detail box.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-detail-box-address',
							'label' => esc_html__( 'Address for the Event Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the address for the event detail box.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-detail-box-phone',
							'label' => esc_html__( 'Phone for the Event Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the phone for the event detail box.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-detail-box-email',
							'label' => esc_html__( 'Email for the Event Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the email for the event detail box.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-detail-box-fax',
							'label' => esc_html__( 'Fax for the Event Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the fax for the event detail box.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-detail-remaining-tickets',
							'label' => esc_html__( 'Remaining Tickets for the Event Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the remaining tickets for the event detail box.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-detail-box-social',
							'label' => esc_html__( 'Social Links for the Event Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the social links for the event detail box.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-detail-box-extra',
							'label' => esc_html__( 'Extra Details for the Event Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the extra details for the event detail box.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
					array(
						'type' => 'tab',
						'id' => 'event-tab-tickets',
						'label' => esc_html__( 'Tickets', 'eventchamp' ),
						'section' => 'events',
					),
						array(
							'type' => 'select',
							'id' => 'event-ticket-style',
							'label' => esc_html__( 'Ticket Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a ticket style.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'style-4',
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
							'section' => 'events',
							'std' => '2',
							'choices' => array(
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
							'section' => 'events',
							'std' => '25',
							'choices' => array(
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
							'type' => 'numeric-slider',
							'id' => 'event_ticket_package_column_for_events',
							'label' => esc_html__( 'Event Tickets Column', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a column for the ticket tables.', 'eventchamp' ),
							'section' => 'events',
							'std' => '1',
							'min_max_step'=> '1,3,1',
						),
						array(
							'type' => 'select',
							'id' => 'event-ticket-quantity',
							'label' => esc_html__( 'Quantity', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the quantity chooser. Only for WooCommerce.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'numeric-slider',
							'id' => 'event-ticket-max-quantity',
							'label' => esc_html__( 'Max Quantity', 'eventchamp' ),
							'desc' => esc_html__( 'You can define max quantity for the ticket purchase. This feature will show on the ticket purchase table.', 'eventchamp' ),
							'section' => 'events',
							'std' => '10',
							'min_max_step'=> '1,9999,1',
						),
					array(
						'type' => 'tab',
						'id' => 'event-tab-media',
						'label' => esc_html__( 'Media', 'eventchamp' ),
						'section' => 'events',
					),
						array(
							'type' => 'select',
							'id' => 'event-photos-status',
							'label' => esc_html__( 'Photos Status', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the photos.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'true',
							'choices' => array(
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
							'desc' => esc_html__( 'You can choose a photo listing column.', 'eventchamp' ),
							'section' => 'events',
							'std' => '3',
							'choices' => array(
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
							'desc' => esc_html__( 'You can choose a column space for the photo listing.', 'eventchamp' ),
							'section' => 'events',
							'std' => '0',
							'choices' => array(
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
						'type' => 'tab',
						'id' => 'event-tab-map',
						'label' => esc_html__( 'Map', 'eventchamp' ),
						'section' => 'events',
					),
						array(
							'type' => 'text',
							'id' => 'event-map-zoom',
							'label' => esc_html__( 'Map Zoom', 'eventchamp' ),
							'desc' => esc_html__( 'You can enter a map zoom value.', 'eventchamp' ),
							'section' => 'events',
							'std' => '16',
						),
						array(
							'type' => 'select',
							'id' => 'event-map-style',
							'label' => esc_html__( 'Map Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a map style.', 'eventchamp' ),
							'section' => 'events',
							'std' => '1',
							'choices' => array(
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
								array(
									'label' => esc_html__( 'Style 14', 'eventchamp' ),
									'value' => '14',
								),
							),
						),
						array(
							'type' => 'upload',
							'id' => 'event-map-icon',
							'label' => esc_html__( 'Map Icon', 'eventchamp' ),
							'desc' => esc_html__( 'You can upload a map icon.', 'eventchamp' ),
							'section' => 'events',
						),
						array(
							'type' => 'select',
							'id' => 'event-map-type',
							'label' => esc_html__( 'Map Type', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the map type.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'true',
							'choices' => array(
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
							'id' => 'event-map-scale',
							'label' => esc_html__( 'Map Scale', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the map scale.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'true',
							'choices' => array(
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
							'id' => 'event-map-zoom-control',
							'label' => esc_html__( 'Map Zoom Control', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the map zoom control.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'true',
							'choices' => array(
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
							'id' => 'event-map-fullscreen',
							'label' => esc_html__( 'Map Fullscreen', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the map fullscreen control.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'true',
							'choices' => array(
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
							'id' => 'event-map-street',
							'label' => esc_html__( 'Map Streets', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the map streets.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'true',
							'choices' => array(
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
						'type' => 'tab',
						'id' => 'event-tab-add-to-calendars',
						'label' => esc_html__( 'Add to Calendar', 'eventchamp' ),
						'section' => 'events',
					),
						array(
							'type' => 'on-off',
							'id' => 'event-add-to-calendar-status',
							'label' => esc_html__( 'Add to Calendar', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the add to calendar function.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-add-to-calendar-google',
							'label' => esc_html__( 'Add to Calendar: Google Calendar', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of Google Calendar for the add to calendar function.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-add-to-calendar-outlook',
							'label' => esc_html__( 'Add to Calendar: Outlook Calendar', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of Outlook Calendar for the add to calendar function.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-add-to-calendar-apple',
							'label' => esc_html__( 'Add to Calendar: Apple Calendar', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of Apple Calendar for the add to calendar function.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-add-to-calendar-yahoo',
							'label' => esc_html__( 'Add to Calendar: Yahoo Calendar', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of Yahoo Calendar for the add to calendar function.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'event-add-to-calendar-ics',
							'label' => esc_html__( 'Add to Calendar: ICS Export', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of ICS export for the add to calendar function.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
					array(
						'type' => 'tab',
						'id' => 'event-tab-related-events',
						'label' => esc_html__( 'Related Events', 'eventchamp' ),
						'section' => 'events',
					),
						array(
							'type' => 'on-off',
							'id' => 'event_related_events',
							'label' => esc_html__( 'Related Events', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the related events for the event single pages.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'radio',
							'id' => 'related_events_style',
							'label' => esc_html__( 'Related Events Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a style for the related events.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'style-3',
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
							),
						),
						array(
							'type' => 'numeric-slider',
							'id' => 'event_related_events_count',
							'label' => esc_html__( 'Related Events Count', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose an event count for the related events.', 'eventchamp' ),
							'section' => 'events',
							'std' => '3',
							'min_max_step'=> '2,12,1',
						),
					array(
						'type' => 'tab',
						'id' => 'event-tab-tags',
						'label' => esc_html__( 'Tags', 'eventchamp' ),
						'section' => 'events',
					),
						array(
							'type' => 'on-off',
							'id' => 'event-tags',
							'label' => esc_html__( 'Event Tags', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the tags for the event single pages.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'radio',
							'id' => 'event-tags-position',
							'label' => esc_html__( 'Event Tags Position', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a position for show the event tags.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'position-1',
							'choices' => array(
								array(
									'label' => esc_html__( 'Under the Event Content', 'eventchamp' ),
									'value' => 'position-1',
								),
								array(
									'label' => esc_html__( 'On the Sidebar', 'eventchamp' ),
									'value' => 'position-2',
								),
							),
						),
						array(
							'type' => 'radio',
							'id' => 'event-tags-style',
							'label' => esc_html__( 'Event Tags Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a style for the event tags.', 'eventchamp' ),
							'section' => 'events',
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
						'type' => 'tab',
						'id' => 'event-tab-social-sharing',
						'label' => esc_html__( 'Social Sharing', 'eventchamp' ),
						'section' => 'events',
					),
						array(
							'type' => 'on-off',
							'id' => 'event_social_share',
							'label' => esc_html__( 'Social Sharing', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the social sharing for the event single pages.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'on',
						),
						array(
							'type' => 'text',
							'id' => 'event-social-share-text',
							'label' => esc_html__( 'Social Sharing Title', 'eventchamp' ),
							'desc' => esc_html__( 'You can enter a title for the social sharing buttons of the event single pages. Default: Share This Event.', 'eventchamp' ),
							'section' => 'events',
						),
						array(
							'type' => 'radio',
							'id' => 'event-social-share-position',
							'label' => esc_html__( 'Social Sharing Position', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a position for show the social sharing on the event single pages.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'position-1',
							'choices' => array(
								array(
									'label' => esc_html__( 'Under the Event Content', 'eventchamp' ),
									'value' => 'position-1',
								),
								array(
									'label' => esc_html__( 'On the Sidebar', 'eventchamp' ),
									'value' => 'position-2',
								),
							),
						),
						array(
							'type' => 'radio',
							'id' => 'event-social-sharing-style',
							'label' => esc_html__( 'Social Sharing Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a style for the social sharing on the event single pages.', 'eventchamp' ),
							'section' => 'events',
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
						'type' => 'tab',
						'id' => 'event-tab-layouts',
						'label' => esc_html__( 'Layouts', 'eventchamp' ),
						'section' => 'events',
					),
						array(
							'type' => 'radio-image',
							'id' => 'event_sidebar_position',
							'label' => esc_html__( 'Sidebar Position for Event Archive', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a sidebar position for the event archives.', 'eventchamp' ),
							'section' => 'events',
							'std' => 'right',
						),
						array(
							'type' => 'sidebar-select',
							'id' => 'event_sidebar_select',
							'label' => esc_html__( 'Sidebar Select for Event Archive', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a sidebar for the event archives.', 'eventchamp' ),
							'section' => 'events',
						),
						array(
							'type' => 'sidebar-select',
							'id' => 'event_detail_sidebar_select',
							'label' => esc_html__( 'Sidebar Select for Event Details', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a sidebar for the event single pages.', 'eventchamp' ),
							'section' => 'events',
						),

				/*====== Venues ======*/
					array(
						'type' => 'tab',
						'id' => 'venue-tab-general',
						'label' => esc_html__( 'General', 'eventchamp' ),
						'section' => 'venues',
					),
						array(
							'type' => 'on-off',
							'id' => 'venue-like-system',
							'label' => esc_html__( 'Venue Like System', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the venue like system. If you choose on, the like button will show on the single venues.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'venue-favorite-system',
							'label' => esc_html__( 'Venue Favorite System', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the venue favorite system. If you choose on, the favorite button will show on the single venues.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'on',
						),
						array(
							'id' => 'venue_event_list_venue_detail',
							'type' => 'on-off',
							'label' => esc_html__( 'Events of the Venue', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the events of venue.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'on',
						),
						array(
							'type' => 'numeric-slider',
							'id' => 'venue_event_list_venue_detail_count',
							'label' => esc_html__( 'Event Count for the Events of the Venue', 'eventchamp' ),
							'desc' => esc_html__( 'You can enter an event count for the events of the venue.', 'eventchamp' ),
							'section' => 'venues',
							'std' => '3',
							'min_max_step'=> '2,999,1',
						),
						array(
							'type' => 'radio',
							'id' => 'venue-events-style',
							'label' => esc_html__( 'Style for the Events of the Venue', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a style for the events of the venue.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'style-3',
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
							),
						),
						array(
							'type' => 'on-off',
							'id' => 'venue-comments',
							'label' => esc_html__( 'Venue Comments', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the comments for the venue single pages.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'on',
						),
						array(
							'type' => 'list-item',
							'id' => 'venue-sidebar-buttons',
							'label' => esc_html__( 'Sidebar Buttons', 'eventchamp' ),
							'desc' => esc_html__( 'You can create buttons for the sidebar.', 'eventchamp' ),
							'section' => 'venues',
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
						'type' => 'tab',
						'id' => 'venue-tab-header',
						'label' => esc_html__( 'Venue Header', 'eventchamp' ),
						'section' => 'venues',
					),
						array(
							'type' => 'select',
							'id' => 'venue-header-status',
							'label' => esc_html__( 'Venue Header Status', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the venue header.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'radio',
							'id' => 'venue_header_style',
							'label' => esc_html__( 'Venue Header Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a style. It will be default venue header style.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'image',
							'choices' => array(
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
							'type' => 'numeric-slider',
							'id' => 'venue-header-image-slider-column',
							'label' => esc_html__( 'Image Slider Column for the Venue Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a column for the image slider in the venue header. Default: 1', 'eventchamp' ),
							'section' => 'venues',
							'std' => '1',
							'min_max_step'=> '1,5,1',
						),
						array(
							'type' => 'numeric-slider',
							'id' => 'venue-header-image-slider-space',
							'label' => esc_html__( 'Image Slider Space for the Venue Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a space value for space between the slides in the venue header. Default: 0', 'eventchamp' ),
							'section' => 'venues',
							'std' => '0',
							'min_max_step'=> '0,50,5',
						),
						array(
							'type' => 'radio',
							'id' => 'venue-header-image-slider-loop',
							'label' => esc_html__( 'Image Slider Loop for the Venue Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the loop for the image slider in the venue header.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'radio',
							'id' => 'venue-header-image-slider-autoplay',
							'label' => esc_html__( 'Image Slider Autoplay for the Venue Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the autoplay for the image slider in the venue header.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'text',
							'id' => 'venue-header-image-slider-autoplay-delay',
							'label' => esc_html__( 'Image Slider Autoplay Delay for the Venue Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can enter an autoplay delay for the image slider in the venue header. Default: 15000', 'eventchamp' ),
							'section' => 'venues',
						),
						array(
							'type' => 'radio',
							'id' => 'venue-header-image-slider-direction',
							'label' => esc_html__( 'Image Slider Direction for the Venue Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a direction for the image slider in the venue header.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'horizontal',
							'choices' => array(
								array(
									'label' => esc_html__( 'Horizontal', 'eventchamp' ),
									'value' => 'horizontal',
								),
								array(
									'label' => esc_html__( 'Vertical', 'eventchamp' ),
									'value' => 'vertical',
								),
							),
						),
						array(
							'type' => 'radio',
							'id' => 'venue-header-image-slider-effect',
							'label' => esc_html__( 'Image Slider Effect for the Venue Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose an effect for the image slider in the venue header.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'slide',
							'choices' => array(
								array(
									'label' => esc_html__( 'Slide', 'eventchamp' ),
									'value' => 'slide',
								),
								array(
									'label' => esc_html__( 'Fade', 'eventchamp' ),
									'value' => 'fade',
								),
								array(
									'label' => esc_html__( 'Cube', 'eventchamp' ),
									'value' => 'cube',
								),
								array(
									'label' => esc_html__( 'Flip', 'eventchamp' ),
									'value' => 'flip',
								),
							),
						),
					array(
						'type' => 'tab',
						'id' => 'venue-tab-detail-box',
						'label' => esc_html__( 'Detail Box', 'eventchamp' ),
						'section' => 'venues',
					),
						array(
							'type' => 'on-off',
							'id' => 'venue-detail-box-status',
							'label' => esc_html__( 'Venue Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the venue detail box.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'venue-detail-box-location',
							'label' => esc_html__( 'Location for the Venue Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the location for the venue detail box.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'venue-detail-box-category',
							'label' => esc_html__( 'Category for the Venue Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the category for the venue detail box.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'venue-detail-box-address',
							'label' => esc_html__( 'Address for the Venue Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the address for the venue detail box.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'venue-detail-box-phone',
							'label' => esc_html__( 'Phone for the Venue Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the phone for the venue detail box.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'venue-detail-box-email',
							'label' => esc_html__( 'Email for the Venue Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the email for the venue detail box.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'venue-detail-box-website',
							'label' => esc_html__( 'Website for the Venue Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the website for the venue detail box.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'venue-detail-box-fax',
							'label' => esc_html__( 'Fax for the Venue Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the fax for the venue detail box.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'venue-detail-box-social',
							'label' => esc_html__( 'Social Links for the Venue Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the social links for the venue detail box.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'venue-detail-box-extra',
							'label' => esc_html__( 'Extra Details for the Venue Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the extra details for the venue detail box.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'on',
						),
					array(
						'type' => 'tab',
						'id' => 'venue-tab-media',
						'label' => esc_html__( 'Media', 'eventchamp' ),
						'section' => 'venues',
					),
							array(
								'type' => 'select',
								'id' => 'venue-photos-status',
								'label' => esc_html__( 'Photos Status', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose status of the photos.', 'eventchamp' ),
								'section' => 'venues',
								'std' => 'true',
								'choices' => array(
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
								'desc' => esc_html__( 'You can choose a photo listing column.', 'eventchamp' ),
								'section' => 'venues',
								'std' => '3',
								'choices' => array(
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
								'desc' => esc_html__( 'You can choose a column space for the photo listing.', 'eventchamp' ),
								'section' => 'venues',
								'std' => '0',
								'choices' => array(
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
						'type' => 'tab',
						'id' => 'venue-tab-map',
						'label' => esc_html__( 'Map', 'eventchamp' ),
						'section' => 'venues',
					),
						array(
							'type' => 'on-off',
							'id' => 'venue-map-status',
							'label' => esc_html__( 'Venue Map', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the venue map for the venue single pages.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'on',
						),
						array(
							'type' => 'radio',
							'id' => 'venue-map-position',
							'label' => esc_html__( 'Venue Map Position', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a position for show the venue map.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'position-2',
							'choices' => array(
								array(
									'label' => esc_html__( 'Under the Event Content', 'eventchamp' ),
									'value' => 'position-1',
								),
								array(
									'label' => esc_html__( 'On the Sidebar', 'eventchamp' ),
									'value' => 'position-2',
								),
							),
						),
						array(
							'type' => 'text',
							'id' => 'venue-map-zoom',
							'label' => esc_html__( 'Map Zoom', 'eventchamp' ),
							'desc' => esc_html__( 'You can enter a map zoom value.', 'eventchamp' ),
							'section' => 'venues',
							'std' => '16',
						),
						array(
							'type' => 'select',
							'id' => 'venue-map-style',
							'label' => esc_html__( 'Map Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a map style.', 'eventchamp' ),
							'section' => 'venues',
							'std' => '1',
							'choices' => array(
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
								array(
									'label' => esc_html__( 'Style 14', 'eventchamp' ),
									'value' => '14',
								),
							),
						),
						array(
							'type' => 'upload',
							'id' => 'venue-map-icon',
							'label' => esc_html__( 'Map Icon', 'eventchamp' ),
							'desc' => esc_html__( 'You can upload a map icon.', 'eventchamp' ),
							'section' => 'venues',
						),
						array(
							'type' => 'select',
							'id' => 'venue-map-type',
							'label' => esc_html__( 'Map Type', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the map type.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'true',
							'choices' => array(
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
							'id' => 'venue-map-scale',
							'label' => esc_html__( 'Map Scale', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the map scale.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'true',
							'choices' => array(
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
							'id' => 'venue-map-zoom-control',
							'label' => esc_html__( 'Map Zoom Control', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the map zoom control.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'true',
							'choices' => array(
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
							'id' => 'venue-map-fullscreen',
							'label' => esc_html__( 'Map Fullscreen', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the map fullscreen control.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'true',
							'choices' => array(
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
							'id' => 'venue-map-street',
							'label' => esc_html__( 'Map Streets', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the map streets.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'true',
							'choices' => array(
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
						'type' => 'tab',
						'id' => 'venue-tab-related-events',
						'label' => esc_html__( 'Related Venues', 'eventchamp' ),
						'section' => 'venues',
					),
						array(
							'type' => 'on-off',
							'id' => 'venue_related_venues',
							'label' => esc_html__( 'Related Venues', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the related venues.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'on',
						),
						array(
							'type' => 'numeric-slider',
							'id' => 'venue_related_venues_count',
							'label' => esc_html__( 'Related Venues Count', 'eventchamp' ),
							'desc' => esc_html__( 'You can enter a venue count for the related venues.', 'eventchamp' ),
							'section' => 'venues',
							'std' => '3',
							'min_max_step'=> '2,12,1',
						),
					array(
						'type' => 'tab',
						'id' => 'venue-tab-tags',
						'label' => esc_html__( 'Tags', 'eventchamp' ),
						'section' => 'venues',
					),
						array(
							'type' => 'on-off',
							'id' => 'venue-tags',
							'label' => esc_html__( 'Venue Tags', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the tags for the venue single pages.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'on',
						),
						array(
							'type' => 'radio',
							'id' => 'venue-tags-position',
							'label' => esc_html__( 'Venue Tags Position', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a position for show the venue tags.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'position-1',
							'choices' => array(
								array(
									'label' => esc_html__( 'Under the Event Content', 'eventchamp' ),
									'value' => 'position-1',
								),
								array(
									'label' => esc_html__( 'On the Sidebar', 'eventchamp' ),
									'value' => 'position-2',
								),
							),
						),
						array(
							'type' => 'radio',
							'id' => 'venue-tags-style',
							'label' => esc_html__( 'Venue Tags Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a style for the venue tags.', 'eventchamp' ),
							'section' => 'venues',
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
						'type' => 'tab',
						'id' => 'venue-tab-social-sharing',
						'label' => esc_html__( 'Social Sharing', 'eventchamp' ),
						'section' => 'venues',
					),
						array(
							'type' => 'on-off',
							'id' => 'venue-social-sharing',
							'label' => esc_html__( 'Social Sharing', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the social sharing for the venue single pages.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'on',
						),
						array(
							'type' => 'text',
							'id' => 'venue-social-share-text',
							'label' => esc_html__( 'Social Sharing Title', 'eventchamp' ),
							'desc' => esc_html__( 'You can enter a title for the social sharing buttons of the venue single pages. Default: Share This Venue.', 'eventchamp' ),
							'section' => 'venues',
						),
						array(
							'type' => 'radio',
							'id' => 'venue-social-share-position',
							'label' => esc_html__( 'Social Sharing Position', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a position for show the social sharing on the venue single pages.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'position-1',
							'choices' => array(
								array(
									'label' => esc_html__( 'Under the Event Content', 'eventchamp' ),
									'value' => 'position-1',
								),
								array(
									'label' => esc_html__( 'On the Sidebar', 'eventchamp' ),
									'value' => 'position-2',
								),
							),
						),
						array(
							'type' => 'radio',
							'id' => 'venue-social-sharing-style',
							'label' => esc_html__( 'Social Sharing Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a style for the social sharing on the venue single pages.', 'eventchamp' ),
							'section' => 'venues',
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
						'type' => 'tab',
						'id' => 'venue-tab-layouts',
						'label' => esc_html__( 'Layouts', 'eventchamp' ),
						'section' => 'venues',
					),
						array(
							'type' => 'radio-image',
							'id' => 'venue_sidebar_position',
							'label' => esc_html__( 'Sidebar Position for Venue Archive', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a general sidebar position for the venue archives.', 'eventchamp' ),
							'section' => 'venues',
							'std' => 'right',
						),
						array(
							'type' => 'sidebar-select',
							'id' => 'venue_sidebar_select',
							'label' => esc_html__( 'Sidebar Select for Venue Archive', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a sidebar for the venue archives.', 'eventchamp' ),
							'section' => 'venues',
						),
						array(
							'type' => 'sidebar-select',
							'id' => 'venue_detail_sidebar_select',
							'label' => esc_html__( 'Sidebar Select for Venue Details', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a sidebar for the venue details.', 'eventchamp' ),
							'section' => 'venues',
						),

				/*====== Speakers ======*/
					array(
						'type' => 'tab',
						'id' => 'speaker-tab-general',
						'label' => esc_html__( 'General', 'eventchamp' ),
						'section' => 'speakers',
					),
						array(
							'type' => 'on-off',
							'id' => 'speaker-like-system',
							'label' => esc_html__( 'Speaker Like System', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the speaker like system. If you choose on, the like button will show on the single speakers.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'speaker-favorite-system',
							'label' => esc_html__( 'Speaker Favorite System', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the speaker favorite system. If you choose on, the favorite button will show on the single speakers.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'on',
						),
						array(
							'id' => 'speaker-events',
							'type' => 'on-off',
							'label' => esc_html__( 'Events of the Speaker', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the events of speaker.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'on',
						),
						array(
							'type' => 'numeric-slider',
							'id' => 'speaker-events-count',
							'label' => esc_html__( 'Event Count for the Events of the Speaker', 'eventchamp' ),
							'desc' => esc_html__( 'You can enter an event count for the events of the speaker.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => '9',
							'min_max_step'=> '2,999,1',
						),
						array(
							'type' => 'radio',
							'id' => 'speaker-events-style',
							'label' => esc_html__( 'Style for the Events of the Speaker', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a style for the events of the speaker.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'style-3',
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
							),
						),
						array(
							'type' => 'on-off',
							'id' => 'speaker-comments',
							'label' => esc_html__( 'Speaker Comments', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the comments for the speaker single pages.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'on',
						),
						array(
							'type' => 'list-item',
							'id' => 'speaker-sidebar-buttons',
							'label' => esc_html__( 'Sidebar Buttons', 'eventchamp' ),
							'desc' => esc_html__( 'You can create buttons for the sidebar.', 'eventchamp' ),
							'section' => 'speakers',
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
							'type' => 'radio',
							'id' => 'schedule_speaker_detail',
							'label' => esc_html__( 'Field for Speaker in the Schedules', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a speaker field for the schedules.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'profession',
							'choices' => array(
								array(
									'label' => esc_html__( 'Profession', 'eventchamp' ),
									'value' => 'profession'
								),
								array(
									'label' => esc_html__( 'Company', 'eventchamp' ),
									'value' => 'company'
								),
							),
						),
					array(
						'type' => 'tab',
						'id' => 'speaker-tab-header',
						'label' => esc_html__( 'Speaker Header', 'eventchamp' ),
						'section' => 'speakers',
					),
						array(
							'type' => 'select',
							'id' => 'speaker-header-status',
							'label' => esc_html__( 'Speaker Header Status', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the speaker header.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'radio',
							'id' => 'speaker-header-style',
							'label' => esc_html__( 'Speaker Header Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a style. It will be default speaker header style.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'image',
							'choices' => array(
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
							'type' => 'numeric-slider',
							'id' => 'speaker-header-image-slider-column',
							'label' => esc_html__( 'Image Slider Column for the Speaker Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a column for the image slider in the speaker header. Default: 1', 'eventchamp' ),
							'section' => 'speakers',
							'std' => '1',
							'min_max_step'=> '1,5,1',
						),
						array(
							'type' => 'numeric-slider',
							'id' => 'speaker-header-image-slider-space',
							'label' => esc_html__( 'Image Slider Space for the Speaker Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a space value for space between the slides in the speaker header. Default: 0', 'eventchamp' ),
							'section' => 'speakers',
							'std' => '0',
							'min_max_step'=> '0,50,5',
						),
						array(
							'type' => 'radio',
							'id' => 'speaker-header-image-slider-loop',
							'label' => esc_html__( 'Image Slider Loop for the Speaker Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the loop for the image slider in the speaker header.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'radio',
							'id' => 'speaker-header-image-slider-autoplay',
							'label' => esc_html__( 'Image Slider Autoplay for the Speaker Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the autoplay for the image slider in the speaker header.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'text',
							'id' => 'speaker-header-image-slider-autoplay-delay',
							'label' => esc_html__( 'Image Slider Autoplay Delay for the Speaker Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can enter an autoplay delay for the image slider in the speaker header. Default: 15000', 'eventchamp' ),
							'section' => 'speakers',
						),
						array(
							'type' => 'radio',
							'id' => 'speaker-header-image-slider-direction',
							'label' => esc_html__( 'Image Slider Direction for the Speaker Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a direction for the image slider in the speaker header.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'horizontal',
							'choices' => array(
								array(
									'label' => esc_html__( 'Horizontal', 'eventchamp' ),
									'value' => 'horizontal',
								),
								array(
									'label' => esc_html__( 'Vertical', 'eventchamp' ),
									'value' => 'vertical',
								),
							),
						),
						array(
							'type' => 'radio',
							'id' => 'speaker-header-image-slider-effect',
							'label' => esc_html__( 'Image Slider Effect for the Speaker Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose an effect for the image slider in the speaker header.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'slide',
							'choices' => array(
								array(
									'label' => esc_html__( 'Slide', 'eventchamp' ),
									'value' => 'slide',
								),
								array(
									'label' => esc_html__( 'Fade', 'eventchamp' ),
									'value' => 'fade',
								),
								array(
									'label' => esc_html__( 'Cube', 'eventchamp' ),
									'value' => 'cube',
								),
								array(
									'label' => esc_html__( 'Flip', 'eventchamp' ),
									'value' => 'flip',
								),
							),
						),
					
					array(
						'type' => 'tab',
						'id' => 'speaker-tab-detail-box',
						'label' => esc_html__( 'Detail Box', 'eventchamp' ),
						'section' => 'speakers',
					),
						array(
							'type' => 'on-off',
							'id' => 'speaker-detail-box-status',
							'label' => esc_html__( 'Speaker Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the speaker detail box.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'speaker-detail-box-category',
							'label' => esc_html__( 'Category for the Speaker Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the category for the speaker detail box.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'speaker-detail-box-location',
							'label' => esc_html__( 'Location for the Speaker Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the location for the speaker detail box.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'speaker-detail-box-address',
							'label' => esc_html__( 'Address for the Speaker Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the address for the speaker detail box.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'speaker-detail-box-phone',
							'label' => esc_html__( 'Phone for the Speaker Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the phone for the speaker detail box.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'speaker-detail-box-email',
							'label' => esc_html__( 'Email for the Speaker Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the email for the speaker detail box.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'speaker-detail-box-website',
							'label' => esc_html__( 'Website for the Speaker Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the website for the speaker detail box.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'speaker-detail-box-social',
							'label' => esc_html__( 'Social Links for the Speaker Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the social links for the speaker detail box.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'speaker-detail-box-extra',
							'label' => esc_html__( 'Extra Details for the Speaker Detail Box', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the extra details for the speaker detail box.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'on',
						),array(
						'type' => 'tab',
						'id' => 'speaker-tab-media',
						'label' => esc_html__( 'Media', 'eventchamp' ),
						'section' => 'speakers',
					),
							array(
								'type' => 'select',
								'id' => 'speaker-photos-status',
								'label' => esc_html__( 'Photos Status', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose status of the photos.', 'eventchamp' ),
								'section' => 'speakers',
								'std' => 'true',
								'choices' => array(
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
								'desc' => esc_html__( 'You can choose a photo listing column.', 'eventchamp' ),
								'section' => 'speakers',
								'std' => '3',
								'choices' => array(
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
								'desc' => esc_html__( 'You can choose a column space for the photo listing.', 'eventchamp' ),
								'section' => 'speakers',
								'std' => '0',
								'choices' => array(
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
						'type' => 'tab',
						'id' => 'speaker-tab-related-speakers',
						'label' => esc_html__( 'Related Speakers', 'eventchamp' ),
						'section' => 'speakers',
					),
						array(
							'type' => 'on-off',
							'id' => 'speaker-related-speakers',
							'label' => esc_html__( 'Related Speaker', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the related speakers.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'on',
						),
						array(
							'type' => 'numeric-slider',
							'id' => 'speaker-related-speakers-count',
							'label' => esc_html__( 'Related Speaker Count', 'eventchamp' ),
							'desc' => esc_html__( 'You can enter a speaker count for the related speakers.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => '3',
							'min_max_step'=> '2,12,1',
						),
						array(
							'type' => 'radio',
							'id' => 'speaker-related-speakers-style',
							'label' => esc_html__( 'Style for the Related Speakers', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a style for the related speakers.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'style-3',
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
						'type' => 'tab',
						'id' => 'speaker-tab-tags',
						'label' => esc_html__( 'Tags', 'eventchamp' ),
						'section' => 'speakers',
					),
						array(
							'type' => 'on-off',
							'id' => 'speaker-tags',
							'label' => esc_html__( 'Speaker Tags', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the tags for the speaker single pages.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'on',
						),
						array(
							'type' => 'radio',
							'id' => 'speaker-tags-position',
							'label' => esc_html__( 'Speaker Tags Position', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a position for show the speaker tags.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'position-1',
							'choices' => array(
								array(
									'label' => esc_html__( 'Under the Event Content', 'eventchamp' ),
									'value' => 'position-1',
								),
								array(
									'label' => esc_html__( 'On the Sidebar', 'eventchamp' ),
									'value' => 'position-2',
								),
							),
						),
						array(
							'type' => 'radio',
							'id' => 'speaker-tags-style',
							'label' => esc_html__( 'Speaker Tags Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a style for the speaker tags.', 'eventchamp' ),
							'section' => 'speakers',
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
						'type' => 'tab',
						'id' => 'speaker-tab-social-sharing',
						'label' => esc_html__( 'Social Sharing', 'eventchamp' ),
						'section' => 'speakers',
					),
						array(
							'type' => 'on-off',
							'id' => 'speaker-social-sharing',
							'label' => esc_html__( 'Social Sharing', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the social sharing for the speaker single pages.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'on',
						),
						array(
							'type' => 'text',
							'id' => 'speaker-social-share-text',
							'label' => esc_html__( 'Social Sharing Title', 'eventchamp' ),
							'desc' => esc_html__( 'You can enter a title for the social sharing buttons of the speaker single pages. Default: Share This Speaker.', 'eventchamp' ),
							'section' => 'speakers',
						),
						array(
							'type' => 'radio',
							'id' => 'speaker-social-share-position',
							'label' => esc_html__( 'Social Sharing Position', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a position for show the social sharing on the speaker single pages.', 'eventchamp' ),
							'section' => 'speakers',
							'std' => 'position-1',
							'choices' => array(
								array(
									'label' => esc_html__( 'Under the Event Content', 'eventchamp' ),
									'value' => 'position-1',
								),
								array(
									'label' => esc_html__( 'On the Sidebar', 'eventchamp' ),
									'value' => 'position-2',
								),
							),
						),
						array(
							'type' => 'radio',
							'id' => 'speaker-social-sharing-style',
							'label' => esc_html__( 'Social Sharing Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a style for the social sharing on the speaker single pages.', 'eventchamp' ),
							'section' => 'speakers',
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
						'type' => 'tab',
						'id' => 'speaker-tab-layouts',
						'label' => esc_html__( 'Layouts', 'eventchamp' ),
						'section' => 'speakers',
					),
						array(
							'type' => 'radio-image',
							'id' => 'speaker_sidebar_position',
							'label' => esc_html__( 'Sidebar Position for Speaker Archive', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a sidebar position for the speaker archives.', 'eventchamp' ),
							'std' => 'right',
							'section' => 'speakers',
						),
						array(
							'type' => 'sidebar-select',
							'id' => 'speaker_sidebar_select',
							'label' => esc_html__( 'Sidebar Select Speaker Archive', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a sidebar for the speaker archives.', 'eventchamp' ),
							'section' => 'speakers',
						),
						array(
							'type' => 'sidebar-select',
							'id' => 'speaker_detail_sidebar_select',
							'label' => esc_html__( 'Sidebar Select for Speaker Details', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a sidebar for the speaker details.', 'eventchamp' ),
							'section' => 'speakers',
						),

				/*====== Datepicker ======*/
					array(
						'label' => esc_html__( 'Date Format', 'eventchamp' ),
						'id' => 'datepicker_date_format',
						'type' => 'text',
						'std' => 'MM dd, yy',
						'desc' => esc_html__( 'You can enter a date format for the datepicker. Default: MM dd, yy - Date formats: https://goo.gl/jU7msW', 'eventchamp' ),
						'section' => 'datepicker',
					),
					array(
						'label' => esc_html__( 'Other Months', 'eventchamp' ),
						'id' => 'datepicker_other_months',
						'type' => 'on-off',
						'desc' => esc_html__( 'You can choose status of the other months.', 'eventchamp' ),
						'std' => 'on',
						'section' => 'datepicker',
					),
					array(
						'label' => esc_html__( 'Apply Button', 'eventchamp' ),
						'id' => 'datepicker_apply_button',
						'type' => 'on-off',
						'desc' => esc_html__( 'You can choose status of the apply button.', 'eventchamp' ),
						'std' => 'on',
						'section' => 'datepicker',
					),
					array(
						'type' => 'radio',
						'id' => 'datepicker_first_day',
						'label' => esc_html__( 'First Day', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose the first day. Sunday is 0, Monday is 1, etc.', 'eventchamp' ),
						'section' => 'datepicker',
						'std' => '1',
						'choices' => array(
							array(
								'label' => '0',
								'value' => '0'
							),
							array(
								'label' => '1',
								'value' => '1'
							),
							array(
								'label' => '2',
								'value' => '2'
							),
							array(
								'label' => '3',
								'value' => '3'
							),
							array(
								'label' => '4',
								'value' => '4'
							),
							array(
								'label' => '5',
								'value' => '5'
							),
							array(
								'label' => '6',
								'value' => '6'
							),
							array(
								'label' => '7',
								'value' => '7'
							),
						),
					),
					array(
						'type' => 'radio',
						'id' => 'datepicker_duration',
						'label' => esc_html__( 'Duration', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose the style of the duration.', 'eventchamp' ),
						'section' => 'datepicker',
						'std' => 'normal',
						'choices' => array(
							array(
								'label' => esc_html__( 'Slow', 'eventchamp' ),
								'value' => 'slow',
							),
							array(
								'label' => esc_html__( 'Normal', 'eventchamp' ),
								'value' => 'normal',
							),
							array(
								'label' => esc_html__( 'Fast', 'eventchamp' ),
								'value' => 'fast',
							),
						),
					),

				/*====== Flex Menu ======*/
					array(
						'type' => 'on-off',
						'id' => 'flex-menu-categorized-events',
						'label' => esc_html__( 'Flex Menu on the Categorized Events', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the flex for the categorized events.', 'eventchamp' ),
						'section' => 'flex-menu',
						'std' => 'on',
					),
					array(
						'type' => 'on-off',
						'id' => 'flex-menu-single-events',
						'label' => esc_html__( 'Flex Menu on the Event Tabs', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the flex menu for the event tabs on the single events.', 'eventchamp' ),
						'section' => 'flex-menu',
						'std' => 'on',
					),
					array(
						'type' => 'on-off',
						'id' => 'flex-menu-schedule',
						'label' => esc_html__( 'Flex Menu on the Schedule', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the flex menu for the event schedule.', 'eventchamp' ),
						'section' => 'flex-menu',
						'std' => 'on',
					),

				/*====== Pages ======*/
					array(
						'type' => 'tab',
						'id' => 'page-tab-general',
						'label' => esc_html__( 'General', 'eventchamp' ),
						'section' => 'pages',
					),
						array(
							'type' => 'on-off',
							'id' => 'page_comment_area',
							'label' => esc_html__( 'Comment Area', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the comment area for the pages.', 'eventchamp' ),
							'section' => 'pages',
							'std' => 'on',
						),
					array(
						'type' => 'tab',
						'id' => 'page-tab-header',
						'label' => esc_html__( 'Page Header', 'eventchamp' ),
						'section' => 'pages',
					),
						array(
							'type' => 'select',
							'id' => 'page-header-status',
							'label' => esc_html__( 'Page Header Status', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the page header.', 'eventchamp' ),
							'section' => 'pages',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'radio',
							'id' => 'page-header-style',
							'label' => esc_html__( 'Page Header Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a style. It will be default page header style.', 'eventchamp' ),
							'section' => 'pages',
							'std' => 'image',
							'choices' => array(
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
							'type' => 'numeric-slider',
							'id' => 'page-header-image-slider-column',
							'label' => esc_html__( 'Image Slider Column for the Page Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a column for the image slider in the page header. Default: 1', 'eventchamp' ),
							'section' => 'pages',
							'std' => '1',
							'min_max_step'=> '1,5,1',
						),
						array(
							'type' => 'numeric-slider',
							'id' => 'page-header-image-slider-space',
							'label' => esc_html__( 'Image Slider Space for the Page Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a space value for space between the slides in the page header. Default: 0', 'eventchamp' ),
							'section' => 'pages',
							'std' => '0',
							'min_max_step'=> '0,50,5',
						),
						array(
							'type' => 'radio',
							'id' => 'page-header-image-slider-loop',
							'label' => esc_html__( 'Image Slider Loop for the Page Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the loop for the image slider in the page header.', 'eventchamp' ),
							'section' => 'pages',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'radio',
							'id' => 'page-header-image-slider-autoplay',
							'label' => esc_html__( 'Image Slider Autoplay for the Page Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the autoplay for the image slider in the page header.', 'eventchamp' ),
							'section' => 'pages',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'text',
							'id' => 'page-header-image-slider-autoplay-delay',
							'label' => esc_html__( 'Image Slider Autoplay Delay for the Page Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can enter an autoplay delay for the image slider in the page header. Default: 15000', 'eventchamp' ),
							'section' => 'pages',
						),
						array(
							'type' => 'radio',
							'id' => 'page-header-image-slider-direction',
							'label' => esc_html__( 'Image Slider Direction for the Page Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a direction for the image slider in the page header.', 'eventchamp' ),
							'section' => 'pages',
							'std' => 'horizontal',
							'choices' => array(
								array(
									'label' => esc_html__( 'Horizontal', 'eventchamp' ),
									'value' => 'horizontal',
								),
								array(
									'label' => esc_html__( 'Vertical', 'eventchamp' ),
									'value' => 'vertical',
								),
							),
						),
						array(
							'type' => 'radio',
							'id' => 'page-header-image-slider-effect',
							'label' => esc_html__( 'Image Slider Effect for the Page Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose an effect for the image slider in the page header.', 'eventchamp' ),
							'section' => 'pages',
							'std' => 'slide',
							'choices' => array(
								array(
									'label' => esc_html__( 'Slide', 'eventchamp' ),
									'value' => 'slide',
								),
								array(
									'label' => esc_html__( 'Fade', 'eventchamp' ),
									'value' => 'fade',
								),
								array(
									'label' => esc_html__( 'Cube', 'eventchamp' ),
									'value' => 'cube',
								),
								array(
									'label' => esc_html__( 'Flip', 'eventchamp' ),
									'value' => 'flip',
								),
							),
						),
					array(
						'type' => 'tab',
						'id' => 'page-tab-layouts',
						'label' => esc_html__( 'Layouts', 'eventchamp' ),
						'section' => 'pages',
					),
						array(
							'type' => 'select',
							'id' => 'page_sidebar_position',
							'label'	=> esc_html__( 'Sidebar Position', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a sidebar position for the pages.', 'eventchamp' ),
							'section' => 'pages',
							'std' => 'nosidebar',
							'choices' => array(
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
							'label' => esc_html__( 'Page Sidebar', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a sidebar for the pages.', 'eventchamp' ),
							'section' => 'pages',
						),

				/*====== Posts ======*/
					array(
						'type' => 'tab',
						'id' => 'post-tab-general',
						'label' => esc_html__( 'General', 'eventchamp' ),
						'section' => 'posts',
					),
						array(
							'type' => 'on-off',
							'id' => 'post_post_information',
							'label' => esc_html__( 'Post Meta', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the post meta.', 'eventchamp' ),
							'section' => 'posts',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'post_post_share_buttons',
							'label' => esc_html__( 'Social Sharing', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the social sharing for the posts.', 'eventchamp' ),
							'section' => 'posts',
							'std' => 'on',
						),
						array(
							'type' => 'text',
							'id' => 'post-social-share-text',
							'label' => esc_html__( 'Social Sharing Title', 'eventchamp' ),
							'desc' => esc_html__( 'You can enter a title for the social sharing buttons of the post single pages. Default: Share This Post.', 'eventchamp' ),
							'section' => 'posts',
						),
						array(
							'type' => 'radio',
							'id' => 'post-social-sharing-style',
							'label' => esc_html__( 'Social Sharing Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a style for the social sharing on the post single pages.', 'eventchamp' ),
							'section' => 'posts',
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
							'type' => 'on-off',
							'id' => 'post_post_tags',
							'label' => esc_html__( 'Tags', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the post tags for the posts.', 'eventchamp' ),
							'section' => 'posts',
							'std' => 'on',
						),
						array(
							'type' => 'radio',
							'id' => 'post-tags-style',
							'label' => esc_html__( 'Post Tags Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a style for the post tags.', 'eventchamp' ),
							'section' => 'posts',
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
							'type' => 'on-off',
							'id' => 'post_post_navigation',
							'label' => esc_html__( 'Post Navigation', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the post navigation for the posts.', 'eventchamp' ),
							'section' => 'posts',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'post_related_posts',
							'label' => esc_html__( 'Related Posts', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the related posts for the posts.', 'eventchamp' ),
							'section' => 'posts',
							'std' => 'on',
						),
						array(
							'type' => 'numeric-slider',
							'id' => 'post_related_posts_column',
							'label' => esc_html__( 'Related Posts Count', 'eventchamp' ),
							'desc' => esc_html__( 'You can enter a post count for the related posts.', 'eventchamp' ),
							'section' => 'posts',
							'std' => '2',
							'min_max_step'=> '2,3,1',
						),
						array(
							'type' => 'on-off',
							'id' => 'post_author_biography',
							'label' => esc_html__( 'Author Biography', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the author biography for the posts.', 'eventchamp' ),
							'section' => 'posts',
							'std' => 'on',
						),
						array(
							'type' => 'on-off',
							'id' => 'post_post_comment_area',
							'label' => esc_html__( 'Post Comments', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the comment area for the posts.', 'eventchamp' ),
							'section' => 'posts',
							'std' => 'on',
						),
					array(
						'type' => 'tab',
						'id' => 'post-tab-header',
						'label' => esc_html__( 'Post Header', 'eventchamp' ),
						'section' => 'posts',
					),
						array(
							'type' => 'select',
							'id' => 'post-header-status',
							'label' => esc_html__( 'Post Header Status', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the post header.', 'eventchamp' ),
							'section' => 'posts',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'radio',
							'id' => 'post-header-style',
							'label' => esc_html__( 'Post Header Style', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a style. It will be default post header style.', 'eventchamp' ),
							'section' => 'posts',
							'std' => 'image',
							'choices' => array(
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
							'type' => 'numeric-slider',
							'id' => 'post-header-image-slider-column',
							'label' => esc_html__( 'Image Slider Column for the Post Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a column for the image slider in the post header. Default: 1', 'eventchamp' ),
							'section' => 'posts',
							'std' => '1',
							'min_max_step'=> '1,5,1',
						),
						array(
							'type' => 'numeric-slider',
							'id' => 'post-header-image-slider-space',
							'label' => esc_html__( 'Image Slider Space for the Post Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a space value for space between the slides in the post header. Default: 0', 'eventchamp' ),
							'section' => 'posts',
							'std' => '0',
							'min_max_step'=> '0,50,5',
						),
						array(
							'type' => 'radio',
							'id' => 'post-header-image-slider-loop',
							'label' => esc_html__( 'Image Slider Loop for the Post Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the loop for the image slider in the post header.', 'eventchamp' ),
							'section' => 'posts',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'radio',
							'id' => 'post-header-image-slider-autoplay',
							'label' => esc_html__( 'Image Slider Autoplay for the Post Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose status of the autoplay for the image slider in the post header.', 'eventchamp' ),
							'section' => 'posts',
							'std' => 'true',
							'choices' => array(
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
							'type' => 'text',
							'id' => 'post-header-image-slider-autoplay-delay',
							'label' => esc_html__( 'Image Slider Autoplay Delay for the Post Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can enter an autoplay delay for the image slider in the post header. Default: 15000', 'eventchamp' ),
							'section' => 'posts',
						),
						array(
							'type' => 'radio',
							'id' => 'post-header-image-slider-direction',
							'label' => esc_html__( 'Image Slider Direction for the Post Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a direction for the image slider in the post header.', 'eventchamp' ),
							'section' => 'posts',
							'std' => 'horizontal',
							'choices' => array(
								array(
									'label' => esc_html__( 'Horizontal', 'eventchamp' ),
									'value' => 'horizontal',
								),
								array(
									'label' => esc_html__( 'Vertical', 'eventchamp' ),
									'value' => 'vertical',
								),
							),
						),
						array(
							'type' => 'radio',
							'id' => 'post-header-image-slider-effect',
							'label' => esc_html__( 'Image Slider Effect for the Post Header', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose an effect for the image slider in the post header.', 'eventchamp' ),
							'section' => 'posts',
							'std' => 'slide',
							'choices' => array(
								array(
									'label' => esc_html__( 'Slide', 'eventchamp' ),
									'value' => 'slide',
								),
								array(
									'label' => esc_html__( 'Fade', 'eventchamp' ),
									'value' => 'fade',
								),
								array(
									'label' => esc_html__( 'Cube', 'eventchamp' ),
									'value' => 'cube',
								),
								array(
									'label' => esc_html__( 'Flip', 'eventchamp' ),
									'value' => 'flip',
								),
							),
						),
					array(
						'type' => 'tab',
						'id' => 'post-tab-layouts',
						'label' => esc_html__( 'Layouts', 'eventchamp' ),
						'section' => 'posts',
					),
						array(
							'type' => 'radio-image',
							'id' => 'post_sidebar_position',
							'label' => esc_html__( 'Sidebar Position for Posts', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a sidebar position for the posts.', 'eventchamp' ),
							'section' => 'posts',
							'std' => 'right',
						),
						array(
							'type' => 'sidebar-select',
							'id' => 'post_sidebar_select',
							'label' => esc_html__( 'Sidebar for Posts', 'eventchamp' ),
							'desc' => esc_html__( 'You can choose a sidebar for the posts.', 'eventchamp' ),
							'section' => 'posts',
						),

				/*====== Colors ======*/
					array(
						'type' => 'on-off',
						'id' => 'dark-skin',
						'label' => esc_html__( 'Dark Skin', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the dark skin.', 'eventchamp' ),
						'section' => 'colors',
						'std' => 'off',
					),
					array(
						'type' => 'background',
						'id' => 'body_background',
						'label' => esc_html__( 'Body Background ', 'eventchamp' ),
						'desc' => esc_html__( 'This is body background of the site.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'background',
						'id' => 'wrapper_background',
						'label' => esc_html__( 'Wrapper Background', 'eventchamp' ),
						'desc' => esc_html__( 'This is wrapper background color of the site.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'box_layouts_bg',
						'label' => esc_html__( 'Box Layouts Background', 'eventchamp' ),
						'desc' => esc_html__( 'You can change background of the box layouts.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'theme_main_color',
						'label' => esc_html__( 'Primary Color', 'eventchamp' ),
						'desc' => esc_html__( 'This is primary color of the site. By setting a color here, all of your elements will use this color instead of default yellow color.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'theme_alternative_color',
						'label' => esc_html__( 'Secondary Color', 'eventchamp' ),
						'desc' => esc_html__( 'This is secondary color of the site. By setting a color here, all of your elements will use this color instead of default purple color.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'css',
						'id' => 'theme_gradient',
						'label' => esc_html__( 'Gradient Background', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a gradient background code. You can see how to create a gradient from the theme documentation.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'link_color',
						'label' => esc_html__( 'Link Color', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the links.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'link_hover_color',
						'label' => esc_html__( 'Link Hover Color', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link hovers.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'heading_color',
						'label' => esc_html__( 'Heading Color', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color heading tags. H1, H2, H3, H4, H5, H6', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'input_border_color',
						'label' => esc_html__( 'Input Border Color', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the border of the inputs.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'input_background_color',
						'label' => esc_html__( 'Input Background Color', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the background of the inputs.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'input_text_color',
						'label' => esc_html__( 'Input Text Color', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the text of the inputs.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'input_placeholder_color',
						'label' => esc_html__( 'Input Placeholder Color', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the placeholder of the inputs.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'button_background_color',
						'label' => esc_html__( 'Button Background Color', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the background of the buttons.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'button_text_color',
						'label' => esc_html__( 'Button Text Color', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the text of the buttons.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'button_hover_background_color',
						'label' => esc_html__( 'Button Hover Background Color', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the hover background of the buttons.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'button_hover_text_color',
						'label' => esc_html__( 'Button Hover Text Color', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the hover text of the buttons.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'footer_style_1_background',
						'label' => esc_html__( 'Background Color for the Footer Style 1', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the background of the footer style 1.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'type' => 'colorpicker',
						'id' => 'footer_style_1_text_color',
						'label' => esc_html__( 'Text Color for the Footer Style 1', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the text of the footer style 1.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'footer_style_1_link_color',
						'label' => esc_html__( 'Link Color for the Footer Style 1', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link of the footer style 1.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'footer_style_1_link_hover_color',
						'label' => esc_html__( 'Link Hover Color for the Footer Style 1', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link hover of the footer style 1.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'footer_style_1_copyright_text_color',
						'label' => esc_html__( 'Copyright Color for the Footer Style 1', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the copyright text of the footer style 1.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'footer_style_2_background',
						'label' => esc_html__( 'Background Color for the Footer Style 2', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the background of the footer style 2.', 'eventchamp' ),
						'section' => 'colors'
					),
					array(
						'type' => 'colorpicker',
						'id' => 'footer_style_2_text_color',
						'label' => esc_html__( 'Text Color for the Footer Style 2', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the text of the footer style 2.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'footer_style_2_link_color',
						'label' => esc_html__( 'Link Color for the Footer Style 2', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link of the footer style 2.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'footer_style_2_link_hover_color',
						'label' => esc_html__( 'Link Hover Color for the Footer Style 2', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link hover of the footer style 2.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'footer_style_2_copyright_text_color',
						'label' => esc_html__( 'Copyright Color for the Footer Style 2', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the copyright text of the footer style 2.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'sidebar_widget_background_color',
						'label' => esc_html__( 'Background Color for the Sidebar Widgets', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the background of the widgets.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'sidebar_widget_title_color',
						'label' => esc_html__( 'Title Color for the Sidebar Widgets', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the title of the widgets.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'sidebar_widget_title_border_color',
						'label' => esc_html__( 'Border Color for the Sidebar Widgets Title', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the title border color of the widgets.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'background',
						'id' => 'header_style_1_background_color',
						'label' => esc_html__( 'Background for Header Style 1', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the background of the header style 1.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_1_link_color',
						'label' => esc_html__( 'Link Color for Header Style 1', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link of the header style 1.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_1_link_hover_color',
						'label' => esc_html__( 'Link Hover Color for Header Style 1', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link hover of the header style 1.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_1_social_links_color',
						'label' => esc_html__( 'Social Links Color for Header Style 1', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the social links of the header style 1.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_1_social_links_hover_color',
						'label' => esc_html__( 'Social Links Hover Color for Header Style 1', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the social links hover of the header style 1.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'background',
						'id' => 'header_style_2_background_color',
						'label' => esc_html__( 'Background for Header Style 2', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the background of the header style 2.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_2_link_color',
						'label' => esc_html__( 'Link Color for Header Style 2', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link of the header style 2.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_2_link_hover_color',
						'label' => esc_html__( 'Link Hover Color for Header Style 2', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link hover of the header style 2.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_2_social_links_color',
						'label' => esc_html__( 'Social Links Color for Header Style 2', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the social links of the header style 2.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_2_social_links_hover_color',
						'label' => esc_html__( 'Social Links Hover Color for Header Style 2', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the social links hover of the header style 2.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'background',
						'id' => 'header_style_3_background_color',
						'label' => esc_html__( 'Background for Header Style 3', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the background of the header style 3.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_3_link_color',
						'label' => esc_html__( 'Link Color for Header Style 3', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link of the header style 3.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_3_link_hover_color',
						'label' => esc_html__( 'Link Hover Color for Header Style 3', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link hover of the header style 3.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_3_social_links_color',
						'label' => esc_html__( 'Social Links Color for Header Style 3', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the social links of the header style 3.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_3_social_links_hover_color',
						'label' => esc_html__( 'Social Links Hover Color for Header Style 3', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the social links hover of the header style 3.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'background',
						'id' => 'header_style_4_background_color',
						'label' => esc_html__( 'Background for Header Style 4', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the background of the header style 4.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_4_link_color',
						'label' => esc_html__( 'Link Color for Header Style 4', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link of the header style 4.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_4_link_hover_color',
						'label' => esc_html__( 'Link Hover Color for Header Style 4', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link hover of the header style 4.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_4_social_links_color',
						'label' => esc_html__( 'Social Links Color for Header Style 4', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the social links of the header style 4.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_4_social_links_hover_color',
						'label' => esc_html__( 'Social Links Hover Color for Header Style 4', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the social links hover of the header style 4.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'background',
						'id' => 'header_style_5_background_color',
						'label' => esc_html__( 'Background for Header Style 5', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the background of the header style 5.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_5_link_color',
						'label' => esc_html__( 'Link Color for Header Style 5', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link of the header style 5.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_5_link_hover_color',
						'label' => esc_html__( 'Link Hover Color for Header Style 5', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link hover of the header style 5.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_5_social_links_color',
						'label' => esc_html__( 'Social Links Color for Header Style 5', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the social links of the header style 5.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_5_social_links_hover_color',
						'label' => esc_html__( 'Social Links Hover Color for Header Style 5', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the social links hover of the header style 5.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'background',
						'id' => 'header_style_6_background_color',
						'label' => esc_html__( 'Background for Header Style 6', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the background of the header style 6.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_6_link_color',
						'label' => esc_html__( 'Link Color for Header Style 6', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link of the header style 6.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_6_link_hover_color',
						'label' => esc_html__( 'Link Hover Color for Header Style 6', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link hover of the header style 6.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_6_social_links_color',
						'label' => esc_html__( 'Social Links Color for Header Style 6', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the social links of the header style 6.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'header_style_6_social_links_hover_color',
						'label' => esc_html__( 'Social Links Hover Color for Header Style 6', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the social links hover of the header style 6.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'background',
						'id' => 'sticky_header_background',
						'label' => esc_html__( 'Background for Sticky Header', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the background of the sticky header.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'sticky_header_link_color',
						'label' => esc_html__( 'Link Color for Sticky Header', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link of the sticky header.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'sticky_header_link_hover_color',
						'label' => esc_html__( 'Link Hover Color for Sticky Header', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the link hover of the sticky header.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'sticky_header_social_links_color',
						'label' => esc_html__( 'Social Links Color for Sticky Header', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the social links of the sticky header.', 'eventchamp' ),
						'section' => 'colors',
					),
					array(
						'type' => 'colorpicker',
						'id' => 'sticky_header_social_links_hover_color',
						'label' => esc_html__( 'Social Links Hover Color for Sticky Header', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a color for the social links hover of the sticky header.', 'eventchamp' ),
						'section' => 'colors',
					),
				
				/*====== Typography ======*/
					array(
						'type' => 'on-off',
						'id' => 'font_subsets_latin',
						'label' => esc_html__( 'Latin Extended', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose the character set of Latin Extended.', 'eventchamp' ),
						'section' => 'fonts',
						'std' => 'off',
					),
					array(
						'type' => 'on-off',
						'id' => 'font_subsets_cyrillic',
						'label' => esc_html__( 'Cyrillic Extended', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose the character set of Cyrillic.', 'eventchamp' ),
						'section' => 'fonts',
						'std' => 'off',
					),
					array(
						'type' => 'on-off',
						'id' => 'font_subsets_greek',
						'label' => esc_html__( 'Greek Extended', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose the character set of Greek language.', 'eventchamp' ),
						'section' => 'fonts',
						'std' => 'off',
					),
					array(
						'type' => 'typography',
						'id' => 'theme_main_font',
						'label' => esc_html__( 'Theme Font', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a main font.', 'eventchamp' ),
						'section' => 'fonts',
					),
					array(
						'type' => 'typography',
						'id' => 'body_text',
						'label' => esc_html__( 'Body', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a font for the body.', 'eventchamp' ),
						'section' => 'fonts',
					),
					array(
						'type' => 'typography',
						'id' => 'h1_font',
						'label' => esc_html__( 'H1', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a font for h1.', 'eventchamp' ),
						'section' => 'fonts',
					),
					array(
						'type' => 'typography',
						'id' => 'h2_font',
						'label' => esc_html__( 'H2', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a font for h2.', 'eventchamp' ),
						'section' => 'fonts',
					),
					array(
						'type' => 'typography',
						'id' => 'h3_font',
						'label' => esc_html__( 'H3', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a font for h3.', 'eventchamp' ),
						'section' => 'fonts',
					),
					array(
						'type' => 'typography',
						'id' => 'h4_font',
						'label' => esc_html__( 'H4', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a font for h4.', 'eventchamp' ),
						'section' => 'fonts',
					),
					array(
						'type' => 'typography',
						'id' => 'h5_font',
						'label' => esc_html__( 'H5', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a font for h5.', 'eventchamp' ),
						'section' => 'fonts',
					),
					array(
						'type' => 'typography',
						'id' => 'h6_font',
						'label' => esc_html__( 'H6', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a font for h6.', 'eventchamp' ),
						'section' => 'fonts',
					),
					array(
						'type' => 'typography',
						'id' => 'input_font',
						'label' => esc_html__( 'Input Font', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a font for the inputs.', 'eventchamp' ),
						'section' => 'fonts',
					),
					array(
						'type' => 'typography',
						'id' => 'button_font',
						'label' => esc_html__( 'Button Font', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a font for the buttons.', 'eventchamp' ),
						'section' => 'fonts',
					),
					array(
						'type' => 'typography',
						'id' => 'header_menu_link_font',
						'label' => esc_html__( 'Header Menu Font', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a font for the header menu.', 'eventchamp' ),
						'section' => 'fonts',
					),

				/*====== Blog ======*/
				array(
					'type' => 'tab',
					'id' => 'blog-tab-categories',
					'label' => esc_html__( 'Categories', 'eventchamp' ),
					'section' => 'archives',
				),
					array(
						'type' => 'radio-image',
						'id' => 'category_sidebar_position',
						'label' => esc_html__( 'Category Sidebar Position', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a sidebar position for the categories.', 'eventchamp' ),
						'section' => 'archives',
						'std' => 'right',
					),
					array(
						'type' => 'radio-image',
						'id' => 'blog_category_post_list_style',
						'label' => esc_html__( 'Category Post List Style', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a post list style for the categories.', 'eventchamp' ),
						'section' => 'archives',
						'std' => 'style1',
					),
					array(
						'type' => 'sidebar_select_category',
						'id' => 'sidebar_select',
						'label' => esc_html__( 'Sidebar For Categories', 'eventchamp' ),
						'section' => 'archives',
					),
				array(
					'type' => 'tab',
					'id' => 'blog-tab-tags',
					'label' => esc_html__( 'Tags', 'eventchamp' ),
					'section' => 'archives',
				),
					array(
						'type' => 'radio-image',
						'id' => 'tag_sidebar_position',
						'label' => esc_html__( 'Sidebar Position for Tag Archive', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a general sidebar position for the tag archives.', 'eventchamp' ),
						'section' => 'archives',
						'std' => 'right',
					),
					array(
						'type' => 'sidebar-select',
						'id' => 'tag_sidebar_select',
						'label' => esc_html__( 'Sidebar Select for Tag Archive', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a sidebar for the tag archives.', 'eventchamp' ),
						'section' => 'archives',
					),
					array(
						'type' => 'radio-image',
						'id' => 'tag_tag_post_list_style',
						'label' => esc_html__( 'Post List Style for Tag Archive', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a post style for the tag archives.', 'eventchamp' ),
						'section' => 'archives',
						'std' => 'style1',
					),
				array(
					'type' => 'tab',
					'id' => 'blog-tab-searches',
					'label' => esc_html__( 'Searches', 'eventchamp' ),
					'section' => 'archives',
				),
					array(
						'type' => 'radio-image',
						'id' => 'search_sidebar_position',
						'label' => esc_html__( 'Sidebar Position for Search', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a sidebar position for the search page.', 'eventchamp' ),
						'section' => 'archives',
						'std' => 'right',
					),
					array(
						'type' => 'sidebar-select',
						'id' => 'search_sidebar_select',
						'label' => esc_html__( 'Sidebar Select for Search', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a sidebar for the search page.', 'eventchamp' ),
						'section' => 'archives',
					),
					array(
						'type' => 'radio-image',
						'id' => 'search_search_post_list_style',
						'label' => esc_html__( 'Post List Style for Search', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a post style for the search page.', 'eventchamp' ),
						'section' => 'archives',
						'std' => 'style1',
					),
				array(
					'type' => 'tab',
					'id' => 'blog-tab-archives',
					'label' => esc_html__( 'Archives', 'eventchamp' ),
					'section' => 'archives',
				),
					array(
						'type' => 'radio-image',
						'id' => 'archive_sidebar_position',
						'label' => esc_html__( 'Sidebar Position for Archives', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a sidebar position for the archives.', 'eventchamp' ),
						'section' => 'archives',
						'std' => 'right',
					),
					array(
						'type' => 'sidebar-select',
						'id' => 'archive_sidebar_select',
						'label' => esc_html__( 'Sidebar Select for Archives', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a sidebar for the archives.', 'eventchamp' ),
						'section' => 'archives',
					),
					array(
						'type' => 'radio-image',
						'id' => 'archive_archive_post_list_style',
						'label' => esc_html__( 'Post List Style for Archives', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a post list style for the archives.', 'eventchamp' ),
						'section' => 'archives',
						'std' => 'style1',
					),
				array(
					'type' => 'tab',
					'id' => 'blog-tab-attachments',
					'label' => esc_html__( 'Attachments', 'eventchamp' ),
					'section' => 'archives',
				),
					array(
						'type' => 'radio-image',
						'id' => 'attachment_sidebar_position',
						'label' => esc_html__( 'Sidebar Position for Attachment', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a general sidebar position for the attachment pages.', 'eventchamp' ),
						'section' => 'archives',
						'std' => 'nosidebar',
					),
					array(
						'type' => 'sidebar-select',
						'id' => 'attachment_sidebar_select',
						'label' => esc_html__( 'Sidebar Select for Attachment', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a sidebar for the attachment pages.', 'eventchamp' ),
						'section' => 'archives',
					),
					array(
						'type' => 'on-off',
						'id' => 'attachment_comment_area',
						'label' => esc_html__( 'Comment Area for Attachment', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the comment area for the attachment pages.', 'eventchamp' ),
						'section' => 'archives',
						'std' => 'on',
					),

				/*====== Fancybox ======*/
					array(
						'type' => 'on-off',
						'id' => 'fancybox',
						'label' => esc_html__( 'Fancybox', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the fancybox.', 'eventchamp' ),
						'section' => 'fancybox',
						'std' => 'on',
					),
					array(
						'type' => 'select',
						'id' => 'fancybox-loop',
						'label' => esc_html__( 'Loop', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the loop.', 'eventchamp' ),
						'section' => 'fancybox',
						'std' => 'true',
						'choices' => array(
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
						'type' => 'select',
						'id' => 'fancybox-keyboard-control',
						'label' => esc_html__( 'Keyboard Control', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the keyboard control.', 'eventchamp' ),
						'section' => 'fancybox',
						'std' => 'true',
						'choices' => array(
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
						'type' => 'select',
						'id' => 'fancybox-infobar',
						'label' => esc_html__( 'Infobar', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the infobar.', 'eventchamp' ),
						'section' => 'fancybox',
						'std' => 'true',
						'choices' => array(
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
						'type' => 'select',
						'id' => 'fancybox-animation-effect',
						'label' => esc_html__( 'Animation Effect', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose an animation effect.', 'eventchamp' ),
						'section' => 'fancybox',
						'std' => 'fade',
						'choices' => array(
							array(
								'label' => esc_html__( 'False', 'eventchamp' ),
								'value' => 'false',
							),
							array(
								'label' => esc_html__( 'Zoom', 'eventchamp' ),
								'value' => 'zoom',
							),
							array(
								'label' => esc_html__( 'Fade', 'eventchamp' ),
								'value' => 'fade',
							),
							array(
								'label' => esc_html__( 'Zoom in Out', 'eventchamp' ),
								'value' => 'zoom-in-out',
							),
						),
					),
					array(
						'type' => 'numeric-slider',
						'id' => 'fancybox-animation-duration',
						'label' => esc_html__( 'Animation Duration', 'eventchamp' ),
						'desc' => esc_html__( 'You can define an animation duration.', 'eventchamp' ),
						'section' => 'fancybox',
						'std' => '366',
						'min_max_step'=> '1,100000,1',
					),
					array(
						'type' => 'select',
						'id' => 'fancybox-transition-effect',
						'label' => esc_html__( 'Transition Effect', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a transition effect.', 'eventchamp' ),
						'section' => 'fancybox',
						'std' => 'fade',
						'choices' => array(
							array(
								'label' => esc_html__( 'False', 'eventchamp' ),
								'value' => 'false',
							),
							array(
								'label' => esc_html__( 'Fade', 'eventchamp' ),
								'value' => 'fade',
							),
							array(
								'label' => esc_html__( 'Slide', 'eventchamp' ),
								'value' => 'slide',
							),
							array(
								'label' => esc_html__( 'Circular', 'eventchamp' ),
								'value' => 'circular',
							),
							array(
								'label' => esc_html__( 'Tube', 'eventchamp' ),
								'value' => 'tube',
							),
							array(
								'label' => esc_html__( 'Zoom in Out', 'eventchamp' ),
								'value' => 'zoom-in-out',
							),
							array(
								'label' => esc_html__( 'Rotate', 'eventchamp' ),
								'value' => 'rotate',
							),
						),
					),
					array(
						'type' => 'numeric-slider',
						'id' => 'fancybox-transition-duration',
						'label' => esc_html__( 'Transition Duration', 'eventchamp' ),
						'desc' => esc_html__( 'You can define a transition duration.', 'eventchamp' ),
						'section' => 'fancybox',
						'std' => '366',
						'min_max_step'=> '1,100000,1',
					),
					array(
						'type' => 'on-off',
						'id' => 'fancybox-zoom-button',
						'label' => esc_html__( 'Zoom Button', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the zoom button.', 'eventchamp' ),
						'section' => 'fancybox',
						'std' => 'on',
					),
					array(
						'type' => 'on-off',
						'id' => 'fancybox-social-sharing-button',
						'label' => esc_html__( 'Social Sharing Button', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the social sharing button.', 'eventchamp' ),
						'section' => 'fancybox',
						'std' => 'on',
					),
					array(
						'type' => 'on-off',
						'id' => 'fancybox-slideshow-button',
						'label' => esc_html__( 'Slideshow Button', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the slideshow button.', 'eventchamp' ),
						'section' => 'fancybox',
						'std' => 'on',
					),
					array(
						'type' => 'select',
						'id' => 'fancybox-slideshow-auto-start',
						'label' => esc_html__( 'Slideshow Auto Start', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the auto start feature of the slideshow.', 'eventchamp' ),
						'section' => 'fancybox',
						'std' => 'true',
						'choices' => array(
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
						'type' => 'numeric-slider',
						'id' => 'fancybox-slideshow-speed',
						'label' => esc_html__( 'Slideshow Speed', 'eventchamp' ),
						'desc' => esc_html__( 'You can define a slideshow speed.', 'eventchamp' ),
						'section' => 'fancybox',
						'std' => '3000',
						'min_max_step'=> '1,100000,1',
					),
					array(
						'type' => 'on-off',
						'id' => 'fancybox-fullscreen-button',
						'label' => esc_html__( 'Fullscreen Button', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the fullscreen button.', 'eventchamp' ),
						'section' => 'fancybox',
						'std' => 'on',
					),
					array(
						'type' => 'on-off',
						'id' => 'fancybox-download-button',
						'label' => esc_html__( 'Download Button', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the download button.', 'eventchamp' ),
						'section' => 'fancybox',
						'std' => 'on',
					),
					array(
						'type' => 'on-off',
						'id' => 'fancybox-thumbs-button',
						'label' => esc_html__( 'Thumbs Button', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the thumbs button.', 'eventchamp' ),
						'section' => 'fancybox',
						'std' => 'on',
					),
					array(
						'type' => 'select',
						'id' => 'fancybox-thumbs-auto-start',
						'label' => esc_html__( 'Thumbs Auto Start', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the auto visible of the thumbs.', 'eventchamp' ),
						'section' => 'fancybox',
						'std' => 'true',
						'choices' => array(
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
						'type' => 'on-off',
						'id' => 'fancybox-close-button',
						'label' => esc_html__( 'Close Button', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the close button.', 'eventchamp' ),
						'section' => 'fancybox',
						'std' => 'on',
					),

				/*====== Cookie Bar ======*/
					array(
						'type' => 'on-off',
						'id' => 'cookie-bar',
						'label' => esc_html__( 'Cookie Bar', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of the cookie bar.', 'eventchamp' ),
						'section' => 'cookie-bar',
						'std' => 'on',
					),
					array(
						'type' => 'radio',
						'id' => 'cookie-bar-style',
						'label' => esc_html__( 'Cookie Bar Style', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose a cookie bar style.', 'eventchamp' ),
						'section' => 'cookie-bar',
						'std' => 'style-1',
						'choices' => array(
							array(
								'label' => esc_html__( 'Style 1', 'eventchamp' ),
								'value' => 'style-1'
							),
							array(
								'label' => esc_html__( 'Style 2', 'eventchamp' ),
								'value' => 'style-2'
							),
							array(
								'label' => esc_html__( 'Style 3', 'eventchamp' ),
								'value' => 'style-3'
							),
							array(
								'label' => esc_html__( 'Style 4', 'eventchamp' ),
								'value' => 'style-4'
							),
						),
					),
					array(
						'type' => 'textarea',
						'id' => 'cookie-bar-text',
						'label' => esc_html__( 'Cookie Bar Description Text', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a description text for the cookie bar.', 'eventchamp' ),
						'section' => 'cookie-bar',
					),
					array(
						'type' => 'text',
						'id' => 'cookie-bar-button-text',
						'label' => esc_html__( 'Cookie Bar Button Text', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a button text for the cookie bar. Default: I Accept', 'eventchamp' ),
						'section' => 'cookie-bar',
					),
					array(
						'type' => 'text',
						'id' => 'cookie-bar-time',
						'label' => esc_html__( 'Cookie Bar Time', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a time for the cookie bar. This time is a day. Default: 15', 'eventchamp' ),
						'section' => 'cookie-bar',
					),

				/*====== Password Protected ======*/
					array(
						'type' => 'text',
						'id' => 'password-protected-title',
						'label' => esc_html__( 'Password Protected Title', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a title for the password protected.', 'eventchamp' ),
						'section' => 'password-protected',
					),
					array(
						'type' => 'text',
						'id' => 'password-protected-text',
						'label' => esc_html__( 'Password Protected Text', 'eventchamp' ),
						'desc' => esc_html__( 'You can enter a text for the password protected.', 'eventchamp' ),
						'section' => 'password-protected',
					),

				/*====== Post Types & Taxonomies ======*/
					array(
						'type' => 'list-item',
						'id' => 'custom-post-types',
						'label' => esc_html__( 'Custom Post Types', 'eventchamp' ),
						'desc' => esc_html__( 'You can create post types from this panel.', 'eventchamp' ),
						'section' => 'post-types-taxonomies',
						'settings' => array(
							array(
								'type' => 'text',
								'id' => 'name',
								'label' => esc_html__( 'Post Type Name', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a post type name. Example: Events', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'singular-name',
								'label' => esc_html__( 'Post Type Singular Name', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a post type singular name. Example: Event', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'slug',
								'label' => esc_html__( 'Post Type Slug', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a post type slug. Use lowercase. Example: event', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'description',
								'label' => esc_html__( 'Post Type Description', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a post type description.', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'position',
								'label' => esc_html__( 'Post Type Menu Position', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a post type menu position. Example: 20', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'icon',
								'label' => esc_html__( 'Post Type Icon', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a post type icon to use on the menu. Example: dashicons-calendar-alt. You can find the icon from this link: https://developer.wordpress.org/resource/dashicons/', 'eventchamp' ),
							),
						),
					),
					array(
						'type' => 'list-item',
						'id' => 'custom-taxonomies',
						'label' => esc_html__( 'Custom Taxonomies', 'eventchamp' ),
						'desc' => esc_html__( 'You can create taxonomies from this panel.', 'eventchamp' ),
						'section' => 'post-types-taxonomies',
						'settings' => array(
							array(
								'type' => 'select',
								'id' => 'post-type',
								'label' => esc_html__( 'Post Type', 'eventchamp' ),
								'desc' => esc_html__( 'You can choose a post type for adding this taxonomy.', 'eventchamp' ),
								'choices' => eventchamp_get_post_types_settings(),
							),
							array(
								'type' => 'text',
								'id' => 'name',
								'label' => esc_html__( 'Taxonomy Name', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a taxonomy name. Example: Categories', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'singular-name',
								'label' => esc_html__( 'Taxonomy Singular Name', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a taxonomy singular name. Example: Category', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'slug',
								'label' => esc_html__( 'Taxonomy Slug', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a taxonomy slug. Use lowercase. Example: category', 'eventchamp' ),
							),
							array(
								'type' => 'text',
								'id' => 'description',
								'label' => esc_html__( 'Taxonomy Description', 'eventchamp' ),
								'desc' => esc_html__( 'You can enter a taxonomy description.', 'eventchamp' ),
							),
						),
					),

				/*====== Social Media ======*/
				array(
					'type' => 'tab',
					'id' => 'social-media-links',
					'label' => esc_html__( 'Social Links', 'eventchamp' ),
					'section' => 'social-media',
				),
					array(
						'type' => 'list-item',
						'id' => 'social-links',
						'label' => esc_html__( 'Social Links', 'eventchamp' ),
						'desc' => esc_html__( 'You can create the social links.', 'eventchamp' ),
						'section' => 'social-media',
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
								'desc' => esc_html__( 'You can enter an URL.', 'eventchamp' ),
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
					'id' => 'social-media-sharing',
					'label' => esc_html__( 'Social Sharing', 'eventchamp' ),
					'section' => 'social-media',
				),
					array(
						'type' => 'on-off',
						'id' => 'social_share_facebook',
						'label' => esc_html__( 'Facebook', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of Facebook for the social sharing.', 'eventchamp' ),
						'section' => 'social-media',
						'std' => 'on',
					),
					array(
						'type' => 'on-off',
						'id' => 'social_share_twitter',
						'label' => esc_html__( 'Twitter', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of Twitter for the social sharing.', 'eventchamp' ),
						'section' => 'social-media',
						'std' => 'on',
					),
					array(
						'type' => 'on-off',
						'id' => 'social_share_googleplus',
						'label' => esc_html__( 'Google+', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of Google+ for the social sharing.', 'eventchamp' ),
						'section' => 'social-media',
						'std' => 'off',
					),
					array(
						'type' => 'on-off',
						'id' => 'social_share_linkedin',
						'label' => esc_html__( 'LinkedIn', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of LinkedIn for the social sharing.', 'eventchamp' ),
						'section' => 'social-media',
						'std' => 'on',
					),
					array(
						'type' => 'on-off',
						'id' => 'social_share_whatsapp',
						'label' => esc_html__( 'WhatsApp', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of WhatsApp for the social sharing.', 'eventchamp' ),
						'section' => 'social-media',
						'std' => 'on',
					),
					array(
						'type' => 'on-off',
						'id' => 'social_share_pinterest',
						'label' => esc_html__( 'Pinterest', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of Pinterest for the social sharing.', 'eventchamp' ),
						'section' => 'social-media',
						'std' => 'off',
					),
					array(
						'type' => 'on-off',
						'id' => 'social_share_reddit',
						'label' => esc_html__( 'Reddit', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of Reddit for the social sharing.', 'eventchamp' ),
						'section' => 'social-media',
						'std' => 'off',
					),
					array(
						'type' => 'on-off',
						'id' => 'social_share_delicious',
						'label' => esc_html__( 'Delicious', 'eventchamp' ),
						'desc' => esc_html__( 'You can choose status of Delicious for the social sharing.', 'eventchamp' ),
						'section' => 'social-media',
						'std' => 'off',
					),
					array(
						'label' => esc_html__( 'VKontakte', 'eventchamp' ),
						'id' => 'social_share_vk',
						'type' => 'on-off',
						'desc' => esc_html__( 'You can choose status of VKontakte for the social share.', 'eventchamp' ),
						'std' => 'off',
						'section' => 'social-media',
					),
					array(
						'label' => esc_html__( 'Tumblr', 'eventchamp' ),
						'id' => 'social_share_tumblr',
						'type' => 'on-off',
						'desc' => esc_html__( 'You can choose status of Tumblr for the social share.', 'eventchamp' ),
						'section' => 'social-media',
						'std' => 'off',
					),
					array(
						'label' => esc_html__( 'Email', 'eventchamp' ),
						'id' => 'social_share_email',
						'type' => 'on-off',
						'desc' => esc_html__( 'You can choose status of the email for the social share.', 'eventchamp' ),
						'section' => 'social-media',
						'std' => 'on',
					),

				/*====== Custom Codes ======*/
				array(
					'type' => 'css',
					'id' => 'custom_css',
					'label' => esc_html__( 'Custom CSS Codes', 'eventchamp' ),
					'desc' => esc_html__( 'You can enter custom CSS codes.', 'eventchamp' ),
					'section' => 'customcodes',
				),
				array(
					'type' => 'javascript',
					'id' => 'custom_js',
					'label' => esc_html__( 'Custom JavaScript Codes', 'eventchamp' ),
					'desc' => esc_html__( 'You can enter custom JavaScript codes.', 'eventchamp' ),
					'section' => 'customcodes',
				),
			),
		);

		$custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );

		if ( $saved_settings !== $custom_settings ) {

			update_option( ot_settings_id(), $custom_settings );

		}
		
		global $ot_has_eventchamp_theme_options;

		$ot_has_eventchamp_theme_options = true;

	}
	add_action( 'init', 'eventchamp_theme_options' );

}
<?php

class NotificationXPro {

    public $plugin_name;
    private $type = 'notificationx';
    private $extension_ids = [];

    public function __construct(){
        if ( defined( 'NOTIFICATIONX_PRO_VERSION' ) ) {
			$this->version = NOTIFICATIONX_PRO_VERSION;
		} else {
			$this->version = '1.0.0';
		}
        $this->plugin_name = 'notificationx-pro';
        
        // $this->load_dependencies();
        add_action( 'notificationx_load_depedencies', array( $this, 'load_dependencies' ) );
        add_action( 'nx_extensions_init', array( $this, 'load_extensions' ) );
        add_action( 'nx_extensions_init', array( $this, 'inject_features' ) );
		add_action( 'nx_notification_link', array( $this, 'add_utm_control' ), 10, 2 );
		add_filter( 'nx_pressbar_link', array( $this, 'add_utm_control' ), 10, 2 );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles') );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts') );
		add_action( 'wp_enqueue_scripts', array( $this, 'public_enqueue_scripts') );
		add_action( 'nx_active_notificationx', array( $this, 'active_extension'), 11 );
		add_filter( 'nx_check_location', array( $this, 'check_location' ), 10, 2 );
		add_action( 'init', array( $this, 'migration' ) );
		do_action( 'nxpro_init' );
    }

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles( $hook ) {
		global $post_type;
		$page_status = false;
		if( $hook == 'notificationx_page_nx-builder' || $hook == 'notificationx_page_nx-settings' || $hook == 'toplevel_page_nx-admin' ) {
			$page_status = true;
		}

		if( $post_type != $this->type && ! $page_status ) {
			return;
		}

		wp_enqueue_style( 
			$this->plugin_name, 
			NOTIFICATIONX_PRO_ADMIN_URL . 'assets/css/nx-pro.min.css', 
			array( 'notificationx' ), $this->version, 'all' 
		);
	}
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts( $hook ) {
		global $post_type;
		$page_status = false;
		if( $hook == 'notificationx_page_nx-builder' || $hook == 'notificationx_page_nx-settings' || $hook == 'toplevel_page_nx-admin' ) {
			$page_status = true;
		}

		if( $post_type != $this->type && ! $page_status ) {
			return;
		}
		wp_enqueue_script( 
			$this->plugin_name . '-clipboard', 
			NOTIFICATIONX_PRO_ADMIN_URL . 'assets/js/clipboard.min.js', 
			array( 'jquery', 'notificationx' ), $this->version, true 
        );
		wp_enqueue_script( 
			$this->plugin_name, 
			NOTIFICATIONX_PRO_ADMIN_URL . 'assets/js/nx-pro-admin.min.js', 
			array( 'jquery', 'notificationx', 'notificationx-pro-clipboard' ), $this->version, true 
        );
        $translation_array = apply_filters( 'nxpro_js_scripts', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		));
        wp_localize_script( $this->plugin_name, 'NXPROJS', $translation_array );
	}
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function public_enqueue_scripts( $hook ) {
		wp_enqueue_script( 
			$this->plugin_name . '-public', 
			NOTIFICATIONX_PRO_URL . 'assets/js/nx-pro-public.min.js', 
			array( 'jquery', 'notificationx' ), $this->version, true 
        );
	}

    /**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the NotificationX_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		$plugin_i18n = new NotificationXPro_i18n();
		add_action( 'plugins_loaded', array( $plugin_i18n, 'load_plugin_textdomain' ) );
	}
	/**
	 * All Pro Dependencies
	 * @since 1.0.0
	 */
    public function load_dependencies(){
        require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'admin/includes/class-nx-role-management.php';
        require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'includes/class-nxpro-helper.php';
        require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'includes/class-nxpro-extension.php';
        require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'includes/class-nxpro-i18n.php';
        require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'includes/class-nxpro-rest-api.php';
		require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'includes/class-nxpro-settings.php';
		require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'features/class-nxpro-advanced-template.php';
		require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'features/class-nxpro-field-options.php';
		require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'features/class-nxpro-woo-features.php';
		require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'features/class-nxpro-edd-features.php';
		require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'features/class-nxpro-give-features.php';
		require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'features/class-nxpro-advanced-style.php';
		require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'features/class-nxpro-sales-features.php';
		require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'features/class-nxpro-tutor-features.php';
		require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'features/class-nxpro-maps-image.php';
		require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'features/class-nxpro-sound.php';
		require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'features/class-nxpro-shortcode.php';

		/**
		 * NotificationX Pro Analytics Report
		 */
		require_once NOTIFICATIONX_PRO_ROOT_DIR_PATH . 'admin/reports/class-nxpro-analytics.php';

		$this->set_locale();
        /**
         * Extension Files
         */
        require_once NOTIFICATIONX_PRO_EXT_DIR_PATH . 'conversions/class-custom.php';
        require_once NOTIFICATIONX_PRO_EXT_DIR_PATH . 'conversions/class-custom-as-type.php'; // @since 1.2.7
        require_once NOTIFICATIONX_PRO_EXT_DIR_PATH . 'mailchimp/class-mailchimp.php';
        require_once NOTIFICATIONX_PRO_EXT_DIR_PATH . 'zapier/class-zapier.php';
        require_once NOTIFICATIONX_PRO_EXT_DIR_PATH . 'freemius/class-freemius.php';
        require_once NOTIFICATIONX_PRO_EXT_DIR_PATH . 'convertkit/class-convertkit.php';
        require_once NOTIFICATIONX_PRO_EXT_DIR_PATH . 'envato/class-envato.php'; // @since 1.1.4
		require_once NOTIFICATIONX_PRO_EXT_DIR_PATH . 'learndash/class-learndash.php'; // @since 1.1.4
		require_once NOTIFICATIONX_PRO_EXT_DIR_PATH . 'google-analytics/class-nxpro-google-analytics.php'; // @since 1.3.0
		require_once NOTIFICATIONX_PRO_EXT_DIR_PATH . 'forms/class-grvf.php'; // @since 1.4.*
    }

    public function load_extensions(){
		$extensions = [
			'custom_notification' 	=> 'NotificationXPro_Custom_Extension',
			'mailchimp'           	=> 'NotificationXPro_MailChimp_Extension',
			'freemius'            	=> 'NotificationXPro_Freemius_Extension',
			'zapier'              	=> 'NotificationXPro_Zapier_Extension',
			'convertkit'          	=> 'NotificationXPro_ConvertKit_Extension',
			'envato'              	=> 'NotificationXPro_Envato_Extension',            	// @since 1.1.4
			'learndash'           	=> 'NotificationXPro_LearnDash_Extension',         	// @since 1.1.4
			'custom'              	=> 'NotificationXPro_CustomNotification_AsType',   	// @since 1.2.7
			'google'              	=> 'NotificationXPro_Google_Analytics',   			// @since 1.4.0
			'grvf'              	=> 'NotificationXPro_GravityForms_Extension',   	// @since 1.4.*
		];

        if( ! empty( $extensions ) ) {
            foreach( $extensions as $key => $extension ) {
                /**
                 * Register the extension
                 */
                nx_register_extension( $extension, $key );
            }
        }
	}

	public function add_utm_control( $link, $settings ){
		$utm_campaign = ! empty( $settings->utm_campaign ) ? "utm_campaign=$settings->utm_campaign" : '';
		$utm_medium   = ! empty( $settings->utm_medium ) ? "utm_medium=$settings->utm_medium" : '';
		$utm_source   = ! empty( $settings->utm_source ) ? "utm_source=$settings->utm_source" : '';
		$parsed_url   = parse_url( $link );
		$query        = isset( $parsed_url['query'] ) ? rtrim( $parsed_url['query'], '&' ) : '';
		
		$query .=  ! empty( $query ) ? '&' : '';
		if( $utm_campaign ) {
			$query .= "$utm_campaign&";
		}
		if( $utm_medium ) {
			$query .= "$utm_medium&";
		} 
		if( $utm_source ) {
			$query .= "$utm_source&";
		}

		$query = ! empty( $query ) ? rtrim( $query, '&' ) : '';
		if( $query ) {
			$parsed_url['query'] = $query;
		}

		if( empty( $parsed_url ) ) {
			return $link;
		}
		$link = self::unparse_url( $parsed_url );
		return $link;
	}
	/**
	 * Unparse URL
	 * @param array $parsed_url
	 * @return string of url
	 * @since 1.3.0
	 */
	public static function unparse_url($parsed_url) {
		$scheme   = isset( $parsed_url['scheme'] ) ? $parsed_url['scheme'] . '://' : '';
		$host     = isset( $parsed_url['host'] ) ? $parsed_url['host'] : '';
		$port     = isset( $parsed_url['port'] ) ? ':' . $parsed_url['port'] : '';
		$user     = isset( $parsed_url['user'] ) ? $parsed_url['user'] : '';
		$pass     = isset( $parsed_url['pass'] ) ? ':' . $parsed_url['pass']  : '';
		$pass     = ( $user || $pass ) ? "$pass@" : '';
		$path     = isset( $parsed_url['path'] ) ? $parsed_url['path'] : '';
		$query    = isset( $parsed_url['query'] ) ? '?' . $parsed_url['query'] : '';
		$fragment = isset( $parsed_url['fragment'] ) ? '#' . $parsed_url['fragment'] : '';
		return "$scheme$user$pass$host$port$path$query$fragment";
	}

	public function active_extension( $activeItems = [] ){

		if( empty( $activeItems ) ) {
			return;
		}

		$mailchimp_ids = array();

		foreach( $activeItems as $id ) {
			
			$settings = NotificationX_MetaBox::get_metabox_settings( $id );

			$logged_in = is_user_logged_in();
			$show_on_display = $settings->show_on_display;

			if( ( $logged_in && 'logged_out_user' == $show_on_display ) || ( ! $logged_in && 'logged_in_user' == $show_on_display )){
				continue;
			}
			$locations = $settings->all_locations;
			$check_location = false;

			if( ! empty( $locations ) && $locations !== 'is_custom' ) {
				$check_location = NotificationX_Locations::check_location( array( $locations ) );
			}

			$check_location = apply_filters( 'nx_check_location', $check_location, $settings );

			if( $settings->show_on == 'on_selected' ) {
				// show if the page is on selected
				if ( ! $check_location ) {
					continue;
				}
			} elseif( $settings->show_on == 'hide_on_selected' ) {
				// hide if the page is on selected
				if ( $check_location ) {
					continue;
				}
			}
			/**
			 * Check for hiding in mobile device
			 */
			if( wp_is_mobile() && $settings->hide_on_mobile ) {
				continue;
			}
			$type = NotificationXPro_Helper::get_type( $settings );
			switch ( $type ) {
				case "mailchimp":
					$this->extension_ids[] = $id;
					break;
				case "zapier":
					$this->extension_ids[] = $id;
					break;
				case "freemius":
					$this->extension_ids[] = $id;
					break;
				case "convertkit":
					$this->extension_ids[] = $id;
					break;
				case "custom":
					$this->extension_ids[] = $id;
					break;
				case "google":
					$this->extension_ids[] = $id;
					break;
			}
		}

		add_filter( 'nx_pro_extetion_ids', array( $this, 'extensions_ids' ) );
	}

	public function check_location( $check_location, $settings ){
		$locations = $settings->all_locations;
		if( $locations == 'is_custom' ) {
			$check_location = NotificationX_Locations::check_location( array( $locations ), $settings->custom_ids );
		}
		return $check_location;
	}

	public function extensions_ids( $ids ){
		$ids = $this->extension_ids;
		return $ids;
	}

    public function run(){
        return $this;
	}

	public function inject_features(){
		// Initiating the above Class as an object
		new NotificationXPro_Helper();
		new NotificationXPro_Advanced_Style();
		new NotificationXPro_Advanced_Template();
		NotificationX_Shortcode::instance();
		new NotificationXPro_Sound();
		// NotificationXPro_CustomNotification_AsType::instance();

		new NotificationXPro_Features( $this->plugin_name, $this->version );
		new NotificationXPro_WooFeatures( $this->plugin_name, $this->version );
		new NotificationXPro_EDDFeatures( $this->plugin_name, $this->version );
		new NotificationXPro_GiveFeatures( $this->plugin_name, $this->version );
		new NotificationXPro_TutorLMS_Features( $this->plugin_name, $this->version );

		new NotificationXPro_MapsImages_Features();

		new NotificationXPro_Sales_Features();
	}

    /**
     * Check if current post/page id is in the inserted id by user
     * @param array $ids
     * @return bool
     */
	public static function check_location_custom_ids( $ids = '' ) {
		if( empty( $ids ) ) {
			return false;
		}

		$ids = explode(',', $ids);

		global $post;
		$status_flag = false;
		
		if( in_array( $post->ID, $ids ) ) {
			return true;
		} else {
			return false;
		}
	}
	/**
	 * Upgrade Migration NotificactonxPro
	 */
	public function migration(){
		$version_migration = get_option( 'nx_version_migration_132', false );
		if( $version_migration === false && version_compare( NOTIFICATIONX_PRO_VERSION, '1.3.1', '>') ) {
			update_option( 'nx_version_migration_132', true );
			global $wpdb;
	
			$inner_sql = "SELECT DISTINCT INNER_POSTS.ID, INNER_POSTS.post_title FROM $wpdb->posts AS INNER_POSTS INNER JOIN $wpdb->postmeta AS INNER_META ON INNER_POSTS.ID = INNER_META.post_id WHERE INNER_POSTS.post_type = '%s'";
	
			$query = $wpdb->prepare(
				"SELECT POSTS.ID, META.meta_key as `key`, META.meta_value as `value` FROM ( $inner_sql ) as POSTS INNER JOIN $wpdb->postmeta as META ON POSTS.ID = META.post_id WHERE META.meta_key = '_nx_meta_impression_per_day'", 
				array(
					'notificationx',
				)
			);
			$results = $wpdb->get_results( $query );
	
			if( ! empty( $results ) && is_array( $results ) )  {
				foreach( $results as $result ) {
					$temp_value = unserialize( $result->value );
					$temp_id = $result->ID;
					$clicks = 0;
					if( is_array( $temp_value ) && ! empty( $temp_value ) ) {
						foreach( $temp_value as $val ) {
							if( isset( $val['clicks'] ) ) {
								$clicks = $clicks + $val['clicks'];
							}
						}
						if( $clicks > 0 ) {
							$wpdb->insert( $wpdb->postmeta, array(
								'post_id' => $temp_id,
								'meta_key' => '_nx_meta_clicks',
								'meta_value' => $clicks,
							), array( '%d', '%s', '%s' ) );
						}
					}
				}
			}
		}

		if(version_compare( NOTIFICATIONX_PRO_VERSION, '1.4.5', '==')){
			$version_migration = get_option( 'nx_pro_version_migration_145', false );
            if( ! $version_migration ) {
                update_option('nx_pro_version_migration_145', true);
				$settings = NotificationX_DB::get_settings();
				$settings['nx_modules']['modules_grvf'] = true;
				NotificationX_DB::update_settings( $settings );
            }
		}
		
		if(version_compare( NOTIFICATIONX_PRO_VERSION, '1.4.12', '==')){
			$version_migration = get_option( 'nx_pro_version_migration_1412', false );
            if( ! $version_migration ) {
                update_option('nx_pro_version_migration_1412', true);
				$settings = NotificationX_DB::get_settings();
				$settings['zapier_api_key'] = md5( home_url( '', 'http' ) );
				NotificationX_DB::update_settings( $settings );
            }
        }
	}
}
<?php
/**
 * @package WordPress
 * @subpackage BuddyPress User Blog
 */
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) )
	exit;

if ( !class_exists( 'BuddyBoss_SAP_Admin' ) ) {

	/**
	 *
	 * BuddyPress User Blog Admin
	 * ********************
	 *
	 *
	 */
	class BuddyBoss_SAP_Admin {
		/* Options/Load
		 * ===================================================================
		 */

		/**
		 * Plugin options
		 *
		 * @var array
		 */
		public $options					 = array();
		private $plugin_settings_tabs	 = array();
		private $network_activated		 = false,
		$plugin_slug			 = 'bb-bp-user-blog',
		$menu_hook				 = 'admin_menu',
		$settings_page			 = 'buddyboss-settings',
		$capability				 = 'manage_options',
		$form_action			 = 'options.php',
		$plugin_settings_url;

		/**
		 * Empty constructor function to ensure a single instance
		 */
		public function __construct() {
			// ... leave empty, see Singleton below
		}

		/* Singleton
		 * ===================================================================
		 */

		/**
		 * Admin singleton
		 *
		 * @since BuddyPress User Blog (1.0.0)
		 *
		 * @param  array  $options [description]
		 *
		 * @uses BuddyBoss_SAP_Admin::setup() Init admin class
		 *
		 * @return object Admin class
		 */
		public static function instance() {
			static $instance = null;

			if ( null === $instance ) {
				$instance = new BuddyBoss_SAP_Admin;
				$instance->setup();
			}

			return $instance;
		}

		/* Utility functions
		 * ===================================================================
		 */

		/**
		 * Get option
		 *
		 * @since BuddyPress User Blog (1.0.0)
		 *
		 * @param  string $key Option key
		 *
		 * @uses BuddyBoss_SAP_Plugin::option() Get option
		 *
		 * @return mixed      Option value
		 */
		public function option( $key ) {
			$value = buddyboss_sap()->option( $key );
			return $value;
		}

		/* Actions/Init
		 * ===================================================================
		 */

		/**
		 * Setup admin class
		 *
		 * @since BuddyPress User Blog (1.0.0)
		 *
		 * @uses buddyboss_sap() Get options from main BuddyBoss_SAP_Plugin class
		 * @uses is_admin() Ensures we're in the admin area
		 * @uses curent_user_can() Checks for permissions
		 * @uses add_action() Add hooks
		 */
		public function setup() {
			if ( (!is_admin() && !is_network_admin() ) || !current_user_can( 'manage_options' ) ) {
				return;
			}

			$this->plugin_settings_url = admin_url( 'admin.php?page=' . $this->plugin_slug );

			$this->network_activated = $this->is_network_activated();

			//if the plugin is activated network wide in multisite, we need to override few variables
			if ( $this->network_activated ) {
				// Main settings page - menu hook
				$this->menu_hook = 'network_admin_menu';

				// Main settings page - parent page
				$this->settings_page = 'settings.php';

				// Main settings page - Capability
				$this->capability = 'manage_network_options';

				// Settins page - form's action attribute
				$this->form_action = 'edit.php?action=' . $this->plugin_slug;

				// Plugin settings page url
				$this->plugin_settings_url = network_admin_url( 'settings.php?page=' . $this->plugin_slug );
			}

			//if the plugin is activated network wide in multisite, we need to process settings form submit ourselves
			if ( $this->network_activated ) {
				add_action( 'network_admin_edit_' . $this->plugin_slug, array( $this, 'save_network_settings_page' ) );
			}

			add_action( 'admin_init',                   array( $this, 'admin_init' ) );
			add_action( 'admin_init',                   array( $this, 'register_support_settings' ) );
			add_action( $this->menu_hook,               array( $this, 'admin_menu' ) );
			add_action( 'admin_footer',                 array( $this, 'print_scripts') );

			add_filter( 'plugin_action_links', array( $this, 'add_action_links' ), 10, 2 );
			add_filter( 'network_admin_plugin_action_links', array( $this, 'add_action_links' ), 10, 2 );
		}

		/**
		 * Check if the plugin is activated network wide(in multisite).
		 *
		 * @return boolean
		 */
		private function is_network_activated() {
			$network_activated = false;
			if ( is_multisite() ) {
				if ( !function_exists( 'is_plugin_active_for_network' ) )
					require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

				if ( is_plugin_active_for_network( basename( constant( 'BUDDYBOSS_SAP_PLUGIN_DIR' ) ) . '/bp-user-blog.php' ) ) {
					$network_activated = true;
				}
			}
			return $network_activated;
		}

		/**
		 * Register admin settings
		 *
		 * @since BuddyPress User Blog (1.0.0)
		 *
		 * @uses register_setting() Register plugin options
		 * @uses add_settings_section() Add settings page option sections
		 * @uses add_settings_field() Add settings page option
		 */
		public function admin_init() {

			$this->plugin_settings_tabs[ 'buddyboss_sap_plugin_options' ] = 'General';

			register_setting( 'buddyboss_sap_plugin_options', 'buddyboss_sap_plugin_options', array( $this, 'plugin_options_validate' ) );
			add_settings_section( 'general_section', __( 'General Settings', 'bp-user-blog' ), array( $this, 'section_general' ), __FILE__ );

			//general options
			add_settings_field( 'enabled-publish-post', __( 'Enable User Publishing', 'bp-user-blog' ), array( $this, 'enabled_publish_post' ), __FILE__, 'general_section' );
            add_settings_field( 'min-words-limit', __( 'Min. Words', 'bp-user-blog' ), array( $this, 'min_words_limit' ), __FILE__, 'general_section' );
            add_settings_field( 'max-words-limit', __( 'Max. Words', 'bp-user-blog' ), array( $this, 'max_words_limit' ), __FILE__, 'general_section' );
			add_settings_field( 'post-create-page', __( 'Create New Post Page', 'bp-user-blog' ), array( $this, 'create_new_post_page' ), __FILE__, 'general_section' );
			add_settings_field( 'enabled-bookmark-post', __( 'Enable Bookmarks', 'bp-user-blog' ), array( $this, 'enabled_bookmark_post' ), __FILE__, 'general_section' );
			add_settings_field( 'bookmarks-page', __( 'Bookmarks Page', 'bp-user-blog' ), array( $this, 'bookmarks_page' ), __FILE__, 'general_section' );
			add_settings_field( 'enabled-recommend-post', __( 'Enable Recommend Posts', 'bp-user-blog' ), array( $this, 'enabled_recommend_post' ), __FILE__, 'general_section' );
			add_settings_field( 'enabled-post-autosave', __( 'Enable Post Autosave', 'bp-user-blog' ), array( $this, 'enabled_post_autosave' ), __FILE__, 'general_section' );
            add_settings_field( 'files-per-batch', __( 'Max. Files per Batch', 'bp-user-blog' ), array( $this, 'files_per_batch' ), __FILE__, 'general_section');
            add_settings_field( 'delete-media-permanently', __( 'Media Management', 'bp-user-blog' ), array( $this, 'delete_media_permanently' ), __FILE__, 'general_section' );
            add_settings_field( 'exclude-categories', __( 'Exclude Categories', 'bp-user-blog' ), array( $this, 'exclude_categories' ), __FILE__, 'general_section' );
		}

		function register_support_settings() {
			$this->plugin_settings_tabs[ 'buddyboss_sap_support_options' ] = __( 'Support', 'bp-user-blog' );

			register_setting( 'buddyboss_sap_support_options', 'buddyboss_sap_support_options' );
			add_settings_section( 'section_support', ' ', array( &$this, 'section_support_desc' ), 'buddyboss_sap_support_options' );
		}

		function section_support_desc() {
			if ( file_exists( dirname( __FILE__ ) . '/help-support.php' ) ) {
				require_once( dirname( __FILE__ ) . '/help-support.php' );
			}
		}

		public function enabled_publish_post() {
			$value = $this->option( 'publish_post' );

			$checked = '';

			if ( $value ) {
				$checked = ' checked="checked" ';
			}

			echo '<label for="publish_post">';
			echo "<input " . $checked . " id='publish_post' name='buddyboss_sap_plugin_options[publish_post]' type='checkbox' />  ";
			_e( 'Allow users to publish posts. If unchecked, they can only submit drafts for review.', 'bp-user-blog' );
			echo '</label>';
		}

		public function enabled_bookmark_post() {
			$value = $this->option( 'bookmark_post' );

			$checked = '';

			if ( $value ) {
				$checked = ' checked="checked" ';
			}

			echo '<label for="bookmark_post">';
			echo "<input " . $checked . " id='bookmark_post' name='buddyboss_sap_plugin_options[bookmark_post]' type='checkbox' />  ";
			_e( 'Allow users to bookmark posts.', 'bp-user-blog' );
			echo '</label>';
		}

		public function enabled_recommend_post() {
			$value = $this->option( 'recommend_post' );

			$checked = '';

			if ( $value ) {
				$checked = ' checked="checked" ';
			}

			echo '<label for="recommend_post">';
			echo "<input " . $checked . " id='recommend_post' name='buddyboss_sap_plugin_options[recommend_post]' type='checkbox' />  ";
			_e( 'Allow users to recommend posts.', 'bp-user-blog' );
			echo '</label>';
		}

		public function enabled_post_autosave() {
            $value = $this->option( 'post_autosave' );

            $checked = '';

            if ( $value ) {
                $checked = ' checked="checked" ';
            }

            echo '<label for="post_autosave">';
            echo "<input " . $checked . " id='post_autosave' name='buddyboss_sap_plugin_options[post_autosave]' type='checkbox' />  ";
            _e( 'Enable post auto saving while editing.', 'bp-user-blog' );
            echo '</label>';
        }

		public function create_new_post_page() {
			$create_new_post_page = $this->option( 'create-new-post' );

			echo wp_dropdown_pages( array(
				'name'				 => 'buddyboss_sap_plugin_options[create-new-post]',
				'echo'				 => false,
				'show_option_none'	 => __( '- None -', 'bp-user-blog' ),
				'selected'			 => $create_new_post_page
			) );
			echo '<a href="' . admin_url( esc_url( add_query_arg( array( 'post_type' => 'page' ), 'post-new.php' ) ) ) . '" class="button-secondary">' . __( 'New Page', 'bp-user-blog' ) . '</a>';
			if ( !empty( $create_new_post_page ) ) {
				echo '<a href="' . get_permalink( $create_new_post_page ) . '" class="button-secondary" target="_bp" style="margin-left: 5px;">' . __( 'View', 'bp-user-blog' ) . '</a>';
			}
			echo '<p class="description">' . __( 'You may need to reset your permalinks after changing this setting. Go to Settings > Permalinks.', 'bp-user-blog' ) . '</p>';
		}

		public function bookmarks_page() {
			$bookmarks_page = $this->option( 'bookmarks-page' );

			echo wp_dropdown_pages( array(
				'name'				 => 'buddyboss_sap_plugin_options[bookmarks-page]',
				'echo'				 => false,
				'show_option_none'	 => __( '- None -', 'bp-user-blog' ),
				'selected'			 => $bookmarks_page
			) );
			echo '<a href="' . admin_url( esc_url( add_query_arg( array( 'post_type' => 'page' ), 'post-new.php' ) ) ) . '" class="button-secondary">' . __( 'New Page', 'bp-user-blog' ) . '</a>';
			if ( !empty( $bookmarks_page ) ) {
				echo '<a href="' . get_permalink( $bookmarks_page ) . '" class="button-secondary" target="_bp" style="margin-left: 5px;">' . __( 'View', 'bp-user-blog' ) . '</a>';
			}
			echo '<p class="description">' . __( 'You may need to reset your permalinks after changing this setting. Go to Settings > Permalinks.', 'bp-user-blog' ) . '</p>';
		}

        /**
         * Setting > Files Per Batch
         */
        public function files_per_batch()
        {
            $files_per_batch = $this->option( 'files_per_batch' );

            echo "<input id='files-per-batch' name='buddyboss_sap_plugin_options[files_per_batch]' min='1' type='number' value='" . esc_attr( $files_per_batch ) . "' />";
            echo '<p class="description">' . __( 'Maximum number of images that can be uploaded in one batch.', 'bp-user-blog' ) . '</p>';
        }

        /**
         * Setting > Delete Media Permanently
         *
         */
        public function delete_media_permanently()
        {
            $value = $this->option( 'delete_media_permanently' );

            $checked = '';

            if ( $value )
            {
                $checked = ' checked="checked" ';
            }

            echo '<label for="delete_media_permanently">';
            echo "<input " . $checked . " id='delete_media_permanently' name='buddyboss_sap_plugin_options[delete_media_permanently]' type='checkbox' />  ";
            _e( 'When a blog post is removed, permanently delete the associated media file.', 'bp-user-blog' );
            echo '</label>';
        }

        /**
         *
         */
        public function min_words_limit() {
            $min_words_limit = $this->option( 'min_words_limit' );

            echo "<input id='min-words-limit' name='buddyboss_sap_plugin_options[min_words_limit]' type='number' value='" . esc_attr( $min_words_limit ) . "' min='0' />";
            echo '<p class="description">' . __( 'Minimum words to publish the post. If you do not want to enforce words limit, just leave this field blank.', 'bp-user-blog' ) . '</p>';
        }

        /**
         *
         */
        public function max_words_limit() {
            $max_words_limit = $this->option( 'max_words_limit' );

            echo "<input id='max-words-limit' name='buddyboss_sap_plugin_options[max_words_limit]' type='number' value='" . esc_attr( $max_words_limit ) . "' min='0' />";
            echo '<p class="description">' . __( 'Maximum words to publish the post. If you do not want to enforce words limit, just leave this field blank.', 'bp-user-blog' ) . '</p>';
        }

        /**
         * Exclude categories from the frontend
         *
         */
        public function exclude_categories() {

            $excluded_categories = $this->option( 'excluded_categories' );

            $cat_args = apply_filters( 'sap_post_category_args', array(
                'hide_empty'    => false,
                'taxonomy'      => 'category',
            ));

            $categories = get_terms( $cat_args );

            $output = "<select multiple name='buddyboss_sap_plugin_options[excluded_categories][]' id='excluded-categories' >\n";

            foreach ( $categories as $cat ) {
                $selected =  ! empty( $excluded_categories ) && in_array( $cat->term_id, $excluded_categories ) ? "selected='selected'": '';
                $output .= "\t<option value='" . esc_attr( $cat->term_id ) . "' $selected>$cat->name</option>\n";
            }

            $output .= "</select>\n";

            echo $output;
        }

		/**
		 * Add plugin settings page
		 *
		 * @since BuddyPress User Blog (1.0.0)
		 *
		 * @uses add_options_page() Add plugin settings page
		 */
		public function admin_menu() {
			add_submenu_page(
			$this->settings_page, 'User Blog', 'User Blog', $this->capability, $this->plugin_slug, array( $this, 'options_page' )
			);
		}

		/**
		 * Add plugin settings page
		 *
		 * @since BuddyPress User Blog (1.0.0)
		 *
		 * @uses BuddyBoss_SAP_Admin::admin_menu() Add settings page option sections
		 */
		public function network_admin_menu() {
			return $this->admin_menu();
		}

		/**
		 * General settings section
		 *
		 */
		public function section_general() {

		}

		/* Settings Page + Sections
		 * ===================================================================
		 */

		/**
		 * Render settings page
		 *
		 * @since BuddyPress User Blog (1.0.0)
		 *
		 * @uses do_settings_sections() Render settings sections
		 * @uses settings_fields() Render settings fields
		 * @uses esc_attr_e() Escape and localize text
		 */
		public function options_page() {
			$tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : __FILE__;
			?>
			<div class="wrap">
				<h2><?php _e( 'BuddyPress User Blog', 'bp-user-blog' ); ?></h2>
				<?php $this->plugin_options_tabs(); ?>
				<form action="<?php echo $this->form_action; ?>" method="post">
					<?php
					if ( $this->network_activated && isset( $_GET[ 'updated' ] ) ) {
						echo "<div class='updated'><p>" . __( 'Settings updated.', 'bp-user-blog' ) . "</p></div>";
					}
					?>
					<?php
					if ( 'buddyboss_sap_plugin_options' == $tab || empty( $_GET[ 'tab' ] ) ) {
						settings_fields( 'buddyboss_sap_plugin_options' );
						do_settings_sections( __FILE__ );
						?>
						<p class="submit">
							<input name="bboss_g_s_settings_submit" type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Changes', 'bp-user-blog' ); ?>" />
						</p><?php
					} else {
						settings_fields( $tab );
						do_settings_sections( $tab );
					}
					?>
				</form>
			</div>

			<?php
		}

		function plugin_options_tabs() {
			$current_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'buddyboss_sap_plugin_options';

			echo '<h2 class="nav-tab-wrapper">';
			foreach ( $this->plugin_settings_tabs as $tab_key => $tab_caption ) {
				$active = $current_tab == $tab_key ? 'nav-tab-active' : '';
				echo '<a class="nav-tab ' . $active . '" href="?page=' . $this->plugin_slug . '&tab=' . $tab_key . '">' . $tab_caption . '</a>';
			}
			echo '</h2>';
		}

		public function add_action_links( $links, $file ) {
			// Return normal links if not this plugin
			if ( plugin_basename( basename( constant( 'BUDDYBOSS_SAP_PLUGIN_DIR' ) ) . '/bp-user-blog.php' ) != $file ) {
				return $links;
			}

			$mylinks = array(
				'<a href="' . esc_url( $this->plugin_settings_url ) . '">' . __( "Settings", "bp-user-blog" ) . '</a>',
			);
			return array_merge( $links, $mylinks );
		}

		public function save_network_settings_page() {
			if ( !check_admin_referer( 'buddyboss_sap_plugin_options-options' ) )
				return;

			if ( !current_user_can( $this->capability ) )
				die( 'Access denied!' );

			if ( isset( $_POST[ 'bboss_g_s_settings_submit' ] ) ) {
				$submitted	 = stripslashes_deep( $_POST[ 'buddyboss_sap_plugin_options' ] );
				$submitted	 = $this->plugin_options_validate( $submitted );

				update_site_option( 'buddyboss_sap_plugin_options', $submitted );
			}

			// Where are we redirecting to?
			$base_url		 = trailingslashit( network_admin_url() ) . 'settings.php';
			$redirect_url	 = esc_url_raw( add_query_arg( array( 'page' => $this->plugin_slug, 'updated' => 'true' ), $base_url ) );

			// Redirect
			wp_redirect( $redirect_url );
			die();
		}

        public function print_scripts() {
		    global $current_screen;

		    if ( 'buddyboss_page_bb-bp-user-blog' == $current_screen->id ) {
                ?>
                <script type="text/javascript">

                    jQuery(document).ready(function ($) {
                        $sap_min_words_limit = jQuery('input[name="buddyboss_sap_plugin_options[min_words_limit]"]');
                        $sap_max_words_limit = jQuery('input[name="buddyboss_sap_plugin_options[max_words_limit]"]');

                        jQuery('input[name="buddyboss_sap_plugin_options[publish_post]"]').change(function(){
                            if ( jQuery( this ).is(':checked') ) {
                                $sap_min_words_limit.closest('tr').show();
                                $sap_max_words_limit.closest('tr').show();
                            } else {
                                $sap_min_words_limit.closest('tr').hide();
                                $sap_max_words_limit.closest('tr').hide();
                            }
                        }).change();

                        if ( $().select2 ) {
                            $('#excluded-categories').select2();
                        }
                    });

                </script>
                <style>
                    .select2-container {
                        min-width: 50%;
                    }
                </style>
                <?php
            }
		}

		/**
		 * Validate plugin option
		 *
		 * @since BuddyPress User Blog (1.0.0)
		 */
		public function plugin_options_validate( $input ) {

			$input[ 'publish_post' ]	            = isset( $input[ 'publish_post' ] ) ? sanitize_text_field( $input[ 'publish_post' ] ) : null;
			$input[ 'min_words_limit' ]	            = isset( $input[ 'min_words_limit' ] ) ? sanitize_text_field( $input[ 'min_words_limit' ] ) : null;
			$input[ 'max_words_limit' ]	            = isset( $input[ 'max_words_limit' ] ) ? sanitize_text_field( $input[ 'max_words_limit' ] ) : null;
			$input[ 'bookmark_post' ]	            = isset( $input[ 'bookmark_post' ] ) ? sanitize_text_field( $input[ 'bookmark_post' ] ) : null;
			$input[ 'recommend_post' ]	            = isset( $input[ 'recommend_post' ] ) ? sanitize_text_field( $input[ 'recommend_post' ] ) : null;
			$input[ 'post_autosave' ]	            = isset( $input[ 'post_autosave' ] ) ? sanitize_text_field( $input[ 'post_autosave' ] ) : null;
			$input[ 'files_per_batch' ]	            = isset( $input[ 'files_per_batch' ] ) ? sanitize_text_field( $input[ 'files_per_batch' ] ) : null;
			$input[ 'delete_media_permanently' ]	= isset( $input[ 'delete_media_permanently' ] ) ? sanitize_text_field( $input[ 'delete_media_permanently' ] ) : null;
			$input[ 'excluded_categories' ]	        = isset( $input[ 'excluded_categories' ] ) ? $input[ 'excluded_categories' ] : null;

			return $input; // return validated input
		}

	}

}
<?php
/**
 * Plugin Name:             GamiPress - WooCommerce Points Per Purchase Total
 * Plugin URI:              https://wordpress.org/plugins/gamipress-wc-points-per-purchase-total
 * Description:             Award points based on WooCommerce purchase's total.
 * Version:                 1.0.3
 * Author:                  GamiPress
 * Author URI:              https://gamipress.com/
 * Text Domain:             gamipress-wc-points-per-purchase-total
 * Domain Path:             /languages/
 * Requires at least:       4.4
 * Tested up to:            5.1
 * License:                 GNU AGPL v3.0 (http://www.gnu.org/licenses/agpl.txt)
 *
 * @package                 GamiPress\WooCommerce\Points_Per_Purchase_Total
 * @author                  GamiPress
 * @copyright               Copyright (c) GamiPress
 */

final class GamiPress_WC_Points_Per_Purchase_Total {

    /**
     * @var         GamiPress_WC_Points_Per_Purchase_Total $instance The one true GamiPress_WC_Points_Per_Purchase_Total
     * @since       1.0.0
     */
    private static $instance;

    /**
     * Get active instance
     *
     * @access      public
     * @since       1.0.0
     * @return      GamiPress_WC_Points_Per_Purchase_Total self::$instance The one true GamiPress_WC_Points_Per_Purchase_Total
     */
    public static function instance() {

        if( !self::$instance ) {

            self::$instance = new GamiPress_WC_Points_Per_Purchase_Total();
            self::$instance->constants();
            self::$instance->includes();
            self::$instance->hooks();
            self::$instance->load_textdomain();

        }

        return self::$instance;
    }

    /**
     * Setup plugin constants
     *
     * @access      private
     * @since       1.0.0
     * @return      void
     */
    private function constants() {

        // Plugin version
        define( 'GAMIPRESS_WC_POINTS_PER_PURCHASE_TOTAL_VER', '1.0.3' );

        // Plugin file
        define( 'GAMIPRESS_WC_POINTS_PER_PURCHASE_TOTAL_FILE', __FILE__ );

        // Plugin path
        define( 'GAMIPRESS_WC_POINTS_PER_PURCHASE_TOTAL_DIR', plugin_dir_path( __FILE__ ) );

        // Plugin URL
        define( 'GAMIPRESS_WC_POINTS_PER_PURCHASE_TOTAL_URL', plugin_dir_url( __FILE__ ) );
    }

    /**
     * Include plugin files
     *
     * @access      private
     * @since       1.0.0
     * @return      void
     */
    private function includes() {

        if( $this->meets_requirements() ) {

            require_once GAMIPRESS_WC_POINTS_PER_PURCHASE_TOTAL_DIR . 'includes/admin.php';
            require_once GAMIPRESS_WC_POINTS_PER_PURCHASE_TOTAL_DIR . 'includes/filters.php';
            require_once GAMIPRESS_WC_POINTS_PER_PURCHASE_TOTAL_DIR . 'includes/scripts.php';

        }
    }

    /**
     * Setup plugin hooks
     *
     * @access      private
     * @since       1.0.0
     * @return      void
     */
    private function hooks() {
        // Setup our activation and deactivation hooks
        register_activation_hook( __FILE__, array( $this, 'activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

        add_action( 'admin_notices', array( $this, 'admin_notices' ) );
    }

    /**
     * Activation hook for the plugin.
     *
     * @since  1.0.0
     */
    function activate() {

        if( $this->meets_requirements() ) {

        }

    }

    /**
     * Deactivation hook for the plugin.
     *
     * @since  1.0.0
     */
    function deactivate() {

    }

    /**
     * Plugin admin notices.
     *
     * @since  1.0.0
     */
    public function admin_notices() {

        if ( ! $this->meets_requirements() && ! defined( 'GAMIPRESS_ADMIN_NOTICES' ) ) : ?>

            <div id="message" class="notice notice-error is-dismissible">
                <p>
                    <?php printf(
                        __( 'GamiPress - WooCommerce Points Per Order Total requires %s and %s in order to work. Please install and activate it.', 'gamipress-wc-points-per-purchase-total' ),
                        '<a href="https://wordpress.org/plugins/gamipress/" target="_blank">GamiPress</a>',
                        '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce</a>'
                    ); ?>
                </p>
            </div>

            <?php define( 'GAMIPRESS_ADMIN_NOTICES', true ); ?>

        <?php endif;

    }

    /**
     * Check if there are all plugin requirements
     *
     * @since  1.0.0
     *
     * @return bool True if installation meets all requirements
     */
    private function meets_requirements() {

        if ( ! class_exists( 'GamiPress' ) )
            return false;

        // Requirements on multisite install
        if( is_multisite() && gamipress_is_network_wide_active() && is_main_site() ) {
            // On main site, need to check if integrated plugin is installed on any sub site to load all configuration files
            if( gamipress_is_plugin_active_on_network( 'woocommerce/woocommerce.php' ) )
                return true;
        }

        if ( ! class_exists( 'WooCommerce' ) )
            return false;

        return true;

    }

    /**
     * Internationalization
     *
     * @access      public
     * @since       1.0.0
     * @return      void
     */
    public function load_textdomain() {

        // Set filter for language directory
        $lang_dir = GAMIPRESS_WC_POINTS_PER_PURCHASE_TOTAL_DIR . '/languages/';
        $lang_dir = apply_filters( 'gamipress_youtube_languages_directory', $lang_dir );

        // Traditional WordPress plugin locale filter
        $locale = apply_filters( 'plugin_locale', get_locale(), 'gamipress-wc-points-per-purchase-total' );
        $mofile = sprintf( '%1$s-%2$s.mo', 'gamipress-wc-points-per-purchase-total', $locale );

        // Setup paths to current locale file
        $mofile_local   = $lang_dir . $mofile;
        $mofile_global  = WP_LANG_DIR . '/gamipress-wc-points-per-purchase-total/' . $mofile;

        if( file_exists( $mofile_global ) ) {
            // Look in global /wp-content/languages/gamipress/ folder
            load_textdomain( 'gamipress-wc-points-per-purchase-total', $mofile_global );
        } elseif( file_exists( $mofile_local ) ) {
            // Look in local /wp-content/plugins/gamipress/languages/ folder
            load_textdomain( 'gamipress-wc-points-per-purchase-total', $mofile_local );
        } else {
            // Load the default language files
            load_plugin_textdomain( 'gamipress-wc-points-per-purchase-total', false, $lang_dir );
        }

    }

}

/**
 * The main function responsible for returning the one true GamiPress_WC_Points_Per_Purchase_Total instance to functions everywhere
 *
 * @since       1.0.0
 * @return      \GamiPress_WC_Points_Per_Purchase_Total The one true GamiPress_WC_Points_Per_Purchase_Total
 */
function GamiPress_WC_Points_Per_Purchase_Total() {
    return GamiPress_WC_Points_Per_Purchase_Total::instance();
}
add_action( 'plugins_loaded', 'GamiPress_WC_Points_Per_Purchase_Total' );

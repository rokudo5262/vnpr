<?php
/**
 * @package   Photo Contest WordPress Plugin
 * @author    Zbyněk Hovorka
 * @link      http://galleryplugins.com/photo-contest/
 * @copyright 2014-2018 Zbyněk Hovorka
 */

if (!defined('WPINC')) {
    die;
}

class Photo_Contest
{

    /**
     * Plugin version, used for cache-busting of style and script file references.
     *
     * @since   1.0.0
     *
     * @var     string
     */
    const VERSION = '4.0';

    /**
     * The variable name is used as the text domain when internationalizing strings
     * of text. Its value should match the Text Domain file header in the main
     * plugin file.
     *
     * @since    1.0.0
     *
     * @var      string
     */
    protected $plugin_slug = 'photo-contest';

    /**
     * Instance of this class.
     *
     * @since    1.0.0
     *
     * @var      object
     */
    protected static $instance = null;

    /**
     * Initialize the plugin by setting localization and loading public scripts
     * and styles.
     *
     * @since     1.0.0
     */
    private function __construct()
    {

        // Load plugin text domain
        add_action('init', [
            $this,
            'load_plugin_textdomain'
        ]);

        // Load plugin text domain
        add_action('wp_head', [
            $this,
            'pc_hook_css'
        ]);

        // Activate plugin when new blog is added
        add_action('wpmu_new_blog', [
            $this,
            'activate_new_site'
        ]);
        // Set the contest.
        add_action('wp_enqueue_scripts', [
            $this,
            'determine_the_contest'
        ]);
        // Load public-facing style sheet and JavaScript.
        add_action('wp_enqueue_scripts', [
            $this,
            'enqueue_styles'
        ]);
        add_action('wp_enqueue_scripts', [
            $this,
            'enqueue_scripts'
        ]);

        /* Define custom functionality.
         * Refer To http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
         */
        //add_action( 'init', array( $this, 'plugin_shortcodes' ) );

        add_action('init', [
            $this,
            'photo_contest_front_output_buffer'
        ]);
        add_action('wp_head', [
            $this,
            'photo_contest_ajaxurl'
        ]);
        add_action('wp_ajax_vote_for_photo', [
            $this,
            'photo_vote_update'
        ]);
        add_action('wp_ajax_nopriv_vote_for_photo', [
            $this,
            'photo_vote_update'
        ]);
        add_action('wp_ajax_vote_for_photo_jury', [
            $this,
            'photo_vote_update_jury'
        ]);
        add_action('wp_ajax_nopriv_vote_for_photo_jury', [
            $this,
            'photo_vote_update_jury'
        ]);
        add_action('wp_ajax_vote_for_photo_jury_undo', [
            $this,
            'photo_vote_update_jury_undo'
        ]);
        add_action('wp_ajax_nopriv_vote_for_photo_jury_undo', [
            $this,
            'photo_vote_update_jury_undo'
        ]);
        add_action('wp_ajax_rate_for_photo', [$this, 'photo_rate_update']);
        add_action('wp_ajax_nopriv_rate_for_photo', [$this, 'photo_rate_update']);

        add_action('init', [
            $this,
            'photo_thumbnail_sizes'
        ]);


    } //vote_for_photo

    /**
     * Return the plugin slug.
     *
     * @return    Plugin slug variable.
     * @since    1.0.0
     *
     */
    public function get_plugin_slug()
    {
        return $this->plugin_slug;
    }

    public function determine_the_contest()
    {

    }

    /**
     * Return an instance of this class.
     *
     * @return    object    A single instance of this class.
     * @since     1.0.0
     *
     */
    public static function get_instance()
    {

        // If the single instance hasn't been set, set it now.
        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Fired when the plugin is activated.
     *
     * @param boolean $network_wide True if WPMU superadmin uses
     *                                       "Network Activate" action, false if
     *                                       WPMU is disabled or plugin is
     *                                       activated on an individual blog.
     * @since    1.0.0
     *
     */
    public static function activate($network_wide)
    {

        if (function_exists('is_multisite') && is_multisite()) {

            if ($network_wide) {

                // Get all blog ids
                $blog_ids = self::get_blog_ids();

                foreach ($blog_ids as $blog_id) {

                    switch_to_blog($blog_id);
                    self::single_activate();
                }

                restore_current_blog();

            } else {
                self::single_activate();
            }

        } else {
            self::single_activate();
        }

    }

    /**
     * Fired when the plugin is deactivated.
     *
     * @param boolean $network_wide True if WPMU superadmin uses
     *                                       "Network Deactivate" action, false if
     *                                       WPMU is disabled or plugin is
     *                                       deactivated on an individual blog.
     * @since    1.0.0
     *
     */
    public static function deactivate($network_wide)
    {

        if (function_exists('is_multisite') && is_multisite()) {

            if ($network_wide) {

                // Get all blog ids
                $blog_ids = self::get_blog_ids();

                foreach ($blog_ids as $blog_id) {

                    switch_to_blog($blog_id);
                    self::single_deactivate();

                }

                restore_current_blog();

            } else {
                self::single_deactivate();
            }

        } else {
            self::single_deactivate();
        }

    }

    /**
     * Fired when a new site is activated with a WPMU environment.
     *
     * @param int $blog_id ID of the new blog.
     * @since    1.0.0
     *
     */
    public function activate_new_site($blog_id)
    {

        if (1 !== did_action('wpmu_new_blog')) {
            return;
        }

        switch_to_blog($blog_id);
        self::single_activate();
        restore_current_blog();

    }

    /**
     * Get all blog ids of blogs in the current network that are:
     * - not archived
     * - not spam
     * - not deleted
     *
     * @return   array|false    The blog ids, false if no matches.
     * @since    1.0.0
     *
     */
    private static function get_blog_ids()
    {

        global $wpdb;

        // get an array of blog ids
        $sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

        return $wpdb->get_col($sql);

    }

    /**
     * Fired for each blog when the plugin is activated.
     *
     * @since    1.0.0
     */
    private static function single_activate()
    {
        global $wpdb;
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        include('install-tables.php');
    }

    /**
     * Fired for each blog when the plugin is deactivated.
     *
     * @since    1.0.0
     */
    private static function single_deactivate()
    {
        // TODO: Define deactivation functionality here
    }

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain()
    {

        $domain = $this->plugin_slug;
        $locale = apply_filters('plugin_locale', get_locale(), $domain);

        load_textdomain($domain, trailingslashit(WP_LANG_DIR) . $domain . '/' . $domain . '-' . $locale . '.mo');
        load_plugin_textdomain($domain, FALSE, basename(dirname(__FILE__)) . '/languages/');

    }

    /**
     * Register and enqueue own header code
     *
     * @since    4.2
     */

    public function pc_hook_css()
    {
        global $post;
        if (!empty($post)) {
            if (has_shortcode($post->post_content, 'contest-menu') or
                has_shortcode($post->post_content, 'contest-page')) {
                $header_code = get_option('pcplugin-header-code');
                echo $header_code;
            }
        }

    }

    /**
     * Register and enqueue public-facing style sheet.
     *
     * @since    1.0.0
     */

    public function enqueue_styles()
    {
        $plugin_version = get_option('pcplugin-version');
        global $post;
        if (!empty($post)) {

            $check_post = $this->check_post($post);

            //Add global styles
            if ($check_post) {
                $font = get_option('pcplugin-font');
                if ($font == 1 or empty($font)) {
                    wp_enqueue_style($this->plugin_slug . '-font', plugins_url('css/font_oswald.css', __FILE__), [], $plugin_version);
                } elseif ($font == 2) {
                    wp_enqueue_style($this->plugin_slug . '-font', plugins_url('css/font_work_sans.css', __FILE__), [], $plugin_version);
                } elseif ($font == 3) {
                    wp_enqueue_style($this->plugin_slug . '-font', plugins_url('css/font_notosans.css', __FILE__), [], $plugin_version);
                } elseif ($font == 4) {
                    wp_enqueue_style($this->plugin_slug . '-font', plugins_url('css/font_notoserif.css', __FILE__), [], $plugin_version);
                } elseif ($font == 6) {
                    wp_enqueue_style($this->plugin_slug . '-font', plugins_url('css/font_roboto_c.css', __FILE__), [], $plugin_version);
                }

                //Add menu styles
                $menu_layout = get_option('pcplugin-menu-layout');
                if ($menu_layout == '1' or empty($menu_layout)) {
                    wp_enqueue_style($this->plugin_slug . '-mobilemenu', plugins_url('css/mobilemenu-v1.css', __FILE__), [], $plugin_version);
                }
                if ($menu_layout == '2') {
                    wp_enqueue_style($this->plugin_slug . '-mobilemenu', plugins_url('css/mobilemenu-v2.css', __FILE__), [], $plugin_version);
                }
                $menu_open = get_option('pcplugin-menu-open');
                if ($menu_open == 1) {
                    wp_enqueue_style($this->plugin_slug . '-menu_mobile', plugins_url('css/menu_mobile.css', __FILE__), [], $plugin_version);
                }

                //Add gallery styles
                wp_enqueue_style($this->plugin_slug . '-public', plugins_url('css/public.css', __FILE__), [], $plugin_version);
                wp_enqueue_style($this->plugin_slug . '-modern', plugins_url('css/modern.css', __FILE__), [], $plugin_version);
                wp_enqueue_style($this->plugin_slug . '-classic', plugins_url('css/classic.css', __FILE__), [], $plugin_version);
                wp_enqueue_style($this->plugin_slug . '-bootstrap', plugins_url('css/bootstrap.css', __FILE__), [], $plugin_version);
                wp_enqueue_style($this->plugin_slug . '-forms-plus', plugins_url('css/forms-plus.css', __FILE__), [], $plugin_version);
                wp_enqueue_style($this->plugin_slug . '-forms-plus-slateGray', plugins_url('css/forms-plus-slateGray.css', __FILE__), [], $plugin_version);

                $lightbox = get_option('pcplugin-allow-lightbox');
                if ($lightbox == '2' or $lightbox == '3') {
                    wp_enqueue_style($this->plugin_slug . '-lightbox', plugins_url('assets/lightbox/css/lightbox.css', __FILE__), [], $plugin_version);
                }

                wp_enqueue_style($this->plugin_slug . '-font-awesome', plugins_url('css/font-awesome.min.css', __FILE__), [], $plugin_version);

            }

            //Widget
            if (is_active_widget(false, false, 'mm_wp_photocontest_widget_category', true) or
                is_active_widget(false, false, 'mm_wp_photocontest_widget', true) or
                is_active_widget(false, false, 'mm_wp_photocontest_widget_gallery', true) or
                is_active_widget(false, false, 'mm_wp_photocontest_widget_rank', true)) { // check if search widget is used
                wp_enqueue_style($this->plugin_slug . '-widgets', plugins_url('css/widgets.css', __FILE__), [], $plugin_version);
            }

        }

    }

    /**
     * Register and enqueues public-facing JavaScript files.
     *
     * @since    1.0.0
     */

    public function enqueue_scripts()
    {
        $plugin_version = get_option('pcplugin-version');
        global $post;
        if (!empty($post)) {

            $check_post = $this->check_post($post);

            if ($check_post) {
                $menu_open = get_option('pcplugin-menu-open');
                if ($menu_open == 2) {
                    wp_enqueue_script($this->plugin_slug . '-mobile-menu-js', plugins_url('js/menu_mobile.js', __FILE__), ['jquery'], $plugin_version);
                }
                wp_enqueue_script($this->plugin_slug . '-plugin-script', plugins_url('js/public.js', __FILE__), ['jquery'], $plugin_version);
                $lightbox = get_option('pcplugin-allow-lightbox');
                if ($lightbox == '3') {
                    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', [], null, true);

                }
            }
        }
    }


    /**
     * Include shortcodes
     *
     * @since    1.0.0
     */
    public function plugin_shortcodes()
    {

        include_once('shortcodes/shortcodes.php');

    }

    /*
     * Headers allready sent fix
     */
    public function photo_contest_front_output_buffer()
    {
        ob_start();
    }


    public function photo_thumbnail_sizes()
    {
        add_theme_support('post-thumbnails');
        add_image_size('gallery-middle', 350, 350, true);
        add_image_size('gallery-middle-widget', 350, 350);
        add_image_size('photo-small', 51, 51, true);
        add_image_size('pc-large', 1100, 800);
    }

    //Voting/Like mode
    public function photo_vote_update()
    {
        if (isset($_POST['option_id']) and $_POST['option_id'] == "basic") {
            include_once('includes/votes/pc-basic-vote-function.php');
        }
    }

    //Rating
    public function photo_rate_update()
    {
        if (isset($_POST['option_id']) and $_POST['option_id'] == "rate") {
            include_once('includes/votes/pc-rate-function.php');
        }
    }

    //Jury Vote/Rate
    public function photo_vote_update_jury()
    {
        if (isset($_POST['option_id']) and $_POST['option_id'] == "jury" and is_user_logged_in() and !empty($_POST['value_id'])) {
            include_once('includes/votes/pc-jury-rate-function.php');
        } else {
            include_once('includes/votes/pc-jury-vote-function.php');
        }
    }

    public function photo_vote_update_jury_undo()
    {
        if (isset($_POST['option_id']) and $_POST['option_id'] == "jury_undo" and is_user_logged_in()) {
            include_once('includes/votes/pc-jury-vote-function-undo.php');
        }

    }

    public function photo_contest_ajaxurl()
    {
        ?>
        <script type="text/javascript">
            var ajaxurl = '<?php
                echo admin_url('admin-ajax.php');
                ?>';
        </script>
        <?php
    }

    /**
     * @param $post
     * @return bool
     */
    private function check_post($post)
    {

        if (has_shortcode($post->post_content, 'contest-page')) {
            return true;
        }
        if (has_shortcode($post->post_content, 'contest-menu')) {
            return true;
        }

        return false;

    }


}

?>

<?php
/**
 * @version    $Id$
 * @package   ZuFusion Core
 * @author     ZuFusion
 * @copyright  (C) 2019  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Zufusion\Core;

use Zufusion\Core\Helpers\Apphelper;

/**
 * Class App
 *
 * @package Zufusion\Core
 *
 */
class App {

	/**
	 * Contains array instance of the data store class that we are working with.
	 *
	 * @var array
	 */
	protected static $instance = array();
	/**
	 * Last used app
	 *
	 * @var string
	 */
	protected static $last_use = '';
	/**
	 *  Admin or site value
	 *
	 * @var string
	 */
	public $type = 'site';
	/**
	 * Plugin name
	 *
	 * @var string
	 */
	public $plugin_name = '';
	/**
	 * Plugin file
	 *
	 * @var string
	 */
	public $plugin_file = '';
	/**
	 * The plugin path
	 *
	 * @var string
	 */
	public $plugin_path = '';
	/**
	 * Plugin path
	 *
	 * @var string
	 */
	public $plugin_url = '';
	/**
	 * Plugin slug
	 *
	 * @var mixed|string
	 */
	public $plugin_slug = '';
	/**
	 * Current site or admin
	 *
	 * @var null
	 */
	public $current = null;
	/**
	 *  Document Query class
	 *
	 * @var null
	 */
	public $query = null;

	/**
	 * database
	 *
	 * @var
	 */
	public $db;

	/**
	 * App constructor.
	 *
	 * @param string $name Unique name for the plugin.
	 * @param string $plugin_file the plugin file.
	 */
	public function __construct( $name, $plugin_file = __FILE__ ) {

		$this->plugin_name = $name;
		$this->plugin_file = $plugin_file;
		$this->plugin_path = plugin_dir_path( $plugin_file );
		$this->plugin_url  = plugin_dir_url( $plugin_file );
		$this->plugin_slug = str_replace( '.php', '', basename( $plugin_file ) );

		if ( ! defined( 'ZUFUSION_MU_PLUGIN_DIR' ) ) {
			define( 'ZUFUSION_MU_PLUGIN_DIR', WPMU_PLUGIN_DIR . '/zufusion/' );
			define( 'ZUFUSION_MU_PLUGIN_URL', WPMU_PLUGIN_URL . '/zufusion/' );
			define( 'ZUFUSION_MU_PLUGIN_VENDOR_PATH', WPMU_PLUGIN_DIR . '/zufusion/vendor/' );
			define( 'ZUFUSION_MU_PLUGIN_VENDOR_URL', WPMU_PLUGIN_URL . '/zufusion/vendor/' );
		}

		$is_admin = is_admin();

		// Admin/site mode.
		$zufusion = Apphelper::get_var( 'zufusion', 'REQUEST', 'string', '' );
		if ( '' !== $zufusion ) {
			if ( 'site' === $zufusion ) {
				$is_admin = false;
			} elseif ( 'admin' === $zufusion ) {
				$is_admin = true;
			}
		}

		if ( $is_admin ) {
			$this->type = 'admin';
			add_action( 'admin_menu', array( $this, 'register_zufusion_page' ), 0 );
		} else {
			$this->type = 'site';
		}

		$prefix = strtoupper( $name );

		$this->app_require_once( 'app/includes/core.php' );
		$core_class = $prefix . '_Core';
		if ( class_exists( $core_class ) ) {
			$this->core = new $core_class( $this );
		}

		$this->app_require_once( 'app/' . $this->get_site_type() . '/start.php' );
		$tem_class = $prefix . '_' . ucfirst( $this->get_site_type() ) . '_Start';
		if ( class_exists( $tem_class ) ) {
			$this->current = new $tem_class( $this );
		}

	}

	/**
	 * Return admin/site current object
	 *
	 * @return null
	 */
	public function get_current() {
		return $this->current;
	}

	/**
	 * Set page to display views
	 */
	public function render_zufusion() {
		$this->start();
	}

	/**
	 * Manage menu items and pages.
	 */
	public function register_zufusion_page() {
		global $_registered_pages;
		$page = Apphelper::get_var( 'page', 'GET', 'string', '' );

		if ( $page == $this->plugin_name ) {
			$hookname = get_plugin_page_hookname( $this->plugin_name, '' );
			if ( ! empty( $hookname ) ) {
				add_action( $hookname, array( $this, 'render_zufusion' ) );
			}
			$_registered_pages[ $hookname ] = true;
		}
	}

	/**
	 * Return an instance of this class.
	 *
	 * @param string $name Unique name for the plugin.
	 * @param string $path the plugin file.
	 *
	 * @return mixed
	 */
	public static function get_instance( $name = null, $path = '' ) {

		if ( $name === null ) {
			$name = self::$last_use;
		}

		if ( ! array_key_exists( $name, self::$instance ) ) {
			self::$instance[ $name ] = new self( $name, $path );
		}
		self::$last_use = $name;

		return self::$instance[ $name ];
	}


	/**
	 * Autoload classes
	 */
	public function autoload() {
		spl_autoload_register(
			function ( $class ) {
				$class = strtolower( $class );
				if ( file_exists( $this->plugin_path . $class . '.php' ) ) {
					require_once $this->plugin_path . $class . '.php';
				} else if ( file_exists( $this->plugin_path . $class . '.php' ) ) {
					require_once $this->plugin_path . $class . '.php';
				}
			}
		);
	}

	/**
	 * Return admin/site type
	 *
	 * @return string
	 */
	public function get_site_type() {
		return $this->type;
	}

	/**
	 * Return file or require file
	 *
	 * @param string $path the file path.
	 * @param bool   $return only return path.
	 *
	 * @return string
	 */
	public function require_files( $path, $return = false ) {

		if ( $return ) {
			return $this->plugin_path . $path;
		} else {
			require $this->plugin_path . $path;
		}

	}

	/**
	 * Return file or require once file
	 *
	 * @param $path
	 * @param bool $return
	 *
	 * @return string
	 */
	function app_require_once( $path, $return = false ) {

		if ( $return ) {
			return $this->plugin_path . $path;
		} else {
			require_once $this->plugin_path . $path;
		}

	}

	/**
	 * Get ajax url
	 *
	 * @return string|void
	 */
	public function get_ajax_url() {

		if ( 'admin' === $this->get_site_type() ) {
			return admin_url( 'admin-ajax.php?zufusion=admin&action=' . $this->plugin_name );
		} else {
			return admin_url( 'admin-ajax.php?zufusion=site&action=' . $this->plugin_name );
		}

	}

	/**
	 * Get admin ajax url
	 *
	 * @return string|void
	 */
	public function get_admin_ajax_url() {
		return admin_url( 'admin-ajax.php?zufusion=admin&action=' . $this->plugin_name );
	}

	/**
	 * Get site ajax url
	 *
	 * @return string|void
	 */
	public function get_site_ajax_url() {
		return admin_url( 'admin-ajax.php?zufusion=site&action=' . $this->plugin_name );
	}

	/**
	 * Get app url
	 *
	 * @param string $url
	 * @param string $type admin or site
	 *
	 * @return string
	 */
	public function get_url($url = '', $type = 'admin') {

		if ($url == '') {
			if ( 'admin' == $type ) {
				$url = admin_url();
			} else {
				$url = site_url();
			}
		}

		return add_query_arg(array( 'zufusion' => $type, 'zufusionapp' => $this->plugin_name ), $url);
	}

	/**
	 * Detect controller vs task of plugin
	 *
	 * @param string $controller name of controller.
	 * @param string $task task of controller.
	 *
	 * @return void
	 */
	public function start( $controller = '', $task = '' ) {

		$controller  = Apphelper::get_var( 'controller', 'REQUEST', 'string', $controller );
		$task        = Apphelper::get_var( 'task', 'REQUEST', 'string', $task );
		$zufusionapp = Apphelper::get_var( 'zufusionapp', 'REQUEST', 'string', $this->plugin_name );
		if ( '' !== $controller && $zufusionapp === $this->plugin_name ) {
			$controller = strtolower( $controller );
			$task       = strtolower( $task );

			$file_controller = $this->app_require_once( 'app/' . $this->get_site_type() . '/controllers/' . $controller . '.php', true );

			if ( ! file_exists( $file_controller ) ) {
				return new WP_Error( '404', esc_html__( 'Controller not found', 'wud' ) );
			}

			include_once $file_controller;

			$name_class = $zufusionapp . ucfirst( $controller ) . 'Controller';
			$main       = new $name_class( $this );
			$ftask      = ucfirst( $task );

			if ( method_exists( $main, $ftask ) ) {
				$main->$ftask();
			}

		}

	}

	/**
	 * Init the plugin
	 */
	public function init() {

		if ( ! defined( 'DOING_AJAX' ) ) {
			$page = Apphelper::get_var( 'page', 'GET', 'string', '' );

			if ( 'zufusion' === $page ) {
				$this->start();
			}

		}

	}

}

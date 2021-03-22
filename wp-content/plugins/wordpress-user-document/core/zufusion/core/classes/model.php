<?php
/**
 * @version    $Id$
 * @package   ZuFusion Core
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Zufusion\Core\Classes;

/**
 * Class Model
 * @package Zufusion\Core\Classes
 */
abstract class Model {

	protected $db;
	/**
	 * Store instance of app class that we are woking with.
	 *
	 * @var null
	 */
	public $app = null;
	/**
	 * Id of a model object
	 *
	 * @var null
	 */
	protected $id = null;

	/**
	 * Model constructor.
	 *
	 * @param object $app current app.
	 */
	public function __construct( $app ) {
		global $wpdb;
		$this->db  = $wpdb;
		$this->app = $app;
	}

	/**
	 * Set id for model
	 *
	 * @param int $id id of object.
	 */
	public function set_id( $id = 0) {
		$this->id = $id;
	}

	/**
	 * Get id of model
	 *
	 * @return int
	 */
	public function get_id() {
		return $this->id;
	}

	/**
	 * Get dynamic model
	 *
	 * @param string $model name of model.
	 * @param $app current app.
	 *
	 * @return bool
	 */
	public static function get_instance( $model = '', $app ) {
		return self::create_model( $model, $app->get_site_type(), $app );
	}

	/**
	 * Get model from backend
	 *
	 * @param $model
	 * @param $app
	 *
	 * @return bool
	 */
	public static function get_admin_instance( $model, $app ) {
		return self::create_model( $model, 'admin', $app );
	}

	/**
	 * Get model from frontend
	 *
	 * @param $model
	 * @param $app
	 *
	 * @return bool
	 */
	public static function get_site_instance( $model, $app ) {
		return self::create_model( $model, 'site', $app );
	}

	/**
	 * Create a model ọbject
	 *
	 * @param $model
	 * @param $type
	 * @param $app
	 *
	 * @return bool
	 */
	public static function create_model( $model, $type, $app ) {

		$model = strtolower( $model );
		$app->app_require_once( 'app/' . $type . '/models/' . $model . '.php' );

		$nameClass = $app->plugin_name . ucfirst( $model ) . 'Model';

		if ( class_exists( $nameClass ) ) {
			return new $nameClass( $app );
		}

		return false;
	}

	/**
	 * Get Model
	 *
	 * @param string $model file name of model.
	 * @param null $type is admin or site.
	 *
	 * @return bool
	 */
	public function get_model( $model = '', $type = '' ) {

		if ( $type === '' ) {
			$type = $this->app->get_site_type();
		}
		$model = strtolower( $model );
		$this->app->app_require_once( 'app/' . $type . '/models/' . $model . '.php' );

		$nameClass = $this->app->plugin_name . ucfirst( $model ) . 'Model';

		if ( class_exists( $nameClass ) ) {
			return new $nameClass( $this->app );
		}

		return false;

	}

}

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
 * Class Controller
 * @package Zufusion\Core\Classes
 */
abstract class Controller {


	public $app = array();

	/**
	 * Controller constructor.
	 *
	 * @param object $app current app
	 */
	public function __construct( $app ) {
		$this->app = $app;
	}


	/**
	 * Get a model object
	 *
	 * @param $model
	 * @param string $type
	 *
	 * @return mixed
	 */
	public function get_model( $model, $type = '' ) {
		if ( $type === '' ) {
			$type = $this->app->get_site_type();
		}
		$model = strtolower( $model );
		$this->app->app_require_once( 'app/' . $type . '/models/' . $model . '.php' );

		$nameClass = $this->app->plugin_name . ucfirst( $model ) . 'Model';

		return new $nameClass( $this->app );
	}

	/**
	 * Render a view file
	 *
	 * @param string $path the path of view
	 * @param array $data data for view
	 *
	 * @throws \Exception
	 */
	public function render( $path, $data = array() ) {
		$view = new View( $this->app );
		$view->render( $path, $data );
	}

}

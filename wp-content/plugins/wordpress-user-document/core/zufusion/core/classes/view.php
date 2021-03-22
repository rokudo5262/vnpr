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
 * View
 *
 */
class View {

	/**
	 * Current app
	 * @var array
	 */
	public $app = array();

	/**
	 * View constructor.
	 *
	 * @param $app
	 */
	public function __construct( $app ) {
		$this->app = $app;
	}

	/**
	 * Render a view file
	 *
	 * @param string $view The view file.
	 * @param array $args Associative array of data to display in the view (optional).
	 *
	 * @return void
	 */
	public function render( $view, $args = array() ) {

		extract( $args, EXTR_SKIP );

		$file = $this->app->plugin_path . 'app/' . $this->app->get_site_type() . '/views/' . $view . '.php';  // relative to Core directory
		if ( is_readable( $file ) ) {
			require $file;
		} else {
			echo "$file not found";
		}
	}

}
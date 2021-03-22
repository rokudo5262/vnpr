<?php
/**
 * @version    $Id$
 * @package   WordPress User Document
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

use Zufusion\Core\Classes\Controller;
use Zufusion\Core\Classes\Form;

/**
 * Class wudSettingsController
 */
class wudSettingsController extends Controller {

	/**
	 * Display settings page
	 * @return mixed|void
	 * @throws Exception
	 */
	public function Index() {
		$model = $this->get_model( 'settings' );
		$form  = new Form();
		global $wp_roles;
		$roles = $wp_roles->roles;
		$args  = array(
			'model'   => $model,
			'form'    => $form,
			'options' => $model->get_options(),
			'roles'   => $roles,
		);

		$this->render( 'settings', $args );
	}

}
<?php
/**
 * @version    $Id$
 * @package   WordPress User Document
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

use Zufusion\Core\Classes\Controller;
use Zufusion\Core\Helpers\Apphelper;

class wudLicensesController extends Controller {

	/**
	 * Display licenses page
	 *
	 * @return mixed|void
	 * @throws Exception
	 */
	public function Index() {
		$licenses_model = $this->get_model( 'licenses' );

		$perpage = Apphelper::get_var( 'per_page', 'GET', 'int', 15 );
		$paged   = Apphelper::get_var( 'pagenum', 'GET', 'int', 1 );
		$action  = Apphelper::get_var( 'action', 'GET', 'string', '-1' );
		$ids     = Apphelper::get_var( 'post', 'GET', 'none', array() );
		$ids     = array_filter( array_map( 'intval', $ids ) );

		$status  = false;
		$msg     = '';
		if ( $action === 'delete' ) {

			if ( ! current_user_can( 'wud_delete_license' ) ) {
				$msg    .= esc_html__( 'You don\'t have permission to delete', 'wud' );
				$status = false;
			} else {
				if ( ! empty( $ids ) ) {
					$licenses_model->delete_items( $ids );
					$status = true;
				}
			}

		}

		list( $total_files, $licenses ) = $licenses_model->get_licenses( $perpage, $paged );

		$total = ceil( $total_files / $perpage );

		$pagination_args = array(
			'pagenum'     => $paged,
			'total_pages' => $total,
			'total_items' => $total_files,
		);

		$this->render( 'licenses', array(
			'pagination' => wud_pagination( $pagination_args ),
			'rows'       => $licenses,
			'status'     => $status,
			'msg'        => $msg,
			'action'     => $action,
		) );

	}

}
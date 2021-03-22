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

/**
 * Class wudDocsController
 */
class wudDocsController extends Controller {

	public function Delete() {

		global $wud_settings;

		$nonce_value = Apphelper::get_var( 'wud-delete-doc-nonce', 'POST', 'string', '' );

		if ( ! wp_verify_nonce( $nonce_value, 'wud-delete-doc' ) ) {
			return;
		}

		$user_id = get_current_user_id();

		if ( $user_id <= 0 ) {
			return;
		}

		if ($wud_settings->get_input_value( 'user_can_delete', 'yes' ) == 'no') {
			wud_store_notices( 'error', esc_html__( 'The delete action was disabled by administrator' ,'wud' ), false );
			return;
		}

		$doc_model = $this->get_model( 'doc', 'admin' );

		$post_ids       = Apphelper::get_var( 'post', 'POST', 'none', array() );
		$count_post_ids = count( $post_ids );

		if ( ! empty( $post_ids ) ) {
			foreach ( $post_ids as $post_id ) {
				$doc_model->delete( $post_id );
			}
		} else {
			wud_store_notices( 'error', esc_html__( 'Please select documents to delete' ), false );
			return;
		}

		$text = $count_post_ids > 1 ? $count_post_ids . ' documents' : $count_post_ids . ' document';
		wud_store_notices( 'delete', '', true, $text );
	}
}
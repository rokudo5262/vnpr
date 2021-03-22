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

class wudLicenseController extends Controller {

	/**
	 * Display license page
	 *
	 * @return mixed|void
	 * @throws Exception
	 */
	public function Index() {
		$this->render( 'license', array(
			'row' => array(
				'ID'             => 0,
				'name'           => '',
				'icon'           => '',
				'reference_link' => '',
			)
		) );
	}

	/**
	 * Display edit license
	 *
	 * @throws Exception
	 */
	public function Edit() {
		$id = Apphelper::get_var( 'id', 'GET', 'int' );

		$license_model = $this->get_model( 'license' );

		$row = $license_model->get_license( $id );
		$this->render( 'license', array(
			'row' => $row
		) );
	}

	/**
	 * Save a license
	 *
	 * @throws Exception
	 */
	public function Save() {
		$id             = Apphelper::get_var( 'id', 'POST', 'int', 0 );
		$name           = Apphelper::get_var( 'license_name', 'POST', 'string', '' );
		$icon           = Apphelper::get_var( 'license_icon', 'POST', 'string', '' );
		$reference_link = Apphelper::get_var( 'reference_link', 'POST', 'string', '' );
		$msg            = '';
		$status         = true;
		$action         = 'update';

		if ( ! current_user_can( 'wud_edit_license' ) ) {
			$msg    .= esc_html__( 'You don\'t have permission to edit', 'wud' );
			$status = false;
			$action = 'error';
		}

		if ( $name === '' ) {
			$msg    .= '<p>' . esc_html__( 'Enter license name', 'wud' ) . '</p>';
			$status = false;
			$action = 'error';
		}
		if ( $icon === '' ) {
			$msg    .= '<p>' . esc_html__( 'Select license icon', 'wud' ) . '</p>';
			$status = false;
			$action = 'error';
		}
		if ( $reference_link === '' ) {
			$msg    .= '<p>' . esc_html__( 'Enter reference link', 'wud' ) . '</p>';
			$status = false;
			$action = 'error';
		}

		$license_model = $this->get_model( 'license' );

		$bool = $license_model->update( $id, array(
			'name'           => $name,
			'icon'           => $icon,
			'reference_link' => $reference_link,
		) );


		if ( ! $bool ) {
			$msg    .= '<p>' . esc_html__( " can\'t be saved to database", 'wud' ) . '</p>';
			$status = false;
			$action = 'error';
		}

		$this->render( 'license', array(
			'status' => $status,
			'msg'    => $msg,
			'action' => $action,
			'row'    => $license_model->get_license( $id )
		) );
	}

	/**
	 * Add a license
	 *
	 * @throws Exception
	 */
	public function Add() {
		$name           = Apphelper::get_var( 'license_name', 'POST', 'string', '' );
		$icon           = Apphelper::get_var( 'license_icon', 'POST', 'string', '' );
		$reference_link = Apphelper::get_var( 'reference_link', 'POST', 'string', '' );
		$msg            = '';
		$status         = true;
		$action         = 'add';

		if ( ! current_user_can( 'wud_add_license' ) ) {
			$msg    .= esc_html__( 'You don\'t have permission to create', 'wud' );
			$status = false;
			$action = 'error';
		}

		if ( $name === '' ) {
			$msg    .= '<p>' . esc_html__( 'Enter license name', 'wud' ) . '</p>';
			$status = false;
			$action = 'error';
		}
		if ( $icon === '' ) {
			$msg    .= '<p>' . esc_html__( 'Select license icon', 'wud' ) . '</p>';
			$status = false;
			$action = 'error';
		}
		if ( $reference_link === '' ) {
			$msg    .= '<p>' . esc_html__( 'Enter reference link', 'wud' ) . '</p>';
			$status = false;
			$action = 'error';
		}

		$license_model = $this->get_model( 'license' );

		if ( $status ) {
			$license_id = $license_model->add_license( array(
				'name'           => $name,
				'icon'           => $icon,
				'reference_link' => $reference_link,
			) );


			if ( ! $license_id ) {
				$msg    .= '<p>' . esc_html__( " can\'t be saved to database", 'wud' ) . '</p>';
				$status = false;
				$action = 'error';
			}
		}


		$this->render( 'license', array(
			'status' => $status,
			'msg'    => $msg,
			'action' => $action,
			'row'    => array(
				'ID'             => 0,
				'name'           => '',
				'icon'           => '',
				'reference_link' => '',
			)
		) );
	}

}
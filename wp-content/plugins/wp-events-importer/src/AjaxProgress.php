<?php

namespace WPEventsImporter;

class AjaxProgress
{
	protected static $progressNames;

	protected static $progressHandle;

	protected static $actionHook;

	protected static $totalOptPrefix;

	protected static $totalCount = [];

	protected static $count = [];



	public static function init()
	{
		self::$totalOptPrefix	= WPEVENTSIMPORTER_DOMAIN . '_scheduled_queue_';
		self::$progressHandle	= WPEVENTSIMPORTER_DOMAIN . '_ajax_progress';
		self::$actionHook		= 'ajax_progress_action';

		$obj = new static();

		\add_action( 'wp_ajax_' . self::$actionHook, [ $obj, self::$actionHook ] );
	}



	public static function getCount( $name )
	{
		global $wpdb;

		if ( isset( self::$count[ $name ] ) ) {
			return self::$count[ $name ];
		}

		if ( ! $wpdb ) {
			return false;
		}

		$opt_name	= self::$totalOptPrefix . $name;
		$table_name	= Formats::get_db_table_name( 'queue' );

		$count = $wpdb->get_var(
			$wpdb->prepare(
				"SELECT COUNT(*) FROM {$table_name} WHERE `name` = %s",
				$opt_name
			)
		);
		self::$count[ $name ] = $count;

		return $count;
	}



	public static function setTotalCount( $name )
	{
		$opt_name	= self::$totalOptPrefix . $name;
		$count		= self::getCount( $name );
		$total		= get_option( $opt_name . '_total', null );

		if ( empty( $total ) || $count > $total ) {
			if( $count > 0 ) {
				update_option( $opt_name . '_total', $count );
			}
		} elseif ( empty( $count ) ) {
			delete_option( $opt_name . '_total' );
		}

		self::$totalCount[ $name ] = $total;

		return $total;
	}



	public static function getTotalCount( $name )
	{
		if ( ! empty( self::$totalCount[ $name ] ) ) {
			return self::$totalCount[ $name ];
		}

		return self::setTotalCount( $name );
	}



	public function getProgress( $name )
	{
		$count = self::getCount( $name );
		$total = self::getTotalCount( $name );

		if ( $total > 0 ) {
			$percent = ( $total - $count ) * 100;
			$percent = intval( $percent / $total );
		} else {
			return false;
		}

		if ( $percent < 1 ) {
			$percent = 1;
		} elseif ( $percent > 99 ) {
			$percent = 100;
		}

		return $percent;
	}



	public static function show( $names )
	{
		self::$progressNames = $names;
		$obj = new static();

		\add_action( "admin_enqueue_scripts", [ $obj, "ajaxProgressEnqueue" ], 99 );
	}



	public function ajaxProgressEnqueue()
	{
		$progress	= false;
		$filename	= \plugins_url( 'js/progress.js', WPEVENTSIMPORTER_BASENAME );

		// Enqueued script with localized data.
		\wp_enqueue_script( self::$progressHandle, $filename, [ 'jquery' ], '1.0.0' );

		if ( ! is_array( self::$progressNames ) ) return;

		foreach ( self::$progressNames as $progress_info ) {
			$status = $this->getProgress( $progress_info[ 'id' ] );

			if ( ! $status ) continue;

			$progress[] = [
				'id'		=> $progress_info[ 'id' ],
				'name'		=> $progress_info[ 'name' ],
				'progress'	=> $status
			];
		}

		if ( ! $progress ) return;

		// Localize the script with new data
		$values = array(
			'ajax_url'	=> \admin_url( 'admin-ajax.php' ),
			'action'	=> self::$actionHook,
			'nonce'		=> \wp_create_nonce( self::$progressHandle . '_nonce' ),
			'progress'	=> $progress
		);

		\wp_localize_script( self::$progressHandle, 'ajax_progress_object', $values );
	}



	/**
	 * Admin Ajax response output function
	 */
	public function ajax_progress_action()
	{
		if ( \wp_verify_nonce( $_REQUEST[ 'nonce' ], self::$progressHandle . '_nonce' ) ) {
			if ( isset( $_REQUEST[ 'progress' ] ) ) {
				$progress = $_REQUEST[ 'progress' ];

				if ( ! is_array( $progress ) ) {
					echo json_encode( $progress );
					return;
				}

				foreach ( $progress as $item ) {
					$progress_ = $this->getProgress( $item[ 'id' ] );
					$result_json[] =[
						'id'				=> $item[ 'id' ],
						'progress'	=> $progress_,
					];
				}
			}
		}

		if ( empty( $result_json ) ) {
			$result_json = [ 'error' => 'Something went wrong!' ];
		}

		echo json_encode( $result_json );
		\wp_die();
	}
}

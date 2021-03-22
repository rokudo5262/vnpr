<?php

namespace WPEventsImporter;

use WPEventsImporter\Formats;
use WPEventsImporter\Importers\Common;

class ExportManager
{
	protected static $classes = [
		'post'						=> '\WPEventsImporter\Importers\Page',
		'page'						=> '\WPEventsImporter\Importers\Page',
		'ai1ec_event'				=> '\WPEventsImporter\Importers\AIOEC',
		'eventchamp_event'			=> '\WPEventsImporter\Importers\EventChamp',
		'theeventcalendar_event'	=> '\WPEventsImporter\Importers\TheEventCalendar',
		'eventon_event'				=> '\WPEventsImporter\Importers\Eventon',
		'calendarizeit_event'		=> '\WPEventsImporter\Importers\CalendarizeIt',
	];



	public static function export( $to, $from, $data )
	{
		$custom_post_types	= Formats::get_custom_post_types( true );
		$classname			= null;

		try {
			if ( empty( $custom_post_types ) || ! is_array( $custom_post_types ) ) {
				throw new Exception( 'custom_post_types cannot be loaded!' );
			}

			// Set required importer class
			if ( isset( $custom_post_types[ $to ] ) ) {
				$param		= $to;
				$classname	= self::$classes[ 'page' ];
			} elseif ( isset( self::$classes[ $to ] ) ) {
				$param		= null;
				$classname	= self::$classes[ $to ];
			}

			if ( ! class_exists( $classname ) ) {
				throw new Exception( 'Importer class couldn`t find!' );
			}

			$importer = new $classname( $param );

			if ( ! $importer instanceof Common ) {
				throw new Exception( 'Undefined importer!' );
			}

			if ( ! is_array( $data ) ) {
				throw new Exception( 'Wrong data format!' );
			}

			// Import event data
			$importer->import( $from, $data );

		} catch ( Exception $err ) {
			echo '<p>';
			echo 	$err->getMessage() . ' on line ' . $err->getLine();
			echo 	' in ' . $err->getFile();
			echo '</p>';

			return false;
		}

		return $importer;
	}
}

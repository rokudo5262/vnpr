<?php

namespace WPEventsImporter\Exceptions;

use Exception;
use WPEventsImporter\ErrorHandler;

class APIException extends Exception
{

	public function __construct( $error )
	{
		parent::__construct( $error );
	}



	public function push()
	{
		$err_			= [];
		$line			= $this->getLine();
		$file			= $this->getFile();
		$info_msg		= sprintf( 'on %s in %s', $line, $file );
		$err_[ 'info' ]	= \__( $info_msg, WPEVENTSIMPORTER_DOMAIN );

		$message		= $this->getMessage();
		$err_[ 'text' ]	= \__( $message, WPEVENTSIMPORTER_DOMAIN );

		ErrorHandler::add( $err_, 100 );
	}
}

<?php

namespace WPEventsImporter;

class ErrorHandler
{
	protected static $option_name = WPEVENTSIMPORTER_DOMAIN . '__error_handler';



	public static function add( $error = null, $errno = null )
	{
		$error_option = get_option( self::$option_name );

		if ( ! empty( $error ) ) {

			if ( is_array( $error ) && ! empty( $error[ 'text' ] ) ) {
				$error_array = $error;
			} else {
				$error_array[ 'text' ] = $error;
			}

			if ( ! empty( $errno ) ) {
				$error_array[ 'errno' ] = $errno;
			}

			$error_option[] = $error_array;

			update_option( self::$option_name, $error_option );
		}
	}



	public static function notices()
	{
		$errors	= get_option( self::$option_name );

		if ( $errors ) {
			if ( is_array( $errors ) ) :
				foreach ( $errors as $error ) :
					?>
					<div class="notice notice-error">
						<h2> <?php _e( 'WP Events Importer :: ERROR! Something went wrong...' )?></h2>
						<p>
							<?php echo $error[ 'text' ]?>
						</p>
					<?php if( !empty( $error[ 'info' ] ) ) : ?>
						<p>
							<?php echo $error[ 'info' ]?>
						</p>
					<?php endif?>
					</div>
					<?php
				endforeach;
			endif;

			delete_option( self::$option_name );
		}
	}
}

jQuery( document ).ready( function( $ ) {

	function check_the_status() {
		var checklist		= $( "#checkbox-container input:checkbox" );
		var check_status	= '';

		for ( var b = 0, n = checklist.length; b < n; b++ ) {
			check_status = checklist[ b ][ 'checked' ];

			if ( check_status === false ) break;
		}

		$( '#check-controller-box' ).attr( 'checked', check_status );
	}

	check_the_status();

	$( document ).ajaxComplete( function() { check_the_status(); } );

	$( document ).on( 'click', '#checkbox-container input:checkbox', function() {
		check_the_status();
	} );

	$( '#check-controller-box' ).click( function() {
		var check_status = $( this ).attr( 'checked' );

		if( check_status === undefined ) check_status = false;

		$( "#checkbox-container input:checkbox" ).attr( 'checked', check_status );
	} );
} );

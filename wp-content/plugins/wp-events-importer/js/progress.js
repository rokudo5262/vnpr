jQuery( document ).ready( function( $ ) {
	var element, result, oldWidth, progressDiv, widthFx, progressBar, progressHTML;

	if ( typeof ajax_progress_object === "undefined" ) return;

	var data = {
		'progress'	: ajax_progress_object.progress,
		'action'	: ajax_progress_object.action,
		'nonce'		: ajax_progress_object.nonce,
	};

	for ( var progressRow in ajax_progress_object.progress ) {
		progressBar = ajax_progress_object.progress[ progressRow ];

		progressHTML = '<div id="gt-' + progressBar.id + '-progressbar" class="gt-progressbar-container">';
		progressHTML += '	<p class="title">' + progressBar.name + '</p>';
		progressHTML += '	<div class="gt-progressbar">';
		progressHTML += '		<div style="width:' + progressBar.progress + '%">' + progressBar.progress + '%</div>';
		progressHTML += '	</div>';
		progressHTML += '</div>';

		element = $( "#wpbody-content .content-box" ).append( progressHTML );
	}

	var progressInterval = setInterval( function() {
		$.post( ajax_progress_object.ajax_url, data, function( response, status ) {
			results = $.parseJSON( response );

			if ( ! Array.isArray( results ) || status !== "success" ) return;

			for ( var result_row in results ) {
				result = results[ result_row ];

				if ( result.progress === false ) {
					$( "#gt-" + result.id + "-progressbar" ).html( "<h2>Completed!</h2>" );
					clearInterval( progressInterval );
					return false;
				}

				if ( ! Number.isInteger( result.progress ) ) {
					continue;
				}

				progressDiv = $( "#gt-" + result.id + "-progressbar div.gt-progressbar div" );
				oldWidth = parseInt( progressDiv.text() );
				widthFx = result.progress - oldWidth;

				if ( widthFx < 1 || widthFx > 100 ) continue;

				progressDiv.css( { "width": result.progress + "%" } );
				progressDiv.text( result.progress + "%" );
				console.log( result.progress );// Debug
			}
		} );
	}, 5000 );
} );

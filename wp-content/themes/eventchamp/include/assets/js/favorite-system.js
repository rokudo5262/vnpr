(function($){
	var add_text = $( '.gt-content-favorite' ).data("add-popup-text"),
		remove_text = $( '.gt-content-favorite' ).data("remove-popup-text"),
		add_div = $( '<div class="gt-content-favorite-add-popup"></div>' ).html( add_text ),
		remove_div = $( '<div class="gt-content-favorite-remove-popup"></div>' ).html( remove_text );

	$( '.gt-site-wrapper' ).append( add_div );
	$( '.gt-site-wrapper' ).append( remove_div );

	$('.gt-content-favorite-add-popup').css( 'display', 'none' );
	$('.gt-content-favorite-remove-popup').css( 'display', 'none' );

	jQuery('body').on( 'click', '.gt-content-favorite', function(event) {

		event.preventDefault();
		favoriteButton = jQuery(this);

		post_id = favoriteButton.data( 'post_id' );
		data_favorite_title = favoriteButton.data( 'favorite-title' );
		data_added_title = favoriteButton.data( 'added-title' );
		data_favorite_text = favoriteButton.data( 'favorite-text' );
		data_added_text = favoriteButton.data( 'added-text' );

		jQuery.ajax({
			type: "post",
			url: ajax_var.url,
			data: "action=gt-content-favorite&nonce="+ajax_var.nonce+"&eventchamp_content_favorite=&post_id="+post_id,
			success: function(count) {
				if ( count.indexOf( "already" ) !== -1 ) {

					var lecount = count.replace("already","");

					if ( lecount === "0" ) {

						lecount = "0";

					}

					favoriteButton.prop( 'title', data_favorite_title );
					favoriteButton.removeClass( 'gt-favorited' );

					$('.gt-content-favorite-remove-popup').fadeIn();

					setTimeout( function() {

						//$('body').addClass( 'tes-message-oralet' );
						$('.gt-content-favorite-remove-popup').fadeOut();

					}, 3000 )

				} else {

					favoriteButton.prop( 'title', data_added_title );
					favoriteButton.addClass( 'gt-favorited' );

					$('.gt-content-favorite-add-popup').fadeIn();

					setTimeout( function() {

						//$('body').addClass( 'tes-message-oralet' );
						$('.gt-content-favorite-add-popup').fadeOut();

					}, 3000 )

				}
			}
		});
	});
} )( jQuery );
(function($){
	var add_text = $( '.gt-content-like' ).data("add-popup-text"),
		remove_text = $( '.gt-content-like' ).data("remove-popup-text"),
		add_div = $( '<div class="gt-content-like-add-popup"></div>' ).html( add_text ),
		remove_div = $( '<div class="gt-content-like-remove-popup"></div>' ).html( remove_text );

	$( '.gt-site-wrapper' ).append( add_div );
	$( '.gt-site-wrapper' ).append( remove_div );

	$('.gt-content-like-add-popup').css( 'display', 'none' );
	$('.gt-content-like-remove-popup').css( 'display', 'none' );

	jQuery('body').on( 'click', '.gt-content-like', function(event) {

		event.preventDefault();
		likeButton = jQuery(this);

		post_id = likeButton.data("post_id");
		data_like_title = likeButton.data("like-title");
		data_unlike_title = likeButton.data("unlike-title");
		data_add_popup_text = likeButton.data("add-popup-text");

		jQuery.ajax({
			type: "post",
			url: ajax_var.url,
			data: "action=gt-content-like&nonce="+ajax_var.nonce+"&eventchamp_content_like=&post_id="+post_id,
			success: function(count) {
				if ( count.indexOf( "already" ) !== -1 ) {

					var lecount = count.replace("already","");

					if ( lecount === "0" ) {

						lecount = "0";

					}

					likeButton.prop( 'title', data_like_title );
					likeButton.removeClass( 'gt-liked' );
					likeButton.html( '<span>' + lecount + '</span>' );

					$('.gt-content-like-remove-popup').fadeIn();

					setTimeout( function() {

						$('.gt-content-like-remove-popup').fadeOut();

					}, 3000 )


				} else {

					likeButton.prop( 'title', data_unlike_title );
					likeButton.addClass( 'gt-liked' );
					likeButton.html( '<span>' + count + '</span>' );

					$('.gt-content-like-add-popup').fadeIn();

					setTimeout( function() {

						$('.gt-content-like-add-popup').fadeOut();

					}, 3000 )

				}

			}
		});
	});
	





} )( jQuery );
(function($){
	'use strict';

	function pt_open_login_dialog(href) {
		jQuery('#pt-user-modal .modal-dialog').removeClass('registration-complete');

		var modal_dialog = jQuery('#pt-user-modal .modal-dialog');
		modal_dialog.attr('data-active-tab', '');

		switch(href){

			case '#pt-register':
				modal_dialog.attr('data-active-tab', '#pt-register');
				break;

			case '#pt-login':
			default:
				modal_dialog.attr('data-active-tab', '#pt-login');
				break;
		}

		jQuery('#pt-user-modal').modal('show');
	}	

	function pt_close_login_dialog(){
		jQuery('#pt-user-modal').modal('hide');
	}

	jQuery(function($) {

		"use strict";

		$('[href="#pt-login"], [href="#pt-register"]').click(function(e){

			e.preventDefault();

			pt_open_login_dialog( $(this).attr('href') );

		});

		$('.modal-footer a, a[href="#pt-reset-password"]').click(function(e){
			e.preventDefault();
			$('#pt-user-modal .modal-dialog').attr('data-active-tab', $(this).attr('href'));
		});

		$('#pt_login_form').on('submit', function(e){

			e.preventDefault();

			var button = $(this).find('button');
				button.button('loading');

			$.post(ptajax.ajaxurl, $('#pt_login_form').serialize(), function(data){

				var obj = $.parseJSON(data);

				$('.pt-login .pt-errors').html(obj.message);
				
				if(obj.error == false){
					$('#pt-user-modal .modal-dialog').addClass('loading');
					window.location.reload(true);
					button.hide();
				}

				button.button('reset');
			});

		});

		$('#pt_registration_form').on('submit', function(e){

			e.preventDefault();

			var button = $(this).find('button');
				button.button('loading');

			$.post(ptajax.ajaxurl, $('#pt_registration_form').serialize(), function(data){
				
				var obj = $.parseJSON(data);

				$('.pt-register .pt-errors').html(obj.message);
				
				if(obj.error == false){
					$('#pt-user-modal .modal-dialog').addClass('registration-complete');
					button.hide();
				}

				button.button('reset');
				
			});

		});

		if(window.location.hash == '#login'){
			pt_open_login_dialog('#pt-login');
		}		

	});

} )( jQuery );
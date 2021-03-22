function pt_open_login_dialog(href){

	jQuery('#gt-login-popup .gt-modal-dialog').removeClass('gt-registration-complete');

	var modal_dialog = jQuery('#gt-login-popup .gt-modal-dialog');
	modal_dialog.attr('data-gt-active-tab', '');

	switch(href){

		case '#gt-register':
			modal_dialog.attr('data-gt-active-tab', '#gt-register');
			break;

		case '#gt-login':
		default:
			modal_dialog.attr('data-gt-active-tab', '#gt-login');
			break;
	}

	jQuery('#gt-login-popup').modal('show');
}	

function pt_close_login_dialog(){

	jQuery('#gt-login-popup').modal('hide');
}	

jQuery(function($){

	"use strict";

	$('[href="#gt-login"], [href="#gt-register"]').click(function(e){

		e.preventDefault();

		pt_open_login_dialog( $(this).attr('href') );

	});

	$('.modal-footer a, a[href="#pt-reset-password"]').click(function(e){
		e.preventDefault();
		$('#gt-login-popup .gt-modal-dialog').attr('data-gt-active-tab', $(this).attr('href'));
	});

	$('#gt-login-form').on('submit', function(e){

		e.preventDefault();

		var button = $(this).find('button');
			button.button('loading');

		$.post(ptajax.ajaxurl, $('#gt-login-form').serialize(), function(data){

			var obj = $.parseJSON(data);

			$('.gt-login-content .gt-errors').html(obj.message);
			
			if(obj.error == false){
				$('#gt-login-popup .gt-modal-dialog').addClass('loading');
				window.location.reload(true);
				button.hide();
			}

			button.button('reset');
		});

	});

	$('#gt-register-form').on('submit', function(e){

		e.preventDefault();

		var button = $(this).find('button');
			button.button('loading');

		$.post(ptajax.ajaxurl, $('#gt-register-form').serialize(), function(data){
			
			var obj = $.parseJSON(data);

			$('.gt-register-content .gt-errors').html(obj.message);
			
			if(obj.error == false){
				$('#gt-login-popup .gt-modal-dialog').addClass('gt-registration-complete');
				button.hide();
			}

			button.button('reset');
			
		});

	});

	if(window.location.hash == '#login'){
		pt_open_login_dialog('#gt-login');
	}		

});
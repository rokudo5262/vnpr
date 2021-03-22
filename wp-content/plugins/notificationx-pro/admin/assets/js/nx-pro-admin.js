(function ($) {
	"use strict";
	/**
	 * NotificationX Pro - Admin JS
	 */
	$.notificationxPro = $.notificationxPro || {};
	/**
	 * NotificationX Admin Fired
	 * when the document is ready.
	 */
	$(document).ready(function () {
		$.notificationxPro.init();
		var zapierInstructions = $("#nxpro-zapier-instructions");
		$("body").on("change", ".nx_meta_display_type", function () {
			var type = $(this).val();
			zapierInstructions.hide(); // Hide Zapier Instructions
			if (type != "press_bar") {
				$.notificationxPro.soundChange(type);
			}
			$(document.querySelectorAll(".nx-template-keys")).each(function (
				i,
				item
			) {
				$(item).removeClass("nxtk-active");
			});
			var zapierInstructionsTemplateKeys = document.querySelector(
				".nx-template-keys." + type
			);
			$(zapierInstructionsTemplateKeys).addClass("nxtk-active");
			var contentMenu = $(".nx-builder-tab-menu").find(
				'li[data-tab="content_tab"]'
			);
			contentMenu.length > 0 ? contentMenu.hide() : null;
			switch (type) {
				case "email_subscription":
					$(
						".nx-mailchimp_theme .nx_meta_mailchimp_theme:checked"
					).trigger("change");
					$("#nx_meta_mailchimp_advance_edit").trigger("change");
					$.notificationx.trigger(".nx_meta_subscription_source");
					break;
				case "page_analytics":
					$(
						".nx-page_analytics_theme .nx_meta_page_analytics_theme:checked"
					).trigger("change");
					$("#nx_meta_page_analytics_advance_edit").trigger("change");
					$.notificationx.trigger(".nx_meta_page_analytics_source");
					break;
				case "custom":
					$(".nx-custom_theme .nx_meta_custom_theme:checked").trigger(
						"change"
					);
					$("#nx_meta_custom_advance_edit").trigger("change");
					contentMenu.length > 0
						? contentMenu.css("display", "inline-block")
						: null;
					break;
			}
		});

		$(".nx_meta_page_analytics_theme").on("change", function (e) {
			if (
				e.currentTarget.value == "pa-theme-two" &&
				!$("#nx_meta_show_default_image").is(":checked")
			) {
				$("#nx_meta_show_default_image").trigger("click");
			}
			if (e.currentTarget.value == "pa-theme-two") {
				var nxpa = $("input#flames_svg_nx_meta_default_avatar").parents(
					".nx-single-theme-wrapper"
				);
				nxpa.find("label").trigger("click");
			}
			if (
				e.currentTarget.value == "pa-theme-one" &&
				$("#nx_meta_show_default_image").is(":checked")
			) {
				$("#nx_meta_show_default_image").val("0").trigger("click");
			}
			if (
				e.currentTarget.value == "pa-theme-three" &&
				!$("#nx_meta_show_default_image").is(":checked")
			) {
				$("#nx_meta_show_default_image").trigger("click");
			}
			if (e.currentTarget.value == "pa-theme-three") {
				var nxpa = $(
					"input#verified_svg_nx_meta_default_avatar"
				).parents(".nx-single-theme-wrapper");
				nxpa.find("label").trigger("click");
			}
		});

		$("body").on("change", ".nx_meta_conversion_from", function () {
			var conv_source = $(this).val();
			zapierInstructions.hide(); // Hide Zapier Instructions
			switch (conv_source) {
				case "woocommerce":
					$("#nx_meta_product_control").trigger("change");
					$("#nx_meta_product_exclude_by").trigger("change");
					break;
				case "edd":
					$("#nx_meta_edd_product_control").trigger("change");
					$("#nx_meta_edd_product_exclude_by").trigger("change");
					break;
				case "custom_notification":
					$("#nx_meta_custom_template_adv").trigger("change");
					break;
				case "zapier":
					zapierInstructions.fadeIn(200);
					break;
				case "freemius":
					$("#nx_meta_freemius_item_type").trigger("change");
					$("#nx_meta_woo_template_adv").trigger("change");
					break;
			}
		});
		$("body").on("change", ".nx_meta_elearning_source", function () {
			var conv_source = $(this).val();
			switch (conv_source) {
				case "learndash":
					$("#nx_meta_ld_product_control").trigger("change");
					break;
			}
		});
		$("body").on("change", ".nx_meta_reviews_source", function () {
			var conv_source = $(this).val();
			zapierInstructions.hide();
			switch (conv_source) {
				case "freemius":
					$("#nx_meta_freemius_item_type").trigger("change");
					break;
				case "zapier":
					zapierInstructions.fadeIn(200);
					break;
			}
		});

		$("body").on("change", ".nx_meta_stats_source", function () {
			var conv_source = $(this).val();
			switch (conv_source) {
				case "freemius":
					$("#nx_meta_freemius_item_type").trigger("change");
					break;
			}
		});

		$("body").on("change", ".nx_meta_page_analytics_source", function () {
			var conv_source = $(this).val();
			$.notificationx.get_instructions_enabled(false, conv_source);
		});

		$("body").on("change", ".nx_meta_subscription_source", function () {
			var source = $(this).val();
			$.notificationx.get_instructions_enabled(false, source);
			$(".nx-mailchimp_theme .nx_meta_mailchimp_theme:checked").trigger(
				"change"
			);
			zapierInstructions.hide();
			switch (source) {
				case "mailchimp" || "zapier" || "convertkit":
					$("#nx_meta_mailchimp_template_adv").trigger("change");
					break;
			}
			if (source === "zapier") {
				zapierInstructions.fadeIn(200);
			}
		});

		// maps
		$("body").on(
			"change",
			".nx_meta_theme, .nx_meta_comment_theme, .nx_meta_mailchimp_theme, .nx_meta_elearning_theme, .nx_meta_donation_theme",
			function (e) {
				var theme = $(this).val();
				var defaultVal = $("#nx_meta_show_notification_image").data(
					"value"
				);
				if (defaultVal == "") {
					if (theme == "maps_theme" || theme == "conv-theme-six") {
						$("#nx_meta_show_notification_image")
							.val("maps_image")
							.trigger("change");
					} else {
						$("#nx_meta_show_notification_image")
							.val("product_image")
							.trigger("change");
					}
				}
			}
		);

		$("body").on("change", "#nx_sound_checkbox", function () {
			var type = $(".nx_meta_display_type:checked").val();
			var sound = $("#nx_meta_" + type + "_sound");
			var active = $(this)
				.parents(".nx-sound-appearance")
				.find(".nx-left .nx-sound-active");
			active
				.removeClass("nx-sound-active")
				.siblings()
				.addClass("nx-sound-active");
			if (this.checked) {
				sound.val("to-the-point").trigger("change");
				$("body, html").animate(
					{
						scrollTop: sound.offset().top,
					},
					500
				);
			} else {
				sound.val("none").trigger("change");
			}
		});
	});

	$.notificationxPro.init = function () {
		$.notificationxPro.bindEvents();
		$.notificationxPro.initializeFields();
		$.notificationxPro.clipboard();
		$.notificationxPro.disableGoogleAnalyticsOptions();
	};

	$.notificationxPro.soundChange = function (sound_type) {
		$("body").on(
			"change",
			"#nx_meta_" + sound_type + "_sound",
			function () {
				var sound_name = $(this).val(),
					volume = $("#nx_meta_volume").val();
				if (sound_name != "none") {
					var sound = $(".nx-admin-audio-list").find(
						"#" + sound_name
					);
					if (sound.length > 0) {
						sound = sound[0];
						sound.volume = parseFloat(volume);
						sound.play();
					}
				}
			}
		);
	};

	$.notificationxPro.clipboard = function () {
		var clipboard = new ClipboardJS(".nx-shortcode-btn");
		var zapier_api_key = $("#nx_meta_zapier_api_key");
		zapier_api_key.on("click", function (e) {
			var $this = $(this),
				val = $this.val();
		});
		clipboard.on("success", function (e) {
			swal({
				title: "Copied",
				text: e.text,
				icon: "success",
				buttons: false,
				timer: 1000,
			});
			e.clearSelection();
		});
	};

	$.notificationxPro.initializeFields = function () {
		/**
		 * Slider Range
		 */
		if ($(".nx-slider-wrap").length > 0) {
			$(".nx-slider-wrap").map(function (iterator, item) {
				var handle = $(item).find(".ui-slider-handle");
				var input = $(item).find("input");
				var inputValue = input.attr("value");
				var volume = parseInt(inputValue * 100);

				$(item).slider({
					create: function () {
						$(this).slider("value", volume);
						handle.text(volume);
						input.val(inputValue);
					},
					slide: function (event, ui) {
						var type = $(".nx_meta_display_type:checked").val();
						var sound_name = $("#nx_meta_" + type + "_sound").val();
						if (sound_name != "none") {
							var sound = $(".nx-admin-audio-list").find(
								"#" + sound_name
							);
							if (sound.length > 0) {
								sound = sound[0];
								sound.volume = parseFloat(ui.value / 100);
								if (sound.played) {
									sound.load();
								} else {
								}
								var playPromise = sound.play();
								if (playPromise !== undefined) {
									playPromise
										.then(function () {
											// console.log('')
										})
										.catch(function (error) {
											// console.log('Nothing to Worry');
										});
								}
							}
						}
						handle.text(ui.value);
						input.val(ui.value / 100);
					},
				});
			});
		}
	};

	$.notificationxPro.disableGoogleAnalyticsOptions = function () {
		// var isConnected = $('.ga-not-connected'),
		// 	noUserApp = $('.no-user-app');
		// if(isConnected.length){
		// 	$('#nx_meta_page_analytics_template_new_first_param option').each(function(index, el){
		// 		$(el).attr('disabled',true);
		// 	})
		// }
		// if(noUserApp.length){
		// 	$('#nx_meta_page_analytics_template_new_first_param option').each(function(index, el){
		// 		var elem = $(el);
		// 		if(elem.val() !== 'tag_siteview'){
		// 			elem.attr('disabled',true);
		// 		}
		// 	})
		// }
	};

	$.notificationxPro.bindEvents = function () {
		$("#nx_meta_show_on").on("change", function () {
			var val = $(this).val();
			if (val != "everywhere") {
				$("#nx_meta_all_locations").trigger("change");
			}
			if (val == "everywhere") {
				$("#nx_meta_all_locations")
					.val("is_front_page")
					.trigger("change");
			}
		});
		var total_items = $("body #nx-api_integrations_tab").find(
			"div.nx-api-integration-settings"
		).length;
		var hidden_items = $("body #nx-api_integrations_tab").find(
			"div.nx-api-integration-settings.hidden"
		).length;
		if (total_items == hidden_items) {
			$(".nx-settings-menu")
				.find('li[data-tab="api_integrations_tab"]')
				.hide();
		} else {
			$(".nx-settings-menu")
				.find('li[data-tab="api_integrations_tab"]')
				.css("display", "inline-block");
		}
		// MailChimp
		$("body").on("click", ".nx-api-integration-header", function (e) {
			e.preventDefault();
			$(this)
				.parent(".nx-api-integration-settings")
				.siblings()
				.find(".nx-api-integration-inner.open")
				.slideUp();
			$(this)
				.next(".nx-api-integration-inner")
				.slideDown()
				.addClass("open");
		});
		$("body").on("click", ".nx-checkbox input", function (e) {
			e.stopPropagation();
			var api_settings = $("#api_" + this.id),
				total_items = $("body #nx-api_integrations_tab").find(
					"div.nx-api-integration-settings"
				).length;
			if (api_settings.length > 0) {
				this.checked
					? api_settings.removeClass("hidden")
					: api_settings.addClass("hidden");
				var hidden_items = $("body #nx-api_integrations_tab").find(
					"div.nx-api-integration-settings.hidden"
				).length;
				if (total_items == hidden_items) {
					$(".nx-settings-menu")
						.find('li[data-tab="api_integrations_tab"]')
						.hide();
				} else {
					$(".nx-settings-menu")
						.find('li[data-tab="api_integrations_tab"]')
						.css("display", "inline-block");
				}
			}
		});
		// MailChimp
		$("body").delegate(
			".nx-api-settings-button.mailchimp_settings_section",
			"click",
			function (e) {
				e.preventDefault();
				$.notificationxPro.mailchimpConnect(this);
			}
		);
		// Freemius
		$("body").delegate(
			".nx-api-settings-button.freemius_settings_section",
			"click",
			function (e) {
				e.preventDefault();
				$.notificationxPro.freemiusConnect(this);
			}
		);
		// ConvertKit
		$("body").delegate(
			".nx-api-settings-button.convertkit_settings_section",
			"click",
			function (e) {
				e.preventDefault();
				$.notificationxPro.convertkitConnect(this);
			}
		);
		// Envato
		$("body").delegate(
			".nx-api-settings-button.envato_settings_section",
			"click",
			function (e) {
				e.preventDefault();
				$.notificationxPro.envatoAPI(this);
			}
		);
		$("body").on(
			"click",
			".nx-api-settings-button.google_analytics_settings_section",
			function (e) {
				e.preventDefault();
				$.notificationxPro.googleApiConnect(this);
			}
		);
		$("body").on(
			"click",
			".google_analytics_settings_section .disconnect-analytics",
			function (e) {
				e.preventDefault();
				$.notificationxPro.googleApiDisConnect(this);
			}
		);
		$("body").on(
			"click",
			".google_analytics_settings_section .setup-google-app",
			function (e) {
				e.preventDefault();
				$.notificationxPro.setupUserGoogleAppOptions(this);
			}
		);
		$("body").on(
			"click",
			".google_analytics_settings_section .connect-user-app",
			function (e) {
				e.preventDefault();
				$.notificationxPro.connectUserGoogleApp(this);
			}
		);
	};

	// MailChimp
	$.notificationxPro.mailchimpConnect = function (button) {
		var button = $(button),
			key = button.data("key"),
			parent = button.parent(),
			api_key = parent.find("#nx_meta_mailchimp_api_key").val(),
			nonce = button.data("nonce"),
			data = {
				action: "nx_mailchimp_connect",
				nonce: nonce,
				api_key: api_key,
				key: key,
			};
		$.notificationxPro.AJAX(data, button);
	};
	// Freemius
	$.notificationxPro.freemiusConnect = function (button) {
		var button = $(button),
			key = button.data("key"),
			parent = button.parent(),
			dev_id = parent.find("#nx_meta_freemius_dev_id").val(),
			dev_public_key = parent.find("#nx_meta_freemius_dev_pk").val(),
			dev_secret_key = parent.find("#nx_meta_freemius_dev_sk").val(),
			nonce = button.data("nonce"),
			data = {
				action: "nx_freemius_connect",
				nonce: nonce,
				dev_id: dev_id,
				dev_public_key: dev_public_key,
				dev_secret_key: dev_secret_key,
				key: key,
			};
		$.notificationxPro.AJAX(data, button);
	};
	// ConvertKit
	$.notificationxPro.convertkitConnect = function (button) {
		var button = $(button),
			key = button.data("key"),
			parent = button.parent(),
			api_key = parent.find("#nx_meta_convertkit_api_key").val(),
			api_secret = parent.find("#nx_meta_convertkit_api_secret").val(),
			nonce = button.data("nonce"),
			data = {
				action: "nx_convertkit_connect",
				nonce: nonce,
				api_key: api_key,
				api_secret: api_secret,
				key: key,
			};
		$.notificationxPro.AJAX(data, button);
	};
	// Envato
	$.notificationxPro.envatoAPI = function (button) {
		var button = $(button),
			key = button.data("key"),
			parent = button.parent(),
			api_token = parent.find("#nx_meta_envato_token").val(),
			nonce = button.data("nonce"),
			data = {
				action: "nx_envato_api",
				nonce: nonce,
				api_token: api_token,
				key: key,
			};
		$.notificationxPro.AJAX(data, button);
	};

	$.notificationxPro.googleApiConnect = function (button) {
		var button = $(button),
			key = button.data("key"),
			parent = button.parent(),
			ga_profile = parent.find("#nx_meta_ga_profile").val(),
			ga_cache_duration = parent.find("#nx_meta_ga_cache_duration").val(),
			nonce = button.data("nonce"),
			data = {
				action: "nx_save_ga_settings",
				nonce: nonce,
				ga_profile: ga_profile,
				ga_cache_duration: ga_cache_duration,
				key: key,
			};
		$.notificationxPro.AJAX(data, button);
	};

	$.notificationxPro.googleApiDisConnect = function (button) {
		var button = $(button),
			data = {
				action: "nx_ga_disconnect_account",
			};
		$.ajax({
			type: "POST",
			url: NXPROJS.ajaxurl,
			data: data,
			beforeSend: function () {
				button.html(
					'<svg id="nx-spinner" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48"><circle cx="24" cy="4" r="4" fill="#fff"/><circle cx="12.19" cy="7.86" r="3.7" fill="#fffbf2"/><circle cx="5.02" cy="17.68" r="3.4" fill="#fef7e4"/><circle cx="5.02" cy="30.32" r="3.1" fill="#fef3d7"/><circle cx="12.19" cy="40.14" r="2.8" fill="#feefc9"/><circle cx="24" cy="44" r="2.5" fill="#feebbc"/><circle cx="35.81" cy="40.14" r="2.2" fill="#fde7af"/><circle cx="42.98" cy="30.32" r="1.9" fill="#fde3a1"/><circle cx="42.98" cy="17.68" r="1.6" fill="#fddf94"/><circle cx="35.81" cy="7.86" r="1.3" fill="#fcdb86"/></svg><span>Disconnecting...</span>'
				);
			},
			success: function (r) {
				var response = JSON.parse(r);
				if (response.status === "success") {
					window.location.reload();
				}
			},
		});
	};

	$.notificationxPro.setupUserGoogleAppOptions = function (button) {
		var btn = $(button),
			data = {
				action: "nx_ga_disconnect_account",
			},
			btnText = "Setting up environment...";
		if ($("#nx-meta-ga_profile").length) {
			btnText = "Disconnecting account...";
		}
		$.ajax({
			type: "POST",
			url: NXPROJS.ajaxurl,
			data: data,
			beforeSend: function () {
				btn.html(
					'<svg id="nx-spinner" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48"><circle cx="24" cy="4" r="4" fill="#fff"/><circle cx="12.19" cy="7.86" r="3.7" fill="#fffbf2"/><circle cx="5.02" cy="17.68" r="3.4" fill="#fef7e4"/><circle cx="5.02" cy="30.32" r="3.1" fill="#fef3d7"/><circle cx="12.19" cy="40.14" r="2.8" fill="#feefc9"/><circle cx="24" cy="44" r="2.5" fill="#feebbc"/><circle cx="35.81" cy="40.14" r="2.2" fill="#fde7af"/><circle cx="42.98" cy="30.32" r="1.9" fill="#fde3a1"/><circle cx="42.98" cy="17.68" r="1.6" fill="#fddf94"/><circle cx="35.81" cy="7.86" r="1.3" fill="#fcdb86"/></svg><span>' +
						btnText +
						"</span>"
				);
			},
			success: function (r) {
				var response = JSON.parse(r);
				if (response.status === "success") {
					$(
						"#nx-meta-ga_disconnect, #nx-meta-ga_profile, #nx-meta-ga_cache_duration, #nx-meta-ga_connect"
					)
						.hide()
						.remove();
					btn.parents(".nx-field").hide();
					$(
						"#nx-meta-ga_redirect_uri, #nx-meta-ga_client_id, #nx-meta-ga_client_secret, #nx-meta-ga_user_app_connect"
					).fadeIn();
				}
			},
		});
	};

	$.notificationxPro.connectUserGoogleApp = function (button) {
		var btn = $(button),
			clientId = $("#nx_meta_ga_client_id").val(),
			clientSecret = $("#nx_meta_ga_client_secret").val();
		if (clientId.length === 0 || clientSecret.length === 0) {
			if (clientId.length === 0) {
				$("#nx_meta_ga_client_id")
					.addClass("has-error")
					.after(
						'<small class="nx-error">Client Id is required </small>'
					);
			}
			if (clientId.length === 0) {
				$("#nx_meta_ga_client_secret")
					.addClass("has-error")
					.after(
						'<small class="nx-error">Client Secret is required </small>'
					);
			}
			return;
		}
		var form = $(".nx-settings-wrap .nx-settings #nx-settings-form"),
			data = {
				action: "nx_ga_save_user_app_info",
				key: btn.data("key"),
				nonce: btn.data("nonce"),
				form_data: $(form).serializeArray(),
				client_id: clientId,
				client_secret: clientSecret,
			};

		$.ajax({
			type: "POST",
			url: NXPROJS.ajaxurl,
			data: data,
			beforeSend: function () {
				btn.html(
					'<svg id="nx-spinner" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48"><circle cx="24" cy="4" r="4" fill="#fff"/><circle cx="12.19" cy="7.86" r="3.7" fill="#fffbf2"/><circle cx="5.02" cy="17.68" r="3.4" fill="#fef7e4"/><circle cx="5.02" cy="30.32" r="3.1" fill="#fef3d7"/><circle cx="12.19" cy="40.14" r="2.8" fill="#feefc9"/><circle cx="24" cy="44" r="2.5" fill="#feebbc"/><circle cx="35.81" cy="40.14" r="2.2" fill="#fde7af"/><circle cx="42.98" cy="30.32" r="1.9" fill="#fde3a1"/><circle cx="42.98" cy="17.68" r="1.6" fill="#fddf94"/><circle cx="35.81" cy="7.86" r="1.3" fill="#fcdb86"/></svg><span>Connecting...</span>'
				);
			},
			success: function (r) {
				var response = JSON.parse(r);
				if (response.status === "success") {
					window.location.replace(response.auth_url);
				}
			},
			complete: function () {
				btn.html("disconnect");
			},
		});
	};

	$.notificationxPro.AJAX = function (data, button) {
		if (data == "" || data == undefined) {
			return;
		}
		var form = $(".nx-settings-wrap .nx-settings #nx-settings-form"),
			formData = $(form).serializeArray();

		data.form_data = formData;
		var button_text = button.text();

		$.ajax({
			type: "POST",
			url: NXPROJS.ajaxurl,
			data: data,
			beforeSend: function () {
				button.html(
					'<svg id="nx-spinner" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 48 48"><circle cx="24" cy="4" r="4" fill="#fff"/><circle cx="12.19" cy="7.86" r="3.7" fill="#fffbf2"/><circle cx="5.02" cy="17.68" r="3.4" fill="#fef7e4"/><circle cx="5.02" cy="30.32" r="3.1" fill="#fef3d7"/><circle cx="12.19" cy="40.14" r="2.8" fill="#feefc9"/><circle cx="24" cy="44" r="2.5" fill="#feebbc"/><circle cx="35.81" cy="40.14" r="2.2" fill="#fde7af"/><circle cx="42.98" cy="30.32" r="1.9" fill="#fde3a1"/><circle cx="42.98" cy="17.68" r="1.6" fill="#fddf94"/><circle cx="35.81" cy="7.86" r="1.3" fill="#fcdb86"/></svg><span>Connecting...</span>'
				);
			},
			success: function (res) {
				button.html(button_text);
				if (res != "") {
					var response = JSON.parse(res);
					if (response.status == "success") {
						swal({
							title: "Settings Saved!",
							text: "Click OK to continue",
							icon: "success",
							buttons: [false, "Ok"],
							timer: 2000,
						});
					} else {
						swal({
							title: "Something went wrong!",
							text: response.message,
							icon: "error",
							buttons: [false, "Cancel"],
						});
					}
				}
			},
			complete: function (res) {
				var mcMsg = $(".nx-pro-mc-message");
				if (res.statusText === "OK") {
					//TODO:
					/**
					 * Something has to be done with the message
					 * auto hide after few seconds
					 */
				}
			},
		});
	};
})(jQuery);

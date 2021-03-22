(function ($) {
	"use strict";

	$.notificationXProPublic = $.notificationXProPublic || {};

	$(document).ready(function () {
		$.notificationXProPublic.init();
		$.notificationXProPublic.pressbar();
	});

	$.notificationXProPublic.pressbar = function () {
		var bars = $(".nx-bar");
		if (bars.length > 0) {
			bars.each(function (i, bar) {
				var id = bar.dataset.press_id,
					current_date = new Date(),
					eg_expire_in = parseInt(bar.dataset.eg_expire_in),
					time_randomize = Boolean(
						parseInt(bar.dataset.time_randomize)
					),
					duration_timestamp = parseInt(
						bar.dataset.duration_timestamp
					),
					time_reset = Boolean(parseInt(bar.dataset.time_reset)),
					start_date = bar.dataset.start_date
						? new Date(bar.dataset.start_date)
						: false,
					end_date = bar.dataset.end_date
						? new Date(bar.dataset.end_date)
						: false,
					evergreen = Boolean(bar.dataset.evergreen);

				if (time_reset) {
					if (Cookies.get("nx_evergreen_first_seen_" + id)) {
						var cTime = new Date(
							Cookies.get("nx_evergreen_first_seen_" + id)
						);

						if (cTime.getDate() !== current_date.getDate()) {
							Cookies.clear("nx_evergreen_first_seen_" + id);
							Cookies.clear("nx_evergreen_first_seen_time_" + id);
							Cookies.clear("notificationx_nx-bar-" + id);
						}
					}
				}

				if (Cookies.get("notificationx_nx-bar-" + id)) {
					return false;
				}

				if (evergreen) {
					var end_timestamp = 0;
					if (Cookies.get("nx_evergreen_first_seen_" + id)) {
						var cTime = new Date(
							Cookies.get("nx_evergreen_first_seen_" + id)
						);
						end_timestamp =
							parseInt(cTime.getTime()) + eg_expire_in;
					} else {
						Cookies.set(
							"nx_evergreen_first_seen_" + id,
							current_date
						);
						var cTime = new Date(
							Cookies.get("nx_evergreen_first_seen_" + id)
						);
						end_timestamp =
							parseInt(cTime.getTime()) + eg_expire_in;
					}

					end_date = new Date(end_timestamp);
					if (time_randomize) {
						if (!Cookies.get("nx_evergreen_first_seen_" + id)) {
							Cookies.set(
								"nx_evergreen_first_seen_" + id,
								new Date()
							);
						}

						if (Cookies.get("nx_evergreen_first_seen_time_" + id)) {
							duration_timestamp = parseInt(
								Cookies.get(
									"nx_evergreen_first_seen_time_" + id
								)
							);
						} else {
							Cookies.set(
								"nx_evergreen_first_seen_time_" + id,
								duration_timestamp
							);
						}
						var cTime = new Date(
							Cookies.get("nx_evergreen_first_seen_" + id)
						);
						var newEnd =
							parseInt(cTime.getTime()) + duration_timestamp;
						newEnd = new Date(newEnd);
						end_date = newEnd;
					}
				}

				var cdWargs = {
					id: id,
					bar: bar,
					end_date: end_date,
					evergreen: evergreen,
					start_date: start_date,
					days: bar.querySelector(".nx-days"),
					hours: bar.querySelector(".nx-hours"),
					minutes: bar.querySelector(".nx-minutes"),
					seconds: bar.querySelector(".nx-seconds"),
				};
				$.notificationx.countdownWrapper(cdWargs);
			});
		}
	};

	$.notificationXProPublic.getRandomInt = function (min, max) {
		min = Math.ceil(min);
		max = Math.floor(max);
		return Math.floor(Math.random() * (max - min)) + min;
	};

	$.notificationXProPublic.init = function () {
		$.notificationXProPublic.sound();
		// for shortcode
		var shortcodeWrapper = $(".notificationx-shortcode-wrapper");
		if (shortcodeWrapper.length > 0) {
			var height = $(
				".notificationx-shortcode-wrapper > div:first"
			).outerHeight();
			shortcodeWrapper.css("height", height);
			var config = shortcodeWrapper.data("config");
			$("html").removeClass("has-nx-bar");
			$.notificationXProPublic.shortcodeRender(
				config,
				shortcodeWrapper.html()
			);
		}
	};

	$.notificationXProPublic.sound = function () {
		$("body").on("nx_frontend_jquery", function (
			event,
			configuration,
			notification
		) {
			if (configuration.sound == "1") {
				var sound = $(notification).find("audio");
				sound = sound[0];
				sound.volume = parseFloat(configuration.volume);
				sound.muted = false;
				var promise = sound.play();
				// TODO: something to do with DOM Promise
				if (promise !== undefined) {
					promise
						.then(function () {
							// console.log( promise.value );
						})
						.catch(function (e) {
							console.log("error: ", e);
						});
				}
			}
		});
	};
	/**
	 * For Shortcode Notification Render
	 */
	$.notificationXProPublic.shortcodeRender = function (configuration, html) {
		var notificationHTML = document.createElement("div");
		notificationHTML.classList.add("notificationx-conversions-shortcode");
		notificationHTML.insertAdjacentHTML("beforeend", html);

		var count = 0,
			notifications = notificationHTML.querySelectorAll(
				".notificationx-" + configuration.id
			),
			delayBetween = configuration.delay_between,
			last = $.notificationx.last(configuration.id, false);

		if (last >= 0) {
			count = last + 1;
		}

		if (notifications.length === 1) {
			count = 0;
		}

		if (configuration.loop === 0 && notifications.length === 1) {
			count = 0;
		}

		$("body").trigger("nx_before_render", [configuration, html]);
		setTimeout(function () {
			$.notificationXProPublic.shortcodeShow(
				notifications[count],
				configuration,
				count
			);
			setTimeout(function () {
				if (configuration.loop !== 0) {
					$.notificationXProPublic.shortcodeHide(
						notifications[count],
						count
					);
				}
				count++;
				var nextNotification = setInterval(function () {
					$.notificationXProPublic.shortcodeShow(
						notifications[count],
						configuration,
						count
					);
					setTimeout(function () {
						$.notificationXProPublic.shortcodeHide(
							notifications[count],
							count
						);
						if (count >= notifications.length - 1) {
							count = 0;
							if (configuration.loop === 0) {
								clearInterval(nextNotification);
							}
						} else {
							count++;
						}
					}, configuration.display_for);
				}, delayBetween + configuration.display_for);
			}, configuration.display_for);
		}, configuration.delay_before);
	};
	/**
	 * Shortcode Single Notification Show
	 */
	$.notificationXProPublic.shortcodeShow = function (
		notification,
		configuration,
		count
	) {
		if ("undefined" === typeof notification || 0 === notification.length) {
			return;
		}
		var htmls = $(".notificationx-shortcode-wrapper > div");
		var body = $("body");
		$(htmls[count]).addClass("nx-animate").animate(
			{
				opacity: 1,
			},
			500
		);
		body.trigger("nx_frontend_jquery", [configuration, notification]);
		var nxClose = $(notification).find(".notificationx-close");
		if (nxClose != null) {
			nxClose.on("click", function (event) {
				var close = $(this);
				var parent = $(close[0]).parents(".nx-notification");
				$.notificationXProPublic.shortcodeHide(parent);
			});
		}
	};
	/**
	 * Shortcode Single Notification Hide
	 */
	$.notificationXProPublic.shortcodeHide = function (notification, count) {
		if (notification === undefined) {
			return;
		}
		if (Cookies.get("nx-close-for-session")) {
			return;
		}
		var htmls = $(".notificationx-shortcode-wrapper > div");
		$(htmls[count]).animate(
			{
				opacity: 0,
			},
			500,
			"swing",
			function () {
				$(this).removeClass("nx-animate");
			}
		);
	};
})(jQuery);

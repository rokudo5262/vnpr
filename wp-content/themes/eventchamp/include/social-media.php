<?php
/*======
*
* Social Media Sites
*
======*/
if( !function_exists( 'eventchamp_social_media_sites' ) ) {

	function eventchamp_social_media_sites( $custom_links = "" ) {

		$output = "";

		/*====== Customizer Settings ======*/
		$links = ot_get_option( 'social-links' );

		/*====== Custom Links ======*/
		if( !empty( $custom_links ) ) {

			$links = $custom_links;

		}

		/*====== HTML Output ======*/
		if( !empty( $links ) ) {

			$output .= '<ul class="gt-social-links">';

				foreach( $links as $link ) {

					if( !empty( $link ) ) {

						if( $link["url"] and $link["title"] ) {

							if( empty( $link["target"] ) ) {

								$link["target"] == "_self";

							}

							if( isset( $link["icon"] ) ) {

								$icon = $link["icon"];

							}

							$output .= '<li>';
								$output .= '<a href="' . esc_url( $link["url"] ) . '" target="' . esc_attr( $link["target"] ) . '">';

									if( !empty( $link["icon"] ) ) {

										$output .= '<i class="' . eventchamp_social_media_site_icon_class( $site = esc_attr( $link["icon"] ) ) . '"></i>';

									}

								$output .= '</a>';
							$output .= '</li>';

						}

					}

				}

			$output .= '</ul>';

		}

		return $output;

	}

}



/*======
*
* Social Media Site Icon Class
*
======*/
if( !function_exists( 'eventchamp_social_media_site_icon_class' ) ) {

	function eventchamp_social_media_site_icon_class( $site = "" ) {

		if( !empty( $site ) ) {

			if( $site == "500px" ) {

				$icon = "fab fa-500px";

			} elseif( $site == "airbnb" ) {

				$icon = "fab fa-airbnb";

			} elseif( $site == "amazon" ) {

				$icon = "fab fa-amazon";

			} elseif( $site == "app-store" ) {

				$icon = "fab fa-app-store";

			} elseif( $site == "apple" ) {

				$icon = "fab fa-apple";

			} elseif( $site == "artstation" ) {

				$icon = "fab fa-artstation";

			} elseif( $site == "bandcamp" ) {

				$icon = "fab fa-bandcamp";

			} elseif( $site == "battle-net" ) {

				$icon = "fab fa-battle-net";

			} elseif( $site == "behance" ) {

				$icon = "fab fa-behance";

			} elseif( $site == "blogger" ) {

				$icon = "fab fa-blogger-b";

			} elseif( $site == "codepen" ) {

				$icon = "fab fa-codepen";

			} elseif( $site == "dailymotion" ) {

				$icon = "fab fa-dailymotion";

			} elseif( $site == "delicious" ) {

				$icon = "fab fa-delicious";

			} elseif( $site == "deviantart" ) {

				$icon = "fab fa-deviantart";

			} elseif( $site == "digg" ) {

				$icon = "fab fa-digg";

			} elseif( $site == "discord" ) {

				$icon = "fab fa-discord";

			} elseif( $site == "dribbble" ) {

				$icon = "fab fa-dribbble";

			} elseif( $site == "dropbox" ) {

				$icon = "fab fa-dropbox";

			} elseif( $site == "ebay" ) {

				$icon = "fab fa-ebay";

			} elseif( $site == "etsy" ) {

				$icon = "fab fa-etsy";

			} elseif( $site == "facebook" ) {

				$icon = "fab fa-facebook-f";

			} elseif( $site == "facebook-messenger" ) {

				$icon = "fab fa-facebook-messenger";

			} elseif( $site == "flickr" ) {

				$icon = "fab fa-flickr";

			} elseif( $site == "foursquare" ) {

				$icon = "fab fa-foursquare";

			} elseif( $site == "github" ) {

				$icon = "fab fa-github";

			} elseif( $site == "goodreads" ) {

				$icon = "fab fa-goodreads-g";

			} elseif( $site == "google" ) {

				$icon = "fab fa-google";

			} elseif( $site == "google-drive" ) {

				$icon = "fab fa-google-drive";

			} elseif( $site == "google-play" ) {

				$icon = "fab fa-google-play";

			} elseif( $site == "imdb" ) {

				$icon = "fab fa-imdb";

			} elseif( $site == "instagram" ) {

				$icon = "fab fa-instagram";

			} elseif( $site == "itunes" ) {

				$icon = "fab fa-itunes";

			} elseif( $site == "jsfiddle" ) {

				$icon = "fab fa-jsfiddle";

			} elseif( $site == "kickstarter" ) {

				$icon = "fab fa-kickstarter-k";

			} elseif( $site == "lastfm" ) {

				$icon = "fab fa-lastfm";

			} elseif( $site == "line" ) {

				$icon = "fab fa-line";

			} elseif( $site == "linkedin" ) {

				$icon = "fab fa-linkedin-in";

			} elseif( $site == "medium" ) {

				$icon = "fab fa-medium-m";

			} elseif( $site == "meetup" ) {

				$icon = "fab fa-meetup";

			} elseif( $site == "microsoft" ) {

				$icon = "fab fa-microsoft";

			} elseif( $site == "odnoklassniki" ) {

				$icon = "fab fa-odnoklassniki";

			} elseif( $site == "patreon" ) {

				$icon = "fab fa-patreon";

			} elseif( $site == "paypal" ) {

				$icon = "fab fa-paypal";

			} elseif( $site == "periscope" ) {

				$icon = "fab fa-periscope";

			} elseif( $site == "php" ) {

				$icon = "fab fa-php";

			} elseif( $site == "pinterest" ) {

				$icon = "fab fa-pinterest-p";

			} elseif( $site == "playstation" ) {

				$icon = "fab fa-playstation";

			} elseif( $site == "product-hunt" ) {

				$icon = "fab fa-product-hunt";

			} elseif( $site == "quora" ) {

				$icon = "fab fa-quora";

			} elseif( $site == "readme" ) {

				$icon = "fab fa-readme";

			} elseif( $site == "reddit" ) {

				$icon = "fab fa-reddit-alien";

			} elseif( $site == "rss" ) {

				$icon = "fas fa-rss";

			} elseif( $site == "safari" ) {

				$icon = "fab fa-safari";

			} elseif( $site == "scribd" ) {

				$icon = "fab fa-scribd";

			} elseif( $site == "shopify" ) {

				$icon = "fab fa-shopify";

			} elseif( $site == "skype" ) {

				$icon = "fab fa-skype";

			} elseif( $site == "slack" ) {

				$icon = "fab fa-slack-hash";

			} elseif( $site == "snapchat" ) {

				$icon = "fab fa-snapchat-ghost";

			} elseif( $site == "soundcloud" ) {

				$icon = "fab fa-soundcloud";

			} elseif( $site == "spotify" ) {

				$icon = "fab fa-spotify";

			} elseif( $site == "steam" ) {

				$icon = "fab fa-steam-symbol";

			} elseif( $site == "stumbleupon" ) {

				$icon = "fab fa-stumbleupon";

			} elseif( $site == "teamspeak" ) {

				$icon = "fab fa-teamspeak";

			} elseif( $site == "telegram" ) {

				$icon = "fab fa-telegram-plane";

			} elseif( $site == "tripadvisor" ) {

				$icon = "fab fa-tripadvisor";

			} elseif( $site == "tumblr" ) {

				$icon = "fab fa-tumblr";

			} elseif( $site == "twitch" ) {

				$icon = "fab fa-twitch";

			} elseif( $site == "twitter" ) {

				$icon = "fab fa-twitter";

			} elseif( $site == "vimeo" ) {

				$icon = "fab fa-vimeo-v";

			} elseif( $site == "vk" ) {

				$icon = "fab fa-vk";

			} elseif( $site == "whatsapp" ) {

				$icon = "fab fa-whatsapp";

			} elseif( $site == "wikipedia" ) {

				$icon = "fab fa-wikipedia-w";

			} elseif( $site == "wordpress" ) {

				$icon = "fab fa-wordpress";

			} elseif( $site == "xbox" ) {

				$icon = "fab fa-xbox";

			} elseif( $site == "xing" ) {

				$icon = "fab fa-xing";

			} elseif( $site == "yahoo" ) {

				$icon = "fab fa-yahoo";

			} elseif( $site == "yandex" ) {

				$icon = "fab fa-yandex-international";

			} elseif( $site == "yelp" ) {

				$icon = "fab fa-yelp";

			} elseif( $site == "youtube" ) {

				$icon = "fab fa-youtube";

			} elseif( $site == "link-1" ) {

				$icon = "fas fa-link";

			} elseif( $site == "link-2" ) {

				$icon = "fas fa-external-link-alt";

			} elseif( $site == "link-3" ) {

				$icon = "fas fa-anchor";

			} elseif( $site == "email" ) {

				$icon = "far fa-envelope";

			}

			if( !empty( $icon ) ) {
		
				return $icon;

			}

		}

	}

}



/*======
*
* Social Share
*
======*/
if( !function_exists( 'eventchamp_social_share' ) ) {

	function eventchamp_social_share( $style = "style-1" ) {

		$facebook_share = ot_get_option( 'social_share_facebook', 'on' );
		$twitter_share = ot_get_option( 'social_share_twitter', 'on' );
		$googleplus_share = ot_get_option( 'social_share_googleplus', 'off' );
		$linkedin_share = ot_get_option( 'social_share_linkedin', 'on' );
		$whatsapp_share = ot_get_option( 'social_share_whatsapp', 'on' );
		$pinterest_share = ot_get_option( 'social_share_pinterest', 'off' );
		$reddit_share = ot_get_option( 'social_share_reddit', 'off' );
		$delicious_share = ot_get_option( 'social_share_delicious', 'off' );
		$vk_share = ot_get_option( 'social_share_vk', 'off' );
		$tumblr_share = ot_get_option( 'social_share_tumblr', 'off' );
		$email_share = ot_get_option( 'social_share_email', 'on' );

		$output = '<div class="gt-social-sharing gt-' . esc_attr( $style ) . '">';
			$output .= '<ul>';

			if( $facebook_share == 'on' ) {

				$output .= '<li class="gt-facebook">';
					$output .= '<a href="' . esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink() . '&t=' . urlencode( get_the_title() ) ) . '" target="_blank">';
						$output .= '<i class="fab fa-facebook-f"></i>';
						$output .= '<span>' . esc_attr__( 'Facebook', 'eventchamp' ) . '</span>';
					$output .= '</a>';
				$output .= '</li>';

			}

			if( $twitter_share == 'on' ) {

				$output .= '<li class="gt-twitter">';
					$output .= '<a href="' . esc_url( 'https://twitter.com/intent/tweet?url=' . get_the_permalink() . '&text=' . urlencode( get_the_title() ) ) . '" target="_blank">';
						$output .= '<i class="fab fa-twitter"></i>';
						$output .= '<span>' . esc_attr__( 'Twitter', 'eventchamp' ) . '</span>';
					$output .= '</a>';
				$output .= '</li>';

			}

			if( $googleplus_share == 'on' ) {

				$output .= '<li class="gt-google-plus">';
					$output .= '<a href="' . esc_url( 'https://plus.google.com/share?url=' . get_the_permalink() ) . '" target="_blank">';
						$output .= '<i class="fab fa-google-plus-g"></i>';
						$output .= '<span>' . esc_attr__( 'Google+', 'eventchamp' ) . '</span>';
					$output .= '</a>';
				$output .= '</li>';

			}

			if( $linkedin_share == 'on' ) {

				$output .= '<li class="gt-linkedin">';
					$output .= '<a href="' . esc_url( 'https://www.linkedin.com/shareArticle?mini=true&amp;url=' . get_the_permalink() . '&title=' . urlencode( get_the_title() ) ) . '" target="_blank">';
						$output .= '<i class="fab fa-linkedin-in"></i>';
						$output .= '<span>' . esc_attr__( 'LinkedIn', 'eventchamp' ) . '</span>';
					$output .= '</a>';
				$output .= '</li>';

			}

			if( $whatsapp_share == 'on' ) {

				$output .= '<li class="gt-whatsapp">';
					$output .= '<a href="' . 'whatsapp://send?text=' . get_the_permalink() . '" target="_blank">';
						$output .= '<i class="fab fa-whatsapp"></i>';
						$output .= '<span>' . esc_attr__( 'WhatsApp', 'eventchamp' ) . '</span>';
					$output .= '</a>';
				$output .= '</li>';

			}

			if( $pinterest_share == 'on' ) {

				$output .= '<li class="gt-pinterest">';
					$output .= '<a href="' . esc_url( 'https://pinterest.com/pin/create/button/?url=' . get_the_permalink() . '&description=' . urlencode( get_the_title() ) ) . '" target="_blank">';
						$output .= '<i class="fab fa-pinterest-p"></i>';
						$output .= '<span>' . esc_attr__( 'Pinterest', 'eventchamp' ) . '</span>';
					$output .= '</a>';
				$output .= '</li>';

			}

			if( $reddit_share == 'on' ) {

				$output .= '<li class="gt-reddit">';
					$output .= '<a href="' . esc_url( 'https://reddit.com/submit?url=' . get_the_permalink() . '&title=' . urlencode( get_the_title() ) ) . '" target="_blank">';
						$output .= '<i class="fab fa-reddit-alien"></i>';
						$output .= '<span>' . esc_attr__( 'Reddit', 'eventchamp' ) . '</span>';
					$output .= '</a>';
				$output .= '</li>';

			}

			if( $delicious_share == 'on' ) {

				$output .= '<li class="gt-delicious">';
					$output .= '<a href="' . esc_url( 'https://del.icio.us/post?url=' . get_the_permalink() ) . '" target="_blank">';
						$output .= '<i class="fab fa-delicious"></i>';
						$output .= '<span>' . esc_attr__( 'Delicious', 'eventchamp' ) . '</span>';
					$output .= '</a>';
				$output .= '</li>';

			}

			if( $vk_share == 'on' ) {

				$output .= '<li class="gt-vk">';
					$output .= '<a href="' . esc_url( 'https://vk.com/share.php?url=' . get_the_permalink() ) . '" target="_blank">';
						$output .= '<i class="fab fa-vk"></i>';
						$output .= '<span>' . esc_attr__( 'VKontakte', 'eventchamp' ) . '</span>';
					$output .= '</a>';
				$output .= '</li>';

			}

			if( $tumblr_share == 'on' ) {

				$output .= '<li class="gt-tumblr">';
					$output .= '<a href="' . esc_url( 'https://www.tumblr.com/share/link?url=' . get_the_permalink() ) . '" target="_blank">';
						$output .= '<i class="fab fa-tumblr"></i>';
						$output .= '<span>' . esc_attr__( 'Tumblr', 'eventchamp' ) . '</span>';
					$output .= '</a>';
				$output .= '</li>';

			}

			if( $email_share == 'on' ) {

				$output .= '<li class="gt-email">';
					$output .= '<a href="' . esc_url( 'mailto:?body=' . get_the_permalink() . '&subject=' . urlencode( get_the_title() ) ) . '" target="_blank">';
						$output .= '<i class="far fa-envelope"></i>';
						$output .= '<span>' . esc_attr__( 'Email', 'eventchamp' ) . '</span>';
					$output .= '</a>';
				$output .= '</li>';

			}
			
			$output .= '</ul>';
		$output .= '</div>';

		return $output;

	}

}



/*======
*
* Social Media Sites for User
*
======*/
if( !function_exists( 'eventchamp_user_social_media_sites' ) ) {

	function eventchamp_user_social_media_sites( $user_id = "" ) {

		$output = "";
		$social = "";
		$user_facebook = get_the_author_meta( 'facebook', $user_id );
		$user_googleplus = get_the_author_meta( 'googleplus', $user_id );
		$user_instagram = get_the_author_meta( 'instagram', $user_id );
		$user_linkedin = get_the_author_meta( 'linkedin', $user_id );
		$user_vine = get_the_author_meta( 'vine', $user_id );
		$user_twitter = get_the_author_meta( 'twitter', $user_id );
		$user_pinterest = get_the_author_meta( 'pinterest', $user_id );
		$user_youtube = get_the_author_meta( 'youtube', $user_id );
		$user_behance = get_the_author_meta( 'behance', $user_id );
		$user_deviantart = get_the_author_meta( 'deviantart', $user_id );
		$user_digg = get_the_author_meta( 'digg', $user_id );
		$user_dribbble = get_the_author_meta( 'dribbble', $user_id );
		$user_flickr = get_the_author_meta( 'flickr', $user_id );
		$user_github = get_the_author_meta( 'github', $user_id );
		$user_lastfm = get_the_author_meta( 'lastfm', $user_id );
		$user_reddit = get_the_author_meta( 'reddit', $user_id );
		$user_soundcloud = get_the_author_meta( 'soundcloud', $user_id );
		$user_tumblr = get_the_author_meta( 'tumblr', $user_id );
		$user_vimeo = get_the_author_meta( 'vimeo', $user_id );
		$user_vk = get_the_author_meta( 'vk', $user_id );
		$user_medium = get_the_author_meta( 'medium', $user_id );

		if( !empty( $user_facebook ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_facebook ) . '" target="_blank">';
					$output .= '<i class="fab fa-facebook-f"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_googleplus ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_googleplus ) . '" target="_blank">';
					$output .= '<i class="fab fa-google-plus-g"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_instagram ) ) {
			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_instagram ) . '" target="_blank">';
					$output .= '<i class="fab fa-instagram"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_linkedin ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_linkedin ) . '" target="_blank">';
					$output .= '<i class="fab fa-linkedin-in"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_vine ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_vine ) . '" target="_blank">';
					$output .= '<i class="fab fa-vine"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_twitter ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_twitter ) . '" target="_blank">';
					$output .= '<i class="fab fa-twitter"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_pinterest ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_pinterest ) . '" target="_blank">';
					$output .= '<i class="fab fa-pinterest-p"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_youtube ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_youtube ) . '" target="_blank">';
					$output .= '<i class="fab fa-youtube"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_behance ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_behance ) . '" target="_blank">';
					$output .= '<i class="fab fa-behance"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_deviantart ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_behance ) . '" target="_blank">';
					$output .= '<i class="fab fa-deviantart"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_digg ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_digg ) . '" target="_blank">';
					$output .= '<i class="fab fa-digg"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_dribbble ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_dribbble ) . '" target="_blank">';
					$output .= '<i class="fab fa-dribbble"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_flickr ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_flickr ) . '" target="_blank">';
					$output .= '<i class="fab fa-flickr"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_github ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_github ) . '" target="_blank">';
					$output .= '<i class="fab fa-github"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_lastfm ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_lastfm ) . '" target="_blank">';
					$output .= '<i class="fab fa-lastfm"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_reddit ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_reddit ) . '" target="_blank">';
					$output .= '<i class="fab fa-reddit-alien"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_soundcloud ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_soundcloud ) . '" target="_blank">';
					$output .= '<i class="fab fa-soundcloud"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_tumblr ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_tumblr ) . '" target="_blank">';
					$output .= '<i class="fab fa-tumblr"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_vimeo ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_vimeo ) . '" target="_blank">';
					$output .= '<i class="fab fa-vimeo-v"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_vk ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_vk ) . '" target="_blank">';
					$output .= '<i class="fab fa-vk"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $user_medium ) ) {

			$output .= '<li>';
				$output .= '<a href="' . esc_url( $user_medium ) . '" target="_blank">';
					$output .= '<i class="fab fa-medium-m"></i>';
				$output .= '</a>';
			$output .= '</li>';

		}

		if( !empty( $output ) ) {

			$social = '<div class="gt-social">';
				$social .= '<ul>';
					$social .= $output;
				$social .= '</ul>';
			$social .= '</div>';

		}

		return $social;

	}

}



/*======
*
* Social Media Sites Array
*
======*/
if( !function_exists( 'eventchamp_social_media_sites_array' ) ) {

	function eventchamp_social_media_sites_array() {

	$sites = array(
		array(
			'label' => esc_html__( '500px', 'eventchamp' ),
			'value' => '500px',
		),
		array(
			'label' => esc_html__( 'Airbnb', 'eventchamp' ),
			'value' => 'airbnb',
		),
		array(
			'label' => esc_html__( 'Amazon', 'eventchamp' ),
			'value' => 'amazon',
		),
		array(
			'label' => esc_html__( 'App Store', 'eventchamp' ),
			'value' => 'app-store',
		),
		array(
			'label' => esc_html__( 'Apple', 'eventchamp' ),
			'value' => 'apple',
		),
		array(
			'label' => esc_html__( 'ArtStation', 'eventchamp' ),
			'value' => 'artstation',
		),
		array(
			'label' => esc_html__( 'Bandcamp', 'eventchamp' ),
			'value' => 'bandcamp',
		),
		array(
			'label' => esc_html__( 'Battle.net', 'eventchamp' ),
			'value' => 'battle-net',
		),
		array(
			'label' => esc_html__( 'Behance', 'eventchamp' ),
			'value' => 'behance',
		),
		array(
			'label' => esc_html__( 'Blogger', 'eventchamp' ),
			'value' => 'blogger',
		),
		array(
			'label' => esc_html__( 'CodePen', 'eventchamp' ),
			'value' => 'codepen',
		),
		array(
			'label' => esc_html__( 'Dailymotion', 'eventchamp' ),
			'value' => 'dailymotion',
		),
		array(
			'label' => esc_html__( 'Delicious', 'eventchamp' ),
			'value' => 'delicious',
		),
		array(
			'label' => esc_html__( 'DeviantArt', 'eventchamp' ),
			'value' => 'deviantart',
		),
		array(
			'label' => esc_html__( 'Digg', 'eventchamp' ),
			'value' => 'digg',
		),
		array(
			'label' => esc_html__( 'Discord', 'eventchamp' ),
			'value' => 'discord',
		),
		array(
			'label' => esc_html__( 'Dribbble', 'eventchamp' ),
			'value' => 'dribbble',
		),
		array(
			'label' => esc_html__( 'Dropbox', 'eventchamp' ),
			'value' => 'dropbox',
		),
		array(
			'label' => esc_html__( 'eBay', 'eventchamp' ),
			'value' => 'ebay',
		),
		array(
			'label' => esc_html__( 'Etsy', 'eventchamp' ),
			'value' => 'etsy',
		),
		array(
			'label' => esc_html__( 'Facebook', 'eventchamp' ),
			'value' => 'facebook',
		),
		array(
			'label' => esc_html__( 'Facebook Messenger', 'eventchamp' ),
			'value' => 'facebook-messenger',
		),
		array(
			'label' => esc_html__( 'Flickr', 'eventchamp' ),
			'value' => 'flickr',
		),
		array(
			'label' => esc_html__( 'Foursquare', 'eventchamp' ),
			'value' => 'foursquare',
		),
		array(
			'label' => esc_html__( 'GitHub', 'eventchamp' ),
			'value' => 'github',
		),
		array(
			'label' => esc_html__( 'Goodreads', 'eventchamp' ),
			'value' => 'goodreads',
		),
		array(
			'label' => esc_html__( 'Google', 'eventchamp' ),
			'value' => 'google',
		),
		array(
			'label' => esc_html__( 'Google Drive', 'eventchamp' ),
			'value' => 'google-drive',
		),
		array(
			'label' => esc_html__( 'Google Play', 'eventchamp' ),
			'value' => 'google-play',
		),
		array(
			'label' => esc_html__( 'IMDb', 'eventchamp' ),
			'value' => 'imdb',
		),
		array(
			'label' => esc_html__( 'Instagram', 'eventchamp' ),
			'value' => 'instagram',
		),
		array(
			'label' => esc_html__( 'iTunes', 'eventchamp' ),
			'value' => 'itunes',
		),
		array(
			'label' => esc_html__( 'JSFiddle', 'eventchamp' ),
			'value' => 'jsfiddle',
		),
		array(
			'label' => esc_html__( 'Kickstarter', 'eventchamp' ),
			'value' => 'kickstarter',
		),
		array(
			'label' => esc_html__( 'Last.fm', 'eventchamp' ),
			'value' => 'lastfm',
		),
		array(
			'label' => esc_html__( 'Line', 'eventchamp' ),
			'value' => 'line',
		),
		array(
			'label' => esc_html__( 'LinkedIn', 'eventchamp' ),
			'value' => 'linkedin',
		),
		array(
			'label' => esc_html__( 'Medium', 'eventchamp' ),
			'value' => 'medium',
		),
		array(
			'label' => esc_html__( 'Meetup', 'eventchamp' ),
			'value' => 'meetup',
		),
		array(
			'label' => esc_html__( 'Microsoft', 'eventchamp' ),
			'value' => 'microsoft',
		),
		array(
			'label' => esc_html__( 'Odnoklassniki', 'eventchamp' ),
			'value' => 'odnoklassniki',
		),
		array(
			'label' => esc_html__( 'Patreon', 'eventchamp' ),
			'value' => 'patreon',
		),
		array(
			'label' => esc_html__( 'PayPal', 'eventchamp' ),
			'value' => 'paypal',
		),
		array(
			'label' => esc_html__( 'Periscope', 'eventchamp' ),
			'value' => 'periscope',
		),
		array(
			'label' => esc_html__( 'Pinterest', 'eventchamp' ),
			'value' => 'pinterest',
		),
		array(
			'label' => esc_html__( 'PlayStation', 'eventchamp' ),
			'value' => 'playstation',
		),
		array(
			'label' => esc_html__( 'Product Hunt', 'eventchamp' ),
			'value' => 'product-hunt',
		),
		array(
			'label' => esc_html__( 'Quora', 'eventchamp' ),
			'value' => 'quora',
		),
		array(
			'label' => esc_html__( 'ReadMe', 'eventchamp' ),
			'value' => 'readme',
		),
		array(
			'label' => esc_html__( 'Reddit', 'eventchamp' ),
			'value' => 'reddit',
		),
		array(
			'label' => esc_html__( 'RSS', 'eventchamp' ),
			'value' => 'rss',
		),
		array(
			'label' => esc_html__( 'Scribd', 'eventchamp' ),
			'value' => 'scribd',
		),
		array(
			'label' => esc_html__( 'Shopify', 'eventchamp' ),
			'value' => 'shopify',
		),
		array(
			'label' => esc_html__( 'Skype', 'eventchamp' ),
			'value' => 'skype',
		),
		array(
			'label' => esc_html__( 'Slack', 'eventchamp' ),
			'value' => 'slack',
		),
		array(
			'label' => esc_html__( 'Snapchat', 'eventchamp' ),
			'value' => 'snapchat',
		),
		array(
			'label' => esc_html__( 'SoundCloud', 'eventchamp' ),
			'value' => 'soundcloud',
		),
		array(
			'label' => esc_html__( 'Spotify', 'eventchamp' ),
			'value' => 'spotify',
		),
		array(
			'label' => esc_html__( 'Steam', 'eventchamp' ),
			'value' => 'steam',
		),
		array(
			'label' => esc_html__( 'StumbleUpon', 'eventchamp' ),
			'value' => 'stumbleupon',
		),
		array(
			'label' => esc_html__( 'TeamSpeak', 'eventchamp' ),
			'value' => 'teamspeak',
		),
		array(
			'label' => esc_html__( 'Telegram', 'eventchamp' ),
			'value' => 'telegram',
		),
		array(
			'label' => esc_html__( 'TripAdvisor', 'eventchamp' ),
			'value' => 'tripadvisor',
		),
		array(
			'label' => esc_html__( 'Tumblr', 'eventchamp' ),
			'value' => 'tumblr',
		),
		array(
			'label' => esc_html__( 'Twitch', 'eventchamp' ),
			'value' => 'twitch',
		),
		array(
			'label' => esc_html__( 'Twitter', 'eventchamp' ),
			'value' => 'twitter',
		),
		array(
			'label' => esc_html__( 'Vimeo', 'eventchamp' ),
			'value' => 'vimeo',
		),
		array(
			'label' => esc_html__( 'VK', 'eventchamp' ),
			'value' => 'vk',
		),
		array(
			'label' => esc_html__( 'WhatsApp', 'eventchamp' ),
			'value' => 'whatsapp',
		),
		array(
			'label' => esc_html__( 'Wikipedia', 'eventchamp' ),
			'value' => 'wikipedia',
		),
		array(
			'label' => esc_html__( 'WordPress', 'eventchamp' ),
			'value' => 'wordpress',
		),
		array(
			'label' => esc_html__( 'Xbox', 'eventchamp' ),
			'value' => 'xbox',
		),
		array(
			'label' => esc_html__( 'Xing', 'eventchamp' ),
			'value' => 'xing',
		),
		array(
			'label' => esc_html__( 'Yahoo', 'eventchamp' ),
			'value' => 'yahoo',
		),
		array(
			'label' => esc_html__( 'Yandex', 'eventchamp' ),
			'value' => 'yandex',
		),
		array(
			'label' => esc_html__( 'Yelp', 'eventchamp' ),
			'value' => 'yelp',
		),
		array(
			'label' => esc_html__( 'YouTube', 'eventchamp' ),
			'value' => 'youtube',
		),
		array(
			'label' => esc_html__( 'Link 1', 'eventchamp' ),
			'value' => 'link-1',
		),
		array(
			'label' => esc_html__( 'Link 2', 'eventchamp' ),
			'value' => 'link-2',
		),
		array(
			'label' => esc_html__( 'Link 3', 'eventchamp' ),
			'value' => 'link-3',
		),
		array(
			'label' => esc_html__( 'Email', 'eventchamp' ),
			'value' => 'email',
		),
	);

	return $sites;

	}

}
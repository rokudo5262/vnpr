<?php
/*======
*
* Font List for Theme Options
*
======*/
$eventchamp_font_list = array();

if( !function_exists( 'eventchamp_google_webfont' ) ) {

	function eventchamp_google_webfont() {

		global $eventchamp_font_list;

		$options = array( 
			array( 
				'option' => "theme_main_font", 
				'default' => "Poppins"
			),
			array( 
				'option' => "body_text", 
				'default' => ""
			),
			array( 
				'option' => "h1_font", 
				'default' => ""
			),
			array( 
				'option' => "h2_font", 
				'default' => ""
			),
			array( 
				'option' => "h3_font", 
				'default' => ""
			),
			array( 
				'option' => "h4_font", 
				'default' => ""
			),
			array( 
				'option' => "h5_font", 
				'default' => ""
			),
			array( 
				'option' => "h6_font", 
				'default' => ""
			),
			array( 
				'option' => "input_font", 
				'default' => ""
			),
			array( 
				'option' => "input_placeholder_font", 
				'default' => ""
			),
			array( 
				'option' => "button_font", 
				'default' => ""
			),
			array( 
				'option' => "header_default_menu_font", 
				'default' => ""
			),
			array( 
				'option' => "header_default_submenu_font", 
				'default' => ""
			),
			array( 
				'option' => "header_classic_menu_font", 
				'default' => ""
			),
			array( 
				'option' => "header_classic_submenu_font", 
				'default' => ""
			),
			array( 
				'option' => "post_posts_title_font", 
				'default' => ""
			),
			array( 
				'option' => "post_posts_content_font", 
				'default' => ""
			),
			array( 
				'option' => "post_posts_bottom_element_title_font", 
				'default' => ""
			),
			array( 
				'option' => "page_title_font", 
				'default' => ""
			),
			array( 
				'option' => "page_content_font", 
				'default' => ""
			),
			array( 
				'option' => "404_page_title", 
				'default' => ""
			),
			array( 
				'option' => "404_page_text", 
				'default' => ""
			),
			array( 
				'option' => "404_page_icon", 
				'default' => ""
			),
		);
		
		$import = '';	
		
		$language = 'latin,latin-ext';
		$font_language = ot_get_option('fonts_languages');

		if ( 'cyrillic' == $font_language ) {

			$language .= ',cyrillic,cyrillic-ext';

		} elseif ( 'greek' == $font_language ) {

			$language .= ',greek,greek-ext';

		} elseif ( 'vietnamese' == $font_language ) {

			$language .= ',vietnamese';

		}
				
		$url_check = is_ssl() ? 'https' : 'http';

		foreach( $options as $option ) {

			$array = ot_get_option($option['option']);
			
			if ( !empty( $array['font-family'] ) ) { 

				if ( !in_array( $array['font-family'], $eventchamp_font_list ) ) {

					array_push( $eventchamp_font_list, $array['font-family'] );

				}

			} elseif( $option['default'] ) {

				if ( !in_array( $option['default'], $eventchamp_font_list ) ) {

					array_push( $eventchamp_font_list, $option['default'] );

				}

			}

		}
		
		$fonts_list_unique = array_unique($eventchamp_font_list);
			
		foreach( $fonts_list_unique as $fonts ) {

			$cssfont = str_replace(' ', '+', $fonts);
			$query_args = array(
				'family' => $cssfont.':200,300,400,400i,500,600,700,700i',
				'subset' => $language,
			);
			$font_url = add_query_arg( $query_args, "$url_check://fonts.googleapis.com/css" );
			$import .= "<link href='".$font_url."' rel='stylesheet' type='text/css'>\n";

		}

		return $import;

	}

}



if( !function_exists( 'eventchamp_font_dropdown' ) ) {

	function eventchamp_font_dropdown( $array, $field_id ) {

		if ( $field_id == "theme_one_font" ) {

			$array = array( 'font-family');

		}
		
		if ( $field_id == "theme_two_font" ) {

			$array = array( 'font-family');

		}
		
		return $array;

	}
	add_filter( 'ot_recognized_typography_fields', 'eventchamp_font_dropdown', 10, 2 );

}



/*======
*
* Fonts for Theme Options
*
======*/
if( !class_exists( 'eventchamp_font_settings' ) ) {

	class eventchamp_font_settings {

		public $ot_typography_id;
		public $eventchamp_css_output = array();
		public $eventchamp_font_output = array();
		public $id_array = array();
		private $css_echo = array(
				'font-color' => 'color', 
				'font-family' => 'font-family', 
				'font-size' => 'font-size', 
				'font-style' => 'font-style',
				'font-variant'	=> 'font-variant',
				'font-weight' => 'font-weight',
				'letter-spacing' => 'letter-spacing',
				'line-height' => 'line-height',
				'text-decoration' => 'text-decoration',
				'text-transform' => 'text-transform'
		);



		/*====== Font List from Json ======*/
		public function eventchamp_font_google_api() {

			ob_start();

			require get_template_directory() . '/include/assets/json/webfonts.json';

			$fonts_list = ob_get_clean();
			$fonts_list = json_decode( $fonts_list, true );

			if ( ! is_array( $fonts_list ) ) {

				$fonts_list = array();

			}

			$fonts = $fonts_list;

			$font_list_arrray = array();

			foreach ( $fonts['items'] as $key => $value) {

				$font_list_arrray[$value['family']] = $value['family'];

			}

			return $font_list_arrray;

		}



		/*====== Font Echo ======*/
		public function eventchamp_font_settings_echo( $ot_typography_id = "", $selector = "", $default_font = 'Arial' ) {

			$ot_typography_name = ot_get_option( $ot_typography_id );

			if ( !empty( $ot_typography_id ) and !empty( $selector ) ) {

				if ( !empty( $ot_typography_name ) ) {

					$css = '';

					foreach ( $ot_typography_name as $key => $value ) {

						if ( $this->css_echo[$key] == 'font-family' && $value == '' ) {

							$value = $default_font;

						}

						if ( $this->css_echo[$key] == 'font-family' ) {

							$this->eventchamp_font_output[] = $value;

						}

						if ( !empty( $ot_typography_name[$key] ) and !empty( $value ) ) {

							$css .= $this->css_echo[$key] . ':' . $value . ';';

						}

						if ( empty( $ot_typography_name['font-family'] ) ) {

							if ( $this->css_echo[$key] == 'font-family' and !empty( $default_font ) ) {

								$css .= 'font-family:' . $default_font . ';';

							}

						}

					}

					if( !empty( $css ) ) {

						$this->eventchamp_css_output[$ot_typography_id] = $selector. "{" . $css . "}";

					}

				} else{

					if( !empty( $default_font ) ) {

						$this->eventchamp_css_output[$ot_typography_id] = 'font-family:' . $default_font . ';';
						$this->eventchamp_css_output[$ot_typography_id] = $selector . "{" . 'font-family:' . $default_font . ';' . "}";
						$this->eventchamp_font_output[] = $default_font;

					}

				}

			}

			$font_echo = $this->eventchamp_font_output;

		}



		/*====== CSS Output ======*/
		public function eventchamp_css_output(){

			$output = '';

			foreach ( $this->eventchamp_css_output as $value ) {

				$output .= $value."\n";

			}

			return $output;

		}



		/*====== CSS Echo ======*/
		public function eventchamp_css_echo( $setting_id = "", $selector = "", $where = "", $default = "" ) {

			$css = '';
			$id_control = ot_get_option( $setting_id );

			if( !empty( $setting_id ) ) {

				//Background Fully
				if ( $where == 'background-all' ) {

					if ( !empty( $id_control ) ) {

						$setting_id = ot_get_option( $setting_id, array() );

						if( $setting_id['background-color'] | $setting_id['background-repeat'] | $setting_id['background-attachment'] | $setting_id['background-position'] | $setting_id['background-image'] ) {

							if( !empty( $setting_id['background-color'] ) ) {

								$css .= $selector;
								$css .= "{background-color: " . esc_attr( $setting_id['background-color'] ) . ";}";

							}

							if( !empty( $setting_id['background-repeat'] ) ) {

								$css .= $selector;
								$css .= "{background-repeat: " . esc_attr( $setting_id['background-repeat'] ) . ";}";

							}

							if( !empty( $setting_id['background-attachment'] ) ) {

								$css .= $selector;
								$css .= "{background-attachment: " . esc_attr( $setting_id['background-attachment'] ) . ";}";

							}

							if( !empty( $setting_id['background-position'] ) ) {

								$css .= $selector;
								$css .= "{background-position: " . esc_attr( $setting_id['background-position'] ) . ";}";

							}

							if( !empty( $setting_id['background-image'] ) ) {
								$css .= $selector;
								$css .= "{background-image: url(" . esc_url( $setting_id['background-image'] ) . ");}";
							}

							if( !empty( $setting_id['background-size'] ) ) {
								$css .= $selector;
								$css .= "{background-size: " . esc_attr( $setting_id['background-size'] ) . ";}";
							}

						}

					}

				} elseif ( $where == 'background' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{background:' . ot_get_option( $setting_id ) . ';}';

					}

				} elseif ( $where == 'background-color' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{background-color:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'background-image' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{background-image:url(' . esc_url( ot_get_option( $setting_id ) ) . ');}';

					}

				} elseif ( $where == 'border-color' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{border-color:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'border-top-color' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{border-top-color:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'border-bottom-color' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{border-bottom-color:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'color' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{color:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'fill' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{fill:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'stroke' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{stroke:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'max-height' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{max-height:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'margin' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{margin:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'top-margin' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{margin-top:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'bottom-margin' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{margin-bottom:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'left-margin' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{margin-left:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'right-margin' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{margin-right:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'padding' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{padding:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'top-padding' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{padding-top:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'bottom-padding' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{padding-bottom:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'left-padding' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{padding-left:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'right-padding' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{padding-right:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'opacity' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{opacity:' . esc_attr( ot_get_option( $setting_id ) ) . ';}';

					}

				} elseif ( $where == 'gradient' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= '{' . ot_get_option( $setting_id ) . '}';

					}

				} elseif ( $where == 'css-codes' ) {

					if ( !empty( $id_control ) ) {

						$css .= $selector;
						$css .= ot_get_option( $setting_id );

					}

				}

			}

			return $css;

		}



		/*====== Font Output ======*/
		public function eventchamp_font_output() {

			$ot_font_subset_latin = ot_get_option ('font_subsets_latin');
			$font_subsets_cyrillic = ot_get_option ('font_subsets_cyrillic');
			$font_subsets_greek = ot_get_option ('font_subsets_greek');

			if( $ot_font_subset_latin == 'on' && $font_subsets_cyrillic == 'on' && $font_subsets_greek == 'on' ) {

				$ot_font_subset_echo = 'cyrillic,cyrillic-ext,greek,greek-ext,latin-ext';

			} elseif( $ot_font_subset_latin == 'on' && $font_subsets_cyrillic == 'on' ) {

				$ot_font_subset_echo = 'cyrillic,cyrillic-ext,latin-ext';

			} elseif( $font_subsets_greek == 'on' && $font_subsets_cyrillic == 'on' ) {

				$ot_font_subset_echo = 'cyrillic,cyrillic-ext,greek,greek-ext';

			} elseif( $ot_font_subset_latin == 'on' && $font_subsets_greek == 'on' ) {

				$ot_font_subset_echo = 'greek,greek-ext,latin-ext';

			} elseif( $ot_font_subset_latin == 'on' ) {

				$ot_font_subset_echo = 'latin-ext';

			} elseif( $font_subsets_cyrillic == 'on' ) {

				$ot_font_subset_echo = 'cyrillic,cyrillic-ext';

			} elseif( $font_subsets_greek == 'on' ) {

				$ot_font_subset_echo = 'greek,greek-ext';

			} else {

				$ot_font_subset_echo = 'cyrillic,cyrillic-ext,greek,greek-ext,latin-ext';

			}

			if ( is_ssl() ) {

				$ssl_control = 'https';

			} else {

				$ssl_control = 'http';

			}

			$fonts_url = '';
			$font_uniq = array_unique( $this->eventchamp_font_output );

			if( !empty( $font_uniq ) ) {

				foreach ( $font_uniq as $value ) {

					if( !empty( $value ) ) {

						$font_name = str_replace(' ', '+', $value);
						$fonts_url .= "<link href='$ssl_control://fonts.googleapis.com/css?family=" . $font_name . ":200,300,400,500,600,700&subset=" . $ot_font_subset_echo . "' rel='stylesheet' type='text/css'>\n";

					}

				}

			}

			echo $fonts_url;
		}



	}
	add_filter( 'ot_recognized_font_families', array( 'eventchamp_font_settings', 'eventchamp_font_google_api' ) );

}



/*======
*
* Typography for Theme Options
*
======*/
if( !function_exists( 'eventchamp_type_echo' ) ) {

	function eventchamp_type_echo( $array_value, $important = false, $default = false ) {

		global $eventchamp_font_list;
		
		if( !empty( $array_value ) ) {

			//Font Family Array
			if ( !empty( $array_value['font-family'] ) ) {

				echo "font-family: '" . esc_attr( $array_value['font-family'] ) . "';\n";

			} elseif( $default ) {

				echo "font-family: '" . esc_attr( $default ) . "';\n";

			}

			//Font Color Array
			if ( !empty( $array_value['font-color'] ) ) {

				echo "color: " . esc_attr( $array_value['font-color'] ) . ";\n";

			}

			//Font Style Array
			if ( !empty( $array_value['font-style'] ) ) {

				echo "font-style: " . esc_attr( $array_value['font-style'] ) . ";\n";

			}

			//Font Variant Array
			if ( !empty( $array_value['font-variant'] ) ) {

				echo "font-variant: " . esc_attr( $array_value['font-variant'] ) . ";\n";

			}

			//Font Weight Array
			if ( !empty( $array_value['font-weight'] ) ) {

				echo "font-weight: " . esc_attr( $array_value['font-weight'] ) . ";\n";

			}

			//Font Size Array
			if ( !empty( $array_value['font-size'] ) ) {
				
				if ( $important ) {

					echo "font-size: " . esc_attr( $array_value['font-size'] ) . "!important;\n";

				} else {

					echo "font-size: " . esc_attr( $array_value['font-size'] ) . "!important;\n";

				}

			}

			//Font Decoration Array
			if ( !empty( $array_value['text-decoration'] ) ) {

				echo "text-decoration: " . esc_attr( $array_value['text-decoration'] ) . " !important;\n";

			}

			//Font Transform Array
			if ( !empty( $array_value['text-transform'] ) ) {

				echo "text-transform: " . esc_attr( $array_value['text-transform'] ) . " !important;\n";

			}

			//Font Height Array
			if ( !empty( $array_value['line-height'] ) ) {

				echo "line-height: " . esc_attr( $array_value['line-height'] ) . " !important;\n";

			}

			//Font Spacing Array
			if ( !empty( $array_value['letter-spacing'] ) ) {

				echo "letter-spacing: " . esc_attr( $array_value['letter-spacing'] ) . " !important;\n";

			}

		}

		if( empty( $array_value ) && !empty( $default ) ) {

			echo "font-family: '" . esc_attr( $default ) . "';\n";

		}

	}

}


/*======
*
* Theme Company for Theme Options
*
======*/
if( !function_exists( 'eventchamp_upload_name' ) ) {

	function eventchamp_upload_name() {

		return esc_html__( 'Send to Theme Options', 'eventchamp' );

	}
	add_filter( 'ot_upload_text', 'eventchamp_upload_name', 10, 2 );

}



/*======
*
* Adding Theme Options from Menu
*
======*/
add_filter( 'ot_theme_options_parent_slug', '__return_false' );



/*======
*
* Adding Theme Options from Menu
*
======*/
if( !function_exists( 'eventchamp_theme_options_logo' ) ) {

	function eventchamp_theme_options_logo() {

		$theme_version = wp_get_theme();

		echo '<li id="option-tree-logo">';
			echo '<span class="theme-name">';
				echo '<strong>' . esc_attr( $theme_version->get( 'Name' ) ) . '</strong>';
			echo '</span>';
			echo '<span> ' . esc_attr( $theme_version->get( 'Version' ) ) . '</span>';
		echo '</li>';

	}
	add_filter( 'ot_header_logo_link', 'eventchamp_theme_options_logo' );

}



/*======
*
* Theme Company for Theme Options
*
======*/
if( !function_exists( 'eventchamp_options_name' ) ) {

	function eventchamp_options_name() {

		$html = '<a href="' . esc_url( 'https://support.gloriathemes.com/' ) . '" target="_blank">' . esc_html__( 'Support & Documentation', 'eventchamp' ) . '</a>';

		return $html;

	}
	add_filter( 'ot_header_version_text', 'eventchamp_options_name', 10, 2 );

}



/*======
*
* Sidebar Creation for Theme Options
*
======*/
if( !function_exists( 'eventchamp_sidebar_creation' ) ) {

	function eventchamp_sidebar_creation() {

		$sidebars = ot_get_option( 'custom_sidebars' );

		if( !empty( $sidebars ) ) {

			foreach( $sidebars as $sidebar ) {

				if( !empty( $sidebar ) ) {

					register_sidebar(
						array(
							'id' => 'sidebar-' . esc_attr( $sidebar['id'] ),
							'name' => esc_attr( $sidebar['title'] ),
							'before_widget' => '<div id="%1$s" class="gt-widget %2$s">',
							'after_widget' => '</div>',
							'before_title' => '<div class="gt-widget-title">',
							'after_title' => '</div>',
						)
					);

				}

			}

		}

	}
	add_action( 'after_setup_theme', 'eventchamp_sidebar_creation' );

}



if ( !function_exists( 'ot_type_sidebar_select_category' ) ) {

	function ot_type_sidebar_select_category( $args = array() ) {

		extract( $args );

		$has_desc = $field_desc ? true : false;
		$args = array(
			'type' => 'post',
			'child_of' => 0,
			'parent' => '',
			'orderby' => 'name',
			'order' => 'ASC',
			'hide_empty' => 0,
			'hierarchical' => 0,
			'taxonomy' => 'category',
			'pad_counts' => false
		);
		$categories = get_terms( 'category', array( 'hide_empty' => false ) );

		if( !empty( $categories ) ) {

			foreach ( $categories as $category ) {

				if( !empty( $categories ) ) {

					$field_id = 'sidebar_select_' . esc_attr( $category->term_id );
					$field_name = 'option_tree[sidebar_select_' . esc_attr( $category->term_id ) .']';
					$field_value = ot_get_option( $field_id );

					echo '<div class="format-setting type-sidebar-select has-desc">';
						echo '<div class="description">' . esc_html__( 'You can a select sidebar for the', 'eventchamp' ) . ' "' . esc_attr( $category->name ) . '."</div>';
						echo '<div class="format-setting-inner">';
							echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';
								$sidebars = $GLOBALS['wp_registered_sidebars'];

								if ( !empty( $sidebars ) ) {

									echo '<option value="">-- ' . esc_html__( 'Choose One', 'eventchamp' ) . ' --</option>';
									foreach ( $sidebars as $sidebar ) {

										if ( !empty( $sidebar ) ) {

											echo '<option value="' . esc_attr( $sidebar['id'] ) . '"' . selected( $field_value, $sidebar['id'], false ) . '>' . esc_attr( $sidebar['name'] ) . '</option>';

										}

									}

								} else {

									echo '<option value="">' . esc_html__( 'No Sidebars Found', 'eventchamp' ) . '</option>';

								}
							echo '</select>';
						echo '</div>';
					echo '</div>';

				}

			}

		}

	}

}



/*======
*
* Image Selector for Radio Button
*
======*/
if ( !function_exists( 'eventchamp_radio_image_selector' ) ) {

	function eventchamp_radio_image_selector( $array, $field_id ) {

		if ( $field_id == 'sidebar_position' or $field_id == 'post_sidebar_position' or $field_id == 'woocommerce_sidebar_position' or $field_id == 'woocommerce_product_sidebar_position' or $field_id == 'attachment_sidebar_position' or $field_id == 'category_sidebar_position' or $field_id == 'search_sidebar_position' or $field_id == 'archive_sidebar_position' or $field_id == 'author_sidebar_position' or $field_id == 'tag_sidebar_position' or $field_id == 'page_sidebar_position' or $field_id == 'layout_select_meta_box_text' or $field_id == 'event_sidebar_position' or $field_id == 'venue_sidebar_position' or $field_id == 'speaker_sidebar_position' ) {

			$array = array(
				array(
					'value' => 'nosidebar',
					'label' => esc_html__( 'No Sidebar', 'eventchamp' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/none-sidebar.jpg',
				),
				array(
					'value' => 'left',
					'label' => esc_html__( 'Left Sidebar', 'eventchamp' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/left-sidebar.jpg',
				),
				array(
					'value' => 'right',
					'label' => esc_html__( 'Right Sidebar', 'eventchamp' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/right-sidebar.jpg',
				)
			);

		}

		if ( $field_id == 'blog_category_post_list_style' or $field_id == 'tag_tag_post_list_style' or $field_id == 'author_author_post_list_style' or $field_id == 'search_search_post_list_style' or $field_id == 'archive_archive_post_list_style' ) {

			$array = array(
				array(
					'value' => 'style1',
					'label' => esc_html__( 'Style 1', 'eventchamp' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/post-style1.jpg',
				),
				array(
					'value' => 'style2',
					'label' => esc_html__( 'Style 2', 'eventchamp' ),
					'src' => get_template_directory_uri() . '/include/assets/img/admin/post-style2.jpg',
				)
			);

		}
		
		return $array;

	}
	add_filter( 'ot_radio_images', 'eventchamp_radio_image_selector', 10, 2 );

}



/*======
*
* Get Post Types for Theme Settings
*
======*/
if( !function_exists( 'eventchamp_get_post_types_settings' ) ) {

	function eventchamp_get_post_types_settings() {

		$post_types = get_post_types();
		$array = array();

		if( !empty( $post_types ) ) {

			foreach( $post_types as $type ) {

				if( !empty( $type ) ) {

					$array[] = array( "value" => $type, "label" => ucfirst( $type ) );


				}

			}

		}

		return $array;

	}

}
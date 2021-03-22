<?php
/**
 * @version    $Id$
 * @package   ZuFusion Core
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Zufusion\Core\Classes;

class Form {

	/**
	 * Render a field type
	 *
	 * @param        $type
	 * @param string $label
	 * @param string $name
	 * @param string $value
	 * @param array $options
	 * @param string $id
	 * @param string $class
	 * @param string $label_class
	 * @param string $desc
	 * @param string $before_html
	 * @param string $after_html
	 * @param string $wrapper_class
	 */
	function get_field( $args = array() ) {
		global $themes_allowedtags;

		extract( wp_parse_args( $args, array(
			'type'              => 'text',
			'label'             => '',
			'name'              => '',
			'value'             => '',
			'options'           => array(),
			'taxonomy_args'     => array(),
			'editor_args'       => array(),
			'id'                => '',
			'class'             => '',
			'label_class'       => '',
			'label_attr'        => '',
			'desc'              => '',
			'extra_attr'        => '',
			'no_display'        => 'no',
			'before_html'       => '',
			'after_html'        => '',
			'wrapper'           => 'yes',
			'wrapper_class'     => '',
			'wrapper_attr'      => '',
			'before_html_field' => '',
			'after_html_field'  => '',
		) ) );
		if ( $no_display != 'no' ) {
			return;
		}

		$label_class = 'field-label ' . $label_class;
		if ( is_array( $value ) ) {
			$value = array_map( 'trim', $value );
		}

		$id            = str_replace( '[', '_', $id );
		$id            = str_replace( ']', '', $id );
		$form_field_id = $name;
		?>
		<?php if ( $wrapper == 'yes' ) {
			$form_field_id = str_replace( '[', '', $form_field_id );
			$form_field_id = str_replace( ']', '', $form_field_id );
			?>

            <div id="forms_field_<?php echo esc_attr( $form_field_id ); ?>" class="form-field-wrapper field-<?php echo esc_attr( $type ); ?> <?php echo esc_attr( $wrapper_class ); ?>" <?php echo wp_kses_normalize_entities( $wrapper_attr) ; ?>>
		<?php } ?>
		<?php
		if ( $type !== 'desc' && $label !== '' ) {
			?>
            <label for="<?php echo esc_attr( $id ); ?>" id="<?php echo esc_attr( $id ) ; ?>_label"
                   class="<?php echo esc_attr( trim( $label_class ) ); ?>" <?php echo esc_attr( $label_attr ); ?>><?php echo esc_attr( $label) ; ?>
                : </label>
			<?php
		}
		if ( $before_html !== '' ) {
			echo esc_html( $before_html );
		}

		if ( $before_html_field !== '' ) {
			echo esc_html( $before_html_field );
		}

		switch ( $type ) {
			case 'text':
				?>
                <input type="text" class="<?php echo esc_attr( $class ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $id ); ?>"
                       value="<?php echo esc_attr( $value ); ?>" <?php echo wp_kses_normalize_entities( $extra_attr ); ?>/>
				<?php
				break;
			case 'number':
				?>
                <input type="number" class="<?php echo esc_attr( $class ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $id ); ?>"
                       value="<?php echo esc_attr( $value ); ?>" <?php echo wp_kses_normalize_entities( $extra_attr ); ?>/>
				<?php
				break;
			case 'email':
				?>
                <input type="email" class="<?php echo esc_attr( $class ); ?>" name="<?php echo esc_attr( $name ); ?>" id="<?php echo esc_attr( $id ); ?>"
                       value="<?php echo esc_attr( $value ); ?>" <?php echo wp_kses_normalize_entities( $extra_attr ); ?>/>
				<?php
				break;
			case 'checkbox':

				if ( is_array( $options ) && ! empty( $options ) ) {
					foreach ( $options as $key => $text ) {
						echo zufusion_checkbox_field_html( $key, $text, $value, $name, $class, $extra_attr );
					}
				}

				break;

			case 'radio':

				if ( is_array( $options ) && ! empty( $options ) ) {
					foreach ( $options as $key => $text ) {
						echo zufusion_radio_field_html( $key, $text, $value, $name, $class );
					}
				}

				break;
			case 'select':
				?>
                <select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>"
                        class="<?php echo esc_attr( $class ); ?>" <?php echo wp_kses_normalize_entities( $extra_attr ); ?>>
					<?php
					if ( is_array( $options ) && ! empty( $options ) ) {
						foreach ( $options as $key => $text ) {
							if ( is_array( $text ) && ! empty( $key ) ) { ?>
                                <optgroup label="<?php echo esc_attr( $key ); ?>">
									<?php
									foreach ( $text as $key2 => $text2 ) { ?>
										<?php
										$selected = selected( $key2, $value, false );
										?>
                                        <option value="<?php echo esc_attr( $key2 ); ?>" <?php echo esc_attr( $selected ); ?>><?php echo esc_html( trim( $text2 ) ); ?></option>
										<?php
										?>
									<?php } ?>
                                </optgroup>
								<?php
							} else {
								$selected = selected( $key, $value, false );
								?>
                                <option value="<?php echo esc_attr( $key ); ?>" <?php echo esc_attr( $selected ); ?>><?php echo esc_html( trim( $text ) ); ?></option>
								<?php
							}
						}
					}
					?>
                </select>
				<?php
				break;

			case 'taxonomy_checkbox':

				$field_args = array(
					'name'       => $name,
					'id'         => $id,
					'class'      => $class,
					'selected'   => $value,
					'extra_attr' => $extra_attr,
				);

				if ( isset( $taxonomy_args['set_all'] ) ) {
					$value_all = $taxonomy_args['set_all'];
					echo zufusion_checkbox_field_html( $value_all, $taxonomy_args[ $value_all ], $field_args['selected'], $field_args['name'], $field_args['class'], $field_args['extra_attr'] );
				}

				echo zufusion_taxonomy_field_html( $taxonomy_args, $field_args, 'checkbox', $taxonomy_args['term_type'] );

				break;
			case 'taxonomy_radio':

				$field_args = array(
					'name'       => $name,
					'id'         => $id,
					'class'      => $class,
					'selected'   => $value,
					'extra_attr' => $extra_attr,
				);
				if ( isset( $taxonomy_args['set_all'] ) ) {
					$value_all = $taxonomy_args['set_all'];
					echo zufusion_radio_field_html( $value_all, $taxonomy_args[ $value_all ], $field_args['selected'], $field_args['name'], $field_args['class'] );
				}
				echo zufusion_taxonomy_field_html( $taxonomy_args, $field_args, 'radio', $taxonomy_args['term_type'] );

				break;

			case 'taxonomy_select':

				?>
                <select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>"
                        class="<?php echo esc_attr( $class ); ?>" <?php echo wp_kses_normalize_entities( $extra_attr ); ?>>
					<?php

					if ( isset( $taxonomy_args['set_all'] ) ) {
						$value_all = $taxonomy_args['set_all'];
						?>
                        <option value="<?php echo esc_attr( $value_all ); ?>" <?php selected( $value_all, $value ); ?>><?php echo esc_html( $taxonomy_args[ $value_all ] ); ?></option>
						<?php
					}
					$field_args = array(
						'name'     => $name,
						'id'       => $id,
						'class'    => $class,
						'selected' => $value,
					);
					echo zufusion_taxonomy_field_html( $taxonomy_args, $field_args, 'option', $taxonomy_args['term_type'] );
					?>
                </select>
				<?php
				break;

			case 'taxonomy_multiple':
				?>
                <select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" class="<?php echo esc_attr( $class ); ?>"
                        multiple="multiple" <?php echo wp_kses_normalize_entities( $extra_attr ); ?>>
					<?php
					if ( isset( $taxonomy_args['set_all'] ) ) {
						$value_all = $taxonomy_args['set_all'];
						$selected  = '';
						if ( is_array( $value ) && in_array( $value_all, $value ) ) {
							$selected = 'selected="selected"';
						}
						?>
                        <option value="<?php echo esc_attr( $value_all ); ?>" <?php echo esc_attr( $selected ); ?>><?php echo esc_html( $taxonomy_args[ $value_all ] ); ?></option>
						<?php
					}
					$field_args = array(
						'name'     => $name,
						'id'       => $id,
						'class'    => $class,
						'selected' => $value,
					);
					echo zufusion_taxonomy_field_html( $taxonomy_args, $field_args, 'option', $taxonomy_args['term_type'] );
					?>
                </select>
				<?php
				break;

			case 'terms_color':

				if ( is_array( $value ) && ! empty( $value ) ) {

					?>
                    <table class="widefat">
                        <thead>
                        <th><?php echo esc_html__( 'Name', 'zufusion' ); ?></th>
                        <th><?php echo esc_html__( 'Color', 'zufusion' ); ?></th>
                        </thead>
						<?php

						foreach ( $value as $slug => $color ) {

							?>
                            <tr>
                                <td><?php echo esc_html( $slug ); ?></td>
                                <td><input type="text" class="color-picker"
                                           name="<?php echo esc_attr( $name . '[' . $slug . ']' ); ?>"
                                           value="<?php echo esc_attr( $color ); ?>"/></td>
                            </tr>
							<?php
						}
						?>
                    </table>
					<?php
				}

				break;

			case 'checkbox_color':

				if ( is_array( $options ) && ! empty( $options ) ) {
					foreach ( $options as $key => $color ) {
						?>
                        <div class="checkbox-wrapper checkbox-color-wrapper">
                            <input type="checkbox" value="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $name ); ?>"
                                   id="<?php echo esc_attr( $id ); ?>"
                                   class="<?php echo esc_attr( $class ); ?>" <?php checked( true, is_array( $value ) && in_array( $key, $value ), true ); ?> <?php echo wp_kses_normalize_entities( $extra_attr ); ?>>
                            <label class="checkbox-color-label" for="<?php echo esc_attr( $id ); ?>"
                                   style="background-color: <?php echo esc_attr( $color ); ?>;"></label>
                        </div>
						<?php
					}
				}

				break;

			case 'multiple':
				?>
                <select id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" class="<?php echo esc_attr( $class ); ?>" multiple="multiple">
					<?php
					if ( is_array( $options ) && ! empty( $options ) ) {
						foreach ( $options as $key => $text ) {

							if ( is_array( $value ) && in_array( $key, $value ) ) {
								$selected = 'selected="selected"';
							} else {
								$selected = selected( $key, $value, false );
							}
							?>
                            <option value="<?php echo esc_attr( $key ); ?>" <?php echo esc_attr( $selected ); ?>><?php echo esc_html( trim( $text ) ); ?></option>
							<?php
						}
					}
					?>
                </select>
				<?php
				break;
			case 'textarea':
				?>
                <textarea id="<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $name ); ?>" class="<?php echo esc_attr( $class ); ?>"
                          rows="4"><?php echo esc_textarea( $value ); ?></textarea>
				<?php
				break;
			case 'editor':

				$wuf_editor_settings = array(
					'wpautop'          => true,  // enable rich text editor
					'textarea_name'    => $name, // name
					'textarea_rows'    => '10',  // number of textarea rows
					'tabindex'         => '',    // tabindex
					'editor_css'       => '',    // extra CSS
					'editor_class'     => $class, // class
					'teeny'            => false, // output minimal editor config
					'dfw'              => false, // replace fullscreen with DFW
					'tinymce'          => true,  // enable TinyMCE
					'quicktags'        => true,  // enable quicktags
					'drag_drop_upload' => true,  // enable drag-drop
				);

				$wuf_editor_settings = wp_parse_args( $editor_args, $wuf_editor_settings );

				wp_editor( wp_kses( trim( $value ), wp_kses_allowed_html( 'post' ) ), $id, $wuf_editor_settings );

				break;
			case 'hidden':
				?>
                <input type="hidden" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>">
				<?php
				break;
			case 'desc':
				?>
                <span class="desc"><label for="<?php echo esc_attr( $id ); ?>"
                                          id="<?php echo esc_attr( $id ); ?>_heading"><?php echo esc_html( $label ); ?></label></span>
				<?php
				break;
		}
		if ( $after_html_field != '' ) {
			echo wp_kses( trim( $after_html_field ), wp_kses_allowed_html( 'post' ) );
		}

		if ( $desc != '' ) {
			?>
            <br/><span class="description"><?php echo wp_kses( $desc, array(
					'a'      => array(
						'href' => true,
						'title' => true,
					),
					'br'     => true,
					'em'     => true,
					'code'   => true,
					'p'      => true,
					'strong' => true,
				) ); ?></span>
			<?php
		}
		if ( $after_html != '' ) {
			echo wp_kses( trim( $after_html ), wp_kses_allowed_html( 'post' ) );
		}
		?>
		<?php if ( $wrapper == 'yes' ) { ?>
            </div>
		<?php } ?>
		<?php
	}


}
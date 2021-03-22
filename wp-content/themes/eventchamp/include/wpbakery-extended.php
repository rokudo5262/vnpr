<?php
/*======
*
* WPBakery Extended
*
======*/
if( function_exists( 'vc_map' ) ) {

	vc_add_param(
		"vc_row",
		array(
			"type" => "dropdown",
			"param_name" => "overflow-status",
			"heading" => esc_html__( 'Overflow Status for the Stretch Row and Content', 'eventchamp' ),
			"value" => array(
				esc_html__( 'Hidden', 'eventchamp' ) => "gt-overflow-hidden",
				esc_html__( 'Visible', 'eventchamp' ) => "gt-overflow-visible",
			)
		)
	);

	vc_add_param(
		"vc_row",
		array(
			"type" => "dropdown",
			"param_name" => "row-text-align",
			"heading" => esc_html__( 'Text Align', 'eventchamp' ),
			"value" => array(
				esc_html__( 'Default', 'eventchamp' ) => "default",
				esc_html__( 'Left', 'eventchamp' ) => "left",
				esc_html__( 'Center', 'eventchamp' ) => "center",
				esc_html__( 'Right', 'eventchamp' ) => "right",
			)
		)
	);

	vc_add_param(
		"vc_column",
		array(
			"type" => "dropdown",
			"param_name" => "row-text-align",
			"heading" => esc_html__( 'Text Align', 'eventchamp' ),
			"value" => array(
				esc_html__( 'Default', 'eventchamp' ) => "default",
				esc_html__( 'Left', 'eventchamp' ) => "left",
				esc_html__( 'Center', 'eventchamp' ) => "center",
				esc_html__( 'Right', 'eventchamp' ) => "right",
			)
		)
	);

	vc_add_param(
		"vc_row",
		array(
			"type" => "dropdown",
			"param_name" => "background-position",
			"group" => esc_html__( 'Design Options', 'eventchamp' ),
			"heading" => esc_html__( 'Background Position', 'eventchamp' ),
			"value" => array(
				esc_html__( 'Initial', 'eventchamp' ) => "initial",
				esc_html__( 'Inherit', 'eventchamp' ) => "inherit",
				esc_html__( 'Center Center', 'eventchamp' ) => "center-center",
				esc_html__( 'Center Top', 'eventchamp' ) => "top-center",
				esc_html__( 'Center Bottom', 'eventchamp' ) => "bottom-center",
				esc_html__( 'Left Top', 'eventchamp' ) => "left-top",
				esc_html__( 'Left Center', 'eventchamp' ) => "left-center",
				esc_html__( 'Left Bottom', 'eventchamp' ) => "left-bottom",
				esc_html__( 'Right Top', 'eventchamp' ) => "right-top",
				esc_html__( 'Right Center', 'eventchamp' ) => "right-center",
				esc_html__( 'Right Bottom', 'eventchamp' ) => "right-bottom",
			)
		)
	);

	vc_add_param(
		"vc_row",
		array(
			"type" => "dropdown",
			"param_name" => "background-attachment",
			"group" => esc_html__( 'Design Options', 'eventchamp' ),
			"heading" => esc_html__( 'Background Attachment ', 'eventchamp' ),
			"description" => esc_html__( 'You can choose a background attachment.', 'eventchamp' ),
			"value" => array(
				esc_html__( 'Initial', 'eventchamp' ) => "initial",
				esc_html__( 'Inherit', 'eventchamp' ) => "inherit",
				esc_html__( 'Scroll', 'eventchamp' ) => "scroll",
				esc_html__( 'Fixed', 'eventchamp' ) => "fixed",
				esc_html__( 'Local', 'eventchamp' ) => "local",
			)
		)
	);

	vc_add_param(
		"vc_column",
		array(
			"type" => "dropdown",
			"param_name" => "background-position",
			"group" => esc_html__( 'Design Options', 'eventchamp' ),
			"heading" => esc_html__( 'Background Position', 'eventchamp' ),
			"value" => array(
				esc_html__( 'Initial', 'eventchamp' ) => "initial",
				esc_html__( 'Inherit', 'eventchamp' ) => "inherit",
				esc_html__( 'Center Center', 'eventchamp' ) => "center-center",
				esc_html__( 'Center Top', 'eventchamp' ) => "top-center",
				esc_html__( 'Center Bottom', 'eventchamp' ) => "bottom-center",
				esc_html__( 'Left Top', 'eventchamp' ) => "left-top",
				esc_html__( 'Left Center', 'eventchamp' ) => "left-center",
				esc_html__( 'Left Bottom', 'eventchamp' ) => "left-bottom",
				esc_html__( 'Right Top', 'eventchamp' ) => "right-top",
				esc_html__( 'Right Center', 'eventchamp' ) => "right-center",
				esc_html__( 'Right Bottom', 'eventchamp' ) => "right-bottom",
			)
		)
	);

	vc_add_param(
		"vc_column",
		array(
			"type" => "dropdown",
			"param_name" => "background-attachment",
			"group" => esc_html__( 'Design Options', 'eventchamp' ),
			"heading" => esc_html__( 'Background Attachment ', 'eventchamp' ),
			"description" => esc_html__( 'You can choose a background attachment.', 'eventchamp' ),
			"value" => array(
				esc_html__( 'Initial', 'eventchamp' ) => "initial",
				esc_html__( 'Inherit', 'eventchamp' ) => "inherit",
				esc_html__( 'Scroll', 'eventchamp' ) => "scroll",
				esc_html__( 'Fixed', 'eventchamp' ) => "fixed",
				esc_html__( 'Local', 'eventchamp' ) => "local",
			)
		)
	);

}
<?php
/**
 * @version    $Id$
 * @package   WordPress User Document
 * @author     ZuFusion
 * @copyright  (C) 2020  ZuFusion All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 */

use Zufusion\Core\Classes\Model;

class wudSettingsModel extends Model {

	/**
	 * Option name
	 * @var string
	 */
	protected $option_name = 'wud_settings_options';
	/**
	 * Store settings model
	 *
	 * @var mixed|null
	 */
	protected $settings = null;

	/**
	 * wudSettingsModel constructor.
	 *
	 * @param $app
	 */
	public function __construct( $app ) {
		$this->settings = $this->get_options();

		parent::__construct( $app );
	}

	/**
	 * get options
	 *
	 * @param array $defaults
	 *
	 * @return mixed
	 */
	public function get_options() {
		$defaults = array(

			'allowed_ext'         => 'doc,docx,ppt,pptx,pps,xls,xlsx,pdf,ps,odt,odp,sxw,sxi,txt,rtf',
			'max_upload_filesize' => 10,
			'color_style'         => 'default',
			'url_base'            => 'document',
			'sort_by'             => 'uploaded_date_desc',
			'per_page'            => 30,
			'use_previewer'       => 'yes',
			'extension_preview'   => 'doc,docx,ppt,pptx,pps,xls,xlsx,pdf,ps,odt,odp,sxw,sxi,txt,rtf',
			'ga_tracking'         => 'no',
			'block_ip'            => '',
			'admin_notification'  => 'yes',
			'auto_approve'        => 'no',
			'sidebar'             => 'sidebar',
			'sidebar_single'      => 'no_sidebar',
		);
		$defaults = apply_filters( 'wud_default_options', $defaults );
		$options  = wp_parse_args( get_option( $this->option_name, $defaults ), $defaults );

		return $options;
	}

	/**
	 * Get input name
	 *
	 * @param $field
	 * @param string $after
	 *
	 * @return string
	 */
	public function get_input_name( $field, $after = '' ) {
		return $this->option_name . '[' . $field . ']' . $after;
	}

	/**
	 * Get input id
	 *
	 * @param $field
	 * @param string $after
	 *
	 * @return string
	 */
	public function get_input_id( $field, $after = '' ) {
		return $this->option_name . '_' . $field . '_' . $after;
	}

	public function get_input_value( $field, $default = '' ) {
		$options = $this->settings;

		return isset( $options[ $field ] ) ? $options[ $field ] : $default;
	}

	/**
	 * Set input value
	 *
	 * @param $field
	 * @param string $value
	 */
	public function set_input_value( $field, $value = '' ) {
		$options           = $this->settings;
		$options[ $field ] = $value;
		update_option( $this->option_name, $options );
	}

	/**
	 * Get allowed extension
	 *
	 * @return array
	 */
	public function get_exts() {
		$allowed_ext = array(
			'doc',
			'docx',
			'ppt',
			'pptx',
			'pps',
			'xls',
			'xlsx',
			'pdf',
			'ps',
			'odt',
			'odp',
			'sxw',
			'sxi',
			'txt',
			'rtf'
		);
		$options     = $this->get_options();

		$exts = wp_parse_args( explode( ',', $options['allowed_ext'] ), $allowed_ext );


		return $exts;
	}

}

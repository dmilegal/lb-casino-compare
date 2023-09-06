<?php

/**
 * Compare button shortcode
 *
 * @link       https://github.com/dmilegal
 * @since      1.0.0
 *
 * @package    LB_CC
 * @subpackage LB_CC/includes
 */

/**
 * Compare button shortcode
 */
class LB_CC_Button_Shortcode { 

	/**
	 * Output the shortcode.
	 *
	 * @param array $atts Shortcode attributes.
	 */
	public static function render($atts) {
		echo LB_CC_Button_Shortcode::get($atts);
	}

	/**
	 * Get content the shortcode.
	 *
	 * @param array $atts Shortcode attributes.
	 */
	public static function get($atts) {
		ob_start();

		LB_CC_Template_Loader::load()->set_template_data($atts)->get_template_part( "toggle-button" );

		return ob_get_clean();
	}
}

<?php

/**
 * Lb shortcodes
 *
 * @link       https://github.com/dmilegal
 * @since      1.0.0
 *
 * @package    LB_CC
 * @subpackage LB_CC/includes
 */

/**
 * Lb shortcodes
 *
 * This class defines all code necessary to 'compare shortcode' manipulation.
 *
 */
class LB_CC_Shortcodes {

	/**
	 * Init shortcodes.
	 */
	public static function init() {
		$shortcodes = array(
			'compare_table'                    => __CLASS__ . '::compare_table',
			'compare_button'		           => __CLASS__ . '::compare_button',
		);

		foreach ( $shortcodes as $shortcode => $function ) {
			add_shortcode( apply_filters( "{$shortcode}_shortcode_tag", $shortcode ), $function );
		}

		LB_CC_Shortcodes::load_dependencies();

	}

	/**
	 * Load shortcode dependencies.
	 * @since    1.0.0
	 * @access   private
	 */
	private static function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/shortcodes/class-lb-cc-buton-shortcode.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/shortcodes/class-lb-cc-shortcode.php';
	}

	/**
	 * Shortcode Wrapper.
	 *
	 * @param string[] $function Callback function.
	 * @param array    $atts     Attributes. Default to empty array.
	 * @param array    $wrapper  Customer wrapper data.
	 *
	 * @return string
	 */
	public static function shortcode_wrapper(
		$function,
		$atts = array(),
		$content
	) {
		$args = [$atts];
		
		if ($content)
			array_push($args, $content);

		ob_start();

		call_user_func( $function, ...$args );

		return ob_get_clean();
	}

	/**
	 * Compare table shortcode.
	 *
	 * @param array $atts Attributes.
	 * @return string
	 */
	public static function compare_table( $atts ) {
		return self::shortcode_wrapper( array( 'LB_CC_Shortcode', 'render' ), $atts );
	}

	/**
	 * Compare button shortcode.
	 *
	 * @param array $atts Attributes.
	 * @return string
	 */
	public static function compare_button( $atts, $content ) {
		return self::shortcode_wrapper( array( 'LB_CC_Button_Shortcode', 'render' ), $atts, $content);
	}
}

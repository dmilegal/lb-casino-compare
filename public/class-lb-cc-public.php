<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/dmilegal
 * @since      1.0.0
 *
 * @package    LB_CC
 * @subpackage LB_CC/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    LB_CC
 * @subpackage LB_CC/public
 * @author     Dmitriy Krapivko <dmitry.krapivko@legalbet.com>
 */
class LB_CC_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in LB_CC_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The LB_CC_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name . '-awesome-notifications' , plugin_dir_url( __FILE__ ) . 'css/libs/awesome-notifications.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/lb-cc-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in LB_CC_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The LB_CC_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script(  $this->plugin_name . '-awesome-notifications', plugin_dir_url( __FILE__ ) . 'js/libs/awesome-notifications.js', array(  ), $this->version, true );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/lb-cc-public.js', array( 'jquery' ), $this->version, true );
		wp_add_inline_script( $this->plugin_name, 'const LB_CC_COOKIE_NAME="'. LB_CC_State::COMPARE_COOKIE_NAME . '-' . base64_encode(home_url()) . '"; LB_CC_LIMIT='. LB_CC_COMPARE_LIMIT .'; LB_CC_TRANSLATE={
			MAX_LIMIT: "'. sprintf(__('The maximum number of casinos for comparison is %d', 'lb-cc'), LB_CC_COMPARE_LIMIT) .'",
			error: "'. __('error', 'lb-cc') .'",
			success: "'. __('success', 'lb-cc') .'",
			attention: "'. __('attention', 'lb-cc') .'",
			loading: "'. __('loading', 'lb-cc') .'",
			info: "'. __('info', 'lb-cc') .'",
			tip: "'. __('tip', 'lb-cc') .'",
			cancel: "'. __('cancel', 'lb-cc') .'",
		};
		const LB_CC_ROUTES = {
			home_url: "'. home_url() .'",
			namespace: "'. LB_CC_Rest::namespace .'",
			preview_compares: "'. LB_CC_Rest::preview_compares_route .'",
			table_route: "'. LB_CC_Rest::compare_table_route .'",
		}', 'before' );
	}

	public function show_bar() {
		LB_CC_Template_Loader::load()->get_template_part( "compare-bar" );
	}

	public function show_compare_modal_tpl() {
		echo '<template class="lb-cc-modal-tpl">';
		LB_CC_Template_Loader::load()->get_template_part( "compare-modal" );
		echo '</template>';
	}

}

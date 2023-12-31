<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/dmilegal
 * @since      1.0.0
 *
 * @package    LB_CC
 * @subpackage LB_CC/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    LB_CC
 * @subpackage LB_CC/admin
 * @author     Dmitriy Krapivko <dmitry.krapivko@legalbet.com>
 */
class LB_CC_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Add admin page.
	 *
	 * @since    1.0.0
	 */
	public function register_page() {
		add_menu_page(__('Casino Comparison', 'lb-cc'), 
		__('Casino Comparison', 'lb-cc'), 
		'manage_options',
		'lb-cc',
		[$this, 'render_page'],
		'dashicons-randomize');
	}

	public function register_settings_page() {
		acf_add_options_page(array(
			'page_title'  => __('Casino Comparison Settings', 'lb-cc'),
			'menu_title'  => __('Settings', 'lb-cc'),
			'menu_slug' => 'lb-cc-settings',
			'parent_slug' => 'lb-cc',
			'capability'  => 'manage_options',
			'position'  => false,
			'icon_url' => false,
		));

	}


	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/lb-cc-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/lb-cc-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Get render page content.
	 *
	 * @since    1.0.0
	 */
	public function render_page() {
		LB_CC_Template_Loader::load()->get_template_part("lb-cc-admin-display");
	}

}

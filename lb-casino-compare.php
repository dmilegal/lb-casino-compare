<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/dmilegal
 * @since             1.0.0
 * @package           LB_CC
 *
 * @wordpress-plugin
 * Plugin Name:       LB Casinos Compare
 * Plugin URI:        https://github.com/dmilegal/lb-casino-compare
 * Description:       Casino comparison: modal window for comparison, separate page for comparison.
 * Version:           1.0.0
 * Author:            Dmitriy Krapivko
 * Author URI:        https://github.com/dmilegal
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       lb-cc
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'LB_CC_VERSION', '1.0.0' );

/**
 * Plugin dirname
 */
define( 'LB_CC_DIRNAME',  plugin_dir_path( __FILE__ ));

/**
 * Limit
 */
define( 'LB_CC_COMPARE_LIMIT',  3);

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-lb-cc-activator.php
 */
function activate_lb_cc() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lb-cc-activator.php';
	LB_CC_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-lb-cc-deactivator.php
 */
function deactivate_lb_cc() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-lb-cc-deactivator.php';
	LB_CC_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_lb_cc' );
register_deactivation_hook( __FILE__, 'deactivate_lb_cc' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-lb-cc.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_lb_cc() {

	$plugin = new LB_CC();
	$plugin->run();

}
run_lb_cc();

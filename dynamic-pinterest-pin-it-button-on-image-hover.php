<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://dynamicweblab.com
 * @since             1.0.0
 * @package           Dynamic_Pinterest_Pin_It_Button_On_Image_Hover
 *
 * @wordpress-plugin
 * Plugin Name:       Dynamic Pin It Button On Image Hover
 * Description:       Show Pinterest Save it button on wordpess image on hover
 * Version:           1.0.0
 * Author:            Dynamic Web Lab
 * Author URI:        https://dynamicweblab.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dwl-pin-it-button
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
define( 'DYNAMIC_PINTEREST_PIN_IT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dynamic-pinterest-pin-it-button-on-image-hover-activator.php
 */
function activate_dynamic_pinterest_pin_it_button_on_image_hover() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dynamic-pinterest-pin-it-button-on-image-hover-activator.php';
	Dynamic_Pinterest_Pin_It_Button_On_Image_Hover_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dynamic-pinterest-pin-it-button-on-image-hover-deactivator.php
 */
function deactivate_dynamic_pinterest_pin_it_button_on_image_hover() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dynamic-pinterest-pin-it-button-on-image-hover-deactivator.php';
	Dynamic_Pinterest_Pin_It_Button_On_Image_Hover_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dynamic_pinterest_pin_it_button_on_image_hover' );
register_deactivation_hook( __FILE__, 'deactivate_dynamic_pinterest_pin_it_button_on_image_hover' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dynamic-pinterest-pin-it-button-on-image-hover.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dynamic_pinterest_pin_it_button_on_image_hover() {

	$plugin = new Dynamic_Pinterest_Pin_It_Button_On_Image_Hover();
	$plugin->run();

}
run_dynamic_pinterest_pin_it_button_on_image_hover();

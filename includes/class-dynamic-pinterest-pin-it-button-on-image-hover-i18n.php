<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://dynamicweblab.com
 * @since      1.0.0
 *
 * @package    Dynamic_Pinterest_Pin_It_Button_On_Image_Hover
 * @subpackage Dynamic_Pinterest_Pin_It_Button_On_Image_Hover/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Dynamic_Pinterest_Pin_It_Button_On_Image_Hover
 * @subpackage Dynamic_Pinterest_Pin_It_Button_On_Image_Hover/includes
 * @author     Dynamic Web Lab <dynamicweblab@gmail.com>
 */
class Dynamic_Pinterest_Pin_It_Button_On_Image_Hover_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'dynamic-pinterest-pin-it-button-on-image-hover',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

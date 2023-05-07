<?php

/**
 * Fired during plugin activation
 *
 * @link       https://dynamicweblab.com
 * @since      1.0.0
 *
 * @package    Dynamic_Pinterest_Pin_It_Button_On_Image_Hover
 * @subpackage Dynamic_Pinterest_Pin_It_Button_On_Image_Hover/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Dynamic_Pinterest_Pin_It_Button_On_Image_Hover
 * @subpackage Dynamic_Pinterest_Pin_It_Button_On_Image_Hover/includes
 * @author     Dynamic Web Lab <dynamicweblab@gmail.com>
 */
class Dynamic_Pinterest_Pin_It_Button_On_Image_Hover_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		update_option('dwl_pin_it_button_settings',[
			'show_on_post' => '1',
			'pin_it_button_size_1' => 'large'
		]);

	}

}

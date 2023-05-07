<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://dynamicweblab.com
 * @since      1.0.0
 *
 * @package    Dynamic_Pinterest_Pin_It_Button_On_Image_Hover
 * @subpackage Dynamic_Pinterest_Pin_It_Button_On_Image_Hover/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Dynamic_Pinterest_Pin_It_Button_On_Image_Hover
 * @subpackage Dynamic_Pinterest_Pin_It_Button_On_Image_Hover/includes
 * @author     Dynamic Web Lab <dynamicweblab@gmail.com>
 */
class Dynamic_Pinterest_Pin_It_Button_On_Image_Hover {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Dynamic_Pinterest_Pin_It_Button_On_Image_Hover_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'DYNAMIC_PINTEREST_PIN_IT_VERSION' ) ) {
			$this->version = DYNAMIC_PINTEREST_PIN_IT_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'dynamic-pinterest-pin-it-button-on-image-hover';

		$this->load_dependencies();
		$this->set_locale();
		add_action( 'wp_enqueue_scripts', [$this,'enqueue_scripts'] );
		add_filter( 'script_loader_tag', [$this,'filter_script_loader_tag'], 10, 2 );
		add_action( 'wp_footer', [$this,'add_pin_button'] );
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Dynamic_Pinterest_Pin_It_Button_On_Image_Hover_Loader. Orchestrates the hooks of the plugin.
	 * - Dynamic_Pinterest_Pin_It_Button_On_Image_Hover_i18n. Defines internationalization functionality.
	 * - Dynamic_Pinterest_Pin_It_Button_On_Image_Hover_Admin. Defines all hooks for the admin area.
	 * - Dynamic_Pinterest_Pin_It_Button_On_Image_Hover_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-dynamic-pinterest-pin-it-button-on-image-hover-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-dynamic-pinterest-pin-it-button-on-image-hover-i18n.php';

		/**
		 * The class responsible for defining Plugin settings.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-dynamic-pinterest-settings.php';


		$this->loader = new Dynamic_Pinterest_Pin_It_Button_On_Image_Hover_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Dynamic_Pinterest_Pin_It_Button_On_Image_Hover_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Dynamic_Pinterest_Pin_It_Button_On_Image_Hover_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Dynamic_Pinterest_Pin_It_Button_On_Image_Hover_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		$pin_it_button_options = get_option( 'dwl_pin_it_button_settings' );

		$dwl_pinit_html_attrs = [
			'async'          => 'async',
			'defer'          => true,
			'data-pin-hover' => 'true',
		];

		if(isset($pin_it_button_options['pin_it_button_size_1']) AND 'large' == $pin_it_button_options['pin_it_button_size_1']){
			$dwl_pinit_html_attrs['data-pin-tall'] = 'true';
		}
		if(isset($pin_it_button_options['pin_it_button_round'])){
			$dwl_pinit_html_attrs['data-pin-round'] = 'true';
		}
		wp_register_script(
			'dwl-pinterest-pinit',
			'//assets.pinterest.com/js/pinit.js',
			array (),
			null,
			true
		);
		wp_script_add_data( 'dwl-pinterest-pinit', 'dwl_pinit_html_attrs', $dwl_pinit_html_attrs );
	}
	
	function filter_script_loader_tag( $tag, $handle ) {

		$attrs = wp_scripts()->get_data( $handle, 'dwl_pinit_html_attrs' );
	
		// Bail if the script doesn't have any registered custom HTML attrs.
		if ( empty( $attrs ) || ! is_array( $attrs ) ) {
			return $tag;
		}

		$dom = new DOMDocument;
	
		//$tag = mb_convert_encoding( $tag, 'HTML-ENTITIES', 'UTF-8' );
		$dom->loadHTML( $tag, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD );
	
		$node = $dom->getElementsByTagName( 'script' )[0];
		foreach ( $attrs as $key => $value ) {
			$node->setAttribute( $key, $value );
		}
	
		return $dom->saveHTML();
	}
	

	/**
	 * Add Pit Button on image
	 *
	 * @since     1.0.0
	 */
	public function add_pin_button()
	{
		// Array of All Options

		$pin_it_button_options = get_option( 'dwl_pin_it_button_settings' ); 
 		
		$show_on_post = isset($pin_it_button_options['show_on_post']) ? true : false;

		$show_on_archive = isset($pin_it_button_options['show_on_archive']) ? true : false;

		if($show_on_post){

			if ( is_single() && 'post' == get_post_type() ) {
				wp_enqueue_script( 'dwl-pinterest-pinit' );
			}

		}

		if($show_on_archive){

			if(is_archive()){
				wp_enqueue_script( 'dwl-pinterest-pinit' );
			}

		}
	
	}

}

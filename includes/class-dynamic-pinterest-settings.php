<?php

class Dynamic_Pinterest_Pin_It_Button {

	private $pin_it_button_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'pin_it_button_add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'pin_it_button_page_init' ) );
	}

	public function pin_it_button_add_plugin_page() {
		add_options_page(
			__( 'Pin It Button', 'dwl-pin-it-button' ), // page_title
			__( 'Pin It Button', 'dwl-pin-it-button' ), // menu_title
			'manage_options', // capability
			'pin-it-button', // menu_slug
			array( $this, 'admin_page_html' ) // function
		);
	}

	public function admin_page_html() {

		// check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$this->pin_it_button_options = get_option( 'dwl_pin_it_button_settings' ); ?>
		
		<div class="wrap">
			<h2><?php esc_html_e( 'Pin It Button', 'dwl-pin-it-button' ); ?></h2>
			<p><?php esc_html_e( 'Pin It Button on image hover settings', 'dwl-pin-it-button' ); ?></p>
			<?php settings_errors(); ?>

			<div id="post-body">
			<div class="meta-box-sortables ui-sortable">
				<div class="postbox">
					<div class="inside">
					<form method="post" action="options.php">
						<?php
							settings_fields( 'pin_it_button_option_group' );
							do_settings_sections( 'pin-it-button-admin' );
							submit_button();
						?>
					</form>
					</div>

				</div>
			</div>

			</div>

		</div>
	<?php }

	public function pin_it_button_page_init() {
		register_setting(
			'pin_it_button_option_group', // option_group
			'dwl_pin_it_button_settings', // option_name
			array( $this, 'pin_it_button_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'pin_it_button_setting_section', // id
			__( 'Settings', 'dwl-pin-it-button' ), // title
			array( $this, 'pin_it_button_section_info' ), // callback
			'pin-it-button-admin' // page
		);

		/**
		 * @todo Pro only
		 */
		// add_settings_field(
		// 	'pin_it_button_first_image', // id
		// 	'Show on First Image only', // title
		// 	array( $this, 'pin_it_button_first_image_callback' ), // callback
		// 	'pin-it-button-admin', // page
		// 	'pin_it_button_setting_section' // section
		// );

		add_settings_field(
			'show_on_post', // id
			__( 'Show on Post', 'dwl-pin-it-button' ), // title
			array( $this, 'show_on_post_callback' ), // callback
			'pin-it-button-admin', // page
			'pin_it_button_setting_section' // section
		);
		add_settings_field(
			'show_on_archive', // id
			__( 'Show on Post Archive', 'dwl-pin-it-button' ), // title
			array( $this, 'show_on_archive_callback' ), // callback
			'pin-it-button-admin', // page
			'pin_it_button_setting_section' // section
		);

		add_settings_field(
			'pin_it_button_size_1', // id
			__( 'Pin It Button Size', 'dwl-pin-it-button' ), // title
			array( $this, 'pin_it_button_size_1_callback' ), // callback
			'pin-it-button-admin', // page
			'pin_it_button_setting_section' // section
		);

		add_settings_field(
			'pin_it_button_round', // id
			__( 'Pin It Button Round', 'dwl-pin-it-button' ), // title
			array( $this, 'pin_it_button_round_callback' ), // callback
			'pin-it-button-admin', // page
			'pin_it_button_setting_section' // section
		);

	}

	public function pin_it_button_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['show_on_post'] ) ) {
			$sanitary_values['show_on_post'] = $input['show_on_post'];
		}
		if ( isset( $input['show_on_archive'] ) ) {
			$sanitary_values['show_on_archive'] = $input['show_on_archive'];
		}
		if ( isset( $input['pin_it_button_size_1'] ) ) {
			$sanitary_values['pin_it_button_size_1'] = $input['pin_it_button_size_1'];
		}

		if ( isset( $input['pin_it_button_round'] ) ) {
			$sanitary_values['pin_it_button_round'] = $input['pin_it_button_round'];
		}

		return $sanitary_values;
	}

	public function pin_it_button_section_info() {
		
	}


	public function pin_it_button_first_image_callback()
	{
		$pin_it_button_first_image = isset($this->pin_it_button_options['pin_it_button_first_image']) ? $this->pin_it_button_options['pin_it_button_first_image'] : '0';
		?>
		<input type="checkbox" id="pin_it_button_first_image" name="dwl_pin_it_button_settings[pin_it_button_first_image]" value="1" <?php checked( 1, $pin_it_button_first_image, true ); ?>>
		<label for="pin_it_button_first_image"> <?php esc_html_e( 'Yes', 'dwl-pin-it-button' ); ?> </label>
		
		<?php
	}

	public function show_on_post_callback()
	{
		$pin_it_button_first_image = isset($this->pin_it_button_options['show_on_post']) ? $this->pin_it_button_options['show_on_post'] : '0';
		?>
		<input type="checkbox" id="show_on_post" name="dwl_pin_it_button_settings[show_on_post]" value="1" <?php checked( 1, $pin_it_button_first_image, true ); ?>>
		<label for="show_on_post"> <?php esc_html_e( 'Yes', 'dwl-pin-it-button' ); ?> </label>
		<?php
	}

	public function show_on_archive_callback() {
		$show_on_archive = isset($this->pin_it_button_options['show_on_archive']) ? $this->pin_it_button_options['show_on_archive'] : '0';
		?>
		<input type="checkbox" id="show_on_archive" name="dwl_pin_it_button_settings[show_on_archive]" value="1" <?php checked( 1, $show_on_archive, true ); ?>>
		<label for="show_on_archive"> <?php esc_html_e( 'Yes', 'dwl-pin-it-button' ); ?> </label>
		<?php
	}

	public function pin_it_button_size_1_callback() {
		?> <select name="dwl_pin_it_button_settings[pin_it_button_size_1]" id="pin_it_button_size_1">
			<?php $selected = (isset( $this->pin_it_button_options['pin_it_button_size_1'] ) && $this->pin_it_button_options['pin_it_button_size_1'] === 'small') ? 'selected' : '' ; ?>
			<option value="small" <?php echo esc_html($selected); ?>><?php esc_html_e( 'Small', 'dwl-pin-it-button' ); ?></option>
			<?php $selected = (isset( $this->pin_it_button_options['pin_it_button_size_1'] ) && $this->pin_it_button_options['pin_it_button_size_1'] === 'large') ? 'selected' : '' ; ?>
			<option value="large" <?php echo esc_html($selected); ?>><?php esc_html_e( 'Large', 'dwl-pin-it-button' ); ?></option>
		</select> <?php
	}

	public function pin_it_button_round_callback()
	{
		$pin_it_button_round = isset($this->pin_it_button_options['pin_it_button_round']) ? $this->pin_it_button_options['pin_it_button_round'] : '0';
		?>
		<input type="checkbox" id="pin_it_button_round" name="dwl_pin_it_button_settings[pin_it_button_round]" value="1" <?php checked( 1, $pin_it_button_round, true ); ?>>
		<label for="pin_it_button_round"> <?php esc_html_e( 'Yes', 'dwl-pin-it-button' ); ?> </label>
		
		<?php
	}

}
if ( is_admin() )
	$pin_it_button = new Dynamic_Pinterest_Pin_It_Button();

/* 
 * Retrieve this value with:
 * $pin_it_button_options = get_option( 'dwl_pin_it_button_settings' ); // Array of All Options
 * $show_on_0 = $pin_it_button_options['show_on_0']; // Show on
 * $pin_it_button_size_1 = $pin_it_button_options['pin_it_button_size_1']; // Pin It Button Size
 */

<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           C_Info_Generator
 *
 * @wordpress-plugin
 * Plugin Name:       C-Info Generator
 * Plugin URI:        https://github.com/frc/c-info-generator
 * Description:       Generates C-Info widget html script tag
 * Version:           1.0.0
 * Author:            Ahti Nurminen
 * Author URI:        https://frantic.com
 * Licence: 		  All rights reserved
 * Text Domain:       c-info-generator
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
define( 'C_INFO_GENERATOR_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-c-info-generator-activator.php
 */
function activate_c_info_generator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-c-info-generator-activator.php';
	C_Info_Generator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-c-info-generator-deactivator.php
 */
function deactivate_c_info_generator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-c-info-generator-deactivator.php';
	C_Info_Generator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_c_info_generator' );
register_deactivation_hook( __FILE__, 'deactivate_c_info_generator' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-c-info-generator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_c_info_generator() {

	$plugin = new C_Info_Generator();
	$plugin->run();

	// WP API v1.
	//include_once 'includes/wp-api-menus-v1.php';
	// WP API v2.
	//include_once 'includes/wp-api-menus-v2.php';

//	if ( ! function_exists ( 'wp_rest_menus_init' ) ) :

		/**
		 * Init JSON REST API Menu routes.
		 *
		 * @since 1.0.0
		 */
		// function wp_rest_menus_init() {

		// 	if ( ! defined( 'JSON_API_VERSION' ) && ! in_array( 'json-rest-api/plugin.php', get_option( 'active_plugins' ) ) ) {
		// 		$class = new WP_REST_Menus();
		// 		add_filter( 'rest_api_init', array( $class, 'register_routes' ) );
		// 	} else {
		// 		$class = new WP_JSON_Menus();
		// 		add_filter( 'json_endpoints', array( $class, 'register_routes' ) );
		// 	}
		// }

		// add_action( 'init', 'wp_rest_menus_init' );

//	endif;

	/* Plugin admin menu settings */

	add_action( 'admin_menu', 'c_info_generator_add_admin_menu' );
	add_action( 'admin_init', 'c_info_generator_settings_init' );


	function c_info_generator_add_admin_menu() { 

		add_options_page( 'C-Info Generator', 'C-Info', 'manage_options', 'c_info_generator', 'c_info_generator_options_page' );

	}


	function c_info_generator_settings_init() { 

		register_setting( 'cInfoPluginPage', 'c_info_generator_settings' );

		add_settings_section(
			'c_info_generator_pluginPage_section', 
			'', 
			'', 
			'cInfoPluginPage'
		);

		add_settings_field( 
			'c_info_generator_text_field_publisher', 
			__( 'publisher', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage', 
			'c_info_generator_pluginPage_section' 
		);
/*
		add_settings_field( 
			'c_info_generator_text_field_header', 
			__( 'header', 'wordpress' ), 
			'c_info_generator_text_field_render', 
			'cInfoPluginPage', 
			'c_info_generator_pluginPage_section' 
		);
		*/

		add_settings_field( 
			'c_info_generator_textarea_field_description', 
			__( 'description', 'wordpress' ), 
			'c_info_generator_textarea_field_callback', 
			'cInfoPluginPage', 
			'c_info_generator_pluginPage_section' 
		);
		

	}

	function c_info_generator_text_field_callback() { 
		$options = get_option( 'c_info_generator_settings' );
		$opt = 'c_info_generator_text_field_publisher';
		?>
		<input type="text" name='c_info_generator_settings[c_info_generator_text_field_publisher]' value='<?php echo $options['c_info_generator_text_field_publisher']; ?>'>
		<?php
	}

	function c_info_generator_textarea_field_callback() { 
		$options = get_option( 'c_info_generator_settings' );
		?>
		<textarea cols='40' rows='5' name='c_info_generator_settings[c_info_generator_textarea_field_description]'><?php echo $options['c_info_generator_textarea_field_description']; ?></textarea>
		<?php
	}


	function c_info_generator_options_page() { 

		$options = get_option( 'c_info_generator_settings' );
		?>
		<form action='options.php' method='post'>

			<h1>C-Info asetukset</h1>
			<p>Lorem ipsum</p>

			<?php
			settings_fields( 'cInfoPluginPage' );
			do_settings_sections( 'cInfoPluginPage' );
			submit_button();
			echo '<br>';

			echo '<h4 style="margin-bottom: 0;">'.__( 'Koodi:', 'wordpress' ).'</h4>';
			echo '<br>';

			echo '<code style="display: inline-block; margin: 0px 1px 25px;">&lt;c-info publisher="Testi oy" material_choice=1 maker_choice_1="" maker_material_1="" maker_names_1="" maker_choice_2="Kuvat" maker_material_2="" maker_names_2="" maker_choice_3="Kuvat" maker_material_3="" maker_names_3="" text_right="1" video_right="1" sound_right="1" terms_link="" ext_cc="" video_cc="" sound_cc="" &gt;&lt;/c-info&gt;';
			echo '&lt;script src="'.home_url().'/c-info.js"&gt;&lt;/script&gt;</code>';
			echo '<br>';

			echo '<h4 style="margin-bottom: 0;">'.__( 'Preview:', 'wordpress' ).'</h4>';
			echo '<br>';

			echo '<div>';
			echo '<c-info publisher="Testi oy" material_choice=1 maker_choice_1="" maker_material_1="" maker_names_1="" maker_choice_2="Kuvat" maker_material_2="" maker_names_2="" maker_choice_3="Kuvat"	maker_material_3="" maker_names_3="" text_right="1" video_right="1" sound_right="1" terms_link="" ext_cc="" video_cc="" sound_cc="" style="position: inline-block;"></c-info>';
			echo '<script src="'.home_url().'/c-info.js"></script>';
			echo '</div>';
			echo '<br>';
			?>

		</form>
		<?php

	}

	function c_info_generator_add_settings_link( $links ) {
		$settings_link = '<a href="options-general.php?page=c_info">' . __( 'Settings' ) . '</a>';
		array_unshift( $links, $settings_link );
		return $links;
	}

	$plugin = plugin_basename( __FILE__ );
	add_filter( "plugin_action_links_$plugin", 'c_info_generator_add_settings_link' );

}
run_c_info_generator();

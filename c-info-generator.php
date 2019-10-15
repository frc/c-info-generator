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
 * @package           C-Info_Generator
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

		register_setting( 'pluginPage', 'c_info_generator_settings' );

		add_settings_section(
			'c_info_generator_pluginPage_section', 
			'', 
			'', 
			'pluginPage'
		);

		add_settings_field( 
			'c_info_generator_text_field_title_fi', 
			__( 'Otsikko_FI', 'wordpress' ), 
			array('c_info_generator_text_field_0_render', 'title_fi'), 
			'pluginPage', 
			'c_info_generator_pluginPage_section' 
		);

		add_settings_field( 
			'c_info_generator_text_field_title_sv', 
			__( 'Otsikko_SV', 'wordpress' ), 
			'c_info_generator_text_field_0_render(title_sv)', 
			'pluginPage', 
			'c_info_generator_pluginPage_section' 
		);

		add_settings_field( 
			'c_info_generator_text_field_title_en', 
			__( 'Otsikko_EN', 'wordpress' ), 
			'c_info_generator_text_field_0_render(title_en)', 
			'pluginPage', 
			'c_info_generator_pluginPage_section' 
		);

		
		add_settings_field( 
			'c_info_generator_textarea_field_intro_fi', 
			__( 'Intro', 'wordpress' ), 
			'c_info_generator_textarea_field_0_render', 
			'pluginPage', 
			'c_info_generator_pluginPage_section' 
		);
		

	}

	function c_info_generator_text_field_0_render($id) { 
		var_dump($id);
		$options = get_option( 'c_info_generator_settings' );
		$opt = 'c_info_generator_text_field_'.$id;
		?>
		<input type="text" name='c_info_generator_settings[<?php echo $options[$opt]; ?>' value='<?php echo $options[$opt]; ?>'>
		<?php

	}


	function c_info_generator_textarea_field_0_render() { 

		$options = get_option( 'c_info_generator_settings' );
		?>
		<textarea disabled cols='40' rows='5' name='c_info_generator_settings[c_info_generator_textarea_field_intro_fi]'> 
		</textarea>
		<?php

	}


	function c_info_generator_options_page() { 

		$options = get_option( 'c_info_generator_settings' );
		?>
		<form action='options.php' method='post'>

			<h1>C-Info asetukset</h1>
			<p>Lorem ipsum</p>

			<?php
			settings_fields( 'pluginPage' );
			do_settings_sections( 'pluginPage' );
			submit_button();
			echo '<br>';

			echo '<h4 style="margin-bottom: 0;">'.__( 'Custom element:', 'wordpress' ).'</h4>';
			echo '<br>';

			echo '<code style="display: inline-block; margin: 0px 1px 25px;">&lt;c-info-generator url="'.home_url().'/wp-json/c-info-generator/v2/menus/'.$options['c_info_generator_text_field_0'].'"&gt;&lt;/c-info-generator&gt;';
			echo '&lt;script src="'.home_url().'/app/plugins/c-info-generator/public/js/c-info-generator.js"&gt;&lt;/script&gt;</code>';
			echo '<br>';

			echo '<h4 style="margin-bottom: 0;">'.__( 'Preview:', 'wordpress' ).'</h4>';
			echo '<br>';

			echo '<div style="width: 99%; height: 500px; background: white;">';
			echo '<c-info-generator url="'.home_url().'/wp-json/c-info-generator/v2/menus/'.$options['c_info_generator_text_field_0'].'"></c-info-generator>';
			echo '<script src="'.home_url().'/app/plugins/c-info-generator/public/js/c-info-generator.js"></script>';
			echo '<iframe src="https://www.frantic.com" style="width: 100%; height: 100%;"></iframe>';
			echo '</div>';
			echo '<br>';
			?>

		</form>
		<a href="https://github.com/frc/c-info-generator" style="position: absolute; bottom: 0;">Project source</a>
		<?php

	}

	function c_info_generator_add_settings_link( $links ) {
		$settings_link = '<a href="options-general.php?page=global_navigation">' . __( 'Settings' ) . '</a>';
		array_unshift( $links, $settings_link );
		return $links;
	}

	$plugin = plugin_basename( __FILE__ );
	add_filter( "plugin_action_links_$plugin", 'c_info_generator_add_settings_link' );

}
run_c_info_generator();

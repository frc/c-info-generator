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
	include_once 'includes/api.php';

	if ( ! function_exists ( 'wp_rest_init' ) ) :

		/**
		 * Init JSON REST API
		 *
		 * @since 1.0.0
		 */
		function wp_rest_init() {

		 	if ( ! defined( 'JSON_API_VERSION' ) && ! in_array( 'json-rest-api/plugin.php', get_option( 'active_plugins' ) ) ) {
		 		$class = new WP_REST();
		 		add_filter( 'rest_api_init', array( $class, 'register_routes' ) );
		 	} else {
		 		// $class = new WP_JSON_Menus();
		 		// add_filter( 'json_endpoints', array( $class, 'register_routes' ) );
		 	}
		}

		add_action( 'init', 'wp_rest_init' );

	endif;

	/* Plugin admin menu settings */

	add_action( 'admin_menu', 'c_info_generator_add_admin_menu' );
	add_action( 'admin_init', 'c_info_generator_settings_init_fi' );
	add_action( 'admin_init', 'c_info_generator_settings_init_en' );
	add_action( 'admin_init', 'c_info_generator_settings_init_sv' );


	function c_info_generator_add_admin_menu() { 

		add_options_page( 'C-Info Generator', 'C-Info', 'manage_options', 'c_info_generator', 'c_info_generator_options_page' );

	}


	function c_info_generator_settings_init_fi() { 

		register_setting( 'cInfoPluginPage_fi', 'c_info_generator_settings_fi' );

		add_settings_section(
			'c_info_generator_pluginPage_section', 
			'', 
			'', 
			'cInfoPluginPage_fi'
		);

		add_settings_field( 
			'publisher_fi', 
			__( 'publisher_fi', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_fi', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'publisher_fi' )
		);

		add_settings_field( 
			'header_fi', 
			__( 'header_fi', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_fi', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'header_fi' )
		);

		
		add_settings_field( 
			'maker_title_fi', 
			__( 'maker_title_fi', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_fi', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'maker_title_fi' )
		);

		add_settings_field( 
			'material_choice_fi', 
			__( 'material_choice_fi', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_fi', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'material_choice_fi' )
		);

		add_settings_field( 
			'maker_choice_fi', 
			__( 'maker_choice_fi', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_fi', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'maker_choice_fi' )
		);

		add_settings_field( 
			'right_title_fi', 
			__( 'right_title_fi', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_fi', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'right_title_fi' )
		);

		add_settings_field( 
			'video_title_fi', 
			__( 'video_title_fi', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_fi', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'video_title_fi' )
		);

		add_settings_field( 
			'sound_title_fi', 
			__( 'sound_title_fi', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_fi', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'sound_title_fi' )
		);

		add_settings_field( 
			'text_rights_fi', 
			__( 'text_rights_fi', 'wordpress' ), 
			'c_info_generator_textarea_field_callback', 
			'cInfoPluginPage_fi', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'text_rights_fi' )
		);

		add_settings_field( 
			'video_rights_fi', 
			__( 'video_rights_fi', 'wordpress' ), 
			'c_info_generator_textarea_field_callback', 
			'cInfoPluginPage_fi', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'video_rights_fi' )
		);

		add_settings_field( 
			'sound_rights_fi', 
			__( 'sound_rights_fi', 'wordpress' ), 
			'c_info_generator_textarea_field_callback', 
			'cInfoPluginPage_fi', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'sound_rights_fi' )
		);

		add_settings_field( 
			'description_fi', 
			__( 'description_fi', 'wordpress' ), 
			'c_info_generator_textarea_field_callback', 
			'cInfoPluginPage_fi', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'description_fi' )
		);
		
	}

	function c_info_generator_settings_init_en() { 

		register_setting( 'cInfoPluginPage_en', 'c_info_generator_settings_en' );

		add_settings_section(
			'c_info_generator_pluginPage_section', 
			'', 
			'', 
			'cInfoPluginPage_en'
		);

		add_settings_field( 
			'publisher_en', 
			__( 'publisher_en', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_en', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'publisher_en' )
		);

		add_settings_field( 
			'header_en', 
			__( 'header_en', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_en', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'header_en' )
		);

		add_settings_field( 
			'maker_title_en', 
			__( 'maker_title_en', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_en', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'maker_title_en' )
		);

		add_settings_field( 
			'material_choice_en', 
			__( 'material_choice_en', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_en', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'material_choice_en' )
		);

		add_settings_field( 
			'maker_choice_en', 
			__( 'maker_choice_en', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_en', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'maker_choice_en' )
		);

		add_settings_field( 
			'right_title_en', 
			__( 'right_title_en', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_en', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'right_title_en' )
		);

		add_settings_field( 
			'video_title_en', 
			__( 'video_title_en', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_en', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'video_title_en' )
		);

		add_settings_field( 
			'sound_title_en', 
			__( 'sound_title_en', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_en', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'sound_title_en' )
		);

		add_settings_field( 
			'text_rights_en', 
			__( 'text_rights_en', 'wordpress' ), 
			'c_info_generator_textarea_field_callback', 
			'cInfoPluginPage_en', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'text_rights_en' )
		);

		add_settings_field( 
			'video_rights_en', 
			__( 'video_rights_en', 'wordpress' ), 
			'c_info_generator_textarea_field_callback', 
			'cInfoPluginPage_en', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'video_rights_en' )
		);

		add_settings_field( 
			'sound_rights_en', 
			__( 'sound_rights_en', 'wordpress' ), 
			'c_info_generator_textarea_field_callback', 
			'cInfoPluginPage_en', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'sound_rights_en' )
		);

		add_settings_field( 
			'description_en', 
			__( 'description_en', 'wordpress' ), 
			'c_info_generator_textarea_field_callback', 
			'cInfoPluginPage_en', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'description_en' )
		);
		
	}

	function c_info_generator_settings_init_sv() { 

		register_setting( 'cInfoPluginPage_sv', 'c_info_generator_settings_sv' );

		add_settings_section(
			'c_info_generator_pluginPage_section', 
			'', 
			'', 
			'cInfoPluginPage_sv'
		);

		add_settings_field( 
			'publisher_sv', 
			__( 'publisher_sv', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_sv', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'publisher_sv' )
		);

		add_settings_field( 
			'header_sv', 
			__( 'header_sv', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_sv', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'header_sv' )
		);

		
		add_settings_field( 
			'maker_title_sv', 
			__( 'maker_title_sv', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_sv', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'maker_title_sv' )
		);

		add_settings_field( 
			'material_choice_sv', 
			__( 'material_choice_sv', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_sv', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'material_choice_sv' )
		);

		add_settings_field( 
			'maker_choice_sv', 
			__( 'maker_choice_sv', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_sv', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'maker_choice_sv' )
		);

		add_settings_field( 
			'right_title_sv', 
			__( 'right_title_sv', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_sv', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'right_title_sv' )
		);

		add_settings_field( 
			'video_title_sv', 
			__( 'video_title_sv', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_sv', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'video_title_sv' )
		);

		add_settings_field( 
			'sound_title_sv', 
			__( 'sound_title_sv', 'wordpress' ), 
			'c_info_generator_text_field_callback', 
			'cInfoPluginPage_sv', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'sound_title_sv' )
		);

		add_settings_field( 
			'text_rights_sv', 
			__( 'text_rights_sv', 'wordpress' ), 
			'c_info_generator_textarea_field_callback', 
			'cInfoPluginPage_sv', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'text_rights_sv' )
		);

		add_settings_field( 
			'video_rights_sv', 
			__( 'video_rights_sv', 'wordpress' ), 
			'c_info_generator_textarea_field_callback', 
			'cInfoPluginPage_sv', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'video_rights_sv' )
		);

		add_settings_field( 
			'sound_rights_sv', 
			__( 'sound_rights_sv', 'wordpress' ), 
			'c_info_generator_textarea_field_callback', 
			'cInfoPluginPage_sv', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'sound_rights_sv' )
		);

		add_settings_field( 
			'description_sv', 
			__( 'description_sv', 'wordpress' ), 
			'c_info_generator_textarea_field_callback', 
			'cInfoPluginPage_sv', 
			'c_info_generator_pluginPage_section',
			array ( 'field' => 'description_sv' )
		);
		
	}

	function c_info_generator_text_field_callback($opt) { 
		$lang = substr(strrchr($opt['field'], "_"), 1);
		$options = get_option( 'c_info_generator_settings_' . $lang );
		$name = 'c_info_generator_settings_'.$lang.'['.$opt['field'].']';
		?>
		<input type='text' name='<?php echo $name ?>' value='<?= isset( $options[$opt['field']] ) ? $options[$opt['field']] : ''; ?>'>
		<?php
	}

	function c_info_generator_textarea_field_callback($opt) { 
		$lang = substr(strrchr($opt['field'], "_"), 1);
		$options = get_option( 'c_info_generator_settings_'  . $lang );
		$name = 'c_info_generator_settings_'.$lang.'['.$opt['field'].']'
		?>
		<textarea cols='40' rows='5' name='<?php echo $name ?>'><?= isset( $options[$opt['field']] ) ? $options[$opt['field']] : ''; ?></textarea>
		<?php
	}

	function c_info_generator_options_page() { 

        ?>
        <h1>C-Info asetukset</h1>
		<p>Anna rajapinnasta haettavat vakioteksti eri kieliversoille. Erota monivalinta vaihtoehdot pilkulla (,).</p>
        <?php
            if ( isset( $_GET[ 'tab' ] ) ) {
                $active_tab = $_GET[ 'tab' ];
            } else {
                $active_tab = 'pluginPage_fi' ;
            }
        ?>
         
        <h2 class="nav-tab-wrapper">
            <a href="?page=c_info_generator&tab=pluginPage_fi" class="nav-tab <?php echo $active_tab == 'pluginPage_fi' ? 'nav-tab-active' : ''; ?>">C-info FI</a>
            <a href="?page=c_info_generator&tab=pluginPage_en" class="nav-tab <?php echo $active_tab == 'pluginPage_en' ? 'nav-tab-active' : ''; ?>">C-info EN</a>
            <a href="?page=c_info_generator&tab=pluginPage_sv" class="nav-tab <?php echo $active_tab == 'pluginPage_sv' ? 'nav-tab-active' : ''; ?>">C-info SV</a>
        </h2>

        <form action='options.php' method='post'>

            <?php

			//settings_fields( 'cInfoPluginPage' );
			//do_settings_sections( 'cInfoPluginPage' );

            if ( $active_tab == 'pluginPage_en' ) {
				echo '<h2>C-Info EN</h2>';
				$options = get_option( 'c_info_generator_settings_en' );
				settings_fields( 'cInfoPluginPage_en' );
				do_settings_sections( 'cInfoPluginPage_en' );
            } else if ($active_tab == 'pluginPage_sv') {
				echo '<h2>C-Info SV</h2>';
				$options = get_option( 'c_info_generator_settings_sv' );
				settings_fields( 'cInfoPluginPage_sv' );
				do_settings_sections( 'cInfoPluginPage_sv' );
            } else  {
				echo '<h2>C-Info FI</h2>';
				$options = get_option( 'c_info_generator_settings_fi' );
				settings_fields( 'cInfoPluginPage_fi' );
				do_settings_sections( 'cInfoPluginPage_fi' );
            }

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

<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    C-Info_Generator
 * @subpackage C-Info_Generator/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    C-Info_Generator
 * @subpackage C-Info_Generator/public
 * @author     Your Name <email@example.com>
 */
class C_Info_Generator_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $c_info_generator    The ID of this plugin.
	 */
	private $c_info_generator;

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
	 * @param      string    $c_info_generator       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $c_info_generator, $version ) {

		$this->c_info_generator = $c_info_generator;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in C-Info_Generator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The C-Info_Generator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->c_info_generator, plugin_dir_url( __FILE__ ) . 'css/c_info_generator.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in C-Info_Generator_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The C-Info_Generator_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->c_info_generator, plugin_dir_url( __FILE__ ) . 'js/c_info_generator.js', array( 'jquery' ), $this->version, false );

	}

}

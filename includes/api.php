<?php
/**
 * WP REST API
 * Route is located at wp-json/c-info/data/
 * @package WP_API
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! class_exists( 'WP_REST' ) ) :


    /**
     * WP REST Menus class.
     *
     * WP API support for WP API v2.
     *
     * @package WP_API
     * @since 1.2.0
     */
    class WP_REST {


	    /**
	     * Get WP API namespace.
	     *
	     * @since 1.2.0
	     * @return string
	     */
        public static function get_api_namespace() {
            return 'wp/';
        }


	    /**
	     * Get WP API namespace.
	     *
	     * @since 1.2.1
	     * @return string
	     */
	    public static function get_plugin_namespace() {
		    return 'c-info/';
	    }


        /**
         * Register routes for WP API.
         *
         * @since  1.2.0
         */
        public function register_routes() {

            register_rest_route( self::get_plugin_namespace(), '/data', array(
                array(
                    'methods'  => WP_REST_Server::READABLE,
                    'callback' => array( $this, 'get_data' ),
                )
            ) );
        }


        /**
         * Get data.
         *
         * @since  1.2.0
         * @return array All registered data
         */
        public static function get_data() {

            $rest_url = trailingslashit( get_rest_url() . self::get_plugin_namespace() . '/data/' );

            $options = get_option( 'c_info_generator_settings_fi' );
            $data[ 'fi' ]['publisher'] = $options['publisher_fi'];
            $data[ 'fi' ]['header'] = $options['header_fi'];
            $data[ 'fi' ]['maker_material'] = $options['maker_title_fi'];
            $data[ 'fi' ]['material_choice'] = $options['material_choice_fi'];
            $data[ 'fi' ]['maker_choice'] = $options['maker_choice_fi'];
            $data[ 'fi' ]['right_title'] = $options['right_title_fi'];
            $data[ 'fi' ]['video_title'] = $options['video_title_fi'];
            $data[ 'fi' ]['sound_title'] = $options['sound_title_fi'];
            $data[ 'fi' ]['text_rights'] = $options['text_rights_fi'];
            $data[ 'fi' ]['video_rights'] = $options['video_rights_fi'];
            $data[ 'fi' ]['sound_rights'] = $options['sound_rights_fi'];
            $data[ 'fi' ]['description'] = $options['description_fi'];

            $options = get_option( 'c_info_generator_settings_en' );
            $data[ 'en' ]['publisher'] = $options['publisher_en'];
            $data[ 'en' ]['header'] = $options['header_en'];
            $data[ 'en' ]['maker_material'] = $options['maker_title_en'];
            $data[ 'en' ]['material_choice'] = $options['material_choice_en'];
            $data[ 'en' ]['maker_choice'] = $options['maker_choice_en'];
            $data[ 'en' ]['right_title'] = $options['right_title_en'];
            $data[ 'en' ]['video_title'] = $options['video_title_en'];
            $data[ 'en' ]['sound_title'] = $options['sound_title_en'];
            $data[ 'en' ]['text_rights'] = $options['text_rights_en'];
            $data[ 'en' ]['video_rights'] = $options['video_rights_en'];
            $data[ 'en' ]['sound_rights'] = $options['sound_rights_en'];
            $data[ 'en' ]['description'] = $options['description_en'];

            $options = get_option( 'c_info_generator_settings_sv' );
            $data[ 'sv' ]['publisher'] = $options['publisher_sv'];
            $data[ 'sv' ]['header'] = $options['header_sv'];
            $data[ 'sv' ]['maker_material'] = $options['maker_title_sv'];
            $data[ 'sv' ]['material_choice'] = $options['material_choice_sv'];
            $data[ 'sv' ]['maker_choice'] = $options['maker_choice_sv'];
            $data[ 'sv' ]['right_title'] = $options['right_title_sv'];
            $data[ 'sv' ]['video_title'] = $options['video_title_sv'];
            $data[ 'sv' ]['sound_title'] = $options['sound_title_sv'];
            $data[ 'sv' ]['text_rights'] = $options['text_rights_sv'];
            $data[ 'sv' ]['video_rights'] = $options['video_rights_sv'];
            $data[ 'sv' ]['sound_rights'] = $options['sound_rights_sv'];
            $data[ 'sv' ]['description'] = $options['description_sv'];

            return apply_filters( 'rest_menus_format_menus', $data );
        }

    }

endif;